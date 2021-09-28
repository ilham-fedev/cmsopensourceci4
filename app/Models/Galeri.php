<?php

namespace App\Models;

use CodeIgniter\Model;

class Galeri extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'galeri';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_album','jdl_galeri','galeri_seo','keterangan','gbr_galeri','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
