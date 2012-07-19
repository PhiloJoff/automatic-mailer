<?php 
class Setup{
	
	private $_Link;
	private $_Bdd;
	private $_Query;
	private $_Status;
	
	public	function __construct(){
		
	}
	
	public function __destruct(){
		if($this->_Link){mysql_close($this->_Link);}
	}

	public function checkDb($host,$user,$psw,$db){
		if($this->_Link = @mysql_connect($host,$user,$psw)){
			if($this->_Bdd = @mysql_select_db($db)){
				$this->_Status = array('success'=> true, 'msg' => 'Ok');
			} else {
				$this->_Status = array('success'=> false, 'msg' => "la base de donnée n'existe pas");
			}
		} else {
			$this->_Status = array('success'=> false, 'msg' => "Impossible de se connecter à la base de données");
		}
		return $this->_Status; 
	}

	public function connectHost($host,$user,$psw){
		if($this->_Link = @mysql_connect($host,$user,$psw)){
			return true;
		} else {
			return false;
		}
	}

	public function connectDb($host,$user,$psw,$db){
		if($this->connectHost($host,$user,$psw)){
			if($this->_Bdd = @mysql_select_db($db)){
				return true;
			} 
		} 

		return false;
	}

	
	public function createConf($host,$user,$psw,$db){
		$this->_Query = 'drop table user_register';
		mysql_query($this->_Query);
	}
		
	public function createDb($db){

		$this->_Query='
		DROP DATABASE IF EXISTS '.$db.';';
		mysql_query($this->_Query) or die (mysql_error());

		$this->_Query='
		CREATE DATABASE IF NOT EXISTS '.$db.';';
		mysql_query($this->_Query) or die (mysql_error());

		$this->_Bdd = mysql_select_db($db);
		$this->_Query='
			CREATE TABLE IF NOT EXISTS users (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`nameUser` varchar(250) DEFAULT NULL,
			`fNameUser` varchar(250) DEFAULT NULL,
			`emailUser` varchar(250) DEFAULT NULL,
			`role` varchar(30) DEFAULT NULL,
			`login` varchar(250) NOT NULL,
			`password` varchar(250) NOT NULL,
			PRIMARY KEY (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
		mysql_query($this->_Query) or die (mysql_error());

		$this->_Query='
			CREATE TABLE IF NOT EXISTS projects (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`nameProject` varchar(250) NOT NULL,
			`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
			`begin_at` date DEFAULT NULL,
			`end_at` date DEFAULT NULL,
			`descriptionProject` varchar(250) DEFAULT NULL,
			`user_ID` int(11) unsigned,
			PRIMARY KEY (`id`),
			FOREIGN KEY(`user_ID`) REFERENCES users(`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8;';
		mysql_query($this->_Query) or die (mysql_error());
		
		$this->_Query='
			CREATE TABLE IF NOT EXISTS mails (
			`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
			`nameMail` varchar(250) DEFAULT NULL,
			`fNameMail` varchar(250) DEFAULT NULL,
			`emailMail` varchar(250) DEFAULT NULL,
			`created_at` date DEFAULT NULL,
			`ip` varchar(250) DEFAULT NULL,
			`image` varchar(250) DEFAULT NULL,
			`project_ID` int(11) unsigned,
			PRIMARY KEY(`id`),
			FOREIGN KEY(`project_ID`) REFERENCES projects(`id`)
			) ENGINE=InnoDB  AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;';
		mysql_query($this->_Query) or die (mysql_error());

		$this->_Query='
			CREATE TABLE IF NOT EXISTS options (
			`siteTitle` varchar(250) DEFAULT NULL,
			`siteDescription` varchar(250) DEFAULT NULL
			);';
		mysql_query($this->_Query) or die (mysql_error());

	}

	public function checkSetup(){
		$host = Config::get('database.connections.mysql.host');
		$user = Config::get('database.connections.mysql.username');
		$psw = Config::get('database.connections.mysql.password');
		$db = Config::get('database.connections.mysql.database');
    	if($this->connectDb($host, $user, $psw, $db)){
    		$content = array('installed'=> true,
    			'msg' =>'<h1>Il faut supprimer le fichier "setup.php" pour continuer !!<br \>
    			Actualiser après avoir supprimer le fichier "setup.php"</h1>');
    	} else {
    		$content = array('installed'=> false,
    			'msg' =>'
    			<h1>Une installation est nécessaire</h1> 
    			<form action="install/?etape=0", method="post">
			    <input type="submit" name="validate" value="Installer" id="validate">
			    </form>
    			');      
      }

    	return $content;
	}

	
}

?>