<?php
class Setup_Controller extends Base_Controller
{
	public $restful = true;

	public function get_index()
	{
		require_once 'application/libraries/setup.class.php';
		$Setup = new Setup();
		$content = $Setup->checkSetup();
		return View::make('setup.setup')->with('content', $content['msg']);
	}

	public function post_index()
	{
		return Redirect::to_action('setup@install');
	}

	public function get_install()
	{
		if(!isset($content)){
			$content = 0;
		}
		return View::make('setup.install')->with('content', $content);
	}

	public function post_install()
	{
		require_once 'application/libraries/setup.class.php';
		$etape = Input::get('etape');
		switch ($etape) {
		case'1':
			$Setup = new Setup();
			$user = trim(Input::get('userServer'));
			$psw = trim(Input::get('pswServer'));
			$status = $Setup->connectHost('localhost',$user,$psw);
			if ($status){
				$Setup->createDb("automaticMailer");
				require_once 'application/libraries/conf.class.php';
				$Conf = new AddConfToFile('application/config/config.php','w');
				$Conf->writeDefine('HOST', 'localhost');
				$Conf->writeDefine('USER', $user);
				$Conf->writeDefine('PSW', $psw);
				$Conf->writeDefine('DB', 'automaticMailer');
				$Conf->writeDefine('AUTHUSER', 'login');
				$Conf->writeEndTagPhp();
				$content= 1;
			} else {
				$content= -1;
			}
			break;
		case'2':
			$user = new User;
			$user->nameUser = Input::get('name');
			$user->fNameUser = Input::get('fname');
			$user->emailUser = Input::get('mail');
			$user->role = 'admin';
			$user->login = Input::get('login');
			$user->password = Hash::make(Input::get('pswUser'));
			$user->save();
			$content = 2;
			break;
		case'3':
			return Redirect::to('home');
			break;
		default:
			$content= 0;
		}
		return View::make('setup.install')->with('content', $content);
	}
}