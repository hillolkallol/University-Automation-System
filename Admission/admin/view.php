<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();
if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}


$query="select * from tbl_student_info where std_id='$id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{	
		$imgpath=$row['std_pic'];
		$dept=$row['std_dept'];
		$prog=$row['std_program'];
		$name=$row['std_name'];
		$fname=$row['std_father_name'];
		$mname=$row['std_mother_name'];
		$gname=$row['std_guardian_name'];
		$per_add=$row['std_permanent_address'];
		$pre_add=$row['std_present_address'];
		$std_cntc_no=$row['std_contact_no'];
		$std_gcntc_no=$row['std_guardian_contact_no'];
		$std_bdate=$row['std_birth_date'];
		$gender=$row['std_gender'];
		$std_nation=$row['std_nationality'];
		$std_ssc_rslt=$row['std_ssc_result'];
		$std_hsc_rslt=$row['std_hsc_result'];
		$std_email=$row['std_email'];
		$std_total_gpa=$row['std_total_result'];
		$std_active=$row['std_active'];
		$std_id = $row['std_id'];
		$batch =$row['std_batch'];
		$std_auto_id = $row['std_auto_id'];
		$std_waiver = $row['std_waiver'];
		$std_semester = $row['std_semester'];
		
}

//For seleecting program value and name
$xyz="select * from tbl_student_info t1 join tbl_department_info t2 on t1.std_dept=t2.dept_id and t1.std_program=t2.dept_program_name where std_id='$std_id'";
$mno=mysql_query($xyz);
while($muhib = mysql_fetch_array($mno))
{
	$dept_name=$muhib['dept_name'];
	$program_program_name=$muhib['dept_program_name'];
}	


?>
<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default" id="printdiv">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Student Information</h2>
								</div>
								<table class="table table-hover table-bordered" >
										<tbody>
											<tr style="color:steelblue">	
												<th>Student Image</th>
												<td><img src="<?php echo $imgpath; ?>" alt="profile pic"/></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Student ID</th>
												<td><?php echo $std_id; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Student Name</th>
												<td><?php echo $name; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Department Name</th>
												<td><?php echo $dept_name; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Program Name</th>
												<td><?php echo $prog; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Batch No</th>
												<td><?php echo $batch; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Semester</th>
												<td><?php echo $std_semester; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Father's Name</th>
												<td><?php echo $fname; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Mother's Name</th>
												<td><?php echo $mname; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Guardian Name</th>
												<td><?php echo $gname; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Permanent Address</th>
												<td><?php echo $per_add; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Present Address</th>
												<td><?php echo $pre_add; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Contact No</th>
												<td><?php echo $std_cntc_no; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Guardian Contact No</th>
												<td><?php echo $std_gcntc_no; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Date Of Birth</th>
												<td><?php echo $std_bdate; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Gender</th>
												<td><?php echo $gender; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Nationality</th>
												<td><?php echo $std_nation; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>SSC GPA</th>
												<td><?php echo $std_ssc_rslt; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>HSC GPA</th>
												<td><?php echo $std_hsc_rslt; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Email Address</th>
												<td><?php echo $std_email; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Waiver</th>
												<td><?php echo $std_waiver; ?>%</td>
											</tr>
										</tbody>		
								</table>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2><a href="update_student.php?id=<?php echo $std_id; ?>" class="btn  btn-primary">Edit&nbsp;&nbsp;&nbsp;&nbsp;</a>
									<button onclick="print();" class="btn btn-primary">Print</button>
								</h2>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
</div>
<?php include("footer.php")?> 

<script>

				$(function() {
						$("#hrefPrint").click(function() {
							// Print the DIV.
							$("#printdiv").print();
						return (false);
							});
						});
		</script>