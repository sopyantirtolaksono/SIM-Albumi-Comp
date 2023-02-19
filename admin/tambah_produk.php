<?php

  // jika tombol submit ditekan
  if(isset($_POST["submit"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto"]["name"];
    $lokasiFoto = $_FILES["foto"]["tmp_name"];

    // ambil nama ekstensinya
    $namaEkstensi = pathinfo($namaFoto, PATHINFO_EXTENSION);
    // cek apakah format foto valid / invalid
    if( $namaEkstensi == "jpg" || 
        $namaEkstensi == "JPG" || 
        $namaEkstensi == "png" || 
        $namaEkstensi == "PNG" ||
        $namaEkstensi == "jpeg" ||
        $namaEkstensi == "JPEG" ) {
        
        // aktifkan uniqid
        $uniqId = uniqid();
        // buat nama foto baru
        $namaFotoBaru = $uniqId."_".$namaFoto;
        // pindahkan foto dari lokasi sementara ke folder img produk
        move_uploaded_file($lokasiFoto, "dist/img-produk/" .$namaFotoBaru);

        // ambil data dari form
        $nama       = $_POST["nama"];
        $harga      = $_POST["harga"];
        $berat      = $_POST["berat"];
        $stok       = $_POST["stok"];
        $kategori   = $_POST["kategori"];
        $deskripsi  = $_POST["deskripsi"];
        $ux         = $_POST["ux"];
        $design     = $_POST["design"];
        $solution   = $_POST["solution"];
        $price      = $_POST["price"];
        $foto       = $namaFotoBaru;

        // masukkan data produk baru ke dalam tabel produk
        $conn->query("INSERT INTO produk (nama_produk, harga_produk, berat_produk, stok_produk, foto_produk, deskripsi_produk, id_kategori, nilai_ux, nilai_desain, nilai_solusi, nilai_harga) VALUES ('$nama', '$harga', '$berat', '$stok', '$foto', '$deskripsi', '$kategori', '$ux', '$design', '$solution', '$price') ");
        // tampilkan pesan dan alihkan kehalaman tambah produk
        echo "<script>alert('Data berhasil ditambahkan!')</script>";
        echo "<script>location ='index.php?halaman=tambah_produk';</script>";

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
    Tambah Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> Produk</li>
    <li class="active">Tambah Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
          <div class="box box-primary">

            <div class="box-header with-border">
              <h3 class="box-title">Produk Baru</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="namaProduk">Nama Produk</label>
                      <input type="text" class="form-control" id="namaProduk" name="nama" placeholder="Nama produk" required>
                    </div>
                    <div class="form-group">
                      <label for="hargaProduk">Harga Produk</label>
                      <input type="number" class="form-control" id="hargaProduk" name="harga" placeholder="Harga produk" required>
                    </div>
                    <div class="form-group">
                      <label for="beratProduk">Berat Produk</label>
                      <input type="number" class="form-control" id="beratProduk" name="berat" placeholder="Berat produk" required>
                    </div>
                    <div class="form-group">
                      <label for="stokProduk">Stok Produk</label>
                      <input type="number" class="form-control" id="stokProduk" name="stok" placeholder="Stok produk" required>
                    </div>

                    <div class="form-group">
                      <label>Kategori Produk</label>
                      <select class="form-control" name="kategori">
                        <?php $ambil = $conn->query("SELECT * FROM kategori"); ?>
                        <?php while($pecah = $ambil->fetch_assoc()) { ?>
                          <option value="<?=$pecah['id_kategori']; ?>"><?=$pecah["kategori_produk"]; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    
                  </div>

                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="ux">User Xperience</label>
                      <input type="number" class="form-control" id="ux" name="ux" placeholder="User xperience" required>
                    </div>
                    <div class="form-group">
                      <label for="design">Design</label>
                      <input type="number" class="form-control" id="design" name="design" placeholder="Design" required>
                    </div><div class="form-group">
                      <label for="solution">Solution</label>
                      <input type="number" class="form-control" id="solution" name="solution" placeholder="Solution" required>
                    </div><div class="form-group">
                      <label for="price">Price</label>
                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                    </div>
                    
                  </div>
                </div>

                <div class="form-group">
                  <label for="deskripsi">Deskripsi </label>
                  <textarea id="deskripsi" name="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi produk" required></textarea>
                </div>
                <div class="form-group">
                  <label for="fotoProduk">Foto Produk</label>
                  <input type="file" id="fotoProduk" name="foto" required>

                  <em><p class="help-block text-red">*Masukkan file berupa gambar</p></em>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-send"></i> Submit</button>
                <a href="index.php?halaman=produk" class="btn btn-default"><i class="fa fa-close"></i> Batal</a>
              </div>

            </form>
          </div>
          <!-- /.box -->
		</div>
	</div>
</section>