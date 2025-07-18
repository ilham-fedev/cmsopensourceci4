<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\DataCaster\DataCaster;

class Meta extends Entity
{
	/**
	 * Attribute
	 */
	protected $attributes = [
        'site_title' 		=> null,
        'site_description' 	=> null,        // Represents a username
        'site_keyword' 		=> null,
        'site_image' 		=> null,
        'site_url' 			=> null,
    ];

	private $cms = NULL;

	/**
	 * __construct
	 */
	function __construct($cms = null)
	{
		parent::__construct();
		$this->cms = $cms;
	}

	/**
	 * getSEO
	 */
	public function getSEO()
	{
		if($this->site_title == null)
		{
			$identity = $this->cms->findIdentity();

			$this->site_title 		= $identity->nama_website;
			$this->site_description = $identity->meta_deskripsi;
			$this->site_keyword 	= $identity->meta_keyword;
			$this->site_url 		= $identity->alamat_website;
			$this->site_image       = base_url('images/logo/favicon.png');
		}

		return (object) $this->attributes;
	}

	/**
	 * push
	 * $item is item data
	 * $params is field or passed item with array format (title, description, url, image)
	 */
	public function push($item, $params = [])
	{
		$parse_keyword = function($keywords)
		{
			return strtolower(str_replace(" ",",",$keywords) . ',' .$keywords);
		};

		$this->site_title   	= $item->{$params[0]};
		$this->site_description = substr(strip_tags($item->{$params[1]}),0,1000);
		$this->site_keyword 	= $parse_keyword($item->{$params[0]});
		$this->site_url		    = current_url();
		$this->site_image       = ($item->{$params[2]} !== null) ? base_url('images/' . $item->{$params[2]}) : base_url('images/favicon.svg');

		return $this;
	}
}
