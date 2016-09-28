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
				</div>>
					
				<div class="col-md-7"> <br>
					<div class="loginwrap"> <br>
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="panel-title"><b>Result Statistics</b></div>
							</div>
							<div class="panel-body">
								<div class="well">
									<form enctype="multipart/form-data" action="result_statistics_at.php" method="post">
									
										<!-------------Live search---------------->
										<div class="form_sep">
											<label for="course">Course Code <span style="color:red">*</span></label> </br>
											<select class="selectpicker " id="course" name="code" data-width="100%" data-live-search="true" title="Select Course Code">
												<?php
													//Course Finding
													$query= mysql_query("SELECT * FROM tbl_course_info");
													while($row= mysql_fetch_assoc($query))
													{
														$code= $row['course_code'];
														$tittle= $row['course_name'];
														$_SESSION['courseidd']=$row['course_auto_id'];
												?>
												<option data-subtext="<?php echo "(" ;echo $tittle ;echo ")" ;?>"> <?php echo $code ;echo " " ;  }?> </option> 		
											</select>
										</div>
										<br>	
										<!-------------Live Search End---------->
										<div class="form_sep">
											<label for="sem1">Semester</label>
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
											<label for="tech1">Teacher ID<span style="color:red">*</span></label> </br>
											<select class="selectpicker " id="tech1" name="tech" data-width="100%" data-live-search="true" title="Select Course Code">
												<?php
													//Finding Teacher ID
													$query1= mysql_query("SELECT * FROM tbl_teacher_info");
													while($row= mysql_fetch_assoc($query1))
													{
														$techid= $row['tch_id'];
														$techname= $row['tch_name'];
												?>
												<option data-subtext="<?php echo "(" ;echo $techname ;echo ")" ;?>"> <?php echo $techid ;echo " " ;  }?> </option> 		
											</select>
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

	<!----------------------------------------->
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: ../teacher.php');
?>	


