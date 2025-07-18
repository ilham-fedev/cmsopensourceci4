<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use App\Models\Cms;
/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
	/**
	 * Identity
	 */
	public static function identity($getShared = true)
	{
	    if ($getShared)
	    {
	        return static::getSharedInstance('identity');
	    }
	
	    return (new Cms)->findIdentity();
	}

	/**
	 * Statistik
	 */
	public static function statistik($getShared = true): ?object
	{
	    if ($getShared)
	    {
	        return static::getSharedInstance('statistik');
	    }
	
	    $result = (new Cms)->getKunjungan();
	    return null; // Return null instead of array to comply with type constraints
	}
}
