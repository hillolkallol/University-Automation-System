<?php
require "db_connection.php";
require "init.php";

	//$teacher=$swmistwer=$seassion=$years=$corsecode=null;
    //$teacher=$_POST['offer_teacher_id'];
    $swmistwer=$_POST['offer_semester'];
    $seassion=$_POST['session'];
    $years=$_POST['year'];
    $corsecode=$_POST['course_auto_id'];
    $dept=$_POST['offer_dept'];
    $section=$_POST['section'];
	$teacher=$_POST['offer_teacher_id'];
    
$query2 = "insert into tbl_course_offer(offer_semester,course_auto_id,year,session,offer_dept,section,offer_teacher_id)values($swmistwer,$corsecode,$years,'$seassion',$dept,'$section',$teacher)";
$result2=mysql_query($query2);
if($result2){
echo 'Sucessfull';
}else{
    echo 'Unsucessfull';
}

?>