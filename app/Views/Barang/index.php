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
                    <th>id barang</th>
                    <th>kode barang</th>
                    <th>nama barang</th>
                    <th>satuan</th>
                    <th>aksi</th>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($barang->getResultArray() as $row) : ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['id_barang']; ?></td>
                            <td><?= $row['kode_barang']; ?></td>
                            <td><?= $row['nama_barang']; ?></td>
                            <td><?= $row['satuan']; ?></td>
                            <td>
                                <button type="button" id="btn-edit-barang" data-toggle="modal" data-target="#modelEdit" class="btn btn-sm btn-warning" data-id_barang="<?= $row['id_barang'] ?>" data-kode_barang="<?= $row['kode_barang'] ?>" data-nama_barang="<?= $row['nama_barang'] ?>" data-satuan="<?= $row['satuan'] ?>">
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
                <form action="<?= base_url('barang/tambah') ?>" method="post">
                    <div class="form-group">
                        <label for="id_barang"></label>
                        <input type="text" name="id_barang" id="id_barang" class="form-control" placeholder="masukan id barang">
                    </div>
                    <div class="form-group">
                        <label for="kode_barang"></label>
                        <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="masukan kode barang">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang"></label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="masukan nama barang">
                    </div>
                    <div class="form-group">
                        <label for="satuan"></label>
                        <input type="text" name="satuan" id="satuan" class="form-control" placeholder="masukan satuan barang">
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
                <a href="/barang/hapus/<?= $row['id_barang']; ?>" type="button" class="btn btn-danger">Yakin</a>
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
                <form action="<?= base_url('barang/ubah') ?>" method="post">
                    <input type="text" name="id_barang" id="id_barang">
                    <div class="form-group">
                        <label for="kode_barang"></label>
                        <input type="text" name="kode_barang" id="kode_barang" class="form-control" placeholder="masukan kode barang" value="<?= $row['kode_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="nama_barang"></label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" placeholder="masukan nama barang" value="<?= $row['nama_barang'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="satuan"></label>
                        <input type="text" name="satuan" id="satuan" class="form-control" placeholder="masukan satuan barang" value="<?= $row['satuan'] ?>">
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