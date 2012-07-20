<?php

class project_Controller extends Base_Controller {

	public $restful = true;

	public function get_index()
	{ 
		return Redirect::to_action('home@login');
	}

	public function post_index()
	{
	}

	public function get_viewProject($project)
	{
		$table = new TableSQL;
		$content = $table->getTableMail($project);
		if($content['exist']){
			return View::make('project.project')->with(array(
				'header' => $project,
				'table' => $content['content']
				));
		}

		return Response::error('404');
	}

	public function post_viewProject()
	{
		return Redirect::to_action('home@login');
	}
}
