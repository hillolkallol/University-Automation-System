$(window).load(function(){
	var h = Math.max($(window).height, $('body > container').height() );

	$('.outer, .vertical-align').css('height', h);
	$('#search-submit').button();
});

$('#search-form').submit(function(e){
	e.preventDefault();

	$('#search-submit').button('loading');

	$('.search').slideUp();

	var form = $(this);

	$.ajax({
		url: 	form.attr( 'action' ),
		method: form.attr( 'method' ),
		data: 	form.serialize(),
		dataType: 'html'
	}).done(function(d){
		$('.search').html(d).delay(100).slideDown();
		$('#search-submit').button('reset');
	});
});


