<?php

namespace App\Models;

use CodeIgniter\Model;

class Komentar extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'komentar';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = fale;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_berita','nama_komentar','url','isi_komentar','aktif','created_at'];

	// Dates
	protected $useTimestamps        = true;
	
}
