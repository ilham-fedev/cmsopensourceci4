<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Libraries\Factory;
use App\Models;

class Halaman extends ResourceController
{
	private $halaman;

	function __construct()
	{
		$this->halaman = new Models\Halaman;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->halaman->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/halaman/index", $data);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{
		//
	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		return view("cms/halaman/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'judul' => $this->request->getVar("judul"),
			'halaman_seo' => url_title($this->request->getVar("judul"), "-", true),
			'isi_halaman' => $this->request->getVar("isi_halaman"),
		];

		$gambar = $this->request->getFile('gambar');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/galeri/' . $name;
			$thumb_destination = 'images/thumb/' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			$height = (1080/$info['width'])*$info['height'];

			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);

			$thumbHeight = (100/$info['width'])*$info['height'];

			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
				}

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->halaman->insert($data);
		if($save)
		{
			return redirect("panel/halaman");
		}

		exit("Error");
	}

	/**
	 * Return the editable properties of a resource object
	 *
	 * @return mixed
	 */
	public function edit($id = null)
	{
		$item = $this->halaman->find($id);
		return view("cms/halaman/edit", [
			'item' => $item
		]);
		
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$data = [
			'judul' => $this->request->getVar("judul"),
			'halaman_seo' => url_title($this->request->getVar("judul"), "-", true),
			'isi_halaman' => $this->request->getVar("isi_halaman"),
		];

		$gambar = $this->request->getFile('gambar');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/galeri/' . $name;
			$thumb_destination = 'images/thumb/' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			$height = (1080/$info['width'])*$info['height'];

			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);

			$thumbHeight = (100/$info['width'])*$info['height'];

			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
				}

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->halaman->update($id, $data);
		if($save)
		{
			return redirect("panel/halaman");
		}

		exit("Error");
	}

	/**
	 * Delete the designated resource object from the model
	 *
	 * @return mixed
	 */
	public function delete($id = null)
	{
		$halaman = $this->halaman->find($id);
		if($halaman->gambar)
		{
			$filename = $halaman->gambar;
			$thumb    = str_replace(".webp","",$filename);
			if(file_exists("images/galeri/" . $filename) && file_exists("images/thumb/" . $thumb))
			{
				unlink("images/galeri/" . $filename);
				unlink("images/thumb/" . $thumb);
			}
		}

		$delete = $this->halaman->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
