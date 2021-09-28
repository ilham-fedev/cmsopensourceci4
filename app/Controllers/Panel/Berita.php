<?php

namespace App\Controllers\Panel;

use CodeIgniter\RESTful\ResourceController;
use Config\Services;
use App\Libraries\Factory;
use App\Models;
use App\Models\Tag;
use App\Models\Kategori;

class Berita extends ResourceController
{
	private $berita;

	function __construct()
	{
		$this->berita = new Models\Berita;
	}
	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$req = $this->request->getVar("page");
		$no   = ( $req && $req > 1 ) ? (($req-1)*25)+1 : 1 ;
		$model = $this->berita;
		$pages = $model->orderBy("id", "DESC")->paginate(25);
		$data = [
			'items' => $pages,
            'pager' => $model->pager,
			'no'    => $no
		];
		return view("cms/berita/index", $data);
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
		$tag = (new Tag)->select("tag_seo, nama_tag")->findAll();
		$kategori = (new Kategori)->select("id, nama_kategori")->findAll();

		$data = [
			'kategori' => $kategori,
			'tags'      => $tag
		];
		return view("cms/berita/new", $data);
	}

	/**
	 * Create a new resource object, from "posted" parameters
	 *
	 * @return mixed
	 */
	public function create()
	{
		$judul = $this->request->getVar("judul");
		$tag   = $this->request->getVar("tag");
		$data = [
			'judul' 	 => $judul,
			'judul_seo'  => url_title($judul, "-", true),
			'isi_berita' => $this->request->getVar("isi_berita"),
			'id_kategori'=> $this->request->getVar("id_kategori"),
			'tag'		 => implode(",", $tag)
		];

		$gambar = $this->request->getFile('gambar');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/berita/' . $name;
			$medium_destination = 'images/berita/medium_' . $name;
			$thumb_destination = 'images/thumb/' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			/** High */
			$height = (1080/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);

			/** Medium */
			$mediumHeight = (400/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(400, $mediumHeight, true, 'width')
			->save($medium_destination,75);

			/** Thumb */
			$thumbHeight = (100/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				Factory::convertImageToWebP($medium_destination, $medium_destination.".webp");
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
					unlink($medium_destination);
				}

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->berita->insert($data);
		if($save)
		{
			return redirect("panel/berita");
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
		$tag = (new Tag)->select("tag_seo, nama_tag")->findAll();
		$kategori = (new Kategori)->select("id, nama_kategori")->findAll();
		$item = $this->berita->find($id);
		$data = [
			'kategori' => $kategori,
			'tags'     => $tag,
			'item'     => $item,
			'tag_select'=> explode(",", $item->tag)
		];
		return view("cms/berita/edit", $data);
	}

	/**
	 * Add or update a model resource, from "posted" properties
	 *
	 * @return mixed
	 */
	public function update($id = null)
	{
		$judul = $this->request->getVar("judul");
		$tag   = $this->request->getVar("tag");
		$data = [
			'judul' 	 => $judul,
			'judul_seo'  => url_title($judul, "-", true),
			'isi_berita' => $this->request->getVar("isi_berita"),
			'id_kategori'=> $this->request->getVar("id_kategori"),
			'tag'		 => implode(",", $tag)
		];

		$gambar = $this->request->getFile('gambar');
		if($gambar->isValid())
		{
			$name = $gambar->getRandomName();
			$destination = 'images/berita/' . $name;
			$medium_destination = 'images/berita/medium_' . $name;
			$thumb_destination = 'images/thumb/' . $name;

			$info = Services::image()
            	  ->withFile($gambar->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			/** High */
			$height = (1080/$info['width'])*$info['height'];
			$service = Services::image()
					   ->withFile($gambar->getTempName())
					   ->resize(1080, $height, true, 'width')
					   ->save($destination,75);

			/** Medium */
			$mediumHeight = (400/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(400, $mediumHeight, true, 'width')
			->save($medium_destination,75);

			/** Thumb */
			$thumbHeight = (100/$info['width'])*$info['height'];
			Services::image()
			->withFile($gambar->getTempName())
			->resize(100, $height, true, 'width')
			->save($thumb_destination,75);

			if($service)
			{
				Factory::convertImageToWebP($medium_destination, $medium_destination.".webp");
				$cfg = Factory::convertImageToWebP($destination, $destination.".webp");
				if($cfg)
				{
					unlink($destination);
				}

				$data["gambar"] = $name.".webp";
			}
		}

		$save = $this->berita->update($id, $data);
		if($save)
		{
			return redirect("panel/berita");
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
		$berita = $this->berita->find($id);
		if($berita->gambar)
		{
			$filename = $berita->gambar;
			$thumb    = str_replace(".webp","",$filename);
			if(file_exists("images/berita/" . $filename) && file_exists("images/thumb/" . $thumb))
			{
				unlink("images/berita/" . $filename);
				unlink("images/berita/medium_" . $filename);
				unlink("images/thumb/" . $thumb);
			}
		}

		$delete = $this->berita->delete($id);
		return $this->response->setJSON(["status" => 200, "message" => $delete]);
	}
}
