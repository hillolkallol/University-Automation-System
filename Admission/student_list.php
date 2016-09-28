<?php 
include("header1.php");
require "db_connection.php";
require "init.php";
loggedin();
$id=$_SESSION['teacher_id'];

$query2 = "Select * From tbl_teacher_info Where tch_id='$id'";
$result2= mysql_query($query2);
while($row = mysql_fetch_array($result2))
{	
		$imgpath=$row['tch_pic'];
		$name=$row['tch_name'];
}
$query="select * from tbl_teacher_info t1 join tbl_course_info t2 join tbl_course_offer t3 on t1.tch_id=t3.offer_teacher_id and t2.course_auto_id=t3.course_auto_id where offer_teacher_id='$id'";
$result=mysql_query($query);
$row=mysql_fetch_array($result);
$section=$row['section'];
if(isset($_REQUEST['id']))
{
	$id=$_REQUEST['id'];
}
echo $id;

$chadni="select std_name,std_email,std_id,std_section from tbl_student_info where std_semester='$id' and std_section='$section'";
$zainab=mysql_query($chadni);
?>
   <div class="profile_area">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="student_image">
							<h4><?php echo $name; ?></h4>
							<img src="img/<?php echo $imgpath; ?>" alt="profile pic"/>
						</div>
					</div>
					<div class="col-md-10">
						<h4 class="welcome" style="color:steelblue">Welcome! <?php echo $name; ?></h4>
						<div class="teacher_menu">
							<ul>
								<li><a href="personal_info_teacher.php">Personal Info</a></li>
								<li><a href="teacher_courses.php">Courses</a></li>
								<li><a href="change_pass_1.php">Change Passsword</a></li>
								<li><a href="logout_teacher.php">Logout</a></li>
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div>
		
		<!--End Of Profile Area--> 
		<div class="view_course_area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default">
								<div class="panel-heading">
								<h2 style="color:steelblue">Student List</h2>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th style="color:steelblue">Student ID</th>
												<th style="color:steelblue">Student Name</th>
												<th style="color:steelblue">Email</th>
											</tr>
										</thead>
										<tbody>
										<?php
											
											while($rimon = mysql_fetch_array($zainab))
											{																	
												$std_name=$rimon['std_name'];
												$std_id=$rimon['std_id'];
												$std_email=$rimon['std_email'];
												
										

										?>
											<tr>
												<td style="color:#31B0D5"><?php echo $std_id; ?></td>
												<td style="color:#31B0D5"><?php echo $std_name; ?></td>
												<td style="color:#31B0D5"><?php echo $std_email; ?></td>
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
		</div>
<?php include("footer.php")?> 
