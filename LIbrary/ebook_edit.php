<?php
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
			$category=$_POST['category'];
			$ebook_link=$_POST['ebook_link'];

			$id=$_REQUEST['id'];
			$con_db = mysqli_connect('localhost','root','','db_leading');
			$query = "update ebook_info set book_title='$title',author='$author' ,
						isbn='$isbn',edition='$edition',category='$category',ebook_link='$ebook_link' where ebook_id='$id'";
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
	
				if(isset($_POST['ebook']))
				{
					$id=$_POST['book_serial'];
					header("location:ebook_edit.php?id=$id");
				
				}

			?>
			<?php
					$id=$_REQUEST['id'];
					// echo $id;
					include('connect.php');
					$con_db = getcon();
					$result=mysqli_query($con_db,"select * from ebook_info where ebook_id='$id'");
					// $num=mysqli_num_rows($result);
					// var_dump($num);
					foreach($result as $row)
					{
			
							$id= $row['ebook_id'];
							$title= $row['book_title'];
							$author= $row['author'];
							$isbn= $row['isbn'];
							$edition= $row['edition'];
							$category= $row['category'];
							$ebook_link=$row['ebook_link'];
						
					}
							
		?>	
       <div class="header_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
					
						<?php
										$id=$_REQUEST['id'];
										// echo $id;
										$con_db=mysqli_connect('localhost','root','','db_leading');
										$result=mysqli_query($con_db,"select * from ebook_info where ebook_id='$id'");
										
										$num=mysqli_num_rows($result);
										 if($num==0)
											{
												echo '<script type="text/javascript">';
													echo 'alert("No Book Found")';
												echo '</script>';?>
												<center><a href="admin.php"><h3 style="color:white; background:#3276b1; padding:20px;">Go Back</h3></a></center>
												<?php
											}

										foreach($result as $row)
										{
								?>
								<center><h2 style="margin-top:100px;">Edit EBook</h2></center>
						<div class="table-responsive">
							<table class="table table-bordered">
								<tr>
									<th>Book ID</th>
									<td><?php echo $row['ebook_id']; ?></td>
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
									<th>Category</th>
									<td><?php echo $row['category']; ?></td>
								</tr>
								<tr>
									<th>Link</th>
									<td><?php echo $row['ebook_link']; ?></td>
								</tr>
								<tr>
									<th>Action</th>
									<td>
										<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#book_edit">Edit</button>
										<button class="btn btn-primary btn-md" data-toggle="modal" data-target="#book_delete">Delete</button>
										<a href="admin.php" style="background:#3276b1; padding:8px; border-radius:5px; color:white;">Go Back</a>
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
								<h4 class="modal-title" id="myModalLabel">Edit Ebook</h4>
							  </div>
							  <div class="modal-body">
								<form action="" method="post">
									<div class="table-responsive">
										<table class="table">
											<tr>
												<td>Book ID</td>
												<td><?php echo $id;?></td>
											</tr>
											<tr>
												<td>Book Title</td>
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
												<td>Category</td>
												<td><input type="text" name="category" value="<?php echo $category;?>" /></td>
											</tr>		
											<tr>
												<td>Ebook_link</td>
												<td><input type="url" name="ebook_link" value="<?php echo $ebook_link;?>" /></td>
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
		$query = "Delete From ebook_info where ebook_id='$id'" ;
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














