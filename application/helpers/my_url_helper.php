<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$CI =& get_instance();
$CI->load->helper('convert');

function get_id_in_url($url)
{
	return (int) substr( strrchr($url, '-'), 1);
}

function name_in_url($string)
{
    $string = strtolower(utf8convert($string));
    $string = str_replace(' ', '-', $string);
    return $string;
}