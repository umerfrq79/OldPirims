<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ApiAuth extends CI_Controller {

    public function test(){
        json_output(200,'Welcome');
    }
	public function login()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
            //$this->apiModel->check_auth_client();

            $params = $_REQUEST;


                $username = $params['username'];
		        $password = $params['password'];
            json_output(400,array('status' => 400,'message' => 'Request.','Data'=>$params));

		        	
		        $response = $this->apiModel->login($username,$password);
				//echo $response;
            json_output($response['status'],$response);
		}
	}

	public function logout()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if($method != 'POST'){
			json_output(400,array('status' => 400,'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->apiModel->check_auth_client();
			if($check_auth_client == true){
		        $response = $this->apiModel->logout();
				json_output($response['status'],$response);
			}
		}
	}
	
}
