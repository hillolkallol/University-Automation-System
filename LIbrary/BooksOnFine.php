<?php
	include('connect.php');
	$con = getcon();
?>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<form action="" method="post">
		<h3> Select a date range to view Books On Fine </h3>
		<table>
			<tr>
				<td>Start Date</td>
				<td><input type="date" required name="StartDate" value = "" /> </td>			
			</tr>
			<tr>
				<td>End Date</td>
				<td><input type="date" required name="EndDate" value = "" /> </td>			
			</tr>
			<tr>
			<td><input type="submit" value="submit" name="aform"/></td>
			</tr>
			<input type="hidden" name="action2" value="date_info" />
		</table>
	</form>
		<?php
		if(isset( $_POST['action2'] ) && 'date_info' == $_POST['action2'])
		{			
			$StartDate = $_POST['StartDate'];
			$EndDate = $_POST['EndDate'];
			if($EndDate < $StartDate) echo "\nPlease Input Valid Date Range";
			else
			{
				$query = "SELECT book_info.book_id ,
					book_info.book_title,
					issue_date , return_date ,  issue_by ,user_id,
					( DATEDIFF( now() , issue_date ) - day_limit ) AS fine
					From book_info , book_transaction 
					Where book_transaction.book_number =  book_info.book_number
					and DATEDIFF( now() , issue_date ) > day_limit
					and transaction_status = 0
					Order by transaction_id DESC ";
					
				$result = mysqli_query($con,$query);
				$found = 0;
				?>
				<!-- Table to Show Last 5 history  -->
				<table border=1px solid cellspacing=2px cellpadding=5px>
				<?php
				while($row1 = mysqli_fetch_array($result))
				{
					if($found===0)
					{
					?>
						<tr>
							<td><b>Book ID</b></td>
							<td><b>Book Title</b></td>
							<td><b>Borrow By</b></td>
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
							<td><?php echo $row1['user_id'];?></td>
							<td><?php echo $row1['issue_date'];?></td>
							<td>
							<?php 
								if($row1['return_date'] == "0000-00-00 00:00:00")
								echo "On Borrow";						
								else echo $row1['return_date'];
							?>
							</td>							
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
				</table>
			<?php
				if($found != 1) echo "NO Trancation Found";
			}
		}






			else
			{					
				$query = "SELECT book_info.book_id ,
					book_info.book_title,
					issue_date , return_date ,  issue_by ,user_id,
					( DATEDIFF( now() , issue_date ) - day_limit ) AS fine
					From book_info , book_transaction 
					Where book_transaction.book_number =  book_info.book_number
					and DATEDIFF( now() , issue_date ) > day_limit
					and transaction_status = 0
					Order by transaction_id DESC 
					LIMIT 0 , 1 ";
					
				$result = mysqli_query($con,$query);
				$found = 0;
				?>
				<!-- Table to Show Last 5 history  -->
				<table border=1px solid cellspacing=2px cellpadding=5px>
				<?php
				while($row1 = mysqli_fetch_array($result))
				{
					if($found===0)
					{
					?>
						<tr>
							<td><b>Book ID</b></td>
							<td><b>Book Title</b></td>
							<td><b>Borrow By</b></td>
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
							<td><?php echo $row1['user_id'];?></td>
							<td><?php echo $row1['issue_date'];?></td>
							<td>
							<?php 
								if($row1['return_date'] == "0000-00-00 00:00:00")
								echo "On Borrow";						
								else echo $row1['return_date'];
							?>
							</td>							
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
				</table>
			<?php
			}

		?>
	</body>
</html>