<?php	include'include/header.php'; 	?>

	<!-------------------1st Container Starts---------------->
	<div class="container">
		<div class="row"><br>
		
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<marquee>
					<div class="alert alert-info">
						<strong>&nbsp;You can get your result here !!! 
							Obviously it is very much helpful for you !!! 
							Stay tuned with us !!! Thank you !!!&nbsp;
						</strong>
					</div>
				</marquee>
			</div><br>
			
			<div class="col-md-1"></div>
			
		</div>
	</div>
	<!-------------------1st Container ENDs---------------->
	
	<!-------------------2nd Container Starts---------------->
	<div class="container">
		<div class="row">
			
			<div class="col-md-2"></div>
			
			<div class="col-md-8">
				<div class="semester">
					
					<div class="loginwrap">
						<div class="panel-heading">
							<div class="panel-title">
								<div class="log1" ><strong >Total Result</strong> </div>
							</div>
						</div>
						<div class="panel-body">
							<form enctype="multipart/form-data"  method="POST" action="total_result.php">
								<div class="form_sep">
									<label for="id1">Student ID <span style="color:red">*</span> </label>
									<input type="text" id="id1" class="form-control" name="studentid" placeholder="Enter Your ID" required>
								</div>
								<br>
								
								<div class="form_sep">
									<label for="pass">Password  <span style="color:red">*</span></label>
									<input type="password" id="pass" class="form-control" name="studentpass" placeholder="Enter Your Password" required>
								</div>
								<br>
								
								<input type="reset" name="reset" class="btn btn-primary"value="Reset">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" name="submit" class="btn btn-primary" value="Submit">
							</form>
						</div>
					</div>
					
					<br>
					
					<div class="loginwrap">
						<div class="panel-heading">
							<div class="panel-title">
								<div class="log1" > <strong >Single Semester Result</strong> </div>
							</div>
						</div>
						<div class="panel-body">
							<form enctype="multipart/form-data"  method="POST" action="semester_result.php">
								<div class="form_sep">
									<label for="id1">Student ID <span style="color:red">*</span> </label>
									<input type="text" id="id1" class="form-control" name="studentid" placeholder="Enter Your ID" required>
								</div>
								<br>
								
								<div class="form_sep">
									<label for="pass">Password  <span style="color:red">*</span></label>
									<input type="password" id="pass" class="form-control" name="studentpass" placeholder="Enter Your Password" required>
								</div>
								<br>
								
								<div class="form_sep">
									<label for="sem1">Semester <span style="color:red">*</span> </label>
									<select id="sem1" class="form-control" name="sem" required>
										<option value="Spring">Spring</option>
										<option value="Summer">Summer</option>
										<option value="Fall">Fall</option>
									</select>
								</div>
								<br>
								
								<div class="form_sep">
									<label for="y1">Year<span style="color:red">*</span></label><br>
									<select id="y1" class="form-control" name="year" required>
										<?php 
											$i=0;$year=2001; $yearlimit=date("Y");
											while($year<=$yearlimit )
											{  ?>
												<option> <?php echo $year ;?> </option> <?php
												$year=$year+1;
											} 
										?> 
									</select>
								</div>
								<br>
								
								<input type="reset" name="reset" class="btn btn-primary"value="Reset">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" name="submit" class="btn btn-primary" value="Submit">
							</form>
						</div>
					</div>
					
				</div><br>
			</div>
			
			<div class="col-md-2"> </div>
			
		</div>	<br><br>		
	</div>
	<!----------------2nd Container Ends---------------------->			

<?php 	include 'include/footer.php' ;	?>		


