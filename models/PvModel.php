<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pvModel extends CI_Model
{
    function getRecord($table, $searchText = NULL){
        $this->db->select('BaseTbl.*,Company.companyName');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId <> 26){
            $this->db->where('BaseTbl.status', 'Active');
        }
        if($this->roleId == 26){
            $this->db->where('BaseTbl.createdby', $this->userId);
        }
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        return $query->result();
    }
    function getRecordEdit($id, $table)
    {
        $this->db->select('BaseTbl.*,Company.companyName,Company.companyUniqueNo');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        if($this->roleId == 26){
            $this->db->where('BaseTbl.createdby', $this->userId);
        }
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function getRecordAttachments($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.masterId', $id);
        $query = $this->db->get();
        return $query->result();
    }

    function qualifiedPerson($table, $searchText = NULL){
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->order_by('STR_TO_DATE(BaseTbl.updateddate, "%d-%M-%y %H:%i")', 'desc', false);
        $query = $this->db->get();
        return $query->result();
    }
    function qualifiedPersonEdit($id, $table)
    {
        $this->db->select('BaseTbl.*');
        $this->db->from($table.' as BaseTbl');
        $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
        $this->db->where('BaseTbl.isDeleted', 0);
        $this->db->where('BaseTbl.id', $id);
        $query = $this->db->get();
        return $query->result();
    }


}