  <link href="<?php echo base_url().'public/css/site/cart/normalize.css' ?>" rel="stylesheet">
  <link href="<?php echo base_url().'public/css/site/cart/style.css' ?>" rel="stylesheet">
  <style type="text/css">
    .customer_form_error{
      border: 1px red solid;
    }
  </style>
  <?php 
      $url_delete_cart = base_url().'index.php/site/cart/delete_product_in_cart';
  ?>

  <h1>Đơn đặt hàng</h1>

  <div class="shopping-cart2">

    <div class="column-labels">
      <label class="product-image">Hình ảnh</label>
      <label class="product-details">Sản phẩm</label>
      <label class="product-price">Giá</label>
      <label class="product-quantity">Số lượng</label>
      <label class="product-removal">Thao tác</label>
      <label class="product-line-price">Thành tiền</label>
    </div>

    <form id="order_form" action="<?php echo base_url().'index.php/site/cart/do_order'; ?>" method="POST" role="form">
        <div class="customer"></div> <!-- contain customer's infomation -->
        <?php 
        $total = 0;
        foreach ($info_of_order_product_array as $items) {
          $total += $items['price_x_order_qty'];
          ?>
          <div class="product">
            <input type="hidden" value="<?=$items['id']?>" name="product_id[]">
            <div class="product-image">
            <img src="<?php echo base_url().'public/img/products/'.$items['image']; ?>">
            </div>
            <div class="product-details">
              <div class="product-title"><?php echo $items['product_name']; ?></div>
              <p class="product-description"><?php echo $items['des']; ?></p>
            </div>
            <div class="product-price"><?php echo number_format($items['price']); ?></div>
            <div class="product-quantity">
              <input name="order_qty[]" type="number" value="<?php echo $items['order_qty']; ?>" min="1">
            </div>
            <div class="product-removal">
              <button id="<?= $items['id'] ?>" onclick="delete_modal('<?= $url_delete_cart ?>', <?= $items['id'] ?>,'del_product_in_cart_success')" type="button" class="remove-product">
                Xóa
              </button>
            </div>
            <div class="product-line-price"><?php echo number_format($items['price_x_order_qty']); ?></div>
          </div>

          <?php
        }
        ?>
      <div class="totals">
        <div class="totals-item totals-item-total">
          <label>Tổng cộng</label>
          <div class="totals-value" id="cart-total"><?php echo number_format($total); ?></div>
        </div>
          
        <div style="width:100%; text-align:right; color: rgb(164, 158, 158);">
          <span>Chú ý: Giá trên có thể chưa chính xác. Chúng tôi sẽ gọi lại cho quý khách sau khi nhận được đơn hàng.</span>
        </div>
      </div>

      <button id="do_order" type="button" onclick="show_customer_form('tuan vu','01676869501')" name="do_order_btn" class="checkout">Tiếp theo</button>
    </form>

  </div>

<script src="<?php echo base_url().'public/js/site/cart/index.js'?>"></script>

<script type="text/javascript">

// function show_customer_form (customer_name, phone,customer_name_class, phone_class) {
//     if (typeof customer_name === 'undefined') {
//       customer_name = '';
//     }

//     if (typeof phone === 'undefined') {
//       phone = '';
//     }

//     if (typeof customer_name_class === 'undefined') {
//       customer_name_class = '';
//     }

//     if (typeof phone_class === 'undefined') {
//       phone_class = '';
//     }

//     bootbox.dialog({
//       title: "Thông tin khách hàng",
//       message: '<div class="row">  ' +
//           '<div class="col-md-12"> ' +
//           '<form class="form-horizontal"> ' +
//           '<div class="form-group"> ' +
//           '<label class="col-md-4 control-label" for="customer_name">Họ tên</label> ' +
//           '<div class="col-md-6"> ' +
//           '<input id="customer_name" value="'+customer_name+'" name="customer_name" type="text" placeholder="Nhập họ tên quý khách" class="form-control input-md '+customer_name_class+'"> ' +
//           '</div> ' +
//           '</div> ' +
//           '<div class="form-group"> ' +
//           '<label class="col-md-4 control-label" for="phone">Số điện thoại</label> ' +
//           '<div class="col-md-6"> ' +
//           '<input id="phone" name="phone" value="'+phone+'" type="text" placeholder="Nhập số điện thoại quý khách" class="form-control input-md '+phone_class+'"> ' +
//           '</div> ' +
//           '</div> ' +
          
//           '</form> </div>  </div>',
//       buttons: {
//         success: {
//           label: "Hoàn thành",
//           className: "btn-success",
//           callback: function () {
//             var customer_name = $('#customer_name').val().trim();
//             var phone = $('#phone').val();

//             //============= validation: start ===========
//             var error_phone = false;
//             var error_name= false;
//             var pattern = new RegExp(/^[0-9]{9,11}$/);
            
//             if (!pattern.test(phone)) {
//               error_phone = true;
//             }

//             if (customer_name.length < 1) {
//               error_name = true;
//             }
//             //============= validation: end =============
            
//             if (error_name && error_phone) {
//                 show_customer_form(customer_name,phone,'customer_form_error', 'customer_form_error');
//             } else if (error_name) {
//                 show_customer_form(customer_name,phone,'customer_form_error', '');
//             } else if (error_phone) {
//                 show_customer_form(customer_name,phone,'', 'customer_form_error');
//             } else {
//                 $('div.customer').append('<input type="hidden" value="'+customer_name+'" name="customer_name">');
//                 $('div.customer').append('<input type="hidden" value="'+phone+'" name="phone">');

//                 $('#order_form').submit();
//             }

//           }
//         }
//       }
//     })
// }
// </script>


<script type="text/javascript">
  function del_product_in_cart_success (del_id) {
    removeItem($('button#'+del_id));
  }
</script>