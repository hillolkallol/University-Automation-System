<?php 
	include('admin_header.php');
	
	if(isset($_POST['save']))
	{
		$oldpass1 = $_POST['oldpass'];
		$newpass1 = $_POST['newpass'];
		$renewpass1 = $_POST['renewpass'];
		
		if(!empty($oldpass1) && !empty($newpass1) && !empty($renewpass1))
		{
			$oldpass = md5($oldpass1);
			$newpass = md5($newpass1);
			$renewpass = md5($renewpass1);
			$query = "SELECT * FROM users WHERE password='".mysql_real_escape_string($oldpass)."'";
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$sessionUsername = $_SESSION['sessionUsername'];
					$hereUsername = mysql_result($query_run, 0, 'username');
					
					if($sessionUsername == $hereUsername)
					{
						if($newpass == $renewpass)
						{
							$query = "UPDATE users SET password= '".mysql_real_escape_string($newpass)."' WHERE password='".mysql_real_escape_string($oldpass)."'";
							
							if($query_run = mysql_query($query))
							{
								echo '<script type="text/javascript">';
								echo 'alert("Updated New Password!")';
								echo '</script>';
							}
							else
							{
								echo '<script type="text/javascript">';
								echo 'alert("Sorry! Something worng here!")';
								echo '</script>';
							}
						}
						else
						{
							echo '<script type="text/javascript">';
							echo 'alert("New Password and Re-type password doesn\'t match with each others!")';
							echo '</script>';
						}
					}
					else
					{
						echo '<script type="text/javascript">';
						echo 'alert("Wrong old password!")';
						echo '</script>';
					}
				}
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("You must fill all the fields!")';
			echo '</script>';
		}
	}
?>
<html>
<body>
               <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="breadcrumbs">
                           <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                           <a href="index.html"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                           <span class="sep">/&nbsp;&nbsp;</span>
                           <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Change Password</span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="login_content">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                           <div class="single_login">
                              <h2>Change Password</h2>
                              <form action="<?php echo $current_file;?>" method="POST">
                                 <div class="form-group">
                                    <input name="oldpass" type="password" placeholder="Your Current Password" required class="form-control input">
                                 </div>
                                 <div class="form-group">
                                    <input name="newpass" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers. To get a strong password, please use characters like- ~!@#$%^&*(){}|][" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" placeholder="New Password" class="form-control input" onchange=" 
                                    this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); 
                                    if(this.checkValidity()) form.renewpass.pattern = this.value; 
                                    ">
                                 </div>
                                 <div class="form-group">
                                    <input name="renewpass" title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Re-Type Password" class="form-control input">
                                 </div>
                                 <div class="form-group">
                                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3"></div>
                  </div>
               </div>
              
            </body>
         </html>
 <?php
		include('admin_footer.php')
	  ?>