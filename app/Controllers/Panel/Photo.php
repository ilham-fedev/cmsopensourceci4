<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Libraries\Factory;
use App\Models\Galeri;
use App\Models\Album;

class Photo extends ResourceController
{
	private $galeri;

	function __construct()
	{
		$this->galeri = new Galeri;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->galeri->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/photo/index", $data);
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
		$albums = (new Album)->select("id, jdl_album")
				  ->get()
				  ->getResult();

		return view("cms/photo/new", [
			'albums' => $albums
		]);
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$judul = $this->request->getVar("jdl_galeri");
		$data = [
			'jdl_galeri' => $judul,
			'galeri_seo' => url_title($judul, "-", true),
			'id_album'   => $this->request->getVar("id_album"),
			'keterangan' => $this->request->getVar("keterangan")
		];

		$gambar = $this->request->getFile('gbr_galeri');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/galeri/' . $name;
			$thumb_destination = 'images/thumb/' . $name;
			$medium_destination = 'images/galeri/medium_' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			/** High */
			$height = (1080/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);
			
			/** Medium */
			$mediumHeight = (400/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(400, $mediumHeight, true, 'width')
			->save($medium_destination,75);

			/** Thumb */
			$thumbHeight = (100/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				Factory::convertImageToWebP($medium_destination, $medium_destination.".webp");
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
					unlink($medium_destination);
				}

				$data["gbr_galeri"] = $name.".webp";
			}
		}

		$save = $this->galeri->insert($data);
		if($save)
		{
			return redirect("panel/photo");
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
		$item = $this->galeri->find($id);
		$albums = (new Album)->select("id, jdl_album")
				  ->get()
				  ->getResult();

		return view("cms/photo/edit",[
			'item'   => $item,
			'albums' => $albums
		]);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$judul = $this->request->getVar("jdl_galeri");

		$data = [
			'jdl_galeri' => $judul,
			'galeri_seo' => url_title($judul, "-", true),
			'id_album'   => $this->request->getVar("id_album"),
			'keterangan' => $this->request->getVar("keterangan")
		];

		$gambar = $this->request->getFile('gbr_galeri');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/galeri/' . $name;
			$thumb_destination = 'images/thumb/' . $name;
			$medium_destination = 'images/galeri/medium_' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			/** High */
			$height = (1080/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);
			
			/** Medium */
			$mediumHeight = (400/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(400, $mediumHeight, true, 'width')
			->save($medium_destination,75);

			/** Thumb */
			$thumbHeight = (100/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				Factory::convertImageToWebP($medium_destination, $medium_destination.".webp");
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
					unlink($medium_destination);
				}

				$data["gbr_galeri"] = $name.".webp";
			}
		}

		$save = $this->galeri->update($id, $data);
		if($save)
		{
			return redirect("panel/photo");
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
		$galeri = $this->galeri->find($id);
		if($galeri->gbr_galeri)
		{
			$filename = $galeri->gbr_galeri;
			$thumb    = str_replace(".webp","",$filename);
			if(file_exists("images/galeri/" . $filename) && file_exists("images/thumb/" . $thumb))
			{
				unlink("images/galeri/" . $filename);
				unlink("images/galeri/medium_" . $filename);
				unlink("images/thumb/" . $thumb);
			}
		}

		$delete = $this->galeri->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
