<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Libraries\Factory;
use App\Models;

class Banner extends ResourceController
{
	private $banner;

	function __construct()
	{
		$this->banner = new Models\Banner;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->banner->findAll();

		return view("cms/banner/index", [
			'items' => $items
		]);
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
		return view("cms/banner/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'judul' => $this->request->getVar("judul")
		];

		$gambar = $this->request->getFile('gambar');
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
			$height = (1920/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1920, $height, true, 'width')
					   ->save($destination,75);
			
			/** Medium */
			$mediumHeight = (640/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(640, $mediumHeight, true, 'width')
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

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->banner->insert($data);
		if($save)
		{
			return redirect("panel/banner");
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
		$item = $this->banner->find($id);
		return view("cms/banner/edit", [
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
			'judul' => $this->request->getVar("judul")
		];

		$gambar = $this->request->getFile('gambar');
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
			$height = (1920/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1920, $height, true, 'width')
					   ->save($destination,75);
			
			/** Medium */
			$mediumHeight = (640/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(640, $mediumHeight, true, 'width')
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

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->banner->update($id, $data);
		if($save)
		{
			return redirect("panel/banner");
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
		$banner = $this->banner->find($id);
		if($banner->gambar)
		{
			$filename = $banner->gambar;
			$thumb    = str_replace(".webp","",$filename);
			if(file_exists("images/galeri/" . $filename) && file_exists("images/thumb/" . $thumb))
			{
				unlink("images/galeri/" . $filename);
				unlink("images/galeri/medium_" . $filename);
				unlink("images/thumb/" . $thumb);
			}
		}

		$delete = $this->banner->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
