
$(document).ready(function() {

  // ajax load untuk mencari data produk sesuai kategori produk
  $("select#cariKategori option").on("click", function() {
    let valCariKategori = $("select#cariKategori").val();
    $("#tableProdukLoad").load("dist/data-load/data_produk_load.php?id=" + valCariKategori);
  });

  // ajax load untuk mencari data foto galeri produk
  // Select Kategori
  $("select#selectKategori option").on("click", function() {
      let valSelectKategori = $("select#selectKategori").val();
      $("#optionLoad").load("dist/data-load/data_option_load.php?id=" + valSelectKategori);
  });
  // Select Produk
  $("select#selectProduk option").on("click", function() {
    let valSelectProduk = $("select#selectProduk").val();
    $("#tableFotoLoad").load("dist/data-load/data_foto_load.php?id=" + valSelectProduk);
  });

  // ajax load untuk mencari data klaim produk berdasarkan nama member
  $("#cariNamaMember").on("keyup", function() {
    let valNamaMember = $("#cariNamaMember").val();
    $("#tableKlaimLoad").load("dist/data-load/data_klaim_load.php?k=" + valNamaMember);
  });

  // ajax load untuk mencari data member
  $("#cariMember").on("keyup", function() {
    let valMember = $("#cariMember").val();
    $("#tableMemberLoad").load("dist/data-load/data_member_load.php?k=" + valMember);
  });

});