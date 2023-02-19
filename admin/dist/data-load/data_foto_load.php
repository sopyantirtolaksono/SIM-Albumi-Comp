<?php 

	// koneksi ke database
	$conn = mysqli_connect("localhost", "root", "", "albumi_comp");
	// ambil data foto dari tabel foto
	$ambilFoto = $conn->query("SELECT * FROM foto WHERE id_produk = '$_GET[id]' "); 
	// jika ada datanya atau tidak ada datanya
	$adaData = $ambilFoto->num_rows;
	$pecahFoto = $ambilFoto->fetch_assoc();

?>

<div class="box-body">
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<h3 class="box-title">Semua foto</h3>
			<tbody>
				<tr>
					<td><img src="dist/img-gallery/<?=$pecahFoto["foto1"]; ?>" alt="Kosong!" width="150"></td>
					<td><img src="dist/img-gallery/<?=$pecahFoto["foto2"]; ?>" alt="Kosong!" width="150"></td>
					<td><img src="dist/img-gallery/<?=$pecahFoto["foto3"]; ?>" alt="Kosong!" width="150"></td>
					<td><img src="dist/img-gallery/<?=$pecahFoto["foto4"]; ?>" alt="Kosong!" width="150"></td>
					<td><img src="dist/img-gallery/<?=$pecahFoto["foto5"]; ?>" alt="Kosong!" width="150"></td>
				</tr>
			</tbody>
		</table>
	</div>

	<?php if($adaData == 1) : ?>
		<a href="hapus_foto_galeri.php?id=<?=$pecahFoto['id_foto']; ?>" class="btn btn-danger btn-block" id="btnHapusFoto" onclick="return confirm('Yakin hapus data?')"><i class="fa fa-trash"></i> Hapus foto</a>
		<script>$("button#btnSimpanFoto").attr("disabled", "")</script>
	<?php else: ?>
		<script>$("button#btnSimpanFoto").removeAttr("disabled", "")</script>
	<?php endif; ?>
</div>