<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>McDonald's</title>
		<meta name="viewport" content="width=device-width">
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/csvtable.css') }}
		{{ HTML::style('css/bootstrap.css') }}
	</head>
	<body>
		<h1>McDonald's</h1>
	    <p>Retrouvez la liste de toutes les personnes ayant laissées leur email :</p>
	    <div id="formLog">
	    	<form action="/login" method="post">
	    		<label for="login">Utilisateur</label><input type="text" name="login" id="login" required><br \>
				<label for="psw">Mot de passe</label><input type="password" name="psw" id="psw" required><br \>
				<input type="submit" name="action" value="Se Connecter" id="connection">
		</div>

	</body>
</html>