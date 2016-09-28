<?php
	require 'config.php';
	ob_start();
	session_start();
	function loggedin()
	{
		if(isset($_SESSION['userida']) && !empty($_SESSION['userida']))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	if(loggedin())
	{	
		include'include/admin_header.php';
		$id= $_SESSION['id'];
		$course= $_SESSION['course'];
		$sem= $_SESSION['seme'];
		$year= $_SESSION['year'];

		$flag= mysql_result(mysql_query("SELECT flag FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."'"),0);

		if($flag==1)
		{
			$entry_del= mysql_query("DELETE FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."' ");
		}
		else if($flag==0)
		{
			$c_id= mysql_result (mysql_query("SELECT course_id FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."'"),0);
				
			$credit= mysql_result (mysql_query("SELECT course_credit FROM tbl_course_info WHERE course_auto_id='".mysql_real_escape_string($c_id)."' AND course_code='".mysql_real_escape_string($course)."'"),0);
			
			$grade_prev= mysql_result(mysql_query("SELECT grade FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."'"),0);
			$addcredit=0;
			if($grade_prev== 'A+') $point_del= 4.00*$credit; 
			else if($grade_prev== 'A') $point_del= 3.75*$credit; 
			else if($grade_prev== 'A-') $point_del= 3.50*$credit;
			else if($grade_prev== 'B+') $point_del= 3.25*$credit;
			else if($grade_prev== 'B') $point_del= 3.00*$credit;
			else if($grade_prev== 'B-') $point_del= 2.75*$credit;
			else if($grade_prev== 'C+') $point_del= 2.50*$credit;
			else if($grade_prev== 'C') $point_del= 2.25*$credit;
			else if($grade_prev== 'D') $point_del= 2.00*$credit;
			else if($grade_prev== 'F' || $grade_prev== 'I' || $grade_prev== 'Incomplete') {$addcredit=1;$point_del= 0;}

			$point_prev= mysql_result(mysql_query("SELECT total_gradepoint FROM  tbl_student_info WHERE std_id='".mysql_real_escape_string($id)."' "),0);
			$credit_prev= mysql_result(mysql_query("SELECT std_total_credit FROM  tbl_student_info WHERE std_id='".mysql_real_escape_string($id)."' "),0);
			
			$mul_entry_chk= mysql_query("SELECT * FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' ");
			$rows= mysql_num_rows($mul_entry_chk);
			
			$entry_del= mysql_query("DELETE FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND session='".mysql_real_escape_string($sem)."' AND year='".mysql_real_escape_string($year)."' ");
			
			if($rows>1)
			{
				$max_marks= mysql_result (mysql_query("SELECT MAX(total_marks) FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."'"),0);
				//echo $max_marks;
				
				$flag_change= mysql_query(" UPDATE student_result SET flag=0 WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND total_marks='".mysql_real_escape_string($max_marks)."' ");
				
				$grade= mysql_result (mysql_query("SELECT grade FROM student_result WHERE s_id='".mysql_real_escape_string($id)."' AND course_code='".mysql_real_escape_string($course)."' AND total_marks='".mysql_real_escape_string($max_marks)."'"),0);
				
				//echo $grade;
				
				if($grade== 'A+') $point_add= 4.00*$credit; 
				else if($grade== 'A') $point_add= 3.75*$credit; 
				else if($grade== 'A-') $point_add= 3.50*$credit;
				else if($grade== 'B+') $point_add= 3.25*$credit;
				else if($grade== 'B') $point_add= 3.00*$credit;
				else if($grade== 'B-') $point_add= 2.75*$credit;
				else if($grade== 'C+') $point_add= 2.50*$credit;
				else if($grade== 'C') $point_add= 2.25*$credit;
				else if($grade== 'D') $point_add= 2.00*$credit;
				else if($grade== 'F' || $grade== 'I') {$addcredit=1;$point_add= 0;}
		
				$point_prev-= $point_del;
				$point_new= $point_prev+$point_add;
				$cgpa= $point_new/$credit_prev;
			}
			else
			{
				$point_new= $point_prev-$point_del;
				if($addcredit!=1)
				{
					$credit_new= $credit_prev-$credit;
					$update_credit= mysql_query(" UPDATE tbl_student_info SET std_total_credit='".mysql_real_escape_string($credit_new)."' WHERE std_id='".mysql_real_escape_string($id)."' ");
					$cgpa= $point_new/$credit_new;
				}
			}
			$update_point= mysql_query(" UPDATE tbl_student_info SET total_gradepoint='".mysql_real_escape_string($point_new)."' WHERE std_id='".mysql_real_escape_string($id)."' ");
			$update_cgpa= mysql_query(" UPDATE tbl_student_info SET std_total_cgpa='".mysql_real_escape_string($cgpa)."' WHERE std_id='".mysql_real_escape_string($id)."' ");
			
		}
		?>
		<!---------------Container starts----------------------------->
		
		<!-------------------Container Ends---------------------->
<?php 
		include 'include/footer.php' ;

	}
	else  header('Location: login.php');
?>
