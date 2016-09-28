<?php include("header.php");
require "init.php";
loggedin();
include("search_syllebus.php");
include("subject_php.php");
?>
		<div class="profile_area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="student_menu">
								<ul>
									<li><a class="menu_top" href="syllebus.php">Syllebus</a></li>
									<li><a class="menu_top" href="course_offer.php">Course Offer</a></li>
									<li><a class="menu_top" href="subject.php">Statistics</a></li>
									<li><a class="menu_top" href="change_pass.php">Change Password</a></li>
									<li><a class="menu_top" href="new_admin.php">Make New Admin</a></li>
									<li><a href="logout.php">Logout</a></li>		
								</ul>
						    </div>
					     </div>					
				    </div>
			    </div>
		    </div><!--End Of Profile Area-->
		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Add Subject</h2>
								</div>
								<div class="panel-body">	
									<form action="" method="POST" id="search" name="change_pass" enctype="multipart/form-data">	
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Name Of The Subject</label>
										<input id="std_id" name="u_pass" class="form-control edit_pass" type="text" placeholder="Enter Name Of the subject"/>
										<div class="error" id="first_error">Name Of The Subject Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Course Code</label>
										<input id="std_dept" name="uc_pass" class="form-control edit_pass" type="text" placeholder="Enter Course Code"/>
										<div class="error" id="second_error">Course Code Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Course Credit</label>
										<input id="std_idd" name="new_pass" class="form-control edit_pass" type="text" placeholder="Enter Course Credit"/>
										<div class="error" id="third_error">Course Credit Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_dept" class="label_admit">Prerequisite</label>
										<select id="std_pre" name="txt_std_pre" class="form-control edit_pass">
										<option selected="selected" value="0">None</option>
										<?php
								while($row=mysql_fetch_array($resullt))
								{	
										$course_title=$row['course_name'];
										$course_code=$row['course_auto_id'];
								?>
									<option value="<?php echo $course_code; ?>"><?php echo $course_title; ?></option>
									
									<?php
								}
								?>
										</select>
										<div class="error" id="fourth_error">Course Credit Must be filled out!</div>
									</div>
						
									<div class="form_group">
										<input type="submit" value="Save" id="submit" name="submit" class="btn btn-info change_submit"/>
									</div>
									<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>
									</form>
								</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h1 style="color:steelblue;">Syllebus</h1>
								</div>
								</br>
								<div class="panel-body">
									<form action="" method="POST" id="admission_form" name="admission" enctype="multipart/form-data">	
										<div class="form_group">
										<label for="student_dept" class="label_admit">Syllebus Name</label>
										<select id="std_depttt" name="txt_std_depttt" class="form-control edit_form">
											<option selected="selected" value="">Select Syllebus Name</option>
											<?php
										while($row1=mysql_fetch_array($resullt1))
										{
											$syllebus_auto_id=$row1['syllebus_auto_id'];
											$syllebus_name=$row1['syllebus_name'];
										?>
											<option value="<?php echo $syllebus_name;?>"><?php echo $syllebus_name; ?></option>
								<?php
										}
								?>
										</select>
										</div>
										<div class="form_group">
										<input type="submit" value="Search" id="submitt" name="addd_std_submit" class="btn btn-info change_submit"/>
										</div>
									</form>
								</div>			
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;"><a href="create_syllebus.php">Create New Syllebus</a></h2>
								</div>
							</div>	
						</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
<?php include("footer.php");?>
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
		if($("#std_idd").val() == ""){
			$("#third_error").show("slow");
			errors = true;
		}
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
	
	});
	</script> 
