<?php 
	include('admin_header.php');
	
	if(isset($_POST['deleteAdmin']))
	{
		$deleteAdminName = $_POST['deleteAdminName'];		
		$currentUsername = $_POST['currentUsername'];		
		$currentPass = $_POST['currentPass'];	
		$anotherUsername = $_POST['anotherUsername'];	
		$anotherPass = $_POST['anotherPass'];	
		
		if(!empty($deleteAdminName) && !empty($currentUsername) && !empty($currentPass)&& !empty($anotherUsername)&& !empty($anotherPass))
		{
			if($currentUsername!=$anotherUsername)
			{
				$query="SELECT * FROM users WHERE username='".mysql_real_escape_string($currentUsername)."'";
				
				if($query_run = mysql_query($query))
				{
					$query1="SELECT * FROM users WHERE username='".mysql_real_escape_string($anotherUsername)."'";
					
					if($query_run1 = mysql_query($query1))
					{
						$password1 = mysql_result($query_run, 0, 'password');
						$password2 = mysql_result($query_run1, 0, 'password');
						if($password1==md5($currentPass) && $password2==md5($anotherPass))
						{
							$query2="DELETE FROM users WHERE username='".mysql_real_escape_string($deleteAdminName)."'";
							if($query_run2 = mysql_query($query2))
							{
								echo '<script type="text/javascript"> alert("Admin Successfully deleted!") </script>';
							}
							else
							{
								echo '<script type="text/javascript"> alert("Something Worng!") </script>';
							}
						}
						else
						{
							echo '<script type="text/javascript"> alert("Password not matched!") </script>';
						}
					}
					else
					{
						echo '<script type="text/javascript"> alert("Something Worng!") </script>';
					}
					
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
					
				}
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") </script>';
		}
	}
	
?>		<div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.html"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Add Teacher/Employee</span>
               </div>
            </div>	
			<div class="col-md-12">
			<div id="delete_an_admin" class="tab-pane">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Delete An Admin</h4>
                              </div>
                              <div class="panel-body">
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Username of admin which you want to delete<span style="color:red">*</span></label>
                                    <input required type="text" class="form-control" name="deleteAdminName">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Current admin's username<span style="color:red">*</span></label>
                                    <input  required readonly value="<?php echo $_SESSION['sessionUsername']; ?>" type="text" class="form-control" name="currentUsername">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Current admin's password<span style="color:red">*</span></label>
                                    <input  required type="password" class="form-control" name="currentPass">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Enter 2nd admin's username<span style="color:red">*</span></label>
                                    <input  required type="text" class="form-control" name="anotherUsername">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Enter 2nd admin's password<span style="color:red">*</span></label>
                                    <input  required type="password" class="form-control" name="anotherPass">
                                 </div>
                                 <br />
                                 <button name="deleteAdmin" type="submit" class="btn btn-primary fa fa-save">&nbsp;Delete</button>	
								</form>
                              </div>
                           </div>
                           </div>							
						</div>
                     </div>
                     </div>
					</div>
                   </div>
					 
	<?php
		include('admin_footer.php')
	  ?>