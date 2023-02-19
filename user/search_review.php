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

    // ambil keyword dari url
    $keyword = $_GET["k"];

    // cari dan ambil data yang dicari dari tabel produk
    $ambilSearch = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE nama_produk LIKE '%$keyword%' OR kategori_produk LIKE '%$keyword%' ");
    $hasilSearch = $ambilSearch->num_rows;

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
    <title>AlbumiComp - Search Review</title>

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

    <!-- ##### Game Review Area Start ##### -->
    <section class="game-review-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <h4 class="mb-4">Hasil pencarian: 
                        <em class="text-secondary"><u><?=$keyword; ?></u></em> 
                    </h4>

                    <!-- jika data ada dan tidak ada -->
                    <?php if($hasilSearch > 0) { ?>

                    <!-- *** Single Review Area *** -->
                    <?php while($pecahSearch = $ambilSearch->fetch_assoc()) { ?>
                        <div class="single-game-review-area d-flex flex-wrap mb-30">
                            <div class="game-thumbnail">
                                <img src="../admin/dist/img-produk/<?=$pecahSearch['foto_produk']; ?>" alt="error">
                            </div>
                            <div class="game-content">
                                <span class="game-tag"><?=$pecahSearch["kategori_produk"]; ?></span>
                                <a class="game-title"><?=$pecahSearch["nama_produk"]; ?></a>
                                <div class="game-meta">
                                    <a class="game-date">Rp. <?=number_format($pecahSearch["harga_produk"]); ?></a>
                                    <a class="game-comments"><?=$pecahSearch["berat_produk"]; ?> Gr</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a class="game-comments">Qty: <?=$pecahSearch["stok_produk"]; ?></a>
                                </div>
                                <p><?=$pecahSearch["deskripsi_produk"]; ?></p>
                                <!-- Download & Rating Area -->
                                <div class="download-rating-area d-flex align-items-center justify-content-between">
                                    <div class="download-area">
                                        <a href="laptop_detail.php?id=<?=base64_encode($pecahSearch['id_produk']); ?>" class="btn btn-info btn-block btn-detail-produk"><strong>Detail produk</strong></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php } else { ?>

                        <div class="data-search">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="text-center" style="margin-top: 100px; color: lightgray;">:( Sorry, <strong><u><?=$keyword; ?></u></strong> not found</h1>
                                </div>
                            </div>    
                        </div>

                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Game Review Area End ##### -->

    <?php // require "footer.php"; ?>

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