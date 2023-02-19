<?php

    // jika tombol submit ditekan
    if(isset($_POST["btn-submit"])) {
        // ambil data dari form
        $namaFile   = $_FILES["gambar-gift"]["name"];
        $lokasiFile = $_FILES["gambar-gift"]["tmp_name"];

        // ambil nama ekstensinya
        $namaEkstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
        // cek apakah format foto valid / invalid
        if( $namaEkstensi == "jpg" || 
            $namaEkstensi == "JPG" || 
            $namaEkstensi == "png" || 
            $namaEkstensi == "PNG" ||
            $namaEkstensi == "jpeg" ||
            $namaEkstensi == "JPEG" ) {

            $namaGift   = $_POST["nama-gift"];
            $pointGift  = $_POST["point-gift"];

            // buat nama baru untuk gambar
            $namaFileBaru = uniqid();
            $namaFileBaru .= "-" .$namaFile;
            // pindahkan gambar dari lokasi sementara ke folder
            move_uploaded_file($lokasiFile, "dist/img-gift/" .$namaFileBaru);

            // masukkan data baru pada tabel gift
            $conn->query("INSERT INTO gift (nama_gift, point_gift, gambar_gift) VALUES ('$namaGift', '$pointGift', '$namaFileBaru') ");

            // tampilkan pesan dan alihkan ke halaman gift
            echo "<script>alert('Data berhasil ditambahkan.')</script>";
            echo "<script>location ='index.php?halaman=gift';</script>";

        }
        else {
            // jika foto invalid
            echo "<script>alert('Maaf, gambar tidak valid!')</script>";
        }

    }

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Gift
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-gift"></i> Gift</li>
  </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Tambah Gift</h3>
                </div>

                <div class="box-body">
                    <div class="row">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="col-md-3">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama-gift" placeholder="Nama gift" required>
                            </div>
                            <div class="col-md-3">
                                <label>Point</label>
                                <input type="number" class="form-control" name="point-gift" placeholder="Point gift" required>
                            </div>
                            <div class="col-md-3">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar-gift" placeholder="Gambar gift" required>
                            </div>
                            <div class="col-md-3">
                                <label>&nbsp;</label> <br>
                                <button type="submit" class="btn btn-primary" name="btn-submit"><i class="fa fa-send"></i> Submit</button>
                            </div>
                        </form>
                    </div>    
                </div>

            </div>
        </div>

        <?php 
            $ambilGift = $conn->query("SELECT * FROM gift ORDER BY id_gift DESC");
            while($pecahGift = $ambilGift->fetch_assoc()) {
        ?>
        <div class="col-md-3">
            <div class="box box-primary">

                <div class="box-body box-profile">

                    <div class="bg-gift-img" style="background-image: url(dist/img-gift/<?=$pecahGift['gambar_gift']; ?>); background-repeat: no-repeat; background-size: cover; background-position: center; height: 25vh; margin-bottom: 15px;">        
                    </div>
                    
                    <h3 class="profile-username text-center"><?=$pecahGift["nama_gift"]; ?></h3>

                    <p class="text-muted text-center"><span class="label label-danger"><?=$pecahGift["point_gift"]; ?> Point</span></p>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-6" style="padding: 0 5px 0 15px;">
                            <a href="index.php?halaman=edit_gift&id=<?=$pecahGift['id_gift']; ?>" class="btn btn-block"><b><i class="fa fa-edit"></i> Edit</b></a>
                        </div>
                        <div class="col-md-6" style="padding: 0 15px 0 5px;">
                            <a href="index.php?halaman=hapus_gift&id=<?=$pecahGift['id_gift']; ?>" class="btn btn-block" onclick="return confirm('Yakin ingin hapus data?');"><b><i class="fa fa-trash"></i> Hapus</b></a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <?php } ?>

    </div>
</section>