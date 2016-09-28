		<div class="header_area" style="background:#3276b1;">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-2 logo_area" style="margin:10px 0px;">
						<a href="home_admin.php"><img src="img/logo.jpg" alt=""  class="img-responsive" style="background:#3276b1;"/></a>
					</div>
					<div class="col-md-8 title_area" >
					<?php
						if(isset($_SESSION['admin_id']) && isset($_SESSION['password']))
								{
									$user_id=$_SESSION['admin_id'];
									$pass=$_SESSION['password'];
									$query="select * from library_admin_info where admin_id='$user_id' and password='$pass' ";
									$result = mysqli_query($con,$query);
									foreach($result as $row)
												{
													$name=$row['name'];
													$temp = "";
													for($i=0; $i< strlen($name) ; $i++)
													{
														if($name[$i]==' ') break;
														$temp = $temp . $name[$i];
													}
													$name = $temp;

													$id=$row['admin_id'];
													//$email=$row['email'];
													//$fine=$row['fine'];
													
												}
					?>
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
											<li class=""><a href="home_admin.php" class="icon_menu"><i class="icon-home icon_style"></i>Home<span class="sr-only">(current)</span></a></li>
											<li class=""><a href="books_admin.php" class="icon_menu"><i class="icon-book icon_style"></i>Books</a></li>
											<li class=""><a href="about_admin.php" class="icon_menu"><i class="icon-info-sign icon_style"></i>About</a></li>
											<li class=""><a href="contact_admin.php" class="icon_menu"><i class="icon-phone icon_style"></i>Contact</a></li>
											<li class="dropdown d_class" >
												<a href=""id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="icon_menu"><i class="icon-user icon_style"></i><?php echo $name;?>
													<span class="caret"></span>
												</a>
												<ul class="dropdown-menu manue_class" role="menu" aria-labelledby="dLabel">
													<li><a href="admin.php">Book Transaction</a></li>
													<li><a href=""  data-toggle="modal" data-target="#view_admin"style="color:black !important;">View All Admin</a></li>
													<li><a href=""  data-toggle="modal" data-target="#add_admin"style="color:black !important;">Add Admin</a></li>
													<li><a href=""  data-toggle="modal" data-target="#remove_admin"style="color:black !important;">Remove Admin</a></li>
													<li><a href=""  data-toggle="modal" data-target="#change_pass"style="color:black !important;">Change Password</a></li>
													<li><a href=""  data-toggle="modal" data-target="#send_msg"style="color:black !important;">Send Message</a></li>
													<li><a href="logout.php">Logout</a></li>
												</ul>
											</li>
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
							<?php }?>
						</div><!-- end of manue_area-->
					</div><!-- end of title_area-->
					<div class="col-md-1"></div>
				</div>
			</div>
			
			<!-- Modal Class-->		
					<div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel"></h4>
								</div>
								<div class="modal-body log_in">
									<center><h3>Add New Admin</h3></center>
									<form class="renew_form" action="" method="post">
										<div class="form-group">
											<label  class="col-md-4 renew_label ">New Admin ID :</label></br>
											<input type="text" class="form-control form_style" name="a_id" placeholder="Admin ID" required>
										</div>
										<div class="form-group">
											<label  class="col-md-4 renew_label ">Name :</label></br>
											<input type="text" class="form-control form_style" name="a_name" placeholder="Admin Name" required>
										</div>
										<div class="form-group">
											<label  class="col-md-4 renew_label ">Email :</label></br>
											<input type="text" class="form-control form_style" name="a_email" placeholder="Email Address" required>
										</div>
										<div class="form-group">
											<label  class="col-md-4 renew_label ">Contact :</label></br>
											<input type="text" class="form-control form_style" name="c_no" placeholder="Contact Number " required>
										</div>
										<div class="form-group">
											<label  class="col-md-4 renew_label ">Password :</label></br>
											<input type="password" class="form-control form_style" name="a_pass" placeholder="Password" required>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" name="admin_add">Add</button>
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="view_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel"></h4>
								</div>
								<div class="modal-body log_in">
									<?php
										$query="select * from library_admin_info ";
										$result = mysqli_query($con,$query);
										if($result)
											{
									?>
									<center><h3> List of All Admin</h3></center>	
									<div class="table-responsivr">
										<table class="table table-bordered">
											<tr>
												<th>Name</th>
												<th>ID</th>
												<th>Email</th>
												<th>Contact</th>
											</tr>
											<?php 
												while($row1=mysqli_fetch_array($result))
												{
													echo "<tr>";
														echo "<td>".$row1['name']."</td>";
														echo "<td>".$row1['admin_id']."</td>";
														echo "<td>".$row1['admin_email']."</td>";
														echo "<td>".$row1['contact_number']."</td>";
													echo "</tr>";		
												}
											}
											else
											{
												echo '<script type="text/javascript">';
													echo 'alert("No Data Found")';
												echo '</script>';
											}
											?>
										</table>
									</div>
									
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade" id="remove_admin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel"></h4>
							  </div>
							  <div class="modal-body log_in">
								<center><h3>Remove Admin</h3></center>
								<form class="renew_form" action="" method="post">
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Admin ID :</label></br>
										<input type="text" class="form-control form_style" name="r_id" placeholder="Admin ID" required>
									</div>
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Password :</label></br>
										<input type="password" class="form-control form_style" name="r_pass" placeholder="Password" required>
									</div>
									<div class="modal-footer">
									<button type="submit" class="btn btn-primary" name="admin_remove">Remove</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</form>
							  </div>
							</div>
						  </div>
						</div>
					</div>
					<div class="modal fade" id="change_pass" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel"></h4>
							  </div>
							  <div class="modal-body log_in">
								<center><h3>Change Your Password</h3></center>
								<form class="renew_form" action="" method="post">
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Old password :</label></br>
										<input type="password" class="form-control form_style" name="o_pass" placeholder="Old Password" required>
									</div>
									<div class="form-group">
										<label  class="col-md-4 renew_label ">New Password :</label></br>
										<input type="Password" class="form-control form_style" name="n_pass" placeholder="New Password" required>
									</div>
									<div class="form-group">
										<label  class="col-md-4 renew_label ">Confirm Password :</label></br>
										<input type="Password" class="form-control form_style" name="c_pass" placeholder="Confirm Password" required />
									</div>
									<div class="modal-footer">
									<button type="submit" class="btn btn-primary" name="pass_change">Change</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<input type="hidden" name="id" value="<?php echo $id;?>" />
								</form>
							  </div>
							</div>
						  </div>
						</div>
					</div>
					<!-- Modal msg -->
					<div class="modal fade" id="send_msg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header" style="background:#3276b1; color:white;">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel">Send Message</h4>
								</div>
								<form action="" method="post">
										<div class="modal-body" style="background:#3276b1; color:white; font-size:15px;">
										<center>
											<input type="number" name="std_id" placeholder="Student ID" reqauired /></br></br>
											Write down your message here </br>
											<textarea name="message" maxlength="560" cols="25" rows="10" required></textarea>
										</center>
									</div>
									<div class="modal-footer" style="background:#3276b1;">
										<button type="submit" class="btn btn-primary" name="message_form" style="background:white; color:black;">Send</button>
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									</div>
								</form>
							</div>
						</div>
					</div><!--end of modal msg-->
		</div> <!--end of header area-->
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
						  <div class="carousel-inner" style="background:#f0f4fa; height:auto">
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
<?php
	if(isset($_POST['pass_change']))
	{
		$new=$_POST['n_pass'];
		$old=$_POST['o_pass'];
		$confirm=$_POST['c_pass'];
		$u_id=$_POST['id'];
		if($confirm==$new)
		{
			$query = "update library_admin_info set password='$new' where admin_id='$u_id' AND password='$old'" ;
			$result = mysqli_query($con,$query);
			
			if($result)
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Your Password has Changed Successfully.")';
					echo '</script>';
			}
			else
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
			}
		}
		else
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Please Confirm Your Password Correctly.")';
					echo '</script>';
			}
	}
	if(isset($_POST['admin_add']))
	{
		$name=$_POST['a_name'];
		$email=$_POST['a_email'];
		$u_id=$_POST['a_id'];
		$pass=$_POST['a_pass'];
		$contact=$_POST['c_no'];
		$query = "INSERT INTO library_admin_info(`name`, `admin_id`, `admin_email`, `password`,`contact_number`) VALUES ('$name','$u_id','$email','$pass','$contact')";
		
			$result = mysqli_query($con,$query);
			
			if($result)
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Successfully Added.")';
					echo '</script>';
			}
			else
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
			}
	}
	if(isset($_POST['admin_remove']))
	{
		$pass=$_POST['r_pass'];
		$u_id=$_POST['r_id'];
		$query = "Delete From library_admin_info where admin_id='$u_id' AND password='$pass'" ;
			$result = mysqli_query($con,$query);
			
			if($result)
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Admin Removed Successfully.")';
					echo '</script>';
			}
			else
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again!")';
					echo '</script>';
			}
	}
?>
<?php	
	if(isset($_POST['message_form']))
		{
			$admin_id=$_SESSION['admin_id'];
			$user_id = $_POST['std_id'];
			$message = $_POST['message'];
			$query = "INSERT INTO `user_message` (`user_id`, `admin_id`, `message`, `time`) VALUES ($user_id, $admin_id, '$message', now());";
			$result = mysqli_query($con,$query);
			if($result)
			{
				echo '<script type="text/javascript">';
					echo 'alert("Message Sent Successfully !!")';
				echo '</script>';
			}
			else 
			{
				echo '<script type="text/javascript">';
					echo 'alert("Sorry Try Again")';
				echo '</script>';
			}								
		}
?>