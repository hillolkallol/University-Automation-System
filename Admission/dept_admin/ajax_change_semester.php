<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];


$query="select distinct semester from tbl_syllebus_info where syllebus_name='$values'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{																	
		
		$syllebus_semester=$row['semester'];
		
										

	?>
				
				<option value="<?php echo $syllebus_semester; ?>"><?php echo $syllebus_semester; ?></option>
						
								
	<?php
}



?>

