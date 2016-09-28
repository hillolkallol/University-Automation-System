<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];


$query="select distinct section,offer_semester from tbl_course_offer where offer_semester='$values'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{																	
		
		$section=$row['section'];
		
										

	?>
				
				<option value="<?php echo $section; ?>"><?php echo $section; ?></option>
						
								
	<?php
}



?>

