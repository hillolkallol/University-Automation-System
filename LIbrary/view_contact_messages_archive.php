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
	
				$query = "SELECT * FROM `contact_messages` where status = 0 ORDER BY id DESC  ";
				$result = mysqli_query($con,$query);
				
				$count = 0;
				echo "<b><br>Archived Messages : </b>";
				while($row = mysqli_fetch_array($result)) 
				{
					$count++;

					$id = $row['id'];
					$name = $row['sender_name'];
					$mobile = $row['sender_mob'];
					$email = $row['sender_email'];
					$message = $row['message'];
					$time = $row['time'];

				?>
					<form method="post" action="">
					 <table>
					 	<tr>
					 		<td><b><br><?php echo $count;?> </b></td>
					 	</tr>
					 	<tr>
					 		<td><b>Name :</b></td>
					 		<td><?php echo $name; ?></td>
					 		<td><b>Time :</b></td>
					 		<td><?php echo date_format(date_create($time),"Y,M-d H:i");?></td>
					 	</tr>
					 	<tr>
					 		<td><b>Mobile :</b></td>
					 		<td><?php echo $mobile; ?></td>				 	
					 		<td><b>Email :</b></td>
					 		<td><?php echo $email;?></td>
					 	</tr>
					 	<tr>
					 		<td>Message :</td>
					 		<td>
					 			<textarea rows="8" cols="25" readonly> <?php echo $message;?></textarea>
					 		</td>
					 	</tr>					 	
					 </table>
					 <input type="radio" value="Recent" name='group1'><b>Recent</b>
					 <input type="radio" value="Delete" name='group1'><b>Delete</b>		 
					 <input type="submit" value="Move" name='cofirm'>
					 <input type="hidden" value="<?php echo $id;?>" name='id'>
					</form>		
				<?php			
				}
				if($count==0) echo "<h3>No Archived Messages Found </h3>";	
							


			if(isset($_POST['cofirm']))
			{
				$id = $_POST['id'];
				echo $_POST['group1'];

				if ($_POST['group1'] == "Delete")
				 {
					$query = "DELETE contact_messages from contact_messages where id = $id";
					$result = mysqli_query($con,$query);
					if ($result) { 
						$show =  "Delete Successful !! ";
						echo "<script type='text/javascript'>alert('$show');</script>";						
					}
				}

				else if ($_POST['group1'] == "Archive")
				 {
					$query = "UPDATE `contact_messages` SET `status` = 0 WHERE `contact_messages`.`id` = $id;";
					$result = mysqli_query($con,$query);
					if ($result) { 
						$show =  "Archived Successful !! ";
						echo "<script type='text/javascript'>alert('$show');</script>";						
					}
				}

				else if ($_POST['group1'] == "Recent")
				 {
					$query = "UPDATE `contact_messages` SET `status` = 1 WHERE `contact_messages`.`id` = $id;";
					$result = mysqli_query($con,$query);
					if ($result) {
						$show =  "Successful !! ";					
						echo "<script type='text/javascript'>alert('$show');</script>";						
					}
				}
				//header('Location: admin.php');
				
			}
			
		?>

	</body>
</html>