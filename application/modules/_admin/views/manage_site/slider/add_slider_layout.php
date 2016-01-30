<script src="<?php echo base_url().'public/js/admin/manage_site/slider/slider.js'?>"></script>
<style type="text/css">
	.img_slide{
		width: 200px;
	}
</style>

<legend style="margin-top:50px; margin-bottom:30px; text-align:center;">THÊM HÌNH ẢNH VÀO SLIDER</legend>

<form action="<?php echo base_url().'index.php/_admin/manage_site/slider/edit_slider'; ?>" method="POST" enctype="multipart/form-data">
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
	        <tr>
	            <td colspan="2">
	                <img id="uploadPreview1" name="add_slider[]" class="img_slide" alt="" /><br />
					<input id="uploadImage1" type="file" name="image_slider" style="display:none;" onchange="PreviewImage(1);" />
					
					<button style="float:left;" onclick="choose_new_image()" type="button" class="btn btn-defalt">Chọn hình</button>
					<button id="reset_old_image" onclick="reset_image()" type="button" style="display:none; float:left; margin-left:10px;" class="btn btn-info">Khôi phục</button>
	            </td>
	            <td><textarea name="add_des_slider[]" id="inputAdd_des_slider[]" class="form-control" rows="3"></textarea></td>
	            <td>
	                <button type="button" class="delete_add_more_image btn btn-xs btn-default">Xóa</button>
	            </td>
	        </tr>
	        <tr>
	    </tbody>
	</table>
	    	<input style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:0px;" class="btn btn-primary" type="submit" name="edit_slider_btn" value="Lưu lại">

	    	<a style="margin-bottom:300px; margin-top:50px; width:100px; float:right; margin-right:10px;" class="btn btn-danger" href="javascript:history.go(-1)" role="button">Hủy</a>
    <button style="margin-bottom:200px; float:left;" onclick="add_more_slide()" type="button" class="btn btn-info">Thêm nữa</button>  
</form>


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