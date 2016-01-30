<script src="<?php echo base_url().'public/ckeditor/ckeditor.js'?>"></script>

	<form action="<?php echo base_url(); ?>index.php/_admin/manage_site/contact/edit_contact" method="POST" role="form" enctype="multipart/form-data" >
		<legend class="text-center">CHỈNH SỬA THÔNG TIN LIÊN LẠC</legend>
		
		<div class="form-group">
			<textarea id="contact" name="content_contact" rows="3" required="required"><?= $contact ?></textarea>
		</div>
		
    	<input style="margin-bottom:300px; width:100px; float:right; margin-right:50px;" class="btn btn-primary" type="submit" name="edit_contact_btn" value="Cập nhật">
    	<a style="margin-bottom:300px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="javascript:history.go(-1)" role="button">Hủy</a>
	</form>		

<script type="text/javascript">
	$(function() {				    				    
		if(CKEDITOR.instances['contact']) {						
			CKEDITOR.remove(CKEDITOR.instances['contact']);
		}
		CKEDITOR.config.width = 1100;
	    CKEDITOR.config.height = 500;
		CKEDITOR.replace('contact',{});
	})
</script>