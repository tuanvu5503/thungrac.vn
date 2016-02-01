<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Thungrac.vn - <?php echo $title; ?></title>
	<style type="text/css">
		body{
			/*width: 99%;*/
			/*padding-top: 75px;*/
			zoom: 90%;
			overflow-x: hidden;
		}
		
	</style>

	<!--================================= My CSS =================================-->
	<link href="<?php echo base_url().'public/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/font-awesome/css/font-awesome.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/s3-slider.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/jquery.bxslider.css' ?>" rel="stylesheet">

	<link href="<?php echo base_url().'public/css/common/common.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/product.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/header.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/footer.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/vmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/banner.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/hmenu.css' ?>" rel="stylesheet">
	<link href="<?php echo base_url().'public/css/site/cart/cart.css' ?>" rel="stylesheet">
	<!--================================= My CSS =================================-->


	<!-- ================================ MY JS =================================== -->
	<script src="<?php echo base_url().'public/jquery/jquery.js'?>"></script>
	<script src="<?php echo base_url().'public/bootstrap/js/bootstrap.min.js'?>"></script>
	<script src="<?php echo base_url().'public/js/common/bootbox.js'?>"></script>
	<script src="<?php echo base_url().'public/js/common/common.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.bxslider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.mCustomScrollbar.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/s3-slider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/jquery.sticky.js'?>"></script>

	<script src="<?php echo base_url().'public/js/site/products.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/hmenu.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/acticle.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/slider.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/cart/cart.js'?>"></script>
	<script src="<?php echo base_url().'public/js/site/main/main.js'?>"></script>
	<!-- ================================ MY JS =================================== -->
	<script type="text/javascript">
		base_url = '<?php echo base_url(); ?>';
	</script>
</head>
<body>
	<!--============================== Alert ==============================-->
	<div class="ajax_alert"></div>
	
	<?php 
		if (null !== $this->session->flashdata('order')) {
			$notice_data = $this->session->flashdata('order');

			$status = $notice_data['status'];
			$content = (array) $notice_data['content'];
			if ($status == 1) {
				$title = '<div style="font-size:18px; color: rgb(79, 180, 94);"><i style="color: rgb(33, 255, 0); font-size: 30px;" class="fa fa-check-square-o"></i> Thành công</div>';
			} else {
				$title = '<div style="font-size:18px; color:red;"><i style="color: rgb(255, 63, 0); font-size: 30px;" class="fa fa-times-circle"></i> Thất bại</div>';
			}

			?>
			<script type="text/javascript">
				var content = <?php echo json_encode($content); ?>;
				var title  =  '<?= $title ?>';
				
				set_alert(<?= $status ?>, title, content);
			</script>
			<?php
		}
	?>	
	<!--============================== Alert ==============================-->

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
					<a style="font-size:14px; font-weight:bold;" class="navbar-brand" href="<?php echo base_url(); ?>"><span style="margin-right:8px;" class="glyphicon glyphicon-home"></span></a>
				</div>

				<div id="menu" class="navbar-collapse collapse">
					<ul style="margin-right:10px;" class="nav navbar-nav navbar-left">
						<?php 
						foreach ($menus as $key => $value) {
							if ( ! empty($value)) {
							?>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo mb_strtoupper($key); ?><span class="caret"></span></a>
								<ul style="overflow:hidden;" class="dropdown-menu">
									<?php
									$i = 0;
									$n = count($value);
									foreach ($value as $row) {
										$i++;
										?>
										<li><a href="<?php echo base_url().'index.php/site/homepage/product_in_sub_category/'.$row['id']; ?>"><?php echo $row['category_name']; ?></a></li>
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
						}
						?>
						<!-- <li>
							<a href="#"><span style="margin-right:8px;" class="glyphicon glyphicon-envelope"></span>LIÊN HỆ</a>
						</li> -->
					</ul>

					<!-- <ul style="margin-right:0px; width:100px;" class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Thành viên <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo base_url().'index.php/site/auth/regist_account' ?>">Đăng ký</a></li>
								<li role="separator" class="divider"></li>
								<li><a href="#">Đăng nhập</a></li>
							</ul>
						</li>
					</ul> -->
					<!--========== START: ICON SHOPPING CART ==========-->
					<?php 
					if ($this->uri->segment(1) != 'dat-hang') {
						?>
						<ul id="cart" class="nav navbar-nav navbar-right">
							<li>
								<a id="cart"><span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng <span class="cart_total_items badge"><?php echo $this->cart->total_items(); ?></span></a>
							</li>
						</ul> 
						<?php	
					}
					?>
					<!--========== END: ICON SHOPPING CART ==========-->


					<form id="search_form" action="<?php echo base_url().'index.php/site/homepage/search_product'; ?>" method="get" class="navbar-form navbar-left" role="search">
							<div class="form-group">
								<input type="text" id="search_val" name="key" 
									value="<?php if (NULL != $this->uri->segment(1) 
										   && $this->uri->segment(1) == 'tim-kiem'
										   && NULL != $this->uri->segment(2)
										   ) {
												echo htmlspecialchars($this->uri->segment(2));
										   	} ?>" 
								class="form-control" placeholder="Nhập và nhấn Enter...">
							</div>
							<!-- <button type="submit" id="btn_search" class="btn btn-primary"><span class="glyphicon glyphicon-search"></span> Tìm</button> -->
						</form>
					</div>
				</nav>
				<!--================= END: NAVBAR MENU NGANG =================-->

			</div>
			<div class="row">

				<!--========== START: BODY OF SHOPPING CART ==========-->
				<div class="shopping-cart">
					<div class="shopping-cart-header">
						<span style='font-size: 15px; margin-right:8px; color: #fff;' class='glyphicon glyphicon-shopping-cart'></span><span class="cart_total_items badge"><?php echo $this->cart->total_items(); ?></span>
						<div class="shopping-cart-total">
							<span class="lighter-text">Total:</span>
							<span class="main-color-text"><?php echo number_format($this->cart->total()); ?>VNĐ</span>
						</div>
					</div> 

					<ul class="shopping-cart-items">

						<?php 
						if ( count($this->cart->contents()) > 0) {
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
									Giá: <span class="item-price"><?php echo number_format($item['price']); ?>VNĐ</span> <br>
									Số lượng: <span class="item-quantity"><?php echo $item['qty']; ?></span>
								</li>
								<?php
							}
						} else {
							echo "Chưa có sản phẩm nào!";
						}
						?>

					</ul>
					<?php 
					if (count($this->cart->contents()) > 0) {
						?>
						<a id="checkout" class="btn btn-primary" href="<?php echo base_url().'dat-hang' ?>" role="button">Đặt hàng</a>
						<?php
					}
					?>
				</div> 
					<!--========== END: BODY OF SHOPPING CART ==========-->

					<!--================= START: MENU DOC ================= -->
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"> 
						<?php 
						$active = $this->uri->segment(4);				
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
									<li class="<?php if ($row['id'] == $active) echo "actived"; ?>" id="<?php echo $row['id']; ?>" role="presentation"><a href="<?php echo base_url().'index.php/site/homepage/product_in_sub_category/'.$row['id']; ?>"><span style="color:#0093FF;" class="glyphicon glyphicon-shopping-cart"></span>  <?php echo htmlspecialchars($row['category_name']); ?></a></li>
									<?php
								}
							}
							?>
						</ul>
					</div>
					<!--================= END: MENU DOC ================= -->



					<!--=========================== LOAD CONTENT ===========================-->
					<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
						
					<?php 
					$this->load->view($subView, $subData);
					?>
					</div>
					<!--=========================== LOAD CONTENT ===========================-->


				</div>

				<div class="row"><!-- Footer -->
					<footer>
						<div id="footer_lienhe">
							<a href="<?php echo base_url(); ?>" class="head_footer">Trang chủ</a>
							<span> | </span>
							<a href="<?php echo base_url().'index.php/site/homepage/contact' ?>" class="head_footer">Liên hệ</a>
							<!-- <span> | </span> -->
							<!-- <a href="#" class="head_footer">Thành viên đăng nhập</a> -->
						</div>
						<div id="footer_content">
							<span>Thông tinh website | Email liên hệ | Số điện thoại liên hệ </span>
							<div style="float:right; margin-right:15px;">Coppyright @ 2015</div>
						</div>
					</footer>
				</div>
			</body>
			</html>

			<script type="text/javascript">
			$("#search_form").submit(function(event) {
				/* Act on the event */
				event.preventDefault();
				key = $("#search_val").val();
				if (key.trim() == '') {
					return false;
				}
				url = '<?php echo base_url()."tim-kiem/" ?>'+key;
				window.location.href = url;
			});
			</script>