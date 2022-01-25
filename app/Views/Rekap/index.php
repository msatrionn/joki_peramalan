<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $judul; ?></h1>
    <?php if (session()->get('message')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            data barang berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
        </div>
    <?php endif; ?>
    <div class="card text-white">
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelTambah">
                Tambah data
            </button>

            <table class="table table-striped">
                <thead>
                    <th>no</th>
                    <th>id rekap</th>
                    <th>nama barang</th>
                    <th>tanggal rekap</th>
                    <th>jumlah perbulan</th>
                    <th>aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($rekap_pemesanan->getResultArray() as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['id_rekap']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['tanggal_rekap']; ?></td>
                            <td><?= $row['jumlah_perbulan']; ?></td>
                            <td>
                                <button type="button" id="btn-edit-rekap" data-toggle="modal" data-target="#modelEdit" class="btn btn-sm btn-warning" data-id_rekap="<?= $row['id_rekap'] ?>" data-id_barang="<?= $row['id_barang'] ?>" data-tanggal_rekap="<?= $row['tanggal_rekap'] ?>" data-jumlah_perbulan="<?= $row['jumlah_perbulan'] ?>">
                                    <i class=" fa fa-edit"></i>
                                </button>
                                <button type="button" data-toggle="modal" data-target="#modelHapus" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal tambah -->
<div class="modal fade" id="modelTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('rekap/tambah') ?>" method="post">
                    <div class="form-group">
                        <label for="id_rekap"></label>
                        <input type="text" name="id_rekap" id="id_rekap" class="form-control" placeholder="masukan id rekap">
                    </div>
                    <div class="form-group">
                        <label for="id_barang"></label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="masukan id_barang">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_rekap"></label>
                        <input type="date" name="tanggal_rekap" id="tanggal_rekap" class="form-control" placeholder="masukan tanggal rekap">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_perbulan"></label>
                        <input type="text" name="jumlah_perbulan" id="jumlah_perbulan" class="form-control" placeholder="masukan jumlah perbulan">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Hapus -->
<div class="modal fade" id="modelHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin Akan Menghapus?
            </div>
            <div class="modal-footer">
                <i type="button" class="btn btn-secondary" data-dismiss="modal">Close</i>
                <a href="/rekap/hapus/<?= $row['id_rekap']; ?>" type="button" class="btn btn-danger">Yakin</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal ubah -->
<div class="modal fade" id="modelEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('rekap/ubah') ?>" method="post">
                    <input type="text" name="id_rekap" id="id_rekap">
                    <div class="form-group">
                        <label for="id_barang"></label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="masukan kode barang" value="<?= $row['id_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_rekap"></label>
                        <input type="date" name="tanggal_rekap" id="tanggal_rekap" class="form-control" placeholder="masukan nama barang" value="<?= $row['tanggal_rekap'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_perbulan"></label>
                        <input type="text" name="jumlah_perbulan" id="jumlah_perbulan" class="form-control" placeholder="masukan jumlah_perbulan barang" value="<?= $row['jumlah_perbulan'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        </div>
    </div>
</div>