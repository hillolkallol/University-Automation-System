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
		
		if(!isset($_POST['submit'])) 
		{ ?>
			<!-------------------------------------->
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
							<a href="student_option.php" class="list-group-item ">View Result</a>
							<a href="print_option.php" class="list-group-item ">Print Result</a>
							<a href="admit.php" class="list-group-item ">Admit Card</a>
						</div>
					</div>
					
					<div class="col-md-7"> <br>
						<div class="loginwrap">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 class="panel-title">&nbsp;<b>Delete Result From Here</b></h2>
								</div>
								<div class="panel-body">
									<div class="well">
										<form action="deleted_result.php" method="POST" enctype="multipart/form-data">
											<div class="form_sep">
												<label for="reg_input_name" class="req">Student Id <span style="color:red">*</span></label> </br>
												<input type="textarea" id="std_number" name="id" class="form-control parsley-validated" data-required="true">
											</div>
											<br>
											<div class="form_sep">
												<label for="reg_input_name" class="req">Course Code <span style="color:red">*</span></label> </br>
												<select class="selectpicker " name="course" data-width="100%" data-live-search="true" title="Select Course Code">
													<?php
														$query= mysql_query("SELECT distinct(course_code),course_name FROM tbl_course_info");
														
														while($row= mysql_fetch_assoc($query))
														{
															$code= $row['course_code'];
															$name= $row['course_name'];
													
													?>
													<option data-subtext="<?php echo "(" ;echo $name ;echo ")" ;?>"> <?php echo $code ;echo " " ;  }?> </option> 
												
												</select>
											</div>
											<!--</select> -->
											<br>
										
											<div class="form_sep">
												<label for="reg_input_name" class="req">Semester <span style="color:red">*</span></label> </br>
												<select class="selectpicker" name="semester" data-live-search="true" data-width="100%" title="Select Semester">
													<option> Spring </option> 
													<option> Summer </option> 
													<option> Fall </option> 
												</select>
											</div>
											</br>
											
											<div class="form_sep">
											   <label for="reg_input_name" class="req">Year <span style="color:red">*</span></label> </br>
											   
												<select class="selectpicker" name="year" data-live-search="true" data-width="100%" title="Select Year">
													<?php
													$year= date('Y');
													$c=0;
													while($c<=5){
													$show= $year-$c;
													?>
													<option> <?php echo $show; ?> </option> 
													<?php
													$c++;
													}
													?>
												</select>
											</div>
											<br>
											
											<button class="btn btn-default" type="submit" name="submit">Submit</button>
										
										</form>
									</div>		
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-md-1"></div>
					
				</div><br><br>
			</div>
			<!-------------------------------------->
			<?php 
		}
		 
		?>
		
		<!-------------------Container Ends---------------------->
<?php 
		include 'include/footer.php' ;

	}
	else  header('Location: index.php');
?>	
