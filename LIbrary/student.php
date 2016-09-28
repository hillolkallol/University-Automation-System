<?php
include('connect.php');
	$con = getcon();
require '../Admission/init.php';

if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
{
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<?php
	$user_id=$_SESSION['user_id'];
	//$pass=$_SESSION['password'];
	$query="SELECT std_name, tbl_student_info.std_id, std_email, tbl_department_info.dept_short_name,libraryFine,std_pic
			FROM tbl_student_info,tbl_department_info , due_history
			WHERE tbl_student_info.std_id = $user_id 
			and tbl_student_info.std_dept =  tbl_department_info.dept_id
			and due_history.studentId = tbl_student_info.std_id ORDER BY tNo DESC limit 1";
			
	$result = mysqli_query($con,$query);
	foreach($result as $row)
				{
					$name=$row['std_name'];
					$id=$row['std_id'];
					$email=$row['std_email'];
					$picture=$row['std_pic'];
					$fine=$row['libraryFine'];
					$dept=$row['dept_short_name'];					
				}
?>
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Leading University Library Management</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
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
			include('header_student.php') ; // header area
			//echo "<br>". strlen($user_id); 

		?>
		<div class="profile-area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-2 pic">
						<center><img src="<?php echo '../Admission/Admin/'.$picture; ?>" alt="Student Picture" /></center>
					</div>
					<div class="col-md-4 pro " >
						<h4 >
						<br>
							<div class="table-responsive">
								<table class="table">
								<tr>
									<td>Name :</td>
									<td><?php echo $name ;?></td>
								</tr>
								<tr>
									<td>ID :</td>
									<td><?php echo $id ;?></td>
								</tr>
								<tr>
									<td>E-Mail :</td>
									<td> <?php echo $email ;?></td>
								</tr>
								<tr>
									<td>Department :</td>
									<td><?php echo $dept ;?></td>
								</tr>
								<tr>
									<td>Library Fine :</td>
									<td><?php echo $fine."Tk" ;?></td>
								</tr>
								
								</table>
							
							</div>
						</h4>
					</div>
					<div class="col-md-4">
						<div class="tab_std">
							<ul class="nav nav-tabs" role="tablist">
							  <li class="active"><a href="#renew_book" role="tab" data-toggle="tab">Renew Book</a></li>
							  <li><a href="#request" role="tab" data-toggle="tab">Request Book</a></li>
							</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="renew_book">
									<div class="renew_std">
										<?php
											$query = "SELECT `book_info`.`book_title`,`book_transaction`.`book_number`  
															from `book_info`,`book_transaction` 
															WHERE `book_info`.`book_number` =`book_transaction`.`book_number`
															and `book_transaction`.`transaction_status`=0 and `book_transaction`.`user_id`=$id";
																				
													$arr = array();
													$result = mysqli_query($con,$query);
													$book_taken=0;
													while($row1=mysqli_fetch_array($result))
														{
															$arr[$book_taken]['book_title'] = $row1['book_title'];
															$arr[$book_taken]['book_id'] = $row1['book_number'];
															$book_taken++;
														}
										?>		
										<form class="form-inline " action="#renew_div" method="post"style="background:#dedede;" >
											<center>
												<h3>Renew Book</h3>
												<div class="form-group group_style">
													<h5 >Renew Your Book </h5>
													<select class="form-control renew_select" name="book_name" required style="" >
														<option value="">Select Your Book To Renew </option>
															<?php 
																for($i=0;$i<$book_taken;$i++)
																	{
																		echo '<option>'.$arr[$i]['book_title'].'</option>';
																	}
																?>	
													</select>
													<input type="submit" value="submit"  name="renew_book" class="btn btn-primary  b_renew "/>
													<input type="hidden" name="id" value="<?php echo $id; ?>" />
												</div>
											</center>	
										</form>	
										
									</div><!--end of renew-->
								</div>
								<div class="tab-pane" id="request">
									<div class="request">
										<center>
											<h3>Request for Book</h3>	
											<form class="form-inline req" method="post" action="" > 
												<div class="form-group ">	
													<input type="trxt" name="title" class= "form-control book_req" placeholder="Book Title">
													<input type="trxt" name="author" class= "form-control book_req" placeholder="Author Name">
													<input type="text" name="edition"  class= "form-control book_req" placeholder="Edition"></br>
													<input type="submit"  value="OK" name="req_form" class="btn btn-primary b_req"/>
												</div>
											</form>	
										</center>
									</div><!--end of request-->
								</div>
							</div>
						</div><!--end of tab-->
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of profile_area-->
		<div class="show">
			<div class="container">
				<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div id="renew_div"></div>
						<?php include('renew_std.php');?>
					</div>
				<div class="col-md-2"></div>
				</div>
			</div>
		</div><!--end of show-->
		<div class="find_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<div class="find_book1" >
							<form class="form-inline" action="ViewSearch.php" role="form" method="post" id="search-form"style="margin-bottom:20px;padding-top:8px; background:#dedede;">
								<h3 style="margin:5px; color:white;background:#3276b1; font-size:16px;padding:10px;">Search Books </h3>								
								<center>
									<div class="form-group">	
										<select class="form-control find " name="cat_value" required >
											<option value="">Keyword</option>
											<option value="title">Title</option>
											<option value="author">Author</option>
											<option value="isbn">ISBN</option>
											<option value="book_id">Book Id</option>
											<option value="category">Category</option>
										</select>
										<input type="text" name="catagori" class= "form-control find" placeholder="Search"/>
										<button class="btn btn-primary find_btn">
											<i id="search-submit" type="submit" class="icon-search" style="color:white;margin:5px;font-size:20px;"></i>
										</button>
									</div>
								</center>
							</form>
						</div><!--end of find1-->
						
					</div>
					<div class="col-md-5">
						<div class="find_book2" >
							<form class="form-inline" action="ViewEbookSearch.php" role="form" method="post" id="ebook-form" style="padding-top:8px; background:#dedede;">
								<h3 style="margin:5px; color:white;background:#3276b1; font-size:16px;padding:10px;">Search EBooks </h3>								
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
						</div><!--end of find2-->
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div> <!--end of find_area-->
		<div class="show_area">
			<div class="container">
				<div class="row">
				<div class="col-md-1"></div>
					<div class="col-md-10">
						<div>
							<div class="search"></div>
						</div>
					</div>
				<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of show_area2-->
		<div class="histry_area">
			<div class="container">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="history">
							<div class="tab_std">
								<ul class="nav nav-tabs" role="tablist">
								  <li class="active"><a href="#history" role="tab" data-toggle="tab">View History</a></li>
								  <li><a href="#i_msg" role="tab" data-toggle="tab">Inbox Message</a></li>
								  <li><a href="#a_msg" role="tab" data-toggle="tab">Archive Message</a></li>
								</ul>
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="history">
									<h3 style="background:#3276b1; color:white;font-weight:bold;padding:8px;">History</h3>
										<div class="tab_heading">
											<form class="form-inline history_form" role="form" action="ViewHistory.php" method="POST"  name="" id="history-form">
													<center>
														
															<input type="date" name="StartDate" class="form-control" placeholder="yyyy-dd-mm" required >	
															TO
															<input type="date"  name="EndDate" class="form-control" placeholder="yyyy-dd-mm" required >	
															<input type="submit" value="submit" name="aform" class="btn btn-primary" id="history-submit"/>	
															<input type="hidden" name="action2" value="date_info" />
															<input type="hidden" name="user_id" value="<?php echo $user_id;?>" />
														
													</center>
											</form>
										</div>
									<div class="historyshow">
										<?php
											$user_id=$id;
											$query = "SELECT book_info.book_id ,
													book_info.book_title,
													issue_date , return_date ,  issue_by , 
													( DATEDIFF( return_date , issue_date ) - day_limit ) AS fine
													From book_info , book_transaction 
													Where book_transaction.book_number =  book_info.book_number
													and user_id = $user_id
													Order by transaction_id DESC 
													Limit 0,5" ;
													
											$result = mysqli_query($con,$query);
											$found = 0;

											?>
											<!-- Table to Show Last 5 history  -->
											
											<?php
												while($row=mysqli_fetch_array($result))
												{
													if($found===0)
													{
													?>
													<div class="table-responsive">
														<table class="table table-bordered">							
															<tr  class="info">
																<td><b>Book ID</b></td>
																<td><b>Book Title</b></td>
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
															<td><?php echo $row['book_id'];?></td>
															<td><?php echo $row['book_title'];?></td>
															<td><?php echo $row['issue_date'];?></td>
															<td><?php echo $row['return_date'];?></td>
															<td><?php echo $row['issue_by'];?></td>
															<td>

																<?php 
																	if($row['fine']>0) echo $row['fine'];
																	else echo"0";
																?>
															</td>
														</tr>
													<?php

												}
												?>
													</table>  <!-- End Of Table to Show Last 5 history  -->
												</div>
									</div>
							</div>
							<div class="tab-pane" id="i_msg">
								<h3 style="background:#3276b1; color:white;font-weight:bold;padding:8px;">Inbox</h3>
								<?php
									include('view_messages_user_inbox.php');
								?>
							</div>
							<div class="tab-pane" id="a_msg">
								<h3 style="background:#3276b1; color:white;font-weight:bold;padding:8px;">Archive</h3>
								<?php
									include('view_messages_user_archive.php');
								?>
							</div>
						</div> <!-- end of tab contant-->
						</div>
					</div>
					<div class="col-md-1"></div>
				</div>
			</div>
		</div><!--end of History_area-->
		<?php
			include('footer.php') // footer area
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
		<script src="js/request.js"></script>
		<script src="js/ebook.js"></script>
		<script src="js/renew.js"></script>
		<script src="js/history.js"></script>
		<script src="js/search.js"></script>
		<script src="js/msg.js"></script>
	</body>
</html>	

<?php
	if(isset($_POST['req_form']))
	{
		try
		{
			if(empty($_POST['title']) || empty($_POST['author']))
			throw new Exception('Field cant be empty');
				
			//$id=$_POST['id'];
			$title=$_POST['title'];
			$author=$_POST['author'];
			$edition=$_POST['edition'];

			//include('connect.php');
			$con_db = getcon();
			$query = "INSERT INTO `db_leading`.`book_request`(`user_id`,`book_title`,`author`,`edition`) VALUES ('$user_id',  '$title',  '$author','$edition')";
			$result = mysqli_query($con_db,$query);
			
			 if($result) 
			 {
				echo '<script type="text/javascript">';
					echo 'alert("Book Request Done Successfully!")';
				echo '</script>';
			 }
		}
		catch(Exception $e)
		{
			$error=$e->getMessage();
		
		}
	}

?>
<?php
	if(isset($error))echo $error;

}
else
header('Location: ../index.php');
?>