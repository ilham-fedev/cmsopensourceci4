<?php

namespace App\Models;

use CodeIgniter\Model;

class Halaman extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'halaman';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['judul','isi_halaman','halaman_seo','gambar','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
