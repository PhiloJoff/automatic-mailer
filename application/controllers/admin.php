<?php

class Admin_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{ 
		return View::make('admin.admin')->with('content', 0);
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

	public function get_user()
	{
		require_once 'application/libraries/table.class.php';
		$table = new TableSQL();

		return View::make('admin.admin')->with(array(
			'content' => 1,
			'table' => $table->getTableUser()
			));
	}

	public function post_user()
	{
	}

	public function get_newUser()
	{
		if(!isset($content)){
			$content = 0;
		}
		return View::make('admin.new_user')->with('content', $content);
	}

	public function post_newUser()
	{
		$etape = Input::get('etape');
		switch ($etape) {
			case'1':
				$user = new User;
				$user->nameUser = Input::get('name');
				$user->fNameUser = Input::get('fname');
				$user->emailUser = Input::get('mail');
				$user->login = Input::get('login');
				$user->password = Hash::make(Input::get('pswUser'));
				$user->save();
				$content = 1;
				break;
			case'2':
				return Redirect::to('admin');
				break;
			default:
				$content = 0;
		}
		return View::make('admin.new_user')->with('content', $content);
	}

	public function get_delUser()
	{
	}

	public function post_delUser()
	{
		if(!isset($content)){
			$content = 0;
		}
		$etape = Input::get('etape');
		$name = Input::get('name');
		$id = Input::get('id');
		switch ($etape) {
			case'0':
				$user = User::find($id);
				$user->delete();
				$content = 1;
				break;
			case'1':
				return Redirect::to('admin');
				break;
			default:
				$content = 0;
		}
		return View::make('admin.del_user')->with(array(
			'content' => $content,
			'user' => $name,
			'id' => $id
			));
	}

	public function get_project()
	{
		require_once 'application/libraries/table.class.php';
		$table = new TableSQL();

		return View::make('admin.admin')->with(array(
			'content' => 2,
			'table' => $table->getTableProject()
			));
	}

	public function post_project()
	{
	}
}