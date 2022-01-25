<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow m-4">
                <div class="card-body">
                    <form action="<?= base_url('peramalan/hitung_ramal') ?>" method="post">
                        <div class="form-group">
                            <label for="">Nama Barang</label>
                            <select name="id_barang" id="" class="form-control">
                                <?php foreach ($detail_barang->getResultArray() as $item) : ?>
                                    <option value="<?= $item['id_barang'] ?>"><?= $item['nama_barang'] ?> <i>(dipilih)</i> </option>
                                <?php endforeach ?>
                                <?php foreach ($cek_barang->getResultArray() as $item) : ?>
                                    <option value="<?= $item['id_barang'] ?>"><?= $item['nama_barang'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <!-- <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">alpha</label>
                                <input type="text" name="alpha" class="form-control" value="<?= $alpha ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">beta</label>
                                <input type="text" name="beta" class="form-control" value="<?= $beta ?>">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Dari Bulan</label>
                                <select name="dari" id="" class="form-control">
                                    <option value="<?= $dari ?>"><?= $nama_awal_bulan ?></option>
                                    <option value="1">Januari</option>
                                    <option value="2">februari</option>
                                    <option value="3">maret</option>
                                    <option value="4">april</option>
                                    <option value="5">mei</option>
                                    <option value="6">juni</option>
                                    <option value="7">juli</option>
                                    <option value="8">agustus</option>
                                    <option value="9">september</option>
                                    <option value="10">oktober</option>
                                    <option value="11">november</option>
                                    <option value="12">desember</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Sampai Bulan</label>
                                <select name="sampai" id="" class="form-control">
                                    <option value="<?= $sampai ?>"><?= $nama_akhir_bulan ?></option>
                                    <option value="1">Januari</option>
                                    <option value="2">februari</option>
                                    <option value="3">maret</option>
                                    <option value="4">april</option>
                                    <option value="5">mei</option>
                                    <option value="6">juni</option>
                                    <option value="7">juli</option>
                                    <option value="8">agustus</option>
                                    <option value="9">september</option>
                                    <option value="10">oktober</option>
                                    <option value="11">november</option>
                                    <option value="12">desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="text" name="tahun" placeholder="masukkan tahun" class="form-control" maxlength="4" value="<?= $tahun ?>">
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary">Ramal</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow m-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-light" id="table_ramal" width="100%" cellspacing="0">
                            <thead>
                                <tr class="bg-primary" style="color: #fff;">
                                    <th>no</th>
                                    <th>Bulan rekap</th>
                                    <th>nama barang</th>
                                    <th>total barang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($pemesanan->getResultArray() as $row) : ?>
                                    <tr>
                                        <td scope="row">
                                            <?= $i; ?>
                                        </td>
                                        <td>

                                            <?= DateTime::createFromFormat('!m', $row['month'])->format('F'); ?>
                                            <?= $row['year']; ?>
                                        </td>
                                        <td>
                                            <?= $row['nama_barang']; ?>
                                        </td>
                                        <td>
                                            <?= $row['total_amount']; ?>
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
    </div>
    <br>
    <div class="card" style="text-align:center">
        <div class="card-body">
            <div class="form-group">
                <form action="<?= base_url('peramalan/tambah') ?>" method="post">
                    <input type="hidden" name="id_pemesanan">
                    <?php foreach ($detail_barang->getResultArray() as $item) : ?>
                        <input type="hidden" name="nama_barang" value="<?= $item['nama_barang'] ?>">
                    <?php endforeach ?>
                    <input type="hidden" name="alpha" class="form-control" value="<?= $alpha ?>">
                    <input type="hidden" name="beta" class="form-control" value="<?= $beta ?>">
                    <input type="hidden" name="dari" value="<?= $dari ?>">
                    <input type="hidden" name="sampai" value="<?= $sampai ?>">
                    <input type="hidden" name="tahun" placeholder="masukkan tahun" class="form-control" maxlength="4" value="<?= $tahun ?>">

                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="">Level</label>
                            <input type="text" name="level" class="form-control" value="<?= $level ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Trend</label>
                            <input type="text" name="trend" class="form-control" value="<?= $trend ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai Ramal</label>
                            <input type="text" name="ramal" class="form-control" value="<?= $forecasting ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">MAD</label>
                            <input type="text" name="mad" class="form-control" value="<?= $mad ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">MAPE</label>
                            <input type="text" name="mape" class="form-control" value="<?= $mape ?>">
                        </div>
                        <div class="form-group col-md-2">
                            <label for=""><i class="fa fa-sync"></i></label>
                            <a href="<?= base_url('peramalan/view_ramal') ?>" class="form-control btn btn-primary">Ulang</a>
                            <label for=""><i class="fa fa-save"></i></label>
                            <button class="form-control btn btn-success">Simpan</button>
                        </div>
                </form>
            </div>
            <div class="form-group col-md-1"></div>
        </div>
    </div>
</div>
</div>
</div>