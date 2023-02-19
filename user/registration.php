<?php 

    // mulai session
    session_start();
    // koneksi ke database
    require "../admin/connection.php";

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

    // cek jika tombol registrasi diklik
    if(isset($_POST["registrasi"])) {
        // ambil data dari form
        $nama          = stripslashes($_POST["nama"]);
        $email         = $_POST["email"];
        $password      = mysqli_escape_string($conn, $_POST["password"]);
        $alamat        = $_POST["alamat"];
        $telepon       = $_POST["telepon"];
        $jenisKelamin  = $_POST["jenis-kelamin"];
        $tglRegistrasi = date("Y-m-d");

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // insert data ke database
        $conn->query("INSERT INTO member (nama_member, email_member, password_member, alamat_member, telepon_member, jenis_kelamin, tanggal_registrasi) VALUES ('$nama', '$email', '$password', '$alamat', '$telepon', '$jenisKelamin', '$tglRegistrasi') ");

        // Arahkan ke halaman login
        header("location:login.php");

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Albumi Comp | Registration</title>
    <!-- Link bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Link font-awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Link style login -->
    <link rel="stylesheet" href="css/registration.css">
    <!-- JavaScript jQuery -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
</head>
<body>

    <div class="row-registration">
        
        <div class="col-bg-registration">
            <div class="bg-registration-content">

            </div>
        </div>

        <div class="col-form-registration" style="">
            <div class="form-registration-content">
                <h2 class="card-title text-center">Registration</h2><br>
                <form action="" method="post">

                    <div class="form-group">
                        <label for="nama">Full name</label>
                        <input type="text" class="form-control form-control-lg" name="nama" id="nama" placeholder="Enter full name" required>
                    </div>

                    <div class="row">
                        <div class="col-6">

                            <div class="form-group">
                                <label for="jenisKelamin">Gender</label>
                                <select class="form-control form-control-lg" name="jenis-kelamin" id="jenisKelamin" required style="box-shadow: none !important;">
                                    <option value="pria">Male</option>
                                    <option value="wanita">Female</option>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="telepon">Telephone</label>
                                <input type="number" class="form-control form-control-lg" name="telepon" id="telepon" placeholder="Enter Telephone" required>
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="Enter email" required>
                    </div>

                    <div class="form-group">
                        <label for="alamat">Address</label>
                        <input type="text" class="form-control form-control-lg" name="alamat" id="alamat" placeholder="Enter address" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Enter password" required>
                    </div>
 
                    <button type="submit" class="btn btn-info btn-block btn-lg" name="registrasi">Create account</button><br>

                   <!-- Link login -->
                    <a href="login.php">Have account ?</a>

                </form>
            </div>
        </div>

    </div>

    <!-- JavaScript -->
    <!-- JavaScript bootstrap -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

</body>
</html>