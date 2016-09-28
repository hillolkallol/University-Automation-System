<?php
	require 'config.php';
	ob_start();
	session_start();
	if(isset($_POST['userid']) && isset($_POST['userpass']))
	{
		$id = mysql_real_escape_string($_POST['userid']);
		$pass = mysql_real_escape_string($_POST['userpass']);
		//$id = $_POST['userid'];
		//$pass = $_POST['userpass'];
		$done=0;
		if(!empty ($id) && !empty($pass) )
		{
			$infoa = mysql_query("SELECT * FROM admin_info_exam");
			while($row = mysql_fetch_array($infoa))
			{
				if($row['admin_id']==$id && $row['admin_pass']==$pass)
				{
					$_SESSION['userida'] = $id;
					$_SESSION['userpassa'] = $pass;
					$done=1;
					header('Location: admin.php');
				}
				else continue;
			}
			
			if($done==0)
			{
				echo '<script type="text/javascript">';
				echo 'alert("Please Submit Correct  Username and Password!")';
				echo '</script>';
				include 'login.php';
			}
		}
		else  header('Location: login.php');
	}
?>

