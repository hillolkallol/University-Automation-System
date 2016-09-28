<?php
require "db_connection.php";
require "init.php";

$query = "select tch_name,tch_id from tbl_teacher_info";
$result=mysql_query($query);

$query1 = "select * from tbl_syllebus_info";
$result1=mysql_query($query1);
while($row1=mysql_fetch_array($result1))
{
	$syllebus_auto_id=$row1['syllebus_auto_id'];
}
$query2 = "select * from tbl_syllebus_info where syllebus_auto_id='$syllebus_auto_id'";
$result2=mysql_query($query2);

while($row2=mysql_fetch_array($result2))
{	
											
     $course_auto_id=$row2['course_auto_id'];
     $syllebus_name=$row2['syllebus_name'];
     $all_course=explode(',',$course_auto_id);
     
}


$mydata=array();
//print_r($all_course);

foreach($all_course as $value){
    $query3  ="select * from tbl_course_info where course_auto_id='$value'";
    $result3 = mysql_query($query3);


while($row3=mysql_fetch_array($result3))
	{ 
        array_push($mydata,$row3);
	}
}

echo json_encode ($mydata);

//print_r($mydata);

/*foreach($mydata as $key=>$valuej){
    foreach($valuej as $key2=>$valuej2){
        echo $key2.'=='.$valuej2;
     }
     echo '<br>';
}*/



















				