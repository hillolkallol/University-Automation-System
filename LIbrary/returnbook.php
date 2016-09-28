<?php
	include('login.php')
?>
<?php
	$user_id=$_SESSION['admin_id'];
	$pass=$_SESSION['password'];
	$query="select * from library_admin_info where admin_id='$user_id' and password='$pass' ";
	$result = mysqli_query($con,$query);
		foreach($result as $row)
		{
			$name=$row['name'];
			$id=$row['admin_id'];
		}
		//echo $name;
?>

<?php 
								//include('connect.php');
								$con = getcon();
								
									$book_id = $_POST['book_id'];

									$query = "SELECT * FROM `book_info` WHERE `book_id` = $book_id";
									$result = mysqli_query($con,$query);
									$valid = 0;

									while($row=mysqli_fetch_array($result))
									{
										$book_title = $row['book_title'];
										$status = $row['status'];
										$book_number = $row['book_number'];
										$campus_name = $row['campus_name'];										
										$shelf_number = $row['shelf_number'];
										$valid = 1;
									}
									
									if($valid!=1) echo "INPUT A VALID Book ID";
									else
									{
										$query = "SELECT book_transaction.user_id, DATE_FORMAT(`book_transaction`.`issue_date`,'%d %b %y') as 'issue_date',
										NOW( ) AS return_date,DATEDIFF( NOW( ) , issue_date ) AS diff , day_limit
												FROM book_transaction
												WHERE book_number = $book_number
												AND transaction_status = 0";
										$result = mysqli_query($con,$query);
										
										while($row=mysqli_fetch_array($result))
										{
											$issue_date = $row['issue_date'];
											$user_id = $row['user_id'];
											$return_date = $row['return_date'];
											$diff = $row['diff'];
											$day_limit = $row['day_limit'];
										}
										if(!$result || $status!=3)
											{
												echo '<script type="text/javascript">';
													echo 'alert("No Transaction Found with this Book Id.")';
												echo '</script>';
											}
									
										else
										{
											$query ="UPDATE book_transaction SET return_date = NOW( ) ,
													transaction_status =1 , `issue_by` = '$name'
													 WHERE user_id=$user_id AND book_number = $book_number AND transaction_status =0;";
												//	echo $query;
											$result = mysqli_query($con,$query);
											if($result)
											{
												$fine = 0;
												if($diff > $day_limit) $fine = $diff-$day_limit;
												if(strlen($user_id)>7)
												{
													$query ="UPDATE book_info,due_history
														SET STATUS = 1, libraryFine = (libraryFine+$fine) 
														WHERE book_id =$book_id AND book_number = $book_number and studentId = $user_id";
														$result = mysqli_query($con,$query);
												}
												else
												{
													$query ="UPDATE book_info
														SET STATUS = 1 WHERE book_id =$book_id AND book_number = $book_number";
														$result = mysqli_query($con,$query);
												}
												?>
												<h3 style="color:#3276b1;">Book Received Successfully</h3> 
												<div class="table-responsive">
													<table class="table table-bordered">
														<tr class="info">
															<td>User Id</td>
															<td>Book Id</td>
															<td>Issue Date</td>
															<td>Return Date</td>
															<td>Day Taken</td>
															<td>Fine</td>
															<td>Location</td>
														</tr>
														<tr>
															<td><?php echo $user_id;?></td>
															<td><?php echo $book_id;?></td>
															<td><?php echo $issue_date;?></td>
															<td><?php echo $return_date;?></td>
															<td><?php echo $diff;?></td>
															<td><?php echo $fine;?></td>
															<td><?php echo $campus_name.",<br>Shelf-Number: ". $shelf_number; ?></td>
														</tr>
													</table>
												</div>
												<?php
											
											}
											else 
											{
												echo '<script type="text/javascript">';
													echo 'alert("Sorry Book Receive UNSUCCESSFULL Try Again")';
												echo '</script>';
											}

										
										
										}
									
									
									
									}
							?>	