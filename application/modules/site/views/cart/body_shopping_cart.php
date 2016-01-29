<div class="shopping-cart-header">
	<span style='font-size: 15px; margin-right:8px; color: #fff;' class='glyphicon glyphicon-shopping-cart'></span><span class="cart_total_items badge"><?php echo $this->cart->total_items(); ?></span>
	<div class="shopping-cart-total">
		<span class="lighter-text">Total:</span>
		<span class="main-color-text"><?php echo number_format($this->cart->total()); ?>VNĐ</span>
	</div>
</div> 

<ul class="shopping-cart-items">

	<?php 
	if ( ! empty($this->cart->contents())) {
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
				Giá: <span class="item-price"><?php echo $item['price']; ?>VNĐ</span> <br>
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
if ( ! empty($this->cart->contents())) {
	?>
	<a id="checkout" class="btn btn-primary" href="<?php echo base_url().'index.php/site/cart/view_order' ?>" role="button">Đặt hàng</a>
	<?php
}
?>