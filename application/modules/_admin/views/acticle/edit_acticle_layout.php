<script src="<?php echo base_url().'public/ckeditor/ckeditor.js'?>"></script>

	<form action="<?php echo base_url(); ?>index.php/_admin/acticle/edit_acticle" method="POST" role="form" enctype="multipart/form-data" >
		<legend class="text-center">CHỈNH SỬA BÀI VIẾT</legend>
		
		<input name="acticle_id" type="hidden" value="<?= $acticle_info['id'] ?>">
		
		<div class="form-group">
			<label style="color: red; font-size: 17px" for="acticle_name">Tiêu đề bài viết</label>
			<input value="<?= $acticle_info['acticle_name'] ?>" style="width: 1000px;" name="acticle_name" type="text" class="form-control" required id="acticle_name" placeholder="Nhập tiêu đề bài viết">
		</div>
		
		<div class="form-group">
			<label style="color: red; font-size: 17px" for="acticle_content">Nội dung</label>
			<textarea id="acticle_content" class="" name="acticle_content" rows="3" required="required"><?= $acticle_info['acticle_content'] ?></textarea>
		</div>
		
    	<input style="margin-bottom:300px; width:100px; float:right; margin-right:200px;" class="btn btn-primary" type="submit" name="edit_acticle_btn" value="Cập nhật">
    	<a style="margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="<?php echo base_url().'index.php/_admin/acticle/show_acticle' ?>" role="button">Hủy</a>
	</form>		

<script type="text/javascript">
	$(function() {				    				    
		if(CKEDITOR.instances['acticle_content']) {						
			CKEDITOR.remove(CKEDITOR.instances['acticle_content']);
		}
		CKEDITOR.config.width = 1000;
	    CKEDITOR.config.height = 500;
		CKEDITOR.replace('acticle_content',{});
	})
</script>