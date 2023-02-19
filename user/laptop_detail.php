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

    // ambil id produk di url
    $id_produk = base64_decode($_GET["id"]);

    // ambil data produk dan kategori
    $ambil = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_produk = '$id_produk
        ' ");
    $pecah = $ambil->fetch_assoc();

    // cek jika id di url kosong atau bukan angka
    if(empty($id_produk) || !intval($id_produk)) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }
    // cek ada data yang dicari tidak
    $adaDataTidak = $ambil->num_rows;
    // jika id produk yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }

    // ambil data foto galeri
    $ambilFoto = $conn->query("SELECT * FROM foto WHERE id_produk = '$id_produk'");
    $pecahFoto = $ambilFoto->fetch_assoc();

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
    <title>Albumi Comp - Laptop Detail</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Embed Stylesheet -->
    <style>
        a.btn-claim-produk:hover,
        a.btn-claim-produk:focus,
        a.btn-accept:hover,
        a.btn-accept:focus{
            font-weight: normal;
        }
    </style>

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
                        <h2>Game Review</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Single Game Review Area Start ##### -->
    <section class="single-game-review-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="single-game-img-slides">
                        <div id="gameSlides" class="carousel slide" data-ride="carousel">

                            <div class="carousel-inner">
                            
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="../admin/dist/img-gallery/<?=$pecahFoto['foto1']; ?>" alt="error" style="width: 1200px; height: 650px;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="../admin/dist/img-gallery/<?=$pecahFoto['foto2']; ?>" alt="" style="width: 1200px; height: 650px;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="../admin/dist/img-gallery/<?=$pecahFoto['foto3']; ?>" alt="" style="width: 1200px; height: 650px;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="../admin/dist/img-gallery/<?=$pecahFoto['foto4']; ?>" alt="" style="width: 1200px; height: 650px;">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="../admin/dist/img-gallery/<?=$pecahFoto['foto5']; ?>" alt="" style="width: 1200px; height: 650px;">
                                </div>
                            
                            </div>
                            <ol class="carousel-indicators">
                                
                                <li data-target="#gameSlides" data-slide-to="0" class="active" style="background-image: url(../admin/dist/img-gallery/<?=$pecahFoto['foto1']; ?>);"></li>
                                <li data-target="#gameSlides" data-slide-to="1" style="background-image: url(../admin/dist/img-gallery/<?=$pecahFoto['foto2']; ?>);"></li>
                                <li data-target="#gameSlides" data-slide-to="2" style="background-image: url(../admin/dist/img-gallery/<?=$pecahFoto['foto3']; ?>);"></li>
                                <li data-target="#gameSlides" data-slide-to="3" style="background-image: url(../admin/dist/img-gallery/<?=$pecahFoto['foto4']; ?>);"></li>
                                <li data-target="#gameSlides" data-slide-to="4" style="background-image: url(../admin/dist/img-gallery/<?=$pecahFoto['foto5']; ?>);"></li>
                                
                            </ol>

                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <!-- *** Review Area *** -->
                <div class="col-12 col-md-6">
                    <div class="single-game-review-area style-2 mt-70">
                        
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
                                <div class="download-rating-area">
                                    <div class="download-area">
                                        <?php if(isset($_SESSION["member"])) : ?>

                                            <?php if($pecah["stok_produk"] == 0) : ?>
                                            <a href="" class="btn btn-secondary btn-block btn-claim-produk disabled"><strong>Stock is empty</strong></a>
                                            <?php else : ?>
                                            <a href="" class="btn btn-warning btn-block btn-claim-produk" name="claim-produk" data-target="#exampleModalScrollable" data-toggle="modal"><strong>Claim produk</strong></a>
                                            <?php endif; ?>

                                        <?php else : ?>

                                            <?php if($pecah["stok_produk"] == 0) : ?>
                                            <a href="" class="btn btn-secondary btn-block btn-claim-produk disabled"><strong>Stock is empty</strong></a>
                                            <?php else : ?>
                                            <a href="" class="btn btn-warning btn-block btn-claim-produk disabled"><strong>Claim produk (Login please!)</strong></a>
                                            <?php endif; ?>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                </div>

                <!-- *** Barfiller Area *** -->
                <div class="col-12 col-md-6">
                    <div class="egames-barfiller">
                        <!-- Single Barfiller -->
                        <div class="single-barfiller-area">
                            <div id="bar1" class="barfiller">
                                <span class="tip"></span>
                                <span class="fill" data-percentage="<?=$pecah['nilai_ux']; ?>"></span>
                                <p>User Experience</p>
                            </div>
                        </div>
                        <!-- Single Barfiller -->
                        <div class="single-barfiller-area">
                            <div id="bar2" class="barfiller">
                                <span class="tip"></span>
                                <span class="fill" data-percentage="<?=$pecah['nilai_desain']; ?>"></span>
                                <p>Design</p>
                            </div>
                        </div>
                        <!-- Single Barfiller -->
                        <div class="single-barfiller-area">
                            <div id="bar3" class="barfiller">
                                <span class="tip"></span>
                                <span class="fill" data-percentage="<?=$pecah['nilai_solusi']; ?>"></span>
                                <p>Solutions</p>
                            </div>
                        </div>
                        <!-- Single Barfiller -->
                        <div class="single-barfiller-area">
                            <div id="bar4" class="barfiller">
                                <span class="tip"></span>
                                <span class="fill" data-percentage="<?=$pecah['nilai_harga']; ?>"></span>
                                <p>Price</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Single Game Review Area End ##### -->

    <!-- Modal Accept-->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Verify</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php 
                        $result = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_produk = '$id_produk'"); 
                        $row = $result->fetch_assoc();
                    ?>
                    <div class="card" style="width: 100%">
                        <img src="../admin/dist/img-produk/<?=$row['foto_produk']; ?>" class="card-img-top" alt="error">
                        <div class="card-body">
                            <h5 class="card-title"><?=$row["nama_produk"]; ?></h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <h6 class="card-title">Rp. <?=number_format($row["harga_produk"]); ?></h6>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="card-title"><?=$row["berat_produk"]; ?> Gr</h6>
                                </div>
                                <div class="col-md-4">
                                    <h6 class="card-title"><?=$row["kategori_produk"]; ?> Both</h6>
                                </div>
                            </div>
                            <p class="card-text"><?=$row["deskripsi_produk"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Cancel</strong></button>
                    <!-- <button type="button" class="btn btn-success" data-target="#" data-toggle="modal"><strong>Accept</strong></button> -->
                    <a href="claim_product.php?id=<?=base64_encode($id_produk); ?>" class="btn btn-success btn-accept"><strong>Accept</strong></a>
                </div>
            </div>
        </div>
    </div>

    
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