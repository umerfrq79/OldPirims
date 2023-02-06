<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class cronJobModel extends CI_Model {

    function __construct()
    {
         parent::__construct();
         $this->db->query("SET time_zone='+05:00'");
    }

    function recordCronJobSave($data, $table)
    {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();

        $thequery=$this->db->last_query();
        $this->db->insert('tbls_auditlog', array('userId'=>0, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));
        
        return $insert_id;
    }

    function recordCronJobUpdate($idColumn, $id, $data, $table)
    {
        $this->db->where($idColumn, $id);
        $this->db->update($table, $data);
        $update_id = $this->db->affected_rows();

        $thequery=$this->db->last_query();
        $this->db->insert('tbls_auditlog', array('userId'=>0, 'dateTime'=>date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR'], 'query'=>$thequery, 'queryData'=>serialize($data)));

        return $update_id;
    }

    function inspectionScheduleToPending()
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('STR_TO_DATE(inspectionFromDate,"%Y-%m-%d %H:%i") < NOW()');
        $this->db->where('BaseTbl.inspectionStatus', 'Inspection Scheduled');
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function inspectionMeetingScheduleToPending()
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('STR_TO_DATE(panelMeetingDate,"%Y-%m-%d %H:%i") < NOW()');
        $this->db->where('BaseTbl.inspectionStatus', 'Panel Meeting Scheduled');
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function licenseRenewal()
    {
        $this->db->select('BaseTbl.id, BaseTbl.licenseTypeId, BaseTbl.companyId, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.licenseNoManual = BaseTbl.licenseNoManual AND tbl_license.isDeleted = 0) as countSameLicenseNo');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        //$this->db->where('DATE_ADD(STR_TO_DATE(BaseTbl.validTill,"%d-%M-%y %H:%i"), INTERVAL -6 MONTH) <= NOW()');
        $this->db->where('DATE_ADD(BaseTbl.validTill, INTERVAL -6 MONTH) <= NOW()');

        $this->db->where('BaseTbl.licenseStatus', 'Approved');
        $this->db->where('BaseTbl.renewalStatus  IS NULL', null, false);
        //$this->db->where('BaseTbl.renewalStatus =', NULL);
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function registrationRenewal()
    {
        $this->db->select('BaseTbl.id, BaseTbl.registrationTypeId, License.companyId, (SELECT COUNT(tbl_registration.id) FROM tbl_registration WHERE tbl_registration.registrationNo = BaseTbl.registrationNo) as countSameRegistrationNo');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('DATE_ADD(STR_TO_DATE(BaseTbl.validTill,"%d-%M-%y %H:%i"), INTERVAL -6 MONTH) <= NOW()');
        $this->db->where('BaseTbl.registrationStatus', 'Approved');
        $this->db->where('BaseTbl.renewalStatus =', NULL);
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function inuserecordUnlock()
    {
        $query = $this->db->query('SELECT tbl_license.id, tbl_license.inUseTime, \'License\' as type, tbls_user.userName FROM tbl_license LEFT JOIN tbls_user ON tbl_license.inUseBy = tbls_user.id WHERE tbl_license.inUseBy <> 0
        UNION ALL
        SELECT tbl_registration.id, tbl_registration.inUseTime, \'Registration\' as type, tbls_user.userName FROM tbl_registration LEFT JOIN tbls_user ON tbl_registration.inUseBy = tbls_user.id WHERE tbl_registration.inUseBy <> 0
        UNION ALL
        SELECT tbl_inspection.id, tbl_inspection.inUseTime, \'Inspection\' as type, tbls_user.userName FROM tbl_inspection LEFT JOIN tbls_user ON tbl_inspection.inUseBy = tbls_user.id WHERE tbl_inspection.inUseBy <> 0');
        
        $result = $query->result();        
        return $result;
    }
}

  