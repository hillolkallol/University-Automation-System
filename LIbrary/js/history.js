$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#history-submit').button();
});

$('#history-form').submit(function(e){
	e.preventDefault();

	$('#history-submit').button('loading');

	$('.historyshow').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.historyshow').html(d).delay(100).slideDown();
		$('#history-submit').button('reset');
	});
});


/*
$('#history-submit').button();
$('#history-submit').click(function(){
	$(this).button('loading');
});
*/