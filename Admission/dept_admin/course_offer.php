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
$querry1="select distinct syllebus_name,syllebus_dept,batch from tbl_syllebus_info where syllebus_dept='$dept'";
$resullt1=mysql_query($querry1);
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
									<h2 style="color:steelblue;">Course Offer</h2>
									<a href="delete_cours_offer.php"><button class="btn btn-sm btn-primary"style="margin-left:263px;"type="button">Start New Semester</button></a>
								</div>
								<div class="panel-body">
									<input style="display:none"id="dept_id"type="text" value="<?php echo $dept?>"/>
									<div class="form_group">
										<select id="std_syllebus" name="txt_syllebus" class="form-control">
											<option selected="selected" value="">Select Syllebus</option>
												<?php
										while($row1=mysql_fetch_array($resullt1))
										{
											$syllebus_auto_id=$row1['syllebus_auto_id'];
											$syllebus_name=$row1['syllebus_name'];
                                            $batch=$row1['batch'];
										?>
											<option value="<?php echo $syllebus_name;?>"><?php echo $syllebus_name; ?></option>
								<?php
										}
								?>
											</select>
										</div>
									<br>
									<div class="form_group">
										<select id="std_seme" name="txt_std_dept" class="form-control">
										<option selected="selected" value="">Select Semister</option>
										</select>
									</div>
									</br>
									<div class="form_group">
										<select id="std_section" name="txt_std_section" class="form-control">
										<option selected="selected" value="">Select section</option>
										<option value="">None</option>
										<option value="A">A</option>
										<option value="B">B</option>
										<option value="C">C</option>
										<option value="D">D</option>
										<option value="E">E</option>
										<option value="F">F</option>
										<option value="G">G</option>
										<option value="H">H</option>
										<option value="I">I</option>
										<option value="J">J</option>
										<option value="J">K</option>
										<option value="J">L</option>
										</select>
									</div>
									</br>
									<div class="form_group">
										<select id="std_session" name="txt_std_dept" class="form-control">
										<option selected="selected" value="">Select Session</option>
										<option value="Spring">Spring</option>
										<option value="Summer">Summer</option>
										<option value="Fall">Fall</option>
										</select>
									</div>
									</br>
									<div class="form_group">
										<select id="std_year" name="txt_std_dept" class="form-control">
										<option selected="selected" value="">Select Year</option>
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										</select>
									</div>
									</br>
								</div>
								</br>
								</br>
								<div class="panel-heading">
									<h2 style="color:steelblue;">Select Courses</h2>
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
											<option selected="selected" value="">Select Course_title</option>
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
								</br/>
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
    
	var show_courses = 'std_seme';
	var select_id = 'std_syllebus';
	$('#'+select_id).change(function(e) 
	{
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({
		     url: 'ajax_change_semester.php?abds='+selectvalue,
             success: function(output) {
                $('#'+show_courses).html(output);
                for_change();
                
            },
            
           
 
            
            
            });
		
	});
   
});

</script>
<script>

function for_change(){
    $('#std_seme').bind('click change', function(){
    var myVal=$('#std_syllebus').val();
	var show_courses = 'std_courses';
		 var selectvalue = $(this).val();
		 $('#'+show_courses).html('Loading...');
		 $.ajax({url: 'ajax_change_couses.php?abds='+selectvalue+'&syl_name='+myVal,
             success: function(output) {
                //alert(output);
                $('#'+show_courses).html(output);
            }});
		

 });
   
}

</script>
<script>
	//$(document).ready(function(){
    
	//var show_courses = 'std_course_code';
	//var show_courses1 = 'std_course_credit';
	//var select_id = 'std_courses';
	//$('#'+select_id).change(function(e) 
	//{
	//	 var selectvalue = $(this).val();
	//	 $('#'+show_courses).html('Loading...');
	//	 $.ajax({url: 'ajax_change_code_credit.php?abds='+selectvalue,
      //       success: function(output) {
                //alert(output);
		//		alert($('#'+show_courses).html(output[0].course_code));
		//		$('#'+show_courses1).html(output[0].course_credit);
         //   }});
		
	//});
   
//});

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
<!--For Saving and Showing-->
<script>
	
$(document).ready(function(){
    $('#forsave').click(function(){
	
        
	var syllebus_name=$('#std_syllebus').val();
	var syllebus_dept=$('#dept_id').val();
    var semester=$('#std_seme').val();
    var session=$('#std_session').val();
    var year=$('#std_year').val();
    var course=$('#std_courses').val();
    var section=$('#std_section').val();
	var teacher=$('#std_course_teacher').val();

	
   if(semester!="" && session!="" && year!="" && course!="" && teacher!="")
  

   $.ajax({
    type: "POST",
    data: {'offer_semester':semester,'session':session,'year':year,'course_auto_id':course,'offer_dept':syllebus_dept,'section':section,'offer_teacher_id':teacher},
    url: "saving_course_offer.php",
    success: function(result){
     autoUpdateReselt();
	//alert("syllebus dept:"+syllebus_dept);
	//alert("semester"+semester);
	//alert("session"+session);
	//alert("year"+year);
	///alert("courses"+course);
	//alert("section"+section);
        }
     });
  });
   
});
function autoUpdateReselt(){
    var section=$('#std_section').val();
    var semester=$('#std_seme').val();
  $.ajax({
    type: "POST",
    data: {'offer_semester':semester,'section':section},
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
