<div class="col-xs-10 col-xs-offset-1 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">QUẢN LÝ LOẠI SẢN PHẨM</legend>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Loại sản phẩm</th>
				<th>Loại danh mục</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (count($all_cate) == 0) {
				?>
				<!-- NO DATA -->
				<tr class="warning">
					<td colspan="4">
						<h2 class="text-center">Chưa có danh mục nào!</h2>
					</td>
				</tr>
				<?php
			} else {
				$stt=0;
				foreach ($all_cate as $row) {
					$stt++;
					?>
					<tr id="<?php echo $row['id'] ?>">
						<td><?php echo $stt ?></td>
						<td><?php echo htmlspecialchars($row['category_name']); ?></td>
						<td><?php echo htmlspecialchars($row['super_categoryName']); ?></td>
						<td>
							<a href="<?php echo base_url().'admin/category/edit/'.$row['id']; ?>">
								<span class="icon_action glyphicon glyphicon-pencil"></span>
							</a>
							<a class="delete" data-toggle="modal" data-id="<?php echo $row['id'] ?>" href='#modal_delete'>
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
	<a style="float:left; margin-top:20px;" class="btn btn-primary" href="<?php echo base_url().'admin/category/add' ?>" role="button">THÊM DANH MỤC</a>
</div>