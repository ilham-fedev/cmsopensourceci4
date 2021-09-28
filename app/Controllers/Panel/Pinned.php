<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Pins;
use Config\Services;
use App\Libraries\Factory;

class Pinned extends ResourceController
{
	private $pin;
	function __construct()
	{
		$this->pin = new Pins;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->pin
				->orderBy("id", "DESC")
				->findAll();

		return view("cms/pinned/index", [
			'items' => $items,
			'no'    => 1
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
		return view("cms/pinned/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'title'  => $this->request->getVar("title"),
			'subtitle'   => $this->request->getVar("subtitle"),
			'aktif'   => $this->request->getVar("aktif"),
			'link'    => $this->request->getVar("link")
		];
		$gambar = $this->request->getFile('image');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/social/' . $name;
			$service = $gambar->move('images/social/', $name);
			if($service)
			{
				$data["image"] = $name;
			}
		}

		$save = $this->pin->insert($data);
		if($save)
		{
			return redirect("panel/pinned");
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
		$item = $this->pin->find($id);
		return view("cms/pinned/edit", [
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
			'title'  => $this->request->getVar("title"),
			'subtitle'   => $this->request->getVar("subtitle"),
			'aktif'   => $this->request->getVar("aktif"),
			'link'    => $this->request->getVar("link")
		];
		$gambar = $this->request->getFile('image');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/social/' . $name;
			$service = $gambar->move('images/social/', $name);
			if($service)
			{
				$data["image"] = $name;
			}
		}

		$save = $this->pin->update($id, $data);
		if($save)
		{
			return redirect("panel/pinned");
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
		$pinned = $this->pin->find($id);
		if($pinned->image)
		{
			$filename = $pinned->image;
			if(file_exists("images/social/" . $filename))
			{
				unlink("images/social/" . $filename);
			}
		}

		$delete = $this->pin->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
