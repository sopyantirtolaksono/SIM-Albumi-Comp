
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Data Tabel
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li><i class="fa fa-cube"></i> Produk</li>
    <li class="active">Data Tabel</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Semua Produk</h3><br><br>
              <div class="row">
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Cari Kategori Produk</label>
                    <select class="form-control select2" id="cariKategori" style="width: 100%;">
                      <?php 
                        $ambilKategori = $conn->query("SELECT * FROM kategori");
                        while($pecahKategori = $ambilKategori->fetch_assoc()) {
                      ?>
                        <option id="optKatProduk" value="<?=$pecahKategori['id_kategori']; ?>"><?=$pecahKategori["kategori_produk"]; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div id="tableProdukLoad">
            <div class="box-body table-responsive">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Berat</th>
                  <th class="text-center">Stok</th>
                  <th class="text-center">kategori</th>
                  <th class="text-center" width="20%">Deskripsi</th>
                  <th class="text-center">Foto</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>

                <tbody>
                <?php $no = 1; ?>
                <?php $ambil = $conn->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY produk.id_produk DESC"); ?>
                <?php while($pecah = $ambil->fetch_assoc()) { ?>
                <tr>
                  <td><?=$no; ?></td>
                  <td><?=$pecah["nama_produk"]; ?></td>
                  <td>Rp. <?=number_format($pecah["harga_produk"]); ?></td>
                  <td><?=$pecah["berat_produk"]; ?> Gr</td>
                  <td><?=$pecah["stok_produk"]; ?></td>
                  <td><?=$pecah["kategori_produk"]; ?></td>
                  <td width="20%"><?=$pecah["deskripsi_produk"]; ?></td>
                  <td><img src="dist/img-produk/<?=$pecah['foto_produk']; ?>" class="img-thumbnail" alt="Gambar Produk." width="100" height="70"></td>
                  <td>
                    <a href="index.php?halaman=edit_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
                    <a href="index.php?halaman=hapus_produk&id=<?=$pecah['id_produk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus data?')"><i class="fa fa-trash"></i></a>
                  </td>
                </tr>
                <?php $no++; ?>
                <?php } ?>
                </tbody>

                <tfoot>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Harga</th>
                  <th class="text-center">Berat</th>
                  <th class="text-center">Stok</th>
                  <th class="text-center">kategori</th>
                  <th class="text-center" width="20%">Deskripsi</th>
                  <th class="text-center">Foto</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
            </div>
            <!-- /.tableLoad -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->