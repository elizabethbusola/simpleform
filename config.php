<?php

define("DBHOST", "localhost");
define("DBNAME", "mine");
define("DBUSER", "root");
define("DBPASS", "");

#dsn
$dsn = 'mysql:host=' .DBHOST. ';dbname=' . DBNAME; 
$options = array(
		PDO::ATTR_PERSISTENT => true,
		PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
	); 
	try{
		$conn = new PDO($dsn, DBUSER, DBPASS, $options);

	}catch(PDOException $e){
		$error = $e->getMessage();

	}