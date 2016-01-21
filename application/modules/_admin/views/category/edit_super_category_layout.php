
<div class="col-xs-6 col-xs-offset-3  col-sm-6 col-sm-offset-3  col-md-6 col-md-offset-3  col-lg-6 col-lg-offset-3 ">
	<legend style="margin-top:50px; margin-bottom:50px; text-align:center;">CẬP NHẬT LOẠI DANH MỤC</legend>
	<form action="<?php echo base_url().'index.php/_admin/category/edit_super_category' ?>" method="POST">
			<input name="super_category_id" type="hidden" value="<?php if (isset($re_super_category_id)) {echo ($re_super_category_id);} else {echo $super_category_info['id'];} ?>">
		<div class="form-group">
			<label for="super_categoryName">Tên loại danh mục</label>
			<input value="<?php if (isset($re_super_category_name)) {echo htmlspecialchars($re_super_category_name);} else {echo $super_category_info['super_categoryName'];} ?>" name="super_categoryName" required type="text" class="form-control" id="super_categoryName" placeholder="Nhập tên danh mục">
		</div>
	
		<input style="margin-bottom:300px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_super_category_btn" value="Cập nhật">
    	<a style="margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="<?php echo base_url().'index.php/_admin/category/show_super_category' ?>" role="button">Hủy</a>
	</form>
</div>
