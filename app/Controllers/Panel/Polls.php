<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Poling;

class Polls extends ResourceController
{
	private $poling;
	function __construct()
	{
		$this->poling = new Poling;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->poling
				 ->orderBy("id", "DESC")
				 ->findAll();

		$pollingStatus = function($item){
			return ($item === 'Pertanyaan') ? 'bg-danger' : 'bg-info';
		};

		return view("cms/polling/index", [
			'items' => $items,
			'no'	=> 1,
			'fnStatus' => $pollingStatus
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
		return view("cms/polling/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'pilihan'  => $this->request->getVar("pilihan"),
			'status'   => $this->request->getVar("status"),
			'aktif'   => $this->request->getVar("aktif"),
		];

		$save = $this->poling->insert($data);
		if($save)
		{
			return redirect("panel/polls");
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
		$item = $this->poling->find($id);

		return view("cms/polling/edit", [
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
			'pilihan'  => $this->request->getVar("pilihan"),
			'status'   => $this->request->getVar("status"),
			'aktif'   => $this->request->getVar("aktif"),
		];

		$save = $this->poling->update($id, $data);
		if($save)
		{
			return redirect("panel/polls");
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
		$delete = $this->poling->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
