<?php
	include('connect.php');
	$con = getcon();
?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>View Request</title>
</head>
<body>
	
	<?php 
	
	if( isset( $_POST['action'] ) && 'date_info' == $_POST['action'])
	{
		$StartDate = $_POST['StartDate'];
		$EndDate = $_POST['EndDate'];
		if($EndDate && $StartDate)
		{
			if($EndDate < $StartDate)
				{
					echo '<script type="text/javascript">';
						echo 'alert("Please Input A Valid Date Range")';
					echo '</script>';
				}
			else
			{
				echo "<h3>Books From ". $StartDate." To ".$EndDate."</h3>";
				$query = "SELECT * FROM `book_request` 
						WHERE `book_request`.`time`  BETWEEN '$StartDate' and '$EndDate' and buy_status = 0 
						ORDER BY  serial DESC";

					//	echo $query;

				$result = mysqli_query($con,$query);
				$count=1;

				if($result)
				{		
					?>
						<div class="table-responsive">
						  <table class="table table-bordered">							
								<tr  class="info" >								
									<td><b>Serial</b></td>
									<td><b>Requested By</b></td>
									<td><b>Book Title</b></td>
									<td><b>Author Name</b></td>
									<td><b>Edition</b></td>
									<td><b>Request Date</b></td>
								</tr>							
								
							<?php
							while($row1=mysqli_fetch_array($result))
							{
								echo "<tr>";
									echo "<td>".$row1['serial']."</td>";
									echo "<td>".$row1['user_id']."</td>";
									echo "<td>".$row1['book_title']."</td>";
									echo "<td>".$row1['author']."</td>";
									if($row1['edition'] == 0) echo "<td>Unknown</td>";
									else
									echo "<td>".$row1['edition']."</td>";
									echo "<td>".$row1['time']."</td>";
								echo "</tr>";
								$count++;
							}						
				}
				if($count == 1)
				{
					echo '<script type="text/javascript">';
						echo 'alert("No Request Found")';
					echo '</script>';
				}
			}
		}
			else
			{
				echo "<center><h3>Recent Requests</h3></center>";
				$query = "SELECT * FROM  `book_request` WHERE buy_status = 0 
						ORDER BY `serial` DESC  LIMIT 0 , 5";
				$con = getcon();
				$result = mysqli_query($con,$query);
				$count=1;

				if($result)
				{		
					?>
					<div class="table-responsive">
					  <table class="table table-bordered">							
						<tr  class="info">
						
							<td><b>Serial</b></td>
							<td><b>Requested By</b></td>
							<td><b>Book Title</b></td>
							<td><b>Author Name</b></td>
							<td><b>Edition</b></td>
							<td><b>Request Date</b></td>

						</tr>
						<?php
						while($row1=mysqli_fetch_array($result))
						{
						echo "<tr>";
								echo "<td>".$row1['serial']."</td>";
								echo "<td>".$row1['user_id']."</td>";
								echo "<td>".$row1['book_title']."</td>";
								echo "<td>".$row1['author']."</td>";
								if($row1['edition'] == 0) echo "<td>Unknown</td>";
								else
								echo "<td>".$row1['edition']."</td>";
								echo "<td>".$row1['time']."</td>";

						echo "</tr>";
							$count++;
						}
				}
				if($count == 1)
				{
					echo '<script type="text/javascript">';
						echo 'alert("No Request Found")';
					echo '</script>';
				}
				?>
					</table>
				</div>
				<?php
			}
	}
	?>	
					</table>
				</div>
					

</body>
</html>