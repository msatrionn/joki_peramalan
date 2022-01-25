<?php

namespace App\Models;

use CodeIgniter\Model;

class M_peramalan extends Model
{
    protected $table = 'peramalan';
    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        $query = $this->builder->get();
        // dd($query->getResultArray());
        return $query;
    }
    public function barang()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('barang');
        $query = $this->builder->get();
        // dd($query->getResultArray());
        return $query;
    }
    public function detail_barang($data)
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('barang');
        $query = $this->builder
            ->where('id_barang', $data['id_barang'])
            ->get();
        // dd($query->getResultArray());
        return $query;
    }
    public function bulan($data)
    {
        $moon = [
            1 => 'januari',
            2 => 'februari',
            3 => 'maret',
            4 => 'april',
            5 => 'mei',
            6 => 'juni',
            7 => 'juli',
            8 => 'agustus',
            9 => 'september',
            10 => 'oktober',
            11 => 'november',
            12 => 'desember',
        ];
        // $cek=$data['dari'];
        $dari = $moon[$data['dari']];
        $sampai = $moon[$data['sampai']];
        return [$dari, $sampai];
    }
    public function hitung_barang($data)
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('pemesanan');
        $dari = $data['dari'];
        $sampai = $data['sampai'];
        $tahun = $data['tahun'];
        $id_barang = $data['id_barang'];
        $query = $this->builder
            ->select('nama_barang')
            ->select('sum(total_barang) as total_amount')
            ->select('year(tanggal_rekap) as year, monthname(tanggal_rekap) as month')
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            // ->distinct()
            // ->groupBy('nama_barang')
            ->groupBy('nama_barang,year(tanggal_rekap), monthname(tanggal_rekap)')
            ->orderBy('month', 'asc')
            ->where('barang.id_barang', $id_barang)
            ->where("month(tanggal_rekap) BETWEEN $dari AND $sampai")
            ->where("year(tanggal_rekap)", $tahun)
            ->get();

        // foreach (json_encode($query->getResultArray()) as $key ) {
        //     dd($key['total_amount']);
        //     # code...
        // }
        return $query;
        // return dd($data);
        // dd($query->getResultArray()->total_amount);
        //    $array1=$query->result();
    }

    public function tambah($data)
    {

        return $this->builder->insert($data);
    }
    public function hapus($id)
    {
        return $this->builder->delete(['id_peramalan' => $id]);
    }
    public function ubah($data, $id)
    {
        return $this->builder->update($data, ['id_peramalan' => $id]);
    }
    public function pemesanan()
    {

        $this->db = db_connect();
        $this->builder = $this->db->table('pemesanan');
        $cek = $this->builder
            ->select('nama_barang')
            ->select('sum(total_barang) as total_amount')
            ->select('year(tanggal_rekap) as year, monthname(tanggal_rekap) as month')
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            ->distinct()
            ->orderBy('month', 'asc')
            // ->groupBy('nama_barang')
            ->groupBy('nama_barang,year(tanggal_rekap), monthname(tanggal_rekap)')
            // ->where('barang.id_barang',3)
            ->get();
        // dd($cek->getResult());
        return $cek;
    }
    public function ramal($data)
    {

        $this->db = db_connect();
        $this->builder = $this->db->table('pemesanan');
        //  dd($data['dari']);
        $dari = $data['dari'];
        $sampai = $data['sampai'];
        $tahun = $data['tahun'];
        $id_barang = $data['id_barang'];
        $query = $this->builder
            ->select('nama_barang')
            ->select('monthname(tanggal_rekap) as month,year(tanggal_rekap) as year')
            ->select('sum(total_barang) as total_amount')
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            // ->distinct()
            // ->groupBy('nama_barang')
            ->groupBy('nama_barang,year(tanggal_rekap), monthname(tanggal_rekap)')
            ->where('barang.id_barang', $id_barang)
            ->where("month(tanggal_rekap) BETWEEN $dari AND $sampai")
            ->where("year(tanggal_rekap)", $tahun)
            ->get();
        return $query;
    }
    public function hitung_ramal($data)
    {

        $this->db = db_connect();
        $this->builder = $this->db->table('pemesanan');
        //  dd($data['dari']);
        $dari = $data['dari'];
        $sampai = $data['sampai'];
        $tahun = $data['tahun'];
        $id_barang = $data['id_barang'];
        $query = $this->builder
            ->select('nama_barang')
            ->select('month(tanggal_rekap) as month,year(tanggal_rekap) as year')
            ->select('sum(total_barang) as total_amount')
            ->join('barang', 'barang.id_barang=pemesanan.id_barang')
            // ->distinct()
            // ->groupBy('nama_barang')
            ->groupBy('nama_barang,year(tanggal_rekap), month(tanggal_rekap)')
            ->where('barang.id_barang', $id_barang)
            ->where("month(tanggal_rekap) BETWEEN $dari AND $sampai")
            ->where("year(tanggal_rekap)", $tahun)
            // ->orderBy('sum(month)', 'asc')
            ->get();
        return $query;
    }
}
