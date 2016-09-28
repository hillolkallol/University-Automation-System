<?php include("header1.php");
include("db_connection.php");
require "init.php";
loggedin();
$id=$_SESSION['user_id'];

$query2 = "Select * From tbl_student_info Where std_id='$id'";
$result2= mysql_query($query2);
while($row = mysql_fetch_array($result2))
{	
		$imgpath=$row['std_pic'];
		$name=$row['std_name'];
		$std_id=$row['std_id'];
		$std_dept=$row['std_dept'];
}
echo '<input type="hidden" class="std_id" value="'.$std_id.'" />';
echo '<input type="hidden" class="std_name" value="'.$name.'" />';
echo '<input type="hidden" class="std_dept" value="'.$std_dept.'" />';
?>
		<div class="profile_area">
			<div class="container">
				<div class="row">
					<div class="col-md-2">
						<div class="student_image">
							<h4 style="color:steelblue;text-align:left"><?php echo $name; ?></h4>
							<img src="img/<?php echo $imgpath; ?>" alt="profile pic"/>
						</div>
					</div>
					<div class="col-md-10">
						<h4 class="welcome" style="color:steelblue">Welcome! <?php echo $name; ?></h4>
						<div class="student_menu">
							<ul>
								<li><a href="personal.php">Personal Info</a></li>
								<li><a href="registration.php">Registration</a></li>
								<li><a href="course.php">Courses</a></li>
								<li><a href="change_pass.php">Change Password</a></li>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>
					</div>					
				</div>
			</div>
		</div>
		
		<div class="courses_area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Your Registration Status</h2>
								</div>
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="color:steelblue; text-align:center;">Semester</th>
									<th style="color:steelblue;">Status</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<select id="std_cours_stats" style="color:steelblue; text-align:center; width:300px;margin-left:250px;"name="txt_std_course_stats" class="form-control">
										<option selected="selected" value="">Select Semester</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
										</select>
									</td>
									
									<td style="color:steelblue;"id="status"">
										
									</td>
								</tr>
							</tbody>
							
						</table>
							</div>
					</div>
				</div>
			</div><br/>
		</div><!--End Of Course_area-->
		<div class="view_course_area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h2 style="color:steelblue;">All Courses You Have  registered This Semester</h2>
							</div>
							<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue;">Course Code</th>
											<th style="color:steelblue;">Course Title</th>
											<th style="color:steelblue;">Course Credit</th>
										</tr>
									</thead>
									<tbody id='showh2'>
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
 <?php include("footer.php")?> 
<script>
	$(document).ready(function(){
    
	var show_courses1 = 'status';
	var select_id = 'std_cours_stats';

	$('#'+select_id).change(function() 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses1).html('Loading...');
		 $.ajax({url: 'success_status.php?abds='+selectvalue,
             success: function(output) {
                //alert("Hello");
                $('#'+show_courses1).html(output);
                
                
            }});
		
	});
   
});

</script> 
 
<script>
	$(document).ready(function(){
    
	var show_courses = 'showh2';
	var select_id = 'std_cours_stats';

	$('#'+select_id).change(function() 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({url: 'ajax_change_course_student.php?abds='+selectvalue,
             success: function(output) {
                //alert("Hello");
                $('#'+show_courses).html(output);
                
                
            }});
		
	});
   
});

</script> 
