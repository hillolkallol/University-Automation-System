<?php
	
	// off error reporting
	error_reporting(0);
	
	// set unlimited php execution time
	set_time_limit(0);
	
	// connect to db
	include 'config.php';
	
	// read file id from url
	$id = (int) isset($_GET['file_id']) ? $_GET['file_id'] : 0;
	
	// retrieve file from db with id
	$query = mysql_query("SELECT * FROM routine WHERE id = '$id'");

	if ($row = mysql_fetch_array($query))
	{
		if (file_exists($row['path']))
		{
			// increase counter value
			$count = ++$row['count'];
			// update count column
			mysql_query("UPDATE routine SET count = '$count' WHERE id = {$row['id']} ");

			// set file download headers
			header('Content-Description: File Transfer');
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="'. $row['name'] .'"');
			header('Content-Transfer-Encoding: binary');
			header('Connection: Keep-Alive');
			header('Expires: 0');
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			header('Pragma: public');
			header('Content-Length: ' . filesize($row['path']));
			
			// read file
			readfile($row['path']);
		}
		else 
		{
			echo 'File not found!';
		}
	}
	else 
	{
		echo 'Bad Request!';
	}
?>
