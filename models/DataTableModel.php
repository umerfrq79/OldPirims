<?php
class DataTableModel extends CI_Model
{
    function make_query()
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
            
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))
        {
            $sql .= " WHERE optimizedSub1.registrationNo LIKE '".$_POST["search"]["value"]."%'";
            //$sql .= " OR WHERE optimizedSub1.submissionRemarks LIKE '".$_POST["search"]["value"]."%'";
            //$sql .= " OR WHERE companyName LIKE '".$_POST["search"]["value"]."%'";
        }
        return $sql;

    }
    function make_datatables(){
        $sql = $this->make_query();
        $_POST["length"] = 25;
        if($_POST["length"] != -1)
        {
            if(isset($_POST['start']))
                $sql .= "LIMIT ".$_POST['start'].", ".$_POST['length']." ";
            else
                $sql .= "LIMIT ".$_POST['length']." ";
            //$sql .= "LIMIT 10, 25 ";
        }
        $query = $this->db->query($sql);
        return $query->result();

    }

    function exportregistration_query()
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
            )";


        if($this->roleId == '26'){ // Company Submission
            $sql .= " AND `BaseTbl`.`companyAccountId` = ".$this->companyUniqueNo;
        }
        $sql .= " 
            
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        if(isset($_POST["search"]["value"]) && !empty($_POST["search"]["value"]))
        {
            $sql .= " WHERE optimizedSub1.registrationNo LIKE '".$_POST["search"]["value"]."%'";
        }
        return $sql;

    }

    function exportregistration_datatables(){
        $sql = $this->exportregistration_query();
        $_POST["length"] = 25;
        if($_POST["length"] != -1)
        {
            if(isset($_POST['start']))
                $sql .= "LIMIT ".$_POST['start'].", ".$_POST['length']." ";
            else
                $sql .= "LIMIT ".$_POST['length']." ";
        }
        $query = $this->db->query($sql);
        return $query->result();

    }
    function get_filtered_data(){
        $sql = $this->make_query();
        $query = $this->db->query($sql);
        return $query->num_rows();
    }
    function get_all_data()
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
             
        ORDER BY
            BaseTbl.id DESC 
             )AS optimizedSub1
             ";

        $query = $this->db->query($sql);
        return $query->num_rows();
    }


}