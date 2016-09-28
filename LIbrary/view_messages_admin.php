<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<?php 
		//include('connect.php');
		//$con = getcon();
	?>

		<?php
			if(1)
			{

				$query = "SELECT * FROM `user_message` where status = 1  ORDER BY id DESC ";
				$result = mysqli_query($con,$query);
				$count = 0;

				echo "<b><br>Recent Sent Messages : </b>";
				while($row = mysqli_fetch_array($result)) 
				{
					$count++;

					$id = $row['id'];
					$user_id = $row['user_id'];
					$admin_id = $row['admin_id'];
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
					 		<td><b>Sent To :</b></td>
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
					 <input type="radio" value="Delete" name='group1'><b>Delete</b>		 
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
				//echo $_POST['group1'];

				if ($_POST['group1'] == "Delete")
				 {
					$query = "DELETE user_message from user_message where id = $id";
					$result = mysqli_query($con,$query);
				}

				if ($_POST['group1'] == "Archive")
				 {
					$query = "UPDATE `user_message` SET `status` = 0 WHERE `user_message`.`id` = $id;";
					$result = mysqli_query($con,$query);
				}
		
			}
		?>

	</body>
</html>