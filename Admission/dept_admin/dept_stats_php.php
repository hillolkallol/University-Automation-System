<?php
require "db_connection.php";
require "init.php";
loggedin();
$id=$_SESSION['user_id'];


	$query="select * from tbl_department_info where dept_id='$id'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{	
		$dept_name=$row['dept_name'];
	}
	
	//For DEpartment Statsistics

	$query="select * from tbl_student_info t1 join tbl_department_info t2 on t1.std_dept=t2.dept_id where dept_id='$id'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{	
		$dept_id=$row['dept_id'];
		$std_dept =$row['std_dept'];
	}
	
	$query="select count(std_id) as total_student from tbl_student_info  where std_active=1 and std_dept='$std_dept'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$total_student = $row['total_student'];
	}
	$query="select count(std_id) as total_student from tbl_student_info  where std_semester=1 and std_dept='$std_dept'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$total_student_1st_semester = $row['total_student'];
	}
	$query="select count(std_id) as total_student from tbl_student_info  where std_gender='Male' and std_dept='$std_dept'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$total_student_1st_male = $row['total_student'];
	}
	$query="select count(std_id) as total_student from tbl_student_info  where std_gender='Female' and std_dept='$std_dept'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{
		$total_student_1st_female = $row['total_student'];
	}

	$query="select * from tbl_teacher_info t1 join tbl_department_info t2 on t1.tch_dept=t2.dept_id where dept_id='$id'";
	$result=mysql_query($query);
	while($row = mysql_fetch_array($result))
	{	
		$dept_id=$row['dept_id'];
		$tch_dept =$row['tch_dept'];
	}
$query="select count(tch_id) as total_teacher from tbl_teacher_info  where tch_dept='$tch_dept'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{
	$total_teacher = $row['total_teacher'];
}

$query="select count(dept_program_name) as total_department from tbl_department_info  where dept_id='$id'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_dept = $row['total_department'];
}


if(isset($_POST['add_std_submit']))
{

	$std_batch  = htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);

	$query  ="select * from tbl_student_info where std_batch='$std_batch'";
	$result = mysql_query($query);
	$row  = mysql_fetch_array($result);

	$id =$row['std_id'];
	$name =$row['std_name'];
	$batch =$row['std_batch'];

	if($std_dept)
	{

		header("location:dept_batch_stats_list.php?id=$batch;");
		//echo"successfully Done";
	}
	
			
}
?>