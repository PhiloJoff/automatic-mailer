<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>McDonald's</title>
		<meta name="viewport" content="width=device-width">
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/bootstrap.css') }}
	</head>
	<body>
		<div>
			<br />
			<h1>Automatic Mailer</h1>
			<h2>Gestionnaire de contact/projet</h2>
		</div>
	    <div id="formLog">
	    	{{Form::open('login')}}
				{{Form::label('login', 'Utilisateur')}}
				{{Form::text('login', '', array('required'))}}
				<br \>
				{{Form::label('psw', 'Mot de passe')}}
				{{Form::password('psw', array('required'))}}
				<br \>
				{{Form::submit('Connexion')}}
			{{Form::close()}}
		</div>

	</body>
</html>