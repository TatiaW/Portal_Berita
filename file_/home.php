<?php include 'koneksi.php'?>
<head>
   <style>
     .search-form {
        vertical-align: middle;
        display: inline-block;
    }
    .search-form input.form-control {
       padding: 5px 15px;
        border: 1px solid #ddd;
        outline: none;
        display: inline-block;
        vertical-align: middle;
    }
    .search-form button {
        border-radius: 0 0 0 0;
        padding: 5px 15px;
        display: inline-block;
        vertical-align: middle;
    }
    .disabled {
        color: #ccc;
        pointer-events: none;
    }              
                  .pagination .disabled {
                     margin: 0 5px;
                     color: grey;
                     pointer-events: none;
                  }
                     .tag-container {
                  display: flex;
                  flex-wrap: wrap;
                  border: 1px solid #ccc;
                  padding: 6px;
                  border-radius: 4px;
                  min-height: 42px;
                  cursor: text;
               }
               .tag-container input {
                  border: none;
                  outline: none;
                  flex: 1;
                  padding: 6px;
               }
               .tag {
                  background: #fc3f00;
                  color: white;
                  padding: 6px 12px;
                  border-radius: 20px;
                  margin: 4px;
                  display: flex;
                  align-items: center;
                  font-size: 0.9rem;
               }
               .tag .remove-tag {
                  margin-left: 8px;
                  cursor: pointer;
                  font-weight: bold;
               }

                     form textarea {
                  width: 100%;
                  padding: 10px;
                  margin-bottom: 15px;
                  border-radius: 4px;
                  border: 1px solid #ccc;
                  font-size: 1rem;
                  resize: vertical;
               }
                     form select {
                  width: 100%;
                  padding: 10px 12px;
                  margin-bottom: 15px;
                  border: 1px solid #ccc;
                  border-radius: 4px;
                  font-size: 1rem;
                  background-color: #fff;
                  color: #333;
                  appearance: none;
                  -webkit-appearance: none;
                  -moz-appearance: none;
                  background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='10'%3E%3Cpath fill='gray' d='M7 10L0 0h14z'/%3E%3C/svg%3E");
                  background-repeat: no-repeat;
                  background-position: right 12px center;
                  background-size: 12px;
               }

        .col-lg-7 {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            padding: 20px;
        }
        .widget_title {
            font-size: 1.8rem;
            margin-bottom: 20px;
            border-left: 5px solid #fc3f00;
            padding-left: 10px;
            color: #fc3f00;
        }
        .news-list {
            list-style-type: none; /* Remove default list styling */
            padding: 0; /* Remove default padding */
            margin: 0; /* Remove default margin */
        }
        .news-item {
            display: flex;
            gap: 15px;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 12px;
            padding-top: 12px; /* Add padding for spacing */
        }
        .news-item:last-child {
            border: none;
        }
        .news-img img {
            width: 120px;
            height: 80px;
            object-fit: cover;
            border-radius: 6px;
        }
        .news-content {
            flex: 1;
        }
        
        
        .news-title {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 6px 0;
            color: #222;
            transition: color 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .news-title:hover {
            color: #fc3f00;
        }
        .news-date {
            font-size: 0.85rem;
            color: #888;
        }

        /* Pagination styles */
        .pagination {
            margin-top: 25px;
            text-align: center;
            user-select: none;
        }
        .pagination a, .pagination span {
            display: inline-block;
            margin: 0 6px;
            padding: 7px 14px;
            color: #fc3f00;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .pagination a:hover:not(.disabled) {
            background-color: #fc3f00;
            color: #fff;
            border-color: #fc3f00;
        }
        .pagination a.disabled {
            color: #ccc;
            cursor: default;
            pointer-events: none;
        }
        .pagination a.active {
            background-color: #fc3f00;
            color: #fff;
            border-color: #fc3f00;
            cursor: default;
        }
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
        }
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }
        form input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }
        form button {
            background-color: transparent;
            border: 2px solid #fc3f00;
            color: #fc3f00;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 30px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        form button:hover {
            background-color: #fc3f00;
            color: #fff;
        }
        /* Buttons container styling */
        .trending-tittle {
            margin-bottom: 20px;
            text-align: center;
        }

    </style>
</head>

<body>
<section class="blog_area single-post-area ">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 ">
                <div class="trending-tittle">

                    
                    <!-- Form Pencarian -->
                    <form action="?page=home" method="get" class="search-form mx-2 " style="display: inline-block;">
                        <input type="hidden" name="page" value="home">
                        <input type="text" name="search" placeholder="Cari berita..." class="form-control" style="display: inline; width: 200px;" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="genric-btn danger-border" style="margin-left:  5px;">Cari</button>
                    </form>

                    <div class="trending-animated">
                    </div>
                </div>
            </div>
        </div>

        <!-- Kategori content -->
        <div class="row">
            <div class="col-lg-3">
                <div class="blog_right_sidebar">
                    <?php
                    // Ambil semua kategori beserta jumlah berita per kategori
                    $query = mysqli_query($conn, "
                        SELECT k.kategori_id, k.judul_kategori, COUNT(n.news_id) AS total_berita
                        FROM tb_kategori k
                        LEFT JOIN tb_news n ON k.kategori_id = n.kategori_id
                        GROUP BY k.kategori_id, k.judul_kategori
                        ORDER BY k.judul_kategori ASC
                    ");
                    ?>

                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Category</h4>
                        <?php
                        // Ambil id kategori yang aktif dari URL
                        $currentKategoriId = isset($_GET['id']) ? intval($_GET['id']) : 0;
                        ?>

                        <ul class="list cat-list">
                            <li><a href="?page=home" class="d-flex">
                                    <p>Semua</p>
                                </a>
                            </li>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <?php
                                    $id = $row['kategori_id'];
                                    $judul = htmlspecialchars($row['judul_kategori']);
                                    $total = $row['total_berita'];

                                    // Tentukan link dan class aktif
                                    if ($currentKategoriId === $id) {
                                        // Jika ini kategori sedang aktif, link ke halaman tanpa filter (toggle off)
                                        $link = "?page=home"; 
                                        $activeClass = "active"; // misal beri class css untuk highlight
                                    } else {
                                        // Jika ini bukan kategori aktif, link ke filter kategori itu
                                        $link = "?page=home&id=$id"; 
                                        $activeClass = "";
                                    }
                                ?>
                                <li class="<?= $activeClass ?>">
                                    <a href="<?= $link ?>" class="d-flex">
                                        <p><?= $judul ?></p>
                                        <p>(<?= $total ?>)</p>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </aside>
                </div>
            </div>

            <!-- Berita content -->
            <div class="col-lg-7">
                <div class="trending-area fix">
                    <div class="container">
                        <div class="trending-main">
                            <h4 class="widget_title">Berita</h4>
                            
                            <ul class="news-list" id="newsList">
                                <?php
                                $kategori_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
                                $tagar_id = isset($_GET['tag']) ? intval($_GET['tag']) : 0;
                                $search_query = isset($_GET['search']) ? trim($_GET['search']) : '';
                                $pageNumber = isset($_GET['pageNumber']) ? max(1, intval($_GET['pageNumber'])) : 1;
                                $perPage = 5;
                                $offset = ($pageNumber - 1) * $perPage;

                                // Total berita
                                if ($tagar_id > 0) {
                                    $countQuery = "
                                        SELECT COUNT(*) AS total
                                        FROM tb_news n
                                        JOIN tb_news_tagar nt ON n.news_id = nt.news_id
                                        WHERE nt.tagar_id = $tagar_id
                                    ";
                                } elseif ($kategori_id > 0) {
                                    $countQuery = "SELECT COUNT(*) AS total FROM tb_news WHERE kategori_id = $kategori_id";
                                } elseif (!empty($search_query)) {
                                    $search_like = "%" . mysqli_real_escape_string($conn, $search_query) . "%";
                                    $countQuery = "SELECT COUNT(*) AS total FROM tb_news 
                                                  WHERE judul LIKE '$search_like' OR slugs LIKE '$search_like'";
                                } else {
                                    $countQuery = "SELECT COUNT(*) AS total FROM tb_news";
                                }

                                $countResult = mysqli_query($conn, $countQuery);
                                $countData = mysqli_fetch_assoc($countResult);
                                $totalBerita = $countData['total'];
                                $totalHalaman = $perPage > 0 ? ceil($totalBerita / $perPage) : 1;

                                // Query berita
                                if ($tagar_id > 0) {
                                    $sql = "
                                        SELECT n.*, k.judul_kategori 
                                        FROM tb_news n
                                        JOIN tb_kategori k ON n.kategori_id = k.kategori_id
                                        JOIN tb_news_tagar nt ON n.news_id = nt.news_id
                                        WHERE nt.tagar_id = $tagar_id
                                        ORDER BY n.tanggal DESC
                                        LIMIT $offset, $perPage
                                    ";
                                } elseif ($kategori_id > 0) {
                                    $sql = "
                                        SELECT n.*, k.judul_kategori 
                                        FROM tb_news n
                                        JOIN tb_kategori k ON n.kategori_id = k.kategori_id
                                        WHERE n.kategori_id = $kategori_id
                                        ORDER BY n.tanggal DESC
                                        LIMIT $offset, $perPage
                                    ";
                                } elseif (!empty($search_query)) {
                                    $search_like = "%" . mysqli_real_escape_string($conn, $search_query) . "%";
                                    $sql = "
                                        SELECT n.*, k.judul_kategori 
                                        FROM tb_news n
                                        JOIN tb_kategori k ON n.kategori_id = k.kategori_id
                                        WHERE n.judul LIKE '$search_like' OR n.slugs LIKE '$search_like'
                                        ORDER BY n.tanggal DESC
                                        LIMIT $offset, $perPage
                                    ";
                                } else {
                                    $sql = "
                                        SELECT n.*, k.judul_kategori 
                                        FROM tb_news n
                                        JOIN tb_kategori k ON n.kategori_id = k.kategori_id
                                        ORDER BY n.tanggal DESC
                                        LIMIT $offset, $perPage
                                    ";
                                }

                                $query = mysqli_query($conn, $sql);

                                if (!$query) {
                                    echo "<li>Error query: " . mysqli_error($conn) . "</li>";
                                } elseif (mysqli_num_rows($query) == 0) {
                                    echo "<li>Belum ada berita tersedia.</li>";
                                } else {
                                    while ($data = mysqli_fetch_assoc($query)) {
                                        $judul = htmlspecialchars($data['judul']);
                                        $slug = htmlspecialchars($data['slugs']);
                                        $gambar = htmlspecialchars($data['image']);
                                        $tanggal = date('d F Y', strtotime($data['tanggal']));
                                        $kategori = htmlspecialchars($data['judul_kategori']);

                                        echo "
                                            <li class='trand-right-single d-flex'>
                                                <div class='trand-right-img'>
                                                    <img src='$gambar' alt='gambar $judul' style='width: 100px; height: auto;' />
                                                </div>
                                                <div class='trand-right-cap'>
                                                    <span class='color1'>$kategori</span>
                                                    <h4><a href='?page=detail_berita&slug=$slug' class='news-title'>$judul</a></h4>
                                                    <p class='news-date'>$tanggal</p>
                                                </div>
                                            </li>
                                        ";
                                    }
                                }
                                ?>
                            </ul>

                            <!-- Pagination -->
                            <div class="pagination" id="pagination">
                                <?php
                                $extraParam = "";
                                if ($tagar_id > 0) {
                                    $extraParam = "&tag=$tagar_id";
                                } elseif ($kategori_id > 0) {
                                    $extraParam = "&id=$kategori_id";
                                } elseif (!empty($search_query)) {
                                    $extraParam = "&search=" . urlencode($search_query);
                                }

                                if ($pageNumber > 1) {
                                    $prevPage = $pageNumber - 1;
                                    echo "<a href='?page=home&pageNumber=$prevPage$extraParam'>« Prev</a>";
                                } else {
                                    echo "<a href='#' class='disabled'>« Prev</a>";
                                }

                                if ($pageNumber < $totalHalaman) {
                                    $nextPage = $pageNumber + 1;
                                    echo "<a href='?page=home&pageNumber=$nextPage$extraParam'>Next »</a>";
                                } else {
                                    echo "<a href='#' class='disabled'>Next »</a>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tag content -->
            <div class="col-lg-2">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget tag_cloud_widget">
                        <h4 class="widget_title">Tag</h4>
                        <ul class="list">
                            <?php
                            $queryTagar = mysqli_query($conn, "
                                SELECT tagar_id, judul_tagar 
                                FROM tb_tagar 
                                ORDER BY tanggaldibuat DESC 
                                LIMIT 20
                            ");

                            while ($tag = mysqli_fetch_assoc($queryTagar)) {
                                $judulTagar = htmlspecialchars($tag['judul_tagar']);
                                $tagarId = $tag['tagar_id'];
                                echo "<li><a href='?page=home&tag=$tagarId'>#$judulTagar</a></li>";
                            }
                            ?>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>

         <!-- Modal for Adding Category -->
         <div id="categoryModal" class="modal" aria-hidden="true" role="dialog">
            <div class="modal-content" role="document">
               <span class="close" id="closeModal" aria-label="Close modal">&times;</span>
               <h2>Tambah Kategori</h2>
               <form id="categoryForm" action="?page=kategori" method="POST">
                     <label for="categoryName">Judul Kategori:</label>
                     <input type="text" id="categoryName" name="judul_kategori" required />
                     <button type="submit" class="genric-btn danger-border">Simpan</button>
               </form>
            </div>
         </div>

         <!-- Modal for Adding News -->
         <div id="newsModal" class="modal" aria-hidden="true" role="dialog">
            <div class="modal-content" role="document">
               <span class="close" id="closeNewsModal" aria-label="Close modal">&times;</span>
               <h2>Tambah Berita</h2>
               <form id="newsForm" action="?page=upload_berita" method="POST" enctype="multipart/form-data">
                     <label for="judul">Judul Berita:</label>
                     <input type="text" id="judul" name="judul" required />

                     <label for="deskripsi">Deskripsi:</label>
                     <textarea id="deskripsi" name="deskripsi" rows="5" required></textarea>

                     <label for="image">Gambar:</label>
                     <input type="file" id="image" name="image" accept="image/*" required />

                     <label for="kategori">Kategori:</label>
                     <select id="kategori" name="kategori" required>
                        <?php
                        include 'koneksi.php';
                        $result = mysqli_query($conn, "SELECT * FROM tb_kategori");
                        while ($row = mysqli_fetch_assoc($result)) {
                           echo "<option value='{$row['kategori_id']}'>{$row['judul_kategori']}</option>";
                        }
                        ?>
                     </select>
                     <label for="tagar_input">Tagar (#):</label>
                     <div id="tagarContainer" class="tag-container">
                        <input type="text" id="tagar_input" placeholder="#politik" />
                     </div>
                     <input type="hidden" name="tagar_text" id="tagar_hidden" required />

                     <br>
                     <button type="submit" class="genric-btn danger-border mt-5">Simpan</button>
               </form>
            </div>
         </div>


               <script>
                  // Modal functionality
                  const modal = document.getElementById("categoryModal");
                  const btnTambahKategori = document.getElementById("btnTambahKategori");
                  const spanClose = document.getElementById("closeModal");

                  btnTambahKategori.addEventListener("click", function(e) {
                     e.preventDefault();
                     modal.style.display = "block";
                     modal.setAttribute('aria-hidden', 'false');
                     document.getElementById("categoryName").focus();
                  });

                  spanClose.addEventListener("click", function() {
                     modal.style.display = "none";
                     modal.setAttribute('aria-hidden', 'true');
                  });

                  window.addEventListener("click", function(event) {
                     if (event.target == modal) {
                           modal.style.display = "none";
                           modal.setAttribute('aria-hidden', 'true');
                     }
                  });

                  // Modal tambah berita
                  const newsModal = document.getElementById("newsModal");
                  const btnTambahBerita = document.querySelector("a[href='?page=upload_berita']");
                  const closeNewsModal = document.getElementById("closeNewsModal");

                  btnTambahBerita.addEventListener("click", function(e) {
                     e.preventDefault();
                     newsModal.style.display = "block";
                     newsModal.setAttribute("aria-hidden", "false");
                     document.getElementById("judul").focus();
                  });

                  closeNewsModal.addEventListener("click", function() {
                     newsModal.style.display = "none";
                     newsModal.setAttribute("aria-hidden", "true");
                  });

                  window.addEventListener("click", function(event) {
                     if (event.target == newsModal) {
                           newsModal.style.display = "none";
                           newsModal.setAttribute("aria-hidden", "true");
                     }
                  });

                  // Tag input functionality
                  const tagInput = document.getElementById("tagar_input");
                  const tagContainer = document.getElementById("tagarContainer");
                  const hiddenInput = document.getElementById("tagar_hidden");
                  let tags = [];

                  tagInput.addEventListener("keydown", function(e) {
                     if (e.key === "Enter" || e.key === "," || e.key === " ") {
                           e.preventDefault();
                           const tag = tagInput.value.trim().replace(/^#/, '');
                           if (tag && !tags.includes(tag)) {
                              tags.push(tag);
                              updateTags();
                           }
                           tagInput.value = '';
                     }
                  });

                  function updateTags() {
                     // Clear existing tags
                     tagContainer.querySelectorAll(".tag").forEach(t => t.remove());

                     // Re-add all tags
                     tags.forEach(t => {
                           const tagEl = document.createElement("span");
                           tagEl.className = "tag";
                           tagEl.textContent = "#" + t;

                           const removeBtn = document.createElement("span");
                           removeBtn.className = "remove-tag";
                           removeBtn.textContent = "×";
                           removeBtn.onclick = () => {
                              tags = tags.filter(tag => tag !== t);
                              updateTags();
                           };

                           tagEl.appendChild(removeBtn);
                           tagContainer.insertBefore(tagEl, tagInput);
                     });

                     hiddenInput.value = tags.join(',');
                  }
               </script>
               </body>