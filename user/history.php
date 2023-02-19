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

    // ambil id member dari session member
    $idMember = $_SESSION["member"]["id_member"];

    // mengambil data produk klaim dari tabel klaim, klaim produk, produk
    $ambilProdukKlaim = $conn->query("SELECT * FROM klaim JOIN klaim_produk ON klaim.id_klaim = klaim_produk.id_klaim JOIN produk ON klaim_produk.id_produk = produk.id_produk WHERE klaim.id_member = '$idMember' ORDER BY klaim.id_klaim DESC ");
    // cek jika member tidak ada histori klaim produk
    $adaTdkData = $ambilProdukKlaim->num_rows;

    // ambil data member yg login dari tabel member
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
    <title>Albumi Comp - History</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Sweet Alert2 -->
    <script src="js/sweet-alert2/sweetalert2.all.min.js"></script>

    <!-- Embed Stylesheet -->
    <style>
        a.btn-detail:hover,
        a.btn-detail:focus,
        a.btn-print:hover,
        a.btn-print:focus,
        a.btn-delete:hover,
        a.btn-delete:focus,
        a.btn-cancel:hover,
        a.btn-cancel:focus{
            font-weight: normal;
        }
        a.btn-getGift:hover,
        a.btn-getGift:focus,
        a.btn-myGift:hover,
        a.btn-myGift:focus{
            font-weight: normal;
            font-size: .875rem;
        }
        button.btn-myPoint:hover{
            cursor: unset !important;
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
            <h3>History 
                <!-- <span class="badge badge-danger"><i class="fa fa-trophy"></i> <?=$pointMember; ?> Point</span> -->
                <button class="btn btn-danger btn-sm btn-myPoint"><i class="fa fa-trophy"></i> <strong>My Points <span class="badge badge-light"><?=$pointMember; ?></span></strong></button>
                <span class="pull-right">
                    <a href="mygift.php" class="btn btn-sm btn-warning btn-myGift">My Gift</a> 
                    <a href="gift.php" class="btn btn-sm btn-danger btn-getGift">Get Gift</a>
                </span>
            </h3>
        </div>

        <!-- jika ada data dan tidak ada data histori -->
        <?php if($adaTdkData > 0) { ?>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Product</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        while($pecahProdukKlaim = $ambilProdukKlaim->fetch_assoc()) { 
                    ?>
                    <tr class="text-center">
                        <td><?=$no; ?></td>
                        <td><?=$pecahProdukKlaim["nama_produk"]; ?></td>
                        <td><?=$pecahProdukKlaim["tanggal_klaim"]; ?></td>
                        <td><?=$pecahProdukKlaim["status_klaim"]; ?></td>
                        <td>
                            <?php if($pecahProdukKlaim["status_klaim"] == "confirmed") { ?>
                            <a href="claim_delete.php?id=<?=base64_encode($pecahProdukKlaim['id_klaim']); ?>" class="btn btn-danger btn-delete" id="btn-delete">Delete</a>
                            <?php } else if($pecahProdukKlaim["status_klaim"] == "pending") { ?>
                            <a href="claim_cancel.php?id=<?=base64_encode($pecahProdukKlaim['id_klaim']); ?>" class="btn btn-secondary btn-cancel" id="btn-cancel">Cancel</a>
                            <?php } ?>

                            <a href="claim_detail.php?id=<?=base64_encode($pecahProdukKlaim['id_klaim']); ?>" class="btn btn-info btn-detail">Detail</a>
                            <a href="invoice_print.php?id=<?=base64_encode($pecahProdukKlaim['id_klaim']); ?>" class="btn btn-primary btn-print" target="_blank">Print</a>
                        </td>
                    </tr>
                    <?php $no++; ?>
                    <?php } ?>

                </tbody>
            </table>
        </div>

        <?php } else { ?>

        <div class="all-history">
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
    <!-- Sweet Alert -->
    <script src="js/sweetalert.js"></script>
</body>

</html>