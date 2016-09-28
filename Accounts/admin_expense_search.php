<?php 
	include('admin_header.php');
	
	$searchTTrackNo;
	$searchTMonth;
	$searchTYear;
	$tNo;
	$chequeNo;
	$amount;
	
	if(isset($_POST['tSearch']))
	{
		$searchTTrackNo = $_POST['searchTTrackNo'];		
		$searchTMonth = $_POST['searchTMonth'];		
		$searchTYear = $_POST['searchTYear'];	
		if(!empty($searchTTrackNo) && !empty($searchTMonth) && !empty($searchTYear))
		{
			$query = "SELECT * FROM teacher_trans WHERE tTrackNo='".mysql_real_escape_string($searchTTrackNo)."' AND month='".mysql_real_escape_string($searchTMonth)."' AND year='".mysql_real_escape_string($searchTYear)."'";
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$tNo = mysql_result($query_run, 0, 'tNo');
					$chequeNo = mysql_result($query_run, 0, 'chequeNo');
					$amount = mysql_result($query_run, 0, 'amount');
				}
				else
				{
					echo '<script type="text/javascript"> alert("Something worng!") 
				window.location.href="admin_expense.php"</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something worng!") 
			window.location.href="admin_expense.php"</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_expense.php"</script>';
		}
	}
	
	if(isset($_POST['edit']))
	{
		$tTrackNo = $_POST['tTrackNo'];		
		$tChequeNo = $_POST['tChequeNo'];		
		$tMonth = $_POST['tMonth'];	
		$tYear = $_POST['tYear'];	
		$tAmount = $_POST['tAmount'];	
		$transNo = $_POST['transNo'];	
		
		if(!empty($tTrackNo) && !empty($tChequeNo) && !empty($tMonth)&& !empty($tYear)&& !empty($tAmount))
		{
			$time = time();
			$date = date('Y-m-d', $time);
			
			$transBy = $_SESSION['sessionUsername'];
			
			$query = "UPDATE all_transactions SET date='".mysql_real_escape_string($date)."',amount='".mysql_real_escape_string($tAmount)."',transBy='".mysql_real_escape_string($transBy)."' WHERE tNo='".mysql_real_escape_string($transNo)."'";
			
			$query1 = "UPDATE teacher_trans SET tTrackNo='".mysql_real_escape_string($tTrackNo)."',chequeNo='".mysql_real_escape_string($tChequeNo)."',month='".mysql_real_escape_string($tMonth)."',year='".mysql_real_escape_string($tYear)."',amount='".mysql_real_escape_string($tAmount)."' WHERE tNo='".mysql_real_escape_string($transNo)."'";
			
			if($query_run = mysql_query($query) && $query_run1 = mysql_query($query1))
			{
				echo '<script type="text/javascript"> alert("Transaction updated!") 
					window.location.href="admin_expense.php"</script>';
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng!") 
					window.location.href="admin_expense.php"</script>';
			}
		}
	}
?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Other Income Search Result</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="alert alert-info"><strong>Teacher Expense Search</strong></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
                     <div class="panel panel-default" style="padding: 10px 10px;">
                        
							<form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input value="<?php 
									if(isset($_POST['tSearch']))
										echo $searchTTrackNo; 
									else
										echo '';
										?>" type="text" class="form-control" name="tTrackNo">
                                 </div>
                                 <br>
                                 					
                                 <div class="form_sep">
                                    <label>Cheque No<span style="color:red">*</span></label>
                                    <input value="<?php 
									if(isset($_POST['tSearch']))
										echo $chequeNo;
									else
										echo '';
									 ?>" type="text" class="form-control" name="tChequeNo">
                                 </div>
                                 <br>
                                 				
                                 <div class="form_sep">
                                    <label>Month <span style="color:red">*</span></label>
                                    <select class="form-control" name="tMonth" id="course">
                                       <option value="<?php
									if(isset($_POST['tSearch']))
										echo $searchTMonth;
									else
										echo '';  ?>" selected><?php
									if(isset($_POST['tSearch']))
										echo $searchTMonth;
									else
										echo '';  ?></option>
                                       <option value="January">January</option>
                                       <option value="February">February</option>
                                       <option value="March">March</option>
                                       <option value="April">April</option>
                                       <option value="May">May</option>
                                       <option value="June">June</option>
                                       <option value="July">July</option>
                                       <option value="August">August</option>
                                       <option value="September">September</option>
                                       <option value="October">October</option>
                                       <option value="November">November</option>
                                       <option value="December">December</option>
                                    </select>
                                 </div>
                                 <br>
                                 <div class="form_sep">
                                    <label>Year <span style="color:red">*</span></label>
                                    <select class="form-control" name="tYear" id="course">
                                       <option value="<?php 
										if(isset($_POST['tSearch']))
											echo $searchTYear;
										else
											echo '';
									    ?>" selected><?php 
										if(isset($_POST['tSearch']))
											echo $searchTYear;
										else
											echo '';
									    ?></option>
                                       <option value="2011">2011</option>
                                       <option value="2012">2012</option>
                                       <option value="2013">2013</option>
                                       <option value="2014">2014</option>
                                       <option value="2015">2015</option>
                                       <option value="2016">2016</option>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Amount<span style="color:red">*</span></label>
                                    <input value="<?php 
										if(isset($_POST['tSearch']))
											echo $amount;
										else
											echo '';
									 ?>" type="text" class="form-control" name="tAmount">
                                    
                                 </div>
                                 <br>
								 <input hidden type="text" name="transNo" value=" <?php echo $tNo; ?> "/>
								 
								 <button type="submit" name="edit" class="btn btn-primary btn-lg fa fa-edit" style="margin-top: 15px;">&nbsp;Edit</button>
							</form>
                     </div>
            </div>
         </div>
      </div>
	   <script>
					$(function() {
					$( "#datepicker1" ).datepicker();
					$( "#datepicker2" ).datepicker();
					});
					</script>
     <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>