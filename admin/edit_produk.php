<?php

  // jika tombol submit ditekan
  if(isset($_POST["submit"])) {
    // ambil foto dari form
    $namaFoto   = $_FILES["foto"]["name"];
    $namaLokasi = $_FILES["foto"]["tmp_name"];
    // buat nama foto baru dengan uniqid
    $uniqId = uniqid();
    $namaFotoBaru = $uniqId ."_". $namaFoto;
    // ambil semua data pada form
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

    // jika ada foto yang diupdate
    if(!empty($namaLokasi)) {

      // ambil nama ekstensinya
      $namaEkstensi = pathinfo($namaFoto, PATHINFO_EXTENSION);
      // cek apakah format foto valid / invalid
      if( $namaEkstensi == "jpg" || 
          $namaEkstensi == "JPG" || 
          $namaEkstensi == "png" || 
          $namaEkstensi == "PNG" ||
          $namaEkstensi == "jpeg" ||
          $namaEkstensi == "JPEG" ) {

        // pindahkan foto dari lokasi sementara ke folder img produk
        move_uploaded_file($namaLokasi, "dist/img-produk/" .$namaFotoBaru);
        // update data pada tabel produk dengan data baru yang ada diform
        $conn->query("UPDATE produk SET nama_produk = '$nama', harga_produk = '$harga', berat_produk = '$berat', stok_produk = '$stok', foto_produk = '$foto', deskripsi_produk = '$deskripsi', id_kategori = '$kategori', nilai_ux = '$ux', nilai_desain = '$design', nilai_solusi = '$solution', nilai_harga = '$price' WHERE id_produk = '$_GET[id]'");
        // tampilkan pesan dan alihkan kehalaman produk
        echo "<script>alert('Data berhasil diupdate!')</script>";
        echo "<script>location ='index.php?halaman=produk';</script>";

      }
      else {
        // jika foto invalid
        echo "<script>alert('Maaf, gambar tidak valid!')</script>";
      }
     
    }
    else {

      // update data pada tabel produk dengan data baru yang ada diform
      $conn->query("UPDATE produk SET nama_produk = '$nama', harga_produk = '$harga', berat_produk = '$berat', stok_produk = '$stok', deskripsi_produk = '$deskripsi', id_kategori = '$kategori', nilai_ux = '$ux', nilai_desain = '$design', nilai_solusi = '$solution', nilai_harga = '$price' WHERE id_produk = '$_GET[id]'");
      // tampilkan pesan dan alihkan kehalaman produk
      echo "<script>alert('Data berhasil diupdate!')</script>";
      echo "<script>location ='index.php?halaman=produk';</script>";

    }

  }
  
?>

<!-- ambil id_produk dari url -->
<?php $idProduk = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori WHERE produk.id_produk = '$_GET[id]'"); ?>
<?php $produkSatuan = $idProduk->fetch_assoc(); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Edit Produk
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> Produk</li>
    <li>Data Tabel</li>
    <li class="active">Edit Produk</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Data</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" enctype="multipart/form-data" role="form">
              <div class="box-body">

                <div class="row">
                  <div class="col-md-6">
                    
                    <div class="form-group">
                      <label for="namaProduk">Nama Produk</label>
                      <input type="text" class="form-control" id="namaProduk" name="nama" placeholder="Nama produk" value="<?=$produkSatuan['nama_produk']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="hargaProduk">Harga Produk</label>
                      <input type="number" class="form-control" id="hargaProduk" name="harga" placeholder="Harga produk" value="<?=$produkSatuan['harga_produk']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="beratProduk">Berat Produk</label>
                      <input type="number" class="form-control" id="beratProduk" name="berat" placeholder="Berat produk" value="<?=$produkSatuan['berat_produk']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="stokProduk">Stok Produk</label>
                      <input type="number" class="form-control" id="stokProduk" name="stok" placeholder="Stok produk" value="<?=$produkSatuan['stok_produk']; ?>" required>
                    </div>

                    <div class="form-group">
                      <label>Kategori Produk</label>
                      <select class="form-control" name="kategori">
                        <option value="<?=$produkSatuan['id_kategori']; ?>"><?=$produkSatuan['kategori_produk']; ?></option>
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
                      <input type="number" class="form-control" id="ux" name="ux" placeholder="User xperience" value="<?=$produkSatuan['nilai_ux']; ?>" required>
                    </div>
                    <div class="form-group">
                      <label for="design">Design</label>
                      <input type="number" class="form-control" id="design" name="design" placeholder="Design" value="<?=$produkSatuan['nilai_desain']; ?>" required>
                    </div><div class="form-group">
                      <label for="solution">Solution</label>
                      <input type="number" class="form-control" id="solution" name="solution" placeholder="Solution" value="<?=$produkSatuan['nilai_solusi']; ?>" required>
                    </div><div class="form-group">
                      <label for="price">Price</label>
                      <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="<?=$produkSatuan['nilai_harga']; ?>" required>
                    </div>

                  </div>
                </div>  

                <div class="form-group">
                  <label for="deskripsi">Deskripsi </label>
                  <textarea id="deskripsi" name="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi produk" required><?=$produkSatuan['deskripsi_produk']; ?></textarea>
                </div>
                <div class="form-group">
                  <img src="dist/img-produk/<?=$produkSatuan['foto_produk']; ?>" class="img-thumbnail" alt="Foto Produk Lama." width="200" height="150">
                </div>
                <div class="form-group">
                  <label for="fotoProduk">Foto Produk</label>
                  <input type="file" id="fotoProduk" name="foto">

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