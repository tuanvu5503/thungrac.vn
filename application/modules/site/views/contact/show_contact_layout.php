<style type="text/css">
	div.content{
		margin-top: 70px;
	}
</style>

	<div class="content">
		<?php 
		 	if (isset($contact)) {
			 	echo $contact;
		 	} else {
		 		echo "Chưa cập nhật thông tin liên lạc!";
		 	} 

		?>
	</div>
	<a style="margin-bottom:300px; margin-top: 100px; width:100px; float:right; margin-right:100px;" class="btn btn-info" href="<?php echo base_url().'index.php/_admin/contact/edit_contact/'; ?>" role="button">Cập nhật</a>
