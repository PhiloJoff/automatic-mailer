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
		if(file_exists('public/data/' . $project . '.csv')){
			return View::make('project.project')->with(array(
				'case' => '1',
				'project' => $project,
				'table' => ''
				));
		} else {
			$table = new TableSQL;
			str_replace('-', ' ', $project);
			$content = $table->getTableMail($project);
			if($content['exist']){
				return View::make('project.project')->with(array(
					'case' => '0',
					'project' => $project,
					'table' => $content['content']
					));
			}
		}

		return Response::error('404');
	}

	public function post_viewProject()
	{
		return Redirect::to_action('home@login');
	}
}
