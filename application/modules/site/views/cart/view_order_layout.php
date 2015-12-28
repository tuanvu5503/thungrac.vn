<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">  <!-- Slider -->
	<link href="<?php echo base_url().'public/css/site/cart/normalize.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/cart/style.css' ?>" rel="stylesheet">
	

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

    <form action="" method="POST" role="form">
        <?php 
        $total = 0;
        foreach ($info_of_order_product_array as $items) {
          $total += $items['price_x_order_qty'];
          ?>
          <div class="product">
            <div class="product-image">
            <img src="<?php echo base_url().'public/img/products/'.$items['image']; ?>">
            </div>
            <div class="product-details">
              <div class="product-title"><?php echo $items['product_name']; ?></div>
              <p class="product-description"><?php echo $items['des']; ?></p>
            </div>
            <div class="product-price"><?php echo number_format($items['price']); ?></div>
            <div class="product-quantity">
              <input type="number" value="<?php echo $items['order_qty']; ?>" min="1">
            </div>
            <div class="product-removal">
              <button type="button" class="remove-product">
                Xóa
              </button>
            </div>
            <div class="product-line-price"><?php echo number_format($items['price_x_order_qty']); ?></div>
          </div>

          <?php
        }
        ?>
    </form>

    <div class="totals">
     <!--  <div class="totals-item">
        <label>Subtotal</label>
        <div class="totals-value" id="cart-subtotal">71.97</div>
      </div>
      <div class="totals-item">
        <label>Tax (5%)</label>
        <div class="totals-value" id="cart-tax">3.60</div>
      </div>
      <div class="totals-item">
        <label>Shipping</label>
        <div class="totals-value" id="cart-shipping">15.00</div>
      </div> -->
      <div class="totals-item totals-item-total">
        <label>Tổng cộng</label>
        <div class="totals-value" id="cart-total"><?php echo number_format($total); ?></div>
      </div>
    </div>

    <button class="checkout">Đặt hàng</button>

  </div>

</div>
<script src="<?php echo base_url().'public/js/site/cart/index.js'?>"></script>
