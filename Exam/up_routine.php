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
		$user_id=$_SESSION["userida"];
		$user_name=$_SESSION["usernamea"];
		$found=0;
		$i=1;
		// retrieve all file form db
		$query = mysql_query("SELECT * FROM routine Order by id DESC");


?>		<!---------------Container Starts---------------->
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
							<div class="notice_border">
								<div class="panel-body">
									<div class="panel panel-info"> 
										<div class="panel-heading" align="center"><strong class="n_name">Routines</strong>
										</div>
										<div class="panel_border">
											<div class="panel-body">
												<div class="table-responsive">
													
													<table  id="delTable"  class="table table-bordered" >
														<thead>
															<tr>
																<th>Number</th>
																<th>File</th>
																<th>Department</th>
																<th>Delete</th>
															</tr>
														</thead>
														<tbody>
															
															<?php
														
																while($row = mysql_fetch_array($query))
																{
																	$name=$row['name']; 
																	$dept=$row['dept']; 
																	$id=$row['id']; ?>
																		<tr id="<?php echo $id;?>" >
																			<td><?php echo $i;?></td>
																			<td> <a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $name; ?> </a> </td>
																			<td><?php echo $dept;?></td>
																			<td><a href="remove.php?id=<?php echo $row['id']; ?>"  class="btn btn-danger btn-xs" role="button">Remove</a></td>	
																		</tr>
																		<?php
																	$i++;
																}
															?> 
														</tbody>
													</table>
												</div>
											</div>
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
		<!--------------Container Ends--------------->
		
<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: login.php');
?>
