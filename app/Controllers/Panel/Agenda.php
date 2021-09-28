<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Agenda extends ResourceController
{
	private $agenda;
	function __construct()
	{
		$this->agenda = new Models\Agenda;
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$items = $this->agenda
				 ->orderBy("id", "DESC")
				 ->findAll();

		return view("cms/agenda/index", [
			'items' => $items,
			'no'	=> 1
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
		return view("cms/agenda/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$tema = $this->request->getVar("tema");
		$data = [
			'tema' => $tema,
			'tema_seo' => url_title($tema, "-", true),
			'isi_agenda' => $this->request->getVar("isi_agenda"),
			'tempat' 	=> $this->request->getVar("tempat"),
			'pengirim' 	=> $this->request->getVar("pengirim") ?? "Admin",
			'tgl_mulai' 	=> $this->request->getVar("tgl_mulai"),
			'tgl_selesai' 	=> $this->request->getVar("tgl_selesai"),
			'jam' 	=> $this->request->getVar("jam"),
		];

		$save = $this->agenda->insert($data);
		if($save)
		{
			return redirect("panel/agenda");
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
		$item = $this->agenda->find($id);
		return view("cms/agenda/edit", [
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
		$tema = $this->request->getVar("tema");
		$data = [
			'tema' => $tema,
			'tema_seo' => url_title($tema, "-", true),
			'isi_agenda' => $this->request->getVar("isi_agenda"),
			'tempat' 	=> $this->request->getVar("tempat"),
			'pengirim' 	=> $this->request->getVar("pengirim") ?? "Admin",
			'tgl_mulai' 	=> $this->request->getVar("tgl_mulai"),
			'tgl_selesai' 	=> $this->request->getVar("tgl_selesai"),
			'jam' 	=> $this->request->getVar("jam"),
		];

		$save = $this->agenda->update($id, $data);
		if($save)
		{
			return redirect("panel/agenda");
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
		$delete = $this->agenda->delete($id);
		
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
