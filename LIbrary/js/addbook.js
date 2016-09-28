$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#showbook-submit').button();
});

$('#showbook-form').submit(function(e){
	e.preventDefault();

	$('#showbook-submit').button('loading');

	$('.showbook').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.showbook').html(d).delay(100).slideDown();
		$('#showbook-submit').button('reset');
	});
});


/*
$('#showbook-submit').button();
$('#showbook-submit').click(function(){
	$(this).button('loading');
});
*/