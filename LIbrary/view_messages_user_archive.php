<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<?php 
		//include('login.php');
		//include('connect.php');
		//$con = getcon();
	?>

		<?php
			$id=$_SESSION['user_id'];
			//echo $id;
			if(1)
			{		
				$query = "SELECT * FROM `user_message` where `user_message`.`user_id`=$id and status = 2 ORDER BY id DESC  ";
				$result = mysqli_query($con,$query);
				
				$count = 0;
			//	echo "<b><br>Archived Messages : </b>";
			?>
				<div class="table-responsive">
					<table class="table">
						<tr>
							<th>Serial</th>
							<th>Sender</th>
							<th>Time</th>
							<th>Message</th>
						</tr>
						<?php
						while($row = mysqli_fetch_array($result)) 
						{
							$count++;

							$id = $row['id'];
							$user_id = $row['user_id'];
							$admin_id = "Admin";
							$message = $row['message'];
							$time = $row['time'];

						?>
					
					 	<tr>
					 		<td><?php echo $count;?> </td>
					 		<td><?php echo $admin_id; ?></td>
					 		<td><?php echo date_format(date_create($time),"Y,M-d H:i");?></td>
					 		<td><?php echo $message;?></td>
					 	</tr>					 					
					 		
				<?php			
						}
				if($count==0) echo "<h3>No Archived Messages Found </h3>";	
							

			}

			if(isset($_POST['cofirm']))
			{
				$id = $_POST['id'];
				echo $_POST['group1'];


				if ($_POST['group1'] == "Archive")
				 {
					$query = "UPDATE `user_message` SET `status` = 2 WHERE `user_message`.`id` = $id;";
					$result = mysqli_query($con,$query);
				}

//header('Location: view_messages_user.php');		
				
					echo '<script type="text/javascript">';
						echo 'alert("Successful")';
					echo '</script>';
				
			}
			?>
			</table>	
		</div>
	</body>
</html>