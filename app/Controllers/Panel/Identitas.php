<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models;

use Config\Services;

class Identitas extends BaseController
{
	private $identitas;

	function __construct()
	{
		$this->identitas = new Models\Identitas;
	}

	/**
	 * Return an array of resource objects, themselves in array format
	 *
	 * @return mixed
	 */
	public function index()
	{
		$item = $this->identitas->find(1);
		return view("cms/identitas/index", [
			'item' => $item
		]);
	}

	public function update()
	{
		//
		$data = [
			'nama_website'  => $this->request->getVar('nama_website'),
			'alamat_website'=> $this->request->getVar('alamat_website'),
			'meta_deskripsi'=> $this->request->getVar('meta_deskripsi'),
			'meta_keyword'  => $this->request->getVar('meta_keyword'),
			'facebook'      => $this->request->getVar('facebook'),
			'twitter'       => $this->request->getVar('twitter'),
			'instagram'     => $this->request->getVar('instagram'),
			'youtube'       => $this->request->getVar("youtube"),
			'favicon'		=> 'favicon.png'
		];

		$logo = $this->request->getFile('logo');
		if($logo->isValid())
		{
			$info = Services::image()
            	  ->withFile($logo->getTempName())
            	  ->getFile()
            	  ->getProperties(true);

			$height = (250/$info['width'])*$info['height'];

			$imageLogo = Services::image()
						 ->withFile($logo->getTempName())
						 ->resize(250, $height, true, 'width')
						 ->save("images/logo/logo.png",90);

			$data["logo"] = 'logo.png';
		}

		$favicon = $this->request->getFile('favicon');
		if($favicon->isValid())
		{
			$imageFavicon = Services::image()
							->withFile($favicon->getTempName())
							->resize(80, 80, true, 'width')
							->save("images/logo/favicon.png",50);

			
		}

		$id = $this->request->getVar('id');

		$save = $this->identitas->update($id, $data);
		if($save)
		{
			return redirect("panel/identitas");
		}
	}
}

