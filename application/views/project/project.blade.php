<!doctype html>
<html lang='en'>
	<head>
		<meta charset='utf-8'>
		<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>
		<title>Administration - Automatic Mailer</title>
		<meta name='viewport' content='width=device-width'>
		{{ HTML::style('css/style.css') }}
		{{ HTML::style('css/csvtable.css') }}
		{{ HTML::style('css/bootstrap.css') }}
	</head>
	<body id="home">
	    <div id='header'>
	    	<h1>{{ $project }}</h1>
		</div>
		<h3>Liste des contacts</h3>
		{{Form::open('')}}
				{{Form::submit('Retour')}}
		{{Form::close()}}
<?php
	switch ($case) {
		case '1':
?>
			<div id="table">
			</div>

			{{ HTML::script('js/jquery.1.7.1.min.js') }}
			{{ HTML::script('js/jquery.csvToTable.js') }}
			{{ HTML::script('js/jquery.tablesorter.min.js') }}
			{{ HTML::script('js/script.js') }}
			<script type="text/javascript">
				tableCsv('{{ $project }}');
			</script>
<?php
			break;
		default:
?>
			<div id="table">
			{{ $table }}
			<br \>
			</div>
			{{ HTML::script('js/script.js') }}
<?php
			break;
	}
?>		

	</body>
</html>