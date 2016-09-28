<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	<form action="" method="post">
		<table>
			<tr>
				<td>Student ID</td>
				<td><input type="text" name="s_id" id="" /></td>
			</tr>				
			<tr>
				<td></td>
				<td><input type="submit" value="submit" name="aform"/></td>
			</tr>
		</table>
	
	</form>
</body>
</html>

<?php
	if(isset($_POST['aform']))
	{
		try
		{
			if(empty($_POST['s_id']))
			throw new Exception('Input the ID');
				
			$id=$_POST['s_id'];
			
			include('connect.php');
			$con_db = getcon();
			$query = "SELECT * FROM  `student_info` where `student_info`.`student_id` = $id ";
			$result = mysqli_query($con_db,$query);
			
			$temp = "125";
			
			echo "<table border='.5' cellpadding='5'>";
				
				while($row = mysqli_fetch_array($result)) {
					
					  echo "<tr>";
					  echo "<td>Student ID &nbsp&nbsp&nbsp&nbsp</td>";
					  echo "<td>". $row['student_id']. "&nbsp&nbsp&nbsp&nbsp</td>";
					  echo "</tr>";
					  
					  echo "<tr>";
					  echo "<td>Library ID </td>";
					  echo "<td>" . $row['library_id']. "</td>";
					  echo "</tr>";
					  
					  echo "<tr>";
					  echo "<td>Fine </td>";
					  echo "<td>" . $row['fine']. "</td>";
					  echo "</tr>";
					  $temp = $row['fine'];
				}				
			echo "</table>";
			

			if($temp == "0")
			{
				?>
				<form action="" method="post">
					<table>
						<tr>
							<td>Book ID</td>
							<td><input type="text" name="s_id" id="" /></td>
						</tr>				
						<tr>
							<td></td>
							<td><input type="submit" value="submit" name="bform"/></td>
						</tr>
					</table>
				
				</form>
			<?php
			}
		}
		catch(Exception $e)
		{
			$error=$e->getMessage();
		}
	}
?>
<?php
	if(isset($error))echo $error;
?>



<?php
	if(isset($_POST['bform']))
	{
		try
		{
			if(empty($_POST['s_id']))
			throw new Exception('Input the Book ID');
				
			$id=$_POST['s_id'];
			
			include('connect.php');
			$con_db = getcon();
			$query = "SELECT * FROM  `student_info` where `student_info`.`student_id` = $id ";
			$result = mysqli_query($con_db,$query);
			
			$temp = "0";
			
			echo "<table border='.5' cellpadding='5'>";
				
				while($row = mysqli_fetch_array($result)) {
					
					  echo "<tr>";
					  echo "<td>Student ID &nbsp&nbsp&nbsp&nbsp</td>";
					  echo "<td>". $row['student_id']. "&nbsp&nbsp&nbsp&nbsp</td>";
					  echo "</tr>";
					  
					  echo "<tr>";
					  echo "<td>Library ID </td>";
					  echo "<td>" . $row['library_id']. "</td>";
					  echo "</tr>";
					  
					  echo "<tr>";
					  echo "<td>Fine </td>";
					  echo "<td>" . $row['fine']. "</td>";
					  echo "</tr>";
					  $temp = $row['fine'];
				}				
			echo "</table>";
			

			if($temp == "0")
			{
				?>
				<form action="" method="post">
					<table>
						<tr>
							<td>Book ID</td>
							<td><input type="text" name="s_id" id="" /></td>
						</tr>				
						<tr>
							<td></td>
							<td><input type="submit" value="submit" name="bform"/></td>
						</tr>
					</table>
				
				</form>
			<?php
			}
		}
		catch(Exception $e)
		{
			$error=$e->getMessage();
		}
	}
?>
<?php
	if(isset($error))echo $error;
?>

