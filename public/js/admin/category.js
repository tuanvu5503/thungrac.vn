$(document).ready(function() {
	/*=============================== DELETE BLOCK	===============================*/
	$("a.delete").click(function(event) {
		/* Act on the event */
		var id = $(this).data('id');
		$("input#del_id").val(id);
	});
	$("button.delete").click(function(event) {
		$('#modal_delete').modal('hide');
		del_id = $("input#del_id").val();

		$.ajax({
            url: 'del_category',
            type: 'POST',
            dataType: 'json',
            data: 
            {
                del_id: del_id
            },
            success: function(msg){
                if (msg.status)
                {
                    $.cookie('success','Xóa danh mục '+msg.category_name+' thành công!');
					$("tr#"+del_id).addClass('remove');
                    setAlert('success');
                } else {
                    // alert('that bai');
                    $.cookie('failed','Xóa danh mục '+msg.category_name+' thất bại!');
                    setAlert('failed');
                }
            }
        });
		
	});
	/*=============================== DELETE BLOCK	===============================*/

    setAlert('success');

});

