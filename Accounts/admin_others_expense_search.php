<?php 
	include('admin_header.php');
	
	$transNo;
	$description;
	$descCount = 0;
	if(isset($_POST['searchTrans']))
	{
		$transNo = $_POST['transNo'];		
		if(empty($transNo))
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_expense.php"	</script>';
		}
		else
		{
			$query= "SELECT * FROM all_transactions WHERE tNo='".$transNo."'";
			$query_run = mysql_query($query);
			$desc = mysql_result($query_run, 0, 'description');
			
			$query2 = "SELECT * FROM descriptions_list WHERE category='expense' AND part='others'";
			if($query_run2 = mysql_query($query2))
			{
				while($query_row2 = mysql_fetch_assoc($query_run2))
				{
					if($desc == $query_row2['descriptions'])
					{
						$description = $desc;
						$descCount = 1;
					}
				}
			}
			if($descCount!=1)
				echo '<script type="text/javascript"> alert("Incorrect Transaction No!") 
				window.location.href="admin_expense.php"	</script>';
		}
	}
	
	if(isset($_POST['edit']))
	{
		$newDesc = $_POST['description'];		
		$newAmount = $_POST['amount'];		
		if(!empty($newDesc) && !empty($newDesc))
		{
			$transNo = $_POST['tNo'];
			$time = time();
			$date = date('Y-m-d', $time);
			$transBy = $_SESSION['sessionUsername'];
			
			$query= "UPDATE all_transactions SET date='".mysql_real_escape_string($date)."',description='".mysql_real_escape_string($newDesc)."',amount='".mysql_real_escape_string($newAmount)."',transBy='".mysql_real_escape_string($transBy)."' WHERE tNo='".mysql_real_escape_string($transNo)."'";
			
			if($query_run = mysql_query($query))
			{
				echo '<script type="text/javascript"> alert("Edited!") 
				window.location.href="admin_expense.php"	</script>';
			}
			else
			{
				echo '<script type="text/javascript"> alert("Something Worng!") 
				window.location.href="admin_expense.php"	</script>';
			}
		}
		else
		{
			echo '<script type="text/javascript"> alert("Fill all the fields!") 
			window.location.href="admin_expense.php"	</script>';
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
                  <span class="current"><i class="fa fa-sign-in"></i>&nbsp;Other Income Search Result</span>
               </div>
            </div>
         </div>
      </div>
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="alert alert-info"><strong>Other Income Search</strong></div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">Others Details</h4>
                  </div>
                  <div class="panel-body">
				  <form action="<?php echo $current_file;?>" method="POST" id="std_register" name="std_register" enctype="multipart/form-data">
                     <div class="form_sep">
                        <label for="reg_input">Description <span style="color:red">*</span></label>
                        <select data-required="true" class="form-control" name="description" id="course">
								<?php
									if(isset($_POST['searchTrans']))
									{	
										?>
										<option> <?php echo $description; ?> </option> <?php
										
										$query2 = "SELECT * FROM descriptions_list WHERE category='expense' AND part='others'";
										if($query_run2 = mysql_query($query2))
										{
											while($query_row2 = mysql_fetch_assoc($query_run2))
											{
												if($description!=$query_row2['descriptions'])
												{
												?><option value="<?php
													echo $query_row2['descriptions'];
												?>"> 
												<?php echo $query_row2['descriptions']; ?>
												</option>
												<?php
												}
											}
										}
									}
									else
										echo 0;
								?>
                        </select>
                     </div>
                     <br />
                     <div class="form_sep">
                        <label>Amount <span style="color:red">*</span></label>
                        <input type="text" class="form-control" name="amount" value="<?php
						if(isset($_POST['searchTrans']))
						{
							$query = "SELECT * FROM all_transactions WHERE tNo='".$transNo."' AND category= 'expense' AND description='".$description."'";
							if($query_run = mysql_query($query))
							{
								echo mysql_result($query_run, 0, 'amount');
							}
						}
						else
							echo 0;
						?>">
                     </div>
					 <input hidden type="text" name="tNo" value="<?php 
					 if(isset($_POST['searchTrans']))
						echo $transNo; ?>" />
					 <button type="submit" name="edit" class="btn btn-primary btn-lg fa fa-edit" style="margin-top: 15px;"><a href="" style="color:white">&nbsp;Edit</a></button>
					 </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
	   <script>
		$(function() {
		$( "#datepicker1" ).datepicker();
		$( "#datepicker2" ).datepicker();
		});
		</script>
     <?php
		include('admin_footer.php')
	  ?>
    </body>
</html>