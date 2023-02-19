<?php
	
  // ambil semua data klaim dari tabel klaim
  $ambilDataKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member ORDER BY klaim.id_klaim DESC");

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Klaim Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-tags"></i> Klaim Produk</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Konfirmasi Klaim</h3>
              <br><br>
              <div class="row">
                <div class="col-md-3">
                  <label for="cariNamaMember">Cari nama member</label>
                  <input type="text" class="form-control" id="cariNamaMember" placeholder="Ketikan nama member..">
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="tableKlaimLoad">
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
            </div>
            <!-- /.tableKlaimLoad -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->