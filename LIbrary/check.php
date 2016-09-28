
<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My First Boot_starp</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/responsivemobilemenu.css" type="text/css"/>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
		<script type="text/javascript" src="js/responsivemobilemenu.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
	
    <body>
		<div class="header_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<center><img src="img/head.jpg" alt="" /></center>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of header_area-->
		<div class="menu_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10 menu">
						<?php
							if(isset($_SESSION['user_id']) && isset($_SESSION['password']))
								{?>
								<nav class="navbar navbar-default" role="navigation">
								  <div class="container-fluid navdiv">
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
										<li class="active cur"><a href="homelogin.php">Home<span class="sr-only">(current)</span></a></li>
										<li class="other"><a href="bookslogin.php">Books</a></li>
										<li class="other"><a href="aboutlogin.php">About</a></li>
										<li class="other"><a href="contactloogin.php">Contact</a></li>
										<li class="other"><a href="noticelogin.php">Notice</a></li>
									  </ul>
									</div><!-- /.navbar-collapse -->
								  </div><!-- /.container-fluid -->
								</nav>
						<?php
							}
							else
								{
								?>
							<nav class="navbar navbar-default" role="navigation">
								  <div class="container-fluid navdiv">
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
										<li class="active cur"><a href="home.php">Home<span class="sr-only">(current)</span></a></li>
										<li class="other"><a href="books.php">Books</a></li>
										<li class="other"><a href="about.php">About</a></li>
										<li class="other"><a href="contact.php">Contact</a></li>
										<li class="other"><a href="notice.php">Notice</a></li>
									  </ul>
									</div><!-- /.navbar-collapse -->
								  </div><!-- /.container-fluid -->
								</nav>
							<?php
							}
							?>	
					
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of menu_area-->
		<div class="slide_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<center><img src="img/p1.jpg" alt="" /></center>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of slide_area-->
		<div class="search_area">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<div class="search_book">
							<center>
								<form class="form-inline find_form" action="ViewSearch.php" role="form" method="post" id="result-form">			
									<div class="form-group">	
										<select class="form-control find " name="cat_value" required >
											<option value="">Keyword</option>
											<option value="title">Title</option>
											<option value="author">Author</option>
											<option value="isbn">ISBN</option>
											<option value="book_id">Book Id</option>
										</select>
										<input type="trxt" name="catagori" class= "form-control find" placeholder="Find Your Book"/>
										<input id="result-submit" type="submit" value="submit" name="" class="btn btn-primary find_btn"/>
									</div>
								</form>
							</center>
						</div><!--end of search-->
						<div class="result"> </div>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div> <!--end of search_area-->
		<div class="para_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-6 others">
							<h3>About LU Library</h3>
							<p>
								The Central Library of Leading University, 
								which started its journey in 2001 with only 04 rooms in the Academic Building A has now been housed in its own 4-storied Central Library Building. 
								Starting with a very meagre collection, the library has now been enriched with more than 54 thousand books, 6 thousand hard copy journals/ periodicals and 23 Dailies for its users. 
								It also serves with more than 4 thousand electronic journals/ resources, which are being subscribed through
								Bangladesh-INASP-PERI network. As the campus has a LAN, these e-journals/ resources can be accessed from all the PCs of each and
								<a href="about.php">Continue.....</a>
							</p>
					</div>
					<div class="col-md-3 log_in">
						<center><h3>Log In</h3></center>
						<form class="renew_form" action="home.php" method="post">
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
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
		<div class="home_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-6 n_book">
						<h3>List of New Books</h3>
						<div class="table-responsive tb">
							<table class="table">
							`<tr class="info">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							<tr class="success">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							<tr class="info">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							<tr class="success">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							<tr class="info">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							<tr class="success">
								<td>Book ID</td>
								<td>Title</td>
								<td>Author</td>
								<td>Edition</td>
							</tr>
							</table>
						</div>
					</div>
					<div class="col-md-3 hour">
						<div>
							<center><h3>Library Hour</h3></center>
							<center>	
								<p class="time">
									<B>Saturday to Wednesday : </B></br>
									9.00am to 3.00pm.</br></br><B>Thursday : </B></br>9.00am to 1.30pm.</br>
									</br><B>Friday : </B> Closed.
								</p>
							</center>
						</div><!--end of hour-->
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div>
		<div class="footer_area">
			<div class="container">
				<div class="row">
					<div class="col-md-6 footer_menu">
					 <ul>
					 	<li><a href="">Home</a></li>
						<li><a href="">Tarms & Conditions</a></li>
						<li><a href="">Contact</a></li>
						
					 </ul>
					</div>
					<div class="col-md-6 ">
					<div class="copy">
						<p>
						<strong>Design & Developed By:</strong>
						CSE 26th Batch.Leading University
						</p>
						</div>	
					</div>
				</div>
			</div>
		</div><!--end of fotter_area-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
		<script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
		<script src="js/script.js"></script>
    </body>
</html>
