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
		$id= $_POST['id'];
			$course= $_POST['course'];
			$sem= $_POST['semester'];
			$year= $_POST['year'];
							
			$_SESSION['id']=$id;
			$_SESSION['course']=$course;
			$_SESSION['seme']=$sem;
			$_SESSION['year']=$year;
				
			$result= mysql_query("SELECT * FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."'");
			$rows = mysql_num_rows($result);
			if($rows==0)
			{
				?>	
				<!-------------------------------------->
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
								<a href="student_option.php" class="list-group-item ">View Result</a>
								<a href="print_option.php" class="list-group-item ">Print Result</a>
								<a href="admit.php" class="list-group-item ">Admit Card</a>
							</div>
						</div>
						
						<div class="col-md-7"> <br>
							<div class="loginwrap">
								<div class="panel panel-default">
									<div class="alert alert-warning alert-dismissible" role="alert">
										<strong> No result found! </strong> 
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-1"></div>
						
					
					</div><br><br>
				</div>
				<!--------------------------------------><?php 
			}
			
			else 
			{ ?>	
				<!-------------------------------------->
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
								<a href="student_option.php" class="list-group-item ">View Result</a>
								<a href="print_option.php" class="list-group-item ">Print Result</a>
								<a href="admit.php" class="list-group-item ">Admit Card</a>
							</div>
						</div>
						
						<div class="col-md-7"> <br>
							<div class="loginwrap">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h2 class="panel-title">&nbsp;<b>Delete Result </b></h2>
									</div>
									<div class="panel-body">
										<div class="well">
											<form action="delete.php" method="POST" enctype="multipart/form-data">
												<table id="users" class="table table-bordered table-condensed">
													<tr><th>Serial</th><th>ID</th><th>Course Code</th><th>Semester</th><th>Grade</th></tr>
													<?php
													$i=1;
													while($row= mysql_fetch_assoc($result))
													{
														$id= $row['s_id'];
														?>
														<tr>
															<td><?php echo $i; ?></td>
															<td><?php echo $id; ?></td>
															<td><?php echo $course; ?></td>
															<td><?php echo $sem; echo " - "; echo $year; ?></td>
															<td><?php  echo $row['grade']; ?></td>
														</tr>	<?php $i++;  
													} ?>
				
												</table>  
												<button type="button" class="btn btn-primary">Delete</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-1"></div>
						
		
					</div>
				</div>
				
				<?php 
			} 
		?>
		
		<!-------------------Container Ends---------------------->
<?php 
		include 'include/footer.php' ;

	}
	else  header('Location: login.php');
?>	
<script>
		jQuery(document).ready(function() 
			{  
      
				$('button.btn').click(function()
				{
					if(confirm("Are you sure you want to delete this row?"))
					{
						var id = $(this).parent().parent().attr('id');
						var data = 'id=' + id ;
						var parent = $(this).parent().parent();

						$.ajax(
						{
							type: "POST",
							url: "delete.php?id="+id+"&data"+data,
							data: data,
							cache: false,
					
							success: function()
							{
							parent.fadeOut('slow', function() {$(this).remove();});
							}
						});				
					}
				});
			});
</script>
