<?php 
	$url = base_url()."index.php/_admin/category/delete_super_category"; 
?>

<div class="col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">QUẢN LÝ LOẠI DANH MỤC</legend>
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				<th>#</th>
				<th>Tên loại danh mục</th>
				<th>Thao tác</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if (count($all_super_category) == 0) {
				?>
				<!-- NO DATA -->
				<tr class="warning">
					<td colspan="3">
						<h2 class="text-center">Chưa có loại danh mục nào!</h2>
					</td>
				</tr>
				<?php
			} else {
				$stt=0;
				foreach ($all_super_category as $row) {
					$stt++;
					?>
					<tr id="<?php echo $row['id'] ?>">
						<td><?php echo $stt ?></td>
						<td><?php echo htmlspecialchars($row['super_categoryName']); ?></td>
						<td>
							<a href="<?php echo base_url().'index.php/_admin/category/edit_super_category/'.$row['id']; ?>">
								<span class="icon_action glyphicon glyphicon-pencil"></span>
							</a>

							<a class="delete" onclick="delete_modal('<?= $url ?>', <?= $row['id'] ?>,'del_super_category_success')">
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
	<a style="float:left; margin-top:20px;" class="btn btn-primary" href="<?php echo base_url().'index.php/_admin/category/add_super_category' ?>" role="button">THÊM LOẠI DANH MỤC</a>
</div>
<script type="text/javascript">
	function del_super_category_success (del_id) {
		$("tr#"+del_id).addClass('remove');
	}
</script>