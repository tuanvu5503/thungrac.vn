<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $title; ?></title>
	<style type="text/css">
		body{
			min-height: 1000px;
			padding-top: 75px;
		}
	</style>

	<!-- My CSS -->
	<link href="<?php echo base_url.'public/css/site/product.css' ?>" rel="stylesheet">

	<!-- Bootstrap CSS -->
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
	<!-- jQuery -->
	<script src="//code.jquery.com/jquery.js"></script>
	<!-- Bootstrap JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	<script src="<?php echo base_url.'public/js/site/products.js'?>"></script>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> <!-- all product -->
				<div id="search_head">Tìm thấy <?php echo $qty; ?> sản phẩm </div>
			</div>
			<div class="row">
				<?php 
				foreach ($search as $row) {
					?>
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
						<div class="items">
							<div class="ribbon-wrapper-green"><div class="ribbon-green">MỚI VỀ</div></div>
								<div class="items_head">
									<div class="pro_name"><a class="product_name" href="<?php echo base_url.'index/lesson6/view_detail?id='.$row['id']; ?>"><?php echo htmlspecialchars($row['product_name']); ?></a></div>
									<div class="price">Giá: <?php echo number_format($row['price']).'$'; ?></div>
								</div>
								<a style="display:block;" href="<?php echo base_url.'index/lesson6/view_detail?id='.$row["id"]; ?>">
								<div class="items_image zooming" style="background-image: url(<?php if ($row['image'] != '') echo base_url.'public/img/products/'.$row['image']; else echo base_url.'public/img/products/noimage.jpg'; ?>);">
									<div class="addcart"><span class="glyphicon glyphicon-shopping-cart"></span> THÊM VÀO GIỎ</div>
									<div class="like"><span class="glyphicon glyphicon-heart"></span> Like</div>
								</div>
								</a>
							</div>
					</div>
					<?php
				}
				?>
			</div>

		</div>
		<span style="float:right;"><?php echo $pagination; ?></span>	
	</div>
</body>
</html>