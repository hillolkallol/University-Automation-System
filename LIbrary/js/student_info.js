$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#student_info-submit').button();
});

$('#student_info-form').submit(function(e){
	e.preventDefault();

	$('#student_info-submit').button('loading');

	$('.renew').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.renew').html(d).delay(100).slideDown();
		$('#student_info-submit').button('reset');
	});
});


