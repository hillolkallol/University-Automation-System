<?php
	include("header.php");
	include("dept_stats_php.php");
?>
<div class="admisssion_area">
		<div class="container">
			<div class="row">					
				<div class="col-md-12">
					<div class="main_area">
						<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;"><?php echo $dept_name;?> Department</h2>
								</div>
									<div class="panel-body">
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info1.png" alt="" />
												<span><?php echo $total_student;?></span>
												<p>Total Number Of Student</p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info2.png" alt="" />
												<span><?php echo $total_teacher;?></span>
												<p>Total Number Of Teachers</p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info4.png" alt="" />
												<span><?php echo $total_dept;?></span>
												<p>Total Number Of Programs</p>
											</div>
										</div>
									</div>
									<div class="panel-body">
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info1.png" alt="" />
												<span><?php echo $total_student_1st_semester;?></span>
												<p>Total Number Of Student This Semester</p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info2.png" alt="" />
												<span><?php echo $total_student_1st_male;?></span>
												<p>Total Number Of Students Male</p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="single_info">
												<img src="../img/ad_info4.png" alt="" />
												<span><?php echo $total_student_1st_female;?></span>
												<p>Total Number Of Students Female</p>
											</div>
										</div>
									</div>
						
						
								<div class="panel-heading">
									<h2 style="color:steelblue;"><a href="dept_teacher_stats_list.php?id=<?php echo $tch_dept; ?>">View Teacher's Information</a></h2>
								</div>
								<div class="panel-body"></div>
								<div class="panel-heading">
									<h2 style="color:steelblue;"><a href="dept_student_stats_list.php?id=<?php echo $std_dept; ?>">View Students Information</a></h2>
								</div>
								<div class="panel-body">
									<form action="" name="search" method="POST" id="search">
										<div class="form_group">
											<label for="student_id" class="label_admit">Student Batch No</label>
											<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder="Batch No"/>
											<div class="error" id="first_error">Student Batch No Must be filled out!</div>
										</div>
										<div class="form_group">
											<input type="submit" value="Search" id="submit" name="add_std_submit" class="btn btn-info change_submit"/>
										</div>	
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
<?php
	include("footer.php");
?>
<!--Jquery using for admission-->
		<script>
		$("#search").submit(function(){
		
		// Assume there are no error on the form
		var errors = false;
		
		// hide all the error messages
		$(".error").hide();
		
		// Check each field to make sure they're not blank
		if($("#std_id").val() == ""){
			$("#first_error").show("slow");
			errors = true;
		}

		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
	
	});
	</script>
