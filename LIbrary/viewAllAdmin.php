<!DOCTYPE HTML>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<?php 
		include('connect.php');
		$con = getcon();
	
		
		$query =  "SELECT * FROM `library_admin_info` ";
		$result = mysqli_query($con,$query);
		$count = 0 ;

		while($row = mysqli_fetch_array($result))
		{
			$name =  $row['name'];
			$admin_id =  $row['admin_id'];
			$email =  $row['admin_email'];
			$number =  $row['contact_number'];
			echo "<b>".++$count."</b>";
			?>

			<table border="2">
				<tr>
					<td>Name : </td>
					<td><?php echo $name ?></td>
				</tr>
				<tr>
					<td>Id : </td>
					<td><?php echo $admin_id ?></td>
				</tr>
				<tr>
					<td>E-mail : </td>
					<td><?php echo $email ?></td>
				</tr>
				<tr>
					<td>Contact Number : </td>
					<td><?php echo $number ?></td>

			</table>
		<?php
		}
?>
	</body>
</html>