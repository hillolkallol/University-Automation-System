<?php
	include('connect.php');
	$con= getcon();
    ?>
<?php if( isset( $_POST['action'] ) && 'student_info' == $_POST['action'] )
		{
			$user_id = $_POST['s_id'];
			if(strlen($user_id)>7)
			{
				$user_id = $_POST['s_id'];
				$query="SELECT std_name, tbl_student_info.std_id,std_pic, std_email, tbl_department_info.dept_short_name,libraryFine
						FROM tbl_student_info,tbl_department_info , due_history
						WHERE tbl_student_info.std_id = $user_id 
						and tbl_student_info.std_dept =  tbl_department_info.dept_id
						and due_history.studentId = tbl_student_info.std_id ORDER BY tNo DESC limit 1";
			
				$result = mysqli_query($con,$query);
				$valid = 0;
				foreach($result as $row)
				{
					$name=$row['std_name'];
					$id=$row['std_id'];
					$email=$row['std_email'];
					$picture=$row['std_pic'];
					$fine=$row['libraryFine'];
					$dept=$row['dept_short_name'];	
					$valid = 1;
				}
				
				
				if ($valid==0)
				{
					echo '<script type="text/javascript">';
						echo 'alert("Invalid Student ID.")';
					echo '</script>';
				}
				else
				{
					?>
						<h2 style="color:#3276b1;">Student Information </h2>
						<center><img src="<?php echo '../Admission/Admin/'.$picture; ?>" alt="Student Picture"  style="margin:10px 0px;"/></center>
					<?php
						$query = "SELECT `book_info`.`book_title`,DATE_FORMAT(`book_transaction`.`issue_date`,'%d %b %y') as 'issue_date'  
						from `book_info`,`book_transaction` 
						WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
						and `book_transaction`.`transaction_status`=0 and `book_transaction`.`user_id`=$user_id";								
						$arr = array();
						$result = mysqli_query($con,$query);
						$book_taken=0;
						while($row1=mysqli_fetch_array($result))
							{
								$arr[$book_taken]['book_title'] = $row1['book_title'];
								$arr[$book_taken]['issue_date'] = $row1['issue_date'];
								$book_taken++;
							}
					?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>Name </td>
									<td><?php echo $name;?></td>
								</tr>				
								<tr>
									<td>ID </td>
									<td><?php echo $user_id;?></td>
								</tr>
								<tr>
									<td>Email </td>
									<td><?php echo $email;?></td>
								</tr>
								<tr>
									<td>Department :</td>
									<td><?php echo $dept ;?></td>
								</tr>
								<tr>
									<td>Fine </td>
									<td><?php echo $fine."/-";?></td>
								</tr>												
					<?php 	if ($book_taken!=0) 
								{
					?>
									<tr>
										<td><b>Book Name  </b></td>									
										<td><b>Issue Date</b></td>
									</tr>	
									<?php for($i=0;$i<$book_taken;$i++){?>
											<tr>
												<td><?php echo $arr[$i]['book_title'];?></td>
													<td><?php echo $arr[$i]['issue_date'];?></td>
											</tr>
									<?php }
								}?>				
							</table>
						</div>													
					<?php if($book_taken<2){?>
						<form action="admin.php" method="POST">
							<div>
								<div class="row" style="background:#3276B1; margin-bottom:10px;">
									<div class="col-md-2"></div>
									<div class="col-md-2 "><h3 style="color:white;">Book ID </h3> </div>
									<div class="col-md-3" style="margin-top:10px;">
										<input type="number" min = 1 name="book_id" class="form-control" placeholder="Book ID" required />
									</div>
									<div class="col-md-3" style="margin-top:10px;">
										<select name="renew_status" class="form-control" >
											<option value="1">Renew Enable</option>
											<option value="0">Renew Disable</option>								
										</select>
									</div>
									<div class="col-md-2" style="margin-top:10px;">
										<input type="submit" value="Confirm" name="" class="btn btn-primary"/>	
									</div>
								</div>
							</div>
					<?php } ?>
							<input type="hidden" name="action" value="request_book" />
							<input type="hidden" name="id" value="<?php echo $user_id;?>"</td>
						</form>

					<?php
				}
			}
			else
			{
				$user_id = $_POST['s_id'];
				$query="select tbl_teacher_info.tch_name,tch_id,tch_email,tch_gender,tch_pic,tbl_department_info.dept_short_name
						FROM tbl_teacher_info,tbl_department_info
						where tch_id='$user_id'
						and tbl_teacher_info.tch_dept = tbl_department_info.dept_id";
				$result = mysqli_query($con,$query);
				$valid = 0;
				while($row=mysqli_fetch_array($result))
					{
						$id=$row['tch_id'];
						$name = $row['tch_name'];
						$email = $row['tch_email'];
						$picture = $row['tch_pic'];
						$dept=$row['dept_short_name'];
						$valid = 1;
					}
				if ($valid==0)
				{
					echo '<script type="text/javascript">';
						echo 'alert("Invalid ID.")';
					echo '</script>';
				}
				else
				{
					?>
						<h2 style="color:#3276b1;">Teacher Information </h2>
						<center><img src="<?php echo '../Admission/Admin/'.$picture; ?>" alt="Teacher Picture"  style="margin:10px 0px;"/></center>
					<?php
						$query = "SELECT `book_info`.`book_title`,DATE_FORMAT(`book_transaction`.`issue_date`,'%d %b %y') as 'issue_date'  
						from `book_info`,`book_transaction` 
						WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
						and `book_transaction`.`transaction_status`=0 and `book_transaction`.`user_id`=$user_id";								
						$arr = array();
						$result = mysqli_query($con,$query);
						$book_taken=0;
						while($row1=mysqli_fetch_array($result))
							{
								$arr[$book_taken]['book_title'] = $row1['book_title'];
								$arr[$book_taken]['issue_date'] = $row1['issue_date'];
								$book_taken++;
							}
					?>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<td>Name </td>
									<td><?php echo $name;?></td>
									</tr>				
									<tr>
									<td>ID </td>
									<td><?php echo $user_id;?></td>
									</tr>
									<tr>
									<td>Email </td>
									<td><?php echo $email;?></td>
								</tr>
								<tr>
									<td>Dept </td>
									<td><?php echo $dept;?></td>
								</tr>												
					<?php 	if ($book_taken!=0) 
								{
					?>
									<tr>
										<td><b>Book Name  </b></td>									
										<td><b>Issue Date</b></td>
									</tr>	
									<?php for($i=0;$i<$book_taken;$i++){?>
											<tr>
												<td><?php echo $arr[$i]['book_title'];?></td>
													<td><?php echo $arr[$i]['issue_date'];?></td>
											</tr>
									<?php }
								}?>				
							</table>
						</div>													
						<form action="admin.php" method="POST">
							<div>
								<div class="row" style="background:#3276B1; margin-bottom:10px;">
									<div class="col-md-2"></div>
									<div class="col-md-2 "><h3 style="color:white;">Book ID </h3> </div>
									<div class="col-md-3" style="margin-top:10px;">
										<input type="number" min = 1 name="book_id" class="form-control" placeholder="Book ID" required />	
									</div>
									<div class="col-md-2" style="margin-top:10px;">
										<input type="submit" value="Confirm" name="" class="btn btn-primary"/>	
									</div>
									<div class="col-md-3"></div>
								</div>
							</div>
							<input type="hidden" name="action" value="request_book" />
							<input type="hidden" name="renew_status" value="0" />
							<input type="hidden" name="id" value="<?php echo $user_id;?>"</td>
						</form>

					<?php
				}
			}
		}
?>
											
												