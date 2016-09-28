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
		
		if(isset($_POST['name']) && isset($_POST['status']))
		{
			include'include/admin_header.php';
			$name = mysql_real_escape_string($_POST['name']);
			$status = mysql_real_escape_string($_POST['status']);
			//$dept= $_POST['dept'];
			//$batch= $_POST['batch'];
			$sen=$_SESSION['userida'];
			$printtype="update admin_info_exam set admin_name = '$name',admin_status = '$status' where admin_id= '$sen'";
			mysql_query($printtype) or die(mysql_error());
?>			


			<!--------------------------------------->
			<?php //Finding User Info
					$name=null;	$status=null;
					$info = mysql_query("SELECT * FROM admin_info_exam");
					while($row = mysql_fetch_array($info))
					{
						if($_SESSION["userida"]==$row['admin_id'])
						{	
							$_SESSION["usernamea"]=$row['admin_name'];
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
					</div>
				</div>
				
				<div class="col-md-7"> <br><br><br><br>
					<div class="loginwrap"> <br>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="well">
									<ul class="list-group">
										<li class="list-group-item list-group-item-success"> <B>Name </B>: <?php echo $name; ?> </li><br>
										<li class="list-group-item list-group-item-success"> <B>Status </B>: <?php echo $status; ?> </li>
									</ul>
								</div>
							</div> 
						</div> 
					</div> 
				</div>
			
				<div class="col-md-1"></div>
				
			</div><br><br><br><br>
		</div> 
<?php 
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
							<a href="admit.php" class="list-group-item ">Admit Card</a>
						</div>
					</div>
					
					<div class="col-md-7"> <br>
						<div class="loginwrap"> <br>
							<div class="panel panel-default">
								<div class="panel-heading" align="center"><strong>Edit Profile</strong> </div>
								<div class="panel-body">
									<div class="well">
										<form enctype="multipart/form-data" action=" " method="post">
									
											<!-------------Live search---------------->
											<div class="form_sep">
												<label for="nam">Name <span style="color:red">*</span></label>
												<input type="text" id='nam' name='name' class="form-control input" placeholder="Your Name">
											</div>
											<br>	
											
											<div class="form_sep">
												<label for="statu">Status<span style="color:red">*</span></label>
												<input type="text" id='statu' name='status' class="form-control input" placeholder="Your Status">
											</div>
											<br>
								
											<button class="btn btn-default" type="reset" value="Reset" name="submit">Reset</button>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<button class="btn btn-default" type="submit" value="Submit" name="submit">Submit</button>
											
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



