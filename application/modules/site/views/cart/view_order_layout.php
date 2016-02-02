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
              <button id="<?= 'tr_'.$items['id'] ?>" onclick="delete_modal('<?= $url_delete_cart ?>', <?= $items['id'] ?>,'del_product_in_cart_success')" type="button" class="remove-product">
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
$(document).ready(function() {
abc();
  
});
function abc () {
  console.log($('button#tr_1').text());
}
  function del_product_in_cart_success (del_id) {
    removeItem('button#tr_'+del_id);
  }
</script>