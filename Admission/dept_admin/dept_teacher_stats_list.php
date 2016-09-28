<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();
$id=$_SESSION['user_id'];

$query  ="select * from tbl_teacher_info where tch_dept ='$id'";
$result = mysql_query($query);
?>
<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue" >Teacher's List</h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Teacher's Name</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th style="color:steelblue">Operation</th>
										</tr>
									</thead>
								<?php
									while($row=mysql_fetch_array($result))
									{	
										$tch_pic = $row['tch_pic'];
										$tch_name = $row['tch_name'];
										$tch_id = $row['tch_id'];
										?>
										<tbody>
											<tr>	
												
												<td><a href="view_teacher.php?id=<?php echo $tch_id; ?>"><?php echo $tch_name; ?></a></p></td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td>&nbsp;&nbsp;&nbsp;</td>
												<td><a href="view_teacher.php?id=<?php echo $tch_id; ?>" class="btn btn-sm btn-info">&nbsp;&nbsp;View&nbsp;&nbsp; </a></td>
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