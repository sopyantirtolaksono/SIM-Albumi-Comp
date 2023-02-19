<?php 

	// ambil id klaim di url
	$idKlaim = $_GET["id"];

	// ambil data detail klaim
	$ambilDetailKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member JOIN klaim_produk ON klaim_produk.id_klaim = klaim.id_klaim JOIN laporan ON klaim.id_laporan = laporan.id_laporan WHERE klaim.id_klaim = '$idKlaim' ");
  	$pecahDetailKlaim = $ambilDetailKlaim->fetch_assoc();

	// update status klaim dari confirmed ke pending
	$conn->query("UPDATE klaim SET status_klaim = 'pending' WHERE id_klaim = '$idKlaim' ");

	// update point member
	$pointBaru = $pecahDetailKlaim["point_member"] - $pecahDetailKlaim["point_kategori"];
	$conn->query("UPDATE member SET point_member = '$pointBaru' WHERE id_member = '$pecahDetailKlaim[id_member]' ");

	// update total pendapatan bulanan pada tabel laporan
	$totalLapBaru = $pecahDetailKlaim["total_laporan"] - $pecahDetailKlaim["total_harga"]; 
	$conn->query("UPDATE laporan SET total_laporan = '$totalLapBaru' WHERE id_laporan = '$pecahDetailKlaim[id_laporan]' ");

	// ambil jumlah kategori favorit pada tabel kategori dan kurangi dengan angka 1
	$ambilKatFavorit = $conn->query("SELECT * FROM kategori WHERE kategori_produk = '$pecahDetailKlaim[kategori_produk]' ");
	$pecahKatFavorit = $ambilKatFavorit->fetch_assoc();
	$jmlKatFavoritBaru = $pecahKatFavorit["jumlah_favorit"] - 1;
	// cek jika jumlahnya kurang dari 0
	if($jmlKatFavoritBaru < 0) {
		// update jumlah kategori favorit pada tabel kategori dan set nilainya jadi 0
		$conn->query("UPDATE kategori SET jumlah_favorit = 0 WHERE kategori_produk = '$pecahDetailKlaim[kategori_produk]' ");
	}
	else {
		// update jumlah kategori favorit pada tabel kategori
		$conn->query("UPDATE kategori SET jumlah_favorit = '$jmlKatFavoritBaru' WHERE kategori_produk = '$pecahDetailKlaim[kategori_produk]' ");
	}

	// alihkan ke halaman klaim produk
	echo "<script>alert('Konfirmasi dibatalkan.')</script>";
	echo "<script>location ='index.php?halaman=klaim_produk';</script>";

?>