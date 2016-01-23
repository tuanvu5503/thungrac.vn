$(document).ready(function() {
	$( "input#input_search" ).focus(function() {
		$( "span.input-group-btn" ).addClass('isfocus');
		$( "button#search-btn" ).addClass('isfocus');
	});
	$( "input#input_search" ).blur(function() {
		$( "button#search-btn" ).removeClass('isfocus');
		$( "span.input-group-btn" ).removeClass('isfocus');
	});

	
});
