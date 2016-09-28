<?php 
	include('admin_header.php');
	$regSearchSeason;
	$regSearchYear;
	$regSearchDept;
	$lastDate;
	$fine1000Date;
	$fineHalfDate;
	
	if(isset($_POST['regSearch']))
	{
		$regSearchSeason = $_POST['regSearchSeason'];
		$regSearchYear = $_POST['regSearchYear'];
		$regSearchDept = $_POST['regSearchDept'];
		
		if(!empty($regSearchSeason) && !empty($regSearchYear) && !empty($regSearchDept))
		{
			$query = "SELECT * FROM reg_dates WHERE season='".mysql_real_escape_string($regSearchSeason)."' AND year='".mysql_real_escape_string($regSearchYear)."' AND dept='".mysql_real_escape_string($regSearchDept)."'";
			
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$lastDate = mysql_result($query_run, 0, 'lastDate');
					$fine1000Date = mysql_result($query_run, 0, 'fine1000Date');
					$fineHalfDate = mysql_result($query_run, 0, 'fineHalfDate');
				}
				else
				{
					echo '<script type="text/javascript"> alert("Something worng!") 
				window.location.href="admin_new_add.php"</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something worng!") 
			window.location.href="admin_new_add.php"</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_new_add.php"</script>';
		}
	}
	
	if(isset($_POST['edit']))
	{
		$regSeason = $_POST['regSeason'];		
		$regYear = $_POST['regYear'];		
		$regDept = $_POST['regDept'];	
		$LDReg = $_POST['LDReg'];	
		$LD1000 = $_POST['LD1000'];	
		$LD50percent = $_POST['LD50percent'];
		$hideSeason = $_POST['hideSeason'];
		$hideYear = $_POST['hideYear'];
		$hideDept = $_POST['hideDept'];
		
		if(!empty($regSeason) && !empty($regYear) && !empty($regDept)&& !empty($LDReg)&& !empty($LD1000)&& !empty($LD50percent))
		{
			$query = "UPDATE reg_dates SET season='".mysql_real_escape_string($regSeason)."', year='".mysql_real_escape_string($regYear)."', dept='".mysql_real_escape_string($regDept)."', lastDate='".mysql_real_escape_string($LDReg)."', fine1000Date='".mysql_real_escape_string($LD1000)."', fineHalfDate='".mysql_real_escape_string($LD50percent)."' WHERE season='".mysql_real_escape_string($hideSeason)."' AND year='".mysql_real_escape_string($hideYear)."' AND dept='".mysql_real_escape_string($hideDept)."'";
			
			if($query_run = mysql_query($query))
			{
				echo '<script type="text/javascript"> alert("Transaction updated!") 
					window.location.href="admin_new_add.php"</script>';
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng!") 
					window.location.href="admin_new_add.php"</script>';
			}
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
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Update Registration Date Information</span>
               </div>
            </div>
         </div>        
		 <div class="row">
						<div class="col-md-2"></div>
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-body">
								<form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Season</label>
                                    <select class="form-control" name="regSeason" id="course">
                                       <option value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchSeason;
										}
										else
											echo 0;
									   ?>"><?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchSeason;
										}
										else
											echo 0;
									   ?></option>
                                       <option value="Spring">Spring</option>
                                       <option value="Summer">Summer</option>
                                       <option value="Fall">Fall</option>
                                    </select>
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Year</label>
                                    <select class="form-control" name="regYear" id="course">
                                       <option value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchYear;
										}
										else
											echo 0;
									   ?>"><?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchYear;
										}
										else
											echo 0;
									   ?></option>
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
                                    <select id="course" name="regDept" class="form-control">
                                       <option value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchDept;
										}
										else
											echo 0;
									   ?>"><?php
										if(isset($_POST['regSearch']))
										{
											$query = "SELECT * FROM tbl_department_info WHERE dept_id='".$regSearchDept."'";
											if($query_run = mysql_query($query))
											{
												$dept_name = mysql_result($query_run, 0, 'dept_name');
												echo $dept_name;
											}
										}
										else
											echo '';
									   ?></option>

                                       <?php
										$query = "SELECT * FROM tbl_department_info WHERE dept_id != '".$regSearchDept."'";
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
                                     <input style="width:100%" name="LDReg" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $lastDate;
										}
										else
											echo 0;
									   ?>" id="datepicker1" type="time" class="form-control" placeholder="Click Here...">
                                </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Last Date Of TK 1000 Late Fee<span style="color:red">*</span></label>
                                     <input style="width:100%"  name="LD1000" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $fine1000Date;
										}
										else
											echo 0;
									   ?>" id="datepicker3" type="time" class="form-control" placeholder="Click Here...">
                                </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Last Date Of 50% Admission Fee as Late Fee<span style="color:red">*</span></label>
                                     <input style="width:100%"  name="LD50percent" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $fineHalfDate;
										}
										else
											echo 0;
									   ?>" id="datepicker4" type="time" class="form-control" placeholder="Click Here...">
                                </div>
                                 <br />
								 
                                       <input hidden name="hideSeason" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchSeason;
										}
										else
											echo 0;
									   ?>" />
                                       
                                       <input hidden name="hideYear" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchYear;
										}
										else
											echo 0;
									   ?>" >
                                       <input hidden name="hideDept" value="<?php
										if(isset($_POST['regSearch']))
										{
											echo $regSearchDept;
										}
										else
											echo 0;
									   ?>" />
								 
                                 <button name="edit" type="submit" class="btn btn-primary fa fa-save">&nbsp;Edit</button>
								</form>
                              </div>
                           </div>
                        </div>
						<div class="col-md-2"></div>
		 </div>
		 <script>
		$(function() {
		$( "#datepicker1" ).datepicker({format: 'yyyy/mm/dd'});
		$( "#datepicker2" ).datepicker({format: 'yyyy/mm/dd'});
		$( "#datepicker3" ).datepicker({format: 'yyyy/mm/dd'});
		$( "#datepicker4" ).datepicker({format: 'yyyy/mm/dd'});
		});
		</script>
      <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>
