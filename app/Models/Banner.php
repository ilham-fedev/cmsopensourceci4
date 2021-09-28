<?php

namespace App\Models;

use CodeIgniter\Model;

class Banner extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'banner';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['judul','url','gambar','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
