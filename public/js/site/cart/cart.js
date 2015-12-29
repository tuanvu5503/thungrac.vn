$(document).ready(function() {
	base_url = $('#base_url').val();

	$(".shopping-cart").sticky({topSpacing:51});

	$("#cart").on("click", function() {
	    $(".shopping-cart").fadeToggle( "fast");
	});

	$('.addcart').click(function(event) {
		event.preventDefault();

		id = $(this).attr('id');
		// alert(id);

		$.ajax({
			url: base_url+'index.php/site/cart/add_cart',
			type: 'POST',
			dataType: 'json',
	        data: {id: id},
	        success: function(msg){
				if (msg.status) {
					location.reload();
				}
	        }
	    });
		
	});

});