<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models;

class Hubungi extends BaseController
{
	private $hubungi;
	
	function __construct()
	{
		$this->hubungi = new Models\Hubungi;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$item = $this->hubungi->find(1);

		return view("cms/hubungi/index",[
			'item' => $item
		]);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update()
	{
		$data = [
			'deskripsi' => $this->request->getVar("deskripsi"),
			'email'  => $this->request->getVar("email"),
			'map'    => $this->request->getVar("map")
		];

		$id = $this->request->getVar("id");
		$save = $this->hubungi->update($id, $data);
		if($save)
		{
			return redirect("panel/hubungi");
		}
	}
}

