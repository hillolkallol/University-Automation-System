<?php
///////////////////// permission starts
require 'connect.conf.php';
require '../Admission/init.php';

	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
   {
	
		
////////////////////// permission working	
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      
<html class="no-js lt-ie9 lt-ie8 lt-ie7">
   <![endif]-->
   <!--[if IE 7]>         
   <html class="no-js lt-ie9 lt-ie8">
      <![endif]-->
      <!--[if IE 8]>         
      <html class="no-js lt-ie9">
         <![endif]-->
         <!--[if gt IE 8]><!--> 
         <html class="no-js">
            <!--<![endif]-->
            <head>
               <meta charset="utf-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <title>Leading University | Admin Panel | Fees</title>
               <meta name="description" content="">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <!-- Place favfa fa.ico and apple-touch-fa fa.png in the root directory -->
               <link rel="stylesheet" href="css/font-awesome.min.css">
               <link rel="stylesheet" href="css/bootstrap.min.css">
               <link rel="stylesheet" href="css/normalize.css">
               <link rel="stylesheet" href="css/main.css">
               <link rel="stylesheet" href="css/responsive.css">
			<script src="js/vendor/modernizr-2.6.2.min.js"></script>
            </head>
            <body>
               <!--[if lt IE 7]>
               <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
               <![endif]-->
               <!-- Add your site or application content here -->
               <div class="header_add">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-10">
                           <div class="header_top text-left">
                              <ul>
                                 <li><i class="fa fa-phone heading_fa fa"></i>+88-0821-720303-6</li>
                                 <li><i class="fa fa-envelope heading_fa fa"></i>mail@cse26.net</li>
                              </ul>
                           </div>
                        </div>
                        <div style="margin-top: 12px;" class="col-md-2 text-left">
                           <div class="btn-group" style="float:right">
                              <a class="btn btn-primary" href="#"><i class="fa fa-user"></i> Student</a>
                              <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="../Admission/change_pass.php"><i class="fa fa-key"></i> Change Password</a></li>
                                 <li><a href="../Admission/logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
		
               <div class="admin_menu_area">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12">
                           <ul class="list-inline list">
                              <li > <a href="../welcome_student.php"> <i class="fa fa-home fa fa-2x"></i> <span class="menu_label">Home</span> </a> </li>
                              <li > <a href="student_view.php"> <i class="fa fa-exchange fa fa-2x"></i> <span class="menu_label">Payment History</span> </a> </li>
                              
							  <!--<li > <a href="student_message.php"> <i class="fa fa-envelope fa fa-2x"></i> <span class="menu_label">Message</span> </a> </li>     -->                        
                              
							  <li > <a href="student_fees.php"> <i class="fa fa-usd fa fa-2x"></i> <span class="menu_label">Pay Slip</span> </a> </li>
                           </ul>
                        </div>
                        </nav>
                     </div>
                  </div>
               </div>
			   
			   
			   
<?php
////////////// permission working
	}
	else
	{
		header('Location: ../index.php');
	}
////////////////// permission ends
?>