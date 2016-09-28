<?php 
include("header1.php");
require "db_connection.php";
require "init.php";
loggedin();
$id=$_SESSION['teacher_id'];

$query2 = "Select * From tbl_teacher_info Where tch_id='$id'";
$result2= mysql_query($query2);
while($row = mysql_fetch_array($result2))
{	
		$imgpath=$row['tch_pic'];
		$name=$row['tch_name'];
}

if(isset($_POST['submit']))
{
	
	$old_pass  =isset($_POST['u_pass'])?$_POST['u_pass']:null;
	$new_pass  =isset($_POST['uc_pass'])?$_POST['uc_pass']:null;
	$new_cpass =isset($_POST['new_pass'])?$_POST['new_pass']:null;
	
	$queryy="select * from tbl_teacher_info where tch_id='$id'";
	$resultt=mysql_query($queryy);
	$row  = mysql_fetch_array($resultt);
	$opass =$row['tch_password'];
	$id =$row['tch_id'];
	if($opass == $old_pass)
	{
		if($new_pass == $new_cpass)
		{	$query="update tbl_teacher_info set tch_password='$new_pass' where tch_id='$id'";
			$result=mysql_query($query);
			if($result)
			{
				//echo"Password Successfully Changed";
				//header('location:student.php');
				echo '<script type="text/javascript">';
				echo 'alert("Password Successfully Changed")';
				echo '</script>';
			}
		}
		else
		{
			//echo"New Password Does Not Match";
			echo '<script type="text/javascript">';
			echo 'alert("New Password Does Not Match")';
			echo '</script>';
		}
			
	
	}
	else
	{
		//echo"Old Password Does Not Match";
		echo '<script type="text/javascript">';
		echo 'alert("Old Password Does Not Match")';
		echo '</script>';
	}
		

}

?>

		<div class="profile_area">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="student_image">
							<h4><?php echo $name; ?></h4>
							<img src="img/<?php echo $imgpath; ?>" alt="profile pic"/>
						</div>
					</div>
					<div class="col-md-10">
						<h4 class="welcome" style="color:steelblue">Welcome! <?php echo $name; ?></h4>
						<div class="teacher_menu">
							<ul>
								<li><a href="personal_info_teacher.php">Personal Info</a></li>
								<li><a href="teacher_courses.php">Courses</a></li>
								<li><a href="change_pass_1.php">Change Passsword</a></li>
								<li><a href="logout_teacher.php">Logout</a></li>
							</ul>
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
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Change Password</h2>
								</div>	
								<br>
								<div class="panel-body">	
									<form action="" method="POST" id="search" name="change_pass" enctype="multipart/form-data">	
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Old Password</label>
										<input id="std_id" name="u_pass" class="form-control edit_pass" type="password" placeholder="Old Password"required="required"/>
										<div class="error" id="first_error">Old Password Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">New Password</label>
										<input id="std_dept" name="uc_pass" class="form-control edit_pass" type="password" placeholder="New Password"title="Password must contain at least 8 characters, including UPPER/lowercase and numbers. To get a strong password, please use characters like- ~!@#$%^&*(){}|][" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"onchange=" 
                                    this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); 
                                    if(this.checkValidity()) form.renewpass.pattern = this.value;"/>
										<div class="error" id="second_error">New Password Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Confirm New Password</label>
										<input id="std_idd" name="new_pass" class="form-control edit_pass" type="password" placeholder="Confirm New Password"title="Password must contain at least 8 characters, including UPPER/lowercase and numbers. To get a strong password, please use characters like- ~!@#$%^&*(){}|][" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"onchange=" 
                                    this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); 
                                    if(this.checkValidity()) form.renewpass.pattern = this.value;"/>
										<div class="error" id="third_error">Confirm New Password Must be filled out!</div>
									</div>
						
									<div class="form_group">
										<input type="submit" value="Save" id="submit" name="submit" class="btn btn-info change_submit"/>
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