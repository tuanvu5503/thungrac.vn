<style type="text/css">
	.img_slide{
		width: 300px;
	}
</style>
<?php 
	$id = isset($re_id) ? $re_id : $slider_info['id'];
	$link_slider = isset($re_link_slider) ? $re_link_slider : $slider_info['link_slider'];
	$des_slider = isset($re_des_slider) ? $re_des_slider : $slider_info['des_slider'];
 ?>
<div class="col-xs-6 col-xs-offset-3 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
	
	<legend style="margin-top:50px; margin-bottom:30px; text-align:center;">CẬP NHẬT SLIDER HÌNH ẢNH</legend>
		<form action="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider' ?>" method="POST" role="form" enctype="multipart/form-data">

			<input type="hidden" name="id" value="<?=$id?>">
			<input id="link_slider_tmp" type="hidden" name="target_link" value="">

			<div class="form-group">
				<?php  
				if (isset($re_link_slider)) {
					?>
					<img id="old_image" display='block' class="img_slide" src="<?=$re_link_slider?>" /><br />
					<?php
				} else {
					?>
					<img id="old_image" display='block' class="img_slide" src="<?php echo base_url().'public/img/slider/'.$link_slider; ?>" /><br />
					<?php
				}
				?>
				<img id="uploadPreview1" class="img_slide" alt="" /><br />
				<input id="uploadImage1" type="file" name="image_slider" style="display:none;" onchange="PreviewImage(1);" />
				<button style="float:left;" onclick="choose_new_image()" type="button" class="btn btn-info">Đổi hình</button>
				<button id="reset_old_image" onclick="reset_image()" type="button" style="display:none; float:left; margin-left:10px;" class="btn btn-info">Khôi phục</button>
			</div>

			<div style="margin-top:50px; clear:both;" class="form-group">
				<label for="inputDes_slider">Mô tả</label>
				<textarea name="des_slider" id="inputDes_slider" class="form-control" rows="3" ><?=$des_slider?></textarea>
			</div>

	    	<input style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_slider_btn" value="Cập nhật">
	    	<a style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="javascript:history.go(-1)" role="button">Hủy</a>
		
		</form>
</div>

<script type="text/javascript">
    function PreviewImage(no) {
    	$('#old_image').css('display', 'none');
    	$('#reset_old_image').css('display', 'block');

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
            target_link = $("#uploadPreview1").attr('src');
	    	$('#link_slider_tmp').val(target_link);

    	// console.log($("#uploadPreview1").attr('src'));
        };
    }

    function reset_image () {
    	$('#old_image').css('display', 'block');

    	$('#uploadPreview1').attr('src', '');
    	$('#reset_old_image').css('display', 'none');
    }

    function choose_new_image () {
    	$("#uploadImage1").click();
    }
</script>