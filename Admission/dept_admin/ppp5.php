<?php
require "db_connection.php";
require "init.php";

$secion=$_POST['section'];
$semister=$_POST['offer_semester'];

$query = "SELECT * FROM tbl_course_offer WHERE offer_semester=$semister AND section='$secion'";

$result2=mysql_query($query);

while($row2=mysql_fetch_array($result2))
{
		//$id=$row2['offer_auto_id'];
echo '<tr>
	<td><P style="color:#31B0D5;font-family:sans-serif">'.subjectNamer($row2['course_auto_id']).'</p></td>
	<td><P style="color:#31B0D5;font-family:sans-serif">'.subjectCode($row2['course_auto_id']).'</p></td>
	<td><P style="color:#31B0D5;font-family:sans-serif">'.subjectCredit($row2['course_auto_id']).'</p></td>
	<td><p><a href="delete.php?id='.foroffer($row2['offer_auto_id']).';"class="btn btn-sm btn-danger delete" onclick="return confirm_delete();"> Delete</a></p></td>
    <tr>
    ';
}


function forteacherName($ida){
    $querya = "SELECT * FROM tbl_teacher_info WHERE tch_id=$ida LIMIT 1";
    $resulta=mysql_query($querya);
    while($rowa=mysql_fetch_array($resulta))
    {	 
       $sha=$rowa['tch_name'];
    }
    return $sha;
}

function subjectNamer($idb){
    $queryb = "SELECT * FROM tbl_course_info WHERE course_auto_id=$idb LIMIT 1";
    $resultb=mysql_query($queryb);
    
    while($rowb=mysql_fetch_array($resultb))
    {	 
       $shb=$rowb['course_name'];
    }
    
    return $shb;
    
}
function foroffer($idc){
    $queryc = "SELECT * FROM tbl_course_offer WHERE offer_auto_id=$idc LIMIT 1";
    $resultc=mysql_query($queryc);
    
    while($rowc=mysql_fetch_array($resultc))
    {	 
       $shc=$rowc['offer_auto_id'];
    }
    
    return $shc;
    
}
function subjectCode($idbb){
    $queryd = "SELECT * FROM tbl_course_info WHERE course_auto_id=$idbb LIMIT 1";
    $resultd=mysql_query($queryd);
    
    while($rowd=mysql_fetch_array($resultd))
    {	 
       $shbd=$rowd['course_code'];
    }
    
    return $shbd;
    
}
function subjectCredit($idbbc){
    $querydd = "SELECT * FROM tbl_course_info WHERE course_auto_id=$idbbc LIMIT 1";
    $resultdd=mysql_query($querydd);
    
    while($rowdd=mysql_fetch_array($resultdd))
    {	 
       $shbdd=$rowdd['course_credit'];
    }
    
    return $shbdd;
    
}


?>