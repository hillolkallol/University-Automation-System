$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#msg-submit').button();
});

$('#msg-form').submit(function(e){
	e.preventDefault();

	$('#msg-submit').button('loading');

	$('.msg').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.msg').html(d).delay(100).slideDown();
		$('#msg-submit').button('reset');
	});
});

