<?php

$q="select distinct dept_name,dept_id from tbl_department_info";
$r=mysql_query($q);
if(isset($_POST['add_std_submit']))
{
	$std_id    = htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
	$std_dept  = htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null);

	$query  ="select * from tbl_teacher_info where tch_id='$std_id'";
	$result = mysql_query($query);
	$check  = mysql_num_rows($result);
	$row  = mysql_fetch_array($result);

	$id =$row['tch_id'];
	$dept =$row['tch_dept'];

	if($id==$std_id && $dept== $std_dept)
	{

		header("location:view_teacher.php?id=$id;");
		//echo"successfully Done";
	}
	else
	{
		//echo"Teacher Id and Department Does Not Match";
		echo '<script type="text/javascript">';
		echo 'alert("Teacher Id and Department Does Not Match!")';
		echo '</script>';
	}
			
}

?>
<!--Jquery using for admission-->
