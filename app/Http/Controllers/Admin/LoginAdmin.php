<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Models\Admin;

class LoginAdmin extends Controller
{
	public function index()
	{
		if (hasAdmin()) {
			return redirect('/content-adm/dashboard');
		} else {
			return view("content-adm.login.index");
		}
	}

	public function login()
	{
		$username  	= filter_var($_POST['email']);
		$password  	= filter_var($_POST['password']);

		$adminLogin = $this->checkUser($username, $password);

		echo $adminLogin ? "1" : "0";
	}

	private function checkUser($email, $password)
	{
		$data = Admin::where("status", 1)->where("email", $email)->first();

		if ($data && Hash::check($password, $data->password)) {

			saveData($data);
			return $data->id;
		}

		return false;
	}

	public function logout()
	{

		// apaga os dados do usuário logado
		deleteAdmin();
		return redirect('/content-adm');
	}
}
