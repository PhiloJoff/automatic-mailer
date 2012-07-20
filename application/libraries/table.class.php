<?php

class TableSQL
{
	private $link;
	private $bdd;
	private $query;
	private $status;

	public	function __construct()
	{
		$host = Config::get('database.connections.mysql.host');
		$user = Config::get('database.connections.mysql.username');
		$psw = Config::get('database.connections.mysql.password');
		$db = Config::get('database.connections.mysql.database');
    	if($this->link = @mysql_connect($host,$user,$psw)){
    		if($this->_Bdd = @mysql_select_db($db))
				return true;
		}
		return false;
	}

	public function __destruct()
	{
		if($this->link){mysql_close($this->link);}
	}

	public function getTableUser()
	{
		$query = 'SELECT users.* 
	               FROM users;';
	    $statement = mysql_query($query) or die(mysql_error());
	    $tableSQL = '<table class =\'table\'>
	                    <tr class = \'table-condensed\'>
	                        <td class = \'table-bordered\'><b>ID</b></td>
	                        <td class = \'table-bordered\'><b>Nom</b></td>
	                        <td class = \'table-bordered\'><b>Prénom</b></td>
	                        <td class = \'table-bordered\'><b>Mail</b></td>
	                        <td class = \'table-bordered\'><b>Identifiant</b></td>
	                        <td class = \'table-bordered\'><b>Mot de passe</b></td>
	                        <td class = \'table-bordered\'><b>Action</b></td>
	                    </tr>';
	     
	    while($row = mysql_fetch_assoc($statement)) {
	        if(strcmp($row['role'], 'admin') != 0){

		        $tableSQL .= '
		        			<tr>
		                        <td class = \'table-bordered\'>' . $row['id'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['nameUser'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['fNameUser'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['emailUser'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['login'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['password'] . '</td>
		                        <td class = \'table-bordered\'>' . 
		                        Form::open('admin/delUser').
									Form::hidden('name', $row['nameUser']).
									Form::hidden('id', $row['id']).
									Form::submit('Supprimer').
								Form::close(). '</td>
		                    </tr>';
		    }
	    }
	     
	    $tableSQL .= '</table>';


		return $tableSQL;
	}

	public function getTableProject($user = null)
	{
		if($user == null){
			$query = 'SELECT projects.* 
		               FROM projects;';
        } else {
        	$query = 'SELECT projects.* 
		               FROM projects
		               WHERE user_ID = (
		               		SELECT id
		               		FROM users
		               		WHERE login = \'' . $user. '\')
		               		;';
        }
	    $statement = mysql_query($query) or die(mysql_error());
		$tableSQL = '<table class =\'table\'>
		                    <tr class = \'table-condensed\'>
		                        <td class = \'table-bordered\'><b>ID</b></td>
		                        <td class = \'table-bordered\'><b>Nom</b></td>
		                        <td class = \'table-bordered\'><b>Date de Création</b></td>
		                        <td class = \'table-bordered\'><b>Date de Début</b></td>
		                        <td class = \'table-bordered\'><b>Date de Fin</b></td>
		                        <td class = \'table-bordered\'><b>Description</b></td>';
		if($user == null){
		    $tableSQL .='<td class = \'table-bordered\'><b>Responsable</b></td>
		    			<td class = \'table-bordered\'><b>Action</b></td>';
		} 
		$tableSQL .= '</tr>';
		     
	    while($row = mysql_fetch_assoc($statement)) {
	    	$query2 = 'SELECT nameUser, fNameUser 
	               FROM users
	               WHERE id = '. $row['user_ID'] .';';
	        $statement2 = mysql_query($query2) or die(mysql_error());
	        while($row2 = mysql_fetch_assoc($statement2)) {
	        	$userName =  $row2['nameUser'];
		        $userFName = $row2['fNameUser'];
		    }
	        $tableSQL .= '
	        			<tr>
	                        <td class = \'table-bordered\'>' . $row['id'] . '</td>
	                        <td class = \'table-bordered\'><a href=\''. URL::base() .'/project/' . $row['nameProject'] . '\'>'. $row['nameProject'] .'</a></td>
	                        <td class = \'table-bordered\'>' . $row['created_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['begin_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['end_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['descriptionProject'] . '</td>';
	        if($user == null){
	        $tableSQL .= '<td class = \'table-bordered\'>' . $userName . ' ' . $userFName . '</td>
	                        <td class = \'table-bordered\'>' . 
		                        Form::open('admin/delProject/').
									Form::hidden('name', $row['nameProject']).
									Form::hidden('id', $row['id']).
									Form::submit('Supprimer', array(
										'img' => 'img/delUser.png'
										)).
								Form::close();
	        }
	        $tableSQL .='</td>
	                    </tr>';
		   
	    }
	    $tableSQL .= '</table>';


		return $tableSQL;
	}

	public function getSelectUsers()
	{
		$query = 'SELECT  users.*
					FROM users;';
		$statement = mysql_query($query) or die(mysql_error());
		$list = '<select name=\'user\' required>
					<option value=""></option>';
		while($row = mysql_fetch_assoc($statement)) {
			$list .='<option value =\'' . $row['id'] . '\'>'
				. $row['nameUser'] . ' ' . $row['fNameUser']
				. '</option>';
		}
		$list .= '</select>';
		return $list;
	}

	public function getTableMail($project)
	{
		$tableSQL = array(
			'exist' => false,
			'content' => '');

		$query='SELECT id
				FROM projects
				WHERE nameProject= \''. $project . '\';';
	    $statement = mysql_query($query) or die(mysql_error());
	    $row = mysql_fetch_assoc($statement);
	    if($row != null){
			$query = 'SELECT mails.* 
		               FROM mails
		               WHERE project_ID = (SELECT id
		               						FROM projects
		               						WHERE nameProject= \''. $project . '\');';
		    $statement = mysql_query($query) or die(mysql_error());
	    
		    $tableSQL['content'] = '<table class =\'table\'>
		                    <tr class = \'table-condensed\'>
		                        <td class = \'table-bordered\'><b>ID</b></td>
		                        <td class = \'table-bordered\'><b>Nom</b></td>
		                        <td class = \'table-bordered\'><b>Prénom</b></td>
		                        <td class = \'table-bordered\'><b>Mail</b></td>
		                        <td class = \'table-bordered\'><b>Ajouté le</b></td>
		                        <td class = \'table-bordered\'><b>IP</b></td>
		                        <td class = \'table-bordered\'><b>Image</b></td>
		                    </tr>';
		     
		    while($row = mysql_fetch_assoc($statement)) {

		        $tableSQL['content'] .= '
		        			<tr>
		                        <td class = \'table-bordered\'>' . $row['id'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['nameMail'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['fNameMail'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['emailMail'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['created_at'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['ip'] . '</td>
		                        <td class = \'table-bordered\'>' . $row['image'] . '</td>';
			    
		    }
		     
		    $tableSQL['content'] .= '</table>';
		    $tableSQL['exist'] = true;
		}

		return $tableSQL;	
	}

}