<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	
$q="select distinct dept_name,dept_id from tbl_department_info";
$r=mysql_query($q);
	
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
		$name  = htmlentities(isset($_POST['txt_std_name'])?$_POST['txt_std_name']:null);
		$fname = htmlentities(isset($_POST['txt_std_fname'])?$_POST['txt_std_fname']:null);
		$mname = htmlentities(isset($_POST['txt_std_mname'])?$_POST['txt_std_mname']:null);
		$per_add = htmlentities(isset($_POST['txt_std_per_add'])?$_POST['txt_std_per_add']:null);
		$pre_add = htmlentities(isset($_POST['txt_std_pre_add'])?$_POST['txt_std_pre_add']:null);
		$std_cntc_no = htmlentities(isset($_POST['txt_std_cntc_no'])?$_POST['txt_std_cntc_no']:null);
		$std_bdate = htmlentities(isset($_POST['txt_std_bdate'])?$_POST['txt_std_bdate']:null);
		$std_gender= htmlentities(isset($_POST['txt_std_gender'])?$_POST['txt_std_gender']:null);
		$std_nation= htmlentities(isset($_POST['txt_std_nation'])?$_POST['txt_std_nation']:null);
		$std_pos= htmlentities(isset($_POST['txt_std_pos'])?$_POST['txt_std_pos']:null);
		$std_qlf= htmlentities(isset($_POST['txt_std_id_qf'])?$_POST['txt_std_id_qf']:null);
		$std_email= htmlentities(isset($_POST['txt_std_email'])?$_POST['txt_std_email']:null);
		$std_id= htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);
		$std_pass= htmlentities(isset($_POST['txt_std_pass'])?$_POST['txt_std_pass']:null);

		if($std_gender==1)
		{
			$gender="Male";
		}
		if($std_gender==2)
		{
			$gender="Female";
		}
		if(!empty($picname))
		{
				if($filesize <100 && $width<160 && $height<160)
				{	
					if($extension=='jpeg'||$extension=='jpg' || $extension=='png')
					{
						$picid="img".date("ymHis");
						$location='../img/ ';
						$uploadfile=$location.$picid.'.'.$extension;
						if(move_uploaded_file($tmp_name,$uploadfile))
						{	
							//echo"uploaded successfully";
							$imgpath=$location.$picid.'.'.$extension;
							$query  ="insert into tbl_teacher_info(tch_pic,tch_dept,tch_name,tch_father_name,tch_mother_name,tch_permanent_address,tch_present_address,tch_contact_no,tch_birth_date,tch_gender,tch_nationality,tch_position,tch_qualification,tch_email,tch_id,tch_password)values
							('$imgpath',$dept,'$name','$fname','$mname','$per_add','$pre_add',$std_cntc_no,'$std_bdate','$gender','$std_nation','$std_pos','$std_qlf','$std_email',$std_id,'$std_pass')";
							
							$result =mysql_query($query);
							if($result)
							{
								//echo"successfully inserted";
									echo '<script type="text/javascript">';
									echo 'alert("successfully Inserted!")';
									echo '</script>';
							}
							else
							{
									echo '<script type="text/javascript">';
									echo 'alert("Sorry Try Again!")';
									echo '</script>';
							}
			
						}
						else
						{
							//echo"There was an errror<br/>";
							echo '<script type="text/javascript">';
									echo 'alert("Sorry Try Again!")';
									echo '</script>';
						}
					
					}
					else		
					{								
						//echo" file must be jpg/jpeg";
						echo '<script type="text/javascript">';
									echo 'alert(" file must be jpg/jpeg!")';
									echo '</script>';	
						
					}
				}
				else
				{
					//echo"file size exceeds (4KB is maximum) And width must be 120px and height must be 120px";
					echo '<script type="text/javascript">';
									echo 'alert("file size exceeds (2MB is maximum) And width must be 120px and height must be 120px";")';
									echo '</script>';
				}		
		}
		else
		{
			//echo"please choose a file";
			echo '<script type="text/javascript">';
									echo 'alert("please choose a file!")';
									echo '</script>';	
		}
			
						
}
?>