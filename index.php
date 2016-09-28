<?php
include("Admission/db_connection.php");
require 'Admission/init.php';

if(isset($_POST['btn_login']))
{
   $user= mysql_real_escape_string(htmlentities(isset($_POST['user'])?$_POST['user']:null));
   $id= mysql_real_escape_string(htmlentities(isset($_POST['user_id'])?$_POST['user_id']:null));
   $pass= mysql_real_escape_string(htmlentities(isset($_POST['user_pass'])?$_POST['user_pass']:null));
      $query="Select std_id,std_password From tbl_student_info Where std_id='$id'";
      $result=mysql_query($query);
      $check=mysql_num_rows($result);
      if($check==1)
      {
         $row=mysql_fetch_array($result);
         $password=$row['std_password'];
         $id=$row['std_id'];
         if($password==$pass)
         {
            $_SESSION['user_id']=$id;
            header('location: welcome_student.php');
         }
         else
         {
            header('location:index.php');
            
         }
         
   }
}

if(isset($_POST['recover']))
{
   $username = $_POST['username'];
   $unique_hash = md5(rand(6,100000));
   $query="INSERT INTO recover_password (unique_hash, username) VALUES('".$unique_hash."', '".$username."')";
   if($query_run = mysql_query($query))
   {
      $query2="SELECT * FROM tbl_student_info WHERE std_id='".$username."'";
      $query_run2 = mysql_query($query2);
      $to = mysql_result($query_run2, 0, 'std_email');
      $subject = "Password Recovery";

      $link="http://".$_SERVER['SERVER_NAME']."/Automation/student_password_recovery.php?user=".$username."&hash=".$unique_hash;
      echo $link;
      $body="To recover your password, click the link ".$link;
      $headers="From: Leading University <info@lus.ac.bd>";

      if(mail($to, $subject, $body, $headers))
      {
         echo '<script type="text/javascript">';
         echo 'alert("An email has been sent to your email account!")';
         echo '</script>';
      }
      else
      {
         echo '<script type="text/javascript">';
         echo 'alert("There was an error sending email!")';
         echo '</script>';
      }
   }
}



   if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
   {
       header('location: welcome_student.php');
   }
   else
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
               <title>Leading University | LogIn</title>
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
                              <div style="font-size:35px; padding-top:50px;">Welcome To Leading University Automation System</div>
                           </div>
                        </div>
                  </div>
               </div>
               
               <div class="login_content">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                           <div class="single_login">
                              <h2>Student Login</h2>
<!---------------------------------form Starts---------------------------------------------->
                              <form action="<?php echo $current_file;?>" method="POST">
                                 <div class="form-group input-group">
									<span class="input-group-addon" id="basic-addon1"><i class="fa fa-user"></i></span>
                                    <input type="text" name="user_id" placeholder="Student ID" class="form-control input" required="required">
                                 </div>
                                 <div class="form-group input-group">
                                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-key"></i></span><input type="password" name="user_pass" placeholder="Password" class="form-control input" required="required">
                                 </div>
                                 <div class="form-group">
                                    <input type="submit" name="btn_login" value="Submit" class="btn btn-primary">
                                    <p class="forgot"><a href=""  data-toggle="modal" data-target="#button"><i class="fa fa-key"></i>&nbsp;Forgot Password?</a></p>
                                 </div>
                              </form>
							  
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3"></div>
                  </div>
               </div>
			   <div class="footer_area">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="copy">
                     <p><strong>Designed &amp; Developed By:</strong> CSE 26th Batch.Leading University</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
                               <!-- Modal -->
                                    <div class="modal fade" id="button" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                       <div class="modal-dialog">
                                          <div class="modal-content">
                                 
                                 <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                                             <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <h4 class="modal-title" id="myModalLabel">Enter your Student ID</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="form_sep">
                                                   <label>Student ID <span style="color:red">*</span></label>
                                                   <input required type="text" class="form-control " name="username"/>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="recover" class="btn btn-primary fa fa-save">&nbsp;Recover</button>
                                             </div>
                                  </form>
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
         ?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     