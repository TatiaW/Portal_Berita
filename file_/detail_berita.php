<?php
include 'koneksi.php';

$slug = $_GET['slug'] ?? ''; 
if (!$slug) {
    echo "<p>Slug berita tidak ditemukan.</p>";
    exit;
}

// Query berita beserta kategori
$query = mysqli_query($conn, "
    SELECT n.*, k.judul_kategori 
    FROM tb_news n
    JOIN tb_kategori k ON n.kategori_id = k.kategori_id
    WHERE n.slugs = '$slug'
");

$berita = mysqli_fetch_assoc($query);

if (!$berita) {
    echo "<p>Berita tidak ditemukan.</p>";
    exit;
}

// Ambil tagar terkait berita (asumsi kamu punya tabel tb_news_tagar dan tb_tagar)
$news_id = $berita['news_id'];
$tagars = [];
$tagar_query = mysqli_query($conn, "
    SELECT t.judul_tagar FROM tb_tagar t
    JOIN tb_news_tagar nt ON t.tagar_id = nt.tagar_id
    WHERE nt.news_id = $news_id
");
while ($row = mysqli_fetch_assoc($tagar_query)) {
    $tagars[] = '#' . $row['judul_tagar'];
}
?>


   
            

 <section class="blog_area single-post-area section-padding">
      <div class="container">
         <div class="row">         
            <div class="col-lg-8 posts-list">
               <div class="trending-tittle">
                    <a href="?page=home" class="genric-btn danger-border mx-2">Kembali</a>
               </div>
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" src="<?= htmlspecialchars($berita['image']) ?>" alt="<?= htmlspecialchars($berita['judul']) ?>">
                    </div>
                    <div class="blog_details">
                        <h2><?= htmlspecialchars($berita['judul']) ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="fa fa-user"></i> <?= htmlspecialchars($berita['judul_kategori']) ?></a></li>
                            <li><a href="#"><i class="fa fa-calendar"></i> <?= date('d F Y', strtotime($berita['tanggal'])) ?></a></li>
                            <li><a href="#"><i class="fa fa-tag"></i> <?= htmlspecialchars(implode(' ', $tagars)) ?></a></li>
                        </ul>
                        <p class="excert">
                            <?= nl2br(htmlspecialchars($berita['deskripsi'])) ?>
                        </p>
                    </div>
                </div>
             </div>
            <div class="col-lg-4">
               <div class="blog_right_sidebar">
                  <aside class="single_sidebar_widget popular_post_widget">
                     <h3 class="widget_title">Recent Post</h3>
                     <?php
                     // Ambil 5 berita terbaru
                     $recent_query = mysqli_query($conn, "
                        SELECT judul, slugs, image, tanggal 
                        FROM tb_news 
                        ORDER BY tanggal DESC 
                        LIMIT 5
                     ");

                     // Simpan dulu ke array
                     $recent_posts = [];
                     while ($recent = mysqli_fetch_assoc($recent_query)) {
                        $recent_posts[] = $recent;
                     }

                     // Balik urutan array (jadi dari paling lama ke terbaru)
                     $recent_posts = array_reverse($recent_posts);

                     // Tampilkan
                     foreach ($recent_posts as $recent) {
                        $judul = htmlspecialchars($recent['judul']);
                        $slug = htmlspecialchars($recent['slugs']);
                        $gambar = htmlspecialchars($recent['image']);
                        $tanggal = date('d F Y', strtotime($recent['tanggal']));

                        echo "
                        <div class='media post_item'>
                              <img src='$gambar' alt='$judul' style='width: 80px; height: 60px; object-fit: cover;'>
                              <div class='media-body'>
                                 <a href='?page=detail_berita&slug=$slug'>
                                    <h3 style='font-size: 16px;'>$judul</h3>
                                 </a>
                                 <p>$tanggal</p>
                              </div>
                        </div>
                        ";
                     }
                     ?>
                  </aside>
               </div>
            </div>
         </div>
      </div>
   </section><?php

  

