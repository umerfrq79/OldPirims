<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	// protected $userId = '';
	// protected $roleId = '';
	// protected $global = array ();

	public function __construct()
    {
        parent::__construct();

        date_default_timezone_set("Asia/Karachi");

        $isLoggedIn = $this->session->userdata('isLoggedIn');

        if(isset($isLoggedIn) || $isLoggedIn == TRUE)
        {
            $email = $this->session->userdata('userEmail');
            $password = $this->session->userdata('plainPassword');
            
            $result = $this->loginModel->loginMe1($email, $password);
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $this->userId = $res->id;
                    $this->userEmail = $res->email;
                    $this->userName = $res->userName;
                    $this->profilepic = $res->profilepic;
                    $this->startDate = $res->startDate;
                    $this->endDate = $res->endDate;
                    $this->resumeDate = $res->resumeDate;
                    $this->countryId = $res->countryId;
                    $this->countryName = $res->countryName;
                    $this->countryFlag = $res->countryFlag;
                    $this->wallpaper = $res->wallpaper;
                    $this->status = $res->status;
                    $this->userUniqueNo = $res->userUniqueNo;
                    $this->companyId = $res->companyId;
                    $this->companyUniqueNo = $res->companyUniqueNo;
                    $this->roleId = $res->roleId;
                    $this->department = $res->department;
                    $this->designation = $res->designation;
                    $this->companyName = 'DRAP';
                    $this->companyNick = 'DRAP';
                    $this->companyCategory = $res->companyCategory;
                    $this->companySubCategory = $res->companySubCategory;
                    $this->companyUserType = $res->companyUserType;
                    $this->companyAddress = 'Drug Regulatory Authority Of Pakistan';
                    $this->companyProject = 'PIRIMS';
                    $this->companyEmail = $res->companyEmail;
                    $this->companyStatus = $res->companyStatus;
                    $this->companyTheme = 'navbar-dark';
                    $this->dateFormat = 'd-M-y';
                    $this->dateTimeFormat = 'd-M-y H:i';
                    $this->dateTimeFullFormat = 'd-M-y H:i:s';
                }
            }
        }
    }

	public function index()
    {
        $this->isLoggedIn();
    }
    
    function isLoggedIn()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        $unlocked = $this->session->userdata('unlocked');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            $this->load->view('login');
        }
        else
        {
            if($unlocked == 'yes'){
                if($this->companyEmail == 'dra.gov.pk' && $this->roleId <> 1){
                    redirect('dashboardSuper');
                }
                else{
                    redirect('dashboard');
                }
            }
            if($unlocked == 'no'){
                $this->lockscreen();
            }
        }
    }

    function isLoggedIn1()
    {
        $email = $this->session->userdata('userEmail');
        $password = $this->session->userdata('plainPassword');
        
        $result = $this->loginModel->loginMe1($email, $password);
        
        if(count($result) > 0)
        {
            foreach ($result as $res)
            {
                $this->userId = $res->id;
                $this->userEmail = $res->email;
                $this->userName = $res->userName;
                $this->profilepic = $res->profilepic;
                $this->startDate = $res->startDate;
                $this->endDate = $res->endDate;
                $this->resumeDate = $res->resumeDate;
                $this->countryId = $res->countryId;
                $this->countryName = $res->countryName;
                $this->countryFlag = $res->countryFlag;
                $this->wallpaper = $res->wallpaper;
                $this->status = $res->status;
                $this->userUniqueNo = $res->userUniqueNo;
                $this->companyId = $res->companyId;
                $this->companyUniqueNo = $res->companyUniqueNo;
                $this->roleId = $res->roleId;
                $this->department = $res->department;
                $this->designation = $res->designation;
                $this->companyName = 'DRAP';
                $this->companyNick = 'DRAP';
                $this->companyCategory = $res->companyCategory;
                $this->companySubCategory = $res->companySubCategory;
                $this->companyUserType = $res->companyUserType;
                $this->companyAddress = 'Drug Regulatory Authority Of Pakistan';
                $this->companyProject = 'PIRIMS';
                $this->companyEmail = $res->companyEmail;
                $this->companyStatus = $res->companyStatus;
                $this->companyTheme = 'navbar-dark';
                $this->dateFormat = 'd-M-y';
                $this->dateTimeFormat = 'd-M-y H:i';
                $this->dateTimeFullFormat = 'd-M-y H:i:s';
            }
        }

		$isLoggedIn = $this->session->userdata('isLoggedIn');
        $unlocked = $this->session->userdata('unlocked');
		
		if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
		{
			redirect('login');
		}
        if($unlocked == 'no' && $this->companyStatus == 'Active')
        {
            redirect('loginMe');
        }
        if($this->companyStatus == 'Inactive')
        {
            redirect('accessDeniedMain');
        }
	}

    function lockMe()
    {
        $unlocked = $this->session->userdata('unlocked');
        
        if($unlocked == 'yes')
        {
            $this->session->set_userdata(array('unlocked' => 'no'));
            $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'lockTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
        }
        redirect('loginMe');
    }

    function unlockMe()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $result = '';
        if(verifyHashedPassword($password, $this->session->userdata('password'))){
            $result = TRUE;
        }
        if($result == TRUE && $email == $this->session->userdata('userEmail')){
        $this->session->set_userdata(array('unlocked' => 'yes', 'welcomeMessageSound' => FALSE));
        $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'unlockTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
        }
        redirect('login');
    }

	public function loginMe()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!(!isset($isLoggedIn) || $isLoggedIn != TRUE))
        {
            $this->index();
        }
        else
        {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            if (!strpos($email, '@dra.gov.pk')) {
				
				//Authenticate Company
				$this->load->model("AuthCompanyModel");
				$response = $this->AuthCompanyModel->companyLogin($email,$password);
				if(isset($response->success) && $response->success == 1){
					$data = $response->data;
					$this->dateTimeFormat = 'd-M-y H:i';
					$createddate = date($this->dateTimeFormat);

                    if($data->account->IssuedLicense == "Drug Sale License"){
                        $licensetype = "Importer";
                    }else{
                        $licensetype = "Manufacturer";
                    }
					//check company already exists
					$companyresult = $this->loginModel->checkCompanyExists($data->account->AccountId);
					if(count($companyresult) === 0){
						//insert company record
						$companyId = $this->loginModel->recordAjaxSave(['companyUniqueNo' => $data->account->AccountId,'companySubCategory'=>$licensetype,'dslNo' =>$data->account->LicenseNumber, 'companyName' => $data->account->AccountTitle, 'email' => $data->user->Email, 'companyAddress' => $data->account->Address,'contactPersonName' => $data->user->Name, 'contactPersonPhone' => $data->user->ContactNumber, 'contactPersonEmail' => $data->user->Email, 'countryId' => 167, 'status' => 'Active', 'createddate' => $createddate],'tbls_company');
                        $this->myModel->recordAjaxSave911(['companyUniqueNo' => $data->account->AccountId,'companySubCategory'=>$licensetype,'dslNo' =>$data->account->LicenseNumber, 'companyName' => $data->account->AccountTitle, 'email' => $data->user->Email, 'companyAddress' => $data->account->Address,'contactPersonName' => $data->user->Name, 'contactPersonPhone' => $data->user->ContactNumber, 'contactPersonEmail' => $data->user->Email, 'countryId' => 167, 'status' => 'Active', 'createddate' => $createddate],'tbls_company');

                    }else{
						//update company record	
						$companyId = $companyresult[0]->id;
						$this->loginModel->recordAjaxUpdate('id',$companyId,['companyUniqueNo' => $data->account->AccountId,'companyName' => $data->account->AccountTitle,'companySubCategory'=>$licensetype,'dslNo' =>$data->account->LicenseNumber, 'email' => $data->user->Email, 'companyAddress' => $data->account->Address,'contactPersonName' => $data->user->Name, 'contactPersonPhone' => $data->user->ContactNumber, 'contactPersonEmail' => $data->user->Email, 'updateddate' => $createddate],'tbls_company');
                        $this->myModel->recordAjaxUpdate911('id',$companyId,['companyUniqueNo' => $data->account->AccountId,'companyName' => $data->account->AccountTitle,'companySubCategory'=>$licensetype,'dslNo' =>$data->account->LicenseNumber, 'email' => $data->user->Email, 'companyAddress' => $data->account->Address,'contactPersonName' => $data->user->Name, 'contactPersonPhone' => $data->user->ContactNumber, 'contactPersonEmail' => $data->user->Email, 'updateddate' => $createddate],'tbls_company');

					}
					
					//check user already exsists 
					$userresult = $this->loginModel->checkEmailExists($data->user->Email);
					if(count($userresult) === 0){
						//insert user record
						$userId = $this->loginModel->recordAjaxSave([ 'email' => $data->user->Email,'password'=>getHashedPassword($password),'userName'=>$data->user->Name, 'phone'=>$data->user->ContactNumber,'roleId'=>26,'companyId'=>$companyId,'profilepic'=>'avatar5.png','wallpaper'=>'wp1.jpg', 'status' => 'Active', 'createddate' => $createddate],'tbls_user');
					}else{
						//update user record	
						$userId = $userresult[0]->id;
						$this->loginModel->recordAjaxUpdate('id',$userId,[ 'email' => $data->user->Email,'password'=>getHashedPassword($password),'userName'=>$data->user->Name, 'phone'=>$data->user->ContactNumber,'companyId'=>$companyId, 'updateddate' => $createddate],'tbls_user');
					}
					if(!is_dir('uploads/company/'.$data->account->AccountId)){
						mkdir('uploads/company/'.$data->account->AccountId,0777,TRUE);
							mkdir('uploads/company/'.$data->account->AccountId.'/docs',0777,TRUE);
                    }


					
					//Get User
					$result = $this->loginModel->getUser($userId);
					foreach ($result as $res)
					{
						$sessionArray = array('userId'=>$res->id,
												'userEmail'=>$res->email,
												'userName'=>$res->userName,
												'token'=>$data->auth->token,
												'authorizationType'=>$data->auth->authorizationType,
												'password'=>$res->password,
												'plainPassword'=>$password,
												'companyName'=>$res->companyName,
												'match'=>isset($companyresult) ? $companyresult[0]->companyName : null,
												'isLoggedIn' => TRUE,
												'welcomeMessageSound'=> FALSE,
												'unlocked'=> 'yes'
										);
										
						$this->session->set_userdata($sessionArray);
						$this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 1));
						$this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'loginTime' => date('d-M-y H:i:s'), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
												
						sleep(1);
						redirect('dashboard');
					}
			
				}
                else if(isset($response->success) && $response->success == 0){
                    $this->session->set_flashdata('error', 'Email or password mismatch');
                    $this->load->view('login');
                    return;
                }
                else{
					$this->session->set_flashdata('error', 'Something went wrong!');
					$this->load->view('login');
					return;
				}
				
			}
            
			
			$this->session->set_userdata(['myEmail'=>$email, 'myPassword'=>$password]);

            $result = $this->loginModel->checkEmailExists($email);
            if(count($result) === 0){
                $this->session->set_flashdata('error', 'Account associated with this email does not appear to be registered here.');
                //redirect();
                //redirect('login');
                //echo "<script>alert('Account associated with this email does not appear to be registered here.');</script>";
                $this->load->view('login');
                return;
            }
            if(count($result) > 0 && $result[0]->status == 'Inactive'){
                $this->session->set_flashdata('error', 'Your account is temporarily Inactive. Please Contact Admin for assistance.');
                //redirect();
                //redirect('login');
                //echo "<script>alert('Your account is temporarily Inactive. Please Contact Admin for assistance.');</script>";
                $this->load->view('login');
                return;
            }
            
            $result = $this->loginModel->loginMe($email, $password);
            
            if(count($result) > 0)
            {
                foreach ($result as $res)
                {
                    $sessionArray = array('userId'=>$res->id,
                                            'userEmail'=>$res->email,
                                            'userName'=>$res->userName,
                                            'password'=>$res->password,
                                            'plainPassword'=>$password,
                                            'companyName'=>$res->companyName,
                                            'isLoggedIn' => TRUE,
                                            'welcomeMessageSound'=> FALSE,
                                            'unlocked'=> 'yes'
                                    );
                                    
                    $this->session->set_userdata($sessionArray);
                    $this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 1));
                    $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'loginTime' => date('d-M-y H:i:s'), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);

                    sleep(1);
                    //if($res->companyEmail == 'dra.gov.pk' && $res->id <> 1 && $res->roleId <> 35){
                    if($res->companyEmail == 'dra.gov.pk' && $res->roleId <> 1 && $res->roleId <> 26){
                        redirect('dashboardSuper');
                    }
                    else{
                        redirect('dashboard');
                    }
                }
            }
            else
            {
                $this->session->set_flashdata('error', 'Email or password mismatch');
                //redirect();
                //redirect('login');
                //echo "<script>alert('Email or password mismatch');</script>";
                $this->load->view('login');
            }
        }
    }

    function logout()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE)
        {
            redirect('login');
        }
        
        $unlocked = $this->session->userdata('unlocked');
        
        if($unlocked == 'no')
        {
            redirect();
        }
        if($unlocked == 'yes')
        {
            $this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 0));
            $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'logoutTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
            $this->session->sess_destroy();
            sleep(1);
            redirect('login');
        }
    }

    public function forgotPassword()
    {
        $this->load->view('forgotPassword');
    }

    public function register()
    {
        $data['country'] = $this->loginModel->countryGet();
        $data['city'] = $this->loginModel->cityGet();

        $this->load->view('register', $data);
    }

    public function registerCaptcha()
    {
        $this->load->view('phptextClass');
    }

    function registerMe()
    {       
        $data = $this->input->post();
        if(!$data){
            redirect('register');
        }

        $this->dateTimeFormat = 'd-M-y H:i';
        $data['createddate'] = date($this->dateTimeFormat);

        if($data['companyName'] <> 'DRAP'){
            $this->db->select('BaseTbl.id, BaseTbl.companyName');
            $this->db->from('tbls_company as BaseTbl');
            $this->db->where('BaseTbl.companyName', $data['companyName']);
            $this->db->where('BaseTbl.isDeleted', 0);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count > 0){
                $this->session->set_userdata(["msg"=>"<span style='color:red'>Company already exists!</span>"]);
                redirect('register');
            }
            $this->db->select('BaseTbl.id, BaseTbl.email');
            $this->db->from('tbls_company as BaseTbl');
            $this->db->where('BaseTbl.email', $data['email']);
            $this->db->where('BaseTbl.isDeleted', 0);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count > 0){
                $this->session->set_userdata(["msg"=>"<span style='color:red'>Email aleady exists in Company Module!</span>"]);
                redirect('register');
            }
            $this->db->select('BaseTbl.id, BaseTbl.email');
            $this->db->from('tbls_user as BaseTbl');
            $this->db->where('BaseTbl.email', $data['email']);
            $this->db->where('BaseTbl.isDeleted', 0);
            $query = $this->db->get();
            $count = $query->num_rows();
            if($count > 0){
                $this->session->set_userdata(["msg"=>"<span style='color:red'>Email aleady exists in User Module!</span>"]);
                redirect('register');
            }
            if($_SESSION['captcha_code'] <> $data['captcha_code']){
                $this->session->set_userdata(["msg"=>"<span style='color:red'>The Validation code does not match!</span>"]);
                redirect('register');
            }
            else{
                $this->session->set_userdata(["msg"=>"<span style='color:green'>The Validation code has been matched.</span>"]);
            }

            $companyUniqueNo = $this->generateRandomString(16);
            if($data['companySubCategory'] == 'Manufacturer'){
                $result = $this->loginModel->registerMe(array('companyUniqueNo' => $companyUniqueNo, 'companyCategory' => $data['companyCategory'], 'companySubCategory' => $data['companySubCategory'], 'companyUserType' => 'New Applicant', 'companyName' => $data['companyName'], 'email' => $data['email'], 'companyAddress' => $data['companyAddress'], 'companyNTN' => $data['companyNTN'], 'dslNo' => $data['dslNo'], 'companyNTNAttachment' => $data['companyNTNAttachment'], 'contactPersonName' => $data['contactPersonName'], 'contactPersonPhone' => $data['contactPersonPhone'], 'contactPersonDesignation' => $data['contactPersonDesignation'], 'contactPersonEmail' => $data['contactPersonEmail'], 'companyType' => $data['companyType'], 'website' => $data['website'], 'phone' => $data['phone'], 'googleMapURL' => $data['googleMapURL'], 'stateId' => $data['stateId'], 'countryId' => 167, 'status' => 'Pending', 'createddate' => $data['createddate']));
            }
            if($data['companySubCategory'] == 'Importer'){
                $result = $this->loginModel->registerMe(array('companyUniqueNo' => $companyUniqueNo, 'companyCategory' => $data['companyCategory'], 'companySubCategory' => $data['companySubCategory'], 'companyUserType' => 'New Applicant', 'companyName' => $data['companyName'], 'email' => $data['email'], 'companyAddress' => $data['companyAddress'], 'companyNTN' => $data['companyNTN'], 'dslNo' => $data['dslNo'], 'companyNTNAttachment' => $data['companyNTNAttachment'], 'dslAttachment' => $data['dslAttachment'], 'godownAddress' => $data['godownAddress'], 'dslAddress' => $data['dslAddress'], 'dslIssuingAuthority' => $data['dslIssuingAuthority'], 'cityId' => $data['cityId'], 'dslValidityDate' => $data['dslValidityDate'], 'contactPersonName' => $data['contactPersonName'], 'contactPersonPhone' => $data['contactPersonPhone'], 'contactPersonDesignation' => $data['contactPersonDesignation'], 'contactPersonEmail' => $data['contactPersonEmail'], 'companyType' => $data['companyType'], 'website' => $data['website'], 'phone' => $data['phone'], 'googleMapURL' => $data['googleMapURL'], 'stateId' => $data['stateId'], 'countryId' => 167, 'status' => 'Pending', 'createddate' => $data['createddate']));
            }

            // for data import purpose only START
            $this->db->select('BaseTbl.*');
            $this->db->from('tbls_company as BaseTbl');
            $this->db->where('BaseTbl.id', $result);
            $query = $this->db->get();
            foreach ($query->result() as $row){
                $id = $row->id;
                $companyName = $row->companyName;
                $companyUniqueNo = $row->companyUniqueNo;
                $status = $row->status;
                $result911 = $this->myModel->recordAjaxSave911(['companyName' => $companyName, 'companyUniqueNo' => $companyUniqueNo, 'status' => $status, 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_company');
            }
            // for data import purpose only END

            if(isset($data['email'])){
                $mailData['from'] = 'DRAP';
                $mailData['subject'] = 'PIRIMS | Account Registration';
                $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                $mailData['message'] = "Your account registeration request has been submitted at Management Information Services (MIS) Division. Autorized officer will check your credentials for the activation of your account. We will verify you with an email soon. In case of any query please write us at: support.pirims@dra.gov.pk";
                $mailData['email'] = $data['email'];
                $sendStatus = mailSend($mailData);
                if($sendStatus == true){
                    $result = 1;
                }
            }
            if(!isset($data['email'])){
                $result = 0;
            }
        
            if(!is_dir('uploads/company/'.$companyUniqueNo)){
                mkdir('uploads/company/'.$companyUniqueNo,0777,TRUE);
                    mkdir('uploads/company/'.$companyUniqueNo.'/docs',0777,TRUE);
            }

            $fileName = 'companyNTNAttachment';
            if(@$_FILES[$fileName]['tmp_name']){
                $data[$fileName] = $this->fileMove('Attachment', $fileName, $companyUniqueNo, 'docs');
            }
            $fileName = 'dslAttachment';
            if(@$_FILES[$fileName]['tmp_name']){
                $data[$fileName] = $this->fileMove('Attachment', $fileName, $companyUniqueNo, 'docs');
            }
        }

        if($result > 0){
            $this->session->set_flashdata('success', 'Account registeration request submitted. We will verify you with an email soon.');
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong.');
        }
        redirect('register');
    }

    function resetPassword()
    {

        $data = $this->input->post();
        if(!$data){
            $this->accessDenied();
            return;
        }

        if($_SESSION['captcha_code'] <> $data['captcha_code']){
            $this->session->set_userdata(["msg"=>"<span style='color:red'>The Validation code does not match!</span>"]);
            redirect('forgotPassword');
        }
        else{
            $this->session->set_userdata(["msg"=>"<span style='color:green'>The Validation code has been matched.</span>"]);
        }
        if (!strpos($data['email'], '@dra.gov.pk')) {
            redirect('https://fee.dra.gov.pk/forgot-password', 'refresh');
        }


        $this->db->select('BaseTbl.id, BaseTbl.email, BaseTbl.userName');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.email', $data['email']);
        $query = $this->db->get();
        foreach ($query->result() as $row){
            $id = $row->id;
            $email = $row->email;
            $userName = $row->userName;
        }
		$result = 0;
        if(isset($email)){
            $token = $this->generateRandomString(64);
            $token .= "_".$id;

            $mailData['from'] = 'DRAP';
            $mailData['subject'] = 'PIRIMS | Account Reset Password Confirmation';
            $mailData['title'] = 'Greetings, '.$userName.'!';
            $mailData['message'] = "Are you trying to Reset your PIRIMS Account Password?\r\nPlease click the following link to confirm Reset Password.\r\n<a href='".base_url()."generatePassword/".$token."'>".$token."</a>";
            $mailData['email'] = $email;
            $sendStatus = emailSend($mailData);
            if($sendStatus == true){

                $result_token = $this->loginModel->createPasswordToken($id, $token);

                $_SESSION['email_token'] = $token;
                $_SESSION['email_email'] = $email;
                $result = 1;
            }

        }
        if(!isset($email)){
            $result = 0;
        }

        if($result > 0){
            $this->session->set_flashdata('success', 'Reset Password Confirmation Email has been sent. Please check your Email.');
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong.');
        }
        
        redirect('login');
    }

    function generatePassword($token)
    {
        $data = $this->input->post();
        $tokenstring = (explode("_",$token));
        $userid = $tokenstring[1];



        $verify_token = $this->loginModel->verifyPasswordToken($userid, $token);

        /*if(isset($_SESSION['email_token'])){
            if($_SESSION['email_token'] <> $token){
                $this->session->set_flashdata('error', 'Invalid Token.');
                redirect('login');
            }
        }
        else{
            $this->session->set_flashdata('error', 'Token Not Set.');
            redirect('login');
        }*/
        if($verify_token < 1){
            $this->session->set_flashdata('error', 'Something went wrong');
            redirect('login');
        }

        $this->db->select('BaseTbl.id, BaseTbl.email, BaseTbl.userName');
        $this->db->from('tbls_user as BaseTbl');
        $this->db->where('BaseTbl.id', $userid);
        $query = $this->db->get();
        foreach ($query->result() as $row){
            $id = $row->id;
            $email = $row->email;
            $userName = $row->userName;
        }

        if(isset($email)){
            $this->userId = $id;
            $this->dateFormat = 'd-M-y';
            $this->dateTimeFormat = 'd-M-y H:i';
            $this->dateTimeFullFormat = 'd-M-y H:i:s';
            $data['updatedby'] = $id;
            $data['updateddate'] = date($this->dateTimeFormat);

            $password = $this->generateRandomString(5);
            $hashedPassword = getHashedPassword($password);
            $result = $this->loginModel->recordAjaxUpdate('id', $id, ['password' => $hashedPassword, 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate']], 'tbls_user');

            $mailData['from'] = 'DRAP';
            $mailData['subject'] = 'PIRIMS | Account Reset Password Information';
            $mailData['title'] = 'Greetings, '.$userName.'!';
            $mailData['message'] = "Please use the following new generated password to Sign In to your PIRIMS Account.\r\nPassword: ".$password."\r\nYou can change it anytime!";
            $mailData['email'] = $email;
            $sendStatus = emailSend($mailData);
            if($sendStatus == true){
                $this->loginModel->createPasswordToken($id, NULL);
                $result = 1;
            }
        }
        if(!isset($email)){
            $result = 0;
        }
        $this->session->unset_userdata('email_token');
        $this->session->unset_userdata('email_email');

        if($result > 0){
            $this->session->set_flashdata('success', 'Reset Password Information Email has been sent. Please check your Email.');
        }
        else{
            $this->session->set_flashdata('error', 'Something went wrong.');
        }
        
        redirect('login');
    }

	function loadViews($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {
        $this->load->view('includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

    function loadViewsSuper($viewName = "", $headerInfo = NULL, $pageInfo = NULL, $footerInfo = NULL)
    {
        $this->load->view('includes/headerSuper', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] =  'PIRIMS | 404 - Page Not Found';
        
        $this->load->view("errors/404", $this->global, NULL, NULL);
    }

    function accessDenied()
    {
        $this->global ['pageTitle'] = $this->companyNick.' | Access Denied';

        $this->loadViews("errors/access", $this->global, NULL, NULL);
    }

    function accessDeniedMain()
    {
        if($this->companyStatus == 'Inactive')
        {
            $this->global ['pageTitle'] = $this->companyNick.' | Access Denied';

            $this->load->view('errors/accessMain', $this->global);
            $this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 0));
            $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'logoutTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
            $this->session->sess_destroy();
        }
        else
        {
            redirect('login');
        }
    }

    function lockscreen()
    {
        $this->global ['pageTitle'] = $this->companyNick.' | Lockscreen';

        $this->load->view('lockscreen', $this->global);
    }

    //################## AJAX FUNCTIONS ##################
    function pageAjaxGet()
    {
        $functionName = __FUNCTION__;

        echo $this->loginModel->$functionName('', '');
    }

    function alertAjaxGet()
    {
        echo $this->loginModel->alertAjaxGet();
    }

    function reportTypeDetailAjaxGet()
    {
        if($this->input->post('reportType'))
        {
            $reportType = $this->input->post('reportType');
            echo $this->loginModel->reportTypeDetailAjaxGet($reportType);
        }
    }

    function systemUpdate()
    {
        if($this->input->post('system') == 'Active')
        {
            $this->loginModel->recordAjaxUpdate('id', '1', ['status' => 'Active', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)], 'tbls_system');
            $this->loginModel->recordAjaxUpdate('id', '2', ['status' => 'Inactive', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)], 'tbls_system');
        }
        if($this->input->post('system') == 'Maintenance')
        {
            $this->loginModel->recordAjaxUpdate('id', '1', ['status' => 'Inactive', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)], 'tbls_system');
            $this->loginModel->recordAjaxUpdate('id', '2', ['status' => 'Active', 'updatedby' => $this->userId, 'updateddate' => date($this->dateTimeFormat)], 'tbls_system');
        }
    }

    //################## AJAX FUNCTIONS ##################

    //################## MAIN FUNCTIONS ##################

    function generateRandomString($length)
    {
        $characters = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function fileMove($label, $fileName, $path, $folder)
    {
        $file = $label.'_'.rand(0,999999);
        $path = 'uploads/company/'.$path.'/'.$folder.'/';
        $imgtmpname = $_FILES[$fileName]['tmp_name'];
        $name = $_FILES[$fileName]['name'];
        $extention = explode('.', $name);
        $ext = end($extention);
        $fullpath = $path.$file.'.'.$ext;
        $filepath = $file.'.'.$ext;
        $allowedFileTypes = array('image/jpeg', 'image/png', 'application/pdf');
        if($_FILES[$fileName]['size'] <= 5000000){
            if(in_array($_FILES[$fileName]['type'], $allowedFileTypes)){
                move_uploaded_file($imgtmpname,$fullpath);
                if($ext <> ''){
                    return $filepath;
                }
            }
        }
    }

    function fileMoveMultiple($label, $fileName, $index, $path, $folder)
    {

        $file = $label.'_'.rand(0,999999);
        $path = 'uploads/company/'.$path.'/'.$folder.'/';
        $imgtmpname = $_FILES[$fileName]['tmp_name'][$index];
        $name = $_FILES[$fileName]['name'][$index];
        $extention = explode('.', $name);
        $ext = end($extention);
        $fullpath = $path.$file.'.'.$ext;
        $filepath = $file.'.'.$ext;
        $allowedFileTypes = array('image/jpeg', 'image/png', 'application/pdf','video/mp4');
        if($_FILES[$fileName]['size'][$index] <= 5000000){
            if(in_array($_FILES[$fileName]['type'][$index], $allowedFileTypes)){
                move_uploaded_file($imgtmpname,$fullpath);
                if($ext <> ''){
                    return $filepath;
                }
            }
        }
    }

    function dataDetailTableSave($masterId, $datadetail, $tableDetail)
    {
        $idColumn = 'id';
        $keys = array_keys($datadetail);
        $rows = [];
        for($i = 0, $len = count($datadetail[$keys[0]]); $i < $len; $i++){
            $rows[$i] = [];
            foreach($keys as $key){
                //$rows[$i][$key] = $datadetail[$key][$i];
                $rows[$i][$key] = isset($datadetail[$key][$i]) ? $datadetail[$key][$i] : 'n/a';
            }
        }
        for($row = 0, $cnt = count($rows); $row < $cnt; $row++){
            $column_data = $rows[$row];
            $column_keys = array_keys($column_data);
            $id = $column_data[$idColumn];
            $id = trim($id);
            $queryCheck = $this->db->get_where($tableDetail, array($idColumn => $id, 'masterId' => $masterId));
            $count = $queryCheck->num_rows();
            if($count === 0){  
                foreach($column_keys as $key){
                    $datainsert[$key] = $column_data[$key];
                }
                if(@$_FILES[$key]['tmp_name']){
                    $datainsert[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
                $datainsert['createdby'] = $this->userId;
                $datainsert['createddate'] = date($this->dateTimeFormat);
                $datainsert['updateddate'] = date($this->dateTimeFormat);
                unset($datainsert['id']);
                $datainsert['masterId'] = $masterId;
                $resultdetail = $this->loginModel->recordAjaxSave($datainsert, $tableDetail);
            }
            if($count > 0){
                foreach($column_keys as $key){
                    $dataupdate[$key] = $column_data[$key];
                }
                if(@$_FILES[$key]['tmp_name']){
                    $datainsert[$key] = $this->fileMove('Attachment', $key, $this->companyUniqueNo, 'docs');
                }
                $dataupdate['updatedby'] = $this->userId;
                $dataupdate['updateddate'] = date($this->dateTimeFormat);
                unset($dataupdate['id']);
                $resultdetail = $this->loginModel->recordAjaxUpdate($idColumn, $id, $dataupdate, $tableDetail);
            }
        }
        unset($datadetail);
        unset($rows);
        unset($column_data);
        unset($column_keys);
        unset($datainsert);
        unset($dataupdate);

        return $resultdetail;
    }

    function structure()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $data['records'] = $this->loginModel->systemInfoGet();
        
        $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
    }

    function backupDB()
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

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
        //force_download('medrs.gz', $backup);

        redirect();
    }

    function permission($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_role';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);
        $data['recordsDetailPage'] = $this->loginModel->permissionDetailEdit($id, 'tbls_pagedetail');
        $data['role'] = $this->loginModel->roleGet();
        $data['page'] = $this->loginModel->pageGet();

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_role');
            // }

            // if($data['recordsEdit'][0]->inUseBy == 0){
            //     $this->loginModel->inUseUpdate($id, array('inUseBy' => $this->userId, 'inUseTime' => date($this->dateTimeFullFormat)), 'tbls_user');
            // }
            // else{
            //     $this->session->set_flashdata('error', 'Record is locked for editing.');
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_role');
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $tableName = 'tabledetailpage-';
            $datadetail['id'] = $data[$tableName.'id_detail'];
            $datadetail['masterId'] = $data[$tableName.'masterId_detail'];
            // $datadetail['isDeleted'] = $data[$tableName.'isDeleted_detail'];
            $datadetail['recordLookup'] = $data[$tableName.'recordLookup_detail'];
            $datadetail['recordAdd'] = $data[$tableName.'recordAdd_detail'];
            $datadetail['recordEdit'] = $data[$tableName.'recordEdit_detail'];
            $datadetail['recordView'] = $data[$tableName.'recordView_detail'];
            $datadetail['recordDelete'] = $data[$tableName.'recordDelete_detail'];
            $datadetail['recordSubmit'] = $data[$tableName.'recordSubmit_detail'];
            $idColumn = 'id';
            $table = 'tbls_pagedetail';
            $keys = array_keys($datadetail);
            $rows = [];
            for($i = 0, $len = count($datadetail[$keys[0]]); $i < $len; $i++){
                $rows[$i] = [];
                foreach($keys as $key){
                    $rows[$i][$key] = isset($datadetail[$key][$i]) ? $datadetail[$key][$i] : 'n/a';
                }
            }
            for($row = 0, $cnt = count($rows); $row < $cnt; $row++){
                $column_data = $rows[$row];
                $column_keys = array_keys($column_data);
                $id = $column_data[$idColumn];
                $id = trim($id);
                $queryCheck = $this->db->get_where($table, array($idColumn => $id, 'roleId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                $count = $queryCheck->num_rows();
                if($count === 0){  
                    foreach($column_keys as $key){
                        $datainsert[$key] = $column_data[$key];
                    }
                    $datainsert['createdby'] = $this->userId;
                    $datainsert['createddate'] = date($this->dateTimeFormat);
                    unset($datainsert['id']);
                    $datainsert['roleId'] = substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1);
                    $resultdetail = $this->loginModel->recordAjaxSave($datainsert, $table);
                }
                if($count > 0){
                    foreach($column_keys as $key){
                        $dataupdate[$key] = $column_data[$key];
                    }
                    $dataupdate['updatedby'] = $this->userId;
                    $dataupdate['updateddate'] = date($this->dateTimeFormat);
                    unset($dataupdate['id']);
                    $resultdetail = $this->loginModel->recordAjaxUpdate($idColumn, $id, $dataupdate, $table);
                }
            }
            unset($datadetail);
            unset($rows);
            unset($column_data);
            unset($column_keys);
            unset($datainsert);
            unset($dataupdate);

            if($result > 0 || $resultdetail > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/lookup');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function helpdesk($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_helpdesk');
            // }

            // if($data['recordsEdit'][0]->inUseBy == 0){
            //     $this->loginModel->inUseUpdate($id, array('inUseBy' => $this->userId, 'inUseTime' => date($this->dateTimeFullFormat)), 'tbls_helpdesk');
            // }
            // else{
            //     $this->session->set_flashdata('error', 'Record is locked for editing.');
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_helpdesk');
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $data = array('isDeleted'=>1, 'updateddate'=>date($this->dateTimeFormat), 'updatedby'=>$this->userId);

            if($this->roleId == 1){
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $fileName = 'attachment';
            if(@$_FILES[$fileName]['tmp_name']){
                $data[$fileName] = $this->fileMove('HelpDeskAttachment', $fileName, $this->companyName, 'helpdesk');
            }

            $result = $this->loginModel->recordAjaxSave(['dateTime' => $data['createddate'], 'userId' => $this->userId, 'moduleName' => $data['moduleName'], 'pageName' => $data['pageName'], 'fieldName' => $data['fieldName'], 'description' => $data['description'], 'stepsToReproduceError' => $data['stepsToReproduceError'], 'currentBehaviour' => $data['currentBehaviour'], 'idealScenario' => $data['idealScenario'], 'errorCode' => $data['errorCode'], 'attachment' => $data['attachment'], 'issueStatus' => 'Logged', 'status' => 'Active', 'createdby' => $data['createdby'], 'createddate' => $data['createddate']], $table);

            // ------------------- Send Alert Start -------------------
            $result = $this->loginModel->recordAjaxSave(['type' => 'User', 'alertName' => 'Greetings Admin, New Help Desk Question!', 'description' => 'Please check help desk module.', 'dateTime' => $data['createddate'], 'duration' => 'now', 'recepients' => '0, 1', 'status' => 'Active', 'createdby' => $data['createdby'], 'createddate' => $data['createddate']], 'tbls_alert');
            // ------------------- Send Alert End -------------------

            if($result > 0){
                $this->session->set_flashdata('success', 'New record saved successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            if($this->roleId == 1){
                $data['inUseBy'] = 0;
                $data['inUseTime'] = '';
                $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), ['issueStatus' => $data['issueStatus'], 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate'], 'inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime']], $table);
            }
            if($this->roleId <> 1){
                $this->db->select('BaseTbl.id, BaseTbl.issueStatus');
                $this->db->from('tbls_helpdesk as BaseTbl');
                $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                $query = $this->db->get();
                $count = $query->num_rows();
                if($count === 0){
                    $this->session->set_flashdata('error', 'No record found.');
                }
                if($count > 0){
                    foreach ($query->result() as $row){
                        $id = $row->id;
                        $issueStatus = $row->issueStatus;
                    }
                    if($issueStatus <> 'Fixed'){
                        $data['clientStatus'] = '';
                    }
                }

                $data['inUseBy'] = 0;
                $data['inUseTime'] = '';
                $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), ['clientStatus' => $data['clientStatus'], 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate'], 'inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime']], $table);
            }
            //$this->session->unset_userdata('recordId');

            if($result > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/lookup');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function setting($action = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        if($action == 'lookup' && $recordLookup == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $result = $this->loginModel->recordAjaxUpdate('id', $this->userId, ['updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate'], 'wallpaper' => $data['wallpaper']], 'tbls_user');

            if($result > 0){
                $this->session->set_flashdata('success', 'Settings updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/edit');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function profile($action = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn');
        if(!isset($isLoggedIn) || $isLoggedIn != TRUE){
            redirect('login');
        }
        $found=false;
        $rolePage = $this->loginModel->rolePageGet($this->roleId);
        if(!empty($rolePage)){
            foreach ($rolePage as $res){
                $pageName = $res->url;
                $recordLookup = $res->recordLookup;
                $recordAdd = $res->recordAdd;
                $recordEdit = $res->recordEdit;
                $recordView = $res->recordView;
                $recordDelete = $res->recordDelete;
                $recordSubmit = $res->recordSubmit;
                if(__FUNCTION__ == $pageName){
                    $found=true; break;
                }
            }
        }
        if($found == false){
            $this->accessDenied();
            return;
        }

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }
        // ignore permissions in the table
            if($this->roleId <> 26){
                $recordSubmit = 1;
                $recordEdit = 1;
            }
        //

        $table = 'tbls_user';
        $data['records'] = $this->loginModel->userEdit($this->userId, $table);

        if($action == 'lookup' && $recordLookup == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $passwordTyped = false;
            if($data['password'] == $data['cpassword']){

                $fileName = 'profilepic';
                if(@$_FILES[$fileName]['tmp_name']){
                    $data[$fileName] = $this->fileMove('User', $fileName, $this->companyName, 'profilepic');
                }

                if($data['password']){
                    if($data['oldpassword'] == $_SESSION['plainPassword']){
                        $data['password'] = getHashedPassword($data['password']);
                        unset($data['cpassword']);
                        $passwordTyped = true;
                        $result = $this->loginModel->recordAjaxUpdate('id', $this->userId, ['updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate'], 'userName' => $data['userName'], 'password' => $data['password'], 'profilepic' => $data['profilepic']], 'tbls_user');
                    }
                    else{
                        $result = 0;
                    }
                }
                else{
                    unset($data['password']);
                    unset($data['cpassword']);
                    $result = $this->loginModel->recordAjaxUpdate('id', $this->userId, ['updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate'], 'userName' => $data['userName'], 'profilepic' => $data['profilepic']], 'tbls_user');
                }
            }
            else{
                $result = 0;
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'Profile updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            if($passwordTyped == true){
                $this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 0));
                $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'logoutTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
                $this->session->sess_destroy();
                sleep(1);
                redirect('login');
            }
            else{
                redirect(__FUNCTION__.'/edit');
            }
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function user($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);
        $data['country'] = $this->loginModel->countryGet();
        $data['role'] = $this->loginModel->roleGet();
        $data['state'] = $this->loginModel->stateGet();
        $data['company'] = $this->loginModel->companyGet();


        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_user');
            // }

            // if($data['recordsEdit'][0]->inUseBy == 0){
            //     $this->loginModel->inUseUpdate($id, array('inUseBy' => $this->userId, 'inUseTime' => date($this->dateTimeFullFormat)), 'tbls_user');
            // }
            // else{
            //     $this->session->set_flashdata('error', 'Record is locked for editing.');
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_user');
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $data = array('isDeleted'=>1, 'updateddate'=>date($this->dateTimeFormat), 'updatedby'=>$this->userId);

            if($id <> 1){
                $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;
            //$data['email'] = $data['email'].'@'.$this->companyEmail;
            $data['wallpaper'] = 'wp1.jpg';
            if($data['password'] == $data['cpassword']){
                if($data['password']){
                    $data['password'] = getHashedPassword($data['password']);
                    unset($data['cpassword']);
                }
                else{
                    unset($data['password']);
                    unset($data['cpassword']);
                }

                $fileName = 'profilepic';
                $data[$fileName] = 'avatar5.png';
                if(@$_FILES[$fileName]['tmp_name']){
                    $data[$fileName] = $this->fileMove('User', $fileName, $this->companyName, 'profilepic');
                }

                $result = $this->loginModel->recordAjaxSave(['email' => $data['email'], 'password' => $data['password'], 'userName' => $data['userName'], 'roleId' => $data['roleId'], 'stateId' => $data['stateId'], 'companyId' => 1, 'countryId' => $data['countryId'], 'profilepic' => $data['profilepic'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate'], 'resumeDate' => $data['resumeDate'], 'phone' => $data['phone'], 'address' => $data['address'], 'remarks' => $data['remarks'], 'status' => $data['status'], 'wallpaper' => 'wp1.jpg', 'createdby' => $data['createdby'], 'createddate' => $data['createddate']], $table);
            }
            else{
                $result = 0;
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'New record saved successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            //$data['email'] = $data['email'].'@'.$this->companyEmail;
            $passwordTyped = false;
            if($data['password'] == $data['cpassword']){

                $fileName = 'profilepic';
                if(@$_FILES[$fileName]['tmp_name']){
                    $data[$fileName] = $this->fileMove('User', $fileName, $this->companyName, 'profilepic');
                }

                $data['inUseBy'] = 0;
                $data['inUseTime'] = '';

                if($data['password']){
                    $data['password'] = getHashedPassword($data['password']);
                    unset($data['cpassword']);
                    $passwordTyped = true;
                    $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), ['email' => $data['email'], 'password' => $data['password'], 'userName' => $data['userName'], 'roleId' => $data['roleId'], 'stateId' => $data['stateId'], 'countryId' => $data['countryId'], 'profilepic' => $data['profilepic'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate'], 'resumeDate' => $data['resumeDate'], 'phone' => $data['phone'], 'address' => $data['address'], 'remarks' => $data['remarks'], 'status' => $data['status'], 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate']], $table);
                }
                else{
                    unset($data['password']);
                    unset($data['cpassword']);
                    $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), ['email' => $data['email'], 'userName' => $data['userName'], 'roleId' => $data['roleId'], 'countryId' => $data['countryId'], 'stateId' => $data['stateId'], 'profilepic' => $data['profilepic'], 'startDate' => $data['startDate'], 'endDate' => $data['endDate'], 'resumeDate' => $data['resumeDate'], 'phone' => $data['phone'], 'address' => $data['address'], 'remarks' => $data['remarks'], 'status' => $data['status'], 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate']], $table);
                }
            }
            else{
                $result = 0;
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            if($passwordTyped == true && substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1) == $this->userId){
                $this->session->unset_userdata('recordId');
                $this->loginModel->onlineStatusUpdate($this->session->userdata('userId'), array('isOnline' => 0));
                $this->loginModel->auditLogSave(['userId' => $this->session->userdata('userId'), 'logoutTime' => date($this->dateTimeFullFormat), 'ipAddress'=>$_SERVER['REMOTE_ADDR']]);
                $this->session->sess_destroy();
                sleep(1);
                redirect('login');
            }
            else{
                redirect(__FUNCTION__.'/lookup');
            }
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function auditlog($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            $this->accessDenied();
            return;
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function alert($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);
        $data['user'] = $this->loginModel->userGet();

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_alert');
            // }

            // if($data['recordsEdit'][0]->inUseBy == 0){
            //     $this->loginModel->inUseUpdate($id, array('inUseBy' => $this->userId, 'inUseTime' => date($this->dateTimeFullFormat)), 'tbls_alert');
            // }
            // else{
            //     $this->session->set_flashdata('error', 'Record is locked for editing.');
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_alert');
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $data = array('isDeleted'=>1, 'updateddate'=>date($this->dateTimeFormat), 'updatedby'=>$this->userId);

            $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);

            if($result > 0){
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['dateTime'] = date($this->dateTimeFormat, strtotime($this->input->post('dateTime')));
            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $result = $this->loginModel->recordAjaxSave($data, $table);

            if($result > 0){
                $this->session->set_flashdata('success', 'New record saved successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $data['inUseBy'] = 0;
            $data['inUseTime'] = '';
            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);
            //$this->session->unset_userdata('recordId');

            if($result > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/lookup');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function alerts($action = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            // if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            // }
            // if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            // }
            // if($myAction == 'add'){
            //     $myAction = 'save';
            // }
            // if($myAction == 'edit'){
                $myAction = 'update';
            // }
        }

        $table = 'tbls_alert';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
		
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            $this->accessDenied();
            return;
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            $this->accessDenied();
            return;
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $data['inUseBy'] = 0;
            $data['inUseTime'] = '';
            $result = $this->loginModel->recordAjaxUpdate('id', $data['id'], ['isCompleted' => 1, 'status' => 'Inactive', 'inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime'], 'updatedby' => $data['updatedby'], 'updateddate' => $data['updateddate']], $table);

            if($result > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/lookup');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function inuserecord($action = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            // if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            // }
            // if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            // }
            // if($myAction == 'add'){
            //     $myAction = 'save';
            // }
            // if($myAction == 'edit'){
                $myAction = 'update';
            // }
        }

        $table = '';
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            $this->accessDenied();
            return;
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            $this->accessDenied();
            return;
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            // ALL RULES
            //$this->form_validation->set_rules('fieldName', 'Label', 'required | matches[otherFieldName] | differs[otherFieldName] | min_length[3] | max_length[3] | exact_length[8] | greater_than[8] | greater_than_equal_to[8] | less_than[8] | less_than_equal_to[8] | in_list[red,blue,green] | alpha | alpha_numeric | alpha_numeric_spaces | alpha_dash | numeric | integer | decimal | is_natural | is_natural_no_zero | valid_url | valid_email | valid_emails | valid_ip | valid_base64 | trim | xss_clean | text');
            // MAJOR USED RULES
            //$this->form_validation->set_rules('fieldName', 'Label', 'required | min_length[3] | max_length[3] | exact_length[8] | in_list[red,blue,green] | alpha | alpha_numeric | alpha_numeric_spaces | alpha_dash | numeric | integer | decimal | is_natural | is_natural_no_zero | valid_url | valid_email | valid_emails | valid_base64 | trim | xss_clean');
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }

            if($this->roleId == '1' && $data['release'] == 'Yes'){
                $data['inUseBy'] = 0;
                $data['inUseTime'] = '';
                if($data['type'] == 'License'){
                    $result = $this->loginModel->recordAjaxUpdate('id', $data['id'], ['inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime']], 'tbl_license');
                }
                if($data['type'] == 'Registration'){
                    $result = $this->loginModel->recordAjaxUpdate('id', $data['id'], ['inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime']], 'tbl_registration');
                }
                if($data['type'] == 'Inspection'){
                    $result = $this->loginModel->recordAjaxUpdate('id', $data['id'], ['inUseBy' => $data['inUseBy'], 'inUseTime' => $data['inUseTime']], 'tbl_inspection');
                }
            }

            if($result > 0){
                $this->session->set_flashdata('success', 'Record released successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/edit');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function userguide($action = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            // if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            // }
            // if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            // }
            // if($myAction == 'add'){
            //     $myAction = 'save';
            // }
            // if($myAction == 'edit'){
                $myAction = 'update';
            // }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'view' && $recordView == 1){
            $this->accessDenied();
            return;
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function registeredDrugSearch(){
        $data['companies'] = $this->myModel->companiesGet();
        $this->load->view('drugsearch',$data);
    }
    function registeredDrug($id){

        $data['drug'] = $this->loginModel->getDrugDetails($id);
        $data['manufacturers'] = $this->loginModel->getDrugManufacturer($id);
        $data['compositions'] = $this->loginModel->getDrugCompositions($id);
        if(!isset($data['drug'][0])){
            redirect('drugSearch');
        }
        $this->load->view('drugdetails',$data);
    }
    function drugSearch(){
        $data = $this->input->post();
        if(!$data){
            redirect('drugSearch');
        }
        $type = $data['searchby'];
        $searchstring = $data['searchstring'];
        if($type == 1){
            $data['drugs'] = $this->loginModel->filterDrugsRegNo($searchstring);
        }elseif($type == 2){
            $data['drugs'] = $this->loginModel->filterDrugsName($searchstring,true);
        }elseif($type == 3){
            $data['drugs'] = $this->loginModel->filterDrugsComposition($searchstring);
        }elseif($type == 4){
            $companyAccountId = $data['companyAccountId'];
            $data['drugs'] = $this->loginModel->filterDrugsCompany($companyAccountId);
        }
        $data['companies'] = $this->myModel->companiesGet();

        $this->load->view('drugsearch',$data);
        //$this->load->view('drugs',$data);
    }

    function company($action = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            }
            if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
                $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            }
            if($myAction == 'add'){
                $myAction = 'save';
            }
            if($myAction == 'edit'){
                $myAction = 'update';
            }
        }

        $table = 'tbls_'.__FUNCTION__;
        $searchText = $this->input->post('searchText');
        $data['searchText'] = $searchText;
        $data['records'] = $this->loginModel->$functionName($table, $searchText);
        $data['recordsEdit'] = $this->loginModel->$functionNameEdit($id, $table);
        $data['country'] = $this->loginModel->countryGet();
        $data['state'] = $this->loginModel->stateGet();
        $data['city'] = $this->loginModel->cityGet();

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'edit' && $recordEdit == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_alert');
            // }

            // if($data['recordsEdit'][0]->inUseBy == 0){
            //     $this->loginModel->inUseUpdate($id, array('inUseBy' => $this->userId, 'inUseTime' => date($this->dateTimeFullFormat)), 'tbls_alert');
            // }
            // else{
            //     $this->session->set_flashdata('error', 'Record is locked for editing.');
            //     redirect(substr(__FUNCTION__, 0, strcspn(__FUNCTION__, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'view' && $recordView == 1){
            if(!$id){
                $this->accessDenied();
                return;
            }
            //$this->session->set_userdata(array('recordId' =>$id));

            // $seenBy = explode(",",$data['recordsEdit'][0]->seenBy);
            // if(!(in_array($this->userId, $seenBy))){
            //     $this->loginModel->seenByUpdate($id, $this->userId, 'tbls_alert');
            // }
            
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'delete' && $recordDelete == 1){
            $data = array('isDeleted'=>1, 'updateddate'=>date($this->dateTimeFormat), 'updatedby'=>$this->userId);

            $result = $this->loginModel->recordAjaxUpdate('id', $id, $data, $table);

            if($result > 0){
                $this->session->set_flashdata('success', 'Record deleted successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['dateTime'] = date($this->dateTimeFormat, strtotime($this->input->post('dateTime')));
            $data['createdby'] = $this->userId;
            $data['createddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            $result = $this->loginModel->recordAjaxSave($data, $table);

            if($result > 0){
                $this->session->set_flashdata('success', 'New record saved successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }

            redirect(__FUNCTION__.'/lookup');
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $data = $this->input->post();
            if(!$data){
                $this->accessDenied();
                return;
            }
            // foreach ($data as $key => $value)
            // {
            //     if($key == 'remarks'){
            //         continue;
            //     }
            //     $this->form_validation->set_rules($key, ucwords(implode(' ', preg_split('/(?=[A-Z])/', $key))), ['required']);
            //     if($key == 'Something'){
            //         // Custom Rule
            //     }
            // }
            // if($this->form_validation->run() == FALSE){
            //     $this->session->set_flashdata('error', validation_errors());
            // }
            $data['updatedby'] = $this->userId;
            $data['updateddate'] = date($this->dateTimeFormat);
            $result = 0;
            $resultdetail = 0;

            if($data['status'] == 'Active'){
                if($data['companyCategory'] == 'Pharma Industry'){
                    $idColumn = 'companyId';
                    $table1 = 'tbls_user';
                    $queryCheck = $this->db->get_where($table1, array($idColumn => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                    $count = $queryCheck->num_rows();
                    if($count === 0){
                        $userData['userName'] = 'Company User';
                        $userData['roleId'] = '26';
                        $userData['countryId'] = '167';
                        $userData['profilepic'] = 'avatar5.png';
                        $userData['status'] = 'Active';
                        $password = $this->generateRandomString(5);
                        $hashedPassword = getHashedPassword($password);
                        $result = $this->loginModel->recordAjaxSave(['email' => $data['email'], 'password' => $hashedPassword, 'userName' => $userData['userName'], 'roleId' => $userData['roleId'], 'countryId' => $userData['countryId'], 'stateId' => $data['stateId'], 'companyId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'profilepic' => $userData['profilepic'], 'status' => $userData['status'], 'wallpaper' => 'wp1.jpg', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_user');

                        $this->db->select('BaseTbl.mailAccountRegistration');
                        $this->db->from('tbls_company as BaseTbl');
                        $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $query = $this->db->get();
                        foreach ($query->result() as $row){
                            $mailAccountRegistration = $row->mailAccountRegistration;
                        }
                        if($mailAccountRegistration == '0'){
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | Account Information';
                            $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                            $mailData['message'] = "Your account has been provisoinally activated subject to the verification of your original documents. \r\n Please Sign In to your PIRIMS Account using this Email: ".$data['email']."\r\n and Password: ".$password.'<br>'."In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $data['email'];
                            $sendStatus = mailSend($mailData);
                            if($sendStatus == true){
                                $data['mailAccountRegistration'] = '1';
                            }
                        }
                    }
                    if($count > 0){
                        $result = 0;
                    }
                }
                if($data['companyCategory'] == 'Distributor'){
                    $idColumn = 'companyId';
                    $table1 = 'tbls_user';
                    $queryCheck = $this->db->get_where($table1, array($idColumn => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                    $count = $queryCheck->num_rows();
                    if($count === 0){
                        $userData['userName'] = 'Distributor User';
                        $userData['roleId'] = '48';
                        $userData['countryId'] = '167';
                        $userData['profilepic'] = 'avatar5.png';
                        $userData['status'] = 'Active';
                        $password = $this->generateRandomString(5);
                        $hashedPassword = getHashedPassword($password);
                        $result = $this->loginModel->recordAjaxSave(['email' => $data['email'], 'password' => $hashedPassword, 'userName' => $userData['userName'], 'roleId' => $userData['roleId'], 'countryId' => $userData['countryId'], 'stateId' => $data['stateId'], 'companyId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'profilepic' => $userData['profilepic'], 'status' => $userData['status'], 'wallpaper' => 'wp1.jpg', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_user');

                        $this->db->select('BaseTbl.mailAccountRegistration');
                        $this->db->from('tbls_company as BaseTbl');
                        $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $query = $this->db->get();
                        foreach ($query->result() as $row){
                            $mailAccountRegistration = $row->mailAccountRegistration;
                        }
                        if($mailAccountRegistration == '0'){
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | Account Information';
                            $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                            $mailData['message'] = "Your account has been provisoinally activated subject to the verification of your original documents. \r\n Please Sign In to your PIRIMS Account using this Email: ".$data['email']."\r\n and Password: ".$password.'<br>'."In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $data['email'];
                            $sendStatus = mailSend($mailData);
                            if($sendStatus == true){
                                $data['mailAccountRegistration'] = '1';
                            }
                        }
                    }
                    if($count > 0){
                        $result = 0;
                    }
                }
                if($data['companyCategory'] == 'Retailer'){
                    $idColumn = 'companyId';
                    $table1 = 'tbls_user';
                    $queryCheck = $this->db->get_where($table1, array($idColumn => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                    $count = $queryCheck->num_rows();
                    if($count === 0){
                        $userData['userName'] = 'Retailer User';
                        $userData['roleId'] = '49';
                        $userData['countryId'] = '167';
                        $userData['profilepic'] = 'avatar5.png';
                        $userData['status'] = 'Active';
                        $password = $this->generateRandomString(5);
                        $hashedPassword = getHashedPassword($password);
                        $result = $this->loginModel->recordAjaxSave(['email' => $data['email'], 'password' => $hashedPassword, 'userName' => $userData['userName'], 'roleId' => $userData['roleId'], 'countryId' => $userData['countryId'], 'stateId' => $data['stateId'], 'companyId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'profilepic' => $userData['profilepic'], 'status' => $userData['status'], 'wallpaper' => 'wp1.jpg', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_user');

                        $this->db->select('BaseTbl.mailAccountRegistration');
                        $this->db->from('tbls_company as BaseTbl');
                        $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $query = $this->db->get();
                        foreach ($query->result() as $row){
                            $mailAccountRegistration = $row->mailAccountRegistration;
                        }
                        if($mailAccountRegistration == '0'){
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | Account Information';
                            $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                            $mailData['message'] = "Your account has been provisoinally activated subject to the verification of your original documents. \r\n Please Sign In to your PIRIMS Account using this Email: ".$data['email']."\r\n and Password: ".$password.'<br>'."In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $data['email'];
                            $sendStatus = mailSend($mailData);
                            if($sendStatus == true){
                                $data['mailAccountRegistration'] = '1';
                            }
                        }
                    }
                    if($count > 0){
                        $result = 0;
                    }
                }
                if($data['companyCategory'] == 'Institution'){
                    $idColumn = 'companyId';
                    $table1 = 'tbls_user';
                    $queryCheck = $this->db->get_where($table1, array($idColumn => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                    $count = $queryCheck->num_rows();
                    if($count === 0){
                        $userData['userName'] = 'Institution User';
                        $userData['roleId'] = '50';
                        $userData['countryId'] = '167';
                        $userData['profilepic'] = 'avatar5.png';
                        $userData['status'] = 'Active';
                        $password = $this->generateRandomString(5);
                        $hashedPassword = getHashedPassword($password);
                        $result = $this->loginModel->recordAjaxSave(['email' => $data['email'], 'password' => $hashedPassword, 'userName' => $userData['userName'], 'roleId' => $userData['roleId'], 'countryId' => $userData['countryId'], 'stateId' => $data['stateId'], 'companyId' => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'profilepic' => $userData['profilepic'], 'status' => $userData['status'], 'wallpaper' => 'wp1.jpg', 'createdby' => $data['updatedby'], 'createddate' => $data['updateddate']], 'tbls_user');

                        $this->db->select('BaseTbl.mailAccountRegistration');
                        $this->db->from('tbls_company as BaseTbl');
                        $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $query = $this->db->get();
                        foreach ($query->result() as $row){
                            $mailAccountRegistration = $row->mailAccountRegistration;
                        }
                        if($mailAccountRegistration == '0'){
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | Account Information';
                            $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                            $mailData['message'] = "Your account has been provisoinally activated subject to the verification of your original documents. \r\n Please Sign In to your PIRIMS Account using this Email: ".$data['email']."\r\n and Password: ".$password.'<br>'."In case of any query please write us at: support.pirims@dra.gov.pk";
                            $mailData['email'] = $data['email'];
                            $sendStatus = mailSend($mailData);
                            if($sendStatus == true){
                                $data['mailAccountRegistration'] = '1';
                            }
                        }
                    }
                    if($count > 0){
                        $result = 0;
                    }
                }
            }
            if($data['status'] == 'Rejected'){
                $this->db->select('BaseTbl.status');
                $this->db->from('tbls_company as BaseTbl');
                $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                $query = $this->db->get();
                foreach ($query->result() as $row){
                    $status = $row->status;
                }
                if($status == 'Pending'){
                    $idColumn = 'companyId';
                    $table1 = 'tbls_user';
                    $queryCheck = $this->db->get_where($table1, array($idColumn => substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), 'isDeleted' => 0));
                    $count = $queryCheck->num_rows();
                    if($count === 0){
                        $result = 1;

                        $this->db->select('BaseTbl.mailAccountRejection');
                        $this->db->from('tbls_company as BaseTbl');
                        $this->db->where('BaseTbl.id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1));
                        $query = $this->db->get();
                        foreach ($query->result() as $row){
                            $mailAccountRejection = $row->mailAccountRejection;
                        }
                        if($mailAccountRejection == '0'){
                            $mailData['from'] = 'DRAP';
                            $mailData['subject'] = 'PIRIMS | Account Registration Rejected';
                            $mailData['title'] = 'Greetings, '.$data['companyName'].'!';
                            $mailData['message'] = "Your account has been rejected due to insufficient/wrong information. Therefore, register your company again with appropriate information please. In case of any query please feel free to contact us at support.pirims@dra.gov.pk";
                            $mailData['email'] = $data['email'];
                            $sendStatus = mailSend($mailData);
                            if($sendStatus == true){
                                $data['mailAccountRejection'] = '1';
                            }
                        }
                    }
                }

                if($count > 0){
                    $result = 0;
                }
                $data['isDeleted'] = 1;
            }

            $data['inUseBy'] = 0;
            $data['inUseTime'] = '';
            $result = $this->loginModel->recordAjaxUpdate('id', substr($_SERVER['HTTP_REFERER'], strrpos($_SERVER['HTTP_REFERER'], '/') + 1), $data, $table);
            //$this->session->unset_userdata('recordId');

            if($result > 0){
                $this->session->set_flashdata('success', 'Record updated successfully.');
            }
            else{
                $this->session->set_flashdata('error', 'Something went wrong.');
            }
            
            redirect(__FUNCTION__.'/lookup');
        }

        else{
            $this->accessDenied();
            return;
        }
    }

    function report($action = NULL, $reportType = NULL, $id = NULL)
    {
        $isLoggedIn = $this->session->userdata('isLoggedIn'); if(!isset($isLoggedIn) || $isLoggedIn != TRUE){redirect('login');} $found=false; $rolePage = $this->loginModel->rolePageGet($this->roleId); if(!empty($rolePage)){foreach ($rolePage as $res){$pageName = $res->url; $recordLookup = $res->recordLookup; $recordAdd = $res->recordAdd; $recordEdit = $res->recordEdit; $recordView = $res->recordView; $recordDelete = $res->recordDelete; $recordSubmit = $res->recordSubmit; if(__FUNCTION__ == $pageName){ $found=true; break;}}} if($found == false){$this->accessDenied(); return;}

        $functionName = __FUNCTION__;
        $functionNameEdit = __FUNCTION__.'Edit';

        $data['pageTitle'] = $this->loginModel->pageTitleGet(__FUNCTION__);
        $this->global['pageTitle'] = $this->companyProject.' | '.$data['pageTitle'][0]->friendlyName;

        $myAction = '';
        if($action == 'submit'){
            // if(explode('/', $_SERVER['HTTP_REFERER'])[4] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[5];
            // }
            // if(explode('/', $_SERVER['HTTP_REFERER'])[3] == __FUNCTION__){
            //     $myAction = explode('/', $_SERVER['HTTP_REFERER'])[4];
            // }
            // if($myAction == 'add'){
            //     $myAction = 'save';
            // }
            // if($myAction == 'edit'){
                $myAction = 'view';
            // }
        }
        else{
            $myAction = $action;
        }

        $data['reportType'] = $this->loginModel->reportTypeGet();

        if($action == 'lookup' && $recordLookup == 1){
            $this->loadViews(__FUNCTION__, $this->global, $data, NULL);
        }

        else if($action == 'add' && $recordAdd == 1){

            $this->accessDenied();
            return;
        }

        else if($action == 'edit' && $recordEdit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'view' && $recordView == 1){

            $parameters = array();
            $reportType = urldecode($reportType);
            if(!$reportType){
                $parameters = $this->input->post();
                if(!$parameters['reportType']){
                    redirect('report');
                }
                $reportType = $parameters['reportType'];

                // if($parameters['dateRange']){
                //     $myDate = explode(' - ', $parameters['dateRange']);
                //     $parameters['fromDate'] = $myDate[0];
                //     $parameters['toDate'] = $myDate[1];
                // }
            }

            $hasReportRights = 0;
            $this->db->select('BaseTbl.id', false);
            $this->db->from('tbls_reporttype as BaseTbl');
            $this->db->where('BaseTbl.isDeleted', 0);
            $this->db->where('BaseTbl.reportType', $reportType);
            $this->db->where('BaseTbl.department', $this->department);

            $query = $this->db->get();
            $count = $query->num_rows();

            if($count === 0){
                $this->session->set_flashdata('error', 'No record found.');
            }
            if($count > 0){
                $hasReportRights = 1;
            }

			
            require_once('./assets/dist/vendors/TCPDF-master/tcpdf.php');

            // create new PDF document
			//if($reportType == 'License Note Sheet' && $hasReportRights == 1){
				$this->load->library('Pdf');
				$pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//}else{
				//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			//}
            $pdf->isnotesheet = false;
            $pdf->footerText = 'This is Computer Generated Document. Errors and omissions excepted and it does not require any Manual Signature or Stamp.';

            // Set some content to print

            $html = '';
        if($reportType == 'All Users' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $_SESSION['reportType'] = $reportType;
            $html = '
            <h1 style="text-align:center;">All Users</h1>
            <div style="border-color:#fff;text-align:right;">
                FROM <b>'.$parameters['fromDate'].'</b> TO <b>'.$parameters['toDate'].'</b>
                <br>
            </div>
            <center>
            <table border="0" style="padding:3px;border:1px solid #000;">
            <tr>
              <th width="10%" style="text-align:left;">S.#</th>
              <th width="30%" style="text-align:left;">Name</th>
              <th width="20%" style="text-align:left;">Email</th>
              <th width="20%" style="text-align:left;">Phone</th>
              <th width="20%" style="text-align:left;">Created On</th>
            </tr><br>';
            $sn=1;
            if(!empty($data['records']))
            {
                foreach($data['records'] as $record)
                {
            $html .= '<tr>
              <td style="border-top:1px solid #000;">'.$sn.'</td>
              <td style="border-top:1px solid #000;">'.$record->userName.'</td>
              <td style="border-top:1px solid #000;">'.$record->email.'</td>
              <td style="border-top:1px solid #000;">'.$record->phone.'</td>
              <td style="border-top:1px solid #000;">'.(($record->dateTime <> '')? date("d-M-y H:i", strtotime(date("d-M-y H:i", strtotime($record->dateTime)))):"").'</td>
            </tr>';
            $sn++;
                }
            }
            $html .=  '</table>
            </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Department Wise Users' && $hasReportRights == 1)/* Done*/{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $_SESSION['reportType'] = $reportType;
            $html = '
            <h1 style="text-align:center;">Department Wise Users</h1>
            <div style="border-color:#fff;text-align:right;">
                Department <b>'.$parameters['headId'].'</b>
                <br>
            </div>
            <center>
            <table border="0" style="padding:3px;border:1px solid #000;">
            <tr>
              <th width="10%" style="text-align:left;">S.#</th>
              <th width="30%" style="text-align:left;">Name</th>
              <th width="20%" style="text-align:left;">Email</th>
              <th width="20%" style="text-align:left;">Phone</th>
              <th width="20%" style="text-align:left;">Department</th>
            </tr><br>';
            $sn=1;
            if(!empty($data['records']))
            {
                foreach($data['records'] as $record)
                {
            $html .= '<tr>
              <td style="border-top:1px solid #000;">'.$sn.'</td>
              <td style="border-top:1px solid #000;">'.$record->userName.'</td>
              <td style="border-top:1px solid #000;">'.$record->email.'</td>
              <td style="border-top:1px solid #000;">'.$record->phone.'</td>
              <td style="border-top:1px solid #000;">'.$record->headName.'</td>
            </tr>';
            $sn++;
                }
            }
            $html .=  '</table>
            </center>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Applicant License Certificate' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->barcode_no = $data['records'][0]->rniRefNo;
			
			// ------ Loading Settings 
			$pdf->setting($this->companyNick,$data);
			
			$pdf->SetFont('helvetica', '', 12, '', true);

            $pdf->SetXY(135, 35);
            $pdf->writeHTML('License No. <b>'.$data['records'][0]->licenseNoManual.'</b>', true, false, false, false, '');

            $pdf->SetY(60);
            $html = '
                
				<h1 class="mt-5" style="text-align:center;"><u>Certificate of License</u></h1>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>'.$data['records'][0]->companyName.'</b> is hereby licensed to manufacture <b>By Way of '.$data['records'][0]->licenseSubType.'</b> at the following premises:- <b>'.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b>.</td>
                </tr>
                <tr>
                  <td width="100%" style="text-align:left;">2. The license permits the manufacture of drugs under the Drug Act 1976.
                  <br><br>3. The License shall, in addition to the conditions specified in the rules made under the Drugs Act 1976, be subject to the following conditions, namely:-
                  <br><br>
                  <table border="0" style="padding:3px;">
                    <tr>
                      <td width="10%" style="text-align:left;">(i)</td>
                      <td width="90%" style="text-align:left;">This License will be in force for a period of five years from the date of issue unless earlier suspended / cancelled.</td>
                    </tr>
                    <tr>
                      <td width="10%" style="text-align:left;">(ii)</td>
                      <td width="90%" style="text-align:left;">This License authorises the sale by way of wholesale dealing and storage for sale by the license of the products manufactured under this license, subject to the conditions applicable to licenses for sale.</td>
                    </tr>
                    <tr>
                      <td width="10%" style="text-align:left;">(iii)</td>
                      <td width="90%" style="text-align:left;">Names of the approved expert staff.</td>
                    </tr>
                  </table>
                  </td>
                </tr>
                </table>
                </center>
                <br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;border:0px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nameProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->qualificationProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nicProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Production Incharge
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:0px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nameQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->qualificationQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nicQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Quality Control Incharge
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
                <br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Issue:- <b>'.(($data['records'][0]->issueDateManual)? date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->issueDateManual)))):"").'</b><br><br><br><br></p>
                <br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Secretary,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Central Licensing Board
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Chairman,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Central Licensing Board
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->AddPage();
            $reportType = 'Grant of License Panel of Inspector';
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

			//$pdf->setY(2);
            //$pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            // $siteAddress = explode(",",$data['records'][0]->siteAddress);
            // $siteCity = end($siteAddress);
            // $sliced = array_slice($siteAddress, 0, -1);
            /* $siteAddress = implode(",", $sliced);
            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            $pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            $pdf->SetY(1);
			*/




			$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>
            

            </center>
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>ISSUANCE OF DRUG MANUFACTURING LICENSE UNDER THE DRUGS ACT, 1976 & THE RULES FRAMED THEREUNDER.</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reference to your application for grant of Drug Manufacturing License By Way of <b>'.$data['records'][0]->licenseSubType.'.</b></p>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Central Licensing Board in its <b>'.@$this->loginModel->getMeetingInfo($id)[0]->meetingNo.'</b> meeting held on <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime(@$this->loginModel->getMeetingInfo($id)[0]->meetingDate)))).'</b> has considered and approved the grant of Drug Manufacturing License by way of '.$data['records'][0]->licenseSubType.' with following section / facility:-</p>
            <br><br>';
            if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Section</b></th>
                          <th width="30%" align="left"><b>Pharmacological Group</b></th>
                          <th width="30%" align="left"><b>Used For</b></th>
                        </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['sections'])) {
                    foreach ($data['recordsDetail']['sections'] as $record) {
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';
            }
            else {
                $html .= '
                            <center>
                                <ol>
                                <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                                <tr>
                                  <th width="5%" align="left"><b>S.#</b></th>
                                  <th width="95%" align="left"><b>API Name</b></th>
                                </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['api'])) {
                    foreach ($data['recordsDetail']['api'] as $record) {
                        $html .= '<tr>
                                  <td align="center">' . $sn . '</td>
                                  <td align="left">' . $record->apiName . '</td>
                                </tr>';
                        $sn++;
                    }
                }
                $html .= '
                                </table>
                                </ol>
                                </center>';
            }
            $html .= '
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accordingly, the Drug Manufacturing License No. <b>'.$data['records'][0]->licenseNoManual.'</b> is hereby issued w.e.f. <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->issueDateManual)))).'</b> subject to conditions that the provisions of rule 15, 16, 18, 19, 20 and provisions of Schedule B, B-I, B-IA, and B-III of the Drugs (Licensing, Registering & Advertising) Rules, 1976 shall be adhered to strictly. </p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enclosure: -     License to Manufacture on Form-2.</p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspection Book.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->licenseApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $reportType = 'Applicant License Certificate';
        }
        if($reportType == 'Renewal Applicant License Certificate' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->barcode_no = $data['records'][0]->rniRefNo;
			
			// ------ Loading Settings 
			$pdf->setting($this->companyNick,$data);
			
			$pdf->SetFont('helvetica', '', 12, '', true);
            //$pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));

            //$y_start = $pdf->GetY();
            //$pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=30, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='C');
            /*$pdf->SetY(9);

            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
			*/
            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');

            $pdf->SetXY(15, 40);
            $pdf->writeHTML('Form-2', true, false, false, false, '');

            $pdf->SetXY(155, 40);
            $pdf->writeHTML('License No. <b>'.$data['records'][0]->licenseNoManual.'</b>', true, false, false, false, '');

            $pdf->SetY(45);
            $html = '
                
                <br><br>
				<h1 style="text-align:center;"><u>Certificate of License Renewal</u></h1>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>'.$data['records'][0]->companyName.'</b> is hereby licensed to manufacture <b>By Way of '.$data['records'][0]->licenseSubType.'</b> at the following premises:- <b>'.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b>.</td>
                </tr>
                <tr>
                  <td width="100%" style="text-align:left;">2. The license permits the manufacture of drugs under the Drug Act 1976.
                  <br><br>3. The License shall, in addition to the conditions specified in the rules made under the Drugs Act 1976, be subject to the following conditions, namely:-
                  <br><br>
                  <table border="0" style="padding:3px;">
                    <tr>
                      <td width="10%" style="text-align:left;">(i)</td>
                      <td width="90%" style="text-align:left;">This License will be in force for a period of five years from the date of issue unless earlier suspended / cancelled.</td>
                    </tr>
                    <tr>
                      <td width="10%" style="text-align:left;">(ii)</td>
                      <td width="90%" style="text-align:left;">This License authorises the sale by way of wholesale dealing and storage for sale by the license of the products manufactured under this license, subject to the conditions applicable to licenses for sale.</td>
                    </tr>
                    <tr>
                      <td width="10%" style="text-align:left;">(iii)</td>
                      <td width="90%" style="text-align:left;">Names of the approved expert staff.</td>
                    </tr>
                  </table>
                  </td>
                </tr>
                </table>
                </center>
                <br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;border:0px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nameProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->qualificationProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nicProductionManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Production Incharge
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:0px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nameQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->qualificationQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$data['records'][0]->nicQCManager.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Quality Control Incharge
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
                <br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Renewal:- <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->renewalDateManual)))).'</b><br><br><br><br></p>
                <br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Secretary,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Central Licensing Board
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b></b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Chairman,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Central Licensing Board
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->AddPage();
            $reportType = 'Grant of License Panel of Inspector';
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
			$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
			
            /*$pdf->setY(2);
            $pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            // $siteAddress = explode(",",$data['records'][0]->siteAddress);
            // $siteCity = end($siteAddress);
            // $sliced = array_slice($siteAddress, 0, -1);
            // $siteAddress = implode(",", $sliced);
            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            $pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            $pdf->SetY(1);
			*/
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>ISSUANCE OF DRUG MANUFACTURING LICENSE UNDER THE DRUGS ACT, 1976 & THE RULES FRAMED THEREUNDER.</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reference to your application for grant of Drug Manufacturing License By Way of <b>'.$data['records'][0]->licenseSubType.'.</b></p>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Central Licensing Board in its <b>'.$data['records'][0]->meetingNo.'</b> meeting held on <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->meetingDate)))).'</b> has considered and approved the grant of Drug Manufacturing License by way of '.$data['records'][0]->licenseSubType.' with following section / facility:-</p>
            <br><br>';
            if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Section</b></th>
                          <th width="30%" align="left"><b>Pharmacological Group</b></th>
                          <th width="30%" align="left"><b>Used For</b></th>
                        </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['sections'])) {
                    foreach ($data['recordsDetail']['sections'] as $record) {
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';
            }
            else {
                $html .= '
                            <center>
                                <ol>
                                <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                                <tr>
                                  <th width="5%" align="left"><b>S.#</b></th>
                                  <th width="95%" align="left"><b>API Name</b></th>
                                </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['api'])) {
                    foreach ($data['recordsDetail']['api'] as $record) {
                        $html .= '<tr>
                                  <td align="center">' . $sn . '</td>
                                  <td align="left">' . $record->apiName . '</td>
                                </tr>';
                        $sn++;
                    }
                }
                $html .= '
                                </table>
                                </ol>
                                </center>';
            }
            $html .='
                        
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Accordingly, the Drug Manufacturing License No. <b>'.$data['records'][0]->licenseNoManual.'</b> is hereby issued w.e.f. <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->issueDateManual)))).'</b> subject to conditions that the provisions of rule 15, 16, 18, 19, 20 and provisions of Schedule B, B-I, B-IA, and B-III of the Drugs (Licensing, Registering & Advertising) Rules, 1976 shall be adhered to strictly. </p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enclosure: -     License to Manufacture on Form-2.</p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inspection Book.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->renewalApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $reportType = 'Renewal Applicant License Certificate';
        }
        if($reportType == 'Renewal Applicant Registration Certificate' && $hasReportRights == 1) /* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
			$pdf->licfileno = $data['records'][0]->regFileNo;

			// ------ Loading Settings 
			$pdf->setting('',$data);
			
			$pdf->SetFont('helvetica', '', 12, '', true);
            $html = '
                
                <center>
				<div style="line-height:80%;">
				<p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
				<p style="text-align:left; font-size:12px; width:100%;"><b>'.$data['records'][0]->companyName.'</b></p>
				<p style="text-align:left; font-size:12px; width:100%;"><b>'.$data['records'][0]->siteAddress.'</b></p>				
				</div>
				<br>

				</center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;">Subject: <b><u><span style="font-size:12px;">RENEWAL OF REGISTRATION OF DRUGS UNDER DRUGS ACT, 1976 AND RULES FRAMED THEREUNDER.</span></u></b><br></td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:left;">I am directed to refer to the subject cited above. Registration Board in its 292 nd meeting authorized its Chairman for disposal of renewal applications of registered drug products. Accordingly, renewal application(s) for below mentioned product(s) registered in your name were considered in the ___ meeting of Renewal Sub-Committee held on ___ and renewed as per following details:</td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px; border:1px solid #000;">
                <tr>
                    <td width="25%" style="text-align:left;">Registration No.</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->registrationNo.'</b></td>
                    <td width="25%" style="text-align:left;">Ref. No.</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->rniRefNo.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Brand Name</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->approvedName.'</b></td>
                    <td width="25%" style="text-align:left;">Shelf Life</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->shelfLife.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Dosage Form</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->dosageName.'</b></td>
                    <td width="25%" style="text-align:left;">Storage Condition</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->storageCondition.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Composition</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->labelClaim.'</b></td>
                    <td width="25%" style="text-align:left;">Used For</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->usedFor.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Route of Admin</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->routeOfAdmin.'</b></td>
                    <td width="25%" style="text-align:left;">Valid Till</td>
                    <td width="25%" style="text-align:left;"><b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->validTill)))).'</b></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="1" style="padding:3px;border:1px solid #000;">
                <tr>
                  <th width="5%" align="left">S.#</th>
                  <th width="55%" align="left">Pack Size</th>
                  <th width="40%" align="left">Approved Price (Rs.)</th>
                </tr>';
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
                $sn=1;
                if(!empty($data['recordsDetail']))
                {
                    foreach($data['recordsDetail'] as $record)
                    {
                $html .= '<tr>
                  <td align="center">'.$sn.'</td>
                  <td align="left"><b>'.$record->packSize.'</b></td>
                  <td align="left"><b>'.$record->approvedPrice.'</b></td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br><br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$record->assignedAD.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Issuing Officer,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$record->assignedSecretary.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Secretary,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Registration Board
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->AddPage();
            $html = '
            <center>
                <p><b>Conditions:</b></p>
                <table border="0" style="padding:3px; font-size:7px;">
                <tr>
                    <td width="5%" style="text-align:left;">1.</td>
                    <td width="95%" style="text-align:left;">The registration shall remain valid unless earlier suspended or cancelled under
the Drugs Act, 1976 and rules framed thereunder.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">2.</td>
                    <td width="95%" style="text-align:left;">The drug(s) shall be manufactured in compliance to the provision of Drugs Act,
1976 and Rules framed there under.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">3.</td>
                    <td width="95%" style="text-align:left;">Every drug shall be produced in sufficient quantity so as to ensure its regular and
adequate supply in the market.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">4.</td>
                    <td width="95%" style="text-align:left;"> The manufacturing of any drug shall not, without the prior approval of the
Registration Board, be discontinued for a period which may result in shortage.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">5.</td>
                    <td width="95%" style="text-align:left;"> The manufacturer shall follow information in label/patient information leaflet and
medical literature regarding clinical use, route of administration, dosage, storage
conditions of finished products and type of container closure system/packaging
material in line with the innovator brand or reference regulatory authorities or as
approved by Registration Board.
</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">6.</td>
                    <td width="95%" style="text-align:left;"> The manufacturer shall not use any of banned excipient; moreover, all excipients
will be of pharmaceutical grade and within safe limits as defined by reference
regulatory authorities.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">7.</td>
                    <td width="95%" style="text-align:left;">The import of raw materials will be made at competitive rates in accordance with
the Import Trade Control Order.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">8.</td>
                    <td width="95%" style="text-align:left;">The name shall be changed in case it has resemblance with already registered
drugs</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">9.</td>
                    <td width="95%" style="text-align:left;">The registered drugs shall conform to the specifications of official
Pharmacopoeial reference as provided in the Drug (Specifications) Rules, 1978.
In case, if the drug(s)is not yet included in any of the pharmacopoeia, it shall
conform to the innovator’s company specifications as approved by the Regulatory
Authority of any reference countries specified by the Registration Board subject
to the compliance of Drug (Specifications) Rules, 1978. The innovator’s
specifications, however, are valid only till inclusion of the product in the official
pharmacopoeia of reference countries as specified by the Registration Board.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">10.</td>
                    <td width="95%" style="text-align:left;">Other conditions as contained under the Drugs Act, 1976 and Rules framed there
under including stability studies shall be strictly adhere to.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">11.</td>
                    <td width="95%" style="text-align:left;">Errors and omission, if any, will be corrected accordingly.</td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Applicant Registration Certificate' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            //$pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));
/*
            $y_start = $pdf->GetY();
            $pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '20', PDF_HEADER_LOGO_WIDTH, $h=22, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='L');
            $pdf->SetY(9);

            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            $pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
			*/
			
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
			$pdf->licfileno = $data['records'][0]->regFileNo;

			// ------ Loading Settings 
			$pdf->setting('',$data);
			
			$pdf->SetFont('helvetica', '', 12, '', true);

			
            //$pdf->SetXY(90, 50);
            //$pdf->writeHTML('<span style="text-align:right; font-size:15px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b></span>', true, false, false, false, '');

            //$pdf->SetY(14);
            $html = '
                <center>
				<div style="line-height:80%;">
				<p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
				<p style="text-align:left; font-size:12px; width:100%;"><b>'.$data['records'][0]->companyName.'</b></p>
				<p style="text-align:left; font-size:12px; width:100%;"><b>'.$data['records'][0]->siteAddress.'</b></p>
				<p style="text-align:left; font-size:12px; width:100%;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
				</div>
				<br>

				</center>
      
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;">Subject: <b><u><span style="font-size:12px;">REGISTRATION OF DRUGS UNDER SECTION 7 OF THE DRUGS ACT, 1976 AND RULES 27, 28, 29 AND 30 OF THE DRUGS (LICENSING, REGISTERING AND ADVERTISING) RULES, 1976.</span></u></b><br></td>
                </tr>
                <tr>
                    <td width="100%" style="text-align:left;">The drug(s) as per details given below has been registered, subject to the conditions appearing hereinafter:</td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px; border:1px solid #000;">
                <tr>
                    <td width="25%" style="text-align:left;">Registration No.</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->registrationNo.'</b></td>
                    <td width="25%" style="text-align:left;">Ref. No.</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->rniRefNo.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Brand Name</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->approvedName.'</b></td>
                    <td width="25%" style="text-align:left;">Shelf Life</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->shelfLife.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Dosage Form</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->dosageName.'</b></td>
                    <td width="25%" style="text-align:left;">Storage Condition</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->storageCondition.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Composition</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->labelClaim.'</b></td>
                    <td width="25%" style="text-align:left;">Used For</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->usedFor.'</b></td>
                </tr>
                <tr>
                    <td width="25%" style="text-align:left;">Route of Admin</td>
                    <td width="25%" style="text-align:left;"><b>'.$data['records'][0]->routeOfAdmin.'</b></td>
                    <td width="25%" style="text-align:left;">Valid Till</td>
                    <td width="25%" style="text-align:left;"><b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->validTill)))).'</b></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="1" style="padding:3px;border:1px solid #000;">
                <tr>
                  <th width="5%" align="left">S.#</th>
                  <th width="55%" align="left">Pack Size</th>
                  <th width="40%" align="left">Approved Price (Rs.)</th>
                </tr>';
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
                $sn=1;
                if(!empty($data['recordsDetail']))
                {
                    foreach($data['recordsDetail'] as $record)
                    {
                $html .= '<tr>
                  <td align="center">'.$sn.'</td>
                  <td align="left"><b>'.$record->packSize.'</b></td>
                  <td align="left"><b>'.$record->approvedPrice.'</b></td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br><br><br><br><br>
                <center>
                <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$record->assignedAD.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Issuing Officer,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$record->assignedSecretary.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Secretary,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Registration Board
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <b>'.$record->assignedD.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Chairman,
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Registration Board
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            $pdf->AddPage();
            $html = '
            <center>
                <p><b>Conditions:</b></p>
                <table border="0" style="padding:3px; font-size:7px;">
                <tr>
                    <td width="5%" style="text-align:left;">1.</td>
                    <td width="95%" style="text-align:left;">The drug(s) shall be manufactured in compliance to the provision of drugs Act, 1976 and rules fiamed there under</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">2.</td>
                    <td width="95%" style="text-align:left;">Every drug shall be produced in suicient quantity so as to ensure its regular and adequate Supply in the market.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">3.</td>
                    <td width="95%" style="text-align:left;">The manufacture of any drug shall not, without the prior approval of the Registration Board, be discontinued for a
period which may result in its shortage.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">4.</td>
                    <td width="95%" style="text-align:left;"> Colour Scheme of the labels 1 cartons & packaging material should not resemble with any of the drug(s) which has /
have already been registered.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">5.</td>
                    <td width="95%" style="text-align:left;"> One of the complete method of testing of the finished drug(s) (containing full details of minor and major steps and
protocols along with specifications, lower and upper limits) shall be submitted to the following institutions within a
period of one months:
<ul>
<li>Chief, Drugs Control & Research Division, National Institute of Health, Islamabad.</li>
<li>Director, Central Drug Laboratory, 4-By SMCHS, Karachi</li>
<li>Director, Drugs Testing Laboratory, 1-Birdwood Road, Lahore</li>
<li>Director, Drugs Testing Laboratory, Sindh, Karachi.</li>
<li>Director, Drugs Testing Laboratory, N.W.F.P, Peshawar</li>
</ul>
</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">6.</td>
                    <td width="95%" style="text-align:left;"> One copy of the master formula (of all registered drugs) containing the names of active and inactive materials (s)
along with the quantities shall be furnished to the Assistant Drugs Controller concerned within a period of one month
for which a receipt shall also be obtained.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">7.</td>
                    <td width="95%" style="text-align:left;">The import of raw materials will be made at competitive rates in accordance with the Import Trade Control Order.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">8.</td>
                    <td width="95%" style="text-align:left;">The name shall be changed in case it has resemblance with already registered drugs.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">9.</td>
                    <td width="95%" style="text-align:left;">The registered drugs shall conform to the specifications of oicial pharmacopoeia. However, if is the drug is not
included in any of the pharmacopoeia, it shall conform to the manufacturer\'s specifications.</td>
                </tr>
                <tr>
                    <td width="5%" style="text-align:left;">10.</td>
                    <td width="95%" style="text-align:left;">Other conditions as contained under the Drugs Act, 1976 and rules formed there under shall be strictly adhere.</td>
                </tr>
                </table>
                </center>
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'License Application Submission Receipt' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            /*$pdf->SetFont('helvetica', '', 12, '', true);
            $pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));

            $y_start = $pdf->GetY();
            $pdf->Image(K_PATH_IMAGES.'logo3.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=30, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='C');
            $pdf->SetY(9);

            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            $pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 53, 50, 100, 100, $style, 'N');
            $pdf->SetY(160);
			*/
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="20%" style="text-align:left;"></td>
                    <td width="60%" style="text-align:center;"><h3><b>'.$data['records'][0]->rniRefNo.'</b></h3></td>
                    <td width="20%" style="text-align:left;"></td>
                </tr>
                <br><br><br><br><br><br><br><br>
                <tr>
                  <td width="20%" style="text-align:left;"></td>
                  <td width="60%" style="text-align:center;"><h1><b>'.$data['records'][0]->companyName.'</b></h1></td>
                  <td width="20%" style="text-align:left;"></td>
                </tr>
                </table>
                </center>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Registration Application Submission Receipt' && $hasReportRights == 1) /* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            //$pdf->SetFont('helvetica', '', 12, '', true);
            /*$pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));

            $y_start = $pdf->GetY();
            $pdf->Image(K_PATH_IMAGES.'logo3.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=30, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='C');
            $pdf->SetY(9);

            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            $pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 53, 50, 100, 100, $style, 'N');
            $pdf->SetY(160);
			*/
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="20%" style="text-align:left;"></td>
                    <td width="60%" style="text-align:center;"><h3><b>'.$data['records'][0]->rniRefNo.'</b></h3></td>
                    <td width="20%" style="text-align:left;"></td>
                </tr>
                <br><br><br><br><br><br><br><br>
                <tr>
                  <td width="20%" style="text-align:left;"></td>
                  <td width="60%" style="text-align:center;"><h1><b>'.$data['records'][0]->companyName.'</b></h1></td>
                  <td width="20%" style="text-align:left;"></td>
                </tr>
                </table>
                </center>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Export Approval Letter' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


                $labelclaim = (($data['records'][0]->refUnit)?$data['records'][0]->refUnit: 'Each ' .$data['records'][0]->dosageName. ' contains:')."\n";
                if (!empty($data['recordsDetail']['compositions'])) {
                    foreach ($data['recordsDetail']['compositions'] as $record) {
                        $labelclaim .= $record->innManual . ' .... ' . $record->strength . ' ' . $record->unit . "\n";
                    }
                }
                //$pdf->footerText = "This document cannot be used for legal proceedings.";


                $pdf->licfileno = $data['records'][0]->regFileNo.' - '.$data['records'][0]->dealingsection;
                $pdf->barcode_no =  $data['records'][0]->id;


                $html = '
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.' ('.$data['records'][0]->licenseNoManual.'),</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->companyAddress.', '.$data['records'][0]->siteCity.'</b></p>
            </div>
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>REGISTRAITON OF DRUGS UNDER SECTION 7 OF THE DRUGS ACT, 1976 AND RULES 30 OF THE DRUGS (LICENSING, REGISTERING AND ADVERTISING) RULES, 1976 (EXCLUSIVELY FOR EXPORT PURPOSE)</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; The drug as per details given below has/have been registered subject yo the conditions appearing heareinafter.</p>
            <br>
            ';
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="20%" align="left"><b>Reg. No.</b></th>
                          <th width="55%" align="left"><b>Name of Drug &  Composition</b></th>
                          <th width="30%" align="left"><b>Strength/Potency</b></th>
                        </tr>
                        <tr>
                          <td align="center">1</td>
                          <td>'.$data['records'][0]->registrationNo.'</td>
                          <td align="left">' . $data['records'][0]->approvedName . '<br>' . $labelclaim . '</td>
                          <td align="left">As per requirement of importing country</td>
                        </tr>';


                $html .= '
                        </table>
                        </ol>
                        </center>';
                $html .= '<h4><u>Conditions:-</u></h4>'.$data['records'][0]->letterConditions;
     /*
                $html .=' <h4><u>Conditions:-</u></h4>
                        <style>
                        li {font-size:12px;}</style>
                        <ol type="i">
                        <li><b>Manufacturer will export the product after complying with all the requirements as required under
Drug Act, 1976 and relevant rules including No Objection Certificate from concerned DRAP office.</b></li>
                        <li><b>Manufacturer will also furnish export documents endorsed from custom authorities (if required for
any query) in order to ensure the export of the product.</b></li>
                        <li><b>The manufacturer shall mention information as per requirement of importing country in the light
of Drugs (Labeling &amp; Packing) Rules, 1986.</b></li>
                        <li>One of the complete method of testing of the finished drug(s) (containing full details of all minor and
major steps and protocols along with specification) (lower and upper limits) shall be submitted to the
following institutions within a period of one month:-
                            <ul>
                            <li>Chief Drugs Control &amp; Traditional Medicine Division, National Institute of Health, Islamabad.</li>
                            <li>Director, Central Drug Laboratory, 4 th B SMCH Sharah-e-Faisal, Karachi.</li>
                            <li>Director, Drugs Testing Laboratory, 1-Birdwood Road, Lahore.Director, Drugs Testing
Laboratory, Sindh, Karachi.</li>
                            <li>Director, Drugs Testing laboratory, K.P. Peshawar.</li>
                            <li>Director, Drugs Testing Laboratory, Balochistan, Quetta.</li>
                            </ul>
                            </li>
                            <li>One copy of the master formula (of all registered drugs) containing the names of active and inactive
material(s) along-with the quantities shall be furnished to the Assistant Director, DRAP within a period of

one month for which a receipt shall also be obtained.</li>
<li>The import of raw materials will be made at competitive rates in accordance with the Import Trade
Control Order.</li>
<li>The name shall be changed in case it has resemblance with already registered drugs.</li>
                        <li>The above mentioned drugs are registered under the permission that these drugs shall not be sold in the
local market and incase of any violation this permission/registration would render invalid.</li>
                        <li><b>These drugs are registered exclusively for export purpose only &amp; this approval shall not be meant
for marketing above product in local market.</b></li>
                        </ol>
                        ';
    */



                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
        if($reportType == 'Export Registration Appliation' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

                $licenserecord  = $this->myModel->getCompanyApprovedLicense($data['records'][0]->companyAccountId);
                $QCIncharge = $this->myModel->approvedQCIncharge($licenserecord[0]->id);
                $PIncharge = $this->myModel->approvedPIncharge($licenserecord[0]->id);


                $moleculename = '';
                $labelclaim = (($data['records'][0]->refUnit)?$data['records'][0]->refUnit: 'Each ' .$data['records'][0]->dosageName. ' contains')." : \n";
                if (!empty($data['recordsDetail']['compositions'])) {
                    foreach ($data['recordsDetail']['compositions'] as $record) {
                        $moleculename .= $record->innManual . ' : ' . $record->strength . ' ' . $record->unit . "<br>\n";

                        $labelclaim .= $record->innManual . ' : ' . $record->strength . ' ' . $record->unit . "\n";
                    }
                }
                //$pdf->footerText = "This document cannot be used for legal proceedings.";


                //$pdf->licfileno = 'FORM 5';//$data['records'][0]->regFileNo.' - '.$data['records'][0]->dealingsection;
                $html = '
            <p style="text-align:center; font-size:18px;"><b>FORM-5 </b> </p>
            <p style="text-align:center; font-size:18px;"><b>[See Rule 26(1) of Drugs (LRA) Rules, 1976] </b> </p>
            <p style="text-align:center; font-size:18px;"><b>APPLICATION FORM FOR REGISTRATION OF DRUG FOR EXPORT PURPOSE </b> </p>
            <p style="text-align:center; font-size:12px;">Having the same active ingredient or sale thereof, therapeutic use, dosage form and route of administration that has already been approved by the Ministry of Health already on sale in local and/or international market.</p>
            <p style="text-align:left; font-size:12px;">I/We <b><u>'.$data['records'][0]->companyName . '</u></b> hereby apply for registration of the drug namely <b><u>'.$data['records'][0]->approvedName.'</u></b> details of which are enclosed.</p>
            <p style="text-align:left; font-size:12px;">Date: '.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->submissionDate)))).'</p>
            <p style="text-align:right; font-size:12px;">Signed: <u>Digitally Signed</u></p>
            <p style="text-align:left; font-size:12px;">Place: <b><u>' . $data['records'][0]->companyAddress . '</u></b></p>

            <p style="text-align:center; font-size:14px;"><b>ENCLOSURES OF THE APPLICATION FOR REGISTRATION OF A DRUG FOR EXPORT PURPOSE </b> </p>
            <div >
            <p style="text-align:left; font-size:12px;">Dosage Form <b>'.$data['records'][0]->dosageName.'</b> </p>
            <p style="text-align:left; font-size:12px;">1. Name and Address of the Manufacturer (Applicant): '.$data['records'][0]->companyName.', '. $data['records'][0]->companyAddress .'</p>
            <p style="text-align:left; font-size:12px;">2. Brand (Proprietary) Name of the Drug: <b>'.$data['records'][0]->approvedName.'</b> </p>
            <p style="text-align:left; font-size:12px;">3. The chemical name(s) and, as appropriate and available established (generic) names and synonyms of the drug: <br><b>'.$moleculename.'</b></p>
            <p style="text-align:left; font-size:12px;">4. Strength of active ingredeient(s) per unit, e.g., each tablet or 5ml etc. contains: <br><b>'.$labelclaim.'</b></p>
                <p style="text-align:left; font-size:12px;">5. Pharmacological Group: <b>'.$data['records'][0]->usedFor.'</b> </p>
                <p style="text-align:left; font-size:12px;">6. Recommended Clinical Use: <b>'.  ( $data['records'][0]->clinicaldosageAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">7. Proposed Route of Administration: <b>'.$data['records'][0]->routeOfAdmin.'</b> </p>
                <p style="text-align:left; font-size:12px;">8. Proposed Dosage: <b>'.$data['records'][0]->dosageName.'</b> </p>
                <p style="text-align:left; font-size:12px;">9. Proposed Shelf-life of the Drug: <b> - </b> </p>
                <p style="text-align:left; font-size:12px;">10. Proposed Storage Conditions of the Finished Product.<b>'.$data['records'][0]->storageCondition.'</b> </p>
                <p style="text-align:left; font-size:12px;">11. Unit Price of the Drug e.g. per Tablet per capsule, per ml etc.:.<b> - </b> </p>
                <p style="text-align:left; font-size:12px;">12. In case of International Availability, provide the following:';
                    if($data['records'][0]->exportDrugTypeId == 1){
                        $html .='<br> Name : '.$data['records'][0]->internationalRefBrandName.'<br> Country : '.$data['records'][0]->internationalRefBrandCountry.'<br> Company : '.$data['records'][0]->internationalRefMAHolder;
                    }else{
                        $html .='<b> N/A</b>';
                    }
                $html .= '
                </p>
                <p style="text-align:left; font-size:12px;">13.Brand Name(s) of the Drug if available in Pakistan:';
                 if($data['records'][0]->exportDrugTypeId == 2){
                        $html .='<b> '.$data['records'][0]->domesticRefBrandName.' ('.$data['records'][0]->domesticRefRegistrationNo.')</b>';
                    }else{
                        $html .='<b> N/A</b>';
                    }
                $html .= '
                 </p>
                <p style="text-align:left; font-size:12px;">14. Name of Company(s) Manufacturing in Pakistan:';
                if($data['records'][0]->exportDrugTypeId == 2){
                    $html .='<b> '.$data['records'][0]->domesticRefProductHolder.'</b>';
                }else{
                    $html .='<b> N/A</b>';
                }
                $html .= '
                 </p>
                <p style="text-align:left; font-size:12px;">15. Composition (active & excipients) including statement of the quantitative composition, giving the weight of measure for each active substance used in the manufacture of the dosage form: <b>'.( $data['records'][0]->compositionAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">16. Outline of Method of Manufacture: <b>'.( $data['records'][0]->manufactureMethodAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">17. Person under whose direct supervision and control the drug is manufactured with following: <br>  <b>'.( $data['records'][0]->technicalStaffAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">18. Name of the equipment that will be used in the manufacture of the drug applied for registration: <br><b>'.( $data['records'][0]->manufacturingEquipmentsAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">19. Full Descriptions of the Specification and analytical methods necessary to assure the identity, strength, quality, purity and homogeneity throughout the Shelf Life of the drug product, stability studies: <br><b>'.( $data['records'][0]->descriptionMethodAttachments != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">20. Name, Qualification and Designation of the person who will be responsible for the Quality Control of the Drug: <b>'.( $data['records'][0]->technicalStaffAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">21. Description of the equipments to be used for the Quality Control of the active raw material and the finished products:  <b>'.( $data['records'][0]->qaEquipmentsAttachments != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>                        
                <p style="text-align:left; font-size:12px;">22. Labeling and Prescribing Information (to be mentioned on the pack/leaflet) specimen or draft shall be submitted for the following class as of drugs namely: </p>
                <table border="0" width="90%" style="padding:3px;border:none; font-size:12px;">
                        <tr>
                          <th width="70%" align="left">(a) C.N.S Stimulants;</th>
                          <th width="30%"   ></th>
                        </tr>
                        <tr>
                          <td align="left">(b) Drugs Affecting Uterine;</td>
                          <td></td>
                        </tr>
                         <tr>
                          <td align="left">(c) Drugs Inhibiting Hormonal Production;</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td align="left">(d) Hormones and Other Steroidal Preparation excluding preparations for external and topical user;</td>
                          <td align="center"><b>'.( $data['records'][0]->labelingprescribingAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b></td>

                        </tr>
                        <tr>
                          <td align="left">(e) Narcotic Drugs as per Single Convention on Narcotic Drugs 1961; and </td>
                        </tr>
                        <tr>
                          <td align="left">(f) Psychotropic Substances mentioned as per convention on psychotropic substances, 1971 (Specimen of label to be submitted as soon as production starts) </td>
                        </tr>
                </table>
                
                <p style="text-align:left; font-size:12px;">23. Facility of Water Processing with Specifications: <b>'.( $data['records'][0]->waterProcessingSpecificationAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b> </p>
                <p style="text-align:left; font-size:12px;">24. Environment Control Processing with Details: <b>'.( $data['records'][0]->enviormentalProcessingSpecificationAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b></p>
                <p style="text-align:left; font-size:12px;">25. Type of container / packaging: <b>'.( $data['records'][0]->packagingTypeAttachment != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b></p>
                <p style="text-align:left; font-size:12px;">26. A copy of last inspection report conducted by the DRAP:  <b>'.( $data['records'][0]->gmpreport != null ? "Document Attached in PIRIMS" :"Document Not Attached" ).'</b></p>
                <p style="text-align:center; font-size:16px;"><b>UNDERTAKING</b></p>
                <p style="text-align:left; font-size:12px;"><b>We hereby undertake that the above given information is true and correct to the best of our knowledge and belief.</b></p>
                <p style="text-align:center; font-size:16px;"><b>UNDERTAKING</b></p>
                <p style="text-align:left; font-size:12px;"><b>I/We <u>'.$data['records'][0]->companyName . '</u>, hereby undertake and confirm the fact that Production Incharge <u>'.$PIncharge[0]->name.'</u> and QC Incharge <u>'.$QCIncharge[0]->name.'</u> have actually consented as per above Undertaking to file for registration of abovestated product and the submission of this application in electronic format tantamounts to their digital signatures.</b></p>';
                $html .= '
            </div>
            <br>
            ';

                $html .= '

                <table border="0" width="90%" style="padding:3px;border:none; font-size:12px;">
                        <tr>
                          <th width="50%" align="left"><b>Digitally Signed</b></th>
                          <th width="50%" align="right"><b>Digitally Signed</b></th>
                        </tr>
                        <tr>
                          <td align="left"><b>'.$PIncharge[0]->name.'</b></td>
                          <td align="right"><b>'.$QCIncharge[0]->name.'</b></td>
                        </tr>
                         <tr>
                          <td align="left">Producttion Incharge</td>
                          <td align="right">QC Incharge</td>
                        </tr>
                </table>
                  
           
            ';




                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
        if($reportType == 'Product Detail' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

                $labelclaim = (($data['records'][0]->refUnit)?$data['records'][0]->refUnit: 'Each ' .$data['records'][0]->dosageName. ' contains:')."\n";
                if (!empty($data['recordsDetail']['compositions'])) {
                    foreach ($data['recordsDetail']['compositions'] as $record) {
                        $labelclaim .= $record->innManual . ' .... ' . $record->strength . ' ' . $record->unit . "\n";
                    }
                }
                $pdf->footerText = "This document cannot be used for legal proceedings.";


                $pdf->licfileno = $data['records'][0]->regFileNo.' - '.$data['records'][0]->dealingsection;
                $pdf->barcode_no =  $data['records'][0]->rniRefNo;

                $html = '
            <div style="line-height:80%;">
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->companyAddress.'</b></p>
            
            <p style="text-align:right; font-size:12px;">Registration Date <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->issueDateManual)))).'</b> </p>
            <p style="display:none; text-align:right; font-size:12px;">Vaild Till <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->validTill)))).'</b> </p>
            <p style="text-align:center; font-size:12px;">Registration No. <b>'.$data['records'][0]->registrationNo.'</b> </p>
            <p style="text-align:center; font-size:12px;">Approved Brand Name <b>'.$data['records'][0]->approvedName.'</b> </p>
            <p style="text-align:left; font-size:12px;">Used For <b>'.$data['records'][0]->usedFor.'</b> </p>
            <p style="text-align:left; font-size:12px;">Route of Admin <b>'.$data['records'][0]->routeOfAdmin.'</b> </p>
            <p style="text-align:left; font-size:12px;">Dosage Form <b>'.$data['records'][0]->dosageName.'</b> </p>
            <p style="text-align:left; font-size:12px;">Reference Unit <b>'.$data['records'][0]->refUnit.'</b> </p>
            
            <p style="text-align:left; font-size:12px;">Product Category <b>'.($data['records'][0]->productCategoryId==1?"Biological":"Pharmaceutical").'</b> </p>
            <p style="text-align:left; font-size:12px;">Finished Product Specification <b>'.$data['records'][0]->pharmacopeia.'</b> </p>
            <p style="text-align:left; font-size:12px;">Shelf Life <b>'.$data['records'][0]->shelfLife.' '.$data['records'][0]->shelfLifeUnit.'</b> </p>
            <p style="text-align:left; font-size:12px;">Manufacturing Type <b>'.($data['records'][0]->regTypeId==1?"Self Manufacturing":($data['records'][0]->regTypeId==2?"Contract Manufacturing":($data['records'][0]->regTypeId==3?"Import":"-"))).'</b> </p>
            <p style="text-align:left; font-size:12px;">Label Claim <b>'.$labelclaim.'</b> </p>
            </div>
            <br>
            ';
                $html .= '
                <h5>Composition</h5>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="55%" align="left"><b>Generic</b></th>
                          <th width="40%" align="left"><b>Strength/Potency</b></th>
                        </tr>';

                $sn = 1;
                if (!empty($data['recordsDetail']['compositions'])) {
                    foreach ($data['recordsDetail']['compositions'] as $record) {
                        if($record->innManual != null && !empty($record->innManual))
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->innManual . '</td>
                          <td align="left">' . $record->strength . ' '.$record->unit.'</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';

                $html .= '
                <h5>Proposed Packing</h5>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="55%" align="left"><b>Pack Size</b></th>
                          <th width="40%" align="left"><b>Approved Price <small>(as per initial registration letter)</small></b></th>
                        </tr>';

                $sn = 1;
                if (!empty($data['recordsDetail']['packings'])) {
                    foreach ($data['recordsDetail']['packings'] as $record) {
                        if($record->packSize != null && !empty($record->packSize))
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->packSize . '</td>
                          <td align="left">' . $record->approvedPrice.'</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';

                $html .= '
                <h5>Other Manufacturers</h5>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Name</b></th>
                          <th width="20%" align="left"><b>Role</b></th>
                          <th width="30%" align="left"><b>Address</b></th>
                          <th width="10%" align="left"><b>Country</b></th>
                        </tr>';

                $sn = 1;
                if (!empty($data['recordsDetail']['manufacturers'])) {
                    foreach ($data['recordsDetail']['manufacturers'] as $record) {
                        if($record->companyName != null && !empty($record->companyName))
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->companyName . '</td>
                          <td align="left">' . $record->role.'</td>
                          <td align="left">' . $record->companyAddress . '</td>
                          <td align="left">' . $record->countryName.'</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';


                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
        if($reportType == 'Applicant Inspection Certificate' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

			//$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
            $html = '
                <center>
                <table border="0" style="padding:3px;">
                
                <tr>
                <td><h1 style="text-align:center;">Certificate of Current Good Manufacturing Practices</h1></td>
                </tr>
                <tr>
                <td><p style="text-align:left; font-size: 12px;"><i>Certificate No. '.$data['records'][0]->companyName.'</i></p></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;">It is to certify that <b>'.$data['records'][0]->companyName.'</b> holding DML No. <b>'.$data['records'][0]->companyName.'</b> is authorized to produce medicine of following categories and is found complying with cGMP in terms of process control maintenance of equipment and area documentation etc. as per provisions of Drug Act, 1976 and tthe rules framed there under:-</td>
                </tr>
                <tr>
                  <td width="100%" style="text-align:left;">
                  <table border="1" style="padding:3px;">
                    <tr>
                      <th width="30%" style="text-align:left;"><b>Formulation</b></th>
                      <th width="30%" style="text-align:left;"><b>Pharmacological Categories</b></th>
                      <th width="40%" style="text-align:left;"><b>Activity(ies)</b></th>
                    </tr>
                    <tr>
                      <td width="30%" style="text-align:left;">For example Tablets</td>
                      <td width="30%" style="text-align:left;">Non antibiotics / antibiotics</td>
                      <td width="40%" style="text-align:left;">Mixing, Drying, Granulation, Compression</td>
                    </tr>
                  </table>
                  </td>
                </tr>
                </table>
                </center>
                <br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;">Certification is based on evaluation conducted on <b>'.$data['records'][0]->companyName.'</b>.
                    <ul>
<li>This certificate is valid for three years from the date of inspection.</li>
<li>Responsibility to maintain quality of Good Manufacturing Standard throughout the period of validity of this certificate shall lie on the manufacturer itself as per Drugs Act, 1976 and the rules framed there under.</li>
<li>This certificate also permits the firm to apply for registration of their products, manufactured as per valid Drug Manufacturing License issued by the Drug Regulatory of Pakistan, in the importing country.</li>
<li>The validity shall automatically cease incase of reporting of non-complaiance of current Good Manufacturing Practices (cGMP) under the Drugs Act, 1976 and rules framed their under.</li>
<li>This certificate is inline with the format as recommended by WHO 9TRS No. 908, 2003).</li>
<li>This certificate is issued on the request of M/s <b>'.$data['records'][0]->companyName.'</b> on the demand of importing country.</li>
</ul>
</td>
                </tr>
                </table>
                </center>
                <br><br>
                <p>Date of Issue / Renewal:- <b>18-Oct-20</b></p>
                <p><u><b>Disclaimer:-</b></u><i>This certificate is issued for export purpose only. Not to be used for any promotional activities within Pakistan. This certificate remains the property of the Drug Regulatory Authority of Pakistan and must be returned on demand.</i></p>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Layout Plan Approval Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;
            $html = '

            <center>
            <div style="line-height:80%;">

            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>APPROVAL OF LAYOUT PLAN</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please refer to your application on the subject cited above. I am directed to convey you the approval of layout plan, for the manufacture of Drugs at the site located at <b>'.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> for following sections:</p>
            <br><br>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Section</b></th>
                          <th width="30%" align="left"><b>Pharmacological Group</b></th>
                          <th width="30%" align="left"><b>Used For</b></th>
                        </tr>';
                        $sn=1;
                        if(!empty($data['recordsDetail']))
                        {
                            foreach($data['recordsDetail'] as $record)
                            {
                        $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->section.'</td>
                          <td align="left">'.$record->pharmaGroup.'</td>
                          <td align="left">'.$record->usedFor.'</td>
                        </tr>';
                        $sn++;
                            }
                        }
                        $html .=  '
                        </table>
                        </ol>
                        </center>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An authenticated copy of the approved layout plan is uploaded.</p>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This approval is valid for a period of one year only, unless the construction is started within this period and a progress report thereof. This approval shall be further subject to the rules, which may be framed from time to time under the Drug Act, 1976.</p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The approved drawing is merely a layout plan of the manufacturing operations. The rest of the conditions including the HVAC systems, the adequacy of working space, surfaces, services, drains, environmental controls, lighting etc., as laid down under the Drug (Licensing, Registering and Advertising) Rules 1976, shall also be taken care of along with ensuring proper provision of safety/emergency exists of personnel under intimation and approval of Building Control Authorities or any other Authority dealing with the subject matter.</p>
            <p style="font-size:12px;">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The production shall be conducted as and when the section shall be developed / constructed, inspected and recommended by panel and approval by Central Licensing Board as per requirements laid down under the Drug (Licensing, Registering and Advertising) Rules, 1976. The firm is also directed to ensure emergency exits along with other condition of Drug Manufacturing License. Encls:  As above </p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->layoutApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'Site Verification Shortcoming Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

			$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            //$pdf->SetY(1);
            $html = '
            <style>
            span {
                font-size:12px;
            }
            </style>
            <center>
            <div style="line-height:80%;">
            
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPLICATION FOR SITE VERIFICATION</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of your application for Site Verification.</p>
             <ol><p style="font-size:12px;">'.$data['records'][0]->reviewer1Remarks.'</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'Site Verification Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
			$html = '

            <center>
            <div style="line-height:80%;">
                        <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>';
            if($id == 311 || $id == 675){
                $html.='
            <p style="text-align:left; font-size:12px;"><b>Additional Director</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan</b></p>
            <p style="text-align:left; font-size:12px;"><b>Lahore.</b></p>';
            }else{
                $html.='
            <p style="text-align:left; font-size:12px;"><b>Director QA & LT</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan TF Complex, G/9-4</b></p>
            <p style="text-align:left; font-size:12px;"><b>Islamabad.</b></p>';
            }

            $html.='
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>ESTABLISHMENT OF A PHARMACEUTICAL UNIT</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to say that <b>M/s '.$data['records'][0]->companyName.'</b> intend to establish a pharmaceutical unit at site located <b>'.$data['records'][0]->siteAddress.' '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> for the manufacture of drugs under the Drugs Act, 1976. You are requested to direct Federal Inspector of Drugs to inspect the site and furnish its report whether the location and surroundings are suitable for a pharmaceutical unit as per requirements laid down under paragraph 1 of Section 1 of Schedule “B” (SRO.470(I)/98 dated 15.05.1998) under Rule 16(a) of the Drugs (Licensing, Registering & Advertising) Rules 1976. Please attach a sketch of the plot and its adjoining areas with the report. </p>
             <div style="line-height:20%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The address and telephone number of the applicant, for contact, is as under: </p>
            </div>
            <div style="line-height:50%;">
            <p style="font-size:12px;"><b><ol>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data['records'][0]->name.'</ol></b></p>
            <p style="font-size:12px;"><b><ol>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data['records'][0]->designation.'</ol></b></p>
            <p style="font-size:12px;"><b><ol>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data['records'][0]->address.'</ol></b></p>
            <p style="font-size:12px;"><b><ol>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$data['records'][0]->phone.'</ol></b></p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
        
        }
        if($reportType == 'Site Approval Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>SITE APPROVAL FOR ESTABLISHMENT OF A PHARMACEUTICAL UNIT</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above and convey you the approval of the site located at  <b>'.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> for the establishment of a pharmaceutical unit. You are required to submit the layout plan as per following details: </p>

            <ol type="i" style="font-size:12px;">
            <li>A detailed building layout (in duplicate), for pre-approval in accordance with the paragraph 2 of Section 1 of Schedule-B, under the Drugs (Licensing, Registering & Advertising) Rules 1976. The layout plan must comply with the Good Manufacturing Practices as laid down under the aforesaid rules.</li>
            <li>Provision of HVAC system may be given in the layout plan. </li>
            <li>Section wise detail of covered areas.</li>
            <li>Fee @ of Rs. 6500/- per section as mentioned in the layout plan to be deposited under the head of A/C No. 0010008463-700018 in Allied Bank Limited. </li>
            <li>Men and material flow may be intimated in different colored arrows.</li>
            </ol>
             
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;After an examination of the layout plan, if needed, you may be advised to send your technical expert(s) to explain and discuss the same in person. The approval of the proposed plan by the Central Licensing Board shall be subject to its confirmation to the Good Manufacturing Practices requirements.  </p>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The approval of the building layout shall be subjected to the conformity of parameters of building and environment safety and other safety measures and by the relevant controlling authority.   </p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This letter in no way is considered as right for approval of layout plan and grant of Drug Manufacturing License. Same shall be processed under the Drug Act, 1976 and Drugs (Licensing, Registering & Advertisement) Rules, 1976 accordingly after fulfillment of legal requirements.  </p>
            
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->siteApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
        
        }
        if($reportType == 'Renewal Shortcoming' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['shortcomings'] = $this->loginModel->licensevarianceDetailQuery($id);


            $totalshortcomings =  count($data['shortcomings']);
            $counter = 1;
            $html = '';
            foreach ($data['shortcomings'] as $shortcoming){
                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no =  $data['records'][0]->rniRefNo;
                $html .= '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;"><b>'.$shortcoming->letterType.'</b> </p>

            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($shortcoming->dateTime)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPLICATION FOR LICENSE RENEWAL</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of your application.</p>
             <ol><p style="font-size:12px;">'.$shortcoming->shortcomming.'</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$shortcoming->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';


                if($counter < $totalshortcomings){
                    $counter++;
                    $html.='<div style="clear: both;page-break-after: always;"> </div>';

                }

            }

        }
        if($reportType == 'Shortcoming Company Management' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['shortcomings'] = $this->loginModel->licensevarianceDetailQuery($id);
                $totalshortcomings =  count($data['shortcomings']);
                $counter = 1;
                $html = '';
                foreach ($data['shortcomings'] as $shortcoming){

                    $pdf->licfileno = $data['records'][0]->licFileNo;

                    $pdf->barcode_no =  $data['records'][0]->rniRefNo;
                    $html .= '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($shortcoming->dateTime)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>CHANGE OF MANAGEMENT</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of application</p>
             <ol><p style="font-size:12px;">'.$shortcoming->shortcomming.'</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$shortcoming->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
                    if($counter < $totalshortcomings){
                        $counter++;
                        //
                        $html.='<div style="clear: both;page-break-after: always;"> </div>';

                        //$pdf->AddPage();
                        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


                    }

                }

        /*    else {

                $pdf->licfileno = $data['records'][0]->licFileNo;

                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>' . date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))) . '</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s ' . $data['records'][0]->companyName . '</b></p>
            <p style="text-align:left; font-size:12px;"><b>' . $data['records'][0]->siteAddress . '</b></p>
            <p style="text-align:left; font-size:12px;"><b>' . $this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName . '</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>CHANGE OF MANAGEMENT</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of application</p>
             <ol><p style="font-size:12px;">' . $data['records'][0]->reviewer1Remarks . '</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>' . $data['records'][0]->assignedOfficer . '</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            }
        */
        }
        if($reportType == 'Shortcoming Company Name' && $hasReportRights == 1)/* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['shortcomings'] = $this->loginModel->licensevarianceDetailQuery($id);
                $totalshortcomings =  count($data['shortcomings']);
                $counter = 1;
                $html = '';
                foreach ($data['shortcomings'] as $shortcoming){

                    $pdf->licfileno = $data['records'][1]->licFileNo;

                    $pdf->barcode_no =  $data['records'][1]->rniRefNo;
                    $html .= '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($shortcoming->dateTime)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>CHANGE OF TITLE</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of application</p>
             <ol><p style="font-size:12px;">'.$shortcoming->shortcomming.'</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$shortcoming->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
                    if($counter < $totalshortcomings){
                        $counter++;
                        //
                        $html.='<div style="clear: both;page-break-after: always;"> </div>';

                        //$pdf->AddPage();
                        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


                    }

                }

                /*    else {

                        $pdf->licfileno = $data['records'][0]->licFileNo;

                        $pdf->barcode_no = $data['records'][0]->rniRefNo;
                        $html = '

                    <center>
                    <div style="line-height:80%;">
                    <p style="text-align:right; font-size:12px;">Islamabad,the <b>' . date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))) . '</b> </p>
                    <p style="text-align:left; font-size:12px;"><b>M/s ' . $data['records'][0]->companyName . '</b></p>
                    <p style="text-align:left; font-size:12px;"><b>' . $data['records'][0]->siteAddress . '</b></p>
                    <p style="text-align:left; font-size:12px;"><b>' . $this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName . '</b></p>
                    </div>
                    <br>

                    </center>
                    <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>CHANGE OF MANAGEMENT</u></b></p>
                    <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of application</p>
                     <ol><p style="font-size:12px;">' . $data['records'][0]->reviewer1Remarks . '</p></ol>
                     <div style="line-height:-80%;">
                    <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
                    </div>
                    <br><br>

                    <table>
                        <tr>
                          <td>
                            <table border="0" style="padding:3px;float:right;">
                            <tr>
                              <td style="text-align:center;">
                              <br><br>

                              </td>
                            </tr>
                            <tr>
                              <td style="text-align:center;">
                              <br><br>

                              <br>
                              </td>
                            </tr>
                            </table>
                          </td>
                          <td>
                            <table border="0" style="padding:3px;float:right;">
                            <tr>
                              <td style="text-align:center;">
                              <br><br>

                              </td>
                            </tr>
                            <tr>
                              <td style="text-align:center;">
                              <br><br>

                              <br>
                              </td>
                            </tr>
                            </table>
                          </td>
                          <td>
                            <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                            <tr>
                              <td style="text-align:center;">
                              <br><br>
                              <b>' . $data['records'][0]->assignedOfficer . '</b>
                              </td>
                            </tr>
                            <tr>
                              <td style="text-align:center;">
                              Assistant Director (Lic)
                              <br>
                              </td>
                            </tr>
                            </table>
                          </td>
                        </tr>
                        </table>

                    ';

                        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                    }
                */
            }
        if($reportType == 'Shortcoming Technical Staff' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['shortcomings'] = $this->loginModel->licensevarianceDetailQuery($id);
            $totalshortcomings =  count($data['shortcomings']);
            $counter = 1;
            $html ='';
            foreach ($data['shortcomings'] as $shortcoming){
     $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no =  $data['records'][0]->rniRefNo;
                $html .= '

            <center>
            

            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;"><b>'.$shortcoming->letterType.'</b> </p>

            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($shortcoming->dateTime)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>
            <style>
            p{
            font-size: x-small;
            }
            </style>
            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPROVAL OF PRODUCTION INCHARGE AND QUALITY CONTROL INCHARGE</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information:-</p>
             <ol><p style="font-size:12px;">'.$shortcoming->shortcomming.'</p></ol>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;It may be noted that manufacturing of Drugs without approved technical staff is violation of Rule 16 of the Drugs (Licensing, Registering and Advertising) Rule, 1976. Proceeding may be initiated for suspension or cancellation of Drug Manufacturing License under section 41 of the Drugs Act, 1976 and rules framed thereunder, in case you failed to provide above documents / information within 15 days positively</p>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$shortcoming->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';


                if($counter < $totalshortcomings){
                    $counter++;
                    $html.='<div style="clear: both;page-break-after: always;"> </div>';
                    //
                    //$pdf->AddPage();
                    //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


                }
            }

            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'Technical Staff Approval Letter' && $hasReportRights == 1)/* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>CHANGE OF TECHNICAL STAFF ('.($data['records'][0]->postchangeTypeId==16?"QC Incharge":"Production Incharge").'). - APPROVAL THEREOF</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above and convey that the following technical staff is approved w.e.f date of joining  in respect of Drug Manufacturing License No.  <b>'.$data['records'][0]->licenseNoManual.'. </p>';
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="17%" align="left"><b>Name</b></th>
                          <th width="16%" align="left"><b>Father Name</b></th>
                          <th width="15%" align="left"><b>NIC</b></th>
                          <th width="15%" align="left"><b>Designation</b></th>
                          <th width="15%" align="left"><b>Qualification</b></th>
                          <th width="15%" align="left"><b>Date of Joining</b></th>
                        </tr>';
                $sn=1;
                if(!empty($data['recordsDetail']))
                {
                    foreach($data['recordsDetail'] as $record)
                    {
                        if($record->enterDate != null){
                            $joinDate = date('d-M-Y', strtotime(date('Y-m-d', strtotime($record->enterDate))));
                        }else{
                            $joinDate = date('d-M-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->submissionDate))));
                        }
                        if($data['records'][0]->postchangeTypeId == 16){
                            if($record->designationId == 2){

                                $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->name.'</td>
                          <td align="left">'.$record->fatherName.'</td>
                          <td align="left">'.$record->nic.'</td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left">'.$record->qualification.'</td>
                          <td align="left">'.$joinDate.'</td>
                        </tr>';
                            }else{
                                $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                        </tr>';

                            }

                        }else if($data['records'][0]->postchangeTypeId == 19){
                            if($record->designationId == 1){
                                $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->name.'</td>
                          <td align="left">'.$record->fatherName.'</td>
                          <td align="left">'.$record->nic.'</td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left">'.$record->qualification.'</td>
                          <td align="left">'.$joinDate.'</td>
                        </tr>';
                            }else{
                                $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left"> X </td>
                          <td align="left"> X </td>
                        </tr>';
                            }
                        }

                        $sn++;
                    }
                }
                $html .=  '
                        </table>
                        </ol>
                        </center>
           <br>
            
             
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please ensure that production in all sections and QC operations are conducted under active supervision of approved technical staff as required under rule 16 of The Drug (Licensing,  Registering & Advertising) Rules, 1976.  </p>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please also note that under rule 19 of the aforesaid Rules, any change in the technical staff shall be immediately notified to the Centeral Licensing Board, under intimation to the area Federal Inspector of Drugs.  </p>
            
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->varianceApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';


            }
        if($reportType == 'Layout Plan Shortcoming Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

			$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no =  $data['records'][0]->rniRefNo;

            $html = '

            <center>
            <div style="line-height:80%;">
           
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPROVAL OF LAYOUT PLAN</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. Layout plan committee discussed proposed LOP in its meeting held on '.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->lopMeetingDate)))).' and noted following observations:</p>
             <ol><p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;'.$data['records'][0]->reviewer1Remarks2.'</p></ol>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are directed to submit revised layout plan after rectification of above said observations and depute a technical person who is well conversant with the matter to discuss the proposed layout plan so that the case may be processed further.</p>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

        }
        if($reportType == 'Layout Plan Variance Certificate' && $hasReportRights == 1)/* Done */{

            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

            $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no =  $data['records'][0]->rniRefNo;

                $html = '

            <center>
            <div style="line-height:80%;">
           
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPROVAL OF LAYOUT PLAN UNDER DML NO. '.$data['records'][0]->licenseNoManual.' </u></b></p>
            <p style="font-size:12px; text-align: justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above and to convey the approval of the layout plan by the Secretary Central Licensing Board for the manufacturing at the site located at '.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.' for the following section(s) with the instructions to ensure the HVAC parameters as per product and facility requirements;</p>
            <ol style="list-style-type: lower-roman;">';
            foreach ($data['recordsDetail'] as $secRecord){
                if($secRecord->varType != 'No Change')
                    $html.= '<li style="font-size: 12px">&nbsp;&nbsp;&nbsp;&nbsp;'.$secRecord->section.' ('.$secRecord->pharmaGroup.') <b>'.$secRecord->varType.'</b></li>';
            }
                $html .= '</ol>
            <p style="font-size:12px; text-align: justify">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An authenticated copy of the approved layout plan is forwarded herewith. Please provide a copy of the approved layout plan to the office of the concerned Federal Inspector of Drugs.</p>
            <p style="font-size:12px; text-align: justify">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This approval is valid for a period of one year only, unless the construction of the main building is started within this period and a progress report thereof, duly verified by the area Federal Inspector of Drugs is submitted to the Central Licensing Board. This approval shall be further subject to the rules, which may be framed from time to time under the Drugs Act, 1976.</p>
            <p style="font-size:12px; text-align: justify">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The approved drawing is merely a layout plan of the manufacturing operations. The rest of the conditions including the HVAC systems, the adequacy of working space, surfaces, services, drains, environmental controls, lighting, as laid down under the Drugs (Licensing, Registering and Advertising) Rules 1976, shall also be taken care of along with ensuring proper provision of safety/ emergency exits of personnel under intimation and approval of Building Control Authorities or any other Authority dealing with the subject matter.</p>
            <p style="font-size:12px; text-align: justify">5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The production shall be conducted as and when the sections shall be developed / constructed, inspected and recommended by panel and approval by Central Licensing Board as per requirements laid down under the Drugs (Licensing, Registering and Advertising) Rules, 1976. The firm is also directed to ensure emergency exists along with other condition of Drug Manufacturing License.</p>

            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

            }
        if($reportType == 'Layout Plan Variance Shortcoming Letter' && $hasReportRights == 1)/* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['shortcomings'] = $this->loginModel->licensevarianceDetailQuery($id);
                $totalshortcomings =  count($data['shortcomings']);
                $counter = 1;
                $html ='';
                foreach ($data['shortcomings'] as $shortcoming){
                    $pdf->licfileno = $data['records'][0]->licFileNo;
                    $pdf->barcode_no =  $data['records'][0]->rniRefNo;

                    $html .= '

            <center>
            

            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;"><b>'.$shortcoming->letterType.'</b> </p>

            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($shortcoming->dateTime)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>
            <style>
            p{
            font-size: x-small;
            }
            span{
            font-size: 12px !important;
            }
            </style>
            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPROVAL OF LAYOUT PLAN </u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information:-</p>
            <p style="font-size:12px; ">'.$shortcoming->shortcomming.'</p>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will help to expedite your case earlier.</p>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$shortcoming->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';


                    if($counter < $totalshortcomings){
                        $counter++;
                        $html.='<div style="clear: both;page-break-after: always;"> </div>';
                        //
                        //$pdf->AddPage();
                        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


                    }
                }

                //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            }
        if($reportType == 'Applicant License Shortcoming Certificate' && $hasReportRights == 1) /* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
			
			$html = '

            <center>
            <div style="line-height:80%;">
            
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>GRANT OF DRUG MANUFACTURING LICENSE</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of your application for Site Verification.</p>
             <ol><p style="font-size:12px;">'.$data['records'][0]->reviewer1Remarks3.'</p></ol>
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are directed to furnish the above said information / documents to this Division so that the case may be processed further.</p>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'License Note Sheet' && $hasReportRights == 1)/* Done */{

            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
           if(!isset($data['records'][0])){
                die();
            }
			//$pdf->setY(2);
            //$pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            // $siteAddress = explode(",",$data['records'][0]->siteAddress);
            // $siteCity = end($siteAddress);
            // $sliced = array_slice($siteAddress, 0, -1);
            // $siteAddress = implode(",", $sliced);
            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            //$pdf->SetY(1);
			$comp = (@$data['records'][0]->roleId == 26)?'<h4 style="text-align:center; font-size:14px;">'.$data['records'][0]->companyName.'</h4>':'';
			$pdf->isnotesheet = true;
			$pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->compName = $data['records'][0]->companyName.' '.$data['records'][0]->siteAddress;
            //$pdf->compSite = $data['records'][0]->siteAddress;

            /*

            <center>
            <div style="line-height:80%;">
            <p style="text-align:center; font-size:14px;">'.$data['records'][0]->licFileNo.'</p>
            <p style="text-align:center; font-size:14px;">    Government of Pakistan</p>
            <p style="text-align:center; font-size:14px;">    Ministry of National Health Services, Regulations & Coordination</p>
            <p style="text-align:center; font-size:14px;">    Drug Regulatory Authority Of Pakistan</p>
            <p style="text-align:center; font-size:14px;">    <b>*****************</b></p>
            <div style="text-align:center; font-size:14px;"><b>"SAY NO TO CORRUPTION"</b></div>
            '.$comp.'
            </div>
            <br><br>
            </center>

            */
			
            $html = '
			
            <center>
                <table>
                <tr>
                    <td>
                        <center>
                        <table >
                        ';
                        $sn=1;
                        if(!empty($data['records']))
                        {
                            foreach($data['records'] as $record)
                            {
                        
						if($record->roleId == 26){
						$html .= '<tr>
                          <td align="right"><h5>Applicant</h5></td>
                        </tr>
						<tr>
						  <td align="right"><small>'.$record->dateTime.'</small></td>
                        </tr>
						<tr>
						  <td align="left"><p style="font-size: 0.80em">'.'1. '.$record->remarks.'</p></td>
                        </tr>
						
						<tr>
						  <td align="left"><h5>'.$record->userName1.'</h5></td>
                        </tr>
						
                        <tr>
						  <td align="left"><h6>'.$record->forwardedRole.'</h6></td>
                        </tr>';
						}else{
							$html .= '<tr>
						  <td align="right"><h5>'.$record->userName.'</h5></td>
                        </tr>
						
						<tr>
						  <td align="right"><h6>'.$record->byRole.'</h6></td>
                        </tr>
						<tr>
						  <td align="right"><small>'.$record->dateTime.($record->isDeleted == 1?"  (Query) ":"").'</small></td>
                        </tr>
						<tr>
						  <td align="left"><p style="font-size: 0.80em">'.$record->remarks.'</p></td>
                        </tr>
						<br>
						<tr>
						  <td align="left"><h5>'.$record->userName1.'</h5></td>
                        </tr>
						
                        <tr>
						  <td align="left"><h6>'.$record->forwardedRole.'</h6></td>
                        </tr>';
						}
						$html .= '<br>';
						
                        $sn++;
                            }
                        }
                        $html .=  '
                        </table>
                        </center>
                    </td>
                </tr>
                </table>
                </center>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'License Note Sheet Old' && $hasReportRights == 1){
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
			$pdf->setY(2);
            $pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            // $siteAddress = explode(",",$data['records'][0]->siteAddress);
            // $siteCity = end($siteAddress);
            // $sliced = array_slice($siteAddress, 0, -1);
            // $siteAddress = implode(",", $sliced);
            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            $pdf->SetY(1);
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:center; font-size:14px;">Government of Pakistan</p>
            <p style="text-align:center; font-size:14px;">Ministry of National Health Services, Regulations & Coordination</p>
            <p style="text-align:center; font-size:14px;">Drug Regulatory Authority Of Pakistan</p>
            <p style="text-align:center; font-size:14px;"><b>*****************</b></p>
            <div style="text-align:center; font-size:14px;"><b>"SAY NO TO CORRUPTION"</b></div>
            </div>
            <br>

            </center>
            <center>
                <table>
                <tr>
                    <td>
                        <center>
                        <table border="1" style="padding:3px;border:1px solid #000;">
                        <tr>
                          <th width="5%" align="left">S.#</th>
                          <th width="15%" align="left">Date</th>
                          <th width="20%" align="left">From</th>
                          <th width="20%" align="left">Forwarded To</th>
                          <th width="20%" align="left">Remarks</th>
                          <th width="20%" align="left">Status</th>
                        </tr>';
                        $sn=1;
                        if(!empty($data['records']))
                        {
                            foreach($data['records'] as $record)
                            {
                        $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="center">'.$record->dateTime.'</td>
                          <td align="left">'.$record->userName.'</td>
                          <td align="left">'.$record->userName1.'</td>
                          <td align="left">'.$record->remarks.'</td>
                          <td align="center">'.$record->status.'</td>
                        </tr>';
                        $sn++;
                            }
                        }
                        $html .=  '
                        </table>
                        </center>
                    </td>
                </tr>
                </table>
                </center>
            
            ';
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'Grant of License Panel of Inspector' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>Director QA & LT</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan TF Complex, G/9-4</b></p>
            <p style="text-align:left; font-size:12px;"><b>Islamabad.</b></p>
            </div>
            </center>
            <div style="line-height:-5%;">
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>GRANT OF DRUG MANUFACTURING LICENSE - INSPECTION THEREOF</u></b></p>
            </div>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to say that <b>'.$data['records'][0]->companyName.' '.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> has informed that their unit is ready for inspection for the purpose of grant of Drug Manufacturing License by way of '.$data['records'][0]->licenseSubType.' for following '.(($data['records'][0]->licenseTypeId == 1 || $data['records'][0]->licenseTypeId == 2)?'API':'Sections').': -</p>
            <br><br>
            ';
            if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Section</b></th>
                          <th width="30%" align="left"><b>Pharmacological Group</b></th>
                          <th width="30%" align="left"><b>Used For</b></th>
                        </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['sections'])) {
                    foreach ($data['recordsDetail']['sections'] as $record) {
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';
            }
                else {
                    $html .= '
                            <center>
                                <ol>
                                <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                                <tr>
                                  <th width="5%" align="left"><b>S.#</b></th>
                                  <th width="95%" align="left"><b>API Name</b></th>
                                </tr>';
                       $sn = 1;
                       if (!empty($data['recordsDetail']['api'])) {
                           foreach ($data['recordsDetail']['api'] as $record) {
                               $html .= '<tr>
                                  <td align="center">' . $sn . '</td>
                                  <td align="left">' . $record->apiName . '</td>
                                </tr>';
                               $sn++;
                           }
                       }
                       $html .= '
                                </table>
                                </ol>
                                </center>';
                }
            $html .= '
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Following panel is constituted under rule 8(17) read with rule 10(1) and (2) of the Drugs (Licensing, Registration and Advertising) Rules, 1976.</p>
            <ol><p style="font-size:12px;">'.$data['records'][0]->panelOfInspector1.'</p></ol>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The panel inspection report should be furnished with clear, candid and definite recommendations on the evaluation form, section wise and installation of HVAC system. List of machinery / equipments, Q.C instruments, list of technical staff should also be annexed with the inspection report.</p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requested to direct the Federal Inspector of Drugs to coordinate with the panel members for conducting inspection and furnish report thereof within stipulated time.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

            }
        if($reportType == 'Renewal of License Panel of Inspector' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>Director QA & LT</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan TF Complex, G/9-4</b></p>
            <p style="text-align:left; font-size:12px;"><b>Islamabad.</b></p>
            </div>
            </center>
            <div style="line-height:0%; margin-top: -5%">
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>RENEWAL OF DRUG MANUFACTURING LICENSE DML NO.'.$data['records'][0]->licenseNoManual.' - INSPECTION THEREOF</u></b></p>
            
            </div>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to say that <b>'.$data['records'][0]->companyName.' '.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b>, having DML No. '.$data['records'][0]->licenseNoManual.' ('.strtoupper($data['records'][0]->licenseSubType).') is due w.e.f '.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->validTill)))).'. The firm has informed that their unit is ready for inspection for the purpose of grant of renewal Drug Manufacturing License by way of '.$data['records'][0]->licenseSubType.' for following '.(($data['records'][0]->licenseTypeId == 1 || $data['records'][0]->licenseTypeId == 2)?'API':'Sections').': -</p>
            <br><br>
            ';
                if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                    $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Section</b></th>
                          <th width="30%" align="left"><b>Pharmacological Group</b></th>
                          <th width="30%" align="left"><b>Used For</b></th>
                        </tr>';
                    $sn = 1;
                    if (!empty($data['recordsDetail']['sections'])) {
                        foreach ($data['recordsDetail']['sections'] as $record) {
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                            $sn++;
                        }
                    }
                    $html .= '
                        </table>
                        </ol>
                        </center>';
                }
                else {
                    $html .= '
                            <center>
                                <ol>
                                <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                                <tr>
                                  <th width="5%" align="left"><b>S.#</b></th>
                                  <th width="95%" align="left"><b>API Name</b></th>
                                </tr>';
                    $sn = 1;
                    if (!empty($data['recordsDetail']['api'])) {
                        foreach ($data['recordsDetail']['api'] as $record) {
                            $html .= '<tr>
                                  <td align="center">' . $sn . '</td>
                                  <td align="left">' . $record->apiName . '</td>
                                </tr>';
                            $sn++;
                        }
                    }
                    $html .= '
                                </table>
                                </ol>
                                </center>';
                }
                $html .= '
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Following panel is constituted under rule 8(17) read with rule 10(1) and (2) of the Drugs (Licensing, Registration and Advertising) Rules, 1976.</p>
            <ol><p style="font-size:12px;">'.$data['records'][0]->panelOfInspector1.'</p></ol>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The panel inspection report should be furnished with clear, candid and definite recommendations on the evaluation form, section wise and installation of HVAC system. List of machinery / equipments, Q.C instruments, list of technical staff should also be annexed with the inspection report.</p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requested to direct the Federal Inspector of Drugs to coordinate with the panel members for conducting inspection and furnish report thereof within stipulated time.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

            }
        if($reportType == 'All License Note Sheet' && $hasReportRights == 1)/* Done */{

                $data['allrecords'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

                if(!isset($data['allrecords'][0])){
                    die();
                }

                $style = array(
                    'border' => 2,
                    'vpadding' => 2, //'auto',
                    'hpadding' => 2, //'auto',
                    'fgcolor' => array(0,0,0),
                    'bgcolor' => false, //array(255,255,255)
                    'module_width' => 1, // width of a single module in points
                    'module_height' => 1 // height of a single module in points
                );

            $html = '';
            $counter = 1;
            $totallic = count($data['allrecords']);
                foreach ($data['allrecords'] as $allrecord) {
                    $datarecords = $this->loginModel->$functionName('License Note Sheet', $allrecord->id, $parameters, 'Main');
                   // if (!empty($datarecords)) {

                        // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
                        //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
                        //$pdf->SetY(1);
                        $comp = (@$datarecords[0]->roleId == 26) ? '<h4 style="text-align:center; font-size:14px;">' . $allrecord->companyName . '</h4>' : '';
                        $pdf->isnotesheet = true;
                        $pdf->licfileno = $allrecord->licFileNo;
                        $pdf->compName = $allrecord->companyName . ' ' . $allrecord->siteAddress;
                        //$pdf->compSite = $data['records'][0]->siteAddress;
                        $html .= '
                    <center>
                    <div style="line-height:80%;">';
                        if($allrecord->postchangeTypeId != null){
                            $html.='<div style="font-size:14px;"><b>' . $allrecord->postlicenseType . ' (' . $allrecord->postlicenseSubType . ' )(Ref No ' . $allrecord->id . ')</b></div>';

                        }else if($allrecord->renewalTypeId != null){
                            $html.='<div style="font-size:14px;"><b> Renewal' . $allrecord->licenseType . ' (' . $allrecord->licenseSubType . ' )(Ref No ' . $allrecord->id . ')</b></div>';
                        }else{
                            $html.='<div style="font-size:14px;"><b>' . $allrecord->licenseType . ' (' . $allrecord->licenseSubType . ' )(Ref No ' . $allrecord->id . ')</b></div>';
                        }
                    $html .= '
                    </div>
                    <br><br>
                    </center>
			
            <center>
                <table>
                <tr>
                    <td>
                        <center>
                        <table >
                        ';
                        $sn = 1;
                        if (!empty($datarecords)) {
                            foreach ($datarecords as $record) {

                                if ($record->roleId == 26) {
                                    $html .= '<tr>
                          <td align="right"><h5>Applicant</h5></td>
                        </tr>
						<tr>
						  <td align="right"><small>' . $record->dateTime . '</small></td>
                        </tr>
						<tr>
						  <td align="left"><p style="font-size: 0.80em">' . '1. ' . $record->remarks . '</p></td>
                        </tr>
						
						<tr>
						  <td align="left"><h5>' . $record->userName1 . '</h5></td>
                        </tr>
						<tr>
						  <td align="left"><h6>' . $record->user2designation . ' ' . $record->user2department . '</h6><br></td>
                        </tr>';
                                } else {
                                    $html .= '<tr>
						  <td align="right"><h5>' . $record->userName . '</h5></td>
                        </tr>
						<tr>
						  <td align="right"><h6>' . $record->user1designation . ' ' . $record->user1department . '</h6></td>
                        </tr>
						<tr>
						  <td align="right"><small>' . $record->dateTime . ($record->isDeleted == 1 ? "  (Query) " : "") . '</small></td>
                        </tr>
						<tr>
						  <td align="left"><p style="font-size: 0.80em">' . $record->remarks . '</p></td>
                        </tr>
						<br>
						<tr>
						  <td align="left"><h5>' . $record->userName1 . '</h5></td>
                        </tr>
						<tr>
						  <td align="left"><h6>' . $record->user2designation . ' ' . $record->user2department . '</h6></td>
                        </tr>';
                                }
                                $html .= '<br>';

                                $sn++;
                            }
                        }
                        $html .= '
                        </table>
                        </center>
                    </td>
                </tr>
                </table>
                </center>
            
            ';
                        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
                        if ($counter < $totallic) {
                            $counter++;
                            $html .= '<div style="clear: both;page-break-after: always;"> </div>';

                        }
                    //}

                }

            }
        if($reportType == 'Inspection Request Panel of Inspector' && $hasReportRights == 1) /* Done */{


            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
			$html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>Director QA & LT</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan TF Complex, G/9-4</b></p>
            <p style="text-align:left; font-size:12px;"><b>Islamabad.</b></p>
            </div>
            </center>
            <div style="line-height:-5%;">
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>GRANT OF AMENDMENTS IN FACILITIES - INSPECTION THEREOF</u></b></p>
            </div>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to say that <b>'.$data['records'][0]->companyName.' '.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> has informed that their unit is ready for inspection for ammendments in facilitates after beinconstructed in the ligh of layout plan approved by the Competent Authority for the aforsaid area. -</p>
            <br>
            ';
            if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="10%" align="left"><b>S.#</b></th>
                          <th width="40%" align="left"><b>Section</b></th>
                          <th width="25%" align="left"><b>Pharmacological Group</b></th>
                          <th width="25%" align="left"><b>Used For</b></th>
                        </tr>';

                $sn = 1;
                if (!empty($data['recordsDetail']['sections'])) {
                    foreach ($data['recordsDetail']['sections'] as $record) {
                        if($record->isInspection == 'Yes' && $record->section != '' && $record->section != null) {
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                            $sn++;
                        }
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';
            }
            else {
                $html .= '<center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>API Name</b></th>
                        </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['api'])) {
                    foreach ($data['recordsDetail']['api'] as $record) {
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->apiName . '</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>Facility/Section Name</b></th>
                        </tr>';
                $sn = 1;
                if (!empty($data['recordsDetail']['facility'])) {
                    foreach ($data['recordsDetail']['facility'] as $record) {
                        $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->facilityname . '</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .= '
                        </table>
                        </ol>
                        </center>';
            }

                        $html .=  '
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Following panel is constituted under rule 8(17) read with rule 10(1) and (2) of the Drugs (Licensing, Registration and Advertising) Rules, 1976.'.$data['records'][0]->panelOfInspector1.'</p>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The panel inspection report should be furnished with clear, candid and definite recommendations on the evaluation form, section wise and installation of HVAC system. List of machinery / equipments, Q.C instruments, list of technical staff should also be annexed with the inspection report.</p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requested to direct the Federal Inspector of Drugs to coordinate with the panel members for conducting inspection and furnish report thereof within stipulated time.</p>
            </div>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
        
        }
        if($reportType == 'License Report' && $hasReportRights == 1) /* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->reportdate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.', '.(($this->loginModel->getCityName($data['records'][0]->siteCity))?$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName:'').'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->licenseSubType.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->phase.' - '.$data['records'][0]->licenseStatus.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>Lic No. '.$data['records'][0]->licenseNoManual.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>File No. '.$data['records'][0]->licFileNo.'</b></p>

            </div>
            </center>
            <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Management Team</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="border:1px solid #000; font-size:12px; ">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="25%" align="left"><b>Name</b></th>
                          <th width="20%" align="left"><b>NIC</b></th>
                          <th width="25%" align="left"><b>Designation</b></th>
                          <th width="25%" align="left"><b>Remarks</b></th>
                        </tr>';
                $sn=1;
                if(!empty($data['recordsDetail']['management']))
                {
                    foreach($data['recordsDetail']['management'] as $record)
                    {
                        $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->name.'</td>
                          <td align="left">'.$record->nic.'</td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left">'.$record->remarks.'</td>
                        </tr>';
                        $sn++;
                    }
                }
                $html .=  '
                        </table>
                        </ol>
                        </center>';
           if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
               $html .= '
            <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Sections</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="30%" align="left"><b>Section</b></th>
                          <th width="20%" align="left"><b>Pharmacological Group</b></th>
                          <th width="20%" align="left"><b>Used For</b></th>
                          <th width="25%" align="left"><b>Remarks</b></th>
                        </tr>';

               $sn = 1;
               if (!empty($data['recordsDetail']['sections'])) {
                   foreach ($data['recordsDetail']['sections'] as $record) {
                       $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                          <td align="left">' . $record->remarks . '</td>
                        </tr>';
                       $sn++;
                   }
               }
               $html .= '
                        </table>
                        </ol>
                        </center>';
           }
           else {
               $html .= ' <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>API</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="40%" align="left"><b>API Name</b></th>
                          <th width="55%" align="left"><b>Remarks</b></th>
                        </tr>';
               $sn = 1;
               if (!empty($data['recordsDetail']['api'])) {
                   foreach ($data['recordsDetail']['api'] as $record) {
                       $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->apiName . '</td>
                          <td align="left">' . $record->remarks . '</td>
                        </tr>';
                       $sn++;
                   }
               }
               $html .= '
                        </table>
                        </ol>
                        </center>
                        <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Facility/Section</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="40%" align="left"><b>Facility/Section Name</b></th>
                          <th width="55%" align="left"><b>Remarks</b></th>
                        </tr>';
               $sn = 1;
               if (!empty($data['recordsDetail']['facility'])) {
                   foreach ($data['recordsDetail']['facility'] as $record) {
                       $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->facilityname . '</td>
                          <td align="left">' . $record->remarks . '</td>
                        </tr>';
                       $sn++;
                   }
               }
               $html .= '
                        </table>
                        </ol>
                        </center>';
           }
            $html .= '<div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Qualified Staff</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="30%" align="left"><b>Name</b></th>
                          <th width="20%" align="left"><b>NIC</b></th>
                          <th width="20%" align="left"><b>Designation</b></th>
                          <th width="25%" align="left"><b>Remarks</b></th>
                        </tr>';
            $sn=1;
            if(!empty($data['recordsDetail']['staff']))
            {
                foreach($data['recordsDetail']['staff'] as $record)
                {
                    $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->name.'</td>
                          <td align="left">'.$record->nic.'</td>
                          <td align="left">'.$record->designation.'</td>
                          <td align="left">'.$record->remarks.'</td>
                        </tr>';
                    $sn++;
                }
            }
            $html .=  '
                        </table>
                        </ol>
                        </center>
           </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

            }
        if($reportType == 'License History' && $hasReportRights == 1) /* Done */{
                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

                $counter = 1;
                $totalhistory = count($data['recordsDetail']);
                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '';
                foreach ($data['recordsDetail'] as $recordDetail){
                    $allinfo = json_decode($recordDetail->recordLog);
                    $license = $allinfo->license[0];

                    $licmanagement = $allinfo->Management;
                    $licsections = $allinfo->Sections;
                    $licapi = $allinfo->API;
                    $licstaff = $allinfo->Staff;
                    $licmachines = $allinfo->Machines;
                    $licfacility = $allinfo->Facility;
                    //pre($licstaff);
                    $html .= '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Submission Date <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($recordDetail->createddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>'.$recordDetail->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$license->siteAddress.', '.(($this->loginModel->getCityName($license->siteCity))?$this->loginModel->getCityName($license->siteCity)[0]->cityName:'').'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$recordDetail->licenseSubType.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$license->phase.' - '.$license->licenseStatus.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>Lic No. '.$license->licenseNoManual.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>File No. '.$license->licFileNo.'</b></p>

            </div>
            </center>
            ';
            if(!empty($licmanagement)) {
                $html .= '
            <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Management Team</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="border:1px solid #000; font-size:12px; ">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="35%" align="left"><b>Name</b></th>
                          <th width="30%" align="left"><b>NIC</b></th>
                          <th width="30%" align="left"><b>Designation</b></th>
                        </tr>';
                $sn = 1;

                foreach ($licmanagement as $record) {
                    $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->name . '</td>
                          <td align="left">' . $record->nic . '</td>
                          <td align="left">' . $record->designation . '</td>
                        </tr>';
                    $sn++;
                }

                $html .= '
                        </table>
                        </ol>
                        </center>';
            }
                    if(($license->licenseTypeId != 1 && $license->licenseTypeId != 2)) {
                        $html .= '
            <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Sections</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="45%" align="left"><b>Section</b></th>
                          <th width="25%" align="left"><b>Pharmacological Group</b></th>
                          <th width="25%" align="left"><b>Used For</b></th>
                        </tr>';

                        $sn = 1;
                        if (!empty($licsections)) {
                            foreach ($licsections as $record) {
                                $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . (($this->loginModel->getRecord('tbl_section','id',$record->sectionId))?$this->loginModel->getRecord('tbl_section','id',$record->sectionId)[0]->section:'') . '</td>
                          <td align="left">' . (($this->loginModel->getRecord('tbl_pharmagroup','id',$record->pharmaGroupId))?$this->loginModel->getRecord('tbl_pharmagroup','id',$record->pharmaGroupId)[0]->pharmaGroup:'') . '</td>
                          <td align="left">' . (($this->loginModel->getRecord('tbl_usedfor','id',$record->usedForId))?$this->loginModel->getRecord('tbl_usedfor','id',$record->usedForId)[0]->usedFor:'') . '</td>
                        </tr>';
                                $sn++;
                            }
                        }
                        $html .= '
                        </table>
                        </ol>
                        </center>';
                    }
                    else {
                        $html .= ' <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>API</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>API Name</b></th>
                        </tr>';
                        $sn = 1;
                        if (!empty($licapi)) {
                            foreach ($licapi as $record) {
                                $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->apiName . '</td>
                        </tr>';
                                $sn++;
                            }
                        }
                        $html .= '
                        </table>
                        </ol>
                        </center>
                        <div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Facility/Section</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>Facility/Section Name</b></th>
                        </tr>';
                        $sn = 1;
                        if (!empty($licfacility)) {
                            foreach ($licfacility as $record) {
                                $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->facilityname . '</td>
                        </tr>';
                                $sn++;
                            }
                        }
                        $html .= '
                        </table>
                        </ol>
                        </center>';
                    }
                    $html .= '<div style="line-height:-5%;">
            <p style="font-size:12px;"><b><u>Qualified Staff</u></b></p>
            </div>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="15%" align="left"><b>Name</b></th>
                          <th width="20%" align="left"><b>NIC</b></th>
                          <th width="20%" align="left"><b>Designation</b></th>
                          <th width="20%" align="left"><b>Qualification</b></th>
                          <th width="20%" align="left"><b>Specialization</b></th>
                        </tr>';
                    $sn=1;
                    if(!empty($licstaff))
                    {
                        foreach($licstaff as $record)
                        {
                            $html .= '<tr>
                          <td align="center">'.$sn.'</td>
                          <td align="left">'.$record->name.'</td>
                          <td align="left">'.$record->nic.'</td>
                          <td align="left">'.(($this->loginModel->getRecord('tbl_companydesignation','id',$record->designationId))?$this->loginModel->getRecord('tbl_companydesignation','id',$record->designationId)[0]->designation:'').'</td>
                          <td align="left">'.(($this->loginModel->getRecord('tbl_companyqualification','id',$record->qualificationId))?$this->loginModel->getRecord('tbl_companyqualification','id',$record->qualificationId)[0]->qualification:'').'</td>
                          <td align="left">'.(($this->loginModel->getRecord('tbl_companyspecialization','id',$record->specializationId))?$this->loginModel->getRecord('tbl_companyspecialization','id',$record->specializationId)[0]->specialization:'').'</td>
                        </tr>';
                            $sn++;
                        }
                    }
                    $html .=  '
                        </table>
                        </ol>
                        </center>
           </div>
            <br><br>
            ';
                    if($counter < $totalhistory){
                        $counter++;
                        $html.='<div style="clear: both;page-break-after: always;"> </div>';
                    }
                }
            }
        if($reportType == 'Renewal Approval Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->barcode_no = $data['records'][0]->rniRefNo;
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b></p>
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>APPROVAL OF LICENSE</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above and convey you the approval of the site located at  <b>'.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> for the establishment of a pharmaceutical unit. You are required to submit the layout plan as per following details: </p>

            <ol type="i" style="font-size:12px;">
            <li>A detailed building layout (in duplicate), for pre-approval in accordance with the paragraph 2 of Section 1 of Schedule-B, under the Drugs (Licensing, Registering & Advertising) Rules 1976. The layout plan must comply with the Good Manufacturing Practices as laid down under the aforesaid rules.</li>
            <li>Provision of HVAC system may be given in the layout plan. </li>
            <li>Section wise detail of covered areas.</li>
            <li>Fee @ of Rs. 6500/- per section as mentioned in the layout plan to be deposited under the head of A/C No. 0010008463-700018 in Allied Bank Limited. </li>
            <li>Men and material flow may be intimated in different colored arrows.</li>
            </ol>
             
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;After an examination of the layout plan, if needed, you may be advised to send your technical expert(s) to explain and discuss the same in person. The approval of the proposed plan by the Central Licensing Board shall be subject to its confirmation to the Good Manufacturing Practices requirements.  </p>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The approval of the building layout shall be subjected to the conformity of parameters of building and environment safety and other safety measures and by the relevant controlling authority.   </p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This letter in no way is considered as right for approval of layout plan and grant of Drug Manufacturing License. Same shall be processed under the Drug Act, 1976 and Drugs (Licensing, Registering & Advertisement) Rules, 1976 accordingly after fulfillment of legal requirements.  </p>
            
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getUser($data['records'][0]->renewalApprovedBy)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'License Agenda' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $parameters['myId'] = @$data['records'][0]->id;
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');

            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td><h3 style="text-align:center;"><b>Agenda</b></h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">___ MEETING OF</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">CENTRAL LICENSING BOARD</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">To be held on ___</h3></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>Venue: </b>Committee Room, Drug Regulatory Authority of Pakistan, ___</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>A. New License</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Grant of License</td>
                  <td align="right">4</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>B. License Renewal</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">1</td>
                  <td align="left">License Renewal</td>
                  <td align="right">2</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>C. License Variance</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">1</td>
                  <td align="left">Company Management</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Layout Plan</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">3</td>
                  <td align="left">Company Name</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">4</td>
                  <td align="left">Technical Staff</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">5</td>
                  <td align="left">Grant/Changes of API</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">6</td>
                  <td align="left">Misc. (Grant of Inspection Book)</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">7</td>
                  <td align="left">Misc. (Attestation of License)</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">8</td>
                  <td align="left">Repacking</td>
                  <td align="right">12</td>
                </tr>
                <tr>
                  <td align="center">9</td>
                  <td align="left">Request for Inspection</td>
                  <td align="right">2</td>
                </tr>
                </table>
                </center>
                <p><br><br></p>
                <center>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="10%" align="center"><b>Date</b></th>
                  <th width="10%" align="center"><b>Type</b></th>
                  <th width="15%" align="center"><b>Company</b></th>
                  <th width="10%" align="center"><b>Sub Type</b></th>
                  <th width="10%" align="center"><b>Site Address</b></th>
                  <th width="10%" align="center"><b>Reviewer Remarks</b></th>
                  <th width="10%" align="center"><b>Inspector Remarks</b></th>
                  <th width="10%" align="center"><b>Inspector Ranking</b></th>
                  <th width="10%" align="center"><b>Phase</b></th>
                </tr>';
                $sn=1;
                if(!empty($data['records']))
                {
                    foreach($data['records'] as $record)
                    {
                $html .= '<tr>
                  <td rowspan="3" align="center">'.$sn.'</td>
                  <td align="left">'.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->submissionDate)))).'</td>
                  <td align="left">'.$record->type.'</td>
                  <td align="left">M/s '.$record->companyName.' ('.$record->licenseNoManual.')</td>
                  <td align="left">'.$record->mySubType.'</td>
                  <td align="left">'.$record->siteAddress.'</td>
                  <td align="left">'.$record->finalRemarksShowToCompany.'</td>
                  <td align="left">'.$record->panelRemarks.'</td>
                  <td align="left">'.$record->rating.'</td>
                  <td align="left">'.$record->phase.'</td>
                </tr>
                <tr>
                  <td colspan="8">
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="35%" align="left"><b>Section</b></th>
                      <th width="30%" align="left"><b>Pharmacological Group</b></th>
                      <th width="30%" align="left"><b>Used For</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail']))
                    {
                        foreach($data['recordsDetail'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->section.'</td>
                      <td align="left">'.$record1->pharmaGroup.'</td>
                      <td align="left">'.$record1->usedFor.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td colspan="9">
                    <b>Recommendations of the panel:-</b>
                    <br><br>
                    _____________________________
                    <br><br>
                    <b>The case is hereby submitted for consideration and orders of the Board, please.</b>
                  </td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Registration Agenda' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $parameters['myId'] = @$data['records'][0]->id;
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
            $data['recordsDetail1'] = $this->loginModel->$functionName('Registration Agenda1', $id, $parameters, 'Detail');


            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td><h3 style="text-align:center;"><b>Agenda</b></h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">___ MEETING OF</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">REGISTRATION BOARD</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">To be held on ___</h3></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>Venue: </b>Committee Room, Drug Regulatory Authority of Pakistan, ___</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>A. New Registration</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Biological</td>
                  <td align="right">4</td>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Pharmaceutical</td>
                  <td align="right">4</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>B. Registration Renewal</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">1</td>
                  <td align="left">Registration Renewal</td>
                  <td align="right">2</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>C. Registration Variance</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                </table>
                </center>
                <p><br><br></p>
                <center>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="30%" align="center"><b>Concern</b></th>
                  <th width="65%" align="center"><b>Data</b></th>
                </tr>';
                $sn=1;
                if(!empty($data['records']))
                {
                    foreach($data['records'] as $record)
                    {
                $html .= '
                <tr>
                  <td rowspan="26" align="center">'.$sn.'</td>
                  <td align="left">Ref. No. and date of submission</td>
                  <td align="left">'.$record->rniRefNo.' / '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->submissionDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Details of fee submitted</td>
                  <td align="left">'.$record->rgFeeAmount.' - '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->rgDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of Applicant / Importer</td>
                  <td align="left">'.$record->companyName.'<br>'.$record->siteAddress.'<br>'.$record->siteCity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of Drug Sale License of Importer</td>
                  <td align="left">'.$record->dslNo.'<br>'.$record->dslValidityDate.'</td>
                </tr>
                <tr>
                  <td align="left">Name and address of marketing authorization holder (abroad)</td>
                  <td align="left">'.$record->internationalRefMAHolder.'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of manufacturer(s)</td>
                  <td align="left">'.$record->manufacturerDetail.'</td>
                </tr>
                <tr>
                  <td align="left">Name of exporting country (Import Case)</td>
                  <td align="left">'.$record->exportingCountry.'</td>
                </tr>
                <tr>
                  <td align="left">Detail of certificates attached (CoPP, Freesale certificate, GMP certificate) (Import Case)</td>
                  <td align="left">COPP No.'.$record->coppNo.'<br> COPP Issuing Authority'.$record->coppIssuingAuthority.'<br> COPP Date of Issue'.$record->coppDateOfIssue.'<br> COPP Validity'.$record->coppValidity.'<br> FSC No.'.$record->fscNo.'<br> FSC Issuing Authority'.$record->fscIssuingAuthority.'<br> FSC Date of Issue'.$record->fscDateOfIssue.'<br> FSC Validity'.$record->fscValidity.'<br> GMP No.'.$record->gmpNo.'<br> GMP Issuing Authority'.$record->gmpIssuingAuthority.'<br> GMP Date of Issue'.$record->gmpDateOfIssue.'<br> GMP Validity'.$record->gmpValidity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of letter of authorization / sole agency agreement (Import Case)</td>
                  <td align="left">'.$record->detailsOfLetterOfAuthorization.'</td>
                </tr>
                <tr>
                  <td align="left">Status of the applicant</td>
                  <td align="left">'.$record->companySubCategory.'</td>
                </tr>
                <tr>
                  <td align="left">Status of application</td>
                  <td align="left">'.$record->mySubType.'</td>
                </tr>
                <tr>
                  <td align="left">Intended use of pharmaceutical product</td>
                  <td align="left">'.$record->intendedUse.'</td>
                </tr>
                <tr>
                  <td align="left">For imported products, specify one the these</td>
                  <td align="left">'.$record->productOrigin.'</td>
                </tr>
                <tr>
                  <td align="left">The proposed proprietary name / brand name</td>
                  <td align="left">'.$record->proposedName1.' | '.$record->proposedName2.' | '.$record->proposedName3.'</td>
                </tr>
                <tr>
                  <td align="left">Strength / concentration of drug of Active Pharmaceutical ingredient (API) per unit</td>
                  <td align="left">'.$record->labelClaim.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmaceutical form of applied drug</td>
                  <td align="left">'.$record->dosageName.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmacotherapeutic Group of (API)</td>
                  <td align="left">'.$record->pharmacoTherapeuticGroup.'</td>
                </tr>
                <tr>
                  <td align="left">Reference to Finished product specifications</td>
                  <td align="left">'.$record->pharmacopeia.'</td>
                </tr>
                <tr>
                  <td>Proposed Pack size and proposed price</td>
                  <td>
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="55%" align="left"><b>Proposed Pack Size</b></th>
                      <th width="40%" align="left"><b>Proposed Price</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail']))
                    {
                        foreach($data['recordsDetail'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->packSize.'</td>
                      <td align="left">'.$record1->proposedPrice.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">The status in reference regulatory authorities</td>
                  <td align="left">'.$record->regulatoryBody.' '.$record->internationalRef3EuropeanCountries.'</td>
                </tr>
                <tr>
                  <td align="left">For generic drugs (me-too status)</td>
                  <td align="left">Domestic Ref. (Brand Name'.$record->domesticRefBrandName.'<br> Domestic Ref. (Registration No.)'.$record->domesticRefRegistrationNo.'<br> Domestic Ref. (Product Holder)'.$record->domesticRefProductHolder.'</td>
                </tr>
                <tr>
                  <td align="left">GMP status of the Finished product manufacturer (Local Case)</td>
                  <td align="left">::Valid/Not Valid::</td>
                </tr>
                <tr>
                  <td align="left">Name and address of API manufacturer.</td>
                  <td align="left">
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="95%" align="left"><b>Manufacturer</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail1']))
                    {
                        foreach($data['recordsDetail1'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->manufacturer.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">Module 1, Module 2, Module 3</td>
                  <td align="left">Submitted</td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Evaluation by PEC:</b>
                    <br><br>
                    '.$record->reviewer1Remarks11.'
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Recommendations of the panel:-</b>
                    <br><br>
                    _____________________________
                    <br><br>
                    <b>The case is hereby submitted for consideration and orders of the Board, please.</b>
                  </td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Registration Renewal Agenda' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $parameters['myId'] = @$data['records'][0]->id;
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
            $data['recordsDetail1'] = $this->loginModel->$functionName('Registration Agenda1', $id, $parameters, 'Detail');
            //$pdf->SetFont('helvetica', '', 12, '', true);
            //$pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));

            // $y_start = $pdf->GetY();
            // $pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=30, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='C');
            //$pdf->SetY(5);

            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td><h3 style="text-align:center;"><b>Agenda</b></h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">___ MEETING OF</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">REGISTRATION BOARD</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">To be held on ___</h3></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>Venue: </b>Committee Room, Drug Regulatory Authority of Pakistan, ___</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>A. New Registration</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Biological</td>
                  <td align="right">4</td>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Pharmaceutical</td>
                  <td align="right">4</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>B. Registration Renewal</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">1</td>
                  <td align="left">Registration Renewal</td>
                  <td align="right">2</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>C. Registration Variance</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                </table>
                </center>
                <p><br><br></p>
                <center>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="30%" align="center"><b>Concern</b></th>
                  <th width="65%" align="center"><b>Data</b></th>
                </tr>';
                $sn=1;
                if(!empty($data['records']))
                {
                    foreach($data['records'] as $record)
                    {
                $html .= '
                <tr>
                  <td rowspan="26" align="center">'.$sn.'</td>
                  <td align="left">Ref. No. and date of submission</td>
                  <td align="left">'.$record->rniRefNo.' / '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->submissionDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Details of fee submitted</td>
                  <td align="left">'.$record->rgFeeAmount.' - '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->rgDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of Applicant / Importer</td>
                  <td align="left">'.$record->companyName.'<br>'.$record->siteAddress.'<br>'.$record->siteCity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of Drug Sale License of Importer</td>
                  <td align="left">'.$record->dslNo.'<br>'.$record->dslValidityDate.'</td>
                </tr>
                <tr>
                  <td align="left">Name and address of marketing authorization holder (abroad)</td>
                  <td align="left">'.$record->internationalRefMAHolder.'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of manufacturer(s)</td>
                  <td align="left">'.$record->manufacturerDetail.'</td>
                </tr>
                <tr>
                  <td align="left">Name of exporting country (Import Case)</td>
                  <td align="left">'.$record->exportingCountry.'</td>
                </tr>
                <tr>
                  <td align="left">Detail of certificates attached (CoPP, Freesale certificate, GMP certificate) (Import Case)</td>
                  <td align="left">COPP No.'.$record->coppNo.'<br> COPP Issuing Authority'.$record->coppIssuingAuthority.'<br> COPP Date of Issue'.$record->coppDateOfIssue.'<br> COPP Validity'.$record->coppValidity.'<br> FSC No.'.$record->fscNo.'<br> FSC Issuing Authority'.$record->fscIssuingAuthority.'<br> FSC Date of Issue'.$record->fscDateOfIssue.'<br> FSC Validity'.$record->fscValidity.'<br> GMP No.'.$record->gmpNo.'<br> GMP Issuing Authority'.$record->gmpIssuingAuthority.'<br> GMP Date of Issue'.$record->gmpDateOfIssue.'<br> GMP Validity'.$record->gmpValidity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of letter of authorization / sole agency agreement (Import Case)</td>
                  <td align="left">'.$record->detailsOfLetterOfAuthorization.'</td>
                </tr>
                <tr>
                  <td align="left">Status of the applicant</td>
                  <td align="left">'.$record->companySubCategory.'</td>
                </tr>
                <tr>
                  <td align="left">Status of application</td>
                  <td align="left">'.$record->mySubType.'</td>
                </tr>
                <tr>
                  <td align="left">Intended use of pharmaceutical product</td>
                  <td align="left">'.$record->intendedUse.'</td>
                </tr>
                <tr>
                  <td align="left">For imported products, specify one the these</td>
                  <td align="left">'.$record->productOrigin.'</td>
                </tr>
                <tr>
                  <td align="left">The proposed proprietary name / brand name</td>
                  <td align="left">'.$record->proposedName1.' | '.$record->proposedName2.' | '.$record->proposedName3.'</td>
                </tr>
                <tr>
                  <td align="left">Strength / concentration of drug of Active Pharmaceutical ingredient (API) per unit</td>
                  <td align="left">'.$record->labelClaim.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmaceutical form of applied drug</td>
                  <td align="left">'.$record->dosageName.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmacotherapeutic Group of (API)</td>
                  <td align="left">'.$record->pharmacoTherapeuticGroup.'</td>
                </tr>
                <tr>
                  <td align="left">Reference to Finished product specifications</td>
                  <td align="left">'.$record->pharmacopeia.'</td>
                </tr>
                <tr>
                  <td>Proposed Pack size and proposed price</td>
                  <td>
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="55%" align="left"><b>Proposed Pack Size</b></th>
                      <th width="40%" align="left"><b>Proposed Price</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail']))
                    {
                        foreach($data['recordsDetail'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->packSize.'</td>
                      <td align="left">'.$record1->proposedPrice.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">The status in reference regulatory authorities</td>
                  <td align="left">'.$record->regulatoryBody.' '.$record->internationalRef3EuropeanCountries.'</td>
                </tr>
                <tr>
                  <td align="left">For generic drugs (me-too status)</td>
                  <td align="left">Domestic Ref. (Brand Name'.$record->domesticRefBrandName.'<br> Domestic Ref. (Registration No.)'.$record->domesticRefRegistrationNo.'<br> Domestic Ref. (Product Holder)'.$record->domesticRefProductHolder.'</td>
                </tr>
                <tr>
                  <td align="left">GMP status of the Finished product manufacturer (Local Case)</td>
                  <td align="left">::Valid/Not Valid::</td>
                </tr>
                <tr>
                  <td align="left">Name and address of API manufacturer.</td>
                  <td align="left">
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="95%" align="left"><b>Manufacturer</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail1']))
                    {
                        foreach($data['recordsDetail1'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->manufacturer.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">Module 1, Module 2, Module 3</td>
                  <td align="left">Submitted</td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Evaluation by PEC:</b>
                    <br><br>
                    '.$record->reviewer1Remarks11.'
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Recommendations of the panel:-</b>
                    <br><br>
                    _____________________________
                    <br><br>
                    <b>The case is hereby submitted for consideration and orders of the Board, please.</b>
                  </td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Registration Variance Agenda' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $parameters['myId'] = @$data['records'][0]->id;
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
            $data['recordsDetail1'] = $this->loginModel->$functionName('Registration Agenda1', $id, $parameters, 'Detail');
            //$pdf->SetFont('helvetica', '', 12, '', true);
            //$pdf->Rect(0, 0, $pdf->getPageWidth(), $pdf->getPageHeight(), 'DF', "",  array(247,247,247));

            // $y_start = $pdf->GetY();
            // $pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=30, $type='', $link='', $align='C', $resize=false, $dpi=300, $palign='C');
            //$pdf->SetY(5);

            $html = '
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td><h3 style="text-align:center;"><b>Agenda</b></h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">___ MEETING OF</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">REGISTRATION BOARD</h3></td>
                </tr>
                <tr>
                    <td><h3 style="text-align:center;">To be held on ___</h3></td>
                </tr>
                </table>
                </center>
                <br><br>
                <center>
                <table border="0" style="padding:3px;">
                <tr>
                    <td width="100%" style="text-align:left;"><b>Venue: </b>Committee Room, Drug Regulatory Authority of Pakistan, ___</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>A. New Registration</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Biological</td>
                  <td align="right">4</td>
                </tr>
                <tr>
                  <td align="center">2</td>
                  <td align="left">Pharmaceutical</td>
                  <td align="right">4</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>B. Registration Renewal</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                <tr>
                  <td align="center">1</td>
                  <td align="left">Registration Renewal</td>
                  <td align="right">2</td>
                </tr>
                </table>
                </center>
                <center>
                <p align="center"><b>C. Registration Variance</b></p>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="65%" align="center"><b>Description</b></th>
                  <th width="30%" align="center"><b>No. Of Cases</b></th>
                </tr>
                </table>
                </center>
                <p><br><br></p>
                <center>
                <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                <tr>
                  <th width="5%" align="center"><b>S.#</b></th>
                  <th width="30%" align="center"><b>Concern</b></th>
                  <th width="65%" align="center"><b>Data</b></th>
                </tr>';
                $sn=1;
                if(!empty($data['records']))
                {
                    foreach($data['records'] as $record)
                    {
                $html .= '
                <tr>
                  <td rowspan="26" align="center">'.$sn.'</td>
                  <td align="left">Ref. No. and date of submission</td>
                  <td align="left">'.$record->rniRefNo.' / '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->submissionDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Details of fee submitted</td>
                  <td align="left">'.$record->rgFeeAmount.' - '.date('d-M-y', strtotime(date('Y-m-d', strtotime($record->rgDate)))).'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of Applicant / Importer</td>
                  <td align="left">'.$record->companyName.'<br>'.$record->siteAddress.'<br>'.$record->siteCity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of Drug Sale License of Importer</td>
                  <td align="left">'.$record->dslNo.'<br>'.$record->dslValidityDate.'</td>
                </tr>
                <tr>
                  <td align="left">Name and address of marketing authorization holder (abroad)</td>
                  <td align="left">'.$record->internationalRefMAHolder.'</td>
                </tr>
                <tr>
                  <td align="left">Name, address of manufacturer(s)</td>
                  <td align="left">'.$record->manufacturerDetail.'</td>
                </tr>
                <tr>
                  <td align="left">Name of exporting country (Import Case)</td>
                  <td align="left">'.$record->exportingCountry.'</td>
                </tr>
                <tr>
                  <td align="left">Detail of certificates attached (CoPP, Freesale certificate, GMP certificate) (Import Case)</td>
                  <td align="left">COPP No.'.$record->coppNo.'<br> COPP Issuing Authority'.$record->coppIssuingAuthority.'<br> COPP Date of Issue'.$record->coppDateOfIssue.'<br> COPP Validity'.$record->coppValidity.'<br> FSC No.'.$record->fscNo.'<br> FSC Issuing Authority'.$record->fscIssuingAuthority.'<br> FSC Date of Issue'.$record->fscDateOfIssue.'<br> FSC Validity'.$record->fscValidity.'<br> GMP No.'.$record->gmpNo.'<br> GMP Issuing Authority'.$record->gmpIssuingAuthority.'<br> GMP Date of Issue'.$record->gmpDateOfIssue.'<br> GMP Validity'.$record->gmpValidity.'</td>
                </tr>
                <tr>
                  <td align="left">Details of letter of authorization / sole agency agreement (Import Case)</td>
                  <td align="left">'.$record->detailsOfLetterOfAuthorization.'</td>
                </tr>
                <tr>
                  <td align="left">Status of the applicant</td>
                  <td align="left">'.$record->companySubCategory.'</td>
                </tr>
                <tr>
                  <td align="left">Status of application</td>
                  <td align="left">'.$record->mySubType.'</td>
                </tr>
                <tr>
                  <td align="left">Intended use of pharmaceutical product</td>
                  <td align="left">'.$record->intendedUse.'</td>
                </tr>
                <tr>
                  <td align="left">For imported products, specify one the these</td>
                  <td align="left">'.$record->productOrigin.'</td>
                </tr>
                <tr>
                  <td align="left">The proposed proprietary name / brand name</td>
                  <td align="left">'.$record->proposedName1.' | '.$record->proposedName2.' | '.$record->proposedName3.'</td>
                </tr>
                <tr>
                  <td align="left">Strength / concentration of drug of Active Pharmaceutical ingredient (API) per unit</td>
                  <td align="left">'.$record->labelClaim.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmaceutical form of applied drug</td>
                  <td align="left">'.$record->dosageName.'</td>
                </tr>
                <tr>
                  <td align="left">Pharmacotherapeutic Group of (API)</td>
                  <td align="left">'.$record->pharmacoTherapeuticGroup.'</td>
                </tr>
                <tr>
                  <td align="left">Reference to Finished product specifications</td>
                  <td align="left">'.$record->pharmacopeia.'</td>
                </tr>
                <tr>
                  <td>Proposed Pack size and proposed price</td>
                  <td>
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="55%" align="left"><b>Proposed Pack Size</b></th>
                      <th width="40%" align="left"><b>Proposed Price</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail']))
                    {
                        foreach($data['recordsDetail'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->packSize.'</td>
                      <td align="left">'.$record1->proposedPrice.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">The status in reference regulatory authorities</td>
                  <td align="left">'.$record->regulatoryBody.' '.$record->internationalRef3EuropeanCountries.'</td>
                </tr>
                <tr>
                  <td align="left">For generic drugs (me-too status)</td>
                  <td align="left">Domestic Ref. (Brand Name'.$record->domesticRefBrandName.'<br> Domestic Ref. (Registration No.)'.$record->domesticRefRegistrationNo.'<br> Domestic Ref. (Product Holder)'.$record->domesticRefProductHolder.'</td>
                </tr>
                <tr>
                  <td align="left">GMP status of the Finished product manufacturer (Local Case)</td>
                  <td align="left">::Valid/Not Valid::</td>
                </tr>
                <tr>
                  <td align="left">Name and address of API manufacturer.</td>
                  <td align="left">
                    <table border="1" width="100%" style="padding:3px;border:1px solid #000; font-size:12px;">
                    <tr>
                      <th width="5%" align="left"><b>S.#</b></th>
                      <th width="95%" align="left"><b>Manufacturer</b></th>
                    </tr>';
                    $sn=1;
                    if(!empty($data['recordsDetail1']))
                    {
                        foreach($data['recordsDetail1'] as $record1)
                        {
                    $html .= '<tr>
                      <td align="center">'.$sn.'</td>
                      <td align="left">'.$record1->manufacturer.'</td>
                    </tr>';
                    $sn++;
                        }
                    }
                    $html .=  '
                    </table>
                  </td>
                </tr>
                <tr>
                  <td align="left">Module 1, Module 2, Module 3</td>
                  <td align="left">Submitted</td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Evaluation by PEC:</b>
                    <br><br>
                    '.$record->reviewer1Remarks11.'
                    <br><br>
                  </td>
                </tr>
                <tr>
                  <td colspan="2">
                    <b>Recommendations of the panel:-</b>
                    <br><br>
                    _____________________________
                    <br><br>
                    <b>The case is hereby submitted for consideration and orders of the Board, please.</b>
                  </td>
                </tr>';
                $sn++;
                    }
                }
                $html .=  '
                </table>
                </center>
                <br><br>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'API FPP Shortage' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
            $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');
            $_SESSION['reportType'] = $reportType;
            //$y_start = $pdf->GetY();
            //$pdf->Image(K_PATH_IMAGES.'logo.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=12, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            //$pdf->SetY(9);
            $html = '
            <h3 style="text-align:center;">API FPP Shortage</h3>
            <div style="border-color:#fff;text-align:right;">
                Printed On <b>'.date('Y-m-d').'</b>
                <br>
            </div>
            <center>
            <table>
            <tr>
            <td>
            <center>
            <table border="1" style="padding:3px;border:1px solid #000;">
            <tr>
              <td width="30%" align="left">From Date</td>
              <td width="20%" align="left"><b>'.$parameters['fromDate'].'</b></td>
              <td width="30%" align="right">To Date</td>
              <td width="20%" align="left"><b>'.$parameters['toDate'].'</b></td>
            </tr>
            </table>
            </center>
            <center>
            <table border="1" style="padding:3px;border:1px solid #000;">
            <tr>
              <th width="5%" align="left">S.#</th>
              <th width="25%" align="left">Brand Name</th>
              <th width="30%" align="left">Manufacturer Name</th>
              <th width="20%" align="left">Contact No.</th>
              <th width="20%" align="left">Email</th>
            </tr>';
            $sn=1;
            if(!empty($data['records']))
            {
                foreach($data['records'] as $record)
                {
            $html .= '<tr>
              <td align="center">'.$sn.'</td>
              <td align="left">'.$record->approvedName.'</td>
              <td align="left">'.$record->companyName.'</td>
              <td align="left">'.$record->phone.'</td>
              <td align="left">'.$record->email.'</td>
            </tr>';
            $sn++;
                }
            }
            $html .=  '
            </table>
            </center>
            </td>
            </tr>
            </table>
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        }
        if($reportType == 'Data Authentication License Note Sheet' && $hasReportRights == 1)/* Done */{
			
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
			
			//$pdf->setY(2);
            //$pdf->Image(K_PATH_IMAGES.'logo5.png', '19', '13', PDF_HEADER_LOGO_WIDTH, $h=25, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='');
            // $siteAddress = explode(",",$data['records'][0]->siteAddress);
            // $siteCity = end($siteAddress);
            // $sliced = array_slice($siteAddress, 0, -1);
            // $siteAddress = implode(",", $sliced);
            $style = array(
                'border' => 2,
                'vpadding' => 2, //'auto',
                'hpadding' => 2, //'auto',
                'fgcolor' => array(0,0,0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );
			
            // QRCODE,L : QR-CODE Low error correction (L, M, Q, H)
            //$pdf->write2DBarcode($data['records'][0]->rniRefNo, 'QRCODE,H', 180, 10, 15, 15, $style, 'N');
            //$pdf->SetY(1);
			$comp = (@$data['records'][0]->roleId == 26)?'<h4 style="text-align:center; font-size:14px;">'.$data['records'][0]->companyName.'</h4>':'';
			$pdf->isnotesheet = true;
			//$pdf->licfileno = 'No.F              .'; //$data['records'][0]->licFileNo;
            $pdf->licfileno = $data['records'][0]->licFileNo;
			$pdf->compName = $data['records'][0]->companyName.' '.$data['records'][0]->siteAddress;

			
            $html = '
			
            <center>
                <table>
                <tr>
                    <td>
                        <center>
                        <table >
                        ';
                        $sn=1;
                        if(!empty($data['records']))
                        {
                            foreach($data['records'] as $record)
                            {
								
								//Application Submitted to Drap
								if($record->isDeleted == 1){
									$html .= '<tr>
											  <td align="right"><h5>Applicant</h5></td>
											</tr>
											<tr>
											  <td align="right"><h6>'.$record->companyName.' '.$record->siteAddress.'</h6></td>
											</tr>
											<tr>
											  <td align="right"><small>'.$record->dateTime.'</small></td>
											</tr>
											<tr>
											  <td align="left"><p style="font-size: 0.80em">'.$sn.'. Application submitted to DRAP</p></td>
											</tr>
											<br>
											<tr>
											  <td align="left"><h5>Licensing Division</h5></td>
											</tr>
											<tr>
											  <td align="left"><h6>License Assigning Officer</h6></td>
											</tr>';
								}
								//returned application to company
								else if($record->sendQueryToCompany == 1){
									$user1id = $record->userId;
									//$user2id = $record->forwardedTo;
									
									$data1user1 = $this->loginModel->getuserNameRole($user1id);
									$data2user1 = $this->loginModel->getuserDepartmentDesignation($data1user1[0]->roleId);
									$username1 = $data1user1[0]->userName;
									$user1designation = $data2user1[0]->designation;
									$user1department = $data2user1[0]->department;
									
									//$data1user2 = $this->loginModel->getuserNameRole($user2id);
									//$data2user2 = $this->loginModel->getuserDepartmentDesignation($data1user2[0]->roleId);
									//$username2 = $data1user2[0]->userName;
									//$user2designation = $data2user2[0]->designation;
									//$user2department = $data2user2[0]->department;	
									$html .= '<tr>
											  <td align="right"><h5>'.$username1.'</h5></td>
											</tr>
					
											<tr>
											  <td align="right"><h6>'.$record->byRole.'</h6></td>
											</tr>
											<tr>
											  <td align="right"><small>'.$record->dateTime.'</small></td>
											</tr>
											<tr>
											  <td align="left"> <p style="font-size: 0.80em">'.$sn.'. '.$record->remarks.'</p></td>
											</tr>
											<br>
											<tr>
											  <td align="left"><h5>Applicant</h5></td>
											</tr>
											<tr>
											  <td align="left"><h6>'.$record->companyName.' '.$record->siteAddress.'</h6></td>
											</tr>';
								}
								// Drap internal Communication
								else{
									
									$user1id = $record->userId;
									$user2id = $record->forwardedTo;
									
									$data1user1 = $this->loginModel->getuserNameRole($user1id);
									$data2user1 = $this->loginModel->getuserDepartmentDesignation($data1user1[0]->roleId);
									$username1 = $data1user1[0]->userName;
									$user1designation = $data2user1[0]->designation;
									$user1department = $data2user1[0]->department;
									
									$data1user2 = $this->loginModel->getuserNameRole($user2id);
									$data2user2 = $this->loginModel->getuserDepartmentDesignation($data1user2[0]->roleId);
									$username2 = $data1user2[0]->userName;
									$user2designation = $data2user2[0]->designation;
									$user2department = $data2user2[0]->department;	
									$html .= '<tr>
											  <td align="right"><h5>'.$username1.'</h5></td>
											</tr>
											
											<tr>
											  <td align="right"><h6>'.$record->byRole.'</h6></td>
											</tr>
											<tr>
											  <td align="right"><small>'.$record->dateTime.'</small></td>
											</tr>
											<tr>
											  <td align="left"><p style="font-size: 0.80em">'.$sn.'. '.$record->remarks.'</p></td>
											</tr>
											<br>
											<tr>
											  <td align="left"><h5>'.$username2.'</h5></td>
											</tr>
											
											<tr>
											  <td align="left"><h6>'.$record->forwardRole.'</h6></td>
											</tr>';
								}
                        
						
						$html .= '<br>';
						
                        $sn++;
                            }
                        }
                        $html .=  '
                        </table>
                        </center>
                    </td>
                </tr>
                </table>
                </center>
            
            ';
            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        
        }
        if($reportType == 'Data Authentication Approval Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

            $pdf->licfileno = $data['records'][0]->licFileNo;
			$html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Data Authentication Approval Letter</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pleae refer to your application on the subject cited above. Your data for <b>'.$data['records'][0]->phase.'</b> has been authenticated from the available record. You may file routine applications using PIRIMS for consideration & approval by the DRAP.</p>
            
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getuserNameRole($data['records'][0]->updatedby)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
        
        }
        if($reportType == 'Data Authentication Shortcoming Letter' && $hasReportRights == 1)/* Done */{
            $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');

            $pdf->licfileno = $data['records'][0]->licFileNo;
			//$pdf->barcode_no = $data['records'][0]->rniRefNo;
			//<p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteCity.'</b></p>
            $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('d-M-y', strtotime($data['records'][0]->letterDate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>M/s '.$data['records'][0]->companyName.'</b></p>
            <p style="text-align:left; font-size:12px;"><b>'.$data['records'][0]->siteAddress.'</b></p>
            
            </div>
            <br>

            </center>
            <p style="font-size:12px;">Subject: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><u>Authentication of already processed application</u></b></p>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to refer to your application on the subject cited above. You are required to submit the following documents / information for completion of your application for Data Authentication.</p>
             <ol><p style="font-size:12px;">'.$data['records'][0]->message.'</p></ol>
             <div style="line-height:-80%;">
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;An early response will expedite the process.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$this->loginModel->getuserNameRole($data['records'][0]->queryfrom)[0]->userName.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';
        
        }
        if($reportType == 'Application History' && $hasReportRights == 1) /* Done */{


                $data['records'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Main');
                if($this->userId == 103){
                    pre($data['records'][0]->recordLog );
                    pre(json_decode($data['records'][0]->recordLog));
                }
                die();

                $data['recordsDetail'] = $this->loginModel->$functionName($reportType, $id, $parameters, 'Detail');


                $pdf->licfileno = $data['records'][0]->licFileNo;
                $pdf->barcode_no = $data['records'][0]->rniRefNo;
                $html = '

            <center>
            <div style="line-height:80%;">
            <p style="text-align:right; font-size:12px;">Islamabad,the <b>'.date('d-F-Y', strtotime(date('Y-m-d', strtotime($data['records'][0]->updateddate)))).'</b> </p>
            <p style="text-align:left; font-size:12px;"><b>Director QA & LT</b></p>
            <p style="text-align:left; font-size:12px;"><b>Drug Regulatory Authority of Pakistan TF Complex, G/9-4</b></p>
            <p style="text-align:left; font-size:12px;"><b>Islamabad.</b></p>
            </div>
            </center>
            <div style="line-height:-5%;">
            <p style="font-size:12px;">Subject:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b><u>GRANT OF AMENDMENTS IN FACI
            LITIES - INSPECTION THEREOF</u></b></p>
            </div>
            <p style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am directed to say that <b>'.$data['records'][0]->companyName.' '.$data['records'][0]->siteAddress.', '.$this->loginModel->getCityName($data['records'][0]->siteCity)[0]->cityName.'</b> has informed that their unit is ready for inspection for ammendments in facilitates after beinconstructed in the ligh of layout plan approved by the Competent Authority for the aforsaid area. -</p>
            <br><br>
            ';
                if(($data['records'][0]->licenseTypeId != 1 && $data['records'][0]->licenseTypeId != 2)) {
                    $html .= '
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="10%" align="left"><b>S.#</b></th>
                          <th width="40%" align="left"><b>Section</b></th>
                          <th width="25%" align="left"><b>Pharmacological Group</b></th>
                          <th width="25%" align="left"><b>Used For</b></th>
                        </tr>';

                    $sn = 1;
                    if (!empty($data['recordsDetail']['sections'])) {
                        foreach ($data['recordsDetail']['sections'] as $record) {
                            if($record->isInspection == 'Yes' && $record->section != '' && $record->section != null) {
                                $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->section . '</td>
                          <td align="left">' . $record->pharmaGroup . '</td>
                          <td align="left">' . $record->usedFor . '</td>
                        </tr>';
                                $sn++;
                            }
                        }
                    }
                    $html .= '
                        </table>
                        </ol>
                        </center>';
                }
                else {
                    $html .= '<center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>API Name</b></th>
                        </tr>';
                    $sn = 1;
                    if (!empty($data['recordsDetail']['api'])) {
                        foreach ($data['recordsDetail']['api'] as $record) {
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->apiName . '</td>
                        </tr>';
                            $sn++;
                        }
                    }
                    $html .= '
                        </table>
                        </ol>
                        </center>
                        <center>
                        <ol>
                        <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                        <tr>
                          <th width="5%" align="left"><b>S.#</b></th>
                          <th width="95%" align="left"><b>Facility/Section Name</b></th>
                        </tr>';
                    $sn = 1;
                    if (!empty($data['recordsDetail']['facility'])) {
                        foreach ($data['recordsDetail']['facility'] as $record) {
                            $html .= '<tr>
                          <td align="center">' . $sn . '</td>
                          <td align="left">' . $record->facilityname . '</td>
                        </tr>';
                            $sn++;
                        }
                    }
                    $html .= '
                        </table>
                        </ol>
                        </center>';
                }


                /*
                    $html .='
                            <center>
                            <ol>
                            <table border="1" width="90%" style="padding:3px;border:1px solid #000; font-size:12px;">
                            <tr>
                              <th width="10%" align="left"><b>S.#</b></th>
                              <th width="40%" align="left"><b>Section</b></th>
                              <th width="25%" align="left"><b>Pharmacological Group</b></th>
                              <th width="25%" align="left"><b>Used For</b></th>
                            </tr>';
                            $sn=1;
                            if(!empty($data['recordsDetail']))
                            {
                                foreach($data['recordsDetail'] as $record)
                                {
                            $html .= '<tr>
                              <td align="center">'.$sn.'</td>
                              <td align="left">'.$record->section.'</td>
                              <td align="left">'.$record->pharmaGroup.'</td>
                              <td align="left">'.$record->usedFor.'</td>
                            </tr>';
                            $sn++;
                                }
                            }
                $html .=  '
                            </table>
                            </ol>
                            </center>';

                            */
                $html .=  '
            <p style="font-size:12px;">2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Following panel is constituted under rule 8(17) read with rule 10(1) and (2) of the Drugs (Licensing, Registration and Advertising) Rules, 1976.</p>
            <ol><p style="font-size:12px;">'.$data['records'][0]->panelOfInspector1.'</p></ol>
            <p style="font-size:12px;">3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The panel inspection report should be furnished with clear, candid and definite recommendations on the evaluation form, section wise and installation of HVAC system. List of machinery / equipments, Q.C instruments, list of technical staff should also be annexed with the inspection report.</p>
            <p style="font-size:12px;">4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;You are requested to direct the Federal Inspector of Drugs to coordinate with the panel members for conducting inspection and furnish report thereof within stipulated time.</p>
            </div>
            <br><br>

            <table>
                <tr>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                  <td>
                    <table border="0" style="padding:3px;border:1px solid #fff;float:right;">
                    <tr>
                      <td style="text-align:center;">
                      <br><br>
                      <b>'.$data['records'][0]->assignedOfficer.'</b>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align:center;">
                      Assistant Director (Lic)
                      <br>
                      </td>
                    </tr>
                    </table>
                  </td>
                </tr>
                </table>
            
            ';

            }


            // ---------------------------------------------------------

        // Close and output PDF document
			if($reportType != 'Applicant Registration Certificate'  && $reportType != 'Renewal Applicant Registration Certificate' && $reportType != 'Applicant License Certificate' && $reportType != 'Renewal Applicant License Certificate'){
				$pdf->setting($this->companyNick,$data);
				$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
			}
            if($reportType == 'Product Detail'){
                // Simple watermark
// This will set it to page one and lay over anything written before it on the first page
                $pdf->setPage( 1 );

// Get the page width/height
                $myPageWidth = $pdf->getPageWidth();
                $myPageHeight = $pdf->getPageHeight();

// Find the middle of the page and adjust.
                $myX = ( $myPageWidth / 2 ) - 75;
                $myY = ( $myPageHeight / 2 ) + 25;

// Set the transparency of the text to really light
                $pdf->SetAlpha(0.39);

// Rotate 45 degrees and write the watermarking text
                $pdf->StartTransform();
                $pdf->Rotate(45, $myX, $myY);
                $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 35);
                $pdf->Text($myX, $myY,"Only for data verification purpose");
                $pdf->StopTransform();

// Reset the transparency to default
                $pdf->SetAlpha(1);
            }
		

        //$pdf->Output('example_001.pdf', 'I');
        //ob_end_clean();
		
        $pdf->Output();
        }

        else if($action == 'delete' && $recordDelete == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'save' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else if($myAction == 'update' && $recordSubmit == 1){
            $this->accessDenied();
            return;
        }

        else{
            $this->accessDenied();
            return;
        }
    }
    public function testmail(){

        $mailData = array();
        $userName = "Hello";
        $email = "codegic@gmail.com";
        $mailData['subject'] = ' Working ';
        $mailData['title'] = 'Greetings, '.$userName.'!';
        $mailData['message'] = "Test Message";
        $mailData['email'] = $email;
        pre(emailSend($mailData));

    }

    //################## MAIN FUNCTIONS ##################

}
