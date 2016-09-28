$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#borrow-submit').button();
});

$('#borrow-form').submit(function(e){
	e.preventDefault();

	$('#borrow-submit').button('loading');

	$('.borrowshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.borrowshow').html(d).delay(100).slideDown();
		$('#borrow-submit').button('reset');
	});
});

/*
$('#borrow-submit').button();
$('#borrow-submit').click(function(){
	$(this).button('loading');
});
*/