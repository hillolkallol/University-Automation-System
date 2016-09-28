<?php 
require 'Accounts/connect.conf.php';
require 'Accounts/core.inc.php';
$access = 0;
$getUser;

	if(isset($_POST['save']))
	{
		$user = $_POST['user'];
		$newpass1 = $_POST['newpass'];
		
		if(!empty($newpass1))
		{
							$newpass = md5($newpass1);

							$query5 = "UPDATE tbl_teacher_info SET tch_password= '".mysql_real_escape_string($newpass)."' WHERE tch_id='".mysql_real_escape_string($user)."'";
							
							if($query_run5 = mysql_query($query5))
							{
								echo '<script type="text/javascript"> alert("Password Recovered!") 
								window.location.href="teacher.php"	</script>';
							}
							else
							{
								echo '<script type="text/javascript"> alert("Something Worng!") 
								window.location.href="teacher.php"	</script>';
							}
		}		
	}

	if(isset($_GET['user']) && isset($_GET['hash']))
	{
		$getUser = $_GET['user'];

		$query = "SELECT * FROM recover_password WHERE username = '".$getUser."'";
		if($query_run = mysql_query($query))
		{
			while($query_row = mysql_fetch_assoc($query_run))
			{
				$hash = $query_row['unique_hash'];
				if($hash==$_GET['hash'])
				{
					$access = 1;
				}
			}
			
		}
		else
		{
			//die(mysql_error());
			echo '<script type="text/javascript"> alert("Something Worng!") 
			window.location.href="teacher.php"	</script>';
		}
	}
	else
	{
		echo '<script type="text/javascript"> alert("Something Worng!") 
			window.location.href="teacher.php"	</script>';
	}

	if($access==0)
	{
		echo '<script type="text/javascript"> alert("Something Worng!") 
			window.location.href="teacher.php"	</script>';
	}
		
	
	
?>
<html>
<body>
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
               <link rel="stylesheet" href="Accounts/css/font-awesome.min.css">
               <link rel="stylesheet" href="Accounts/css/bootstrap.min.css">
               <link rel="stylesheet" href="Accounts/css/datepicker.css">
               <link rel="stylesheet" href="Accounts/css/main.css">
               <link rel="stylesheet" href="Accounts/css/responsive.css">
               <script src="Accounts/js/vendor/modernizr-2.6.2.min.js"></script>

 				<br><br><br><br><br>
               <div class="login_content">
                  <div class="container">
                     <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                           <div class="single_login">
                              <h2>Recover Password</h2>
                              <form action="<?php echo $current_file;?>" method="POST">
                                 <div class="form-group">
                                    <input name="newpass" title="Password must contain at least 8 characters, including UPPER/lowercase and numbers. To get a strong password, please use characters like- ~!@#$%^&*(){}|][" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="password" placeholder="New Password" class="form-control input" onchange=" 
                                    this.setCustomValidity(this.validity.patternMismatch ? this.title : ''); 
                                    if(this.checkValidity()) form.renewpass.pattern = this.value; 
                                    ">
                                 </div>
                                 <div class="form-group">
                                    <input name="renewpass" title="Please enter the same Password as above" type="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" placeholder="Re-Type Password" class="form-control input">
                                 </div>
                                 <input hidden value="<?php echo $getUser; ?>" name="user">
                                 <div class="form-group">
                                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3"></div>
                  </div>
               </div>
              
            </body>
         </html>