<?php include("header.php");
require "db_connection.php";
require "init.php";
include "search_student_php.php";
loggedin();

$query  ="select * from tbl_student_info where std_active = 0 ORDER BY std_auto_id DESC limit 10";
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
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">View Student</h2>
								</div>
								<div class="panel-body">
									<form action="" name="search" method="POST" id="search">
										<div class="form_group">
											<label for="student_id" class="label_admit">Student ID</label>
											<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder="Student ID"/>
											<div class="error" id="first_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_dept" class="label_admit">Department</label>
												<select id="std_dept" name="txt_std_dept" class="form-control edit_form">
												<option selected="selected" value="">Select Department</option>
												<?php
												while($row=mysql_fetch_array($r))
												{	
													$dept_name=$row['dept_name'];
													$dept_id=$row['dept_id'];
													$dept_short_name=$row['dept_short_name'];
												?>
													<option value="<?php echo $dept_id; ?>"><?php echo $dept_name; ?></option>
									
										<?php
												}
										?>
												</select>
												<div class="error" id="second_error">Student Department Name must be filled out!</div>
										</div>
										<div class="form_group">
											<input type="submit" value="Search" id="submit" name="add_std_submit" class="btn btn-primary change_submit"/>
										</div>	
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>		
							</div>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;"><a href="admission.php">Add New Student</a></h2>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
		</div>
		
<?php include("footer.php")?> 

<!--For Delete Inactive student By using Jscript-->
<script>
		function confirm_delete() {
			return confirm('are you sure want to delete this data?');
		}
</script>
<!--Jquery using for admission-->
		<script>
		$("#search").submit(function(){
		
		// Assume there are no error on the form
		var errors = false;
		
		// hide all the error messages
		$(".error").hide();
		
		// Check each field to make sure they're not blank
		if($("#std_id").val() == ""){
			$("#first_error").show("slow");
			errors = true;
		}

		if($("#std_dept").val() == ""){
			$("#second_error").show("slow");
			errors = true;
		}
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
	
	});
	</script>