<?php	include'include/header.php';	?>

	<!----------------Container Starts------------------------>
	<div class="container">
		<div class="row">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<div class="panel panel-default">
					<div class="notice_border" >	
						<div class="panel-body">
							<div class="bs-example bs-example-tabs">
								<ul role="tablist" class="nav nav-tabs" id="myTab">
								  <li class="active"><a data-toggle="tab" role="tab" href="#all">Official Notices</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#cse_routine">CSE</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#eee_routine">EEE</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#civil_routine">CIVIL</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#archi_routine">ARCHI</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#llb_routine">LLB</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#bba_routine">BBA</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#eng_routine">ENGLISH</a></li>
								</ul>
								<div class="tab-content" id="myTabContent">	
									
									<!-----------------All Notices------------------------>	
									<div id="all" class="tab-pane fade in active">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													
													<?php
														// SQL query to Display Details.
														$query_all = mysql_query("SELECT * FROM notice_info  WHERE dept='all' ORDER by date desc  LIMIT 5");
														$all_no=1;
													?>
													
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															 <thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_all)) :
																		echo '<tr>';
																			echo '<td>'.$all_no.'</td>';
																			echo '<td>'.$row['text'].'</td>';
																			echo '<td>'.$row['user_name'].'</td>';
																			echo '<td>'.$row['date'].'</td>';
																		echo '</tr>';
																		$all_no++;
																		endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>

									<!-----------------CSE Notices------------------------>	
									<div id="cse_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														// SQL query to Display Details.
														$query_c = mysql_query("SELECT * FROM notice_info  WHERE dept='cse' ORDER by date desc  LIMIT 5");
														$cse_no=1;
													?>
												<div class="panel-body">	
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
															<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_c)) :
																	echo '<tr>';
																		echo '<td>'.$cse_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$cse_no++;
																	endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<!-----------------EEE Notices------------------------>	
									<div id="eee_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														// SQL query to Display Details.
														$query_c = mysql_query("SELECT * FROM notice_info  WHERE dept='cse' ORDER by date desc  LIMIT 5");
														$eee_no=1;
													?>
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_c)) :
																	echo '<tr>';
																		echo '<td>'.$eee_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$eee_no++;
																	endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								
									<!------------------CIVIL Notices----------->
									<div id="civil_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														$query_ci = mysql_query("SELECT * FROM notice_info  WHERE dept='civil' ORDER by date DESC LIMIT 5");
														$civil_no=1;
													?>
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_ci)) :
																	echo '<tr>';
																		echo '<td>'.$civil_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$civil_no++;
																	endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>	
									</div>
						
									<!----------------ARCHI Notices------------------->	
									<div id="archi_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														$query_a = mysql_query("SELECT * FROM notice_info  WHERE dept='archi' ORDER by date DESC LIMIT 5");
														$archi_no=1;
													?>
												
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_a)) :
																	echo '<tr>';
																		echo '<td>'.$archi_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$archi_no++;
																	endwhile
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								
									<!----------------LLB Notices------------>	
									<div id="llb_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														$query_l = mysql_query("SELECT * FROM notice_info  WHERE dept='law' ORDER by date DESC LIMIT 5");
														$llb_no=1;
													?>
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_l)) :
																	echo '<tr>';
																		echo '<td>'.$llb_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$llb_no++;
																	endwhile
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>	
							
									<!------------BBA Notices------------->	
									<div id="bba_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														$query_b = mysql_query("SELECT * FROM notice_info  WHERE dept='bba' ORDER by date DESC LIMIT 5");
														$bba_no=1;
													?>
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_b)) :
																	echo '<tr>';
																		echo '<td>'.$bba_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$bba_no++;
																	endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
							
									<!----------------ENG Notices---------------->	
									<div id="eng_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" align="center"> Latest Notices </div>
													<?php
														$query_en = mysql_query("SELECT * FROM notice_info WHERE dept='eng' ORDER by date DESC LIMIT 5");
														$eng_no=1;
													?>
												<div class="panel-body">
													<div class="table-responsive">
														<table  id="delTable"  class="table table-bordered" >
															<thead>
																<tr>
																	<th><div class="center1">Number</div></th>
																	<th><div class="center1">Notice</div></th>
																	<th><div class="center1">User Name</div></th>
																	<th><div class="center1">Date</div></th>
																</tr>
															</thead>
															<tbody>
																<?php while($row = mysql_fetch_array($query_en)) :
																	echo '<tr>';
																		echo '<td>'.$eng_no.'</td>';
																		echo '<td>'.$row['text'].'</td>';
																		echo '<td>'.$row['user_name'].'</td>';
																		echo '<td>'.$row['date'].'</td>';
																	echo '</tr>';
																	$eng_no++;
																	endwhile 
																?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!----------------------ENg Notice End-------------> 
								
								</div>
							</div><br><br><br><br><br>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-1"></div>
			
		</div>
	</div>
	<!--------------------Container Ends-------------------->
			
<?php	include'include/footer.php';	?>
