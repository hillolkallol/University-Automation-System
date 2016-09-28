<?php
include("header.php");
require "db_connection.php";
require "init.php";
loggedin();

if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}

$q2="select * from tbl_syllebus_info where syllebus_name='$id'";
$r2=mysql_query($q2);
while($rowq=mysql_fetch_array($r2))
{	
			$batch=$rowq['batch'];
			$syllebus_name=$rowq['syllebus_name'];
			$course_auto_id=$rowq['course_auto_id'];
}

$q="select * from tbl_syllebus_info where syllebus_name='$syllebus_name' and course_auto_id='$course_auto_id'";
$r=mysql_query($q);

?>

		<div class="profile_area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="student_menu">
								<ul>
									<li><a class="menu_top" href="syllebus.php">Syllebus</a></li>
									<li><a class="menu_top" href="course_offer.php">Course Offer</a></li>
									<li><a class="menu_top" href="subject.php">Statistics</a></li>
									<li><a class="menu_top" href="change_pass.php">Change Password</a></li>
									<li><a class="menu_top" href="new_admin.php">Make New Admin</a></li>
									<li><a href="logout.php">Logout</a></li>		
								</ul>
						    </div>
					     </div>					
				    </div>
			    </div>
		    </div><!--End Of Profile Area-->
		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">All Courses For Batch <?php echo $batch; ?></h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Course Code</th>
											<th style="color:steelblue">Course Title</th>
											<th style="color:steelblue">Credit &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
											<th style="color:steelblue">Semester</th>
										</tr>
									</thead>
						<?php
							while($row=mysql_fetch_array($r))
							{	
										$course_auto_id=$row['course_auto_id'];
										
										$syllebus_name=$row['syllebus_name'];
										//echo $batch;


							$query10="select * from tbl_syllebus_info t1 join tbl_course_info t2 on t1.course_auto_id=t2.course_auto_id  where syllebus_name='$syllebus_name'";
							$result10=mysql_query($query10);

								while($row10 = mysql_fetch_array($result10))
								{																	
			
										$course_title=$row10['course_name'];
										$course_code=$row10['course_code'];
										$course_credit=$row10['course_credit'];
										$batch=$row['batch'];
										$course_auto_id=$row10['course_auto_id'];
										$semester=$row10['semester'];
									
										
								?>
									<tbody>
										<tr>
											<td><P style="color:#31B0D5;float:left;font-family:sans-serif"><?php echo $course_code; ?></p></td>
											<td><p style="float:left;color:#31B0D5"><?php echo $course_title; ?></p></td>
											<td><p style="float:left;color:#31B0D5"><?php echo $course_credit; ?></p></td>
											<td><p style="float:left;color:#31B0D5"><?php echo $semester; ?></p></td>
											
											
											
										</tr>
										
									</tbody>
													
							<?php
								}
								}
									
									
							?>
								</table>
								</br>
								</br>
								<div class="form_group">
										<a href="add_new_syllebus.php?id=<?php echo $id; ?>"><button type="button" style="margin-left:250px;" class="btn btn-primary">Add New Course</button></a>
								</div>
								</br>
							</div>		
						</div>
					</div>
				</div>
			</div>
		</div> 
<?php include("footer.php");?>
<!--For Delete Department By using Jscript-->
<script>
		function confirm_delete() {
			return confirm('are you sure want to delete this data?');
		}
</script>
