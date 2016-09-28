$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#trans-submit').button();
});

$('#trans-form').submit(function(e){
	e.preventDefault();

	$('#trans-submit').button('loading');

	$('.transshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.transshow').html(d).delay(100).slideDown();
		$('#trans-submit').button('reset');
	});
});

