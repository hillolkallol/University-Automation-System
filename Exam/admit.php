<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['userida']) && !empty($_SESSION['userida']))
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
		
		if(isset($_POST['studentid']) && isset($_POST['sem']) && isset($_POST['year']) && isset($_POST['exam']))
		{
			include'include/admin_header.php';
			$studentid = mysql_real_escape_string($_POST['studentid']);
			$sem = mysql_real_escape_string($_POST['sem']);
			$year = mysql_real_escape_string($_POST['year']);
			$exam = mysql_real_escape_string($_POST['exam']);
?>			
			<!--------------Java Script------------->
			<script type="text/javascript">
				function printthis()
				{
					var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
					w.document.write($("#printthis").html());
					w.document.close(); // needed for chrome and safari
					javascript:w.print();
					w.close();
					return false;
				}
			</script>
			<!----------------Java Script Ends----------->

			<!--------------1st Container Starts------------------>
			<div class="container">
				<div class="row">
			
					<div class="col-md-1"></div>
			
					<div class="col-md-10">
						<a href="admit.php">	
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
			<!--------Print Start----------------->
			<div id="printthis">
				<style>
					@media print {
						body {
							font-family: normal;
							font-size: .8em;
							color: black;
							margin: .2cm
						}
						h2{
							font-size: 1.2em;
							letter-spacing: 1px;
						}
						h4{
							font-size: .7em;
							letter-spacing: 1px;
						}
						table {
							font-size: .8em;
							text-align:left;
						}
						#space{
							padding-right:155px;
						}
						#space1{
							text-align:right;
						}
						#centera{
							text-align:center;
						}
					}
					</style>	
					<!---------------------------------------->
					<?php
						//Finding Student's Information And Student Syllabus
						$name=null;		$dept=null;		$batch=null;	$degree=null;
						$totalcredit=0;		$totalgradepoint=0;		$totalcgpa=0;
						$info = mysql_query("SELECT * FROM tbl_student_info");
						while($row = mysql_fetch_array($info))
						{
							if($row['std_id']==$studentid)
							{
								$name= $row['std_name'];
								$batch= $row['std_batch'];
								if($batch==11 || $batch==12 || $batch==13) $batch=$batch.'th';
								else if(($batch %10)==1) $batch=$batch.'st';
								else if(($batch %10)==2) $batch=$batch.'nd';
								else if(($batch %10)==3) $batch=$batch.'rd';
								else $batch=$batch.'th';
								//if(($batch %10)==1) $batch=$batch.'st';
								//else if(($batch %10)==2) $batch=$batch.'nd';
								//else if(($batch %10)==3) $batch=$batch.'rd';
								//else $batch=$batch.'th';
								$totalcredit=$row['std_total_credit'];
								$totalgradepoint=$row['total_gradepoint'];
								$totalcgpa=$row['std_total_cgpa'];
								$dept= $row['std_dept'];
								$degree= $row['std_program'];
								$old=$row['std_old_id'];
								$req=$row['std_required_credit'];
								$picture=$row['std_pic'];
								break;
							}
							else continue;
						}
					?>	
					<!-------------------------------------->
					<body>
						<!---------------------------------------------------------------->
						<div class="table-responsive" >
							<table>
								<tr>
									<td><h2>Leading University</h2></td>
								</tr>
								<tr>
									<td><b>Admit Card</b></td>
									<td><b><?php echo $exam.".".$sem." Semester-".$year;?></b></td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td><img src="<?php echo '../Admission/Admin/'.$picture; ?>" alt="Student Picture" /></td>
								</tr>
								<tr>
									<td><b>Student ID</b></td>
									<td>&nbsp;&nbsp;&nbsp;<?php echo $studentid;?></td>
								</tr>
								<tr>
									<td><b>Name</b></td>
									<td>&nbsp;&nbsp;&nbsp;<?php if($name==null) echo'No Name found'; else echo $name;?></td>
								</tr>
								<tr>
									<td><b>Department</b></td>
									<td>&nbsp;&nbsp;
										<?php
											$dept_name=null;
											$dept_check= mysql_query("SELECT dept_name FROM tbl_department_info where dept_id=$dept");
											$dept_check1 = mysql_fetch_array($dept_check);
											$dept_name=$dept_check1['dept_name'];
											if($dept_name==null) echo'Not found'; else echo $dept_name;	
										?>
									</td>
								</tr>
							</table><br><br>
						</div>
						<!----------------------------------------------->
					
						<?php 
						$due=0;$found=0;
						if($exam=='Final'){
							$due_check= mysql_query("SELECT dueAmount FROM due_history where studentid=$studentid");
							$due_check1 = mysql_fetch_array($due_check);
							$due=$due_check1['dueAmount'];
						}
						//reg course Finding from tbl_course_registration
						if($due<500)	
						{
							$reg = mysql_query("SELECT * FROM tbl_course_registration");
							$reg_main=0;
							$retake=0;
							
							while($row = mysql_fetch_array($reg))
							{
								if($row['student_id']==$studentid && $row['session']==$sem && $row['reg_year']==$year)
								{	$found=1;
									$reg_main= $row['reg_main_course_list'];
									$retake=$row['reg_retake_course_list'];
									//echo $reg_main."<br>";
									//echo $retake;
									break;
								}
								else continue;
							}?>
							<div class="table-responsive" >
								<div id="border" >
									<table style="width:100%">
										<tr>
											<td><b>Course Code</b></td>
											<td><b>Course Title</b></td>
											<td><div id="centera"><b>Credit</b></div></td>
										</tr>
										<?php 
											$reg_main1 = explode(",", $reg_main);
											$int1=0;
											while( sizeof($reg_main1)>$int1)
											{
												//Finding Course Information
												$code= null; $title=null;$credit=0;
												$course = mysql_query("SELECT * FROM tbl_course_info");
												while($row3 = mysql_fetch_array($course))
												{
													if($row3['course_auto_id']==$reg_main1[$int1])
													{$found=1;
														$code= $row3['course_code']; 
														$title=$row3['course_name'];
														$credit=$row3['course_credit']; ?>
														<tr>
															<td><?php echo $code;?></td>
															<td><?php echo $title;?></td>
															<td> <div id="centera"> <?php echo $credit;?>  </div> </td>
														</tr> <?php
																	
														break;
													}
													else continue;
												}
												$int1++;
											}
														
												$reg_main2 = explode(",", $retake);
												$int2=0;
												while( sizeof($reg_main2)>$int2)
												{
													//Finding Course Information
													$code1= null; $title1=null;$credit1=0;
													$course1 = mysql_query("SELECT * FROM tbl_course_info");
													while($row4 = mysql_fetch_array($course1))
													{
														if($row4['course_auto_id']==$reg_main2[$int2])
														{
															$code1= $row4['course_code']; 
															$title1=$row4['course_name'];
															$credit1=$row4['course_credit']; ?>
															<tr>
																<td><?php echo $code1;?></td>
																<td><?php echo $title1;?></td>
																<td> <div id="centera"> <?php echo $credit1;?>  </div> </td>
															</tr> <?php
																	
															break;
														}
														else continue;
													}
													$int2++;
												}
						}
						else { echo "<h1>"."You have due amount ".$due."Tk."."</h1>"; }
											
						if ($found==0 && $due==0) { echo "<h1>".'Not Registered'."</h1>"; }
											
											
						?>
						
								
								</table>
							</div>
						</div>
						
						
							<div class="table-responsive" >
								<div id="border" >
									<table style="width:100%">
										<tr><br><br>
											<td>
												-------------------------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	---------------------------------&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ------------------------------------<br>
												Verification of the Controller's Office &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			Head of the Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Controller Of Examinations<br>
										
											</td>
										</tr>
									</table>
								</div>
							</div>
					</body>
				</div>
				<!--------Print End----------------->
		</div>
		<!----------------10 Col Ends here------------------>
					
					<div class="col-md-1"></div>

				</div>
				<!--------------------New Row----------------->
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4"><br><br><br><br>
						<form>
							<input  type="button"  value="Print" onclick="printthis()"  class="btn btn-success" style="float:right;margin-top:15px;width:100%">		
						</form>
					</div>
					<div class="col-md-4"></div>
				</div><br><br>
			</div><br><br><br><br>
			<!--------------------------------------------->	
<?php 
			include 'include/footer.php' ;
		}
		
		
		else
		{
			include'include/admin_header.php';
?>
			<!---------------Container starts----------------------------->
			<div class="container">
				<div class="row">
				
					<div class="col-md-1"></div>
					
					<div class="col-md-3">
						<div class="border1">
							<a href="result_entry.php"  class="list-group-item ">Enter Result</a>
							<a href="result_modify.php" class="list-group-item ">Modify Result</a>
							<a href="result_delete.php"  class="list-group-item ">Delete Result</a>
							<a href="a_routine_entry.php" class="list-group-item ">Enter Routine</a>
							<a href="up_routine.php"   class="list-group-item ">Uplaoded Routine</a>
							<a href="a_notice_entry.php" class="list-group-item ">Enter Notice </a>
							<a href="a_n_action.php" class="list-group-item ">View Notice </a>
							<a href="batch_result.php" class="list-group-item ">Batch Wise Result</a>
							<a href="result_statistics.php" class="list-group-item ">Result Statistics</a>
							<a href="view_result.php" class="list-group-item ">View Result</a>
							<a href="print_option.php" class="list-group-item ">Print Result</a>
							<a href="admit.php" class="list-group-item ">Admit Card</a>
						</div>
					</div>
					
					<div class="col-md-7"> <br>
						<div class="loginwrap"> <br>
							<div class="panel panel-default">
								<div class="panel-heading" align="center"><strong>Admit Card</strong> </div>
								<div class="panel-body">
									<div class="well">
										<form enctype="multipart/form-data" action=" " method="post">
									
											<div class="form_sep">
												<label for="id1">Student ID <span style="color:red">*</span> </label>
												<input type="text" id="id1" class="form-control" name="studentid" placeholder="Enter Your ID" required>
											</div>
											<br>
											
											<div class="form_sep">
												<label for="sem1">Semester <span style="color:red">*</span> </label>
												<select id="sem1" class="form-control" name="sem" required>
													<option value="Spring">Spring</option>
													<option value="Summer">Summer</option>
													<option value="Fall">Fall</option>
												</select>
											</div>
											<br>
								
											<div class="form_sep">
												<label for="y1">Year<span style="color:red">*</span></label><br>
												<select id="y1" class="form-control" name="year" required>
													<?php 
														$i=0;$year=2001; $yearlimit=date("Y");
														while($year<=$yearlimit )
														{  ?>
															<option> <?php echo $year ;?> </option> <?php
															$year=$year+1;
														} 
													?> 
												</select>
											</div>
											<br>
											
											<div class="form_sep">
												<label for="term">Exam <span style="color:red">*</span> </label>
												<select id="term" class="form-control" name="exam" required>
													<option value="Mid-Term">Mid-Term</option>
													<option value="Final">Final</option>
												</select>
											</div>
											<br>
								
											<input type="reset" name="reset" class="btn btn-primary"value="Reset">
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<input type="submit" name="submit" class="btn btn-primary" value="Submit">
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
	else  header('Location: login.php');
?>	



