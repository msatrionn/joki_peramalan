<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_peramalan;
use DateTime;

class Chart extends BaseController
{
    public function __construct()
    {
        $this->model = new M_peramalan;
        $this->session = session();
    }
    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $data = [
            'judul' => 'Dashboard',
            'cek_barang' => $this->model->barang()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('peramalan/chart', $data);
        echo view('templates/v_footer');
    }
    public function lihat_chart()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $data = [
            'dari' => $this->request->getPost('dari'),
            'sampai' => $this->request->getPost('sampai'),
            'id_barang' => $this->request->getPost('id_barang'),
            'tahun' => $this->request->getPost('tahun')
        ];
        // dd($data);
        $success =
            [
                $this->model->hitung_ramal($data),
                $this->model->bulan($data),
                $this->model->ramal($data),
                $this->model->detail_barang($data),
                $this->model->hitung_barang($data),
            ];
        if ($success) {

            $alpha = 0.2;
            $beta = 0.2;
            $ambil = $this->model->hitung_ramal($data);
            // dd($ambil->getResult());
            $cek_barang = $this->model->barang();
            $detail_barang = $this->model->detail_barang($data);
            $cek_bulan = $this->model->bulan($data);
            $nama_awal_bulan = $cek_bulan[0];
            $nama_akhir_bulan = $cek_bulan[1];
            $brg = $this->model->hitung_barang($data);
            $barangs = $brg;
            $total = count($ambil->getResult());
            // dd($barang->total_amount);
            foreach ($ambil->getResultArray() as $key => $value) {
                $barang[] = $value['total_amount'];
            }
            foreach ($ambil->getResultArray() as $key => $value) {
                $perbulan[] = $value['month'];
                // dd($perbulan);
                // $perbulan[] = DateTime::createFromFormat('!m', $value['month'])->format('F');
                // $val[] = DateTime::createFromFormat('!m', $value['month'])->format('F');
                // $sampai[] = $val;
            }
            // echo ($perbulan);

            // print_r($barang[2]);
            // print_r($cek);
            // dd($total);
            switch ($total) {
                case '0':

                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        'level' => 'Bulan ini kekurangan data',
                        'trend' => 'Bulan ini kekurangan data',
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => null,
                        'forecasting' => 'tidak ada hasil',
                        'mape' => 'tidak ada hasil',
                        'judul' => 'Dashboard'

                    ];

                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '1':
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        'level' => 'Bulan ini kekurangan data',
                        'trend' => 'Bulan ini kekurangan data',
                        'forecasting' => 'tidak ada hasil',
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => null,
                        'mape' => 'tidak ada hasil'

                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '2':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $forecasting2 = $level2 + $trend2;
                    // dd($barang[1]);
                    $forecasting['forecast'] = [$barang[0], $forecasting2];
                    $mape2 = 100 * ($barang[1] - $forecasting2) / $barang[1];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        'judul' => 'Dashboard',
                        'level' => $level2,
                        'trend' => $trend2,
                        'forecasting' => $forecasting2,
                        'mape' => $mape2,
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'pemesanan' => $this->model->ramal($data)
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '3':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $mape3 = ($barang[2] - $forecasting3) / $barang[2];
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level3,
                        'trend' => $trend3,
                        'mape' => $mape3,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting3
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '4':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $forecasting4 = $level3 + $trend3;
                    $mape4 = ($barang[3] - $forecasting4) / $barang[3];
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4];

                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        'judul' => 'Dashboard',
                        'level' => $level4,
                        'trend' => $trend4,
                        'forecasting' => $forecasting4,
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'mape' => $mape4,
                        'pemesanan' => $this->model->ramal($data)
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '5':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $forecasting5 = $level4 + $trend4;
                    $mape5 = ($barang[4] - $forecasting5) / $barang[4];
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    // dd($barang[3]);

                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        'judul' => 'Dashboard',
                        'level' => $level5,
                        'trend' => $trend5,
                        'forecasting' => $forecasting5,
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'mape' => $mape5,
                        'pemesanan' => $this->model->ramal($data)
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '6':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $forecasting6 = $level5 + $trend5;
                    $mape6 = ($barang[5] - $forecasting6) / $barang[5];
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    // dd($forecasting6);
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level6,
                        'trend' => $trend6,
                        'forecasting' => $forecasting6,
                        'mape' => $mape6,
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'pemesanan' => $this->model->ramal($data)
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '7':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $forecasting7 = $level6 + $trend6;
                    $mape7 = ($barang[6] - $forecasting7) / $barang[6];
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level7,
                        'trend' => $trend7,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting7,
                        'mape' => $mape7
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '8':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $level8 = ($alpha * $barang[7]) + ((1 - $alpha) * ($level7 + $trend7));
                    $trend8 = $beta * ($level8 - $level7) + (1 - $beta) * $trend7;
                    $forecasting2 = $level2 + $trend2;

                    // dd($alpha, $barang[1]);
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting8 = $level8 + $trend8;
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7, $forecasting8];

                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level8,
                        'trend' => $trend8,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',

                        'forecasting' => $forecasting8,
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        // [
                        //     'perbul'=>$perbulan, 
                        //     'for'=>$forecasting['forecast']],
                        // 'perbulan' => $perbulan,
                    ];
                    // dd($data['forecast_chart']);
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '9':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $level8 = ($alpha * $barang[7]) + ((1 - $alpha) * ($level7 + $trend7));
                    $trend8 = $beta * ($level8 - $level7) + (1 - $beta) * $trend7;
                    $level9 = ($alpha * $barang[8]) + ((1 - $alpha) * ($level8 + $trend8));
                    $trend9 = $beta * ($level9 - $level8) + (1 - $beta) * $trend8;
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting8 = $level8 + $trend8;
                    $forecasting9 = $level9 + $trend9;
                    $mape9 = ($barang[8] - $forecasting9) / $barang[8];
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7, $forecasting8, $forecasting9];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level9,
                        'trend' => $trend9,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting9,
                        'mape' => $mape9
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '10':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $level8 = ($alpha * $barang[7]) + ((1 - $alpha) * ($level7 + $trend7));
                    $trend8 = $beta * ($level8 - $level7) + (1 - $beta) * $trend7;
                    $level9 = ($alpha * $barang[8]) + ((1 - $alpha) * ($level8 + $trend8));
                    $trend9 = $beta * ($level9 - $level8) + (1 - $beta) * $trend8;
                    $level10 = ($alpha * $barang[9]) + ((1 - $alpha) * ($level9 + $trend9));
                    $trend10 = $beta * ($level10 - $level9) + (1 - $beta) * $trend9;
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting8 = $level8 + $trend8;
                    $forecasting9 = $level9 + $trend9;
                    $forecasting10 = $level10 + $trend10;
                    $mape10 = ($barang[9] - $forecasting10) / $barang[9];
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7, $forecasting8, $forecasting9, $forecasting10];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level10,
                        'trend' => $trend10,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting10,
                        'mape' => $mape10
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '11':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $level8 = ($alpha * $barang[7]) + ((1 - $alpha) * ($level7 + $trend7));
                    $trend8 = $beta * ($level8 - $level7) + (1 - $beta) * $trend7;
                    $level9 = ($alpha * $barang[8]) + ((1 - $alpha) * ($level8 + $trend8));
                    $trend9 = $beta * ($level9 - $level8) + (1 - $beta) * $trend8;
                    $level10 = ($alpha * $barang[9]) + ((1 - $alpha) * ($level9 + $trend9));
                    $trend10 = $beta * ($level10 - $level9) + (1 - $beta) * $trend9;
                    $level11 = ($alpha * $barang[10]) + ((1 - $alpha) * ($level10 + $trend10));
                    $trend11 = $beta * ($level11 - $level10) + (1 - $beta) * $trend10;
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting8 = $level8 + $trend8;
                    $forecasting9 = $level9 + $trend9;
                    $forecasting10 = $level10 + $trend10;
                    $forecasting11 = $level11 + $trend11;
                    $mape11 = ($barang[10] - $forecasting11) / $barang[10];
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7, $forecasting8, $forecasting9, $forecasting10, $forecasting11];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level11,
                        'trend' => $trend11,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting11,
                        'mape' => $mape11
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;
                case '12':
                    $level2 = ($alpha * $barang[1]) + ((1 - $alpha) * ($barang[0] + ($barang[1] - $barang[0])));
                    $trend2 = $beta * ($level2 - $barang[0]) + (1 - $beta) * ($barang[1] - $barang[0]);
                    $level3 = ($alpha * $barang[2]) + ((1 - $alpha) * ($level2 + $trend2));
                    $trend3 = $beta * ($level3 - $level2) + (1 - $beta) * $trend2;
                    $level4 = ($alpha * $barang[3]) + ((1 - $alpha) * ($level3 + $trend3));
                    $trend4 = $beta * ($level4 - $level3) + (1 - $beta) * $trend3;
                    $level5 = ($alpha * $barang[4]) + ((1 - $alpha) * ($level4 + $trend4));
                    $trend5 = $beta * ($level5 - $level4) + (1 - $beta) * $trend4;
                    $level6 = ($alpha * $barang[5]) + ((1 - $alpha) * ($level5 + $trend5));
                    $trend6 = $beta * ($level6 - $level5) + (1 - $beta) * $trend5;
                    $level7 = ($alpha * $barang[6]) + ((1 - $alpha) * ($level6 + $trend6));
                    $trend7 = $beta * ($level7 - $level6) + (1 - $beta) * $trend6;
                    $level8 = ($alpha * $barang[7]) + ((1 - $alpha) * ($level7 + $trend7));
                    $trend8 = $beta * ($level8 - $level7) + (1 - $beta) * $trend7;
                    $level9 = ($alpha * $barang[8]) + ((1 - $alpha) * ($level8 + $trend8));
                    $trend9 = $beta * ($level9 - $level8) + (1 - $beta) * $trend8;
                    $level10 = ($alpha * $barang[9]) + ((1 - $alpha) * ($level9 + $trend9));
                    $trend10 = $beta * ($level10 - $level9) + (1 - $beta) * $trend9;
                    $level11 = ($alpha * $barang[10]) + ((1 - $alpha) * ($level10 + $trend10));
                    $trend11 = $beta * ($level11 - $level10) + (1 - $beta) * $trend10;
                    $level12 = ($alpha * $barang[11]) + ((1 - $alpha) * ($level11 + $trend11));
                    $trend12 = $beta * ($level12 - $level11) + (1 - $beta) * $trend11;
                    $forecasting2 = $level2 + $trend2;
                    $forecasting3 = $level3 + $trend3;
                    $forecasting4 = $level4 + $trend4;
                    $forecasting5 = $level5 + $trend5;
                    $forecasting6 = $level6 + $trend6;
                    $forecasting7 = $level7 + $trend7;
                    $forecasting8 = $level8 + $trend8;
                    $forecasting9 = $level9 + $trend9;
                    $forecasting10 = $level10 + $trend10;
                    $forecasting11 = $level11 + $trend11;
                    $forecasting12 = $level12 + $trend12;
                    $mape12 = ($barang[11] - $forecasting12) / $barang[11];
                    $forecasting['forecast'] = [$barang[0], $forecasting2, $forecasting3, $forecasting4, $forecasting5, $forecasting6, $forecasting7, $forecasting8, $forecasting9, $forecasting10, $forecasting11, $forecasting12];
                    $data = [
                        'cek_barang' => $cek_barang,
                        'detail_barang' => $detail_barang,
                        'nama_awal_bulan' => $nama_awal_bulan,
                        'nama_akhir_bulan' => $nama_akhir_bulan,
                        'dari' => $this->request->getPost('dari'),
                        'sampai' => $this->request->getPost('sampai'),
                        'id_barang' => $this->request->getPost('id_barang'),
                        'tahun' => $this->request->getPost('tahun'),
                        'alpha' => $alpha = $this->request->getPost('alpha'),
                        'beta' => $beta = $this->request->getPost('beta'),
                        // 'judul' => 'Barang',
                        'level' => $level12,
                        'trend' => $trend12,
                        'pemesanan' => $this->model->ramal($data),
                        'judul' => 'Dashboard',
                        'forecast_chart' => [
                            'item' => $perbulan,
                            'item2' => $forecasting['forecast']
                        ],
                        'forecasting' => $forecasting12,
                        'mape' => $mape12
                    ];
                    echo view('templates/v_header', $data);
                    echo view('templates/v_sidebar');
                    echo view('templates/v_topbar');
                    echo view('peramalan/lihat_chart', $data);
                    echo view('templates/v_footer');
                    break;

                default:
                    echo 'Batas peramalan 12 bulan';
                    break;
            }
        }
    }
}
