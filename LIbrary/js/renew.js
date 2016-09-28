$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#renew-submit').button();
});

$('#renew-form').submit(function(e){
	e.preventDefault();

	$('#renew-submit').button('loading');

	$('.renew').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.renew').html(d).delay(100).slideDown();
		$('#renew-submit').button('reset');
	});
});


/*
$('#renew-submit').button();
$('#renew-submit').click(function(){
	$(this).button('loading');
});
*/