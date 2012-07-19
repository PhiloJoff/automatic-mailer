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
				<h3>Projet ajouté !</h3>
				{{Form::open('admin/newProject/?etape=2')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
<?php 
				break;
			default :
?>
				<h3>Création d'un nouveau projet</h3>
				
				{{Form::open('admin/newProject/?etape=1')}}
					{{Form::label('name', 'Nom')}}
					{{Form::text('name', '', array('required'))}}
					<br \>
					{{Form::label('desc', 'Description')}}
					{{Form::text('desc')}}
					<br \>
					{{Form::label('begin', 'Date de Début(AAAA-MM-JJ)')}}
					{{Form::text('begin')}}
					<br \>
					{{Form::label('end', 'Date de Fin(AAAA-MM-JJ)')}}
					{{Form::email('end')}}
					<br \>
					{{Form::label('user', 'Responsable')}}
					<?php echo $select ?>
					<br \>
					{{Form::submit('Valider')}}
				{{Form::close()}}


<?php
		}
?>
		</div>
	</body>
</html>