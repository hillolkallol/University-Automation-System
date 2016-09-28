<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}


$query="select * from tbl_teacher_info where tch_id='$id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{	
		$imgpath=$row['tch_pic'];
		$dept=$row['tch_dept'];
		$name=$row['tch_name'];
		$fname=$row['tch_father_name'];
		$mname=$row['tch_mother_name'];
		$per_add=$row['tch_permanent_address'];
		$pre_add=$row['tch_present_address'];
		$std_cntc_no=$row['tch_contact_no'];
		$std_bdate=$row['tch_birth_date'];
		$gender=$row['tch_gender'];
		$std_nation=$row['tch_nationality'];
		$std_ssc_rslt=$row['tch_position'];
		$std_hsc_rslt=$row['tch_qualification'];
		$std_email=$row['tch_email'];
		$std_id = $row['tch_id'];
		
}

//For seleecting dept value and name
$abc="select *  from tbl_teacher_info t1 join  tbl_department_info t2 on t1.tch_dept=t2.dept_id where tch_id='$std_id'";
$def=mysql_query($abc);
while($rimon = mysql_fetch_array($def))
{
	$dept_id=$rimon['dept_id'];
	$dept_name=$rimon['dept_name'];
	$dept=$rimon['tch_dept'];
}

//For showing all value in option for department
$quer="select distinct dept_name,dept_id from tbl_department_info";
$resul=mysql_query($quer);
	
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



		
		$query  = "update tbl_teacher_info set tch_dept=$dept,
					tch_name='$name',tch_father_name='$fname',
					tch_mother_name='$mname',tch_permanent_address='$per_add',tch_present_address='$pre_add',tch_contact_no=$std_cntc_no,tch_birth_date='$std_bdate',tch_gender='$gender',tch_nationality='$std_nation',tch_email='$std_email',tch_position='$std_pos',tch_qualification='$std_qlf',tch_id=$std_id where tch_id='$id'";

		$result =mysql_query($query);
		if($result)
		{
				//echo"successfully updated";
				echo '<script type="text/javascript">';
				echo 'alert("successfully Inserted!")';
				echo '</script>';
				header("location:teacher.php");
		}
		else
		{
					echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
		}
			
						
}
?>