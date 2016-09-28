<?php
	include('login.php');
	//include('home.php');
?>
<!DOCTYPE html>
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
			include('header_student.php') // header area
		?>
		<div class="para_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="about_para" style="background:#3276b1;">
							<center><h2 style="color:white; padding:10px; text-decoration:underline;"><b>About Library</b></h2></center>
							<p style="color:white;margin:12px;">
								The Central Library of leading university started its operation during the establishment of Leading University (LU) in the year 2001.
								The mission of LU Library is to provide innovative and quality Library services for the students, faculty members,
								researchers and staffs. Presently LU Library has a wide collection of Books, Magazines and Journals.
								In addition the numbers of Library Resources are increasing rapidly. LU Library is located at 7th floor,
								of Leading University.The total floor space of LU Library is 2000 sq.ft.
								Authority has further plan to extend the floor capacity of the library. LU Library provides special
								user services for external users under some circumstances. Currently 150 to 200 users visit LU Library
								everyday including researchers and faculty members. The numbers of library user are increasing gradually.
								LU Library is open six days a week. Library users are taking this advantage effectively.
								Currently LU Library is providing Reference Service, Lending service and Reprography services for its users.
								In addition Internet facility, Magazines and Newspapers are also available for the readers.
								A project has been taken for the full automation process of LU Library. 
							</p>
							<p style="color:white;margin:12px;">
								-> After completing the automation process library users will get:
								<ul style="color:white;">
									<li>Fast and smooth Circulation desk Service</li>
									<li>Online Public Access Catalogue commonly known as OPAC facilities</li>
									<li>E-resources access facilities</li>
									<li>Auto alert like e-mail or text message notifications</li>
								</ul>
							</p>
							<p style="color:white;margin:12px;">
								-> The work procedure of automation project will be as follows:
								<ol style="color:white;">
									<li> Server setup</li>
									<li>Installing and configuring each software</li>
									<li>Necessary customization according to need analysis</li>
									<li>Training for the library and IT staff group wise for different modules and software</li>
									<li>Preparing cataloguing policy, Data entry form design, Data entry and supervision</li>
									<li>Testing and evaluation </li>
									<li>Running whole system</li>
									<li>One year support service and user empowerment</li>
								</ol>
							</p>
							<h3 style="color:white;margin:12px;">Rules of Library:</h3>
							<ol style="color:white;">
								<li>Only valid library users are entitled to get Library Facilities.</li>
								<li>All the students are requested to show their ID Card at the  entrance of the Library premises.</li>
								<li>Entrance without ID Card is strictly restricted.</li>
								<li>Personal bags/materials are not allowed inside the library.</li>
								<li>No books will be issued without valid ID Card.</li>
								<li>Students will get two books at a time for 10 days and can be renewed for the same period.</li>
								<li>Late fine taka 05.00 will be charged for an item/day if not returned on due date.</li>
								<li>For any Lost/damaged item a cumulative fine of original price with 20% service charge will be added.</li>
							</ol>
							<div style="margin:25px; background:#3276b1;"><center><h3 style="color:white; padding:15px;"><b>Thank You</b></h3></center></div>
						</div>
						
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of para area-->
		<?php
			include('footer.php') // fotter area
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
