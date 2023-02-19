<?php 

	// jika tombol simpan foto ditekan
	if(isset($_POST["simpan"])) {
		// ambil id produk yang dipilih
		$id_produk 	= $_POST["id_produk"];
		// hitung jumlah foto yang dipilih
		$jumlah 	= count($_FILES["foto"]["name"]);

		// jika tidak ada produk yang dipilih
		if($id_produk == 0) {
			echo "<script>alert('Anda harus pilih produk dahulu!')</script>";
			echo "<script>location ='index.php?halaman=tambah_foto';</script>";
			exit();
		}

		// jika foto yang dipilih ada 5
		if($jumlah == 5) {
			$gambar = array();
			// lakukan looping
			for ($i = 0; $i < $jumlah; $i++) { 
				$namaFile 		= $_FILES["foto"]["name"][$i];
				$lokasiFile 	= $_FILES["foto"]["tmp_name"][$i];
				$namaFileBaru 	= uniqid();
				$namaFile 		= $namaFileBaru.".jpg";
				// $namaFileBaru .= "-". $namaFile;
				// pindahkan foto dari lokasi sementara ke folder img gallery
				move_uploaded_file($lokasiFile, "dist/img-gallery/". $namaFile);
				// masukkan setiap nama foto baru yang sudah dibuat ke variabel foto 
				$foto[$i] = $namaFile;
			}
			// masukkan semua foto yang dipilih ke dalam tabel foto
			mysqli_query($conn, "INSERT INTO foto VALUES('', '$id_produk', '$foto[0]', '$foto[1]', '$foto[2]', '$foto[3]', '$foto[4]')");
			// tampilkan pesan
			echo "<script>alert('Upload foto berhasil!')</script>";
		}
		// jika foto yang dipilih kurang dari 5
		else if($jumlah < 5 ) {
			echo "<script>alert('Harus 5 foto!')</script>";
		}
		// jika foto yang dipilih lebih dari 5
		else if($jumlah > 5) {
			echo "<script>alert('Harus 5 foto!')</script>";
		}
		// selain itu gagal upload atau foto kosong
		else {
			echo "<script>alert('Gagal upload/foto kosong!')</script>";
		}
	}

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Tambah Foto Galeri
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> Produk</li>
    <li class="active">Tambah Foto Galeri</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  	<div class="row">
    	<!-- left column -->
    	<div class="col-md-3">
			<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
				  <h3 class="box-title">Foto Galeri Produk</h3><br><br>
				  <div class="row">
	                <div class="col-md-12">
	                  <div class="form-group">
	                    <label>Kategori Produk</label>
	                    <select class="form-control select1" id="selectKategori" style="width: 100%;">
	                    	<?php 
	                    		$ambilKategori = $conn->query("SELECT * FROM kategori");
	                    		while($pecahKategori = $ambilKategori->fetch_assoc()) {
	                    	?>
	                      	<option value="<?=$pecahKategori['id_kategori']; ?>"><?=$pecahKategori["kategori_produk"]; ?></option>
	                  		<?php } ?>
	                    </select>
	                  </div>
	                </div>
	              </div>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="" method="post" enctype="multipart/form-data">
				  <div class="box-body">
				  	<div class="form-group">
	                    <label>Pilih Produk</label>
	                    <div id="optionLoad">
	                    <select class="form-control select2" name="id_produk" id="selectProduk" style="width: 100%;">
	                    		<option value="0">Pilih produk dahulu!</option>
	                    	<?php $ambil = $conn->query("SELECT * FROM produk ORDER BY id_produk DESC"); ?>
	                    	<?php while($pecah = $ambil->fetch_assoc()) { ?>
		                      	<option value="<?=$pecah['id_produk']; ?>"><?=$pecah["nama_produk"]; ?></option>
	                  		<?php } ?>
	                    </select>
	                    </div>
	                </div>
				    <div class="form-group">
				      <label for="exampleInputFile">File input</label>
				      <input type="file" multiple="multiple" name="foto[]" id="exampleInputFile" required>
				      <em><p class="help-block text-red">*Harus 5 foto!</p></em>
				    </div>
				  </div>
				  <!-- /.box-body -->

				  <div class="box-footer">
				    <button type="submit" class="btn btn-primary" id="btnSimpanFoto" name="simpan"><i class="fa fa-send"></i> Submit</button>
				  </div>
				</form>
			</div>
			<!-- /.box -->
		</div>

		<!-- right column -->
    	<div class="col-md-9">
    		<div class="box box-primary">
    			<div id="tableFotoLoad">
	    		<div class="box-body">

					<div class="row margin-bottom">

						<?php $ambilFoto = $conn->query("SELECT * FROM foto ORDER BY id_foto DESC LIMIT 0,1"); ?>
						<?php while($pecahFoto = $ambilFoto->fetch_assoc()) { ?>

	                    <div class="col-sm-6">
	                      <img class="img-responsive" src="dist/img-gallery/<?=$pecahFoto["foto1"]; ?>" alt="Photo">
	                    </div>
	                    <!-- /.col -->
	                    <div class="col-sm-6">
	                      <div class="row">
	                        <div class="col-sm-6">
	                          <img class="img-responsive" src="dist/img-gallery/<?=$pecahFoto["foto2"]; ?>" alt="Photo">
	                          <br>
	                          <img class="img-responsive" src="dist/img-gallery/<?=$pecahFoto["foto3"]; ?>" alt="Photo">
	                        </div>
	                        <!-- /.col -->
	                        <div class="col-sm-6">
	                          <img class="img-responsive" src="dist/img-gallery/<?=$pecahFoto["foto4"]; ?>" alt="Photo">
	                          <br>
	                          <img class="img-responsive" src="dist/img-gallery/<?=$pecahFoto["foto5"]; ?>" alt="Photo">
	                        </div>
	                        <!-- /.col -->
	                      </div>
	                      <!-- /.row -->
	                    </div>
	                    <!-- /.col -->

						<?php } ?>

	                </div>
	                <!-- /.row -->

	    		</div>
	    		</div>
    		</div>
		</div>


	</div>
</section>