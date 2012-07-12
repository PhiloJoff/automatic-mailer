<?php

class User_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{ 
		return View::make('user.user')->with('content', 0);
	}

	public function post_index()
	{
	}

	public function get_logout()
	{
		Session::flush();
		return Redirect::to('home');
	}

	public function post_logout()
	{
	}

	public function get_project()
	{
		return View::make('user.user')->with('content', 1);
	}

	public function post_project()
	{
	}
}