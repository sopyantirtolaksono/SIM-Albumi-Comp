<?php 

  // ambil id klaim dari url
  $idKlaim = $_GET["id"];

  // ambil dan tampilkan isi dari tabel klaim, member, klaim produk, produk, kategori
  $ambilDetailKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member JOIN klaim_produk ON klaim_produk.id_klaim = klaim.id_klaim WHERE klaim.id_klaim = '$idKlaim' ");
  $pecahDetailKlaim = $ambilDetailKlaim->fetch_assoc();

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Detail Klaim
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-tags"></i> Home</li>
    <li>Konfirmasi klaim</li>
    <li class="active">Detail klaim</li>
  </ol>
</section>

<div class="pad margin no-print">
  <div class="callout callout-info" style="margin-bottom: 0!important;">
    <h4><i class="fa fa-info"></i> Note:</h4>
    <strong>Penting!</strong> Admin harus segera mengkonfirmasi klaim produk dari member, admin dapat mengkonfirmasi klaim, konfirmasi ulang klaim dan admin dapat mencetak bukti detail klaim produk ini.
  </div>
</div>

<!-- Main content -->
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> Admin Albumi Comp.
        <small class="pull-right">Tanggal: <?=date("Y/m/d"); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong>Admin, Inc.</strong><br>
        Jalan Tentara Pelajar<br>
        Purin, Kendal Jateng, Indonesia<br>
        Phone: (804) 123-5432<br>
        Email: albumicomp@gmail.com
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong><?=$pecahDetailKlaim["nama_member"]; ?></strong><br>
        <?=$pecahDetailKlaim["alamat_member"]; ?><br>
        Phone: <?=$pecahDetailKlaim["telepon_member"]; ?><br>
        Email: <?=$pecahDetailKlaim["email_member"]; ?>
      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Detail Klaim</b><br>
      <br>
      <b>Tanggal Klaim:</b> <?=$pecahDetailKlaim["tanggal_klaim"]; ?><br>
      <b>Status Klaim:</b> <?=$pecahDetailKlaim["status_klaim"]; ?>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>Produk</th>
          <th>Kategori</th>
          <th>Berat</th>
          <th>Harga</th>
          <th>Jumlah</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td><?=$pecahDetailKlaim["nama_produk"]; ?></td>
          <td><?=$pecahDetailKlaim["kategori_produk"]; ?> Both</td>
          <td><?=$pecahDetailKlaim["berat_produk"]; ?> Gr.</td>
          <td>Rp. <?=number_format($pecahDetailKlaim["harga_produk"]); ?></td>
          <td><?=$pecahDetailKlaim["total_klaim"]; ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-xs-6 pull-right">
      <p class="lead">Detail:</p>

      <div class="table-responsive">
        <table class="table">
          <tr>
            <th style="width:50%">Total Harga:</th>
            <td>Rp. <?=number_format($pecahDetailKlaim["total_harga"]); ?></td>
          </tr>
          <tr>
            <th>Point Kategori:</th>
            <td><?=$pecahDetailKlaim["point_kategori"]; ?> Point</td>
          </tr>
          <tr>
            <th>Point Member:</th>
            <td><?=$pecahDetailKlaim["point_member"]; ?> Point</td>
          </tr>
        </table>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">
    <div class="col-xs-12">
      
      <a href="index.php?halaman=klaim_produk" class="btn btn-default"><i class="fa fa-undo"></i> Kembali</a>
      <a href="invoice_print.php?id=<?=$idKlaim; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>

      <?php if($pecahDetailKlaim["status_klaim"] == "pending") { ?>
      <a href="index.php?halaman=konfirmasi_klaim&id=<?=$idKlaim; ?>" class="btn btn-warning pull-right"><i class="fa fa-arrow-right"></i> Konfirmasi
      </a>
      <?php } else { ?>
      <a href="#" class="btn btn-success pull-right disabled"><i class="fa fa-check"></i> Terkonfirmasi
      </a>
      <a href="index.php?halaman=rekonfirmasi&id=<?=$idKlaim; ?>" class="btn btn-warning pull-right" style="margin-right: 5px;" onclick="return confirm('Yakin ingin batalkan konfirmasi?')">
        <i class="fa fa-refresh"></i> Batalkan Konfirmasi
      </a>
      <?php } ?>

    </div>
  </div>
</section>
<!-- /.content -->
<div class="clearfix"></div>