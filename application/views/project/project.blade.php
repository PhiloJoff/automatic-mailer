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
	    	<h1>{{ $header }}</h1>
		</div>
		<div>
			<h3>Liste des contacts</h3>
			{{Form::open('')}}
					{{Form::submit('Retour')}}
				{{Form::close()}}
			{{ $table }}
		</div>



	</body>
</html>