<script src="<?php echo base_url().'public/js/admin/manage_site/slider/slider.js'?>"></script>
<style type="text/css">
	.img_slide{
		width: 200px;
	}
</style>

<legend style="margin-top:50px; margin-bottom:30px; text-align:center;">THÊM HÌNH ẢNH VÀO SLIDER</legend>

<form action="<?php echo base_url().'index.php/_admin/manage_site/slider/add_slider'; ?>" method="POST" enctype="multipart/form-data">
	<div id="hidden"></div>
	<table class="table table-hover">
		<thead>
			<tr>
				<th width="5%">#</th>
				<th width="35%">Hình ảnh</th>
				<th width="50%">Mô tả</th>
				<th width="10%">Thao tác</th>
			</tr>
		</thead>
		<tbody id="add">

		<?php 
			if (isset($re_des_slider)) {
				for ($i=0; $i < count($re_des_slider); $i++) { 
					?>
					<tr>
			            <td colspan="2">
			                <img id="<?php echo 'uploadPreview'.$i; ?>" class="img_slide" alt="" /><br />
							<input id="<?php echo 'uploadImage'.$i; ?>" type="file" name="image_slider[]" style="display:none;" onchange="PreviewImage(<?php echo $i; ?>);" />
							
							<button style="float:left;" onclick="choose_new_image(<?php echo $i; ?>)" type="button" class="btn btn-defalt">Chọn hình</button>
							<button id="<?php echo 'reset_old_image'.$i; ?>" onclick="reset_image(<?=$i?>)" type="button" style="display:none; float:left; margin-left:10px;" class="btn btn-warning">Xóa</button>
			            </td>
			            <td><textarea name="des_slider[]" id="" class="form-control" rows="3"><?=$re_des_slider[$i]?></textarea></td>
			            <td>
			                <button type="button" class="delete_add_more_image btn btn-xs btn-default">Xóa</button>
			            </td>
			        </tr>

					<?php
				} 
			} else {
					?>
			        <tr>
			            <td colspan="2">
			                <img id="uploadPreview1" class="img_slide" alt="" /><br />
							<input id="uploadImage1" type="file" name="image_slider[]" style="display:none;" onchange="PreviewImage(1);" />
							
							<button style="float:left;" onclick="choose_new_image(1)" type="button" class="btn btn-defalt">Chọn hình</button>
							<button id="reset_old_image1" onclick="reset_image(1)" type="button" style="display:none; float:left; margin-left:10px;" class="btn btn-warning">Xóa</button>
			            </td>
			            <td><textarea name="des_slider[]" id="" class="form-control" rows="3"></textarea></td>
			            <td>
			                <button type="button" class="delete_add_more_image btn btn-xs btn-default">Xóa</button>
			            </td>
			        </tr>
					<?php
				}
		 ?>


	    </tbody>
	</table>
	    	<input style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_slider_btn" value="Lưu lại">

	    	<a style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="javascript:history.go(-1)" role="button">Hủy</a>
    <button style="margin-bottom:200px; float:left;" onclick="add_more_slide()" type="button" class="btn btn-info">Thêm nữa</button>  
</form>


<script type="text/javascript">
    function PreviewImage(no) {
    	$('#reset_old_image'+no).css('display', 'block');

        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage"+no).files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreview"+no).src = oFREvent.target.result;
        };
    }

    function reset_image (no) {
    	$('#uploadPreview'+no).attr('src', '');
    	$('#reset_old_image'+no).css('display', 'none');
    }

    function choose_new_image (no) {
    	$("#uploadImage"+no).click();
    }
</script>