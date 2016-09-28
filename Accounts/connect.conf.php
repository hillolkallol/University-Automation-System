<?php
//error_reporting(E_ALL ^ E_DEPRECATED);
$mysql_host = 'localhost';
$mysql_user = 'root';
$mysql_pass = '';

$mysql_db = 'db_leading';

if(!mysql_connect($mysql_host, $mysql_user, $mysql_pass) || !mysql_select_db($mysql_db))
{
	die('Sorry! Database Connection Error!');
}
/*
else
{
	echo 'connected!';
}
*/
?>