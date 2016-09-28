<?php

session_start();
$current_file  = $_SERVER['SCRIPT_NAME'];


function loggedin()
{
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
	{
		
			$id=$_SESSION['user_id'];
	}
	else
	{
		header("location:index.php");

	}
}
?>