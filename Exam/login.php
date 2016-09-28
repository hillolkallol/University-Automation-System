<?php 	include'include/header.php'; 	?>

	<!------------------Container Starts------------------------>
	<div class="container">
		<div class="row"><br><br><br><br>
		
			<div class="col-md-4"></div>
			
			<div class="col-md-4">
				<div class="loginwrap">
					<div class="panel-heading">
						<div class="panel-title">	
							<div class="log1" ><strong >Login</strong> </div>
						</div>
					</div>
					<div class="panel-body">
						<form enctype="multipart/form-data" method="POST" action="login_a.php">
							<div class="form_sep">
								<label for="id">User ID <span style="color:red">*</span></label>
								<input type="text" id="id" class="form-control" name="userid"  placeholder="Enter User Id" required>
							</div>
							<br>
							
							<div class="form_sep">
								<label for="pass">Password  <span style="color:red">*</span></label>
								<input type="password" id="pass" class="form-control" name="userpass" placeholder="Enter Your Password" required>
							</div>
							<br>
							
							<input type='reset' value='Reset' class="btn btn-primary">
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type='submit' value='Submit' class="btn btn-primary">
						</form>
					</div>
				</div>
			</div>
			
			<div class="col-md-4"></div>
			
		</div><br><br><br><br>
	</div>
	<!------------------------------------------>
	
<?php	include "include/footer.php";	?>		
