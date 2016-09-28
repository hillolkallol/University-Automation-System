$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#showebook-submit').button();
});

$('#showebook-form').submit(function(e){
	e.preventDefault();

	$('#showebook-submit').button('loading');

	$('.showebook').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.showebook').html(d).delay(100).slideDown();
		$('#showebook-submit').button('reset');
	});
});


