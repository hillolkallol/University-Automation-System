<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	

$query="select count(std_id) as total_student from tbl_student_info";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_student = $row['total_student'];
}
$query="select count(std_id) as total_student from tbl_student_info where std_semester=1";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_student_1st_semester = $row['total_student'];
}
$query="select count(std_id) as total_student from tbl_student_info where std_gender='Male'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_student_1st_male = $row['total_student'];
}
$query="select count(std_id) as total_student from tbl_student_info where std_gender='Female'";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_student_1st_female = $row['total_student'];
}


$query="select count(tch_id) as total_teacher from tbl_teacher_info";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_teacher = $row['total_teacher'];
}
$query="select count(dept_id) as total_department from tbl_department_info";
$result=mysql_query($query);
while($row=mysql_fetch_array($result))
{
	$total_dept = $row['total_department'];
}

//For showing all value in option for department
$q="select distinct dept_name,dept_id from tbl_department_info";
$r=mysql_query($q);


if(isset($_POST['add_std_submit']))
{

	$std_dept  = htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null);

	$query  ="select * from tbl_department_info where dept_id='$std_dept'";
	$result = mysql_query($query);
	$row  = mysql_fetch_array($result);

	$id =$row['dept_id'];
	$dept =$row['dept_name'];

	if($std_dept)
	{

		header("location:dept_stats.php?id=$id;");
		//echo"successfully Done";
	}
	
			
}



?>