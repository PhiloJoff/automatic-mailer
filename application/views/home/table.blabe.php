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
		<h1>McDonald's</h1>
	      <p>Retrouvez la liste de toutes les personnes ayant laissées leur email :</p>
	      <div id='import-mcdonald'>
	      </div>

	      {{ HTML::script('js/jquery.1.7.1.min.js') }}
	      {{ HTML::script('js/jquery.csvToTable.js') }}
	      {{ HTML::script('js/jquery.tablesorter.min.js') }}
	      {{ HTML::script('js/script.js') }}
	</body>
</html>