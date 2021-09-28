<?php

namespace App\Models;

use CodeIgniter\Model;

class SekilasInfo extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'sekilasinfo';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['info','gambar','created_at'];

	// Dates
	protected $useTimestamps        = true;
	
}
