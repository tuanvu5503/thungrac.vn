$(document).ready(function() {
	$("#search_form").submit(function(event) {
		/* Act on the event */
		event.preventDefault();
		key = $("#search_val").val();
		if (key.trim() == '') {
			return false;
		}
		url = base_url+'tim-kiem/'+key;
		window.location.href = url;
	});
});


function load_shopping_cart () {
	$("div.shopping-cart").load(base_url+'index.php/site/cart/load_shopping_cart');
}

function refer_page(url) {
	window.location.href = url;
}
