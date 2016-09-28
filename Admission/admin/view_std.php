<?php include("header.php");
require "db_connection.php";
require "init.php";
include "search_student_php.php";
loggedin();

$query  ="select * from tbl_student_info where std_active = 0 ORDER BY std_auto_id DESC";
$result = mysql_query($query);
?>
		
		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Inactive Student List</h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>&nbsp;Slip No</th>
											<th>Student Name</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>Operation</th>
										</tr>
									</thead>
								<?php
									while($row=mysql_fetch_array($result))
									{	
										$std_name = $row['std_name'];
										$std_auto_id = $row['std_auto_id'];
										?>
										<tbody>
											<tr>
												<td style="color:steelblue;">&nbsp;&nbsp;<?php echo $std_auto_id; ?></td>
												<td><a href="admin_admission.php?id=<?php echo $std_auto_id; ?>"><?php echo $std_name; ?></a></td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td><a onclick="return confirm_delete();" href="delete.php?id=<?php echo $std_auto_id; ?>"class="btn btn-sm btn-info"> Delete</a></td>
											</tr>		
										</tbody>
										<?php
									}
								?>
								</table>
								</br>
								<p style="text-align:center"><a href="view_std.php?id=<?php echo $std_auto_id; ?>"class="btn btn-sm btn-primary"> View All</a></p>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
		
<?php include("footer.php")?> 
