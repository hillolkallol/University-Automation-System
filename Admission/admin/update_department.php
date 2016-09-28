<?php include("header.php");

include "edit_department_php.php";

?>
<div class="admisssion_area">
			<div class="container">
				<div class="row">					
					<div class="col-md-12">
						<div class="main_area">
							<div class="panel panel-default new_panel">
								<div class="panel-heading">
									<h2 style="color:steelblue;">Department Information</h2>
								</div>
								<div class="panel-body">
									<form action="" method="POST" id="admission_form" name="admission" enctype="multipart/form-data">	
										<div class="form_group">
											<label for="student_name" class="label_admit">Name of the Faculty</label>
											<input id="disabledInput" name="txt_std_name" class="form-control edit_form"type="text" placeholder="Computer Science & Engineering"  value="<?php echo $dept_name; ?>"disabled/>
											<div class="error" id="first_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_id" class="label_admit">Faculty ID</label>
											<input id="disabledInput" name="txt_std_id" class="form-control edit_form"type="text" placeholder="01"  value="<?php echo $dept_id; ?>"disabled/>
											<div class="error" id="second_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
											<label for="student_id" class="label_admit">Short Name</label>
											<input id="disabledInput" name="txt_std_short" class="form-control edit_form"type="text" placeholder="CSE"  value="<?php echo $dept_short_name; ?>"disabled/>
											<div class="error" id="third_error">Student ID be filled out!</div>
										</div>
										<div class="form_group">
										<?php
												while($row1=mysql_fetch_array($result2))
												{	
													
													$dept_program_name=$row1['dept_program_name'];
												?>
											<label for="student_id" class="label_admit">Program Name</label>
											<input id="disabledInput" name="txt_std_prg" class="form-control edit_form"type="text"  value="<?php echo $dept_program_name; ?>"disabled/>
											<div class="error" id="third_error">Student ID be filled out!</div>
										
									
										<?php
												}
										?>
										</div>
										<!--<div class="form_group">
											<input type="submit" value="Update" id="add_submit" name="add_std_submit" class="btn btn-info change_submit"/>
										</div>
										-->
										<div id="warning">Oops, ya missed something, try again.</div>
									</form>
								</div>
							</div>
					</div>
				</div>
			</div>
		</div> 
</div>
		
<?php include("footer.php")?> 
