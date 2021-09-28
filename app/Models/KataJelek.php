<?php

namespace App\Models;

use CodeIgniter\Model;

class KataJelek extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'katajelek';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = false;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['kata','ganti','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
