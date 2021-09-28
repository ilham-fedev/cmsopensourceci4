<?php

namespace App\Models;

use CodeIgniter\Model;

class Album extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'album';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['jdl_album','album_seo','gbr_album','aktif','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
