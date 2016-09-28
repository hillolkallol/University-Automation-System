$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#request-submit').button();
});

$('#request-form').submit(function(e){
	e.preventDefault();

	$('#request-submit').button('loading');

	$('.requestshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.requestshow').html(d).delay(100).slideDown();
		$('#request-submit').button('reset');
	});
});

