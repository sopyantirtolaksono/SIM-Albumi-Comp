<?php

  // mulai session
  session_start();
  // koneksi ke database
  require "connection.php";

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AlBumi Comp | Login</title>
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
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="login.php"><b>Albumi</b> Comp</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Masuk untuk memulai sesi</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="user" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pass" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
      <div class="radio text-center">
        <p class="login-box-msg">Status:</p>
        <label>
          <input type="radio" name="level" value="operator" checked>
          Operator
        </label>
        <label>
          <input type="radio" name="level" value="manager">
          Manager
        </label>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="sign-in">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br>

    <?php

      // jika tombol sign in ditekan
      if(isset($_POST["sign-in"])) {
        $ambil = $conn->query("SELECT * FROM admin WHERE username = '$_POST[user]' AND password = '$_POST[pass]' AND level = '$_POST[level]' ");

        $pecah = $ambil->fetch_assoc();

        $cocok = $ambil->num_rows;

        if($cocok == 1) {
          if($pecah["level"] == "operator") {
            $_SESSION["operator"] = $pecah;
            header("Location: index.php?halaman=dashboard");
          }
          else if($pecah["level"] == "manager") {
            $_SESSION["manager"] = $pecah;
            header("Location: index.php?halaman=dashboard");
          }

          // echo "<div class='alert alert-success text-center'>Login berhasil</div>";
          // echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=dashboard'>";
        }
        else {
          echo "<div class='alert alert-danger text-center'>
                  Login gagal!<br>
                  <span>Cek username, password dan status anda!</span>
              </div>";
        }
      }

    ?>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>
</body>
</html>
