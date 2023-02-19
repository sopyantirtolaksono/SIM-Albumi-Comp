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
        // jika status member non aktif
        if($pecahMember["status_member"] == "non active") {
            // alihkan ke halaman login
            echo "<script>location ='login.php';</script>";
            header('Location: login.php');
            $idM     = session_unset();
            exit();
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
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Albumi Comp - Contact</title>

    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <?php require "header.php"; ?>

    <!-- ##### Breadcrumb Area Start ##### -->
    <section class="breadcrumb-area bg-img bg-overlay" style="background-image: url(img/bg-img/23.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <!-- Breadcrumb Text -->
                <div class="col-12">
                    <div class="breadcrumb-text">
                        <h2>Contact</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Breadcrumb Area End ##### -->

    <!-- ##### Contact Area Start ##### -->
    <section class="contact-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="contact-content mb-100">
                                <a href="#" class="mb-50 d-block"><img src="img/core-img/logo.png" alt=""></a>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat.</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="contact-content mb-100">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque dignissim massa quis, mattis facilisis erat. Aliquam erat volutpat. Sed efficitur diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris velit arcu, scelerisque.</p>
                            </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="contact-content mb-100">
                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex align-items-center">
                                    <div class="title">
                                        <p>Address</p>
                                    </div>
                                    <p>Jalan Tentara Pelajar, Purin, Kendal Jateng Indonesia.</p>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex align-items-center">
                                    <div class="title">
                                        <p>Phone</p>
                                    </div>
                                    <p>+62 82 234 777 001</p>
                                </div>

                                <!-- Single Contact Info -->
                                <div class="single-contact-info d-flex align-items-center">
                                    <div class="title">
                                        <p>E-mail</p>
                                    </div>
                                    <p>albumicomp@gmail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <!-- Google Maps -->
                    <div class="map-area">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.716827002111!2d110.18003835003083!3d-6.924414194972341!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e705cf3f0455447%3A0xb3ae7526f88d5539!2sAl%20Bumi%20Laptop%20dan%20Komputer!5e0!3m2!1sid!2sid!4v1568821902032!5m2!1sid!2sid" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Contact Area End ##### -->

    <!-- Footer -->
    <?php require "footer.php"; ?>

    <!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
</body>

</html>