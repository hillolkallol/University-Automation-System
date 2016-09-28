<?php
	require 'config.php';
	if(isset($_POST['studentid']) && isset($_POST['studentpass']))
	{
		$studentid = mysql_real_escape_string($_POST['studentid']);
		$studentpass = mysql_real_escape_string($_POST['studentpass']);
		//$studentid = $_POST['studentid'];
		//studentpass = $_POST['studentpass'];
		
		//Finding Student's Information And Student Syllabus
		$passwordcheck=0;
		$name=null;		$dept=null;		$batch=null;	$degree=null;
		$totalcredit=0;		$totalgradepoint=0;		$totalcgpa=0;
		$info = mysql_query("SELECT * FROM tbl_student_info");
		while($row = mysql_fetch_array($info))
		{
			if($row['std_id']==$studentid && $row['std_password']==$studentpass)
			{
				$passwordcheck=1;
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
				break;
			}
			else continue;
		}
		
		//IF Password Match
		if($passwordcheck==1)
		{
			include'include/header.php';
	
?>			<!--------------1st Container Starts------------------>
			<div class="container">
				<div class="row">
			
					<div class="col-md-1"></div>
			
					<div class="col-md-10">
						<a href="student_option.php">	
							<img src="img/back_icon.png" alt="with responsive image feature" class="img-responsive">
						</a>
					</div>
			
					<div class="col-md-1"></div>
			
				</div>
			</div>
			<!--------------1st Container Ends------------------>
			
			<!--------------2nd Container Starts------------------>
			<div class="container">
				<div class="row"><br>
				
					<div class="col-md-1"></div>
						
						<div class="col-md-10">
							<div class="semester1">
								
								<div class="panel panel-default">
									<div class="panel-body">
										
										<div class="well">
											<div class="table-responsive">
												<table >
													<thead>
														<tr>
															<td>
																<b>Student ID &nbsp;: &nbsp;&nbsp;</b>
															</td>
															<td>
																<?php echo $studentid;?>
															</td>
														</tr>
														<tr>
															<td>
																<b>Name &nbsp;: &nbsp;&nbsp;</b>
															</td>
															<td>
																<?php if($name==null) echo'No Name found'; else echo $name;?>
															</td>
														</tr>
														<tr>
															<td>
																<b>Department &nbsp;: &nbsp;&nbsp;</b>
															</td>
															<td>
																<?php
																	$dept_name=null;
																	$dept_check= mysql_query("SELECT dept_name FROM tbl_department_info where dept_id=$dept");
																	$dept_check1 = mysql_fetch_array($dept_check);
																	$dept_name=$dept_check1['dept_name'];
																	if($dept_name==null) echo'Not found'; else echo $dept_name;	
																?>
															</td>
														</tr>
														<tr>
															<td>
																<b>Batch &nbsp;: &nbsp;&nbsp;</b>
															</td>
															<td>
																<?php  if($batch==null) echo'Not found'; else echo $batch;?>
															</td>
														</tr>
														<tr>
															<td>
																<b>Degree &nbsp;: &nbsp;&nbsp;</b>
															</td>
															<td>
																<?php  if($degree==null) echo'Not found'; else echo $degree;?>
															</td>
														</tr>
														
													</thead>
												</table>
											</div>
										</div>
										
										<div class="panel panel-default">
											<div class="well">	
												<?php
								
													//Finding Result
													$sem=null;	$grade=null;	$creditearn=0;	$point=0;	$gradepoint=0;	$semestergradepoint=0; $found=0; $line=1; $semester=null;
													$result = mysql_query("SELECT * FROM student_result");
													while($row2 = mysql_fetch_array($result)) 
													{
														if($row2['s_id']==$studentid || $row2['s_id']==$old)
														{	
															if( $row2['flag']==0 )
															{
																$semester=$row2['session'];
																$year=$row2['year'];
																if($sem!=$semester)
																{	
																	if($creditearn>0 && $found==1)
																	{	
																		if($sem=='Spring') 
																		{ ?>
																			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																		}
																		else  if($sem=='Summer') 
																		{ ?>
																			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																		}
																		else
																		{ ?>
																			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																		}?>
																		
																		Semester GPA = <?php $valu=round(($semestergradepoint /$creditearn),2);
																		echo number_format((float)$valu, 2, '.', ''); ?>
																		
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		Credit Earned =<?php $valu1= round($creditearn,2);
																		echo number_format((float)$valu1, 2, '.', ''); ?>
																	
																		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																		Grade Point = <?php  $valu2= round($semestergradepoint,2);
																		echo number_format((float)$valu2, 2, '.', '');
																		
																		$creditearn=0;	$point=0;	$gradepoint=0;	$semestergradepoint=0; 
																	}	?>		
																	<table class="table table-bordered">
																		<thead><br><br>
												
																			<tr>
																				<th>Course Code</th>
																				<th>Course Title</th>
																				<th> <div class="center1"> Credit </div> </th>
																				<th> <div class="center1"> Marks  </div> </th>
																				<th> <div class="center1"> Grade  </div> </th>
																				<th> <div class="center1"> Point  </div> </th>
																			</tr>
												
																		</thead>
																		<?php 
																}
																		$found=1;
											
																		//Finding Course Information
																		$code= null; $title=null;$credit=0;$marks=0;
																		$course = mysql_query("SELECT * FROM tbl_course_info");
																		while($row3 = mysql_fetch_array($course))
																		{
																			if($row3['course_auto_id']==$row2['course_id'])
																			{
																				$code= $row3['course_code']; 
																				$title=$row3['course_name'];
																				$credit=$row3['course_credit'];
																				$marks=$row2['total_marks'];
																				$grade=$row2['grade'];
																				if($grade != 'F')	{	$creditearn=$creditearn+$credit;}
																				if($grade=='F') 	$credit=0;
																				break;
																			}
																			else continue;
																		}
																		?>
																		<tbody>
																			<tr>
																				<td><?php echo $code;?></td>
																				<td><?php echo $title;?></td>
																				<td>  <div class="center1"> <?php echo $credit;?> </div> </td>
																				<td>  <div class="center1"> <?php echo $marks;?>  </div> </td>
																				<td>  <div class="center1"> <?php echo $grade;?>  </div> </td>
																				<td>  <div class="center1">	<?php 
																					if($grade=='D')			{	$point=2.00;	$gradepoint=$credit*$point; 	$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='C')	{	$point=2.25; 	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='C+')	{	$point=2.50;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='B-')	{	$point=2.75;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='B')	{	$point=3.00;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='B+')	{	$point=3.25;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='A-')	{	$point=3.50;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='A')	{	$point=3.75;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else if($grade=='A+')	{	$point=4.00;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					else 					{	$point=0.00;	$gradepoint=$credit*$point;		$semestergradepoint=$gradepoint+$semestergradepoint;}
																					echo $point;	?>	</div>
																				</td>
																			</tr>
																			<?php 
																			if($sem!=$semester)
																			{
																				echo"<b>". $semester; echo "-".$year."</b>";	
																				$sem=$semester;	
																			}
															}
																		
														}
																			else Continue;
													}
																			if($creditearn>0 && $found==1)
																			{	
																				if($sem=='Spring') 
																				{ ?>
																					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																				}
																				else  if($sem=='Summer') 
																				{ ?>
																					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																				}
																				else
																				{ ?>
																					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php 
																				}?>
																				Semester GPA = <?php $valu=round(($semestergradepoint /$creditearn),2);
																				echo number_format((float)$valu, 2, '.', ''); ?>
																			
																				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																				Credit Earned =<?php $valu1= round($creditearn,2);
																				echo number_format((float)$valu1, 2, '.', ''); ?>
																		
																				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																				Grade Point = <?php  $valu2= round($semestergradepoint,2);
																				echo number_format((float)$valu2, 2, '.', '');
																				$creditearn=0;	$point=0;	$gradepoint=0;	$semestergradepoint=0; 
																			}		?>
																		</tbody>
																	</table>
											</div>
										</div><br>
										<?php 
											if($found==0)
											{	
										?>
										<h1>No Result Found</h1>
										<?php
											}	
											
											//Old id total credit
											$totalcredit3=0; $totalgradepoint3=0;	$totalcgpa3=0;
											$rzlt = mysql_query("SELECT * FROM tbl_student_info");
											while($row6 = mysql_fetch_array($rzlt))
											{
												if($row6['std_id']==$old)
												{
													
													$totalcredit3=$row6['std_total_credit'];
													$totalgradepoint3=$row6['total_gradepoint'];
													$totalcgpa3=$row6['std_total_cgpa'];
													break;
												}
												else continue;
											}
										?>
										
										
										
										
										<div class="well">
											<div class="table-responsive">
												<table >
													<thead>
														
														<tr>
															
															<td>
																<div class="panel-body">
																	<div class="well">
																		<div class="space1">
																			<ul class="list-group">
																				<li class="list-group-item list-group-item-success"> 
																					<b>Credit Completed &nbsp;:  &nbsp;&nbsp;</b>
																					<?php $ans1= round(($totalcredit+$totalcredit3),2); 
																					echo number_format((float)$ans1, 2, '.', ''); ?>
																				</li>
																				<li class="list-group-item list-group-item-success"> 
																					<b>Total Grade Point &nbsp;: &nbsp;&nbsp;</b>
																					<?php $ans2= round(($totalgradepoint+$totalgradepoint3),2);
																					echo number_format((float)$ans2, 2, '.', ''); ?>
																				</li>
																				<li class="list-group-item list-group-item-success"> 
																					<b>CGPA &nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
																					<?php $ans3=0;if($ans1>0){$ans3= round((($totalgradepoint+$totalgradepoint3)/($totalcredit+$totalcredit3)),2);}
																					echo number_format((float)$ans3, 2, '.', ''); ?>
																				</li><br>
																				Credit Completed <?php echo number_format((float)$ans1, 2, '.', ''); ?> out of <?php echo $req; ?>
																			</ul>
																		</div>
																	</div>
																</div>
															</td>
															<td>
																<div class ="space2"></div>
															</td>
														
															<td>
																<div class ="tablesize">
																	<b>Greading System</b>
																	<div class="table-responsive">
																		<table border="1">

																			<thead>
																				<tr>
																					<th>&nbsp;&nbsp;Marks</th>
																					<th>&nbsp;Grades&nbsp;</th>
																					<th>&nbsp;points&nbsp;</th>
																					<th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remarks</th>
																				</tr>
																			</thead>

																			<tbody>
																		
																				<tr>
																					<td>80-100</td>
																					<td> <div class="center1">A+</div> </td>
																					<td> <div class="center1"> 4.00 </div> </td>
																					<td>Outstanding</td>		
																				</tr>

																				<tr>
																					<td>75-79</td>
																					<td> <div class="center1">A &nbsp;</div> </td>
																					<td> <div class="center1"> 3.75 </div> </td>
																					<td>Excellent</td>		
																				</tr>

																				<tr>
																					<td>70-74</td>
																					<td> <div class="center1"> A-  </div> </td>
																					<td> <div class="center1">3.50 </div> </td>
																					<td>Very Good</td>		
																				</tr>
																			
																				<tr>
																					<td>65-69</td>
																					<td> <div class="center1"> B+  </div> </td>
																					<td> <div class="center1">3.25 </div> </td>
																					<td>Good</td>		
																				</tr>

																				<tr>
																					<td>60-64</td>
																					<td> <div class="center1">B&nbsp;  </div> </td>
																					<td> <div class="center1">3.00 </div> </td>
																					<td>Above Average</td>		
																				</tr>

																				<tr>
																					<td>55-59</td>
																					<td><div class="center1">B-</div></td>
																					<td><div class="center1">2.75</div></td>
																					<td>Average</td>		
																				</tr>

																				<tr>
																					<td>50-54</td>
																					<td> <div class="center1"> C+   </div> </td>
																					<td> <div class="center1"> 2.50 </div> </td>
																					<td>Below Average</td>		
																				</tr>
																		
																				<tr>
																					<td>45-49</td>
																					<td> <div class="center1"> C&nbsp;</div> </td>
																					<td> <div class="center1"> 2.25 </div> </td>
																					<td>Poor</td>		
																				</tr>

																				<tr>
																					<td>40-44</td>
																					<td> <div class="center1"> D&nbsp;</div> </td>
																					<td> <div class="center1"> 2.00 </div> </td>
																					<td>Pass</td>		
																				</tr>
																	
																				<tr>
																					<td>Below 40</td>
																					<td> <div class="center1"> F&nbsp;</div> </td>
																					<td> <div class="center1"> 0.00 </div> </td>
																					<td>Fail</td>		
																				</tr>

																			</tbody>
																		</table>
																	</div>
																</div>
															</td>
															
														</tr>
														
													</thead>
												</table>
												
											</div>
										</div>
		
									</div>
								</div>
								
							</div>
						</div>
						
						<div class="col-md-1"></div>
						
					</div><br>
				</div>
				<!----------------------2nd Container Ends------------------>
<?php
		include 'include/footer.php' ;
		}
		
		//Password Does not Match
		else if($passwordcheck==0)
		{
			echo '<script type="text/javascript">';
			echo 'alert("Please Submit Correct  Student ID and Password!")';
			echo '</script>';
			include 'student_option.php';
		}
	}
?>
