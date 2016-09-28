<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();
if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}




$query="select * from tbl_teacher_info where tch_id='$id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{	
		$imgpath=$row['tch_pic'];
		$dept=$row['tch_dept'];
		$name=$row['tch_name'];
		$fname=$row['tch_father_name'];
		$mname=$row['tch_mother_name'];
		$per_add=$row['tch_permanent_address'];
		$pre_add=$row['tch_present_address'];
		$std_cntc_no=$row['tch_contact_no'];
		$std_bdate=$row['tch_birth_date'];
		$gender=$row['tch_gender'];
		$std_nation=$row['tch_nationality'];
		$std_ssc_rslt=$row['tch_position'];
		$std_hsc_rslt=$row['tch_qualification'];
		$std_email=$row['tch_email'];
		$std_id = $row['tch_id'];
		
}	

//For seleecting program value and name
$xyz="select * from tbl_teacher_info t1 join tbl_department_info t2 on t1.tch_dept=t2.dept_id where tch_id='$std_id'";
$mno=mysql_query($xyz);
while($muhib = mysql_fetch_array($mno))
{
	$dept_name=$muhib['dept_name'];
}	


?>
<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Teacher Information</h2>
								</div>
								<table class="table table-hover table-bordered ">
										<tbody>
											<tr style="color:steelblue">	
												<th>Teacher Image</th>
												<td><img src="<?php echo $imgpath; ?>" alt="profile pic"/></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Teacher ID</th>
												<td><?php echo $std_id; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th> Name</th>
												<td><?php echo $name; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Department Name</th>
												<td><?php echo $dept_name; ?></td>
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
												<th>Position</th>
												<td><?php echo $std_ssc_rslt; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Qualification</th>
												<td><?php echo $std_hsc_rslt; ?></td>
											</tr>
											<tr style="color:steelblue">	
												<th>Email Address</th>
												<td><?php echo $std_email; ?></td>
											</tr>
										</tbody>		
								</table>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2><a href="update_teacher.php?id=<?php echo $std_id; ?>" class="btn btn-info">Edit</a></h2>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
</div>
<?php include("footer.php")?> 