<?php
	//include('connect.php');
	//$con = getcon();
?>
<html lang="en-US">
	<head>
		<meta charset="UTF-8">
		<title></title>
	</head>
	<body>
	<div class="tab_heading">
		<form class="form-inline request " role="form" action="" method="POST"  name="" ">
			<div class="row">
				<div class="col-md-12 request_field">
					<center><input type="date" name="StartDate" class="form-control" placeholder="yyyy-dd-mm" >	
					TO
					<input type="date"  name="EndDate" class="form-control" placeholder="yyyy-dd-mm" >	
					<input type="submit" value="submit" name="" class="btn btn-primary"/>	
					<input type="hidden" name="action3" value="date_info" /></center>
				</div>
			</div>
		</form>
	</div>
		<?php
		if(isset( $_POST['action3'] ) && 'date_info' == $_POST['action3'])
		{			
			$StartDate = $_POST['StartDate'];
			$EndDate = $_POST['EndDate'];
			if($EndDate < $StartDate) echo "\nPlease Input Valid Date Range";
			else
			{
				$query = "SELECT `tbl_student_info`.`std_id` ,`tbl_student_info`.`std_name` ,
						`tbl_student_info`.`std_email` , `book_info`.`book_title`,`book_info`.`book_id`,
						`book_transaction`.`issue_date`,`book_transaction`.`issue_by`, DATEDIFF( NOW( ) , issue_date ) AS diff, day_limit 
						from `book_info`,`book_transaction` ,`tbl_student_info`  
						WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
						and `book_transaction`.`transaction_status`= 0 
						and `book_transaction`.`user_id`= `tbl_student_info`.`std_id`
						and (( issue_date BETWEEN '$StartDate' and '$EndDate' ) or 
							( return_date BETWEEN '$StartDate' and '$EndDate' ))
						ORDER BY DATEDIFF( NOW( ) , issue_date ) DESC";
					
				$result = mysqli_query($con,$query);
				$found = 0;
				?>
				<!-- Table to Show Last 5 history  -->
			<div class="table-responsive">
				<table class="table">
				<?php
				while($row1 = mysqli_fetch_array($result))
				{
					if($found===0)
					{
					?>
						<tr>
							<td><b>Serial</b></td>
							<td><b>Book Id</b></td>
							<td><b>Book Title</b></td>
							<td><b>User Name</b></td>
							<td><b>User ID</b></td>
							<td><b>Issue By</b></td>
							<td><b>Issue Date</b></td>
							<td><b>Total Days</b></td>
							<td><b>Message Option</b></td>
						</tr>					
					<?php					
						$found = 1;
						
					}
					$id=$row1['book_id'];
																//echo "<td>".
					$title=$row1['book_title'];
					$student=$row1['std_name'];
					$std_id=$row1['std_id'];
					$issueby=$row1['issue_by'];
					$issuedate=$row1['issue_date'];
					$diff=$row1['diff'];
					$admin_id=$_SESSION['admin_id'];
					?>
					<tr>
						<td><?php echo $found; ?></td>
						<td><?php echo $id; ?></td>
						<td><?php echo $title; ?></td>
						<td><?php echo $student; ?></td>
						<td><?php echo $std_id; ?></td>
						<td><?php echo $issueby; ?></td>
						<td><?php echo $issuedate; ?></td>
						<td><?php echo $diff; ?></td>
						<td><button class="btn btn-primary btn-md" data-toggle="modal" data-target="#msg" >Send message</button></td>
					</tr>
						
			<?php
				$found++;
				}				
			?>
				</table>
			</div>
			<?php
				if($found == 1) echo "NO Trancation Found";
			}
		}






			else
			{
?>			
				<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Books On Borrow </h3></center>
									<?php 
										$query = " SELECT `tbl_student_info`.`std_id` ,`tbl_student_info`.`std_name` ,
												`tbl_student_info`.`std_email` , `book_info`.`book_title`,`book_info`.`book_id`,
												`book_transaction`.`issue_date`,`book_transaction`.`issue_by`, DATEDIFF( NOW( ) , issue_date ) AS diff, day_limit 
												from `book_info`,`book_transaction` ,`tbl_student_info`  
												WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
												and `book_transaction`.`transaction_status`= 0 
												and `book_transaction`.`user_id`= `tbl_student_info`.`std_id` 
												ORDER BY DATEDIFF( NOW( ) , issue_date ) DESC LIMIT 0 , 5";
										$result = mysqli_query($con,$query);
										$count=1;
											if($result)
												{ 
									?>
									<center>
										<div class="table-responsive">
											<table class="table table-bordered">
												<tr>
													<td><b>Serial</b></td>
													<td><b>Book Id</b></td>
													<td><b>Book Title</b></td>
													<td><b>User Name</b></td>
													<td><b>User ID</b></td>
													<td><b>Issue By</b></td>
													<td><b>Issue Date</b></td>
													<td><b>Total Days</b></td>
													<td><b>Message Option</b></td>
												</tr>
										<?php
											while($row1=mysqli_fetch_array($result))
												{
													$day=$row1['diff'];
													//echo $day;
													if($day<30)
														{
															//echo "<tr>";
																//echo "<td>".$count."</td>";
																//echo "<td>".
																$id=$row1['book_id'];
																//echo "<td>".
																$title=$row1['book_title'];
																$student=$row1['std_name'];
																$std_id=$row1['std_id'];
																$issueby=$row1['issue_by'];
																$issuedate=$row1['issue_date'];
																$diff=$row1['diff'];
																
															//echo $admin_id;
															
															?>
															<tr>
																<td><?php echo $count; ?></td>
																<td><?php echo $id; ?></td>
																<td><?php echo $title; ?></td>
																<td><?php echo $student; ?></td>
																<td><?php echo $std_id; ?></td>
																<td><?php echo $issueby; ?></td>
																<td><?php echo $issuedate; ?></td>
																<td><?php echo $diff; ?></td>
																<td>
																	<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#msg" >
																		Send message
																	</button>
																</td>
															</tr>
												<?php
													$count++;
														}
												}
										?>
											
											</table>
										</div>
									</center>
									<?php
										}
										if($count == 1)
											echo "<h2>No Data Found</h2>";
											
									?>
								
			<?php
			}

		?>
		<!-- Modal -->
		<div class="modal fade" id="msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background:#3276b1; color:white;">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="myModalLabel">Send Message</h4>
					</div>
					<form action="" method="post" style="background:#3276b1; color:white; font-size:15px;">
							
							<div class="modal-body" style="background:#3276b1; color:white; font-size:15px;">
							<center>
								Confirm Student ID</br>
								<input type="number"  name="id" placeholder="Student ID" required/ style=""></br>
								Write down your message here </br>
								<textarea name="message" maxlength="560" cols="25" rows="10" required style=""></textarea>
							</center>
						</div>
						<div class="modal-footer" style="background:#3276b1;">
							<button type="submit" class="btn btn-primary" name="message_formb" style="background:white; color:black;">Send</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							
							
						</div>
					</form>
				</div>
			</div>
		</div><!--end of modal-->
	</body>
</html>
<?php	
	if(isset($_POST['message_formb']))
		{
			//include('connect.php');
			$con = getcon();
			$admin_id=$_SESSION['admin_id'];
			$user_id = $_POST['id'];
			$message = $_POST['message'];
			$query = "INSERT INTO `user_message` (`user_id`, `admin_id`, `message`, `time`) VALUES ($user_id, $admin_id, '$message', now());";
			$result = mysqli_query($con,$query);
			if($result)
			{
				echo '<script type="text/javascript">';
					echo 'alert("Message Sent Successfully !!")';
				echo '</script>';
			}
			else 
			{
				echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again")';
				echo '</script>';
			}								
		}
?>