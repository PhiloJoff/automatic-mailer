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
		if($this->link){
			mysql_close($this->link);
		}
	}

	public function getTableUser()
	{
		$query = 'SELECT users.* 
	               FROM users;';
	    $statement = mysql_query($query) or die(mysql_error());
	    $tableSQL = '<table class =\'table table-striped table-bordered table-condensed\'>
	                    <thead class = \'\'>
	                        <th class = \'header\'><b>ID</b></td>
	                        <th class = \'header\'><b>Nom</b></td>
	                        <th class = \'header\'><b>Prénom</b></td>
	                        <th class = \'header\'><b>Mail</b></td>
	                        <th class = \'header\'><b>Identifiant</b></td>
	                        <th class = \'header\'><b>Mot de passe</b></td>
	                        <th class = \'header\'><b>Action</b></td>
	                    </thead>';
	     
	    while($row = mysql_fetch_assoc($statement)) {
	        if(strcmp($row['role'], 'admin') != 0){

		        $tableSQL .= '
		        			<tr>
		                        <td class = \'\'>' . $row['id'] . '</td>
		                        <td class = \'\'>' . $row['nameUser'] . '</td>
		                        <td class = \'\'>' . $row['fNameUser'] . '</td>
		                        <td class = \'\'>' . $row['emailUser'] . '</td>
		                        <td class = \'\'>' . $row['login'] . '</td>
		                        <td class = \'\'>' . $row['password'] . '</td>
		                        <td class = \'\'>' . 
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
		$tableSQL = '<table class =\'table table-striped table-bordered table-condensed\'>
		                    <thead class = \'\'>
		                        <th class = \'header\'><b>ID</b></td>
		                        <th class = \'header\'><b>Nom</b></td>
		                        <th class = \'header\'><b>Date de Création</b></td>
		                        <th class = \'header\'><b>Date de Début</b></td>
		                        <th class = \'header\'><b>Date de Fin</b></td>
		                        <th class = \'header\'><b>Description</b></td>';
		if($user == null){
		    $tableSQL .='<th class = \'header\'><b>Responsable</b></td>
		    			<th class = \'header\'><b>Action</b></td>';
		} 
		$tableSQL .= '</thead>';
		     
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
	                        <td class = \'\'>' . $row['id'] . '</td>
	                        <td class = \'\'>
	                        	<a href=\''. URL::base() .'/project/' . 
	                        	str_replace(' ', '-' ,$row['nameProject']) . '\'>'. 
	                        	$row['nameProject'] .
	                        	'</a></td>
	                        <td class = \'\'>' . $row['created_at'] . '</td>
	                        <td class = \'\'>' . $row['begin_at'] . '</td>
	                        <td class = \'table-bordered\'>' . $row['end_at'] . '</td>
	                        <td class = \'\'>' . $row['descriptionProject'] . '</td>';
	        if($user == null){
	        $tableSQL .= '<td class = \'\'>' . $userName . ' ' . $userFName . '</td>
	                        <td class = \'\'>' . 
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
			if($row['id'] != 1){
				$list .='<option value =\'' . $row['id'] . '\'>'
				. $row['nameUser'] . ' ' . $row['fNameUser']
				. '</option>';
			}
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
	    $indexCB = 0;
	    if($row != null){
			$query = 'SELECT mails.* 
		               FROM mails
		               WHERE project_ID = (SELECT id
		               						FROM projects
		               						WHERE nameProject= \''. $project . '\');';
		    $statement = mysql_query($query) or die(mysql_error());
	    
		    $tableSQL['content'] = '<table id="tableSQL" class =\'table table-striped table-bordered table-condensed\' onload=\'tablesorter()\'>
		                    <thead class = \'\'>
		                    	<tr class = \'\'>
			                    	<th class = \'header\'>
			                    		<input type="checkbox" name="checkAll" value="'.$indexCB.'" onclick="check(this.checked)"> 
			                    	</th>
			                        <th class = \'header\'><b>ID</b></th>
			                        <th class = \'header\'><b>Nom</b></th>
			                        <th class = \'header\'><b>Prénom</b></th>
			                        <th class = \'header\'><b>Mail</b></th>
			                        <th class = \'header\'><b>Ajouté le</b></th>
			                        <th class = \'header\'><b>IP</b></th>
			                        <th class = \'header\'><b>Image</b></th>
			                        <th class = \'header\'><b>Action</b></th>
			                    </tr>
		                    </thead>';
		    $indexCB++;
		    $tableSQL['content'] .= '<tbody class = \'\'>';
		    while($row = mysql_fetch_assoc($statement)) {
		    	($indexCB % 2) ? $oddOrEven = 'odd' : $oddOrEven = 'even';
		        $tableSQL['content'] .= '
		        			<tr class="'.$oddOrEven.'">
		        				<td class = \'\'>
		                    		<input type="checkbox" name="check" > 
		                    	</td>
		                        <td class = \'\'>' . $row['id'] . '</td>
		                        <td class = \'\'>' . $row['nameMail'] . '</td>
		                        <td class = \'\'>' . $row['fNameMail'] . '</td>
		                        <td class = \'\'>' . $row['emailMail'] . '</td>
		                        <td class = \'\'>' . $row['created_at'] . '</td>
		                        <td class = \'\'>' . $row['ip'] . '</td>
		                        <td class = \'\'>' . 
		                        HTML::Image($row['image'], '', array('width' => '50','height' => '50')) . 
	                        	'</td>
                        	</tr>';
				$indexCB++;    
		    }
		     
		    $tableSQL['content'] .= '</tbody></table>';
		    $tableSQL['exist'] = true;
		}

		return $tableSQL;	
	}

}