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
		//echo $user_id;
		$notice_t = "SELECT * FROM notice_info where user_name='".mysql_real_escape_string($user_name)."' order by id desc";
		$n_query=mysql_query($notice_t);
?>		<!---------------Container starts----------------------------->
		<div class="container">
			<div class="row">
				
				<div class="col-md-1"></div>
				
				<div class="col-md-3">
					<div class="border1">
						<a href="result_entry.php"  class="list-group-item ">Enter Result</a>
						<a href="result_modify.php" class="list-group-item ">Modify Result</a>
						<a href="result_delete.php"  class="list-group-item ">Delete Result</a>
						<a href="a_routine_entry.php" class="list-group-item ">Enter Routine</a>
						<a href="up_routine.php"   class="list-group-item ">Uploaded Routine</a>
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
							<div class="notice_border">
								<div class="panel-body">
									<div class="panel panel-info"> 
										<div class="panel-heading" align="center"><strong class="n_name">Notices of <?php echo $user_name; ?></strong></div>
										<div class="panel-body">
											<div class="table-responsive">
												<table  id="delTable"  class="table table-bordered" >
													<thead>
														<tr>
															<th>Notice</th>
															<th>Date</th>
															<th>Edit</th>
															<th>Delete</th>
														</tr>
													</thead>
													<tbody>
														<?php
															while($row1=mysql_fetch_array($n_query))
															{
																$n_text=$row1['text']; 
																$n_date=$row1['date']; 
																$id=$row1['id']; ?>
																<tr id="<?php echo $id;?>">
																	<td><?php echo $n_text;?></td>
																	<td><?php echo $n_date;?></td>
																	<td><a class="btn btn-small btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="<?php echo $row1['id']; ?>">Edit</a></td>	
																	<td><button type="button" class="btn btn-primary">Delete</button></td>
																</tr>
																<?php
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

				<div class="col-md-1"></div>
				
				<!------------- Modal-------------------- -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="memberModalLabel">Edit Notice</h4>
							</div>
							<div class="at">
						  
							</div>

						</div>
					</div>
				</div>
				<!----------modal end------------->

			</div><br><br><br>
		</div>
		
		<!------ jQuery Version 1.11.0 -------->
		<script src="js/jquery-latest.min.js"></script>
		
	
		<!---------java script-------->
		<script >
			$('#exampleModal').on('show.bs.modal', function (event) 
			{
				var button = $(event.relatedTarget) // Button that triggered the modal
				var recipient = button.data('whatever') // Extract info from data-* attributes
				var modal = $(this);
				var dataString = 'id=' + recipient;

				$.ajax
				({
					type: "GET",
					url: "a_editdata.php",
					data: dataString,
					cache: false,
					success: function (data) 
					{
						console.log(data);
						modal.find('.at').html(data);
					},
					error: function(err) 
					{
						console.log(err);
					}
				});  
			});
			jQuery(document).ready(function() 
			{  
      
				$('table#delTable td button.btn').click(function()
				{
					if(confirm("Are you sure you want to delete this row?"))
					{
						var id = $(this).parent().parent().attr('id');
						var data = 'id=' + id ;
						var parent = $(this).parent().parent();

						$.ajax(
						{
							type: "GET",
							url: "a_delete.php?id="+id+"&data"+data,
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

<?php 
		include 'include/footer.php' ;
	}
	else  header('Location: login.php');
?>
