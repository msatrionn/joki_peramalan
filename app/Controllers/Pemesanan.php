<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_pemesanan;

class Pemesanan extends Controller
{
    public function __construct()
    {
        $this->model = new M_pemesanan;
    }
    public function index()
    {

        $data = [
            'judul' => 'Pemesanan',
            'pemesanan' => $this->model->getAllData()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('Pemesanan/index', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        $data = [
            'id_pemesanan' => $this->request->getPost('id_pemesanan'),
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('pemesanan'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('pemesanan'));
        }
    }
    public function ubah()
    {
        $id = $this->request->getPost('id_pemesanan');

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_pemesanan' => $this->request->getPost('tanggal_pemesanan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('pemesanan'));
        }
    }
}
