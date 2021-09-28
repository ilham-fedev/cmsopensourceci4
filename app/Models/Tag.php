<?php

namespace App\Models;

use CodeIgniter\Model;

class Tag extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'tag';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_tag','tag_seo','count','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
