<?php
session_start();

$q="select distinct dept_name,dept_id from tbl_department_info";
$r=mysql_query($q);

if(isset($_POST['btn_login']))
{
	$dept= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null));
	$uname= mysql_real_escape_string(htmlentities(isset($_POST['user_name'])?$_POST['user_name']:null));
	$pass= mysql_real_escape_string(htmlentities(isset($_POST['user_pass'])?$_POST['user_pass']:null));
	
		$query="Select * From tbl_dept_admin Where dadmin_name='$uname'";
		$result=mysql_query($query);
		$check=mysql_num_rows($result);
		if($check>=1)
		{
			$row=mysql_fetch_array($result);
			$name=$row['dadmin_name'];
			$password=$row['dadmin_password'];
			$id=$row['dadmin_auto_id'];
			$deptt=$row['dadmin_dept'];
			if( $deptt == $dept && $password==$pass)
			{
				$_SESSION['user_id']=$id;
				header('location:syllebus.php');
				
				
			}
			else
			{
				//header('location:index.php');
				echo '<script type="text/javascript">';
					echo 'alert("User/Password Does Not Match")';
					echo '</script>';
					echo '</script>';
				
			}
		}
		else
		{
			//header('location:index.php');
			echo '<script type="text/javascript">';
					echo 'alert("Department Does Not Match")';
					echo '</script>';
				
		}
			
}
?>