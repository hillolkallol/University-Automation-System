<?php 
	include('admin_header.php');
	
	if(isset($_POST['saveDescription']))
	{
		$description = $_POST['addDescription'];
		
		if(!empty($description))
		{
			$query = "INSERT INTO fine_desc(description) VALUES('".$description."')";
			if($query_run = mysql_query($query))
			{
				echo '<script type="text/javascript">';
				echo 'alert("A new description added!")';
				echo '</script>';
			}
			else
			{
				echo '<script type="text/javascript">';
				echo 'alert("Something Worng!")';
				echo '</script>';
			}
		}
		else
		{
		echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_income.php"	</script>';
		}
	}
	
	if(isset($_POST['reduce']))
	{
		$stduentId = $_POST['stduentId'];
		$description = $_POST['description'];
		$amount = $_POST['amount'];
		
		if(!empty($description) && !empty($amount))
		{
			$query = "SELECT * FROM due_history WHERE studentId='".$stduentId."'";	
			if($query_run = mysql_query($query))
			{
				$transId = mysql_result($query_run, 0, 'tNo');
				$newDue = mysql_result($query_run, 0, 'dueAmount');
				$libraryFine = mysql_result($query_run, 0, 'libraryFine');
				if($description=='Library Fine')
					$libraryFine = $libraryFine - $amount;
				else
					$newDue = $newDue - $amount;


				$query1 = "INSERT INTO reduce_fine(studentId, fineDesc, amount) VALUES ('".$stduentId."','".$description."','".$amount."')";

				$query2 = "UPDATE due_history SET libraryFine='".$libraryFine."', dueAmount='".$newDue."' WHERE studentId='".$stduentId."'";
				if($query_run1 = mysql_query($query1) && $query_run2 = mysql_query($query2))
				{
					echo '<script type="text/javascript"> alert("Fine has been reduced!") 
						window.location.href="admin_reduce_fine.php"	</script>';
				}
				else
				{
					echo '<script type="text/javascript"> alert("Something Worng!") 
						window.location.href="admin_income.php"	</script>';
				}
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng!") 
						window.location.href="admin_income.php"	</script>';
			}
		}
		else
		{
		echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_income.php"	</script>';
		}
	}
?>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="breadcrumbs">
                  <span><strong>You are here:</strong>&nbsp;&nbsp;&nbsp;</span>
                  <a href="index.php"><i class="fa fa-home"></i>&nbsp;Home&nbsp;&nbsp;</a>
                  <span class="sep">/&nbsp;&nbsp;</span>
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Reduce Fine</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">

                  <div id="others_expense" class="">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">Reduce Fine</h4>
                              </div>
							  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                              <div class="panel-body">
                                
                                 <div class="form_sep">
                                    <label>Student ID <span style="color:red">*</span></label>
                                    <input type="text" class="form-control " name="stduentId" required="required">
                                 </div>
                                 <br />

                                 <div class="form_sep">
                                    <label>Description <span style="color:red">*</span></label>
                                    <select required class="form-control" name="description" id="course">
                                    	<option></option>
                                       <?php
										$query = "SELECT * FROM fine_desc";
										if($query_run = mysql_query($query))
										{
											while($query_row = mysql_fetch_assoc($query_run))
											{
												?><option value="<?php
													echo $query_row['description'];
												?>"> 
												<?php echo $query_row['description']; ?>
												</option>
												<?php
											}
										}
									   ?>
                                    </select>
                                    <br />
                                    <a href="" class="btn btn-primary"  data-toggle="modal" data-target="#button">Add a description</a>
                                    
                                 </div>
                                 <br />
                                 <div class="form_sep">
                                    <label>Amount <span style="color:red">*</span></label>
                                    <input required type="text" class="form-control " name="amount" required="required">
                                 </div>
                                 <br />
                                 <button type="submit" name="reduce" class="btn btn-danger fa fa-save">&nbsp;Reduce</button>
                              </div>
							  </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
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
                                                <h4 class="modal-title" id="myModalLabel">Add New Description</h4>
                                             </div>
                                             <div class="modal-body">
                                                <div class="form_sep">
                                                   <label>Description <span style="color:red">*</span></label>
                                                   <input type="text" class="form-control " name="addDescription"/>
                                                </div>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" name="saveDescription" class="btn btn-primary fa fa-save">&nbsp;Save changes</button>
                                             </div>
											 </form>
                                          </div>
                                       </div>
                                    </div>
	  <script>
		$(function() {
		$( "#datepicker1" ).datepicker();
		$( "#datepicker2" ).datepicker();
		$( "#datepicker3" ).datepicker();
		});
		</script>
      
   </body>
</html>

<?php
		include('admin_footer.php')
?>
