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
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"> <!-- all product -->
	<!--================================= List product by super category =================================-->
	<?php 
	foreach ($products as $key => $value) {
		if (count($value) > 0) {
		?>
		<div class="all_pro_head">
			<?php 
			echo mb_strtoupper($key);
			?>
		</div>

		<?php 
			?>
			<div class="slider1">

				<?php
				$super_categoryName = strtolower(utf8convert($key));
				$super_categoryName = str_replace(' ', '-', $super_categoryName);
				foreach ($value as $row) {
					// var_dump($row);
					$categoryName = strtolower(utf8convert($row['category_name']));;
					$categoryName = str_replace(' ', '-', $categoryName);
					?>
					<div style="width:212px; height:300px; float:left;">
						
						<div class="items">
							<div class="ribbon-wrapper-green"><div class="ribbon-green">MỚI VỀ</div></div>
							<div class="items_head">
								<div class="pro_name"><a class="product_name" href="<?php echo base_url().'index.php/site/homepage/view_detail/'.$super_categoryName.'/'.$categoryName.'-'.$row["id"]; ?>"><?php echo htmlspecialchars($row['product_name']); ?></a></div>
								<div class="price">Giá: <?php echo number_format($row['price']).'$'; ?></div>
							</div>
							<a style="display:block;" href="<?php echo base_url().'index.php/site/homepage/view_detail/'.$super_categoryName.'/'.$categoryName.'-'.$row["id"]; ?>">
								<div class="items_image zooming" style="background-image: url(<?php if ($row['image'] != '') echo base_url().'public/img/products/'.$row['image']; else echo base_url().'public/img/products/noimage.jpg'; ?>);">
									<div id="<?php echo $row['id']; ?>" class="addcart"><span class="glyphicon glyphicon-shopping-cart"></span> THÊM VÀO GIỎ</div>
									<div class="like"><span class="glyphicon glyphicon-heart"></span> Like</div>
								</div>
							</a>
						</div>
					</div>
					<?php
				}
				?>		
			</div>
			<?php
		}
	}
	?>
	<!--================================= End List product by super category =================================-->








</div>