<?php include("header_2.php");
require "db_connection.php";
include"login.php";
?>
        <div class="login_area">
			<div class="container">
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-7">
						<div class="login_form">
							<h2>Login</h2>
							<form action="" name="login" method="post">
								<div class="form-group">
									<select id="std_dept" name="txt_std_dept" class="form-control" required="required">
									<option selected="selected" value="">Select Department</option>
								<?php
								while($row=mysql_fetch_array($r))
								{	
										$dept_name=$row['dept_name'];
										$dept_id=$row['dept_id'];
								?>
									<option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
									
									<?php
								}
								?>
								</select>
								</div>
								<div class="form-group">
									<input name="user_name" type="text" placeholder="Your name" class="form-control input"required="required">
								</div>
								<div class="form-group">
									<input name="user_pass" type="password" placeholder="Password" class="form-control input"required="required">
								</div>
								<div class="form-group">
									<input name="btn_login" type="submit" class="btn btn-primary" value="Submit">
								</div>
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
 <?php include("footer_2.php")?> 
