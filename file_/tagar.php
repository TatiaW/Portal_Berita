<?php
include "koneksi.php";


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['judul_tagar'])) {
    $judul_tagar = $conn->real_escape_string(trim($_POST['judul_tagar']));
    $tanggal = date('Y-m-d');
    
    $sql = "INSERT INTO tb_tagar (judul_tagar, tanggaldibuat) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $judul_tagar, $tanggal);
    
    if ($stmt->execute()) {
        echo "<script>alert('Tag berhasil ditambahkan!');</script>";
        echo '<meta http-equiv="refresh" content="1">';
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    $stmt->close();
}


if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
   
    $conn->begin_transaction();
    
    try {
       
        $sql1 = "DELETE FROM tb_news_tags WHERE tagar_id = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("i", $id);
        $stmt1->execute();
        $stmt1->close();
        
   
        $sql2 = "DELETE FROM tb_tagar WHERE tagar_id = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();
        
        $conn->commit();
        echo "<script>alert('Tag berhasil dihapus!');</script>";
        echo '<meta http-equiv="refresh" content="1">';
    } catch (Exception $e) {
        $conn->rollback();
        echo "<script>alert('Gagal menghapus tag: " . $e->getMessage() . "');</script>";
    }
}

$tags = $conn->query("SELECT t.*, COUNT(nt.news_id) as jumlah_berita 
                     FROM tb_tagar t
                     LEFT JOIN tb_news_tags nt ON t.tagar_id = nt.tagar_id
                     GROUP BY t.tagar_id
                     ORDER BY t.judul_tagar");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tag</title>
    <style>
        .tag-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .tag-list {
            list-style: none;
            padding: 0;
        }
        .tag-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-bottom: 1px solid #eee;
        }
        .tag-item:last-child {
            border-bottom: none;
        }
        .tag-actions a {
            color: #fc3f00;
            margin-left: 10px;
            text-decoration: none;
        }
        .tag-actions a:hover {
            text-decoration: underline;
        }
        .tag-form {
            margin-bottom: 20px;
        }
        .tag-form input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 300px;
        }
        .tag-form button {
            background: #fc3f00;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <section class="blog_area single-post-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tag-container">
                        <h2 class="widget_title">Manajemen Tag</h2>
                        
                        <div class="tag-form">
                            <form method="POST">
                                <input type="text" name="judul_tagar" placeholder="Nama tag baru" required>
                                <button type="submit">Tambah Tag</button>
                            </form>
                        </div>
                        
                        <ul class="tag-list">
                            <?php while($tag = $tags->fetch_assoc()): ?>
                                <li class="tag-item">
                                    <div class="tag-name">
                                        <strong><?= htmlspecialchars($tag['judul_tagar']) ?></strong>
                                        <span style="color: #777; font-size: 0.9rem; margin-left: 10px;">
                                            (<?= $tag['jumlah_berita'] ?> berita)
                                        </span>
                                    </div>
                                    <div class="tag-actions">
                                        <a href="?page=tag_detail&id=<?= $tag['tagar_id'] ?>">Lihat</a>
                                        <a href="?page=tagar&hapus=<?= $tag['tagar_id'] ?>" onclick="return confirm('Yakin hapus tag ini?')">Hapus</a>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
<?php $conn->close(); ?>