<?php

namespace App\Models;

use CodeIgniter\Model;

class MainMenu extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'mainmenu';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = false;
	protected $allowedFields        = ['nama_menu','link','aktif','adminmenu','icon','created_at','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
