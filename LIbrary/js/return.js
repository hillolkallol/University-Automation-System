$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#return-submit').button();
});

$('#return-form').submit(function(e){
	e.preventDefault();

	$('#return-submit').button('loading');

	$('.borrowshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.borrowshow').html(d).delay(100).slideDown();
		$('#return-submit').button('reset');
	});
});


