<?php 

  // koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "albumi_comp");
  
  // ambil keyword di url
  $keyword = $_GET["k"];
  // ambil data yang dicari di tabel klaim
  $ambilDataKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member WHERE member.nama_member LIKE '%$keyword%' ORDER BY klaim.id_klaim DESC");
  // cek ada data yang dicari atau tidak
  $adaDataTidak = $ambilDataKlaim->num_rows;

?>


<?php if($adaDataTidak > 0) { ?>

<div class="box-body table-responsive">
  <table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Tanggal Klaim</th>
      <th class="text-center">Status</th>
      <th class="text-center">Aksi</th>
    </tr>
    </thead>

    <tbody>
    <?php 
      $no = 1;
      while($pecahDataKlaim = $ambilDataKlaim->fetch_assoc()) {
    ?>
    <tr>
      <td><?=$no; ?></td>
      <td><?=$pecahDataKlaim["nama_member"]; ?></td>
      <td><?=$pecahDataKlaim["tanggal_klaim"]; ?></td>

      <?php if($pecahDataKlaim["status_klaim"] == "pending") { ?>
      <td><span class="label label-warning"><?=$pecahDataKlaim["status_klaim"]; ?></span></td>
      <?php } else { ?>
      <td><span class="label label-success"><?=$pecahDataKlaim["status_klaim"]; ?></span></td>
      <?php } ?>

      <td>
        <a href="index.php?halaman=hapus_klaim_produk&id=<?=$pecahDataKlaim['id_klaim']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i> Hapus</a>
        <a href="index.php?halaman=detail_klaim&id=<?=$pecahDataKlaim['id_klaim']; ?>" class="btn btn-info"><i class="fa fa-file-text"></i> Detail</a>

        <?php if($pecahDataKlaim["status_klaim"] == "pending") { ?>
        <a href="index.php?halaman=konfirmasi_klaim&id=<?=$pecahDataKlaim['id_klaim']; ?>" class="btn btn-warning"><i class="fa fa-arrow-right"></i> Konfirmasi</a>
        <?php } else { ?>
        <a href="#" class="btn btn-success disabled"><i class="fa fa-check"></i> Terkonfirmasi</a>
        <?php } ?>
      </td>
    </tr>
    <?php $no++; ?>
    <?php } ?>
    </tbody>

    <tfoot>
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama</th>
      <th class="text-center">Tanggal Klaim</th>
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