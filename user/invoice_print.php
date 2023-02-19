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
    // ambil id klaim produk di url
    $idKlaim = base64_decode($_GET["id"]);

    // mengambil data produk klaim dari tabel klaim, klaim produk, produk
    $ambilProdukKlaim = $conn->query("SELECT * FROM klaim JOIN klaim_produk ON klaim.id_klaim = klaim_produk.id_klaim JOIN produk ON klaim_produk.id_produk = produk.id_produk JOIN kategori ON produk.id_kategori = kategori.id_kategori JOIN member ON klaim.id_member = member.id_member WHERE klaim.id_klaim = '$idKlaim' ");
    $pecahProdukKlaim = $ambilProdukKlaim->fetch_assoc();

    // cek jika id di url kosong atau bukan angka
    if(empty($idKlaim) || !intval($idKlaim)) {
        // alihkan ke halaman history
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
        exit();
    }
    // cek ada data yang dicari tidak
    $adaDataTidak = $ambilProdukKlaim->num_rows;
    // jika id klaim yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman history
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
        exit();
    }

    // jika member yang login akses nota milik member lain
    if($pecahProdukKlaim["id_member"] != $idMember) {
        // alihkan ke halaman histori
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
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
    <title>Albumi Comp - Invoice</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body onload="window.print();">

    <div class="container mb-5 mt-5">

        <div class="row">
            <div class="col-sm-12">
                <h5>
                    <i class="fa fa-globe"></i> AlBumiComp Store 

                    <?php if($pecahProdukKlaim["status_klaim"] == "confirmed") { ?>
                    <span class="badge badge-success badge-pill text-uppercase">
                        <i class="fa fa-check-circle"></i>
                        <strong><?=$pecahProdukKlaim["status_klaim"]; ?></strong>
                    </span>
                    <?php } else { ?>
                    <span class="badge badge-warning badge-pill text-uppercase">
                        <i class="fa fa-clock-o"></i>
                        <strong><?=$pecahProdukKlaim["status_klaim"]; ?></strong>
                    </span>
                    <?php } ?>

                    <small class="pull-right">Date: <?=date("Y/m/d"); ?></small>
                </h5>
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                From
                <address>
                    <strong>Admin, Inc.</strong><br>
                    Jalan Tentara Pelajar<br>
                    Purin, Kendal Jateng, Indonesia<br>
                    Phone: (804) 123-5432<br>
                    Email: albumicomp@gmail.com
                </address>
            </div>
            <div class="col-sm-4">
                To
                <address>
                    <strong><?=$pecahProdukKlaim["nama_member"]; ?></strong><br>
                    <?=$pecahProdukKlaim["alamat_member"]; ?><br>
                    Phone: <?=$pecahProdukKlaim["telepon_member"]; ?><br>
                    Email: <?=$pecahProdukKlaim["email_member"]; ?>
                </address>
            </div>
            <div class="col-sm-4">
                <b>Claim Details</b><br>
                <br>
                <b>Claim Date:</b> <?=$pecahProdukKlaim["tanggal_klaim"]; ?><br>
                <b>Claim Status:</b> <?=$pecahProdukKlaim["status_klaim"]; ?>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Product</th>
                        <th>Category</th>
                        <th>Weight</th>
                        <th>Price</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="text-center">
                        <td><?=$pecahProdukKlaim["nama_produk"]; ?></td>
                        <td><?=$pecahProdukKlaim["kategori_produk"]; ?></td>
                        <td><?=$pecahProdukKlaim["berat_produk"]; ?> gr.</td>
                        <td>Rp. <?=number_format($pecahProdukKlaim["harga_produk"]); ?></td>
                        <td><?=$pecahProdukKlaim["total_klaim"]; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row">

            <div class="col-sm-6">
                <p class="lead">Details:</p>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">Total Price:</th>
                            <td>Rp. <?=number_format($pecahProdukKlaim["total_harga"]); ?></td>
                        </tr>
                        <tr>
                            <th>Category Points:</th>
                            <td><?=$pecahProdukKlaim["point_kategori"]; ?> Points</td>
                        </tr>
                        <tr>
                            <th>My Points:</th>
                            <td><?=$pecahProdukKlaim["point_member"]; ?> Points</td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>

    </div>

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