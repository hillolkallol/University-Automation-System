<?php
require 'connect.conf.php';
require 'core.inc.php';

$studentId[] = array();

$transNo[] = array();
$date[] = array();
$season;
$year;
$admissionFee[] = array();

$totalPrint = 0;
$due;
$x=0;

	if(isset($_POST['admissionPayment']))
	{
		$query0 = "SELECT * FROM tbl_student_info WHERE std_semester='1'";
		$query_run0 = mysql_query($query0);
		while($query_row0 = mysql_fetch_assoc($query_run0))
		{
			$std_id = $query_row0['std_id'];
			$query = "SELECT * FROM student_trans WHERE studentId='".$std_id."' AND admissionFee > 0 AND status='1'";
									
			if($query_run = mysql_query($query))
			{
				if(mysql_num_rows($query_run)==0)
				{
					echo '<script type="text/javascript"> alert("No data found from this query! Please try another one!") 
						window.location.href="admin_student_collection_report.php"</script>';
				}
				while($query_row = mysql_fetch_assoc($query_run))
				{
					$transNo[$x] = $query_row['tNo'];
					$studentId[$x] = $query_row['studentId'];
					$admissionFee[$x]= $query_row['total'];
					$totalPrint = $totalPrint + $admissionFee[$x];
					
					$queryValue = $query_row['tNo'];
					
					$query1 = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($queryValue)."'";
					if($query_run1 = mysql_query($query1))
					{
						$date[$x]= mysql_result($query_run1, 0, 'date');
					}
					else
					{
						//die(mysql_error());
						echo '<script type="text/javascript"> alert("Something worng!") 
								window.location.href="admin_student_collection_report.php"</script>';
					}
					
					$x++;
				}
				
			}
			else
			{
				//die(mysql_error());
				echo '<script type="text/javascript"> alert("Something worng!") 
						window.location.href="admin_student_collection_report.php"</script>';
			}
		}
		
	}

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
      
			   
               <div class="container" style="padding: 50px 0px;">
                  <div class="row">
                     <form action="admin_income.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<div style="text-align: center;" class="print_top">
									<div class="print_header">
										<img style="width: 15%;" src="img/logo.png" alt="">				
										<h1>LEADING UNIVERSITY</h1>
										<p>A Promise To Lead</p>
									</div>
									<button class="btn btn-primary">Report on New Admission Income</button>
								</div>
							</div>
							<!--<div class="col-md-6">
								<div class="form_sep">
								   <label>Session:</label>
								   <input readonly value="<?php echo $season; ?>" type="text" class="form-control" name="std_number" placeholder="Auto Generate">
								</div>
								<br />
								<div class="form_sep">
								   <label>Year:</label>
								   <input readonly value="<?php echo $year; ?>" type="text" class="form-control" name="std_number" placeholder="Auto Generate">
								</div>
							</div>-->
						</div>
						<hr style="margin: 30px 0px;">
						<br />
						<br />
						<br />
						 <div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
						  <thead>
							<tr>
							  <th>Transaction No</th>
							  <th>Student ID</th>
							  <th>Date</th>
							  <th style="text-align: right; ">Amount</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td><?php
								if(isset($_POST['admissionPayment']))
								{
									foreach ($transNo as $tNo)
									{
										echo $tNo.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>
							  <td><?php
								if(isset($_POST['admissionPayment']))
								{
									foreach ($studentId as $stdId)
									{
										echo $stdId.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>
							  <td><?php
								if(isset($_POST['admissionPayment']))
								{
									foreach ($date as $d)
									{
										echo $d.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>	
							  <td  style="text-align: right; "><?php
								if(isset($_POST['admissionPayment']))
								{
									foreach ($admissionFee as $admF)
									{
										echo $admF.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>
							</tr>	
							<tr>
								<td></td>
								<td></td>
								<th><b>Total</b></th>
							  <th style="text-align: right; " ><b><?php echo $totalPrint; ?></b></th>

							</tr>						
						  </tbody>
						</table>
							
						</div>

					</div>
					<button onClick="window.print()" name="print" style="float:right" class="btn btn-primary fa fa-print">&nbsp;&nbsp;Print</button>
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
