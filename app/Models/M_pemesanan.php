<?php

namespace App\Models;

use CodeIgniter\Model;

class M_pemesanan extends Model
{
    protected $table = 'pemesanan';
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }
    public function getAllData()
    {
        $cek = $this->builder
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            ->orderBy('tanggal_rekap', 'asc')
            ->get();
        // var_dump($cek->getResult());
        return $cek;
    }
    public function getBarang()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('barang');
        $cek = $this->builder->get();
        // dd($cek->getResultArray());
        return $cek;
    }
    public function tambah($data)
    {
        return $this->builder->insert($data);
    }
    public function hapus($id)
    {
        return $this->builder->delete(['id_pemesanan' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->builder->update($data, ['id_pemesanan' => $id]);
    }
    public function pemesanan($barang)
    {
        if ($barang == "Semua") {
            $cek = $this->builder
                ->select('nama_barang')
                ->select('satuan')
                ->select('sum(total_barang) as total_amount')
                ->select('year(tanggal_rekap) as year, monthname(tanggal_rekap) as month')
                ->join('barang', 'barang.id_barang=pemesanan.id_barang')
                ->distinct()
                ->groupBy('satuan,nama_barang,year(tanggal_rekap), monthname(tanggal_rekap)')
                ->get();
        } else {
            $cek = $this->builder
                ->select('nama_barang')
                ->select('satuan')
                ->select('sum(total_barang) as total_amount')
                ->select('year(tanggal_rekap) as year, monthname(tanggal_rekap) as month')
                ->join('barang', 'barang.id_barang=pemesanan.id_barang')
                ->distinct()
                ->groupBy('satuan,nama_barang,year(tanggal_rekap), monthname(tanggal_rekap)')
                ->where('nama_barang', $barang)
                ->get();
        }
        return $cek;
    }
    public function pemesanan_barang()
    {
        $cek = $this->builder
            ->select('nama_barang')
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            ->distinct()
            ->get();
        // var_dump($cek->getResult());
        // dd($cek->getResult());
        return $cek;
    }
}
