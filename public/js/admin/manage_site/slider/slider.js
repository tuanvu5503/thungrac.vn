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
     $("#add").append("<tr><td colspan='2'><input type='file' name='add_slide[]'></td><td><textarea name='add_des_slider[]' id='inputAdd_des_slider[]' class='form-control' rows='3'></textarea></td><td><button type='button' class='delete_add_more_image btn btn-xs btn-default'>Xóa</button></td></tr>");
}