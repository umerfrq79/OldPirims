<?php
    
class AuthCompany extends CI_Controller {
     
    public $api_url;
	
	public function __construct(){
            $this->api_url = "https://e.dra.gov.pk/api/user/";
    }
	
	public function companyLogin($email, $password){
		pre($api_url);
		pre($email);
		pre($password);
		die();
	}
    public function simleExample()
    {
        /* API URL */
        $url = 'http://www.mysite.com/api';
             
        /* Init cURL resource */
        $ch = curl_init($url);
            
        /* Array Parameter Data */
        $data = ['name'=>'Hardik', 'email'=>'itsolutionstuff@gmail.com'];
            
        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           
        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type:application/json',
                    'App-Key: 123456',
                    'App-Secret: 1233'
                ));
            
        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
        /* execute request */
        $result = curl_exec($ch);
           
        /* close cURL resource */
        curl_close($ch);
    }
}