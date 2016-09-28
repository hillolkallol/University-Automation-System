<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];

$query10="select * from tbl_course_info where course_auto_id='$values'";
$result10=mysql_query($query10);

while($row10 = mysql_fetch_array($result10))
{																	
			
		$course_title=$row10['course_name'];
		$course_code=$row10['course_code'];
		$course_credit=$row10['course_credit'];
		$course_auto_id=$row10['course_auto_id'];
										

	?>
				
				<tr>		
					<td style="color:#31B0D5"><?php echo $course_credit; ?></td>
					 												 										
				</tr>
						
								
	<?php
}



?>

