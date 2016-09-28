<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];


$query="select * from tbl_course_offer where offer_semester='$values' and(section='A' OR section ='')";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{																	
		
		$offer_auto_id=$row['offer_auto_id'];
		$course_auto_id=$row['course_auto_id'];
		$query10="select * from tbl_course_offer t1 join tbl_course_info t2 on t1.course_auto_id=t2.course_auto_id  where offer_auto_id='$offer_auto_id'";
		$result10=mysql_query($query10);	
		while($row10 = mysql_fetch_array($result10))
		{																	
			
				$course_title=$row10['course_name'];		
				$course_auto_id=$row10['course_auto_id'];		
				$offer_auto_id=$row10['offer_auto_id'];		

	?>
				
				
				
				<option value="<?php echo $course_auto_id; ?>"><?php echo $course_title; ?></option>
				<option id="offer_auto_id"style="display:none"value="<?php echo $offer_auto_id ?>"><?php echo $course_title; ?></option>
						
								
	<?php
	}
}



?>

