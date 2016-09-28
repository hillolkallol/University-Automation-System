<?php
session_start();


	if(isset($_POST['btn_login']))
	{
		$username = mysql_real_escape_string(htmlentities(isset($_POST['user_name'])?$_POST['user_name']:null));
		$password = mysql_real_escape_string(htmlentities(isset($_POST['user_pass'])?$_POST['user_pass']:null));

		$query  ="select * from tbl_admin where admin_name = '".mysql_real_escape_string($username)."'";
		$result =mysql_query($query);

		$check  =mysql_num_rows($result);
		if($check==1)
		{
			$row  = mysql_fetch_array($result);

			$pass =$row['admin_password'];

			$id   =$row['admin_auto_id'];

			if($pass == $password)
			{
				$_SESSION['user_id'] = $id;
				header("location:admin.php");
			}
			else
			{
				//echo"Password Does Not Match";
				echo '<script type="text/javascript">';
					echo 'alert("Password Does Not Match")';
					echo '</script>';
			}
		}
		else
		{
			//echo"You must forget to enter password/username";
			echo '<script type="text/javascript">';
			echo 'alert(" Password Does Not Match")';
			echo '</script>';
		}
	}
?>