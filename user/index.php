<?php 

    // mulai session
    session_start();
    // koneksi ke database
    require "../admin/connection.php";

    // cek cookienya
    if(isset($_COOKIE["idC"]) && isset($_COOKIE["keyC"])) {
        // ambil value cookienya
        $idC    = $_COOKIE["idC"];
        $keyC   = $_COOKIE["keyC"];

        // ambil data member dari tabel member
        $ambilMemberC = $conn->query("SELECT * FROM member WHERE id_member = '$idC' ");
        $pecahMemberC = $ambilMemberC->fetch_assoc();

        // cek/verifikasi value keyC dengan nama member pada tabel member
        if($keyC === hash("sha256", $pecahMemberC["nama_member"])) {
            // jika cocok, set session membernya
            $_SESSION["member"] = $pecahMemberC;
        }

    }

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
    <title>Albumi Comp - Home</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Embed style index -->
    <style>
        .btn-popular,.btn-latest,.btn-cheap:hover{font-weight: normal !important;}
        .btn-gold:hover{color: white !important;}
        .btn-silver:hover{color: white !important;}
        .btn-bronze:hover{color: white !important;}
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

    <!-- Header Area -->
    <?php require "header.php"; ?>

    <!-- ##### Hero Area Start ##### -->
    <div class="hero-area">
        <!-- Hero Post Slides -->
        <div class="hero-post-slides owl-carousel">

            <!-- Single Slide -->
            <div class="single-slide bg-img bg-overlay" style="background-image: url(img/bg-img/1.jpg);">
                <!-- Blog Content -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-lg-9">
                            <div class="blog-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="400ms">The Power of Gaming</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique justo id elit bibendum pharetra non vitae lectus. Mauris libero felis, dapibus a ultrices sed, commodo vitae odio. Sed auctor tellus quis arcu tempus, egestas tincidunt.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide -->
            <div class="single-slide bg-img bg-overlay" style="background-image: url(img/bg-img/2.jpg);">
                <!-- Blog Content -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-lg-9">
                            <div class="blog-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="400ms">The Power of Gaming</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique justo id elit bibendum pharetra non vitae lectus. Mauris libero felis, dapibus a ultrices sed, commodo vitae odio. Sed auctor tellus quis arcu tempus, egestas tincidunt.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Slide -->
            <div class="single-slide bg-img bg-overlay" style="background-image: url(img/bg-img/msi.png);">
                <!-- Blog Content -->
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 col-lg-9">
                            <div class="blog-content" data-animation="fadeInUp" data-delay="100ms">
                                <h2 data-animation="fadeInUp" data-delay="400ms">The Power of Gaming</h2>
                                <p data-animation="fadeInUp" data-delay="700ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc tristique justo id elit bibendum pharetra non vitae lectus. Mauris libero felis, dapibus a ultrices sed, commodo vitae odio. Sed auctor tellus quis arcu tempus, egestas tincidunt.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Games Area Start ##### -->
    <div class="games-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- Single Games Area -->
                <div class="col-12 col-md-4">
                    <div class="single-games-area text-center mb-100 wow fadeInUp" data-wow-delay="100ms">
                        <img src="img/bg-img/asus.png" alt="">
                        <a href="#" class="btn egames-btn mt-30">View Site</a>
                    </div>
                </div>

                <!-- Single Games Area -->
                <div class="col-12 col-md-4">
                    <div class="single-games-area text-center mb-100 wow fadeInUp" data-wow-delay="300ms">
                        <img src="img/bg-img/lenovo2.png" alt="">
                        <a href="#" class="btn egames-btn mt-30">View Site</a>
                    </div>
                </div>

                <!-- Single Games Area -->
                <div class="col-12 col-md-4">
                    <div class="single-games-area text-center mb-100 wow fadeInUp" data-wow-delay="500ms">
                        <img src="img/bg-img/msi-logo.jpg" alt="">
                        <a href="#" class="btn egames-btn mt-30">View Site</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Games Area End ##### -->

    <!-- ##### Monthly Picks Area Start ##### -->
    <section class="monthly-picks-area section-padding-100 bg-pattern" id="monthly-picks-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="left-right-pattern"></div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Title -->
                    <h2 class="section-title mb-70 wow fadeInUp" data-wow-delay="100ms">This Month’s Pick</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs wow fadeInUp" data-wow-delay="300ms" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="popular-tab" data-toggle="tab" href="#popular" role="tab" aria-controls="popular" aria-selected="true">Popular</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="latest-tab" data-toggle="tab" href="#latest" role="tab" aria-controls="latest" aria-selected="false">Latest</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="editor-tab" data-toggle="tab" href="#editor" role="tab" aria-controls="editor" aria-selected="false">Cheap</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="tab-content wow fadeInUp" data-wow-delay="500ms" id="myTabContent">
            <div class="tab-pane fade show active" id="popular" role="tabpanel" aria-labelledby="popular-tab">
                <!-- Popular Laptop Slideshow -->
                <div class="popular-games-slideshow owl-carousel">

                    <!-- Single Laptop -->
                    <?php $ambilPopular = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.stok_produk <= 5"); ?>
                    <?php while($pecahPopular = $ambilPopular->fetch_assoc()) { ?>
                        <div class="single-games-slide">
                            <img src="../admin/dist/img-produk/<?=$pecahPopular["foto_produk"]; ?>" alt="">
                            <div class="slide-text">
                                <a href="#" class="game-title"><?=$pecahPopular["nama_produk"]; ?></a>
                                <div class="meta-data row">
                                    <div class="col-md-8">
                                        <p>Rp. <?=number_format($pecahPopular["harga_produk"]); ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><?=$pecahPopular["kategori_produk"]; ?></p>
                                    </div>
                                </div>
                                <a href="laptop_detail.php?id=<?=base64_encode($pecahPopular['id_produk']); ?>" class="btn btn-outline-info btn-block btn-popular">Details</a>
                            </div>
                        </div>
                    <?php } ?>                  

                </div>
            </div>
            <div class="tab-pane fade" id="latest" role="tabpanel" aria-labelledby="latest-tab">
                <!-- Latest Laptop Slideshow -->
                <div class="latest-games-slideshow owl-carousel">

                    <!-- Single Laptop -->
                    <?php $ambilLatest = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY produk.id_produk DESC LIMIT 0, 7"); ?>
                    <?php while($pecahLatest = $ambilLatest->fetch_assoc()) { ?>
                        <div class="single-games-slide">
                            <img src="../admin/dist/img-produk/<?=$pecahLatest["foto_produk"]; ?>" alt="">
                            <div class="slide-text">
                                <a href="#" class="game-title"><?=$pecahLatest["nama_produk"]; ?></a>
                                <div class="meta-data row">
                                    <div class="col-md-8">
                                        <p>Rp. <?=number_format($pecahLatest["harga_produk"]); ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><?=$pecahLatest["kategori_produk"]; ?></p>
                                    </div>
                                </div>
                                <a href="laptop_detail.php?id=<?=base64_encode($pecahLatest['id_produk']); ?>" class="btn btn-outline-info btn-block btn-latest">Details</a>
                            </div>
                        </div>
                    <?php } ?>    

                </div>
            </div>
            <div class="tab-pane fade" id="editor" role="tabpanel" aria-labelledby="editor-tab">
                <!-- cheap Laptop Slideshow -->
                <div class="editor-games-slideshow owl-carousel">

                    <!-- Single Laptop -->
                    <?php $ambilCheap = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.harga_produk <= 10000000"); ?>
                    <?php while($pecahCheap = $ambilCheap->fetch_assoc()) { ?>
                        <div class="single-games-slide">
                            <img src="../admin/dist/img-produk/<?=$pecahCheap["foto_produk"]; ?>" alt="">
                            <div class="slide-text">
                                <a href="#" class="game-title"><?=$pecahCheap["nama_produk"]; ?></a>
                                <div class="meta-data row">
                                    <div class="col-md-8">
                                        <p>Rp. <?=number_format($pecahCheap["harga_produk"]); ?></p>
                                    </div>
                                    <div class="col-md-4">
                                        <p><?=$pecahCheap["kategori_produk"]; ?></p>
                                    </div>
                                </div>
                                <a href="laptop_detail.php?id=<?=base64_encode($pecahCheap['id_produk']); ?>" class="btn btn-outline-info btn-block btn-cheap">Details</a>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
    <!-- ##### Monthly Picks Area End ##### -->

    <!-- ##### Video Area Start ##### -->
    <div class="egames-video-area section-padding-100 bg-pattern2" id="egames-video-area">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="egames-nav-btn">
                        <div class="nav flex-column" id="video-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="video1" data-toggle="pill" href="#video-1" role="tab" aria-controls="video-1" aria-selected="true">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="100ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/14.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Assemble Your Squad and Join the Battle</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video2" data-toggle="pill" href="#video-2" role="tab" aria-controls="video-2" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="200ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/15.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Tips to improve your game</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video3" data-toggle="pill" href="#video-3" role="tab" aria-controls="video-3" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="300ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/16.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Game reviews: the best of 2018</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video4" data-toggle="pill" href="#video-4" role="tab" aria-controls="video-4" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="400ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/17.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Assemble Your Squad and Join the Battle</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video5" data-toggle="pill" href="#video-5" role="tab" aria-controls="video-5" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="500ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/18.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Tips to improve your game</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video6" data-toggle="pill" href="#video-6" role="tab" aria-controls="video-6" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="600ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/14.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Game reviews: the best of 2018</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video7" data-toggle="pill" href="#video-7" role="tab" aria-controls="video-7" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="700ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/15.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Tips to improve your game</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>

                            <a class="nav-link" id="video8" data-toggle="pill" href="#video-8" role="tab" aria-controls="video-8" aria-selected="false">
                                <!-- Single Video Widget -->
                                <div class="single-video-widget d-flex wow fadeInUp" data-wow-delay="800ms">
                                    <div class="video-thumbnail">
                                        <img src="img/bg-img/16.jpg" alt="">
                                    </div>
                                    <div class="video-text">
                                        <p class="video-title mb-0">Game reviews: the best of 2018</p>
                                        <span>Nintendo Wii, PS4, XBox 360</span>
                                    </div>
                                    <div class="video-rating">8.3/10</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-8">
                    <div class="tab-content" id="video-tabContent">
                        <div class="tab-pane fade show active" id="video-1" role="tabpanel" aria-labelledby="video1">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/45.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-2" role="tabpanel" aria-labelledby="video2">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/46.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-3" role="tabpanel" aria-labelledby="video3">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/47.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-4" role="tabpanel" aria-labelledby="video4">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/48.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-5" role="tabpanel" aria-labelledby="video5">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/49.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-6" role="tabpanel" aria-labelledby="video6">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/45.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-7" role="tabpanel" aria-labelledby="video7">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/46.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="video-8" role="tabpanel" aria-labelledby="video8">
                            <div class="video-playground bg-img" style="background-image: url(img/bg-img/47.jpg);">
                                <!-- Play Button -->
                                <div class="play-btn">
                                    <a href="https://www.youtube.com/watch?v=7HKoqNJtMTQ" class="play-button"><img src="img/core-img/play.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Video Area End ##### -->

    <!-- ##### Articles Area Start ##### -->
    <section class="latest-articles-area section-padding-100-0 bg-img bg-pattern bg-fixed" style="background-image: url(img/bg-img/5.jpg);" id="latest-articles-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="mb-100">
                        <!-- Title -->
                        <h2 class="section-title mb-70 wow fadeInUp" data-wow-delay="100ms">Choose your best</h2>

                        <!-- *** Single Articles Area *** -->
                        <div class="single-articles-area style-2 d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="300ms">
                            <div class="article-thumbnail">
                                <img src="img/bg-img/43.jpg" alt="">
                            </div>
                            <div class="article-content">
                                <a class="post-title">Gold Both</a>
                                <div class="post-meta">
                                    <a href="laptop_review.php?id=<?=base64_encode('1'); ?>" class="btn btn-outline-info btn-block btn-lg btn-gold">Choose Plane</a>
                                    <!-- <a href="#" class="post-comments">2 Comments</a> -->
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat. Aliquam erat volutpat. Sed efficitur diam.</p>
                            </div>
                        </div>

                        <!-- *** Single Articles Area *** -->
                        <div class="single-articles-area style-2 d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="500ms">
                            <div class="article-thumbnail">
                                <img src="img/bg-img/42.jpg" alt="">
                            </div>
                            <div class="article-content">
                                <a class="post-title">Silver Both</a>
                                <div class="post-meta">
                                    <a href="laptop_review.php?id=<?=base64_encode('2'); ?>" class="btn btn-outline-info btn-block btn-lg btn-silver">Choose Plane</a>
                                    <!-- <a href="#" class="post-comments">2 Comments</a> -->
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat. Aliquam erat volutpat. Sed efficitur diam.</p>
                            </div>
                        </div>

                        <!-- *** Single Articles Area *** -->
                        <div class="single-articles-area style-2 d-flex flex-wrap mb-30 wow fadeInUp" data-wow-delay="700ms">
                            <div class="article-thumbnail">
                                <img src="img/bg-img/41.jpg" alt="">
                            </div>
                            <div class="article-content">
                                <a class="post-title">Bronze Both</a>
                                <div class="post-meta">
                                    <a href="laptop_review.php?id=<?=base64_encode('3'); ?>" class="btn btn-outline-info btn-block btn-lg btn-bronze">Choose Plane</a>
                                    <!-- <a href="#" class="post-comments">2 Comments</a> -->
                                </div>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat. Aliquam erat volutpat. Sed efficitur diam.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                    <!-- Title -->
                    <h2 class="section-title mb-70 wow fadeInUp" data-wow-delay="100ms">This week’s deal</h2>

                    <!-- Single Widget Area -->
                    <div class="single-widget-area add-widget wow fadeInUp" data-wow-delay="300ms">
                        <a href="#"><img src="img/bg-img/add.png" alt=""></a>
                        <!-- Side Img -->
                        <img src="img/bg-img/side-img.png" class="side-img" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Articles Area End ##### -->

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