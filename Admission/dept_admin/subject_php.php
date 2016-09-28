<?php 
require "db_connection.php";


$id=$_SESSION['user_id'];

	$queryy="select * from tbl_dept_admin where dadmin_auto_id='$id'";
	$resultt=mysql_query($queryy);
	while($row  = mysql_fetch_array($resultt))
	{	
		$dept   =$row['dadmin_dept'];
	}
	
$querry="select * from tbl_course_info where course_dept='$dept'";
$resullt=mysql_query($querry);

if(isset($_POST['submit']))
{
	
	$course_title  =isset($_POST['u_pass'])?$_POST['u_pass']:null;
	$course_code  =isset($_POST['uc_pass'])?$_POST['uc_pass']:null;
	$course_credit =isset($_POST['new_pass'])?$_POST['new_pass']:null;
	$course_prereq =isset($_POST['txt_std_pre'])?$_POST['txt_std_pre']:null;
	
	$query="insert into tbl_course_info(course_code,course_name,course_credit,course_dept,course_prerequisite)
	values('$course_code','$course_title','$course_credit',$dept,$course_prereq)";
	$result=mysql_query($query);
	
	if($result)
	{
		echo '<script type="text/javascript">';
					echo 'alert("Successfully Inserted")';
					echo '</script>';
					echo '</script>';
	}
	
	


}

?>	
