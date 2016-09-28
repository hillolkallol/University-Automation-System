<?php

$q="select * from tbl_student_info where std_active=0";
$r=mysql_query($q);
while($row = mysql_fetch_array($r))
{
	$std_auto_id=$row['std_auto_id'];
	$std_id=$row['std_id'];
	for($i=0; $i<=$std_auto_id; $i++){
  

     $result = mysql_query("UPDATE tbl_student_info SET std_id=$i WHERE std_auto_id='$std_auto_id'");
	
    
}
}

$query="select distinct dept_name,dept_id from tbl_department_info";
$result=mysql_query($query);

$q="select * from tbl_department_info";
$res=mysql_query($q);

	
	if(isset($_POST['add_std_submit']))
{
		$picname=isset($_FILES['txt_std_pic']['name'])?$_FILES['txt_std_pic']['name']:null;
		$extension=strtolower(substr($picname,strpos($picname,'.')+1));
		$size=isset($_FILES['txt_std_pic']['size'])?$_FILES['txt_std_pic']['size']:null;
		$type=isset($_FILES['txt_std_pic']['type'])?$_FILES['txt_std_pic']['type']:null;
		$tmp_name=isset($_FILES['txt_std_pic']['tmp_name'])?$_FILES['txt_std_pic']['tmp_name']:null;
		$filesize = filesize($tmp_name)  * .0009765625 * .0009765625;; // bytes to MB
		list($width, $height, $type, $attr) = getimagesize($tmp_name);
		$dept  = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null));
		$prog  = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_prg'])?$_POST['txt_std_prg']:null));
		$name  = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_name'])?$_POST['txt_std_name']:null));
		$fname = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_fname'])?$_POST['txt_std_fname']:null));
		$mname = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_mname'])?$_POST['txt_std_mname']:null));
		$gname = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_gname'])?$_POST['txt_std_gname']:null));
		$per_add =mysql_real_escape_string(htmlentities(isset($_POST['txt_std_per_add'])?$_POST['txt_std_per_add']:null));
		$pre_add = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_pre_add'])?$_POST['txt_std_pre_add']:null));
		$std_cntc_no = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_cntc_no'])?$_POST['txt_std_cntc_no']:null));
		$std_gcntc_no = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_gcntc_no'])?$_POST['txt_std_gcntc_no']:null));
		$std_bdate = mysql_real_escape_string(htmlentities(isset($_POST['txt_std_bdate'])?$_POST['txt_std_bdate']:null));
		$std_gender= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_gender'])?$_POST['txt_std_gender']:null));
		$std_nation= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_nation'])?$_POST['txt_std_nation']:null));
		$std_ssc_rslt= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_ssc_rslt'])?$_POST['txt_std_ssc_rslt']:null));
		$std_hsc_rslt= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_hsc_rslt'])?$_POST['txt_std_hsc_rslt']:null));
		$std_email= mysql_real_escape_string(htmlentities(isset($_POST['txt_std_email'])?$_POST['txt_std_email']:null));
		
		if($std_gender==1)
		{
			$gender="Male";
		}
		if($std_gender==2)
		{
			$gender="Female";
		}
		$std_total_gpa = ($std_ssc_rslt + $std_hsc_rslt);



		if(!empty($picname))
		{
				if($filesize <2 && $width<160 && $height<160)
				{	
					if($extension=='jpeg'||$extension=='jpg' || $extension=='png')
					{
						$picid="img".date("ymHis");
						$location='../img/';
						$uploadfile=$location.$picid.'.'.$extension;
						if(move_uploaded_file($tmp_name,$uploadfile))
						{	
							//echo"uploaded successfully";
							$imgpath=$location.$picid.'.'.$extension;
							$query  ="insert into tbl_student_info(std_pic,std_dept,std_program,std_name,std_father_name,std_mother_name,std_guardian_name,std_permanent_address,std_present_address,std_contact_no,std_guardian_contact_no,std_birth_date,std_gender,std_nationality,std_ssc_result,std_hsc_result,std_email,std_total_result)values
							('$imgpath',$dept,'$prog','$name','$fname','$mname','$gname','$per_add','$pre_add',$std_cntc_no,$std_gcntc_no,'$std_bdate','$gender','$std_nation',$std_ssc_rslt,$std_hsc_rslt,'$std_email',$std_total_gpa)";
							$result =mysql_query($query);
							if($result)
							{
								//echo"successfully inserted";
								$qu="select * from tbl_student_info order by std_auto_id desc";
								$ru=mysql_query($qu);
								$std_id=mysql_result($ru, 0, 'std_auto_id');
								//echo $std_id;
								header('Location: ../../Accounts/student_print.php?studentId='.$std_id.'&payCategory=2&season=""&year=""&generate=Generate');

							}
							else
							{
								//echo"hoisena";
									unlink($imgpath);
									echo '<script type="text/javascript">';
									echo 'alert("Sorry Try Again!")';
									echo '</script>';
									
							}
			
						}
						else
						{
							echo"There was an errror<br/>";
						}
					
					}
					else		
					{								
						echo" file must be jpg/jpeg";	
						
					}
				}
				else
				{
					//echo"file size exceeds (2MB is maximum) And width must be below 160px and height must be 160px";
					echo '<script type="text/javascript">';
					echo 'alert("file size exceeds (2MB is maximum) And width must be below 160px and height must be 160px!")';
					echo '</script>';
				}		
		}
		else
		{
			echo"please choose a file";
		}
}







?>