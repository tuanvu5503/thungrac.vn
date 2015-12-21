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
	<script src="<?php echo base_url().'public/js/site/jquery.elevatezoom.js'?>"></script>
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
			<?php 
			foreach ($info as $row) {
				$id = $row['id'];
				$img = $row['image'];
				$detail_image = htmlspecialchars($row['detail_image']);
				$product_name = $row['product_name'];
				$price = $row['price'];
				$des = $row['des'];
			}
			$sm_img=explode('|',$detail_image);
			?>
			<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
				<div class="album">
					<?php 
					$i=0;
					if ($sm_img[0] != '') { //neu khong co hinh chi tiet thi show hinh defaut.jpg
						?>
						<div class="sp-wrap">
							<?php
							foreach ($sm_img as $row) {
								?>
	    							<a href="<?php echo base_url().'public/img/detail_img/'.$sm_img[$i]; ?>"><img src="<?php echo base_url().'public/img/detail_img/'.$sm_img[$i]; ?>" alt=""></a>
								<?php
								$i++;
							}
							?>
						</div>
						<?php
					} else {
						?>
							<div class="sp-wrap">
    							<a href="<?php echo base_url().'public/img/detail_img/noimage.jpg'; ?>"><img src="<?php echo base_url().'public/img/detail_img/noimage.jpg'; ?>" alt=""></a>
							</div>
						<?php
					}
					?>
				</div>
			</div>

			<div class="col-xs-4 col-xs-offset-1 col-sm-4 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
				<div id="product_name"> <?php echo $product_name; ?></div>
				<div id="price"> <span style="font-weight:bold; color:#333;">Giá:</span> <?php echo number_format($price).' VNĐ'; ?></div>
				<div>
					<span style="float:left; font-size:15px; font-weight:bold; padding-top:15px; margin-right:20px;">Đặt hàng:</span>
					<input style="width:70px; float:left; margin-right:20px;" type="number" id="qty" class="form-control" value="1" min="1" max="" step="" required="required" title="số lượng">
					<button  type="button" id="btn_mua" class="btn btn-primary">Đặt hàng</button>
				</div>
				<div style="margin-top:15px;" id="describle"> <span style="font-weight:bold;">Mô tả:</span> <?php echo $des; ?></div>

				<span style="margin-top:10px; font-size:15px; font-weight:bold; padding-top:15px; margin-right:20px;">Hỗ trợ bán hàng:</span>
			</div>
			
		</div>
			
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