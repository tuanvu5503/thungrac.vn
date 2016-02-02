	
<div id="search_head"><?php echo $title_action.' ('.$total_product.')'; ?></div>

	<?php
	if ( ! empty($all_pro)) {
		$i=0;
		foreach ($all_pro as $row) {
			$categoryName = name_in_url($row['categoryName']);
			$url_product_name = name_in_url($row['product_name']);
				
			$i++;
			if (($i % 4) == 0) {
				echo '<div class="row">';
			}
			?>
				
				<div class="items">
				<?php 
					if (trim($row['ribbon']) != '') {
						?>
						<div class="ribbon-wrapper-green"><div class="ribbon-green"><?php echo mb_strtoupper(htmlspecialchars($row['ribbon'])); ?></div></div>
						<?php
					} 
				 ?>
					<div class="items_head">
						<div class="pro_name"><a class="product_name" href="<?php echo base_url().'san-pham/'.$categoryName.'/'.$url_product_name.'/maso-'.$row['id'].'.html'; ?>"><?php echo htmlspecialchars($row['product_name']); ?></a></div>
						<div class="price">Giá: <?php echo number_format($row['price']).' Vnđ'; ?></div>
					</div>
					<a style="display:block;" href="<?php echo base_url().'san-pham/'.$categoryName.'/'.$url_product_name.'/maso-'.$row['id'].'.html'; ?>">
						<div class="items_image zooming" style="background-image: url(<?php if ($row['image'] != '') echo base_url().'public/img/products/'.$row['image']; else echo base_url().'public/img/products/noimage.jpg'; ?>);">
							<div id="<?php echo $row['id']; ?>" class="addcart"><span class="glyphicon glyphicon-shopping-cart"></span> THÊM VÀO GIỎ</div>
							<div class="like"><span class="glyphicon glyphicon-heart"></span> Like</div>
						</div>
					</a>
				</div>
			<?php
			if (($i % 4) == 0) {
				echo '</div>';
			}
		}
	} else {
		echo "Không tìm thấy sản phẩm nào!";
	}
	?>
	<div style="width:100%; clear:both; padding-right:90px; text-align:right;">
		<?php if (isset($pagination)) echo $pagination; ?>
	</div>