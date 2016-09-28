<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];
loggedin();
$id=$_SESSION['user_id'];

//$std_dept=$_POST['std_dept'];
$query10="select * from tbl_course_registration where student_semester='$values' and student_id='$id'";
$result10=mysql_query($query10);
$row=mysql_fetch_array($result10);
$status=$row['active'];
if($status==1)
{
	echo'<button class="btn btn-sm btn-warning">Pending</button>';
}
else if($status==2)
{
	echo'<button class="btn btn-sm btn-primary">successful</button>';
}
else if($status==3)
{
	echo'<button class="btn btn-sm btn-danger">Failed</button>';
}
else{
	echo'<button class="btn btn-sm btn-success">Not Available</button>';
}



?>