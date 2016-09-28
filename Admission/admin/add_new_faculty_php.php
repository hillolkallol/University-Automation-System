<?php

if(isset($_POST['add_std_submit']))
{
	$faculty_name    = htmlentities(isset($_POST['txt_std_name'])?$_POST['txt_std_name']:null);
	$faculty_id  = htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
	$faculty_short_name  = htmlentities(isset($_POST['txt_std_short'])?$_POST['txt_std_short']:null);
	$faculty_program_name  = htmlentities(isset($_POST['txt_std_program'])?$_POST['txt_std_program']:null);



	$query="insert into tbl_department_info(dept_name,dept_id,dept_short_name,dept_program_name)values('$faculty_name',$faculty_id,'$faculty_short_name','$faculty_program_name')";
	$result=mysql_query($query);
	if($result)
	{
		//echo"successfully Inserted";
		header("location:faculty.php");
	}
	else
	{
					echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
	}
			
}
if(isset($_POST['addd_std_submit']))
{
	$program_name    = htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
	$program_dept  = htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null);

	$query1  ="select * from tbl_department_info where dept_id='$program_dept'";
	$result1 = mysql_query($query1);
	
	$row1=mysql_fetch_array($result1);
		
		$dept_name=$row1['dept_name'];
		$dept_id=$row1['dept_id'];
		$dept_short_name=$row1['dept_short_name'];
		$query2="insert into tbl_department_info(dept_name,dept_id,dept_short_name,dept_program_name)values('$dept_name',$dept_id,'$dept_short_name','$program_name')";
		$result2=mysql_query($query2);
		if($result2)
		{
			echo '<script type="text/javascript">';
			echo 'alert("successfully Inserted!")';
			echo '</script>';
			//echo'successfully Inserted';
			//echo"successfully Inserted";
			//header("location:faculty.php");
		}
		else
		{
					echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
			
		}
			
}


?>