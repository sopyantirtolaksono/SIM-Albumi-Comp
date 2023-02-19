<?php 

    // mulai session
    session_start();
    // koneksi ke database
    require "../admin/connection.php";

    // cek cookienya
    if(isset($_COOKIE["idC"]) && isset($_COOKIE["keyC"])) {
        // ambil value cookienya
        $idC    = $_COOKIE["idC"];
        $keyC   = $_COOKIE["keyC"];

        // ambil data member dari tabel member
        $ambilMemberC = $conn->query("SELECT * FROM member WHERE id_member = '$idC' ");
        $pecahMemberC = $ambilMemberC->fetch_assoc();

        // cek/verifikasi value keyC dengan nama member pada tabel member
        if($keyC === hash("sha256", $pecahMemberC["nama_member"])) {
            // jika cocok, alihkan ke halaman index
            echo "<script>location ='index.php';</script>";
            header('Location: index.php');    
        }

    }

    // jika member sudah login, tapi status member non aktif
    if(isset($_SESSION["member"])) {
        $idM         = $_SESSION["member"]["id_member"];
        $ambilMember = $conn->query("SELECT * FROM member WHERE id_member = '$idM' ");
        $pecahMember = $ambilMember->fetch_assoc();
        // jika status member aktif
        if($pecahMember["status_member"] == "active") {
            // alihkan ke halaman index
            echo "<script>location ='index.php';</script>";
            header('Location: index.php');
            exit();
        }
        else if($pecahMember["status_member"] == "non active") {
            $idM     = session_unset();
        }
    }
    else if(!isset($_SESSION["member"])) {
        $idM     = session_unset();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Albumi Comp - Login</title>
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link font-awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Link style login -->
    <link rel="stylesheet" href="css/login.css">
    <!-- JavaScript jQuery -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
</head>
<body>

    <div class="row-login">
        <div class="col-form-login" style="">
            <div class="form-login-content">
                <h2 class="card-title text-center h2-login">Login</h2><br>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" class="" name="remember-me" id="remember-me">
                        <label for="remember-me">Remember me</label>  
                    </div>

                    <button type="submit" class="btn btn-info btn-block btn-lg" name="login">Login</button><br>

                    <!-- Script login -->
                    <?php 

                        // jika tombol login ditekan
                        if(isset($_POST["login"])) {
                            // ambil data member yang login dari form
                            $email    = $_POST["email"];
                            $password = $_POST["password"];

                            // ambil data dari tabel member sesuai data yg dikirim diform
                            $ambil = $conn->query("SELECT * FROM member WHERE email_member = '$email' ");
                            // cek ada data yang cocok tidak
                            $akunCocok = $ambil->num_rows;

                            // jika ada data yang cocok
                            if($akunCocok == 1) {
                                // ambil data member
                                $akunMember = $ambil->fetch_assoc();

                                // verifikasi password
                                if(password_verify($password, $akunMember["password_member"])) {

                                    // cek jika akun aktif atau non aktif
                                    if($akunMember["status_member"] == "active") {
                                        // buat session member dan alihkan ke halaman index
                                        $_SESSION["member"] = $akunMember;
                                        require "footer_login.php";

                                        // cek ada cookie tidak
                                        if(isset($_POST["remember-me"])) {
                                            // set cookie id member
                                            setcookie("idC", $akunMember["id_member"], time()+604800 );
                                            // set cookie nama member
                                            setcookie("keyC", hash("sha256", $akunMember["nama_member"]), time()+604800 );
                                        }

                                        echo "<script>location='index.php';</script>";
                                    }
                                    else if($akunMember["status_member"] == "non active") {
                                        // tampilkan pesan status non aktif dan tetap dihalaman login
                                        echo "<div class='alert alert-warning text-center'>Oops! Your account is non active</div>";
                                        echo "<script>
                                                $('div.form-login-content h2.h2-login').addClass('text-warning')
                                        </script>";
                                    }

                                }
                                else {
                                    // tampilkan pesan kesalahan
                                    echo "<div class='alert alert-danger text-center'>Oops! Please check your password</div>";
                                    echo "<script>
                                            $('div.form-login-content input#password').addClass('is-invalid')
                                            $('div.form-login-content h2.h2-login').addClass('text-danger')
                                    </script>";
                                }       

                            }
                            else {
                                // tampilkan pesan kesalahan
                                echo "<div class='alert alert-danger text-center'>Oops! Please check your username and password</div>";
                                echo "<script>
                                        $('div.form-login-content input').addClass('is-invalid')
                                        $('div.form-login-content h2.h2-login').addClass('text-danger')
                                </script>";
                            }

                        }          

                    ?>

                    <!-- Link registrasi -->
                    <a href="registration.php">Have not account ?</a>

                </form>
            </div>
        </div>
        <div class="col-bg-login">
            <div class="bg-login-content">

            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <!-- JavaScript bootstrap -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

</body>
</html>