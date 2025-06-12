<?php
include "koneksi.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (isset($_POST['judul_kategori']) && !empty(trim($_POST['judul_kategori']))) {
        $judulKategori = $conn->real_escape_string(trim($_POST['judul_kategori']));
        $tanggalDibuat = date('Y-m-d');
      
        $sql = "INSERT INTO tb_kategori (judul_kategori, tanggaldibuat) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Gagal menyiapkan query: " . $conn->error);
        }

        
        $stmt->bind_param("ss", $judulKategori, $tanggalDibuat);

        if ($stmt->execute()) {
           
            echo "<script>alert('Kategori berhasil ditambahkan!');</script>";
            echo '<meta http-equiv="refresh" content="1; url=?page=home">';
            exit();
        } else {
         
            $errorMsg = urlencode($stmt->error);
            echo "<script>alert('Gagal menambahkan kategori: " . $errorMsg . "');</script>";
            echo '<meta http-equiv="refresh" content="1; url=?page=home">';
            exit();
        }

      
        $stmt->close();
    } else {
        
        $errorMsg = urlencode("Judul kategori tidak boleh kosong.");
        echo "<script>alert('Gagal: $errorMsg');</script>";
        echo '<meta http-equiv="refresh" content="1; url=?page=home">';
        exit();
    }
} else {
 
    echo '<meta http-equiv="refresh" content="0; url=?page=home">';
    exit();
}
$conn->close();
?>
