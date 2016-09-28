<?php
	include('connect.php');
	$con = getcon();
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>VIew On Borrow</title>
</head>
<body>
      <form method="post" action="">
  			<select name="catagory">
				<option value="on_fine">On Fine</option>
				<option value="on_borrow">On Borrow</option>
			</select>

			<input type="submit" value="submit" name="aform"/>
			<input type="hidden" name="action" value="catagory_info" />
		</form>
	<?php 
	
	if( isset( $_POST['action'] ) && 'catagory_info' == $_POST['action']  && "on_borrow" == $_POST['catagory'] )
	{
		echo "<h3>On Borrow </h3>";
		$query = " SELECT `user_info`.`user_id` ,`user_info`.`name` , `user_info`.`email` , `book_info`.`book_title`,`book_info`.`book_id`,
				`book_transaction`.`issue_date`, DATEDIFF( NOW( ) , issue_date ) AS diff, day_limit 
				from `book_info`,`book_transaction` ,`user_info`  
				WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
				and `book_transaction`.`transaction_status`= 0 
				and `book_transaction`.`user_id`= `user_info`.`user_id` 
				ORDER BY DATEDIFF( NOW( ) , issue_date ) DESC ";

		$result = mysqli_query($con,$query);
		$count=1;
		if($result)
		{ ?>
			<table border=1px solid cellspacing=2px cellpadding=5px>
				<tr>
					<td><b>Serial</b></td>
					<td><b>Book Id</b></td>
					<td><b>Book Title</b></td>
					<td><b>User Name</b></td>
					<td><b>User ID</b></td>
					<td><b>Issue Date</b></td>
					<td><b>Total Days</b></td>
				</tr>	
			<?php
			while($row1=mysqli_fetch_array($result))
			{
				echo "<tr>";
					echo "<td>".$count."</td>";
					echo "<td>".$row1['book_id']."</td>";
					echo "<td>".$row1['book_title']."</td>";
					echo "<td>".$row1['name']."</td>";
					echo "<td>".$row1['user_id']."</td>";
					echo "<td>".$row1['issue_date']."</td>";
					echo "<td>".$row1['diff']."</td>";
				echo "</tr>";
				$count++;
			}
			echo "</table>";					
		}
		if($count == 1)
			echo "<h2>No Data Found</h3>";
	}

	else
	{
		echo "<h3>On Fine </h3>";
		$query = " SELECT `user_info`.`user_id` ,`user_info`.`name` , `user_info`.`email` , `book_info`.`book_title`,`book_info`.`book_id`,
				`book_transaction`.`issue_date`, DATEDIFF( NOW( ) , issue_date ) AS diff, day_limit 
				from `book_info`,`book_transaction` ,`user_info`  
				WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
				and `book_transaction`.`transaction_status`= 0 
				and `book_transaction`.`user_id`= `user_info`.`user_id` 
				and day_limit< DATEDIFF( NOW( ) , issue_date )
				ORDER BY DATEDIFF( NOW( ) , issue_date ) DESC ";



		$result = mysqli_query($con,$query);
		$count=1;

		if($result)
		{		?>

			<table border=1px solid cellspacing=2px cellpadding=5px>
				
				<tr>
					<td><b>Serial</b></td>
					<td><b>Book Id</b></td>
					<td><b>Book Title</b></td>
					<td><b>User Name</b></td>
					<td><b>User ID</b></td>
					<td><b>Issue Date</b></td>
					<td><b>Total Days</b></td>
				</tr>	

			<?php
			while($row1=mysqli_fetch_array($result))
			{
				echo "<tr>";
					echo "<td>".$count."</td>";
					echo "<td>".$row1['book_id']."</td>";
					echo "<td>".$row1['book_title']."</td>";
					echo "<td>".$row1['name']."</td>";
					echo "<td>".$row1['user_id']."</td>";
					echo "<td>".$row1['issue_date']."</td>";
					echo "<td>".$row1['diff']."</td>";
				echo "</tr>";
				$count++;
			}
			echo "</table>";					
		}
		if($count == 1)
			echo "<h2>No Data Found</h3>";
	} 
	?>

</body>
</html>