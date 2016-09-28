<?php

require "db_connection.php";
require "init.php";
loggedin();

if(isset($_REQUEST['id']))
{

			$id=$_REQUEST['id'];
			$q="select * from tbl_student_info where std_auto_id='$id'";
			$r=mysql_query($q);
			$row=mysql_fetch_array($r);
			$image=$row['std_pic'];
			$query="delete from tbl_student_info where std_auto_id='$id'";
			$result=mysql_query($query);
			if($result)
			{
				unlink($image);
				header('location:admin.php');
			}
			else
			{
				echo"somthing problem";
			}
}
?>
