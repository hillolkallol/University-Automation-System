<?php
session_start();
include('connect.php');
	$con = getcon();
	if(isset($_POST['admin_log']))
	{
		if(isset($_POST['u_id']) && isset($_POST['pass']))
		{
			$userid=$_POST['u_id'];
			$pass=$_POST['pass'];
			$query = "select * from library_admin_info where admin_id='$userid' and password='$pass' ";
			$result = mysqli_query($con,$query);
			
			if(!$result)
			{
				echo '<script type="text/javascript">';
					echo 'alert("Invalid Username or Password combination!")';
				echo '</script>';
			}
			else
			{
				$count = 0;
				$name = "";
				//$email = "";
				//$fine = 0;
				
				while($row=mysqli_fetch_array($result))
				{
					$name = $row['name'];
					//$email = $row['email'];
					//$fine = $row['fine'];				
					$count++;				
				}
				if($count!=1)
				{
					session_destroy();
					//header('Location: loginhome.php');
					echo '<script type="text/javascript">';
						echo 'alert("Invalid User name or Password combination!")';
					echo '</script>';
					
				}
				else
				{
					$_SESSION['admin_id']=$userid;
					$_SESSION['password']=$pass;
					//echo $name." ->-".$userid." ->-".$email." ->-".$fine;
					if(isset($_SESSION['admin_id']) && isset($_SESSION['password']))
					header('Location: admin.php');
					else
					{
						echo '<script type="text/javascript">';
						echo 'alert("You Are Not Logged In")';
						echo '</script>';
					}
					
				}
			
				
			
			}
		}
	}

?>