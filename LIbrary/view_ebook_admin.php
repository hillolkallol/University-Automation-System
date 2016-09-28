<!DOCTYPE HTML>
<?php session_start();?>
<html lang="en-US">
<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Library Management,Leading University</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>
<body>
<?php
	include('connect.php');
	$con=getcon();
?>
	<?php

		$category=$_POST['category'];
		$value=$_POST['value'];
		//echo $category .'  '.$value;		

	?>
	<div class="table-responsive" style="margin:20px;">
	<center><h3>Ebook List</h3></center>
		<table class="table table-bordered">
			<?php
				if($category == "title")
				$querry="SELECT * FROM ebook_info  WHERE book_title LIKE  '%$value%'  GROUP BY edition , book_title ";
				else if($category == "author")
				$querry= "SELECT * FROM ebook_info WHERE author LIKE  '%$value%' GROUP BY edition , book_title";
				else if($category == "isbn")
				$querry="SELECT * from ebook_info where isbn LIKE  '%$value%' GROUP BY edition , book_title";
				else if($category == "category")
				$querry="SELECT * from ebook_info where category LIKE  '%$value%' GROUP BY edition , book_title";
				
			//	echo $querry;
					
				$result=mysqli_query($con,$querry);
				
			//	$num=mysqli_num_rows($result);
				// var_dump($num);
				$Available = 0;
				$Total = 0;
				$temp=0;
				
				while($row=mysqli_fetch_array($result))
				{
					if($temp==0)
					{
						$temp=1;
			?>					
						<tr>
							<b>
								<td>Serial</td>
								<td>Title</td>
								<td>Author</td>
								<td>ISBN</td>
								<td>Edition</td>
								<td>Category</td>
								<td>URL</td>
							</b>
						</tr>					
			<?php
					}
			?>
						<tr>
							<td><?php echo $row['ebook_id']; ?></td>
							<td><?php echo $row['book_title']; ?></td>
							<td><?php echo $row['author'] ?></td>
							<td><?php echo $row['isbn']; ?></td>
							<td><?php echo $row['edition']; ?></td>
							<td><?php echo $row['category']; ?></td>
							<td><a href="<?php echo $row['ebook_link'];?>"> Downlod </a></td>	


						</tr>
							
			<?php
				} 	
			?>
		</table>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/bootstrap.min.js"></script>
		<script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
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