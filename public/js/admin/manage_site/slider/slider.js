$(document).ready(function() {
	$('#add').on("click","button.xoaanh", function(event) {
      	id = $(this).attr('id');
      	$(this).closest('tr').remove();
		$("div#hidden").append("<input value='"+id+"' type='hidden' name='delete_slide[]'>");
   });

	$('#add').on("click","button.delete_add_more_image", function(event) {
      $(this).closest('tr').remove();
	});
});

function add_more_slide () {

  var now = new Date().getTime() / 1000;
  var random_id = parseInt(now + Math.random());
  console.log(random_id);

     // $("#add").append("<tr><td colspan='2'><input type='file' name='add_slide[]'></td><td><textarea name='add_des_slider[]' id='inputAdd_des_slider[]' class='form-control' rows='3'></textarea></td><td><button type='button' class='delete_add_more_image btn btn-xs btn-default'>Xóa</button></td></tr>");
    tmp = '<tr><td colspan="2"><img id="uploadPreview'+random_id+'" class="img_slide" alt="" /><br /><input id="uploadImage'+random_id+'" type="file" name="image_slider[]" style="display:none;" onchange="PreviewImage('+random_id+');" /><button style="float:left;" onclick="choose_new_image('+random_id+')" type="button" class="btn btn-defalt">Chọn hình</button><button id="reset_old_image'+random_id+'" onclick="reset_image('+random_id+')" type="button" style="display:none; float:left; margin-left:10px;" class="btn btn-warning">Xóa</button></td><td><textarea name="des_slider[]" id="" class="form-control" rows="3"></textarea></td><td><button type="button" class="delete_add_more_image btn btn-xs btn-default">Xóa</button></td></tr><tr>';
    
    $("#add").append(tmp);
}