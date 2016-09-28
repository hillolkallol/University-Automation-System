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
		include'include/admin_header.php';
		$studentid = mysql_real_escape_string($_POST['studentid']);
		//$studentid = $_POST['studentid'];
?>		
		<!------------------------------------>
		<script type="text/javascript">
			function printthis()
			{
				var w = window.open('', '', 'width=800,height=700,resizeable,scrollbars');
				w.document.write($("#printthis").html());
				w.document.close(); // needed for chrome and safari
				javascript:w.print();
				w.close();
				return false;
			}
		</script>
		<!------------------------------------------------------------>
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
				break;
			}
			else continue;
		}
?>
		<!---------------------------------------------------------->
		<style>
			#container
			{
				margin-left:60px;
				margin-right:60px;
			}
		</style>
		<!----------------------------------------------------------->
		<div id="container">
			
			<div id="row">
				<div class="col-md-12">
					<div id="printthis">
						<!------------------------------------->
						<style>
								@media print {
									body {
										font-family: normal;
										font-size: .8em;
										color: black;
										margin: .2cm
									}
									h2{
										font-size: 1em;
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
						<!---------------------------------------------------------------->
						<body>
							<img src="img/lu.png"alt="with responsive image feature" class="img-responsive">
							<h2>Leading University,Sylhet.</h2>
							
							<!----------------------------------------------->
							<div class="table-responsive" >
								<table>
									<tr>
										<td> <b>Student ID</b> </td>
										<td> &nbsp;&nbsp;&nbsp; <?php echo $studentid;?> </td>
									</tr>
									<tr>
										<td> <b>Name</b></td>
										<td> &nbsp;&nbsp;&nbsp; <?php if($name==null) echo'No Name found'; else echo $name;?> </td>
									</tr>
									<tr>
										<td><b>Department</b></td>
										<td>&nbsp;&nbsp;&nbsp;
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
										<td><b>Batch</b></td>
										<td>&nbsp;&nbsp;&nbsp;<?php  if($batch==null) echo'Not found'; else echo $batch;?></td>
									</tr>
									<tr>
										<td><b>Degree</b></td>
										<td>&nbsp;&nbsp;&nbsp;<?php  if($degree==null) echo'Not found'; else echo $degree;?></td>
									</tr>
								</table>
							</div>
							<!----------------------------------------------->
							<h4><b>Performance Report</b></h4>
							<style>
								#border{}
								#border table
								{
									border-top:1px solid black;
									border-bottom:1px solid black;
								}
							</style>
							<!---------------------------------------------------------->
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
											<div class="table-responsive" >
												<div id="border" >
													<table style="width:100%"><br><br>
														<tr>
															<td><b>Course Code</b></td>
															<td><b>Course Title</b></td>
															<td><div id="centera"><b>Credit</b></div></td>
															<td><div id="centera"><b>Marks</b></div></td>
															<td><div id="centera"><b>Grade</b></div></td>
															<td><div id="centera"><b>Point</b></div></td>
														</tr>
														<?php 
										}
													$found=1;
						
													//Finding Course Information
													$code= null; $title=null;$credit=0;
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
														<tr>
																	
															<td><?php echo $code;?></td>
															<td><?php echo $title;?></td>
															<td> <div id="centera"> <?php echo $credit;?>  </div> </td>
															<td> <div id="centera">  <?php echo $marks;?>  </div> </td>
															<td> <div id="centera"> <?php echo $grade;?>  </div> </td>
															<td><div id="centera">
																	<?php 
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
																	echo $point;?>
																</div>
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
													</table>
												</div>
											</div>	<?php
											if($found==0)
													{	?>
														<h1>No Result Found</h1>	<?php
													}	?>
											<!---------------------------------------------------------->	
											<?php 
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
											<!---------------------------------------------------------->
											<div class="table-responsive" >	<br><br>
														<div id="border">
															<table>
																<tr>
																	<td><?php echo "Total Credit Completed = ";?></td>
																	<td><?php $ans1= round(($totalcredit+$totalcredit3),2); 
																		echo number_format((float)$ans1, 2, '.', ''); ?></td>
																</tr>
																<tr>
																	<td><?php echo "Total Grade Point = ";?></td>
																	<td><?php $ans2= round(($totalgradepoint+$totalgradepoint3),2);
																		echo number_format((float)$ans2, 2, '.', ''); ?></td>		
																</tr>
																<tr>
																	<td><?php echo "CGPA = ";?></td>
																	<td><?php $ans3=0;if($ans1>0){$ans3= round((($totalgradepoint+$totalgradepoint3)/($totalcredit+$totalcredit3)),2);}
																		echo number_format((float)$ans3, 2, '.', ''); ?>
																	</td>		
																</tr>
														</table>
													</div>
												</div>
												<h4>Credit Completed <?php echo number_format((float)$ans1, 2, '.', ''); ?> out of <?php echo $req; ?></h4>
														
										<!---------------------------------------------------------->
										<div class="table-responsive" >	
											<table style="width:100%">
												<tr><br><br><br>
													<td>
														<div id="space">-----------------------------------------<br>
														&nbsp;&nbsp;Controller Of Examinations<br>
														&nbsp;&nbsp;Leading University,Sylhet</div><br><br><br><br><br>
														Prepared By &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;: -----------------------------------<br><br>
														Checked By &nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp;: -----------------------------------<br><br>
														Date Of Preparation &nbsp; &nbsp; <?php echo  date("d.m.Y")?> <br>
														Sylhet,Bangaldesh.
													</td>		
													<td>
														<table>
															<tr>
																<th><div id="centera" >Marks</div></th>
																<th><div id="centera" >Grades</div></th>
																<th><div id="centera" >points</div></th>
																<th><div id="centera" >Remarks</div></th>
															</tr>
															<tr>
																<td><div id="centera" >80-100</div></td>
																<td><div id="centera" >A+</div></td>
																<td><div id="centera" >4.00</div></td>
																<td><div id="centera" >Outstanding</div></td>	
															</tr>
															<tr>
																<td><div id="centera" >75-79</div></td>
																<td><div id="centera" >A</div></td>
																<td><div id="centera" >3.75</div></td>
																<td><div id="centera" >Excellent</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >70-74</div></td>
																<td><div id="centera" >A-</div></td>
																<td><div id="centera" >3.50</div></td>
																<td><div id="centera" >Very Good</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >65-69</div></td>
																<td><div id="centera" >B+</div></td>
																<td><div id="centera" >3.25</div></td>
																<td><div id="centera" >Good</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >60-64</div></td>
																<td><div id="centera" >B</div></td>
																<td><div id="centera" >3.00</div></td>
																<td><div id="centera" >Above Average</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >55-59</div></td>
																<td><div id="centera" >B-</div></td>
																<td><div id="centera" >2.75</div></td>
																<td><div id="centera" >Average</div></td>
															</tr>
															<tr>
																<td><div id="centera" >50-54</div></td>
																<td><div id="centera" >C+ </div></td>
																<td><div id="centera" >2.50</div></td>
																<td><div id="centera" >Below Average</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >45-49</div></td>
																<td><div id="centera" >C </div></td>
																<td><div id="centera" >2.25</div></td>
																<td><div id="centera" >Poor</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >40-44</div></td>
																<td><div id="centera" >D </div></td>
																<td><div id="centera" >2.00</div></td>
																<td><div id="centera" >Pass</div></td>		
															</tr>
															<tr>
																<td><div id="centera" >Below 40</div></td>
																<td><div id="centera" >F</div></td>
																<td><div id="centera" >0.00</div></td>
																<td><div id="centera" >Fail</div></td>		
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</div>
										<!-------------------------------------------------------->
						</div>
					</div>
					<!---------------Print------------------------>
				</div><br>
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
			</div>
			<br><br>
			
		</div>
		<!----------------------------------------->
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: login.php');
?>	
