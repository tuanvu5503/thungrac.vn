const SUCCESS_STATUS = 1;
const FAILED_STATUS = 0;
//========================== FUNCTION DELETE: START ========================== 
function delete_modal (del_url, del_id, function_callback) {
	bootbox.confirm({
	    title: "<div style='color:red;'><i style='color:red;' class='fa fa-exclamation-triangle'></i> Chú ý</div>",
	    message: "Bạn có chắc chắn muốn xóa không?",
	    size: 'small',
	    buttons: {
	        cancel: {
	            label: "Không",
	            className: "btn-default pull-right button_of_delete_modal"
	        },
	        confirm: {
	            label: "Đồng ý",
	            className: "btn-danger pull-right button_of_delete_modal"
	        }
	    },
	    callback: function(result) {
	    	if (result) {
		        $.ajax({
					url: del_url,
					type: 'POST',
					dataType: 'json',
					data: 
					{
						del_id: del_id
					},
					success: function(rs){
						if (rs.mess != '') {
							set_notice(rs.status, rs.mess, 7000);
						}
						if(rs.status == SUCCESS_STATUS) {
							if (typeof function_callback != 'undefined') {
								window[function_callback](del_id); 
							}
						}
					}
				});
	    	}
	    }
	});
}

//========================== FUNCTION DELETE: END ========================== 

//========================== FUNCTION SHOW NOTICE: START ========================== 
function set_notice(status, mess, time) {
	var mess_code = '';
	if (typeof mess == 'object') {
		for (var val in mess) {
			mess_code = mess_code + mess[val] + '<br>';
		}
	} else {
		mess_code = mess;
	}

	success_type = '<div style="display:block;  padding-left:300px;" class="show-alert alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="mess">'+mess_code+'</strong></div>';
	failed_type = '<div style="display:block;  padding-left:300px;" class="show-alert alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="mess">'+mess_code+'</strong></div>';
	
	if (status == SUCCESS_STATUS) {
		$("div.ajax_alert").append(success_type);
	} else {
		$("div.ajax_alert").append(failed_type);
	}
	setTimeout(function(){ $('div.show-alert').fadeOut(400, function() {
		$(this).fadeTo(400, 0, function() {
		 	$("div.ajax_alert").html(''); 
		});}
	); }, time);
}
//========================== FUNCTION SHOW NOTICE: END ========================== 

//========================== FUNCTION SHOW NOTICE: START ========================== 
function set_alert(status, title, mess) {
	var mess_code = '';
	if (typeof mess == 'object') {
		for (var val in mess) {
			mess_code = mess_code + mess[val] + '<br>';
		}
	} else {
		mess_code = mess;
	}

	bootbox.alert({
		title: title,
		message: mess_code
	});
	
}
//========================== FUNCTION SHOW NOTICE: END ========================== 

