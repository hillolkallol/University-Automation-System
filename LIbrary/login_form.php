
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">edit book</h4>
							  </div>
							  <div class="modal-body">
								<center><h3>Log In</h3></center>
								<form class="renew_form" action="loginhome.php" method="post">
									<div class="form-group">
										<label  class="col-md-4 renew_label ">User_ID :</label></br>
										<input type="text" class="form-control form_style" name="u_id" placeholder="User ID" required>
									</div>
									<div class="form-group">
										<label  class="col-md-4 renew_label ">password :</label></br>
										<input type="password" class="form-control form_style" name="pass" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="submit" value="login" name="login" class="btn btn-primary "/>
									</div>
								</form>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="eform">Save changes</button>
								</form>
							  </div>
							</div>
						  </div>
						</div>