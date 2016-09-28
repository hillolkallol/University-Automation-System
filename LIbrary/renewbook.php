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
		//if(isset($_POST['aform']))
		if( isset( $_POST['action'] ) && 'book_id_info' == $_POST['action'] )

		{
			$book_id = $_POST['book_id'];

			$query = "SELECT * FROM `book_info` WHERE `book_id` = $book_id";
			$result = mysqli_query($con,$query);
			$valid = 0;
			$name = "";

			while($row=mysqli_fetch_array($result))
			{
				$book_title = $row['book_title'];
				$status = $row['status'];
				$book_number = $row['book_number'];
				$valid = 1;
			}
			
			if($valid!=1 ) 
			{
				echo '<script type="text/javascript">';
					echo 'alert("INPUT A VALID Book ID")';
				echo '</script>';
			}
			else
			{
				$query = "SELECT  `tbl_student_info`.`std_name`, std_email, book_transaction.user_id,book_transaction.transaction_id,
					libraryFine, DATE_FORMAT(`book_transaction`.`issue_date`,'%d %b %y') as 'issue_date',`renew_status`,
					NOW( ) AS return_date,DATEDIFF( NOW( ) , issue_date ) AS diff , day_limit
					FROM book_transaction , tbl_student_info,due_history
					WHERE book_number = $book_number 
					and `book_transaction`.`user_id` = `tbl_student_info`.`std_id`
					AND transaction_status = 0 
					AND due_history.studentId = tbl_student_info.std_id 
					LIMIT 1";
				$result = mysqli_query($con,$query);
				
				while($row=mysqli_fetch_array($result))
				{
					$issue_date = $row['issue_date'];
					$user_id = $row['user_id'];
					$transaction_id = $row['transaction_id'];
					$return_date = $row['return_date'];
					$diff = $row['diff'];
					$name =$row['std_name'];
					$email =$row['std_email'];
					$day_limit = $row['day_limit'];
					$fine = $row['libraryFine'];
					$renew_status = $row['renew_status'];
				}
				if(!$result || $status!=3) 
				{
					echo '<script type="text/javascript">';
						echo 'alert("No Transaction Found with this Book Id.")';
					echo '</script>';
				}
				else
				{ ?>
				<form action="" method="post" id="">
					<div class="table-responsive">
					<table class="table table-bordered">
					<tr>
						<td><b>Name :</b>
						<?php echo $name;?></td>
						<td><b>ID :</b>
						<?php echo $user_id;?></td>
						<td><b>Email :</b>
						<?php echo $email;?></td>
					</tr>
					<tr>
						<td><b>Fine :</b>
						<?php echo $fine."/-";?></td>
						<td><b>Book ID :</b>
						<?php echo $book_id;?></td>
						<td><b>Book Name :</b>
						<?php echo $book_title;?></td>
						
					</tr>
					
					<tr>
						
						<td><b>Issue Date :</b>
						<?php echo $issue_date;?></td>
						<td><b>Remaining Day :</b>
						<?php echo $day_limit - $diff." Days";?></td>
						<td>
							<b>Extand for - </b>
						<?php
							if ( $diff > $day_limit ) {
								echo '<script type="text/javascript">';
									echo 'alert(" Already On Fine")';
								echo '</script>';

							}
							else if ($day_limit >=30) {
							echo "Limit Eeceeded";
							}
							else if($renew_status ==0) echo "Renew Disable";
							else
								{
									echo '<select name="renew">';
									for($j=1;$j<=10;$j++)
									{
										echo '<option>'.$j.'</option>';
										if ($j + $day_limit >=30) break;
									}
									echo '</select>	';
									?>
						
							<input type="submit" value="Confirm" id="renew-submit" />
						</td>
					</tr>
					<tr>				
						<input type="hidden" name="action" value="request_renew" />
						<input type="hidden" name="transaction_id" value="<?php echo $transaction_id;?>">
						<input type="hidden" name="day_limit" value="<?php echo $day_limit ;?>">
								<?php
								}								
						?>
					</tr>
				
					<?php } }

					?>	

					</table>
				</div>
				</form>
		<?php
		} 
		//UPDATE `db_leading`.`book_transaction` SET `day_limit` = '11' WHERE `book_transaction`.`transaction_id` =675;
		
		

		
		?>	
		
</body>
</html>