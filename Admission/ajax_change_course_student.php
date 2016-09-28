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
while($row10 = mysql_fetch_array($result10))
{																	
		
		$course_id=$row10['reg_main_course_list'];
		$all_course = explode(',',$course_id);
		$count =count($all_course);
		for($i=0; $i<$count; $i++)
		{
				$course_id= $all_course[$i];
				$query  ="select * from tbl_course_info  where course_auto_id='$course_id'";
				$result = mysql_query($query);
				while($row=mysql_fetch_array($result))
				{	
					$course_code = $row['course_code'];
					$course_title = $row['course_name'];
					$course_credit = $row['course_credit'];
										

	?>
			
						
				<tr>		
					<td style="color:#31B0D5"><?php echo $course_code; ?></td>
					<td style="color:#31B0D5"><?php echo $course_title; ?></td>
					<td style="color:#31B0D5"><?php echo $course_credit;?></td>
										
					 										
				</tr>
				
				
											
					 												 										
				
						
								
	<?php
				}
		}				
	
}
$query10="select * from tbl_course_registration where student_semester='$values' and student_id='$id'";
$result10=mysql_query($query10);
while($row10 = mysql_fetch_array($result10))
{																	
		
		$course_id=$row10['reg_retake_course_list'];
		$all_course = explode(',',$course_id);
		$count =count($all_course);
		for($i=0; $i<$count; $i++)
		{
				$course_id= $all_course[$i];
				$query  ="select * from tbl_course_info  where course_auto_id='$course_id'";
				$result = mysql_query($query);
				while($row=mysql_fetch_array($result))
				{	
					$course_code = $row['course_code'];
					$course_title = $row['course_name'];
					$course_credit = $row['course_credit'];
										

	?>
			
						
				<tr>		
					<td style="color:#31B0D5"><?php echo $course_code; ?></td>
					<td style="color:#31B0D5"><?php echo $course_title; ?></td>
					<td style="color:#31B0D5"><?php echo $course_credit;?></td>
										
					 										
				</tr>
				
				
											
					 												 										
				
						
								
	<?php
				}
		}				
	
}



?>

