<?php

require 'connect.conf.php';
require 'core.inc.php';

$transStatus = 0;
$studentId;
$amount;
$slipNo;

	if(isset($_POST['submitPaySlip']))
	{
		$slipNo = $_POST['slipNo'];
		
		
		if(!empty($slipNo))
		{
			$query = "SELECT * FROM student_trans WHERE slipNo ='".mysql_real_escape_string($slipNo)."'";	
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==1)
				{
					$status = mysql_result($query_run, 0, 'status');
					$studentId = mysql_result($query_run, 0, 'studentId');
					$amount = mysql_result($query_run, 0, 'total');
					if($status == '0')
					{
						$transStatus = 1;
					}
					else
					{
						$transStatus = 2;
					}
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something worng!") 
			window.location.href="admin_income.php"	</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Enter a slip no!") 
			window.location.href="admin_income.php"	</script>';
		}
	}
	
	if(isset($_POST['yes']))
	{
		$query = "SELECT * FROM all_transactions ORDER BY tNo DESC";	
			
		if($query_run = mysql_query($query))
		{
			$tNo = mysql_result($query_run, 0, 'tNo');
			$tNo++;
			
			$time = time();
			$date = date('Y-m-d', $time);
			$transBy = $_SESSION['sessionUsername'];
			
			$slipNo = $_POST['HiddenSlipNo'];
			$amount = $_POST['HiddenAmount'];
			
			$query1 = "INSERT INTO all_transactions(tNo, date, category, description, amount, transBy) VALUES ('".mysql_real_escape_string($tNo)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string('income')."','".mysql_real_escape_string('Student Collection')."','".mysql_real_escape_string($amount)."','".mysql_real_escape_string($transBy)."')";
			if(!($query_run1 = mysql_query($query1)))
			{
				echo '<script type="text/javascript">';
				echo 'alert("Something worng!")';
				echo '</script>';
			}
			
			$query2 = "UPDATE student_trans SET tNo='".mysql_real_escape_string($tNo)."', status='".mysql_real_escape_string('1')."' WHERE slipNo='".mysql_real_escape_string($slipNo)."'";
			if(!($query_run2 = mysql_query($query2)))
			{
				echo '<script type="text/javascript">';
				echo 'alert("Something worng!")';
				echo '</script>';
			}

			$query3 = "SELECT * FROM student_trans WHERE slipNo='".mysql_real_escape_string($slipNo)."'";
			if($query_run3 = mysql_query($query3))
			{
				$payCategory = mysql_result($query_run3, 0, 'payCategory');
				$dueAmount = mysql_result($query_run3, 0, 'due');
				$studentId = mysql_result($query_run3, 0, 'studentId');
				$season = mysql_result($query_run3, 0, 'season');
				$year = mysql_result($query_run3, 0, 'year');
				if($payCategory==1)
				{
					$dueHistoryQuery="SELECT * FROM due_history WHERE studentId='".$studentId."'";
					if(($query_runQuery = mysql_query($dueHistoryQuery)))
					{
						if(mysql_num_rows($query_runQuery)==1)
						{
							$queryAgain2 = "UPDATE due_history SET tNo='".$tNo."', libraryFine='0', dueAmount='".$dueAmount."' WHERE studentId='".$studentId."'";
							$query_run2 = mysql_query($queryAgain2);
						}
						else
						{
							$queryAgain3="INSERT INTO due_history(studentId, tNo, libraryFine, dueAmount) VALUES ('".$studentId."', '".$tNo."', '0', '".$dueAmount."')";
							$query_run3 = mysql_query($queryAgain3);
						}
					}

					$query4 = "UPDATE tbl_course_registration SET active='".mysql_real_escape_string('2')."' WHERE student_id='".mysql_real_escape_string($studentId)."' AND session='".mysql_real_escape_string($season)."' AND reg_year='".mysql_real_escape_string($year)."'";
					if(!($query_run4 = mysql_query($query4)))
					{
						echo '<script type="text/javascript">';
						echo 'alert("Something worng!")';
						echo '</script>';
					}
				}
				if($payCategory==2)
				{
					$query5 = "UPDATE tbl_student_info SET std_active='".mysql_real_escape_string('1')."' WHERE std_id='".mysql_real_escape_string($studentId)."' OR std_auto_id='".mysql_real_escape_string($studentId)."'";
					if(!($query_run5 = mysql_query($query5)))
					{
						echo '<script type="text/javascript">';
						echo 'alert("Something worng!")';
						echo '</script>';
					}
				}
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Something worng!")';
			echo '</script>';
		}
		header('Location: admin_income.php');
	}

	if(isset($_POST['no']))
	{
		$query = "SELECT * FROM all_transactions ORDER BY tNo DESC";	
			
		if($query_run = mysql_query($query))
		{
			$tNo = mysql_result($query_run, 0, 'tNo');
			$tNo++;
			
			$time = time();
			$date = date('Y-m-d', $time);
			$transBy = $_SESSION['sessionUsername'];
			
			$slipNo = $_POST['HiddenSlipNo'];
			$amount = $_POST['HiddenAmount'];
			
			$query3 = "SELECT * FROM student_trans WHERE slipNo='".mysql_real_escape_string($slipNo)."'";
			if($query_run3 = mysql_query($query3))
			{
				$payCategory = mysql_result($query_run3, 0, 'payCategory');
				$dueAmount = mysql_result($query_run3, 0, 'due');
				$studentId = mysql_result($query_run3, 0, 'studentId');
				$season = mysql_result($query_run3, 0, 'season');
				$year = mysql_result($query_run3, 0, 'year');
				if($payCategory==1)
				{
					
					$query4 = "UPDATE tbl_course_registration SET active='".mysql_real_escape_string('3')."' WHERE student_id='".mysql_real_escape_string($studentId)."' AND session='".mysql_real_escape_string($season)."' AND reg_year='".mysql_real_escape_string($year)."'";
					if(!($query_run4 = mysql_query($query4)))
					{
						echo '<script type="text/javascript">';
						echo 'alert("Something worng!")';
						echo '</script>';
					}
				}
			}
		}
		else
		{
			echo '<script type="text/javascript">';
			echo 'alert("Something worng!")';
			echo '</script>';
		}
		header('Location: admin_income.php');
	}

///////////////////// permission starts
	if(loggedin())
	{
		$accessCategory = $_SESSION['accessCategory'];
		if($accessCategory==1)
		{
////////////////////// permission working	
?>

<!DOCTYPE html>
<html class="no-js">
   <!--<![endif]-->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Leading University | Student</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- Place favfa fa.ico and apple-touch-fa fa.png in the root directory -->
      <link rel="stylesheet" href="css/font-awesome.min.css">
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/normalize.css">
      <link rel="stylesheet" href="css/main.css">
      <link rel="stylesheet" href="css/responsive.css">
      <script src="js/vendor/modernizr-2.6.2.min.js"></script>
   </head>
   <body>
      <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
      <!-- Add your site or application content here -->
      
			   
               <div class="container" style="padding: 50px 300px;">
                  <div class="row panel panel-default" style="padding: 10px 10px;">
                     <form action="#" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<div style="text-align: center;" class="print_top">
									<div class="print_header">
										<h1 class="btn btn-primary" style="width:100%;font-size:30px">Confirm The Transaction</h1>
									</div>
								</div>
							</div>
						</div>
						<br><br>
					<?php
					if($transStatus == 1)
					{ ?>
					<div class="row">
                        <div class="col-md-12">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Student ID</th>
                                    <th>Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><?php echo $studentId; ?></td>
                                    <td><?php echo $amount; ?></td>
                                 </tr>
                              </tbody>
                           </table>
						   <input hidden type="text" name="HiddenAmount" value="<?php echo $amount; ?>"/>
						   <input hidden type="text" name="HiddenSlipNo" value="<?php echo $slipNo; ?>"/>
                        </div>
                    </div>
					<br><br>
					<hr style="margin: 30px 0px;">
					<h3 >Are you sure you want to confirm the transaction?</h3>
					<button type="submit" name="yes" class="btn btn-primary btn-lg" style="margin-top: 15px;">Yes</button>
                    <button type="submit" name="no" href="admin_income.php" class="btn btn-primary btn-lg" style="margin-top: 15px;">No</button>
					<?php
					}
					else if($transStatus == 2)
					{ ?>
						<h3 >Transaction already confirmed.</h3>
						<a href="admin_income.php" class="btn btn-primary btn-lg" style="margin-top: 15px;">OK</a>
					<?php 
					}
					?>
                     </form>
                  </div>
               </div>
	  
	  
      <script src="htttp://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>

<?php
////////////// permission working
		}
		if($accessCategory==2)
		{
			header('Location: student_view.php');
		}
	}
	else
	{
		header('Location: login.php');
	}
////////////////// permission ends
?>