<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- /.container-fluid -->
    <div class="card shadow m-4">
        <div class="card-body">
            <div class="table-responsive">
                <?php
                if (session()->get('message')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        data pemesanan berhasil <strong><?= session()->getFlashdata('message'); ?></strong>
                    </div>
                <?php endif; ?>
                <div class="row" style="max-width: 100%;">
                    <div class="col-md-2">
                        <h1 class="h3 mb-4 text-gray-800" style="width: 300px;">Tabel <?= $judul; ?></h1>
                    </div>
                    <div class="col-md-4 ml-auto " style="display: flex;margin-right: 50px;">
                        <div>
                            <a href="<?= base_url('peramalan/view_ramal') ?>" class="btn btn-primary">Ramal</a><br><br>
                        </div>
                        <div style="display: flex; align-items: center;margin-bottom: 20px;margin-right: 120px ;">
                            <span style="margin-right: 5px;margin-left: 10px;">Cari</span><input type=" text" id="myCustomSearchBox" class="form-control pencarian">
                        </div>
                    </div>
                </div>
                <table class="table table-light" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary" style="color: #fff;">
                            <th>no</th>
                            <th>Nama barang</th>
                            <th>Bulan</th>
                            <th>Alpha</th>
                            <th>Beta</th>
                            <th>Level</th>
                            <th>Trend</th>
                            <th>Nilai Ramal</th>
                            <th>mad</th>
                            <th>mape</th>
                            <th>aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($peramalan->getResultArray() as $row) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $row['nama_barang']; ?></td>
                                <td><?= $row['bulan_peramalan']; ?></td>
                                <td><?= $row['alpha']; ?></td>
                                <td><?= $row['beta']; ?></td>
                                <td><?= $row['level']; ?></td>
                                <td><?= $row['trend']; ?></td>
                                <td><?= $row['nilai_ramal']; ?></td>
                                <td><?= $row['mad']; ?></td>
                                <td><?= $row['mape']; ?></td>
                                <td>
                                    <button type="button" id="btn-hapus-peramalan" data-toggle="modal" data-target="#modelHapus" class="btn btn-sm btn-danger" data-id_peramalan="<?= $row['id_peramalan'] ?>">
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
<!-- End of Main Content -->

<!-- Modal Hapus -->
<div class="modal fade" id="modelHapus">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                Apakah Anda Yakin Akan Menghapus?
            </div>
            <div class="modal-footer">
                <i type="button" class="btn btn-secondary" data-dismiss="modal">Close</i>
                <form action="<?= base_url('/peramalan/hapus/') ?>" method="post">
                    <input type="hidden" name="id_peramalan" id="id_peramalan">
                    <button type="submit" name="hapus" class="btn btn-primary">hapus Data</button>
                </form>
            </div>
        </div>
    </div>
</div>