<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_rekap;

class Rekap extends Controller
{
    public function __construct()
    {
        $this->model = new M_rekap;
    }
    public function index()
    {

        $data = [
            'judul' => 'Rekap Pemesanan',
            'rekap_pemesanan' => $this->model->getAllData()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('Rekap/index', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        $data = [
            'id_rekap' => $this->request->getPost('id_rekap'),
            'id_barang' => $this->request->getPost('id_barang'),
            'tanggal_rekap' => $this->request->getPost('tanggal_rekap'),
            'jumlah_perbulan' => $this->request->getPost('jumlah_perbulan')
        ];
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('rekap'));
        }
    }
    public function hapus($id)
    {
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('rekap'));
        }
    }
    public function ubah()
    {
        $id = $this->request->getPost('id_rekap');

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'tanggal_rekap' => $this->request->getPost('tanggal_rekap'),
            'jumlah_perbulan' => $this->request->getPost('jumlah_perbulan')
        ];
        //insert data
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('rekap'));
        }
    }
}
