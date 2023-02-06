<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/Login.php';

class cronJob extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Karachi");

        $this->dateFormat = 'd-M-y';
        $this->dateTimeFormat = 'd-M-y H:i';
        $this->dateTimeFullFormat = 'd-M-y H:i:s';
    }

    function inspectionScheduleToPending()
    {
        // if(current server name <> 'actual server name'){
        //     $this->accessDenied();
        //     return;
        // }

        $data['createdby'] = 0;
        $data['createddate'] = date($this->dateTimeFormat);

        $functionName = __FUNCTION__;

        $searchResult = $this->cronJobModel->$functionName();

        $dataupdate = array('inspectionStatus' => 'Inspection Pending');

        foreach ($searchResult as $row){
            $resultdetail = $this->cronJobModel->recordCronJobUpdate('id', $row->id, $dataupdate, 'tbl_inspection');
        }

        if(isset($searchResult)){
            //print_r($searchResult);
            print_r('<font color="#fff">Select query returned '.count($searchResult).' rows.</font>');
        }

        print_r('<br><br>');

        if(isset($resultdetail)){
            //print_r($resultdetail);
            print_r('<font color="#fff">Each record updated successfully.</font>');
        }

        print_r('<br><br>');

        print_r('<font color="#fff">You are genius!</font>');
    }

    function inspectionMeetingScheduleToPending()
    {
        // if(current server name <> 'actual server name'){
        //     $this->accessDenied();
        //     return;
        // }

        $data['createdby'] = 0;
        $data['createddate'] = date($this->dateTimeFormat);

        $functionName = __FUNCTION__;

        $searchResult = $this->cronJobModel->$functionName();

        $dataupdate = array('inspectionStatus' => 'Panel Meeting Pending');

        foreach ($searchResult as $row){
            $resultdetail = $this->cronJobModel->recordCronJobUpdate('id', $row->id, $dataupdate, 'tbl_inspection');
        }

        if(isset($searchResult)){
            //print_r($searchResult);
            print_r('<font color="#fff">Select query returned '.count($searchResult).' rows.</font>');
        }

        print_r('<br><br>');

        if(isset($resultdetail)){
            //print_r($resultdetail);
            print_r('<font color="#fff">Each record updated successfully.</font>');
        }

        print_r('<br><br>');

        print_r('<font color="#fff">You are genius!</font>');
    }

    function licenseRenewal()
    {
        // if(current server name <> 'actual server name'){
        //     $this->accessDenied();
        //     return;
        // }

        $data['createdby'] = 0;
        $data['createddate'] = date($this->dateTimeFormat);

        $functionName = __FUNCTION__;

        $searchResult = $this->cronJobModel->$functionName();
        pre($searchResult);
        //die();
        //$searchResult = array();
        $id = 0;
        foreach ($searchResult as $row){
            $id = $row->id;
            $companyId = $row->companyId;
            if($row->countSameLicenseNo > 1){
                continue;
            }
            if($row->licenseTypeId == 1){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.companyId, BaseTbl.licenseNo, BaseTbl.licenseNoManual, BaseTbl.issueDateManual, BaseTbl.licenseTypeId, BaseTbl.issueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.postchangeTypeId, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.svCoveringLetter, BaseTbl.svLandDocument, BaseTbl.svFeeChallan, BaseTbl.svStatusofFirm, BaseTbl.svPartnershipDeed, BaseTbl.svCopyOfCNIC, BaseTbl.svRegistrationCertificate, BaseTbl.svSiteMap, BaseTbl.svSECPDocuments, BaseTbl.icFeeChallan, BaseTbl.icCoveringLetter, BaseTbl.icAppointmentLetter, BaseTbl.icAcceptanceLetter, BaseTbl.icCopyOfCNIC, BaseTbl.icAcademicDegrees, BaseTbl.icPharmacyCouncilLetter, BaseTbl.icExperienceCertificate, BaseTbl.icResignationLetter, BaseTbl.icResignationLetterPreviousEmployer, BaseTbl.icUndertakingProductionIC, BaseTbl.icUndertakingProductionQC, BaseTbl.dmlForm1, BaseTbl.dmlProForma, BaseTbl.dmlLegalStatus, BaseTbl.dmlFeeChallan, BaseTbl.dmlFormA1, BaseTbl.mgmApplicationForm, BaseTbl.mgmFeeChallan, BaseTbl.mgmShareAgreement, BaseTbl.mgmTransferDeed, BaseTbl.mgmForm29, BaseTbl.mgmCopyOfCNIC, BaseTbl.mgmNOCFromPreviousOwner, BaseTbl.mgmNothingDueCertificate, BaseTbl.apiApplicationForm, BaseTbl.apiFeeChallan, BaseTbl.apiChemicalNamesManufacturing, BaseTbl.apiChemicalNamesRecycled, BaseTbl.apiManufacturinfFlowChart, BaseTbl.apiTheoricalYied, BaseTbl.apiTrialBatches, BaseTbl.apiReferenceMonograph, BaseTbl.apiReferenceMonograph, BaseTbl.apiShelfLifeOfAPI, BaseTbl.apiMaterialSafetyData, BaseTbl.lpApplicationCoveringLetter, BaseTbl.lpChallanForm, BaseTbl.lpLayoutPlan, BaseTbl.lpLayoutPlan2, BaseTbl.lpLayoutPlan3, BaseTbl.lpLayoutPlan4, BaseTbl.lpLayoutPlan5, BaseTbl.lpLayoutPlan6, BaseTbl.lpLayoutPlan7, BaseTbl.lpLayoutPlan8, BaseTbl.lpLayoutPlan9, BaseTbl.lpLayoutPlan10, BaseTbl.ibApplicationCoveringLetter, BaseTbl.ibChallanForm, BaseTbl.ibLastThreePagesOfInspectionBook, BaseTbl.ibCopyOfFIR, BaseTbl.rpkApplicationCoveringLetter, BaseTbl.rpkFeeChallan, BaseTbl.rpkApprovalLetter, BaseTbl.qsDocuments, BaseTbl.qsDocuments2, BaseTbl.rCoveringLetter, BaseTbl.rFeeChallan, BaseTbl.rcrf, BaseTbl.rformA1, BaseTbl.rformA2, BaseTbl.rformA3, BaseTbl.rformA4, BaseTbl.rformA5, BaseTbl.pvFeeChallan, BaseTbl.pvts1, BaseTbl.pvts2, BaseTbl.pvts3, BaseTbl.pvts4, BaseTbl.pvts5, BaseTbl.pvts6, BaseTbl.pvts7, BaseTbl.pvts8, BaseTbl.pvts9, BaseTbl.pvts10, BaseTbl.pvcm1, BaseTbl.pvcm2, BaseTbl.pvcm3, BaseTbl.pvcn1, BaseTbl.pvcn2, BaseTbl.pvcn3, BaseTbl.pvcn4, BaseTbl.pvlp1, BaseTbl.pvlp2, BaseTbl.pvmg1, BaseTbl.pvmg2, BaseTbl.pvmg3, BaseTbl.pvmg4, BaseTbl.pvma1, BaseTbl.pvma2, BaseTbl.pvma3, BaseTbl.pvma4, BaseTbl.licFileNo, BaseTbl.siteApprovalRemarks, BaseTbl.panelOfInspector, BaseTbl.lastRenewalDateManual, BaseTbl.googleMapURL, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.layoutPlanPath, BaseTbl.siteAddress, BaseTbl.phase, BaseTbl.phase1Invoice, BaseTbl.phase2Invoice, BaseTbl.phase3Invoice, BaseTbl.phase1InvoicePaid, BaseTbl.phase2InvoicePaid, BaseTbl.phase3InvoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, "Draft" as renewalStatus, 8 as renewalTypeId, Company.companyName, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_license');
                    }
                }
            }
            if($row->licenseTypeId == 2){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.companyId, BaseTbl.licenseNo, BaseTbl.licenseNoManual, BaseTbl.issueDateManual, BaseTbl.licenseTypeId, BaseTbl.issueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.postchangeTypeId, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.svCoveringLetter, BaseTbl.svLandDocument, BaseTbl.svFeeChallan, BaseTbl.svStatusofFirm, BaseTbl.svPartnershipDeed, BaseTbl.svCopyOfCNIC, BaseTbl.svRegistrationCertificate, BaseTbl.svSiteMap, BaseTbl.svSECPDocuments, BaseTbl.icFeeChallan, BaseTbl.icCoveringLetter, BaseTbl.icAppointmentLetter, BaseTbl.icAcceptanceLetter, BaseTbl.icCopyOfCNIC, BaseTbl.icAcademicDegrees, BaseTbl.icPharmacyCouncilLetter, BaseTbl.icExperienceCertificate, BaseTbl.icResignationLetter, BaseTbl.icResignationLetterPreviousEmployer, BaseTbl.icUndertakingProductionIC, BaseTbl.icUndertakingProductionQC, BaseTbl.dmlForm1, BaseTbl.dmlProForma, BaseTbl.dmlLegalStatus, BaseTbl.dmlFeeChallan, BaseTbl.dmlFormA1, BaseTbl.mgmApplicationForm, BaseTbl.mgmFeeChallan, BaseTbl.mgmShareAgreement, BaseTbl.mgmTransferDeed, BaseTbl.mgmForm29, BaseTbl.mgmCopyOfCNIC, BaseTbl.mgmNOCFromPreviousOwner, BaseTbl.mgmNothingDueCertificate, BaseTbl.apiApplicationForm, BaseTbl.apiFeeChallan, BaseTbl.apiChemicalNamesManufacturing, BaseTbl.apiChemicalNamesRecycled, BaseTbl.apiManufacturinfFlowChart, BaseTbl.apiTheoricalYied, BaseTbl.apiTrialBatches, BaseTbl.apiReferenceMonograph, BaseTbl.apiReferenceMonograph, BaseTbl.apiShelfLifeOfAPI, BaseTbl.apiMaterialSafetyData, BaseTbl.lpApplicationCoveringLetter, BaseTbl.lpChallanForm, BaseTbl.lpLayoutPlan, BaseTbl.lpLayoutPlan2, BaseTbl.lpLayoutPlan3, BaseTbl.lpLayoutPlan4, BaseTbl.lpLayoutPlan5, BaseTbl.lpLayoutPlan6, BaseTbl.lpLayoutPlan7, BaseTbl.lpLayoutPlan8, BaseTbl.lpLayoutPlan9, BaseTbl.lpLayoutPlan10, BaseTbl.ibApplicationCoveringLetter, BaseTbl.ibChallanForm, BaseTbl.ibLastThreePagesOfInspectionBook, BaseTbl.ibCopyOfFIR, BaseTbl.rpkApplicationCoveringLetter, BaseTbl.rpkFeeChallan, BaseTbl.rpkApprovalLetter, BaseTbl.qsDocuments, BaseTbl.qsDocuments2, BaseTbl.rCoveringLetter, BaseTbl.rFeeChallan, BaseTbl.rcrf, BaseTbl.rformA1, BaseTbl.rformA2, BaseTbl.rformA3, BaseTbl.rformA4, BaseTbl.rformA5, BaseTbl.pvFeeChallan, BaseTbl.pvts1, BaseTbl.pvts2, BaseTbl.pvts3, BaseTbl.pvts4, BaseTbl.pvts5, BaseTbl.pvts6, BaseTbl.pvts7, BaseTbl.pvts8, BaseTbl.pvts9, BaseTbl.pvts10, BaseTbl.pvcm1, BaseTbl.pvcm2, BaseTbl.pvcm3, BaseTbl.pvcn1, BaseTbl.pvcn2, BaseTbl.pvcn3, BaseTbl.pvcn4, BaseTbl.pvlp1, BaseTbl.pvlp2, BaseTbl.pvmg1, BaseTbl.pvmg2, BaseTbl.pvmg3, BaseTbl.pvmg4, BaseTbl.pvma1, BaseTbl.pvma2, BaseTbl.pvma3, BaseTbl.pvma4, BaseTbl.licFileNo, BaseTbl.siteApprovalRemarks, BaseTbl.panelOfInspector, BaseTbl.lastRenewalDateManual, BaseTbl.googleMapURL, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.layoutPlanPath, BaseTbl.siteAddress, BaseTbl.phase, BaseTbl.phase1Invoice, BaseTbl.phase2Invoice, BaseTbl.phase3Invoice, BaseTbl.phase1InvoicePaid, BaseTbl.phase2InvoicePaid, BaseTbl.phase3InvoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, "Draft" as renewalStatus, 9 as renewalTypeId, Company.companyName, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_license');
                    }
                }
            }
            if($row->licenseTypeId == 5){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.companyId, BaseTbl.licenseNo, BaseTbl.licenseNoManual, BaseTbl.issueDateManual, BaseTbl.licenseTypeId, BaseTbl.issueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.postchangeTypeId, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.svCoveringLetter, BaseTbl.svLandDocument, BaseTbl.svFeeChallan, BaseTbl.svStatusofFirm, BaseTbl.svPartnershipDeed, BaseTbl.svCopyOfCNIC, BaseTbl.svRegistrationCertificate, BaseTbl.svSiteMap, BaseTbl.svSECPDocuments, BaseTbl.icFeeChallan, BaseTbl.icCoveringLetter, BaseTbl.icAppointmentLetter, BaseTbl.icAcceptanceLetter, BaseTbl.icCopyOfCNIC, BaseTbl.icAcademicDegrees, BaseTbl.icPharmacyCouncilLetter, BaseTbl.icExperienceCertificate, BaseTbl.icResignationLetter, BaseTbl.icResignationLetterPreviousEmployer, BaseTbl.icUndertakingProductionIC, BaseTbl.icUndertakingProductionQC, BaseTbl.dmlForm1, BaseTbl.dmlProForma, BaseTbl.dmlLegalStatus, BaseTbl.dmlFeeChallan, BaseTbl.dmlFormA1, BaseTbl.mgmApplicationForm, BaseTbl.mgmFeeChallan, BaseTbl.mgmShareAgreement, BaseTbl.mgmTransferDeed, BaseTbl.mgmForm29, BaseTbl.mgmCopyOfCNIC, BaseTbl.mgmNOCFromPreviousOwner, BaseTbl.mgmNothingDueCertificate, BaseTbl.apiApplicationForm, BaseTbl.apiFeeChallan, BaseTbl.apiChemicalNamesManufacturing, BaseTbl.apiChemicalNamesRecycled, BaseTbl.apiManufacturinfFlowChart, BaseTbl.apiTheoricalYied, BaseTbl.apiTrialBatches, BaseTbl.apiReferenceMonograph, BaseTbl.apiReferenceMonograph, BaseTbl.apiShelfLifeOfAPI, BaseTbl.apiMaterialSafetyData, BaseTbl.lpApplicationCoveringLetter, BaseTbl.lpChallanForm, BaseTbl.lpLayoutPlan, BaseTbl.lpLayoutPlan2, BaseTbl.lpLayoutPlan3, BaseTbl.lpLayoutPlan4, BaseTbl.lpLayoutPlan5, BaseTbl.lpLayoutPlan6, BaseTbl.lpLayoutPlan7, BaseTbl.lpLayoutPlan8, BaseTbl.lpLayoutPlan9, BaseTbl.lpLayoutPlan10, BaseTbl.ibApplicationCoveringLetter, BaseTbl.ibChallanForm, BaseTbl.ibLastThreePagesOfInspectionBook, BaseTbl.ibCopyOfFIR, BaseTbl.rpkApplicationCoveringLetter, BaseTbl.rpkFeeChallan, BaseTbl.rpkApprovalLetter, BaseTbl.qsDocuments, BaseTbl.qsDocuments2, BaseTbl.rCoveringLetter, BaseTbl.rFeeChallan, BaseTbl.rcrf, BaseTbl.rformA1, BaseTbl.rformA2, BaseTbl.rformA3, BaseTbl.rformA4, BaseTbl.rformA5, BaseTbl.pvFeeChallan, BaseTbl.pvts1, BaseTbl.pvts2, BaseTbl.pvts3, BaseTbl.pvts4, BaseTbl.pvts5, BaseTbl.pvts6, BaseTbl.pvts7, BaseTbl.pvts8, BaseTbl.pvts9, BaseTbl.pvts10, BaseTbl.pvcm1, BaseTbl.pvcm2, BaseTbl.pvcm3, BaseTbl.pvcn1, BaseTbl.pvcn2, BaseTbl.pvcn3, BaseTbl.pvcn4, BaseTbl.pvlp1, BaseTbl.pvlp2, BaseTbl.pvmg1, BaseTbl.pvmg2, BaseTbl.pvmg3, BaseTbl.pvmg4, BaseTbl.pvma1, BaseTbl.pvma2, BaseTbl.pvma3, BaseTbl.pvma4, BaseTbl.licFileNo, BaseTbl.siteApprovalRemarks, BaseTbl.panelOfInspector, BaseTbl.lastRenewalDateManual, BaseTbl.googleMapURL, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.layoutPlanPath, BaseTbl.siteAddress, BaseTbl.phase, BaseTbl.phase1Invoice, BaseTbl.phase2Invoice, BaseTbl.phase3Invoice, BaseTbl.phase1InvoicePaid, BaseTbl.phase2InvoicePaid, BaseTbl.phase3InvoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, "Draft" as renewalStatus, 10 as renewalTypeId, Company.companyName, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                //echo $this->db->get_compiled_select();
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_license');
                    }
                }
            }
            if($row->licenseTypeId == 6){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.companyId, BaseTbl.licenseNo, BaseTbl.licenseNoManual, BaseTbl.issueDateManual, BaseTbl.licenseTypeId, BaseTbl.issueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.postchangeTypeId, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.googleMapURL, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.layoutPlanPath, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.svCoveringLetter, BaseTbl.svLandDocument, BaseTbl.svFeeChallan, BaseTbl.svStatusofFirm, BaseTbl.svPartnershipDeed, BaseTbl.svCopyOfCNIC, BaseTbl.svRegistrationCertificate, BaseTbl.svSiteMap, BaseTbl.svSECPDocuments, BaseTbl.icFeeChallan, BaseTbl.icCoveringLetter, BaseTbl.icAppointmentLetter, BaseTbl.icAcceptanceLetter, BaseTbl.icCopyOfCNIC, BaseTbl.icAcademicDegrees, BaseTbl.icPharmacyCouncilLetter, BaseTbl.icExperienceCertificate, BaseTbl.icResignationLetter, BaseTbl.icResignationLetterPreviousEmployer, BaseTbl.icUndertakingProductionIC, BaseTbl.icUndertakingProductionQC, BaseTbl.dmlForm1, BaseTbl.dmlProForma, BaseTbl.dmlLegalStatus, BaseTbl.dmlFeeChallan, BaseTbl.dmlFormA1, BaseTbl.mgmApplicationForm, BaseTbl.mgmFeeChallan, BaseTbl.mgmShareAgreement, BaseTbl.mgmTransferDeed, BaseTbl.mgmForm29, BaseTbl.mgmCopyOfCNIC, BaseTbl.mgmNOCFromPreviousOwner, BaseTbl.mgmNothingDueCertificate, BaseTbl.apiApplicationForm, BaseTbl.apiFeeChallan, BaseTbl.apiChemicalNamesManufacturing, BaseTbl.apiChemicalNamesRecycled, BaseTbl.apiManufacturinfFlowChart, BaseTbl.apiTheoricalYied, BaseTbl.apiTrialBatches, BaseTbl.apiReferenceMonograph, BaseTbl.apiReferenceMonograph, BaseTbl.apiShelfLifeOfAPI, BaseTbl.apiMaterialSafetyData, BaseTbl.lpApplicationCoveringLetter, BaseTbl.lpChallanForm, BaseTbl.lpLayoutPlan, BaseTbl.lpLayoutPlan2, BaseTbl.lpLayoutPlan3, BaseTbl.lpLayoutPlan4, BaseTbl.lpLayoutPlan5, BaseTbl.lpLayoutPlan6, BaseTbl.lpLayoutPlan7, BaseTbl.lpLayoutPlan8, BaseTbl.lpLayoutPlan9, BaseTbl.lpLayoutPlan10, BaseTbl.ibApplicationCoveringLetter, BaseTbl.ibChallanForm, BaseTbl.ibLastThreePagesOfInspectionBook, BaseTbl.ibCopyOfFIR, BaseTbl.rpkApplicationCoveringLetter, BaseTbl.rpkFeeChallan, BaseTbl.rpkApprovalLetter, BaseTbl.qsDocuments, BaseTbl.qsDocuments2, BaseTbl.rCoveringLetter, BaseTbl.rFeeChallan, BaseTbl.rcrf, BaseTbl.rformA1, BaseTbl.rformA2, BaseTbl.rformA3, BaseTbl.rformA4, BaseTbl.rformA5, BaseTbl.pvFeeChallan, BaseTbl.pvts1, BaseTbl.pvts2, BaseTbl.pvts3, BaseTbl.pvts4, BaseTbl.pvts5, BaseTbl.pvts6, BaseTbl.pvts7, BaseTbl.pvts8, BaseTbl.pvts9, BaseTbl.pvts10, BaseTbl.pvcm1, BaseTbl.pvcm2, BaseTbl.pvcm3, BaseTbl.pvcn1, BaseTbl.pvcn2, BaseTbl.pvcn3, BaseTbl.pvcn4, BaseTbl.pvlp1, BaseTbl.pvlp2, BaseTbl.pvmg1, BaseTbl.pvmg2, BaseTbl.pvmg3, BaseTbl.pvmg4, BaseTbl.pvma1, BaseTbl.pvma2, BaseTbl.pvma3, BaseTbl.pvma4, BaseTbl.licFileNo, BaseTbl.siteApprovalRemarks, BaseTbl.panelOfInspector, BaseTbl.lastRenewalDateManual, BaseTbl.phase, BaseTbl.phase1Invoice, BaseTbl.phase2Invoice, BaseTbl.phase3Invoice, BaseTbl.phase1InvoicePaid, BaseTbl.phase2InvoicePaid, BaseTbl.phase3InvoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, "Draft" as renewalStatus, 11 as renewalTypeId, Company.companyName, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_license');
                    }
                }
            }
            if($row->licenseTypeId == 7){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.companyId, BaseTbl.licenseNo, BaseTbl.licenseNoManual, BaseTbl.issueDateManual, BaseTbl.licenseTypeId, BaseTbl.issueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.postchangeTypeId, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.googleMapURL, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.layoutPlanPath, BaseTbl.siteAddress, BaseTbl.siteCity, BaseTbl.svCoveringLetter, BaseTbl.svLandDocument, BaseTbl.svFeeChallan, BaseTbl.svStatusofFirm, BaseTbl.svPartnershipDeed, BaseTbl.svCopyOfCNIC, BaseTbl.svRegistrationCertificate, BaseTbl.svSiteMap, BaseTbl.svSECPDocuments, BaseTbl.icFeeChallan, BaseTbl.icCoveringLetter, BaseTbl.icAppointmentLetter, BaseTbl.icAcceptanceLetter, BaseTbl.icCopyOfCNIC, BaseTbl.icAcademicDegrees, BaseTbl.icPharmacyCouncilLetter, BaseTbl.icExperienceCertificate, BaseTbl.icResignationLetter, BaseTbl.icResignationLetterPreviousEmployer, BaseTbl.icUndertakingProductionIC, BaseTbl.icUndertakingProductionQC, BaseTbl.dmlForm1, BaseTbl.dmlProForma, BaseTbl.dmlLegalStatus, BaseTbl.dmlFeeChallan, BaseTbl.dmlFormA1, BaseTbl.mgmApplicationForm, BaseTbl.mgmFeeChallan, BaseTbl.mgmShareAgreement, BaseTbl.mgmTransferDeed, BaseTbl.mgmForm29, BaseTbl.mgmCopyOfCNIC, BaseTbl.mgmNOCFromPreviousOwner, BaseTbl.mgmNothingDueCertificate, BaseTbl.apiApplicationForm, BaseTbl.apiFeeChallan, BaseTbl.apiChemicalNamesManufacturing, BaseTbl.apiChemicalNamesRecycled, BaseTbl.apiManufacturinfFlowChart, BaseTbl.apiTheoricalYied, BaseTbl.apiTrialBatches, BaseTbl.apiReferenceMonograph, BaseTbl.apiReferenceMonograph, BaseTbl.apiShelfLifeOfAPI, BaseTbl.apiMaterialSafetyData, BaseTbl.lpApplicationCoveringLetter, BaseTbl.lpChallanForm, BaseTbl.lpLayoutPlan, BaseTbl.lpLayoutPlan2, BaseTbl.lpLayoutPlan3, BaseTbl.lpLayoutPlan4, BaseTbl.lpLayoutPlan5, BaseTbl.lpLayoutPlan6, BaseTbl.lpLayoutPlan7, BaseTbl.lpLayoutPlan8, BaseTbl.lpLayoutPlan9, BaseTbl.lpLayoutPlan10, BaseTbl.ibApplicationCoveringLetter, BaseTbl.ibChallanForm, BaseTbl.ibLastThreePagesOfInspectionBook, BaseTbl.ibCopyOfFIR, BaseTbl.rpkApplicationCoveringLetter, BaseTbl.rpkFeeChallan, BaseTbl.rpkApprovalLetter, BaseTbl.qsDocuments, BaseTbl.qsDocuments2, BaseTbl.rCoveringLetter, BaseTbl.rFeeChallan, BaseTbl.rcrf, BaseTbl.rformA1, BaseTbl.rformA2, BaseTbl.rformA3, BaseTbl.rformA4, BaseTbl.rformA5, BaseTbl.pvFeeChallan, BaseTbl.pvts1, BaseTbl.pvts2, BaseTbl.pvts3, BaseTbl.pvts4, BaseTbl.pvts5, BaseTbl.pvts6, BaseTbl.pvts7, BaseTbl.pvts8, BaseTbl.pvts9, BaseTbl.pvts10, BaseTbl.pvcm1, BaseTbl.pvcm2, BaseTbl.pvcm3, BaseTbl.pvcn1, BaseTbl.pvcn2, BaseTbl.pvcn3, BaseTbl.pvcn4, BaseTbl.pvlp1, BaseTbl.pvlp2, BaseTbl.pvmg1, BaseTbl.pvmg2, BaseTbl.pvmg3, BaseTbl.pvmg4, BaseTbl.pvma1, BaseTbl.pvma2, BaseTbl.pvma3, BaseTbl.pvma4, BaseTbl.licFileNo, BaseTbl.siteApprovalRemarks, BaseTbl.panelOfInspector, BaseTbl.lastRenewalDateManual, BaseTbl.phase, BaseTbl.phase1Invoice, BaseTbl.phase2Invoice, BaseTbl.phase3Invoice, BaseTbl.phase1InvoicePaid, BaseTbl.phase2InvoicePaid, BaseTbl.phase3InvoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, "Draft" as renewalStatus, 12 as renewalTypeId, Company.companyName, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_license as BaseTbl');
                $this->db->join('tbls_company as Company','Company.id = BaseTbl.companyId','left');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_license');
                    }
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.name, BaseTbl.fatherName, BaseTbl.address, BaseTbl.nic, BaseTbl.department, BaseTbl.designation, BaseTbl.phone, BaseTbl.email, BaseTbl.enterDate, BaseTbl.exitDate, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_companymanagement as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_companymanagement');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.name, BaseTbl.fatherName, BaseTbl.address, BaseTbl.nic, BaseTbl.phone, BaseTbl.designationId, BaseTbl.qualificationId, BaseTbl.specializationId, BaseTbl.enterDate, BaseTbl.exitDate, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_companyqualifiedstaff as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_companyqualifiedstaff');
                }
            }
            // $this->db->select('"'.$result.'" as masterId, BaseTbl.checklistId, BaseTbl.checklistCheckedId, BaseTbl.attachment, BaseTbl.description, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);                        
            // $this->db->from('tbl_licensechecklist as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensechecklist');
            //     }
            // }
            // $this->db->select('"'.$result.'" as masterId, BaseTbl.dosageId, BaseTbl.drugName, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);                     
            // $this->db->from('tbl_licensedrugclass as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensedrugclass');
            //     }
            // }                       
            // $this->db->select('"'.$result.'" as masterId, BaseTbl.type, BaseTbl.userId, BaseTbl.forwardedTo, BaseTbl.dateTime, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            // $this->db->from('tbl_licensehistory as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensehistory');
            //     }
            // }
            // $this->db->select('"'.$result.'" as masterId, BaseTbl.type, BaseTbl.meetingNo, BaseTbl.meetingDate, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            // $this->db->from('tbl_licensemeeting as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensemeeting');
            //     }
            // }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.sectionId, BaseTbl.pharmaGroupId, BaseTbl.usedForId, BaseTbl.approved, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_licensesection as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensesection');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.sectionId, BaseTbl.pharmaGroupId, BaseTbl.usedForId, BaseTbl.drugName, BaseTbl.machineMake, BaseTbl.machineModel, BaseTbl.machinePartNo, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_licensesectionmachine as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licensesectionmachine');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.filePath, BaseTbl.approvedFilePath, BaseTbl.description, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_licenselayoutplan as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_licenselayoutplan');
                }
            }
        }

        if(isset($searchResult)){
            //print_r($searchResult);
            print_r('<font color="#fff">Select query returned '.count($searchResult).' rows.</font>');
        }

        print_r('<br><br>');

        if(isset($resultdetail)){
            //print_r($resultdetail);
            print_r('<font color="#fff">Each record updated successfully.</font>');
        }

        print_r('<br><br>');

        print_r('<font color="#fff">You are genius!</font>');
    }

    function registrationRenewal()
    {
        // if(current server name <> 'actual server name'){
        //     $this->accessDenied();
        //     return;
        // }

        $data['createdby'] = 0;
        $data['createddate'] = date($this->dateTimeFormat);

        $functionName = __FUNCTION__;

        $searchResult = $this->cronJobModel->$functionName();

        $id = 0;
        foreach ($searchResult as $row){
            $id = $row->id;
            $companyId = $row->companyId;
            if($row->countSameRegistrationNo > 1){
                continue;
            }
            if($row->registrationTypeId == 1){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.masterId, BaseTbl.registrationTypeId, BaseTbl.regIssueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.registrationNo, BaseTbl.postchangeTypeId, BaseTbl.approvedName, BaseTbl.manufacturerId, BaseTbl.productCategoryId, BaseTbl.productOriginId, BaseTbl.intendedMarketId, BaseTbl.dosageFormId, BaseTbl.strength, BaseTbl.unit, BaseTbl.labelClaim, BaseTbl.packingDesc, BaseTbl.secondaryPackingDesc, BaseTbl.approvedPrice, BaseTbl.proposedArtworkPath, BaseTbl.approvedArtworkPath, BaseTbl.pharmacopeiaId, BaseTbl.atcCodeId, BaseTbl.atcCodeManual, BaseTbl.countryId, BaseTbl.usedForId, BaseTbl.routeOfAdminId, BaseTbl.shelfLifeId, BaseTbl.storageConditionId, BaseTbl.innovatorBrand, BaseTbl.innovatorCompany, BaseTbl.invoice, BaseTbl.invoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, 6 as renewalTypeId, "Draft" as renewalStatus, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_registration');
                    }
                }
            }
            if($row->registrationTypeId == 2){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.masterId, BaseTbl.registrationTypeId, BaseTbl.regIssueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.registrationNo, BaseTbl.postchangeTypeId, BaseTbl.approvedName, BaseTbl.manufacturerId, BaseTbl.productCategoryId, BaseTbl.productOriginId, BaseTbl.intendedMarketId, BaseTbl.dosageFormId, BaseTbl.strength, BaseTbl.unit, BaseTbl.labelClaim, BaseTbl.packingDesc, BaseTbl.secondaryPackingDesc, BaseTbl.approvedPrice, BaseTbl.proposedArtworkPath, BaseTbl.approvedArtworkPath, BaseTbl.pharmacopeiaId, BaseTbl.atcCodeId, BaseTbl.atcCodeManual, BaseTbl.countryId, BaseTbl.usedForId, BaseTbl.routeOfAdminId, BaseTbl.shelfLifeId, BaseTbl.storageConditionId, BaseTbl.innovatorBrand, BaseTbl.innovatorCompany, BaseTbl.invoice, BaseTbl.invoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, 7 as renewalTypeId, "Draft" as renewalStatus, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_registration');
                    }
                }
            }
            if($row->registrationTypeId == 3){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.masterId, BaseTbl.registrationTypeId, BaseTbl.regIssueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.registrationNo, BaseTbl.postchangeTypeId, BaseTbl.approvedName, BaseTbl.manufacturerId, BaseTbl.productCategoryId, BaseTbl.productOriginId, BaseTbl.intendedMarketId, BaseTbl.dosageFormId, BaseTbl.strength, BaseTbl.unit, BaseTbl.labelClaim, BaseTbl.packingDesc, BaseTbl.secondaryPackingDesc, BaseTbl.approvedPrice, BaseTbl.proposedArtworkPath, BaseTbl.approvedArtworkPath, BaseTbl.pharmacopeiaId, BaseTbl.atcCodeId, BaseTbl.atcCodeManual, BaseTbl.countryId, BaseTbl.usedForId, BaseTbl.routeOfAdminId, BaseTbl.shelfLifeId, BaseTbl.storageConditionId, BaseTbl.innovatorBrand, BaseTbl.innovatorCompany, BaseTbl.invoice, BaseTbl.invoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, 8 as renewalTypeId, "Draft" as renewalStatus, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_registration');
                    }
                }
            }
            if($row->registrationTypeId == 4){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.masterId, BaseTbl.registrationTypeId, BaseTbl.regIssueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.registrationNo, BaseTbl.postchangeTypeId, BaseTbl.approvedName, BaseTbl.manufacturerId, BaseTbl.productCategoryId, BaseTbl.productOriginId, BaseTbl.intendedMarketId, BaseTbl.dosageFormId, BaseTbl.strength, BaseTbl.unit, BaseTbl.labelClaim, BaseTbl.packingDesc, BaseTbl.secondaryPackingDesc, BaseTbl.approvedPrice, BaseTbl.proposedArtworkPath, BaseTbl.approvedArtworkPath, BaseTbl.pharmacopeiaId, BaseTbl.atcCodeId, BaseTbl.atcCodeManual, BaseTbl.countryId, BaseTbl.usedForId, BaseTbl.routeOfAdminId, BaseTbl.shelfLifeId, BaseTbl.storageConditionId, BaseTbl.innovatorBrand, BaseTbl.innovatorCompany, BaseTbl.invoice, BaseTbl.invoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, 9 as renewalTypeId, "Draft" as renewalStatus, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_registration');
                    }
                }
            }
            if($row->registrationTypeId == 10){
                $this->db->select('"'.$row->id.'" as parentId, BaseTbl.masterId, BaseTbl.registrationTypeId, BaseTbl.regIssueDate, BaseTbl.validTill, BaseTbl.lastRenewalDate, BaseTbl.registrationNo, BaseTbl.postchangeTypeId, BaseTbl.approvedName, BaseTbl.manufacturerId, BaseTbl.productCategoryId, BaseTbl.productOriginId, BaseTbl.intendedMarketId, BaseTbl.dosageFormId, BaseTbl.strength, BaseTbl.unit, BaseTbl.labelClaim, BaseTbl.packingDesc, BaseTbl.secondaryPackingDesc, BaseTbl.approvedPrice, BaseTbl.proposedArtworkPath, BaseTbl.approvedArtworkPath, BaseTbl.pharmacopeiaId, BaseTbl.atcCodeId, BaseTbl.atcCodeManual, BaseTbl.countryId, BaseTbl.usedForId, BaseTbl.routeOfAdminId, BaseTbl.shelfLifeId, BaseTbl.storageConditionId, BaseTbl.innovatorBrand, BaseTbl.innovatorCompany, BaseTbl.invoice, BaseTbl.invoicePaid, BaseTbl.renewalInvoice, BaseTbl.renewalInvoicePaid, 11 as renewalTypeId, "Draft" as renewalStatus, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
                $this->db->from('tbl_registration as BaseTbl');
                $this->db->where('BaseTbl.isDeleted', 0);
                $this->db->where('BaseTbl.id', $id);
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $result = $this->cronJobModel->recordCronJobSave($row, 'tbl_registration');
                    }
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.proposedName, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationproposedname as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationproposedname');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.packSize, BaseTbl.proposedPrice, BaseTbl.shelfLife, BaseTbl.approvedPrice, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationproposedprice as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationproposedprice');
                }
            }
            $this->db->select('"'.$result.'" as masterId,  BaseTbl.brandName, BaseTbl.registrationNo, BaseTbl.productHolder, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationdomesticreference as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationdomesticreference');
                }
            }
            $this->db->select('"'.$result.'" as masterId,  BaseTbl.brandName, BaseTbl.productHolder, BaseTbl.regulatingBody, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationinternationalreference as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationinternationalreference');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.checklistId, BaseTbl.checklistCheckedId, BaseTbl.attachment, BaseTbl.description, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationchecklist as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationchecklist');
                }
            }
            // $this->db->select('"'.$result.'" as masterId,  BaseTbl.type ,BaseTbl.userId ,BaseTbl.forwardedTo, BaseTbl.dateTime ,BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            // $this->db->from('tbl_registrationhistory as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationhistory');
            //     }
            // }
            // $this->db->select('"'.$result.'" as masterId, BaseTbl.type, BaseTbl.meetingNo, BaseTbl.meetingDate, BaseTbl.remarks, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            // $this->db->from('tbl_registrationmeeting as BaseTbl');
            // $this->db->where('BaseTbl.isDeleted', 0);
            // $this->db->where('BaseTbl.masterId', $id);
            // $query = $this->db->get();
            // $count = $query->num_rows();
            // if($count === 0){
            //     $this->session->set_flashdata('error', 'No record found.');
            // }
            // if($count > 0){
            //     foreach ($query->result() as $row){
            //         $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationmeeting');
            //     }
            // }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.folderData1, BaseTbl.folderData2, BaseTbl.folderData3, BaseTbl.folderData4, BaseTbl.folderData5, BaseTbl.folderData6, BaseTbl.folderData7, BaseTbl.folderData8, BaseTbl.folderData9, BaseTbl.folderData10, BaseTbl.folderData11, BaseTbl.folderData12, BaseTbl.folderData13, BaseTbl.folderData14, BaseTbl.folderData15, BaseTbl.folderData16, BaseTbl.folderData17, BaseTbl.folderData18, BaseTbl.folderData19, BaseTbl.folderData20, BaseTbl.folderData21, BaseTbl.folderData22, BaseTbl.folderData23, BaseTbl.folderData24, BaseTbl.folderData25, BaseTbl.folderData26, BaseTbl.folderData27, BaseTbl.folderData28, BaseTbl.folderData29, BaseTbl.folderData30, BaseTbl.folderData32, BaseTbl.folderData33, BaseTbl.folderData34, BaseTbl.folderData35, BaseTbl.folderData36, BaseTbl.folderData37, BaseTbl.folderData38, BaseTbl.folderData39, BaseTbl.folderData40, BaseTbl.folderData41, BaseTbl.folderData42, BaseTbl.folderData43, BaseTbl.folderData44, BaseTbl.folderData45, BaseTbl.folderData46, BaseTbl.folderData47, BaseTbl.folderData48, BaseTbl.folderData54, BaseTbl.folderData55, BaseTbl.folderData56, BaseTbl.folderData57, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qos as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qos');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.batchNumber, BaseTbl.batchSize, BaseTbl.mfgDate, BaseTbl.useOf, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosbatchanalysis as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosbatchanalysis');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.componentQualityStd, BaseTbl.quantityPerBatch, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosbatchformula as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosbatchformula');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.componentAndQty, BaseTbl.function, BaseTbl.perUnitQty, BaseTbl.percentage, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qoscompositionofdrugproduct as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qoscompositionofdrugproduct');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.containerSizeDesc, BaseTbl.containerSizeUnit, BaseTbl.containerSizeValue, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qoscontainerclosuresystem as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qoscontainerclosuresystem');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.controlsStep, BaseTbl.controlsTest, BaseTbl.controlsAcceptance, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qoscontrolsperformed as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qoscontrolsperformed');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.excipientName, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosexcipients as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosexcipients');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.brandName, BaseTbl.submissionDate, BaseTbl.drugSubstance, BaseTbl.substanceMfg, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosotherinfo as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosotherinfo');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.mfgNameAddress, BaseTbl.mfgResponsibility, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosproductmanufacturer as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosproductmanufacturer');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.storageCondition1, BaseTbl.batchNo, BaseTbl.batchSize, BaseTbl.containerClosure, BaseTbl.completedTestingInterval, BaseTbl.conclusion, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosproductstability as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosproductstability');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.storageCondition2, BaseTbl.batchNo2, BaseTbl.batchSize2, BaseTbl.containerClosure2, BaseTbl.completedTestingInterval2, BaseTbl.conclusion2, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosproductstability2 as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosproductstability2');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.storageStatement2, BaseTbl.shelfLife2, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosproposedstoragestatement as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosproposedstoragestatement');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.testName, BaseTbl.criteria, BaseTbl.reference, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosspecificidentification as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosspecificidentification');
                }
            }
            $this->db->select('"'.$result.'" as masterId, BaseTbl.containerClosure, BaseTbl.storageStatement, BaseTbl.shelfLife, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosstoragestatement as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosstoragestatement');
                }
            }
            $resultdetailId = 0;
            $this->db->select('"'.$result.'" as masterId, BaseTbl.id, BaseTbl.innCodeId, BaseTbl.strength, BaseTbl.unit, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_registrationinn as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $id = $row->id;
                    $resultdetailId = $this->cronJobModel->recordCronJobSave($row, 'tbl_registrationinn');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, "'.$result.'" as applicationId, BaseTbl.recommendedINNName, BaseTbl.compendialName, BaseTbl.chemicalName, BaseTbl.otherName, BaseTbl.casRegNumber, BaseTbl.structuralFormula, BaseTbl.molecularFormula, BaseTbl.relativeMolecularMass, BaseTbl.physicalDescription, BaseTbl.physicalForm, BaseTbl.solvate, BaseTbl.hydrate, BaseTbl.listOfStudies, BaseTbl.potentialForIsomerism, BaseTbl.potentialPolymorphicStudy, BaseTbl.particleSizeStudy, BaseTbl.specsStandard, BaseTbl.specsRef, BaseTbl.analyticalProcedure, BaseTbl.validationOfAnalyticalProc, BaseTbl.batchAnalysis, BaseTbl.justificationOfSpecs, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosspart as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosspart');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.medium, BaseTbl.solubility, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qossolubilities as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qossolubilities');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.mfgName, BaseTbl.latitude, BaseTbl.longitude, BaseTbl.responsibility, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosmanufacturers as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosmanufacturers');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.apiRelatedImpurity, BaseTbl.structure, BaseTbl.origin, BaseTbl.acceptanceLimit, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosdrugsubstance as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosdrugsubstance');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.compoundName, BaseTbl.compoundLimit, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosprocessimpurities as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosprocessimpurities');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.test, BaseTbl.acceptanceCriteria, BaseTbl.analyticalProcedure, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosspecifications as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosspecifications');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.packagingComponent, BaseTbl.materialOfConstruction, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qoscontainerclosure as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qoscontainerclosure');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.storageCondition, BaseTbl.batchNo, BaseTbl.batchSize, BaseTbl.containerClosure, BaseTbl.completedTestingInterval, BaseTbl.conclusion, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosstability as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosstability');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.storageCondition2, BaseTbl.batchNo2, BaseTbl.batchSize2, BaseTbl.containerClosure2, BaseTbl.completedTestingInterval2, BaseTbl.conclusion2, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosstability2 as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosstability2');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.storageCondition3, BaseTbl.batchNo3, BaseTbl.batchSize3, BaseTbl.containerClosure3, BaseTbl.completedTestingInterval3, BaseTbl.conclusion3, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosstability3 as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosstability3');
                }
            }
            $this->db->select('"'.$resultdetailId.'" as masterId, BaseTbl.containerClosureSystem, BaseTbl.storageConditions, BaseTbl.retestPeriod, BaseTbl.remarks, BaseTbl.status, BaseTbl.createdby as createdby, "'.$data['createddate'].'" as createddate', false);
            $this->db->from('tbl_qosproposedstoragecondition as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.masterId', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                foreach ($query->result() as $row){
                    $resultdetail = $this->cronJobModel->recordCronJobSave($row, 'tbl_qosproposedstoragecondition');
                }
            }
        }

        if(isset($searchResult)){
            //print_r($searchResult);
            print_r('<font color="#fff">Select query returned '.count($searchResult).' rows.</font>');
        }

        print_r('<br><br>');

        if(isset($resultdetail)){
            //print_r($resultdetail);
            print_r('<font color="#fff">Each record updated successfully.</font>');
        }

        print_r('<br><br>');

        print_r('<font color="#fff">You are genius!</font>');
    }

    function inuserecordUnlock()
    {
        // if(current server name <> 'actual server name'){
        //     $this->accessDenied();
        //     return;
        // }

        // $data['createdby'] = 0;
        // $data['createddate'] = date($this->dateTimeFormat);

        // $functionName = __FUNCTION__;

        // $result = $this->cronJobModel->$functionName();

        // $dataupdate = array('inUseBy' => 0, 'inUseTime' => '');

        // foreach ($result as $row){
        //     if($row->type == 'License'){
        //         $resultdetail = $this->cronJobModel->recordCronJobUpdate('id', $row->id, $dataupdate, 'tbl_license');
        //     }
        //     if($row->type == 'Registration'){
        //         $resultdetail = $this->cronJobModel->recordCronJobUpdate('id', $row->id, $dataupdate, 'tbl_registration');
        //     }
        //     if($row->type == 'Inspection'){
        //         $resultdetail = $this->cronJobModel->recordCronJobUpdate('id', $row->id, $dataupdate, 'tbl_inspection');
        //     }
        // }

        // if(isset($result)){
        //     //print_r($result);
        //     print_r('<font color="#fff">Select query returned '.count($result).' rows.</font>');
        // }

        // print_r('<br><br>');

        // if(isset($resultdetail)){
        //     //print_r($resultdetail);
        //     print_r('<font color="#fff">Each record updated successfully.</font>');
        // }

        // print_r('<br><br>');

        // print_r('<font color="#fff">You are genius!</font>');
        print_r('<font color="#fff">Currently Disabled.</font>');
    }

    function backupDB(){
        $this->load->database();

        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('backup/pirims_'.date('d-M-y H-i-s').'.gz', $backup);

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        //force_download('pirims.gz', $backup);

        redirect();
    }
}
