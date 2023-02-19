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

    // ambil id produk di url
    $idProduk = base64_decode($_GET["id"]);
    // ambil semua data produk dari tabel produk
    $ambilProduk = $conn->query("SELECT * FROM produk WHERE id_produk = '$idProduk
        '");
    $pecahProduk = $ambilProduk->fetch_assoc();

    // cek jika id di url kosong atau bukan angka
    if(empty($idProduk) || !intval($idProduk)) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }
    // cek ada data yang dicari tidak
    $adaDataTidak = $ambilProduk->num_rows;
    // jika id produk yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman index
        echo "<script>location ='index.php';</script>";
        header('Location: index.php');
        exit();
    }

    // ambil id kategori produk yang diklaim dari tabel produk
    $idKategori     = $pecahProduk["id_kategori"];
    // ambil kategori produk yang diklaim dari tabel kategori
    $ambilKategori  = $conn->query("SELECT * FROM kategori WHERE id_kategori = '$idKategori' ");
    $pecahKategori  = $ambilKategori->fetch_assoc();
    $kategoriProduk = $pecahKategori["kategori_produk"];
    $pointKategori  = $pecahKategori["point_kategori"];

    // jika tombol save ditekan
    if(isset($_POST["btn-save"])) {

        // ambil id member
        $idMember = $_SESSION["member"]["id_member"];
        // ambil tanggal klaim
        $tglKlaim = date("Y-m-d");
        // ambil bulan klaim
        $blnKlaim = date("M");
        // ambil tahun klaim
        $thnKlaim = date("Y");
        // jml klaim
        $jmlKlaim = $_POST["jml-klaim"];
        // cek jika jml klaim kurang dari 1 atau lebih dari stok tersisa
        if($jmlKlaim > $pecahProduk["stok_produk"]) {
            // echo "<script>alert('Sorry, quantity is more than!')</script>";
            echo "<script>location ='claim_product.php?id=$_GET[id]&k=b';</script>";
            exit();
        } else if($jmlKlaim < 1) {
            // echo "<script>alert('Sorry, quantity is less then!')</script>";
            echo "<script>location ='claim_product.php?id=$_GET[id]&k=k';</script>";
            exit();
        }
        // kurangi stok lama dengan jml klaim produk
        $stokBaru = $pecahProduk["stok_produk"] - $jmlKlaim;
        // total harga
        $totalHarga = $pecahProduk["harga_produk"] * $jmlKlaim;

        // update stok produk pada tabel produk
        $conn->query("UPDATE produk SET stok_produk = '$stokBaru' WHERE id_produk = '$idProduk' ");

        // ambil id laporan pada tabel laporan
        $ambilIdLaporan = $conn->query("SELECT * FROM laporan WHERE tahun_laporan = '$thnKlaim' AND bulan_laporan = '$blnKlaim' ");
        $adaIdLapTidak  = $ambilIdLaporan->num_rows;

        // cek jika id laporan pada tabel laporan belum/tidak ada
        if($adaIdLapTidak > 0) {
            // ambil id laporannya
            $pecahIdLaporan = $ambilIdLaporan->fetch_assoc();
            $idLaporan      = $pecahIdLaporan["id_laporan"];
            // simpan data pada tabel klaim
            $conn->query("INSERT INTO klaim (id_member, id_laporan, tanggal_klaim, total_harga, bulan_klaim) VALUES ('$idMember', '$idLaporan', '$tglKlaim', '$totalHarga', '$blnKlaim')");
        }
        else {
            // insert data baru pada tabel laporan
            $conn->query("INSERT INTO laporan (tahun_laporan, bulan_laporan) VALUES ('$thnKlaim', '$blnKlaim') ");
            // mendapatkan id laporan barusan (id laporan baru)
            $idLaporanBaru = $conn->insert_id;
            // simpan data pada tabel klaim
            $conn->query("INSERT INTO klaim (id_member, id_laporan, tanggal_klaim, total_harga, bulan_klaim) VALUES ('$idMember', '$idLaporanBaru', '$tglKlaim', '$totalHarga', '$blnKlaim') ");
        }


        // mendapatkan id klaim barusan
        $idKlaimBarusan = $conn->insert_id;

        // menyimpan juga pada tabel klaim produk
        $conn->query("INSERT INTO klaim_produk (id_klaim, id_produk, total_klaim, nama_produk, kategori_produk, berat_produk, harga_produk, point_kategori) VALUES ('$idKlaimBarusan', '$idProduk', '$jmlKlaim', '$pecahProduk[nama_produk]', '$kategoriProduk', '$pecahProduk[berat_produk]', '$pecahProduk[harga_produk]', '$pointKategori' ) ");

        // tampilkan pesan sukses dan alihkan kehalaman history
        // echo "<script>alert('Data is saved.')</script>";
        // echo "<script>location ='history.php';</script>";
        echo "<script>location ='claim_product.php?id=$_GET[id]&k=s';</script>";

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
    <title>Albumi Comp - Claim Product</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

    <!-- Sweet Alert2 -->
    <script src="js/sweet-alert2/sweetalert2.all.min.js"></script>

    <!-- Embed Stylesheet -->
    <style>
        a.btn-cancel:hover,
        a.btn-cancel:focus{
            font-weight: normal;
        }
    </style>

</head>

<body>

    <?php 

        // script sweet alert2 untuk klaim produk
        if(isset($_GET["k"])) {

            $getK    = $_GET["k"];
            if($getK == "b") {
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops..',
                        text: 'Sorry, quantity is more than!'
                    }).then(() => {
                        document.location.href ='claim_product.php?id=$_GET[id]';
                    });
                </script>";
            }
            else if($getK == "k") {
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops..',
                        text: 'Sorry, quantity is less than!'
                    }).then(() => {
                        document.location.href ='claim_product.php?id=$_GET[id]';
                    });
                </script>";
            }
            else if($getK == "s") {
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data is saved!'
                    }).then(() => {
                        document.location.href ='history.php';
                    });
                </script>";
            }

        }

    ?>

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
            <h3>Claim Product</h3>
        </div>

        <form action="" method="post">
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Weight</th>
                            <th>Qty</th>
                            <th>Claim Qty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>1</td>
                            <td><?=$pecahProduk["nama_produk"]; ?></td>
                            <td>Rp. <?=number_format($pecahProduk["harga_produk"]); ?></td>
                            <td><?=$pecahProduk["berat_produk"]; ?> gr.</td>
                            <td><?=$pecahProduk["stok_produk"]; ?></td>
                            <td><input type="number" class="form-control" name="jml-klaim" placeholder="Insert claim quantity.." required></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="form-member mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?=$_SESSION['member']['nama_member']; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?=$_SESSION['member']['alamat_member']; ?>" readonly>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" value="<?=$_SESSION['member']['telepon_member']; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="save-cancel-button">
                <a href="laptop_detail.php?id=<?=base64_encode($idProduk); ?>" class="btn btn-secondary btn-cancel">Cancel</a>
                <button type="submit" class="btn btn-success" name="btn-save">Save</button>
            </div>

        </form>

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