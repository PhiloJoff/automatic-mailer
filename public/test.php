<?php

	Config::set('database.connections.mysql.host', $host);
	Config::set('database.connections.mysql.username', $user);
	Config::set('database.connections.mysql.password', $psw);
	Config::set('database.connections.mysql.database', $db);
	$host = Config::get('database.connections.mysql.host');
	$user = Config::get('database.connections.mysql.username');
	$psw = Config::get('database.connections.mysql.password');
	$db = Config::get('database.connections.mysql.database');
	echo $host, "<br \>", $user, "<br \>", $psw, "<br \>", $db, "<br \>";
