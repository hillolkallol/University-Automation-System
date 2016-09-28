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
		$id = mysql_real_escape_string($_GET['id']);
		$sql = "SELECT * FROM routine where id='$id'";
		$sql_result =  mysql_query($sql);
		$fetch = mysql_fetch_assoc($sql_result) or (mysql_error());
		// get correct file path
		$fileName = mysql_real_escape_string($fetch['name']);
		$fileid= mysql_real_escape_string($fetch['id']); 
		$filePath = mysql_real_escape_string($fetch['path']);
		if (isset($_GET['id'])) 
		{
			$id = $_GET['id'];
			$del = "DELETE from routine WHERE id='$id'";
			if(mysql_query($del))
			{
				if ( file_exists($filePath)) 
				{
					unlink(realpath($filePath));
					header('Location:up_routine.php');
				}
			}
			else echo "0";	
		}
	}
	else  header('Location: login.php');
?>




