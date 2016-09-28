<?php
require 'Admission/init.php';
if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
   {
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
               <title>Leading University | Welcome To Leading University Automation</title>
               <meta name="description" content="">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <!-- Place favfa fa.ico and apple-touch-fa fa.png in the root directory -->
               <link rel="stylesheet" href="Accounts/css/font-awesome.min.css">
               <link rel="stylesheet" href="Accounts/css/bootstrap.min.css">
               <link rel="stylesheet" href="Accounts/css/normalize.css">
               <link rel="stylesheet" href="Accounts/css/main.css">
               <link rel="stylesheet" href="Accounts/css/responsive.css">
               <script src="Accounts/js/vendor/modernizr-2.6.2.min.js"></script>
            </head>
            <body>
               <!--[if lt IE 7]>
               <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
               <![endif]-->
               <!-- Add your site or application content here -->
               <div class="header_add">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-7">
                           <div class="header_top">
                              <ul>
                                 <li><i class="fa fa-phone heading_fa fa"></i>&nbsp;+88-0821-720303-6</li>
                                 <li><i class="fa fa-envelope heading_fa fa"></i>&nbsp;mail@cse26.net</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="breadcumb_area">
                  <div class="container">
                        <div class="row">
                           <div class="col-md-2">
                              <div class="logo" >
                                 <img src="Accounts/img/logo.png" alt="" style="width:100%;"/>
                              </div>
                           </div>
                           <div class="col-md-10">
                              <div style="font-size:35px; padding-top:60px;">Welcome To Leading University Automation System</span></div>
                           </div>
                        </div>
                  </div>
               </div>
               
               <div class="login_content">
                  <div class="container">
                     <div class="row">
						<div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          
          <div class="caption">
            <h3 style="text-align: center; font-weight: bold; border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 15px;"><i class="fa fa-sign-in"></i>&nbsp;Admission & Registration</h3>
            <p>You can get your admission & registration information here. Obviously it is very much helpful for you.Stay tuned with us. Thank you! </p>
            
            <p><a role="button" class="btn btn-primary btn-block" href="Admission/personal.php">Continue...</a></p>
          </div>
        </div>
      </div>
						<div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          
          <div class="caption">
            <h3 style="text-align: center; font-weight: bold; border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 15px;"><i class="fa fa-usd"></i>&nbsp;Accounts</h3>
            <p>You can get your accounts information here. Obviously it is very much helpful for you.Stay tuned with us. Thank you! </p>
            
            <p><a role="button" class="btn btn-primary btn-block" href="Accounts/student_view.php">Continue...</a></p>
          </div>
        </div>
      </div>
						<div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          
          <div class="caption">
            <h3 style="text-align: center; font-weight: bold; border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 15px;"><i class="fa fa-puzzle-piece"></i>&nbsp;Exam & Results</h3>
            <p>You can get your exams info & result here.Obviously it is very much helpful for you.Stay tuned with us. Thank you! </p>
            <p><a role="button" class="btn btn-primary btn-block" href="Exam/student_option.php">Continue...</a></p>
          </div>
        </div>
      </div>
						<div class="col-sm-6 col-md-3">
        <div class="thumbnail">
          
          <div class="caption">
            <h3 style="text-align: center; font-weight: bold; border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 15px;"><i class="fa fa-book"></i>&nbsp;Library</h3>
            <p>You can get your library information here.Obviously it is very much helpful for you.Stay tuned with us. Thank you! <br /></p>
            <p><a role="button" class="btn btn-primary btn-block" href="Library/student.php">Continue...</a></p>
          </div>
        </div>
      </div>
						</div>
                     </div>
                  </div>
                  <br>
			   <div class="footer_area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="copy">
                     <center><p title="By Nahian & Kallol"><strong>Design &amp; Developed By:</strong> CSE 26th Batch.Leading University</p></center>
                  </div>
               </div>
            </div>
         </div>
      </div>
               <script src="htttp://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
               <script>window.jQuery || document.write('<script src="Accounts/js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
               <script src="Accounts/js/bootstrap.min.js"></script>
               <script src="Accounts/js/plugins.js"></script>
               <script src="Accounts/js/main.js"></script>
            </body>
         </html>

         <?php
       }
       else
       {
          header('location:index.php');
       }
         ?>