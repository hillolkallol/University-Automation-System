<?php 
	include('admin_header.php');
	$duplicate = 1;
	
	if(isset($_POST['makeAdmin']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$email = $_POST['email'];
		
		$password_hash = md5($password);
		
		if(!empty($username) && !empty($password) && !empty($fname) && !empty($lname) && !empty($email))
		{
			$query0="SELECT * FROM users";
			if($query_run0 = mysql_query($query0))
			{
				while($query_row0 = mysql_fetch_assoc($query_run0))
				{
					if($query_row0['username']==$username)
					{
						$duplicate = 0;
					}
				}
			}

			if($duplicate==1)
			{
				$query = "INSERT INTO users (username, password, fname, lname, email, category) VALUES ('".mysql_real_escape_string($username)."','".mysql_real_escape_string($password_hash)."','".mysql_real_escape_string($fname)."','".mysql_real_escape_string($lname)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string(1)."')";
			
				if($query_run = mysql_query($query))
				{
					echo '<script type="text/javascript">';
					echo 'alert("New Admin Created!")';
					echo '</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'alert("Username must be unique!")';
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
                  <a href="index.html"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Make An Admin</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">New Admin Profile</h4>
                  </div>
                  <div class="panel-body">
				  
<!------------------------------Form starts here------------------------------------------>				  
                     <form action="<?php echo $current_file;?>" method="POST">
						 <div class="form_sep">
							<label>User Name <span style="color:red">*</span></label>
							<input required title="Username must be unique" type="text" class="form-control" name="username">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>Password <span style="color:red">*</span></label>
							<input name="password" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers. To get a strong password, please use characters like- ~!@#$%^&*(){}|][" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" class="form-control input" onchange=" 
                                    this.setCustomValidity(this.validity.patternMismatch ? this.title : '');
                                    ">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>First Name <span style="color:red">*</span></label>
							<input required type="text" class="form-control" name="fname">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>Last Name <span style="color:red">*</span></label>
							<input required type="text" class="form-control" name="lname">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>E-Mail <span style="color:red">*</span></label>
							<input required type="email" class="form-control" name="email">
						 </div>
						 <br> <!--
						 <div class="form_sep">
							<label class="req" for="reg_input">Status <span style="color:red">*</span></label>
							<select class="form-control" name="course" id="course">
							   <option value="" selected="selected">Select Status</option>
							   <option value="1">Super Admin</option>
							   <option value="1">Super Admin</option>
							   <option value="1">Super Admin</option>
							</select>
						 </div>
						 <br />
						 <br>
						 <div class="form_sep">
							<label>Profile Picture <span style="color:red">*</span></label>
							<input type="file" id="exampleInputFile">
						 </div>
						 <br /> -->
						 <div class="button_edit">
							<input type='submit' value='Make Admin' name='makeAdmin' class="btn btn-primary" href="">
						 </div>
					 </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
	  <!------------------------------------Admin List : Table Starts from here---------------------------------------->
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="alert alert-info"><strong>All Admin List</strong></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <table class="table table-hover">
                  <thead>
                     <tr>
                        <th>User Name</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>E-Mail Adress</th>
                        <!-- <th>Action</th> -->
                     </tr>
                  </thead>
                  <tbody>                     
                     <tr>
                        <td><?php
							$query = "SELECT * FROM users WHERE category='".mysql_real_escape_string(1)."'";
					
							if($query_run = mysql_query($query))
							{
								while($query_row = mysql_fetch_assoc($query_run))
								{
									$username = $query_row['username'];
									echo $username.'<br><br>';
								}
							}
						?></td>
                        <td><?php
							$query = "SELECT * FROM users WHERE category='".mysql_real_escape_string(1)."'";
					
							if($query_run = mysql_query($query))
							{
								while($query_row = mysql_fetch_assoc($query_run))
								{
									$fname = $query_row['fname'];
									echo $fname.'<br><br>';
								}
							}
						?></td>
                        <td><?php
							$query = "SELECT * FROM users WHERE category='".mysql_real_escape_string(1)."'";
					
							if($query_run = mysql_query($query))
							{
								while($query_row = mysql_fetch_assoc($query_run))
								{
									$lname = $query_row['lname'];
									echo $lname.'<br><br>';
								}
							}
						?></td>
                        <td><?php
							$query = "SELECT * FROM users WHERE category='".mysql_real_escape_string(1)."'";
					
							if($query_run = mysql_query($query))
							{
								while($query_row = mysql_fetch_assoc($query_run))
								{
									$email = $query_row['email'];
									echo $email.'<br><br>';
								}
							}
						?></td>
						<!--
                        <td><?php /*
							$query = "SELECT * FROM users WHERE category='".mysql_real_escape_string(1)."'";
					
							if($query_run = mysql_query($query))
							{
								while($query_row = mysql_fetch_assoc($query_run))
								{
									$username = $query_row['username'];
									echo '<button class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#delete_admin">Delete</button> <br>';
								}
							}*/
						?></td> -->
                     </tr>
                  </tbody>
               </table>
            </div>
			
			
			<!--Modal for delete button-->
			<!--
            <div class="modal fade" id="delete_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                     </div>
                     <div class="modal-body">
                        <h1>Are You Sure?</h1>
                     </div>
                     <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary">Yes</button>
                     </div>
                  </div>
               </div>
            </div> -->
         </div>
      </div>
      <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>
