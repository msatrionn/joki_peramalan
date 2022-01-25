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
                                <?php foreach ($barang->getResultArray() as $item) : ?>
                                    <option value="<?= $item['id_barang'] ?>"><?= $item['nama_barang'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
<!--                         <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">alpha</label>
                                <input type="text" name="alpha" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">beta</label>
                                <input type="text" name="beta" class="form-control">
                            </div>
                        </div> -->
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Dari Bulan</label>
                                <select name="dari" id="" class="form-control">
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
                                <input type="text" name="tahun" placeholder="masukkan tahun" class="form-control" maxlength="4">
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

                                <tr>
                                    <td scope="row">
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>

                                </tr>

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
                    <?php foreach ($barang->getResultArray() as $item) : ?>
                        <input type="hidden" name="nama_barang" value="<?= $item['nama_barang'] ?>">
                    <?php endforeach ?>
                    <input type="hidden" name="alpha" class="form-control">
                    <input type="hidden" name="beta" class="form-control">
                    <input type="hidden" name="dari">
                    <input type="hidden" name="sampai">
                    <input type="hidden" name="tahun" placeholder="masukkan tahun" class="form-control" maxlength="4">

                    <div class="row">
                        <div class="form-group col-md-1"></div>
                        <div class="form-group col-md-2">
                            <label for="">Level</label>
                            <input type="text" name="level" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Trend</label>
                            <input type="text" name="trend" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">Nilai Ramal</label>
                            <input type="text" name="ramal" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">MAD</label>
                            <input type="text" name="mad" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="">MAPE</label>
                            <input type="text" name="mape" class="form-control" disabled>
                        </div>
                        <div class="form-group col-md-1"></div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
</div>