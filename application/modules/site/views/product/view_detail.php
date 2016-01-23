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


