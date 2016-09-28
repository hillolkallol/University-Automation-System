<!DOCTYPE html>
<?php
//session_start();
include('login.php');
	
?>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Leading University Library Management</title>
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
		<?php
			include('header_teacher.php') // header area
		?>
		<div class="librarian_info_one">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<center><h2 style="background:#3276b1; color:white; padding:10px;">Contact With Librarians</h2></center> 
						<div class="librarian_one">
							<center><h2>Rongmohol Tower Campus</h2></center>
							<div class=" col-md-6 info_one">
								<div class="table-responsive" style="background:#3276b1; color:white;">
									<table class="table">
										<tr>
											<th>Librarian Name:</th>
											<td>Gautam Chakrobarty</td>
										</tr>
										<tr>
											<th>University ID:</th>
											<td>123456</td>
										</tr>
										<tr>
											<th>Contact Number:</th>
											<td>01717744884</td>
										</tr>
										<tr>
											<th>Email Address:</th>
											<td>Gautam@gmail.com</td>
										</tr>
									</table>
								</div>
							</div>
							<div class=" col-md-6 info_two">
								<div class="table-responsive" style="background:#3276b1; color:white;">
									<table class="table">
										<tr>
											<th>Librarian Name:</th>
											<td>Fatema Tuz Zohra</td>
										</tr>
										<tr>
											<th>University ID:</th>
											<td>123458</td>
										</tr>
										<tr>
											<th>Contact Number:</th>
											<td>01718684255</td>
										</tr>
										<tr>
											<th>Email Address:</th>
											<td>Fatema@gmail.com</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
		<div class="librarian_info_two">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="librarian_two">
							<center><h2>Shurma Tower Campus</h2></center>
							
							<div class="col-md-6 info_three">
								<div class="table-responsive" style="background:#3276b1; color:white;">
									<table class="table">
										<tr>
											<th>Librarian Name:</th>
											<td>Shamsia Sharmin</td>
										</tr>
										<tr>
											<th>Contact Number:</th>
											<td>01737976101</td>
										</tr>
										<tr>
											<th>Email Address:</th>
											<td>shamsia@gmail.com</td>
										</tr>
									</table>
								</div>
							</div>
							<div class="col-md-6 info_four">
								<div class="table-responsive" style="background:#3276b1; color:white;">
									<table class="table">
										<tr>
											<th>Librarian Name:</th>
											<td>Moshrur Abu Jafor</td>
										</tr>
										<tr>
											<th>Contact Number:</th>
											<td>01737465701</td>
										</tr>
										<tr>
											<th>Email Address:</th>
											<td>Moshrur@gmail.com</td>
										</tr>
									</table>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
		<div class="meassage">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div style="margin:10px;">
							<?php
								include('contact_form.php');
							?>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div>
		<?php
			include('footer.php') // footer area
		?>
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
    </body>
</html>
