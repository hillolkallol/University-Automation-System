<?php
	session_start();
	if(isset($_POST['eform']))
	{
		try
		{
			if(empty($_POST['id'])||empty($_POST['title']) || empty($_POST['author']) || empty($_POST['isbn']))throw new Exception('Field cant be empty');
				
			$id=$_POST['id'];
			$title=$_POST['title'];
			$author=$_POST['author'];
			$isbn=$_POST['isbn'];
			$edition=$_POST['edition'];
			$status=$_POST['status'];
			$price=$_POST['price'];
			$campus=$_POST['campus'];
			$shelf=$_POST['shelf'];

			if($status == "Lost") $status = 0;
			else if($status == "Available") $status = 1;
			else $status = 2;

			$id=$_REQUEST['id'];
			$con_db = mysqli_connect('localhost','root','','db_leading');
			$query = "UPDATE book_info set book_title='$title',author='$author' ,
						isbn='$isbn',edition='$edition',status='$status',price='$price',
						campus_name ='$campus', shelf_number = $shelf
						WHERE book_id='$id' ";
						
			$result = mysqli_query($con_db,$query);
			
			if($result) 
			{
				   echo '<script type="text/javascript">';
					echo 'alert("Data Updated Successfully")';
					echo '</script>';
			}
		}
		catch(Exception $e)
		{
			$error=$e->getMessage();
		
		}
	}

	if(isset($error))echo $error;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
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
	
				if(isset($_POST['chk']))
				{
					$id=$_POST['idbook'];
					header("location:edit.php?id=$id");
				
				}

			?>
			<?php
					$id=$_REQUEST['id'];
					// echo $id;
					include('connect.php');
					$con_db = getcon();
					$result=mysqli_query($con_db,"select * from book_info where book_id='$id'");
					
					foreach($result as $row)
					{
			
							$id= $row['book_id'];
							$title= $row['book_title'];
							$author= $row['author'];
							$isbn= $row['isbn'];
							$edition= $row['edition'];
							$status= $row['status'];
							$price=$row['price'];
							$campus=$row['campus_name'];
							$shelf=$row['shelf_number'];
							$category=$row['category'];	
					}
							
		?>	
       <div class="header_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">			
						
						<div class="table-responsive" style="background:#3276b1; color:white; margin:50px 0px 50px 0px;">

							<table class="table table-bordered" class="color:white !important;">
								<?php

										$id=$_REQUEST['id'];
										// echo $id;
										$con_db=mysqli_connect('localhost','root','','db_leading');
										$result=mysqli_query($con_db,"select * from book_info where book_id='$id'");
										$num=mysqli_num_rows($result);
										 if($num==0) 
											{
												echo '<script type="text/javascript">';
													echo 'alert("No Book Found")';
												echo '</script>';?>
												<center><a href="admin.php"><h3 style="color:white; padding:20px;">Go Back</h3></a></center>
												<?php
											}
										 //echo "No Book Found !";
										foreach($result as $row)
										{
								?>
								<center><h2 style="background:#3276b1; color:white !important;; padding:20px; margin:100px 0px 10px;">Edit Book </h2></center>
								<tr>
									<th>Book ID</th>
									<td><?php echo $row['book_id']; ?></td>
								</tr>
								<tr>
									<th>Title</th>
									<td><?php echo $row['book_title'] ?></td>
								</tr>
								<tr>
									<th>Author</th>
									<td><?php echo $row['author']; ?></td>
								</tr>
								<tr>
									<th>ISBN</th>
									<td><?php echo $row['isbn']; ?></td>
								</tr>
								<tr>
									<th>Edition</th>
									<td><?php echo $row['edition']; ?></td>
								</tr>
								<tr>
									<th>Price</th>
									<td><?php echo $row['price']; ?></td>
								</tr>
								<tr>
									<th>Status</th>
									<td><?php 

										if( $row['status'] == 1) echo "Available";
										else if( $row['status'] == 2) echo "Library Copy";
										else echo "Lost";
									?></td>
								</tr>
								<tr>
									<th>Location</th>
									<td><?php echo $row['campus_name'].',Shelf number: '.$row['shelf_number']; ?></td>
								</tr>
								<tr>
									<th>Action</th>
									<td>
										<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#book_edit" style="background:white; color:#3276b1;">Edit</button>
										<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#book_delete" style="background:white; color:#3276b1;">Delete</button>
										<a href="admin.php" style="background:white; padding:8px; border-radius:5px;">Go Back</a>
									</td>
								</tr>	
								<?php			
											}
								?>
							</table>
						</div>
						

					<!-- Modal -->
						<div class="modal fade" id="book_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">Edit book</h4>
							  </div>
							  <div class="modal-body">
								<form action="" method="post">
									<div class="table-responsive" ">
										<table class="table">
											<tr>
												<td>Book ID</td>
												<td><?php echo $id;?></td>
											</tr>
											<tr>
												<td>Book title</td>
												<td><input type="text" name="title" value="<?php echo $title;?>" /></td>
											</tr>
									
											<tr>
												<td>Author Name</td>
												<td><input type="text" name="author" value="<?php echo $author;?>" /></td>
											</tr>			
											<tr>
												<td>ISBN  </td>
												<td><input type="text" name="isbn" value="<?php echo $isbn;?>" /></td>
											</tr>
											<tr>
												<td>Edition</td>
												<td><input type="text" name="edition" value="<?php echo $edition;?>" /></td>
											</tr>		
											<tr>
												<td>Status</td>
												<td>
												 <select name="status" required >
														<option value="">Select</option>
														<option value="Available">Available</option>
														<option value="LibraryCopy">Library Copy</option>
														<option value="Lost">Lost</option>
												</select>										

												</td>
											</tr>		
											<tr>
												<td>Price</td>
												<td><input type="text" name="price" value="<?php echo $price;?>" /></td>
											</tr>
											<tr>
												<td>Campus</td>
												<td>
												<select name="campus" required >
														<option value="">Select</option>
														<option value="Central Library">Central Library</option>
														<option value="Rongmohol Tower">Rongmohol Tower</option>
														<option value="Shurma Tower">Shurma Tower</option>
														<option value="Kamal Bazar">Kamal Bazar</option>
												</select>
												
											</tr>
											<tr>
												<td>Shelf Number</td>
												<td><input type="Number" min = "1" name="shelf" value="<?php echo $shelf;?>" /></td>
											</tr>			
											
										</table>
									</div>
									<input type="hidden" name="id" value="<?php echo $id;?>"/>
								
								
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="eform">Save changes</button>
								</form>
							  </div>
							</div>
						  </div>
						</div>
						
							<div class="modal fade" id="book_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						  <div class="modal-dialog">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="myModalLabel">edit book</h4>
							  </div>
							  <div class="modal-body">
								Are You Want To Delete This Book ?
							 </div>
							  <div class="modal-footer">
								<form action="" method="post">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary" name="dform">Delete</button>
								</form>
							  </div>
							</div>
						  </div>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of header_area-->
		//<a href="admin.php">go back</a>
		
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

<?php
	if(isset($_POST['dform']))
	{
		$query = "Delete From book_info where book_id='$id'" ;
		$result = mysqli_query($con_db,$query);
			
			if($result)
			{
				  echo '<script type="text/javascript">';
					echo 'alert("Book delete is Successful.")';
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













