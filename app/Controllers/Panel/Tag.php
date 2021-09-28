<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Tag extends ResourceController
{
	private $tag;
	function __construct()
	{
		$this->tag = new Models\Tag;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->tag->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/tag/index", $data);
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
		return view("cms/tag/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$nama = $this->request->getVar("nama_tag");
		$data = [
			'nama_tag'  => $nama,
			'tag_seo'   => url_title($nama,"-",true),
		];

		$save = $this->tag->insert($data);
		if($save)
		{
			return redirect("panel/tag");
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
		$item = $this->tag->find($id);
		$data = [
			'item' => $item
		];
		return view("cms/tag/edit", $data);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$nama = $this->request->getVar("nama_tag");
		$data = [
			'nama_tag'  => $nama,
			'tag_seo'   => url_title($nama,"-",true),
		];

		$save = $this->tag->update($id, $data);
		if($save)
		{
			return redirect("panel/tag");
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
		$delete = $this->tag->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
