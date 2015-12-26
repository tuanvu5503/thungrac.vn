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
    <label class="product-line-price">Tổng tiền</label>
  </div>








  

  <div class="product">
    <div class="product-image">
      <img src="http://s.cdpn.io/3/dingo-dog-bones.jpg">
    </div>
    <div class="product-details">
      <div class="product-title">Dingo Dog Bones</div>
      <p class="product-description">The best dog bones of all time. Holy crap. Your dog will be begging for these things! I got curious once and ate one myself. I'm a fan.</p>
    </div>
    <div class="product-price">12.99</div>
    <div class="product-quantity">
      <input type="number" value="2" min="1">
    </div>
    <div class="product-removal">
      <button class="remove-product">
        Xóa
      </button>
    </div>
    <div class="product-line-price">25.98</div>
  </div>





  <div class="product">
    <div class="product-image">
      <img src="http://s.cdpn.io/3/large-NutroNaturalChoiceAdultLambMealandRiceDryDogFood.png">
    </div>
    <div class="product-details">
      <div class="product-title">Nutro™ Adult Lamb and Rice Dog Food</div>
      <p class="product-description">Who doesn't like lamb and rice? We've all hit the halal cart at 3am while quasi-blackout after a night of binge drinking in Manhattan. Now it's your dog's turn!</p>
    </div>
    <div class="product-price">45.99</div>
    <div class="product-quantity">
      <input type="number" value="1" min="1">
    </div>
    <div class="product-removal">
      <button class="remove-product">
        Xóa
      </button>
    </div>
    <div class="product-line-price">45.99</div>
  </div>




  <div class="totals">
    <div class="totals-item">
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
    </div>
    <div class="totals-item totals-item-total">
      <label>Grand Total</label>
      <div class="totals-value" id="cart-total">90.57</div>
    </div>
  </div>
      
      <button class="checkout">Checkout</button>

</div>

</div>
	<script src="<?php echo base_url().'public/js/site/cart/index.js'?>"></script>
