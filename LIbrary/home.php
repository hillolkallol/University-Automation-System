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
			include('header.php') // header area
		?>
		
		<div class="search_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="search_book">
							<center>
								<form class="form-inline find_form" action="ViewSearch.php" role="form" method="post" id="search-form">			
									<div class="form-group">	
										<select class="form-control find " name="cat_value" required >
											<option value="">Keyword</option>
											<option value="title">Title</option>
											<option value="author">Author</option>
											<option value="isbn">ISBN</option>
											<option value="book_id">Book Id</option>
											<option value="category">Category</option>
										</select>
										<input type="trxt" name="catagori" class= "form-control find" placeholder="Find Your Book"/>
										<button class="btn btn-primary find_btn">
											<i id="search-submit" type="submit" class="icon-search" style="color:white;margin:5px;font-size:20px;"></i>
										</button>
									</div>
								</form>
							</center>
						</div><!--end of search-->
						<div class="search"> </div>
					</div>
					<div class="col-md-1"></div>
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
								The Central Library of leading university started its operation during the establishment of Leading University (LU) in the year 2001.
								The mission of LU Library is to provide innovative and quality Library services for the students, faculty members,
								researchers and staffs. Presently LU Library has a wide collection of Books, Magazines and Journals.
								In addition the numbers of Library Resources are increasing rapidly. LU Library is located at 7th floor,
								of Leading University.The total floor space of LU Library is 2000 sq.ft.
								Authority has further plan to extend the floor capacity of the library. LU Library provides special
								user services  
								<a href="about.php">Continue.....</a>
							</p>
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
		<div class="home_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10 n_book">
						<h3>List of New Books</h3>
						<?php
						$query = "SELECT * FROM  `book_info`  GROUP BY book_title ORDER BY `book_info`.`book_number` DESC  LIMIT 0 , 5";
											$con = getcon();
											$result = mysqli_query($con,$query);
											$count=1;

											if($result)
											{		
												?>
												<div class="table-responsive">
												  <table class="table table-bordered">							
													`<tr class="info">
														<td><b>Serial</b></td>
														<td><b>Title</b></td>
														<td><b>Author</b></td>
														<td><b>Edition</b></td>
													</tr>	

												<?php
												while($row1=mysqli_fetch_array($result))
												{
												if($count%2==0)
												{
												?>
												
												<tr class="info">
												<?php
														//echo "<td>".$count."</td>";
														echo "<td>".$count."</td>";
														echo "<td>".$row1['book_title']."</td>";
														echo "<td>".$row1['author']."</td>";
														if($row1['edition'] == 0) echo "<td>Unknown</td>";
														else
														echo "<td>".$row1['edition']."</td>";
														$count++;
												}
												else
												{
												?></tr>
												<tr class="success">
												<?php
														//echo "<td>".$count."</td>";
														echo "<td>".$count."</td>";
														echo "<td>".$row1['book_title']."</td>";
														echo "<td>".$row1['author']."</td>";
														if($row1['edition'] == 0) echo "<td>Unknown</td>";
														else
														echo "<td>".$row1['edition']."</td>";
														$count++;
													
												?></tr>
												<?php
												}
												}
											}
										?>
										</table>
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
		<script src="js/search.js"></script>
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
		<script src="js/search.js"></script>
    </body>
</html>
