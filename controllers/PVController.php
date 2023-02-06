<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/controllers/Login.php';

class PVController extends Login
{


    public function __construct()
    {
        parent::__construct();
        $this->isLoggedIn1();
    }


    public function qualifiedPerson($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvmodule1';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }
            
            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId == '26' && $data['recordsEdit'][0]->companyId <> $this->companyId) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from('tbl_pvmodule1 as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }
            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            $this->db->select('BaseTbl.id, BaseTbl.companyId, Company.companyUniqueNo, Company.companyName');
            $this->db->from('tbls_user as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', $this->userId);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyName = $row->companyName;
                    $companyUniqueNo = $row->companyUniqueNo;
                }
            }
            $data['companyId'] = $this->companyId;

            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                }
            }

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);


            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }


            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*, Company.companyName, Company.companyUniqueNo');
            $this->db->from('tbl_pvmodule1 as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;
                }
            }
            

            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissionDate'] = date($this->dateTimeFormat);
                }
            } 
            else if ($this->roleId == '6') { // Licensing Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Deferred and Closed') {
                    $data['status'] = 'Deferred and Closed';
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'approveclb') {
                    $data['status'] = $status;
                    $data['discussInBoard'] = 0;
                }

            }
            else if ($this->roleId == '10') { // Licensing Additional Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
            }
            else if ($this->roleId == '14') { // Licensing Deputy Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
            }
            else if ($this->roleId == '18') { // Licensing Assistant Director
                if ($data['status'] == 'Save' || $data['status'] == 'fwdapproval') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Referred Back To Company') {
                    if ($status == 'Under Review Stage 1') {
                        $data['status'] = 'Referred Back To Company (Locked)';
                    } else {
                        $data['status'] = 'Referred Back To Company (Locked)';
                    }
                }


                if ($data['status'] == 'Proceed') {
                    if ($status == 'Under Review Stage 1') {
                        if ($phase == 'Site Verification' || $phase == 'Grant of License') {
                            $data['status'] = 'Under Inspection';
                        }
                        if ($phase == 'Layout Plan') {
                            $data['layoutApprovedBy'] = $this->userId;
                            $data['status'] = 'Draft';
                            $data['phase'] = 'Grant of License';
                        }

                        if ($phase == 'Site Verification') {
                            $resultdetail = $this->loginModel->recordAjaxSave(['inspectionTypeId' => 5, 'refId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'companyId' => $companyId, 'inspectionStatus' => 'Draft', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate'], 'updateddate' => $data['updateddate']], 'tbl_inspection');
                        }
                        if ($phase == 'Grant of License') {
                            $resultdetail = $this->loginModel->recordAjaxSave(['inspectionTypeId' => 7, 'refId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'companyId' => $companyId, 'inspectionStatus' => 'Draft', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate'], 'updateddate' => $data['updateddate']], 'tbl_inspection');
                        }
                        if ($data['status'] == 'Under Inspection') {
                            // ------------------- Send Mail Start -------------------
                            $inspDirector = $this->myModel->getRecords('tbls_user', 'id', 121);
                            if (isset($inspDirector[0]->email)) {
                                $mailData['from'] = 'DRAP';
                                $mailData['subject'] = 'PIRIMS | Inspection';
                                $mailData['title'] = 'Greetings, ' . $inspDirector[0]->userName . '!';
                                $mailData['message'] = "The Licensing Division requested an inspection, please log in to PIRIMS to complete the inspection. ";
                                $mailData['email'] = $inspDirector[0]->email;
                                $sendStatus = emailSend($mailData);
                                if ($sendStatus == true) {
                                    $result = 1;
                                }
                            }
                            if (!isset($inspDirector[0]->email)) {
                                $result = 0;
                            }
                            // ------------------- Send Mail End -------------------

                        }
                    }
                    if ($status == 'Post Inspection Process') {
                        if ($phase == 'Site Verification') {
                            $data['siteApprovedBy'] = $this->userId;
                            $data['status'] = 'Draft';
                            $data['phase'] = 'Layout Plan';
                        }
                        if ($phase == 'Grant of License') {
                            $data['status'] = 'Under Board Stage 2';
                            $data['phase'] = 'Grant of License';
                        }
                    }
                    if ($status == 'Recommended By Board Stage 3') {
                        $data['status'] = $status;
                    }
                }

                if ($data['status'] == 'Approved') {
                    if ($status == 'Recommended By Board Stage 3' && $phase == 'Grant of License') {
                        $data['status'] = 'Approved';
                        $data['licenseApprovedBy'] = $this->userId;
                        $data['issueDate'] = date($this->dateTimeFormat);
                        $validTill1 = date_create(date('Y-m-d H:i', strtotime($validTill1 . ' +5 YEAR')));
                        $validTill1 = date_format($validTill1, $this->dateTimeFormat);
                        $data['validTill'] = $validTill1;
                        $data['licenseNo'] = 'L-N-' . $id;
                        $data['status'] = 'Active';
                        // ------------------- Send Mail Start -------------------
                        if (isset($email)) {
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | License Approved';
                            $mailData['title'] = 'Greetings, ' . $userName . '!';
                            $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been approved. In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $email;
                            $sendStatus = emailSend($mailData);
                            if ($sendStatus == true) {
                                $result = 1;
                            }
                        }
                        if (!isset($email)) {
                            $result = 0;
                        }
                        // ------------------- Send Mail End -------------------
                    }
                }
                if ($data['status'] == 'Deferred and Closed') {
                    $data['status'] = 'Deferred and Closed';
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }

            }
            else if ($this->roleId == '38') { // Licensing Assigning Officer
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                    if ($status == 'Submitted' || $status == 'Screening') {
                        $data['status'] = 'Under Review Stage 1';
                        // ------------------- Send Alert Start -------------------
                        $this->db->select('BaseTbl.id, BaseTbl.masterId, BaseTbl.forwardedTo, User.userName');
                        $this->db->from('tbl_licensehistory as BaseTbl');
                        $this->db->join('tbls_user as User', 'User.id = BaseTbl.forwardedTo', 'left');
                        $this->db->where('BaseTbl.isDeleted', 0);
                        $this->db->where('BaseTbl.masterId', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $this->db->limit(1);
                        $this->db->order_by('BaseTbl.id', 'desc');
                        $queryAlert = $this->db->get();
                        $countAlert = $queryAlert->num_rows();
                        if ($countAlert === 0) {
                            $this->session->set_flashdata('error', 'No record found.');
                        }
                        if ($countAlert > 0) {
                            foreach ($queryAlert->result() as $rowAlert) {
                                $id = $rowAlert->id;
                                $masterId = $rowAlert->masterId;
                                $forwardedTo = $rowAlert->forwardedTo;
                                $userName = $rowAlert->userName;
                            }
                        }

                        $resultdetail = $this->loginModel->recordAjaxSave(['type' => 'User', 'alertName' => 'Greetings ' . $userName . ', New Task For You!', 'description' => 'Please Assign. Link: <a href="' . base_url() . 'license/edit/' . $masterId . '">PIRIMS</a>', 'dateTime' => $data['updateddate'], 'duration' => 'now', 'recepients' => '0,' . $forwardedTo, 'status' => 'Active', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_alert');
                        // ------------------- Send Alert End -------------------
                    }
                    if ($status == 'Under Review Stage 1') {
                        $data['status'] = $status;
                        // ------------------- Send Alert Start -------------------
                        $this->db->select('BaseTbl.id, BaseTbl.masterId, BaseTbl.forwardedTo, User.userName');
                        $this->db->from('tbl_licensehistory as BaseTbl');
                        $this->db->join('tbls_user as User', 'User.id = BaseTbl.forwardedTo', 'left');
                        $this->db->where('BaseTbl.isDeleted', 0);
                        $this->db->where('BaseTbl.masterId', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $this->db->limit(1);
                        $this->db->order_by('BaseTbl.id', 'desc');
                        $queryAlert = $this->db->get();
                        $countAlert = $queryAlert->num_rows();
                        if ($countAlert === 0) {
                            $this->session->set_flashdata('error', 'No record found.');
                        }
                        if ($countAlert > 0) {
                            foreach ($queryAlert->result() as $rowAlert) {
                                $id = $rowAlert->id;
                                $masterId = $rowAlert->masterId;
                                $forwardedTo = $rowAlert->forwardedTo;
                                $userName = $rowAlert->userName;
                            }
                        }

                        $resultdetail = $this->loginModel->recordAjaxSave(['type' => 'User', 'alertName' => 'Greetings ' . $userName . ', New Task For You!', 'description' => 'Please Assign. Link: <a href="' . base_url() . 'license/edit/' . $masterId . '">PIRIMS</a>', 'dateTime' => $data['updateddate'], 'duration' => 'now', 'recepients' => '0,' . $forwardedTo, 'status' => 'Active', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_alert');
                        // ------------------- Send Alert End -------------------
                    }
                }
            }
            else if ($this->roleId == '43') { // Licensing Board Secretary
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Deferred and Closed') {
                    if ($status == 'Under Board Stage 2') {
                        $data['status'] = 'Deferred and Closed';
                    }
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }
                if ($data['status'] == 'Proceed') {
                    if ($status == 'Under Board Stage 2' && $phase == 'Grant of License') {
                        $data['status'] = 'Recommended By Board Stage 3';
                    }
                    if ($status == 'Recommended By Board Stage 3' && $phase == 'Grant of License') {
                        $data['status'] = $status;
                    }
                }
            }
            else if ($this->roleId == '42') { // CEO

            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }


    public function pmsf($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvpmsf';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyId <> $this->companyId) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            }
            else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }


            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            $this->db->select('BaseTbl.id, BaseTbl.companyId, Company.companyUniqueNo, Company.companyName');
            $this->db->from('tbls_user as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', $this->userId);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $companyName = $row->companyName;
                }
            }

            // PMSF Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                $data['companyId'] = $companyId;
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                }
            }
            // PMSF Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);


            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*, Company.companyUniqueNo, Company.companyName');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $status = $row->status;
                    $companyUniqueNo = $row->companyUniqueNo;

                }
            }

            if ($this->roleId == '26') { // Company Submission

                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';

                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissionDate'] = date($this->dateTimeFormat);
                }
            }
            else if ($this->roleId == '6') { // Licensing Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Deferred and Closed') {
                    $data['status'] = 'Deferred and Closed';
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'approveclb') {
                    $data['status'] = $status;
                    $data['discussInBoard'] = 0;
                }

            }
            else if ($this->roleId == '10') { // Licensing Additional Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
            }
            else if ($this->roleId == '14') { // Licensing Deputy Director
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                }
            }
            else if ($this->roleId == '18') { // Licensing Assistant Director
                if ($data['status'] == 'Save' || $data['status'] == 'fwdapproval') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Referred Back To Company') {
                    if ($status == 'Under Review Stage 1') {
                        $data['status'] = 'Referred Back To Company (Locked)';
                    } else {
                        $data['status'] = 'Referred Back To Company (Locked)';
                    }
                }


                if ($data['status'] == 'Proceed') {
                    if ($status == 'Under Review Stage 1') {
                        if ($phase == 'Site Verification' || $phase == 'Grant of License') {
                            $data['status'] = 'Under Inspection';
                        }
                        if ($phase == 'Layout Plan') {
                            $data['layoutApprovedBy'] = $this->userId;
                            $data['status'] = 'Draft';
                            $data['phase'] = 'Grant of License';
                        }

                        if ($phase == 'Site Verification') {
                            $resultdetail = $this->loginModel->recordAjaxSave(['inspectionTypeId' => 5, 'refId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'companyId' => $companyId, 'inspectionStatus' => 'Draft', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate'], 'updateddate' => $data['updateddate']], 'tbl_inspection');
                        }
                        if ($phase == 'Grant of License') {
                            $resultdetail = $this->loginModel->recordAjaxSave(['inspectionTypeId' => 7, 'refId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'companyId' => $companyId, 'inspectionStatus' => 'Draft', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate'], 'updateddate' => $data['updateddate']], 'tbl_inspection');
                        }
                        if ($data['status'] == 'Under Inspection') {
                            // ------------------- Send Mail Start -------------------
                            $inspDirector = $this->myModel->getRecords('tbls_user', 'id', 121);
                            if (isset($inspDirector[0]->email)) {
                                $mailData['from'] = 'DRAP';
                                $mailData['subject'] = 'PIRIMS | Inspection';
                                $mailData['title'] = 'Greetings, ' . $inspDirector[0]->userName . '!';
                                $mailData['message'] = "The Licensing Division requested an inspection, please log in to PIRIMS to complete the inspection. ";
                                $mailData['email'] = $inspDirector[0]->email;
                                $sendStatus = emailSend($mailData);
                                if ($sendStatus == true) {
                                    $result = 1;
                                }
                            }
                            if (!isset($inspDirector[0]->email)) {
                                $result = 0;
                            }
                            // ------------------- Send Mail End -------------------

                        }
                    }
                    if ($status == 'Post Inspection Process') {
                        if ($phase == 'Site Verification') {
                            $data['siteApprovedBy'] = $this->userId;
                            $data['status'] = 'Draft';
                            $data['phase'] = 'Layout Plan';
                        }
                        if ($phase == 'Grant of License') {
                            $data['status'] = 'Under Board Stage 2';
                            $data['phase'] = 'Grant of License';
                        }
                    }
                    if ($status == 'Recommended By Board Stage 3') {
                        $data['status'] = $status;
                    }
                }

                if ($data['status'] == 'Approved') {
                    if ($status == 'Recommended By Board Stage 3' && $phase == 'Grant of License') {
                        $data['status'] = 'Approved';
                        $data['licenseApprovedBy'] = $this->userId;
                        $data['issueDate'] = date($this->dateTimeFormat);
                        $validTill1 = date_create(date('Y-m-d H:i', strtotime($validTill1 . ' +5 YEAR')));
                        $validTill1 = date_format($validTill1, $this->dateTimeFormat);
                        $data['validTill'] = $validTill1;
                        $data['licenseNo'] = 'L-N-' . $id;
                        $data['status'] = 'Active';
                        // ------------------- Send Mail Start -------------------
                        if (isset($email)) {
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | License Approved';
                            $mailData['title'] = 'Greetings, ' . $userName . '!';
                            $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been approved. In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $email;
                            $sendStatus = emailSend($mailData);
                            if ($sendStatus == true) {
                                $result = 1;
                            }
                        }
                        if (!isset($email)) {
                            $result = 0;
                        }
                        // ------------------- Send Mail End -------------------
                    }
                }
                if ($data['status'] == 'Deferred and Closed') {
                    $data['status'] = 'Deferred and Closed';
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }

            }
            else if ($this->roleId == '38') { // Licensing Assigning Officer
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Proceed') {
                    $data['status'] = $status;
                    if ($status == 'Submitted' || $status == 'Screening') {
                        $data['status'] = 'Under Review Stage 1';
                        // ------------------- Send Alert Start -------------------
                        $this->db->select('BaseTbl.id, BaseTbl.masterId, BaseTbl.forwardedTo, User.userName');
                        $this->db->from('tbl_licensehistory as BaseTbl');
                        $this->db->join('tbls_user as User', 'User.id = BaseTbl.forwardedTo', 'left');
                        $this->db->where('BaseTbl.isDeleted', 0);
                        $this->db->where('BaseTbl.masterId', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $this->db->limit(1);
                        $this->db->order_by('BaseTbl.id', 'desc');
                        $queryAlert = $this->db->get();
                        $countAlert = $queryAlert->num_rows();
                        if ($countAlert === 0) {
                            $this->session->set_flashdata('error', 'No record found.');
                        }
                        if ($countAlert > 0) {
                            foreach ($queryAlert->result() as $rowAlert) {
                                $id = $rowAlert->id;
                                $masterId = $rowAlert->masterId;
                                $forwardedTo = $rowAlert->forwardedTo;
                                $userName = $rowAlert->userName;
                            }
                        }

                        $resultdetail = $this->loginModel->recordAjaxSave(['type' => 'User', 'alertName' => 'Greetings ' . $userName . ', New Task For You!', 'description' => 'Please Assign. Link: <a href="' . base_url() . 'license/edit/' . $masterId . '">PIRIMS</a>', 'dateTime' => $data['updateddate'], 'duration' => 'now', 'recepients' => '0,' . $forwardedTo, 'status' => 'Active', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_alert');
                        // ------------------- Send Alert End -------------------
                    }
                    if ($status == 'Under Review Stage 1') {
                        $data['status'] = $status;
                        // ------------------- Send Alert Start -------------------
                        $this->db->select('BaseTbl.id, BaseTbl.masterId, BaseTbl.forwardedTo, User.userName');
                        $this->db->from('tbl_licensehistory as BaseTbl');
                        $this->db->join('tbls_user as User', 'User.id = BaseTbl.forwardedTo', 'left');
                        $this->db->where('BaseTbl.isDeleted', 0);
                        $this->db->where('BaseTbl.masterId', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $this->db->limit(1);
                        $this->db->order_by('BaseTbl.id', 'desc');
                        $queryAlert = $this->db->get();
                        $countAlert = $queryAlert->num_rows();
                        if ($countAlert === 0) {
                            $this->session->set_flashdata('error', 'No record found.');
                        }
                        if ($countAlert > 0) {
                            foreach ($queryAlert->result() as $rowAlert) {
                                $id = $rowAlert->id;
                                $masterId = $rowAlert->masterId;
                                $forwardedTo = $rowAlert->forwardedTo;
                                $userName = $rowAlert->userName;
                            }
                        }

                        $resultdetail = $this->loginModel->recordAjaxSave(['type' => 'User', 'alertName' => 'Greetings ' . $userName . ', New Task For You!', 'description' => 'Please Assign. Link: <a href="' . base_url() . 'license/edit/' . $masterId . '">PIRIMS</a>', 'dateTime' => $data['updateddate'], 'duration' => 'now', 'recepients' => '0,' . $forwardedTo, 'status' => 'Active', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_alert');
                        // ------------------- Send Alert End -------------------
                    }
                }
            }
            else if ($this->roleId == '43') { // Licensing Board Secretary
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Deferred and Closed') {
                    if ($status == 'Under Board Stage 2') {
                        $data['status'] = 'Deferred and Closed';
                    }
                    // ------------------- Send Mail Start -------------------
                    if (isset($email)) {
                        $mailData['from'] = 'DRAP';
                        $mailData['subject'] = 'PIRIMS | License Rejected';
                        $mailData['title'] = 'Greetings, ' . $userName . '!';
                        $mailData['message'] = "Your license application with ref. no " . $rniRefNo . " has been rejected. In case of any query please write us at: support.pirims@dra.gov.pk";
                        $mailData['email'] = $email;
                        $sendStatus = emailSend($mailData);
                        if ($sendStatus == true) {
                            $result = 1;
                        }
                    }
                    if (!isset($email)) {
                        $result = 0;
                    }
                    // ------------------- Send Mail End -------------------
                }
                if ($data['status'] == 'Proceed') {
                    if ($status == 'Under Board Stage 2' && $phase == 'Grant of License') {
                        $data['status'] = 'Recommended By Board Stage 3';
                    }
                    if ($status == 'Recommended By Board Stage 3' && $phase == 'Grant of License') {
                        $data['status'] = $status;
                    }
                }
            }
            else if ($this->roleId == '42') { // CEO

            } else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }


            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

    public function riskManagement($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvriskManagementPlans';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);
        $data['recordsdetailattachments'] = $this->pvModel->getRecordAttachments($id,$table.'Attachments');

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }


            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            $this->db->select('BaseTbl.id, BaseTbl.companyId, Company.companyName');
            $this->db->from('tbls_user as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', $this->userId);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyName = $row->companyName;
                }
            }

            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);


            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }
            $sId = 0;
            $keys = array_keys($dataDetailTable);
            foreach (array_keys($dataDetailTable) as $key) {
                $current_key = current($keys);
                $current_value = $dataDetailTable[$current_key];
                $next_key = next($keys);
                $next_value = @$dataDetailTable[$next_key];
                $tableName = substr($current_key, 0, strpos($current_key, '-'));
                $nextTableName = substr($next_key, 0, strpos($next_key, '-'));
                if ($tableName == 'tabledetailattachments') {
                    $tableDetail = $table.'Attachments';
                    $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $current_value;
                    $totalFiles = @count(@$_FILES[$current_key]['tmp_name']);
                    for ($i = 0; $i < $totalFiles; $i++) {
                        if (@$_FILES[$current_key]['tmp_name'][$i]) {
                            $fileNames[] = $this->fileMoveMultiple('Attachment', $current_key, $i, $this->companyUniqueNo, 'docs');
                            $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $fileNames;
                        }
                    }
                    if ($myAction == 'save') {
                        $masterId = $result;
                    }
                    if ($myAction == 'update') {
                        $masterId = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);
                    }
                    if ($nextTableName <> $tableName) {
                        $resultdetail = $this->dataDetailTableSave($masterId, $datadetail, $tableDetail);
                        unset($datadetail);
                    }
                }
                $sId++;
            }


            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*,  Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;

                }
            }

            if (isset($_POST['tabledetailattachments-remarks_detail']) && count($_POST['tabledetailattachments-remarks_detail']) > 0) {

                $tableDetail = $table.'Attachments';
                $this->myModel->recordDelete('masterId',$id,$tableDetail);

                for ($ind = 0; $ind < count($_POST['tabledetailattachments-remarks_detail']); $ind++) {
                    $attachment = array();
                    $attachment['remarks'] = $_POST['tabledetailattachments-remarks_detail'][$ind];
                    $attachment['masterId'] = $id;
                    if (@$_FILES['tabledetailattachments-filePath_detail']['tmp_name'][$ind]) {
                        $attachment['filePath'] = $this->fileMoveMultiple('Attachment', 'tabledetailattachments-filePath_detail', $ind, $this->companyUniqueNo, 'docs');
                    } else {

                        $attachment['filePath'] = ($_POST['tabledetailattachments-filePath_detail'][$ind])?$_POST['tabledetailattachments-filePath_detail'][$ind]:null;
                    }
                    $attachment['isDeleted'] = ($_POST['tabledetailattachments-isDeleted_detail'][$ind]==1)?1:0;
                    $resultdetail = $this->loginModel->recordAjaxSave($attachment, $tableDetail);

                }

            }


            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['submissionDate'] = date($this->dateTimeFormat);
                    $data['status'] = 'Active';

                }
            }

            //  Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);
/*

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }
            $sId = 0;
            $keys = array_keys($dataDetailTable);
            foreach (array_keys($dataDetailTable) as $key) {
                $current_key = current($keys);
                $current_value = $dataDetailTable[$current_key];
                $next_key = next($keys);
                $next_value = @$dataDetailTable[$next_key];
                $tableName = substr($current_key, 0, strpos($current_key, '-'));
                $nextTableName = substr($next_key, 0, strpos($next_key, '-'));
                if ($tableName == 'tabledetailattachments') {
                    $tableDetail = $table.'Attachments';
                    $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $current_value;
                    $totalFiles = @count(@$_FILES[$current_key]['tmp_name']);
                    for ($i = 0; $i < $totalFiles; $i++) {
                        if (@$_FILES[$current_key]['tmp_name'][$i]) {
                            $fileNames[] = $this->fileMoveMultiple('Attachment', $current_key, $i, $companyUniqueNo, 'docs');
                            $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $fileNames;
                        }
                    }
                    if ($myAction == 'save') {
                        $masterId = $result;
                    }
                    if ($myAction == 'update') {
                        $masterId = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);
                    }
                    if ($nextTableName <> $tableName) {
                        $resultdetail = $this->dataDetailTableSave($masterId, $datadetail, $tableDetail);
                        unset($datadetail);
                    }
                }
                $sId++;
            }
*/

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

    public function adverseEvents($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvadverseEvents';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                redirect(__FUNCTION__ . '/lookup');
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*,  Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;
                }
            }


            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['submissionDate'] = date($this->dateTimeFormat);
                    $data['status'] = 'Active';
                }
            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }
    public function adverseEventsADR($action = NULL, $id = NULL)
    {
        $this->accessDenied();
        return;

        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvadverseEvents';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                redirect(__FUNCTION__ . '/lookup');
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*,  Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;
                }
            }


            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['submissionDate'] = date($this->dateTimeFormat);
                    $data['status'] = 'Active';
                }
            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }
    public function adverseEventsNilReport($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvadverseEventsNil';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                redirect(__FUNCTION__ . '/lookup');
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }

            if ($result > 0 || $resultdetail > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*,  Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;
                }
            }


            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['submissionDate'] = date($this->dateTimeFormat);
                    $data['status'] = 'Active';
                }
            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

    public function pbrer($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvpbrer';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);
        $data['recordsdetailattachments'] = $this->pvModel->getRecordAttachments($id,$table.'Attachments');

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        }
        else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }


            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);

            foreach ($this->input->post() as $key => $row) {
                if (substr($key, -6) == 'detail') {
                    $dataDetailTable[$key] = $row;
                }
            }
            $sId = 0;
            $keys = array_keys($dataDetailTable);
            foreach (array_keys($dataDetailTable) as $key) {
                $current_key = current($keys);
                $current_value = $dataDetailTable[$current_key];
                $next_key = next($keys);
                $next_value = @$dataDetailTable[$next_key];
                $tableName = substr($current_key, 0, strpos($current_key, '-'));
                $nextTableName = substr($next_key, 0, strpos($next_key, '-'));
                if ($tableName == 'tabledetailattachments') {
                    $tableDetail = $table.'Attachments';
                    $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $current_value;
                    $totalFiles = @count(@$_FILES[$current_key]['tmp_name']);
                    for ($i = 0; $i < $totalFiles; $i++) {
                        if (@$_FILES[$current_key]['tmp_name'][$i]) {
                            $fileNames[] = $this->fileMoveMultiple('Attachment', $current_key, $i, $this->companyUniqueNo, 'docs');
                            $datadetail[substr($current_key, strpos($current_key, '-') + 1, strrpos($current_key, '_') - strrpos($current_key, '-') - 1)] = $fileNames;
                        }
                    }
                    if ($myAction == 'save') {
                        $masterId = $result;
                    }
                    if ($myAction == 'update') {
                        $masterId = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);
                    }
                    if ($nextTableName <> $tableName) {
                        $resultdetail = $this->dataDetailTableSave($masterId, $datadetail, $tableDetail);
                        unset($datadetail);
                    }
                }
                $sId++;
            }


            if ($result > 0 ) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        }
        else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            //  Workflow Update START
            $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;
                }
            }


            if (isset($_POST['tabledetailattachments-remarks_detail']) && count($_POST['tabledetailattachments-remarks_detail']) > 0) {

                $tableDetail = $table.'Attachments';
                $this->myModel->recordDelete('masterId',$id,$tableDetail);

                for ($ind = 0; $ind < count($_POST['tabledetailattachments-remarks_detail']); $ind++) {
                    $attachment = array();
                    $attachment['remarks'] = $_POST['tabledetailattachments-remarks_detail'][$ind];
                    $attachment['masterId'] = $id;
                    if (@$_FILES['tabledetailattachments-filePath_detail']['tmp_name'][$ind]) {
                        $attachment['filePath'] = $this->fileMoveMultiple('Attachment', 'tabledetailattachments-filePath_detail', $ind, $this->companyUniqueNo, 'docs');
                    } else {

                        $attachment['filePath'] = ($_POST['tabledetailattachments-filePath_detail'][$ind])?$_POST['tabledetailattachments-filePath_detail'][$ind]:null;
                    }
                    $attachment['isDeleted'] = ($_POST['tabledetailattachments-isDeleted_detail'][$ind]==1)?1:0;
                    $resultdetail = $this->loginModel->recordAjaxSave($attachment, $tableDetail);

                }

            }



            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissiondate'] = date($this->dateTimeFormat);

                }
            }
            else {
                $data['status'] = $status;
            }
            //  Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

    public function pass($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvpass';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                if ($this->roleId <> '38') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }



            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);



            if ($result > 0 ) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;

                }
            }


            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissiondate'] = date($this->dateTimeFormat);

                }
            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }


    public function detectedSignals($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvdetectedsignals';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }


            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }


            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);


            $result = $this->loginModel->recordAjaxSave($data, $table);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;

                }
            }



            unset($data['undefined']);

            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissiondate'] = date($this->dateTimeFormat);

                }
            }
            else {
                $data['status'] = $status;
            }
            // Licensing Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0 ) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

    public function safetyCommunications($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if (!isset($isLoggedIn) || $isLoggedIn != TRUE) {
            redirect('login');
        }
        $found = false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if (!empty($rolePage)) {
            foreach ($rolePage as $res) {
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if (__FUNCTION__ == $pageName) {
                    $found = true;
                    break;
                }
            }
        }
        if ($found == false) {
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__ . 'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject . ' | ' . $data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if ($action == 'submit') {
            if (explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if (explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__) {
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if ($myAction == 'add') {
                $myAction = 'save';
            }
            if ($myAction == 'edit') {
                $myAction = 'update';
            }
        }

        $table = 'tbl_pvsafetycomm';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $this->load->model("pvModel");
        $data['records'] = $this->pvModel->getRecord($table, $searchText);
        $data['recordsEdit'] = $this->pvModel->getRecordEdit($id, $table);

        if ($action == 'lookup' && $recordLookup == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'add' && $recordAdd == 1) {
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'edit' && $recordEdit == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }

            if ($data['recordsEdit'][0]->status == 'Draft') {
                if ($this->roleId <> '26' && $data['recordsEdit'][0]->companyUniqueNo <> $this->companyUniqueNo) {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
                }
            } else if ($data['recordsEdit'][0]->status == 'Active') {
                    $this->session->set_flashdata('error', 'You are not authorized to edit this record.');
                    redirect(__FUNCTION__ . '/lookup');
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'view' && $recordView == 1) {
            if (!$id) {
                $this->accessDenied();
                return;
            }
            $this->loadViews('company/' . $this->companyName . '/pv/' . __FUNCTION__, $this->global, $data, NULL);
        } else if ($action == 'delete' && $recordDelete == 1) {
            $data = array('isDeleted' => 1, 'updateddate' => date($this->dateTimeFormat), 'updatedby' => $this->userId);

            $this->db->select('BaseTbl.status');
            $this->db->from($table.' as BaseTbl');
            $this->db->where('BaseTbl.id', $id);
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'save' && $recordSubmit == 1) {
            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }
            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            //  Workflow Save START
            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = 'Draft';
                    $data['companyId'] = $this->companyId;
                }
                unset($data['forwardedTo_detail101']);
                unset($data['remarks_detail101']);
                unset($data['sendQueryToCompany']);
            }
            //  Workflow Save END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
            }
            unset($data['undefined']);

            $result = $this->loginModel->recordAjaxSave($data, $table);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'New record saved successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else if ($myAction == 'update' && $recordSubmit == 1) {

            $data = $this->input->post();
            if (!$data) {
                $this->accessDenied();
                return;
            }


            $validationFailed = 0;

            if ($this->form_validation->run() == FALSE) {
                $validationFailed = 1;
                $this->session->set_flashdata('error', validation_errors());
            }

            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            foreach ($data as $key => $row) {
                if (strpos($key, '-') !== false || strpos($key, '_length') !== false) {
                    unset($data[$key]);
                }
            }

            // Licensing Workflow Update START
            $this->db->select('BaseTbl.*, Company.id as companyId, Company.companyUniqueNo');
            $this->db->from($table.' as BaseTbl');
            $this->db->join('tbls_company as Company', 'Company.id = BaseTbl.companyId', 'left');
            $this->db->join('tbls_user as User', 'User.companyId = Company.id', 'left');
            $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
            $query = $this->db->get();
            $count = $query->num_rows();
            if ($count === 0) {
                $this->session->set_flashdata('error', 'No record found.');
                $result = 0;
            }
            if ($count > 0) {
                foreach ($query->result() as $row) {
                    $id = $row->id;
                    $companyId = $row->companyId;
                    $companyUniqueNo = $row->companyUniqueNo;
                    $status = $row->status;

                }
            }



           unset($data['undefined']);

            if ($this->roleId == '26') { // Company Submission
                if ($data['status'] == 'Save') {
                    $data['status'] = $status;
                }
                if ($data['status'] == 'Submit') {
                    $data['status'] = 'Active';
                    $data['submissiondate'] = date($this->dateTimeFormat);

                }
            }
             else {
                $data['status'] = $status;
            }
            //  Workflow Update END

            foreach ($data as $key => $row) {
                if (@$_FILES[$key]['tmp_name']) {
                    $data[$key] = $this->fileMove('Attachment', $key, $companyUniqueNo, 'docs');
                }
            }

            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);


            if ($result > 0 ) {
                $this->session->set_flashdata('success', 'Record updated successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__ . '/lookup');
        } else {
            $this->accessDenied();
            return;
        }
    }

}