<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	if(isset($_REQUEST['id'])) 
{
			$id=$_REQUEST['id'];
			$query="delete from tbl_course_offer where offer_auto_id='$id'";
			$result=mysql_query($query);
			if($result)
			{
				header('location:view_courses.php');
			}
			else
			{
				echo"something problem";
			}
	
}

										
?>