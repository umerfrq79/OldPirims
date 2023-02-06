<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class apiModel extends CI_Model {

    var $client_service = "frontend-client";
    var $auth_key       = "simplerestapi";

    /**
     * Get header Authorization
     * */
    function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * get access token from header
     * */
    function getBearerToken() {
        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $matches[1];
            }
        }
        return null;
    }
    public function check_auth_client(){
        $token = $this->getBearerToken();
        $q  = $this->db->select('*')->from('tbls_api')->where('isDeleted',0)->where('token',$token)->where('expireDateTime >',date('Y-m-d H:i:s'))->get()->row();
        if($q){
            return true;
        }else{
            return false;
        }
    }

    public function login($username,$password)
    {
        $q  = $this->db->select('password,id,userName,email')->from('tbls_user')->where('email',$username)->get()->row();

        if($q == ""){
            return array('status' => 204, 'message' => "Wrong email or password.");
        } else {
            $hashed_password = $q->password;
            $id              = $q->id;
            $uName = $q->userName;
            //echo $hashed_password ." ".$password;
            //exit;
            if (hash_equals($hashed_password, crypt($password, $hashed_password))) {
                $last_login = date('Y-m-d H:i:s');
                $token = getHashedPassword(rand());
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->trans_start();
                //$this->db->where('id',$id)->update('users',array('last_login' => $last_login));
                $this->db->insert('tbls_api',array('userId' => $id,'token' => $token,'expireDateTime' => $expired_at));
                if ($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                    return array('status' => 500,'message' => 'Internal server error.');
                } else {
                    $this->db->trans_commit();
                    return array('status' => 200,'message' => 'Successfully login.','data'=>array('id' => $id,'user'=>$uName, 'token' => $token));
                }
            } else {
                return array('status' => 204,'message' => 'Wrong password.');
            }
        }
    }

    public function logout()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        //$this->db->where('userId',$users_id)->where('token',$token)->delete('tbls_api');
        $this->db->where('userId',$users_id)->where('token',$token)->update('tbls_api',array('isDeleted' => 1));
        return array('status' => 200,'message' => 'Successfully logout.');
    }

    public function auth()
    {
        $users_id  = $this->input->get_request_header('User-ID', TRUE);
        $token     = $this->input->get_request_header('Authorization', TRUE);
        $q  = $this->db->select('expireDateTime, isDeleted')->from('tbls_api')->where('userId',$users_id)->where('token',$token)->get()->row();
        if($q == ""){
            return json_output(401,array('status' => 401,'message' => 'Unauthorized.'));
        } else {
            if($q->expireDateTime < date('Y-m-d H:i:s') || $q->isDeleted == 1){
                return json_output(401,array('status' => 401,'message' => 'Your session has been expired.'));
            } else {
                $updated_at = date('Y-m-d H:i:s');
                $expired_at = date("Y-m-d H:i:s", strtotime('+12 hours'));
                $this->db->where('userId',$users_id)->where('token',$token)->update('tbls_api',array('expireDateTime' => $expired_at));
                return array('status' => 200,'message' => 'Authorized.');
            }
        }
    }


    public function book_all_data()
    {
        return $this->db->select('id,title,author')->from('books')->order_by('id','desc')->get()->result();
    }

    public function book_detail_data($id)
    {
        return $this->db->select('id,title,author')->from('books')->where('id',$id)->order_by('id','desc')->get()->row();
    }

    public function book_create_data($data)
    {
        $this->db->insert('books',$data);
        return array('status' => 201,'message' => 'Data has been created.');
    }

    public function book_update_data($id,$data)
    {
        $this->db->where('id',$id)->update('books',$data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }

    public function book_delete_data($id)
    {
        //$this->db->where('id',$id)->delete('books');
        $this->db->where('id',$id)->update('books',$data);
        return array('status' => 200,'message' => 'Data has been deleted.');
    }
    public function registrationRecord($id){
        $this->db->select('BaseTbl.id,BaseTbl.registrationNo,BaseTbl.approvedName,BaseTbl.issueDateManual as issueDate,BaseTbl.validTill, BaseTbl.labelClaim,BaseTbl.testingmethod as testingMethod, BaseTbl.companyName as registrationHolder,Pharmacopeia.pharmacopeia,BaseTbl.registrationStatus');
        $this->db->join('tbl_pharmacopeia AS Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.registrationNo', $id);
        $query = $this->db->get();
        $registrationRecord =  $query->result();
        return $registrationRecord;
    }

}
