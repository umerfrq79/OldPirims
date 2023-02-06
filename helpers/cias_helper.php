<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = 'sendmail'; // smtp
        $config['mailpath'] = '/usr/sbin/sendmail'; //

        // final working
        // $config['smtp_host'] = 'webmail.dra.gov.pk';
        // $config['smtp_port'] = '25';
        // $config['smtp_user'] = 'pirims@dra.gov.pk';
        // $config['smtp_pass'] = 'aj979Mx&';
        // $config['smtp_auth'] = TRUE;
        // $config['smtp_crypto'] = 'no';
        // final working

        //$config['timeout'] = '7';
        //$config['smtp_crypto'] = 'ssl';
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = 'html';
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}
if(!function_exists('setTestProtocol'))
{
    function setTestProtocol()
    {
        $CI = &get_instance();

        $CI->load->library('email');
/*
        $config['protocol'] = 'smtp'; // smtp
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'covidpcr8@gmail.com';
        $config['smtp_pass'] = 'Admin@123';
*/
        //$config['mailpath'] = '/usr/sbin/sendmail'; //
        //$config['timeout'] = '7';
        //$config['smtp_crypto'] = 'ssl';

        // Working Configurations
         $config['protocol'] = 'smtp'; // smtp
         $config['smtp_host'] = 'webmail.dra.gov.pk';
         $config['smtp_port'] = '25';
         $config['smtp_user'] = 'pirims@dra.gov.pk';
         $config['smtp_pass'] = 'aj979Mx&';
         $config['smtp_auth'] = TRUE;
         $config['smtp_crypto'] = 'no';
         $config['charset'] = 'UTF-8';
         $config['mailtype'] = 'html';
         $config['newline'] = "\r\n";

        $CI->email->initialize($config);

        return $CI;
    }
}

function emailSend($detail)
{
    $data['data'] = $detail;

    $CI = setTestProtocol();

    $CI->email->from('pirims@dra.gov.pk');
    $CI->email->subject($detail['subject']);
    $CI->email->message($CI->load->view('email/mailTemplate', $data, TRUE));
    $CI->email->to($detail['email']);
    $status = $CI->email->send();

    return $status;
}

function mailSend($detail)
{
    $data['data'] = $detail;
        
    $CI = setProtocol();        
    
    $CI->email->from('danial212k@gmail.com', $detail['from']);
    $CI->email->subject($detail['subject']);
    $CI->email->message($CI->load->view('email/mailTemplate', $data, TRUE));
    $CI->email->to($detail['email']);
    $status = $CI->email->send();
    
    return $status;

    // $to = 'danial212k@gmail.com';
    // $subject = 'TEST!';
    // $message = 'some message';
    // mail($to, $subject, $message);
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

?>