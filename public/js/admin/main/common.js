const SUCCESS_STATUS = 1;
const FAILED_STATUS = 0;

//========================== FUNCTION DELETE: START ========================== 
function delete_modal (del_url, del_id, callback='') {
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
	            label: "Xóa ngay",
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
						set_alert(rs.status, rs.mess);
						if (callback != '') {
							window[callback](del_id); 
						}
					}
				});
	    	}
	    }
	});
}

//========================== FUNCTION DELETE: END ========================== 

//========================== FUNCTION SHOW NOTICE: START ========================== 
function set_alert(status, mess) {
	success_type = '<div style="display:block;" class="show-alert text-center alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="mess">'+mess+'</strong></div>';
	failed_type = '<div style="display:block;" class="show-alert text-center alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><strong class="mess">'+mess+'</strong></div>';
	
	if (status == SUCCESS_STATUS) {
		$("div.ajax_alert").append(success_type);
	} else {
		$("div.ajax_alert").append(failed_type);
	}
	setTimeout(function(){ $('div.show-alert').fadeOut(400, function() {
		$(this).fadeTo(400, 0, function() {
		 	$("div.ajax_alert").html(''); 
		});}
	); }, 5000);
}
//========================== FUNCTION SHOW NOTICE: END ========================== 

