<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
			
			$query="DELETE FROM `tbl_course_offer` WHERE 1";
			$result=mysql_query($query);
			if($result)
			{
				header('location:course_offer.php');
			}
			else
			{
				echo '<script type="text/javascript">';
					echo 'alert("something problem")';
					echo '</script>';
					echo '</script>';
			}
	


										
?>