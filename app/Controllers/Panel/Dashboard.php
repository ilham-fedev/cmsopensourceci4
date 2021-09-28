<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Libraries\Factory;

use Config\Database;
use Config\Services;
use App\Models\Halaman;
use App\Models\Berita;
use App\Models\Galeri;

class Dashboard extends BaseController
{
	private $db;
	private $halaman;
	private $berita;
	private $galeri;

	function __construct()
	{
		$this->db = Database::connect();
		$this->halaman = new Halaman;
		$this->berita  = new Berita;
		$this->galeri  = new Galeri;
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$halaman   = $this->halaman->countAllResults();
		$berita    = $this->berita->countAllResults();
		$galeri    = $this->galeri->countAllResults();
		$statistik = $this->db
					 ->table("statistik")
					 ->select("ip")
					 ->countAll();

		$items     = $this->berita
					 ->select('id, judul, dibaca, created_at')
					 ->orderBy('created_at','DESC')
					 ->limit(5)
					 ->get()
					 ->getResult();

		return view("cms/dashboard", [
			'halaman' => $halaman,
			'berita'  => $berita,
			'galeri'  => $galeri,
			'items'	  => $items,
			'no'	  => 1,
			'statistik' => $statistik,
		]);
	}

	/**
	 * API
	 */
	public function api()
	{
		$statistik = $this->db
					 ->table("statistik")
					 ->select("MONTH(created_at) as bulan, COUNT(ip) as id")
					 ->groupBy("MONTH(created_at)")
					 ->get()
					 ->getResult();

		$data = [
			'success' => true,
			'data'    => $statistik
		];
		
		return $this->response->setJSON($data);
	}

	public function upload()
	{
		if($this->request->isAjax())
		{
			$image = $this->request->getFile('image');
			if($image->isValid())
			{
				$name = 'summernote_'.$image->getRandomName();
				$destination = 'images/berita/' . $name;
				$info = Services::image()
            	  ->withFile($image->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

				$height = (640/$info['width'])*$info['height'];
				$service = Services::image()
						   ->withFile($image->getTempName())
						   ->resize(640, $height, true, 'width')
						   ->save($destination,100);

				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);

					echo base_url($destination.".webp");
				}
			}
		}
	}
}
