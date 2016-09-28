<?php include("header.php");
require "db_connection.php";
require "init.php";
loggedin();

$id=$_SESSION['user_id'];

$queryy="select * from tbl_dept_admin where dadmin_auto_id='$id'";
$resultt=mysql_query($queryy);
while($row  = mysql_fetch_array($resultt))
{	
		$dept   =$row['dadmin_dept'];
}


$query5="select * from tbl_course_info where course_dept='$dept'";
$result5=mysql_query($query5);

$query3="select distinct std_batch,std_active,std_dept from tbl_student_info where std_active=1 and std_dept='$dept'";
$result3=mysql_query($query3);

$query4="select * from tbl_department_info where dept_id='$dept'";
$result4=mysql_query($query4);

?>
	<div class="profile_area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="student_menu">
								<ul>
									<li><a class="menu_top" href="syllebus.php">Syllebus</a></li>
									<li><a class="menu_top" href="course_offer.php">Course Offer</a></li>
									<li><a class="menu_top" href="subject.php">Statistics</a></li>
									<li><a class="menu_top" href="change_pass.php">Change Password</a></li>
									<li><a class="menu_top" href="new_admin.php">Make New Admin</a></li>
									<li><a href="logout.php">Logout</a></li>		
								</ul>
						    </div>
					     </div>					
				    </div>
			    </div>
		    </div><!--End Of Profile Area-->
	<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area1">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Create Syllabus</h2>
								</div>
								
								<div class="panel-body">
									<br>
									<div class="form_group">
										<input id="syllebus_nam" class="form-control" type="text" placeholder="Enter Name Of the syllabus"/>
									</div>
									<input style="display:none"id="dept_id"type="text" value="<?php echo $dept?>"/>
									<br/>
									<div class="form_group">
										<select id="std_batch" class="form-control">
										<option selected="selected" value="">Select Batch</option>
										<?php
												while($row3 = mysql_fetch_array($result3))
												{																	
		
														$std_batch=$row3['std_batch'];
														
										

										?>
				
											<option value="<?php echo $std_batch ?>"><?php echo $std_batch ?></option>
											
								
										<?php
										
												}
										?>
										</select>
									</div>
									</br>
									<div class="form_group">
										<select id="std_program"  class="form-control">
										<option selected="selected" value="">Select Program</option>
										<?php
												while($row4 = mysql_fetch_array($result4))
												{																	
		
													
														$dept_program_name=$row4['dept_program_name'];
										

										?>
				
											<option value="<?php echo $dept_program_name; ?>"><?php echo $dept_program_name; ?></option>
											
								
										<?php
										
												}
										?>
										</select>
									</div>
									<br/>
									<div class="form_group">
										<select id="std_semisterr"  class="form-control">
											<option selected="selected" value="">Select Semester</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10">10</option>
											<option value="11">11</option>
											<option value="12">12</option>
										</select>
									</div>
								<br/>
									<div class="form_group">
										<select id="std_co"  class="form-control">
											<option selected="selected" value="">Select Course Title</option>
								<?php
											while($row5=mysql_fetch_array($result5))
											{	
												$course_title=$row5['course_name'];
												$course_code=$row5['course_code'];
												$course_credit=$row5['course_credit'];
												$course_auto_id=$row5['course_auto_id'];
								?>
												<option value="<?php echo $course_auto_id;?>"><?php echo $course_title ;?></option>
								<?php
											}
								?>
											</select>
									</div>
									</br>
								</div>
								</br>
								</br>
								<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Course Code</th>
											<th style="color:steelblue">Course Title</th>
											<th style="color:steelblue">Credit</th>								
										</tr>
										</thead>
										<tbody id="showh2">																			
										</tbody>					
								</table>
								</div>	
								<br/>
								<hr/>
								<div class="form_group">
									<input type="button" id="for" value="Save" class="btn btn-info change_submit"/>
								</div>
								<div id="forDi" class="panel-body">
								
                                
                                
								</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 

<?php include("footer.php");?>

<script>
		function confirm_delete() {
			return confirm('are you sure want to delete this data?');
		}
</script>

<script>
	$(document).ready(function(){
    
	var show_courses = 'showh2';

	var select_id = 'std_co';
	$('#'+select_id).change(function(e) 
	{
		 var selectvalue = $(this).val();
		 //$('#'+show_courses).html('Loading...');
		 $.ajax({url: 'ajax_with_syllebus.php?abds='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#'+show_courses).html(output);
                
            }});
		
	});
   
});

</script>

<script>
$(document).ready(function(){
    $('#for').click(function(){
	
        
	var syllebus_name=$('#syllebus_nam').val();
    var syllebus_dept=$('#dept_id').val();
    var std_batch=$('#std_batch').val();
    var program_name=$('#std_program').val();
    var semester=$('#std_semisterr').val();
    var course=$('#std_co').val();
	
   if(syllebus_name!="" && std_batch!="" && program_name!="" && semester!="" && course!="")
  

   $.ajax({
    type: "POST",
    data: {'syllebus_name':syllebus_name,'syllebus_dept':syllebus_dept,'program_name':program_name,'batch':std_batch,'course_auto_id':course,'semester':semester},
    url: "saving_syllebus.php",
    success: function(result){
        $("#forDi").html('<p style="color:green;text-align:center">Successfully Saved.</p>');
        
        setInterval(function(){ $("#forDi *").fadeOut(); }, 3000);
        
      //autoUpdateReselt();
	// alert(syllebus_name);
        }
     });
  });
   
});
//For Showing Saved values
function autoUpdateReselt(){
  $.ajax({
    type: "POST",
    url: "view_saved_course.php",
    success: function(result){
        alert(result);
        
        }
    });
}
</script>
