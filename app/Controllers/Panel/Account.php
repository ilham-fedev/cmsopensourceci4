<?php

namespace App\Controllers\Panel;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Libraries\Hash;

class Account extends BaseController
{
	// edit
	public function edit()
	{
		return view("cms/akun/edit");
	}

	// edit password
	public function ubah_password()
	{
		return view("cms/akun/edit_password");
		
	}

	// save edit
	public function save()
	{
		$data = [
			'nama_lengkap' => $this->request->getVar("nama_lengkap"),
			'email'   => $this->request->getVar("email"),
			'no_telp' => $this->request->getVar("no_telp"),
		];
		$id = $this->request->getVar("id");

		$save = (new Users)->update($id, $data);
		if($save)
		{
			session()->set("cms.nama", $data['nama_lengkap']);
			session()->set("cms.email", $data['email']);
			session()->set("cms.phone", $data['no_telp']);

			return redirect()->to("/panel/akun/edit")->with("message", "Akun Berhasil di Ubah");;
		}

		exit("Error");
	}

	// save password
	public function save_password()
	{
		$data = [
			'username' => $this->request->getVar("username")
		];

		$password =  $this->request->getVar("password");

		if($password)
		{
			$hash = Hash::create($password);
			$data["password"] =  $hash;
		}

		$id = $this->request->getVar("id");

		$save = (new Users)->update($id, $data);
		if($save)
		{
			session()->set("cms.initial", $data['username']);

			return redirect()->to("/panel/akun/ubah-password")->with("message", "Password Berhasil di Ubah");
		}

		exit("Error");
	}
}
