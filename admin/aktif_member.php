<?php 

	// ambil id member di url
	$idMember = $_GET["id"];

	// update status member pada tabel member
	$conn->query("UPDATE member SET status_member = 'active' WHERE id_member = '$idMember' ");

	// alihkan lokasi ke halaman member
	echo "<script>alert('Member Aktif')</script>";
	echo "<script>location ='index.php?halaman=member';</script>";

?>