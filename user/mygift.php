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

    // ambil id member yang login
    $idMember = $_SESSION["member"]["id_member"];

    // ambil data klaim gift member yg login dari tabel klaim gift
    $ambilKlaimGift = $conn->query("SELECT * FROM klaim_gift WHERE id_member = '$idMember' ORDER BY id_klaim_gift DESC ");
    // cek jika member tidak ada klaim gift
    $adaTdkData = $ambilKlaimGift->num_rows;

    // set default timezone
    date_default_timezone_set('Asia/Jakarta');
    // ambil tanggal dan waktu sekarang
    $tglWaktuSekarang = date("Y-m-d H:i:s");

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
    <title>Albumi Comp - My Gift</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Embed Stylesheet -->
    <style>
        a.btn-getGift:hover,
        a.btn-getGift:focus{
            font-weight: normal;
            font-size: .875rem;
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
            <h3>All My Gift <span class="pull-right"><a href="gift.php" class="btn btn-sm btn-danger btn-getGift">Get Gift</a></span></h3>
        </div>

        <!-- jika ada data dan tidak ada data klaim gift -->
        <?php if($adaTdkData > 0) { ?>

        <div class="all-mygift">
            <div class="row">

                <?php while($pecahKlaimGift = $ambilKlaimGift->fetch_assoc()) { ?>
                <?php 
                    // cari tgl expired klaim gift
                    $tglExpKlaim = $pecahKlaimGift["tanggal_expired"];
                    // jika tgl klaim sdh expired
                    if($tglWaktuSekarang >= $tglExpKlaim) {
                        // update status klaim gift menjadi expired
                        $conn->query("UPDATE klaim_gift SET status_klaim = 'expired' WHERE tanggal_expired <= '$tglWaktuSekarang' ");
                    }    
                ?>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="../admin/dist/img-gift/<?=$pecahKlaimGift['gambar_gift']; ?>" alt="gift" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?=$pecahKlaimGift["nama_gift"]; ?></h5>
                            <!-- <p class="card-text mb-1"><i class="fa fa-hourglass-start"></i> <?=$pecahKlaimGift["tanggal_klaim"]; ?></p> -->
                            <p class="card-text mb-1"><strong>Claim :</strong> <?=$pecahKlaimGift["tanggal_klaim"]; ?></p>
                            <!-- <p class="card-text mb-1"><i class="fa fa-hourglass-end"></i> <?=$pecahKlaimGift["tanggal_expired"]; ?></p> -->
                            <p class="card-text mb-1"><strong>Exp :</strong> <?=$pecahKlaimGift["tanggal_expired"]; ?></p>
                            <p class="card-text"><i class="fa fa-trophy"></i> <?=$pecahKlaimGift["point_gift"]; ?> Point</p>
                        </div>
                        <div class="card-footer">
                            <!-- jika tgl klaim sdh expired -->
                            <?php if($pecahKlaimGift["status_klaim"] == "expired") { ?>
                            <a href="#" class="btn btn-secondary btn-block disabled">Expired</a>
                            <?php } else { ?>
                            <a href="#" class="btn btn-success btn-block disabled">Active</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
            
        </div>

        <?php } else { ?>

        <div class="all-mygift">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center" style="margin-top: 150px; color: lightgray;">:( Sorry, not activity</h1>
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
</body>

</html>