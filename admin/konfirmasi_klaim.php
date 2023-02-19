<?php 

	// ambil id klaim di url
	$idKlaim = $_GET["id"];

	// ambil data detail klaim
	$ambilDetailKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member JOIN klaim_produk ON klaim_produk.id_klaim = klaim.id_klaim JOIN laporan ON klaim.id_laporan = laporan.id_laporan WHERE klaim.id_klaim = '$idKlaim' ");
  	$pecahDetailKlaim = $ambilDetailKlaim->fetch_assoc();

	// update status klaim dari pending ke confirmed
	$conn->query("UPDATE klaim SET status_klaim = 'confirmed' WHERE id_klaim = '$idKlaim' ");

	// update point member
	$pointBaru = $pecahDetailKlaim["point_member"] + $pecahDetailKlaim["point_kategori"];
	$conn->query("UPDATE member SET point_member = '$pointBaru' WHERE id_member = '$pecahDetailKlaim[id_member]' ");

	// update dan ambil tahun sekarang
	// $thnSekarang = date("Y");
	// update dan ambil bulan sekarang
	// $blnSekarang = date("M");
	// ambil total harga pada tabel klaim dan jumlahkan semua total harganya yang bulan sekarang yg statusnya sudah confirmed/terkonfirmasi
	$idLaporan   = $pecahDetailKlaim["id_laporan"];
	$totalLapBln = 0;
	// $ambilLaporan = $conn->query("SELECT * FROM klaim WHERE bulan_klaim = '$blnSekarang' AND status_klaim = 'confirmed' ");
	// while($pecahLaporan = $ambilLaporan->fetch_assoc()) {
	// 	$totalLapBln += $pecahLaporan["total_harga"];
	// }
	$ambilLaporan = $conn->query("SELECT * FROM klaim WHERE id_laporan = '$idLaporan' AND status_klaim = 'confirmed' ");
	while($pecahLaporan = $ambilLaporan->fetch_assoc()) {
		$totalLapBln += $pecahLaporan["total_harga"];
	}

	// update atau insert data pada tabel laporan
	// $ablThnBlnLapSkrng = $conn->query("SELECT * FROM laporan WHERE tahun_laporan = '$thnSekarang' AND bulan_laporan = '$blnSekarang' ");
	$ablThnBlnLapSkrng = $conn->query("SELECT * FROM laporan WHERE id_laporan = '$idLaporan' ");
	$adaDataTidak = $ablThnBlnLapSkrng->num_rows;
	// jika ada data
	if($adaDataTidak > 0) {
		// $conn->query("UPDATE laporan SET total_laporan = '$totalLapBln' WHERE tahun_laporan = '$thnSekarang' AND bulan_laporan = '$blnSekarang' ");
		$conn->query("UPDATE laporan SET total_laporan = '$totalLapBln' WHERE id_laporan = '$idLaporan' ");
	}
	// else {
	// 	$conn->query("INSERT INTO laporan (tahun_laporan, bulan_laporan, total_laporan) VALUES ('$thnSekarang', '$blnSekarang', '$totalLapBln') ");
	// }

	// ambil jumlah kategori favorit pada tabel kategori dan jumlahkan dengan angka 1
	$ambilKatFavorit = $conn->query("SELECT * FROM kategori WHERE kategori_produk = '$pecahDetailKlaim[kategori_produk]' ");
	$pecahKatFavorit = $ambilKatFavorit->fetch_assoc();
	$jmlKatFavoritBaru = $pecahKatFavorit["jumlah_favorit"] + 1;
	// update jumlah kategori favorit pada tabel kategori
	$conn->query("UPDATE kategori SET jumlah_favorit = '$jmlKatFavoritBaru' WHERE kategori_produk = '$pecahDetailKlaim[kategori_produk]' ");

	// alihkan ke halaman klaim produk
	echo "<script>alert('Status Terkonfirmasi')</script>";
	echo "<script>location ='index.php?halaman=klaim_produk';</script>";

?>