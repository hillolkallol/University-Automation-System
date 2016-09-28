<?php
require 'connect.conf.php';
require 'core.inc.php';

$studentId = $_SESSION['user_id'];
$sFName;
$sLName;
$dept;

$transNo[] = array();
$date[] = array();
$season[] = array();
$year[] = array();
$amount[] = array();
$libFine;
$due;
$x=0;

$totalPrint = 0;

$query= "SELECT * FROM tbl_student_info WHERE std_id='".mysql_real_escape_string($studentId)."'";
	if($query_run = mysql_query($query))
	{
		$sFName= mysql_result($query_run, 0, 'std_name');
		$dept= mysql_result($query_run, 0, 'std_dept');
	}
	

	if(isset($_POST['searchTotal']))
	{
		$query = "SELECT * FROM student_trans WHERE studentId = '".mysql_real_escape_string($studentId)."' AND status='1'";
								
		if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run)==0)
			{
				echo '<script type="text/javascript"> alert("No data found from this query! Please try another one!") 
					window.location.href="student_view.php"</script>';
			}
			while($query_row = mysql_fetch_assoc($query_run))
			{
				$transNo[$x] = $query_row['tNo'];
				$season[$x] = $query_row['season'];
				$year[$x] = $query_row['year'];
				
				$queryValue = $query_row['tNo'];
				
				$query1 = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($queryValue)."'";
				if($query_run1 = mysql_query($query1))
				{
					$date[$x]= mysql_result($query_run1, 0, 'date');
					$amount[$x]= mysql_result($query_run1, 0, 'amount');
					$totalPrint = $totalPrint + $amount[$x];
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something worng!") 
							window.location.href="student_view.php"</script>';
				}
				
				$x++;
			}
			
			$query2 = "SELECT * FROM due_history WHERE studentId = '".mysql_real_escape_string($studentId)."'";
			
			if($query_run2 = mysql_query($query2))
			{
				$due= mysql_result($query_run2, 0, 'dueAmount');
				$libFine= mysql_result($query_run2, 0, 'libraryFine');
			}
			
		}
		else
		{
			//die(mysql_error());
			echo '<script type="text/javascript"> alert("Something worng!") 
					window.location.href="student_view.php"</script>';
		}
	}


	if(isset($_POST['searchSingle']))
	{
		$studentId = $_POST['studentId'];
		$Queryseason = $_POST['season'];
		$Queryyear = $_POST['year'];
		
		$query = "SELECT * FROM student_trans WHERE studentId = '".mysql_real_escape_string($studentId)."' AND season='".mysql_real_escape_string($Queryseason)."' AND year='".mysql_real_escape_string($Queryyear)."' AND status='1'";
								
		if($query_run = mysql_query($query))
		{
			if(mysql_num_rows($query_run)==0)
			{
				echo '<script type="text/javascript"> alert("No data found from this query! Please try another one!") 
					window.location.href="student_view.php"</script>';
			}
			while($query_row = mysql_fetch_assoc($query_run))
			{
				$transNo[$x] = $query_row['tNo'];
				$season[$x] = $query_row['season'];
				$year[$x] = $query_row['year'];
				
				$queryValue = $query_row['tNo'];
				
				$query1 = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($queryValue)."'";
				if($query_run1 = mysql_query($query1))
				{
					$date[$x]= mysql_result($query_run1, 0, 'date');
					$amount[$x]= mysql_result($query_run1, 0, 'amount');
					$totalPrint = $totalPrint + $amount[$x];
				}
				else
				{
					//die(mysql_error());
					echo '<script type="text/javascript"> alert("Something worng!") 
							window.location.href="student_view.php"</script>';
				}
				
				$x++;
			}		
		}
		else
		{
			//die(mysql_error());
			echo '<script type="text/javascript"> alert("Something worng!") 
					window.location.href="student_view.php"</script>';
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
                  <div class="row" id="a">
                     <form action="student_view.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-6">
								<div style="text-align: center;" class="print_top">
									<div class="print_header">
										<img style="width: 15%;" src="img/logo.png" alt="">				
										<h1>LEADING UNIVERSITY</h1>
										<p>A Promise To Lead</p>
									</div>
									<button class="btn btn-primary">Payment History</button>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form_sep">
								   <label>Student ID:</label>
								   <input readonly value="<?php echo $studentId; ?>" type="text" class="form-control" name="std_number" placeholder="Auto Generate">
								</div>
								<br />
								<div class="form_sep">
								   <label>Name:</label>
								   <input readonly value="<?php echo $sFName; ?>" type="text" class="form-control" name="std_number" placeholder="Auto Generate">
								</div>
								<br />
								<div class="form_sep">
								   <label>Department:</label>
								   <input readonly value="<?php 
								   			$query = "SELECT * FROM tbl_department_info WHERE dept_id='".$dept."'";
											if($query_run = mysql_query($query))
											{
												$dept_name = mysql_result($query_run, 0, 'dept_name');
												echo $dept_name;
											}
											else
												echo '';

								    ?>" type="text" class="form-control" name="std_number" placeholder="Auto Generate">
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
							  <th>Date</th>
							  <th>Season</th>
							  <th>year</th>
							  <th style="text-align: right; ">Amount</th>
							</tr>
						  </thead>
						  <tbody>
							<tr>
							  <td><?php
								if(isset($_POST['searchTotal']) || isset($_POST['searchSingle']))
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
								if(isset($_POST['searchTotal']) || isset($_POST['searchSingle']))
								{
									foreach ($date as $d)
									{
										echo $d.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>		
							  <td><?php
								if(isset($_POST['searchTotal']) || isset($_POST['searchSingle']))
								{
									foreach ($season as $sea)
									{
										echo $sea.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>		
							  <td><?php
								if(isset($_POST['searchTotal']) || isset($_POST['searchSingle']))
								{
									foreach ($year as $ye)
									{
										echo $ye.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>		
							  <td style="text-align: right; "><?php
								if(isset($_POST['searchTotal']) || isset($_POST['searchSingle']))
								{
									foreach ($amount as $amo)
									{
										echo $amo.'</br>';
									}
								}
								else
									echo 0;
							  ?></td>		
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<th><b>Total</b></th>
							  <th style="text-align: right; " ><b><?php echo $totalPrint; ?></b></th>
							  
							</tr>							
						  </tbody>
						</table>
							<?php
								if(isset($_POST['searchTotal']))
								{
								?>	
							<tr>
							  <td>Library Fine: </td>		
							  <td><?php echo $libFine; ?>TK</td>		
							</tr>
							<br>
							<tr>
							  <td>Remaining Due: </td>		
							  <td><?php echo $due; ?>TK</td>		
							</tr>
							<?php } ?>
						</div>

					</div>
					
                  </div>
                  <button onclick="printInfo()" name="print" style="float:right" class="btn btn-primary fa fa-print">&nbsp;&nbsp;Print</button>
                     </form>
               </div>
	  
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
      <script src="htttp://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/plugins.js"></script>
      <script src="js/main.js"></script>
   </body>
</html>
