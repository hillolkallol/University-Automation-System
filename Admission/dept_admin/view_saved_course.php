<?php
require "db_connection.php";
require "init.php";

$query = "SELECT * FROM tbl_syllebus_info";
$result2=mysql_query($query);

while($row2=mysql_fetch_array($result2)){
		$course_auto_id=$row2['course_auto_id'];
		$syllebus_auto_id=$row2['syllebus_auto_id'];
}

$query10="select * from tbl_course_info where course_auto_id=$course_auto_id";
$result10=mysql_query($query10);

while($row10 = mysql_fetch_array($result10))
{																	
			
		$course_title=$row10['course_name'];
		$course_code=$row10['course_code'];
		$course_credit=$row10['course_credit'];
		//$course_auto_id=$row10['course_auto_id'];
										

	?>
				
						
				<tr>		
					<td style="color:#31B0D5"><?php echo $course_code; ?></td>
					<td style="color:#31B0D5"><?php echo $course_title; ?></td>
					<td style="color:#31B0D5"><?php echo $course_credit;?></td>
					<td><p><a href="delete_syllebus.php?id=<?php echo $syllebus_auto_id;?>"class="btn btn-sm btn-danger delete" onclick="return confirm_delete();"> Delete</a></p></td>
					 										
				</tr>
					
											
					 												 										
				
						
								
	<?php
}



?>