<?php include("header1.php");
include"db_connection.php";
include "for_admission_php.php";
?>
			
		<!-- After Submitting admission form -->
		
		
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
											<img src="../img/bb.jpg" alt="profile pic"/>
										</div>
										<div class="upload_area">
											<div class="pic_errors" id="pic_error">You Forgot To Upload Your Photo!</div>
											<input id="std_pic" class="btn btn-xs btn-info add_pic " name="txt_std_pic"type="file"/>
												
										</div>
									</div>	
								</div>	
								<div class="form_group">
									<label for="student_dept" class="label_admit">Name of the Department</label>
									<select id="std_dept" name="txt_std_dept" class="form-control edit_form">
									<option selected="selected" value="">Select Department</option>
								<?php
								while($row=mysql_fetch_array($result))
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
									<label for="student_dept" class="label_admit">Name of the program</label>
									<select id="std_prg" name="txt_std_prg" class="form-control edit_form">
										<option selected="selected" value="">Select Your Program</option>
									</select>
									<div class="error" id="seventeen_error">Applicant Program Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_name" class="label_admit">Name of the Applicant</label>
									<input id="std_name" name="txt_std_name" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="second_error">Applicant Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_fname" class="label_admit">Father's Name</label>
									<input id="std_fname" name="txt_std_fname" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="third_error">Applicant Father's Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_mname" class="label_admit">Mother's Name</label>
									<input id="std_mname" name="txt_std_mname" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="fourth_error">Applicant Mother's Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_gname" class="label_admit">Local Guardian's Name</label>
									<input id="std_gname" name="txt_std_gname" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="fifth_error">Applicant Guardian's Name must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_per_address" class="label_admit">Permanent Address</label>
									<input id="std_per_add" name="txt_std_per_add" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="six_error">Applicant Permanent Address must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_pre_address" class="label_admit">Present Address</label>
									<input id="std_pre_add" name="txt_std_pre_add" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="seven_error">Applicant Present Address must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_contact_no" class="label_admit">Telephpne/Mobile(Applicant)</label>
									<input title="Phone number is not valid" pattern="(?=.*\d).{6,11}" id="std_cntc_no" name="txt_std_cntc_no" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="eight_error">Applicant Telephpne/Mobile must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_gcntc_no" class="label_admit">Telephone/Mobile(Guardian)</label>
									<input title="Phone number is not valid" pattern="(?=.*\d).{6,11}" id="std_gcntc_no" name="txt_std_gcntc_no" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="nine_error">Applicant Telephone/Mobile(Guardian) must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_birth" class="label_admit">Date of Birth</label>
									<input name="txt_std_bdate" class="form-control edit_form"type="text"id="datepicker"placeholder=""/>
									<div class="error" id="ten_error">Applicant Date of Birth must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_gender" class="label_admit">Gender</label>
									<select id="std_gender" name="txt_std_gender" class="form-control edit_form">
										<option selected="selected" value="">Select Gender</option>
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
									<div class="error" id="eleven_error">Applicant Gender must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_nationality" class="label_admit">Student Nationality</label>
									<input id="std_nation" name="txt_std_nation" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="twelve_error">Applicant Nationality must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_ssc_result" class="label_admit">SSC Result</label>
									<input id="std_ssc_result" name="txt_std_ssc_rslt" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="fourteen_error">Applicant SSC Result must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_hsc_result" class="label_admit">HSC Result</label>
									<input id="std_hsc_result" name="txt_std_hsc_rslt" class="form-control edit_form"type="text" placeholder=""/>
									<div class="error" id="sixteen_error">Applicant HSC Result must be filled out!</div>
								</div>
								<div class="form_group">
									<label for="student_email" class="label_admit">Student Email</label>
									<input id="std_email" name="txt_std_email" class="form-control edit_form"type="email" placeholder=""/>
									<div class="error" id="email_error">Applicant Email Address must be filled out!</div>
								</div>
								<div class="form_group">
									<input type="submit" value="Submit" id="submit" name="add_std_submit" class="btn btn-primary change_submit"/>
								</div>
							</form>
							<div id="warning">Oops, missed something, try again.</div>
							<p class="subtext">By clicking submit you agree to our <a href="term.php">Terms & Conditions</a></p>
						</div>			
					</div>
				</div>
			</div>
		</div>
       


<?php include"footer1.php"?>









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
		if($("#std_prg").val() == ""){
			$("#seventeen_error").show("slow");
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
		if($("#std_gname").val() == ""){
			$("#fifth_error").show("slow");
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
		if($("#std_gcntc_no").val() == ""){
			$("#nine_error").show("slow");
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
		if($("#std_ssc_result").val() == ""){
			$("#fourteen_error").show("slow");
			errors = true;
		}
		if($("#std_hsc_result").val() == ""){
			$("#sixteen_error").show("slow");
			errors = true;
		}
		if($("#std_email").val() == ""){
			$("#email_error").show("slow");
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
	//	$(".close").click(function(){
		//	$(".overlay").fadeOut();
	//	});
		</script>
		
<script>
	$(document).ready(function(){
    
	var show_courses = 'std_prg';
	var select_id = 'std_dept';
	$('#'+select_id).change(function(e) 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({url: 'admission_ajax.php?abds='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#'+show_courses).html(output);
            }});
		
	});
   
});

</script>		


