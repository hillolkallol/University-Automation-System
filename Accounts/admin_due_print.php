<?php
require 'connect.conf.php';
require 'core.inc.php';

$studentId[] = array();

$transNo[] = array();
$due[] = array();
$libFine[] = array();
$stuId;
$x=0;

$totalPrint = 0;

	if(isset($_POST['dueSingle']))
	{
		$stuId = $_POST['studentId'];
		$query = "SELECT * FROM due_history WHERE studentId='".$stuId."' AND (dueAmount > 0 OR libraryFine > 0)";
								
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
				$due[$x]= $query_row['dueAmount'];
				$libFine[$x]= $query_row['libraryFine'];
				$totalPrint = $totalPrint +$due[$x] + $libFine[$x];
				
				$queryValue = $query_row['tNo'];
				
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

	if(isset($_POST['dueAll']))
	{
		$query = "SELECT * FROM due_history WHERE dueAmount > 0 OR libraryFine > 0";
								
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
				$due[$x]= $query_row['dueAmount'];
				$libFine[$x]= $query_row['libraryFine'];
				$totalPrint = $totalPrint +$due[$x] + $libFine[$x];
				
				$queryValue = $query_row['tNo'];
				
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
									<button class="btn btn-primary"><?php if(!isset($_POST['dueSingle'])){ ?>All Due History<?php } ?><?php if(!isset($_POST['dueAll'])){ ?>Individual Due History<?php } ?></button>
								</div>
							</div>
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
							  <th style="text-align: right; " >Library Fine</th>
							  <th style="text-align: right; " >Due</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td><?php
								if(isset($_POST['dueSingle']) || isset($_POST['dueAll']))
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
								if(isset($_POST['dueSingle']) || isset($_POST['dueAll']))
								{
									foreach ($studentId as $stdId)
									{
										echo $stdId.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>
							  <td style="text-align: right; " ><?php
								if(isset($_POST['dueSingle']) || isset($_POST['dueAll']))
								{
									foreach ($libFine as $d)
									{
										echo $d.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>	
							  <td style="text-align: right; " ><?php
								if(isset($_POST['dueSingle']) || isset($_POST['dueAll']))
								{
									foreach ($due as $du)
									{
										echo $du.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>
							</tr>	
							<tr>
								<td></td>
								<td></td>
								<th style="text-align: right; " ><b>Total</b></th>
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
