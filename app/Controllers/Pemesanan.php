<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pemesanan;

class Pemesanan extends Controller
{
    public function __construct()
    {
        $this->session = session();
        $this->model = new M_pemesanan;
    }
    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'judul' => 'Penjualan',
            'pemesanan' => $this->model->getAllData(),
            'barang' => $this->model->getBarang()
        ];
        // $barang['barang'] =  $this->model->getBarang();
        // foreach ($data as $key => $value) {
        //     $tanggal=$value['tanggal_pemesanan'];
        // }
        // echo $tanggal;
        // $myDateTime = DateTime::createFromFormat('Y-m-d', $weddingdate);
        // dd($data['barang']->getResultArray());
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('Pemesanan/index', $data);
        echo view('templates/v_footer');
    }
    public function rekap()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $barang = $this->request->getPost('barang');

        $data = [
            'judul' => 'Rekap Penjualan',
            'pemesanan' => $this->model->pemesanan($barang),
            'barang' => $this->model->pemesanan_barang(),
            'barang_now' => $barang
        ];

        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('Pemesanan/detail_pemesanan', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'tanggal_rekap' => $this->request->getPost('tanggal_rekap'),
            'total_barang' => $this->request->getPost('total_barang')
        ];
        // dd($this->request->getPost());
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('pemesanan'));
        }
    }
    public function hapus()
    {
        $id = $this->request->getPost('id_pemesanan');
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('pemesanan'));
        }
    }
    public function ubah()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $id = $this->request->getPost('id_pemesanan');

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'tanggal_rekap' => $this->request->getPost('tanggal_rekap'),
            'total_barang' => $this->request->getPost('total_barang')
        ];
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('pemesanan'));
        }
    }
}
