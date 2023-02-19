<?php 

	// koneksi ke database
	$conn = mysqli_connect("localhost", "root", "", "albumi_comp");
	// set default timezone indonesia
	date_default_timezone_set("Asia/Jakarta");

	// ambil keyword dari url
	$keyword = $_GET["k"];
	// ambil data yang dicari dari tabel member
	$ambil = $conn->query("SELECT * FROM member WHERE nama_member LIKE '%$keyword%' ORDER BY id_member DESC ");
  // cek ada data yang dicari atau tidak
  $adaDataTidak = $ambil->num_rows;

	// dapatkan tanggal sekarang
	$tglSekarang = date("Y-m-d");

?>


<?php if($adaDataTidak > 0) { ?>

<div class="box-body table-responsive">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Gambar</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Email</th>
      <th class="text-center">Alamat</th>
      <th class="text-center">Telepon</th>
      <th class="text-center">Jenis Kelamin</th>
      <th class="text-center">Tanggal Gabung</th>
      <th class="text-center">Point</th>
      <th class="text-center">Status</th>
      <th class="text-center">Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php $no = 1; ?>
    <?php while($pecah = $ambil->fetch_assoc()) { ?>

    <?php if($pecah["tanggal_registrasi"] == $tglSekarang) { ?>
    <tr class="bg-danger">
    <?php } else { ?>
    <tr>
    <?php } ?>

      <td><?=$no; ?></td>
      <td>
        <img src="../user/img/profile-img/<?=$pecah['img_member']; ?>" class="img-thumbnail" alt="" width="80">
      </td>
      <td><?=$pecah["nama_member"]; ?></td>
      <td><?=$pecah["email_member"]; ?></td>
      <td><?=$pecah["alamat_member"]; ?></td>
      <td><?=$pecah["telepon_member"]; ?></td>
      <td><?=$pecah["jenis_kelamin"]; ?></td>
      <td><?=$pecah["tanggal_registrasi"]; ?></td>
      <td><?=$pecah["point_member"]; ?></td>

      <?php if($pecah["status_member"] == "active") { ?>

      <td><span class="label label-success"><?=$pecah["status_member"]; ?></span></td>
      <td>
        <a href="index.php?halaman=nonaktif_member&id=<?=$pecah['id_member']; ?>" class="btn btn-success btn-block"><i class="fa fa-toggle-on"></i></a>
        <a href="index.php?halaman=hapus_member&id=<?=$pecah['id_member']; ?>" class="btn btn-danger btn-block" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i></a>
      </td>

      <?php } else { ?>

      <td><span class="label label-warning"><?=$pecah["status_member"]; ?></span></td>
      <td>
        <a href="index.php?halaman=aktif_member&id=<?=$pecah['id_member']; ?>" class="btn btn-default btn-block"><i class="fa fa-toggle-off"></i></a>
        <a href="index.php?halaman=hapus_member&id=<?=$pecah['id_member']; ?>" class="btn btn-danger btn-block" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i></a>
      </td>

      <?php } ?>

    </tr>

    <?php $no++; ?>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Gambar</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Email</th>
      <th class="text-center">Alamat</th>
      <th class="text-center">Telepon</th>
      <th class="text-center">Jenis Kelamin</th>
      <th class="text-center">Tanggal Gabung</th>
      <th class="text-center">Point</th>
      <th class="text-center">Status</th>
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