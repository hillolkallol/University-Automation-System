<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_id']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(loggedin())
	{
		$id =mysql_real_escape_string( $_GET['id']);  
			$user_name=$_SESSION['usernamet'];
			$user_id=$_SESSION["teacher_id"];
		if (isset($_POST['submit'])) 
		{
			$id = mysql_real_escape_string($_POST['id']);
			$user_id=mysql_real_escape_string($_POST['user_id']);
			$text = mysql_real_escape_string($_POST['text']);
			$date =mysql_real_escape_string( $_POST['date']);
			$up_query = "UPDATE `notice_info` SET `text`='".mysql_real_escape_string($text)."' , `date`='".mysql_real_escape_string($date)."' WHERE `id`='".mysql_real_escape_string($id)."'";
			
			$res=mysql_query($up_query)  or die(mysql_error());

			header("location:t_n_action.php");
		}

		$sql = "SELECT * FROM notice_info WHERE `id`='$id'";
		$sql_result =  mysql_query($sql) or die(mysql_error());
		$fetch = mysql_fetch_assoc($sql_result) or die(mysql_error());
	  
		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<meta name="viewport" content="width=device-width, initial-scale=1.0">
			<title>Using Bootstrap modal</title>

			<!-- Bootstrap Core CSS -->
			<link href="../css/bootstrap.min.css" rel="stylesheet">
		</head>
		<body>
		<form method="post" action="t_editdata.php" role="form">
			<div class="modal-body">             
				<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $fetch['id'];?>" readonly="true"/>
				<div class="form-group">
					<label for="name">User ID :
					<input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_id ;?>" readonly="true"/>
					</label>
				</div>	
				<div class="form-group">
					<label for="name">User Name :
					<input type="text" class="form-control" id="user_id" value="<?php echo $fetch['user_name'];?>" readonly="true"/>
					</label>
				</div>	
				<div class="form-group">
					<label>Date :
						<input type="text" class="form-control" id="date" name="date" value="<?php echo $fetch['date'];?>" />
					</label>
				</div>	
				<div class="form-group">
					<label>Notice :
						<textarea id="text" name="text" class="form-control" rows="5" cols="50" ><?php echo$fetch['text']; ?></textarea>
					</label>
				</div>	
				
			</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</form>
		</body>
		</html>
<?php 
	}
	else  header('Location: ../teacher.php');
?>
