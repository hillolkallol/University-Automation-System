<?php 
	include('admin_header.php');
	
	//code for edit user detail starts
	if(isset($_POST['edit']))
	{
		$editusername = $_POST['username'];
		$editfname = $_POST['fname'];
		$editlname = $_POST['lname'];
		$editemail = $_POST['email'];
		
		if(!empty($editusername) && !empty($editfname) && !empty($editlname) && !empty($editemail))
		{
			$query = "UPDATE users SET fname= '".mysql_real_escape_string($editfname)."', lname= '".mysql_real_escape_string($editlname)."', email = '".mysql_real_escape_string($editemail)."' WHERE username='".mysql_real_escape_string($editusername)."'";
			
			if($query_run = mysql_query($query))
			{
				echo '<script type="text/javascript">';
				echo 'alert("Edited!")';
				echo '</script>';
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'alert("Sorry!")';
				echo '</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("You must fill all the fields!")';
			echo '</script>';
		}
	}
	//code for edit user detail ends
	
	
	//code for fill all the field of form starts
	$sessionUsername = $_SESSION['sessionUsername'] ;
		$username;
		$firstName;
		$lastName;
		$email;
					
			$query = "SELECT * FROM users WHERE username='".mysql_real_escape_string($sessionUsername)."'";
					
					if($query_run = mysql_query($query))
					{
						if(mysql_num_rows($query_run)==1)
						{
							$username = mysql_result($query_run, 0, 'username');
							$firstName = mysql_result($query_run, 0, 'fname');
							$lastName = mysql_result($query_run, 0, 'lname');
							$email = mysql_result($query_run, 0, 'email');
							
						}
						else
						{
							echo '<script type="text/javascript">';
							echo 'alert("Something Wrong! Please Try Again Later!")';
							echo '</script>';
						}
					}
	//code for fill all the field of form ends
					
?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Admin Profile</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <!--
			<div class="col-md-3">
               <div class="admin_img">
                  <img alt="" src="img/ad_info3.png" style="width: 100%;">
               </div>
			   <br>
			   <input type="file" id="exampleInputFile">
            </div>
			-->
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">Admin Profile</h4>
                  </div>
                  <div class="panel-body">
					<form action="<?php echo $current_file;?>" method="POST">
						 <div class="form_sep">
							<label>User Name <span style="color:red">*</span></label>
							<input required value=<?php echo $username; ?> type="text" class="form-control" name="username" readonly>
						 </div>
						 <br>
						 <div class="form_sep">
							<label>First Name <span style="color:red">*</span></label>
							<input required value=<?php echo $firstName; ?> type="text" class="form-control" name="fname">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>Last Name <span style="color:red">*</span></label>
							<input required value=<?php echo $lastName; ?> type="text" class="form-control" name="lname">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>E-Mail <span style="color:red">*</span></label>
							<input required value=<?php echo $email; ?> type="text" class="form-control" name="email">
						 </div>
						 <br>
						 
						 <div class="button_edit">
							<input type="submit" value="Edit" name="edit" class="btn btn-primary">
						 </div>
					</form>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  
	  
      <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>
