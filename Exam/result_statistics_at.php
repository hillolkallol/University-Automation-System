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
		include'include/teacher_header.php';
		$code = mysql_real_escape_string($_POST['code']);
		$semester = mysql_real_escape_string($_POST['sem']);
		$year = mysql_real_escape_string($_POST['year']);
		$tech = mysql_real_escape_string($_POST['tech']);
		//$code= $_POST['code'];
		//$semester= $_POST['sem'];
		//$year= $_POST['year'];
		//$tech= $_POST['tech'];
?>
		<!--------------1st Container Starts------------------>
		<div class="container">
			<div class="row">
			
				<div class="col-md-1"></div>
		
				<div class="col-md-10">
					<a href="result_statistics_t.php">	
						<img src="img/back_icon.png" alt="with responsive image feature" class="img-responsive">
					</a>
				</div>
			
				<div class="col-md-1"></div>
			
			</div>
		</div>
		<!--------------1st Container Ends------------------>
			
		<!-------------Container Starts-------------->	
		<div class="container">
			<div class="row">
				
				<div class="col-md-1"></div>
					
				<div class="col-md-10">
					<div class="bordercon1">
						<div class="panel panel-default">
							<?php
							//Finding Teacher Information
							$info = mysql_query("SELECT * FROM tbl_teacher_info");
							$name=null;
							while($row = mysql_fetch_array($info))
							{
								if($row['tch_id']==$tech)
								{
									$name=$row['tch_name'];
									break;
								}
								else continue;
							}
							?>
							<div class="panel-heading" align="center">
								<b> Course-Code : 	<?php echo $code ?> </b>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b> Teacther : 	<?php if($name) echo $name;
									else echo "Teacher Not Found"; ?>
								</b>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<b> Semester :  <?php echo $semester."-".$year; ?> </b>
							</div>
					
							<div class="panel-body">
								<div class="well">	
									<div class="table-responsive">
										<table class="table table-bordered">
					
											<thead>
												<tr>
													<th><div class="center1">Student ID</div></th>
													<th><div class="center1">Marks</div></th>
													<th><div class="center1">Grade</div></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<?php				

													//Check Student Result
													$check = mysql_query("SELECT * FROM student_result");
													$message=0;		$student=0;  $countApluse=0; $countA=0;
													$countAminus=0;$countBpluse=0;$countB=0;$countBminus=0;
													$countF=0; $countD=0; $countC=0; $countCpluse=0;
													while($row1 = mysql_fetch_array($check))
													{
														if($row1['course_code']==$code && $row1['session']==$semester && $row1['year']==$year && $row1['t_id']==$tech)
														{
															$student++;
															$id=$row1['s_id'];
															$marks=$row1['total_marks'];
															$grade1=$row1['grade'];
															$message=1;
															?>
																<td> <div class="center1"><?php echo $id; ?> </div></td>
																<td> <div class="center1"><?php echo $marks; ?> </div> </td>
																<td> <div class="center1"><?php echo $grade1; ?> </div> </td>	
												</tr> <?php
															if($row1['grade']=='A+')	$countApluse++;
															else if($row1['grade']=='A')	$countA++;
															else if($row1['grade']=='A-')	$countAminus++;
															else if($row1['grade']=='B+')	$countBpluse++;
															else if($row1['grade']=='B')	$countB++;
															else if($row1['grade']=='B-')	$countBminus++;
															else if($row1['grade']=='C+')	$countCpluse++;
															else if($row1['grade']=='C')	$countC++;
															else if($row1['grade']=='D')	$countD++;
															else $countF++;
										
														}
														else continue;
													}	
													?>
											</tbody>
										</table>
									</div>
								</div>
							</div><br><br>
							<!---------------------------------------->
							<div class="panel-heading" align="center">
								<b>Result Statictics</b><br><br>
								<b>Total No Of Students = &nbsp;<?php echo $student;?></b>
							</div>
						
							<div class="panel-body">
								<div class="well">	
									<div class="table-responsive">
										<table class="table table-bordered">
					
											<thead>
												<tr>
													<th><div class="center1">No Of Students</div></th>
													<th><div class="center1">Grade</div></th>
													<th><div class="center1">Percentage</div></th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td> <div class="center1"><?php echo $countApluse; ?> </div></td>
													<td><div class="center1"> A+ </div></td>
													<td> <div class="center1"><?php $ansa=0; if($student>0){$ansa=round((($countApluse*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr> 
												
												<tr>
													<td> <div class="center1"><?php echo $countA; ?> </div></td>
													<td><div class="center1"> A </div></td>
													<td> <div class="center1"><?php $ansa=0 ;if($student>0){$ansa=round((($countA*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countAminus; ?> </div></td>
													<td><div class="center1"> A- </div></td>
													<td> <div class="center1"><?php $ansa=0 ;if($student>0){$ansa=round((($countAminus*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countBpluse; ?> </div></td>
													<td><div class="center1"> B+ </div></td>
													<td> <div class="center1"><?php $ansa=0; if($student>0){$ansa=round((($countBpluse*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countB; ?> </div></td>
													<td><div class="center1"> B </div></td>
													<td> <div class="center1"><?php $ansa=0; if($student>0){$ansa=round((($countB*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countBminus; ?> </div></td>
													<td><div class="center1"> B- </div></td>
													<td> <div class="center1"><?php $ansa=0 ;if($student>0){$ansa=round((($countBminus*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												
												<tr>
													<td> <div class="center1"><?php echo $countCpluse; ?> </div></td>
													<td><div class="center1"> C+ </div></td>
													<td> <div class="center1"><?php $ansa=0; if($student>0){$ansa=round((($countCpluse*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countC; ?> </div></td>
													<td><div class="center1"> C</div></td>
													<td> <div class="center1"><?php $ansa=0 ;if($student>0){$ansa=round((($countC*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countD; ?> </div></td>
													<td><div class="center1"> D</div></td>
													<td> <div class="center1"><?php $ansa=0 ;if($student>0){ $ansa=round((($countD*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>
												
												<tr>
													<td> <div class="center1"><?php echo $countF; ?> </div></td>
													<td><div class="center1"> F</div></td>
													<td> <div class="center1"><?php $ansa=0; if($student>0){$ansa=round((($countF*100)/$student),2);}
															echo $ansa."%";?></div></td>	
												</tr>


											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!---------------------------------------->
							
						</div>
					</div>
				</div>
				
				<div class="col-md-1"></div>
			</div>
		</div>
		
		<!----------------------------------------------------------->
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: ../teacher.php');
?>	

