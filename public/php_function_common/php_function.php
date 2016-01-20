<?php 

	function set_notice($status, $content) {
		$data['status'] = $status;
		$data['content'] = $content;
		
		$CI =& get_instance();
		$CI->session->set_flashdata('status', $data);
	}

?>
