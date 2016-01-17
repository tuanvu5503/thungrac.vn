<?php 


function trim_input($data) {
	$data = trim($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function isImage($tmp_name)
{
	var_dump($tmp_name); die;
	$allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
	$detectedType = exif_imagetype($tmp_name);
	$rs = in_array($detectedType, $allowedTypes);
	return $rs;
}