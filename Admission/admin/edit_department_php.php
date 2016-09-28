<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}
$query="select * from tbl_department_info where dept_id='$id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{	
		$dept_name=$row['dept_name'];
		$dept_id=$row['dept_id'];
		$dept_short_name=$row['dept_short_name'];
		$dept_program_name=$row['dept_program_name'];
		
		
}	
$query1  ="select distinct dept_program_name from tbl_department_info where dept_id='$id'";
$result2 = mysql_query($query1);

if(isset($_POST['add_std_submit']))
{
	$faculty_name    = htmlentities(isset($_POST['txt_std_name'])?$_POST['txt_std_name']:null);
	$faculty_id  = htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
	$faculty_short_name  = htmlentities(isset($_POST['txt_std_short'])?$_POST['txt_std_short']:null);
	$faculty_program_name  = htmlentities(isset($_POST['txt_std_prg'])?$_POST['txt_std_prg']:null);



	$query="update tbl_department_info set dept_name='$faculty_name',dept_id=$faculty_id,dept_short_name='$faculty_short_name'dept_program_name='$faculty_program_name' where dept_id='$id'";
	$result=mysql_query($query);
	if($result)
	{
		//echo"successfully Updated";
		header("location:faculty.php");
	}
	else
	{
		echo"Hoisena";
	}
			
}

?>