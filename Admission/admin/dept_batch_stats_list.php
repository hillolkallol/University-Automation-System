<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();
if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}

$query  ="select * from   tbl_student_info where std_batch='$id'";
$result = mysql_query($query);

?>
<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2>Student's List</h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Student's Name</p></th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>Operation</th>
										</tr>
									</thead>
								<?php
									while($row=mysql_fetch_array($result))
									{	
										$std_name = $row['std_name'];
										$std_id = $row['std_id'];
										
										?>
										<tbody>
											<tr>	
												
												<td><a href="view.php?id=<?php echo $std_id; ?>"><?php echo $std_name; ?></a></p></td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td><a href="view.php?id=<?php echo $std_id; ?>" class="btn btn-sm btn-info">&nbsp;&nbsp;View&nbsp;&nbsp; </a></td>
											</tr>		
										</tbody>
										<?php
									}
								?>
								</table>
							</div>							
						</div>
					</div>
				</div>
			</div> 
		</div>
<?php
	include("footer.php");
?>