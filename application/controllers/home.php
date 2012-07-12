<?php

class Home_Controller extends Base_Controller {


	public $restful = true;

	public function get_index()
	{ 

		if(file_exists('application/controllers/setup.php')){
			return Controller::call('setup@index');		
		} 
		return Redirect::to_action('home@login');
	}

	public function post_index()
	{
		return Redirect::to('home');
	}

	public function get_login()
	{
		if(Session::has('login')){
     		$log = array(
			'username' => Session::get('login'),
			'password' => Session::get('psw')
			);
			if(Auth::attempt($log)){
				if(strcmp(Auth::user()->role, 'admin') == 0){
					return Redirect::to('admin');
				} else{
					return Redirect::to('user');
				}
			}
		}
		return View::make('home.login');
	}

	public function post_login()
	{


		$log = array(
			'username' => Input::get('login'),
			'password' => Input::get('psw')
			);
		if(Auth::attempt($log)){
			Session::put('login', $log['username'], 1);
			Session::put('psw', $log['password'], 1);
			if(strcmp(Auth::user()->role, 'admin') == 0){
				return Redirect::to('admin');
			} else{
				return Redirect::to('user');
			}
		} else {
			echo 'mauvais log';
		}
	}
}