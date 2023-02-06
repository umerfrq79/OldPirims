<?php
    
class AuthCompanyModel extends CI_Model {
     
    private $api_url; 
	
	public function __construct(){
		parent::__construct();
        $this->api_url = "https://e.dra.gov.pk/api/user/";
    }
	
	public function companyLogin($email, $password){
		
		$endpoint = $this->api_url.'auth/login';
        $ch = curl_init($endpoint);
        // parameters
        $data = ['email'=>$email, 'password'=>$password];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        //Header
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type:application/json',
                    'Accept:application/json'
                ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        /*if($email == 'test@test.com.pk'){
            pre($data);
            pre($result);
            echo "method";
            die();
        }*/
        curl_close($ch);
		return json_decode($result);
	}
    public function verifyChallan($invoiceNumber){
        $endpoint = $this->api_url.'fee/query';
        $ch = curl_init($endpoint);
        // parameters
        $data = ['invoiceNumber'=>$invoiceNumber];
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        //Header
        $authorization = '';
        if($this->session->userdata('authorizationType') == "Bearer Token"){
            $authorization = 'Authorization: Bearer '.$this->session->userdata('token');
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type:application/json',
            'Accept:application/json',
            $authorization
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}