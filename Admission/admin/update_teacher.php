<?php
	include("header.php");
	include"edit_teacher_php.php";
?>
<!-- After Submitting admission form -->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="overlay">
								<div class="success">
								<h1>Thank you for signing up!</h1>
								<p>Now Click continue To go ahead towards our account section</p>
								<p><a class="close" href="www.google.com">Continue</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
		
		
		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<h1>Application Form for Admission</h1>
							<h2>Undergraduate Program</h2>
							<p>We're excited to have you come here</p>
							<form action="" method="POST" id="admission_form" name="admission" enctype="multipart/form-data">
								<div class="row">
									<div class="col-md-9"></div>
									<div class="col-md-3">
										<div class="student_pic">
											<img src="<?php echo $imgpath; ?>" alt="profile pic"/>
										</div>
									</div>	
								</div>	
								<div class="form_group">
									<label for="student_dept" class="label_admit">Name of the Department</label>
									<select id="std_dept" name="txt_std_dept" class="form-control edit_form">
									<option selected="selected" value="<?php echo $dept_id;?>"><?php echo $dept_name;?></option>
									<?php
								while($row=mysql_fetch_array($resul))
								{	
										$dept_name=$row['dept_name'];
										$dept_id=$row['dept_id'];
										$dept_short_name=$row['dept_short_name'];
										$dept_program_name=$row['dept_program_name'];
								?>
									<option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
									
									<?php
								}
								?>
									</select>
									<div class="error" id="first_error">Applicant Department Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_name" class="label_admit">Name of the Applicant</label>
									<input id="std_name" name="txt_std_name" class="form-control edit_form"type="text" placeholder="Your Name" value="<?php echo $name; ?>"/>
									<div class="error" id="second_error">Applicant Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_fname" class="label_admit">Father's Name</label>
									<input id="std_fname" name="txt_std_fname" class="form-control edit_form"type="text" placeholder="Father's Name" value="<?php echo $fname; ?>"/>
									<div class="error" id="third_error">Applicant Father's Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_mname" class="label_admit">Mother's Name</label>
									<input id="std_mname" name="txt_std_mname" class="form-control edit_form"type="text" placeholder="Mother's Name" value="<?php echo $mname; ?>"/>
									<div class="error" id="fourth_error">Applicant Mother's Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_per_address" class="label_admit">Permanent Address</label>
									<input id="std_per_add" name="txt_std_per_add" class="form-control edit_form"type="text" placeholder="Permanent Address" value="<?php echo $per_add; ?>"/>
									<div class="error" id="six_error">Applicant Permanent Address must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_pre_address" class="label_admit">Present Address</label>
									<input id="std_pre_add" name="txt_std_pre_add" class="form-control edit_form"type="text" placeholder="Present Address" value="<?php echo $pre_add; ?>"/>
									<div class="error" id="seven_error">Applicant Present Address must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_contact_no" class="label_admit">Telephpne/Mobile(Applicant)</label>
									<input id="std_cntc_no" name="txt_std_cntc_no" class="form-control edit_form"type="text" placeholder="0171..." value="<?php echo $std_cntc_no; ?>"/>
									<div class="error" id="eight_error">Applicant Telephpne/Mobile must be filled out!</div>
								</div>
								
								<div class="form_group">
									<label for="student_birth" class="label_admit">Date of Birth</label>
									<input name="txt_std_bdate" class="form-control edit_form"type="text"id="datepicker"placeholder="21/10/2014" value="<?php echo $std_bdate; ?>"/>
									<div class="error" id="ten_error">Applicant Date of Birth must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_gender" class="label_admit">Gender</label>
									<select id="std_gender" name="txt_std_gender" class="form-control edit_form">
										<option selected="selected" value="<?php echo $gender; ?>"><?php echo $gender; ?></option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
									<div class="error" id="eleven_error">Applicant Gender must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_nationality" class="label_admit">Student Nationality</label>
									<input id="std_nation" name="txt_std_nation" class="form-control edit_form"type="text" placeholder="Bangladesh" value="<?php echo $std_nation; ?>"/>
									<div class="error" id="twelve_error">Applicant Nationality must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_Id" class="label_admit">Teacher Position</label>
									<input id="std_position" name="txt_std_pos" class="form-control edit_form"type="text" placeholder="1101020001" value="<?php echo $std_ssc_rslt;?>"/>
									<div class="error" id="position_error">Applicant ID must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_Id" class="label_admit">Teacher Qualification</label>
									<input id="std_qf" name="txt_std_id_qf" class="form-control edit_form"type="text" placeholder="1101020001" value="<?php echo $std_hsc_rslt;?>"/>
									<div class="error" id="qf_error">Applicant ID must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_email" class="label_admit">Student Email</label>
									<input id="std_email" name="txt_std_email" class="form-control edit_form"type="email" placeholder="rimon@gmail.com" value="<?php echo $std_email; ?>"/>
									<div class="error" id="email_error">Applicant Email Address must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_Id" class="label_admit">Student ID</label>
									<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder="1101020001" value="<?php echo $std_id; ?>"/>
									<div class="error" id="id_error">Applicant ID must be filled out!</div>
								</div>
								<div class="form_group">
									<input type="submit" value="Submit" id="submit" name="add_std_submit" class="btn btn-primary change_submit"/>
								</div>
							</form>
							<div id="warning">Oops, ya missed something, try again.</div>
							<p class="subtext">By clicking submit you agree to our <a href="term.html">Terms & Conditions</a></p>
						</div>			
					</div>
				</div>
			</div>
		</div>
        <div class="testimonial_area">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<h2>Contact Info</h2>			
						<div class="Info_about_us">
							<ul>
								<li><i class="fa fa-map-marker"></i>&nbsp;Leading University,Sylhet</li>
								<li><i class="fa fa-phone"></i>&nbsp;Phone: +91-9846-192-868</li>
								<li><i class="fa fa-envelope"></i>&nbsp;E-Mail: support@cse26.com</li>
								<li><i class="fa fa-globe"></i>&nbsp; Web: http://cse26.com</li>
							</ul>
						</div>
					</div>
					<div class="col-md-4">
						<h2>About Us</h2>
						<div class="Info_about_us">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>
						</div>
					</div>
					<div class="col-md-4">
						<h2>Sign Up for Email Newsletter</h2>
						<div class="Info_about_us">
							<form>
								<div class="form-group">
								<input type="text" placeholder="Your  Name" class="form-control">
								</div>
								<div class="form-group">
								<input type="text" placeholder="Your Email" class="form-control">
								</div>
								<div class="form-group">
								<a href="" class="btn btn-primary btn-lg btn-block"><i class="fa fa-hand-o-right"></i>&nbsp;Submit</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>	
<!-- End of Testimonial Area -->
<?php include("footer.php")?>


<!--Jquery using for admission-->
		<script>
		$("#admission_form").submit(function(){
		
		// Assume there are no error on the form
		var errors = false;
		
		// hide all the error messages
		$(".error").hide();
		
		// Check each field to make sure they're not blank
		if($("#std_pic").val() == ""){
			$("#pic_error").show("slow");
			errors = true;
		}
		if($("#std_dept").val() == ""){
			$("#first_error").show("slow");
			errors = true;
		}
		if($("#std_name").val() == ""){
			$("#second_error").show("slow");
			errors = true;
		}
		if($("#std_fname").val() == ""){
			$("#third_error").show("slow");
			errors = true;
		}
		if($("#std_mname").val() == ""){
			$("#fourth_error").show("slow");
			errors = true;
		}
		if($("#std_per_add").val() == ""){
			$("#six_error").show("slow");
			errors = true;
		}
		if($("#std_pre_add").val() == ""){
			$("#seven_error").show("slow");
			errors = true;
		}
		if($("#std_cntc_no").val() == ""){
			$("#eight_error").show("slow");
			errors = true;
		}
		if($("#datepicker").val() == ""){
			$("#ten_error").show("slow");
			errors = true;
		}
		if($("#std_gender").val() == ""){
			$("#eleven_error").show("slow");
			errors = true;
		}
		if($("#std_nation").val() == ""){
			$("#twelve_error").show("slow");
			errors = true;
		}
		if($("#std_position").val() == ""){
			$("#position_error").show("slow");
			errors = true;
		}
		if($("#std_qf").val() == ""){
			$("#qf_error").show("slow");
			errors = true;
		}	
		if($("#std_email").val() == ""){
			$("#email_error").show("slow");
			errors = true;
		}				
		if($("#std_id").val() == ""){
			$("#id_error").show("slow");
			errors = true;
		}
		if($("#std_password").val() == ""){
			$("#pass_error").show("slow");
			errors = true;
		}
		
		
		
		// If there are errors, then show a general error message
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
		
		// If there are not any errors, show a success message
		//$(".overlay").fadeIn();
		return true;
		//if(!errors){
			//alert("garia");
			//return true;
		//}
	});
	
	// Make the close button on the success screen work
		//$(".close").click(function(){
		//	$(".overlay").fadeOut();
		//});
		</script>

