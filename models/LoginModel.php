<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class loginModel extends CI_Model {

    function __construct()
    {
         parent::__construct();
         $this->db->query("SET time_zone='+05:00'");
         //$this->db->query("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
    }

	function loginMe($email, $password)
    {
        $this->db->select('BaseTbl.id, BaseTbl.roleId, BaseTbl.email, BaseTbl.userName, BaseTbl.password, BaseTbl.profilepic, BaseTbl.startDate, BaseTbl.endDate, BaseTbl.resumeDate, Country.id as countryId, Country.countryName, Country.countryFlag, BaseTbl.wallpaper, BaseTbl.status, BaseTbl.userUniqueNo, Role.id as roleId, Role.department, Role.designation, Company.id as companyId, Company.companyName, Company.companyCategory, Company.companySubCategory, Company.companyUserType, Company.companyEmail, Company.status as companyStatus, Company.companyUniqueNo');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role', 'Role.id = BaseTbl.roleId','left');
        $this->db->join('tbls_country as Country', 'Country.id = BaseTbl.countryId','left');
        $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        //$this->db->where('BaseTbl.isOnline', 0);
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function loginMe1($email, $password)
    {
        $this->db->select('BaseTbl.id, BaseTbl.roleId, BaseTbl.email, BaseTbl.userName, BaseTbl.password, BaseTbl.profilepic, BaseTbl.startDate, BaseTbl.endDate, BaseTbl.resumeDate, Country.id as countryId, Country.countryName, Country.countryFlag, BaseTbl.wallpaper, BaseTbl.status, BaseTbl.userUniqueNo, Role.id as roleId, Role.department, Role.designation, Company.id as companyId, Company.companyCategory, Company.companySubCategory, Company.companyUserType, Company.companyEmail, Company.status as companyStatus, Company.companyUniqueNo');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role', 'Role.id = BaseTbl.roleId','left');
        $this->db->join('tbls_country as Country', 'Country.id = BaseTbl.countryId','left');
        $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId','left');        
        $this->db->where('BaseTbl.email', $email);
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        
        $user = $query->result();
        
        if(!empty($user)){
            if(verifyHashedPassword($password, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }

    function checkEmailExists($email)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.email', $email);
        $query = $this->db->get();
        
        return $query->result();
    }
	function checkCompanyExists($companyUniqueNo)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.companyUniqueNo', $companyUniqueNo);
        $query = $this->db->get();
        return $query->result();
    }
	function checkUserExists($userUniqueNo)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.userUniqueNo', $userUniqueNo);
        $query = $this->db->get();
        return $query->result();
    }

    function resetPasswordUser($data)
    {
        $result = $this->db->insert('tbl_reset_password', $data);

        if($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function checkActivationDetails($email, $activation_id)
    {
        $this->db->select('id');
        $this->db->from('tbl_reset_password');
        $this->db->where('email', $email);
        $this->db->where('activation_id', $activation_id);
        $query = $this->db->get();
        return $query->num_rows;
    }
    function verifyPasswordToken($id, $token)
    {
        $this->db->select('id');
        $this->db->from('tbls_user');
        $this->db->where('id', $id);
        $this->db->where('password_resetToken', $token);
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
        //return $query;
        return $query->num_rows();
    }

    function createPasswordToken($id, $token)
    {
        $this->db->where('id', $id);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbls_user', array('password_resetToken'=>$token));
    }

    function createPasswordUser($email, $password)
    {
        $this->db->where('email', $email);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', array('password'=>getHashedPassword($password)));
        $this->db->delete('tbl_reset_password', array('email'=>$email));
    }
    function getDrugDetails($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.registrationStatus', 'Provisionally Active');
        $this->db->where('BaseTbl.productStatus', 3);
        $this->db->where('BaseTbl.id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function filterDrugsRegNo($regno, $public = true)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        if($public){
            $this->db->where('BaseTbl.isPublic', 1);
        }
        //$this->db->where('BaseTbl.registrationStatus', 'Provisionally Active');
        //$this->db->where('BaseTbl.productStatus', 3);
        $this->db->where('BaseTbl.registrationNo', $regno);
        $this->db->limit(100);
        //echo $this->db->get_compiled_select(); // before $this->db->get();

        $query = $this->db->get();
        return $query->result();
    }
    function filterDrugsCompany($accountid, $public = true)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        if($public){
            $this->db->where('BaseTbl.isPublic', 1);
        }
        //$this->db->where('BaseTbl.registrationStatus', 'Provisionally Active');
        //$this->db->where('BaseTbl.productStatus', 3);
        $this->db->where('BaseTbl.companyAccountId', (int)$accountid);
        //$this->db->limit(100);
        //echo $this->db->get_compiled_select(); // before $this->db->get();

        $query = $this->db->get();
        return $query->result();
    }
    function filterDrugsName($name,$public = true)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        if($public){
            $this->db->where('BaseTbl.isPublic', 1);
        }
        //$this->db->where('BaseTbl.registrationStatus', 'Provisionally Active');
        //$this->db->where('BaseTbl.productStatus', 3);
        $this->db->like('BaseTbl.approvedName', $name);
        $this->db->limit(100);

        //echo $this->db->get_compiled_select(); // before $this->db->get();

        $query = $this->db->get();
        return $query->result();
    }
    function filterDrugsComposition($generic,$public = true)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_registrationinn as INN','INN.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        if($public){
            $this->db->where('BaseTbl.isPublic', 1);
        }
        //$this->db->where('BaseTbl.registrationStatus', 'Provisionally Active');
        //$this->db->where('BaseTbl.productStatus', 3);
        $this->db->like('INN.innManual', $generic);
        $this->db->limit(1000);
        //echo $this->db->get_compiled_select(); // before $this->db->get();

        $query = $this->db->get();
        return $query->result();
    }

    function onlineStatusUpdate($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('tbls_user', $data);
    }

    function seenByUpdate($id, $data, $table)
    {
        $this->db->set('seenBy', 'concat(seenBy,\','.$data.'\')', FALSE);
        $this->db->where('id', $id);
        $this->db->update($table);
    }

    function inUseUpdate($id, $data, $table)
    {
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    function alertSeenByUpdate($id, $data, $table)
    {
        $this->db->set('alertSeenBy', 'concat(alertSeenBy,\','.$data.'\')', FALSE);
        $this->db->where('id', $id);
        $this->db->update($table);
    }

    function auditLogSave($data)
    {
        $this->db->insert('tbls_auditlog', $data);
        $insert_id = $this->db->insert_id();
        
        return $insert_id;
    }

    function recordAjaxCustomQuery($customQuery)
    {
        $this->db->query($customQuery);

        $thequery=$this->db->last_query();
        $this->db->insert('tbls_auditlog', array('userId'=>$this->userId, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery));
    }

    function recordAjaxDelete($idColumn, $id, $table)
    {
        $this->db->where($idColumn, $id);
        $this->db->delete($table);

        $thequery=$this->db->last_query();
        $this->db->insert('tbls_auditlog', array('userId'=>$this->userId, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($idColumn)));
    }

    function recordAjaxSave($data, $table)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        $thequery=$this->db->last_query();
		if(isset($this->userId)){
			$this->db->insert('tbls_auditlog', array('userId'=>$this->userId, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
		}else{
			$this->db->insert('tbls_auditlog', array('dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
		}
        
        return $insert_id;
    }

    function recordAjaxUpdate($idColumn, $id, $data, $table)
    {
        $this->db->where($idColumn, $id);
        $this->db->update($table, $data);
        $update_id = $this->db->affected_rows();

        $thequery=$this->db->last_query();
		if(isset($this->userId)){
			$this->db->insert('tbls_auditlog', array('userId'=>$this->userId, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
		}else{
			$this->db->insert('tbls_auditlog', array( 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
		}


        return $update_id;
    }

    //########################## AJAX GET QUERIES ##########################

    function pageAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_page as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.visibleinlist', 1);
        $this->db->order_by('BaseTbl.friendlyName');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="0">Select Module</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->friendlyName.'</option>';
        }
        return $output;
    }

    function stateAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_state as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.masterId', $data);
        $query = $this->db->get();

        $output = '';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->stateName.'</option>';
        }
        return $output;
    }

    function alertAjaxGet()
    {
        $this->db->select('BaseTbl.duration');
        $this->db->from('tbls_alert as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->limit(1);
        $this->db->order_by('BaseTbl.id','asc');
        $query1 = $this->db->get();
        $count = $query1->num_rows();
        $output = '';
        if($count > 0){

            foreach($query1->result() as $record1)
            {
               $duration = $record1->duration;
            }

            $this->db->select('BaseTbl.*');
            $this->db->from('tbls_alert as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.status', 'Active');
            if($duration == 'now'){
                $this->db->where('STR_TO_DATE(dateTime,"%d-%b-%y %H:%i") < NOW()');
            }
            else{
                $this->db->where('STR_TO_DATE(dateTime,"%d-%b-%y %H:%i") + INTERVAL '.$duration.' < NOW()');
            }
            $this->db->limit(1);
            $this->db->order_by('BaseTbl.id','asc');
            $query = $this->db->get();

            $output = '';
            foreach($query->result() as $record)
            {
               if($record->type == 'Broadcast'){
                    $allNotified = '';
                    $this->db->select('BaseTbl.id');
                    $this->db->from('tbls_user as BaseTbl');
                    $this->db->where('BaseTbl.isDeleted', 0);
                    $this->db->where('BaseTbl.status', 'Active');
                    $this->db->order_by('BaseTbl.id','asc');
                    $query0 = $this->db->get();

                    foreach($query0->result() as $record0)
                    {
                        $seenBy = explode(",",$record->alertSeenBy);
                        if(in_array($record0->id, $seenBy)){
                         $allNotified = 'Yes';
                        }
                        else{
                            $allNotified = 'No';
                            break;
                        }
                    }
                    if($allNotified == 'Yes'){
                        $this->recordAjaxUpdate('id', $record->id, array('status' => 'Inactive', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)), 'tbls_alert');
                        $seenBy = explode(",",$record->alertSeenBy);
                        if(!(in_array($this->userId, $seenBy))){
                            $this->alertSeenByUpdate($record->id, $this->userId, 'tbls_alert');
                        }
                   }
                   else{
                        $output = $record->alertName .'_'. $record->description;
                        $this->recordAjaxUpdate('id', $record->id, array('updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)), 'tbls_alert');
                        $seenBy = explode(",",$record->alertSeenBy);
                        if(!(in_array($this->userId, $seenBy))){
                            $this->alertSeenByUpdate($record->id, $this->userId, 'tbls_alert');
                        }
                   }
               }
               if($record->type == 'User'){
                    $userNotified = '';
                    $this->db->select('BaseTbl.id');
                    $this->db->from('tbls_user as BaseTbl');
                    $this->db->where('BaseTbl.isDeleted', 0);
                    $this->db->where('BaseTbl.status', 'Active');
                    $this->db->where('BaseTbl.id', $this->userId);
                    $query0 = $this->db->get();

                    foreach($query0->result() as $record0)
                    {
                        $alertRecepients = explode(",",$record->recepients);
                        $seenBy = explode(",",$record->alertSeenBy);
                        //if(in_array($this->userId, $alertRecepients) && !(in_array($this->userId, $seenBy))){
                        if(in_array($this->userId, $alertRecepients)){
                            $userNotified = 'Yes';
                            break;
                        }
                        else{
                            $userNotified = 'No';
                        }
                    }
                    if($userNotified == 'Yes'){
                        $this->recordAjaxUpdate('id', $record->id, array('status' => 'Inactive', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)), 'tbls_alert');
                        $this->alertSeenByUpdate($record->id, $this->userId, 'tbls_alert');
                        $output = $record->alertName .'_'. $record->description;
                   }
               }
            }
        }
        return $output;
    }

    function reportTypeDetailAjaxGet($data)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_reporttype as BaseTbl');
        //$this->db->join('tbls_reporttype as ReportType','ReportType.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.reportType', $data);
        $this->db->where('BaseTbl.department', $this->department);
        //$this->db->order_by('BaseTbl.sorting','asc');
        $query = $this->db->get();

        $output = '';
        foreach($query->result() as $record)
        {
            $output .= 'RRR - '. $record->filters .'%';
        }
        return $output;
    }

    //########################## AJAX GET QUERIES ##########################

    //########################## MAIN GET QUERIES ##########################

    function systemInfoGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_system as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pageTitleGet($data)
    {
        $this->db->select('BaseTbl.id, BaseTbl.friendlyName, BaseTbl.url, BaseTbl.icon');
        $this->db->from('tbls_page as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.url', $data);
        $query = $this->db->get();
        
        return $query->result();
    }

    function rolePageHeaderGet($data)
    {
        $this->db->select('BaseTbl.roleId, Page.id, Page.url, Page.defaultAction, Page.friendlyName, Page.pageName, Page.icon, Page.parentId, Page.head, Page.myHead, (SELECT COUNT(tbls_page.id) FROM tbls_page LEFT JOIN tbls_pagedetail ON tbls_pagedetail.masterId = tbls_page.id WHERE tbls_page.parentId = Page.id AND tbls_pagedetail.roleId = '.$data.' AND tbls_page.isDeleted = "0" AND tbls_page.status = "Active" AND tbls_page.visible = "1" AND tbls_pagedetail.recordLookup = "1" AND tbls_page.sorting > Page.sorting) as children');
        $this->db->from('tbls_pagedetail as BaseTbl');
        $this->db->join('tbls_page as Page','Page.id = BaseTbl.masterId','left');
        $this->db->where('Page.isDeleted', 0);
        $this->db->where('Page.status', 'Active');
        $this->db->where('BaseTbl.roleId', $data);
        $this->db->where('Page.visible', 1);
        $this->db->where('BaseTbl.recordLookup', 1);
        $this->db->order_by('Page.sorting','asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function rolePageGet($data)
    {
        $this->db->select('BaseTbl.*, Page.id, Page.url, Page.friendlyName, Page.pageName, Page.icon');
        $this->db->from('tbls_pagedetail as BaseTbl');
        $this->db->join('tbls_page as Page','Page.id = BaseTbl.masterId','left');
        $this->db->where('Page.isDeleted', 0);
        $this->db->where('Page.status', 'Active');
        $this->db->where('BaseTbl.roleId', $data);
        $this->db->order_by('Page.sorting','asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pageGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_page as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.visibleinlist', 1);
        $this->db->order_by('BaseTbl.friendlyName');
        $query = $this->db->get();
        
        return $query->result();
    }

    function unseenRecordCountGet($moduleName, $roleId)
    {
        if($moduleName == 'New License'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.licenseStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Licensing Director
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '10'){ // Licensing Additional Director
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '14'){ // Licensing Deputy Director
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '18'){ // Licensing Assistant Director
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '38'){ // Licensing Assigning Officer
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '43'){ // Licensing Board Secretary
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
                    $this->db->where('BaseTbl.licenseStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'License Renewal'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.renewalStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Licensing Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '10'){ // Licensing Additional Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '14'){ // Licensing Deputy Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '18'){ // Licensing Assistant Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '38'){ // Licensing Assigning Officer
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '43'){ // Licensing Board Secretary
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'License Variance'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.postchangeStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Licensing Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '10'){ // Licensing Additional Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '14'){ // Licensing Deputy Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '18'){ // Licensing Assistant Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '38'){ // Licensing Assigning Officer
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '43'){ // Licensing Board Secretary
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'New Registration'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('License.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.registrationStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Registration Director
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '10'){ // Registration Additional Director
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '14'){ // Registration Deputy Director
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '18'){ // Registration Assistant Director
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '38'){ // Registration Assigning Officer
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '43'){ // Registration Board Secretary
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '45'){ // Registration Pricing User
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
                    $this->db->where('BaseTbl.registrationStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'Registration Renewal'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('License.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.renewalStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Registration Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '10'){ // Registration Additional Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '14'){ // Registration Deputy Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '18'){ // Registration Assistant Director
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '38'){ // Registration Assigning Officer
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '43'){ // Registration Board Secretary
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '45'){ // Registration Pricing User
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
                    $this->db->where('BaseTbl.renewalStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'Registration Variance'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('License.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->where_in('BaseTbl.postchangeStatus', array('Draft'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){ // Registration Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '10'){ // Registration Additional Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '14'){ // Registration Deputy Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '18'){ // Registration Assistant Director
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '38'){ // Registration Assigning Officer
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '43'){ // Registration Board Secretary
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '45'){ // Registration Pricing User
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
                    $this->db->where('BaseTbl.postchangeStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'Inspection'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_inspection as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.companyId', $this->companyId);
                if($roleId == '26'){ // Company Submission
                    $this->db->group_start();
                        $this->db->group_start();
                            $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                            $this->db->where('BaseTbl.inspectionStatus !=', '');
                            $this->db->where('BaseTbl.sendInspectionScheduleToCompany', 'Yes');
                        $this->db->group_end();
                        $this->db->or_group_start();
                            $this->db->where('BaseTbl.sendInspectionScheduleToCompany', 'No');
                            $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending'));
                            $this->db->where('BaseTbl.inspectionStatus !=', '');
                            $this->db->where('BaseTbl.inspectionStatus', 'CAPA Awaited From Company');
                        $this->db->group_end();
                    $this->db->group_end();
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen, (SELECT tbl_panelpool.userId FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserId');
                $this->db->from('tbl_inspection as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '36'){ // Inspection Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                }
                else if($roleId == '6'){ // Licensing Director
                    $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                }
                else if($roleId == '7'){ // Registration Director
                    $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                }
                else if($roleId == '12'){ // Inspection Additional Director
                    $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                }
                else if($roleId == '37'){ // Inspection Deputy Director
                    $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                    $this->db->having('leadUserId', $this->userId);
                }
                else if($roleId == '16'){ // Inspection FID
                    $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                    $this->db->having('leadUserId', $this->userId);
                }
                else if($roleId == '20'){ // Inspection Assistant Director
                    $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                    $this->db->having('leadUserId', $this->userId);
                }
                else if($roleId == '42'){ // CEO
                    $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                    $this->db->where('BaseTbl.inspectionStatus !=', '');
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        else if($moduleName == 'Batches'){
            $this->db->select('count(*) as unseen');
            $this->db->from('tbl_batch as BaseTbl');
            $this->db->not_like('BaseTbl.seenBy', $this->userId);
            $this->db->group_by('BaseTbl.id');
            $query = $this->db->get();
            
            return $query->result();
        }

        else if($moduleName == 'Query'){
            if($this->roleId == 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_query as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbl_registration as Registration','Registration.id = BaseTbl.masterId','left');
                $this->db->join('tbl_inspection as Inspection','Inspection.id = BaseTbl.masterId','left');
                $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.authorization', 'Granted');
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where('License.createdby', $this->userId);
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('Registration.createdby', $this->userId);
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('Inspection.createdby', $this->userId);
                    $this->db->group_end();
                $this->db->group_end();
                if($roleId == '26'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change', 'Registration', 'Registration Renewal', 'Post Registration Change', 'Inspection'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($this->roleId <> 26){
                $this->db->select('count(*) as unseen');
                $this->db->from('tbl_query as BaseTbl');
                $this->db->not_like('BaseTbl.seenBy', $this->userId);
                $this->db->where('BaseTbl.isDeleted', 0);
                if($roleId == '6'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '10'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '14'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '18'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '38'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '43'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
                }
                else if($roleId == '7'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '11'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '15'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '19'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '39'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '44'){
                    $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
                }
                else if($roleId == '36'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '12'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '37'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '16'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '20'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '40'){
                    $this->db->where('BaseTbl.type', 'Inspection');
                }
                else if($roleId == '42'){
                    $this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change', 'Registration', 'Registration Renewal', 'Post Registration Change', 'Inspection'));
                }
                else{
                    $this->db->where('BaseTbl.id', '0');
                }
                $this->db->group_by('BaseTbl.id');
                $query = $this->db->get();
                
                return $query->result();
            }
        }

        // else if($moduleName == 'Alerts'){
        //     $this->db->select('count(*) as unseen');
        //     $this->db->from('tbl_batch as BaseTbl');
        //     $this->db->not_like('BaseTbl.seenBy', $this->userId);
        //     $query = $this->db->get();
            
        //     return $query->result();
        // }

        else{
            return array();
        }
    }

    function totalRecordCountGet($data)
    {
        $this->db->select('count(*) as total');
        $this->db->from($data);
        $query = $this->db->get();
        
        return $query->result();
    }

    function roleGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_role as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_not_in('BaseTbl.id', array(1));
        $query = $this->db->get();
        
        return $query->result();
    }

    function userGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.roleId', $this->roleId);
        $query = $this->db->get();
        
        return $query->result();
    }

    function countryGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_country as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        
        return $query->result();
    }

    function stateGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_state as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        
        return $query->result();
    }

    function cityGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_city as BaseTbl');
        $this->db->join('tbls_state as State','State.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('State.masterId', 167);
        $this->db->order_by('BaseTbl.cityname', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        
        return $query->result();
    }

    function reportTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_reporttype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.department', $this->department);
        $this->db->where('BaseTbl.visibleinlist', 1);
        $query = $this->db->get();
        
        return $query->result();
    }

    function alertGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_alert as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
		$this->db->where("(BaseTbl.type='Broadcast' OR (BaseTbl.type='User' AND FIND_IN_SET({$this->userId},BaseTbl.recepients) > 0))", NULL, FALSE);
		$this->db->where("(FIND_IN_SET({$this->userId},BaseTbl.alertSeenBy) = 0)", NULL, FALSE);
		//$this->db->where("(BaseTbl.duration='now' OR (BaseTbl.type='User' ))", NULL, FALSE);
		$this->db->order_by('BaseTbl.id', 'DESC');
		$this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    //########################## MAIN GET QUERIES ##########################

    function registerMe($data)
    {
        $this->dateTimeFullFormat = 'd-M-y H:i:s';

        $this->db->insert('tbls_company', $data);
        $insert_id = $this->db->insert_id();

        $thequery=$this->db->last_query();
        $this->db->insert('tbls_auditlog', array('dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
        
        return $insert_id;
    }

    function user($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, Country.countryName, Role.department, Role.designation');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.userName', $searchText);
                $this->db->or_like('BaseTbl.email', $searchText);
                $this->db->or_like('BaseTbl.phone', $searchText);
                $this->db->or_like('Country.countryName', $searchText);
                $this->db->or_like('Role.department', $searchText);
                $this->db->or_like('Role.designation', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbls_country as Country','Country.id = BaseTbl.countryId','left');
        $this->db->join('tbls_role as Role','Role.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id !=', 1);
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function userEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
	function getLicenseQueries($licenseid)
    {
				$otherdb = $this->load->database('otherdb', TRUE);

                $otherdb->select('BaseTbl.*');
                $otherdb->from('tbl_query2 as BaseTbl');
                $otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.masterId', $licenseid);
                $query = $otherdb->get();

                $result = $query->result();
                $otherdb->close();
                return $result;
    }
	function getUser($userid)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $userid);
        $query = $this->db->get();
        return $query->result();
    }
	function getuserNameRole($userid)
    {
        $this->db->select('BaseTbl.userName,BaseTbl.roleId');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $userid);
        $query = $this->db->get();
        return $query->result();
    }
    function getuserRecord($userid)
    {
        $this->db->select('BaseTbl.*,RoleUser.department,RoleUser.designation');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as RoleUser','RoleUser.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $userid);
        $query = $this->db->get();
        return $query->result();
    }
    function getCityName($cityid)
    {
        $this->db->select('BaseTbl.cityName');
        $this->db->from('tbls_city as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $cityid);
        $query = $this->db->get();
        return $query->result();
    }
    function getRecord($table,$column,$value)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.'.$column, $value);

        $query = $this->db->get();

        return $query->result();
    }
    function getDesignationDepartment($userid)
    {
        $this->db->select('CONCAT(RoleUser.designation," ",RoleUser.department) as urole');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as RoleUser','RoleUser.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $userid);
        $query = $this->db->get();
        return $query->result();
    }

    function getOtherdbRecord($table,$column,$value)
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('BaseTbl.*');
        $otherdb->from($table.' as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.'.$column, $value);

        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function getLicenseCompany($id)
    {
        $this->db->select('BaseTbl.*,License.licenseNoManual');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->join('tbl_license as License','BaseTbl.id = License.companyId','left');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('License.id', (int)$id);

        $query = $this->db->get();

        return $query->result();
    }
    function getCompanyData($id)
    {
        $this->db->select('BaseTbl.companyName');
        $this->db->from('tbls_company as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', (int)$id);

        $query = $this->db->get();

        return $query->result();
    }
    function getCompany($accountid)
    {
        $this->db->select('BaseTbl.companyName');
        $this->db->from('tbls_company as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.companyUniqueNo', (int)$accountid);

        $query = $this->db->get();

        return $query->result();
    }
    function getDosage($id)
    {
        $this->db->select('BaseTbl.dosageName');
        $this->db->from('tbl_dosage as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $id);

        $query = $this->db->get();

        return $query->result();
    }
    function getUnit($id)
    {
        $this->db->select('BaseTbl.unit');
        $this->db->from('tbl_unit as BaseTbl');
        $this->db->where('BaseTbl.id', $id);

        $query = $this->db->get();

        return $query->result();
    }
    function getCountry($id)
    {
        $this->db->select('BaseTbl.countryName');
        $this->db->from('tbls_country as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $id);

        $query = $this->db->get();

        return $query->result();
    }
    function getDrugManufacturer($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationothermanufacturer as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->like('BaseTbl.role', '%Manufacturer');


        $query = $this->db->get();

        return $query->result();
    }
    function getDrugCompositions($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationinn as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.masterId', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function getMeetingInfo($licenseId)
    {
        $this->db->select('Meeting.meetingNo,Meeting.meetingDate');
        $this->db->from('tbl_meetingagenda as BaseTbl');
        $this->db->join('tbl_licensemeeting as Meeting','Meeting.id = BaseTbl.meetingId','left');
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.masterId', $licenseId);
        $query = $this->db->get();
        return $query->result();
    }
	function getuserDepartmentDesignation($roleid)
    {
        $this->db->select('BaseTbl.department,BaseTbl.designation');
        $this->db->from('tbls_role as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $roleid);
        $query = $this->db->get();
        return $query->result();
    }

    function permission($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.department', $searchText);
                $this->db->or_like('BaseTbl.designation', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function permissionEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function permissionDetailEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, Page.friendlyName');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_page as Page','Page.id = BaseTbl.masterId','left');
        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.roleId', $id);
        $this->db->order_by('Page.friendlyName', 'asc');
        //$this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function auditlog($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, User.userName');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.userName', $searchText);
                $this->db->or_like('BaseTbl.dateTime', $searchText);
                $this->db->or_like('BaseTbl.query', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->where('BaseTbl.isArchived', 0);
        $this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function auditlogEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function alert($table, $searchText = NULL)
    {
		
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.type', $searchText);
                $this->db->or_like('BaseTbl.dateTime', $searchText);
                $this->db->or_like('BaseTbl.alertName', $searchText);
                $this->db->or_like('BaseTbl.duration', $searchText);
                $this->db->or_like('BaseTbl.description', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function alertEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function alerts($table, $searchText = NULL)
    {
		$this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
		$this->db->where("(BaseTbl.type='Broadcast' OR (BaseTbl.type='User' AND FIND_IN_SET({$this->userId},BaseTbl.recepients) > 0))", NULL, FALSE);
		$this->db->where("(FIND_IN_SET({$this->userId},BaseTbl.alertSeenBy) = 0)", NULL, FALSE);
		//$this->db->where("(BaseTbl.duration='now' OR (BaseTbl.type='User' ))", NULL, FALSE);
		$this->db->order_by('BaseTbl.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
		/*
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.type', $searchText);
                $this->db->or_like('BaseTbl.dateTime', $searchText);
                $this->db->or_like('BaseTbl.alertName', $searchText);
                $this->db->or_like('BaseTbl.duration', $searchText);
                $this->db->or_like('BaseTbl.description', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->like('BaseTbl.recepients', $this->userId);
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
		*/
    }

    function inuserecord($table, $searchText = NULL)
    {
        $query = $this->db->query('SELECT tbl_license.id, tbl_license.inUseTime, \'License\' as type, tbls_user.userName FROM tbl_license LEFT JOIN tbls_user ON tbl_license.inUseBy = tbls_user.id WHERE tbl_license.inUseBy <> 0
        UNION ALL
        SELECT tbl_registration.id, tbl_registration.inUseTime, \'Registration\' as type, tbls_user.userName FROM tbl_registration LEFT JOIN tbls_user ON tbl_registration.inUseBy = tbls_user.id WHERE tbl_registration.inUseBy <> 0
        UNION ALL
        SELECT tbl_inspection.id, tbl_inspection.inUseTime, \'Inspection\' as type, tbls_user.userName FROM tbl_inspection LEFT JOIN tbls_user ON tbl_inspection.inUseBy = tbls_user.id WHERE tbl_inspection.inUseBy <> 0');
        
        $result = $query->result();        
        return $result;
    }

    function helpdesk($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, User.userName');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.dateTime', $searchText);
                $this->db->or_like('BaseTbl.id', $searchText);
                $this->db->or_like('BaseTbl.description', $searchText);
                $this->db->or_like('BaseTbl.issueStatus', $searchText);
                $this->db->or_like('BaseTbl.clientStatus', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId <> '1'){
            $this->db->where('BaseTbl.createdby', $this->userId);
        }
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
    function licensevarianceDetailQuery($id)
    {
        $this->db->select('BaseTbl.*, User.userName as assignedOfficer');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.createdby','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
       // $this->db->where('BaseTbl.shortcommingTypeId', $type);
        //$this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();

        return $query->result();
    }

    function helpdeskEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function userguide($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.createddate', $searchText);
                $this->db->or_like('BaseTbl.version', $searchText);
                $this->db->or_like('BaseTbl.name', $searchText);
            $this->db->group_end();
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.roleId', $this->roleId);
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function company($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, State.stateName');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.companyUniqueNo', $searchText);
                $this->db->or_like('BaseTbl.companyCategory', $searchText);
                $this->db->or_like('BaseTbl.companyUserType', $searchText);
                $this->db->or_like('BaseTbl.companyName', $searchText);
                $this->db->or_like('BaseTbl.companyType', $searchText);
                $this->db->or_like('BaseTbl.companyAddress', $searchText);
                $this->db->or_like('BaseTbl.companyNTN', $searchText);
                $this->db->or_like('BaseTbl.email', $searchText);
                $this->db->or_like('BaseTbl.website', $searchText);
                $this->db->or_like('State.stateName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);            
        }
        $this->db->join('tbls_state as State', 'State.id = BaseTbl.stateId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id !=', 1);
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function companyEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function report($reportType, $id, $parameters, $type)
    {
        if($type == 'Main'){
            if($reportType == 'All Users'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbls_users as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                if($id){
                    $this->db->where('BaseTbl.id', $id);
                }
                if(isset($parameters['fromDate'])){
                    //$this->db->where('BaseTbl.dateTime >=', $parameters['fromDate']);
                    $this->db->where('STR_TO_DATE(BaseTbl.dateTime,"%d-%M-%y %H:%i") <= STR_TO_DATE("'.$parameters['fromDate'].'","%d-%M-%y")');
                }
                if(isset($parameters['toDate'])){
                    //$this->db->where('BaseTbl.dateTime <=', $parameters['toDate']);
                    $this->db->where('STR_TO_DATE(BaseTbl.dateTime,"%d-%M-%y %H:%i") <= STR_TO_DATE("'.$parameters['toDate'].'","%d-%M-%y")');
                }
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Applicant License Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0  ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation, (SELECT tbl_companyqualifiedstaff.name FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nameProductionManager, (SELECT tbl_companyqualifiedstaff.nic FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nicProductionManager, (SELECT tbl_companyqualification.qualification FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId LEFT JOIN tbl_companyqualification ON tbl_companyqualification.id = tbl_companyqualifiedstaff.qualificationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as qualificationProductionManager, (SELECT tbl_companyqualifiedstaff.name FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nameQCManager, (SELECT tbl_companyqualifiedstaff.nic FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nicQCManager, (SELECT tbl_companyqualification.qualification FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId LEFT JOIN tbl_companyqualification ON tbl_companyqualification.id = tbl_companyqualifiedstaff.qualificationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.id AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as qualificationQCManager');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Renewal Applicant License Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation, (SELECT tbl_companyqualifiedstaff.name FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nameProductionManager, (SELECT tbl_companyqualifiedstaff.nic FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nicProductionManager, (SELECT tbl_companyqualification.qualification FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId LEFT JOIN tbl_companyqualification ON tbl_companyqualification.id = tbl_companyqualifiedstaff.qualificationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "Production Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as qualificationProductionManager, (SELECT tbl_companyqualifiedstaff.name FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nameQCManager, (SELECT tbl_companyqualifiedstaff.nic FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as nicQCManager, (SELECT tbl_companyqualification.qualification FROM tbl_companyqualifiedstaff LEFT JOIN tbl_companydesignation ON tbl_companydesignation.id = tbl_companyqualifiedstaff.designationId LEFT JOIN tbl_companyqualification ON tbl_companyqualification.id = tbl_companyqualifiedstaff.qualificationId WHERE tbl_companyqualifiedstaff.masterId = BaseTbl.companyId AND tbl_companydesignation.designation = "QC Incharge" ORDER BY tbl_companyqualifiedstaff.id ASC LIMIT 1) as qualificationQCManager');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Applicant Registration Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, Company.dslNo, Company.dslValidityDate, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, UsedFor.usedFor, RouteOfAdmin.routeOfAdmin, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 19 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedAD, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 44 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedSecretary, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 7 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedD');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
				$this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->join('tbl_routeofadmin as RouteOfAdmin','RouteOfAdmin.id = BaseTbl.routeOfAdminId','left');
                $this->db->join('tbl_shelflife as ShelfLife','ShelfLife.id = BaseTbl.shelfLifeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Renewal Applicant Registration Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, Company.dslNo, Company.dslValidityDate, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, UsedFor.usedFor, RouteOfAdmin.routeOfAdmin, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 19 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedAD, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 44 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedSecretary, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 7 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedD');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->join('tbl_routeofadmin as RouteOfAdmin','RouteOfAdmin.id = BaseTbl.routeOfAdminId','left');
                $this->db->join('tbl_shelflife as ShelfLife','ShelfLife.id = BaseTbl.shelfLifeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Product Detail'){
                $this->db->select('BaseTbl.*,Pharmacopeia.pharmacopeia, Company.id as companyId,License.licenseNoManual, Company.companyName, Company.companyAddress, Company.dslNo, Company.dslValidityDate, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, UsedFor.usedFor, RouteOfAdmin.routeOfAdmin, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 19 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedAD, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 44 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedSecretary, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 7 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedD');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->join('tbl_routeofadmin as RouteOfAdmin','RouteOfAdmin.id = BaseTbl.routeOfAdminId','left');
                $this->db->join('tbl_shelflife as ShelfLife','ShelfLife.id = BaseTbl.shelfLifeId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Export Approval Letter'){
                $this->db->select('BaseTbl.*,Pharmacopeia.pharmacopeia, Company.id as companyId,License.licenseNoManual, Company.companyName, Company.companyAddress, Company.dslNo, Company.dslValidityDate, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, UsedFor.usedFor, RouteOfAdmin.routeOfAdmin, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 19 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedAD, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 44 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedSecretary, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 7 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedD');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->join('tbl_routeofadmin as RouteOfAdmin','RouteOfAdmin.id = BaseTbl.routeOfAdminId','left');
                $this->db->join('tbl_shelflife as ShelfLife','ShelfLife.id = BaseTbl.shelfLifeId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.isexport', 1);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Export Registration Appliation'){
                $this->db->select('BaseTbl.*,Pharmacopeia.pharmacopeia, Company.id as companyId,License.licenseNoManual, Company.companyName, Company.companyAddress, Company.dslNo, Company.dslValidityDate, License.siteAddress, City.cityName as siteCity, Country.countryName as internationalRefBrandCountry, Dosage.dosageName, UsedFor.usedFor, RouteOfAdmin.routeOfAdmin, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 19 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedAD, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 44 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedSecretary, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id AND tbls_user.roleId = 7 ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedD');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->join('tbls_country as Country','Country.id = BaseTbl.internationalRefBrandCountryId','left');
                $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->join('tbl_routeofadmin as RouteOfAdmin','RouteOfAdmin.id = BaseTbl.routeOfAdminId','left');
                $this->db->join('tbl_shelflife as ShelfLife','ShelfLife.id = BaseTbl.shelfLifeId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.isexport', 1);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }

            if($reportType == 'License Application Submission Receipt'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Application Submission Receipt'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Applicant Inspection Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName');
                $this->db->from('tbl_inspection as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Site Verification Shortcoming Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.forwardedRole = "Assistant Director Licensing" AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'License Report'){
                $this->db->select('BaseTbl.*,LicenseType.licenseSubType, Company.id as companyId, Company.companyName, Company.companyAddress, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }

            if($reportType == 'Site Verification Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.id ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Site Approval Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Layout Plan Approval Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Renewal Shortcoming'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Shortcoming Company Name' || $reportType == 'Shortcoming Company Management'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Shortcoming Technical Staff'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Technical Staff Approval Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                //$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Layout Plan Shortcoming Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Layout Plan Variance Shortcoming Letter'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                //$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Layout Plan Variance Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                //$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Applicant License Shortcoming Certificate'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'License Note Sheet'){
                $this->db->select('BaseTbl.*, Licensetbl.licFileNo, User1.userName, User1.roleId,Company.companyName,Licensetbl.siteAddress, User2.userName as userName1, RoleUser1.designation as user1designation, RoleUser1.department as user1department, RoleUser2.designation as user2designation, RoleUser2.department as user2department');
                $this->db->from('tbl_licensehistory as BaseTbl');
                $this->db->join('tbls_user as User1','User1.id = BaseTbl.userId','left');
                $this->db->join('tbls_user as User2','User2.id = BaseTbl.forwardedTo','left');
				$this->db->join('tbls_role as RoleUser1','RoleUser1.id = User1.roleId','left');
                $this->db->join('tbls_role as RoleUser2','RoleUser2.id = User2.roleId','left');
                $this->db->join('tbl_license as Licensetbl','BaseTbl.masterId = Licensetbl.id','left');
                $this->db->join('tbls_company as Company','Company.id = Licensetbl.companyId','left');

                //$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
				$this->db->order_by("BaseTbl.id", "ASC");
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'All License Note Sheet'){
                $companydata = $this->getLicenseCompany($id);
                $this->db->select('BaseTbl.*,Company.companyName,LicenseType.licenseType, LicenseType.licenseSubType,PostLicenseChangeType.licenseType as postlicenseType, PostLicenseChangeType.licenseSubType as postlicenseSubType');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->join('tbl_licensetype as PostLicenseChangeType','PostLicenseChangeType.id = BaseTbl.postchangeTypeId','left');

                //$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.companyId', $companydata[0]->id);
                $this->db->order_by("BaseTbl.id", "ASC");

                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Grant of License Panel of Inspector' || $reportType == 'Inspection Request Panel of Inspector'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.forwardedRole = "Assistant Director Licensing" AND tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation, (SELECT tbl_licensemeeting.meetingNo FROM tbl_licensemeeting WHERE tbl_licensemeeting.masterId = BaseTbl.id ORDER BY tbl_licensemeeting.id DESC LIMIT 1) as meetingNo, (SELECT tbl_licensemeeting.meetingDate FROM tbl_licensemeeting WHERE tbl_licensemeeting.masterId = BaseTbl.id ORDER BY tbl_licensemeeting.id DESC LIMIT 1) as meetingDate');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Renewal of License Panel of Inspector'){
                $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyName, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.designation FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = BaseTbl.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as designation, (SELECT tbl_licensemeeting.meetingNo FROM tbl_licensemeeting WHERE tbl_licensemeeting.masterId = BaseTbl.id ORDER BY tbl_licensemeeting.id DESC LIMIT 1) as meetingNo, (SELECT tbl_licensemeeting.meetingDate FROM tbl_licensemeeting WHERE tbl_licensemeeting.masterId = BaseTbl.id ORDER BY tbl_licensemeeting.id DESC LIMIT 1) as meetingDate');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();

                return $query->result();
            }

            if($reportType == 'License Agenda'){
                $this->db->select('BaseTbl.*, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, Company.companyName, (SELECT tbl_licensehistory.dateTime FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id  AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.licenseStatus = \'Under Board Stage 2\' THEN \'License\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'License Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post License Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT rating FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as rating');
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where('BaseTbl.licenseStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                $this->db->group_end();
                $this->db->where('BaseTbl.discussInBoard', 1);
                //$this->db->limit(100);
                //$this->db->group_by('BaseTbl.id');
                $this->db->order_by('BaseTbl.id', 'desc');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Agenda'){
                $this->db->select('BaseTbl.*, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, Pharmacopeia.pharmacopeia, RegulatoryBody.regulatoryBody, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, ProductOrigin.productOrigin, RegistrationType.registrationType, RegistrationType.registrationSubType, Company.companyName, Company.companySubCategory, Company.dslNo, Company.dslValidityDate, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
                $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->join('tbl_regulatorybody as RegulatoryBody','RegulatoryBody.id = BaseTbl.internationalRefRegulatoryBodyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                $this->db->group_end();
                $this->db->where('BaseTbl.discussInBoard', 1);
                //$this->db->limit(100);
                //$this->db->group_by('BaseTbl.id');
                $this->db->order_by('BaseTbl.productCategoryId', 'desc');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Renewal Agenda'){
                $this->db->select('BaseTbl.*, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, Pharmacopeia.pharmacopeia, RegulatoryBody.regulatoryBody, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, ProductOrigin.productOrigin, RegistrationType.registrationType, RegistrationType.registrationSubType, Company.companyName, Company.companySubCategory, Company.dslNo, Company.dslValidityDate, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
                $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->join('tbl_regulatorybody as RegulatoryBody','RegulatoryBody.id = BaseTbl.internationalRefRegulatoryBodyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
				$this->db->where('BaseTbl.isDeleted', 0);
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                $this->db->group_end();
                $this->db->where('BaseTbl.discussInBoard', 1);
                //$this->db->limit(100);
                //$this->db->group_by('BaseTbl.id');
                $this->db->order_by('BaseTbl.productCategoryId', 'desc');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Variance Agenda'){
                $this->db->select('BaseTbl.*, License.siteAddress, City.cityName as siteCity, Dosage.dosageName, Pharmacopeia.pharmacopeia, RegulatoryBody.regulatoryBody, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, ProductOrigin.productOrigin, RegistrationType.registrationType, RegistrationType.registrationSubType, Company.companyName, Company.companySubCategory, Company.dslNo, Company.dslValidityDate, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_city as City','City.id = License.siteCity','left');
				$this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
                $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
                $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
                $this->db->join('tbl_pharmacopeia as Pharmacopeia','Pharmacopeia.id = BaseTbl.pharmacopeiaId','left');
                $this->db->join('tbl_regulatorybody as RegulatoryBody','RegulatoryBody.id = BaseTbl.internationalRefRegulatoryBodyId','left');
                $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->group_start();
                    $this->db->group_start();
                        $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2000');
                    $this->db->group_end();
                    $this->db->or_group_start();
                        $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2');
                    $this->db->group_end();
                $this->db->group_end();
                $this->db->where('BaseTbl.discussInBoard', 1);
                //$this->db->limit(100);
                //$this->db->group_by('BaseTbl.id');
                $this->db->order_by('BaseTbl.productCategoryId', 'desc');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'API FPP Shortage'){
                $this->db->select('BaseTbl.*, Company.companyName, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.email FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as email');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_registrationinn as RegistrationINN','RegistrationINN.masterId = BaseTbl.id','left');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.registrationStatus', 'Approved');
                $this->db->where('RegistrationINN.innManual', @$parameters['innManual']);
                //$this->db->where('RegistrationINN.innManual >=', @$parameters['fromDate']);
                //$this->db->where('RegistrationINN.innManual <=', @$parameters['toDate']);
                //$this->db->limit(100);
                //$this->db->group_by('BaseTbl.id');
                $this->db->order_by('BaseTbl.id', 'desc');
                $query = $this->db->get();
                
                return $query->result();
            }
			if($reportType == 'Data Authentication License Note Sheet'){
				$otherdb = $this->load->database('otherdb', TRUE);
				$other_dbname = $otherdb->database;
				$main_dbname = $this->db->database;
				
				
				
//                $otherdb->select('BaseTbl.*, Licensetbl.licFileNo, User1.userName, User1.roleId,Company.companyName,Licensetbl.siteAddress, User2.userName as userName1, RoleUser1.designation as user1designation, RoleUser1.department as user1department, RoleUser2.designation as user2designation, RoleUser2.department as user2department');
                $otherdb->select('BaseTbl.*, Licensetbl.licFileNo,Company.companyName,Licensetbl.siteAddress');
                $otherdb->from('tbl_licensehistory as BaseTbl');
                //$otherdb->join('tbls_user as User1','User1.id = BaseTbl.userId','left');
                //$otherdb->join('tbls_user as User2','User2.id = BaseTbl.forwardedTo','left');
				//$otherdb->join('tbls_role as RoleUser1','RoleUser1.id = User1.roleId','left');
                //$otherdb->join('tbls_role as RoleUser2','RoleUser2.id = User2.roleId','left');
                $otherdb->join('tbl_license as Licensetbl','BaseTbl.masterId = Licensetbl.id','left');
                $otherdb->join('tbls_company as Company','Company.id = Licensetbl.companyId','left');
                //$otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.masterId', $id);
				$otherdb->order_by("BaseTbl.id", "ASC");
				
				//echo $otherdb->get_compiled_select();
                $query = $otherdb->get();
                $result = $query->result();
                $otherdb->close();
                return $result;
            }
			if($reportType == 'Data Authentication Approval Letter'){
				$otherdb = $this->load->database('otherdb', TRUE);

                $otherdb->select('BaseTbl.*, Company.id as companyId, Company.companyName');
                $otherdb->from('tbl_license as BaseTbl');
                $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.id', $id);
                $query = $otherdb->get();

                $result = $query->result();
                $otherdb->close();
                return $result;
            }
			if($reportType == 'Data Authentication Shortcoming Letter'){
				$otherdb = $this->load->database('otherdb', TRUE);

                $otherdb->select('BaseTbl.createdDate as letterDate,BaseTbl.message, BaseTbl.createdby as queryfrom, License.*, Company.id as companyId, Company.companyName');
                $otherdb->from('tbl_query2 as BaseTbl');
				$otherdb->join('tbl_license as License','BaseTbl.masterId = License.id','left');
                $otherdb->join('tbls_company as Company','Company.id = License.companyId','left');
                $otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.id', $id);
                $query = $otherdb->get();

                $result = $query->result();
                $otherdb->close();
                return $result;
            }
            if($reportType == 'License History'){
                $otherdb = $this->load->database('otherdb', TRUE);

                $otherdb->select('BaseTbl.*, Company.id as companyId, LicenseType.licenseType, LicenseType.licenseSubType, Company.companyName');
                $otherdb->from('tbl_license as BaseTbl');
                $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $otherdb->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
                $otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.id', $id);
                $query = $otherdb->get();
                $result = $query->result();
                $otherdb->close();
                return $result;
            }

            
		}

        if($type == 'Detail'){
            if($reportType == 'Registration Certificate'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Applicant Registration Certificate'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Layout Plan Variance Certificate'){
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                //$this->db->where('BaseTbl.approved', 'Yes');
                $query = $this->db->get();

                return $query->result();
            }
            if($reportType == 'Layout Plan Approval Letter'){
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                //$this->db->where('BaseTbl.approved', 'Yes');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'License Report' || $reportType == 'Inspection Request Panel of Inspector'){
                $allrecord = array();
                // sections
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $query = $this->db->get();
                $allrecord['sections'] =  $query->result();

                //API
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_licenseapi as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['api'] =  $query->result();
                // Management
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_companymanagement as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['management'] =  $query->result();
                //Staff
                $this->db->select('BaseTbl.*,Designation.designation');
                $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
                $this->db->join('tbl_companydesignation as Designation','Designation.id = BaseTbl.designationId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['staff'] =  $query->result();

                //Facility
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_licensefacility as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['facility'] =  $query->result();
                return $allrecord;
            }
            if($reportType == 'License History'){
                $otherdb = $this->load->database('otherdb', TRUE);

                $otherdb->select('BaseTbl.*, Company.id as companyId, LicenseType.licenseType, LicenseType.licenseSubType, Company.companyName');
                $otherdb->from('tbl_licenselog as BaseTbl');
                $otherdb->join('tbl_license as License','License.id = BaseTbl.masterId','left');

                $otherdb->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
                $otherdb->join('tbls_company as Company','Company.id = License.companyId','left');

                $otherdb->where('BaseTbl.isDeleted', 0);
                $otherdb->where('BaseTbl.masterId', $id);
                $query = $otherdb->get();
                $result = $query->result();
                $otherdb->close();
                return $result;
            }
            if($reportType == 'Product Detail'){
                $allrecord = array();
                // compositions
                $this->db->select('BaseTbl.*, INNCode.atcName, Unit.unit');
                $this->db->from('tbl_registrationinn as BaseTbl');
                $this->db->join('tbl_atccode as INNCode','INNCode.id = BaseTbl.innCodeId','left');
                $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['compositions'] =  $query->result();

                //proposed packing
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['packings'] =  $query->result();

                // Other Manufacturer
                $this->db->select('BaseTbl.*,Country.countryName');
                $this->db->from('tbl_registrationothermanufacturer as BaseTbl');
                $this->db->join('tbls_country as Country','Country.id = BaseTbl.companyCountry','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['manufacturers'] =  $query->result();

                return $allrecord;
            }

            if($reportType == 'Export Approval Letter'){
                $allrecord = array();
                // compositions
                $this->db->select('BaseTbl.*, INNCode.atcName, Unit.unit');
                $this->db->from('tbl_registrationinn as BaseTbl');
                $this->db->join('tbl_atccode as INNCode','INNCode.id = BaseTbl.innCodeId','left');
                $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['compositions'] =  $query->result();

                //proposed packing
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['packings'] =  $query->result();

                // Other Manufacturer
                $this->db->select('BaseTbl.*,Country.countryName');
                $this->db->from('tbl_registrationothermanufacturer as BaseTbl');
                $this->db->join('tbls_country as Country','Country.id = BaseTbl.companyCountry','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['manufacturers'] =  $query->result();

                return $allrecord;
            }
            if($reportType == 'Export Registration Appliation'){
                $allrecord = array();
                // compositions
                $this->db->select('BaseTbl.*, INNCode.atcName, Unit.unit');
                $this->db->from('tbl_registrationinn as BaseTbl');
                $this->db->join('tbl_atccode as INNCode','INNCode.id = BaseTbl.innCodeId','left');
                $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['compositions'] =  $query->result();

                //proposed packing
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['packings'] =  $query->result();

                // Other Manufacturer
                $this->db->select('BaseTbl.*,Country.countryName');
                $this->db->from('tbl_registrationothermanufacturer as BaseTbl');
                $this->db->join('tbls_country as Country','Country.id = BaseTbl.companyCountry','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['manufacturers'] =  $query->result();

                return $allrecord;
            }

            if($reportType == 'Grant of License Panel of Inspector' ){
                $allrecord = array();
                // sections
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->where('BaseTbl.approved', 'Yes');
                $query = $this->db->get();
                $allrecord['sections'] =  $query->result();

                //API
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_licenseapi as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['api'] =  $query->result();

                return $allrecord;
            }
            if($reportType == 'Renewal of License Panel of Inspector' ){
                $allrecord = array();
                // sections
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->where('BaseTbl.approved', 'Yes');
                $query = $this->db->get();
                $allrecord['sections'] =  $query->result();

                //API
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_licenseapi as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                $allrecord['api'] =  $query->result();

                return $allrecord;
            }

            if($reportType == 'License Agenda'){
                $this->db->select('BaseTbl.*, Section.section, PharmaGroup.pharmaGroup, UsedFor.usedFor');
                $this->db->from('tbl_licensesection as BaseTbl');
                $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
                $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
                $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $parameters['myId']);
                $this->db->where('BaseTbl.approved', 'Yes');
                $this->db->where('BaseTbl.recommended', 'Yes');
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Agenda'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $parameters['myId']);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Technical Staff Approval Letter'){
                $this->db->select('BaseTbl.*,Designation.designation,Qualification.qualification,Specialization.specialization');
                $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
                $this->db->join('tbl_companydesignation as Designation','Designation.id = BaseTbl.designationId','left');
                $this->db->join('tbl_companyqualification as Qualification','Qualification.id = BaseTbl.qualificationId','left');
                $this->db->join('tbl_companyspecialization as Specialization','Specialization.id = BaseTbl.specializationId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $id);
                $this->db->order_by('BaseTbl.id', 'asc');
                $query = $this->db->get();
                return  $query->result();
            }
            if($reportType == 'Registration Renewal Agenda'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $parameters['myId']);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Variance Agenda'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationproposedprice as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $parameters['myId']);
                $query = $this->db->get();
                
                return $query->result();
            }
            if($reportType == 'Registration Agenda1'){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationinn as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.masterId', $parameters['myId']);
                $query = $this->db->get();
                
                return $query->result();
            }
        }
    }
}

  