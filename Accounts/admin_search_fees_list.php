<?php 
	include('admin_header.php');
	$searchFBatch;
	$searchFDept;
	$creditFee;
	$adFee;
	$actDevFee;
	$librarySFee;
	$trncptFee;
	$certiFee;
	$makeUpFee;
	$semFee;
	$labFee;
	
	if(isset($_POST['searchFees']))
	{
		$searchFBatch = $_POST['searchFBatch'];
		$searchFDept = $_POST['searchFDept'];
		
		if(!empty($searchFBatch) && !empty($searchFDept))
		{
			$query = "SELECT * FROM manage_reg_fees WHERE batch='".mysql_real_escape_string($searchFBatch)."' AND dept='".mysql_real_escape_string($searchFDept)."'";
			
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$creditFee = mysql_result($query_run, 0, 'creditFee');
					$semFee = mysql_result($query_run, 0, 'semFee');
					$labFee = mysql_result($query_run, 0, 'labFee');
					$actDevFee = mysql_result($query_run, 0, 'actDevFee');
					$makeUpFee = mysql_result($query_run, 0, 'makeUpFee');
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
		$fBatch = $_POST['fBatch'];		
		$fDept = $_POST['fDept'];		
		$fCreditFee = $_POST['fCreditFee'];		
		$semFee = $_POST['semFee'];	
		$labFee = $_POST['labFee'];	
		$fAcDevFee = $_POST['fAcDevFee'];	
		$fMEFee = $_POST['fMEFee'];	
		$prevBatch = $_POST['prevBatch'];	
		$prevDept = $_POST['prevDept'];	
		
		if(!empty($fBatch) && !empty($fCreditFee) && !empty($fAcDevFee)&& !empty($semFee)&& !empty($fMEFee))
		{
			$query = "UPDATE manage_reg_fees SET batch='".mysql_real_escape_string($fBatch)."',dept='".mysql_real_escape_string($fDept)."',creditFee='".mysql_real_escape_string($fCreditFee)."',semFee='".mysql_real_escape_string($semFee)."',labFee='".mysql_real_escape_string($labFee)."',actDevFee='".mysql_real_escape_string($fAcDevFee)."',makeUpFee='".mysql_real_escape_string($fMEFee)."' WHERE batch='".mysql_real_escape_string($prevBatch)."' AND dept='".mysql_real_escape_string($prevDept)."'";
			
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
                                    <label>batch<span style="color:red">*</span></label>
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $searchFBatch;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="fBatch">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Department <span style="color:red">*</span></label>
                                    <select id="course" name="fDept" class="form-control">
                                       <option value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $searchFDept;
										}
										else
											echo 0;
											
									?>"><?php
										if(isset($_POST['searchFees']))
										{
											$query = "SELECT * FROM tbl_department_info WHERE dept_id='".$searchFDept."'";
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
										$query = "SELECT * FROM tbl_department_info WHERE dept_id != '".$searchFDept."'";
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
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $creditFee;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="fCreditFee">
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Semester Fee<span style="color:red">*</span></label>
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $semFee;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="semFee">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Activity and Development Fee<span style="color:red">*</span></label>
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $actDevFee;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="fAcDevFee">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Library Fee<span style="color:red">*</span></label>
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $labFee;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="labFee">
                                 </div>
                                 <br />
								 <div class="form_sep">
                                    <label>Makeup Exam Fee<span style="color:red">*</span></label>
                                    <input value="<?php
										if(isset($_POST['searchFees']))
										{
											echo $makeUpFee;
										}
										else
											echo 0;
											
									?>" type="text" class="form-control" name="fMEFee">
                                 </div>
                                 <br />
								 
								 <input hidden type="text" value="<?php echo $searchFBatch; ?>" name="prevBatch"/>
								 <input hidden type="text" value="<?php echo $searchFDept; ?>" name="prevDept"/>
								 
                                 <button name="edit" type="submit" class="btn btn-primary fa fa-save">&nbsp;Edit</button>
								</form>	
                              </div>
                           </div>
                        </div>
						<div class="col-md-2"></div>
		 </div>
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
		include('admin_footer.php');
	  ?>
   </body>
</html>
