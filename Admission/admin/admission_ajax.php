<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];


$query="select * from tbl_department_info where dept_id='$values'";
$result=mysql_query($query);

while($row = mysql_fetch_array($result))
{																	
		
		$dept_name=$row['dept_name'];
		$dept_id=$row['dept_id'];
		$dept_short_name=$row['dept_short_name'];
		$dept_program_name=$row['dept_program_name'];
										

	?>
				
				<option value="<?php echo $dept_program_name; ?>"><?php echo $dept_program_name; ?></option>
						
								
	<?php
}



?>

