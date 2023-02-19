<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Selalu Siaga Melayani
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?=date("Y"); ?> <a href="index.php?halaman=dashboard">Albumi Comp</a>.</strong> Computer Store
  </footer>

</div>
<!-- ./wrapper -->



<!-- REQUIRED JS SCRIPTS -->

<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- Search Script -->
<script src="dist/js/search_script.js"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->


<!-- PHP CODE -->
<?php 

  // settingan utk data chart laporan bulanan (LINE CHART)
  $thnSekarang = date("Y");
  $dataBulan = [];
  $dataTotLap = [];
  $ambilLaporan = $conn->query("SELECT * FROM laporan WHERE tahun_laporan = '$thnSekarang' ");
  while($pecahLaporan = $ambilLaporan->fetch_assoc()) {

    $dataBulan[] = $pecahLaporan["bulan_laporan"];
    $dataTotLap[] = intval($pecahLaporan["total_laporan"]);

  }

  // settingan utk data kategori produk yang ter klaim/ter konfirmasi/favorit (PIE CHART)
  // data kategori gold
  $ambilKatGold = $conn->query("SELECT * FROM kategori WHERE kategori_produk = 'gold' ");
  $pecahKatGold = $ambilKatGold->fetch_assoc();
  $jmlDataKatGold = $pecahKatGold["jumlah_favorit"];

  // data kategori silver
  $ambilKatSilver = $conn->query("SELECT * FROM kategori WHERE kategori_produk = 'silver' ");
  $pecahKatSilver = $ambilKatSilver->fetch_assoc();
  $jmlDataKatSilver = $pecahKatSilver["jumlah_favorit"];

  // data kategori bronze
  $ambilKatBronze = $conn->query("SELECT * FROM kategori WHERE kategori_produk = 'bronze' ");
  $pecahKatBronze = $ambilKatBronze->fetch_assoc();
  $jmlDataKatBronze = $pecahKatBronze["jumlah_favorit"];

?>


<!-- JAVASCRIPT CODE -->
<script>

  // LINE CHART
  // script untuk set data chart laporan bulanan 
  var lineChartData = {
    labels : <?=json_encode($dataBulan) ?>,
    datasets : [
      {
        label: "My First dataset",
        fillColor : "rgba(121,174,234,0.5)",
        strokeColor : "rgba(220,220,220,1)",
        pointColor : "rgba(220,220,220,1)",
        pointStrokeColor : "#fff",
        pointHighlightFill : "#fff",
        pointHighlightStroke : "rgba(220,220,220,1)",
        data : <?=json_encode($dataTotLap); ?>
      }
    ]

  }

  // PIE CHART
  // script untuk menampilkan data produk yang di klaim
  var pieData = [
    {
      value: <?=$jmlDataKatGold; ?>,
      color:"rgba(254,216,1,1)",
      highlight: "rgba(254,216,1,.7)",
      label: "Gold"
    },
    {
      value: <?=$jmlDataKatSilver; ?>,
      color: "rgba(192,192,192,1)",
      highlight: "rgba(192,192,192,.7)",
      label: "Silver"
    },
    {
      value: <?=$jmlDataKatBronze; ?>,
      color: "rgba(182,107,107,1)",
      highlight: "rgba(182,107,107,.7)",
      label: "Bronze"
    }

  ];

  //  function untuk line chart dan pie chart
  window.onload = function() {

    var ctxLine = document.getElementById("canvas-line").getContext("2d");
    window.myLine = new Chart(ctxLine).Line(lineChartData, {
      responsive: true
    });

    var ctxPie = document.getElementById("canvas-pie").getContext("2d");
    window.myPie = new Chart(ctxPie).Pie(pieData);

  }

</script>

</body>
</html>