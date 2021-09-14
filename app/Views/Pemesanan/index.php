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
                    <th>id pemesanan</th>
                    <th>id barang</th>
                    <th>Id pemesanan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>jumlah barang</th>
                    <th>aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($pemesanan->getResultArray() as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['id_pemesanan']; ?></td>
                            <td><?= $row['id_barang']; ?></td>
                            <td><?= $row['id_rekap']; ?></td>
                            <td><?= $row['tanggal_pemesanan']; ?></td>
                            <td><?= $row['jumlah_barang']; ?></td>
                            <td>
                                <button type="button" id="btn-edit-barang" data-toggle="modal" data-target="#modelEdit" class="btn btn-sm btn-warning" data-id_pemesanan="<?= $row['id_pemesanan'] ?>" data-id_barang="<?= $row['id_barang'] ?>" data-id_rekap="<?= $row['id_rekap'] ?>" data-tanggal_pemesanan="<?= $row['tanggal_pemesanan'] ?>" data-jumlah_barang="<?= $row['jumlah_barang'] ?>">
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
                <form action="<?= base_url('pemesanan/tambah') ?>" method="post">
                    <div class="form-group">
                        <label for="id_pemesanan"></label>
                        <input type="text" name="id_pemesanan" id="id_pemesanan" class="form-control" placeholder="masukan id pemesanan">
                    </div>
                    <div class="form-group">
                        <label for="id_barang"></label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="masukan id barang">
                    </div>
                    <div class="form-group">
                        <label for="id_rekap"></label>
                        <input type="text" name="id_rekap" id="id_rekap" class="form-control" placeholder="masukan id rekap">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pemesanan"></label>
                        <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" placeholder="masukan tanggal pemesanan">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang"></label>
                        <input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control" placeholder="masukan jumlah perbulan">
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
                <a href="/pemesanan/hapus/<?= $row['id_pemesanan']; ?>" type="button" class="btn btn-danger">Yakin</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal ubah -->
<div class="modal fade" id="modelEdit">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah <?= $judul; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pemesanan/ubah') ?>" method="post">
                    <div class="form-group">
                        <label for="id_pemesanan"></label>
                        <input type="text" name="id_pemesanan" id="id_pemesanan" class="form-control" placeholder="masukan id pemesanan" value="<?= $row['id_pemesanan'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_barang"></label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="masukan id barang" value="<?= $row['id_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="id_rekap"></label>
                        <input type="text" name="id_rekap" id="id_rekap" class="form-control" placeholder="masukan id pemesanan" value="<?= $row['id_rekap'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_pemesanan"></label>
                        <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" placeholder="masukan tanggal pemesanan" value="<?= $row['tanggal_pemesanan'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="jumlah_barang"></label>
                        <input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control" placeholder="masukan jumlah perbulan" value="<?= $row['jumlah_barang'] ?>">
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