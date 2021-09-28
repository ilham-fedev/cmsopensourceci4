<?php

namespace App\Models;

use CodeIgniter\Model;

class Poling extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'poling';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['pilihan','status','rating','aktif','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
