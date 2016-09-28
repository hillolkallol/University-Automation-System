<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_POST['abds'];

$mydata=array();

$query = "SELECT * FROM tbl_course_info WHERE course_auto_id=$values LIMIT 1 ";

$result2=mysql_query($query);

while($row2=mysql_fetch_array($result2))
{	 
    array_push($mydata,$row2);
}
echo json_encode ($mydata);

?>