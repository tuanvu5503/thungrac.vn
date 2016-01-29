<script src="<?php echo base_url().'public/js/site/zoom_product.js'?>"></script>
<script src="<?php echo base_url().'public/js/site/smoothproducts.js'?>"></script>

<link href="<?php echo base_url().'public/css/site/smoothproducts.css' ?>" rel="stylesheet">
<style type="text/css">
	.sp-wrap {
	        max-width: 400px !important;
	    }
</style>

<?php 
foreach ($info as $row) {
	$id 		  = $row['id'];
	$img 		  = htmlspecialchars($row['image']);
	$detail_image = htmlspecialchars($row['detail_image']);
	$product_name = $row['product_name'];
	$price 		  = $row['price'];
	$des 		  = $row['des'];
	$size 		  = htmlspecialchars($row['size']);
	$substance 	  = htmlspecialchars($row['substance']);

}
	$sm_img = $detail_image != '' ? explode('|',$detail_image) : array();
?>

<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
	<div class="album">
		<?php 
		$i=0;
		if ( ! empty($sm_img) && $img != '') { //neu khong co hinh chi tiet thi show hinh defaut.jpg
			?>
			<div class="sp-wrap">
				<a href="<?php echo base_url().'public/img/products/'.$img; ?>"><img src="<?php echo base_url().'public/img/products/'.$img; ?>" alt=""></a>
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
		} elseif(empty($sm_img) && $img != '') {
			?>
			<div class="sp-wrap">
				<a href="<?php echo base_url().'public/img/products/'.$img; ?>"><img src="<?php echo base_url().'public/img/products/'.$img; ?>" alt=""></a>
			</div>
			<?php
		} elseif ( ! empty($sm_img) && $img == '') {
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

<div class="col-xs-6 col-xs-offset-1 col-sm-6 col-sm-offset-1 col-md-6 col-md-offset-1 col-lg-6 col-lg-offset-1">
	<div id="product_name"> <?php echo $product_name; ?></div>
	<div id="price"> <span style="font-weight:bold; color:#333;">Giá:</span> <?php if ($price == 0) echo "<span style='font-size:18px;'>Liên hệ</span>"; else echo number_format($price).' VNĐ'; ?></div>
	<div>

    	<form id="order_form" action="<?php echo base_url().'index.php/site/cart/do_order'; ?>" method="POST" role="form">
            <input type="hidden" value="<?=$id?>" name="product_id">
        	<div class="customer"></div> <!-- contain customer's infomation -->

			<span style="float:left; font-size:15px; font-weight:bold; padding-top:15px; margin-right:20px;">Đặt hàng:</span>
			<input name="order_qty" style="width:70px; float:left; margin-right:20px;" type="number" id="qty" class="form-control" value="1" min="1" max="" step="" required="required" title="số lượng">
		</form>
			<button onclick="show_customer_form('tuan vu','01676869501')" type="button" id="btn_mua" class="btn btn-primary">Đặt hàng</button>
			<i id="<?=$id?>" style="cursor: pointer; font-size: 26px; color: rgb(103, 203, 34); margin-left: 20px;" class="addcart2 fa fa-cart-arrow-down"></i>
	</div>

	<div style="margin-top:15px;" id="describle"> <span style="font-weight:bold;">Kích thước:</span> <?php echo $size; ?></div>
	<div style="margin-top:15px;" id="describle"> <span style="font-weight:bold;">Chất liệu:</span> <?php echo $substance; ?></div>
	<div style="margin-top:15px;" id="describle"> <span style="font-weight:bold;">Mô tả:</span> <?php echo $des; ?></div>

	<span style="margin-top:10px; font-size:15px; font-weight:bold; padding-top:15px; margin-right:20px;">Hỗ trợ bán hàng:</span>
</div>

