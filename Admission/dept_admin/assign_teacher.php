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
//$query2="select distinct offer_semester,offer_dept from tbl_course_offer where offer_dept='$dept'";
//$result2=mysql_query($query2);
$query = "select tch_name,tch_id from tbl_teacher_info";
$result=mysql_query($query);



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
									<h2 style="color:steelblue;">Assign Course Teacher</h2>
								</div>
								<div class="panel-body">
						
									<br>
									<div class="form_group">
										<select id="std_seme" name="txt_std_dept" class="form-control">
										<option selected="selected" value="">Select Semister</option>
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
									
									</br>
									<div class="form_group">
										<select id="std_section" name="txt_std_section" class="form-control">
										<option selected="selected" value="">Select section</option>
										</select>
									</div>
								</div>
							
								</br>
								<div class="panel-heading">
									<h2 style="color:steelblue;">Select Teacher</h2>
								</div>
								<div class="panel-body">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Course Teacher</th>
											<th style="color:steelblue">Course Title</th>
											<th style="color:steelblue">Code</th>
											<th style="color:steelblue">Credit</th>
											<th style="color:steelblue">Operation</th>								
										</tr>
									</thead>
										<tbody>
												<td><select id="std_course_teacher" name="txt_std_course" class="form-control">
											<option selected="selected" value="">Select Teacher</option>
								<?php
											while($row=mysql_fetch_array($result))
											{	
												$tch_name = $row['tch_name'];
												$tch_id = $row['tch_id'];
								?>
												<option value="<?php echo $tch_id;?>"><?php echo$tch_name ;?></option>
								<?php
											}
								?>
											</select></td>
											<td><select id="std_courses" name="txt_std_course14" class="form-control">
											<option selected="selected" value="">Select Course Title</option>
											</select>		
											</td>
											<td id="std_course_code" style="color:#31B0D5;text-align:center"></td>
											<td id="std_course_credit" style="color:#31B0D5;text-align:center"></td>
											<td><input type="button" id="forsave" value="Save" class="btn btn-sm btn-info"/></td>
										</tbody>
									
								</table>
								</div>
								<div class="panel-body">
								<table class="table table-hover table-bordered">
									<thead>
										<tr>
											<th style="color:steelblue ;text-align:center">Course Teacher</th>
											<th style="color:steelblue ;text-align:center">Course Title</th>
											<th style="color:steelblue ;text-align:center">Code</th>
											<th style="color:steelblue ;text-align:center">Credit</th>
											<th style="color:steelblue ;text-align:center">Operation</th>		
										</tr>
										<tbody id="forDiscrip">
		
										</tbody>
									</thead>
								</table>
								</div>
								<br/>
								<div class="panel-heading">
									<h2><a href="view_courses.php">View Offered Courses</a></h2>
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
    
	var show_courses = 'std_section';
	var select_id = 'std_seme';
	$('#'+select_id).change(function(e) 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({url: 'ajax_change_section.php?abds='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#'+show_courses).html(output);
            }});
		
	});
   
});

</script>
<script>
	$(document).ready(function(){
    
	var show_courses = 'std_courses';
	var select_id = 'std_seme';
	$('#'+select_id).change(function(e) 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({
		 url: 'ajax_change_offer_couses.php?abds='+selectvalue,
             success: function(output) {
                //alert(output);
                $('#'+show_courses).html(output);
            }});
		
	});
   
});

</script>
<script>
$(document).ready(function(){
    
$('#std_courses').change(function(){
    var myvals=$('#std_courses').val();
    valueChange(myvals);
});
   
});


function valueChange(myVal){
  $.ajax({
    type: "POST",
    dataType: "json",
    data: {'abds':myVal},
    url: "ppp2.php",
    success: function(result){
		$('#std_course_code').html(result[0].course_code);
        $('#std_course_credit').html(result[0].course_credit);
    }
    });
}
</script>
<script>
$(document).ready(function(){
    $('#forsave').click(function(){
	
        
	var teacher=$('#std_course_teacher').val();
	var section=$('#std_section').val();
	var semester=$('#std_seme').val();
	var course=$('#std_courses').val();
	var offer_auto_id=$('#offer_auto_id').val();
    

	
   if(teacher!="")
  

   $.ajax({
    type: "POST",
    data: {'offer_teacher_id':teacher,'section':section,'offer_auto_id':offer_auto_id,'offer_semester':semester,'course_auto_id':course},
    url: "update_course_offer.php",
    success: function(result){
     autoUpdateReselt();
	
	//alert("section"+section);
	//alert("teacher"+teacher);
	//alert("offer_auto_id"+offer_auto_id);
	//alert("semester"+semester);
	//alert("course"+course);
        }
     });
  });
   
});
function autoUpdateReselt(){
    var section=$('#std_section').val();
    var semester=$('#std_seme').val();
    var auto_id=$('#offer_auto_id').val();
  $.ajax({
    type: "POST",
    data: {'offer_semester':semester,'section':section,'offer_auto_id':auto_id},
    url: "ppp6.php",
    success: function(result){
        $("#forDiscrip").html(result);
        }
    });
}
//For Showing Saved values
//function autoUpdateReselt(){
  //$.ajax({
   // type: "POST",
   // url: "http://localhost/lu2/dept_admin/view_saved_course.php",
   // success: function(result){
      //  $("#forDi").html(result);
      //  }
    //});
//}
</script>
