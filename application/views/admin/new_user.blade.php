<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<title>Administration - Automatic Mailer</title>
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
				<h3>Utilisateur ajouté !</h3>
				{{Form::open('admin/newUser/?etape=2')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
<?php 
				break;
			default :
?>
				<h3>Création d'un nouvel utilisateur</h3>
				
				{{Form::open('admin/newUser/?etape=1')}}
					{{Form::label('name', 'Nom')}}
					{{Form::text('name')}}
					<br \>
					{{Form::label('fname', 'Prenom')}}
					{{Form::text('fname')}}
					<br \>
					{{Form::label('mail', 'E-mail')}}
					{{Form::email('mail')}}
					<br \>
					{{Form::label('login', 'Identifiant')}}
					{{Form::text('login', '', array('required'))}}
					<br \>
					{{Form::label('pswUser', 'Mot de passe')}}
					{{Form::password('pswUser', array('required'))}}
					<br \>
					{{Form::submit('Valider')}}
				{{Form::close()}}
				{{Form::open('admin/newUser/?etape=2')}}
					{{Form::submit('Annuler')}}
				{{Form::close()}}


<?php
		}
?>
		</div>
	</body>
</html>