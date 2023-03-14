<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';     


class RegController extends REST_Controller
{
        public function __construct()
        {
            header('Access-Control-Allow-Origin: *');
            header("Access-Control-Allow-Methods: GET");
            header("Access-Control-Allow-Headers: X-API-KEY, Origin,X-Requested-With, Content-Type, Accept, Access-Control-Requested-Method, Authorization");
            header('Content-type: application/json');
            parent::__construct();
            $this->load->model(array("RegModel"));
          }

        public function index_get($id = 0)
        {

          if(!empty($id))
          {
            $regs = $this->RegModel->get_index($id);
            print_r($regs);
          }
          else{
            $this->response([
                'status'=> false,
              'message'=>'please provide id'
            ]);
          }
        }

       
}
?>