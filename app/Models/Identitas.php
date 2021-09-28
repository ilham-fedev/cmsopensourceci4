<?php

namespace App\Models;

use CodeIgniter\Model;

class Identitas extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'identitas';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['nama_website','alamat_website','meta_deskripsi','meta_keyword','favicon','facebook','twitter','instagram','youtube','logo','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
