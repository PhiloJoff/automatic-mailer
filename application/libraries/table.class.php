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

	public function getTableUser($options = null)
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
	                        <td class = \'table-bordered\'><b>Login</b></td>
	                        <td class = \'table-bordered\'><b>MDP</b></td>
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

	public function getTableProject($options = null)
	{
		$query = 'SELECT projects.* 
	               FROM projects;';
	    $statement = mysql_query($query) or die(mysql_error());
		$tableSQL = '<table class =\'table\'>
		                    <tr class = \'table-condensed\'>
		                        <td class = \'table-bordered\'><b>ID</b></td>
		                        <td class = \'table-bordered\'><b>Nom</b></td>
		                        <td class = \'table-bordered\'><b>Date de Création</b></td>
		                        <td class = \'table-bordered\'><b>Date de Début</b></td>
		                        <td class = \'table-bordered\'><b>Date de Fin</b></td>
		                        <td class = \'table-bordered\'><b>Description</b></td>
		                        <td class = \'table-bordered\'><b>Responsable</b></td>
		                        <td class = \'table-bordered\'><b>Action</b></td>
		                    </tr>';
		     
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
	                        <td class = \'table-bordered\'>' . $row['nameProject'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['created_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['begin_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['end_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['descriptionProject'] . '</td>
	                        <td class = \'table-bordered\'>' . $userName . ' ' . $userFName . '</td>
	                        <td class = \'table-bordered\'>' . 
	                        Form::open('admin/delProject/').
								Form::hidden('name', $row['nameProject']).
								Form::hidden('id', $row['id']).
								Form::submit('Supprimer').
							Form::close(). 
							'</td>
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
}