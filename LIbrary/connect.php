<?php


function getcon()
{
	$con= mysqli_connect('localhost','root','','db_leading');
	return $con;
}

?>