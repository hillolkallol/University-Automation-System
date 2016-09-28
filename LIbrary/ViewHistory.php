<?php
	include('connect.php');
	$con = getcon();
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
	
	<?php 
		
		 if(isset( $_POST['action2'] ) && 'date_info' == $_POST['action2'])
		{
			
			$user_id = $_POST['user_id'];
			$StartDate = $_POST['StartDate'];
			$EndDate = $_POST['EndDate'];
			if($EndDate < $StartDate)
			{
				echo '<script type="text/javascript">';
					echo 'alert("Please Input A Valid Date Range.")';
				echo '</script>';
			}
			else
			{
				$query = "SELECT book_info.book_id ,
							book_info.book_title,
							issue_date , return_date ,  issue_by , 
							( DATEDIFF( return_date , issue_date ) - day_limit ) AS fine
							From book_info , book_transaction 
							Where book_transaction.book_number =  book_info.book_number
							and user_id = $user_id
							and (( issue_date BETWEEN '$StartDate' and '$EndDate' ) or 
								( return_date BETWEEN '$StartDate' and '$EndDate' ))
							Order by transaction_id DESC ";
					
				$result = mysqli_query($con,$query);
				$found = 0;
				?>
				<!-- Table to Show Last 5 history  -->
				<div class="table-responsive">
					<table class="table table-bordered">
					<?php
					while($row1 = mysqli_fetch_array($result))
					{
						if($found===0)
						{
						?>
							<tr>
								<td><b>Book ID</b></td>
								<td><b>Book Title</b></td>
								<td><b>Issue Date</b></td>
								<td><b>Return Date</b></td>
								<td><b>Issue By</b></td>
								<td><b>Fine</b></td>
							</tr>					
						<?php					
							$found = 1;
						}
						?>
							<tr>
								<td><?php echo $row1['book_id'];?></td>
								<td><?php echo $row1['book_title'];?></td>
								<td><?php echo $row1['issue_date'];?></td>
								<td><?php echo $row1['return_date'];?></td>
								<td><?php echo $row1['issue_by'];?></td>
								<td>

								<?php 
									if($row1['fine']>0) echo $row1['fine'];
									else echo"0";
								?>
								</td>
							</tr>
				<?php
					}
				?>

					</table>  <!-- End Of Table to Show history  -->
				</div>
	<?php
			}
		}
	else
	{	
			$query = "SELECT book_info.book_id ,
					book_info.book_title,
					issue_date , return_date ,  issue_by , 
					( DATEDIFF( return_date , issue_date ) - day_limit ) AS fine
					From book_info , book_transaction 
					Where book_transaction.book_number =  book_info.book_number
					and user_id = $user_id
					Order by transaction_id DESC 
					Limit 0,5" ;
					
			$result = mysqli_query($con,$query);
			$found = 0;

			?>
			<!-- Table to Show Last 5 history  -->
			<div class="table-responsive">
				<table class="table table-bordered">
				<?php
					while($row=mysqli_fetch_array($result))
					{
						if($found===0)
						{
						?>
							<tr>
								<td><b>Book ID</b></td>
								<td><b>Book Title</b></td>
								<td><b>Issue Date</b></td>
								<td><b>Return Date</b></td>
								<td><b>Issue By</b></td>
								<td><b>Fine</b></td>
							</tr>					
						<?php					
							$found = 1;
						}
						?>
							<tr>
								<td><?php echo $row['book_id'];?></td>
								<td><?php echo $row['book_title'];?></td>
								<td><?php echo $row['issue_date'];?></td>
								<td><?php echo $row['return_date'];?></td>
								<td><?php echo $row['issue_by'];?></td>
								<td>

									<?php 
										if($row['fine']>0) echo $row['fine'];
										else echo"0";
									?>
								</td>
							</tr>
						<?php

					}
					?>
					</table>  <!-- End Of Table to Show Last 5 history  -->
				</div>
				<?php
		}
?>	
		
</body>
</html>