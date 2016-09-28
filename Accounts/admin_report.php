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
                           <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Report</span>
                        </div>
                     </div>

            			
               <div class="col-md-12">
			   <form action="admin_report_print.php" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                  <div class="panel panel-default">
                     <div class="panel-heading">
                        <h4 class="panel-title">Total Report</h4>
                     </div>
                     <div class="panel-body">
					 <div class="form_sep col-md-12" style="margin-bottom: 25px;">
						<div class="col-md-2">
							<label class="fa fa-calendar " style="margin-bottom: 15px; font-size: 18px;">&nbsp;Date</label>
						</div>
						<div class="col-md-10">
                           <div class="row">
						   <div class="col-md-3">
                              <input type="radio" class="inlineCheckbox1" value="all" name="allDateAll">&nbsp;All
						   </div> 
						   <div class="col-md-1">
								<input type="radio" class="inlineCheckbox1" value="choose" name="allDateAll">
						   </div>
							<div class="col-md-4">
                               <input name="allDateFrom" style="width:100%" id="datepicker1" type="date" class="form-control" placeholder="From">
						   </div>
                           <div class="col-md-4">
                               <input name="allDateTo" style="width:100%" id="datepicker2" type="date" class="form-control" placeholder="To">
						   </div>
						   </div>
						</div>
                         </div>
                         <br />
						 <div class="form_sep col-md-12" style="margin-bottom: 25px;">
						 <div class="col-md-2">
							 <label style="margin-bottom: 15px; font-size: 18px; " class=" fa fa-file-text">&nbsp;Category</label>
						</div>
						<div class="col-md-10">
                           <div class="row">
							<div class="col-md-6">
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox1" value="income" name="allCategories[]">&nbsp;Income
							</label>
						   </div>
                           <div class="col-md-6">
							<label class="checkbox-inline">
							  <input type="checkbox" id="inlineCheckbox1" value="expense" name="allCategories[]">&nbsp;Expense
							</label>
						   </div> 
						   </div>
						 </div>
                         </div>
						 <br />
						 <div class="form_sep col-md-12" style="margin-bottom: 25px;">
						 <div class="col-md-2">
							<label  style="margin-bottom: 15px; font-size: 18px;" class="fa fa-briefcase">&nbsp;Particulars </label>
						</div>
						<div class="col-md-10" style="margin-bottom: 25px;">
							<div class="col-md-6">
							<label>Income Particulars</label>
							<select multiple id="course" class="form-control parsley-validated" name="allIncomeDesc[]"  data-required="true" style="">
										<?php
										$query = "SELECT * FROM descriptions_list WHERE category='income'";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['descriptions'];
												?>"> 
												<?php echo $query_row['descriptions']; ?>
												</option>
												<?php
											}
										}
									   ?>
							</select></div>
							<div class="col-md-6">
							<label>Expense Particulars</label>
							<select multiple id="course" class="form-control parsley-validated" name="allExpenseDesc[]"  data-required="true" style="">
										<?php
										$query = "SELECT * FROM descriptions_list WHERE category='expense'";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['descriptions'];
												?>"> 
												<?php echo $query_row['descriptions']; ?>
												</option>
												<?php
											}
										}
									   ?>
							</select>
						</div>
						 </div>
						 <br /> 
						 <div class="form_sep col-md-12" style="margin-bottom: 25px;">
						 <div class="col-md-2">
							 <label  style="margin-bottom: 15px; font-size: 18px;" class=" fa fa-money">&nbsp;Amount</label>
						</div>
						<div class="col-md-10">
                           <div class="row">
							<div class="col-md-2">
							<label class="checkbox-inline">
							  <input type="radio" id="inlineCheckbox1" value="any" name="allAmount">&nbsp;Any
							</label>
						   </div>
							<div class="col-md-5">
							<label class="checkbox-inline">
							  <input type="radio" id="inlineCheckbox1" value="gt" name="allAmount">&nbsp;Greater Than...
							</label>
							<input type="text" class="form-control" name="gtAmount"/>
						   </div>
							<div class="col-md-5">
							<label class="checkbox-inline">
							  <input type="radio" id="inlineCheckbox1" value="lt" name="allAmount">&nbsp;Less Than...
							</label>
							<input type="text" class="form-control" name="ltAmount"/>
						   </div>
						   </div>
						 </div>
                         </div>
						 <br/>
						 <div class=" col-md-12" style="margin-left: 15px;">
						 <button type="submit" name="allCreateReport" class="btn btn-primary fa fa-plug">&nbsp;Create Report</button>
						 </div>
                  </div>
				  
			
               </div>
            </form>
         </div>
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
