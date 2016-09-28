<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['userida']) && !empty($_SESSION['userida']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(loggedin())
	{
		
			if(isset($_POST['makeAdmin']))
			
		{	include'include/admin_header.php';
			$admin_id = $_POST['admin_id'];
			$admin_pass = $_POST['admin_pass'];
			$admin_name = $_POST['admin_name'];
			$status = $_POST['status'];
								
			//$password_hash = md5($password);
								
			if(!empty($admin_id) && !empty($admin_pass) && !empty($admin_name) && !empty($status))
				{
					$query = "INSERT INTO admin_info_exam (admin_id, admin_name, admin_pass, admin_status) VALUES ('$admin_id','$admin_name','$admin_pass','$status')";		
					if($query_run = mysql_query($query))
						{ ?>
							
					<?php //Finding User Info
					$name=null;	$status=null;
					$info = mysql_query("SELECT * FROM admin_info_exam");
					while($row = mysql_fetch_array($info))
					{
						if($admin_id==$row['admin_id'] )
						{	
							$name=$row['admin_name'];
							$status=$row['admin_status'];
							break;
						}
						else continue;
					}
				?>
			<div class="container">
			<div class="row">
				
				<div class="col-md-1"></div>
				
				<div class="col-md-3">
					<div class="border1">
						<a href="result_entry.php"  class="list-group-item ">Enter Result</a>
						<a href="result_modify.php" class="list-group-item ">Modify Result</a>
						<a href="result_delete.php"  class="list-group-item ">Delete Result</a>
						<a href="a_routine_entry.php" class="list-group-item ">Enter Routine</a>
						<a href="up_routine.php"   class="list-group-item ">Uplaoded Routine</a>
						<a href="a_notice_entry.php" class="list-group-item ">Enter Notice </a>
						<a href="a_n_action.php" class="list-group-item ">View Notice </a>
						<a href="batch_result.php" class="list-group-item ">Batch Wise Result</a>
						<a href="result_statistics.php" class="list-group-item ">Result Statistics</a>
						<a href="view_result.php" class="list-group-item ">View Result</a>
						<a href="print_option.php" class="list-group-item ">Print Result</a>
						<a href="admit.php" class="list-group-item ">Admit Card</a>
					</div>
				</div>
				
				<div class="col-md-7"> <br>
					<div class="loginwrap"> <br>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="well">
									<ul class="list-group">
										<li class="list-group-item list-group-item-success"> <B>New Admin </li><br>
										<li class="list-group-item list-group-item-success"> <B>Name </B>: <?php echo $name; ?> </li><br>
										<li class="list-group-item list-group-item-success"> <B>Status </B>: <?php echo $status; ?> </li>
										<li class="list-group-item list-group-item-success"> <div class="alert alert-success" role="alert">Well done! You have successfully created new admin. </div></li>	
									</ul>
								</div>
							</div> 
						</div> 
					</div> 
				</div>
			
				<div class="col-md-1"></div>
				
			</div><br><br><br><br>
		</div> 
						
				<?php	}
					else echo "Not Done";
				}
						else
						{
							//echo '<script type="text/javascript">';
							echo "You must fill all the fields!";
							//echo '</script>';
						}
			include 'include/footer.php' ;
					
		} 
		
		else
		{
			include'include/admin_header.php';
?>
			<!---------------Container starts----------------------------->
			<div class="container">
				<div class="row">
				
					<div class="col-md-1"></div>
					
					<div class="col-md-3">
						<div class="border1">
							<a href="result_entry.php"  class="list-group-item ">Enter Result</a>
							<a href="result_modify.php" class="list-group-item ">Modify Result</a>
							<a href="result_delete.php"  class="list-group-item ">Delete Result</a>
							<a href="a_routine_entry.php" class="list-group-item ">Enter Routine</a>
							<a href="up_routine.php"   class="list-group-item ">Uplaoded Routine</a>
							<a href="a_notice_entry.php" class="list-group-item ">Enter Notice </a>
							<a href="a_n_action.php" class="list-group-item ">View Notice </a>
							<a href="batch_result.php" class="list-group-item ">Batch Wise Result</a>
							<a href="result_statistics.php" class="list-group-item ">Result Statistics</a>
							<a href="view_result.php" class="list-group-item ">View Result</a>
							<a href="print_option.php" class="list-group-item ">Print Result</a>
						</div>
					</div>
					
					<div class="col-md-7"> <br>
						<div class="loginwrap"> <br>
							<div class="panel panel-default">
								<div class="panel-heading" align="center"><strong>Change Password</strong> </div>
								<div class="panel-body">
									<div class="well">
										 <form enctype="multipart/form-data" action="" method="POST">
						 <div class="form_sep">
							<label>User ID <span style="color:red">*</span></label>
							<input type="text" class="form-control" name="admin_id">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>User Name <span style="color:red">*</span></label>
							<input type="text" class="form-control" name="admin_name">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>Password <span style="color:red">*</span></label>
							<input type="password" class="form-control" name="admin_pass">
						 </div>
						 <br>
						 <div class="form_sep">
							<label>Status <span style="color:red">*</span></label>
							<input type="text" class="form-control" name="status">
						 </div>
						 <br> 
						 
							<input type='submit' value='Make Admin' name='makeAdmin' class="btn btn-primary" id="submit">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary btn-sm" type="reset" value="Reset" name="submit">Reset</button>
					 </form>
									</div>
								</div> 	
							</div> 		
						</div>
					</div>

					<div class="col-md-1"></div>
				
				</div><br><br><br><br>
			</div> 
			<!-------------------Container Ends---------------------->
<?php 
			include 'include/footer.php' ;
		}
	}
	else  header('Location: login.php');
?>	





