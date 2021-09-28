<?php

namespace App\Models;

use CodeIgniter\Model;

class Berita extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'berita';
	protected $primaryKey           = 'id';
	protected $returnType           = 'object';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['id_kategori','username','judul','judul_seo','headline','isi_berita','hari','gambar','dibaca','tag','created_by'];

	// Dates
	protected $useTimestamps        = true;
}
