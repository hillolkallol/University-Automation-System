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
		<form method="post" action="" >
		<table>
			<tr>
				<td>Messages :</td>
				<td>
					<select name="type">
					<option>Inbox</option>
					<option>Archive</option>
					</select>
				</td>
				<td><input type="submit" value="Submit" name = "message_type"></td>
			</tr>
		</table>
	</form>

		<?php
			$id=$_SESSION['user_id'];
			//echo $id;
			if(isset($_POST['message_type']) && $_POST['type']=="Archive")
			{		
				$query = "SELECT * FROM `user_message` where `user_message`.`user_id`=$id and status = 2 ORDER BY id DESC  ";
				$result = mysqli_query($con,$query);
				
				$count = 0;
				echo "<b><br>Archived Messages : </b>";
				while($row = mysqli_fetch_array($result)) 
				{
					$count++;

					$id = $row['id'];
					$user_id = $row['user_id'];
					$admin_id = "Admin";
					$message = $row['message'];
					$time = $row['time'];

				?>
					<form method="post" action="">
					 <table>
					 	<tr>
					 		<td><b><br><?php echo $count;?> </b></td>
					 	</tr>
					 	<tr>
					 		<td><b>Sender :</b></td>
					 		<td><?php echo $admin_id; ?></td>					 		
					 	</tr>
					 	<tr>
					 		<td><b>Receiver :</b></td>
					 		<td><?php echo $user_id; ?></td>				 	
					 		<td><b>Time :</b></td>
					 		<td><?php echo date_format(date_create($time),"Y,M-d H:i");?></td>
					 	</tr>
					 	<tr>
					 		<td>Message :</td>
					 		<td>
					 			<textarea rows="8" cols="25" readonly> <?php echo $message;?></textarea>
					 		</td>
					 	</tr>					 	
					 </table>					
					 <input type="hidden" value="<?php echo $id;?>" name='id'>
					</form>		
				<?php			
				}
				if($count==0) echo "<h3>No Archived Messages Found </h3>";	
							

			}

			else
			{

				$query = "SELECT * FROM `user_message` where `user_message`.`user_id`=$id and status !=2  ORDER BY id DESC ";
				$result = mysqli_query($con,$query);
				$count = 0;

				echo "<b><br>Recent Sent Messages : </b>";
				while($row = mysqli_fetch_array($result)) 
				{
					$count++;

					$id = $row['id'];
					$user_id = $row['user_id'];
					$admin_id = "Admin";
					$message = $row['message'];
					$time = $row['time'];

				?>
					<form method="post" action="">
					 <table>
					 	<tr>
					 		<td><b><br><?php echo $count;?> </b></td>
					 	</tr>
					 	<tr>
					 		<td><b>Sender :</b></td>
					 		<td><?php echo $admin_id; ?></td>					 		
					 	</tr>
					 	<tr>
					 		<td><b>Receiver :</b></td>
					 		<td><?php echo $user_id; ?></td>				 	
					 		<td><b>Time :</b></td>
					 		<td><?php echo date_format(date_create($time),"Y,M-d H:i");?></td>
					 	</tr>
					 	<tr>
					 		<td>Message :</td>
					 		<td>
					 			<textarea rows="8" cols="25" readonly> <?php echo $message;?></textarea>
					 		</td>
					 	</tr>					 	
					 </table>
					 <input type="radio" value="Archive" name='group1'><b>Archive</b>	 
					 <input type="submit" value="Confirm" name='cofirm'>
					 <input type="hidden" value="<?php echo $id;?>" name='id'>
					</form>		
				<?php			
				}
				if($count==0) echo "<h3>No Recent Messages Found </h3>";
			}

			if(isset($_POST['cofirm']))
			{
				$id = $_POST['id'];
				echo $_POST['group1'];


				if ($_POST['group1'] == "Archive")
				 {
					$query = "UPDATE `user_message` SET `status` = 2 WHERE `user_message`.`id` = $id;";
					$result = mysqli_query($con,$query);
					if ($result) { 
						$show =  "Archived Successful !! ";
						echo "<script type='text/javascript'>alert('$show');</script>";						
					}
				}
				echo '<script type="text/javascript">';
					echo 'alert("Successful")';
				echo '</script>';
				//header('Location: view_messages_user.php');			
			}
		?>

	</body>
</html>