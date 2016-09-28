<?php
	require "db_connection.php";
	require "init.php";
	loggedin();
	if(isset($_REQUEST['id'])) 
{
	$id = $_REQUEST['id'];
}


$query="select * from tbl_student_info where std_id='$id'";
$result=mysql_query($query);
while($row = mysql_fetch_array($result))
{	
		$imgpath=$row['std_pic'];
		$dept=$row['std_dept'];
		$prog=$row['std_program'];
		$name=$row['std_name'];
		$fname=$row['std_father_name'];
		$mname=$row['std_mother_name'];
		$gname=$row['std_guardian_name'];
		$per_add=$row['std_permanent_address'];
		$pre_add=$row['std_present_address'];
		$std_cntc_no=$row['std_contact_no'];
		$std_gcntc_no=$row['std_guardian_contact_no'];
		$std_bdate=$row['std_birth_date'];
		$gender=$row['std_gender'];
		$std_nation=$row['std_nationality'];
		$std_ssc_rslt=$row['std_ssc_result'];
		$std_hsc_rslt=$row['std_hsc_result'];
		$std_email=$row['std_email'];
		$std_total_gpa=$row['std_total_result'];
		$std_active=$row['std_active'];
		$std_waiver=$row['std_waiver'];
		$std_batch=$row['std_batch'];
		$std_id = $row['std_id'];
		
}	

//For seleecting dept value and name
$abc="select *  from tbl_student_info t1 join  tbl_department_info t2 on t1.std_dept=t2.dept_id where std_id='$std_id'";
$def=mysql_query($abc);
while($rimon = mysql_fetch_array($def))
{
	$dept_id=$rimon['dept_id'];
	$dept_name=$rimon['dept_name'];
	$dept=$rimon['std_dept'];
}

//For showing all value in option for department
$quer="select distinct dept_name,dept_id from tbl_department_info";
$resul=mysql_query($quer);
	

//For seleecting program value and name
$xyz="select * from tbl_student_info t1 join tbl_department_info t2 on t1.std_program=t2.dept_program_name and t1.std_dept=t2.dept_id  where std_id='$std_id'";
$mno=mysql_query($xyz);
while($muhib = mysql_fetch_array($mno))
{
	$program_id=$muhib['std_dept'];
	$program_program_name=$muhib['dept_program_name'];
	$program=$muhib['std_program'];
}

//For showing all value in option program
$q="select * from tbl_department_info";
$res=mysql_query($q);

	
	if(isset($_POST['add_std_submit']))
{

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
		$std_batch= htmlentities(isset($_POST['txt_std_batch'])?$_POST['txt_std_batch']:null);
		$std_waiver= htmlentities(isset($_POST['txt_std_waiver'])?$_POST['txt_std_waiver']:null);
		$std_id= htmlentities(isset($_POST['txt_std_id'])?$_POST['txt_std_id']:null);

		if($std_gender==1)
		{
			$gender="Male";
		}
		if($std_gender==2)
		{
			$gender="Female";
		}



		
		$query  = "update tbl_student_info set std_dept=$dept,
					std_program='$prog',std_name='$name',std_father_name='$fname',
					std_mother_name='$mname',std_guardian_name='$gname',
					std_permanent_address='$per_add',std_present_address='$pre_add',
					std_contact_no=$std_cntc_no,std_guardian_contact_no=$std_gcntc_no,
					std_birth_date='$std_bdate',std_gender='$gender',std_nationality='$std_nation',
					std_ssc_result=$std_ssc_rslt,std_hsc_result=$std_hsc_rslt,std_email='$std_email',
					std_batch=$std_batch,std_waiver=$std_waiver,std_id=$std_id where std_id='$id'";

		$result =mysql_query($query);
		if($result)
		{
				//echo"successfully updated";
				
				echo '<script type="text/javascript">';
				echo 'alert("successfully Inserted!")';
				echo '</script>';
				header("location:admin.php");
		}
		else
		{
					echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
		}
			
						
}
?>