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
	    	<h1> <?php echo Session::get('login') ?> </h1>
		</div>
		<div id='menu'>
			<ul id="onglets">
			    <li class="active">{{ HTML::link_to_action('user@project', 'Projet') }}</li>
			    <li>{{ HTML::link_to_action('user@logout', 'Deconnexion') }}</li>
			</ul>
		</div>

<?php	switch($content) {
		case 1 :
?>
			<div>
				<h3>Liste des projets</h3>
				<?php echo 	$table; ?>
			</div>

<?php 	
			break;
		default :
	}
?>


	</body>
</html>