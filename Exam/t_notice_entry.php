<?php
session_start();
ob_start();	
require 'config.php';
	function loggedin()
	{
		if(isset($_SESSION['teacher_id']) && !empty($_SESSION['teacher_id']))
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
		include'include/teacher_header.php';

		$user1=$_SESSION["teacher_id"];
		$user=$_SESSION["usernamet"];
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$text1= $_POST['text'];
			$dept1= $_POST['dept'];
			//$user1=$_POST['user_id'];
			//echo $_session['user_id'];
			$found=0;
			if(!empty($text1) && !empty($dept1) && !empty($user1)){
				$query_t=mysql_query("SELECT * FROM tbl_teacher_info WHERE tch_id='".mysql_real_escape_string($user1)."'");
				if(mysql_num_rows($query_t)==1){
				$found=1;
				while($row=mysql_fetch_array($query_t)){
					
					$date=date("Y-m-d H:i:s");
					//$_SESSION['useridt']=$row['t_id'];
					//$_SESSION['usernamet']=$row['teacher_name'];
				
					}
					if($found=1){
					$query="INSERT INTO notice_info(user_name,text,dept,date) VALUES ('".mysql_real_escape_string($user)."','".mysql_real_escape_string($text1)."','".mysql_real_escape_string($dept1)."','".mysql_real_escape_string($date)."')";
					$query_run=mysql_query($query);
					header('Location: t_n_action.php');
				
					}
					
				}
				else {
				
					echo '<script type="text/javascript">';
					echo 'alert("No User Found!")';
					echo '</script>';
				}
				
			}
			else {
				echo '<script type="text/javascript">';
				echo 'alert("Plaese Fill all Fields!")';
				echo '</script>';
				
			}
				

		}

?>
		<!---------------Container starts----------------------------->
		<div class="container">
			<div class="row">
				
				<div class="col-md-1"></div>
				
				<div class="col-md-3">
					<div class="border1">
						<a href="result_entry_t.php" class="list-group-item ">Enter Result</a>
						<a href="t_notice_entry.php" class="list-group-item ">Enter Notice </a>
						<a href="t_n_action.php" class="list-group-item ">View Notice </a>
						<a href="batch_result_t.php" class="list-group-item ">Batch Wise Result</a>
						<a href="result_statistics_t.php" class="list-group-item ">Result Statistics</a>
						<a href="view_result_t.php" class="list-group-item ">View Result</a>
					</div>
				</div>
				
				<div class="col-md-7"> <br>
					<div class="loginwrap"> <br>
						<div class="panel panel-default">
							<div class="panel-heading" align="center"><strong class="n_name">Enter Notice</strong> </div>
							<div class="panel-body">
								<form action="" method="post" enctype="multipart/form-data">
									
									<label><i class="fa fa-file-text booking_font"></i>&nbsp;Type Notice Here<span class="req">*</span></label>
									<textarea class="form-control" id="message" name="text" rows="8" cols="8"></textarea>
									<br>
				
									<!--dropdown menu-->
									<div class="form_sep">
										<label class="req" for="reg_input_name">Select Department<span style="color:red">*</span></label>
										<select class="selectpicker" name="dept" data-live-search="true"  title="Select department">
											<option> All </option>
											<option> ARCHI </option>
											<option> BBA </option> 
											<option> CIVIL </option>
											<option> CSE </option>
											<option> EEE </option>
											<option > ENG </option>
											<option> LAW </option>	
										</select>
									</div>
									<br>
									
									<button class="btn btn-primary" type="submit" value="submit" name="submit">Submit</button>
									<br>
									
								</form>
								
							</div>		
						</div>
					</div>
				</div>
				
				<div class="col-md-1"> </div>

			</div><br><br>
		</div>
		<!-----------Container Ends--------------------->
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: ../teacher.php');
?>	
