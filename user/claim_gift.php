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

    // ambil id gift dari url
    $idGift = base64_decode($_GET["id"]);
 	// ambil id member yang login
    $idMember = $_SESSION["member"]["id_member"];

    // ambil data member dari tabel member
    $ambilMember = $conn->query("SELECT * FROM member WHERE id_member = '$idMember' ");
    $pecahMember = $ambilMember->fetch_assoc();
    // ambil point member
    $pointMember = $pecahMember["point_member"];

    // ambil data gift yg diklaim dari tabel gift
    $ambilGift = $conn->query("SELECT * FROM gift WHERE id_gift = '$idGift' ");
    $pecahGift = $ambilGift->fetch_assoc();
    // ambil nama gift
    $namaGift = $pecahGift["nama_gift"];
    // ambil point gift
    $pointGift = $pecahGift["point_gift"];
    // ambil gambar gift
    $gambarGift = $pecahGift["gambar_gift"];

    // cek jika id di url kosong atau bukan angka
    if(empty($idGift) || !intval($idGift)) {
        // alihkan ke halaman gift
        echo "<script>location ='gift.php';</script>";
        header('Location: gift.php');
        exit();
    }
    // cek ada data yang dicari tidak
    $adaDataTidak = $ambilGift->num_rows;
    // jika id klaim yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman gift
        echo "<script>location ='gift.php';</script>";
        header('Location: gift.php');
        exit();
    }

    // set default timezone
    date_default_timezone_set('Asia/Jakarta');
    // ambil tanggal dan waktu sekarang (utk tgl klaim gift)
    $tglKlaimGift = date("Y-m-d H:i:s");
    // set tanggal dan waktu expired klaim gift (24 jam kedepan)
    $tglExpKlaim = date("Y-m-d H:i:s", strtotime("next day"));

    // pengurangan point member dengan point gift yang diambil
    $pointMemberBaru = $pointMember - $pointGift;
    // update point member pada tabel member
    $conn->query("UPDATE member SET point_member = '$pointMemberBaru' WHERE id_member = '$idMember' ");

    // masukkan semua data dari data member dan gift ke tabel klaim gift
    $conn->query("INSERT INTO klaim_gift (id_member, id_gift, nama_gift, point_gift, gambar_gift, tanggal_klaim, tanggal_expired) VALUES ('$idMember', '$idGift', '$namaGift', '$pointGift', '$gambarGift', '$tglKlaimGift', '$tglExpKlaim') ");

    // tampilkan pesan dan alihkan ke halaman mygift
    // echo "<script>alert('Claim is Success');</script>";
    echo "<script>location ='mygift.php';</script>";

?>