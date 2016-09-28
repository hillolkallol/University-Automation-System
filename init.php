<?php
session_start();
$current_file  = $_SERVER['SCRIPT_NAME'];


function loggedin()
{
	if(isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_id']))
	{
		
			$id=$_SESSION['teacher_id'];
	}
}
?>