<?php

namespace App\Models;

use CodeIgniter\Model;

class Template extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'templates';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = false;
	protected $insertID             = 0;
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['judul','pembuat','folder','aktif','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
