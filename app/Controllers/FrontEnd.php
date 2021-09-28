<?php

namespace App\Controllers;

use App\Entities\Meta;
use App\Models\Cms;

class FrontEnd extends BaseController
{
	/**
	 * Set Var & Const
	 */
	private $themes;
	private $meta;
	private $cms;

	/**
	 * __construct
	 * Configure Cms Model base on Query Builder for Best Performance
	 * Set active themes, and Set Session
	 */
	function __construct()
	{
		helper('cms');

		$this->cms  = new Cms;
		$this->meta = new Meta(new Cms);

		if(session()->has('active_themes'))
		{
			$this->themes = 'themes/'.session()->get('active_themes');
		}else{
			$themes = $this->cms->getActiveThemes();

			session()->set('active_themes',$themes->folder);
			$this->themes = 'themes/'.$themes->folder;
		}

		/**
		 * Statistik ALways On
		 */
		$this->cms->getStatistikKunjungan();
	}

	/**
	 * Home
	 */
	public function index()
	{
		$meta = $this->meta->getSEO();

		/**
		 * News
		 */
		$news = $this->cms;
		$news->limit 	= 6;
		$news->offset	= 0;
		$news->order 	= [
			'order_by' => 'id',
			'sort'	   => 'DESC'
		];
		$items = $news->getNews();

		/**
		 * Agenda
		 */
		$agenda = $this->cms;
		$agenda->limit = 4;
		$agendas = $agenda->getAgenda();

		/**
		 * Pinned
		 */
		$pinned = $this->cms->getPinned();

		/**
		 * Banner
		 */
		$banners = $this->cms->getBanner();

		$data = [
			'meta' => $meta,
			'news' => $items,
			'agendas' => $agendas,
			'pinned'  => $pinned,
			'banners' => $banners
		];

		return view($this->themes . '/home', $data);
	}

	/**
	 * Page
	 */
	public function page($seo)
	{
		$page  = $this->cms->findPage($seo);
		$meta  = $this->meta
				 ->push($page,[
					 'judul','isi_halaman','gambar'
				 ])
				 ->getSEO();

		$data = [
			'meta' => $meta,
			'page' => $page
		];

		return view($this->themes . '/page', $data);
	}

	/**
	 * News
	 */
	public function news()
	{
		$news = $this->cms;
		$news->limit 	= 6;
		$news->offset	= 0;
		$news->order 	= [
			'order_by' => 'id',
			'sort'	   => 'DESC'
		];

		$items = $news->getNews();

		$meta = $this->meta;
		$meta->site_title = "Baca berita di CMS Open Source";

		$data = [
			'meta'  => $meta->getSEO(),
			'items' => $items
		];

		return view($this->themes . '/news', $data);
	}

	/**
	 * Read
	 */
	public function read($seo)
	{
		$news = $this->cms->findNews($seo);
		$meta  = $this->meta
				 ->push($news,[
					 'judul','isi_berita','gambar'
				 ]);
		$meta->site_keyword = $news->tag. ',' .$meta->site_keyword;

		$data = [
			'meta'  => $meta->getSEO(),
			'item'  => $news
		];

		return view($this->themes . '/read', $data);
	}

	/**
	 * Agenda
	 */
	public function agenda()
	{
		$meta = $this->meta->getSEO();

		$agenda = $this->cms;
		$agenda->limit = 15;
		$agendas = $agenda->getAgenda();

		$data = [
			'meta' => $meta,
			'agendas' => $agendas
		];

		return view($this->themes . '/agenda', $data);
	}

	/**
	 * Api Agenda
	 */
	public function api_agenda($seo)
	{
		$agenda = $this->cms
				  ->findAgenda($seo);
		$data = [
			'item' => $agenda,
			'success' => true
		];
		return $this->response->setJSON($data);
	}

	/**
	 * Category
	 */
	public function category($seo)
	{
		$meta = $this->meta->getSEO();
		$news = $this->cms;
		$news->limit 	= 6;
		$news->offset	= 0;
		$news->order 	= [
			'order_by' => 'id',
			'sort'	   => 'DESC'
		];
		$news->filter = [
			'kategori_seo' => $seo
		];
		$items = $news->getNews();
		$data = [
			'meta' => $meta,
			'news' => $items,
			'seo'  => $seo
		];

		return view($this->themes . '/category', $data);
	}

	/**
	 * Tags
	 */
	public function tags($tag)
	{
		$meta = $this->meta->getSEO();
		$news = $this->cms;
		$news->limit 	= 6;
		$news->offset	= 0;
		$news->withLike = true;
		$news->order 	= [
			'order_by' => 'id',
			'sort'	   => 'DESC'
		];
		$news->filter = [
			'tag' => $tag
		];
		$items = $news->getNews();
		$data = [
			'meta' => $meta,
			'news' => $items,
			'tag'  => $tag
		];

		return view($this->themes . '/tags', $data);
	}

	/**
	 * Search
	 */
	public function search()
	{
		$word = $this->request->getGet('search');
		$meta = $this->meta->getSEO();
		$news = $this->cms;
		$news->limit 	= 15;
		$news->offset	= 0;
		$items = $news->getSearch($word);
		$data = [
			'meta' => $meta,
			'items' => $items,
			'word' => $word
		];

		return view($this->themes . '/search', $data);
	}

	/**
	 * Galeri
	 */
	public function galeri()
	{
		$galeries  = $this->cms->getGaleri();
		$meta  = $this->meta->getSEO();

		$data = [
			'meta' => $meta,
			'galeries' => $galeries
		];

		return view($this->themes . '/galeri', $data);
	}

	/**
	 * Galeri Detail
	 */
	public function galeri_detail($seo)
	{
		$galeriPhotos  = $this->cms->findGaleri($seo);

		$meta  = $this->meta->getSEO();

		$data = [
			'meta'   => $meta,
			'galeri' => $galeriPhotos["galeri"],
			'photos' => $galeriPhotos["photos"]
		];

		return view($this->themes . '/photo', $data);
	}

	/**
	 * Download
	 */
	public function download()
	{
		$file = $this->request->getGet("fname");
		if($file)
		{
			$fileExist = file_exists("downloads/" . $file);
			if($fileExist)
			{
				return $this->response->download('downloads/'.$file, null);
			}
			exit("File not found");
			return false;
		}

		$meta = $this->meta->getSEO();
		$downloads = $this->cms->getDownload();

		$data = [
			'meta' => $meta,
			'downloads' => $downloads,
			'no'   => 1
		];

		return view($this->themes . '/download', $data);
	}

		/**
	 * Contact
	 */
	public function contact()
	{
		$item = $this->cms->getContact();
		$meta = $this->meta->getSEO();

		$data = [
			'item' => $item,
			'meta' => $meta
		];

		return view($this->themes . "/contact", $data);
	}
}
