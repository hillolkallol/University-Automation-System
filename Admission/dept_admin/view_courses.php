<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();

$id=$_SESSION['user_id'];
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
<?php



for($i=1; $i<=12; $i++)
{

	?>
	
	<?php
	$query="select distinct section,offer_semester,session,year from tbl_course_offer where offer_semester='$i'";
	$result=mysql_query($query);
	while($row=mysql_fetch_array($result)){
	
		$semester=$row['offer_semester'];
		$section=$row['section'];
		$session=$row['session'];
		$year=$row['year'];
		
			
		?>
		<div class="admisssion_area">	
			<div class="container">
				<div class="row">
					<div class="col-md-12"> <!-- Upoor tik ache -->
						<div class="panel panel-default">
							<div class="panel panel-heading">
								<h4 class="panel-title"style="color:steelblue"><b>Semester:</b><?php echo $semester; ?>&nbsp;&nbsp;&nbsp;<b>Section: </b><?php echo $section;?>&nbsp;&nbsp;&nbsp; <b>Session:</b><?php echo $session; ?>&nbsp;&nbsp;&nbsp;<b>Year:</b><?php echo $year; ?></h4>
							</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Teacher Name</th>
											<th style="color:steelblue">Course Title</th>
											<th style="color:steelblue">Course Code</th>
											<th style="color:steelblue">Course Credit</th>
											<th style="color:steelblue">operation</th>
										</tr>
									</thead>
									<?php
									$query1="select * from tbl_course_offer t1 join tbl_course_info t2 join tbl_teacher_info t3 on t1.course_auto_id=t2.course_auto_id and t1.offer_teacher_id=t3.tch_id where offer_semester='$semester' and section='$section'";
									$result1=mysql_query($query1);
									$total_credit=0;
										while($row1=mysql_fetch_array($result1)){
										
											$course_auto_id=$row1['course_auto_id'];
											$teacher_name=$row1['tch_name'];
											$course_code=$row1['course_code'];
											$course_credit=$row1['course_credit'];
											$course_title=$row1['course_name'];
											$offer_auto_id=$row1['offer_auto_id'];
											$total_credit=$total_credit+$course_credit;
											
										
									
									?>
									<tbody>
											<tr>		
												<td style="color:#31B0D5;"><?php echo $teacher_name;?></td>
												<td style="color:#31B0D5;"><?php echo $course_title;?></td>
												<td style="color:#31B0D5;"><?php echo $course_code;?></td>
												<td style="color:#31B0D5;"><?php echo $course_credit;?></td>
												<td><p><a href="delete2.php?id=<?php echo $offer_auto_id;?>"class="btn btn-sm btn-danger delete" onclick="return confirm_delete();"> Delete</a></p></td>
											</tr>
											
									</tbody>	
								
								<?php
									}
									?>
									</table>
									<h3 style="color: steelblue;font-weight:bolder;"><u>Total Credit :</u>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $total_credit;?></h3>								
							</div>
						</div>
					</div>
				</div>	
			</div>
	
	<?php
	}
}
?>		
	
<?php include("footer.php");

?>

<!--For Delete Department By using Jscript-->
<script>
		function confirm_delete() {
			return confirm('are you sure want to delete this data?');
		}
</script>