$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#edit-submit').button();
});

$('#edit-form').submit(function(e){
	e.preventDefault();

	$('#edit-submit').button('loading');

	$('.editshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.editshow').html(d).delay(100).slideDown();
		$('#edit-submit').button('reset');
	});
});


/*
$('#edit-submit').button();
$('#edit-submit').click(function(){
	$(this).button('loading');
});
*/