<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\M_barang;

class Barang extends Controller
{
    public function __construct()
    {
        $this->session = session();
        $this->model = new M_barang;
    }
    public function index()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'judul' => 'Barang',
            'barang' => $this->model->getAllData()
        ];
        echo view('templates/v_header', $data);
        echo view('templates/v_sidebar');
        echo view('templates/v_topbar');
        echo view('Barang/index', $data);
        echo view('templates/v_footer');
    }
    public function tambah()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }

        $data = [
            'id_barang' => $this->request->getPost('id_barang'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan')
        ];
        //insert data
        $success = $this->model->tambah($data);
        if ($success) {
            session()->setFlashdata('message', 'Ditambahkan');
            return redirect()->to(base_url('barang'));
        }
    }
    public function hapus()
    {

        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $id = $this->request->getPost('id_barang');
        $success = $this->model->hapus($id);
        if ($success) {
            session()->setFlashdata('message', 'Dihapus');
            return redirect()->to(base_url('barang'));
        }
    }
    public function ubah()
    {
        if (!$this->session->has('isLogin')) {
            return redirect()->to('/auth/login');
        }
        $id = $this->request->getPost('id_barang');


        $data = [
            'kode_barang' => $this->request->getPost('kode_barang'),
            'nama_barang' => $this->request->getPost('nama_barang'),
            'satuan' => $this->request->getPost('satuan')
        ];
        // dd($id);
        //insert data
        $success = $this->model->ubah($data, $id);
        if ($success) {
            session()->setFlashdata('message', 'Diubah');
            return redirect()->to(base_url('barang'));
        }
    }
}
