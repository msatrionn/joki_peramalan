<?php

namespace App\Models;

use CodeIgniter\Model;

class M_barang extends Model
{
	protected $table = 'barang';
	public function __construct()
	{
		$this->db = db_connect();
		$this->builder = $this->db->table($this->table);
	}

	public function getAllData()
	{
		return $this->builder->get();
	}
	public function tambah($data)
	{
		return $this->builder->insert($data);
	}
	public function hapus($id)
	{
		return $this->builder->delete(['id_barang' => $id]);
	}
	public function ubah($data, $id)
	{
		return $this->builder->update($data, ['id_barang' => $id]);
	}
}
