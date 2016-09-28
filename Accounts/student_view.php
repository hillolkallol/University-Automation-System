<?php

include('student_header.php')

?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Student Account Details</span>
               </div>
            </div>
            <form action="student_total_print.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                <div class="col-md-12">
					  <div class="panel panel-default">
						 <div class="panel-heading">
							<h4 class="panel-title">Total Payment History</h4>
						 </div>
						 <div class="panel-body">
							<div class="form_sep">
							   <label>Student ID<span style="color:red">*</span></label>
							   <input readonly value="<?php echo $_SESSION['user_id']; ?>" id="std_number" name="studentId" class="form-control" type="text">
							</div>
							<br />
							<button  class="btn btn-primary fa fa-search" type="submit" name="searchTotal" id="std_reg_submit">&nbsp;Search</button>
						 </div>
					  </div>
				</div>
			</form>
			<form action="student_total_print.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
			   <div class="col-md-12">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">Single Semester Payment History</h4>
                     </div>
                     <div class="panel-body">
                        <div class="form_sep">
                           <label>Student ID<span style="color:red">*</span></label>
                           <input readonly value="<?php echo $_SESSION['user_id']; ?>" id="std_number" name="studentId" class="form-control" type="text">
                        </div>
                        <br />							 
                        <div class="form_sep">
                           <label>Session <span style="color:red">*</span></label>
                           <select required="required"   id="course" name="season" class="form-control ">
                              <option></option>
                              <option value="Spring">Spring</option>
                              <option value="Summer">Summer</option>
                              <option value="Fall">Fall</option>
                           </select>
                        </div>
                        <br />
                        <div class="form_sep">
                           <label>Year <span style="color:red">*</span></label>
                           <select required="required"  class="form-control" name="year" id="course">
                              <option></option>
                              <option value="2011">2011</option>
                              <option value="2012">2012</option>
                              <option value="2013">2013</option>
                              <option value="2014">2014</option>
                              <option value="2015">2015</option>
                              <option value="2016">2016</option>
                           </select>
                        </div>
                        <br />
                        <button class="btn btn-primary fa fa-search" type="submit" name="searchSingle" id="std_reg_submit">&nbsp;Search</button>
					</div>
					</div>
					</div>
            </form>
         </div>
         </div>
      
	  <?php require('student_footer.php');?>
	  
      
   </body>
</html>
