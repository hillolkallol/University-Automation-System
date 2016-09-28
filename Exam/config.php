<?php
	$con= mysql_connect('localhost','root');
	if(!$con)
	{
		die("Mysql Connection Error :(");
	}

	$db= mysql_select_db('db_leading',$con);
	if(!$db)
	{
		die("Database Connection Error :(");
	}
?>
