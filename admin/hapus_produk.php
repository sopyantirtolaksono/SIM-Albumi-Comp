<?php
	// hapus produk dari tabel produk
	$conn->query("DELETE FROM produk WHERE id_produk = '$_GET[id]'");
	echo "<script>alert('Data berhasil dihapus!')</script>";
	echo "<script>location ='index.php?halaman=produk';</script>";
?>