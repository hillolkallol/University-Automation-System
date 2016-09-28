<?php 
include("header.php");
require "db_connection.php";
require "init.php";
loggedin();
$id=$_SESSION['user_id'];

if(isset($_POST['submit']))
{
	
	$name  =isset($_POST['u_pass'])?$_POST['u_pass']:null;
	$new_pass  =isset($_POST['uc_pass'])?$_POST['uc_pass']:null;
	$new_cpass =isset($_POST['new_pass'])?$_POST['new_pass']:null;
	
	$queryy="select * from tbl_dept_admin where dadmin_auto_id='$id'";
	$resultt=mysql_query($queryy);
	while($row  = mysql_fetch_array($resultt))
	{	
		$opass =$row['dadmin_password'];
		$id   =$row['dadmin_auto_id'];
		$dept   =$row['dadmin_dept'];
	}		
	if($new_pass == $new_cpass)
	{	$query="insert into tbl_dept_admin(dadmin_name,dadmin_password,dadmin_dept)values('$name','$new_pass',
		'$dept')";
		$result=mysql_query($query);
		if($result)
		{
			//echo"New Admin Has Been Successfully Created";
			echo '<script type="text/javascript">';
				echo 'alert("New Admin Has Been Successfully Created")';
				echo '</script>';
			//header('location:home.php');
		}
	}
	else
	{
		//echo"Invalid Name/password Does Not Match";
			echo '<script type="text/javascript">';
				echo 'alert("Invalid Name/password Does Not Match")';
				echo '</script>';
	}
			
	

		

}

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
									<h2 style="color:steelblue;">Make New Admin</h2>
								</div>	
								<br>
								<div class="panel-body">	
									<form action="" method="POST" id="search" name="change_pass" enctype="multipart/form-data">	
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Admin Name</label>
										<input id="std_id" name="u_pass" class="form-control edit_pass" type="text" placeholder="Admin Name"/>
										<div class="error" id="first_error">Admin Name Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Password</label>
										<input id="std_dept" name="uc_pass" class="form-control edit_pass" type="password" placeholder=" Password"/>
										<div class="error" id="second_error"> Password Must be filled out!</div>
									</div>
									<div class="form_group edit_passs">
										<label for="student_name" class="label_admit">Confirm New Password</label>
										<input id="std_idd" name="new_pass" class="form-control edit_pass" type="password" placeholder="Confirm  Password"/>
										<div class="error" id="third_error">Confirm  Password Must be filled out!</div>
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