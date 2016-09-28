<?php

ob_start();
session_start();
$current_file = $_SERVER['SCRIPT_NAME'];

function loggedin()
{
	if(isset($_SESSION['sessionUsername']) && !empty($_SESSION['sessionUsername']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

?>