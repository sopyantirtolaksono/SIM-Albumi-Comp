<?php 

	// ambil data klaim yang akan dihapus
	$ambilKlaim = $conn->query("SELECT * FROM klaim JOIN klaim_produk ON klaim.id_klaim = klaim_produk.id_klaim JOIN produk ON klaim_produk.id_produk = produk.id_produk WHERE klaim.id_klaim = '$_GET[id]' ");
	$pecahKlaim 	= $ambilKlaim->fetch_assoc();
	$statusKlaim 	= $pecahKlaim["status_klaim"];
	$totalKlaim 	= $pecahKlaim["total_klaim"];
	$idProduk 		= $pecahKlaim["id_produk"];
	$stokProdukLama = $pecahKlaim["stok_produk"];

	// jika statusnya pending, maka kembalikan stok yang diambil
	if($statusKlaim == "pending") {
		$stokProdukBaru = $stokProdukLama + $totalKlaim;
		// update stok produk pada tabel produk
		$conn->query("UPDATE produk SET stok_produk = '$stokProdukBaru' WHERE id_produk = '$idProduk' ");
		// hapus klaim produk dari tabel klaim dan klaim produk
		$conn->query("DELETE FROM klaim WHERE id_klaim = '$_GET[id]' ");
		echo "<script>alert('Data berhasil dihapus!')</script>";
		echo "<script>location ='index.php?halaman=klaim_produk';</script>";
	}
	else if($statusKlaim == "confirmed") {
		// hapus klaim produk dari tabel klaim dan klaim produk
		$conn->query("DELETE FROM klaim WHERE id_klaim = '$_GET[id]' ");
		echo "<script>alert('Data berhasil dihapus!')</script>";
		echo "<script>location ='index.php?halaman=klaim_produk';</script>";
	}

?>