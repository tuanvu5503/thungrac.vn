$(document).ready(function() {
	setAlert('success');
	document.cookie = 'success' + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';



	$("a.delete").click(function(event) {
		var id = $(this).data('id');
		$("input#del_id").val(id);
	});

	$("button.delete").click(function(event) {
		$('#modal_delete').modal('hide');
		del_id = $("input#del_id").val();
		$.ajax({
			url: delete_url,
			type: 'POST',
			dataType: 'json',
			data: 
			{
				del_id: del_id
			},
			success: function(msg){
				if (msg.status)
				{
					set_alert(1,'Xóa sản phẩm '+msg.product_name+' thành công');
					$("tr#"+del_id).addClass('remove');
				} else {
					set_alert(0, 'Xóa sản phẩm '+msg.product_name+' thất bại');
				}
			}
		});

	});
});
