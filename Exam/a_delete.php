<?php
require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['userida']) && !empty($_SESSION['userida']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(loggedin())
	{
		if (isset($_GET['id'])) 
		{
			$id = $_GET['id'];
			$sql = "DELETE from notice_info WHERE id='$id'";
			mysql_query($sql) or die(mysql_error());
			//echo "done"; 
			header("location:a_n_action.php");
		}
		else echo "0";
	}
	else  header('Location: login.php');
?>
