<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function send_mail($arr_to_mail, $subject, $message)
{
    $ci = get_instance();
    $ci->load->library('email');
    $config['protocol'] = "smtp";
    $config['smtp_host'] = "ssl://smtp.gmail.com";
    $config['smtp_port'] = "465";
    $config['smtp_user'] = "website.thungrac@gmail.com"; 
    $config['smtp_pass'] = "07061991";
    $config['charset'] = "utf-8";
    $config['mailtype'] = "html";
    $config['newline'] = "\r\n";

    $ci->email->initialize($config);

    $ci->email->from('website.thungrac@gmail.com', 'Website-thungrac');
    $ci->email->to($arr_to_mail);
    $ci->email->reply_to('website.thungrac@gmail.com', 'Website-Thungrac');
    $ci->email->subject($subject);
    $ci->email->message($message);
    
    return $ci->email->send();
}