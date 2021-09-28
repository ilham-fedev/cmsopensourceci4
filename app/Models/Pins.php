<?php

namespace App\Models;

use CodeIgniter\Model;

class Pins extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'pinned';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['title','subtitle','link','image','aktif','created_at'];

	// Dates
	protected $useTimestamps        = true;
}
