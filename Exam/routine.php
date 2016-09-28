<?php	include'include/header.php';	?>

	<!-------------Container Starts------------------------>
	<div class="container">
		<div class="row">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<div class="panel panel-default">
					<div class="notice_border" >
						<div class="panel-body">
							<div class="bs-example bs-example-tabs">
								<ul role="tablist" class="nav nav-tabs" id="myTab">
								  <li class=""><a data-toggle="tab" role="tab" href="#cse_routine">CSE</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#eee_routine">EEE</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#civil_routine">CIVIL</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#archi_routine">ARCHI</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#llb_routine">LLB</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#bba_routine">BBA</a></li>
								  <li class=""><a data-toggle="tab" role="tab" href="#eng_routine">ENGLISH</a></li>
								</ul>
								<div class="tab-content" id="myTabContent">
						
									<!-----------------CSE Routine---------------------->
									<div id="cse_routine" class="tab-pane fade in active">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
													<?php
														// retrieve all file form db
														$query_c = mysql_query("SELECT * FROM routine  WHERE dept='cse' ORDER by id DESC LIMIT 2");
													?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_c)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
									
									<!-----------------EEE Routine---------------------->
									<div id="eee_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
												<?php
													$query_e = mysql_query("SELECT * FROM routine  WHERE dept='eee' ORDER by id DESC LIMIT 2");
												?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_e)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
								
									<!-----------------CIVIL Routine---------------------->
									<div id="civil_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
												<?php
													$query_ci = mysql_query("SELECT * FROM routine  WHERE dept='civil' ORDER by id DESC LIMIT 2");
												?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_ci)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
									
									<!-----------------ARCHI Routine---------------------->
									<div id="archi_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
												<?php
													$query_a = mysql_query("SELECT * FROM routine  WHERE dept='archi' ORDER by id DESC LIMIT 2");
												?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_a)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
									
									<!-----------------LLB Routine---------------------->
									<div id="llb_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
												<?php
													$query_l = mysql_query("SELECT * FROM routine  WHERE dept='law' ORDER by id DESC LIMIT 2");
												?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_l)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
									
									<!-----------------BBA Routine---------------------->
									<div id="bba_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
													<?php
														$query_b = mysql_query("SELECT * FROM routine  WHERE dept='bba' ORDER by id DESC LIMIT 2");
													?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_b)) : ?>
															<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
																<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
																Downloaded: <?php echo $row['count']?> times
															</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
								
									<!-----------------ENG Routine---------------------->
									<div id="eng_routine" class="tab-pane fade">
										<div class="panel1">
											<div class="panel panel-default">
												<div class="panel-heading" >
													<h4 class="panel-title" text align="center">Download Routine</h4>
												</div>
												<br>
													<?php
														$query_en = mysql_query("SELECT * FROM routine  WHERE dept='eng' ORDER by id DESC LIMIT 2");
													?>
												<div class="panel-body">
													<?php while($row = mysql_fetch_array($query_en)) : ?>
														<div style="max-width: 400px; margin: 0 auto 10px;" class="well">
															<h3><a href="download.php?file_id=<?php echo $row['id']?>"><?php echo $row['name'] ?></a></h3>
															Downloaded: <?php echo $row['count']?> times
														</div>
													<?php endwhile ?>
												</div>
											</div>
										</div>
									</div>
									<!-----------------ENG Routine ENd---------------------->
					
								</div>
							</div><br><br><br><br><br><br>
						</div>
					</div>
				</div>
			</div>
		
			<div class="col-md-1"></div>
		
		</div>
	</div>
	<!-------------Container ENDs------------------------>

<?php	include'include/footer.php';	?>
