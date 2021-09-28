<?php

namespace App\Models;

use CodeIgniter\Model;

class Kategori extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'kategori';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_kategori','kategori_seo','aktif','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
