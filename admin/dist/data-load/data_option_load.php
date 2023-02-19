<?php 
	// koneksi ke database
	$conn = mysqli_connect("localhost", "root", "", "albumi_comp");
	// ambil data produk dari tabel produk
	$ambil = $conn->query("SELECT * FROM produk WHERE id_kategori = '$_GET[id]' ORDER BY id_produk DESC ");
?>

<select class="form-control" name="id_produk" style="width: 100%;" id="selectFoto">
	<?php while($pecah = $ambil->fetch_assoc()) { ?>
      	<option value="<?=$pecah['id_produk']; ?>"><?=$pecah["nama_produk"]; ?></option>
	<?php } ?>
</select>

<!-- jQuery load data foto -->
<script>
	$(document).ready(function(){
		$("select#selectFoto option").on("click", function(){
			let valSelectFoto = $("select#selectFoto").val()
			$("#tableFotoLoad").load("dist/data-load/data_foto_load.php?id=" + valSelectFoto)
		})
	})
</script>