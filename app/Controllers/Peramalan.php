<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_peramalan;

class Peramalan extends Controller
{
    public function __construct()
    {
        $this->model = new M_peramalan;
    }
    public function index()
    {

        $data = [
            'judul' => 'peramalan',
            'peramalan' => $this->model->getAllData()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('peramalan/index', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        $data = [
            'id_peramalan' => $this->request->getPost('id_peramalan'),
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_peramalan' => $this->request->getPost('tanggal_peramalan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('peramalan'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('peramalan'));
        }
    }
    public function ubah()
    {
        $id = $this->request->getPost('id_peramalan');

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'id_rekap' => $this->request->getPost('id_rekap'),
            'tanggal_peramalan' => $this->request->getPost('tanggal_peramalan'),
            'jumlah_barang' => $this->request->getPost('jumlah_barang')
        ];
        //insert data
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('peramalan'));
        }
    }
}
