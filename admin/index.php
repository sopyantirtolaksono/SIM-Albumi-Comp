<?php require "header.php"; ?>

<div class="content-wrapper">
	<!-- <section class="content container-fluid"> -->
		<?php
			if(isset($_GET["halaman"])) {
				if($_GET["halaman"] == "dashboard") {
					require "dashboard.php";
				}
				if($_GET["halaman"] == "kategori_produk") {
					require "kategori_produk.php";
				}
				if($_GET["halaman"] == "status_klaim") {
					require "status_klaim.php";
				}
				else if($_GET["halaman"] == "produk") {
					require "produk.php";
				}
				else if($_GET["halaman"] == "tambah_produk") {
					require "tambah_produk.php";
				}
				else if($_GET["halaman"] == "tambah_foto") {
					require "tambah_foto.php";
				}
				else if($_GET["halaman"] == "edit_produk") {
					require "edit_produk.php";
				}
				else if($_GET["halaman"] == "hapus_produk") {
					require "hapus_produk.php";
				}
				else if($_GET["halaman"] == "klaim_produk") {
					require "klaim_produk.php";
				}
				else if($_GET["halaman"] == "detail_klaim") {
					require "detail_klaim.php";
				}
				else if($_GET["halaman"] == "konfirmasi_klaim") {
					require "konfirmasi_klaim.php";
				}
				else if($_GET["halaman"] == "rekonfirmasi") {
					require "rekonfirmasi.php";
				}
				else if($_GET["halaman"] == "hapus_klaim_produk") {
					require "hapus_klaim_produk.php";
				}
				else if($_GET["halaman"] == "gift") {
					require "gift.php";
				}
				else if($_GET["halaman"] == "edit_gift") {
					require "edit_gift.php";
				}
				else if($_GET["halaman"] == "hapus_gift") {
					require "hapus_gift.php";
				}
				else if($_GET["halaman"] == "member") {
					require "member.php";
				}
				else if($_GET["halaman"] == "nonaktif_member") {
					require "nonaktif_member.php";
				}
				else if($_GET["halaman"] == "aktif_member") {
					require "aktif_member.php";
				}
				else if($_GET["halaman"] == "hapus_member") {
					require "hapus_member.php";
				}
				else if($_GET["halaman"] == "laporan") {
					require "laporan.php";
				}
				else if($_GET["halaman"] == "logout") {
					require "logout.php";
				}
			}
		?>
	<!-- </section> -->
</div>

<?php require "footer.php"; ?>