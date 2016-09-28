<?php 
 include("header.php");
require "db_connection.php";
require "init.php";
include "search_teacher_php.php";
loggedin();


?>

		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">View Teacher</h2>
								</div>
								<div class="panel-body">
									<form action="" name="search" method="POST" id="search">
										<div class="form_group">
											<label for="student_id" class="label_admit">Teacher ID</label>
											<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder="Teacher ID"/>
											<div class="error" id="first_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_dept" class="label_admit">Department</label>
												<select id="std_dept" name="txt_std_dept" class="form-control edit_form">
												<option selected="selected" value="">Select Department</option>
												<?php
												while($row=mysql_fetch_array($r))
												{	
													$dept_name=$row['dept_name'];
													$dept_id=$row['dept_id'];
													$dept_short_name=$row['dept_short_name'];
												?>
													<option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
									
										<?php
												}
										?>
												</select>
												<div class="error" id="second_error">Student Department Name must be filled out!</div>
										</div>
										<div class="form_group">
											<input type="submit" value="Search" id="submit" name="add_std_submit" class="btn btn-info change_submit"/>
										</div>	
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>		
							</div>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;"><a href="add_new_teacher.php">Add New Teacher</a></h2>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php include("footer.php")?> 
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

		if($("#std_dept").val() == ""){
			$("#second_error").show("slow");
			errors = true;
		}
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
	
	});
	</script>
