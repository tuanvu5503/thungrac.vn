<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">CẬP NHẬT LOẠI SẢN PHẨM</legend>
<?php
  	if (isset($re_sub_category_name)) {
  	 	$sub_category_name = htmlspecialchars($re_sub_category_name); 
  	} elseif (isset($sub_category_info['category_name'])) {
  	 	$sub_category_name = htmlspecialchars($sub_category_info['category_name']); 
  	}

  	 if (isset($re_sub_category_id)) {
  	 	$sub_category_id = htmlspecialchars($re_sub_category_id); 
  	} elseif (isset($sub_category_info['id'])) {
  	 	$sub_category_id = htmlspecialchars($sub_category_info['id']); 
  	 }
?>
	<form action="<?php echo base_url().'index.php/_admin/category/edit_sub_category' ?>" method="POST">
		<div class="form-group">
            <label for="super_category_id">Loại danh mục</label>
            <select name="super_category_id" id="super_category_id" class="form-control" required="required">
            	<option value="">Chọn loại danh mục</option>
            	<?php 
            	foreach ($all_super_category as $item) {
            		if ($sub_category_info['super_categoryId'] == $item['id']) {
	            		echo "<option selected value='".$item['id']."'>".$item['super_categoryName']."</option>";
            			continue;
            		}
            		echo "<option value='".$item['id']."'>".$item['super_categoryName']."</option>";
            	}
            	?>
            </select>
        </div>

        <input name="sub_category_id" type="hidden" value="<?= $sub_category_id ?>">

		<div class="form-group">
			<label for="sub_category_name">Tên loại sản phẩm</label>
			<input value="<?= $sub_category_name ?>" name="sub_category_name" required type="text" class="form-control" id="sub_category_name" placeholder="Nhập tên loại danh mục">
		</div>

		<input style="margin-bottom:300px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_sub_category_btn" value="Cập nhật">
    	<a style="margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="<?php echo base_url().'index.php/_admin/category/show_sub_category' ?>" role="button">Hủy</a>
	
	</form>
</div>
