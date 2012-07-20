<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<title>Administration - Suppression d'utilisateur</title>
		<meta name='viewport' content='width=device-width'>
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/bootstrap.css') }}
	</head>
	<body>
		<div id="formLog">
<?php 	
		switch($content) {
			case 1 :
?>
				<h3>Utilisateur supprimé !</h3>
				{{Form::open('admin/delUser/?etape=1')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
<?php 
				break;
			default :
?>
				<h3>Etes-vous sur de vouloir supprimer l'utilisateur {{ $user }} ?</h3>
				
				{{Form::open('admin/delUser/?etape=1')}}
					{{Form::submit('Non')}}
				{{Form::close()}}
				{{Form::open('admin/delUser/?etape=0')}}
					{{Form::hidden('id', $id)}}
					{{Form::submit('Oui')}}
				{{Form::close()}}


<?php
		}
?>
		</div>
	</body>
</html>