<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];


$syl_name=$_GET['syl_name'];


$query="select * from tbl_syllebus_info where semester='$values' AND syllebus_name='$syl_name'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{																	
		
		$syllebus_auto_id=$row['syllebus_auto_id'];
		$course_auto_id=$row['course_auto_id'];
		$query10="select * from tbl_syllebus_info t1 join tbl_course_info t2 on t1.course_auto_id=t2.course_auto_id  where syllebus_auto_id='$syllebus_auto_id'";
		$result10=mysql_query($query10);	
		while($row10 = mysql_fetch_array($result10))
		{																	
			
				$course_title=$row10['course_name'];		
				$course_auto_id=$row10['course_auto_id'];		

	?>
				
				
				<option value="<?php echo $course_auto_id; ?>"><?php echo $course_title; ?></option>
						
								
	<?php
	}
}



?>

