<?php 

  // koneksi ke database
	$conn = mysqli_connect("localhost", "root", "", "albumi_comp");
  // ambil data produk pada tabel produk sesuai dengan id produk yang ada di url
  $ambil = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_kategori = '$_GET[id]' ORDER BY produk.id_produk DESC ");
  // cek apakah ada data yang dicari atau tidak
  $adaDataTidak = $ambil->num_rows;

?>

<!-- jika ada data yang dicari -->
<?php if($adaDataTidak > 0) { ?>

<div class="box-body table-responsive">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Harga</th>
      <th class="text-center">Berat</th>
      <th class="text-center">Stok</th>
      <th class="text-center">kategori</th>
      <th class="text-center" width="20%">Deskripsi</th>
      <th class="text-center">Foto</th>
      <th class="text-center">Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php $no = 1; ?>
    <?php while($pecah = $ambil->fetch_assoc()) { ?>
    <tr>
      <td><?=$no; ?></td>
      <td><?=$pecah["nama_produk"]; ?></td>
      <td>Rp. <?=number_format($pecah["harga_produk"]); ?></td>
      <td><?=$pecah["berat_produk"]; ?> Gr</td>
      <td><?=$pecah["stok_produk"]; ?></td>
      <td><?=$pecah["kategori_produk"]; ?></td>
      <td width="20%"><?=$pecah["deskripsi_produk"]; ?></td>
      <td><img src="dist/img-produk/<?=$pecah['foto_produk']; ?>" class="img-thumbnail" alt="Gambar Produk." width="100" height="70"></td>
      <td>
        <a href="index.php?halaman=edit_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
        <a href="index.php?halaman=hapus_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i></a>
      </td>
    </tr>
    <?php $no++; ?>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Harga</th>
      <th class="text-center">Berat</th>
      <th class="text-center">Stok</th>
      <th class="text-center">kategori</th>
      <th class="text-center" width="20%">Deskripsi</th>
      <th class="text-center">Foto</th>
      <th class="text-center">Aksi</th>
    </tr>
    </tfoot>
  </table>
</div>
<!-- /.box-body -->

<?php } else { ?>

<div class="box-body">
  <h1 class="text-gray text-center"><i class="fa fa-warning"></i> Oops! Data tidak ditemukan</h1>
</div>

<?php } ?>