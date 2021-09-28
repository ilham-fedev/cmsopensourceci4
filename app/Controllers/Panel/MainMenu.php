<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class MainMenu extends ResourceController
{
	private $mainmenu;
	function __construct()
	{
		$this->mainmenu = new Models\MainMenu;
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->mainmenu->findAll();
		$data = [
			'items' => $items,
			'no'	=> 1
		];
		return view("cms/menu/index", $data);
	}

	/**
	 * Return the properties of a resource object
	 *
	 * @return mixed
	 */
	public function show($id = null)
	{

	}

	/**
	 * Return a new resource object, with default properties
	 *
	 * @return mixed
	 */
	public function new()
	{
		return view("cms/menu/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'nama_menu' => $this->request->getVar("nama_menu"),  
			'link'  => $this->request->getVar("link"),  
			'aktif' => $this->request->getVar("aktif")
		];
		$save = $this->mainmenu->insert($data);
		if($save)
		{
			return redirect("panel/menu");
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
		$item = $this->mainmenu->find($id);
		return view("cms/menu/edit", [
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
			'nama_menu' => $this->request->getVar("nama_menu"),  
			'link'  => $this->request->getVar("link"),  
			'aktif' => $this->request->getVar("aktif")
		];
		$save = $this->mainmenu->update($id, $data);
		if($save)
		{
			return redirect("panel/menu");
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
		$delete = $this->mainmenu->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}