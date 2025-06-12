<?php
include 'koneksi.php'; 

function generateSlug($string) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    return $slug;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul      = $_POST['judul'];
    $deskripsi  = $_POST['deskripsi'];
    $kategori   = $_POST['kategori'];
    $slug       = generateSlug($judul);
    $tanggal    = date('Y-m-d H:i:s');
    $tagarInput = $_POST['tagar_text']; 
    $tagars     = array_map('trim', explode(',', $tagarInput));

    // - Upload Gambar ---
    $imageName = $_FILES['image']['name'];
    $imageTmp  = $_FILES['image']['tmp_name'];
    $imagePath = 'uploads/' . time() . '_' . basename($imageName);

    if (!move_uploaded_file($imageTmp, $imagePath)) {
        die("Upload gambar gagal.");
    }

    // --- Simpan ke tb_news ---
    $query = "INSERT INTO tb_news (judul, deskripsi, tanggal, image, kategori_id, slugs) 
              VALUES ('$judul', '$deskripsi', '$tanggal', '$imagePath', '$kategori', '$slug')";

    if (mysqli_query($conn, $query)) {
        $news_id = mysqli_insert_id($conn);

        // ---  Simpan tagar & relasi ke tb_news_tagar ---
        foreach ($tagars as $tag) {
            $tag = ltrim($tag, '#');
            $cek = mysqli_query($conn, "SELECT tagar_id FROM tb_tagar WHERE judul_tagar = '$tag'");
            if (mysqli_num_rows($cek)) {
                $tagar_id = mysqli_fetch_assoc($cek)['tagar_id'];
            } else {
                mysqli_query($conn, "INSERT INTO tb_tagar (judul_tagar, tanggaldibuat) VALUES ('$tag', '$tanggal')");
                $tagar_id = mysqli_insert_id($conn);
            }
            mysqli_query($conn, "INSERT INTO tb_news_tagar (news_id, tagar_id) VALUES ('$news_id', '$tagar_id')");
        }

        echo "<script>alert('Berita berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
