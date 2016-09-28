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
		<form method="post" action="">

			<table class="table">
			<center><h3 style="background:#3276b1; width:60%; color:white;padding:8px; margin:10px 0px;">You Can Send Message to Libraian</h3></center>
				<tr>
					<td>Name *</td>
					<td><input  type="text" name="name" maxlength="50" required> </td>
				
					 <td>Email Address *</td>
					 <td><input  type="text" name="email" maxlength="40" required> </td>				 
				
				 	<td>Mobile Number *</td>
				 	<td><input  type = number name="mobile" min="150000000" max="99999999999" required></td>
				</tr>
			</table>
			<table class="table">
				<tr>
					 <td>Message *</td>
					 <td> <textarea  name="message" maxlength="560" cols="40" rows="6" required></textarea>				 
					 <input type="submit" value="Submit" name='contact_form'></td>
				</tr>
			</table>
		</form>
	</body>

	<?php	
	if(isset($_POST['contact_form']))
	{
		//include('connect.php');
		$con = getcon();
		$name = $_POST['name'];
		$email = $_POST['email'];
		$mobile = $_POST['mobile'];
		$message = $_POST['message'];

		$error_message = "";
	    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

	  	if(!preg_match($email_exp,$email))
	  	{
	    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  		}
  		$string_exp = "/^[A-Za-z .'-]+$/";
		if(!preg_match($string_exp,$name))
		{
		   $error_message .= 'The First Name you entered does not appear to be valid.<br />';
		}

		if(strlen($message) < 10) {
		  $error_message .= 'The Comments you entered do not appear to be valid.<br />';
		}
		if(strlen($error_message) > 0)
		{
		    echo $error_message;
		}

		else
		{
			$query = "INSERT INTO `contact_messages` (`sender_name`, `sender_mob`, `sender_email`, `message`,`time`)
					 VALUES ('$name', $mobile, '$email', '$message' ,now());";
			$result = mysqli_query($con,$query);

			if($result) echo "Message Sent Successful !!";
			else echo "Please Tray Again Later !";	
		}	
	}
?>

</html>