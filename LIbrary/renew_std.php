<?php 

	
	
	if( isset( $_POST['renew_book'] ))
	{
		$id=$_POST['id'];
		$book_name=$_POST['book_name'];
		$book_id;
		$book_number;
		//echo $id;
		//echo $book_name;
		$query = "SELECT `book_info`.`book_title`,`book_info`.`book_id`,`book_transaction`.`book_number`  
					from `book_info`,`book_transaction` 
					WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
					and `book_transaction`.`transaction_status`=0 and `book_transaction`.`user_id`=$id";
																		
			$arr = array();
			$result = mysqli_query($con,$query);
			$book_taken=0;
			while($row1=mysqli_fetch_array($result))
				{
					$arr[$book_taken]['book_title'] = $row1['book_title'];
					$arr[$book_taken]['book_number'] = $row1['book_number'];
					$arr[$book_taken]['book_id'] = $row1['book_id'];
					$book_taken++;
		
		}
		for($i=0;$i<$book_taken;$i++)
			{
				$name=$arr[$i]['book_title'];
				
				if($name==$book_name)
				{
					$book_id=$arr[$i]['book_id'];
					$book_number=$arr[$i]['book_number'];
				}
			}
			//echo $book_id;
			$query = "SELECT  `tbl_student_info`.`std_name`, std_email, book_transaction.user_id,
					book_transaction.transaction_id,`libraryFine`,
					DATE_FORMAT(`book_transaction`.`issue_date`,'%d %b %y') as 'issue_date',renew_status,
				NOW( ) AS return_date,DATEDIFF( NOW( ) , issue_date ) AS diff , day_limit
						FROM book_transaction , tbl_student_info,due_history
						WHERE book_number = $book_number 
						and `book_transaction`.`user_id` = `tbl_student_info`.`std_id`
						and due_history.studentId = tbl_student_info.std_id
						AND transaction_status = 0";
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
					
					?>
					<form action="student.php" method="post" id="">
						<div class="table-responsive">
						<table class="table table-bordered">
						
						<tr>
							<td><b>Book ID :</b></td>
							<td><b>Book Name :</b></td>
							<td><b>Issue Date :</b></td>
							<td><b>Remaining Date :</b></td>
							
						</tr>
						
						<tr>
							<td><?php echo $book_id;?></td>
							<td><?php echo $book_name;?></td>
							<td><?php echo $issue_date;?></td>
							<td><?php echo $day_limit-$diff." Days";?></td>
							<td>
								
							<?php
								if ( $diff > $day_limit ) {
									echo '<script type="text/javascript">';
										echo 'alert(" Can not renew your book after 10 days")';
									echo '</script>';

								}
								else if ($day_limit >=30) {
								echo "Limit Exceeded";
								}
								else if($renew_status == 0) echo "Renew Disable";
								else
									{
								?>		<b>Extand for : </b>
								<?php
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
					
						

						</table>
					</div>
				</form>
				<?php
				}
				?>				<?php
										if( isset( $_POST['action'] ) && 'request_renew' == $_POST['action'] ){
											$transaction_id = $_POST['transaction_id'];
											$day_limit = $_POST['day_limit'];
											$renew = $_POST['renew'];
											$max = $day_limit + $renew ;

											$query = "UPDATE `db_leading`.`book_transaction` SET `day_limit` = $max  WHERE `book_transaction`.`transaction_id` = $transaction_id";
											//echo $query ;
											$result = mysqli_query($con,$query);
											if($result)
											{
												 echo '<script type="text/javascript">';
													echo 'alert("Book Renew is Successfull")';
												echo '</script>';
											}
											else
											{
												 echo '<script type="text/javascript">';
													echo 'alert(" Sorry Try Again")';
												echo '</script>';
											}
											
													
											}
									?>