<?php

namespace App\Http\Controllers;
use Request;
use Auth;


class LoginController extends Controller
{
	public function getToken()
{
	$response = new \stdClass;
	$response->token = csrf_token();
	$response->success = true;
	return response()->json($response);
}

	public function __construct()
	{
		$this->middleware('auth',['only'=>'getDashboard']);
	}

	public function getIndex()
	{
	    return redirect('login/login');

	}

	public function getLogin()
	{
		return view('login/login');
	} 

	public function postLogin()
	{
		$username = Request::input('username');
		$password = Request::input('password');
		if (Auth::attempt(
			array(
				'username'=>$username,
				'password'=>$password
				)
		))
		{
			//Login Ok
			$user = Auth::user();
			return redirect('users/timeline');
		}
		else
		{
			//Login Failed
			return redirect('login/login');
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return redirect('login/login');
	} 


}
