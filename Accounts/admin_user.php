<?php 
	include('admin_header.php');
?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Admin User</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
               <div class="alert alert-info"><strong>Admin User</strong></div>
               <form action="#" method="POST" id="user" name="user" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <!--<div class="panel-heading">
                        <h4 class="panel-title">Simple Validation</h4>
                        </div>-->
                     <div class="panel-body">
                        <div class="form_sep">
                           <label>First Name</label>
                           <input name="first_name" class="form-control parsley-validated" data-required="true" type="text">
                        </div>
                        <div class="form_sep">
                           <label>Last Name</label>
                           <input id="last_name" name="last_name" class="form-control parsley-validated" data-required="true" type="text">
                        </div>
                        <div class="form_sep">
                           <label for="register_username" class="req">Username</label>
                           <input id="username" name="username" class="form-control parsley-validated" data-required="true" data-required-message="Please enter a valid Username" type="text">
                        </div>
                        <div class="form_sep">
                           <label for="register_password" class="req">Password</label>
                           <input id="password" name="password" class="form-control input-lg parsley-validated" value="" data-required="true" data-minlength="6" data-minlength-message="Password should have at least 6 characters." data-required-message="Please enter a valid Password" type="password"> 							
                        </div>
                        <div class="form_sep">
                           <label for="reg_password_repeat" class="req">Repeat Password</label>
                           <input name="password_repeat" id="password_repeat" class="form-control parsley-validated" data-required="true" data-equalto="#password" type="password">
                        </div>
                        <div class="form_sep">
                           <label for="email" class="req">Email</label>
                           <input id="email" name="email" class="form-control parsley-validated" data-required="true" data-type="email" type="text">
                        </div>
                        <div class="form_sep">
                           <label for="phone" class="req">Phone</label>
                           <input id="phone" name="phone" class="form-control parsley-validated" data-required="true" data-required-message="Please enter a valid Number" data-type="number" type="text">
                        </div>
                        <br />
                        <div class="form_sep">
                           <button class="btn btn-success" type="submit" name="user_submit" id="user_submit">Save</button>
                        </div>
                     </div>
                     <!--set privillege-->
                  </div>
               </form>
            </div>
         </div>
      </div>
      
	  <?php
		include('admin_footer.php')
	  ?>
   </body>
</html>
