<?php
	require 'config.php';
	ob_start();
	session_start();
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
		
		//Finding User Info
		$name=null;	$status=null;
		$info = mysql_query("SELECT * FROM tbl_teacher_info");
		while($row = mysql_fetch_array($info))
		{
			if($_SESSION["teacher_id"]==$row['tch_id'])
			{	
				$_SESSION["usernamet"]=$row['tch_name'];
				$name=$row['tch_name'];
				$status=$row['tch_position'];
				break;
			}
			else continue;
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
				
				<div class="col-md-7"> <br><br>
					<div class="loginwrap"> <br>
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="well">
									<ul class="list-group">
										<li class="list-group-item list-group-item-success"> <B>Name </B>: <?php echo $name; ?> </li><br>
										<li class="list-group-item list-group-item-success"> <B>Designation </B>: <?php echo $status; ?> </li>
									</ul>
								</div>
							</div> 
						</div> 
					</div> 
				</div>
				
				<div class="col-md-1"></div>
				
			</div><br><br><br><br><br><br>
		</div> 
		<!---------------------Container Ends---------------------------->	
		
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: ../teacher.php');
?>

