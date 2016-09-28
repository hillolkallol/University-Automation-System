<?php
require "db_connection.php";
require "init.php";



	//$syllebus_name=$syllebus_dept=$std_batch=$program_name=$semester=$course=null;
	
    $syllebus_name=$_POST['syllebus_name'];
    $syllebus_dept=$_POST['syllebus_dept'];
    $std_batch=$_POST['batch'];
    $program_name=$_POST['program_name'];
    $course=$_POST['course_auto_id'];
	$semester=$_POST['semester'];
    
$query_new = "insert into tbl_syllebus_info(syllebus_name,syllebus_dept,program_name,batch,course_auto_id,semester )values('$syllebus_name',$syllebus_dept,'$program_name',$std_batch,$course,$semester)";
$result_new=mysql_query($query_new);
if($result_new){
echo 'Sucessfull';
}else{
   echo 'Unsucessfull';
}

?>
