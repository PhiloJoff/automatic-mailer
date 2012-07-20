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
	    <div id='header'>
	    	<h1>Administration</h1>
		</div>
		<div id='menu'>
			<ul id="onglets">
			    <li>{{ HTML::link_to_action('admin@user', 'Utilisateur') }}</li>
			    <li>{{ HTML::link_to_action('admin@project', 'Projet') }}</li>
			    <li>{{ HTML::link_to_action('admin@logout', 'Deconnexion') }}</li>
			</ul>
		</div>

<?php	switch($content) {
		case 1 :
?>
			<div>
				<h3>Liste des utilisateurs</h3>
				{{ HTML::image_link('admin/newUser', 'img/newUser.png', 'Ajouter Utilisateur', '', array('width' => '50','height' => '50')) }}
				{{ $table }}
			</div>
<?php
			break;
		case 2 :
?>
			<div>
				<h3>Liste des projets</h3>
				{{ HTML::image_link('admin/newProject', 'img/newProject.png', 'Ajouter Projet', '', array('width' => '50','height' => '50')) }}
				{{ $table }} 	
			</div>

<?php 	
			break;
		default :
	}
?>


	</body>
</html>