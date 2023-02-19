<?php 
    
    // jika member sudah login dan jika belum login 
    if(isset($_SESSION["member"])) {
        $akunMember = $_SESSION["member"]["id_member"];
    }
    else {
        $akunMember = session_unset();
    }

    // ambil data member yang login dari tabel member
    $result = $conn->query("SELECT * FROM member WHERE id_member = '$akunMember'"); 
    $row = $result->fetch_assoc();

    // jika tombol update profil ditekan
    if(isset($_POST["updateProfile"])) {
        // ambil data foto member
        $namaFoto   = $_FILES["fotoMember"]["name"];
        $lokasiFoto = $_FILES["fotoMember"]["tmp_name"];
        // buat nama foto baru
        $namaFotoBaru = uniqid();
        $namaFotoBaru .= "_".$namaFoto;
        // ambil data dari form
        $id           = $_POST["id"];
        $nama         = stripslashes($_POST["nama"]);
        $email        = $_POST["email"];
        $password     = mysqli_escape_string($conn, $_POST["password"]);
        $alamat       = $_POST["alamat"];
        $telepon      = $_POST["telepon"];
        $jenisKelamin = $_POST["jenis-kelamin"];

        // jika foto kosong/tidak upload foto
        if(empty($lokasiFoto)) {
            // jika password kosong dan jika ada password baru
            if(empty($password)) {
                // update data pada tabel member
                $conn->query("UPDATE member SET nama_member = '$nama', email_member = '$email', alamat_member = '$alamat', telepon_member = '$telepon', jenis_kelamin = '$jenisKelamin' WHERE id_member = '$id' ");
            }
            else {
                // enkripsi password member
                $password = password_hash($password, PASSWORD_DEFAULT);
                // update data pada tabel member
                $conn->query("UPDATE member SET nama_member = '$nama', email_member = '$email', password_member = '$password', alamat_member = '$alamat', telepon_member = '$telepon', jenis_kelamin = '$jenisKelamin' WHERE id_member = '$id' ");
            }
            
            // echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
        else {
            move_uploaded_file($lokasiFoto, "img/profile-img/" .$namaFotoBaru);

            // jika password kosong atau jika ada password baru
            if(empty($password)) {
                // update data pada tabel member
                $conn->query("UPDATE member SET nama_member = '$nama', email_member = '$email', alamat_member = '$alamat', telepon_member = '$telepon', jenis_kelamin = '$jenisKelamin', img_member = '$namaFotoBaru' WHERE id_member = '$id' ");
            }
            else {
                // enkripsi password member
                $password = password_hash($password, PASSWORD_DEFAULT);
                // update data pada tabel member
                $conn->query("UPDATE member SET nama_member = '$nama', email_member = '$email', password_member = '$password', alamat_member = '$alamat', telepon_member = '$telepon', jenis_kelamin = '$jenisKelamin', img_member = '$namaFotoBaru' WHERE id_member = '$id' ");
            }

            // echo "<meta http-equiv='refresh' content='1;url=index.php'>";
        }
    }

    // script pencarian data
    if(isset($_POST["btn-search"])) {
        // ambil data dari form pencarian
        $keyword = $_POST["top-search"];
        header("Location: search_review.php?k=$keyword");
        
    }

?>


<!-- ##### Header Area Start ##### -->
    <header class="header-area wow fadeInDown" data-wow-delay="500ms">
        <!-- Top Header Area -->
        <div class="top-header-area">
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Logo Area -->
                        <div class="logo">
                            <a href="index.php"><img src="img/core-img/logo.png" alt=""></a>
                        </div>

                        <!-- Search & Login Area -->
                        <div class="search-login-area d-flex align-items-center">
                            <!-- Top Search Area -->
                            <div class="top-search-area">
                                <form action="" method="post">
                                    <input type="search" name="top-search" placeholder="Search" autocomplete="off">
                                    <button type="submit" class="btn" name="btn-search"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!-- Login Area -->
                            <?php if(isset($_SESSION["member"])) : ?>
                                <div class="login-area">
                                    <a href="logout.php"><span>Logout</span> <i class="fa fa-lock" aria-hidden="true"></i></a>
                                </div>
                            <?php else : ?>
                                <div class="login-area">
                                    <a href="login.php" target="_blank"><span>Login / Register</span> <i class="fa fa-lock" aria-hidden="true"></i></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navbar Area -->
        <div class="egames-main-menu" id="sticker">
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
                    <!-- Menu -->
                    <nav class="classy-navbar justify-content-between" id="egamesNav">

                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- Close Button -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div class="classynav">
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="#">Choose Plane</a>
                                        <ul class="dropdown">
                                            <li>
                                                <a href="laptop_review.php?id=<?=base64_encode('1'); ?>">Gold Both</a>
                                            </li>
                                            <li>
                                                <a href="laptop_review.php?id=<?=base64_encode('2'); ?>">Silver Both</a>
                                            </li>
                                            <li>
                                                <a href="laptop_review.php?id=<?=base64_encode('3'); ?>">Bronze Both</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a href="contact.php">Contact</a></li>

                                    <?php if(isset($_SESSION["member"])) { ?>
                                    <li><a href="#">Account</a>
                                        <ul class="dropdown">
                                            <li><a href="#" data-target="#modalProfile" data-toggle="modal">Profile</a></li>
                                            <li><a href="#" data-target="#modalUpdateProfile" data-toggle="modal">Update Profile</a></li>
                                            <li><a href="history.php">History</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>

                                    <li>
                                        <?php if(empty($row["img_member"])) { ?>
                                        <img src="img/profile-img/face-0.jpg" class="rounded-circle" style="width: 45px; height: 45px;" alt="">
                                        <?php } else { ?>
                                        <img src="img/profile-img/<?=$row['img_member']; ?>" class="rounded-circle" style="width: 45px; height: 45px;" alt="">
                                        <?php } ?>
                                    </li>
                                    <?php } ?>

                                </ul>
                            </div>
                            <!-- Nav End -->
                        </div>

                        <!-- Top Social Info -->
                        <div class="top-social-info">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Behance"><i class="fa fa-behance" aria-hidden="true"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
<!-- ##### Header Area End ##### -->




<!-- Modal Profile -->
    <div class="modal fade" id="modalProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%">
                        <div>
                            <?php if(empty($row["img_member"])) : ?>
                                <div class="mt-3 rounded-circle bg-light" style="width:200px; height:200px; border:3px solid silver; margin:auto; background:url(img/profile-img/face-0.jpg) no-repeat center center/cover;">
                                </div>
                            <?php else: ?>
                                <div class="mt-3 rounded-circle bg-light" style="width:200px; height:200px; border:3px solid silver; margin:auto; background:url(img/profile-img/<?=$row["img_member"]; ?>) no-repeat center center/cover;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <h6 class="card-title">Name :</h6>
                            <p class="card-text"><?=$row["nama_member"]; ?></p>

                            <h6 class="card-title">Gender :</h6>
                            <?php if($row["jenis_kelamin"] == "pria") { ?>
                            <p class="card-text">Male</p>
                            <?php } else if($row["jenis_kelamin"] == "wanita") { ?>
                            <p class="card-text">Female</p>
                            <?php } ?>

                            <h6 class="card-title">Join Date :</h6>
                            <p class="card-text"><?=$row["tanggal_registrasi"]; ?></p>

                            <h6 class="card-title">Email :</h6>
                            <p class="card-text"><?=$row["email_member"]; ?></p>

                            <h6 class="card-title">Telephone :</h6>
                            <p class="card-text"><?=$row["telepon_member"]; ?></p>

                            <h6 class="card-title">Address :</h6>
                            <p class="card-text"><?=$row["alamat_member"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal Update Profile -->
    <div class="modal fade" id="modalUpdateProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card" style="width: 100%">
                        <div>
                            <?php if(empty($row["img_member"])) : ?>
                                <div class="mt-3 rounded-circle bg-light" style="width:200px; height:200px; border:3px solid silver; margin:auto; background:url(img/profile-img/face-0.jpg) no-repeat center center/cover;">
                                </div>
                            <?php else: ?>
                                <div class="mt-3 rounded-circle bg-light" style="width:200px; height:200px; border:3px solid silver; margin:auto; background:url(img/profile-img/<?=$row["img_member"]; ?>) no-repeat center center/cover;">
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group text-center">
                                  <label for="fotoMember">Photo Profile</label>
                                  <input type="file" id="fotoMember" name="fotoMember" style="width: 90px;">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id" value="<?=$row['id_member']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nama">Full name</label>
                                    <input type="text" class="form-control" name="nama" id="nama" value="<?=$row['nama_member']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenisKelamin">Gender</label>
                                    <select name="jenis-kelamin" class="form-control" id="jenisKelamin">
                                        <?php if($row["jenis_kelamin"] == "pria") { ?>
                                        <option value="<?=$row['jenis_kelamin']; ?>">Male</option>
                                        <?php } else if($row["jenis_kelamin"] == "wanita") { ?>
                                        <option value="<?=$row['jenis_kelamin']; ?>">Female</option>
                                        <?php } ?>

                                        <option value="pria">Male</option>
                                        <option value="wanita">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" name="email" id="email" value="<?=$row['email_member']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" name="password" id="password" placeholder="Type here for new password!">
                                </div>
                                <div class="form-group">
                                    <label for="telepon">Telephone</label>
                                    <input type="number" class="form-control" name="telepon" id="telepon" value="<?=$row['telepon_member']; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Address</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" value="<?=$row['alamat_member']; ?>" required>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><strong>Close</strong></button>
                    <button type="submit" class="btn btn-info" name="updateProfile"><strong>Save</strong></button><br>
                </div>
                            </form>
            </div>
        </div>
    </div>