<!DOCTYPE html>
<?php
session_start();
include('connect.php');
	$con = getcon();
if(isset($_SESSION['admin_id']) && isset($_SESSION['password']))
{
	$user_id=$_SESSION['admin_id'];
	$pass=$_SESSION['password'];
	$query="select * from library_admin_info where admin_id='$user_id' and password='$pass' ";
	$result = mysqli_query($con,$query);
		foreach($result as $row)
		{
			$name=$row['name'];
			$id=$row['admin_id'];
		}
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
			include('header_admin.php'); // header area
		?>
		<div class="info_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-5" >
						<div class="borrow">
							<h3>Issue Book :</h3>
							<center>
								<center>
									<form class="form-inline form_class2" role="form" action="borrowbook.php" method="POST"  name="" id="borrow-form" >
										<div class="row">
											<div class="col-md-12 ID_style">
												<label>User ID :</label></br>
												<input type="text" class="form-control" name="s_id" placeholder="User ID" required>	
												<input type="submit" value="submit" name="tform" class="btn btn-primary" id="borrow-submit"/>	
												<input type="hidden" name="action" value="student_info" />
											</div>
										</div>
									</form>
								</center>
							</center>
						</div>
					</div>
					<?php if( isset( $_POST['action'] ) && 'request_book' == $_POST['action'] )
											
												{	$con = getcon();
													$user_id = $_POST['id'];
													$book_id = $_POST['book_id'];
													$renew_status = $_POST['renew_status'];

													$query = "SELECT * FROM `db_leading`.`book_info` WHERE `book_id` = $book_id";
													$result = mysqli_query($con,$query);
													$valid = 0;

								 					while($row=mysqli_fetch_array($result))
													{
														$book_title = $row['book_title'];
														$status = $row['status'];
														$book_number = $row['book_number'];
														$valid = 1;
													}
													if($valid!=1 || $status !=1)
															{
																echo '<script type="text/javascript">';
																	echo 'alert(" Book number '. $book_number.' is Not Avaible ")';
																echo '</script>';
															}
													else
													{
														$query = "INSERT INTO `book_transaction` (`transaction_id`, `user_id`, `book_number`, 
															`issue_date`, `return_date`, `issue_by`, `transaction_status`, `day_limit`, `renew_status`)
															VALUES (NULL, '$user_id', '$book_number', now(), '0000-00-00 00:00:00', '$name', '0', '10', '$renew_status');";
															
														$result = mysqli_query($con,$query);


														
														if($result)
														{
															$query = "UPDATE book_info SET status= 3 WHERE book_number= $book_number;";
															$result2 = mysqli_query($con,$query);
															if ($result2)
															{
																echo '<script type="text/javascript">';
																	echo 'alert("Successfull")';
																echo '</script>';
															}
															else echo "Borrow Successfull . Please update  Book ID : ".$book_id."Book Title : ".$book_title."\n";

														}
														else
															{
																echo '<script type="text/javascript">';
																	echo 'alert("Transaction Fail")';
																echo '</script>';
															}
													}
													}
											?>
										
					<div class="col-md-5">
						<div class="return">
							<h3> Receive Book :</h3>
							<center>
								<form class="form-inline form_class2 " role="form" action="returnbook.php" method="POST" id="return-form" >
									<div class="row">
										<div class="col-md-12 ID_style">
											<label>BooK ID :</label><br>
											<input type="text" class="form-control" name="book_id" placeholder="Book ID" required>	
											<input type="submit" value="submit" name="rform" id="return-submit" class="btn btn-primary"  />	
										</div>
									</div>
								</form>
							</center>
						</div>	
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of info_area-->
		<div class="show">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<center>
							<div class="borrowshow"></div> 
						</center>
												
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div><!--end of show area-->
		<div class="info_area2">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-5" >
						<div class="borrow">
							<center>
								<h3>Renew Book :</h3></center>
								<center>
									<form class="form-inline form_class2 " role="form" action="renewbook.php" method="POST"  name="" id="renew-form">
										<div class="row">
											<div class="col-md-12 ID_style">
												<label>Book ID :</label><br>
												<input type="number" min ="1" required name="book_id" class="form-control" placeholder="Book ID">	
												<input type="submit" value="submit" name="aform" class="btn btn-primary" id="renew-submit"/>	
												<input type="hidden" name="action" value="book_id_info" />
											</div>
										</div>
									</form>
									<?php
										if( isset( $_POST['action'] ) && 'request_renew' == $_POST['action'] ){
											$transaction_id = $_POST['transaction_id'];
											$day_limit = $_POST['day_limit'];
											$renew = $_POST['renew'];
											$max = $day_limit + $renew ;
											$query = "UPDATE `db_leading`.`book_transaction` SET `day_limit` = $max  WHERE `book_transaction`.`transaction_id` = $transaction_id";
											//echo $query ;
											$result = mysqli_query($con,$query);
											if($result)
											{
												echo '<script type="text/javascript">';
													echo 'alert("Book Renew is Successful")';
												echo '</script>';
											}
											else
												{
													echo '<script type="text/javascript">';
														echo 'alert(" Sorry Try Again")';
													echo '</script>';
												}
										}
										?>
							</center>
						</div>
					</div>					
					<div class="col-md-5">
						<div class="return">
							<h3> Student Information :</h3>
							<center>
								<form class="form-inline form_class2 " role="form" action="view_student_info.php" method="POST" id="student_info-form" >
									<div class="row">
										<div class="col-md-12 ID_style">
											<label>Student ID :</label><br>
											<input type="text" class="form-control" name="std_id" placeholder="Student ID" required>	
											<input type="submit" value="submit" name="" class="btn btn-primary" id="student_info-submit"  />	
										</div>
									</div>
								</form>
							</center>
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of info_area2-->
				<div class="show_area2">
			<div class="container">
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<center> <div class="renew">
						</div> 
						</center>
												
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</div><!--end of show area2-->
		<div class="viewtab_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="view_menu">
							<nav class="navbar navbar-default" role="navigation" style="background:#f0f4fa;">
								<div class="container-fluid navdiv">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
									  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									  </button>
									</div>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
										<ul class="nav navbar-nav">
											<li class="tab_menu active"><a href="#borrow" role="tab" data-toggle="tab">Books on Borrow</a></li>
											<li class="tab_menu"><a href="#fine" role="tab" data-toggle="tab">Books on fine</a></li>
											<li class="tab_menu"><a href="#trans" role="tab" data-toggle="tab">All Transaction</a></li>
											<li class="tab_menu"><a href="#requested_book" role="tab" data-toggle="tab">Request</a></li>
											<li class="tab_menu"><a href="#message" role="tab" data-toggle="tab">Messages</a></li>
											
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
						<!-- Tab panes1 -->
							<div class="tab-content">
								<div class="tab-pane active" id="borrow">
									<!--<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Select a date range to view Books on Borrow </h3></center>-->
									<?php include('BooksOnBorrow.php');?>
								</div><!--end of borrow-->
								<div class="tab-pane" id="trans">
									<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Select a date range to view Transactino History </h3></center>
									<div class="tab_heading">
										<form class="form-inline request " role="form" action="viewAllTransaction.php" method="POST"  name="" id="trans-form">
											<div class="row">
												<div class="col-md-12 request_field">
													<center><input type="date" name="StartDate" class="form-control" placeholder="yyyy-dd-mm" required>	
													TO
													<input type="date"  name="EndDate" class="form-control" placeholder="yyyy-dd-mm" required >	
													<input type="submit" value="submit" name="aform" class="btn btn-primary" id="trans-submit"/>	
													<input type="hidden" name="action2" value="date_info" /></center>
												</div>
											</div>
										</form>
									</div>
										<div class="transshow">
											<center><h3>Last Five Transaction</h3></center>
											<?php
												$query = "SELECT book_info.book_id ,
													book_info.book_title,
													issue_date , return_date ,  issue_by ,user_id,
													( DATEDIFF( return_date , issue_date ) - day_limit ) AS fine
													From book_info , book_transaction 
													Where book_transaction.book_number =  book_info.book_number
													Order by transaction_id DESC 
													LIMIT 0 , 5";
													//include('connect.php');
														//	$con=getcon();
												$result = mysqli_query($con,$query);
												$found = 0;
												?>
												<!-- Table to Show Last 5 history  -->
											<div class="table-responsive">
												<table class="table">
												<?php
												while($row1 = mysqli_fetch_array($result))
												{
													if($found===0)
													{
													?>
														<tr>
															<td><b>Book ID</b></td>
															<td><b>Book Title</b></td>
															<td><b>Borrow By</b></td>
															<td><b>Issue Date</b></td>
															<td><b>Return Date</b></td>
															<td><b>Issue By</b></td>
															<td><b>Fine</b></td>
														</tr>					
													<?php					
														$found = 1;
													}
													?>
														<tr>
															<td><?php echo $row1['book_id'];?></td>
															<td><?php echo $row1['book_title'];?></td>
															<td><?php echo $row1['user_id'];?></td>
															<td><?php echo $row1['issue_date'];?></td>
															<td>
															<?php 
																if($row1['return_date'] == "0000-00-00 00:00:00")
																echo "On Borrow";						
																else echo $row1['return_date'];
															?>
															</td>							
															<td><?php echo $row1['issue_by'];?></td>
															<td>

															<?php 
																if($row1['fine']>0) echo $row1['fine'];
																else echo"0";
															?>
															</td>
														</tr>
											<?php
												}				
											?>
												</table>
											</div>
										<?php //include('viewAllTransaction.php');?>
										</div>
								</div><!--end of alltransaction-->
								<div class="tab-pane" id="requested_book">
									<ul class="nav nav-tabs" role="tablist">
										<li class="active"><a href="#request" role="tab" data-toggle="tab">View Request</a></li>
										<li><a href="#update" role="tab" data-toggle="tab">Update Book Status</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="request">
											<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Select a Date Range to View Request :</h3></center><br>
											<div class="tab_heading">
												<form class="form-inline request " role="form" action="viewRequest.php" method="POST"  name="" id="request-form">
													<div class="row">
														<div class="col-md-12 request_field">
															<center><input type="date" name="StartDate" class="form-control" placeholder="yyyy-dd-mm" >	
															TO
															<input type="date"  name="EndDate" class="form-control" placeholder="yyyy-dd-mm" >	
															<input type="submit" value="submit" name="aform" class="btn btn-primary" id="request-submit"/>	
															<input type="hidden" name="action" value="date_info" /></center>
														</div>
													</div>
												</form>
											</div>
											<div class="requestshow">
												<center><h3>Recent Requests</h3></center>
												<?php
													
													$query = "SELECT * FROM  `book_request` WHERE buy_status = 0 
													ORDER BY `book_request`.`serial` DESC  LIMIT 0 , 5";
													$con = getcon();
													$result = mysqli_query($con,$query);
													$count=1;
														if($result)
														{		
													?>
												<div class="table-responsive">
													<table class="table table-bordered">							
														<tr  class="info">
															<td><b>Serial</b></td>
															<td><b>Requested By</b></td>
															<td><b>Book Title</b></td>
															<td><b>Author Name</b></td>
															<td><b>Edition</b></td>
															<td><b>Request Date</b></td>
														</tr>	
														<?php
															while($row1=mysqli_fetch_array($result))
																{
																	echo "<tr>";
																		echo "<td>".$row1['serial']."</td>";
																		echo "<td>".$row1['user_id']."</td>";
																		echo "<td>".$row1['book_title']."</td>";
																		echo "<td>".$row1['author']."</td>";
																		if($row1['edition'] == 0) echo "<td>Unknown</td>";
																		else
																			echo "<td>".$row1['edition']."</td>";
																			echo "<td>".$row1['time']."</td>";
																	echo "</tr>";
																	$count++;
																}
														}
													?>
													</table>
												</div>
												<?php
													if($count == 1)
														{
															echo '<script type="text/javascript">';
																echo 'alert("No Request Found")';
															echo '</script>';
														}
												?>
											
											</div><!--end of requestshow-->
										</div><!--end of request-->
										<div class="tab-pane" id="update">
											<div class="tab_heading">
												<center><h3 style="background:#3276b1; color:white; padding:15px;width:60%;">Update Books Status :</h3></center>
												<div class="row">
													<center>
														<form class="form-inline form_class2 " role="form" action="editBookRequest.php" method="POST"  name=""  > 
															<div class="col-md-12 ID_style">
																<label style="margin-top:10px;">Request Number :</label><br>
																<input type="number" min ="1" class="form-control" name="serial" placeholder="Book Serial" required>	
																<input type="submit"  value="submit" name='chk' class="btn btn-primary" id="" />	
															</div>
														</form>	
													</center>
												</div>
											</div>
										</div>
									</div>
								</div><!--end of requested_Book-->
								<div class="tab-pane" id="message">
									<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Messages</h3></center>
									<ul class="nav nav-tabs" role="tablist">
										<li class="active"><a href="#r_msg" role="tab" data-toggle="tab">Received Messages</a></li>
										<li><a href="#s_msg" role="tab" data-toggle="tab">Sent Messages</a></li>
										<li ><a href="#ar_msg" role="tab" data-toggle="tab">Archive (Receive)</a></li>
										<li><a href="#as_msg" role="tab" data-toggle="tab">Archive (send)</a></li>
									</ul>
									<div class="tab-content">
										<div class="tab-pane active" id="r_msg">
											<?php include('view_contact_messages.php')?>
										</div>
										<div class="tab-pane " id="s_msg">
											<?php include('view_messages_admin.php')?>
										</div>
										<div class="tab-pane " id="ar_msg">
											<?php include('view_contact_messages_archive.php')?>
										</div>
										<div class="tab-pane " id="as_msg">
											<?php include('view_messages_admin_archive.php')?>
										</div>
									</div>
								</div><!--end of message-->
								<div class="tab-pane" id="fine">
								<center><h3 style="background:#3276b1; color:white; padding:15px; width:60%;">Books On Fine </h3></center>
												<?php
													$query = " SELECT `tbl_student_info`.`std_id` ,`tbl_student_info`.`std_name` , `tbl_student_info`.`std_email` , `book_info`.`book_title`,`book_info`.`book_id`,
															`book_transaction`.`issue_date`, DATEDIFF( NOW( ) , issue_date ) AS diff, day_limit 
															from `book_info`,`book_transaction` ,`tbl_student_info`  
															WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
															and `book_transaction`.`transaction_status`= 0 
															and `book_transaction`.`user_id`= `tbl_student_info`.`std_id` 
															and day_limit< DATEDIFF( NOW( ) , issue_date )
															ORDER BY DATEDIFF( NOW( ) , issue_date ) DESC ";



													$result = mysqli_query($con,$query);
													$count=1;

													if($result)
													{		
													?>
														<?php
															$temp = 0;
														?>
														<div class="table-responsive">
															<?php
															while($row1=mysqli_fetch_array($result))
															{															
													
																if($temp == 0)
																{
															?>
																<table class="table">
																<tr>
																	<td><b>Serial</b></td>
																	<td><b>Book Id</b></td>
																	<td><b>Book Title</b></td>
																	<td><b>User Name</b></td>
																	<td><b>User ID</b></td>
																	<td><b>Issue Date</b></td>
																	<td><b>Total Days</b></td>
																</tr>	
															
															<?php	}
																
																		$temp = 5;
																		echo "<tr>";
																			echo "<td>".$count."</td>";
																			echo "<td>".$row1['book_id']."</td>";
																			echo "<td>".$row1['book_title']."</td>";
																			echo "<td>".$row1['std_name']."</td>";
																			echo "<td>".$row1['std_id']."</td>";
																			echo "<td>".$row1['issue_date']."</td>";
																			echo "<td>".$row1['diff']."</td>";
																		echo "</tr>";
																		$count++;
																}
														echo "</table>";					
															}
															if($count == 1)
																echo "<h2>No Data Found</h3>"; 
															?>



														</div>
								</div><!--end of fine-->	
							</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div> <!--end of view tab area-->
		<div class="tab_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="tab_manue">
							<nav class="navbar navbar-default" role="navigation" style="background:#f0f4fa;">
								<div class="container-fluid navdiv">
									<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
									  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
										<span class="sr-only">Toggle navigation</span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									  </button>
									</div>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
										<ul class="nav navbar-nav">
											<li class="tab_menu active"><a href="#add" role="tab" data-toggle="tab">Add Book</a></li>
											<li class="tab_menu"><a href="#edit" role="tab" data-toggle="tab">Edit Book</a></li>
											<li class="tab_menu"><a href="#aebook" role="tab" data-toggle="tab">Add Ebook</a></li>
											<li class="tab_menu"><a href="#editebook" role="tab" data-toggle="tab">Edit EBook</a></li>
											<li class="tab_menu"><a href="#ebook" role="tab" data-toggle="tab">EBooks</a></li>
											
										</ul>
									</div><!-- /.navbar-collapse -->
								</div><!-- /.container-fluid -->
							</nav>
						<!-- Tab panes2 -->
							<center>
								<div class="tab-content heading">
									<div class="tab-pane active" id="add">
										<div class="tab_heading">
											<center><h3>Add Book Detailes :</h3></center>
											<form class="form-inline form_class" role="form" action="addbook.php" method="POST"  name="" id="showbook-form">
												<?php
													$con_db = getcon();
													$maxid = 0;
													$querry = "SELECT MAX(book_id) as max FROM book_info";
													$result = mysqli_query($con_db,$querry);
													//echo $querry;
													while($row=mysqli_fetch_array($result))
													{
														$maxid = $row['max'];
													}
												?>
												<div class="row">
													<div class="col-md-3 ">
														<div class="form-group">
															<label  class="col-md-3 control-label">ID </label>
															<div class="col-md-9">
															  <input required type="text" class="form-control form_style" name="id" value="<?php echo $maxid+1;?>" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">Title </label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="title" placeholder="Book Title" required >
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">Author</label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="author" placeholder="Author" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label" style="margin-left:25px;">Copy</label>
															<div class="col-md-9">
																 <select class="form-control form_style" name="copy" >
																	<?php
																		for($i=1 ; $i<=50 ; $i++)
																		{
																			echo '<option>'.$i.'</option>';
																		}
																	?>	
																</select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">ISBN</label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="isbn" placeholder="ISBN" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Edition</label>
															<div class="col-md-9">
															  <input type="number" min ="1" class="form-control form_style" name="edition" placeholder="Edition" required style="margin-left:-8px !important;">
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">Price</label>
															<div class="col-md-9">
															  <input type="number" min ="1" class="form-control form_style" name="price" placeholder="Price" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label" style="margin-left:25px;">Shelf</label>
															<div class="col-md-9">
															  <select class="form-control form_style" name="shelf_number" >
																<?php
																	for($i=1 ; $i<=50 ; $i++)
																	{
																		echo '<option>'.$i.'</option>';
																	}
																?>	
															  </select>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">Campus</label>
															<div class="col-md-9">
																 <select class="form-control form_style" name="campus_name" required >
																	<option value="">Select</option>
																	<option value="Central Library">Central Library</option>
																	<option value="RangmaholTower">Rangmahol Tower</option>
																	<option value="ShurmaTower">Shurma Tower</option>
																	<option value="Kamal Bazar">Kamal Bazar</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Status</label>
															<div class="col-md-9">
																 <select class="form-control form_style" name="status" >
																	<option value="">Select</option>
																	<option value="Available">Available</option>
																	<option value="Library">Library</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Category</label>
															<div class="col-md-9">
																 <select class="form-control form_style" name="category" required >
																	<option value="">Select</option>
																	<option value="ARC">ARC</option>
																	<option value="BUA">BUA</option>
																	<option value="CIVIL">CIVIL</option>
																	<option value="CSE">CSE</option>
																	<option value="EEE">EEE</option>
																	<option value="ENGLISH">ENGLISH</option>
																	<option value="LAW">LAW</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label"></label>
															<div class="col-md-9">
															  <input type="submit" value="submit" id="showbook-submit" name="aform" class="btn btn-primary adbtn"/>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="showbook"></div>
										</div>										
									</div><!--end of addbook-->
									<div class="tab-pane" id="edit">
										<div class="tab_heading">
											<center><h3>Edit Books :</h3></center>
											<div class="row">
												<center>
													<form class="form-inline form_class2 " role="form" action="edit.php" method="POST"  name=""  > 
														<div class="col-md-12 ID_style">
															<label style="margin-top:10px;">Edit Books :</label><br>
															<input type="number" min ="1" class="form-control" name="idbook" placeholder="Book ID" required>	
															<input type="submit"  value="submit" name='chk' class="btn btn-primary" id="edit-submit" />	
														</div>
													</form>	
												</center>
											</div>
										</div>
									</div><!--end of editbook-->
									<div class="tab-pane" id="editebook">
										<div class="tab_heading">
											<center><h3>Edit EBooks :</h3></center>
											<div class="row">
												<center>
													<form class="form-inline form_class2 " role="form" action="ebook_edit.php" method="POST"  name="" > 
														<div class="col-md-12 ID_style">
															<label style="margin-top:10px;">Edit EBooks :</label><br>
															<input type="number" min ="1" class="form-control" name="book_serial" placeholder="Book ID" required>	
															<input type="submit"  value="submit" name='ebook' class="btn btn-primary" />	
														</div>
													</form>
												</center>	
											</div>
										</div>
									</div><!--end of editbook-->
									<div class="tab-pane" id="ebook">
										<div class="tab_heading">
											<center><h3>Search EBooks :</h3></center>
											<div class="row">
												<center>
													<form class="form-inline" action="view_ebook_admin.php" role="form" method="post" id="ebook-form" style="padding-top:8px; background:#dedede;">						
														<center>
															<div class="form-group">
																<select class="form-control find " name="category" required>
																	<option value="">Keyword</option>						
																	<option value="title">Title</option>
																	<option value="author">Author</option>
																	<option value="category">Category</option>
																	<option value="isbn">ISBN</option>
																</select>
																<input type="trxt" name="value" class= "form-control find" placeholder="Search"/>
																<button class="btn btn-primary find_btn">
																	<i id="ebook-submit" type="submit" class="icon-search" name="aform" style="color:white;margin:5px;font-size:20px;"></i>
																</button>
															</div>
														</center>
													</form>
													<div class="search"></div>
												</center>	
											</div>
										</div>
									</div><!--end of editbook-->
									<div class="tab-pane" id="aebook">
										<div class="tab_heading">	
											<center><h3>Add EBook Detailes :</h3></center>
											<form class="form-inline form_class" role="form" action="addebook.php" method="POST"  name="" id="showebook-form">
												
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label  class="col-md-3 control-label">Title </label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="title" placeholder="Book Title" required>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label  class="col-md-3 control-label">Author</label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="author" placeholder="Author" required>
															</div>
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Edition</label>
															<div class="col-md-9">
															  <input type="number" min ="1" class="form-control form_style" name="edition" placeholder="Edition" required>
															</div>
														</div>
													</div>
												</div>
												<div class="row">	
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label">ISBN</label>
															<div class="col-md-9">
															  <input type="text" class="form-control form_style" name="isbn" placeholder="ISBN" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Link</label>
															<div class="col-md-9">
															  <input type="url" min ="1" class="form-control form_style" name="url" placeholder="Link" required>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label ">Category</label>
															<div class="col-md-9">
																 <select class="form-control form_style" name="category" required>
																	<option>Select</option>
																	<option>ARC</option>
																	<option>BUA</option>
																	<option>CIVIL</option>
																	<option>CSE</option>
																	<option>EEE</option>
																	<option>ENGLISH</option>
																	<option>LAW</option>
																</select>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label  class="col-md-3 control-label"></label>
															<div class="col-md-9">
															  <input type="submit" value="submit" name="eform" id="showebook-submit" class="btn btn-primary adbtn"/>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="showebook"></div>
										</div>
									</div><!--end of ebook-->
								</div><!--end of tab-content heading-->
							</center>
						</div><!--end of tab_manue-->
					</div>
					<div class="col-md-1"></div>
				</div><!--end of tab_area_row-->
			</div><!--end of tab_area_container-->
		</div><!--end of tab_area-->
		 <?php
					include('footer.php') // admin footer
				?>
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
		<script src="js/script.js"></script>
		<script src="js/borrow.js"></script>
		<script src="js/request.js"></script>
		<script src="js/renew.js"></script>
		<script src="js/return.js"></script>
		<script src="js/addbook.js"></script>
		<script src="js/addebook.js"></script>
		<script src="js/edit.js"></script>
		<script src="js/student_info.js"></script>
		<script src="js/trans.js"></script>
		<script src="js/ebook.js"></script>
    </body>
</html>
<?php
}
else
header('Location: index.php');
?>
