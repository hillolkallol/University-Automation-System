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
?>		
		<!-------------------2nd Container Starts---------------->
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
				
				<div class="col-md-7"><br>
					<div class="semester">
						
						<div class="loginwrap">
							<div class="panel-heading">
								<div class="panel-title">
									<div class="log1" ><strong >Total Result</strong> </div>
								</div>
							</div>
							<div class="panel-body">
								<form enctype="multipart/form-data"  method="POST" action="print_total_result.php">
									<div class="form_sep">
										<label for="id1">Student ID <span style="color:red">*</span> </label>
										<input type="text" id="id1" class="form-control" name="studentid" placeholder="Enter Your ID" required>
									</div>
									<br>
									
									<input type="reset" name="reset" class="btn btn-primary"value="Reset">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="submit" name="submit" class="btn btn-primary" value="Submit">
								</form>
							</div>
						</div>
						
						<br>
						
						<div class="loginwrap">
							<div class="panel-heading">
								<div class="panel-title">
									<div class="log1" > <strong >Single Semester Result</strong> </div>
								</div>
							</div>
							<div class="panel-body">
								<form enctype="multipart/form-data"  method="POST" action="print_semester_result.php">
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
									
									<input type="reset" name="reset" class="btn btn-primary"value="Reset">
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="submit" name="submit" class="btn btn-primary" value="Submit">
								</form>
							</div>
						</div>
						
					</div><br>
				</div>
				
				<div class="col-md-1"> </div>
				
			</div>	<br><br><br><br>			
		</div>
		<!----------------2nd Container Ends---------------------->			
		
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: login.php');
?>
