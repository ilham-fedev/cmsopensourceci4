<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['username','password','nama_lengkap','email','no_telp','level','blokir','id_session','created_by'];

	// Dates
	protected $useTimestamps        = true;
	
}
