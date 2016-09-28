<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_id']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(loggedin())
	{
		if(isset($_POST['dept']) && isset($_POST['batch']))
		{
			include'include/teacher_header.php';
			$dept = mysql_real_escape_string($_POST['dept']);
			$batch = mysql_real_escape_string($_POST['batch']);
			//$dept= $_POST['dept'];
			//$batch= $_POST['batch'];
?>			

			<!--------------1st Container Starts------------------>
			<div class="container">
				<div class="row">
			
					<div class="col-md-1"></div>
			
					<div class="col-md-10">
						<a href="batch_result_t.php">	
							<img src="img/back_icon.png" alt="with responsive image feature" class="img-responsive">
						</a>
					</div>
			
					<div class="col-md-1"></div>
			
				</div>
			</div>
			<!--------------1st Container Ends------------------>
			<!-------------Container Starts-------------->	
			<div class="container">
				<div class="row"><br>
				
					<div class="col-md-1"></div>
					
					<div class="col-md-10">
						<div class="bordercon1">
							<div class="panel panel-default">
								<div class="panel-heading" align="center">
									<b> Department : <?php  echo $dept;	?>  </b>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<b> Batch : <?php
										$batch1=$batch; 
										if($batch==11 || $batch==12 || $batch==13) $batch1=$batch1.'th';
										else if(($batch %10)==1) $batch1=$batch1.'st';
										else if(($batch %10)==2) $batch1=$batch1.'nd';
										else if(($batch %10)==3) $batch1=$batch1.'rd';
										else $batch1=$batch1.'th';  echo $batch1;	?> 
									</b>
								</div>
								<div class="panel-body">
									<div class="well">	
										<div class="table-responsive">
											<table class="table table-bordered">
												<thead>
													<tr>
														<th>Student ID</th>
														<th>Student Name</th>
														<th><div class="center1">Credit Completed</div></th>
														<th><div class="center1">CGPA</div></th>
													</tr>
												</thead>
											
												<tbody>
													<tr>
														<?php
														
															//Department ID Check
															$dept_check= mysql_query("SELECT dept_id FROM tbl_department_info where dept_short_name='$dept'");
															$dept_check1 = mysql_fetch_array($dept_check);
															$dept_id=$dept_check1['dept_id'];
															
															//Student Info check
															$check= mysql_query("SELECT * FROM tbl_student_info");
															$message=0; $count=0;
															while($row1 = mysql_fetch_array($check))
															{
																if($row1['std_dept']==$dept_id && $row1['std_batch']==$batch)
																{
																	$count++;
																	$id=$row1['std_id'];
																	$name=$row1['std_name'];
																	$credit=$row1['std_total_credit'];
																	$gradepoint=$row1['total_gradepoint'];
																	$cgpa=$row1['std_total_cgpa'];
																	$old=$row1['std_old_id'];
																	$message=1;
																	//old id credit
																	if($old!=null && $old!=0)
																	{
																		$rzlt = mysql_query("SELECT * FROM tbl_student_info");
																		while($row6 = mysql_fetch_array($rzlt))
																		{
																			if($row6['std_id']==$old)
																			{
																				$totalcredit3=$row6['std_total_credit'];
																				$credit=$credit+$totalcredit3;
																				$totalgradepoint3=$row6['total_gradepoint'];
																				$gradepoint=$gradepoint+$totalgradepoint3;
																				$cgpa=$gradepoint/$credit;
																				break;
																			}
																			else continue;
																		}
																	}
														?>
														
																	<td><?php echo $id;?></td>
																	<td><?php echo $name;?></td>
																	<td> <div class="center1"><?php echo $credit;?></div></td>
																	<td> <div class="center1"><?php echo round($cgpa,2);?></div></td>
													</tr>		<?php
																}
																else continue;
															}
																?>
												</tbody>
											</table>
										</div>
										<?php 
											if($message==0)
											{
												echo"<br>";
												echo "<b>No Result Found</b>";
												echo"<br>";
												echo"<br>";
								
											}		
										?>
										<b> No Of Students = <?php  echo $count;	?>  </b>
									</div> <br>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-1"></div>
					
				</div>
			</div><br><br><br><br>
			<!--------------------------------------------->	
<?php 
			include 'include/footer.php' ;
		}
		
		
		else
		{
			include'include/teacher_header.php';
?>
			<!---------------Container starts----------------------------->
			<div class="container">
				<div class="row">
				
					<div class="col-md-1"></div>
					
					<div class="col-md-3">
						<div class="border1">
							<a href="result_entry_t.php" class="list-group-item ">Enter Result</a>
							<a href="t_notice_entry.php" class="list-group-item ">Enter Notice </a>
							<a href="t_n_action.php" class="list-group-item ">View Notice </a>
							<a href="batch_result_t.php" class="list-group-item ">Batch Wise Result</a>
							<a href="result_statistics_t.php" class="list-group-item ">Result Statistics</a>
							<a href="view_result_t.php" class="list-group-item ">View Result</a>
						</div>
					</div>
					
					<div class="col-md-7"> <br>
						<div class="loginwrap"> <br>
							<div class="panel panel-default">
								<div class="panel-heading" align="center"><strong>Batch Result</strong> </div>
								<div class="panel-body">
									<div class="well">
										<form enctype="multipart/form-data" action=" " method="post">
									
											<!-------------Live search---------------->
											<div class="form_sep">
												<label for="deptmnt">Department <span style="color:red">*</span></label>
												<select class="selectpicker " id="deptmnt" name="dept" data-width="100%" data-live-search="true" title="Select Department">
													<?php
														//Dept Finding
														$query= mysql_query("SELECT dept_short_name FROM tbl_department_info");
														while($row= mysql_fetch_assoc($query))
														{
															$dept= $row['dept_short_name'];
											
													?>
														<option> <?php echo $dept ; }?> 	</option>
												</select>
											</div>
											<br>	
								
											<div class="form_sep">
												<label for="bth">Batch</label> 
												<input type="number" min="1" max="1000000" id="bth" class="form-control"  name="batch" required>
											</div>	
											<br>
										
											<button class="btn btn-default" type="reset" value="Reset" name="submit">Reset</button>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<button class="btn btn-default" type="submit" value="Submit" name="submit">Submit</button>
											
										</form>
									</div>
								</div> 	
							</div> 		
						</div>
					</div>

					<div class="col-md-1"></div>
				
				</div><br><br><br><br>
			</div> 
			<!-------------------Container Ends---------------------->
<?php 
			include 'include/footer.php' ;
		}
	}
	else  header('Location: ../teacher.php');
?>	



