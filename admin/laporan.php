<?php
    
    // deklarasikan array variabel kosong
    $semuaData      = array();
    $tgl_mulai      = '-';
    $tgl_selesai    = '-';

    // cek jika tombol cari ditekan
    if(isset($_POST['kirim'])) {
        $statusKlaim    = $_POST['status-klaim'];
        $tgl_mulai      = $_POST['tglm'];
        $tgl_selesai    = $_POST['tgls'];

        $ambil = $conn->query("SELECT * FROM klaim kl LEFT JOIN member mb ON kl.id_member = mb.id_member WHERE tanggal_klaim BETWEEN '$tgl_mulai' AND '$tgl_selesai' AND status_klaim = '$statusKlaim' ");

        while($pecah = $ambil->fetch_assoc()) {
            $semuaData[] = $pecah;
        }
    }

?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Laporan
    <small>Preview</small>
  </h1>
  <ol class="breadcrumb">
    <li class="active"><i class="fa fa-file"></i> Laporan</a></li>
  </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Laporan klaim dari <?=$tgl_mulai; ?> hingga <?=$tgl_selesai; ?></h3>
                </div>

                <div class="box-body">
                    <form action="" method="post">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="status-klaim" value="confirmed" checked>
                                      Klaim terkonfirmasi
                                    </label>&nbsp;&nbsp;
                                    <label>
                                      <input type="radio" name="status-klaim" value="pending">
                                      Klaim belum terkonfirmasi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tglm" value='<?=$tgl_mulai; ?>'>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tgls" value='<?=$tgl_selesai; ?>'>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label>&nbsp;</label> <br>
                                <button class="btn btn-primary" name="kirim"><i class="fa fa-search"></i>  Lihat</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Member</th>
                                    <th>Tanggal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = 0; ?>
                                <?php foreach($semuaData as $key => $value) : ?>
                                <?php $total += $value['total_harga']; ?>
                                <tr>
                                    <td><?=$key+1; ?></td>
                                    <td><?=$value['nama_member']; ?></td>
                                    <td><?=$value['tanggal_klaim']; ?></td>
                                    <td>Rp. <?=number_format($value['total_harga']); ?></td>

                                    <?php if($value['status_klaim'] == 'pending') : ?>
                                    <td><span class="label label-warning"><?=$value['status_klaim']; ?></span></td>
                                    <?php else: ?>
                                    <td><span class="label label-success"><?=$value['status_klaim']; ?></span></td>
                                    <?php endif; ?>

                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3">Total :</th>
                                    <th>Rp. <?=number_format($total); ?></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>