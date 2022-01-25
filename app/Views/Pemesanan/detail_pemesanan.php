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
                <div class="row" style="max-width: 100%; padding-top: 10px;">
                    <div class="col-md-7">
                        <h1 class="h3 mb-4 text-gray-800" style="width: 350px;">Tabel <?= $judul; ?></h1>
                        <form action="<?= site_url('pemesanan/rekap') ?>" method="POST">
                            <div class="row">
                                <select name="barang" id="" class="form-control col-md-4 ml-4 mb-3">
                                    <option value="<?= $barang_now ?>" selected aria-readonly="true"><?= $barang_now ?></option>
                                    <option value="Semua">Semua</option>
                                    <?php foreach ($barang->getResultArray() as $barang) : ?>
                                        <option value="<?= $barang['nama_barang'] ?>"><?= $barang['nama_barang'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm col-md-1 mb-3">Filter</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4 ml-auto " style="display: flex;margin-right: 50px;">
                        <div style="display: flex; align-items: center;margin-bottom: 20px;margin-right: 120px ;">
                            <span style="margin-right: 5px;margin-left: 10px;">Cari</span><input type=" text" id="myCustomSearchBox" class="form-control pencarian">
                        </div>
                    </div>
                </div>
                <table class="table table-light" id="table_id" width="100%" cellspacing="0">
                    <thead>
                        <tr class="bg-primary" style="color: #fff;">
                            <th>no</th>
                            <th>Bulan rekap</th>
                            <th>nama barang</th>
                            <th>total barang</th>
                            <th>satuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pemesanan->getResultArray() as $row) : ?>
                            <tr>
                                <td scope="row"><?= $i; ?></td>
                                <td><?= $row['month']; ?> <?= $row['year']; ?></td>
                                <td><?= $row['nama_barang']; ?></td>
                                <td><?= $row['total_amount']; ?></td>
                                <td><?= $row['satuan']; ?></td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>