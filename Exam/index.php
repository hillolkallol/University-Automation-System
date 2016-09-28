<?php	include'include/header1.php';	?>
	<!------------------Slider Start---------------->
	<div class="container">
		<div class="row">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<div class="slider">
					<div id="wrapper">
							<div class="slider-wrapper theme-default">
								<div id="slider" class="nivoSlider">
									<img src="img/slide-1.jpg" data-thumb="img/slide-1.jpg" alt="" />
									<img src="img/slide-2.jpg" data-thumb="img/slide-2.jpg" alt=""  />
									<img src="img/slide-3.jpg" data-thumb="img/slide-3.jpg" alt=""  />
									<img src="img/slide-2.jpg" data-thumb="img/slide-2.jpg" alt=""  />
								</div>
								
							</div>
					</div>
				</div>  
			</div>
			
			<div class="col-md-1"></div>
			
		</div>
	</div>
	<!------------------Slider Ends-------------------->
	
	<!-------------------Marquee Starts----------------> 
	<div class="container">
		<div class="row">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<div class="marq">
					<?php
						include 'config.php';
						// SQL query to Display Details.
						$query_all = mysql_query("SELECT * FROM notice_info  WHERE dept='all' ORDER by date desc  LIMIT 5");
					?>
						<marquee>
						<?php while($row = mysql_fetch_array($query_all)) :
							echo $row['text'];
							echo '....';
						endwhile ?>
						<a href="notice.php" >Click Here </a> To see all the notices.
						</marquee>
				</div>
			</div>
			
			<div class="col-md-1"></div>
			
		</div>
	</div>
	<!---------------------Marquee Ends---------------------> 
	
	<!------------------Welcome starts-------------------->
	<div class="container">
		<div class="row">
			
			<div class="col-md-1"></div>
			
			<div class="col-md-10">
				<div class="welcome">
					<b>Welcome To Leading University
					</b>	<br>
					Leading University (LU) is the first Government Approved Private University of 
					Sylhet, Bangladesh founded by renowned Philanthropist Danobir Dr. Ragib Ali. On 
					his proposal for establishing Leading University to the Ministry of Education on 
					24th August. 1996, the Ministry issued permission on 28th August 2001 
					to establish this University.And the Leading University was inaugurated 
					its functions with 107 students on 4th March 2002.<br>
					It's mission is to provide world-class higer education at a reasonable 
					cost in a range of subjects those are particularly relevant to current
					and future society needs in trade,industry and public services.
					
					<div class="line"></div>
					
					<div class="login1">
						<a href="login.php">	
							<img src="img/login_1.png" alt="with responsive image feature" class="img-responsive">
						</a>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="student_option.php">
							<img src="img/login_2.png" alt="with responsive image feature" class="img-responsive">
						</a>
						<div class="primary_button">
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="login.php" ><button type="button" class="btn btn-primary">Login</button></a>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="student_option.php"><button type="button" class="btn btn-primary">See Result</button></a>
						</div>		
					</div>
					
					<div class="line"></div>
					Contact Information<br>	
					<ul>
						<li><i class="fa fa-map-marker"></i> Surma Tower, VIP Road, Taltola,</li>
						<li><i class="fa fa-map-marker"></i> Sylhet-3100, Bangladesh.</li>
						<li><i class="fa fa-phone"></i> Phone: +880-821-720303-6.</li>
						<li><i class="fa fa-globe"></i> Web: www.lus.ac.bd</li>
					</ul>
					<br>
				</div>
			</div>
			
			<div class="col-md-1"></div>
		</div>
	</div>
	 <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
	<!------------------Welcome Ends-------------------->
	
<?php	include'include/footer.php';	?>		
