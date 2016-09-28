<?php

require 'connect.conf.php';
require 'core.inc.php';

/////generate starts
	$studentId;
	$dept;
	$Program;
	$payCategory;
	$season;
	$year;
	$totalPayable = 0;
	$adFee;
	$regularCredit;
	$regularCreditFee;
	$retakeCredit;
	$retakeCreditFee;
	$labFee;
	$actDevFee;
	$librarySFee;
	$lateFee;
	$reAdFee;
	$trncptFee;
	$certiFee;
	$makeupFee;
	$othersFee =0;
	$previousDue;
	$totalPayable;

	$semFee;
	$labFee;
	$libraryFine;

	$keepingDue = 0;
	$totalPayingFee;
	$slipNo;
	$fill=0; //no student entered! invalid
	$printCount = 1;
	$creditFeePayment = 0;
	
	if(isset($_GET['generate']))
	{
		$studentId = $_GET['studentId'];
		$payCategory = $_GET['payCategory'];
		$season = $_GET['season'];
		$year = $_GET['year'];
		
		
		if(empty($studentId) || empty($payCategory))
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="student_fees.php"	</script>';
		}
		else
		{
			$printCount = 0;
			$query1 = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";	
			if($query_run1 = mysql_query($query1))
			{
						if(mysql_num_rows($query_run1)==1)
						{
							if($payCategory==2 || $payCategory==4 || $payCategory==5 || $payCategory==6 || $payCategory==7 || $payCategory==8)
							{
								//dont need course registration
								$fill=1; // valid
							}
							else
							{
								if($payCategory==1)
								{
									$queryFind="SELECT * FROM student_trans WHERE studentId='".$studentId."' AND season='".$season."' AND year='".$year."' AND activityFee > 0 AND status='1'";
									if($query_run_find = mysql_query($queryFind))
									{
										if(mysql_num_rows($query_run_find)==1)
										{
											$creditFeePayment = 1;

											$queryDue="SELECT * FROM due_history WHERE studentId='".$studentId."'";
											if($query_run_due = mysql_query($queryDue))
											{
												if(mysql_num_rows($query_run_due)==1)
												{
													$previousDue = mysql_result($query_run_due, 0, 'dueAmount');
												}
												else
												{
													$previousDue = 0;
												}
											}
										}
									}
								}
								// check registration
								$query = "SELECT * FROM tbl_course_registration WHERE student_id ='".mysql_real_escape_string($studentId)."' AND session ='".mysql_real_escape_string($season)."' AND reg_year = '".mysql_real_escape_string($year)."'";
								if($query_run = mysql_query($query))
								{
									if(mysql_num_rows($query_run)==1)
									{
										$fill=1; //valid	
									}
									else
									{
										echo '<script type="text/javascript"> alert("Student hasn\'t been registered yet!") 
												window.location.href="student_fees.php"	</script>';
										
									}
								}
							}
						}
						else
						{
							echo '<script type="text/javascript"> alert("Student not found!") 
								</script>';
						}
			}
		}
		
		
	}
//generate ends

// is set update starts
	/*
	if(isset($_POST['update']))
	{
		$payCategory = $_POST['payCategory'];
		$studentId = $_POST['studentId'];
		$dept = $_POST['dept'];
		$season = $_POST['season'];
		$year = $_POST['year'];
		$adFee = $_POST['adFee'];
		$regularCredit = $_POST['regularCredit'];
		$regularCreditFee = $_POST['regularCreditFee'];
		$retakeCredit = $_POST['retakeCredit'];
		$retakeCreditFee = $_POST['retakeCreditFee'];
		$actDevFee = $_POST['actDevFee'];
		$librarySFee = $_POST['librarySFee'];
		$lateFee = $_POST['lateFee'];
		$reAdFee = $_POST['reAdFee'];
		$trncptFee = $_POST['trncptFee'];
		$certiFee = $_POST['certiFee'];
		$makeupFee = $_POST['makeupFee'];
		$othersFee = $_POST['othersFee'];
		$previousDue = $_POST['previousDue'];
		$totalPayable = $_POST['totalPayable'];	
		$keepingDue = $_POST['keepingDue'];
		$totalPayingFee = $_POST['totalPayingFee'];
		$fill=1;
		$printCount = 0;
		
		if($keepingDue > $totalPayable/2)
		{
			echo '<script type="text/javascript">';
			echo 'alert("Due must be smaller than 50% of the total payable fee!")';
			echo '</script>';
		}
	}
// is set update ends
*/
// is set print starts
	if(isset($_POST['print']))
	{
		$payCategory = $_POST['payCategory'];
		$studentId = $_POST['studentId'];
		$dept = $_POST['dept'];
		$season = $_POST['season'];
		$year = $_POST['year'];
		$adFee = $_POST['adFee'];
		$regularCredit = $_POST['regularCredit'];
		$regularCreditFee = $_POST['regularCreditFee'];
		$retakeCredit = $_POST['retakeCredit'];
		$retakeCreditFee = $_POST['retakeCreditFee'];
		$actDevFee = $_POST['actDevFee'];
		$labFee = $_POST['labFee'];
		$semFee = $_POST['semFee'];
		$librarySFee = $_POST['librarySFee'];
		$lateFee = $_POST['lateFee'];
		$reAdFee = $_POST['reAdFee'];
		$trncptFee = $_POST['trncptFee'];
		$certiFee = $_POST['certiFee'];
		$makeupFee = $_POST['makeupFee'];
		$othersFee = $_POST['othersFee'];
		$previousDue = $_POST['previousDue'];
		$totalPayable = $_POST['totalPayable'];
		$keepingDue = $_POST['keepingDue'];
		$totalPayingFee = $_POST['totalPayingFee'];
		
		if($studentId!=0)
		{
			$query = "SELECT * FROM student_trans ORDER BY slipNo DESC";
			if($query_run = mysql_query($query))
			{
				$slipNo = mysql_result($query_run, 0, 'slipNo');
				$slipNo++;
			}
			else
			{
				$slipNo = 1;
			}
			
			
			$queryAgain = "INSERT INTO student_trans(slipNo, studentId, season, year, admissionFee, regularCredit, retakeCredit, activityFee, semFee, labFee, libraryFee, lateFee, reAdFee, transcriptFee, certificateFee, makeupFee, due, total, payCategory, status) VALUES ('".$slipNo."','".$studentId."','".$season."','".$year."','".$adFee."','".$regularCreditFee."','".$retakeCreditFee."','".$actDevFee."','".$semFee."','".$labFee."','".$librarySFee."','".$lateFee."','".$reAdFee."','".$trncptFee."','".$certiFee."','".$makeupFee."','".$keepingDue."','".$totalPayingFee."', '".$payCategory."' ,'0')";
			if($query_run = mysql_query($queryAgain))
			{
				echo '<script type="text/javascript"> alert("Informations have been saved into database!") 
					</script>';
			}
			else
			{
				//die(mysql_error());
				echo '<script type="text/javascript"> alert("Something Worng! Please try again") 
				window.location.href="student_fees.php"	</script>';
			}
		}
		else
		{
			$printCount= 1;
		}
	}
	// is set print ends

///////////////////// permission starts
	/*if(loggedin())
	{
		$accessCategory = $_SESSION['accessCategory'];
		if($accessCategory==2)
		{*/
////////////////////// permission working	
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
   <![endif]-->
   <!--[if IE 7]>         
   <html class="no-js lt-ie9 lt-ie8">
      <![endif]-->
      <!--[if IE 8]>         
      <html class="no-js lt-ie9">
         <![endif]-->
         <!--[if gt IE 8]><!--> 
         <html class="no-js">
            <!--<![endif]-->
            <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <title>Leading University | Admin Panel | Fees</title>
               <meta name="description" content="">
               <!-- Place favfa fa.ico and apple-touch-fa fa.png in the root directory -->
               <link rel="stylesheet" href="css/font-awesome.min.css">
               <link rel="stylesheet" href="css/bootstrap.min.css">
               <link rel="stylesheet" href="css/normalize.css">
               <link rel="stylesheet" href="css/main.css">
               <script src="js/vendor/modernizr-2.6.2.min.js"></script>
			   
			   
            </head>
            <body>
               <!--[if lt IE 7]>
               <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
               <![endif]-->
               <!-- Add your site or application content here -->
              
			  <div class="container" style="padding: 50px 0px;">
                  <div class="row" id="a">
                     <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
							
							<div class="col-md-3" style="border-right: 1px dashed black;">
								<div class="print_top" style="text-align: center; margin-bottom: 15px;">
									<div class="print_header">
										<img alt="" src="img/logo.png" style="float: left; width: 15%;">				
										<h1>LEADING UNIVERSITY</h1>
										<p>ADVICE FOR DEPOSIT ON ACCOUNT OF TUTION & OTHERS FEES</p>
									</div>
									<button class="btn btn-primary">University Copy </button>
								</div>
								<div class="form_sep">
                                    <p><b>Account No:</b> STD 13100000667<br><span style="font-size: 12px;">Southeast Bank Ltd. Laldigirpar Branch, Sylhet</span></p>
                                    
                                 </div>
                                 
                                 <div class="form_sep">
                                    <label>Slip No: </label>
                                    <label><?php
										$query = "SELECT * FROM student_trans ORDER BY slipNo DESC";
										if($query_run = mysql_query($query))
										{
											$slipNo = mysql_result($query_run, 0, 'slipNo');
											$slipNo++;
										}
										else
										{
											$slipNo=1;
										}
										
										echo $slipNo;
									?></label>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Student ID</label>
                                    <input type="text" name="studentId" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $studentId; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Program</label>
                                    <input type="text" name="dept" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{	
										$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
										$query_run = mysql_query($query);
										$dept = mysql_result($query_run, 0, 'std_dept');

										$query1 = "SELECT * FROM tbl_department_info WHERE dept_id ='".mysql_real_escape_string($dept)."'";
										$query_run1 = mysql_query($query1);
										$Program = mysql_result($query_run1, 0, 'dept_program_name');
										echo $Program;
									}		
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  				
                                 <div class="form_sep">
                                    <label>Season</label>
                                    <input type="text" name="season" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $season; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Year</label>
                                    <input type="text" name="year" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $year; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Admission Fee</label>
                                    <input type="text" name="adFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $adFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
												$query_run = mysql_query($query);
												$batch = mysql_result($query_run, 0, 'std_batch');
												$dept = mysql_result($query_run, 0, 'std_dept');
												
												$queryAgain = "SELECT * FROM manage_fees WHERE 1";
												$query_run_again = mysql_query($queryAgain);
												$adFee = mysql_result($query_run_again, 0, 'adFee');
												echo $adFee;
												
												$totalPayable = $totalPayable + $adFee;
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Regular Credit</label>
                                    <input type="text" name="regularCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_course_registration WHERE student_id ='".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$regularCredit = mysql_result($query_run, 0, 'reg_main_credit');
													
													echo $regularCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Regular Credit Fee</label>
                                    <input type="text" name="regularCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{												
													$query1 = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run1 = mysql_query($query1);
													$batch = mysql_result($query_run1, 0, 'std_batch');
													$dept = mysql_result($query_run1, 0, 'std_dept');
													
													$query2 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
													$query_run2 = mysql_query($query2);
													$creditFee = mysql_result($query_run2, 0, 'creditFee');
													
													$query3 = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run3 = mysql_query($query3);
													$waver = mysql_result($query_run3, 0, 'std_waiver');
													
													$regularCreditFee = ($regularCredit * $creditFee *(100-$waver))/100;
													echo $regularCreditFee;
													
													$totalPayable = $totalPayable + $regularCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit</label>
                                    <input type="text" name="retakeCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_course_registration WHERE student_id ='".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$retakeCredit = mysql_result($query_run, 0, 'reg_retake_credit');
													
													echo $retakeCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit Fee</label>
                                    <input type="text" name="retakeCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_course_registration WHERE student_id ='".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$retakeCredit = mysql_result($query_run, 0, 'reg_retake_credit');
													
													$query1 = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run1 = mysql_query($query1);
													$batch = mysql_result($query_run1, 0, 'std_batch');
													$dept = mysql_result($query_run1, 0, 'std_dept');
													
													
													$query2 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
													$query_run2 = mysql_query($query2);
													$creditFee = mysql_result($query_run2, 0, 'creditFee');
													
													$retakeCreditFee = ($retakeCredit * $creditFee);
													echo $retakeCreditFee;
													
													$totalPayable = $totalPayable + $retakeCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Student Activity &amp; Development Fee</label>
                                    <input type="text" name="actDevFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $actDevFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$batch = mysql_result($query_run, 0, 'std_batch');
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$actDevFee = mysql_result($query_run1, 0, 'actDevFee');
													echo $actDevFee;
													
													$totalPayable = $totalPayable + $actDevFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Semester Fee</label>
                                    <input type="text" name="semFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $semFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$batch = mysql_result($query_run, 0, 'std_batch');
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$semFee = mysql_result($query_run1, 0, 'semFee');
													echo $semFee;
													
													$totalPayable = $totalPayable + $semFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Lab Fee</label>
                                    <input type="text" name="labFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $labFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$batch = mysql_result($query_run, 0, 'std_batch');
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$labFee = mysql_result($query_run1, 0, 'labFee');
													echo $labFee;
													
													$totalPayable = $totalPayable + $labFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Library Security Fee</label>
                                    <input type="text" name="librarySFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $librarySFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
												$query_run = mysql_query($query);
												$batch = mysql_result($query_run, 0, 'std_batch');
												$dept = mysql_result($query_run, 0, 'std_dept');
												
												$query1 = "SELECT * FROM manage_fees WHERE 1";
												$query_run1 = mysql_query($query1);
												$librarySFee = mysql_result($query_run1, 0, 'librarySFee');
												echo $librarySFee;
												
												$totalPayable = $totalPayable + $librarySFee;
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Late Registration Fee</label>
                                    <input type="text" name="lateFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $lateFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$lastDate = mysql_result($query_run1, 0, 'lastDate');
													//$fine500Date = mysql_result($query_run1, 0, 'fine500Date');
													$fine1000Date = mysql_result($query_run1, 0, 'fine1000Date');
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate<= $lastDate)
													{
														$lateFee = 0;
														echo $lateFee;
														$totalPayable = $totalPayable + $lateFee;
													}
													else if($actualDate<= $fine1000Date)
													{
														$lateFee = 1000;
														echo $lateFee;
														$totalPayable = $totalPayable + $lateFee;
													}
													else if($actualDate<= $fineHalfDate)
													{
														$queryAgain = "SELECT * FROM manage_fees WHERE 1";
														$query_run_again = mysql_query($queryAgain);
														$adFee = mysql_result($query_run_again, 0, 'adFee');
														
														$lateFee = $adFee/2;
														echo $lateFee;
														$totalPayable = $totalPayable + $lateFee;
													}
													else if($actualDate> $fineHalfDate)
													{
														$lateFee = 'Re-Admission';
														echo $lateFee;
														
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Admission Fee</label>
                                    <input type="text" name="reAdFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $reAdFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate> $fineHalfDate)
													{
														$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
														$query_run = mysql_query($query);
														$batch = mysql_result($query_run, 0, 'std_batch');
														$dept = mysql_result($query_run, 0, 'std_dept');
														
														$queryAgain = "SELECT * FROM manage_fees WHERE 1";
														$query_run_again = mysql_query($queryAgain);
														$adFee = mysql_result($query_run_again, 0, 'adFee');

														$reAdFee = $adFee;
														echo $reAdFee;
														$totalPayable = $totalPayable + $reAdFee;
													}
													else
													{
														echo '';
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Transcript Fee</label>
                                   <input type="text" name="trncptFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $trncptFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '6')
											{
												$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
												$query_run = mysql_query($query);
												$batch = mysql_result($query_run, 0, 'std_batch');
												$dept = mysql_result($query_run, 0, 'std_dept');
												
												$query1 = "SELECT * FROM manage_fees WHERE 1";
												$query_run1 = mysql_query($query1);
												$trncptFee = mysql_result($query_run1, 0, 'trncptFee');
												echo $trncptFee;
												
												$totalPayable = $totalPayable + $trncptFee;
											}
											else
											{
												echo '';
											}
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Certificate Fee</label>
                                    <input type="text" name="certiFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $certiFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '7')
											{
												$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
												$query_run = mysql_query($query);
												$batch = mysql_result($query_run, 0, 'std_batch');
												$dept = mysql_result($query_run, 0, 'std_dept');
												
												$query1 = "SELECT * FROM manage_fees WHERE 1";
												$query_run1 = mysql_query($query1);
												$certiFee = mysql_result($query_run1, 0, 'certiFee');
												echo $certiFee;
												
												$totalPayable = $totalPayable + $certiFee;
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Make-up Exam Fee</label>
                                    <input type="text" name="makeupFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $makeupFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '3')
											{
												$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
												$query_run = mysql_query($query);
												$batch = mysql_result($query_run, 0, 'std_batch');
												$dept = mysql_result($query_run, 0, 'std_dept');
												
												$query1 = "SELECT * FROM manage_reg_fees WHERE batch ='".mysql_real_escape_string($batch)."' AND dept='".mysql_real_escape_string($dept)."'";
												$query_run1 = mysql_query($query1);
												$makeupFee = mysql_result($query_run1, 0, 'makeUpFee');
												echo $makeupFee;
												
												$totalPayable = $totalPayable + $makeupFee;
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Others Fee</label>
                                    <input type="text" name="othersFee" value="<?php 
									if(isset($_POST['update']))
									{
										$totalPayable = $totalPayable + $othersFee;
										echo $othersFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory == '4')
											{
												echo $othersFee = 0;
											}
											else
											{
												echo $othersFee = 0;
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Library Fine</label>
                                   <input type="text" name="libraryFine" value="<?php 
									if(isset($_POST['update']))
									{
										echo $libraryFine;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory==1 || $payCategory==8)
											{
												$query = "SELECT * FROM due_history WHERE studentId ='".mysql_real_escape_string($studentId)."'";
												if($query_run = mysql_query($query))
												{
													if(mysql_num_rows($query_run)>=1)
													{
														$libraryFine = mysql_result($query_run, 0, 'libraryFine');
														echo $libraryFine;
														
														$totalPayable = $totalPayable + $libraryFine;
													}
													else
													{
														echo $libraryFine = 0;
													}
												}
											}
											else
											{
												echo $libraryFine = '';
											}
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Previous Due</label>
                                   <input type="text" name="previousDue" value="<?php 
									if(isset($_POST['update']))
									{
										echo $previousDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory==1)
											{
												$query = "SELECT * FROM due_history WHERE studentId ='".mysql_real_escape_string($studentId)."'";
												if($query_run = mysql_query($query))
												{
													if(mysql_num_rows($query_run)==1)
													{
														$previousDue = mysql_result($query_run, 0, 'dueAmount');
														echo $previousDue;
														
														$totalPayable = $totalPayable + $previousDue;
													}
													else
													{
														echo $previousDue = 0;
													}
												}
											}
											else
											{
												echo $previousDue = '';
											}
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Total Payable Fee</label>
                                   <input type="text" name="totalPayable" value="<?php 
									if(isset($_POST['update']))
									{
										echo $totalPayable;
									}
									else
									{
										if(isset($_POST['update']))
										{
											echo $totalPayable;
										}
										else
										{
											if($fill==0)
											{
												echo 0;
											}
											else
											{
												echo $totalPayable; 
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Keeping Due</label>
                                   <input type="text" name="keepingDue" value="<?php 
									if(isset($_POST['update']))
									{
										if($keepingDue > $totalPayable/2)
										{
											$keepingDue = $totalPayable/2;
											
										}
										echo $keepingDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											echo 0; 
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Total Paying Fee</label>
                                   <input type="text" name="totalPayingFee" value="<?php 
									if(isset($_POST['update']))
									{
										$totalPayingFee = $totalPayable - $keepingDue;
										echo $totalPayingFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											$totalPayingFee = $totalPayable;
											echo $totalPayingFee; 
										}
									}
									?>" id="" class="form-control" placeholder="" readonly>
                                 </div>
								 
                            </div>
<!---------------------------------------------------------------------------------------------->							
							<div class="col-md-3" style="border-right: 1px dashed black;">
								<div class="print_top" style="text-align: center; margin-bottom: 15px;">
									<div class="print_header">
										<img alt="" src="img/logo.png" style="float: left; width: 15%;">				
										<h1>LEADING UNIVERSITY</h1>
										<p>ADVICE FOR DEPOSIT ON ACCOUNT OF TUTION & OTHERS FEES</p>
									</div>
									<button class="btn btn-primary">Bank Copy </button>
								</div>
								<div class="form_sep">
                                    <p><b>Account No:</b> STD 13100000667<br><span style="font-size: 12px;">Southeast Bank Ltd. Laldigirpar Branch, Sylhet</span></p>
                                    
                                 </div>
                                 
                                 <div class="form_sep">
                                    <label>Slip No: </label>
                                    <label><?php
										$query = "SELECT * FROM student_trans ORDER BY slipNo DESC";
										$query_run = mysql_query($query);
										$slipNo = mysql_result($query_run, 0, 'slipNo');
										$slipNo++;
										echo $slipNo;
									?></label>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Student ID</label>
                                    <input type="text" name="studentId" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $studentId; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Program</label>
                                    <input type="text" name="dept" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{	
										echo $Program;
									}		
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  				
                                 <div class="form_sep">
                                    <label>Season</label>
                                    <input type="text" name="season" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $season; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Year</label>
                                    <input type="text" name="year" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $year; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Admission Fee</label>
                                    <input type="text" name="adFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $adFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $adFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Regular Credit</label>
                                    <input type="text" name="regularCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $regularCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Regular Credit Fee</label>
                                    <input type="text" name="regularCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $regularCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit</label>
                                    <input type="text" name="retakeCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit Fee</label>
                                    <input type="text" name="retakeCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                                                   
                                 <div class="form_sep">
                                    <label>Student Activity &amp; Development Fee</label>
                                    <input type="text" name="actDevFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $actDevFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $actDevFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Semester Fee</label>
                                    <input type="text" name="semFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $semFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $semFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                  <div class="form_sep">
                                    <label>Lab Fee</label>
                                    <input type="text" name="labFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $labFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $labFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Library Security Fee</label>
                                    <input type="text" name="librarySFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $librarySFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $librarySFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Late Registration Fee</label>
                                    <input type="text" name="lateFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $lateFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$lastDate = mysql_result($query_run1, 0, 'lastDate');
													//$fine500Date = mysql_result($query_run1, 0, 'fine500Date');
													$fine1000Date = mysql_result($query_run1, 0, 'fine1000Date');
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate<= $lastDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fine1000Date)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate> $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}

											}
											else
											{
												echo '';
											}
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Admission Fee</label>
                                    <input type="text" name="reAdFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $reAdFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate> $fineHalfDate)
													{
														
														echo $reAdFee;
														
													}
													else
													{
														echo '';
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Transcript Fee</label>
                                   <input type="text" name="trncptFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $trncptFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '6')
											{
												
												echo $trncptFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Certificate Fee</label>
                                    <input type="text" name="certiFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $certiFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '7')
											{
												
												echo $certiFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Make-up Exam Fee</label>
                                    <input type="text" name="makeupFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $makeupFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '3')
											{
												
												echo $makeupFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Others Fee</label>
                                    <input type="text" name="othersFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $othersFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory == '4')
											{
												echo 0;
											}
											else
											{
												echo 0;
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  <div class="form_sep">
                                    <label>Library Fine</label>
                                   <input type="text" name="libraryFine" value="<?php 
									if(isset($_POST['update']))
									{
										echo $libraryFine;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $libraryFine;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Previous Due</label>
                                   <input type="text" name="previousDue" value="<?php 
									if(isset($_POST['update']))
									{
										echo $previousDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $previousDue;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Total Payable Fee</label>
                                   <input type="text" name="totalPayable" value="<?php 
									if(isset($_POST['update']))
									{
										echo $totalPayable;
									}
									else
									{
										if(isset($_POST['update']))
										{
											echo $totalPayable;
										}
										else
										{
											if($fill==0)
											{
												echo 0;
											}
											else
											{
												echo $totalPayable; 
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Keeping Due</label>
                                   <input type="text" name="keepingDue" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $keepingDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											echo 0; 
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Total Paying Fee</label>
                                   <input type="text" name="totalPayingFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $totalPayingFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $totalPayingFee; 
										}
									}
									?>" id="" class="form-control" placeholder="" readonly>
                                 </div>
								 
                            </div>
<!---------------------------------------------------------------------------------------->							
							<div class="col-md-3" style="border-right: 1px dashed black;">
								<div class="print_top" style="text-align: center; margin-bottom: 15px;">
									<div class="print_header">
										<img alt="" src="img/logo.png" style="float: left; width: 15%;">				
										<h1>LEADING UNIVERSITY</h1>
										<p>ADVICE FOR DEPOSIT ON ACCOUNT OF TUTION & OTHERS FEES</p>
									</div>
									<button class="btn btn-primary">Bank Copy </button>
								</div>
								<div class="form_sep">
                                    <p><b>Account No:</b> STD 13100000667<br><span style="font-size: 12px;">Southeast Bank Ltd. Laldigirpar Branch, Sylhet</span></p>
                                    
                                 </div>
                                 
                                 <div class="form_sep">
                                    <label>Slip No: </label>
                                    <label><?php
										$query = "SELECT * FROM student_trans ORDER BY slipNo DESC";
										$query_run = mysql_query($query);
										$slipNo = mysql_result($query_run, 0, 'slipNo');
										$slipNo++;
										echo $slipNo;
									?></label>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Student ID</label>
                                    <input type="text" name="studentId" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $studentId; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Program</label>
                                    <input type="text" name="dept" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{	
										echo $Program;
									}		
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  				
                                 <div class="form_sep">
                                    <label>Season</label>
                                    <input type="text" name="season" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $season; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Year</label>
                                    <input type="text" name="year" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $year; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Admission Fee</label>
                                    <input type="text" name="adFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $adFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $adFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Regular Credit</label>
                                    <input type="text" name="regularCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												
												if($creditFeePayment==0)
												{
													echo $regularCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Regular Credit Fee</label>
                                    <input type="text" name="regularCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $regularCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit</label>
                                    <input type="text" name="retakeCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit Fee</label>
                                    <input type="text" name="retakeCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                                                   
                                 <div class="form_sep">
                                    <label>Student Activity &amp; Development Fee</label>
                                    <input type="text" name="actDevFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $actDevFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $actDevFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Semester Fee</label>
                                    <input type="text" name="semFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $semFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $semFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                  <div class="form_sep">
                                    <label>Lab Fee</label>
                                    <input type="text" name="labFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $labFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $labFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Library Security Fee</label>
                                    <input type="text" name="librarySFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $librarySFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $librarySFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Late Registration Fee</label>
                                    <input type="text" name="lateFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $lateFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$lastDate = mysql_result($query_run1, 0, 'lastDate');
													//$fine500Date = mysql_result($query_run1, 0, 'fine500Date');
													$fine1000Date = mysql_result($query_run1, 0, 'fine1000Date');
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate<= $lastDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fine1000Date)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate> $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Admission Fee</label>
                                    <input type="text" name="reAdFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $reAdFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate> $fineHalfDate)
													{
														
														echo $reAdFee;
														
													}
													else
													{
														echo '';
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Transcript Fee</label>
                                   <input type="text" name="trncptFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $trncptFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '6')
											{
												
												echo $trncptFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Certificate Fee</label>
                                    <input type="text" name="certiFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $certiFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '7')
											{
												
												echo $certiFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Make-up Exam Fee</label>
                                    <input type="text" name="makeupFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $makeupFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '3')
											{
												
												echo $makeupFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Others Fee</label>
                                    <input type="text" name="othersFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $othersFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory == '4')
											{
												echo 0;
											}
											else
											{
												echo 0;
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  <div class="form_sep">
                                    <label>Library Fine</label>
                                   <input type="text" name="libraryFine" value="<?php 
									if(isset($_POST['update']))
									{
										echo $libraryFine;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $libraryFine;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Previous Due</label>
                                   <input type="text" name="previousDue" value="<?php 
									if(isset($_POST['update']))
									{
										echo $previousDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $previousDue;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Total Payable Fee</label>
                                   <input type="text" name="totalPayable" value="<?php 
									if(isset($_POST['update']))
									{
										echo $totalPayable;
									}
									else
									{
										if(isset($_POST['update']))
										{
											echo $totalPayable;
										}
										else
										{
											if($fill==0)
											{
												echo 0;
											}
											else
											{
												echo $totalPayable; 
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Keeping Due</label>
                                   <input type="text" name="keepingDue" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $keepingDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											echo 0; 
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Total Paying Fee</label>
                                   <input type="text" name="totalPayingFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $totalPayingFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $totalPayingFee; 
										}
									}
									?>" id="" class="form-control" placeholder="" readonly>
                                 </div>
								 
                            </div>
<!------------------------------------------------------------------------------------>							
							<div class="col-md-3">
								<div class="print_top" style="text-align: center; margin-bottom: 15px;">
									<div class="print_header">
										<img alt="" src="img/logo.png" style="float: left; width: 15%;">				
										<h1>LEADING UNIVERSITY</h1>
										<p>ADVICE FOR DEPOSIT ON ACCOUNT OF TUTION & OTHERS FEES</p>
									</div>
									<button class="btn btn-primary">Student Copy </button>
								</div>
								<div class="form_sep">
                                    <p><b>Account No:</b> STD 13100000667<br><span style="font-size: 12px;">Southeast Bank Ltd. Laldigirpar Branch, Sylhet</span></p>
                                    
                                 </div>
                                 
                                 <div class="form_sep">
                                    <label>Slip No: </label>
                                    <label><?php
										$query = "SELECT * FROM student_trans ORDER BY slipNo DESC";
										$query_run = mysql_query($query);
										$slipNo = mysql_result($query_run, 0, 'slipNo');
										$slipNo++;
										echo $slipNo;
									?></label>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Student ID</label>
                                    <input type="text" name="studentId" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $studentId; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Program</label>
                                    <input type="text" name="dept" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{	
										echo $Program;
									}		
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  				
                                 <div class="form_sep">
                                    <label>Season</label>
                                    <input type="text" name="season" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $season; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Year</label>
                                    <input type="text" name="year" value="<?php 
									if($fill==0)
									{
										echo '';
									}
									else
									{
										echo $year; 
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Admission Fee</label>
                                    <input type="text" name="adFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $adFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $adFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Regular Credit</label>
                                    <input type="text" name="regularCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												
												if($creditFeePayment==0)
												{
													echo $regularCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Regular Credit Fee</label>
                                    <input type="text" name="regularCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $regularCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $regularCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit</label>
                                    <input type="text" name="retakeCredit" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCredit;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCredit;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Take Credit Fee</label>
                                    <input type="text" name="retakeCreditFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $retakeCreditFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $retakeCreditFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                                                   
                                 <div class="form_sep">
                                    <label>Student Activity &amp; Development Fee</label>
                                    <input type="text" name="actDevFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $actDevFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $actDevFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Semester Fee</label>
                                    <input type="text" name="semFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $semFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $semFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                  <div class="form_sep">
                                    <label>Lab Fee</label>
                                    <input type="text" name="labFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $labFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													echo $labFee;
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
												
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>

                                 <div class="form_sep">
                                    <label>Library Security Fee</label>
                                    <input type="text" name="librarySFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $librarySFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '2')
											{
												
												echo $librarySFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Late Registration Fee</label>
                                    <input type="text" name="lateFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $lateFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$lastDate = mysql_result($query_run1, 0, 'lastDate');
													//$fine500Date = mysql_result($query_run1, 0, 'fine500Date');
													$fine1000Date = mysql_result($query_run1, 0, 'fine1000Date');
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate<= $lastDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fine1000Date)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate<= $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
													else if($actualDate> $fineHalfDate)
													{
														
														echo $lateFee;
														
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Re-Admission Fee</label>
                                    <input type="text" name="reAdFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $reAdFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '1')
											{
												if($creditFeePayment==0)
												{
													$time = time();
													$actualDate = date('Y-m-d', $time);
													
													$query = "SELECT * FROM tbl_student_info WHERE std_id ='".mysql_real_escape_string($studentId)."' OR std_auto_id = '".mysql_real_escape_string($studentId)."'";
													$query_run = mysql_query($query);
													$dept = mysql_result($query_run, 0, 'std_dept');
													
													$query1 = "SELECT * FROM reg_dates WHERE season ='".mysql_real_escape_string($season)."' AND year = '".mysql_real_escape_string($year)."' AND dept = '".mysql_real_escape_string($dept)."'";
													$query_run1 = mysql_query($query1);
													$fineHalfDate = mysql_result($query_run1, 0, 'fineHalfDate');
													
													if($actualDate> $fineHalfDate)
													{
														
														echo $reAdFee;
														
													}
													else
													{
														echo '';
													}
												}
												else
												{
													if($previousDue>0)
													{
														echo 'Partial Credit Fee Payment Slip';
													}
													
												}
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Transcript Fee</label>
                                   <input type="text" name="trncptFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $trncptFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{	
											if($payCategory == '6')
											{
												
												echo $trncptFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Certificate Fee</label>
                                    <input type="text" name="certiFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $certiFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '7')
											{
												
												echo $certiFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
                                 <div class="form_sep">
                                    <label>Make-up Exam Fee</label>
                                    <input type="text" name="makeupFee" value="<?php 
									if(isset($_POST['update']))
									{
										echo $makeupFee;
									}
									else
									{
										if($fill==0)
										{
											echo '';
										}
										else
										{
											if($payCategory == '3')
											{
												
												echo $makeupFee;
												
											}
											else
											{
												echo '';
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  
								 <div class="form_sep">
                                    <label>Others Fee</label>
                                    <input type="text" name="othersFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $othersFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											if($payCategory == '4')
											{
												echo 0;
											}
											else
											{
												echo 0;
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
                                  <div class="form_sep">
                                    <label>Library Fine</label>
                                   <input type="text" name="libraryFine" value="<?php 
									if(isset($_POST['update']))
									{
										echo $libraryFine;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $libraryFine;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Previous Due</label>
                                   <input type="text" name="previousDue" value="<?php 
									if(isset($_POST['update']))
									{
										echo $previousDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $previousDue;
											
										}
									}
								   ?>" class="form-control" placeholder="" readonly>
                                 </div>
                                 <div class="form_sep">
                                    <label>Total Payable Fee</label>
                                   <input type="text" name="totalPayable" value="<?php 
									if(isset($_POST['update']))
									{
										echo $totalPayable;
									}
									else
									{
										if(isset($_POST['update']))
										{
											echo $totalPayable;
										}
										else
										{
											if($fill==0)
											{
												echo 0;
											}
											else
											{
												echo $totalPayable; 
											}
										}
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Keeping Due</label>
                                   <input type="text" name="keepingDue" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $keepingDue;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											echo 0; 
										}	
									}
									?>" class="form-control" placeholder="" readonly>
                                 </div>
								  
                                 <div class="form_sep">
                                    <label>Total Paying Fee</label>
                                   <input type="text" name="totalPayingFee" value="<?php 
									if(isset($_POST['update']))
									{
										
										echo $totalPayingFee;
									}
									else
									{
										if($fill==0)
										{
											echo 0;
										}
										else
										{
											
											echo $totalPayingFee; 
										}
									}
									?>" id="" class="form-control" placeholder="" readonly>
                                 </div>
								 
                            </div>
						</div>
						<br><br><br><hr>	
							<div class="row">
								<div class="col-md-3">Accounts officer</div>
								<div class="col-md-3">Accounts officer</div>
								<div class="col-md-3">Accounts officer</div>
								<div class="col-md-3">Accounts officer</div>
							</div>
							<br><br>
							<input hidden value="<?php echo $payCategory; ?>" name="payCategory">
							<div class="row">
								<div class="col-md-3"><a style="margin-top:15px;" class="btn btn-primary fa fa-hand-o-left" href="../Admission/Admin/admission.php"> Back to Admission Section</a></div>
								<div class="col-md-3"><a style="margin-top:15px;" class="btn btn-primary fa fa-hand-o-left" href="student_fees.php"> Back to Accounts Section</a></div>
								<div class="col-md-3">
									<!--<input <?php if($keepingDue!=0 || $othersFee!=0) echo 'disabled'; ?> type="submit" name="update" value="Update" class="btn btn-success" style="float:right;margin-top:15px;width:100%">-->
								</div>
								<div class="col-md-3">
									<input <?php if($printCount==1) echo 'disabled'; ?>  type="submit" onclick="printInfo()" name="print" value="Print" class="btn btn-info fa fa-print" style="float:right;margin-top:15px;width:100%" />
								</div>
							</div>
					 </form>
                  
               </div>
			  
            </body>
         </html>
		 
<script>
function printInfo() {
    var prtContent = document.getElementById("a");
	var WinPrint = window.open('', '', 'letf=0,top=0,width=1200,height=700,toolbar=0,scrollbars=1,status=0');
	WinPrint.document.write(prtContent.innerHTML);
	WinPrint.document.write('<link rel="stylesheet" href="css/font-awesome.min.css">');
	WinPrint.document.write('<link rel="stylesheet" href="css/bootstrap.min.css">');
	WinPrint.document.write('<link rel="stylesheet" href="css/normalize.css">');
	WinPrint.document.write('<link rel="stylesheet" href="css/main.css">');
    WinPrint.document.close();
	WinPrint.focus();
	WinPrint.print();
	WinPrint.close();
}
</script>
		 
		 <?php/*
////////////// permission working
		}
		if($accessCategory==1)
		{
			header('Location: admin.php');
		}
	}
	else
	{
		header('Location: login.php');
	}*/
////////////////// permission ends
?>