<?php 

    // mulai session
    session_start();
    // koneksi ke database
    require "../admin/connection.php";

    // jika member sudah login, tapi status member non aktif
    if(isset($_SESSION["member"])) {
        $idM         = $_SESSION["member"]["id_member"];
        $ambilMember = $conn->query("SELECT * FROM member WHERE id_member = '$idM' ");
        $pecahMember = $ambilMember->fetch_assoc();
        // jika status member non aktif
        if($pecahMember["status_member"] == "non active") {
            // alihkan ke halaman login
            echo "<script>location ='login.php';</script>";
            header('Location: login.php');
            $idM     = session_unset();
            exit();
        }
    }
    else if(!isset($_SESSION["member"])) {
        $idM     = session_unset();
    }

    // ambil id kategori di url
    $idKategori = base64_decode($_GET["id"]);

    // cek jika id di url kosong atau bukan angka
    if(empty($idKategori) || !intval($idKategori)) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }
    // ambil data kategori dari tabel kategori sesuai id di url
    $ambilKategori = $conn->query("SELECT * FROM kategori WHERE id_kategori = '$idKategori' ");
    $adaDataTidak  = $ambilKategori->num_rows;
    // jika id kategori yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Albumi Comp - Laptop Review</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Embed Stylesheet -->
    <style>a.btn-detail-produk:hover{font-weight: normal;}</style>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <?php require "header.php"; ?>

    <!-- ##### Breadcrumb Area Start ##### -->
    <div class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/27.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <!-- Breadcrumb Text -->
                <div class="col-12">
                    <div class="breadcrumb-text">
                        <h2>Review</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Game Review Area Start ##### -->
    <section class="game-review-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- *** Single Review Area *** -->
                    <?php $ambil = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_kategori = '$idKategori' "); ?>
                    <?php while($pecah = $ambil->fetch_assoc()) { ?>
                        <div class="single-game-review-area d-flex flex-wrap mb-30">
                            <div class="game-thumbnail">
                                <img src="../admin/dist/img-produk/<?=$pecah['foto_produk']; ?>" alt="error">
                            </div>
                            <div class="game-content">
                                <span class="game-tag"><?=$pecah["kategori_produk"]; ?></span>
                                <a class="game-title"><?=$pecah["nama_produk"]; ?></a>
                                <div class="game-meta">
                                    <a class="game-date">Rp. <?=number_format($pecah["harga_produk"]); ?></a>
                                    <a class="game-comments"><?=$pecah["berat_produk"]; ?> Gr</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="game-comments">Qty: <?=$pecah["stok_produk"]; ?></a>
                                </div>
                                <p><?=$pecah["deskripsi_produk"]; ?></p>
                                <!-- Download & Rating Area -->
                                <div class="download-rating-area d-flex align-items-center justify-content-between">
                                    <div class="download-area">
                                        <a href="laptop_detail.php?id=<?=base64_encode($pecah['id_produk']); ?>" class="btn btn-info btn-block btn-detail-produk"><strong>Detail produk</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <!-- ### Pagination Area ### -->
                    <!-- <nav aria-label="Page navigation example">
                        <ul class="pagination mt-100">
                            <li class="page-item active"><a class="page-link" href="#">01</a></li>
                        </ul>
                    </nav> -->
                    
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Game Review Area End ##### -->

    <?php require "footer.php"; ?>

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>