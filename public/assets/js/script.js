$(document).on('click', '#btn-edit-barang', function(){
    $('.modal-body #id_barang').val($(this).data('id_barang'));
    $('.modal-body #kode_barang').val($(this).data('kode_barang'));
    $('.modal-body #nama_barang').val($(this).data('nama_barang'));
    $('.modal-body #satuan').val($(this).data('satuan'));
})
$(document).on('click', '#btn-edit-rekap', function(){
    $('.modal-body #id_rekap').val($(this).data('id_rekap'));
    $('.modal-body #id_barang').val($(this).data('id_barang'));
    $('.modal-body #tanggal_rekap').val($(this).data('tanggal_rekap'));
    $('.modal-body #jumlah_perbulan').val($(this).data('jumlah_perbulan'));
})