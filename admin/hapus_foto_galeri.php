<?php 
	// koneksi ke database
	require "connection.php";
	// hapus data dari tabel foto
	$conn->query("DELETE FROM foto WHERE id_foto = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus!')</script>";
	echo "<script>location ='index.php?halaman=tambah_foto';</script>";
 ?>