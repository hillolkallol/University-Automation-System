<?php
require 'connect.conf.php';
require 'core.inc.php';

$transNo[] = array();
$date[] = array();
$category[] = array();
$description[] = array();
$amount[] = array();
$x=0;

$totalPrint = 0;

	if(isset($_POST['allCreateReport']))
	{
		$allDateFrom = $_POST['allDateFrom'];
		$allDateTo = $_POST['allDateTo'];
		$allDateAll = $_POST['allDateAll'];
		$allCategories = $_POST['allCategories'];
		$allIncomeDesc = $_POST['allIncomeDesc'];
		$allExpenseDesc = $_POST['allExpenseDesc'];
		$allAmount = $_POST['allAmount'];
		$gtAmount = $_POST['gtAmount'];
		$ltAmount = $_POST['ltAmount'];

		if(!empty($allDateAll) && !empty($allCategories) && !empty($allAmount))
		{
			if($allDateAll=='all')
			{
				if($allAmount=='any')
				{
					if(in_array("income", $allCategories) && in_array("expense", $allCategories))
					{
						if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
						{
							foreach ($allIncomeDesc as $incomeDesc)
							{
								$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."'";
								
								if($query_run = mysql_query($query))
								{
									while($query_row = mysql_fetch_assoc($query_run))
									{
										$transNo[$x] = $query_row['tNo'];
										$date[$x] = $query_row['date'];
										$category[$x] = $query_row['category'];
										$description[$x] = $query_row['description'];
										$amount[$x] = $query_row['amount'];
										$totalPrint = $totalPrint + $amount[$x];
										$x++;
									}
								}
								else
								{
									//die(mysql_error());
									echo '<script type="text/javascript"> alert("Something worng!") 
											window.location.href="admin_report.php"</script>';
								}
							}
						
							foreach ($allExpenseDesc as $expenseDesc)
							{
								$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."'";
								
								if($query_run = mysql_query($query))
								{
									while($query_row = mysql_fetch_assoc($query_run))
									{
										$transNo[$x] = $query_row['tNo'];
										$date[$x] = $query_row['date'];
										$category[$x] = $query_row['category'];
										$description[$x] = $query_row['description'];
										$amount[$x] = $query_row['amount'];
										$totalPrint = $totalPrint + $amount[$x];
										$x++;
									}
								}
								else
								{
									//die(mysql_error());
									echo '<script type="text/javascript"> alert("Something worng!") 
											window.location.href="admin_report.php"</script>';
								}
							}
						}
						else
						{
							//go back
							echo '<script type="text/javascript"> alert("Fill all the fields!") 
								window.location.href="admin_report.php"</script>';
						}
					}
					else if(in_array("income", $allCategories))
					{
						if(!empty($allIncomeDesc))
						{
							foreach ($allIncomeDesc as $incomeDesc)
							{
								$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."'";
								
								if($query_run = mysql_query($query))
								{
									while($query_row = mysql_fetch_assoc($query_run))
									{
										$transNo[$x] = $query_row['tNo'];
										$date[$x] = $query_row['date'];
										$category[$x] = $query_row['category'];
										$description[$x] = $query_row['description'];
										$amount[$x] = $query_row['amount'];
										$totalPrint = $totalPrint + $amount[$x];
										$x++;
									}
								}
								else
								{
									//die(mysql_error());
									echo '<script type="text/javascript"> alert("Something worng!") 
											window.location.href="admin_report.php"</script>';
								}
							}
						}
						else
						{
							echo '<script type="text/javascript"> alert("Fill all the fields!") 
								window.location.href="admin_report.php"</script>';
						}
					
					}
					else if(in_array("expense", $allCategories))
					{
						if(!empty($allExpenseDesc))
						{
							foreach ($allExpenseDesc as $expenseDesc)
							{
								$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."'";
								
								if($query_run = mysql_query($query))
								{
									while($query_row = mysql_fetch_assoc($query_run))
									{
										$transNo[$x] = $query_row['tNo'];
										$date[$x] = $query_row['date'];
										$category[$x] = $query_row['category'];
										$description[$x] = $query_row['description'];
										$amount[$x] = $query_row['amount'];
										$totalPrint = $totalPrint + $amount[$x];
										$x++;
									}
								}
								else
								{
									//die(mysql_error());
									echo '<script type="text/javascript"> alert("Something worng!") 
											window.location.href="admin_report.php"</script>';
								}
							}
						}
						else
						{
							//go back
							echo '<script type="text/javascript"> alert("Fill all the fields!") 
							window.location.href="admin_report.php"</script>';
						}
					}
				}
				else if($allAmount=='gt')
				{
					if(!empty($gtAmount))
					{
						//query
						if(in_array("income", $allCategories) && in_array("expense", $allCategories))
						{
							if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						}
						else if(in_array("income", $allCategories))
						{
							if(!empty($allIncomeDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						
						}
						else if(in_array("expense", $allCategories))
						{
							if(!empty($allExpenseDesc))
							{
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
								window.location.href="admin_report.php"</script>';
							}
						}
					}
					else
					{
						//go back
						echo '<script type="text/javascript"> alert("Fill all the required fields!") 
								window.location.href="admin_report.php"</script>';
					}
				}
				else if($allAmount=='lt')
				{
					if(!empty($ltAmount))
					{
						//query
						if(in_array("income", $allCategories) && in_array("expense", $allCategories))
						{
							if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						}
						else if(in_array("income", $allCategories))
						{
							if(!empty($allIncomeDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						
						}
						else if(in_array("expense", $allCategories))
						{
							if(!empty($allExpenseDesc))
							{
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
								window.location.href="admin_report.php"</script>';
							}
						}
					}
					else
					{
						//go back
						echo '<script type="text/javascript"> alert("Fill all the required fields!") 
							window.location.href="admin_report.php"</script>';
					}
				}
			}
			else
			{
				if(!empty($allDateFrom) && !empty($allDateTo) && $allDateFrom<=$allDateTo)
				{
					//query
					if($allAmount=='any')
					{
						if(in_array("income", $allCategories) && in_array("expense", $allCategories))
						{
							if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."'  AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						}
						else if(in_array("income", $allCategories))
						{
							if(!empty($allIncomeDesc))
							{
								foreach ($allIncomeDesc as $incomeDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."'  AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
							}
						
						}
						else if(in_array("expense", $allCategories))
						{
							if(!empty($allExpenseDesc))
							{
								foreach ($allExpenseDesc as $expenseDesc)
								{
									$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
									
									if($query_run = mysql_query($query))
									{
										while($query_row = mysql_fetch_assoc($query_run))
										{
											$transNo[$x] = $query_row['tNo'];
											$date[$x] = $query_row['date'];
											$category[$x] = $query_row['category'];
											$description[$x] = $query_row['description'];
											$amount[$x] = $query_row['amount'];
											$totalPrint = $totalPrint + $amount[$x];
											$x++;
										}
									}
									else
									{
										//die(mysql_error());
										echo '<script type="text/javascript"> alert("Something worng!") 
												window.location.href="admin_report.php"</script>';
									}
								}
							}
							else
							{
								//go back
								echo '<script type="text/javascript"> alert("Fill all the fields!") 
								window.location.href="admin_report.php"</script>';
							}
						}
					}
					else if($allAmount=='gt')
					{
						if(!empty($gtAmount))
						{
							//query
							if(in_array("income", $allCategories) && in_array("expense", $allCategories))
							{
								if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
								{
									foreach ($allIncomeDesc as $incomeDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								
									foreach ($allExpenseDesc as $expenseDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									//go back
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
										window.location.href="admin_report.php"</script>';
								}
							}
							else if(in_array("income", $allCategories))
							{
								if(!empty($allIncomeDesc))
								{
									foreach ($allIncomeDesc as $incomeDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
										window.location.href="admin_report.php"</script>';
								}
							
							}
							else if(in_array("expense", $allCategories))
							{
								if(!empty($allExpenseDesc))
								{
									foreach ($allExpenseDesc as $expenseDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount>='".mysql_real_escape_string($gtAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									//go back
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
								}
							}
						}
						else
						{
							//go back
							echo '<script type="text/javascript"> alert("Fill all the required fields!") 
									window.location.href="admin_report.php"</script>';
						}
					}
					else if($allAmount=='lt')
					{
						if(!empty($ltAmount))
						{
							//query
							if(in_array("income", $allCategories) && in_array("expense", $allCategories))
							{
								if(!empty($allIncomeDesc) && !empty($allExpenseDesc))
								{
									foreach ($allIncomeDesc as $incomeDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								
									foreach ($allExpenseDesc as $expenseDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									//go back
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
										window.location.href="admin_report.php"</script>';
								}
							}
							else if(in_array("income", $allCategories))
							{
								if(!empty($allIncomeDesc))
								{
									foreach ($allIncomeDesc as $incomeDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('income')."' AND description = '".mysql_real_escape_string($incomeDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
										window.location.href="admin_report.php"</script>';
								}
							
							}
							else if(in_array("expense", $allCategories))
							{
								if(!empty($allExpenseDesc))
								{
									foreach ($allExpenseDesc as $expenseDesc)
									{
										$query = "SELECT * FROM all_transactions WHERE category = '".mysql_real_escape_string('expense')."' AND description = '".mysql_real_escape_string($expenseDesc)."' AND amount<='".mysql_real_escape_string($ltAmount)."' AND date>='".mysql_real_escape_string($allDateFrom)."'  AND date<='".mysql_real_escape_string($allDateTo)."'";
										
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												$transNo[$x] = $query_row['tNo'];
												$date[$x] = $query_row['date'];
												$category[$x] = $query_row['category'];
												$description[$x] = $query_row['description'];
												$amount[$x] = $query_row['amount'];
												$totalPrint = $totalPrint + $amount[$x];
												$x++;
											}
										}
										else
										{
											//die(mysql_error());
											echo '<script type="text/javascript"> alert("Something worng!") 
													window.location.href="admin_report.php"</script>';
										}
									}
								}
								else
								{
									//go back
									echo '<script type="text/javascript"> alert("Fill all the fields!") 
									window.location.href="admin_report.php"</script>';
								}
							}
						}
						else
						{
							//go back
							echo '<script type="text/javascript"> alert("Fill all the required fields!") 
								window.location.href="admin_report.php"</script>';
						}
					}
				}
				else
				{
					//go back
					echo '<script type="text/javascript"> alert("Fill all the required fields with correct informations!") 
							window.location.href="admin_report.php"</script>';
				}
			}
		}
		else
		{
			//go back
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_report.php"</script>';
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
      					<div class="row">
							<div class="col-md-12">
								<div style="text-align: center;" class="print_top">
									<div class="print_header">
										<img style="width: 15%;" src="img/logo.png" alt="">				
										<h1>LEADING UNIVERSITY</h1>
										<p>A Promise To Lead</p>
										
									</div>
								</div>
							</div>
						</div>
			   
               <div class="container" style="padding: 50px 0px;">
                    <form action="admin_report.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">                  
                  		<div class="row" id="a">
						<h1 class="btn btn-primary" style="width:100%;font-size:30px">Report</h1>
						<hr style="margin: 30px 0px;">
						<div class="row">
                        <div class="col-md-12">
                           <table class="table table-hover">
                              <thead>
                                 <tr>
                                    <th>Transaction No</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th style="text-align: right; ">Amount</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td><?php
									if(isset($_POST['allCreateReport']))
									{
										if(!empty($transNo))
										{
											foreach ($transNo as $tNo)
											{
												echo $tNo.'</br>';
											}
										}
										else
											echo ' ';
									}
									else
										echo ' ';
									?></td>
                                    <td><?php
									if(isset($_POST['allCreateReport']))
									{	
										if(!empty($date))
										{
											foreach ($date as $d)
											{
												echo $d.'</br>';
											}
										}
										else
											echo ' ';
									}
									else
										echo ' ';
									?></td>
                                    <td><?php
									if(isset($_POST['allCreateReport']))
									{
										if(!empty($category))
										{
											foreach ($category as $cat)
											{
												echo $cat.'</br>';
											}
										}
										else
											echo ' ';
									}
									else
										echo ' ';
									?></td>
                                    <td><?php
									if(isset($_POST['allCreateReport']))
									{
										if(!empty($description))
										{
											foreach ($description as $desc)
											{
												echo $desc.'</br>';
											}
										}
										else
											echo ' ';
									}
									else
										echo ' ';
									?></td>
                                    <td style="text-align: right; "><?php
									if(isset($_POST['allCreateReport']))
									{
										if(!empty($amount))
										{
											foreach ($amount as $amo)
											{
												echo $amo.'</br>';
											}
										}
										else
											echo ' ';
									}
									else
										echo ' ';
									?></td>
                                 </tr>
                                 <tr>
                                 	<!--<td></td>
                                 	<td></td>
                                 	<td></td>
                                 	<td><b>Total</b></td>
                                 	<td style="text-align: right; "><b><?php echo $totalPrint; ?></b></td>-->
                                 </tr>
                              </tbody>
                           </table>
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
