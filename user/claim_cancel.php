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

	// ambil data klaim yang akan dihapus
	$ambilKlaim = $conn->query("SELECT * FROM klaim JOIN klaim_produk ON klaim.id_klaim = klaim_produk.id_klaim JOIN produk ON klaim_produk.id_produk = produk.id_produk WHERE klaim.id_klaim = '$idKlaim' ");
	$pecahKlaim 	= $ambilKlaim->fetch_assoc();
	$statusKlaim 	= $pecahKlaim["status_klaim"];
	$totalKlaim 	= $pecahKlaim["total_klaim"];
	$idProduk 		= $pecahKlaim["id_produk"];
	$stokProdukLama = $pecahKlaim["stok_produk"];

	// cek jika id di url kosong atau bukan angka
    if(empty($idKlaim) || !intval($idKlaim)) {
        // alihkan ke halaman history
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
        exit();
    }
    // cek ada data yang dicari tidak
    $adaDataTidak = $ambilKlaim->num_rows;
    // jika id klaim yang dicari tidak ada
    if($adaDataTidak < 1) {
        // alihkan ke halaman history
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
        exit();
    }

    // jika member yang login akses klaim produk milik member lain
    if($pecahKlaim["id_member"] != $idMember) {
        // alihkan ke halaman histori
        echo "<script>location ='history.php';</script>";
        header('Location: history.php');
        exit();
    }

	// jika statusnya pending, maka kembalikan stok yang diambil
	if($statusKlaim == "pending") {
		$stokProdukBaru = $stokProdukLama + $totalKlaim;
		// update stok produk pada tabel produk
		$conn->query("UPDATE produk SET stok_produk = '$stokProdukBaru' WHERE id_produk = '$idProduk' ");
		// hapus klaim produk dari tabel klaim dan klaim produk
		$conn->query("DELETE FROM klaim WHERE id_klaim = '$idKlaim' ");
		// echo "<script>alert('Claim is cancelled')</script>";
		echo "<script>location ='history.php';</script>";
	}
    else if($statusKlaim == "confirmed") {
        echo "<script>location ='history.php';</script>";
    }

?>