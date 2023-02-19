<?php 

  // koneksi ke database
  $conn = mysqli_connect("localhost", "root", "", "albumi_comp");

  // ambil id klaim dari url
  $idKlaim = $_GET["id"];

  // ambil dan tampilkan isi dari tabel klaim, member, klaim produk, produk, kategori
  $ambilDetailKlaim = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member JOIN klaim_produk ON klaim_produk.id_klaim = klaim.id_klaim JOIN produk ON klaim_produk.id_produk = produk.id_produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE klaim.id_klaim = '$idKlaim' ");
  $pecahDetailKlaim = $ambilDetailKlaim->fetch_assoc();

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AlbumiComp | Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body onload="window.print();">

  <div class="wrapper">
    
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
        <div class="col-xs-6 pull-left">
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

    </section>
    <!-- /.content -->

  </div>
  
</body>
</html>