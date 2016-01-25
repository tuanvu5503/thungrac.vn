<?php 

	function set_notice($status_name, $status, $content, $alert_time=7000) {
		$data['status'] = $status;
		$data['content'] = $content;
		$data['alert_time'] = $alert_time;
		
		$CI =& get_instance();
		$CI->session->set_flashdata($status_name, $data);
	}

?>
