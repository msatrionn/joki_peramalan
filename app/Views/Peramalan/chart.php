  <html>

  <head>
      <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
          google.charts.load('current', {
              'packages': ['corechart']
          });
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {
              var data = google.visualization.arrayToDataTable([
                  ['Month', 'Forecasting'],
                  ['January', 1000],
                  ['February', 1170],
                  ['Maret', 660],
                  ['April', 1030]
              ]);

              var options = {
                  title: 'Peramalan',
                  curveType: 'function',
                  legend: {
                      position: 'bottom'
                  }
              };

              var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

              chart.draw(data, options);
          }
      </script>
  </head>

  <body>
      <div class="col-md-12">
          <div style="margin:0 auto;">
              <form action="<?= base_url('chart/lihat_chart') ?>" method="post">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12" style="width: 100%;">
                              <div class="card shadow">
                                  <div class="container" style="padding: 10px;">
                                      <div class="row col-md-12">
                                          <div class="form-group col-md-4">
                                              <label for="">Dari bulan </label>
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

                                          <div class="form-group col-md-4">
                                              <label for="">Sampai </label>
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
                                          <div class="form-group col-md-4">
                                              <label for="">Tahun</label>
                                              <input type="text" name="tahun" placeholder="masukkan tahun" class="form-control" maxlength="4">
                                          </div>
                                      </div>
                                      <div class="row col-md-12">
                                          <!-- <div class="form-group col-md-4">
                                              <label for="">Alpha</label>
                                              <input type="text" name="alpha" class="form-control" required>
                                          </div>
                                          <div class="form-group col-md-4">
                                              <label for="">Beta</label>
                                              <input type="text" name="beta" class="form-control" required>
                                          </div> -->
                                          <div class="form-group col-md-4">
                                              <label for="">Barang</label>
                                              <select name="id_barang" id="" class="form-control">
                                                  <?php foreach ($cek_barang->getResultArray() as $item) : ?>
                                                      <option value="<?= $item['id_barang'] ?>"><?= $item['nama_barang'] ?></option>
                                                  <?php endforeach ?>
                                              </select>
                                          </div>
                                          <div class="form-group col-md-2" style="text-align: center;">
                                              <label for=""><i class="fa fa-search"></i></label>
                                              <button type="submit" class="btn btn-success">Lihat</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </form>
              <div class="card shadow">
                  <div class="table-responsive">
                      <table>
                          <div id="curve_chart" style="width: 90%;"></div>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </body>

  </html>