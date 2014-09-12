<?php

class LoginController extends BaseController {

	//
	protected $layout = 'layouts.login';

	//
	public function login()
	{
		$this->layout->content = View::make('admin.login');
	}

	//
	public function auth() {

		$credentials = array(
		   "username" => Input::get("username"),
		   "password" => Input::get("password")
		);

		if (Auth::attempt($credentials)) {
		    return Redirect::to('/');
		} else {
		    return Redirect::to('login')
		        ->with('message', 'Usuário ou senha inválido!')
		        ->withInput();
		}
	}

	//
	public function logoff()
	{
		Auth::logout();
    	return Redirect::guest('login');
	}

}
