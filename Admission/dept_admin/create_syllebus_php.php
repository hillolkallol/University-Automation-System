<?php 
require "db_connection.php";
require "init.php";
loggedin();

$id=$_SESSION['user_id'];

$queryy="select * from tbl_dept_admin where dadmin_auto_id='$id'";
$resultt=mysql_query($queryy);
while($row  = mysql_fetch_array($resultt))
{	
		$dept   =$row['dadmin_dept'];
}

//For Showing Values For Course list
$query2="select * from tbl_student_info where std_active=1 and std_dept='$dept'";
$result2=mysql_query($query2);


$querry="select * from tbl_course_info where course_dept='$dept'";
$resullt=mysql_query($querry);

$query1="select * from tbl_department_info where dept_id='$dept'";
$result1=mysql_query($query1);




if(isset($_POST['submit']))
{
	$syllebus_name = isset($_POST['u_pass'])?$_POST['u_pass']:null;
	$course_id     = isset($_POST['course_id'])?$_POST['course_id']:null;
	
	$checkbox_values = '"'.implode(',', $course_id).'"';
	
		
	  
	$query = "insert into tbl_syllebus_info(syllebus_name,course_auto_id,syllebus_dept)values('$syllebus_name',$checkbox_values,$dept)";
	$result=mysql_query($query);
	
		if($result)
		{
			echo"successful";
		}
		else
		{
			echo"failedvdzfdsfadsfadsdasdsadsad";
		}
	
	
	
}
?>