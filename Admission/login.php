<?php
session_start();
include("db_connection.php");

if(isset($_POST['btn_login']))
{
	$user= mysql_real_escape_string(htmlentities(isset($_POST['user'])?$_POST['user']:null));
	$id= mysql_real_escape_string(htmlentities(isset($_POST['user_id'])?$_POST['user_id']:null));
	$pass= mysql_real_escape_string(htmlentities(isset($_POST['user_pass'])?$_POST['user_pass']:null));
	if($user==1)
	{
	
		$query="Select std_id,std_password From tbl_student_info Where std_id='$id'";
		$result=mysql_query($query);
		$check=mysql_num_rows($result);
		if($check==1)
		{
			$row=mysql_fetch_array($result);
			$password=$row['std_password'];
			$id=$row['std_id'];
			if($password==$pass)
			{
				$_SESSION['user_id']=$id;
				header('location:personal.php');
			}
			else
			{
				header('location:index.php');
				
			}
		}
		else
			{
				header('location:index.php');
				
			}
			
	}
	else if ($user==2)
	{
	
		$query="Select tch_id,tch_password From tbl_teacher_info Where tch_id='$id'";
		$result=mysql_query($query);
		$check=mysql_num_rows($result);
		if($check==1)
		{
			$row=mysql_fetch_array($result);
			$password=$row['tch_password'];
			$id=$row['tch_id'];
			if($password==$pass)
			{
				$_SESSION['user_id']=$id;
				header('location:personal_info_teacher.php');
			}
			else
			{
				header('location:index.php');
			}
		}
		else
			{
				header('location:index.php');
				
			}
			
	}
	else{
		header('location:index.php');
	}
	

}
?>