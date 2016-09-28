<?php

require "db_connection.php";
require "init.php";
loggedin();

if(isset($_REQUEST['id']))
{

			$id=$_REQUEST['id'];
			$query="delete from tbl_department_info where dept_id='$id'";
			$result=mysql_query($query);
			if($result)
			{
				header('location:faculty.php');
			}
			else
			{
				echo"something problem";
			}
}
?>