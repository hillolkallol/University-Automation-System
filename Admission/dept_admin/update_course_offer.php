<?php
require "db_connection.php";
require "init.php";

	//$teacher=$swmistwer=$seassion=$years=$corsecode=null;
    //$teacher=$_POST['offer_teacher_id'];
    $semester=$_POST['offer_semester'];
    $teacher=$_POST['offer_teacher_id'];
    $section=$_POST['section'];
    $offer_auto_id=$_POST['offer_auto_id'];
    $course_auto_id=$_POST['course_auto_id'];
    
$query1="select * from tbl_course_offer where offer_semester='$semester' and section='$section'  and course_auto_id='$course_auto_id'";
$result1=mysql_query($query1);
while($row1 = mysql_fetch_array($result1))
{	
	
	$offer_auto_id=$row1['offer_auto_id'];
	$section=$row1['section'];
	
$query2 = "update tbl_course_offer set offer_teacher_id=$teacher where offer_auto_id='$offer_auto_id'";
$result2=mysql_query($query2);
if($result2){
echo 'Sucessfull';
}else{
    echo 'Unsucessfull';
}

}


?>