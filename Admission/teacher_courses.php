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
		$id=$row['tch_id'];
}

$query="select * from tbl_teacher_info t1 join tbl_course_info t2 join tbl_course_offer t3 on t1.tch_id=t3.offer_teacher_id and t2.course_auto_id=t3.course_auto_id where offer_teacher_id='$id'";
$result=mysql_query($query);
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
		
		<div class="view_course_area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="teacher_courses">
							<div class="panel panel-default">
								<div class="panel-heading">
								<h2 style="color:steelblue">All Courses You Have Been Offered This Semester</h2>
								</div>
								<div class="panel-body">
									<table class="table table-hover">
										<thead>
											<tr>
												<th style="color:steelblue">Course Code</th>
												<th style="color:steelblue">Course Title</th>
												<th style="color:steelblue">Course Credit</th>
												<th style="color:steelblue">Semester</th>
												<th style="color:steelblue">Section</th>
											</tr>
										</thead>
										<tbody>
										<?php
								
										while($row1 = mysql_fetch_array($result))
										{																	
											
											$course_title=$row1['course_name'];
											$course_code=$row1['course_code'];
											$course_credit=$row1['course_credit'];
											$semester=$row1['offer_semester'];
											$section=$row1['section'];
										

										?>
											<tr>
												<td style="color:#31B0D5"><?php echo $course_code; ?></td>
												<td><a href="student_list.php?id=<?php echo $semester;?>" style="color:#31B0D5"><?php echo $course_title; ?></a></td>
												<td style="color:#31B0D5;text-align:center"><?php echo $course_credit; ?></td>
												<td style="color:#31B0D5;text-align:center"><?php echo $semester; ?></td>
												<td style="color:#31B0D5;text-align:center"><?php echo $section; ?></td>
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
		</div><!--End Of view Course Area-->
		


