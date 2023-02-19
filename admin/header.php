<?php 

  // mulai session
  session_start();
  // koneksi database
  require "connection.php";

  // set zona waktu indonesia
  date_default_timezone_set("Asia/Jakarta");
  // ambil tanggal sekarang
  $tglSekarang = date("Y-m-d");

  // ambil jumlah data klaim yg belum dikonfirmasi/pending
  $ambilDataPending = $conn->query("SELECT * FROM klaim JOIN member ON klaim.id_member = member.id_member WHERE status_klaim = 'pending' ORDER BY klaim.id_klaim DESC ");
  // ambil jumlah data klaim yg sudah dikonfirmasi/confirmed
  $ambilDataConfirm = $conn->query("SELECT * FROM klaim WHERE status_klaim = 'confirmed' ");
  // ambil jumlah semua data klaim yg belum dikonfirmasi dan sudah dikonfirmasi
  $ambilDataKlaim   = $conn->query("SELECT * FROM klaim ");
  // ambil data member baru dari tabel member
  $ambilMemberBaru  = $conn->query("SELECT * FROM member WHERE tanggal_registrasi = '$tglSekarang' ORDER BY id_member DESC");

  $jmlDataPending   = $ambilDataPending->num_rows;
  $jmlDataConfirm   = $ambilDataConfirm->num_rows;
  $jmlDataKlaim     = $ambilDataKlaim->num_rows;
  $jmlMemberBaru    = $ambilMemberBaru->num_rows;

?>



<!-- jika yang login manager -->
<?php if(isset($_SESSION["manager"])) { ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Albumi Comp | Control Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <!-- <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>BC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Albumi</b> Comp</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- jika admin/operator yang login -->
          <?php if(isset($_SESSION["operator"])) { ?>

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">

            <?php if($jmlMemberBaru > 0) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownToggleMember">
              <i class="fa fa-user-plus"></i>
              <span class="label label-danger" id="labelMember"><?=$jmlMemberBaru; ?></span>
            </a>
            <?php } else { ?>
            <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
              <i class="fa fa-user-plus"></i>
            </a>
            <?php } ?>

            <ul class="dropdown-menu">
              <li class="header">Kamu punya <?=$jmlMemberBaru; ?> member baru</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  <?php while($pecahMemberBaru = $ambilMemberBaru->fetch_assoc()) { ?>
                  <li><!-- start message -->
                    <a href="index.php?halaman=member">
                      <div class="pull-left">
                        <img src="../user_page/img/profile-img/<?=$pecahMemberBaru['img_member']; ?>" class="img-circle" alt="Gambar Member">
                      </div>
                      <h4>
                        <?=$pecahMemberBaru["nama_member"]; ?>
                      </h4>
                      <p>
                        <i class="fa fa-clock-o"></i> 
                        <?=$pecahMemberBaru["tanggal_registrasi"]; ?>
                      </p>
                    </a>
                  </li>
                  <!-- end message -->
                  <?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="index.php?halaman=member">Detail</a></li>
            </ul>
          </li>
          
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->

            <?php if($jmlDataPending > 0) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="label label-warning"><?=$jmlDataPending; ?></span>
            </a>
            <?php } else { ?>
            <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
            </a>
            <?php } ?>

            <ul class="dropdown-menu">
              <li class="header">Pemberitahuan <?=$jmlDataPending; ?> data pending</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">

                  <?php while($pecahDataPending = $ambilDataPending->fetch_assoc()) { ?>
                  <li>
                    <a href="index.php?halaman=status_klaim&k=pending">
                      <i class="fa fa-tags text-yellow"></i> 
                      <?=$pecahDataPending["nama_member"]; ?>
                      <small class="pull-right"><i class="fa fa-clock-o"></i> 
                      <?=$pecahDataPending["tanggal_klaim"]; ?>
                      </small>
                    </a>
                  </li>
                  <?php } ?>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="index.php?halaman=status_klaim&k=pending">Lihat semua</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../dist/img/avatar04.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Operator Albumi Comp</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../dist/img/avatar04.png" class="img-circle" alt="Operator Image">

                <p>
                  Operator - Team at Albumi Comp
                  <small>Team since Dec. 2014</small>
                </p>
              </li>
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="index.php?halaman=logout" class="btn btn-default btn-flat btn-block" onclick="return confirm('Anda ingin keluar?')">Keluar</a>
                </div>
              </li>
            </ul>
          </li>

          <?php } else if(isset($_SESSION["manager"])) { ?>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../dist/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Manager Albumi Comp</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../dist/img/avatar5.png" class="img-circle" alt="Manager Image">

                <p>
                  Manager - Team at Albumi Comp
                  <small>Team since Nov. 2014</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="index.php?halaman=logout" class="btn btn-default btn-flat btn-block" onclick="return confirm('Anda ingin keluar?')">Keluar</a>
                </div>
              </li>
            </ul>
          </li>

          <?php } ?>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <?php if(isset($_SESSION["operator"])) { ?>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar04.png" class="img-circle" alt="Operator Image">
        </div>
        <div class="pull-left info">
          <p>Operator</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <?php } else if(isset($_SESSION["manager"])) { ?>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar5.png" class="img-circle" alt="Manager Image">
        </div>
        <div class="pull-left info">
          <p>Manager</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <?php } ?>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Navigasi</li>
        <!-- Optionally, you can add icons to the links -->    
        
        <?php if(isset($_SESSION["manager"])) { ?>
          <li><a href="index.php?halaman=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li><a href="index.php?halaman=laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
          <li><a href="index.php?halaman=logout" onclick="return confirm('Anda ingin keluar?')"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <?php } ?>

        <?php if(isset($_SESSION["operator"])) { ?>
          <li><a href="index.php?halaman=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <li class="active treeview">
            <a href="#">
              <i class="fa fa-cube"></i> <span>Produk</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="index.php?halaman=produk"><i class="fa fa-circle-o text-aqua"></i> Data Tabel</a></li>
              <li><a href="index.php?halaman=tambah_produk"><i class="fa fa-circle-o text-aqua"></i> Tambah Produk</a></li>
              <li><a href="index.php?halaman=tambah_foto"><i class="fa fa-circle-o text-aqua"></i> Tambah Foto Galeri</a></li>
            </ul>
          </li>

          <li>
            <a href="index.php?halaman=klaim_produk">
              <i class="fa fa-tags"></i> <span>Klaim Produk</span>
              <span class="pull-right-container">
                <span class="label label-info pull-right"><?=$jmlDataKlaim; ?></span>

                <?php if($jmlDataConfirm > 0) { ?>
                <span class="label label-success pull-right"><?=$jmlDataConfirm; ?></span>
                <?php } ?>

                <?php if($jmlDataPending > 0) { ?>
                <span class="label label-warning pull-right"><?=$jmlDataPending; ?></span>
                <?php } ?>
              </span>
            </a>
          </li>

          <li><a href="index.php?halaman=gift"><i class="fa fa-gift"></i> <span>Gift</span></a></li>

          <li>
            <a href="index.php?halaman=member">
              <i class="fa fa-users"></i> <span>Members</span>
              <span class="pull-right-container">

                <?php if($jmlMemberBaru > 0) { ?>
                <span class="label label-danger pull-right"><?=$jmlMemberBaru; ?></span>
                <?php } ?>

              </span>
            </a>
          </li>

          <li><a href="index.php?halaman=laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
          <li><a href="index.php?halaman=logout" onclick="return confirm('Anda ingin keluar?')"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <?php } ?>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>



<!-- jika yang login operator -->
<?php } else if(isset($_SESSION["operator"])) { ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Albumi Comp | Control Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Select2 -->
  <!-- <link rel="stylesheet" href="../bower_components/select2/dist/css/select2.min.css"> -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="../bower_components/jquery/dist/jquery.min.js"></script>

</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>BC</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Albumi</b> Comp</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- jika admin/operator yang login -->
          <?php if(isset($_SESSION["operator"])) { ?>

          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">

            <?php if($jmlMemberBaru > 0) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="dropdownToggleMember">
              <i class="fa fa-user-plus"></i>
              <span class="label label-danger" id="labelMember"><?=$jmlMemberBaru; ?></span>
            </a>
            <?php } else { ?>
            <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
              <i class="fa fa-user-plus"></i>
            </a>
            <?php } ?>

            <ul class="dropdown-menu">
              <li class="header">Kamu punya <?=$jmlMemberBaru; ?> member baru</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">

                  <?php while($pecahMemberBaru = $ambilMemberBaru->fetch_assoc()) { ?>
                  <li><!-- start message -->
                    <a href="index.php?halaman=member">
                      <div class="pull-left">
                        <img src="../user_page/img/profile-img/<?=$pecahMemberBaru['img_member']; ?>" class="img-circle" alt="Gambar Member">
                      </div>
                      <h4>
                        <?=$pecahMemberBaru["nama_member"]; ?>
                      </h4>
                      <p>
                        <i class="fa fa-clock-o"></i> 
                        <?=$pecahMemberBaru["tanggal_registrasi"]; ?>
                      </p>
                    </a>
                  </li>
                  <!-- end message -->
                  <?php } ?>
                </ul>
              </li>
              <li class="footer"><a href="index.php?halaman=member">Detail</a></li>
            </ul>
          </li>
          
          <!-- Notifications Menu -->
          <li class="dropdown notifications-menu">
            <!-- Menu toggle button -->

            <?php if($jmlDataPending > 0) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="label label-warning"><?=$jmlDataPending; ?></span>
            </a>
            <?php } else { ?>
            <a href="#" class="dropdown-toggle disabled" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
            </a>
            <?php } ?>

            <ul class="dropdown-menu">
              <li class="header">Pemberitahuan <?=$jmlDataPending; ?> data pending</li>
              <li>
                <!-- Inner Menu: contains the notifications -->
                <ul class="menu">

                  <?php while($pecahDataPending = $ambilDataPending->fetch_assoc()) { ?>
                  <li>
                    <a href="index.php?halaman=status_klaim&k=pending">
                      <i class="fa fa-tags text-yellow"></i> 
                      <?=$pecahDataPending["nama_member"]; ?>
                      <small class="pull-right"><i class="fa fa-clock-o"></i> 
                      <?=$pecahDataPending["tanggal_klaim"]; ?>
                      </small>
                    </a>
                  </li>
                  <?php } ?>
                  <!-- end notification -->
                </ul>
              </li>
              <li class="footer"><a href="index.php?halaman=status_klaim&k=pending">Lihat semua</a></li>
            </ul>
          </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../dist/img/avatar04.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Operator Albumi Comp</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../dist/img/avatar04.png" class="img-circle" alt="Operator Image">

                <p>
                  Operator - Team at Albumi Comp
                  <small>Team since Dec. 2014</small>
                </p>
              </li>
            
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="index.php?halaman=logout" class="btn btn-default btn-flat btn-block" onclick="return confirm('Anda ingin keluar?')">Keluar</a>
                </div>
              </li>
            </ul>
          </li>

          <?php } else if(isset($_SESSION["manager"])) { ?>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="../dist/img/avatar5.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">Manager Albumi Comp</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="../dist/img/avatar5.png" class="img-circle" alt="Manager Image">

                <p>
                  Manager - Team at Albumi Comp
                  <small>Team since Nov. 2014</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="">
                  <a href="index.php?halaman=logout" class="btn btn-default btn-flat btn-block" onclick="return confirm('Anda ingin keluar?')">Keluar</a>
                </div>
              </li>
            </ul>
          </li>

          <?php } ?>

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <?php if(isset($_SESSION["operator"])) { ?>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar04.png" class="img-circle" alt="Operator Image">
        </div>
        <div class="pull-left info">
          <p>Operator</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <?php } else if(isset($_SESSION["manager"])) { ?>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="../dist/img/avatar5.png" class="img-circle" alt="Manager Image">
        </div>
        <div class="pull-left info">
          <p>Manager</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <?php } ?>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu Navigasi</li>
        <!-- Optionally, you can add icons to the links -->    
        
        <?php if(isset($_SESSION["manager"])) { ?>
          <li><a href="index.php?halaman=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li><a href="index.php?halaman=laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
          <li><a href="index.php?halaman=logout" onclick="return confirm('Anda ingin keluar?')"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <?php } ?>

        <?php if(isset($_SESSION["operator"])) { ?>
          <li><a href="index.php?halaman=dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <li class="active treeview">
            <a href="#">
              <i class="fa fa-cube"></i> <span>Produk</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="index.php?halaman=produk"><i class="fa fa-circle-o text-aqua"></i> Data Tabel</a></li>
              <li><a href="index.php?halaman=tambah_produk"><i class="fa fa-circle-o text-aqua"></i> Tambah Produk</a></li>
              <li><a href="index.php?halaman=tambah_foto"><i class="fa fa-circle-o text-aqua"></i> Tambah Foto Galeri</a></li>
            </ul>
          </li>

          <li>
            <a href="index.php?halaman=klaim_produk">
              <i class="fa fa-tags"></i> <span>Klaim Produk</span>
              <span class="pull-right-container">
                <span class="label label-info pull-right"><?=$jmlDataKlaim; ?></span>

                <?php if($jmlDataConfirm > 0) { ?>
                <span class="label label-success pull-right"><?=$jmlDataConfirm; ?></span>
                <?php } ?>

                <?php if($jmlDataPending > 0) { ?>
                <span class="label label-warning pull-right"><?=$jmlDataPending; ?></span>
                <?php } ?>
              </span>
            </a>
          </li>

          <li><a href="index.php?halaman=gift"><i class="fa fa-gift"></i> <span>Gift</span></a></li>

          <li>
            <a href="index.php?halaman=member">
              <i class="fa fa-users"></i> <span>Members</span>
              <span class="pull-right-container">

                <?php if($jmlMemberBaru > 0) { ?>
                <span class="label label-danger pull-right"><?=$jmlMemberBaru; ?></span>
                <?php } ?>

              </span>
            </a>
          </li>

          <li><a href="index.php?halaman=laporan"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
          <li><a href="index.php?halaman=logout" onclick="return confirm('Anda ingin keluar?')"><i class="fa fa-sign-out"></i> <span>Keluar</span></a></li>
        <?php } ?>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

<?php } else { ?>

  <!-- jika tidak ada yang login -->
  
  <!-- alihkan kehalaman login -->
  <script>location = "login.php";</script>
  <!-- alihkan kehalaman login -->
  <?php 
    header("Location: login.php"); 
    exit();
  ?>

<?php } ?>