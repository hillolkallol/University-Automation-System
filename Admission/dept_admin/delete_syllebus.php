<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	if(isset($_REQUEST['id'])) 
{
			$id=$_REQUEST['id'];
			
			$query="delete from tbl_syllebus_info where syllebus_auto_id='$id'";
			$result=mysql_query($query);
			if($result)
			{
				header('location:create_syllebus.php');
			}
			else
			{
				echo"something problem";
			}
	
}

										
?>