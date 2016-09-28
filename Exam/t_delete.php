<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_id']))
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
			$id = mysql_real_escape_string($_GET['id']);
	
			$sql = "DELETE from notice_info WHERE id=$id";
			mysql_query($sql) or die(mysql_error());
			//echo "done"; 
			header("location:t_n_action.php");
		}
		else echo "0";
	}
	else  header('Location: ../teacher.php');
?>
