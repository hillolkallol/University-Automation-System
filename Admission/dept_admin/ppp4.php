<?php
require "db_connection.php";
require "init.php";
	$teacher=$swmistwer=$seassion=$years=$corsecode=null;
    $teacher=$_POST['offer_teacher_id'];
    $swmistwer=$_POST['offer_semester'];
    $seassion=$_POST['session'];
    $years=$_POST['year'];
    $corsecode=$_POST['course_auto_id'];
    
$query2 = "insert into tbl_course_offer (offer_semester, course_auto_id, offer_teacher_id, year, session) values ($swmistwer,$corsecode,$teacher,$years,'$seassion')";
$result2=mysql_query($query2);
if($result2){
echo 'Sucessfull';
}else{
    echo 'Unsucessfull';
}

?>