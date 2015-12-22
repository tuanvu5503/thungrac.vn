
<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9"> <!-- all product -->
<!--================================= List product by super category =================================-->
	<?php 
	foreach ($products as $key => $value) {
		?>
		<div class="all_pro_head">
			<?php 
			echo $key;
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
	 ?>
<!--================================= End List product by super category =================================-->








</div>