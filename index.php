
<?php
include_once 'koneksi.php';
$page = isset($_GET['page']) ? $_GET['page'] :"home";
function loadPage($page){
    if ($page === 'home'){
      include 'file_/home.php';
    }else if ($page === 'upload_berita'){
      include 'file_/upload_berita.php';
    }else if ($page === 'kategori'){
      include 'file_/kategori.php';
    } else if ($page === 'detail_berita'){
      include 'file_/detail_berita.php';
    }else if ($page === 'tagar'){
      include 'file_/tagar.php';
    } else if ($page === 'admin'){
      include 'file_/admin.php';
    }else {
      include 'file_/404/error.php';  
    }
}
include '_template/header.php';
loadPage(page: $page);
include '_template/footer.php';?>
