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
		
	</style>

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<!--================================= My CSS =================================-->
	<link href="<?php echo base_url().'public/css/site/s3-slider.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/jquery.mCustomScrollbar.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/jquery.bxslider.css' ?>" rel="stylesheet">

	<link href="<?php echo base_url().'public/css/site/product.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/header.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/footer.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/vmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/acticle.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/banner.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/hmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/cart/cart.css' ?>" rel="stylesheet">
	<!--================================= My CSS =================================-->

	<!-- ================================ MY JS =================================== -->
	<script src="<?php echo base_url().'public/js/site/jquery.bxslider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.mCustomScrollbar.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/s3-slider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.sticky.js'?>"></script>

	<script src="<?php echo base_url().'public/js/site/products.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/hmenu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/acticle.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/slider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/cart/cart.js'?>"></script>
	<!-- ================================ MY JS =================================== -->

</head>
<body>
	<!--============ START: ICON SCROLL TO TOP ============-->
	<img id="top_icon" src="<?php echo base_url().'public/icon/top.png' ?>">
	<!--============ END: ICON SCROLL TO TOP ============-->
	
	<!--============ START: BASE_URL USE IN JQUERY FILE ============-->
	<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
	<!--============ END: BASE_URL USE IN JQUERY FILE ============-->

	<div class="container">
		<div class="row">



			<!--================= START: Banner website =================-->
			<img style="width:100%;" src="<?php echo base_url().'public/img/banner/banner.jpg'; ?>" class="img-responsive" alt="Image">
			<!--================= END: Banner website ===================-->

			<!--================= START: NAVBAR MENU NGANG =================-->
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

					<!--========== START: ICON SHOPPING CART ==========-->
					<ul id="cart" class="nav navbar-nav navbar-right">
				      	<li>
				      		<a id="cart"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng <span class="badge"><?php echo $this->cart->total_items(); ?></span></a>
				      	</li>
				    </ul> 
					<!--========== END: ICON SHOPPING CART ==========-->

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
				<!--================= END: NAVBAR MENU NGANG =================-->

			</div>
			<div class="row">

				<!--========== START: BODY OF SHOPPING CART ==========-->
				<div class="shopping-cart">
					<div class="shopping-cart-header">
						<span style='font-size: 15px; margin-right:8px; color: #fff;' class='glyphicon glyphicon-shopping-cart'></span><span class="badge"><?php echo $this->cart->total_items(); ?></span>
						<div class="shopping-cart-total">
							<span class="lighter-text">Total:</span>
							<span class="main-color-text"><?php echo number_format($this->cart->total()); ?>VNĐ</span>
						</div>
					</div> 

					<ul class="shopping-cart-items">

					<?php 
						// var_dump($this->cart->contents());

						foreach ($this->cart->contents() as $item) {
							?>
							<li class="clearfix">
								<?php if ($this->cart->has_options($item['rowid']) == TRUE): ?>
                                    <?php foreach ($this->cart->product_options($item['rowid']) as $option_name => $option_value): ?>
										<img width="70" height="70" src="<?php echo base_url().'public/img/products/'.$option_value; ?>" alt="item1" />
                                    <?php endforeach; ?>
		                        <?php endif; ?>
								<input type="hidden" id="id" value="<?php echo $item['id']; ?>">
								<span class="item-name"><?php echo $item['name']; ?></span>
								Giá: <span class="item-price"><?php echo $item['price']; ?>VNĐ</span> <br>
								Số lượng: <span class="item-quantity"><?php echo $item['qty']; ?></span>
							</li>
							<?php
						}
					 ?>


							<!-- <li class="clearfix">
								<img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
								<span class="item-name">Sony DSC-RX100M III</span>
								<span class="item-price">$849.99</span>
								<span class="item-quantity">Quantity: 01</span>
							</li> -->

						
					</ul>
					<a id="checkout" class="btn btn-primary" href="<?php echo base_url().'index.php/site/cart/view_order' ?>" role="button">Đặt hàng</a>
				</div> 
				<!--========== END: BODY OF SHOPPING CART ==========-->

				<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> <!-- Menu doc -->
					<?php 
					$active = 'adf';				
					?>
					<ul id="vmenu" class="nav nav-pills nav-stacked">
						<div class="new_pro_head">
							<!-- <img style="padding-bottom:3px; padding-right:10px;" src="<?php echo base_url().'public/icon/catalog-icon.png' ?>"> -->
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

				

				<!--=========================== LOAD CONTENT ===========================-->
				<?php 
				$this->load->view($subView, $subData);
				?>
				<!--=========================== LOAD CONTENT ===========================-->


			</div>
			
			<div class="row"><!-- Footer -->
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
		</body>
		</html>