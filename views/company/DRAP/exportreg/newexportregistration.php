<?php
// if($userInfo[0]->status == 'Completed'){
//   //if($this->userId <> 27){
//   header("Location:".base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
//   exit();
//   //}
// }

$myAction = '';
if(explode('/', $_SERVER['REQUEST_URI'])[2] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[3];
}
if(explode('/', $_SERVER['REQUEST_URI'])[1] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[2];
}
?>
<head>
    <style>
        .suggestbox > ul{
            background-color:#eee;
            cursor:pointer;
        }
        .suggestbox > ul > li{
            padding:12px;
        }
    </style>
</head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName.' (FORM  5)'; ?></h1>
        </div>
        <div class="col-sm-6">
          <h1><a href="<?php if($myAction == 'lookup'){echo base_url();}else{echo base_url().$pageTitle[0]->url.'/lookup';} ?>" style="background-color: #3e8193 !important;" <?php if($myAction == 'add' || $myAction == 'edit'){echo 'onclick="return confirm(\'Changes may not be saved.\')"';} ?> class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Go Back</a></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-8">
      </div>
      <div class="col-md-4 float-right">
        <?php
            if($this->session->flashdata('error'))
            {
        ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-warning"></i> Alert!</h4>
            <?php echo $this->session->flashdata('error'); ?>                    
        </div>
        <?php } ?>
        <?php  
            if($this->session->flashdata('success'))
            {
        ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-check"></i> Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?>
        </div>
        <?php } ?>
        
        <div class="row">
            <div class="col-md-12">
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
      </div>
    </div>
    <?php if($myAction == 'lookup'){ ?>
    <div class="container-fluid">
        <div class="row justify-content-center d-none">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <div class="pull-left">
                            <h6 class="card-title txt-dark">Registered Drug Search - DRAP</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <form action="<?php echo base_url(); ?>importregistration/lookup" method="post" >
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">Search By</label>
                                                <select autofocus class="form-control" name="searchby" id="searchby">
                                                    <option value="1" selected >Registration Number</option>
                                                    <option value="2" <?php echo isset($searchby) && $searchby == 2?'selected':''; ?> >Brand Name</option>
                                                    <option value="3" <?php echo isset($searchby) && $searchby == 3?'selected':''; ?>>Composition</option>
                                                    <option value="4" <?php echo isset($searchby) && $searchby == 4?'selected':''; ?>>Company</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-9 filterbox">
                                            <div class="form-group">
                                                <label for="sstring">Search String</label>
                                                <input autofocus type="text" class="form-control" id="sstring" value="<?php echo isset($searchstring)?$searchstring:''; ?>" name="searchstring">
                                            </div>
                                        </div>

                                        <div class="col-md-9 companyfilter">
                                            <div class="form-group">
                                                <?php $label = 'Company Name'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'companyAccountId'; ?>
                                                <select style="height: inherit" autofocus class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($companies))
                                                    {
                                                        foreach ($companies as $company)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $company->companyUniqueNo ?>" <?php echo isset($companyAccountId) && $companyAccountId == $company->companyUniqueNo?'selected':''; ?> ><?php echo $company->companyName.' -'.$company->licenseNoManual.'- (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="submit" value="Search" class="btn btn-primary" name="" id="">
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lookup</h3>
              <div class="card-tools">
                <?php
                if($this->roleId == 26) {
                    echo '<a href="' . base_url() . $pageTitle[0]->url . '/add' . '" class="btn btn-primary"><i class="fa fa-plus"></i>New Export Registration</a>';
                }
                ?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">

              <?php
                if(isset($records)){
                    ?>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.#</th>
                            <th class="text-center">Pirims Ref. No.</th>
                            <th>Company</th>
                            <?php if($this->companySubCategory <> 'Importer'){?>
                                <!-- <th>Establishment License</th>
                                <th>License No.</th> -->
                            <?php } ?>
                            <th>Registration No.</th>
                            <th>Approved Name</th>
                            <th>Registration Type</th>
                            <th>Registration Form Type</th>
                            <th>Product Origin</th>
                            <th>Product Category</th>
                            <th>Used For</th>

                            <th>Issue Date</th>
                            <th>Renewal Due Date</th>
                            <th>Last Renewal Date</th>
                            <?php
                            if($this->roleId <> 26){
                            ?>
                            <th class="text-center">Assigned User</th>
                            <?php
                            }
                            ?>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sn=1; ?>
                        <?php

                        $CI =& get_instance();
                        if(!empty($records))
                        {

                            foreach($records as $record)
                            {
                                $seenBy = explode(",",$record->seenBy);
                                ?>
                                <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                                    <td><?=$sn?>.</td>
                                    <td class="text-center"><?php echo $record->id; ?></td>
                                    <td>
                                        <?php
                                        $company = $CI->loginModel->getCompany($record->companyAccountId);
                                        echo isset($company[0])?$company[0]->companyName:'';
                                        ?>

                                    </td>
                                    <!--<td><?php //echo $record->companyNTN; ?></td>-->
                                    <?php if($this->companySubCategory <> 'Importer'){?>
                                        <!-- <td><?php echo $record->licenseType.' &mdash; '.$record->licenseSubType; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td> -->
                                    <?php } ?>
                                    <td><?php echo $record->registrationNo; ?></td>
                                    <td><?php echo $record->approvedName; ?></td>

                                    <td>
                                        <?php
                                        $regtype = $CI->loginModel->getRecord('tbl_registrationtype','id',$record->registrationTypeId);
                                        echo isset($regtype[0])?$regtype[0]->registrationType.' &mdash; '.$regtype[0]->registrationSubType:'';
                                        ?>
                                    </td>
                                    <td><?php echo $record->registrationFormType; ?></td>
                                    <td>
                                        <?php
                                        $porigin = $CI->loginModel->getRecord('tbl_productorigin','id',$record->productOriginId);
                                        echo isset($porigin[0])?$porigin[0]->productOrigin:'';
                                        ?>

                                    </td>
                                    <td>
                                        <?php
                                        $pcat = $CI->loginModel->getRecord('tbl_productcategory','id',$record->productCategoryId);
                                        echo isset($pcat[0])?$pcat[0]->productCategory:'';
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $usedfor = $CI->loginModel->getRecord('tbl_usedfor','id',$record->usedForId);
                                        echo isset($usedfor[0])?$usedfor[0]->usedFor:'';
                                        ?>
                                    </td>
                                    <td><?php  echo ($record->registrationStatus == 'Approved')?date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))):''; ?></td>
                                    <td><?php echo ($record->registrationStatus == 'Approved')?date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))):''; ?></td>
                                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                                    <?php
                                    if($this->roleId <> 26){

                                        ?>
                                        <td class="text-center"><?php echo $record->assignedOfficer; ?></td>
                                        <?php
                                    }
                                    ?>
                                    <td class="text-center">
                                        <b><h4><span class='badge bg-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Re Submitted' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Post Inspection Process' || $record->registrationStatus == 'Under Board Stage 1' || $record->registrationStatus == 'Under Board Stage 2' || $record->registrationStatus == 'Post Board Process'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'secondary';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 3' || $record->registrationStatus == 'Under Pricing' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                                    </td>
                                    <td class="text-center widthMaxContent">
                                        <div class="btn-group">
                                            <div class="btn-group-prepend">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" style="">

                                                <?php if($record->registrationStatus <> 'Draft'){ echo '
                                                  <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Export Registration Appliation/'.$record->id.'">Form 5 Appliation</a></li>
                                                ';} ?>


                                                <?php if($record->registrationStatus == 'Approved'){ echo '
                                                <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Export Approval Letter/'.$record->id.'">Registration Certificate Export Purpose</a></li>
                                                ';} ?>

                                                </ul>
                                            </div>
                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $sn++ ?>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <!-- <tfoot>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                        </tr>
                        </tfoot> -->
                    </table>

                    <?php
                }else{
                    ?>
                    <table id="newtable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.#</th>
                            <th class="text-center">Referrence No.</th>
                            <th>Company</th>
                            <?php if($this->companySubCategory <> 'Importer'){?>
                                <!-- <th>Establishment License</th>
                                <th>License No.</th> -->
                            <?php } ?>
                            <th>Registration No.</th>
                            <th>Approved Name</th>
                            <th>Registration Type</th>
                            <th>Registration Form Type</th>
                            <th>Product Origin</th>
                            <th>Product Category</th>
                            <th>Used For</th>

                            <th>Issue Date</th>
                            <th>Renewal Due Date</th>
                            <th>Last Renewal Date</th>
                            <th class="text-center">Data Status</th>
                            <th class="text-center">Stage</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sn=1; ?>
                        <?php
                        if(!empty($drugs))
                        {
                            foreach($drugs as $record)
                            {
                                $seenBy = explode(",",$record->seenBy);
                                ?>
                                <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                                    <td><?=$sn?>.</td>
                                    <td class="text-center"><?php echo $record->id; ?></td>
                                    <td><?php echo $record->companyName; ?></td>
                                    <!--<td><?php //echo $record->companyNTN; ?></td>-->
                                    <?php if($this->companySubCategory <> 'Importer'){?>
                                        <!-- <td><?php echo $record->licenseType.' &mdash; '.$record->licenseSubType; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td> -->
                                    <?php } ?>
                                    <td><?php echo $record->registrationNo; ?></td>
                                    <td><?php echo $record->approvedName; ?></td>

                                    <td><?php echo $record->registrationType.' &mdash; '.$record->registrationSubType; ?></td>
                                    <td><?php echo $record->registrationFormType; ?></td>
                                    <td><?php echo $record->productOrigin; ?></td>
                                    <td><?php echo $record->productCategory; ?></td>
                                    <td><?php echo $record->usedFor; ?></td>
                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))); ?></td>
                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))); ?></td>
                                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                                    <td class="text-center">
                                        <?php if($record->productStatus ==1){
                                            echo "Verified";
                                        } else if($record->productStatus ==2){
                                            echo "Un-Verified";
                                        }else if($record->productStatus ==3){
                                            echo "Provisionally Verified";
                                        }

                                        ?>

                                    </td>
                                    <td class="text-center">
                                        <b><h4><span class='badge bg-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Screening' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Post Inspection Process' || $record->registrationStatus == 'Under Board Stage 2' || $record->registrationStatus == 'Post Board Process'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 3' || $record->registrationStatus == 'Under Pricing' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                                    </td>
                                    <td class="text-center widthMaxContent">
                                        <div class="btn-group">
                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php $sn++ ?>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                        <!-- <tfoot>
                        <tr>
                          <th>Rendering engine</th>
                          <th>Browser</th>
                          <th>Platform(s)</th>
                          <th>Engine version</th>
                          <th>CSS grade</th>
                        </tr>
                        </tfoot> -->
                    </table>

                    <?php
                }
                ?>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php } ?>

    <?php if($myAction == 'add' || $myAction == 'edit' || $myAction == 'view'){ ?>
    <div class="container-fluid">

      <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" autocomplete="off" accept-charset="utf-8">';}?>

        <div class="card card-primary card-outline1">
          <div class="card-header">
            <h3 class="card-title"><?php if($myAction == 'add'){echo 'Add';} if($myAction == 'edit'){echo 'Edit';} if($myAction == 'view'){echo 'View';} ?> Details</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body cardBodyTransaction">

              <?php if($myAction <> 'add'){ ?>
              <div class="row">
                  <?php if(@$challanInfo[0]->challan_no || $this->roleId <> 26){ ?>
                      <div class="col-md-12">
                          <div class="card card-success">
                              <div class="card-header">
                                  <span> Challan Staus  : <strong><?php echo @$challanInfo[0]->challan_status; ?></strong></span>
                              </div>
                              <div class="card-body">
                                  <span><strong> Challan No :  </strong><?php echo @$challanInfo[0]->challan_no; ?></span><br>
                                  <span><strong> Challan Fee :  </strong><?php echo @$challanInfo[0]->challan_fee; ?></span><br>
                                  <span><strong> Challan Date :  </strong><?php echo @$challanInfo[0]->challan_date; ?></span><br>
                                  <span><strong> Challan Info :  </strong><?php echo @$challanInfo[0]->challan_msg; ?></span><br>
                              </div>
                          </div>
                      </div>
                  <?php } else { ?>
                      <div class="col-md-4">
                          <div class="form-group">
                              <?php $label = 'Challan No'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'challan_no'; ?>
                              <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                              <input type="hidden" id="challan_msg" name="challan_msg" value="" />
                              <input type="hidden" id="challan_status" name="challan_status" value="" />
                              <input type="hidden" id="challan_fee" name="challan_fee" value="" />
                              <input type="hidden" id="challan_date" name="challan_date" value="" />
                              <input type="hidden" id="challan_account_id" name="challan_account_id" value="" />
                              <input type="hidden" id="challan_account_title" name="challan_account_title" value="" />
                          </div>
                      </div>
                      <div class="col-md-2">
                          <label> &nbsp;</label>
                          <div>
                              <a href="#" id="verify_challan" class="btn btn-sm btn-success">
                                  Verify Challan
                              </a>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <p class="text-danger mb-12 challan-status">Challan Status:</p>
                          <p class="text-default mb-10" id="verify_result"></p>
                      </div>
                  <?php } ?>
              </div>
              <?php } ?>

              <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active"  data-toggle="pill" href="#tab1" id="t1" >Product Details</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab2" id="t2" >Product Attachments</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="pill" href="#tab6" id="t6" >License Data</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="pill" href="#tab5" >Queries</a>
                                </li>
                                <?php if($this->roleId <> 26){

                                    if($this->roleId == 55){
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#tab3">Letter Statement</a>
                                    </li>
                                       <?php
                                        if(@$recordsEdit[0]->registrationStatus == 'Under Board Stage 1' || @$recordsEdit[0]->registrationStatus == 'Under Board Stage 2' || @$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3'   ||  @$recordsEdit[0]->registrationStatus == 'Approved'){
                                        ?>
                                                <!--
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="pill" href="#tab7">Meeting Minutes</a>
                                        </li>-->
                                    <?php
                                        }
                                    } ?>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#tab4">Notesheet</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="tab-pane fade show active" id="tab1">

                                    <div class="row" style="float: left; width: 100%;">


                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php $label = 'Brand Name'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'approvedName'; ?>
                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Used For'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'usedForId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($usedFor))
                                                    {
                                                        foreach ($usedFor as $record)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->usedFor ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Route of Admin'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'routeOfAdminId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($routeOfAdmin))
                                                    {
                                                        foreach ($routeOfAdmin as $record)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->routeOfAdmin ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php $label = 'Dosage Form'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'dosageFormId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control prefixselect2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($dosageForm))
                                                    {
                                                        foreach ($dosageForm as $record)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->dosageName ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <?php $label = 'Reference Unit (In case if reference unit is NOT Dosage Form itself)'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'refUnit'; ?>
                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                            </div>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Composition</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                    <?php $myTable = 'tabledetailinn'; ?>
                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>S.#</th>
                                                            <th >Generic</th>
                                                            <th>Strength / Potency</th>
                                                            <th >Unit</th>
                                                            <?php if($myAction <> 'view' && $this->roleId == 26 ){ ?>
                                                                <th class="text-center">Action</th>
                                                            <?php } ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sn = 1;
                                                        $sId = 0;
                                                        $total = 0;
                                                        ?>
                                                        <?php
                                                        if(empty($recordsDetailINN))
                                                        {
                                                            unset($record);
                                                            @$recordsDetailINN[0]->id = 1;
                                                        }
                                                        ?>
                                                        <?php
                                                        if(!empty($recordsDetailINN))
                                                        {
                                                            foreach($recordsDetailINN as $record)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="srNo">
                                                                        <span><?=$sn?></span>.
                                                                        <?php $column = 'id'; ?>
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                    </td>

                                                                    <td>
                                                                        <div class="col-md-12 w-100 ui-widget">
                                                                            <div class="form-group">
                                                                                <?php $column = 'innManual'; ?>
                                                                                <input <?php if($myAction == 'view'|| ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control generic">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'strength'; ?>
                                                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $label = 'Unit'; ?>
                                                                                <?php $column = 'unitId'; ?>
                                                                                <select style="max-width: 200px" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                    <?php
                                                                                    if(!empty($unit))
                                                                                    {
                                                                                        foreach ($unit as $detail)
                                                                                        {
                                                                                            ?>
                                                                                            <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->unit ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                                                        <td class="text-center widthMaxContent">
                                                                            <div class="btn-group">
                                                                                <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                                                                <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php $sId++ ?>
                                                                <?php $sn++ ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                        <?php if($myAction <> 'add'){ ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <?php $label = 'Label Claim'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'labelClaim'; ?>
                                                <textarea readonly <?php if($myAction == 'view'  || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3">
                            <?php echo ((@$recordsEdit[0]->refUnit)? @$recordsEdit[0]->refUnit:'Each '.@$recordsEdit[0]->dosageName.' contains:')."\n";
                            foreach ($recordsDetailINN as $record1)
                            {
                                echo @$record1->innManual.' .... '.@$record1->strength.' '.@$record1->unit."\n";
                            }?></textarea>
                                            </div>
                                        </div>
                                        <?php } ?>


                                        <div class="col-md-12">
                                            <?php $label = 'Proposed Packing'; ?>
                                            <label><?php echo $label; ?></label>
                                            <!-- Group of default radios - option 1 -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" value="1" id="pp1" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> <?php  if( (@$recordsEdit[0]->proposedpackingType) && 1 == @$recordsEdit[0]->proposedpackingType){ echo 'checked'; } ?> name="proposedpackingType">
                                                <label class="custom-control-label" for="pp1">As Per requirement of importing country</label>
                                            </div>

                                            <!-- Group of default radios - option 3 -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" value="2" id="pp2" name="proposedpackingType" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> <?php  if( (@$recordsEdit[0]->proposedpackingType)){ if(2 == @$recordsEdit[0]->proposedpackingType){ echo 'checked';} }else{ echo 'checked'; } ?>>
                                                <label class="custom-control-label" for="pp2">Other</label>
                                            </div>

                                        </div>

                                        <div id="ppdata" class="col-md-12">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Proposed Packing</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                    <?php $myTable = 'tabledetailproposedpacking'; ?>
                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>S.#</th>
                                                            <th>Pack Size</th>
                                                            <th style="display: none">Description of Pack (Primary and Secondary)</th>

                                                            <th class="d-none">Approved Price</th>
                                                            <th style="display: none">Proposed Price</th>
                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                                                <th class="text-center">Action</th>
                                                            <?php } ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sn = 1;
                                                        $sId = 0;
                                                        $total = 0;
                                                        ?>
                                                        <?php
                                                        if(empty($recordsDetailProposedPacking))
                                                        {
                                                            unset($record);
                                                            @$recordsDetailProposedPacking[0]->id = 1;
                                                        }
                                                        ?>
                                                        <?php
                                                        if(!empty($recordsDetailProposedPacking))
                                                        {
                                                            foreach($recordsDetailProposedPacking as $record)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="srNo">
                                                                        <span><?=$sn?></span>.
                                                                        <?php $column = 'id'; ?>
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'packSize'; ?>
                                                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="Pack Size">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td style="display: none">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'description'; ?>
                                                                                <textarea <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control " rows="3"><?php echo @$record->$column; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td class="d-none">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'approvedPrice'; ?>
                                                                                <input <?php if($myAction == 'view'|| ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column ?>" class="form-control" placeholder="Price" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td style="display: none">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'proposedPrice'; ?>
                                                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <?php if($myAction <> 'view' && $this->roleId == 26 ){ ?>
                                                                        <td class="text-center widthMaxContent">
                                                                            <div class="btn-group">
                                                                                <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                                                                <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php $sId++ ?>
                                                                <?php $sn++ ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>





                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Product Category'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'productCategoryId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($productCategory))
                                                    {
                                                        foreach ($productCategory as $record)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $record->id ?>" <?php echo ($record->id == @$recordsEdit[0]->$column)?'selected':($record->id==2)?'selected':'';  ?>><?php echo $record->productCategory ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!--
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Finished Product Specification'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'pharmacopeiaId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <?php
                                                    if(!empty($pharmacopeia))
                                                    {
                                                        foreach ($pharmacopeia as $record)
                                                        {
                                                            ?>
                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->pharmacopeia ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Shelf Life'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'shelfLife'; ?>
                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Shelf Life Unit'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'shelfLifeunit'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option <?php echo @$recordsEdit[0]->$column == 'Months(s)'?'selected':''; ?> value="Months(s)">Month(s)</option>
                                                </select>
                                            </div>
                                        </div>

                                        -->
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <?php $label = 'Proposed Storage Condition of Finished Product'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'storageCondition'; ?>
                                                <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                            </div>
                                        </div>





                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <?php $label = 'Manufacturing Type'; ?>
                                                <label><?php echo $label; ?></label>
                                                <?php $column = 'regTypeId'; ?>
                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                    <option value="">Select <?php echo @$label; ?></option>
                                                    <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Self Manufacturing</option>
                                                    <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Contract Manufacturing</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <?php $label = 'Product Type'; ?>
                                            <label><?php echo $label; ?></label>
                                            <!-- Group of default radios - option 1 -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" value="1" id="defaultGroupExample1" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> <?php  if( (@$recordsEdit[0]->exportDrugTypeId) && 1 == @$recordsEdit[0]->exportDrugTypeId){ echo 'checked'; } ?> name="exportDrugTypeId">
                                                <label class="custom-control-label" for="defaultGroupExample1">Product Registered in RRA</label>
                                            </div>

                                            <!-- Group of default radios - option 2 -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input"  value="2"  id="defaultGroupExample2" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> <?php  if( (@$recordsEdit[0]->exportDrugTypeId) && 2 == @$recordsEdit[0]->exportDrugTypeId){ echo 'checked'; } ?> name="exportDrugTypeId" >
                                                <label class="custom-control-label" for="defaultGroupExample2">Product Registered in Pakistan</label>
                                            </div>

                                            <!-- Group of default radios - option 3 -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" value="3" id="defaultGroupExample3" name="exportDrugTypeId" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> <?php  if( (@$recordsEdit[0]->exportDrugTypeId)){ if(3 == @$recordsEdit[0]->exportDrugTypeId){ echo 'checked';} }else{ echo 'checked'; } ?>>
                                                <label class="custom-control-label" for="defaultGroupExample3">Product not Registered either in RRA/Pakistan</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12" id="rradata">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Product Registered in RRA</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body " style="height: 300px;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'International Drug Name'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefBrandName'; ?>
                                                            <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Country where Sold/Registered'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefBrandCountryId'; ?>
                                                            <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($countries))
                                                                {
                                                                    foreach ($countries as $detail)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $detail->countryName; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Company Name Selling Drug/Registration to Manufactuer'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefMAHolder'; ?>
                                                            <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                        <div class="col-md-12" id="pakdata">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Product Registered in Pakistan</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body " style="height: 300px;">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Drug Name in Pakistan'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefBrandName'; ?>
                                                            <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Drug Registration No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefRegistrationNo'; ?>
                                                            <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Company Name Registration to Manufactuer'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefProductHolder'; ?>
                                                            <input <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">

                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>



                                        <div class="col-md-12">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Other Manufacturer</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                    <?php $myTable = 'tabledetailmanufacturer'; ?>
                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>S.#</th>
                                                                <th style="width:30%" >Company</th>
                                                            <th>Role</th>
                                                            <th>Address</th>
                                                            <th>Country</th>
                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                                                <th class="text-center">Action</th>
                                                            <?php } ?>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sn = 1;
                                                        $sId = 0;
                                                        $total = 0;
                                                        ?>
                                                        <?php
                                                        if(empty($recordsDetailOtherManufacturer))
                                                        {
                                                            unset($record);
                                                            @$recordsDetailOtherManufacturer[0]->id = 1;
                                                        }
                                                        ?>
                                                        <?php
                                                        if(!empty($recordsDetailOtherManufacturer))
                                                        {
                                                            foreach($recordsDetailOtherManufacturer as $record)
                                                            {

                                                                ?>
                                                                <tr>
                                                                    <td class="srNo">
                                                                        <span><?=$sn?></span>.
                                                                        <?php
                                                                        $column = 'id'; ?>
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                    </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">

                                                                                    <?php $label = 'Name'; ?>
                                                                                    <?php $column = 'companyName'; ?>
                                                                                    <select style="max-width: 200px" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55) ){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($companies))
                                                                                        {
                                                                                            foreach ($companies as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->companyName ?>" <?php if($detail->companyName == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->companyName.' (<small>'.$detail->companyAddress.'</small>)'; ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>



                                                                                </div>
                                                                            </div>
                                                                        </td>


                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'role'; ?>
                                                                                <?php $label = 'Role'; ?>
                                                                                <select style="max-width: 200px" <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55) ){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                    <option value="Contract Manufacturing" <?php if('Contract Manufacturing' == @$record->$column){ echo 'selected'; } ?>>Contract Manufacturing</option>
                                                                                    <option value="Source of Pellets" <?php if('Source of Pellets' == @$record->$column){ echo 'selected'; } ?>>Source of Pellets</option>

                                                                                </select>

                                                                            </div>
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'companyAddress'; ?>
                                                                                <textarea <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control cadd" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $label = 'Country'; ?>
                                                                                <?php $column = 'companyCountry'; ?>
                                                                                <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                    <?php
                                                                                    if(!empty($countries))
                                                                                    {
                                                                                        foreach ($countries as $detail)
                                                                                        {
                                                                                            ?>
                                                                                            <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->countryName ?></option>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                                                        <td class="text-center widthMaxContent">
                                                                            <div class="btn-group">
                                                                                <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                                                                <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                                                            </div>
                                                                        </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php $sId++ ?>
                                                                <?php $sn++ ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>

                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="tab2">

                                    <div class="row" style="float: left; width: 100%;">


                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Covering Letter'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'rgCoverLetter'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutrequired">
                                                    <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Fee Challan'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'rgFeeChallan'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutrequired">
                                                    <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Recommended clinical use and dosage'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'clinicaldosageAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->clinicaldosageAttachment!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Manufacturing License Certificate'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'licenseCertificateAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Manufacturing Contract (In case of contract manufacturing)'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'contractManufacturingAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>


                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Approved Manufacturing Facility of Manufacturer'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'approvedManufacturerFacilityAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'NOC for CRF Clearance'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'nocCRFAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Signature identification with name, desigation and specimen signature'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'signatureAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Compositions'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'compositionAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Outline method of manufacture and manufacturing operations'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'manufactureMethodAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Approved technical staff responsible for drug manufacturing'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'technicalStaffAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Equipments used for drug manufacturing'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'manufacturingEquipmentsAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Equipments used for QA of raw and finished product'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'qaEquipmentsAttachments'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Description of specification and analytical methods'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'descriptionMethodAttachments'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>
<!--
                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Source & raw material specification/testing method of active & inactives'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'sourcerawSpecificationAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>
-->
                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Labeling/Prescribing Information'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'labelingprescribingAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Facility of water processing with specfications'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'waterProcessingSpecificationAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Enviormental control processing with specifications'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'enviormentalProcessingSpecificationAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Type of container/packaging material'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'packagingTypeAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Latest GMP Report'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'gmpreport'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Undertaking brand name similarity'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'undertakingBrandNameSimilarityAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Undertaking specimen of label'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'undertakingLableSpecimenAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Undertaking electronic copy'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'undertakingElectronicCopyAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>
                                        <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->registrationStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                            <div class="form-group">
                                                <?php $label = 'Undertaking registration is export purpose only'; ?>
                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                <?php $column = 'undertakingExportAttachment'; ?>
                                                <div class="custom-file">
                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><?php echo $label; ?> Link</label>
                                                <br>
                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="tab-pane fade" id="tab6">



                                    <div class="row" style="float: left; width: 100%;">
                                        <div class="col-md-12" style="border: 5px outset #c2c7d0; padding: 1%;">
                                            <div class="col-md-6" style="float: left;">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Company Name</label>
                                                        <br>
                                                        <i><u><?php echo @$licenserecord[0]->companyName; ?></u></i>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Site Address</label>
                                                        <br>
                                                        <i><u><?php echo @$licenserecord[0]->siteAddress.' '.@$recordsEdit[0]->siteCity; ?></u></i>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>License No.</label>
                                                        <br>
                                                        <i><u><?php echo @$licenserecord[0]->licenseNoManual; ?></u></i>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Valid Till</label>
                                                        <br>
                                                        <i><u><?php echo @$licenserecord[0]->validTill; ?></u></i>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 d-none">
                                                    <div class="form-group">
                                                        <label>GMP Status</label>
                                                        <br>
                                                        <!-- <span class="text-success font-weight-bold">VALID</span> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="float: right;">
                                                <iframe src="https://maps.google.com/maps?q=<?php echo @$licenserecord[0]->latitude.', '.@$licenserecord[0]->longitude; ?>&z=12&output=embed" width="100%" height="280" frameborder="0" allowfullscreen="" style="border:0"></iframe>

                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Qualified Staff</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                    <?php $myTable = 'tabledetailqualifiedstaff'; ?>
                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>S.#</th>
                                                            <th>Name</th>
                                                            <th>Father Name</th>
                                                            <th>Address</th>
                                                            <th>NIC</th>
                                                            <th>Phone</th>
                                                            <th>Designation</th>
                                                            <th>Qualification</th>
                                                            <th>Specialization</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sn = 1;
                                                        $sId = 0;
                                                        $total = 0;
                                                        ?>
                                                        <?php
                                                        if(empty($recordsDetailQualifiedStaff))
                                                        {
                                                            unset($record);
                                                            @$recordsDetailQualifiedStaff[0]->id = 1;
                                                        }
                                                        ?>
                                                        <?php
                                                        if(!empty($recordsDetailQualifiedStaff))
                                                        {
                                                            foreach($recordsDetailQualifiedStaff as $record)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="srNo">
                                                                        <span><?=$sn?></span>.
                                                                        <?php $column = 'id'; ?>
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'name'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'fatherName'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'address'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'nic'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $column = 'phone'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $label = 'Designation'; ?>
                                                                                <?php $column = 'designation'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $label = 'Qualification'; ?>
                                                                                <?php $column = 'qualification'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <?php $label = 'Specialization'; ?>
                                                                                <?php $column = 'specialization'; ?>
                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                            </div>
                                                                        </div>
                                                                    </td>



                                                                </tr>
                                                                <?php $sId++ ?>
                                                                <?php $sn++ ?>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                        </tbody>
                                                        <!-- <tfoot>
                                                        <tr>
                                                          <th>Rendering engine</th>
                                                          <th>Browser</th>
                                                          <th>Platform(s)</th>
                                                          <th>Engine version</th>
                                                          <th>CSS grade</th>
                                                        </tr>
                                                        </tfoot> -->
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <?php if(@$licenserecord[0]->licenseTypeId == 1 || @$licenserecord[0]->licenseTypeId == 2){ ?>
                                            <div class="col-md-12">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Sections (Basic/Semi-Basic Manufacture)</h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                        <?php $myTable = 'tabledetailfacility'; ?>
                                                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed1" style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>S.#</th>
                                                                <th>Facility/Section Name</th>

                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $sn = 1;
                                                            $sId = 0;
                                                            $total = 0;
                                                            ?>
                                                            <?php
                                                            if(empty($recordsDetailFacility))
                                                            {
                                                                unset($record);
                                                                @$recordsDetailFacility[0]->id = 1;
                                                            }
                                                            ?>
                                                            <?php
                                                            if(!empty($recordsDetailFacility))
                                                            {
                                                                foreach($recordsDetailFacility as $record)
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="srNo">
                                                                            <span><?=$sn?></span>.
                                                                            <?php $column = 'id'; ?>
                                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $column = 'facilityname'; ?>
                                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control">
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <?php $sId++ ?>
                                                                    <?php $sn++ ?>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-12">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Section's Detail</h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                        <?php $myTable = 'tabledetailsections'; ?>
                                                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>S.#</th>
                                                                <th>Section</th>
                                                                <th>Pharmacological Group</th>
                                                                <th>Used For</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $sn = 1;
                                                            $sId = 0;
                                                            $total = 0;
                                                            ?>
                                                            <?php
                                                            if(!empty($recordsDetailSection))
                                                            {
                                                                foreach($recordsDetailSection as $record)
                                                                {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="srNo">
                                                                            <span><?=$sn?></span>.
                                                                            <?php $column = 'id'; ?>
                                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $label = 'Section'; ?>
                                                                                    <?php $column = 'sectionId'; ?>
                                                                                    <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($section))
                                                                                        {
                                                                                            foreach ($section as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $label = 'Pharmacological Group'; ?>
                                                                                    <?php $column = 'pharmaGroupId'; ?>
                                                                                    <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($pharmaGroup))
                                                                                        {
                                                                                            foreach ($pharmaGroup as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $label = 'Used For'; ?>
                                                                                    <?php $column = 'usedForId'; ?>
                                                                                    <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($usedFor))
                                                                                        {
                                                                                            foreach ($usedFor as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                    <?php $sId++ ?>
                                                                    <?php $sn++ ?>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                            <!-- <tfoot>
                                                            <tr>
                                                              <th>Rendering engine</th>
                                                              <th>Browser</th>
                                                              <th>Platform(s)</th>
                                                              <th>Engine version</th>
                                                              <th>CSS grade</th>
                                                            </tr>
                                                            </tfoot> -->
                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>

                                        <?php } ?>
                                    </div>

                                </div>

                                <?php if($this->roleId <> 26){
                                if($this->roleId == 55){
                                    ?>
                                    <div class="tab-pane fade " id="tab3">

                                        <div class="row" style="float: left; width: 100%;">

                                            <div class="col-md-3">
                                                <div class="form-group ui-widget">
                                                    <?php $label = 'File Number'; ?>
                                                    <label><?php echo $label; ?></label>
                                                    <?php $column = 'regFileNo'; ?>
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $label = 'Registration No.'; ?>
                                                    <label><?php echo $label; ?></label>
                                                    <?php $column = 'registrationNo'; ?>
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $label = 'Registration Date'; ?>
                                                    <label><?php echo $label; ?></label>
                                                    <?php $column = 'issueDateManual'; ?>
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo date('Y-m-d', strtotime(date('d-m-Y H:i', strtotime(@$recordsEdit[0]->$column)))); ?>"  class="form-control required">
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <?php $label = 'Renewal Due Date'; ?>
                                                    <label><?php echo $label; ?></label>
                                                    <?php $column = 'validTill'; ?>
                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <?php $label = 'Registration Shortcoming'; ?>
                                                <?php $column = 'reviewer1Remarks'; ?>
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <?php echo $label; ?>
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <?php $label = 'Letter Conditions Type'; ?>
                                                    <label><?php echo $label; ?></label>
                                                    <?php $column = 'letterConditionsType'; ?>
                                                    <select <?php if($myAction == 'view' || ($this->roleId <> 26 && $this->roleId <> 55)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" >
                                                        <option value="">Select <?php echo @$label; ?></option>
                                                        <?php
                                                        if(!empty($letterConditions))
                                                        {
                                                            foreach ($letterConditions as $record)
                                                            {
                                                                ?>
                                                                <option <?php //echo (@$recordsEdit[0]->$column == $record->id)?'selected':''; ?> value="<?php echo $record->id ?>" ><?php echo $record->letterType ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>


                                            <div class="col-md-12">
                                                <?php $label = 'Registration Letter Conditions'; ?>
                                                <?php $column = 'letterConditions'; ?>
                                                <div class="card card-outline card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">
                                                            <?php echo $label; ?>
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>



                                    </div>


                                <?php } ?>
                                    <div class="tab-pane fade" id="tab4">

                                        <div class="row" style="float: left; width: 100%;">

                                            <div class="col-md-12">
                                                <div class="card card-primary card-outline">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Note Sheet</h3>
                                                        <div class="card-tools">
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                        <?php $myTable = 'tabledetailhistory'; ?>
                                                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                            <thead>
                                                            <tr>
                                                                <th>S.#</th>
                                                                <th class="text-center" width="10%">Date</th>
                                                                <th class="text-center" width="25%">Designation</th>
                                                                <th class="text-center" width="25%">Forwarded To</th>
                                                                <th class="text-center" width="40%">Remarks</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            $sn = 1;
                                                            $snum = 1;
                                                            $sId = 0;
                                                            $total = 0;
                                                            ?>
                                                            <?php
                                                            if(!empty($recordsDetailHistory))
                                                            {
                                                                foreach($recordsDetailHistory as $record)
                                                                {
                                                                    if($record->fromQ == 'DRAP'){
                                                                    ?>
                                                                    <tr>
                                                                        <td class="srNo">
                                                                            <span><?=$snum?></span>.
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo $record->dateTime; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if(!empty($historyDesignation))
                                                                            {
                                                                                foreach ($historyDesignation as $detail)
                                                                                {
                                                                                    ?>
                                                                                    <?php if($detail->id == @$record->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $label = 'User'; ?>
                                                                                    <?php $column = 'forwardedTo'; ?>
                                                                                    <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($historyDesignation))
                                                                                        {
                                                                                            foreach ($historyDesignation as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $column = 'remarks'; ?>
                                                                                    <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                        </td>

                                                                    </tr>
                                                                    <?php $sId++; ?>
                                                                    <?php $sn = $sn<9?$sn++:$sn; ?>
                                                                    <?php
                                                                    $snum++;
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            <tr>
                                                                <td class="srNo">
                                                                    <span></span>.
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php echo date($this->dateTimeFormat); ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if(!empty($historyDesignation))
                                                                    {
                                                                        foreach ($historyDesignation as $detail)
                                                                        {
                                                                            ?>
                                                                            <?php if($detail->id == $this->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php $label = 'User'; ?>
                                                                            <?php $column = 'forwardedTo'; ?>
                                                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101">
                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                <?php
                                                                                if(!empty($historyDesignation))
                                                                                {
                                                                                    foreach ($historyDesignation as $detail)
                                                                                    {
                                                                                        ?>
                                                                                        <option <?php if($this->userId == $detail->id){ echo 'selected';} ?> value="<?php echo $detail->id ?>"><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php $column = 'remarks'; ?>
                                                                            <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101" class="form-control required" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <?php if($this->roleId == '55'){?>
                                                                        <br>
                                                                        <div class="col-md-12">
                                                                            <div class="icheck-primary">
                                                                                <?php $label = 'Send This Query To The Applicant?'; ?>
                                                                                <?php $column = 'sendQueryToCompany'; ?>
                                                                                <input type="hidden" id="<?php echo $column; ?>Hidden" name="<?php echo $column; ?>" value="0">
                                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="1">
                                                                                <label for="<?php echo @$column; ?>"><?php echo $label; ?></label>
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </td>
                                                                <td class="text-center">

                                                                </td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                                <!-- /.card -->
                                            </div>

                                        </div>

                                    </div>

                                    <?php
                                    if(@$recordsEdit[0]->registrationStatus == 'Under Board Stage 1' || @$recordsEdit[0]->registrationStatus == 'Under Board Stage 2' || @$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3'   ||  @$recordsEdit[0]->registrationStatus == 'Approved'){
                                    ?>
                                        <div class="tab-pane fade" id="tab7">

                                            <div class="row" style="float: left; width: 100%;">

                                                <div class="col-md-12">
                                                    <div class="card card-primary card-outline">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Application Board Meetings</h3>
                                                            <div class="card-tools">
                                                            </div>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                            <?php $myTable = 'tabledetailmeeting'; ?>
                                                            <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                <thead>
                                                                <tr>
                                                                    <th>S.#</th>
                                                                    <th>Meeting No.</th>
                                                                    <th>Meeting Date</th>
                                                                    <th>Decision</th>
                                                                    <th class="text-center" style="display:none">Status</th>
                                                                    <?php if($myAction <> 'view'){ ?>
                                                                        <th style="display:none" class="text-center">Action</th>
                                                                    <?php } ?>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php
                                                                $sn = 1;
                                                                $sId = 0;
                                                                $total = 0;
                                                                ?>
                                                                <?php
                                                                if(empty($recordsDetailMeeting))
                                                                {
                                                                    unset($record);
                                                                    @$recordsDetailMeeting[0]->id = 1;
                                                                }
                                                                ?>
                                                                <?php
                                                                if(!empty($recordsDetailMeeting))
                                                                {
                                                                    foreach($recordsDetailMeeting as $record)
                                                                    {

                                                                        ?>
                                                                        <tr>
                                                                            <td class="srNo">
                                                                                <span><?=$sn?></span>.
                                                                                <?php $column = 'id'; ?>
                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                            </td>
                                                                            <td>

                                                                                <div class="col-md-12">
                                                                                  <div class="form-group">
                                                                                    <?php $column = 'meetingNo'; ?>
                                                                                    <input <?php if($myAction == 'view' || $this->roleId <> 55 || ($this->roleId == 55 && @$recordsEdit[0]->registrationStatus <> 'Under Board Stage 1')){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                  </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>

                                                                                <div class="col-md-12">
                                                                                  <div class="form-group">
                                                                                    <?php $column = 'meetingDate'; ?>
                                                                                    <input <?php if($myAction == 'view' || $this->roleId <> 55 || ($this->roleId == 55 && @$recordsEdit[0]->registrationStatus <> 'Under Board Stage 1')){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                  </div>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                               <!-- <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <?php $column = 'remarks'; ?>
                                                                                        <textarea <?php echo 'disabled';?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                                        -->
                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo 'agendaid'; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo 'agendaid'; ?>_detail[]" value="<?php echo @$record->agendaid; ?>" class="rowId">
                                                                                <div class="col-md-12">
                                                                                  <div class="form-group">
                                                                                    <?php $column = 'remarks'; ?>
                                                                                    <textarea <?php if($myAction == 'view' || $this->roleId <> 55 || ($this->roleId == 55 && @$recordsEdit[0]->registrationStatus <> 'Under Board Stage 1')){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                  </div>
                                                                                </div>
                                                                            </td>
                                                                            <td style="display:none">
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group">
                                                                                        <?php $column = 'status'; ?>
                                                                                        <select <?php echo 'disabled'; ?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                                            <option value="Approved" <?php if('Approved' == @$record->$column){ echo 'selected'; } ?>>Approved</option>
                                                                                            <option value="Deferred" <?php if('Deferred' == @$record->$column){ echo 'selected'; } ?>>Deferred</option>
                                                                                            <option value="Inspection Required" <?php if('Inspection Required' == @$record->$column){ echo 'selected'; } ?>>Inspection Required</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                                <!--
										<?php echo ($this->roleId != 6)?$record->status:''; ?>
										<?php if($this->roleId == 6) {?>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'status'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="Approved" <?php if('Approved' == @$record->$column){ echo 'selected'; } ?>>Approved</option>
                                              <option value="Deferred" <?php if('Deferred' == @$record->$column){ echo 'selected'; } ?>>Deferred</option>
                                              <option value="Inspection Required" <?php if('Inspection Required' == @$record->$column){ echo 'selected'; } ?>>Inspection Required</option>
                                            </select>
                                          </div>
                                        </div>
										<?php } ?>
										-->
                                                                            </td>
                                                                            <?php if($myAction <> 'view'){ ?>
                                                                                <td style="display:none" class="text-center widthMaxContent">
                                                                                    <div class="btn-group">
                                                                                        <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                                                                        <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                                                                    </div>
                                                                                </td>
                                                                            <?php } ?>
                                                                        </tr>
                                                                        <?php $sId++ ?>
                                                                        <?php $sn++ ?>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                                </tbody>

                                                            </table>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                    <!-- /.card -->
                                                </div>

                                            </div>

                                        </div>
                                    <?php  } ?>

                                <?php } ?>
                                <div class="tab-pane fade " id="tab5">

                                    <div class="row" style="float: left; width: 100%;">

                                        <div class="col-md-12">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <h3 class="card-title">Queries</h3>
                                                    <div class="card-tools">
                                                    </div>
                                                </div>

                                                <!-- /.card-header -->
                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                    <?php $myTable = 'tbl_query2'; ?>
                                                    <input type="hidden"  name="fromQ" value="<?php if($this->roleId == 26){ echo 'Applicant'; }else{ echo 'DRAP'; } ?>">

                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                        <thead>
                                                        <tr>
                                                            <th>S.#</th>
                                                            <th>Date & Time</th>
                                                            <th>Shortcoming</th>
                                                            <th>Comment</th>
                                                            <th>Attachment</th>
                                                            <!--<th class="text-center">Action</th>
                                                            -->
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                        $sn = 1;
                                                        $sId = 0;
                                                        $total = 0;
                                                        ?>
                                                        <?php
                                                        if(!empty($recordsDetailQuery))
                                                        {

                                                            foreach($recordsDetailQuery as $record)
                                                            {
                                                                ?>
                                                                <tr>
                                                                    <td class="srNo">
                                                                        <span><?=$sn?></span>.
                                                                    </td>
                                                                    <td><?php echo $record->dateTime; ?></td>
                                                                    <td><?php echo $record->shortcomming; ?> </td>
                                                                    <td><?php echo $record->message; ?> </td>
                                                                    <td>
                                                                        <div class="col-12 my-2">
                                                                            <a title="<?php echo $record->filePath; ?>" <?php if(!@$record->filePath){ echo 'disabled';} ?> <?php if(@$record->filePath){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->filePath.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->filePath){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                        </div>
                                                                    </td>
                                                                    <!--<td></td>-->
                                                                </tr>
                                                                <?php

                                                            }
                                                        }
                                                        ?>
                                                        </tbody>

                                                    </table>


                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
              <?php if($this->roleId <> 26){ ?>
                  <div class="col-md-6">
                      <div class="form-group">
                          <?php $label = 'Status'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'registrationStatus'; ?>
                          <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                              <?php
                              if($this->roleId == '7'){ // Registration Director
                                  echo '
							  <option value="Save">Save</option>
							  <option value="Proceed">Save and Forward</option>
							  <!--<option value="Deferred and Closed">Deferred and Closed</option>-->
							  ';
                                  /*if(@$recordsEdit[0]->registrationStatus == 'Under Board Stage 2'){
                                      echo '
                                           <option value="approveminutes">Approve Meeting Descision</option>
                                           <option value="changeminutes">Changes in Meeting Descision</option>
                                      ';
                                  }*/

                              }
                              if($this->roleId == '11'){ // Registration Additional Director
                                  echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Forward</option>
                      ';
                              }
                              if($this->roleId == '15'){ // Registration Deputy Director
                                  echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Forward</option>
                      ';
                              }
                              if($this->roleId == '19'){ // Registration Deputy Director
                                  echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Forward</option>
                      ';
                              }
                              if($this->roleId == '55'){ // Registration Export Assistant Director
                                  echo '<option value="Save">Save</option>
							  <option value="Proceed">Save and Forward</option>';
                                  if(@$recordsEdit[0]->registrationStatus == 'Under Review'){
                                      echo '<option value="Referred Back To Company (Locked)">Referred Back To Company</option>
							  <option value="Deferred and Closed">Deferred and Closed</option>
							  <option value="Approved">Approved</option>';
                                  }/*
                                  else if(@$recordsEdit[0]->registrationStatus == 'Under Board Stage 1'){
                                      echo '<option value="minutesapproval">Forwarded for Meeting Approval</option>';
                                  }

                                  else if(@$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3'){
                                      echo '<option value="Deferred and Closed">Deferred and Closed</option>
							  <option value="Approved">Approved</option>
							  ';
                                  }else{
                                      echo '<option value="Referred Back To Company (Locked)">Referred Back To Company</option>
							  ';

                                  }*/
                              }
                              if($this->roleId == '39'){ // Registration Assigning Officer
                                  echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Forward</option>
                      ';
                              }
                              if($this->roleId == '44'){ // Registration Board Secretary
                                  echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Forward</option>
                      <!-- <option value="Deferred and Closed">Deferred and Closed</option> -->
                      ';
                              }
                              if($this->roleId == '42'){ // CEO
                                  echo '
                      <!-- <option value="Save">Save</option> -->
                      <!-- <option value="Deferred and Closed">Deferred and Closed</option> -->
                      <!-- <option value="Approved">Approved</option> -->
                      ';
                              }
                              ?>
                          </select>
                      </div>
                  </div>
              <?php } ?>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <?php
              if($this->roleId == 26) {
                  if ($myAction == 'add') {
                      echo '<input type="submit" name="registrationStatus"  class="btn btn-warning" value="Save">';
                  }
                  else if ($myAction == 'edit') {
                      echo '<input type="submit" name="registrationStatus" id="formSubmit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-primary" value="Submit">';
                      echo '<input type="submit" name="registrationStatus"  class="btn btn-warning" value="Save">';
                  }
              }else{
                  if ($myAction == 'add' || $myAction == 'edit') {
                      echo '<input type="submit"  class="btn btn-primary" value="Submit">';
                  }
              }
          ?>
          </div>
        <!-- /.card -->
        </div>
        <!-- /.row -->
      <?php if($myAction == 'add' || $myAction == 'edit'){echo '</form>';}?>
    </div>
    <!-- /.container-fluid -->
    <?php } ?>
  </section>
  <!-- /.content -->
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<script type="text/javascript">
    var prefix_Sorter = function(results) {
        if (!results || results.length == 0)
            return results

        // Find the open select2 search field and get its value
        var term = document.querySelector('.select2-search__field').value.toLowerCase()
        if (term.length == 0)
            return results

        return results.sort(function(a, b) {
            aHasPrefix = a.text.toLowerCase().indexOf(term) == 0
            bHasPrefix = b.text.toLowerCase().indexOf(term) == 0

            return bHasPrefix - aHasPrefix // If one is prefixed, push to the top. Otherwise, no sorting.
        })
    }
  loadMyTable('table', true, 15);

    function initailizeSelect2(){

        $(".select2_el").select2({
            ajax: {
                url: "ajaxfile.php",
                type: "post",
                dataType: 'json',
                delay: 250,
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    }
  //loadMyTable('tabledetailinn', false, -1);
  loadBasicTable('tabledetailinn');
  $('#tabledetailinn').on( 'click', '.plus', function () {
      var myCurrentTable = 'tabledetailinn';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");

      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));


      //var lastelement = $('#'+myCurrentTable+' tr:last').find("[name='tabledetailinn-innManual_detail[]']");
      //lastelement.attr('id') = "tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());
      //$("td input.generic", row).val("tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()));
      $('#'+myCurrentTable).DataTable().row.add(row).draw();
/*
      $("td:eq(3)", row).closest('td').html('<select class="form-control prefixselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'"></select>');
      $( ".prefixselect2" ).last().select2({

          ajax: {
              url:"<?php echo base_url(); ?>myController/myAjaxGetOptions",
              method:"POST",
              data:{table:'tbl_unit', columnName:'unit'},
              delay: 250,
              processResults: function (response) {
                  console.log(response)
                  return {
                      results: response
                  };
              },
              cache: true
          }
      });
      */

      $.ajax({
          url:"<?php echo base_url(); ?>myController/myAjaxGet",
          method:"POST",
          data:{table:'tbl_unit', columnName:'unit'},
          success:function(data)
          {
              //console.log(data);
              $("td:eq(3)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control prefixunitselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select></div></div>');
          },
          complete: function (data) {
              $('.prefixunitselect2').last().select2({ width: '100%' });
          }
      });

      //$('.prefixselect2').select2({ sorter: prefix_Sorter });


      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });

      var lastgenericid = '';
      lastgenericid = "tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());

      $( ".generic" ).last().attr('id',lastgenericid);

      var generics  =  <?php echo json_encode($generics); ?>;


      $('#'+lastgenericid).on("keyup", function(){
         // console.log(lastgenericid);

          $('#'+lastgenericid).autocomplete({
              minLength:3,
              source: generics
          });
      });

      //alert(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));
      /*$("td input.generic").on("keyup", function(){

          $(this).autocomplete({
              source: generics
          });
      });
      /*$('.generic').on("keyup", function(){
          $(this).autocomplete({
              source: generics
          });
      });*/

  });
  //loadMyTable('tabledetailmanufacturer', false, -1);
  loadBasicTable('tabledetailmanufacturer');
  $('#tabledetailmanufacturer').on( 'click', '.plus', function () {
      var myCurrentTable = 'tabledetailmanufacturer';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      var lastid = parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());


      var lastcompid = "tabledetailmanufacturer-comp_"+lastid;
      var lastcnameid = "tabledetailmanufacturer-companyName_"+lastid;
      var lastcaddid = "tabledetailmanufacturer-companyAddress_"+lastid;

      $.ajax({
          url:"<?php echo base_url(); ?>myController/myAjaxGetCompany",
          method:"POST",
          data:{table:'tbls_company', columnName:'companyName'},
          success:function(data)
          {
              $("td:eq(1)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2 comp" id="'+lastcompid+'" >'+data+'</select></div></div>');
          },
          complete: function (data) {
              $('#'+lastcompid).on('change', function() {
                  var selectedid = $(this).attr('id').split('_')[1];

                  var cnameid = "#tabledetailmanufacturer-companyName_"+selectedid;
                  var caddid = "#tabledetailmanufacturer-companyAddress_"+selectedid;

                  var cadd = $(this).find('option:selected').attr('data-add');
                  var cname = $(this).find('option:selected').text();
                  $(cnameid).val(cname);
                  $(caddid).val(cadd);
              });
              $('#'+lastcompid).select2({ width: '100%' });
            //  $('.select2:nth-last-child(2)').select2();
          }
      });
      $.ajax({
          url:"<?php echo base_url(); ?>myController/myAjaxGet",
          method:"POST",
          data:{table:'tbls_country', columnName:'countryName'},
          success:function(data)
          {
              $("td:eq(4)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control prefixselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(5).children().children().children().attr("name") +'">'+data+'</select></div></div>');
          },
          complete: function (data) {
             // console.log($('.select2').last().attr('name'));
              $('.prefixselect2').last().select2({ width: '100%' });
          }
      });


      //$( ".comp" ).first().attr('id',lastcompid);
      $( ".cname" ).last().attr('id',lastcnameid);
      $( ".cadd" ).last().attr('id',lastcaddid);

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
  });


  //loadMyTable('tabledetailproposedpacking', false, -1);
  loadBasicTable('tabledetailproposedpacking');

  $('#tabledetailproposedpacking').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailproposedpacking';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      // $.ajax({
      //   url:"<?php echo base_url(); ?>myController/myAjaxGet",
      //   method:"POST",
      //   data:{table:'tbls_page', columnName:'friendlyName'},
      //   success:function(data)
      //   {
      //     $("td:eq(5)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(5).children().children().children().attr("name") +'">'+data+'</select>');
      //   }
      //  });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });
  $(document).ready(function(){

      var value = $( 'input[name=exportDrugTypeId]:checked' ).val();

      if(value == 1){
          $("#pakdata").hide();
          $("#rradata").show();
      }else if(value == 2){
          $("#rradata").hide();
          $("#pakdata").show();
      }else{
          $("#rradata").hide();
          $("#pakdata").hide();
      }

      $('input[name=exportDrugTypeId]').change(function(){
          var value = $( 'input[name=exportDrugTypeId]:checked' ).val();

          if(value == 1){
              $("#pakdata").hide();
              $("#rradata").show();
          }else if(value == 2){
              $("#rradata").hide();
              $("#pakdata").show();
          }else{
              $("#rradata").hide();
              $("#pakdata").hide();
          }
      });


      var ppval = $( 'input[name=proposedpackingType]:checked' ).val();

      if(ppval == 1){
          $("#ppdata").hide();
      }else{
          $("#ppdata").show();
      }

      $('input[name=proposedpackingType]').change(function(){
          var value = $( 'input[name=proposedpackingType]:checked' ).val();

          if(value == 1){
              $("#ppdata").hide();
          }else{
              $("#ppdata").show();
          }
      });



      if($('#searchby').val() == 4){
          $(".filterbox").hide();
          $(".companyfilter").show();
      }else{
          $(".companyfilter").hide();
      }
      $('#searchby').on('change', function() {
          if(this.value == 4){
              $(".filterbox").hide();
              $(".companyfilter").show();
          }else{
              $(".filterbox").show();
              $(".companyfilter").hide();
          }
      });
      $('#letterConditionsType').on('change', function() {
          var letterid= $("#letterConditionsType option:selected").val();
          if(letterid != null && letterid != '') {
              $.ajax({
                  url: "<?php echo base_url(); ?>myController/getCondition/" + letterid,
                  method: "GET",
                  dataType: 'json',
                  success: function (response) {
                      console.log(response);
                      $('#letterConditions').summernote('code', response);
                  }
              });

          }
      });
      $('.comp').on('change', function() {

          var selectedid = $(this).attr('id').split('_')[1];

          var cnameid = "#tabledetailmanufacturer-companyName_"+selectedid;
          var caddid = "#tabledetailmanufacturer-companyAddress_"+selectedid;

          var cadd = $(this).find('option:selected').attr('data-add');
          var cname = $(this).find('option:selected').text();

          $(cnameid).val(cname);
          $(caddid).val(cadd);
      });

      $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
          $(this).closest(".select2-container").siblings('select:enabled').select2('open');
      });

// steal focus during close - only capture once and stop propogation
      $('select.select2').on('select2:closing', function (e) {
          $(e.target).data("select2").$selection.one('focus focusin', function (e) {
              e.stopPropagation();
          });
      });

      $("#companyAccountId").change(function () {

          $("#companyAddress").val($(this).find(':selected').data('address'));

          /*if($(this).val() != null && $(this).val() != ''){
              $.ajax({
                  url:"<?php echo base_url(); ?>myController/companyLicenseGet",
                  method:"POST",
                  dataType: 'json',
                  data:{companyId:$(this).val()},
                  success:function(response)
                  {
                      //console.log(response['licenseSubType']+" ("+response['licenseNoManual']+")");

                      $("#masterId").val(response['licenseSubType']+" ("+response['licenseNoManual']+")");
                      $("#masterIdHidden").val(response['id']);
                  }
              });
          }*/

      }).change();
      var refUnit  = <?php echo json_encode($refunits); ?>;
      $( "#refUnit" ).autocomplete({
          source: refUnit
      });

      var filenum  = <?php echo json_encode($filenumbers); ?>;
      $( "#regFileNo" ).autocomplete({
          source: filenum
      });

      var generics  =  <?php echo json_encode($generics); ?>;


      $('.generic').on("keyup", function(){
          //console.log($(this).val());
          $(this).autocomplete({
              minLength:3,
              source: generics
          });
      });




      $('#regFileNo').on("focusout", function() {
          var fnum = this.value;
          var regExp = /\(([^)]+)\)/;
          var matches = regExp.exec(fnum);

          if(matches[1].startsWith("M-"))
              $( "#meetingNo" ).val(matches[1].split("M-")[1]);
          else
              $( "#meetingNo" ).val('');
      });
      $('#issueDateManual').on("focusout", function() {
          var issuedate = this.value;
          var year  = new Date(issuedate).getFullYear();
          var month = new Date(issuedate).getMonth();
          var day   = new Date(issuedate).getDate();
          var date  = new Date(year +5, month, day -1);
          var vtill = date.toLocaleDateString("en-CA");
          $( "#validTill" ).val(vtill);
      });

      <?php if($this->roleId <> 26 ){ ?>
      var newtable = $('#newtable').DataTable({
          "processing": true,
          "serverSide": true,
          "ajax":{
              url: "<?php echo base_url(); ?>myController/exportregistrationData",
              type:"POST",
              error:function(err, status){
                  // what error is seen(it could be either server side or client side.
                  console.log('Error');
                  console.log(err);
              },
          },
          'orderCellsTop': true,
          'fixedHeader'  : true,
          'paging'       : true,
          'lengthChange' : false,
          'searching'    : true,
          'ordering'     : false,
          'info'         : true,
          'iDisplayLength': 25,
          'autoWidth'    : true,
          'lengthMenu': [
              [ 10, 25, 50, -1 ],
              [ '10 rows', '25 rows', '50 rows', 'Show all' ]
          ],
          "dom": 'Blfrtip',
          "oLanguage": {
              "sInfo" : "Showing _START_ to _END_",// text you want show for info section
          },

          'search'       : {'caseInsensitive': false},
          'searchDelay': 10000,
          //'columnDefs'   : [{ 'type': 'html-input', 'targets': ['_all'] }],
          'columnDefs'   : [{ 'type': 'html-input', 'targets': [1] }],
          'buttons'      : [{'extend':'copy', 'exportOptions': {'columns': ':visible' }}, {'extend':'csv', 'exportOptions': {'columns': ':visible' }}, {'extend':'excel', 'exportOptions': {'columns': ':visible' }}, {'extend':'pdf', 'exportOptions': {'columns': ':visible' }}, {'extend':'print', 'exportOptions': {'columns': ':visible' }}, 'colvis'],

          initComplete   : function () {
              this.api().columns().every( function () {
                  var that = this;
                  $( 'input', $('#newtable thead tr:eq(1) th').eq( this.index() ) ).on( 'keyup change clear', function () {
                      if ( that.search() !== this.value ) {
                          that
                              .search( this.value )
                              .draw();
                      }
                  } );
              } );
          }
      }).buttons().container().appendTo('#newtable_wrapper .col-md-6:eq(0)');
      $('.dataTables_filter input')
          .unbind('keypress keyup')
          .bind('keypress keyup', function(e){
              if ($(this).val().length < 3 && e.keyCode != 13) return;
              newtable.fnFilter($(this).val());
          });
      <?php }else{ ?>
      loadMyTable('newtable', false, -1);
      <?php } ?>

      $('#reviewer1Remarks').summernote();
      $('#letterConditions').summernote();

      <?php if($myAction == 'view'){ ?>
      $('#reviewer1Remarks').summernote('disable');
      $('#letterConditions').summernote('disable');
      <?php } ?>
  });
</script>