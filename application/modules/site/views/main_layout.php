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
	<link href="<?php echo base_url().'public/css/site/cart.css' ?>" rel="stylesheet">
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
	<script src="<?php echo base_url().'public/js/site/cart.js'?>"></script>
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

					<ul class="navbar-right">
				      	<li><a id="cart"><i class="fa fa-shopping-cart"></i> Cart <span class="badge">3</span></a></li>
				    </ul> <!--end navbar-right -->

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
			




	<div class="shopping-cart">
    <div class="shopping-cart-header">
      <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">3</span>
      <div class="shopping-cart-total">
        <span class="lighter-text">Total:</span>
        <span class="main-color-text">$2,229.97</span>
      </div>
    </div> <!--end shopping-cart-header -->

    <ul class="shopping-cart-items">
      <li class="clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item1.jpg" alt="item1" />
        <span class="item-name">Sony DSC-RX100M III</span>
        <span class="item-price">$849.99</span>
        <span class="item-quantity">Quantity: 01</span>
      </li>

      <li class="clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item2.jpg" alt="item1" />
        <span class="item-name">KS Automatic Mechanic...</span>
        <span class="item-price">$1,249.99</span>
        <span class="item-quantity">Quantity: 01</span>
      </li>

      <li class="clearfix">
        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/195612/cart-item3.jpg" alt="item1" />
        <span class="item-name">Kindle, 6" Glare-Free To...</span>
        <span class="item-price">$129.99</span>
        <span class="item-quantity">Quantity: 01</span>
      </li>
    </ul>

    <a href="#" class="button">Checkout</a>
  </div> <!--end shopping-cart -->







			</div>
			<div class="row">
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

				<div class="col-xs-5 col-sm-5 col-md-5 col-lg-5">  <!-- Slider -->

					<div id="slider">
						<div class="slide">
							<img src='<?php echo base_url()."/public/img/slider/slide33.jpg"?> '/>
							<span> <b>A Tile is good</b><br/>Some text long or short text should be placed here to inform customers of your great products...</span>
						</div>

						<div class="slide">
							<img src='<?php echo base_url()."/public/img/slider/slide22.jpg"?> '/>
							<span> Finally a short text...</span>
						</div>

						<div class="slide">
							<img src='<?php echo base_url()."/public/img/slider/slide11.jpg"?> '/>
							<span> Finally a short text...</span>
						</div>

					</div>
				</div>

				<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"> <!-- Bai viet -->
					<div id="acticle_head">
						<img id="acticle_title-icon" src="<?php echo base_url().'public/icon/acticle_title-icon.png' ?>">
						Tin hot trong tuần
					</div>
					<ul class="acticle" data-mcs-theme="dark" style="font-size:15px;">
						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>

						<li>
							<img style="margin-bottom:5px;" src="<?php echo base_url().'public/icon/acticle_icon.png' ?>">
							<a href="">Thùng rác đôi nhập khẩu hình mái vòm giá rẻ tại Hà Nội </a>
						</li>
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