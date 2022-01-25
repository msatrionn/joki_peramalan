<!-- Begin Page Content -->
<?php $session = session() ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <!-- Page Heading -->
                <?php if (session()->get('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        data barang berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
                    </div>
                <?php endif; ?>
                <div class="row" style="max-width: 100%;">
                    <div class="col-md-6">
                        <h1 class="h3 mb-4 text-gray-800" style="width: 200px;">Tabel <?= $judul; ?></h1>
                    </div>
                    <div class="col-md-4 ml-auto " style="display: flex;margin-right: 50px;">
                        <div>
                            <button type="button" data-toggle="modal" class="btn btn-success" data-target="#modelTambah">Tambah</button><br><br>
                        </div>
                        <div style="display: flex; align-items: center;margin-bottom: 20px;margin-right: 120px ;">
                            <span style="margin-right: 5px;margin-left: 10px;">Cari</span><input type=" text" id="myCustomSearchBox" class="form-control pencarian">
                        </div>
                    </div>
                </div>
                <table class="table table-light" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary" style="color: #fff;">
                            <th>Nomor</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Satuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($barang->getResultArray() as $row) : ?>

                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['kode_barang'] ?></td>
                                <td><?= $row['nama_barang'] ?></td>
                                <td><?= $row['satuan'] ?></td>
                                <td>
                                    <button type="button" id="btn-edit-barang" data-toggle="modal" data-target="#modelEdit" class="btn btn-sm btn-warning" data-id_barang="<?= $row['id_barang'] ?>" data-kode_barang="<?= $row['kode_barang'] ?>" data-nama_barang="<?= $row['nama_barang'] ?>" data-satuan="<?= $row['satuan'] ?>">
                                        <i class=" fa fa-edit"></i>
                                    </button>
                                    <button type="button" id="btn-hapus-barang" data-toggle="modal" data-target="#modelHapus" class="btn btn-sm btn-danger" data-id_barang="<?= $row['id_barang'] ?>">
                                        <i class="fa fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


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
                        <label for="kode_barang"></label>
                        <input type="text" maxlength="20" name="kode_barang" id="kode_barang" class="form-control" placeholder="masukan kode barang" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_barang"></label>
                        <input type="text" maxlength="40" name="nama_barang" id="nama_barang" class="form-control" placeholder="masukan nama barang" required>
                    </div>
                    <div class="form-group">
                        <label for="satuan"></label>
                        <input type="text" maxlength="20" name="satuan" id="satuan" class="form-control" placeholder="masukan satuan barang" required>
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
                <form action="<?= base_url('/barang/hapus/') ?>" method="post">
                    <input type="hidden" name="id_barang" id="id_barang">
                    <button type="submit" name="hapus" class="btn btn-primary">hapus Data</button>
                </form>
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
                <?php if (empty($row)) { ?>

                <?php } else { ?>

                    <form action="<?= base_url('barang/ubah') ?>" method="post">
                        <input type="hidden" name="id_barang" id="id_barang">
                        <div class="form-group">
                            <label for="kode_barang"></label>
                            <input type="text" maxlength="20" name="kode_barang" id="kode_barang" class="form-control" placeholder="masukan kode barang" value="<?= $row['kode_barang'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama_barang"></label>
                            <input type="text" maxlength="40" name="nama_barang" id="nama_barang" class="form-control" placeholder="masukan nama barang" value="<?= $row['nama_barang'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="satuan"></label>
                            <input type="text" maxlength="20" name="satuan" id="satuan" class="form-control" placeholder="masukan satuan barang" value="<?= $row['satuan'] ?>">
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="ubah" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        <?php } ?>
        </div>
    </div>
</div>