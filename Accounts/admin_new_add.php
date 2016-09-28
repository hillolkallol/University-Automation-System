<?php 
	include('admin_header.php');

	$admiFee = '';
	$libSeFee = '';
	$traFee = '';
	$cerFee = '';

	$querry="SELECT * FROM manage_fees WHERE 1";
	$querry_run = mysql_query($querry);
	$admiFee = mysql_result($querry_run, 0, 'adFee'); 	 	 	 
	$libSeFee = mysql_result($querry_run, 0, 'librarySFee');
	$traFee = mysql_result($querry_run, 0, 'trncptFee');
	$cerFee = mysql_result($querry_run, 0, 'certiFee');
	
	/*
	if(isset($_POST['createTeacher']))
	{
		$tFName = $_POST['tFName'];		
		$tLName = $_POST['tLName'];		
		$tDept = $_POST['tDept'];	
		$tPosition = $_POST['tPosition'];	
		$tSalary = $_POST['tSalary'];	
		
		if(!empty($tFName) && !empty($tLName) && !empty($tDept)&& !empty($tPosition)&& !empty($tSalary))
		{
			$query = "SELECT * FROM teacher_info ORDER BY tTrackNo DESC";	
			if($query_run = mysql_query($query))
			{
				$tTrackNo = mysql_result($query_run, 0, 'tTrackNo');
				$tTrackNo++;
				
				$query1 = "INSERT INTO teacher_info(tTrackNo, tFName, tLName, dept, position, salary) VALUES ('".mysql_real_escape_string($tTrackNo)."','".mysql_real_escape_string($tFName)."','".mysql_real_escape_string($tLName)."','".mysql_real_escape_string($tDept)."','".mysql_real_escape_string($tPosition)."','".mysql_real_escape_string($tSalary)."')";
				
				if($query_run1 = mysql_query($query1))
				{
					echo '<script type="text/javascript"> alert("New teacher added and teacher\'s track no is: '.$tTrackNo.'!") </script>';
					
					echo '<script type="text/javascript"> alert("Again be sure that track no is: '.$tTrackNo.'! Memorize it very carefullty!") </script>';
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
					
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng2!") </script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") </script>';
		}
	}
	
	if(isset($_POST['createEmployee']))
	{
		$eFName = $_POST['eFName'];		
		$eLName = $_POST['eLName'];		
		$ePosition = $_POST['ePosition'];	
		$eSalary = $_POST['eSalary'];	
		
		if(!empty($eFName) && !empty($eLName) && !empty($ePosition)&& !empty($eSalary))
		{
			$query = "SELECT * FROM employee_info ORDER BY eTrackNo DESC";	
			if($query_run = mysql_query($query))
			{
				$eTrackNo = mysql_result($query_run, 0, 'eTrackNo');
				$eTrackNo++;
				
				$query1 = "INSERT INTO employee_info(eTrackNo, eFName, eLName, position, salary) VALUES ('".mysql_real_escape_string($eTrackNo)."','".mysql_real_escape_string($eFName)."','".mysql_real_escape_string($eLName)."','".mysql_real_escape_string($ePosition)."','".mysql_real_escape_string($eSalary)."')";
				
				if($query_run1 = mysql_query($query1))
				{
					echo '<script type="text/javascript"> alert("New teacher added and teacher\'s track no is: '.$eTrackNo.'!") </script>';
					
					echo '<script type="text/javascript"> alert("Again be sure that track no is: '.$eTrackNo.'! Memorize it very carefullty!") </script>';
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
					
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng2!") </script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") </script>';
		}
	}*/
	
	if(isset($_POST['saveRegDate']))
	{
		$regSeason = $_POST['regSeason'];		
		$regYear = $_POST['regYear'];		
		$regDept = $_POST['regDept'];	
		$LDReg = $_POST['LDReg'];	
		$LD1000 = $_POST['LD1000'];	
		$LD50percent = $_POST['LD50percent'];	
		
		if(!empty($regSeason) && !empty($regYear) && !empty($regDept)&& !empty($LDReg)&& !empty($LD1000)&& !empty($LD50percent))
		{
			
				$query = "INSERT INTO reg_dates(season, year, dept, lastDate, fine1000Date, fineHalfDate) VALUES ('".mysql_real_escape_string($regSeason)."','".mysql_real_escape_string($regYear)."','".mysql_real_escape_string($regDept)."','".mysql_real_escape_string($LDReg)."','".mysql_real_escape_string($LD1000)."','".mysql_real_escape_string($LD50percent)."')";
				
				if($query_run = mysql_query($query))
				{
					echo '<script type="text/javascript"> alert("Registration date saved!") </script>';
					
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
					
				}
			
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") </script>';
		}
	}
	
	
	
	if(isset($_POST['manageFees']))
	{
		$fAddFee = $_POST['fAddFee'];	
		$fLSFee = $_POST['fLSFee'];	
		$fTransFee = $_POST['fTransFee'];	
		$fCertiFee = $_POST['fCertiFee'];	

		$query0="SELECT * FROM manage_fees";
		if($query_run0 = mysql_query($query0))
		{
			if(mysql_num_rows($query_run0)==1)
			{
				$query = "UPDATE manage_fees SET adFee='".mysql_real_escape_string($fAddFee)."',librarySFee='".mysql_real_escape_string($fLSFee)."',trncptFee='".mysql_real_escape_string($fTransFee)."',certiFee='".mysql_real_escape_string($fCertiFee)."' WHERE 1";
				
				if($query_run = mysql_query($query))
				{
					echo '<script type="text/javascript"> alert("New Fees saved!") </script>';
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
				}
			}
			else
			{
				$query = "INSERT INTO manage_fees(adFee, librarySFee, trncptFee, certiFee) VALUES ('".mysql_real_escape_string($fAddFee)."','".mysql_real_escape_string($fLSFee)."','".mysql_real_escape_string($fTransFee)."','".mysql_real_escape_string($fCertiFee)."')";
				
				if($query_run = mysql_query($query))
				{
					echo '<script type="text/javascript"> alert("New Fees saved!") </script>';
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
				}
			}
		}
				
	}


	if(isset($_POST['manageRegFees']))
	{
		$fBatch = $_POST['fBatch'];		
		$fDept = $_POST['fDept'];		
		$fCreditFee = $_POST['fCreditFee'];		
		$fAcDevFee = $_POST['fAcDevFee'];	
		$fSemFee = $_POST['fSemFee'];
		$fLabFee = $_POST['fLabFee'];	
		$fMEFee = $_POST['fMEFee'];	
		
				$query = "INSERT INTO manage_reg_fees(batch, dept, semFee, creditFee, actDevFee, labFee, makeUpFee) VALUES ('".mysql_real_escape_string($fBatch)."','".mysql_real_escape_string($fDept)."','".mysql_real_escape_string($fSemFee)."','".mysql_real_escape_string($fCreditFee)."','".mysql_real_escape_string($fAcDevFee)."','".mysql_real_escape_string($fLabFee)."','".mysql_real_escape_string($fMEFee)."')";
				
				if($query_run = mysql_query($query))
				{
					echo '<script type="text/javascript"> alert("New Fees saved!") </script>';
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something Worng!") </script>';
				}

	}
?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.html"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Settings</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
			<div class="col-md-12">
            <div class="tabs">
               <ul id="myTab" class="nav nav-tabs" role="tablist" style="margin-bottom: 30px;">
                 <!-- <li class="active"><a href="#add_teacher" role="tab" data-toggle="tab">Add New Teacher</a></li>
                  <li class=""><a href="#add_employee" role="tab" data-toggle="tab">Add New Employee</a></li>-->
                  <li class="active"><a href="#last_date" role="tab" data-toggle="tab">Last Date Of Registration</a></li>
                  <li class=""><a href="#add_fee" role="tab" data-toggle="tab">Manage Fees</a></li>
                  <li class=""><a href="#reg_fee" role="tab" data-toggle="tab">Manage Registration Fees</a></li>
               </ul>
               <div class="tab-content" id="myTabContent">
               	<!--
                  <div id="add_teacher" class="tab-pane fade active in">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Teacher Details</h4>
                              </div>
                              <div class="panel-body">
								<form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>First Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="tFName">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Last Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="tLName">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select id="course" name="tDept" class="form-control">
                                       <option value="BBA">BBA</option>
                                       <option value="CSE">CSE</option>
                                       <option value="LLB">LLB</option>
                                       <option value="ARCH">ARCH</option>
                                       <option value="CIVIL">CIVIL</option>
                                       <option value="EEE">EEE</option>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Position <span style="color:red">*</span></label>
                                    <select id="course" name="tPosition" class="form-control">
                                       <option value="Junior Lecturer">Junior Lecturer</option>
                                       <option value="Senior Lecturer">Senior Lecturer</option>
                                       <option value="Guest Lecturer">Guest Lecturer</option>
                                       <option value="Assistant Professor">Assistant Professor</option>
                                       <option value="Associate Professor">Associate Professor</option>
                                       <option value="Head Of Department">Head Of Department</option>
                                       <option value="Pro Vice Chancellor">Pro Vice Chancellor</option>
                                       <option value="Vice Chancellor">Vice Chancellor</option>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Salary<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="tSalary">
                                 </div>
                                 <br />
                                 <button name="createTeacher" type="submit" class="btn btn-primary fa fa-save">&nbsp;Create</button>
								</form>
                              </div>
                           </div>
                           </div>
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title ">Search Teacher</h4>
                              </div>
                              <div class="panel-body">
							  <form action="admin_search_new_teacher.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input type="text" id="std_number" name="tSearchTrackNo" class="form-control">
                                 </div>
                                 <br>
                                 <button type="submit" class="btn btn-primary fa fa-search" name="teacherSearch" id="std_reg_submit">&nbsp;Search</button>
								</form>
                              </div>
                           </div>
                        </div>
						</div>
                     </div>
                  <div id="add_employee" class="tab-pane">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Employee Details</h4>
                              </div>
                              <div class="panel-body">
								<form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>First Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eFName">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Last Name<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eLName">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Position <span style="color:red">*</span></label>
                                    <select id="course" name="ePosition" class="form-control">
                                       <option value="Junior Officer">Junior Officer</option>
                                       <option value="Senior Officer">Senior Officer</option>
                                       <option value="Official Staff">Official Staff</option>
                                       <option value="Department Staff">Department Staff</option>
                                       <option value="Security Guard">Security Guard</option>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Salary<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eSalary">
                                 </div>
                                 <br />
                                 <button name="createEmployee" type="submit" class="btn btn-primary fa fa-save">&nbsp;Create</button>
								</form>
                              </div>
                           </div>
                           </div>							
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title ">Search Employee</h4>
                              </div>
                              <div class="panel-body">
							  <form action="admin_search_new_employee.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input type="text" id="std_number" name="eSearchTrackNo" class="form-control">
                                 </div>
                                 <br>
                                 <button class="btn btn-primary fa fa-search" type="submit" name="employeeSearch" id="std_reg_submit">&nbsp;Search</button>
								 </form>
                              </div>
                           </div>
                        </div>
						</div>
                     </div>
                 -->
					 <div id="last_date" class="tab-pane fade active in">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Last Date Of Registration</h4>
                              </div>
                              <div class="panel-body">
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                <div class="form_sep">
                                    <label>Session</label>
                                    <select required class="form-control" name="regSeason" id="course">
                                    	<option></option>
                                       <option value="Spring">Spring</option>
                                       <option value="Summer">Summer</option>
                                       <option value="Fall">Fall</option>
                                    </select>
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Year</label>
                                    <select required class="form-control" name="regYear" id="course">
                                    	<option></option>
                                       <option value="2018">2018</option>
                                       <option value="2017">2017</option>
                                       <option value="2016">2016</option>
                                       <option value="2015">2015</option>
                                       <option value="2014">2014</option>
                                       <option value="2013">2013</option>
                                       <option value="2012">2012</option>
                                       <option value="2011">2011</option>
                                       <option value="2010">2010</option>
                                       <option value="2009">2009</option>
                                    </select>
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select required id="course" name="regDept" class="form-control">
                                       <option></option>
                                       <?php
										$query = "SELECT * FROM tbl_department_info";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['dept_id'];
												?>"> 
												<?php echo $query_row['dept_name']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                 </div>
                                 <br />
								<div class="form_sep">
                                    <label>Last Date Of Registration<span style="color:red">*</span></label>
                                     <input style="width:100%" name="LDReg" id="datepicker1" type="time" class="form-control" placeholder="Click Here..." required="required">
                                </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Last Date Of TK 1000 Late Fee<span style="color:red">*</span></label>
                                     <input style="width:100%"  name="LD1000" id="datepicker3" type="time" class="form-control" required="required" placeholder="Click Here...">
                                </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Last Date Of 50% Admission Fee as Late Fee<span style="color:red">*</span></label>
                                     <input style="width:100%"  name="LD50percent" id="datepicker4" type="time" class="form-control" required="required" placeholder="Click Here...">
                                </div>
                                 <br />
                                 <button name="saveRegDate" type="submit" class="btn btn-primary fa fa-save">&nbsp;Save</button>
								</form>
                              </div>
                           </div>
                           </div>							
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title ">Search Registration Date</h4>
                              </div>
                              <div class="panel-body">
							  <form action="admin_search_reg_date.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                <div class="form_sep">
                                    <label>Season</label>
                                    <select required class="form-control" name="regSearchSeason" id="course">
                                    	<option></option>
                                       <option value="Spring">Spring</option>
                                       <option value="Summer">Summer</option>
                                       <option value="Fall">Fall</option>
                                    </select>
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Year</label>
                                    <select required class="form-control" name="regSearchYear" id="course" required="required">
                                    	<option></option>
                                       <option value="2018">2018</option>
                                       <option value="2017">2017</option>
                                       <option value="2016">2016</option>
                                       <option value="2015">2015</option>
                                       <option value="2014">2014</option>
                                       <option value="2013">2013</option>
                                       <option value="2012">2012</option>
                                       <option value="2011">2011</option>
                                       <option value="2010">2010</option>
                                       <option value="2009">2009</option>
                                    </select>
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select required id="course" name="regSearchDept" class="form-control" required="required">
                                       <option></option>
                                       <?php
										$query = "SELECT * FROM tbl_department_info";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['dept_id'];
												?>"> 
												<?php echo $query_row['dept_name']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                 </div>
                                 <br />
                                 <button class="btn btn-success fa fa-search" type="submit" name="regSearch" id="std_reg_submit">&nbsp;Search</button>
								 </form>
                              </div>
                           </div>
                        </div>
						</div>
                     </div>
					 <div id="add_fee" class="tab-pane">
                     <div class="row">
                     	<div class="col-md-3">
	                           
	                    </div>
                        <div class="col-md-6">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Manage Fees</h4>
                              </div>
                              <div class="panel-body">
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 
                                 <div class="form_sep">
                                    <label>Admission Fee<span style="color:red">*</span></label>
                                    <input value="<?php echo $admiFee; ?>" type="text" class="form-control" name="fAddFee" required="required">
                                 </div>
                                 <br>
								 <div class="form_sep">
                                    <label>Library Security Fee<span style="color:red">*</span></label>
                                    <input value="<?php echo $libSeFee; ?>" type="text" class="form-control" name="fLSFee" required="required">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Transcript Fee<span style="color:red">*</span></label>
                                    <input value="<?php echo $traFee; ?>" type="text" class="form-control" name="fTransFee" required="required">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Certificate Fee<span style="color:red">*</span></label>
                                    <input value="<?php echo $cerFee; ?>" type="text" class="form-control" name="fCertiFee" required="required">
                                 </div>
                                 <br />
								 
                                 <button name="manageFees" type="submit" class="btn btn-primary fa fa-save">&nbsp;Save</button>
								</form>								 
                              </div>
                           </div>
                           </div>							
	                        <div class="col-md-3">
	                           
	                        </div>
						</div>
                     </div>
                     <div id="reg_fee" class="tab-pane">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Manage Registration Fees</h4>
                              </div>
                              <div class="panel-body">
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Batch<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fBatch" required="required">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select id="course" name="fDept" class="form-control" required="required">
                                       <option></option>
                                       <?php
										$query = "SELECT * FROM tbl_department_info";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['dept_id'];
												?>"> 
												<?php echo $query_row['dept_name']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Credit Fee<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fCreditFee" required="required">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Semester Fee<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fSemFee" required="required">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Activity and Development Fee<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fAcDevFee" required="required">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Lab Fee<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fLabFee">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Makeup Exam Fee<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="fMEFee" required="required">
                                 </div>
                                 <br />
                                 <button name="manageRegFees" type="submit" class="btn btn-primary fa fa-save">&nbsp;Save</button>
								</form>								 
                              </div>
                           </div>
                           </div>							
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title ">Search Registration Fees</h4>
                              </div>
                              <div class="panel-body">
                                 <form action="admin_search_fees_list.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>batch<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="searchFBatch" required="required">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select id="course" name="searchFDept" class="form-control" required="required">
                                       <option></option>
                                       <?php
										$query = "SELECT * FROM tbl_department_info";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['dept_id'];
												?>"> 
												<?php echo $query_row['dept_name']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                 </div>
                                 <br />
                                 <button class="btn btn-success fa fa-search" type="submit" name="searchFees" id="std_reg_submit">&nbsp;Search</button>
								 </form>
                              </div>
                           </div>
                        </div>
						</div>
                     </div>


               </div>
            </div>
         </div>
      </div>
      </div>
      </div>
      </div>
      </div>
      </div>
	  <script>
		$(function() {
		$( "#datepicker1" ).datepicker({format: 'yyyy-mm-dd'});
		$( "#datepicker2" ).datepicker({format: 'yyyy-mm-dd'});
		$( "#datepicker3" ).datepicker({format: 'yyyy-mm-dd'});
		$( "#datepicker4" ).datepicker({format: 'yyyy-mm-dd'});
		});
		</script>
      <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>
