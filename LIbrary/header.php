		<div class="header_area" style="background:#3276b1;">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-2 logo_area" style="margin:10px 0px;">
						<a href="index.php"><img src="img/logo.jpg" alt=""  class="img-responsive" style="background:#3276b1;"/></a>
					</div>
					<div class="col-md-8 title_area" >
						<h1>Library Management, Leading University  </h1>	
						<div class="manue_area" style="margin-top:10px;">
							<nav class="navbar navbar-default navbar-static-top" role="navigation">
								<div class="container-fluid navdiv" style=" background:#3276b1 !important; color:#3276b1 !important;">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" value="home">				
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
										<ul class="nav navbar-nav">
											<li class=""><a href="index.php" class="icon_menu"><i class="icon-home icon_style"></i>Home<span class="sr-only">(current)</span></a></li>
											<li class=""><a href="loginbooks.php" class="icon_menu"><i class="icon-book icon_style"></i>Books</a></li>
											<li class=""><a href="about.php" class="icon_menu"><i class="icon-info-sign icon_style"></i>About</a></li>
											<li class=""><a href="contact.php" class="icon_menu"><i class="icon-phone icon_style"></i>Contact</a></li>
											<li class=""><a href=""  data-toggle="modal" data-target="#login_admin"  class="icon_menu"><i class="icon-user icon_style"></i>Login</a></li>
											
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
						</div><!-- end of manue_area-->
					</div><!-- end of title_area-->
					<div class="col-md-1"></div>
				</div>
			</div>
					<div class="modal fade" id="login_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel"></h4>
							  </div>
							  <div class="modal-body log_in">
								<center><h3>Log In</h3></center>
								<form class="renew_form" action="index.php" method="post">
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Admin ID :</label></br>
										<input type="text" class="form-control form_style" name="u_id" placeholder="Admin ID" required>
									</div>
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Password :</label></br>
										<input type="password" class="form-control form_style" name="pass" placeholder="Password" required>
									</div>
									<div class="modal-footer">
									<button type="submit" class="btn btn-primary" name="admin_log">Login</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</form>
							  </div>
							</div>
						  </div>
						</div>
					</div>
		</div><!--end of header area-->
		<div class="slide_area" style="margin:10px 0px;">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->
						  <ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active" ></li>
							<li data-target="#carousel-example-generic" data-slide-to="1" ></li>
							<li data-target="#carousel-example-generic" data-slide-to="2" ></li>
							<li data-target="#carousel-example-generic" data-slide-to="3" ></li>
							<li data-target="#carousel-example-generic" data-slide-to="4" ></li>
						  </ol>

						  <!-- Wrapper for slides -->
						  <div class="carousel-inner">
							<div class="item active">
							  <img src="img/p1.jpg" alt="...">
							  <div class="carousel-caption">
							  </div>
							</div>
							<div class="item">
							  <img src="img/p2.jpg" alt="...">
							  <div class="carousel-caption">
							  </div>
							</div>
							<div class="item">
							  <img src="img/p4.jpg" alt="...">
							  <div class="carousel-caption">
							  </div>
							</div>
							<div class="item">
							  <img src="img/p5.jpg" alt="...">
							  <div class="carousel-caption">
							  </div>
							</div>
							<div class="item">
							  <img src="img/p6.jpg" alt="...">
							  <div class="carousel-caption">
							  </div>
							</div>
						  </div>

						  <!-- Controls -->
						 
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of slide_area-->