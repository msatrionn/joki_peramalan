$(document).on("click", "#btn-edit-barang", function () {
  $(".modal-body #id_barang").val($(this).data("id_barang"));
  $(".modal-body #kode_barang").val($(this).data("kode_barang"));
  $(".modal-body #nama_barang").val($(this).data("nama_barang"));
  $(".modal-body #satuan").val($(this).data("satuan"));
});
$(document).on("click", "#btn-hapus-barang", function () {
  $(".modal-footer #id_barang").val($(this).data("id_barang"));
});
$(document).on("click", "#btn-edit-pemesanan", function () {
  $(".modal-body #id_pemesanan").val($(this).data("id_pemesanan"));
  $(".modal-body #id_barang").val($(this).data("id_barang"));
  $(".modal-body #tanggal_rekap").val($(this).data("tanggal_rekap"));
  $(".modal-body #total_barang").val($(this).data("total_barang"));
});
$(document).on("click", "#btn-hapus-pemesanan", function () {
  $(".modal-footer #id_pemesanan").val($(this).data("id_pemesanan"));
});
$(document).on("click", "#btn-hapus-peramalan", function () {
  $(".modal-footer #id_peramalan").val($(this).data("id_peramalan"));
});
