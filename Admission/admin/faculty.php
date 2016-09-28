<?php 
include("header.php");
require "db_connection.php";
require "init.php";
include "add_new_faculty_php.php";
loggedin();
$query  ="select distinct dept_name,dept_id from tbl_department_info";
$result = mysql_query($query);

$q="select distinct dept_name from tbl_department_info";
$r=mysql_query($q);

$query1  ="select distinct dept_name,dept_id,dept_short_name from tbl_department_info ";
$result1 = mysql_query($query1);
?>
		
		<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">View Department List</h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Department Name</th>
											<th style="color:steelblue">Department ID</th>
											<th>&nbsp;&nbsp;&nbsp;</th>
											<th style="color:steelblue">Operation</th>
										</tr>
									</thead>
							<?php
							while($row=mysql_fetch_array($result))
							{	
								$faculty_name = $row['dept_name'];
								$faculty_id = $row['dept_id'];
								?>
									<tbody>
										<tr>	
											<td><P style="color:#31B0D5;float:left"><?php echo $faculty_name; ?></p></a></td>
											<td style="text-align:center;color:#31B0D5">0<?php echo $faculty_id; ?></td>
											<td>&nbsp;&nbsp;&nbsp;</td>
											<td><a href="update_department.php?id=<?php echo $faculty_id; ?>" class="btn btn-sm btn-info">&nbsp;&nbsp;View&nbsp;&nbsp; </a>&nbsp;&nbsp;<a href="delete_department_php.php?id=<?php echo $faculty_id; ?>"class="btn btn-sm btn-danger delete" onclick="return confirm_delete();">Delete</a></td>
										</tr>	
									</tbody>
								<?php
							}
							?>
								</table>
							</div>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Add New Department</h2>
								</div>
								<div class="panel-body">
									<form action="" method="POST" id="admission_form" name="admission" enctype="multipart/form-data">	
										<div class="form_group">
											<label for="student_name" class="label_admit">Name of the Department</label>
											<input id="std_name" name="txt_std_name" class="form-control edit_form"type="text" placeholder="Computer Science & Engineering"/>
											<div class="error" id="first_error">Department Name Must be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_id" class="label_admit">Department ID</label>
											<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder="01"/>
											<div class="error" id="second_error">Department ID Must be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_id" class="label_admit">Short Name</label>
											<input id="std_short" name="txt_std_short" class="form-control edit_form"type="text" placeholder="CSE"/>
											<div class="error" id="third_error">Short Name Must be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_id" class="label_admit">Program Name</label>
											<input id="std_program" name="txt_std_program" class="form-control edit_form"type="text" placeholder="CSE"/>
											<div class="error" id="fourth_error">Program Name Must be filled out!</div>
										</div>
										<div class="form_group">
											<input type="submit" value="Save" id="add_submit" name="add_std_submit" class="btn btn-info change_submit"/>
										</div>
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>
							</div>
							<div class="panel panel-warning">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Add New Program</h2>
								</div>
								<div class="panel-body">
									<form action="" name="search" method="POST" id="search">
										<div class="form_group">
											<label for="student_id" class="label_admit">Program Name</label>
											<input id="std_id" name="txt_std_id" class="form-control edit_form"type="text" placeholder=""/>
											<div class="error" id="first_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_dept" class="label_admit">Department</label>
												<select id="std_dept" name="txt_std_dept" class="form-control edit_form">
												<option selected="selected" value="">Select Department</option>
												<?php
												while($row=mysql_fetch_array($result1))
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
											<input type="submit" value="Save" id="submit" name="addd_std_submit" class="btn btn-info change_submit"/>
										</div>	
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>	
							</div>
					</div>
				</div>
			</div>
		</div> 
	</div>
<?php include("footer.php")?> 		

<!--For Delete Department By using Jscript-->
<script>
		function confirm_delete() {
			return confirm('are you sure want to delete this data?');
		}
</script>
<!--Jquery using for admission-->
		<script>
		$("#admission_form").submit(function(){
		
		// Assume there are no error on the form
		var errors = false;
		
		// hide all the error messages
		$(".error").hide();
		
		// Check each field to make sure they're not blank
		if($("#std_name").val() == ""){
			$("#first_error").show("slow");
			errors = true;
		}

		if($("#std_id").val() == ""){
			$("#second_error").show("slow");
			errors = true;
		}
		if($("#std_short").val() == ""){
			$("#third_error").show("slow");
			errors = true;
		}
		if($("#std_program").val() == ""){
			$("#fourth_error").show("slow");
			errors = true;
		}
		if(errors){
			$("#warning").show("slow").fadeOut(5000);
			return false;
		}
	
	});
	</script>
