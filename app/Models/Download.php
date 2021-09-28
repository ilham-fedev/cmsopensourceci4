<?php

namespace App\Models;

use CodeIgniter\Model;

class Download extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'download';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['judul','nama_file','hits','direct_link','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
