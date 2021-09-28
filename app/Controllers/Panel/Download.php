<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use App\Models;

class Download extends ResourceController
{
	private $download;

	function __construct()
	{
		$this->download = new Models\Download;
	}
	/**
	 * Index
	 */
	public function index()
	{
		$items = $this->download
				 ->orderBy("id", "DESC")
				 ->get()
				 ->getResult();
		$direct = function($item)
		{
			return $this->directLink($item);
		};

		return view("cms/download/index", [
			'items' => $items,
			'no'    => 1,
			'direct'=> $direct
		]);
	}

	/**
	 * Show
	 */
	public function show($id = null)
	{
		//
	}

	/**
	 * New
	 */
	public function new()
	{
		return view("cms/download/new");
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$data = [
			'judul'  	  => $this->request->getVar("judul"),
			'direct_link' => $this->request->getVar("direct_link")
		];

		$file = $this->request->getFile('nama_file');
		if($file->isValid())
		{
			$name = $file->getRandomName();
			$destination = 'downloads/' . $name;
			$service = $file->move('downloads/', $name);
			if($service)
			{
				$data["nama_file"] = $name;
			}
		}

		$save = $this->download->insert($data);
		if($save)
		{
			return redirect("panel/download");
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
		$item = $this->download->find($id);
		return view("cms/download/edit", [
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
			'judul'  	  => $this->request->getVar("judul"),
			'direct_link' => $this->request->getVar("direct_link")
		];

		$file = $this->request->getFile('nama_file');
		if($file->isValid())
		{
			$name = $file->getRandomName();
			$destination = 'downloads/' . $name;
			$service = $file->move('downloads/', $name);
			if($service)
			{
				$data["nama_file"] = $name;
			}
		}

		$save = $this->download->update($id, $data);
		if($save)
		{
			return redirect("panel/download");
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
		$download = $this->download->find($id);
		if($download->nama_file)
		{
			$filename = $download->nama_file;
			if(file_exists("downloads/" . $filename))
			{
				unlink("downloads/" . $filename);
			}
		}

		$delete = $this->download->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
    }

	//directLink
	private function directLink($link)
	{
		return ($link->nama_file) ? base_url("downloads/" . $link->nama_file) : $link->direct_link;
	}
}
