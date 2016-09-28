<?php
require "db_connection.php";


$id=$_SESSION['user_id'];
$queryy="select * from tbl_dept_admin where dadmin_auto_id='$id'";
$resultt=mysql_query($queryy);
while($row  = mysql_fetch_array($resultt))
{	
		$dept   =$row['dadmin_dept'];
}

//For Showing Values For Course list
$querry1="select distinct syllebus_name,syllebus_dept from tbl_syllebus_info where syllebus_dept='$dept'";
$resullt1=mysql_query($querry1);


if(isset($_POST['addd_std_submit']))
{
	$std_name    = htmlentities(isset($_POST['txt_std_depttt'])?$_POST['txt_std_depttt']:null);

	$query  ="select * from tbl_syllebus_info where syllebus_name='$std_name'";
	$result = mysql_query($query);
	$row  = mysql_fetch_array($result);
	$syllebus_name =$row['syllebus_name'];
	$id =$row['syllebus_auto_id'];
	$dept =$row['syllebus_dept'];

	if($result)
	{

		header("location:view_syllebus.php?id=$syllebus_name");
		//echo"successfully Done";
	}
	else
	{
		echo"Syllebus Does not found";
	}
			
}


?>

