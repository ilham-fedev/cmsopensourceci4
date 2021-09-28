<?php

namespace App\Models;

use CodeIgniter\Model;

class SubMenu extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'submenu';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_sub','link_sub','id_main','aktif','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
