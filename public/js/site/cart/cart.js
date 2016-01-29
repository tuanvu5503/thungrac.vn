$(document).ready(function() {
	base_url = $('#base_url').val();

	$(".shopping-cart").sticky({topSpacing:51});

	$("#cart").on("click", function() {
	    $(".shopping-cart").fadeToggle( "fast");
	});

	$('.addcart, .addcart2').click(function(event) {
		event.preventDefault();

		id = $(this).attr('id');

		$.ajax({
			url: base_url+'index.php/site/cart/add_cart',
			type: 'POST',
			dataType: 'json',
	        data: {id: id},
	        success: function(rs){
				if (rs.status) {
					// location.reload();
          load_shopping_cart();
          $("span.cart_total_items").html(rs.qty);
				}
	        }
	    });
		
	});

});

function show_customer_form (customer_name, phone,customer_name_class, phone_class) {
    if (typeof customer_name === 'undefined') {
      customer_name = '';
    }

    if (typeof phone === 'undefined') {
      phone = '';
    }

    if (typeof customer_name_class === 'undefined') {
      customer_name_class = '';
    }

    if (typeof phone_class === 'undefined') {
      phone_class = '';
    }

    bootbox.dialog({
      title: "Thông tin khách hàng",
      message: '<div class="row">  ' +
          '<div class="col-md-12"> ' +
          '<form class="form-horizontal"> ' +
          '<div class="form-group"> ' +
          '<label class="col-md-4 control-label" for="customer_name">Họ tên</label> ' +
          '<div class="col-md-6"> ' +
          '<input id="customer_name" value="'+customer_name+'" name="customer_name" type="text" placeholder="Nhập họ tên quý khách" class="form-control input-md '+customer_name_class+'"> ' +
          '</div> ' +
          '</div> ' +
          '<div class="form-group"> ' +
          '<label class="col-md-4 control-label" for="phone">Số điện thoại</label> ' +
          '<div class="col-md-6"> ' +
          '<input id="phone" name="phone" value="'+phone+'" type="text" placeholder="Nhập số điện thoại quý khách" class="form-control input-md '+phone_class+'"> ' +
          '</div> ' +
          '</div> ' +
          
          '</form> </div>  </div>',
      buttons: {
        success: {
          label: "Hoàn thành",
          className: "btn-success",
          callback: function () {
            var customer_name = $('#customer_name').val().trim();
            var phone = $('#phone').val();

            //============= validation: start ===========
            var error_phone = false;
            var error_name= false;
            var pattern = new RegExp(/^[0-9]{9,11}$/);
            
            if (!pattern.test(phone)) {
              error_phone = true;
            }

            if (customer_name.length < 1) {
              error_name = true;
            }
            //============= validation: end =============
            
            if (error_name && error_phone) {
                show_customer_form(customer_name,phone,'customer_form_error', 'customer_form_error');
            } else if (error_name) {
                show_customer_form(customer_name,phone,'customer_form_error', '');
            } else if (error_phone) {
                show_customer_form(customer_name,phone,'', 'customer_form_error');
            } else {
                $('div.customer').append('<input type="hidden" value="'+customer_name+'" name="customer_name">');
                $('div.customer').append('<input type="hidden" value="'+phone+'" name="phone">');

                $('#order_form').submit();
            }

          }
        }
      }
    })
}