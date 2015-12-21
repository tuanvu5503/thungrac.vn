$(document).ready(function() {
	$(".shopping-cart").sticky({topSpacing:100});


	$("#cart").on("click", function() {
	    $(".shopping-cart").fadeToggle( "fast");
	});
});