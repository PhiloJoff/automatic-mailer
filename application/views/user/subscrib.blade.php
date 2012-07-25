<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<title>Automatic Mailer</title>
		<meta name='viewport' content='width=device-width'>
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/bootstrap.css') }}
	</head>
	<body>
	    <div id='header'>
	    	<h1>{{ $project }}</h1>
		</div>
		<div id="formLog">
<?php 	
		switch($content) {
			case 1 :
?>
				<h3>Contact ajouté !</h3>
				{{Form::open('admin/newProject/?etape=2')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
<?php 
				break;
			default :
?>
				<h3>Création d'un nouveau contact</h3>
				
				{{Form::open('admin/newProject/?etape=1')}}
					{{Form::label('name', 'Nom')}}
					{{Form::text('name')}}
					<br \>
					{{Form::label('fname', 'Prenom')}}
					{{Form::text('fname')}}
					<br \>
					{{Form::label('mail', 'E-mail')}}
					{{Form::email('mail')}}
					<br \>
					{{Form::label('date', 'Date d\'ajout(AAAA-MM-JJ)')}}
					{{Form::text('date')}}
					<br \>
					{{Form::label('img', 'Picture')}}
					{{Form::text('img')}}
					<br \>
					{{Form::reset('Reset')}}
					{{Form::submit('Valider')}}
				{{Form::close()}}



<?php
		}
?>
		</div>
	</body>
</html>