<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Kategori extends ResourceController
{
	private $kategori;
	function __construct()
	{
		$this->kategori = new Models\Kategori;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->kategori->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/kategori/index", $data);
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
		return view("cms/kategori/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$nama = $this->request->getVar("nama_kategori");
		$data = [
			'nama_kategori'  => $nama,
			'kategori_seo'   => url_title($nama,"-",true),
		];

		$save = $this->kategori->insert($data);
		if($save)
		{
			return redirect("panel/kategori");
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
		$item = $this->kategori->find($id);
		$data = [
			'item' => $item
		];
		return view("cms/kategori/edit", $data);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$nama = $this->request->getVar("nama_kategori");
		$data = [
			'nama_kategori'  => $nama,
			'kategori_seo'   => url_title($nama,"-",true),
		];

		$save = $this->kategori->update($id, $data);
		if($save)
		{
			return redirect("panel/kategori");
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
		$delete = $this->kategori->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
