<?php

namespace App\Models;

use CodeIgniter\Model;

class Hubungi extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'hubungi';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['deskripsi','map','email','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
