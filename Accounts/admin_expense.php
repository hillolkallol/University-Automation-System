<?php 
	include('admin_header.php');
	/*
	if(isset($_POST['tSave']))
	{
		$tTrackNo = $_POST['tTrackNo'];		
		$tMonth = $_POST['tMonth'];		
		$tYear = $_POST['tYear'];		
		if(!empty($tTrackNo) && !empty($tMonth) && !empty($tYear))
		{
			$query = "SELECT * FROM all_transactions ORDER BY tNo DESC";	
			if($query_run = mysql_query($query))
			{
				$tNo = mysql_result($query_run, 0, 'tNo');
				$tNo++;
				
				$time = time();
				$date = date('Y-m-d', $time);
				
				$transBy = $_SESSION['sessionUsername'];
				
				$query2 = "INSERT INTO teacher_trans(tNo, tTrackNo, chequeNo, month, year, amount) VALUES ('".mysql_real_escape_string($tNo)."','".mysql_real_escape_string($tTrackNo)."','".mysql_real_escape_string($tChequeNo)."','".mysql_real_escape_string($tMonth)."','".mysql_real_escape_string($tYear)."','".mysql_real_escape_string($tAmount)."')";
				
				$query3 = "INSERT INTO all_transactions(tNo, date, category, description, amount, transBy) VALUES ('".mysql_real_escape_string($tNo)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string('expense')."','".mysql_real_escape_string('teacher\'s salary')."','".mysql_real_escape_string($tAmount)."','".mysql_real_escape_string($transBy)."')";
				if($query_run2 = mysql_query($query2) && $query_run3 = mysql_query($query3))
				{
					echo '<script type="text/javascript">';
					echo 'alert("A new transaction inserted!")';
					echo '</script>';
				}
				else
				{
					echo '<script type="text/javascript">';
					echo 'alert("Something Worng!")';
					echo '</script>';
				}
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			</script>';
		}
	}
	
	if(isset($_POST['eSave']))
	{
		$eTrackNo = $_POST['eTrackNo'];		
		$eChequeNo = $_POST['eChequeNo'];		
		$eMonth = $_POST['eMonth'];		
		$eYear = $_POST['eYear'];		
		$eAmount = $_POST['eAmount'];		
		if(!empty($eTrackNo) && !empty($eChequeNo) && !empty($eMonth) && !empty($eYear) && !empty($eAmount))
		{
			$query = "SELECT * FROM all_transactions ORDER BY tNo DESC";	
			if($query_run = mysql_query($query))
			{
				$tNo = mysql_result($query_run, 0, 'tNo');
				$tNo++;
				
				$time = time();
				$date = date('Y-m-d', $time);
				
				$transBy = $_SESSION['sessionUsername'];
				
				$query2 = "INSERT INTO employee_trans(tNo, eTrackNo, chequeNo, month, year, amount) VALUES ('".mysql_real_escape_string($tNo)."','".mysql_real_escape_string($eTrackNo)."','".mysql_real_escape_string($eChequeNo)."','".mysql_real_escape_string($eMonth)."','".mysql_real_escape_string($eYear)."','".mysql_real_escape_string($eAmount)."')";
				
				$query3 = "INSERT INTO all_transactions(tNo, date, category, description, amount, transBy) VALUES ('".mysql_real_escape_string($tNo)."','".mysql_real_escape_string($date)."','".mysql_real_escape_string('expense')."','".mysql_real_escape_string('employee\'s salary')."','".mysql_real_escape_string($eAmount)."','".mysql_real_escape_string($transBy)."')";
				if($query_run2 = mysql_query($query2) && $query_run3 = mysql_query($query3))
				{
					echo '<script type="text/javascript">';
					echo 'alert("A new transaction inserted!")';
					echo '</script>';
				}
				else
				{
					echo '<script type="text/javascript">';
					echo 'alert("Something Worng!")';
					echo '</script>';
				}
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			</script>';
		}
	}*/
	
	if(isset($_POST['saveDescription']))
	{
		$description = $_POST['addDescription'];
		$code = $_POST['addCode'];
		
		if(!empty($description))
		{
			$query = "INSERT INTO descriptions_list(category, part, descriptions, code) VALUES('expense','others','".$description."','".$code."')";
			if($query_run = mysql_query($query))
			{
				echo '<script type="text/javascript">';
				echo 'alert("A new description added!")';
				echo '</script>';
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'alert("Something Worng!")';
				echo '</script>';
			}
		}
		else
		{
		echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_expense.php"	</script>';
		}
	}
	
	if(isset($_POST['save']))
	{
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		
		if(!empty($description) && !empty($amount))
		{
			$query = "SELECT * FROM all_transactions ORDER BY tNo DESC";	
			if($query_run = mysql_query($query))
			{
				$tNo = mysql_result($query_run, 0, 'tNo');
				$tNo++;
				
				$time = time();
				$date = date('Y-m-d', $time);
				$transBy = $_SESSION['sessionUsername'];
				
				$query2 = "INSERT INTO all_transactions(tNo, date, category, description, amount, transBy) VALUES ('".$tNo."','".$date."','expense','".$description."','".$amount."','".$transBy."')";
				if($query_run2 = mysql_query($query2))
				{
					echo '<script type="text/javascript">';
					echo 'alert("A new transaction inserted!")';
					echo '</script>';
				}
				else
				{
					echo '<script type="text/javascript">';
					echo 'alert("Something Worng!")';
					echo '</script>';
				}
			}
		}
		else
		{
		echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_expense.php"	</script>';
		}
	}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-select.min.css">
</head>
<body>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Expense</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
<!--         <div class="row">
            

            <div class="tabs">
               <ul role="tablist" class="nav nav-tabs" id="myTab">
                  <li class="active"><a data-toggle="tab" role="tab" href="#teacher_expense">Teacher</a></li>
                  <li class=""><a data-toggle="tab" role="tab" href="#employee_expense">Employe</a></li>
                  <li class=""><a data-toggle="tab" role="tab" href="#others_expense">Others</a></li>
               </ul>
               <div class="tab-content" id="myTabContent">
                  <div id="teacher_expense" class="tab-pane fade active in">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Teacher Details</h4>
                              </div>
                              <div class="panel-body">
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>ID No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="tTrackNo">
                                 </div>
                                 <br>			
                                 <div class="form_sep">
                                    <label>Month <span style="color:red">*</span></label>
                                    <select class="form-control" name="tMonth" id="course">
                                       <option value="January" selected>January</option>
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
                                       <option value="2011">2011</option>
                                       <option value="2012">2012</option>
                                       <option value="2013">2013</option>
                                       <option value="2014" >2014</option>
                                       <option value="2015" selected>2015</option>
                                       <option value="2016">2016</option>
                                    </select>
                                 </div>
                                 <br>
                                 <button id="std_reg_submit" name="tSave" type="submit" class="btn btn-primary offset-2 fa fa-save">&nbsp;Save</button>	
								</form>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Search Teacher</h4>
                              </div>
                              <div class="panel-body">
								<form action="admin_expense_search.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="searchTTrackNo">
                                 </div>
                                 <br>				
                                 <div class="form_sep">
                                    <label>Month <span style="color:red">*</span></label>
                                    <select class="form-control" name="searchTMonth" id="course">
                                      <option value="January" selected>January</option>
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
                                    <select class="form-control" name="searchTYear" id="course">
                                       <option value="2011">2011</option>
                                       <option value="2012">2012</option>
                                       <option value="2013">2013</option>
                                       <option value="2014" selected >2014</option>
                                       <option value="2015">2015</option>
                                       <option value="2016">2016</option>
                                    </select>
                                 </div>
                                 <br>
                                 <button name="tSearch" type="submit" class="btn btn-primary fa fa-search">&nbsp;Search</button>
								 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="alert alert-info"><strong>Last 10 Transactions Teacher List</strong></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <table class="table table-hover">
                                          <thead>
                                             <tr>
                                                <th>Transaction No</th>
                                                <th>Date</th>
                                                <th>Teacher Track No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Cheque No</th>
                                                <th>Amount</th>
                                                <th>Transaction By</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td><?php
													$query = "SELECT * FROM  teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																echo $tNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																$againQuery = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($tNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$date = mysql_result($query_run2, 0, 'date');
																		echo $date.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tTrackNo = $query_row['tTrackNo'];
																echo $tTrackNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tTrackNo = $query_row['tTrackNo'];
																$againQuery = "SELECT * FROM teacher_info WHERE tTrackNo='".mysql_real_escape_string($tTrackNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$fname = mysql_result($query_run2, 0, 'tFName');
																		echo $fname.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tTrackNo = $query_row['tTrackNo'];
																$againQuery = "SELECT * FROM teacher_info WHERE tTrackNo='".mysql_real_escape_string($tTrackNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$lname = mysql_result($query_run2, 0, 'tLName');
																		echo $lname.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$chequeNo = $query_row['chequeNo'];
																echo $chequeNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$amount = $query_row['amount'];
																echo $amount.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM teacher_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																$againQuery = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($tNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$transBy = mysql_result($query_run2, 0, 'transBy');
																		echo $transBy.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                        </div>
                     </div>
                  </div>
                  <div id="employee_expense" class="tab-pane fade">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Employee Details</h4>
                              </div>
                              <div class="panel-body">
                                 <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eTrackNo">
                                 </div>
                                 <br>
                                 					
                                 <div class="form_sep">
                                    <label>Cheque No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eChequeNo">
                                 </div>
                                 <br>
                                 				
                                 <div class="form_sep">
                                    <label>Month <span style="color:red">*</span></label>
                                    <select class="form-control" name="eMonth" id="course">
                                       <option value="January" selected>January</option>
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
                                    <select class="form-control" name="eYear" id="course">
                                       <option value="2011">2011</option>
                                       <option value="2012">2012</option>
                                       <option value="2013">2013</option>
                                       <option value="2014" selected >2014</option>
                                       <option value="2015">2015</option>
                                       <option value="2016">2016</option>
                                    </select>
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Amount<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="eAmount">
                                 </div>
                                 <br>
                                 <button id="std_reg_submit" name="eSave" type="submit" class="btn btn-primary offset-2 fa fa-save">&nbsp;Save</button>	
								</form>					
                              </div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Search Employee</h4>
                              </div>
                              <div class="panel-body">
                                 <form action="admin_search_employee.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Track No<span style="color:red">*</span></label>
                                    <input type="text" class="form-control" name="searchETrackNo">
                                 </div>
                                 <br>				
                                 <div class="form_sep">
                                    <label>Month <span style="color:red">*</span></label>
                                    <select class="form-control" name="searchEMonth" id="course">
                                      <option value="January" selected>January</option>
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
                                    <select class="form-control" name="searchEYear" id="course">
                                       <option value="2011">2011</option>
                                       <option value="2012">2012</option>
                                       <option value="2013">2013</option>
                                       <option value="2014" selected >2014</option>
                                       <option value="2015">2015</option>
                                       <option value="2016">2016</option>
                                    </select>
                                 </div>
                                 <br>
                                 <button name="eSearch" type="submit" class="btn btn-primary fa fa-search">&nbsp;Search</button>
								 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="alert alert-info"><strong>Last 10 Transactions Employee List</strong></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <table class="table table-hover">
                                          <thead>
                                             <tr>
                                                <th>Transaction No</th>
                                                <th>Date</th>
                                                <th>Employee Track No</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Cheque No</th>
                                                <th>Amount</th>
                                                <th>Transaction By</th>
                                             </tr>
                                          </thead>
                                             <tr>
                                                <td><?php
													$query = "SELECT * FROM  employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																echo $tNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																$againQuery = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($tNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$date = mysql_result($query_run2, 0, 'date');
																		echo $date.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$eTrackNo = $query_row['eTrackNo'];
																echo $eTrackNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$eTrackNo = $query_row['eTrackNo'];
																$againQuery = "SELECT * FROM employee_info WHERE eTrackNo='".mysql_real_escape_string($eTrackNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$fname = mysql_result($query_run2, 0, 'eFName');
																		echo $fname.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$eTrackNo = $query_row['eTrackNo'];
																$againQuery = "SELECT * FROM employee_info WHERE eTrackNo='".mysql_real_escape_string($eTrackNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$lname = mysql_result($query_run2, 0, 'eLName');
																		echo $lname.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$chequeNo = $query_row['chequeNo'];
																echo $chequeNo.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM  employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$amount = $query_row['amount'];
																echo $amount.'<br>';
															}
															$count--;
														}
													}
												?></td>
                                                <td><?php
													$query = "SELECT * FROM employee_trans ORDER BY tNo DESC";
													$count = 10;
													if($query_run = mysql_query($query))
													{
														while($query_row = mysql_fetch_assoc($query_run))
														{
															if($count>0)
															{
																$tNo = $query_row['tNo'];
																$againQuery = "SELECT * FROM all_transactions WHERE tNo='".mysql_real_escape_string($tNo)."'";
																if($query_run2 = mysql_query($againQuery))
																{
																	if(mysql_num_rows($query_run2)==1)
																	{
																		$transBy = mysql_result($query_run2, 0, 'transBy');
																		echo $transBy.'<br>';
																	}
																}
																
															}
															$count--;
														}
													}
												?></td>
                                             </tr>
                                          </tbody>
                                       </table>
                        </div>
                     </div>
                  </div>
-->

                  <div id="others_expense" class="">
                     <div class="row">
                        <div class="col-md-8">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Expense</h4>
                              </div>
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                              <div class="panel-body">
                                
                                 <div class="form_sep">
                                    <label>Particulars <span style="color:red">*</span></label>
                                    <select required class="form-control selectpicker" data-live-search="true" name="description" id="course">
                                    	<option></option>
                                       <?php
										$query = "SELECT * FROM descriptions_list WHERE category='expense' AND part='others'";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['descriptions'];
												?>" data-subtext="<?php
													echo $query_row['descriptions'];
												?>"> 
												<?php echo $query_row['code']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                    <br /><br>
                                    <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#button">Add a Particular</a>
                                    
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Amount <span style="color:red">*</span></label>
                                    <input required type="number" step="any" class="form-control " name="amount">
                                 </div>
                                 <br />
                                 <button type="submit" name="save" class="btn btn-primary fa fa-save">&nbsp;Save</button>
                              </div>
							  </form>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Expense Search</h4>
                              </div>
                              <div class="panel-body">
								<form action="admin_others_expense_search.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                 <div class="form_sep">
                                    <label>Transaction No <span style="color:red">*</span></label>
                                    <input required type="number" class="form-control " name="transNo">
                                 </div>
                                 <br />
                                 <button type="submit" name="searchTrans" class="btn btn-primary fa fa-search">&nbsp;Search</a>
								</form>
							  </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="alert alert-info"><strong>Last 10 Transactions</strong></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Transaction No</th>
                                    <th>Date</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Transaction By</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><?php
										$query = "SELECT * FROM all_transactions WHERE category='expense' AND description!='teacher\'s salary' AND description!='employee\'s salary' ORDER BY tNo DESC";
										$count = 10;
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												if($count>0)
												{
													$tNo = $query_row['tNo'];
													echo $tNo.'<br>';
												}
												$count--;
											}
										}
									?></td>
                                    <td><?php
										$query = "SELECT * FROM all_transactions WHERE category='expense' AND description!='teacher\'s salary' AND description!='employee\'s salary' ORDER BY tNo DESC";
										$count = 10;
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												if($count>0)
												{
													$date = $query_row['date'];
													echo $date.'<br>';
												}
												$count--;
											}
										}
									?></td>
                                    <td><?php
										$query = "SELECT * FROM all_transactions WHERE category='expense' AND description!='teacher\'s salary' AND description!='employee\'s salary' ORDER BY tNo DESC";
										$count = 10;
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												if($count>0)
												{
													$description = $query_row['description'];
													echo $description.'<br>';
												}
												$count--;
											}
										}
									?></td>
                                    <td><?php
										$query = "SELECT * FROM all_transactions WHERE category='expense' AND description!='teacher\'s salary' AND description!='employee\'s salary' ORDER BY tNo DESC";
										$count = 10;
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												if($count>0)
												{
													$amount = $query_row['amount'];
													echo $amount.'<br>';
												}
												$count--;
											}
										}
									?></td>
                                    <td><?php
										$query = "SELECT * FROM all_transactions WHERE category='expense' AND description!='teacher\'s salary' AND description!='employee\'s salary' ORDER BY tNo DESC";
										$count = 10;
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												if($count>0)
												{
													$transBy = $query_row['transBy'];
													echo $transBy.'<br>';
												}
												$count--;
											}
										}
									?></td>
                                 </tr>
                              </tbody>
                           </table>
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
      						<!-- Modal -->
                                    <div class="modal fade" id="button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
											
											<form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Add New Particular</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="form_sep">
                                                   <label>Code <span style="color:red">*</span></label>
                                                   <input type="text" class="form-control " name="addCode" />
                                                </div>
                                                <div class="form_sep">
                                                   <label>Particular <span style="color:red">*</span></label>
                                                   <input type="text" class="form-control " name="addDescription" />
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="saveDescription" class="btn btn-primary fa fa-save">&nbsp;Save changes</button>
                                             </div>
											 </form>
                                          </div>
                                       </div>
                                    </div>
	  <script>
		$(function() {
		$( "#datepicker1" ).datepicker();
		$( "#datepicker2" ).datepicker();
		$( "#datepicker3" ).datepicker();
		});
		$('.selectpicker').selectpicker();
		</script>
      <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
      
   </body>
</html>

<?php
		include('admin_footer.php')
?>
