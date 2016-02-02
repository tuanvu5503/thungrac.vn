<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">THÊM LOẠI SẢN PHẨM</legend>

	<form action="<?php echo base_url().'index.php/_admin/category/add_sub_category' ?>" method="POST">
		<div class="form-group">
            <label for="super_category_id">Loại danh mục</label>
            <select name="super_category_id" id="super_category_id" class="form-control" required="required">
            	<option value="">Chọn loại danh mục</option>
            	<?php 
            	foreach ($all_super_category as $item) {
            		if (isset($re_super_categoryId) && $re_super_categoryId == $item['id']) {
            			echo "<option selected value='".$item['id']."'>".$item['super_categoryName']."</option>";
            		} else {
            			echo "<option value='".$item['id']."'>".$item['super_categoryName']."</option>";
            		}
            	}
            	?>
            </select>
        </div>

		<div class="form-group">
			<label for="sub_category_name">Tên loại sản phẩm</label>
			<input value="<?php if (isset($re_sub_category_name)) echo htmlspecialchars($re_sub_category_name); ?>" name="sub_category_name" required type="text" class="form-control" id="sub_category_name" placeholder="Nhập tên loại danh mục">
		</div>

		<input value="Thêm" name="add_sub_category_btn" style="margin-top:40px; font-size: 17px; margin-bottom:300px; width:100px; float:right; margin-right:10px;" type="submit" class="btn btn-primary">
		<a style="margin-top:40px; font-size: 17px; margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-info" href="<?php echo base_url().'index.php/_admin/category/show_sub_category' ?>" role="button">
			<span style='font-size:20px; padding-right:5px;' class='glyphicon glyphicon-circle-arrow-left'></span>Trở về
		</a>
	</form>
</div>
