<!DOCTYPE html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title>Automatic-Mailer</title>
	</head>
	<body>
		<h1>Installation de Automatic-Mailer</h1>
		<div id="formLog">
		<?php 
		switch($content) {
			case 1 :
		?>
				<h3>Création de la base de donnée effectuée</h3>
				<h3>La création d'un administrateur est requis</h3>
				
				{{Form::open('install/?etape=2')}}
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
		<?php 	
				break;
			case 2 :
		?>
				<h3>Fin de l'installation</h3>
				<h4>N'oubliez pas de supprimer le fichier "setup.php" dans le dossier controller afin de pour continuer</h4>
				{{Form::open('install/?etape=3')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
		<?php 
				break;
			case -1 :
		?>
				<h3>Erreur de connection au serveur</h3>
				<h3>Veuillez renseigner les informations nécessaires pour créer la base de donnée que va utiliser Dynamic Mailer</h3>
				
				{{Form::open('install/?etape=1')}}
					{{Form::label('userServer', 'Utilisateur')}}
					{{Form::text('userServer', '', array('required'))}}
					<br \>
					{{Form::label('pswServer', 'Mot de passe')}}
					{{Form::password('pswServer', array('required'))}}
					<br \>
					{{Form::submit('Valider')}}
				{{Form::close()}}
		<?php 
				break;
			default:
		?>
				<h3>Veuillez renseigner les informations nécessaires pour créer la base de donnée que va utiliser Dynamic Mailer</h3>
				
				{{Form::open('install/?etape=1')}}
					{{Form::label('userServer', 'Utilisateur')}}
					{{Form::text('userServer', '', array('required'))}}
					<br \>
					{{Form::label('pswServer', 'Mot de passe')}}
					{{Form::password('pswServer', array('required'))}}
					<br \>
					{{Form::submit('Valider')}}
				{{Form::close()}}
		<?php
		}
		?>
		</div>
	</body>
</html>