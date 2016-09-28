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
		include'include/admin_header.php';

		$max_upload_size = 1024*1024*2; // max file size
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{	
			
			$path = 'include/uploads/' . uniqid() . '.';
			$path .= pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
					
			$name = $_FILES['file']['name'];
			$file_type= $_FILES['file']['type'];
			$dept=$_POST['dept'];
			
			// only PDF accepted.
			if(($file_type!=="application/pdf") ) 
			{
				$message = 'File must have to be pdf!';
			}
			
			else if (($file_type=="application/pdf"))
			{	
				if ($_FILES['file']['size'] < $max_upload_size) 
				{
					
					// generate upload path with unique file name
					// move uploaded file to upload directory
					if ( move_uploaded_file($_FILES['file']['tmp_name'], $path) )
					{
						// insert new file to mysql db
						mysql_query("INSERT INTO routine (name,path,dept)
									VALUES('".mysql_real_escape_string($name)."','".mysql_real_escape_string($path)."','".mysql_real_escape_string($dept)."')");
						
						// set success message
						$message = 'File Uploaded!';

					} 
					
					else 
					{
						$message = 'Upload fail';
					}
				} 
				
				else 
				{
					$message = 'File is too large';
				}
			}  
			
			else 
			{
				$message = 'file must have to be  pdf';
			}
							
		}

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
				
				<div class="col-md-7"><br>
					<div class="loginwrap"> 
						<div class="panel panel-default">
							<div class="panel-heading" align="center"><B style="color:black; font-size:16px;">Enter Routines </B> </div>
							<div class="panel-body">
								
								<!--messages-->
								<?php if(isset($message)): ?>
									<div class="alert alert-info">
										<strong><?php echo $message; ?></strong>
									</div>
								<?php endif ?>
								
								<div class="alert alert-info">
									<div class="form-inline">
										<div class="control-group">
											<form action="" method="post" enctype="multipart/form-data">				
												<label><i class="fa fa-file-text booking_font"></i>&nbsp;Enter Routine Here</label>
												<div class="form-group">
													<input type="file" name="file" accept="application/pdf" required>
												</div>
												<br><br>
												
												<label for="dept"> Select Department: </label> <br>
												<input name="dept" type="radio" value="ARCHI" required> ARCHITECTURE <br>
												<input name="dept" type="radio" value="BBA" required> BBA <br>
												<input name="dept" type="radio" value="CIVIL" required> CIVIL ENG<br>
												<input name="dept" type="radio" value="CSE" required> CSE <br>
												<input name="dept" type="radio" value="EEE" required> EEE<br>
												<input name="dept" type="radio" value="ENG" required> ENG<br>
												<input name="dept" type="radio" value="LAW" required> LAW <br>
												<input name="dept" type="radio" value="MBA" required> MBA <br><br>
												<button class="btn btn-primary" type="reset" name="Reset"  value="Reset" >Reset</button>
												
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												<button class="btn btn-primary" type="submit" name="upload"  value="Upload" >Upload</button>
												<br>
											</form>
										</div>
									</div>
								</div>
							</div>		
						</div>
					</div>
				</div>
				
				<div class="col-md-1"></div>
					
			</div><br><br><br><br>
		</div>
		<!---------------------Container Ends---------------------------->	

<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: login.php');
?>
