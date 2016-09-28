<?php
///////////////////// permission starts
require 'connect.conf.php';
require 'core.inc.php';

	if(loggedin())
	{
		$accessCategory = $_SESSION['accessCategory'];
		if($accessCategory==1)
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
               <title>Leading University | Admin Panel</title>
               <meta name="description" content="">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <!-- Place favfa fa.ico and apple-touch-fa fa.png in the root directory -->
			<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
               <link rel="stylesheet" href="css/font-awesome.min.css">
               <link rel="stylesheet" href="css/bootstrap.min.css">
               <link rel="stylesheet" href="css/datepicker.css">
               <link rel="stylesheet" href="css/main.css">
               <link rel="stylesheet" href="css/responsive.css">
               <script src="js/vendor/modernizr-2.6.2.min.js"></script>
            </head>
            <body>
               <!--[if lt IE 7]>
               <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
               <![endif]-->
               <!-- Add your site or application content here -->
               <div class="header_add" style="margin-bottom:12px">
                  <div class="container">
                     <div class="row">
						<div class="col-md-2">
							<img style="width: 160px; margin-top: 5px;" src="img/header-logo.png" alt="">
						</div>
                        <div class="col-md-8">
                           <div class="header_top text-left">
                              <ul>
                                 <li><i class="fa fa-phone heading_fa fa"></i>&nbsp;+88-0821-720303-6</li>
                                 <li><i class="fa fa-envelope heading_fa fa"></i>&nbsp;mail@cse26.net</li>
                              </ul>
                           </div>
                        </div>
                        <div class="col-md-2" style="margin-top: 12px;">
                           <div class="btn-group" style="float:right">
                              <a href="#" class="btn btn-primary"><i class="fa fa-user"></i> Admin</a>
                              <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle"><span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                 <li><a href="admin_profile.php"><i class="fa fa-pencil"></i> Profile</a></li>
                                 <li><a href="admin_password.php"><i class="fa fa-key"></i> Change Password</a></li>
                                 <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a></li>
                                 <li class="divider"></li>
                                 <li><a href="admin_new.php"><i class="fa fa-hand-o-right"></i> Add Admin</a></li>
								 <li><a href="delete_admin.php"><i class="fa fa-hand-o-right"></i> Delete Admin</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="admin_menu_area">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-12 selected">
                           <ul class="list-inline list">
                              <li > <a href="admin.php"> <i class="fa fa-home fa fa-2x"></i> <span class="menu_label">Home</span> </a> </li>
                              
							  <!--<li > <a href="admin_message.php"> <i class="fa fa-envelope fa fa-2x"></i> <span class="menu_label">Message</span> </a> </li>  -->
                              <li > <a href="admin_fees.php"> <i class="fa fa-usd fa fa-2x"></i> <span class="menu_label">Pay Slip</span> </a> </li>
							         <li > <a href="admin_income.php"> <i class="fa fa-money fa fa-2x"></i> <span class="menu_label">Income</span> </a> </li>
                              <li > <a href="admin_expense.php"> <i class="fa fa-money fa fa-2x"></i> <span class="menu_label">Expense</span> </a> </li>
                              
                              <li > <a href="admin_report.php"> <i class="fa fa-exchange fa fa-2x"></i> <span class="menu_label">Income-Expense Report</span> </a> </li>                       
                              <li > <a href="admin_student_collection_report.php"> <i class="fa fa-exchange fa fa-2x"></i> <span class="menu_label">Student Collection Report</span> </a> </li>							  
                              <li > <a href="admin_balance.php"> <i class="fa fa-exchange fa fa-2x"></i> <span class="menu_label">Balance Sheet</span> </a> </li>							  
                              <li > <a href="admin_reduce_fine.php"> <i class="fa fa-money fa fa-2x"></i> <span class="menu_label">Reduce Fine</span> </a> </li>
                              <li > <a href="admin_new_add.php"> <i class="fa fa-wrench fa fa-2x"></i> <span class="menu_label">Settings</span> </a> </li>
                           </ul>
                        </div>
                        </nav>
                     </div>
                  </div>
               </div>
			   
			   
<?php
////////////// permission working
		}
		if($accessCategory==2)
		{
			header('Location: student_view.php');
		}
	}
	else
	{
		header('Location: login.php');
	}
////////////////// permission ends
?>