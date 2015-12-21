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
            url: 'del_account',
            type: 'POST',
            dataType: 'json',
            data: 
            {
                del_id: del_id
            },
            success: function(msg){
                if (msg.status)
                {
                    $.cookie('success','Xóa tài khoản '+msg.username+' thành công');
                    setAlert('success');
                    $("tr#"+del_id).addClass('remove');
                } else {
                    $.cookie('failed','Xóa tài khoản '+msg.username+' thất bại!');
                    setAlert('failed');
                } 
            }
        });
		
	});
	/*=============================== DELETE BLOCK	===============================*/

    setAlert('success');
    setAlert('failed');
});
