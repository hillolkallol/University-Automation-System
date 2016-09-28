<?php 
	include('admin_header.php');
?>
              
			  <div class="container">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="breadcrumbs">
                           <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                           <a href="index.html"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                           <span class="sep">/&nbsp;&nbsp;</span>
                           <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Balance Sheet</span>
                        </div>
                     </div>

            			
               <div class="col-md-12" style="margin-top:20px">
			   <form action="admin_balance_details.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">Balance Sheet Report</h4>
                     </div>
                     <div class="panel-body">
					 <div class="form_sep col-md-12" style="margin-bottom: 25px;">
						<div class="col-md-2">
							<label class="fa fa-calendar " style="margin-bottom: 15px; font-size: 18px;">&nbsp;Date</label>
						</div>
						<div class="col-md-10">
                           <div class="row">
								<div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-arrow-right"></i></span>
										<input required name="DateFrom" style="width:100%" id="datepicker1" type="date" class="form-control" placeholder="From">
									</div>
							   </div>
							   <div class="col-md-4">
									<div class="input-group">
										<span class="input-group-addon" id="basic-addon1"><i class="fa fa-arrow-left"></i></span>
										<input required name="DateTo" style="width:100%" id="datepicker2" type="date" class="form-control" placeholder="To">
									</div>
							   </div>
						   </div>
						</div>
                         </div>
						 <br/>
						 <div class=" col-md-12" style="margin-left: 15px;">
						 <button type="submit" name="createBalanceSheet" class="btn btn-primary fa fa-plug">&nbsp;Create Balance Sheet</button>
						 </div>
                  </div>
				  
			
               </div>
            </form>
         </div>
         </div>
         </div>
		 <script>
			$(function() {
			$( "#datepicker1" ).datepicker({format: 'yyyy-mm-dd'});
			$( "#datepicker2" ).datepicker({format: 'yyyy-mm-dd'});
			$( "#datepicker3" ).datepicker({format: 'yyyy-mm-dd'});
			});
		</script>
		
		<?php
			include('admin_footer.php');
		?>
            </body>
         </html>
