<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class SubMenu extends ResourceController
{
	private $submenu;
	private $menu;

	function __construct()
	{
		$this->submenu = new Models\SubMenu;
		$this->menu = (new Models\MainMenu)->select('id, nama_menu')
					  ->findAll();
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->submenu->findAll();
		$menu  = $this->arrayMenu();

		$data = [
			'items' => $items,
			'no'	=> 1,
			'menu'  => $menu
		];
		return view("cms/submenu/index", $data);
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
		return view("cms/submenu/new", [
			'menu' => $this->menu
		]);
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'nama_sub'  => $this->request->getVar("nama_sub"),
			'link_sub'  => $this->request->getVar("link_sub"),
			'id_main'   => $this->request->getVar("id_main")
		];

		$save = $this->submenu->insert($data);
		if($save)
		{
			return redirect("panel/submenu");
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
		$item = $this->submenu->find($id);
		return view("cms/submenu/edit", [
			'menu' => $this->menu,
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
			'nama_sub'  => $this->request->getVar("nama_sub"),
			'link_sub'  => $this->request->getVar("link_sub"),
			'id_main'   => $this->request->getVar("id_main")
		];
		
		$save = $this->submenu->update($id, $data);
		if($save)
		{
			return redirect("panel/submenu");
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
		$delete = $this->submenu->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}

	function arrayMenu()
	{
		$array = [];
		foreach($this->menu as $item)
		{
			$array[$item->id] = $item->nama_menu;
		}

		return $array;
	}
}

