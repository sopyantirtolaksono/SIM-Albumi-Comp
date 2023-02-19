<?php

	// ambil id gift dari url
	$idGift = $_GET["id"];

	// hapus data gift yang dipilih dari tabel gift
	$conn->query("DELETE FROM gift WHERE id_gift = '$idGift' ");

	// tampilkan pesan dan alihkan ke halaman gift
	echo "<script>alert('Data berhasil dihapus.');</script>";
	echo "<script>location ='index.php?halaman=gift';</script>";

?>