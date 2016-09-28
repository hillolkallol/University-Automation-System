<?php include("header.php")?>
		
	<div class="leading_area">	
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="map">
						<iframe  height="350" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msa=0&amp;msid=205845320487512496573.0004e7ea7fe6440c9fad6&amp;hl=en&amp;ie=UTF8&amp;ll=24.906117,91.863553&amp;spn=0,0&amp;t=m&amp;output=embed"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--End of Leading map area-->
<div class="contact_area">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="contact contact_details">
					<h4>Get in touch with us now!</h4>
					<form method="POST" action="#">
						<div class="row">
							<div class="col-md-4">
								<label><i class="fa fa-user booking_font"></i>&nbsp;Name<span class="req">*</span></label>
								<input type="text" class="form-control" name="name" id="name">
							</div>
							<div class="col-md-4">
								<label><i class="fa fa-envelope booking_font"></i>&nbsp;Email <span class="req">*</span></label>
								<input type="text" class="form-control" name="email" id="email">
							</div>
							<div class="col-md-4">
								<label><i class="fa fa-globe booking_font"></i>&nbsp;Website <span class="req">*</span></label>
								<input type="text" class="form-control" name="website" id="website">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label style="margin-top: 18px;"><i class="fa fa-building-o booking_font"></i>&nbsp;Subject <span class="req">*</span></label>
								<input type="text" style="margin-bottom: 20px;" id="subject" name="subject" class="form-control">        
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label><i class="fa fa-file-text booking_font"></i>&nbsp;Message <span class="req">*</span></label>
								<textarea cols="10" rows="10" name="message" id="message" class="form-control"></textarea>
								<p id="btnsubmit"><input type="submit" id="send" value="Send" class="btn btn-primary btn-large"></p>               
							</div>
						</div>
					</form>
				</div>
            </div>					
			<div class="col-md-4">
				<div class="contact_details">
					<div class="single_contact">
                        <h4>Rongmohol Tower:</h4>
                           <p>
							<i class="fa fa-map-marker only"></i>Address: Rongmohol Tower,Sylhet,Bangladesh<br>
                            <i class="fa fa-phone only"></i>Phone: +62 1234 5678 90<br>
                            <i class="fa fa-envelope-o only"></i> Fax: +62 1234 5678 92<br>
                            <i class="fa fa-envelope only"></i>Email: <a href="mailto:contact@casanova.co.id">contact@casanova.co.id</a>
							</p>
					</div>
					<div class="single_contact">
                        <h4>Shurma Tower:</h4>
                           <p>
							<i class="fa fa-map-marker only"></i>Address: Surma Tower,Sylhet,Bangladesh<br>
                            <i class="fa fa-phone only"></i>Phone: +62 1234 5678 90<br>
                            <i class="fa fa-envelope-o only"></i> Fax: +62 1234 5678 92<br>
                            <i class="fa fa-envelope only"></i>Email: <a href="mailto:contact@casanova.co.id">contact@casanova.co.id</a>
							</p>
					</div>
					<div class="contact_social">
							<a class="icon primary square" href="#"><i class="fa fa-facebook only"></i></a>
							<a class="icon blue square" href="#"><i class="fa fa-twitter only"></i></a>
							<a class="icon red square" href="#"><i class="fa fa-google-plus only"></i></a>
					</div>
                </div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php")?>
