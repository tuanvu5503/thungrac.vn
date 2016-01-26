<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
	
<div id="search_head"><?php echo $title_action.' ('.$total_product.')'; ?></div>

	<?php
	if ( ! empty($all_pro)) {
		$i=0;
		foreach ($all_pro as $row) {
				$super_categoryName = strtolower(utf8convert($row['super_categoryName']));
				$super_categoryName = str_replace(' ', '-', $super_categoryName);
				$categoryName = strtolower(utf8convert($row['categoryName']));;
				$categoryName = str_replace(' ', '-', $categoryName);

			$i++;
			if (($i % 4) == 0) {
				echo '<div class="row">';
			}
			?>
				
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
			<?php
			if (($i % 4) == 0) {
				echo '</div>';
			}
		}
	} else {
		echo "Không tìm thấy sản phẩm nào!";
	}
	?>
</div>
<?php if (isset($pagination)) echo $pagination; ?>