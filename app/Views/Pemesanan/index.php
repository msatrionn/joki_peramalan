<!-- Begin Page Content -->
<?php $session = session() ?>
<div class="container-fluid">
    <div class="card shadow m-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                if (session()->get('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        data penjualan berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
                    </div>
                <?php endif; ?>
                <div class="row" style="max-width: 100%;">
                    <div class="col-md-2">
                        <h1 class="h3 mb-4 text-gray-800" style="width: 300px;">Tabel <?= $judul; ?></h1>
                    </div>
                    <div class="col-md-4 ml-auto " style="display: flex;margin-right: 50px;">
                        <div>
                            <button type="button" data-toggle="modal" class="btn btn-success" data-target="#modelTambah">Tambah</button><br><br>
                        </div>
                        <div style="display: flex; align-items: center;margin-bottom: 20px;margin-right: 120px ;">
                            <span style="margin-right: 5px;margin-left: 10px;">Cari</span><input type=" text" id="myCustomSearchBox" class="form-control pencarian" style="color: red;" placeholder="cari">
                        </div>
                    </div>
                </div>
                <table class="table table-light" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary" style="color: #fff;">
                            <th>no</th>
                            <th>Nama Barang</th>
                            <th>Tanggal Penjualan</th>
                            <th>Jumlah Barang</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan->getResultArray() as $row) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $row['nama_barang']; ?></td>
                                <td><?= $row['tanggal_rekap']; ?></td>
                                <td><?= $row['total_barang']; ?></td>
                                <td>
                                    <button type="button" id="btn-edit-pemesanan" data-toggle="modal" data-target="#modelEdit" class="btn btn-sm btn-warning" data-id_pemesanan="<?= $row['id_pemesanan'] ?>" data-id_barang="<?= $row['id_barang'] ?>" data-tanggal_rekap="<?= $row['tanggal_rekap'] ?>" data-total_barang="<?= $row['total_barang'] ?>">
                                        <i class=" fa fa-edit"></i>
                                    </button>
                                    <button type="button" id="btn-hapus-pemesanan" data-toggle="modal" data-target="#modelHapus" class="btn btn-sm btn-danger" data-id_pemesanan="<?= $row['id_pemesanan'] ?>">
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


</div>
<!-- /.container-fluid -->


<!-- Modal tambah -->
<div class="modal fade" id="modelTambah">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('pemesanan/tambah') ?>" method="post">

                    <div class="form-group">
                        <label for="id_barang">Nama Barang</label>
                        <select name="id_barang" id="id_barang" class="form-control" placeholder="masukan id barang">
                            <?php foreach ($barang->getResultArray() as $item) : ?>
                                <option value="<?= $item['id_barang']  ?>"><?= $item['nama_barang']  ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_rekap">Tanggal Pemesanan</label>
                        <input type="date" name="tanggal_rekap" id="tanggal_rekap" class="form-control" placeholder="masukan tanggal pemesanan" required>
                    </div>
                    <div class="form-group">
                        <label for="total_barang">Jumlah Barang</label>
                        <input type="number" name="total_barang" id="total_barang" class="form-control" placeholder="masukan jumlah barang" required>
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
                <form action="<?= base_url('/pemesanan/hapus/') ?>" method="post">
                    <input type="hidden" name="id_pemesanan" id="id_pemesanan">
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
                <h5 class="modal-title">Ubah </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if (empty($row)) { ?>
                <?php } else { ?>
                    <form action="<?= base_url('pemesanan/ubah') ?>" method="post">
                        <input type="hidden" name="id_pemesanan" id="id_pemesanan">
                        <div class="form-group">
                            <label for="id_barang">Nama Barang</label>
                            <select name="id_barang" id="id_barang" class="form-control" placeholder="masukan id barang">
                                <option id="id_barang"><?= $row['nama_barang']  ?></option>
                                <?php foreach ($barang->getResultArray() as $item) : ?>
                                    <option value="<?= $item['id_barang']  ?>"><?= $item['nama_barang']  ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_rekap"></label>
                            <input type="date" name="tanggal_rekap" id="tanggal_rekap" class="form-control" placeholder="masukan nama barang" value="<?= $row['tanggal_rekap'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="total_barang"></label>
                            <input type="number" name="total_barang" id="total_barang" class="form-control" placeholder="masukan total barang" value="<?= $row['total_barang'] ?>" required>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
            </div>
            </form>
        <?php } ?>
        </div>
    </div>
</div>