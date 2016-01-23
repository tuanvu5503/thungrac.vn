<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">THÊM LOẠI DANH MỤC</legend>

	<form action="<?php echo base_url().'index.php/_admin/category/add_super_category' ?>" method="POST">
		<div class="form-group">
			<label for="super_category_name">Tên loại danh mục</label>
			<input value="<?php if (isset($re_super_category_name)) echo htmlspecialchars($re_super_category_name); ?>" name="super_category_name" required type="text" class="form-control" id="super_category_name" placeholder="Nhập tên loại danh mục">
		</div>

		<input value="Thêm" name="add_super_category_btn" style="margin-top:40px; font-size: 17px; margin-bottom:300px; width:100px; float:right; margin-right:10px;" type="submit" class="btn btn-primary">
		<a style="margin-top:40px; font-size: 17px; margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-info" href="<?php echo base_url().'index.php/_admin/category/show_super_category' ?>" role="button">
			<span style='font-size:20px; padding-right:5px;' class='glyphicon glyphicon-circle-arrow-left'></span>Trở về
		</a>
	</form>
</div>
