<?php 
	$url = base_url()."index.php/_admin/product/del_product"; 
?>

<legend style="margin-top:10px; margin-bottom:20px; text-align:center;"><?= mb_strtoupper($super_category_name) ?> (<?= $total_product;?>)</legend>
<table style="margin-top:10px;" class="table table-striped table-hover">
	<thead>
		<tr>
			<th style="text-align:center;">#</th>
			<th style="text-align:center;">Hình đại diện</th>
			<th style="text-align:center;">Tên sản phẩm</th>
			<th style="text-align:center;">Loại sản phẩm</th>
			<th style="text-align:center;">Giá (VNĐ)</th>
			<th style="text-align:center;">Kích thước</th>
			<th style="text-align:center;">Chất liệu</th>
			<th style="text-align:center;">Tem dán</th>
			<th style="text-align:center;">Thao tác</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		
		if (count($all_pro) == 0) {
			?>
				<!-- NO DATA -->
				<tr style="text-align:center;" class="warning">
					<td colspan="9">
						<h2 class="text-center">Không tìm thấy sản phẩm nào!</h2>
					</td>
				</tr>
			<?php
		} else {
			if ($this->uri->segment(3) == 'product_in_category') {
				$stt = $this->uri->segment(5) == null ? 0 : $this->uri->segment(5);
			} else {
				$stt = $this->uri->segment(4) == null ? 0 : $this->uri->segment(4);
			}
		
			foreach ($all_pro as $row) {
				$stt++;
				?>
				<tr style="text-align:center;" id="<?php echo $row['id'] ?>">
					<td><?php echo $stt ?></td>
					<td><img style="margin: 0 auto;" width="70px" src="<?php echo base_url().'public/img/products/'.$row['image'] ?>" class="img-responsive" alt="Image"></td>
					<td><?php echo htmlspecialchars($row['product_name']); ?></td>
					<td><?php echo htmlspecialchars($row['category_name']) ?></td>
					<td style="text-align:right;"><?php echo number_format($row['price']) ?></td>
					<td><?= $row['size'] ?></td>
					<td><?= $row['substance'] ?></td>
					<td><?php echo htmlspecialchars(mb_strtoupper($row['ribbon'])); ?></td>
					<td>
						<a href="<?php echo base_url().'index.php/_admin/product/edit/'.$row['id'] ?>">
							<span class="icon_action glyphicon glyphicon-pencil"></span>
						</a>
						<a class="delete" onclick="delete_modal('<?= $url ?>', <?= $row['id'] ?>,'del_product_success')">
							<span class="icon_action glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>

				<?php
			}
		}
		?>
	</tbody>
</table>
<a style="float:left; margin-top:20px;" class="btn btn-primary" href="<?php echo base_url().'index.php/_admin/product/add_product' ?>" role="button">THÊM SẢN PHẨM</a>
<?php 
	echo $pagination;
?>
</div>

<script type="text/javascript">
	function del_product_success (del_id) {
		$("tr#"+del_id).addClass('remove');
	}
</script>

