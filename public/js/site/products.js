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
	
	$('.like').click(function(event) {
		// alert("LIKE");
		return false;
	});

	//================= PRODUCT SLIDER BAR =================
	  $('.slider1').bxSlider({
	    slideWidth: 200,
	    minSlides: 1,
	    maxSlides: 10,
	    slideMargin: 25,
	    controls: false,
	    auto: true,
	    moveSlides: 2,
	    autoHover: true
	  });
	//================= PRODUCT SLIDER BAR =================

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