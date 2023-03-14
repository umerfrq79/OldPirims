<?php

defined('BASEPATH') or exit('No direct script access allowed');

class RegModel extends CI_Model{

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        
         }

    public function get_index($id=0)
    {
             $this->db->select('BaseTbl.approvedName, BaseTbl.registrationNo, BaseTbl.testingmethod, BaseTbl.pharmacopeiaId, BaseTbl.mfgName, BaseTbl.mfgAddress, BaseTbl.companyName, BaseTbl.companyAddress');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.id', $id);
                $events = $this->db->get();
                $data_events = array();
            foreach ($events->result() as $r) {
                            $data_events[] = array(
                                "Brand Name" => $r->approvedName,
                                "Registration No" => $r->registrationNo,
                                "Testing Method" => $r->testingmethod,
                                "Manufacturer Name" => $r->mfgName,
                                "Manufacturer Address" => $r->mfgAddress,
                                "Company Name" => $r->companyName,
                                "Company Address" => $r->companyAddress

                            );
                }
        echo json_encode(array("events" => $data_events));
    }


 }
 ?>
