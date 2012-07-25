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
				return Redirect::to_action('admin@user');
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
				return Redirect::to_action('admin@user');
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
		$table = new TableSQL();

		return View::make('admin.admin')->with(array(
			'content' => 2,
			'table' => $table->getTableProject()
			));
	}

	public function post_project()
	{
	}

	public function get_newProject()
	{
		if(!isset($content)){
			$content = 0;
		}
		$table = new TableSQL();
		return View::make('admin.new_project')->with(array(
			'content'=> $content,
			'select'=> $table->getSelectUsers()
			));
	}

	public function post_newProject()
	{
		$etape = Input::get('etape');
		switch ($etape) {
			case'1':
				$project = new Project;
				$project->nameProject = Input::get('name');
				$project->begin_at = Input::get('begin');
				$project->end_at = Input::get('end');
				$project->descriptionProject = Input::get('desc');
				$project->user_id = Input::get('user');
				$project->save();
				$content = 1;
				break;	
			case'2':
				return Redirect::to_action('admin@project');
				break;
			default:
				$content = 0;
		}
		return View::make('admin.new_project')->with('content', $content);
	}

	public function get_delProject()
	{
	}

	public function post_delProject()
	{
		if(!isset($content)){
			$content = 0;
		}
		$etape = Input::get('etape');
		$name = Input::get('name');
		$id = Input::get('id');
		switch ($etape) {
			case'0':
				$project = Project::find($id);
				$project->delete();
				$content = 1;
				break;
			case'1':
				return Redirect::to_action('admin@project');
				break;
			default:
				$content = 0;
		}
		return View::make('admin.del_project')->with(array(
			'content' => $content,
			'project' => $name,
			'id' => $id
			));
	}
}