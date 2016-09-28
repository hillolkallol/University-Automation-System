<?php
	require "db_connection.php";
	require "init.php";
	loggedin();

//for department value & name	
$query="select distinct dept_name,dept_id from tbl_department_info";
$result=mysql_query($query);


//for program name &value
$q="select * from tbl_department_info";
$res=mysql_query($q);
	
	if(isset($_POST['add_std_submit']))
{
		$picname=isset($_FILES['txt_std_pic']['name'])?$_FILES['txt_std_pic']['name']:null;
		$extension=strtolower(substr($picname,strpos($picname,'.')+1));
		$size=isset($_FILES['txt_std_pic']['size'])?$_FILES['txt_std_pic']['size']:null;
		$type=isset($_FILES['txt_std_pic']['type'])?$_FILES['txt_std_pic']['type']:null;
		$tmp_name=isset($_FILES['txt_std_pic']['tmp_name'])?$_FILES['txt_std_pic']['tmp_name']:null;
		$filesize = filesize($tmp_name) * .0009765625; // bytes to KB
		list($width, $height, $type, $attr) = getimagesize($tmp_name);
		$dept  = htmlentities(isset($_POST['txt_std_dept'])?$_POST['txt_std_dept']:null);
		$prog  = htmlentities(isset($_POST['txt_std_prg'])?$_POST['txt_std_prg']:null);
		$name  = htmlentities(isset($_POST['txt_std_name'])?$_POST['txt_std_name']:null);
		$fname = htmlentities(isset($_POST['txt_std_fname'])?$_POST['txt_std_fname']:null);
		$mname = htmlentities(isset($_POST['txt_std_mname'])?$_POST['txt_std_mname']:null);
		$gname = htmlentities(isset($_POST['txt_std_gname'])?$_POST['txt_std_gname']:null);
		$per_add = htmlentities(isset($_POST['txt_std_per_add'])?$_POST['txt_std_per_add']:null);
		$pre_add = htmlentities(isset($_POST['txt_std_pre_add'])?$_POST['txt_std_pre_add']:null);
		$std_cntc_no = htmlentities(isset($_POST['txt_std_cntc_no'])?$_POST['txt_std_cntc_no']:null);
		$std_gcntc_no = htmlentities(isset($_POST['txt_std_gcntc_no'])?$_POST['txt_std_gcntc_no']:null);
		$std_bdate = htmlentities(isset($_POST['txt_std_bdate'])?$_POST['txt_std_bdate']:null);
		$std_gender= htmlentities(isset($_POST['txt_std_gender'])?$_POST['txt_std_gender']:null);
		$std_nation= htmlentities(isset($_POST['txt_std_nation'])?$_POST['txt_std_nation']:null);
		$std_ssc_rslt= htmlentities(isset($_POST['txt_std_ssc_rslt'])?$_POST['txt_std_ssc_rslt']:null);
		$std_hsc_rslt= htmlentities(isset($_POST['txt_std_hsc_rslt'])?$_POST['txt_std_hsc_rslt']:null);
		$std_email= htmlentities(isset($_POST['txt_std_email'])?$_POST['txt_std_email']:null);
		$std_active= htmlentities(isset($_POST['txt_std_active'])?$_POST['txt_std_active']:null);
		$std_batch= htmlentities(isset($_POST['txt_std_batch'])?$_POST['txt_std_batch']:null);
		$std_waiver= htmlentities(isset($_POST['txt_std_waiver'])?$_POST['txt_std_waiver']:null);
		$std_math= htmlentities(isset($_POST['txt_std_math'])?$_POST['txt_std_math']:null);
		$std_physics= htmlentities(isset($_POST['txt_std_physics'])?$_POST['txt_std_physics']:null);
		$std_id= htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
		$std_pass= htmlentities(isset($_POST['txt_std_pass'])?$_POST['txt_std_pass']:null);
		$std_total_gpa = ($std_ssc_rslt + $std_hsc_rslt);

		if($std_gender==1)
		{
			$gender="Male";
		}
		if($std_gender==2)
		{
			$gender="Female";
		}
		if($std_math==1)
		{
			$math="Yes";
		}
		else
		{
			$math="No";
		}
		if($std_physics==1)
		{
			$physics="Yes";
		}
		else
		{
			$physics="No";
		}

		if(!empty($picname))
		{
				if($filesize <100 && $width<160 && $height<160)
				{	
					if($extension=='jpeg'||$extension=='jpg')
					{
						$picid="img".date("ymHis");
						$location='../img/ ';
						$uploadfile=$location.$picid.'.'.$extension;
						if(move_uploaded_file($tmp_name,$uploadfile))
						{	
							//echo"uploaded successfully";
							$imgpath=$location.$picid.'.'.$extension;
							$query  ="insert into tbl_student_info(std_pic,std_dept,std_program,std_name,std_father_name,std_mother_name,std_guardian_name,std_permanent_address,std_present_address,std_contact_no,std_guardian_contact_no,std_birth_date,std_gender,std_nationality,std_ssc_result,std_hsc_result,std_email,std_total_result,std_active,std_batch,std_semester,std_waiver,std_math,std_physics,std_id,std_password)values
							('$imgpath',$dept,'$prog','$name','$fname','$mname','$gname','$per_add','$pre_add',$std_cntc_no,$std_gcntc_no,'$std_bdate','$gender','$std_nation',$std_ssc_rslt,$std_hsc_rslt,'$std_email',$std_total_gpa,$std_active,$std_batch,1,$std_waiver,'$math','$physics',$std_id,$std_pass)";
							
							$result =mysql_query($query);
							if($result)
							{
								echo"successfully inserted";
		
							}
							else
							{
							echo"hoisena";
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
					echo"file size exceeds (4KB is maximum) And width must be 120px and height must be 120px";
				}		
		}
		else
		{
			echo"please choose a file";
		}
			
						
}
?>