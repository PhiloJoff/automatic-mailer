<?php

class Subscrib_Controller extends Base_Controller {
	public $restful = true;

	public function get_index($project)
	{ 
		$table = new TableSQL();
		if($table->projectExist($project)){
			return View::make('user.subscrib')->with(array(
				'content'=> 0,
				'project' => $project
				));
		}
		return Response::error('404');
	}

	public function post_index()
	{
	}
}