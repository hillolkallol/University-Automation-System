<?php
require "db_connection.php";
require "init.php";
$values="";
$values=$_GET['abds'];
loggedin();
 $id=$_SESSION['user_id'];

$query2 = "Select * From tbl_student_info Where std_id='$id'";
$result2= mysql_query($query2);
while($row2 = mysql_fetch_array($result2))
{	
		$std_dept=$row2['std_dept'];
		$name=$row2['std_name'];
        $std_id=$row2['std_id'];
}


$query="select distinct * from  tbl_course_offer t1  join tbl_course_info t2 on t1.course_auto_id=t2.course_auto_id where offer_semester='$values' and offer_dept='$std_dept'and(section='A' OR section ='')";
$result=mysql_query($query);
$course_credt_total=0;

										

	?> 										
					 										



									<div class="panel-heading">
									<h2 style="color:steelblue;">Main Course</h2>
									</div>
									<table class="table table-hover">
										<thead>
											<tr>
												<th style="color:steelblue">Course Code</th>
												<th style="color:steelblue">Course Title</th>
												<th style="color:steelblue">Credit</th>
											</tr>
										</thead>
										<tbody>
                                        
                                        <?php
                                        
          while($row = mysql_fetch_array($result))
           {																	
                    	$session=$row['session'];
                    	$year=$row['year'];
                    	$course_auto_id=$row['course_auto_id'];
                    	$course_title=$row['course_name'];
                    	$course_code=$row['course_code'];
                    	
						$kallol="select course_prerequisite from tbl_course_info where course_auto_id='$course_auto_id'";
						$resultk=mysql_query($kallol);
						$rowk=mysql_fetch_array($resultk);
					   $preq=$rowk['course_prerequisite'];
						$kalloll="select * from student_result where course_id='$preq' and s_id='$id'";
						$resultkl=mysql_query($kalloll);
						$rowlk=mysql_fetch_array($resultkl);
						$grade=$rowlk['grade'];
						if($grade!='F')
						{
                       echo' <input type="text" style="color:#31B0D5; display: none;" class="session" name="session" value="'.$session.'">';
                       echo' <input type="text" style="color:#31B0D5; display: none;" class="year" name="year" value="'.$year.'">';
                        
                        $course_credit=$row['course_credit'];
                    	$course_credt_total+=$course_credit;
                        
                        echo '<tr>
   <td style="color:#31B0D5; display: none;"><input type="checkbox" class="checked_values" name="course_id[]" value="'.$course_auto_id.'" checked></td>
   <td style="color:#31B0D5">'.$course_code.'</td>
   <td style="color:#31B0D5">'.$course_title.'</td>
   <td style="color:#31B0D5">'.$course_credit.'</td> 
                        </tr>';
                        
                       }else{
                        //nothing
                       }
						
                        
              }
              
              
	
                                            ?>
                                        
                                        
                                        
                                        
                                        
											
										</tbody>
									</table>
										
										</br>
									<p style="color:dodgerblue;font-weight:lighter;text-align:left">Did You Drop Any Courses/Do You Want To Take Any Improvements?&nbsp;&nbsp;&nbsp;&nbsp;		
											<input type="radio" name="sex" value="male" id="show">Yes&nbsp;&nbsp;
											<input type="radio" name="sex" value="female" id="hide">No
									</p>
								<div class="show_table">
								<div class=" panel panel-default">
									<div class="panel-heading">
									<h2 style="color:steelblue;">Retake Course</h2>
									</div>
								
								<table class="table table-hover ">
									<thead>
										<tr>
											<th style="color:steelblue">Course Code</th>
											<th style="color:steelblue">Course Title</th>
											<th style="color:steelblue">Credit</th>
										</tr>
										<tbody>
									<?php
									$queryy="select * from tbl_course_offer t1 join student_result t2 join tbl_course_info t3 on t1.course_auto_id=t2.course_id and t1.course_auto_id=t3.course_auto_id where s_id='$std_id' and (grade='F' || total_marks<=60) and (section='A' OR section='')";
									$resulltr=mysql_query($queryy);
									$course_retake_credt_total=0;
										while($rowr=mysql_fetch_array($resulltr))
										{
											$course_title=$rowr['course_name'];
											$course_code=$rowr['course_code'];
											$course_credit1=$rowr['course_credit'];
											$course_auto_id=$rowr['course_auto_id'];
											
										?>
										<tr>
											<td><P style="color:#31B0D5;float:left;font-family:sans-serif"><?php echo $course_code; ?></p></td>
											<td><p style="float:left;color:#31B0D5"><?php echo $course_title; ?></p></td>
											<td><p style="float:left;color:#31B0D5"><?php echo $course_credit1; ?></p></td>
											<td><input style="float:right"type="checkbox" class="checked_values1" name="course_retake[]" value="<?php echo $course_auto_id ?>"/>
                                            <input type="hidden" class="abc" value="<?php echo $course_credit1 ?>" />
             
                                            </td>
										</tr>
										
										
								<?php
											$course_retake_credt_total=$course_retake_credt_total+$course_credit1;
										   
										}
									//	$total=$course_credt_total+$course_retake_credt_total;
								?>
										</tbody>
									</thead>
								</table>
								</div>
								</div>	
								
								<div class="panel-heading">
									<h2 style="color:steelblue;">Credit</h2>
								</div>
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="color:steelblue">Main Course Credit</th>
											<th style="color:steelblue">Retake Course Credit</th>
											<th style="color:steelblue">Total Credit Taken</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td id="main_credit"style="color:#31B0D5;text-align:center">
                                            
                                            <?php echo $course_credt_total; 
         echo '<input type="hidden" class="total_ceradit" value="'.$course_credt_total.'">'
                                            
                                            ?>
                                            
                                            </td>
                                            <input type="hidden" class="total_retike1" />
											<td class="total_retike" style="color:#31B0D5;text-align:center">0</td>
											<td class="main_totol" style="color:#31B0D5;text-align:center"></td>
										</tr>
									</tbody>
								</table>
								<div class="form_group">
								<input type="button" value="Submit" id="add_submit_change" name="add_std_submit" class="btn btn-info change_submit"/>
								</div>
								
								<p class="subtext">By clicking submit you agree to our <a href="term.html">Terms & Conditions</a></p>
							</div>






























