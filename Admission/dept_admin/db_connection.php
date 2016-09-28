<?php
$db_host='localhost';
$db_user='root';
$db_pass='';
$db_name='db_leading';

$con=mysql_connect($db_host,$db_user,$db_pass,$db_name);
if($con)
{
	//echo "successfully connected<br/>";
}
else
{
	echo"connection error<br/>";
}
$result=mysql_select_db($db_name);
if($result)
{
	//echo"database found <br/>";
}
else
{
	echo"database does not exist <br/>";
}




?>