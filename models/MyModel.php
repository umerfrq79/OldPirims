<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class myModel extends CI_Model {

    //########################## AJAX GET QUERIES ##########################

    function example1AjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_example as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id', $data);
        $query = $this->db->get();

        $output = '';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->columnName.'</option>';
        }
        return $output;
    }

    function getRecord($table, $columnName, $columnValue)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from($table.' as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $otherdb->where('BaseTbl.'.$columnName, $columnValue);
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;

    }
    function getLicensingOfficersRecord(){
        $sql = "SELECT tbl_licensehistory.forwardedTo,forwardedRole, COUNT(tbl_licensehistory.id) as totalapplications,tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.id IN ( SELECT MAX(tbl_licensehistory.id) FROM tbl_licensehistory LEFT JOIN tbl_license on tbl_license.id = tbl_licensehistory.masterId WHERE CASE WHEN tbl_licensehistory.type = 'License Renewal' THEN tbl_license.renewalStatus != 'Draft'  AND tbl_license.renewalStatus != 'Approved' WHEN tbl_licensehistory.type = 'Post License Change' THEN tbl_license.postchangeStatus != 'Draft'  AND tbl_license.postchangeStatus != 'Approved' ELSE tbl_license.licenseStatus != 'Draft' AND tbl_license.licenseStatus != 'Approved' END GROUP BY tbl_licensehistory.masterId) GROUP BY tbl_licensehistory.forwardedTo";
        $query = $this->db->query($sql);
        return $query->result();
    }
    function getLicensingOfficers()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
            $this->db->where('BaseTbl.roleId', 14);
            $this->db->or_where('BaseTbl.roleId', 18);
            $this->db->or_where('BaseTbl.roleId', 38);
            $this->db->or_where('BaseTbl.roleId', 43);
            /*$this->db->or_group_start();
            $this->db->where('BaseTbl.licenseStatus', 'Draft');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('BaseTbl.renewalStatus', 'Draft');
            $this->db->group_end();
            $this->db->or_group_start();
            $this->db->where('BaseTbl.postchangeStatus', 'Draft');
            $this->db->group_end();*/
        $this->db->group_end();

        $query = $this->db->get();
        return $query->result();
    }
    function getRegistrationASD()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.roleId', 19);
        $query = $this->db->get();
        return $query->result();
    }
    function getRecords($table, $columnName, $columnValue)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.'.$columnName, $columnValue);
        $query = $this->db->get();
        return $query->result();
    }
    function getAjaxRecords($table, $columnName, $columnValue)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.'.$columnName, $columnValue);
        $query = $this->db->get();
        return  $query->result();
    }

    function getActiveRecords($table, $columnName, $columnValue)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.'.$columnName, $columnValue);
        $query = $this->db->get();
        return $query->result();
    }
    function getLicenseRecord($id)
    {
        $license_record = array();
        $license_record['license'] = $this->getRecord('tbl_license','id',$id);
        $license_record['Management'] = $this->getRecord('tbl_companymanagement','masterId',$id);
        $license_record['Sections'] = $this->getRecord('tbl_licensesection','masterId',$id);
        $license_record['API'] = $this->getRecord('tbl_licenseapi','masterId',$id);
        $license_record['Staff'] = $this->getRecord('tbl_companyqualifiedstaff','masterId',$id);
        $license_record['Machines'] = $this->getRecord('tbl_licensesectionmachine','masterId',$id);
        $license_record['Facility'] = $this->getRecord('tbl_licensefacility','masterId',$id);

        return json_encode($license_record);
    }



    function myAjaxGet($table, $data, $compare, $columnName)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where('BaseTbl.id', $data);
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->$columnName.'</option>';
        }
        return $output;
    }
    function myAjaxGetCompany($table, $data, $compare, $columnName)
    {

        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id >', 673);
        $this->db->order_by('BaseTbl.companyName', 'asc');


        //$this->db->where('BaseTbl.id', $data);
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select Company</option>';
        foreach($query->result() as $record)
        {
            $output .= '<option data-add="'.$record->companyAddress.'" value="'.$record->$columnName.'"';
            if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->$columnName.' ('.$record->companyAddress.')</option>';
        }
        return $output;
    }
    function myAjaxSearch($table, $value, $columnName)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where('BaseTbl.id', $data);
        $this->db->like($columnName, $value, 'after');
        $query = $this->db->get();

        $output = '';
        $output = '<ul class="list-unstyled suggestbox">';
        foreach($query->result() as $record)
        {
            if($table == 'tbls_company'){
                $output .= '<li data-id="'.$record->id.'">'.$record->$columnName.' ('.$record->companyUniqueNo.')</li>';
            }else{
                $output .= '<li data-id="'.$record->id.'">'.$record->$columnName.'</li>';
            }
        }
        $output .= '</ul>';
        return $output;
    }
    function myAjaxSearchGet($table, $value, $columnName)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where('BaseTbl.id', $data);
        $this->db->like($columnName, $value, 'after');
        $query = $this->db->get();



        $response = array();

//      Read Data
        foreach($query->result() as $record){
            $response[] = array(
                "id" => $record->id,
                "text" => $record->$columnName//.' ('.$record->companyUniqueNo.')'
            );
        }

        return json_encode($response);
    }

    function companyLicenseGet($companyid)
    {
/*        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.licenseStatus', 'Approved');
        $this->db->where('BaseTbl.companyId', $companyid);
        $query = $this->db->get();
        return json_encode($query->result());
*/
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType,LicenseCity.cityName as licCityName');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbls_city as LicenseCity','LicenseCity.id = BaseTbl.siteCity','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companyId', $companyid);
        $this->db->where('LicenseType.licenseType', 'License');
        $this->db->where('BaseTbl.licenseStatus', 'Approved');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        return json_encode($query->row());
    }
    function sectionApprovedAjaxGet11($data, $compare)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $data);
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->section.'</option>';
        }
        return $output;
    }

    function pharmaGroupApprovedAjaxGet11($data, $compare)
    {
        $this->db->select('BaseTbl.*, PharmaGroup.pharmaGroup');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $data);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by('BaseTbl.pharmaGroupId');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->pharmaGroup.'</option>';
        }
        return $output;
    }

    function usedForApprovedAjaxGet11($data, $compare)
    {
        $this->db->select('BaseTbl.*, UsedFor.usedFor');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $data);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by('BaseTbl.usedForId');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->usedFor.'</option>';
        }
        return $output;
    }

    function memberAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*, User.userName, Role.department, Role.designation');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->join('tbls_role as Role', 'Role.id = User.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Internal');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->userName.' &mdash; '.$record->designation.'</option>';
        }
        return $output;
    }

    function memberLeadAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*, User.userName, Role.department, Role.designation');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->join('tbls_role as Role', 'Role.id = User.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Internal');
        $this->db->where('BaseTbl.isLead', 1);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->userName.' &mdash; '.$record->designation.'</option>';
        }
        return $output;
    }

    function memberExternalAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'External');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->memberName.'</option>';
        }
        return $output;
    }

    function innAjaxGet($data, $compare)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_atccode as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.codeLevel', '5');
        $this->db->group_by('BaseTbl.atcCode');
        $this->db->order_by('BaseTbl.atcName', 'asc');
        $query = $this->db->get();

        $output = '';
        $output = '<option value="">Select an option</option>';
        foreach($query->result() as $record)
        {
           $output .= '<option value="'.$record->id.'"';
           if ($compare == $record->id){
                $output .= ' selected';
            }
            $output .= '>'.$record->atcName.'</option>';
        }
        return $output;
    }

    //########################## AJAX GET QUERIES ##########################

    //########################## MAIN GET QUERIES ##########################

    function countriesGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_country as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $query = $this->db->get();
        return $query->result();
    }
    function regIdGet($regno)
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.registrationNo', $regno);
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }
    function filenumbersGet()
    {
        $this->db->select('BaseTbl.regFileNo');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->group_by('BaseTbl.regFileNo');
        $query = $this->db->get();
        return $query->result();
    }
    function refUnitsGet()
    {
        $this->db->select('BaseTbl.refUnit');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->group_by('BaseTbl.refUnit');
        $query = $this->db->get();
        return $query->result();
    }
    function genericGet()
    {
        $this->db->select('BaseTbl.innManual');
        $this->db->from('tbl_registrationinn as BaseTbl');
        $this->db->group_by('BaseTbl.innManual');
        $query = $this->db->get();
        return $query->result();
    }
    function countDashbordManufacturerGetGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companySubCategory', 'Manufacturer');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function countChallan($challan)
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_challan as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.challan_no', $challan);
        $query = $this->db->get();

        return $query->result();
    }

    function licenseTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensetype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseType', array('License'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function companiesGet(){
        $this->db->select('BaseTbl.*,(SELECT tbl_license.licenseNoManual FROM tbl_license  WHERE tbl_license.companyId = BaseTbl.id ORDER BY tbl_license.id DESC LIMIT 1) as licenseNoManual');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id >', 673);
        $this->db->order_by('BaseTbl.companyName', 'asc');


        $query = $this->db->get();

        return $query->result();
    }
    function companiesApprovedLicenseGet(){
        $this->db->select('BaseTbl.*,(SELECT tbl_license.id FROM tbl_license  WHERE tbl_license.companyId = BaseTbl.id AND tbl_license.isDeleted = 1 AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as licenseId,(SELECT tbl_license.licenseNoManual FROM tbl_license  WHERE tbl_license.companyId = BaseTbl.id AND tbl_license.isDeleted = 1 AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as licenseNoManual');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.id >', 673);
        $this->db->order_by('BaseTbl.companyName', 'asc');
        echo $this->db->get_compiled_select();
        $query = $this->db->get();

        return $query->result();
    }

    function sectionGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_section as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmaGroupGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_pharmagroup as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function usedForGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_usedfor as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyDesignationGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companydesignation as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyQualificationGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualification as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companySpecializationGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyspecialization as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licensePostChangeTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensetype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseType', array('License Change'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenseDesignationGet()
    {
        $this->db->select('BaseTbl.id, BaseTbl.userName, Role.department, Role.designation');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role','Role.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.roleId', array('6', '10', '14', '18', '38', '43', '42'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationDesignationGet()
    {
        $this->db->select('BaseTbl.id, BaseTbl.userName, Role.department, Role.designation');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role','Role.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.roleId', array('7', '11', '15', '19', '39', '44', '42', '51', '54'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function registrationExportDesignationGet()
    {
        $this->db->select('BaseTbl.id, BaseTbl.userName, Role.department, Role.designation');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role','Role.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.roleId', array('7', '11', '15', '19', '39', '44', '42', '51', '54','55'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function companyApplicationStatusGet($id, $type)
    {
        if($type == 'License'){
            $this->db->select('BaseTbl.licenseStatus as status');
            $this->db->from('tbl_license as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');


            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'License Renewal'){
            $this->db->select('BaseTbl.renewalStatus as status');
            $this->db->from('tbl_license as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'Post License Change'){
            $this->db->select('BaseTbl.postchangeStatus as status');
            $this->db->from('tbl_license as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'Registration'){
            $this->db->select('BaseTbl.registrationStatus as status');
            $this->db->from('tbl_registration as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'Registration Renewal'){
            $this->db->select('BaseTbl.renewalStatus as status');
            $this->db->from('tbl_registration as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'Post Registration Change'){
            $this->db->select('BaseTbl.postchangeStatus as status');
            $this->db->from('tbl_registration as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
        if($type == 'Inspection'){
            $this->db->select('BaseTbl.status as status');
            $this->db->from('tbl_inspection as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.id', $id);
            //$this->db->where('BaseTbl.status', 'Active');
            $query = $this->db->get();

            return $query->result();
        }
    }

    function panelPoolUsersGet()
    {
        $this->db->select('BaseTbl.*, Role.department, Role.designation');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->join('tbls_role as Role', 'Role.id = BaseTbl.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.roleId', array(16, 20));
        $this->db->where_not_in('BaseTbl.roleId', array(1, 26, 28, 29, 30, 31, 32, 33, 35, 41, 42));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectiontype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.inspectionType', array('QA'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionTypeRegistrationGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectiontype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.inspectionType', array('Registration'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionAllTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectiontype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.inspectionType', array('QA'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyGet()
    {
        $this->db->select('BaseTbl.*, License.licenseNoManual');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->join('tbl_license as License','BaseTbl.id = License.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('License.isDeleted', 0);
        $this->db->where('License.licenseStatus', 'Approved');

        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_not_in('BaseTbl.id', array('1', '9'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenseApprovedGet1($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companyId', $id);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenseApprovedGet($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companyId', $id);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }
	function dashbordPendingDMLGet()
    {
		$otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus !=', '');
        $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
		$otherdb->where('BaseTbl.licenseStatus !=', 'Approved');
        $otherdb->order_by('BaseTbl.id', 'asc');

        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function companyDraftApplication(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.licenseStatus', 'Draft');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.renewalStatus', 'Draft');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.postchangeStatus', 'Draft');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function companyDraftDataApplication()
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus', 'Draft');
        $otherdb->where('BaseTbl.companyId', $this->companyId);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function companySubmittedApplication()
    {

        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.licenseStatus !=', '');
                $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
                $this->db->where('BaseTbl.licenseStatus !=', 'Approved');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.renewalStatus !=', '');
                $this->db->where('BaseTbl.renewalStatus !=', 'Draft');
                $this->db->where('BaseTbl.renewalStatus !=', 'Approved');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.postchangeStatus !=', '');
                $this->db->where('BaseTbl.postchangeStatus !=', 'Draft');
                $this->db->where('BaseTbl.postchangeStatus !=', 'Approved');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function companySubmittedDataApplication()
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus !=', '');
        $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
        $otherdb->where('BaseTbl.licenseStatus !=', 'Approved');
        $otherdb->where('BaseTbl.companyId', $this->companyId);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function companyApprovedApplication(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.licenseStatus', 'Approved');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.renewalStatus', 'Approved');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.postchangeStatus', 'Approved');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function companyApprovedDataApplication()
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus', 'Approved');
        $otherdb->where('BaseTbl.companyId', $this->companyId);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function companyRejectedApplication(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.licenseStatus', 'Rejected and Closed');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.renewalStatus', 'Rejected and Closed');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.postchangeStatus', 'Rejected and Closed');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function companyRejectedDataApplication()
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus', 'Rejected and Closed');
        $otherdb->where('BaseTbl.companyId', $this->companyId);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function companyReturnedApplication(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_start();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.licenseStatus', 'Referred Back To Company (Locked)');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.renewalStatus', 'Referred Back To Company (Locked)');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.postchangeStatus', 'Referred Back To Company (Locked)');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function companyReturnedDataApplication()
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('COUNT(*) as resultCount');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.licenseStatus', 'Referred Back To Company');
        $otherdb->where('BaseTbl.companyId', $this->companyId);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function companyInspectionScheduled()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Inspection Scheduled');
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function draftInspection(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Draft');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function scheduledInspection(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Inspection Scheduled');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function pendingInspection(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Inspection Pending');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function initiatedInspection(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Initiated');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function completedInspection(){
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_inspection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.inspectionStatus', 'Inspection Completed');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }


    function userCompany()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbls_company as BaseTbl');
        $this->db->where('BaseTbl.id', $this->companyId);
        $query = $this->db->get();
        return $query->result();
    }

    function dashbordPendingRegistrationGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus !=', '');
        $this->db->where('BaseTbl.registrationStatus !=', 'Draft');
        $this->db->where('BaseTbl.registrationStatus !=', 'Approved');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function dashbordReturnedRegistrationGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Referred Back To Company');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function dashbordApprovedRegistrationGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Approved');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
    function dashbordRejectedRegistrationGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Deferred and Closed');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function dashbordPendingLicenseGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('BaseTbl.licenseStatus !=', '');
        $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
		$this->db->where('BaseTbl.licenseStatus !=', 'Approved');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
	function dashbordPriorityLicenseGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('BaseTbl.licenseStatus !=', '');
        $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
		$this->db->where('BaseTbl.licenseStatus !=', 'Approved');
		$this->db->where('BaseTbl.isPriority', 1);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
	function dashbordApprovedLicenseGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.licenseStatus', 'Approved');
		$this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }
	function dashbordTroubleLicenseGet()
    {
        $this->db->select('COUNT(*) as resultCount');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.licenseStatus', 'Rejected and Closed');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function registrationApprovedGet($id)
    {
        if($this->userId == 772){
            $id = (int)'0826024268';
        }
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Approved');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isunderprocess', '0');
        $this->db->where('BaseTbl.companyAccountId', $id);
        //$this->db->where_in('BaseTbl.registrationStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationApprovedGet2($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.isexport', 0);
        $this->db->where('BaseTbl.companyAccountId', $id);
        $this->db->where('BaseTbl.isunderprocess', '0');
       // $this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.registrationStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));

        $query = $this->db->get();
        
        return $query->result();
    }

    function allApprovedLicensesGet()
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType, Company.companyName');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.companyId', $id);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyApprovedLicenseGet($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType, Company.companyName');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Company.companyUniqueNo', $id);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();

        return $query->result();
    }

    function registrationGet()
    {
        $this->db->select('BaseTbl.*, RegistrationType.registrationType, RegistrationType.registrationSubType');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.registrationStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function memberGet()
    {
        $this->db->select('BaseTbl.*, User.userName, Role.department, Role.designation');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->join('tbls_role as Role', 'Role.id = User.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Internal');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function memberLeadGet()
    {
        $this->db->select('BaseTbl.*, User.userName, Role.department, Role.designation');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->join('tbls_role as Role', 'Role.id = User.roleId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Internal');
        $this->db->where('BaseTbl.isLead', 1);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function memberExternalGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_panelpool as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'External');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionChecklistSectionGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionchecklistsection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionChecklistQuestionGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionchecklistquestion as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionImageTypesGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionimagetype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionChecklistGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_checklist as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Inspection');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationtype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.registrationType', array('Registration'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationVarianceTypeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationtype as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.registrationType', array('Post Registration Change'));
        $this->db->order_by('BaseTbl.registrationHead', 'asc');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmacopeiaGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_pharmacopeia as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function atcCodeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_atccode as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->group_by('BaseTbl.atcCode');
        $this->db->order_by('BaseTbl.atcName', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function registrationLetterConditionsGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_letterConditions as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $query = $this->db->get();

        return $query->result();
    }

    function innCodeGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_atccode as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.codeLevel', '5');
        $this->db->group_by('BaseTbl.atcCode');
        $this->db->order_by('BaseTbl.atcName', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function productOriginGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_productorigin as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function productCategoryGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_productcategory as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function dosageFormGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_dosage as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.dosageName', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function basicDoseGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_basicdose as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmaDoseGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_pharmadose as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function combinedPharmaDoseGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_combinedpharmadose as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function releaseCharacteristicsGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_releasecharacteristics as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function transformationGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_transformation as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function adminMethodGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_adminmethod as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function intendedSiteGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_intendedsite as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function presentationUnitGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_presentationunit as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function packagingCategoryGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_packagingcategory as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function routeOfAdminGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_routeofadmin as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function unitGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_unit as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function labelClaimGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_labelclaim as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function regulatoryBodyGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_regulatorybody as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationPriorityReasonGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_priorityreason as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.type', 'Registration');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyProductsGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Approved');
        $this->db->where('License.companyId', $this->companyId);
        $query = $this->db->get();
        
        return $query->result();
    }

    //########################## MAIN GET QUERIES ##########################

    function licenseFilter($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, Company.companyName, Company.companyNTN, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.id < BaseTbl.id AND tbl_license.licenseStatus = "Submitted") as queuePosition, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.status = "Active" AND tbl_license.licenseStatus = "Approved" AND tbl_license.companyId = '.$this->companyId.') as countApprovedLicense, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.companyId = '.$this->companyId.') as countLicense, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->like('BaseTbl.fieldName', $searchText);
            $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Company.companySubCategory !=', 'Importer');
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
        $this->db->group_start();
        $this->db->where('BaseTbl.status',  'Active');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  NULL);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  '');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.licenseStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId <> '26'){
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
        }
        /*else{
            $this->db->where('BaseTbl.id', '0');
        }*/
        $this->db->where('BaseTbl.isDeleted', '0');
        //$this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function licenseFilterRecord($searchString, $type)
    {
        if($type == 'staff'){
            $this->db->select('masterId')->from('tbl_companyqualifiedstaff')->where('isDeleted', 0)->where('REPLACE (nic, "-", "") = '.$searchString, NULL, FALSE);
            $subQueryStaff =  $this->db->get_compiled_select();
        } else if($type == 'section'){
            $this->db->select('masterId')->from('tbl_licensesection')->where('isDeleted', 0)->where('sectionId', $searchString['sectionId'])->where('pharmaGroupId', $searchString['pharmaGroupId']);
            $subQuerySection =  $this->db->get_compiled_select();
        } else if($type == 'management'){
            $this->db->select('masterId')->from('tbl_companymanagement')->where('isDeleted', 0)->where('REPLACE (nic, "-", "") = '.$searchString, NULL, FALSE);
            $subQueryManagement =  $this->db->get_compiled_select();
        }

        $this->db->select('BaseTbl.*, Company.companyName, Company.companyNTN, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.id < BaseTbl.id AND tbl_license.licenseStatus = "Submitted") as queuePosition, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.status = "Active" AND tbl_license.licenseStatus = "Approved" AND tbl_license.companyId = '.$this->companyId.') as countApprovedLicense, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.companyId = '.$this->companyId.') as countLicense, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer');
        //$this->db->select('BaseTbl.*');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        $this->db->group_start();
        $this->db->group_start();
        $this->db->where('BaseTbl.status',  'Active');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  NULL);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  '');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.licenseStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        else{
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
        }
        /*else{
            $this->db->where('BaseTbl.id', '0');
        }*/
        $this->db->where('BaseTbl.isDeleted', '0');
        if($type == 'staff'){

            $this->db->where("BaseTbl.id  IN ($subQueryStaff)", NULL, FALSE);
        } else if($type == 'section'){

            $this->db->where("BaseTbl.id  IN ($subQuerySection)", NULL, FALSE);
        } else if($type == 'management'){
            $this->db->where("BaseTbl.id  IN ($subQueryManagement)", NULL, FALSE);
        }
        //$this->db->limit(15);
        $this->db->group_by('BaseTbl.id');

        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function officerLicenseApplicationHistory($officerid)
    {
        $sql = 'SELECT `BaseTbl`.*, `LicenseType`.`licenseType`, `LicenseType`.`licenseSubType`, (SELECT tbl_licensehistory.type FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) AS applicationType FROM `tbl_license` as `BaseTbl` LEFT JOIN `tbl_licensetype` as `LicenseType` ON `LicenseType`.`id` = `BaseTbl`.`licenseTypeId` WHERE `BaseTbl`.`isDeleted` = 0 AND (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) = '.$officerid.' GROUP BY `BaseTbl`.`id` ORDER BY STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i") DESC';
        $query = $this->db->query($sql);
        return $query->result();
    }

    function licenseApplicationHistory()
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType,(CASE WHEN licensestatus IS NOT NULL THEN "1" WHEN postchangeStatus IS NOT NULL THEN "2" WHEN renewalStatus IS NOT NULL THEN "3" END) AS applicationType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.licenseStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        $this->db->group_by('BaseTbl.id');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function registrationApplicationHistory()
    {


        //    $acid = '0826024268';
        $compid = (int)$this->companyUniqueNo;
        /*if($this->userId == 772){
            $compid = (int)'0826024268';
        }
        */
        $sql = "SELECT
        optimizedSub1.*,
		(SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`isCompany` = 1
            AND `BaseTbl`.`isunderprocess` = 0
            AND `BaseTbl`.`companyAccountId` = " . $compid . "
            
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function newlicense($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, Company.companyName, Company.companyNTN, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.id < BaseTbl.id AND tbl_license.licenseStatus = "Submitted") as queuePosition, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.status = "Active" AND tbl_license.licenseStatus = "Approved" AND tbl_license.companyId = '.$this->companyId.') as countApprovedLicense, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.companyId = '.$this->companyId.') as countLicense, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficerId, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.forwardedRole = "Assistant Director Licensing" ORDER BY tbl_licensehistory.id DESC LIMIT 1) as deskOfficer');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Company.companySubCategory !=', 'Importer');
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('BaseTbl.status',  'Active');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  NULL);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  '');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.licenseStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId == '56'){ // QMS Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '6'){ // Licensing Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '10'){ // Licensing Additional Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '14'){ // Licensing Deputy Director
			$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '18'){ // Licensing Assistant Director
            //$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where('(SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) = '.$this->userId.'');
            //$this->db->where('LicenseHistory.id = (SELECT MAX(tbl_licensehistory.id) FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id)');
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '38'){ // Licensing Assigning Officer
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            //$this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '43'){ // Licensing Board Secretary
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '42'){ // CEO
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->where('BaseTbl.licenseStatus !=', '');
            $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
            //$this->db->where('BaseTbl.phase !=', 'Site Verification');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        if(!empty($searchText)) {
            //$this->db->where('BaseTbl.licenseStatus', $searchText);
        }
        //$this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
	//echo $this->db->get_compiled_select();

        $query = $this->db->get();
        
        $result = $query->result();  
        return $result;
    }

    function newlicenseEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, City.cityName as siteCityName, Company.companyName, Company.companyUniqueNo, Company.companyType, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedUserId,(SELECT tbls_user.roleId FROM tbl_licensehistory LEFT JOIN tbls_user ON tbl_licensehistory.forwardedTo = tbls_user.id  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT rating FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as rating, (SELECT MAX(tbl_license.id) FROM tbl_license WHERE tbl_license.licenseStatus = "Approved" and tbl_license.companyId = BaseTbl.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
		$this->db->join('tbls_city as City','City.id = BaseTbl.siteCity','left');

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function licensereportEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, City.cityName as siteCityName, Company.companyName, Company.companyUniqueNo, Company.companyType, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedUserId,(SELECT tbls_user.roleId FROM tbl_licensehistory LEFT JOIN tbls_user ON tbl_licensehistory.forwardedTo = tbls_user.id  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT rating FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as rating, (SELECT MAX(tbl_license.id) FROM tbl_license WHERE tbl_license.licenseStatus = "Approved" and tbl_license.companyId = BaseTbl.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbls_city as City','City.id = BaseTbl.siteCity','left');

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function applylicenseDetailManagementEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companymanagement as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenseDetailSectionEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenseDetailSectionMachineEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesectionmachine as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function approvedQCIncharge($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.designationId', 2);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
    function approvedPIncharge($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.designationId', 1);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function applylicenseDetailQualifiedStaffEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function applylicenseDetailQualifiedStaffAllEdit($id)
    {
        $this->db->select('BaseTbl.*,Qualification.qualification,Specialization.specialization,Designation.designation');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        $this->db->join('tbl_companyqualification as Qualification','BaseTbl.qualificationId = Qualification.id','left');
        $this->db->join('tbl_companyspecialization as Specialization','BaseTbl.specializationId = Specialization.id','left');
        $this->db->join('tbl_companydesignation as Designation','BaseTbl.designationId = Designation.id','left');

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function applylicenseDetailLayoutPlanEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenselayoutplan as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenseDetailApiEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenseapi as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function applylicenseDetailFacilityEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensefacility as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function licenseDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $this->db->where('BaseTbl.type', 'License');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
	function licenseQueryEdit911($id)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_query2 as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $otherdb->where('BaseTbl.type', 'License');
        $otherdb->where('BaseTbl.authorization', 'Granted');
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
	function licenseQueryAttachments911($id)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
		
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_queryattachment as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $otherdb->order_by('BaseTbl.id', 'asc');
		//echo $otherdb->get_compiled_select(); 
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function licenseDetailMeetingEdit($id)
    {
        $this->db->select('BaseTbl.id, BaseTbl.meetingNo, BaseTbl.meetingDate, BaseTbl.isheld, MeetingAgenda.id as agendaid, MeetingAgenda.remarks, MeetingAgenda.status, MeetingAgenda.type');
        $this->db->from('tbl_licensemeeting as BaseTbl');
		$this->db->join('tbl_meetingagenda as MeetingAgenda','MeetingAgenda.meetingid = BaseTbl.id','left');

        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('MeetingAgenda.masterId', $id);
        //$this->db->where('BaseTbl.type', 'License');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function licenseDetailHistoryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensehistory as BaseTbl');
        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function sectionApprovedGet11($id)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmaGroupApprovedGet11($id)
    {
        $this->db->select('BaseTbl.*, PharmaGroup.pharmaGroup');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by('BaseTbl.pharmaGroupId');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function usedForApprovedGet11($id)
    {
        $this->db->select('BaseTbl.*, UsedFor.usedFor');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by('BaseTbl.usedForId');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenserenewal($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, Company.companyName, Company.companyNTN, LicenseType.licenseType, LicenseType.licenseSubType, (SELECT COUNT(tbl_query.id) FROM tbl_query WHERE tbl_query.masterId = BaseTbl.id ) as totalQueries, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.id < BaseTbl.id AND tbl_license.renewalStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficerId, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.forwardedRole = "Assistant Director Licensing" ORDER BY tbl_licensehistory.id DESC LIMIT 1) as deskOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Company.companySubCategory !=', 'Importer');
        //$this->db->where('BaseTbl.status', 'Active');

        $this->db->where('BaseTbl.renewalStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId == '56'){ // QMS Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '6'){ // Licensing Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '10'){ // Licensing Additional Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '14'){ // Licensing Deputy Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '18'){ // Licensing Assistant Director
            $this->db->where('LicenseHistory.forwardedTo', $this->userId);
            //$this->db->where('LicenseHistory.id = (SELECT MAX(tbl_licensehistory.id) FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id)');
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '38'){ // Licensing Assigning Officer
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '43'){ // Licensing Board Secretary
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        // $this->db->where('Status.page', 'Apply License');
        //$this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        if($this->userEmail == 'ao-licensing@dra.gov.pk'){
            //echo $this->db->get_compiled_select();
        }

        $query = $this->db->get();
        
        $result = $query->result(); 
	
        return $result;
    }

    function licenserenewalEdit($id, $table)
    {
        $this->db->select('BaseTbl.*,Challan.challan_no,Challan.challan_fee,Challan.challan_status,Challan.challan_msg,Challan.challan_date, Company.companyName, Company.companyUniqueNo, Company.companyType, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedUserId,(SELECT tbls_user.roleId FROM tbl_licensehistory LEFT JOIN tbls_user ON tbl_licensehistory.forwardedTo = tbls_user.id  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedroleId ,(SELECT tbls_user.roleId FROM tbl_licensehistory LEFT JOIN tbls_user ON tbl_licensehistory.forwardedTo = tbls_user.id  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT rating FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as rating, (SELECT MAX(tbl_license.id) FROM tbl_license WHERE tbl_license.licenseStatus = "Approved" and tbl_license.companyId = BaseTbl.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_challan as Challan','Challan.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenserenewalDetailManagementEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companymanagement as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenserenewalDetailSectionEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesection as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenserenewalDetailSectionMachineEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesectionmachine as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenserenewalDetailQualifiedStaffEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function applylicenseapprovedRecord($table,$id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function applylicenserenewalDetailLayoutPlanEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenselayoutplan as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicenserenewalDetailApiEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenseapi as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenserenewalDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $this->db->where('BaseTbl.type', 'License Renewal');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function sectionApprovedGet1($id)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmaGroupApprovedGet1($id)
    {
        $this->db->select('BaseTbl.*, PharmaGroup.pharmaGroup');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by(['BaseTbl.masterId', 'BaseTbl.pharmaGroupId']);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function usedForApprovedGet1($id)
    {
        $this->db->select('BaseTbl.*, UsedFor.usedFor');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->group_by(['BaseTbl.masterId', 'BaseTbl.usedForId']);;
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licenseSectionApprovedGet($id)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_registration as Registration','Registration.masterId = License.id','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Registration.id', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->where('BaseTbl.recommended', 'Yes');
        //$this->db->group_by(['BaseTbl.masterId', 'BaseTbl.usedForId']);;
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licensevariance($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*,Challan.challan_no,Challan.challan_fee,Challan.challan_status,Challan.challan_msg,Challan.challan_date ,Company.companyName, Company.companyNTN, LicenseType.licenseType, LicenseType.licenseSubType,(SELECT COUNT(tbl_query.id) FROM tbl_query WHERE tbl_query.masterId = BaseTbl.id ) as totalQueries, PostLicenseChangeType.licenseType as postLicenseChangeType, PostLicenseChangeType.licenseSubType as postLicenseChangeSubType, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.id < BaseTbl.id AND tbl_license.postchangeStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficerId, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.postchangeStatus = "Draft" and tbl_license.companyId = '.$this->companyId.' and tbl_license.isDeleted = 0) as countPendingVariance, (SELECT tbls_user.userName FROM tbl_licensehistory LEFT JOIN tbls_user ON tbls_user.id = tbl_licensehistory.forwardedTo WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.forwardedRole = "Assistant Director Licensing" ORDER BY tbl_licensehistory.id DESC LIMIT 1) as deskOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbl_challan as Challan','Challan.masterId = BaseTbl.id','left');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbl_licensetype as PostLicenseChangeType','PostLicenseChangeType.id = BaseTbl.postchangeTypeId','left');
        $this->db->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        //$this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('Company.companySubCategory !=', 'Importer');
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('BaseTbl.status',  'Active');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  NULL);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  '');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.postchangeStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId == '56'){ // QMS Director
            //$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '6'){ // Licensing Director
			//$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '10'){ // Licensing Additional Director
			//$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '14'){ // Licensing Deputy Director
			$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '18'){ // Licensing Assistant Director
            $this->db->where('LicenseHistory.forwardedTo', $this->userId);
            //$this->db->where('LicenseHistory.id = (SELECT MAX(tbl_licensehistory.id) FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id)');
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '38'){ // Licensing Assigning Officer
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '43'){ // Licensing Board Secretary
			//$this->db->where('LicenseHistory.forwardedTo', $this->userId);
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        // $this->db->where('Status.page', 'Apply License');
        //$this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.submissionDate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function licensevarianceEdit($id, $table)
    {
        $this->db->select('BaseTbl.*,Challan.challan_no,Challan.challan_fee,Challan.challan_status,Challan.challan_msg,Challan.challan_date , Company.companyName, Company.companyUniqueNo, Company.companyType, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedUserId, (SELECT tbls_user.roleId FROM tbl_licensehistory LEFT JOIN tbls_user ON tbl_licensehistory.forwardedTo = tbls_user.id  WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT rating FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as rating, (SELECT MAX(tbl_license.id) FROM tbl_license WHERE tbl_license.licenseStatus = "Approved" and tbl_license.companyId = BaseTbl.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->join('tbl_challan as Challan','Challan.masterId = BaseTbl.id','left');
        //$this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }
    function getChallanInfo($id, $phase = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_challan as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        if($phase != NULL){
            $this->db->where('BaseTbl.phase', $phase);
        }
        $query = $this->db->get();

        return $query->result();
    }
    function getQueryChallanInfo($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_challan as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.queryid', $id);
        $query = $this->db->get();

        return $query->result();
    }

    function applylicensevarianceDetailManagementEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companymanagement as BaseTbl');
        //$this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->where('License.licenseStatus', 'Approved');
        //$this->db->where('License.status', 'Active');
        //$this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicensevarianceDetailSectionEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesection as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicensevarianceDetailSectionMachineEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesectionmachine as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicensevarianceDetailQualifiedStaffEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicensevarianceDetailLayoutPlanEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenselayoutplan as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applylicensevarianceDetailApiEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licenseapi as BaseTbl');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licensevarianceDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('License', 'License Renewal', 'Post License Change'));
        $this->db->where('BaseTbl.type', 'Post License Change');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function licensesGet1($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId == '26'){
            $this->db->where('BaseTbl.companyId', $this->companyId);
        }
        if($this->roleId <> '26'){
            $this->db->where('BaseTbl.companyId', $id);
        }
        $this->db->where('LicenseType.licenseType', 'License');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where_in('BaseTbl.renewalStatus', array('Approved'));
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where_in('BaseTbl.postchangeStatus', array('Approved'));
            $this->db->group_end();
        $this->db->group_end();
        $this->db->limit(1);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        //$this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }
    function getCompanyActiveLicenseApplications($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companyId', $id);
        $this->db->or_group_start();
            $this->db->where('BaseTbl.renewalStatus !=', 'Approved');
            $this->db->where('BaseTbl.postchangeStatus !=', 'Approved');
        $this->db->group_end();
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    function getCompanyApprovedLicense($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType,Company.companyName');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Company.companyUniqueNo', $id);
        $this->db->where('LicenseType.licenseType', 'License');
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $this->db->limit(1);
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();

        return $query->result();
    }


    function getLicense($id)
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->where('BaseTbl.id', $id);
        $this->db->where('LicenseType.licenseType', 'License');
        
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        //$this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.licenseStatus', array('Approved'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $query = $this->db->get();
        
        return $query->result();
    }
	function getLicensesForVariance()
    {
        $this->db->select('BaseTbl.*, LicenseType.licenseType, LicenseType.licenseSubType');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId == 26)
            $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->where('LicenseType.licenseType', 'License');
        
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        //$this->db->where('BaseTbl.status', 'Active');
        //$this->db->where_in('BaseTbl.licenseStatus', array('Approved','Draft'));
        //$this->db->where('STR_TO_DATE(BaseTbl.validTill,"%d-%b-%y %H:%i") >=', date($this->dateTimeFormat));
        $this->db->limit(1);
        $query = $this->db->get();
        
        return $query->result();
    }
    function registrationquery($table, $searchText = NULL)
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('BaseTbl.*, Company.companyName');
        $otherdb->from('tbl_registrationquery as BaseTbl');
        $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $otherdb->where('BaseTbl.isDeleted', 0);
        if($this->roleId == 26){
            $otherdb->where('BaseTbl.companyId', $this->companyId);
        }
        $otherdb->group_by(array("BaseTbl.officerid", "BaseTbl.companyId"));

        $otherdb->order_by('BaseTbl.createddate', 'desc');

        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function newLicenseHistory()
    {
        $this->db->select('count(BaseTbl.id) as totalapplications, BaseTbl.licenseStatus');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.licenseStatus !=', 'Draft');
        $this->db->where('BaseTbl.licenseStatus !=', '');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_by('BaseTbl.licenseStatus');

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function renewalLicenseHistory()
    {
        $this->db->select('count(BaseTbl.id) as totalapplications, BaseTbl.renewalStatus as licenseStatus');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.renewalStatus !=', 'Draft');
        $this->db->where('BaseTbl.renewalStatus !=', '');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_by('BaseTbl.renewalStatus');

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function varianceLicenseHistory()
    {
        $this->db->select('count(BaseTbl.id) as totalapplications, BaseTbl.postchangeStatus as licenseStatus');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.postchangeStatus !=', 'Draft');
        $this->db->where('BaseTbl.postchangeStatus !=', '');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->group_by('BaseTbl.postchangeStatus');

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }
    function inprocessHistory()
    {

        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('count(BaseTbl.id) as totalapplications, BaseTbl.licenseStatus');
        $otherdb->from('tbl_license as BaseTbl');
        $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
        $otherdb->where('BaseTbl.licenseStatus !=', '');

        $otherdb->group_by('BaseTbl.licenseStatus');

        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function registrationqueryEdit($id,$oid, $table)
    {
        $otherdb = $this->load->database('otherdb', TRUE);

        $otherdb->select('BaseTbl.*, Company.companyName, Company.companyUniqueNo');
        $otherdb->from($table.' as BaseTbl');
        $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $otherdb->where('BaseTbl.isDeleted', 0);
        if($this->roleId == 26){
            $otherdb->where('BaseTbl.companyId', $this->companyId);
        }else{
            $otherdb->where('BaseTbl.companyId', $id);
        }
        $otherdb->where('BaseTbl.officerid', $oid);
        $otherdb->order_by('BaseTbl.status', 'desc');
        $otherdb->order_by('BaseTbl.updateddate', 'asc');

        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
    function query($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, User.userName, (CASE WHEN BaseTbl.type = \'License\' THEN (SELECT tbl_license.licenseStatus FROM tbl_license WHERE tbl_license.id = BaseTbl.masterId) WHEN BaseTbl.type = \'License Renewal\' THEN (SELECT tbl_license.renewalStatus FROM tbl_license WHERE tbl_license.id = BaseTbl.masterId) WHEN BaseTbl.type = \'Post License Change\' THEN (SELECT tbl_license.postchangeStatus FROM tbl_license WHERE tbl_license.id = BaseTbl.masterId) WHEN BaseTbl.type = \'Registration Export\' THEN (BaseTbl.applicationStatus) WHEN BaseTbl.type = \'Registration\' THEN (SELECT tbl_registration.registrationStatus FROM tbl_registration WHERE tbl_registration.id = BaseTbl.masterId) WHEN BaseTbl.type = \'Registration Renewal\' THEN (SELECT tbl_registration.renewalStatus FROM tbl_registration WHERE tbl_registration.id = BaseTbl.masterId) WHEN BaseTbl.type = \'Post Registration Change\' THEN (SELECT tbl_registration.postchangeStatus FROM tbl_registration WHERE tbl_registration.id = BaseTbl.masterId) ELSE "" END) as applicationStatus');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_registration as Registration','Registration.id = BaseTbl.masterId','left');
        $this->db->join('tbl_inspection as Inspection','Inspection.id = BaseTbl.masterId','left');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
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
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        //echo $this->db->get_compiled_select();
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function queryEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function letterConditions($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('BaseTbl.id', 'desc');

        $query = $this->db->get();

        $result = $query->result();
        return $result;
    }

    function letterConditionsEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();

        return $query->result();
    }


    function panelpool($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, User.userName');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_user as User','User.id = BaseTbl.userId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function panelpoolEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspection($table, $searchText = NULL)
    {
        if($this->roleId == 26){
            $this->db->select('BaseTbl.*, Company.companyName, InspectionType.inspectionType, InspectionType.inspectionSubType, (SELECT tbl_panelpool.userId FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserId, (SELECT tbls_user.userName FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId LEFT JOIN tbls_user ON tbls_user.id = tbl_panelpool.userId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserName');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
            $this->db->join('tbl_inspectiontype as InspectionType','InspectionType.id = BaseTbl.inspectionTypeId','left');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.companyId', $this->companyId);
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
            //$this->db->limit(15);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
        if($this->roleId <> 26){
            $this->db->select('BaseTbl.*, Company.companyName, InspectionType.inspectionType, InspectionType.inspectionSubType, (SELECT tbl_panelpool.userId FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserId, (SELECT tbls_user.userName FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId LEFT JOIN tbls_user ON tbls_user.id = tbl_panelpool.userId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserName');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
            $this->db->join('tbl_inspectiontype as InspectionType','InspectionType.id = BaseTbl.inspectionTypeId','left');
            $this->db->where('BaseTbl.isDeleted', 0);
            if($this->roleId == '56'){ // QMS Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            if($this->roleId == '36'){ // Inspection Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else if($this->roleId == '6'){ // Licensing Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else if($this->roleId == '7'){ // Registration Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else if($this->roleId == '12'){ // Inspection Additional Director
                $this->db->where_in('BaseTbl.inspectionStatus', array('Draft', 'Inspection Scheduled', 'Inspection Pending', 'Initiated', 'Inspection Completed', 'Panel Meeting Scheduled', 'Panel Meeting Pending', 'Under Review Stage 1', 'CAPA Awaited From Company', 'CAPA Received From Company', 'Under Review Stage 2', 'Review Complete', 'Further Information Required', 'Follow-Up Inspection', 'Re-Inspection', 'Deferred and Closed', 'Approved'));
                //$this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else if($this->roleId == '37'){ // Inspection Deputy Director
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else if($this->roleId == '16'){ // Inspection FID
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
                $this->db->having('leadUserId', $this->userId);
            }
            else if($this->roleId == '20'){ // Inspection Assistant Director
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
                $this->db->having('leadUserId', $this->userId);
            }
            else if($this->roleId == '18'){ // Licensing Assistant Director
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
                $this->db->having('leadUserId', $this->userId);
            }
            else if($this->roleId == '19'){ // Registration Assistant Director
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
                $this->db->having('leadUserId', $this->userId);
            }
            else if($this->roleId == '42'){ // CEO
                $this->db->where_not_in('BaseTbl.inspectionStatus', array('Draft'));
                $this->db->where('BaseTbl.inspectionStatus !=', '');
            }
            else{
                $this->db->where('BaseTbl.id', '0');
            }
            //$this->db->limit(15);
            //$this->db->group_by('BaseTbl.id');
            //$this->db->order_by('BaseTbl.id', 'desc');
            $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);

            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
    }

    function inspectionEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, License.latitude, License.longitude, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, License.pvmg4, License.licenseTypeId, License.dmlFeeChallan, License.dmlLegalStatus, License.dmlProForma, License.dmlForm1, License.svStatusOfFirm, License.svCopyOfCNIC, License.svRegistrationCertificate, License.svLandDocument, License.svSiteMap, License.qsDocuments, License.qsDocuments2, Company.companyType, Company.companyName, Company.companyUniqueNo, (SELECT tbl_panelpool.userId FROM tbl_inspectionmember LEFT JOIN tbl_panelpool ON tbl_panelpool.id = tbl_inspectionmember.memberId WHERE tbl_inspectionmember.masterId = BaseTbl.id AND tbl_inspectionmember.isLead = "Yes" ORDER BY tbl_inspectionmember.id DESC LIMIT 1) as leadUserId, (SELECT tbl_license.googleMapURL FROM tbl_license WHERE tbl_license.companyId = BaseTbl.companyId AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as googleMapURL1, (SELECT tbl_license.siteAddress FROM tbl_license WHERE tbl_license.companyId = BaseTbl.companyId AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as siteAddress1, (SELECT tbl_license.siteCity FROM tbl_license WHERE tbl_license.companyId = BaseTbl.companyId AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as siteCity1, (SELECT tbl_license.licenseNoManual FROM tbl_license WHERE tbl_license.companyId = BaseTbl.companyId AND tbl_license.licenseStatus = "Approved" ORDER BY tbl_license.id DESC LIMIT 1) as licenseNoManual1');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.refId','left');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailSection1Edit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionsection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailSectionEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailRegistrationEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionregistration as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailMemberEdit($id)
    {
        $this->db->select('BaseTbl.*, PanelPool.type, PanelPool.userId');
        $this->db->from('tbl_inspectionmember as BaseTbl');
        $this->db->join('tbl_panelpool as PanelPool','PanelPool.id = BaseTbl.memberId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailMemberExternalEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionmemberexternal as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailMemberPostEdit($id)
    {
        $this->db->select('BaseTbl.*, PanelPool.type, PanelPool.userId');
        $this->db->from('tbl_inspectionmemberpost as BaseTbl');
        $this->db->join('tbl_panelpool as PanelPool','PanelPool.id = BaseTbl.memberId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailMemberExternalPostEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionmemberexternalpost as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailImageEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionimage as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailMeetingEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectionmeeting as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailManagementEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_companymanagement as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_inspection as Inspection','Inspection.refId = License.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('Inspection.id', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailChecklistEdit($id)
    {
        $this->db->select('BaseTbl.*, Inspection.inspectionStatus');
        $this->db->from('tbl_inspectionchecklist as BaseTbl');
        $this->db->join('tbl_inspection as Inspection','Inspection.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailDocumentChecklistEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectiondocumentchecklist as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailChecklistReportEdit($id)
    {
        $this->db->select('BaseTbl.*, InspectionChecklistQuestion.checklistNo, InspectionChecklistQuestion.checklistName, InspectionChecklistSection.section, InspectionChecklistQuestion.trsNumber, InspectionChecklistQuestion.url');
        $this->db->from('tbl_inspectionchecklist as BaseTbl');
        $this->db->join('tbl_inspectionchecklistquestion as InspectionChecklistQuestion','InspectionChecklistQuestion.id = BaseTbl.checklistId','left');
        $this->db->join('tbl_inspectionchecklistsection as InspectionChecklistSection','InspectionChecklistSection.id = InspectionChecklistQuestion.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where_in('BaseTbl.inspectorRating', array('Critical', 'Major', 'Minor'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailCAPAEdit($id)
    {
        $this->db->select('BaseTbl.*, InspectionChecklistQuestion.checklistNo, InspectionChecklistQuestion.checklistName, InspectionChecklistSection.section, InspectionChecklistQuestion.trsNumber, InspectionChecklistQuestion.url');
        $this->db->from('tbl_inspectionchecklist as BaseTbl');
        $this->db->join('tbl_inspectionchecklistquestion as InspectionChecklistQuestion','InspectionChecklistQuestion.id = BaseTbl.checklistId','left');
        $this->db->join('tbl_inspectionchecklistsection as InspectionChecklistSection','InspectionChecklistSection.id = InspectionChecklistQuestion.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where_in('BaseTbl.panelRating', array('Critical', 'Major', 'Minor'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function inspectionDetailCAPAEdit1($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_inspectioncapa as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function companySectionGet($id)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('License.status', 'Active');
        $this->db->where('License.companyId', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function companyRegistrationGet($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('License.status', 'Active');
        $this->db->where('License.companyId', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function sectionApprovedGet12($id)
    {
        $this->db->select('BaseTbl.*, Section.section');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_section as Section','Section.id = BaseTbl.sectionId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pharmaGroupApprovedGet12($id)
    {
        $this->db->select('BaseTbl.*, PharmaGroup.pharmaGroup');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_pharmagroup as PharmaGroup','PharmaGroup.id = BaseTbl.pharmaGroupId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function usedForApprovedGet12($id)
    {
        $this->db->select('BaseTbl.*, UsedFor.usedFor');
        $this->db->from('tbl_licensesection as BaseTbl');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        // $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        // $this->db->where('License.licenseStatus', 'Approved');
        // $this->db->where('License.status', 'Active');
        // $this->db->where('License.companyId', $id);
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where('BaseTbl.approved', 'Yes');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
	
	 function meetingagenda($table, $searchText = NULL)
    {
        if($this->roleId == 43){ //Secretary Licensing
            $this->db->select('BaseTbl.*, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, Company.companyName, Company.companyName, (SELECT tbl_licensehistory.dateTime FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.licenseStatus = \'Under Board Stage 2\' THEN \'License\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'License Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post License Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
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
            $this->db->where('BaseTbl.discussInBoard', 0);
            //$this->db->limit(100);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
        if($this->roleId == 44){ //Secretary Registration
            $this->db->select('BaseTbl.*, RegistrationType.registrationType as myType, RegistrationType.registrationSubType as mySubType, Company.companyName, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 1\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
            $this->db->from('tbl_registration as BaseTbl');
            $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
            $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
            $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->group_start();
                $this->db->group_start();
                    $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 1');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2');
                $this->db->group_end();
            $this->db->group_end();
            $this->db->where('BaseTbl.discussInBoard', 0);
            //$this->db->limit(100);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
    }


    function agendaandminutes($table, $searchText = NULL)
    {
        if($this->roleId == 18){ //Assistant Director Licensing
            $this->db->select('BaseTbl.*, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, Company.companyName, Company.companyName, (SELECT tbl_licensehistory.dateTime FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.licenseStatus = \'Under Board Stage 2\' THEN \'License\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'License Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post License Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
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
            $this->db->where('BaseTbl.discussInBoard', 0);
            //$this->db->limit(100);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
        if($this->roleId == 19){ //Assistant Director Registration
            $this->db->select('BaseTbl.*, RegistrationType.registrationType as myType, RegistrationType.registrationSubType as mySubType, Company.companyName, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
            $this->db->from('tbl_registration as BaseTbl');
            $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
            $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
            $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->group_start();
                $this->db->group_start();
                    $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2');
                $this->db->group_end();
            $this->db->group_end();
            $this->db->where('BaseTbl.discussInBoard', 0);
            //$this->db->limit(100);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
        if($this->roleId == 43){ // Licensing Secretary
            if($searchText == NULL){
				$this->db->select('BaseTbl.*');
				$this->db->from('tbl_licensemeeting as BaseTbl');
				$this->db->where('BaseTbl.isDeleted', 0);
				$this->db->where('BaseTbl.createdby', $this->userId);
				$this->db->order_by('BaseTbl.id', 'desc');
				$this->db->order_by('BaseTbl.isheld', 'desc');
				$query = $this->db->get();
				
				$result = $query->result();        
				return $result;
			}else{
				$this->db->select('BaseTbl.*,MeetingAgenda.id as agendaid, LicenseType.licenseType as myType, LicenseType.licenseSubType as mySubType, Company.companyName, (SELECT tbl_licensehistory.dateTime FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id ORDER BY tbl_licensehistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.licenseStatus = \'Under Board Stage 2\' THEN \'License\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'License Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post License Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
				$this->db->from('tbl_license as BaseTbl');
				$this->db->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
				$this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
				//$this->db->join('tbl_licensemeeting  as LicenseMeeting','LicenseMeeting.id = BaseTbl.meetingid','left');
				$this->db->join('tbl_meetingagenda as MeetingAgenda','MeetingAgenda.masterId = BaseTbl.id','left');
				$this->db->where('BaseTbl.isDeleted', 0);

				$this->db->where('MeetingAgenda.meetingid', $searchText);
				
				$this->db->order_by('BaseTbl.id', 'desc');
				$this->db->group_by('MeetingAgenda.id');
				$this->db->group_by('BaseTbl.id');

				$query = $this->db->get();

				$result = $query->result();
		
				return $result;
			}
        }
        if($this->roleId == 44){ //Registration Secretary

            if($searchText == NULL){
                $this->db->select('BaseTbl.*');
                $this->db->from('tbl_registrationmeeting as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.createdby', $this->userId);
                $this->db->order_by('BaseTbl.id', 'desc');
                $this->db->order_by('BaseTbl.isheld', 'desc');
                $query = $this->db->get();

                $result = $query->result();

                return $result;
            }
            else{
                $this->db->select('BaseTbl.*,MeetingAgenda.id as agendaid, RegistrationType.registrationType as myType, RegistrationType.registrationSubType as mySubType, Company.companyName, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id ASC LIMIT 1) as submissionDate, (CASE WHEN BaseTbl.registrationStatus = \'Under Board Stage 2\' THEN \'Registration\' WHEN BaseTbl.renewalStatus = \'Under Board Stage 2\' THEN \'Registration Renewal\' WHEN BaseTbl.postchangeStatus = \'Under Board Stage 2\' THEN \'Post Registration Change\' ELSE "" END) as type, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks');
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
                $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
                $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');


                $this->db->join('tbl_meetingagenda as MeetingAgenda','MeetingAgenda.masterId = BaseTbl.id','left');
                $this->db->where('BaseTbl.isDeleted', 0);

                $this->db->where('MeetingAgenda.meetingid', $searchText);

                $this->db->order_by('BaseTbl.id', 'desc');
                $this->db->group_by('MeetingAgenda.id');
                $this->db->group_by('BaseTbl.id');

                $query = $this->db->get();

                $result = $query->result();

                return $result;
            }




            /*$this->db->group_start();
                $this->db->group_start();
                    $this->db->where('BaseTbl.registrationStatus', 'Under Board Stage 2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.renewalStatus', 'Under Board Stage 2');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('BaseTbl.postchangeStatus', 'Under Board Stage 2');
                $this->db->group_end();
            $this->db->group_end();
            */

        }
    }
	
	
    function newregistration($table, $searchText = NULL)
    {
        $txt = ["test3", "Scotmann Pharmaceuticals", "Shaigan Pharmaceuticals (Pvt) Ltd", "Crystolite", "Rotex Pharma Private Limited", "HIMMEL PHARMACEUTICALS (PVT.) LTD", "Lab Diagnostic Systems (SMC) Pvt. Ltd.", "M/s Amgomed", "Vety Care (Pvt) Ltd.", "Kanel Pharma", "Seraph Pharmaceutical"];

        $txt2=  in_array($_SESSION["match"], $txt);
        
        if($txt2==true)
        {?>

        <?php
            //    $acid = '0826024268';
            $compid = (int)$this->companyUniqueNo;
            if($this->userId == 772){
                $compid = (int)'0826024268';
            }
            $sql = "SELECT
        optimizedSub1.*,
		
        (SELECT
            tbls_user.userName 
        FROM
            tbl_registrationhistory 
        LEFT JOIN
            tbls_user 
                ON tbls_user.id = tbl_registrationhistory.forwardedTo 
        WHERE
            tbl_registrationhistory.masterId = optimizedSub1.BaseTbl_id 
        ORDER BY
            tbl_registrationhistory.id DESC LIMIT 1) AS assignedOfficer,
			
			
			
        (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Company`.`companyNTN` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyNTN`,
        (SELECT
            `Company`.`dslNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `dslNo`,
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0
            AND `BaseTbl`.`isexport` = 0 
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`isCompany` = 1
            AND `BaseTbl`.`isunderprocess` = 0
            AND `BaseTbl`.`companyAccountId` = " . $compid . "
            
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

            $query = $this->db->query($sql);
            return $query->result();



        /*
        //return array();
        die();
        $this->db->select('BaseTbl.*, License.licenseNo, License.companyId, Company.companyName, Company.companyNTN, Company.dslNo, LicenseType.licenseType, LicenseType.licenseSubType, License.licenseNoManual, License.issueDateManual as licIssueDateManual, RegistrationType.registrationType, RegistrationType.registrationSubType, ProductOrigin.productOrigin, ProductCategory.productCategory, UsedFor.usedFor, (SELECT COUNT(tbl_registration.id) FROM tbl_registration WHERE tbl_registration.id < BaseTbl.id AND tbl_registration.registrationStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
        $this->db->join('tbl_productcategory as ProductCategory','ProductCategory.id = BaseTbl.productCategoryId','left');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $this->db->join('tbl_registrationhistory as RegistrationHistory','RegistrationHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('BaseTbl.status',  'Active');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  NULL);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  '');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.registrationStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('License.companyId', $this->companyId);
        }
        else if($this->roleId == '7'){ // Registration Director
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '11'){ // Registration Additional Director
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '15'){ // Registration Deputy Director
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '19'){ // Registration Assistant Director
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('RegistrationHistory.forwardedTo', $this->userId);
            //$this->db->where('RegistrationHistory.id = (SELECT MAX(tbl_registrationhistory.id) FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id)');
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '39'){ // Registration Assigning Officer
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '44'){ // Registration Board Secretary
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '45'){ // Registration Pricing User
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '51'){ // Registration Screening Officer
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $this->db->where('BaseTbl.registrationStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        // $this->db->where('Status.page', 'Apply License');
        $this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
        */
         }
        else{
            ?>

            <?php
        }

    }

    function newregistrationEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, Company.companyName, Company.companySubCategory, Company.companyUniqueNo, License.companyId, License.googleMapURL, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, Dosage.dosageName, ATCCode.atcName, Unit.unit, (SELECT tbl_registrationhistory.forwardedTo FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedUserId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT MAX(tbl_registration.id) FROM tbl_registration LEFT JOIN tbl_license ON tbl_license.id = tbl_registration.masterId WHERE tbl_registration.registrationStatus = "Approved" and tbl_license.companyId = License.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
        $this->db->join('tbl_atccode as ATCCode','ATCCode.id = BaseTbl.atcCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function applyregistrationDetailProposedNameEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationproposedname as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applyregistrationDetailINNEdit($id)
    {
        $this->db->select('BaseTbl.*, INNCode.atcName, Unit.unit');
        $this->db->from('tbl_registrationinn as BaseTbl');
        $this->db->join('tbl_atccode as INNCode','INNCode.id = BaseTbl.innCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function applyregistrationOtherManufacturerEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationothermanufacturer as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function applyregistrationDetailProposedPackingEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationproposedprice as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applyregistrationDetailDomesticReferenceEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationdomesticreference as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function applyregistrationDetailInternationalReferenceEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationinternationalreference as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change', 'Registration Export'));
        //$this->db->where('BaseTbl.type', 'Registration');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function registrationDetailMeetingEdit($id)
    {
        $this->db->select('BaseTbl.id, BaseTbl.meetingNo, BaseTbl.meetingDate, BaseTbl.isheld, MeetingAgenda.id as agendaid, MeetingAgenda.remarks, MeetingAgenda.status, MeetingAgenda.type');
        $this->db->from('tbl_registrationmeeting as BaseTbl');
        $this->db->join('tbl_meetingagenda as MeetingAgenda','MeetingAgenda.meetingid = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('MeetingAgenda.masterId', $id);
        //$this->db->where('BaseTbl.type', 'Registration');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationDetailHistoryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationhistory as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationrenewal($table, $searchText = NULL)
    {
        if(($this->roleId == '26' && $this->userId == 772) || $this->roleId <> '26') {

            $sql = "SELECT
        optimizedSub1.*,
		
        (SELECT
            tbls_user.userName 
        FROM
            tbl_registrationhistory 
        LEFT JOIN
            tbls_user 
                ON tbls_user.id = tbl_registrationhistory.forwardedTo 
        WHERE
            tbl_registrationhistory.masterId = optimizedSub1.BaseTbl_id 
        ORDER BY
            tbl_registrationhistory.id DESC LIMIT 1) AS assignedOfficer,
			
			
			
        (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Company`.`companyNTN` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyNTN`,
        (SELECT
            `Company`.`dslNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `dslNo`,
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0 
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`isCompany` = 1
            AND `BaseTbl`.`renewalStatus` IS NOT NULL";

            if($this->roleId == '26'){
                $compid = (int)$this->companyUniqueNo;
                if($this->userId == 772){
                    $compid = (int)'0826024268';
                }
                $sql .=  " AND `BaseTbl`.`companyAccountId` = " . $compid;
            }else{
                $sql .=  " AND `BaseTbl`.`renewalStatus` != 'Draft' ";
            }
            $sql .=  "

        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

            $query = $this->db->query($sql);
            return $query->result();
        }else{
            return array();
        }




        return array();
        die();
        $this->db->select('BaseTbl.*, License.licenseNo, License.companyId, Company.companyName, Company.companyNTN, Company.dslNo, LicenseType.licenseType, LicenseType.licenseSubType, License.licenseNoManual, License.issueDateManual as licIssueDateManual, RegistrationType.registrationType, RegistrationType.registrationSubType, ProductOrigin.productOrigin, ProductCategory.productCategory, UsedFor.usedFor, (SELECT COUNT(tbl_registration.id) FROM tbl_registration WHERE tbl_registration.id < BaseTbl.id AND tbl_registration.renewalStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
        $this->db->join('tbl_productcategory as ProductCategory','ProductCategory.id = BaseTbl.productCategoryId','left');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $this->db->join('tbl_registrationhistory as RegistrationHistory','RegistrationHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('BaseTbl.status',  'Active');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  NULL);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  '');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.renewalStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('License.companyId', $this->companyId);
        }
        else if($this->roleId == '7'){ // Registration Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '11'){ // Registration Additional Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '15'){ // Registration Deputy Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '19'){ // Registration Assistant Director
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('RegistrationHistory.forwardedTo', $this->userId);
            //$this->db->where('RegistrationHistory.id = (SELECT MAX(tbl_registrationhistory.id) FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id)');
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '39'){ // Registration Assigning Officer
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '44'){ // Registration Board Secretary
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '45'){ // Registration Pricing User
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '51'){ // Registration Screening Officer
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $this->db->where_not_in('BaseTbl.renewalStatus', array('Draft'));
            $this->db->where('BaseTbl.renewalStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        // $this->db->where('Status.page', 'Apply License');
        $this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function registrationrenewalEdit($id, $table)
    {
        $this->db->select('BaseTbl.*,Challan.challan_no,Challan.challan_fee,Challan.challan_status,Challan.challan_msg,Challan.challan_date, Company.companyName, Company.companySubCategory, Company.companyUniqueNo, License.companyId, License.googleMapURL, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, Dosage.dosageName, ATCCode.atcName, Unit.unit, (SELECT tbl_registrationhistory.forwardedTo FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedUserId, (SELECT tbls_user.roleId FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbl_registrationhistory.forwardedTo = tbls_user.id  WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT MAX(tbl_registration.id) FROM tbl_registration LEFT JOIN tbl_license ON tbl_license.id = tbl_registration.masterId WHERE tbl_registration.registrationStatus = "Approved" and tbl_license.companyId = License.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
        $this->db->join('tbl_atccode as ATCCode','ATCCode.id = BaseTbl.atcCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->join('tbl_challan as Challan','Challan.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationrenewalDetailINNEdit($id)
    {
        $this->db->select('BaseTbl.*, INNCode.atcName, Unit.unit');
        $this->db->from('tbl_registrationinn as BaseTbl');
        $this->db->join('tbl_atccode as INNCode','INNCode.id = BaseTbl.innCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationrenewalDetailProposedPackingEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationproposedprice as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationrenewalDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
        $this->db->where('BaseTbl.type', 'Registration Renewal');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationvariance($table, $searchText = NULL)
    {
        $sql = "SELECT
        optimizedSub1.*,
		
        (SELECT
            tbls_user.userName 
        FROM
            tbl_registrationhistory 
        LEFT JOIN
            tbls_user 
                ON tbls_user.id = tbl_registrationhistory.forwardedTo 
        WHERE
            tbl_registrationhistory.masterId = optimizedSub1.BaseTbl_id 
        ORDER BY
            tbl_registrationhistory.id DESC LIMIT 1) AS assignedOfficer,
			
			
			
        (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Company`.`companyNTN` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyNTN`,
        (SELECT
            `Company`.`dslNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `dslNo`,
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`isCompany` = 1
            AND BaseTbl.postchangeStatus != ''
            AND `BaseTbl`.`isexport` = 0";
        if($this->roleId == 26) {
            $compid = (int)$this->companyUniqueNo;
            $sql .= "
            AND `BaseTbl`.`companyAccountId` = " . $compid . "
            ";
        }else{
            $sql .= "
            AND `BaseTbl`.`registrationStatus` != 'Draft'
            ";
        }
        $sql .= "
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        $query = $this->db->query($sql);
        return $query->result();

        //return array();
        //die();
        $this->db->select('BaseTbl.*, License.licenseNo, License.companyId, Company.companyName, Company.companyNTN, Company.dslNo, LicenseType.licenseType, LicenseType.licenseSubType, License.licenseNoManual, License.issueDateManual as licIssueDateManual, RegistrationType.registrationType, RegistrationType.registrationSubType, ProductOrigin.productOrigin, ProductCategory.productCategory, UsedFor.usedFor, (SELECT COUNT(tbl_registration.id) FROM tbl_registration WHERE tbl_registration.id < BaseTbl.id AND tbl_registration.postchangeStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
        $this->db->join('tbl_productcategory as ProductCategory','ProductCategory.id = BaseTbl.productCategoryId','left');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $this->db->join('tbl_registrationhistory as RegistrationHistory','RegistrationHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
            $this->db->group_start();
                $this->db->where('BaseTbl.status',  'Active');
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  NULL);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where('BaseTbl.status =',  '');
            $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.postchangeStatus !=', '');
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('License.companyId', $this->companyId);
        }
        else if($this->roleId == '7'){ // Registration Director
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '11'){ // Registration Additional Director
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '15'){ // Registration Deputy Director
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '19'){ // Registration Assistant Director
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('RegistrationHistory.forwardedTo', $this->userId);
            //$this->db->where('RegistrationHistory.id = (SELECT MAX(tbl_registrationhistory.id) FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id)');
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '39'){ // Registration Assigning Officer
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '44'){ // Registration Board Secretary
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '45'){ // Registration Pricing User
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '51'){ // Registration Screening Officer
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $this->db->where_not_in('BaseTbl.postchangeStatus', array('Draft'));
            $this->db->where('BaseTbl.postchangeStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        // $this->db->where('Status.page', 'Apply License');
        $this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function registrationvarianceEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, Company.companyName,RegType.registrationType,RegType.registrationSubType, Company.companySubCategory, Company.companyUniqueNo, License.companyId, License.googleMapURL, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, Dosage.dosageName, ATCCode.atcName, Unit.unit, (SELECT tbl_registrationhistory.forwardedTo FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedUserId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT MAX(tbl_registration.id) FROM tbl_registration LEFT JOIN tbl_license ON tbl_license.id = tbl_registration.masterId WHERE tbl_registration.registrationStatus = "Approved" and tbl_license.companyId = License.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_registrationtype as RegType','RegType.id = BaseTbl.registrationTypeId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
        $this->db->join('tbl_atccode as ATCCode','ATCCode.id = BaseTbl.atcCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function registrationvarianceDetailQueryEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_query as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        //$this->db->where_in('BaseTbl.type', array('Registration', 'Registration Renewal', 'Post Registration Change'));
        $this->db->where('BaseTbl.type', 'Post Registration Change');
        $this->db->where('BaseTbl.authorization', 'Granted');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }

    function pricing($table, $searchText = NULL)
    {
        if($this->roleId == 45){
            $this->db->select('BaseTbl.*, Registration.isPriority, Company.companyName, (SELECT tbl_registrationhistory.dateTime FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.masterId ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as receiveDate, (CASE WHEN Registration.registrationStatus = \'Under Pricing\' THEN \'Registration\' WHEN Registration.renewalStatus = \'Under Pricing\' THEN \'Registration Renewal\' WHEN Registration.postchangeStatus = \'Under Pricing\' THEN \'Post Registration Change\' ELSE "" END) as type');
            $this->db->from($table.' as BaseTbl');
            if(!empty($searchText)) {
                $this->db->group_start();
                    $this->db->like('BaseTbl.fieldName', $searchText);
                    $this->db->or_like('BaseTbl.status', $searchText);
                $this->db->group_end();
            }
            $this->db->join('tbl_registration as Registration','Registration.id = BaseTbl.masterId','left');
            $this->db->join('tbl_license as License','License.id = Registration.masterId','left');
            $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->group_start();
                $this->db->group_start();
                    $this->db->where('Registration.registrationStatus',  'Under Pricing');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('Registration.renewalStatus',  'Under Pricing');
                $this->db->group_end();
                $this->db->or_group_start();
                    $this->db->where('Registration.postchangeStatus',  'Under Pricing');
                $this->db->group_end();
            $this->db->group_end();
            $this->db->where('Registration.discussInBoard', 1);
            ////$this->db->limit(15);
            //$this->db->group_by('BaseTbl.id');
            $this->db->order_by('BaseTbl.id', 'desc');
            $query = $this->db->get();
            
            $result = $query->result();        
            return $result;
        }
    }

    function rni($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId == '3'){ // Country Standard User
            //$this->db->where('Country.countryName', $this->countryName);
        }
        ////$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function rniEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function amc($table, $searchText = NULL)
    {
        $this->db->select('BaseTbl.*, Registration.approvedName, Dosage.dosageName, Company.companyName');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
                $this->db->like('BaseTbl.fieldName', $searchText);
                $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        $this->db->join('tbl_registration as Registration','Registration.id = BaseTbl.registrationId','left');
        $this->db->join('tbl_license as License','License.id = Registration.masterId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = Registration.dosageFormId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId == '26'){ // Company Submission
            $this->db->where('License.companyId', $this->companyId);
        }
        else if($this->roleId == '47'){ // AMC Incharge
            $this->db->where_not_in('BaseTbl.amcStatus', array('Draft'));
            $this->db->where('BaseTbl.amcStatus !=', '');
        }
        else{
            $this->db->where('BaseTbl.id', '0');
        }
        ////$this->db->limit(15);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function amcEdit($id, $table)
    {
        $this->db->select('BaseTbl.*, Company.companySubCategory');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_registration as Registration','Registration.id = BaseTbl.registrationId','left');
        $this->db->join('tbl_license as License','License.id = Registration.masterId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        
        return $query->result();
    }

    function apifppshortage($parameters)
    {
        $this->db->select('BaseTbl.*, Company.companyName, (SELECT tbl_companymanagement.phone FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as phone, (SELECT tbl_companymanagement.email FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as email, (SELECT tbl_companymanagement.address FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as address, (SELECT tbl_companymanagement.name FROM tbl_companymanagement WHERE tbl_companymanagement.masterId = License.companyId ORDER BY tbl_companymanagement.id ASC LIMIT 1) as name, (SELECT COUNT(tbls_company.id) FROM tbls_company WHERE tbls_company.id = License.companyId AND RegistrationINN.innManual = "'.@$parameters['innManual'].'" AND tbls_company.companySubCategory = "Manufacturer") as countManufacturer');
        $this->db->from('tbl_registration as BaseTbl');
        $this->db->join('tbl_registrationinn as RegistrationINN','RegistrationINN.masterId = BaseTbl.id','left');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.id = License.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.registrationStatus', 'Approved');
        //$this->db->where('RegistrationINN.innManual', @$parameters['innManual']);
        //$this->db->where('RegistrationINN.innManual >=', @$parameters['fromDate']);
        //$this->db->where('RegistrationINN.innManual <=', @$parameters['toDate']);
        //$this->db->limit(100);
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'desc');
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    function importlicense($table, $searchText = NULL)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*, Company.companyName, (SELECT COUNT(tbl_license.id) FROM tbl_license WHERE tbl_license.companyId = '.$this->companyId.') as countLicense , (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as assignedOfficer, , (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.forwardRole = "Assistant Director Licensing" AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as deskOfficer');
        $otherdb->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $otherdb->group_start();
                $otherdb->like('BaseTbl.fieldName', $searchText);
                $otherdb->or_like('BaseTbl.status', $searchText);
            $otherdb->group_end();
        }
        $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        //$otherdb->join('tbl_licensehistory as LicenseHistory','LicenseHistory.masterId = BaseTbl.id','left');
        //$otherdb->join('tbl_dosage as Dosage','Dosage.id = Registration.dosageFormId','left');
        $otherdb->where('BaseTbl.isDeleted', 0);
        if($this->roleId == '26'){ // Company Submission
            $otherdb->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId == '56'){ // QMS Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '6'){ // Licensing Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '10'){ // Licensing Additional Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '14'){ // Licensing Deputy Director
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '18'){ // Licensing Assistant Director
            //$otherdb->where('LicenseHistory.forwardedTo', $this->userId);
            //$this->db->where('LicenseHistory.id = (SELECT MAX(tbl_licensehistory.id) FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id)');
            //$this->db->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '38'){ // Assigning Officer
            //$otherdb->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else if($this->roleId == '43'){ // Licensing Secretary
            //$otherdb->where_not_in('BaseTbl.licenseStatus', array('Draft'));
            $otherdb->where('BaseTbl.licenseStatus !=', '');
            $otherdb->where('BaseTbl.licenseStatus !=', 'Draft');
            //$otherdb->where('BaseTbl.phase !=', 'Site Verification');
        }
        else{
            $otherdb->where('BaseTbl.id', '0');
        }
        ////$otherdb->limit(15);
        $otherdb->group_by('BaseTbl.id');
        //$otherdb->order_by("FIELD(`assignedOfficer`,".$this->userId." )", "desc");
        //$otherdb->order_by('BaseTbl.id', 'desc');
       $otherdb->order_by('STR_TO_DATE(BaseTbl.submissionDate, "%d-%M-%y %H:%i")', 'desc', false);

        $query = $otherdb->get();
        

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function importlicenseEdit($id, $table)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*, Company.companyName, Company.companySubCategory, Company.companyUniqueNo, (SELECT tbl_licensehistory.forwardedTo FROM tbl_licensehistory WHERE tbl_licensehistory.masterId = BaseTbl.id AND tbl_licensehistory.isDeleted = 0 ORDER BY tbl_licensehistory.id DESC LIMIT 1) as lastAssignedUserId');
        $otherdb->from($table.' as BaseTbl');
        $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.id', $id);
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function applylicenseDetailManagementEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_companymanagement as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();
        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function applylicenseDetailSectionEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_licensesection as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function applylicenseDetailSectionMachineEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_licensesectionmachine as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }
	function applylicenseDetailApiEdit911($id)
    {
		$otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_licenseapi as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function applylicenseDetailQualifiedStaffEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_companyqualifiedstaff as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function licenseDetailQueryEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_licensehistory as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function importregistration($table, $searchText = NULL)
    {
        return array();
        die();
        $sql = "SELECT
        optimizedSub1.*,
		
        (SELECT
            tbls_user.userName 
        FROM
            tbl_registrationhistory 
        LEFT JOIN
            tbls_user 
                ON tbls_user.id = tbl_registrationhistory.forwardedTo 
        WHERE
            tbl_registrationhistory.masterId = optimizedSub1.BaseTbl_id 
        ORDER BY
            tbl_registrationhistory.id DESC LIMIT 1) AS assignedOfficer,
			
			
			
        (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Company`.`companyNTN` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyNTN`,
        (SELECT
            `Company`.`dslNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `dslNo`,
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0 
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`registrationStatus` != '' 
            AND `BaseTbl`.`registrationStatus` NOT IN (
                'Draft'
            ) 
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1;";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
        /*
        $this->db->select('Company.companyName,Company.companyUniqueNo,BaseTbl.*,  Company.companyNTN, Company.dslNo, RegistrationType.registrationType, RegistrationType.registrationSubType, ProductOrigin.productOrigin, ProductCategory.productCategory, UsedFor.usedFor, (SELECT COUNT(tbl_registration.id) FROM tbl_registration WHERE tbl_registration.id < BaseTbl.id AND tbl_registration.registrationStatus = "Submitted") as queuePosition, (SELECT tbls_user.userName FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbls_user.id = tbl_registrationhistory.forwardedTo WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as assignedOfficer');
        $this->db->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $this->db->group_start();
            $this->db->like('BaseTbl.fieldName', $searchText);
            $this->db->or_like('BaseTbl.status', $searchText);
            $this->db->group_end();
        }
        //$this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        //$this->db->join('tbl_licensetype as LicenseType','LicenseType.id = License.licenseTypeId','left');
        $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
        $this->db->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
        $this->db->join('tbl_productcategory as ProductCategory','ProductCategory.id = BaseTbl.productCategoryId','left');
        $this->db->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $this->db->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $this->db->join('tbl_registrationhistory as RegistrationHistory','RegistrationHistory.masterId = BaseTbl.id','left');
        $this->db->where('BaseTbl.isDeleted', 0);

        //$this->db->where('BaseTbl.status', 'Active');
        $this->db->group_start();
        $this->db->group_start();
        $this->db->where('BaseTbl.status',  'Active');
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  NULL);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('BaseTbl.status =',  '');
        $this->db->group_end();
        $this->db->group_end();
        $this->db->where('BaseTbl.registrationStatus !=', '');
        $this->db->where_not_in('BaseTbl.registrationStatus', array('Draft'));

        // $this->db->where('Status.page', 'Apply License');
        $this->db->limit(15);
        $this->db->group_by('BaseTbl.id');
        //$this->db->order_by('BaseTbl.id', 'desc');
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        //echo $this->db->get_compiled_select();
        //die();
        $query = $this->db->get();

        $result = $query->result();
        return $result;
        /*
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*, Company.companyName, Company.companyNTN, Company.dslNo, LicenseType.licenseType, LicenseType.licenseSubType, RegistrationType.registrationType, RegistrationType.registrationSubType, ProductOrigin.productOrigin, ProductCategory.productCategory, UsedFor.usedFor');
        $otherdb->from($table.' as BaseTbl');
        if(!empty($searchText)) {
            $otherdb->group_start();
                $otherdb->like('BaseTbl.fieldName', $searchText);
                $otherdb->or_like('BaseTbl.status', $searchText);
            $otherdb->group_end();
        }
        //$otherdb->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $otherdb->join('tbl_licensetype as LicenseType','LicenseType.id = BaseTbl.licenseTypeId','left');
        $otherdb->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $otherdb->join('tbl_productorigin as ProductOrigin','ProductOrigin.id = BaseTbl.productOriginId','left');
        $otherdb->join('tbl_productcategory as ProductCategory','ProductCategory.id = BaseTbl.productCategoryId','left');
        $otherdb->join('tbl_usedfor as UsedFor','UsedFor.id = BaseTbl.usedForId','left');
        $otherdb->join('tbl_registrationtype as RegistrationType','RegistrationType.id = BaseTbl.registrationTypeId','left');
        $otherdb->join('tbl_registrationhistory as RegistrationHistory','RegistrationHistory.masterId = BaseTbl.id','left');
        //$otherdb->join('tbl_dosage as Dosage','Dosage.id = Registration.dosageFormId','left');
        $otherdb->where('BaseTbl.isDeleted', 0);
        if($this->roleId == '26'){ // Company Submission
            $otherdb->where('BaseTbl.companyId', $this->companyId);
        }
        else if($this->roleId == '7'){ // Registration Director
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '11'){ // Registration Additional Director
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '15'){ // Registration Deputy Director
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '19'){ // Registration Assistant Director
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('RegistrationHistory.forwardedTo', $this->userId);
            //$otherdb->where('RegistrationHistory.id = (SELECT MAX(tbl_registrationhistory.id) FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id)');
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '39'){ // Registration Assigning Officer
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '44'){ // Registration Board Secretary
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '45'){ // Registration Pricing User
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '51'){ // Registration Screening Officer
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else if($this->roleId == '42'){ // CEO
            $otherdb->where_not_in('BaseTbl.registrationStatus', array('Draft'));
            $otherdb->where('BaseTbl.registrationStatus !=', '');
        }
        else{
            $otherdb->where('BaseTbl.id', '0');
        }
        ////$otherdb->limit(15);
        $otherdb->group_by('BaseTbl.id');
        $otherdb->order_by('BaseTbl.id', 'desc');
        $query = $otherdb->get();
        
        $result = $query->result();        
        return $result;
        */
    }

    function importregistrationEdit($id, $table)
    {
        $this->db->select('Company.companyName, Company.companySubCategory, Company.companyUniqueNo,BaseTbl.*,  License.companyId, License.googleMapURL, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, Dosage.dosageName, ATCCode.atcName, Unit.unit, (SELECT tbl_registrationhistory.forwardedTo FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedUserId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT MAX(tbl_registration.id) FROM tbl_registration LEFT JOIN tbl_license ON tbl_license.id = tbl_registration.masterId WHERE tbl_registration.registrationStatus = "Approved" and tbl_license.companyId = License.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
        $this->db->join('tbl_atccode as ATCCode','ATCCode.id = BaseTbl.atcCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $this->db->group_by('BaseTbl.id');
        $query = $this->db->get();

        return $query->result();

    }

    function applyregistrationDetailProposedPackingEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_registrationproposedprice as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function registrationDetailQueryEdit911($id)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->select('BaseTbl.*');
        $otherdb->from('tbl_registrationhistory as BaseTbl');
        $otherdb->where('BaseTbl.isDeleted', 0);
        $otherdb->where('BaseTbl.masterId', $id);
        $otherdb->order_by('BaseTbl.id', 'asc');
        $query = $otherdb->get();

        $result = $query->result();
        $otherdb->close();
        return $result;
    }

    function recordAjaxSave911($data, $table)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->insert($table, $data);
        $insert_id = $otherdb->insert_id();

        $otherdb->close();
        return $insert_id;
    }

    function recordAjaxUpdate911($idColumn, $id, $data, $table)
    {
        $otherdb = $this->load->database('otherdb', TRUE);
        $otherdb->where($idColumn, $id);
        $otherdb->update($table, $data);
        $update_id = $otherdb->affected_rows();

        $otherdb->close();
        return $update_id;
    }
	function recordDelete($idColumn,$id,$table){
		$this->db->where($idColumn, $id);
		return $this->db->delete($table);
	}
	function companyLicensesApproved()
    {
        $this->db->select('COUNT(*) as approvedlicenses');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('BaseTbl.phase', 'Grant of License');
		$this->db->where('BaseTbl.licenseStatus', 'Approved');
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
	function companyLicensesTillLayoutApproved()
    {
        $this->db->select('COUNT(*) as layoutapproved');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('BaseTbl.phase', 'Grant of License');
		$this->db->where('BaseTbl.licenseStatus !=', 'Approved');
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
	function companyLicensesTillSiteApproved()
    {
        $this->db->select('COUNT(*) as siteapproved');
        $this->db->from('tbl_license as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
		$this->db->where('BaseTbl.phase', 'Layout Plan');
		$this->db->where('BaseTbl.licenseStatus !=', 'Approved');
        $this->db->where('BaseTbl.companyId', $this->companyId);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();
        
        return $query->result();
    }
    function myAjaxAllGet($table, $column = null, $val = null)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        //$this->db->where('BaseTbl.status', 'Active');
        if(isset($column) && $column != null )
            $this->db->where($column, $val);
        $query = $this->db->get();
        return $query->result();

    }
    function amcRegisteredBrands($molecule)
    {
        $this->db->select('BaseTbl.*,Company.companyName,Company.companyAddress');
        $this->db->from('tbl_registration  as BaseTbl');
        $this->db->join('tbl_registrationinn as INN','BaseTbl.id = INN.masterId','left');
        $this->db->join('tbls_company as Company','BaseTbl.companyAccountId = Company.companyUniqueNo','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->like('INN.innManual', $molecule);
        //$this->db->where('BaseTbl.approved', 'Yes');
        //$this->db->group_by('BaseTbl.id');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
    function amcRegisteredManufacturers($molecule)
    {
        $this->db->select('BaseTbl.*,Company.companyName,Company.companyAddress');
        $this->db->from('tbl_registration  as BaseTbl');
        $this->db->join('tbl_registrationinn as INN','BaseTbl.id = INN.masterId','left');
        $this->db->join('tbls_company as Company','BaseTbl.companyAccountId = Company.companyUniqueNo','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->like('INN.innManual', $molecule);
        $this->db->group_by('BaseTbl.companyAccountId');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
    function exportDrugs(){
        $sql = 'SELECT
        optimizedSub1.*,
	    (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Pharmacopeia`.`pharmacopeia` 
        FROM
            `tbl_pharmacopeia` AS `Pharmacopeia` 
        WHERE
            `Pharmacopeia`.`id` = optimizedSub1.pharmacopeiaId LIMIT 1) AS `pharmacopeia`,
        (SELECT
            `Dosage`.`dosageName` 
        FROM
            `tbl_dosage` AS `Dosage` 
        WHERE
            `Dosage`.`id` = optimizedSub1.dosageFormId LIMIT 1) AS `dosageName`,
        (SELECT
            `RouteAdmin`.`routeOfAdmin` 
        FROM
            `tbl_routeofadmin` AS `RouteAdmin` 
        WHERE
            `RouteAdmin`.`id` = optimizedSub1.routeOfAdminId LIMIT 1) AS `routeOfAdmin`,
        
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            BaseTbl.id AS id,
            BaseTbl.issueDateManual,
            BaseTbl.registrationNo,
            BaseTbl.approvedName,
            BaseTbl.refUnit,
            BaseTbl.regType,
            BaseTbl.old_regid,
            BaseTbl.shelfLife,
            BaseTbl.shelfLifeUnit,
            BaseTbl.lastRenewalDateManual,
            BaseTbl.validTill,
            BaseTbl.dealingsection,
            BaseTbl.regFileNo,
            BaseTbl.registrationStatus,
            BaseTbl.productStatus,
            BaseTbl.isPublic,
            BaseTbl.submissionRemarks,
            BaseTbl.pharmacopeiaId AS pharmacopeiaId,
            BaseTbl.dosageFormId AS dosageFormId,
            BaseTbl.routeOfAdminId AS routeOfAdminId,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0
            AND `BaseTbl`.`isexport` = 0
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1';
        $query = $this->db->query($sql);
        return $query->result();
    }
    function newexportregistration($table, $searchText = NULL)
    {
        $sql = "SELECT
        optimizedSub1.*,
		
        (SELECT
            tbls_user.userName 
        FROM
            tbl_registrationhistory 
        LEFT JOIN
            tbls_user 
                ON tbls_user.id = tbl_registrationhistory.forwardedTo 
        WHERE
            tbl_registrationhistory.masterId = optimizedSub1.BaseTbl_id 
        ORDER BY
            tbl_registrationhistory.id DESC LIMIT 1) AS assignedOfficer,
			
			
			
        (SELECT
            `Company`.`companyName` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyName`,
        (SELECT
            `Company`.`companyUniqueNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyUniqueNo`,
        (SELECT
            `Company`.`companyNTN` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `companyNTN`,
        (SELECT
            `Company`.`dslNo` 
        FROM
            `tbls_company` AS `Company` 
        WHERE
            `Company`.`companyUniqueNo` = optimizedSub1.BaseTbl_companyAccountId LIMIT 1) AS `dslNo`,
        (SELECT
            `RegistrationType`.`registrationType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationType`,
        (SELECT
            `RegistrationType`.`registrationSubType` 
        FROM
            `tbl_registrationtype` AS `RegistrationType` 
        WHERE
            `RegistrationType`.`id` = optimizedSub1.BaseTbl_registrationTypeId LIMIT 1) AS `registrationSubType`,
        (SELECT
            `ProductOrigin`.`productOrigin` 
        FROM
            `tbl_productorigin` AS `ProductOrigin` 
        WHERE
            `ProductOrigin`.`id` = optimizedSub1.BaseTbl_productOriginId LIMIT 1) AS `productOrigin`,
        (SELECT
            `ProductCategory`.`productCategory` 
        FROM
            `tbl_productcategory` AS `ProductCategory` 
        WHERE
            `ProductCategory`.`id` = optimizedSub1.BaseTbl_productCategoryId LIMIT 1) AS `productCategory`,
        (SELECT
            `UsedFor`.`usedFor` 
        FROM
            `tbl_usedfor` AS `UsedFor` 
        WHERE
            `UsedFor`.`id` = optimizedSub1.BaseTbl_usedForId LIMIT 1) AS `usedFor` 
    FROM
        (SELECT
            `BaseTbl`.*,
            BaseTbl.id AS BaseTbl_id,
            `BaseTbl`.`companyAccountId` AS BaseTbl_companyAccountId,
            `BaseTbl`.`registrationTypeId` AS BaseTbl_registrationTypeId,
            `BaseTbl`.`productOriginId` AS BaseTbl_productOriginId,
            `BaseTbl`.`productCategoryId` AS BaseTbl_productCategoryId,
            `BaseTbl`.`usedForId` AS BaseTbl_usedForId 
        FROM
            `tbl_registration` AS `BaseTbl` 
        WHERE
            `BaseTbl`.`isDeleted` = 0
            AND `BaseTbl`.`isexport` = 1 
            AND (
                (
                    `BaseTbl`.`status` = 'Active'
                ) 
                OR (
                    `BaseTbl`.`status` IS NULL
                ) 
                OR (
                    `BaseTbl`.`status` = ''
                )
            ) 
            AND `BaseTbl`.`isCompany` = 1
            AND `BaseTbl`.`isexport` = 1";
        if($this->roleId == 26) {
            $compid = (int)$this->companyUniqueNo;
            $sql .= "
            AND `BaseTbl`.`companyAccountId` = " . $compid . "
            ";
        }else{
            $sql .= "
            AND `BaseTbl`.`registrationStatus` != 'Draft'
            ";
        }
        $sql .= "
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        $query = $this->db->query($sql);
        return $query->result();

    }

    function newexportregistrationEdit($id, $table)
    {
        $this->db->select('Company.companyName, Company.companySubCategory, Company.companyUniqueNo,BaseTbl.*,  License.companyId, License.googleMapURL, License.licFileNo as fileNo, License.licenseNoManual, License.issueDateManual as licIssueDateManual, License.siteAddress, License.siteCity, Dosage.dosageName, ATCCode.atcName, Unit.unit, (SELECT tbl_registrationhistory.forwardedTo FROM tbl_registrationhistory WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedUserId,(SELECT tbls_user.roleId FROM tbl_registrationhistory LEFT JOIN tbls_user ON tbl_registrationhistory.forwardedTo = tbls_user.id  WHERE tbl_registrationhistory.masterId = BaseTbl.id ORDER BY tbl_registrationhistory.id DESC LIMIT 1) as lastAssignedroleId, (SELECT remarks FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as panelRemarks, (SELECT tbl_inspection.inspectionReportPath FROM tbl_inspection WHERE tbl_inspection.refId = BaseTbl.id ORDER BY tbl_inspection.id DESC LIMIT 1) as inspectionReportPath, (SELECT MAX(tbl_registration.id) FROM tbl_registration LEFT JOIN tbl_license ON tbl_license.id = tbl_registration.masterId WHERE tbl_registration.registrationStatus = "Approved" and tbl_license.companyId = License.companyId and tbl_license.isDeleted = 0) as maxApprovedId');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbl_license as License','License.id = BaseTbl.masterId','left');
        $this->db->join('tbls_company as Company','Company.companyUniqueNo = BaseTbl.companyAccountId','left');
        $this->db->join('tbl_dosage as Dosage','Dosage.id = BaseTbl.dosageFormId','left');
        $this->db->join('tbl_atccode as ATCCode','ATCCode.id = BaseTbl.atcCodeId','left');
        $this->db->join('tbl_unit as Unit','Unit.id = BaseTbl.unitId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.isExport', 1);
        $this->db->where('BaseTbl.id', $id);
        $this->db->group_by('BaseTbl.id');
        $query = $this->db->get();

        return $query->result();

    }


    // -- CTD
    function ctdGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_ctd as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->where('BaseTbl.lastLevel', '1');
        $query = $this->db->get();

        return $query->result();
    }

    function ctdStructureGet()
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_ctd as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.status', 'Active');
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function registrationDetailCTDEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_registrationctd as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
    function registrationCTDEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_qos as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }

    function registrationDetailCTDSPartEdit($id)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from('tbl_qosspart as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $this->db->order_by('BaseTbl.id', 'asc');
        $query = $this->db->get();

        return $query->result();
    }
    // -- CTD

}

  