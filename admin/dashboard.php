<?php

  // ambil data produk gold, silver, bronze, member dan hitung jumlah data yang masuk/yang ada
  $gold = $conn->query("SELECT COUNT(id_kategori) FROM produk WHERE id_kategori = 1");
  $Silver = $conn->query("SELECT COUNT(id_kategori) FROM produk WHERE id_kategori = 2");
  $Bronze = $conn->query("SELECT COUNT(id_kategori) FROM produk WHERE id_kategori = 3");
  $member = $conn->query("SELECT COUNT(id_member) FROM member");

  $goldArray = $gold->fetch_assoc();
  $silverArray = $Silver->fetch_assoc();
  $bronzeArray = $Bronze->fetch_assoc();
  $memberArray = $member->fetch_assoc();
  
  // rubah data dari array ke string
  $goldString = implode($goldArray);
  $silverString = implode($silverArray);
  $bronzeString = implode($bronzeArray);
  $memberString = implode($memberArray);


  // ambil jumlah data klaim produk, klaim terkonfirmasi, klaim pending, gift
  $ambilKlaim          = $conn->query("SELECT * FROM klaim");
  $ambilKlaimTerkonfir = $conn->query("SELECT * FROM klaim WHERE status_klaim = 'confirmed' ");
  $ambilKlaimPending   = $conn->query("SELECT * FROM klaim WHERE status_klaim = 'pending' ");
  $ambilGift           = $conn->query("SELECT * FROM gift");

  // hitung jumlah datanya
  $jmlKlaim           = $ambilKlaim->num_rows;
  $jmlKlaimTerkonfirm = $ambilKlaimTerkonfir->num_rows;
  $jmlKlaimPending    = $ambilKlaimPending->num_rows;
  $jmlGift            = $ambilGift->num_rows;

?>

<section class="content">

  <?php if(isset($_SESSION["manager"])) { ?>
  
    <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(254,216,1,1);">
            <div class="inner" style="color: white;">
              <h3><?=$goldString; ?></h3>

              <p>Produk Gold</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(192,192,192,1);">
            <div class="inner" style="color: white;">
              <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
              <h3><?=$silverString; ?></h3>

              <p>Produk Silver</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(182,107,107,1);">
            <div class="inner" style="color: white;">
              <h3><?=$bronzeString; ?></h3>

              <p>Produk Bronze</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?=$memberString; ?></h3>

              <p>Members</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$jmlKlaim; ?></h3>

              <p>Klaim Produk</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$jmlKlaimTerkonfirm; ?></h3>

              <p>Klaim Terkonfirmasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-circle"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$jmlKlaimPending; ?></h3>

              <p>Klaim Pending</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$jmlGift; ?></h3>

              <p>Produk Gift</p>
            </div>
            <div class="icon">
              <i class="fa fa-gift"></i>
            </div>

            <a class="small-box-footer disabled">Albumi Comp</a>
          </div>
        </div>
        <!-- ./col -->

      </div>
    <!-- /.row -->

  <?php } ?>


  <?php if(isset($_SESSION["operator"])) { ?>

	 <!-- Small boxes (Stat box) -->
      <div class="row">

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(254,216,1,1);">
            <div class="inner" style="color: white;">
              <h3><?=$goldString; ?></h3>

              <p>Produk Gold</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <?php if($goldString > 0) { ?>
            <a href="index.php?halaman=kategori_produk&id=1" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(192,192,192,1);">
            <div class="inner" style="color: white;">
              <!-- <h3>53<sup style="font-size: 20px">%</sup></h3> -->
              <h3><?=$silverString; ?></h3>

              <p>Produk Silver</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <?php if($silverString > 0) { ?>
            <a href="index.php?halaman=kategori_produk&id=2" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box" style="background-color: rgba(182,107,107,1);">
            <div class="inner" style="color: white;">
              <h3><?=$bronzeString; ?></h3>

              <p>Produk Bronze</p>
            </div>
            <div class="icon">
              <i class="fa fa-cube"></i>
            </div>

            <?php if($bronzeString > 0) { ?>
            <a href="index.php?halaman=kategori_produk&id=3" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?=$memberString; ?></h3>

              <p>Members</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>

            <?php if($memberString > 0) { ?>
            <a href="index.php?halaman=member" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?=$jmlKlaim; ?></h3>

              <p>Klaim Produk</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>

            <?php if($jmlKlaim > 0) { ?>
            <a href="index.php?halaman=klaim_produk" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?=$jmlKlaimTerkonfirm; ?></h3>

              <p>Klaim Terkonfirmasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-circle"></i>
            </div>

            <?php if($jmlKlaimTerkonfirm > 0) { ?>
            <a href="index.php?halaman=status_klaim&k=confirmed" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?=$jmlKlaimPending; ?></h3>

              <p>Klaim Pending</p>
            </div>
            <div class="icon">
              <i class="fa fa-clock-o"></i>
            </div>

            <?php if($jmlKlaimPending > 0) { ?>
            <a href="index.php?halaman=status_klaim&k=pending" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?=$jmlGift; ?></h3>

              <p>Produk Gift</p>
            </div>
            <div class="icon">
              <i class="fa fa-gift"></i>
            </div>

            <?php if($jmlGift > 0) { ?>
            <a href="index.php?halaman=gift" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
            <?php } else { ?>
            <a class="small-box-footer disabled">Tidak ada data</a>
            <?php } ?>
          </div>
        </div>
        <!-- ./col -->

      </div>
    <!-- /.row -->
    
  <?php } ?>



  <!-- AREA DATA LINE CHART DAN PIE CHART -->
  <div class="row">

    <!-- AREA CHART LAPORAN BULANAN -->
    <div class="col-md-8">
      <div class="box box-primary">
        <div class="box-header with-border">

          <?php 
            $thnSkrngAktif = date("Y");
            $ambilTahun = $conn->query("SELECT * FROM laporan WHERE tahun_laporan = '$thnSkrngAktif' ");
            $dataThnAdaTdk = $ambilTahun->num_rows;
            $pecahTahun = $ambilTahun->fetch_assoc();
          ?>
          <?php if($dataThnAdaTdk > 0) { ?>
            <h3 class="box-title"><i class="fa fa-line-chart"></i> 
              Laporan Bulanan - Tahun <?=$pecahTahun["tahun_laporan"]; ?>
            </h3>
          <?php } else { ?>
            <h3 class="box-title"><span class="label label-warning"><i class="fa fa-clock-o"></i> Loading..</span></h3>
          <?php } ?>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
    
        <div class="box-body">
          <div class="chart">
            <canvas id="canvas-line" style="height:300px"></canvas>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>

    <!-- AREA CHART LAPORAN DATA SETIAP KATEGORI YANG TER KLAIM -->
    <div class="col-md-4">
      <div class="box box-primary">

        <div class="box-header with-border">

          <h3 class="box-title"><i class="fa fa-pie-chart"></i> 
            Kategori produk favorit
          </h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
    
        <div class="box-body">

          <div class="text-center" id="canvas-holder">
            <canvas id="canvas-pie" width="300" height="300"/>
          </div>

        </div>
        <!-- /.box-body -->
        
      </div>
    </div>

  </div>

</section>