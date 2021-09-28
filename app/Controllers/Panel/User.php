<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Users;
use App\Libraries\Hash;

class User extends ResourceController
{
	private $users;

	function __construct()
	{
		$this->users = new Users;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->users
				->orderBy("id","DESC")
				->findAll();
		$data = [
			'items' => $items,
			'no'    => 1
		];
		return view("cms/users/index", $data);
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
		return view("cms/users/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$password = Hash::create($this->request->getVar("password"));
		$data = [
			'username' => $this->request->getVar("username"),
			'password' => $password,
			'nama_lengkap' => $this->request->getVar("nama_lengkap"),
			'email' 	=> $this->request->getVar("email"),
			'no_telp' 	=> $this->request->getVar("no_telp"),
			'level' 	=> $this->request->getVar("level"),
			'blokir' 	=> $this->request->getVar("blokir")
		];

		$save = $this->users->insert($data);
		if($save)
		{
			return redirect("panel/user");
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
		$data = [
			'item' => $this->users->find($id)
		];
		return view("cms/users/edit", $data);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$data = [
			'username' => $this->request->getVar("username"),
			'nama_lengkap' => $this->request->getVar("nama_lengkap"),
			'email' 	=> $this->request->getVar("email"),
			'no_telp' 	=> $this->request->getVar("no_telp"),
			'level' 	=> $this->request->getVar("level"),
			'blokir' 	=> $this->request->getVar("blokir")
		];


		if($this->request->getVar("password"))
		{
			$password = Hash::create($this->request->getVar("password"));
			$data["password"] =  $password;
		}

		$save = $this->users->update($id, $data);
		if($save)
		{
			return redirect("panel/user");
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
		$delete = $this->users->delete($id);
		
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}