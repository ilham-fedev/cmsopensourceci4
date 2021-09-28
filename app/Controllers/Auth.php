<?php

namespace App\Controllers;

use App\Libraries\AuthManager;

class Auth extends BaseController
{
	public function index()
	{
		/**
		 * user : @cmsopensurce
		 * pass : cmsopensurce
		 */
		return view('auth/index');
	}

    /**
     * check
     */
    public function check()
	{
		$authManager = new AuthManager;
		$has = $authManager->validate();

		if($has)
		{
			unset($has->password);

			$token = mt_rand(11111111,99999999);
			$csrf  = $this->request->getVar("csrf_cm_standar");

			$session = [
				'cms.token' 	=> $token,
				'cms.initial' 	=> $has->username,
				'cms.nama' 	    => $has->nama_lengkap,
				'cms.id' 		=> $has->id,
				'cms.email' 	=> $has->email,
				'cms.verified'  => true,
				'cms.rules' 	=> $has->level,
				'cms.phone' 	=> $has->no_telp,
				'cms.random'    => $token.$csrf,
			];
			session()->set($session);
			session()->set('cms_token_'.$token, $csrf);

			return redirect()->to('panel')->with('message', 'Welcome..');
		}

		return redirect()->to('cms-login')->with('_error', 'Login salah, silahkan ulangi');
	}
}
