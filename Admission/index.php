<?php include("header.php")?>
        <div class="login_area">
			<div class="container">
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-7">
						<div class="login_form">
							<h2>Login</h2>
							<form action="login.php" name="login" method="post" id="search">
								<div class="form-group">
									<select name="user" id="user_id" class="form-control">
										<option value=""> Select User </option>
										<option value="1">Student</option>
										<option value="2">Teacher</option>
									</select>
									<div class="error" id="first_error">Please Seelct A User First!</div>
								</div>
								<div class="form-group">
									<input name="user_id" id="std_dept"type="text" placeholder="Your ID" class="form-control input">
									<div class="error" id="second_error">Please Seelct User ID</div>
								</div>
								<div class="form-group">
									<input name="user_pass" id="std_idd" type="password" placeholder="Password" class="form-control input">
									<div class="error" id="third_error">Please Seelct User Password!</div>
								</div>
								<div class="form-group">
									<input name="btn_login" id="submit"type="submit" class="btn btn-primary" value="Submit">
									
								</div>
								<div id="warning">Oops, ya missed something, try again.</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End of Login Area -->
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
		$("#search").submit(function(){
		
		// Assume there are no error on the form
		var errors = false; 
		
		// hide all the error messages
		$(".error").hide();
		
		// Check each field to make sure they're not blank
		if($("#user_id").val() == ""){
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