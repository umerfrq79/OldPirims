<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = 'login/pageNotFound';
$route['translate_uri_dashes'] = FALSE;

//####################### BASE ROUTES #######################
$route['downloadRegisteredProducts'] = 'myController/generateExcel';
$route['downloadCompanyRegisteredProducts'] = 'myController/generateExcelfile';
$route['drugSearch'] = 'login/registeredDrugSearch';
$route['drugs'] = 'login/drugSearch';
$route['drugDetails/(:any)'] = 'login/registeredDrug/$1';
$route['filterregistration/lookup'] = 'myController/filterRegistration';

$route['testmail'] = 'login/testmail';
$route['verifyChallan'] = 'myController/verifyChallan';
$route['notesheet/(:any)/(:any)'] = 'myController/notesheet/$1/$2';

$route['loginMe'] = 'login/loginMe';
$route['logout'] = 'login/logout';
$route['lockMe'] = 'login/lockMe';
$route['unlockMe'] = 'login/unlockMe';
$route['accessDeniedMain'] = 'login/accessDeniedMain';
// $route['accessDenied'] = 'login/accessDenied';
$route['register'] = 'login/register';
$route['registerCaptcha'] = 'login/registerCaptcha';
$route['registerMe'] = 'login/registerMe';
$route['forgotPassword'] = 'login/forgotPassword';
$route['resetPassword'] = 'login/resetPassword';
$route['generatePassword/(:any)'] = 'login/generatePassword/$1';

$route['structure'] = 'login/structure';

$route['backupDB'] = "login/backupDB";

$route['permission/(:any)'] = 'login/permission/$1';
$route['permission/(:any)/(:num)'] = 'login/permission/$1/$2';

$route['helpdesk/(:any)'] = 'login/helpdesk/$1';
$route['helpdesk/(:any)/(:num)'] = 'login/helpdesk/$1/$2';

$route['setting/(:any)'] = 'login/setting/$1';

$route['profile/(:any)'] = 'login/profile/$1';

$route['user/(:any)'] = 'login/user/$1';
$route['user/(:any)/(:num)'] = 'login/user/$1/$2';

$route['auditlog/(:any)'] = 'login/auditlog/$1';
$route['auditlog/(:any)/(:num)'] = 'login/auditlog/$1/$2';

$route['alert/(:any)'] = 'login/alert/$1';
$route['alert/(:any)/(:num)'] = 'login/alert/$1/$2';

$route['alerts/(:any)'] = 'login/alerts/$1';

$route['inuserecord/(:any)'] = 'login/inuserecord/$1';

$route['report/(:any)'] = "login/report/$1";
$route['report/(:any)/(:any)'] = "login/report/$1/$2";
$route['report/(:any)/(:any)/(:num)'] = "login/report/$1/$2/$3";

$route['userguide/(:any)'] = 'login/userguide/$1';
$route['userguide/(:any)/(:num)'] = 'login/userguide/$1/$2';

$route['company/(:any)'] = 'login/company/$1';
$route['company/(:any)/(:num)'] = 'login/company/$1/$2';

$route['pvmod/(:any)'] = 'PVController/module/$1';
//####################### BASE ROUTES #######################

//####################### COMPANY ROUTES #######################
//-- CTD
$route['applyregistration'] = 'myController/applyregistration';
$route['applyregistrationAdd'] = "myController/applyregistrationAdd";
$route['applyregistrationEdit/(:num)'] = "myController/applyregistrationEdit/$1";
$route['applyregistrationView/(:num)'] = "myController/applyregistrationView/$1";
$route['applyregistrationDelete/(:num)'] = "myController/applyregistrationDelete/$1";
$route['applyregistrationSave'] = "myController/applyregistrationSave";
$route['applyregistrationUpdate'] = "myController/applyregistrationUpdate";



$route['ctdspart/(:num)'] = "myController/ctdspart/$1";
$route['ctdspartview/(:num)'] = "myController/ctdspartview/$1";
$route['ctdspartUpdate'] = "myController/ctdspartUpdate";
// --- CTD


$route['dashboard'] = 'myController/dashboard';
$route['dashboard/(:any)'] = 'myController/dashboard/$1';

$route['dashboardSuper'] = 'myController/dashboardSuper';

$route['uploaddata/(:any)'] = "myController/uploaddata/$1";

//$route['customer/display_medicine_prescription'] = 'customer/display_medicine_prescription/(:any)';
//
//$route["display_medicine_prescription/([0-9]+)/(.*)"] ="customer/display_medicine_prescription";



//$route['importregistration/edit/:num'] = 'myController/importregistration';
//
//$route['importregistration/edit/([0-9]+)/(.*)'] = 'myController/importregistration';

//$route['importregistration/edit/(:any)'] = 'MyController/importregistration/$id';





require_once(BASEPATH .'database/DB.php');
$this->db =& DB();

$this->db->select('BaseTbl.id, BaseTbl.url, BaseTbl.pageName');
$this->db->from('tbls_page as BaseTbl');
$this->db->where('BaseTbl.isDeleted', 0);
$this->db->where('BaseTbl.status', 'Active');
$query = $this->db->get();
$count = $query->num_rows();
if($count === 0){
    $this->session->set_flashdata('error', 'No record found.');
}
if($count > 0){
    foreach ($query->result() as $row){
        $id = $row->id;
        $url = $row->url;
        $pageName = $row->pageName;
        if(strpos($pageName, 'PV-M') !== false){
            $route[$url.'/(:any)'] = 'PVController/'.$url.'/$1';
            $route[$url.'/(:any)/(:num)'] = 'PVController/'.$url.'/$1/$2';
            $route[$url.'/(:any)/(:num)/(:any)/(:num)'] = 'PVController/'.$url.'/$1/$2/$3/$4';

        }else{
            $route[$url.'/(:any)'] = 'myController/'.$url.'/$1';
            $route[$url.'/(:any)/(:num)'] = 'myController/'.$url.'/$1/$2';
            $route[$url.'/(:any)/(:num)/(:any)/(:num)'] = 'myController/'.$url.'/$1/$2/$3/$4';

        }



    }
}



// $route['newlicense/(:any)'] = 'myController/newlicense/$1';
// $route['newlicense/(:any)/(:num)'] = 'myController/newlicense/$1/$2';

// $route['licenserenewal/(:any)'] = 'myController/licenserenewal/$1';
// $route['licenserenewal/(:any)/(:num)'] = 'myController/licenserenewal/$1/$2';

// $route['licensevariance/(:any)'] = 'myController/licensevariance/$1';
// $route['licensevariance/(:any)/(:num)'] = 'myController/licensevariance/$1/$2';
//$route['importregistration/(:num)']['edit'] = 'importregistration/edit/$1';
//
//$route['importregistration/(:num)']['edit'] = 'importregistration/edit/$1';
//
//$route['importregistration/edit/(:num)'] = 'importregistration/edit/$1';
//
// $route['newregistration/(:any)'] = 'myController/newregistration/$1';
// $route['newregistration/(:any)/(:num)'] = 'myController/newregistration/$1/$2';
//
//$route['importregistration/(:any)'] = 'myController/newregistration/$1';
//$route['importregistration/(:any)/(:num)'] = 'myController/newregistration/$1/$2';

// $route['registrationrenewal/(:any)'] = 'myController/registrationrenewal/$1';
// $route['registrationrenewal/(:any)/(:num)'] = 'myController/registrationrenewal/$1/$2';

// $route['registrationvariance/(:any)'] = 'myController/registrationvariance/$1';
// $route['registrationvariance/(:any)/(:num)'] = 'myController/registrationvariance/$1/$2';

// $route['query/(:any)'] = 'myController/query/$1';
// $route['query/(:any)/(:num)'] = 'myController/query/$1/$2';
// $route['query/(:any)/(:num)/(:any)/(:num)'] = 'myController/query/$1/$2/$3/$4';

// $route['agendaandminutes/(:any)'] = 'myController/agendaandminutes/$1';
// $route['agendaandminutes/(:any)/(:num)'] = 'myController/agendaandminutes/$1/$2';

// $route['amc/(:any)'] = 'myController/amc/$1';
// $route['amc/(:any)/(:num)'] = 'myController/amc/$1/$2';

// $route['inspection/(:any)'] = 'myController/inspection/$1';
// $route['inspection/(:any)/(:num)'] = 'myController/inspection/$1/$2';

// $route['inspectionchecklist/(:any)'] = 'myController/inspectionchecklist/$1';
// $route['inspectionchecklist/(:any)/(:num)'] = 'myController/inspectionchecklist/$1/$2';

// $route['capa/(:any)'] = 'myController/capa/$1';
// $route['capa/(:any)/(:num)'] = 'myController/capa/$1/$2';

// $route['panelpool/(:any)'] = 'myController/panelpool/$1';
// $route['panelpool/(:any)/(:num)'] = 'myController/panelpool/$1/$2';


//####################### COMPANY ROUTES #######################

//####################### API ROUTES #######################
$route['api/test'] = 'ApiAuth/test';
$route['apiauth/login'] = 'ApiAuth/login';
$route['apiauth/logout']['post'] = 'ApiAuth/logout';
$route['apidata']['get'] = 'ApiData';
$route['apidata/detail/(:num)']['get'] = 'ApiData/detail/$1';
$route['apidata/create']['post'] = 'ApiData/create';
$route['apidata/update/(:num)']['put'] = 'ApiData/update/$1';
$route['apidata/delete/(:num)']['delete'] = 'ApiData/delete/$1';
$route['api/authentication/login'] = 'api/authentication/login';
$route['api/authentication/test'] = 'api/authentication/test';

//####################### API ROUTES #######################

//####################### Cron Job ROUTES #######################
$route['cronJob/inspectionScheduleToPending'] = 'cronJob/inspectionScheduleToPending';
$route['cronJob/registrationRenewal'] = 'cronJob/registrationRenewal';
$route['cronJob/licenseRenewal'] = 'cronJob/licenseRenewal';
$route['cronJob/backupDB'] = 'cronJob/backupDB';
//####################### Cron Job ROUTES #######################
//new routes

$route['api/Reg/index'] = 'api/RegController/index';

$route['downloadLicSection'] = 'myController/LicGenerateXls';