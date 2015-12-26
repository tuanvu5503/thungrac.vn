<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style type="text/css">
		body{
			/*width: 99%;*/
			/*padding-top: 75px;*/
			zoom: 90%;
			overflow-x: hidden;
		}
		.sp-wrap {
	        width: 200px;
	    }
	    @import "compass/css3";

/*
I wanted to go with a mobile first approach, but it actually lead to more verbose CSS in this case, so I've gone web first. Can't always force things...

Side note: I know that this style of nesting in SASS doesn't result in the most performance efficient CSS code... but on the OCD/organizational side, I like it. So for CodePen purposes, CSS selector performance be damned.
*/

/* Global settings */
$color-border: #eee;
$color-label: #aaa;
$font-default: 'HelveticaNeue-Light', 'Helvetica Neue Light', 'Helvetica Neue', Helvetica, Arial, sans-serif;
$font-bold: 'HelveticaNeue-Medium', 'Helvetica Neue Medium';


/* Global "table" column settings */
.product-image { float: left; width: 20%; }
.product-details { float: left; width: 37%; }
.product-price { float: left; width: 12%; }
.product-quantity { float: left; width: 10%; }
.product-removal { float: left; width: 9%; }
.product-line-price { float: left; width: 12%; text-align: right; }


/* This is used as the traditional .clearfix class */
.group:before,
.group:after {
    content: '';
    display: table;
} 
.group:after {
    clear: both;
}
.group {
    zoom: 1;
}


/* Apply clearfix in a few places */
.shopping-cart, .column-labels, .product, .totals-item {
  @extend .group;
}


/* Apply dollar signs */
.product .product-price:before, .product .product-line-price:before, .totals-value:before {
  content: '$';
}


/* Body/Header stuff */
body {
  padding: 0px 30px 30px 20px;
  font-family: $font-default;
  font-weight: 100;
}

h1 {
  font-weight: 100;
}

label {
  color: $color-label;
}

.shopping-cart {
  margin-top: -45px;
}


/* Column headers */
.column-labels {
  label {
    padding-bottom: 15px;
    margin-bottom: 15px;
    border-bottom: 1px solid $color-border;
  }
  
  .product-image, .product-details, .product-removal {
    text-indent: -9999px;
  }
}


/* Product entries */
.product {
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 1px solid $color-border;
  
  .product-image {
    text-align: center;
    img {
      width: 100px;
    }
  }
  
  .product-details {
    .product-title {
      margin-right: 20px;
      font-family: $font-bold;
    }
    .product-description {
      margin: 5px 20px 5px 0;
      line-height: 1.4em;
    }
  }
  
  .product-quantity {
    input {
      width: 40px;
      
    }
  }
  
  .remove-product {
    border: 0;
    padding: 4px 8px;
    background-color: #c66;
    color: #fff;
    font-family: $font-bold;
    font-size: 12px;
    border-radius: 3px;
  }
  
  .remove-product:hover {
    background-color: #a44;
  }
}


/* Totals section */
.totals {
  .totals-item {
    float: right;
    clear: both;
    width: 100%;
    margin-bottom: 10px;
    
    label {
      float: left;
      clear: both;
      width: 79%;
      text-align: right;
    }
    
    .totals-value {
      float: right;
      width: 21%;
      text-align: right;
    }
  }
  
  .totals-item-total {
    font-family: $font-bold;
  }
}

.checkout {
  float: right;
  border: 0;
  margin-top: 20px;
  padding: 6px 25px;
  background-color: #6b6;
  color: #fff;
  font-size: 25px;
  border-radius: 3px;
}

.checkout:hover {
  background-color: #494;
}

/* Make adjustments for tablet */
@media screen and (max-width: 650px) {
  
  .shopping-cart {
    margin: 0;
    padding-top: 20px;
    border-top: 1px solid $color-border;
  }
  
  .column-labels {
    display: none;
  }
  
  .product-image {
    float: right;
    width: auto;
    img {
      margin: 0 0 10px 10px;
    }
  }
  
  .product-details {
    float: none;
    margin-bottom: 10px;
    width: auto;
  }
  
  .product-price {
    clear: both;
    width: 70px;
  }
  
  .product-quantity {
    width: 100px;
    input {
      margin-left: 20px;
    }
  }
  
  .product-quantity:before {
    content: 'x';
  }
  
  .product-removal {
    width: auto;
  }
  
  .product-line-price {
    float: right;
    width: 70px;
  }
  
}


/* Make more adjustments for phone */
@media screen and (max-width: 350px) {
  
  .product-removal {
    float: right;
  }
  
  .product-line-price {
    float: right;
    clear: left;
    width: auto;
    margin-top: 10px;
  }
  
  .product .product-line-price:before {
    content: 'Item Total: $';
  }
  
  .totals {
    .totals-item {
      label {
        width: 60%;
      }
      
      .totals-value {
        width: 40%;
      }
    }
  }
}
	</style>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!--================================= My CSS =================================-->
	<link href="<?php echo base_url().'public/css/site/jquery.bxslider.css' ?>" rel="stylesheet">

	<link href="<?php echo base_url().'public/css/site/product.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/header.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/footer.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/vmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/banner.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/hmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/smoothproducts.css' ?>" rel="stylesheet">
	<!--================================= My CSS =================================-->

	<!-- ================================ MY JS =================================== -->
	<script src="<?php echo base_url().'public/js/site/jquery.bxslider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.sticky.js'?>"></script>

	<script src="<?php echo base_url().'public/js/site/products.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/menu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/hmenu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/smoothproducts.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/zoom_product.js'?>"></script>
	<!-- ================================ MY JS =================================== -->

</head>
<body>
	<!-- Icon scroll to Top -->
	<img id="top_icon" src="<?php echo base_url().'public/icon/top.png' ?>">
	<div class="container">
		<div class="row">

			<!--================= START: Banner website =================-->
			<img style="width:100%;" src="<?php echo base_url().'public/img/banner/banner.jpg'; ?>" class="img-responsive" alt="Image">
			<!--================= END: Banner website ===================-->

			<!--================= START: navbar menu =================-->
			<nav class="navbar navbar-default container sticker" role="navigation">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#menu">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a style="font-size:14px; font-weight:bold;" class="navbar-brand" href="<?php echo base_url(); ?>"><span style="margin-right:8px;" class="glyphicon glyphicon-home"></span>TRANG CHỦ</a>
				</div>

				<div id="menu" class="navbar-collapse collapse">
					<ul style="margin-right:10px;" class="nav navbar-nav navbar-left">
						<?php 
								// var_dump($menus);
						foreach ($menus as $key => $value) {
							?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $key ?><span class="caret"></span></a>
								<ul class="dropdown-menu">
									<?php
									$i = 0;
									$n = count($value);
									foreach ($value as $row) {
										$i++;
										?>
										<li><a href="#"><?php echo $row['category_name']; ?></a></li>
										<?php
										if ($i != $n) {
											echo '<li role="separator" class="divider"></li>';
										}
									}
									?>
								</ul>
							</li>
							<?php
						}
						?>
						<li>
							<a href="#"><span style="margin-right:8px;" class="glyphicon glyphicon-envelope"></span>LIÊN HỆ</a>
						</li>
					</ul>

						<!-- <ul style="margin-right:10px;" class="nav navbar-nav navbar-right">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Thành viên <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="#">Đăng ký</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#">Đăng nhập</a></li>
								</ul>
							</li>
						</ul> -->
						<form action="<?php echo base_url().'index/lesson6/search'; ?>" method="get" class="navbar-form navbar-right" role="search">
						 	<!-- <div class="form-group">
								<select name="category" id="inputCategory" class="form-control">
									<option selected="selected" value="">Tìm theo</option>
				 					<?php 
									if (isset($header)) {
										foreach ($header as $row) {
											echo $row['id'];
											?>
											<option <?php if ( isset($_GET['category']) && ($_GET['category'] == $row['id'])) echo "selected"; ?> value="<?php echo $row['id']; ?>"><?php echo $row['category_name']; ?></option>
											<?php
										}
									}
									 ?>
								</select>
							</div> 

							<div class="form-group">
								<select name="price" id="inputPrice" class="form-control">
									<option selected="selected" value="">Chọn giá</option>
									<option <?php if (isset($_GET['price']) && ($_GET['price'] == 100)) echo "selected"; ?> value="100">Dưới 100$</option>
									<option <?php if (isset($_GET['price']) && ($_GET['price'] == 300)) echo "selected"; ?> value="300">Dưới 300$</option>
									<option <?php if (isset($_GET['price']) && ($_GET['price'] == 500)) echo "selected"; ?> value="500">Dưới 500$</option>
									<option <?php if (isset($_GET['price']) && ($_GET['price'] == 1000)) echo "selected"; ?> value="1000">Dưới 1000$</option>
								</select>
							</div> -->
							<div class="form-group">
								<input type="text" id="search_val" name="key" value="<?php if (isset($_GET['key'])) echo $_GET['key']; ?>" class="form-control" placeholder="Bạn tìm gì?">
							</div>
							<button type="submit" id="btn_search" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Tìm</button>
						</form>
					</div>
				</nav>
			<!--================= END: navbar menu =================-->

			</div>
			<div class="row">

			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> <!-- Menu doc -->
				<?php 
				$active = 'adf';				
				?>
				<ul id="vmenu" class="nav nav-pills nav-stacked">
					<div class="new_pro_head">
						<span style="padding-right:10px;" class="glyphicon glyphicon-th-list"></span>
						DANH MỤC SẢN PHẨM
					</div>
					<?php 
					if (!empty($menu)) {
						foreach ($menu as $row) {
							?>
							<li class="<?php if ($row['id'] == $active) echo "actived"; ?>" id="<?php echo $row['id']; ?>" role="presentation"><a href="<?php echo base_url().'index/lesson6/products_category/'.$row['id'].'#view'; ?>"><span style="color:#0093FF;" class="glyphicon glyphicon-shopping-cart"></span>  <?php echo htmlspecialchars($row['category_name']); ?></a></li>
							<?php
						}
					}
					?>
				</ul>
			</div>

			<!--============================= START: CONTENT OF BODY =============================-->
			<h1>Shopping Cart</h1>

			<div class="shopping-cart">

			  <div class="column-labels">
			    <label class="product-image">Image</label>
			    <label class="product-details">Product</label>
			    <label class="product-price">Price</label>
			    <label class="product-quantity">Quantity</label>
			    <label class="product-removal">Remove</label>
			    <label class="product-line-price">Total</label>
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
			        Remove
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
			        Remove
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
			<!--============================= END: CONTENT OF BODY ===============================-->
			
		<div class="row"><!-- Footer -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<footer>
					<div id="footer_lienhe">
						<a href="#" class="head_footer">Trang chủ</a>
						<span> | </span>
						<a href="#" class="head_footer">Liên hệ</a>
						<span> | </span>
						<a href="#" class="head_footer">Thành viên đăng nhập</a>
					</div>
					<div id="footer_content">
						<span>Thông tinh website | Email liên hệ | Số điện thoại liên hệ </span>
						<div style="float:right; margin-right:15px;">Coppyright @ 2015</div>
					</div>
				</footer>
			</div>
		</div>
	</body>
	</html>