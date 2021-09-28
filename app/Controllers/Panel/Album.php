<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Libraries\Factory;
use App\Models;

class Album extends ResourceController
{
	private $album;

	function __construct()
	{
		$this->album = new Models\Album;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->album->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/album/index", $data);
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
		return view("cms/album/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'jdl_album' => $this->request->getVar("jdl_album"),
			'album_seo' => url_title($this->request->getVar("jdl_album"), "-", true),
		];

		$gambar = $this->request->getFile('gbr_album');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/album/' . $name;
			$thumb_destination = 'images/thumb/' . $name;
			$medium_destination = 'images/album/medium_' . $name;

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

				$data["gbr_album"] = $name.".webp";
			}
		}

		$save = $this->album->insert($data);
		if($save)
		{
			return redirect("panel/album");
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
		$item = $this->album->find($id);
		return view("cms/album/edit",[
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
			'jdl_album' => $this->request->getVar("jdl_album"),
			'album_seo' => url_title($this->request->getVar("jdl_album"), "-", true),
		];

		$gambar = $this->request->getFile('gbr_album');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/album/' . $name;
			$thumb_destination = 'images/thumb/' . $name;
			$medium_destination = 'images/album/medium_' . $name;

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

				$data["gbr_album"] = $name.".webp";
			}
		}

		$save = $this->album->update($id, $data);
		if($save)
		{
			return redirect("panel/album");
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
		$album = $this->album->find($id);
		if($album->gbr_album)
		{
			$filename = $album->gbr_album;
			$thumb    = str_replace(".webp","",$filename);
			if(file_exists("images/album/" . $filename) && file_exists("images/thumb/" . $thumb))
			{
				unlink("images/album/" . $filename);
				unlink("images/album/medium_" . $filename);
				unlink("images/thumb/" . $thumb);
			}
		}

		$delete = $this->album->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
