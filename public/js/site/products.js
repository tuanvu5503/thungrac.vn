$(document).ready(function() {
	//Items effect
	jQuery(".addcart").hide();
	jQuery(".like").hide();
	jQuery('div.items').hover(function() {
		jQuery(this).find('.addcart').fadeIn(0);
		jQuery(this).find('.like').fadeIn(0);
	}, function() {
		jQuery(this).find('.addcart').fadeOut(0); 
		jQuery(this).find('.like').fadeOut(0); 
	});
	$('.addcart').click(function(event) {
		alert("ADD CART");
		return false;
	});
	$('.like').click(function(event) {
		alert("LIKE");
		return false;
	});

	//Show Thumb in View detail
	$("span.sm_img").click(function(event) {
		var i=$(this).attr('id');
		$("div.thumb").addClass('thumb-unactive');
		$("div#thumb-"+i).removeClass('thumb-unactive');
		$("div#thumb-"+i).addClass('thumb-active');
		// $("div#thumb-3").attr('display', 'block');
	});

scrolltop(); //Scroll to Top
});
function scrolltop()
{
    var id_button = '#top_icon';
 
    // Kéo xuống khoảng cách 220px thì xuất hiện button
    var offset = 220;
 
    var duration = 500;
 	jQuery(id_button).fadeOut(0);
    // Thêm vào sự kiện scroll của window, nghĩa là lúc trượt sẽ
    // kiểm tra sự ẩn hiện của button
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery(id_button).fadeIn(duration);
        } else {
            jQuery(id_button).fadeOut(duration);
        }
    });
 
    // Thêm sự kiện click vào button để khi click là trượt lên top
    jQuery(id_button).click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    });
}