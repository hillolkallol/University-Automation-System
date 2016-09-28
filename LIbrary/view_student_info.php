<?php
	include('connect.php');
	$con= getcon();
    ?>
<?php 
			$user_id = $_POST['std_id'];
			if(strlen($user_id)>7)
			{
				$user_id = $_POST['std_id'];
				$query = "SELECT `tbl_student_info`.`std_name`,std_contact_no,`std_email`,`std_pic`,`libraryFine`,`std_dept`,`tbl_department_info`.`dept_short_name`,libraryFine
				FROM `tbl_student_info`,`tbl_department_info` , due_history
				WHERE `tbl_student_info`.`std_id` = $user_id  
				and `tbl_department_info`.`dept_id`=`tbl_student_info`.`std_dept` 
				and due_history.studentId = tbl_student_info.std_id  limit 1 ";
				
				$result = mysqli_query($con,$query);
				$valid = 0;
				while($row=mysqli_fetch_array($result))
					{
						$name = $row['std_name'];
						$email = $row['std_email'];
						$picture=$row['std_pic'];
						$std_contact_no = $row['std_contact_no'];
						$fine = $row['libraryFine'];
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
									<td>Phone </td>
									<td><?php echo "0". $std_contact_no;?></td>
								</tr>
								<tr>
									<td>Department </td>
									<td><?php echo $dept;?></td>
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
								}
								else echo "No Book";
							?>				
							</table>
						</div>													
					<?php
				}
			}
		
?>
											
												