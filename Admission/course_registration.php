<?php 
require "db_connection.php";
require "init.php";

//$total_retake_credit=$val1="";
	 $std_id=check_empty($_POST['student_id']);
	 $semester=check_empty($_POST['student_semester']);
     $val=check_empty($_POST['reg_main_course_list']);
     $session=check_empty($_POST['session']);
     $year=check_empty($_POST['reg_year']);
     $total_credit=check_empty($_POST['reg_main_credit']);
     $val1=check_empty($_POST['reg_retake_course_list']);
     $total_retake_credit=check_empty($_POST['reg_retake_credit']);
	 $total=$total_credit+$total_retake_credit;

	//$semester = isset($_POST['txt_std_semister'])?$_POST['txt_std_semister']:null;
	//$main_course = isset($_POST['auto_id'])?$_POST['auto_id']:null;
	//$main_credit_total = isset($_POST['total_credit'])?$_POST['total_credit']:null;

	//$course_id     = isset($_POST['course_id'])?$_POST['course_id']:null;
	
	$checkbox_values = '"'.implode(',', $val).'"';
	$checkbox_values1 = '"'.implode(',', $val1).'"';
	
		$query = "insert into tbl_course_registration(student_id,student_semester,reg_year,session,reg_main_course_list,reg_main_credit,reg_retake_course_list,reg_retake_credit,reg_total_credit,active)values($std_id,$semester,'$year','$session',$checkbox_values,$total_credit,$checkbox_values1,$total_retake_credit,$total,1)";
  
	
	$result=mysql_query($query);
	
		if($result)
		{
			//echo"successful";
			//header('location: ../Accounts/student_print.php?studentId='.$std_id.'&payCategory=1&season'.$session.'&year='.$year.'&generate=Generate');
			header('Location: ../Accounts/student_print.php?studentId='.$std_id.'&payCategory=2&season=""&year=""&generate=Generate');
		}
		else
		{
			echo $reg_retake_credit;
		}
        

function check_empty($values){
    if($values=='' || $values==null){
        return 0;
    }else{
        return $values;
    }
}
	
	
//$query = "insert into tbl_course_registration(student_id,student_semester,reg_year,session,reg_main_course_list,reg_main_credit)values($std_id,$semester,'$year','$session',$val,$total_credit)";
  
//	$query = "insert into tbl_course_registration(student_id,reg_year,session,reg_main_course_list,reg_retake_course_list,active,reg_main_credit,reg_retake_credit,reg_total_credit)values(0,0,'spring',$checkbox_values,,0,,,,)";
	//$result=mysql_query($query);
?>