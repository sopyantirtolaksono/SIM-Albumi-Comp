<?php 

    // mulai session
    session_start();
    // jika member belum login
    if(!isset($_SESSION['member'])) {
        echo "<script>location ='login.php';</script>";
        header('Location: login.php');
        exit();
    }
    // koneksi ke database
    require "../admin/connection.php";

    // jika member sudah login, tapi status member non aktif
    $idM         = $_SESSION["member"]["id_member"];
    $ambilMember = $conn->query("SELECT * FROM member WHERE id_member = '$idM' ");
    $pecahMember = $ambilMember->fetch_assoc();
    if(isset($_SESSION['member'])) {
        if($pecahMember["status_member"] == "non active") {
            // alihkan ke halaman login
            echo "<script>location ='login.php';</script>";
            header('Location: login.php');
            $idM     = session_unset();
            exit();
        }   
    }

    // ambil semua data gift dari tabel gift
    $ambilGift = $conn->query("SELECT * FROM gift");
    // cek jika data/produk gift tidak ada/tidak tersedia
    $adaDataTidak = $ambilGift->num_rows;

    // ambil id member yang login
    $idMember = $_SESSION["member"]["id_member"];
    // ambil data member yang login
    $ambilMember = $conn->query("SELECT * FROM member WHERE id_member = '$idMember' ");
    $pecahMember = $ambilMember->fetch_assoc();
    $pointMember = $pecahMember["point_member"];

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
    <title>Albumi Comp - Gift</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Sweet Alert2 -->
    <script src="js/sweet-alert2/sweetalert2.all.min.js"></script>

    <!-- Embed Stylesheet -->
    <style>
        a.btn-myGift:hover,
        a.btn-myGift:focus{
            font-weight: normal;
            font-size: .875rem;
        }
        a.btn-getIt:hover,
        a.btn-getIt:focus{
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

    <div class="container mb-5">

        <div class="head-text mb-3">
            <h3>All Gift <span class="pull-right"><a href="mygift.php" class="btn btn-sm btn-warning btn-myGift">My Gift</a></span></h3>
        </div>

        <?php if($adaDataTidak > 0) { ?>

        <div class="all-gift">
            <div class="row">

                <?php while($pecahGift = $ambilGift->fetch_assoc()) { ?>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="../admin/dist/img-gift/<?=$pecahGift['gambar_gift']; ?>" alt="gift" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title text-center"><?=$pecahGift["nama_gift"]; ?></h5>

                            <h6 class="text-center mb-4"><p class="card-text badge badge-danger"><i class="fa fa-trophy"></i> <?=$pecahGift["point_gift"]; ?> Point</p></h6>
                            
                            <?php if($pointMember < $pecahGift["point_gift"]) { ?>
                            <a href="#" class="btn btn-secondary btn-block btn-getIt disabled">Claim</a>
                            <?php } else { ?>
                            <a href="claim_gift.php?id=<?=base64_encode($pecahGift['id_gift']); ?>" class="btn btn-primary btn-block btn-getIt" id="btn-getIt">Claim</a>
                            <?php } ?>

                        </div>
                    </div>
                </div>
                
                <?php } ?>

            </div>
        </div>

        <?php } else { ?>

        <div class="all-gift">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="margin-top: 150px; color: lightgray;">:( Sorry, gift is empty</h1>
                </div>
            </div>    
        </div>

        <?php } ?>

    </div>

    
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
    <!-- Sweet Alert -->
    <script src="js/sweetalert.js"></script>

</body>

</html>