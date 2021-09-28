<?php

namespace App\Models;

use CodeIgniter\Model;

class Agenda extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'agenda';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['tema','tema_seo','isi_agenda','tempat','pengirim','tgl_mulai','tgl_selesai','jam','username','created_by'];

	// Dates
	protected $useTimestamps        = true;
}

