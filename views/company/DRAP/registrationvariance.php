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
  
</head>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName; ?></h1>
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
    <?php if($myAction == 'lookup'){?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lookup</h3>
              <div class="card-tools">
                <?php if($this->roleId == 26){?>
                  <a class="btn btn-primary" href="<?php echo base_url().$pageTitle[0]->url.'/add' ?>"><i class="fa fa-plus"></i> <?php echo $pageTitle[0]->friendlyName; ?></a>
                <?php }?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">

              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th class="text-center">Referrence No.</th>
                  <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                  <th>Company</th>
                  <th>NTN</th>
                  <?php } ?>

                  <th>Variance Type</th>
                  <th>Product Origin</th>
                  <th>Product Category</th>
                  <th>Used For</th>
                  <th>Registration No.</th>
                  <th>Approved Name</th>
                  <th>Issue Date</th>
                  <th>Renewal Due Date</th>
                  <th>Last Renewal Date</th>

                  <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                  <th>Assigned Officer</th>
                  <?php } ?>
                  <th class="text-center">Status</th>
                  <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                  <th>Added In Agenda</th>
                  <?php } ?>
                  <!-- <th class="text-center">Status</th> -->
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $sn=1; ?>
                  <?php
                  if(!empty($records))
                  {
                      foreach($records as $record)
                      {
                        $seenBy = explode(",",$record->seenBy);
                  ?>
                  <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                    <td><?php echo $record->companyName; ?></td>
                    <td><?php echo $record->companyNTN; ?></td>
                    <?php } ?>
                    <td><?php echo $record->registrationType.' &mdash; '.$record->registrationSubType; ?></td>
                    <td><?php echo $record->productOrigin; ?></td>
                    <td><?php echo $record->productCategory; ?></td>
                    <td><?php echo $record->usedFor; ?></td>
                    <td><?php echo $record->registrationNo; ?></td>
                    <td><?php echo $record->approvedName; ?></td>
                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))); ?></td>
                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))); ?></td>
                    <td><?php echo $record->lastRenewalDateManual; ?></td>

                    <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                    <td><?php echo $record->assignedOfficer; ?></td>
                    <?php } ?>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->postchangeStatus == 'Draft'){echo 'warning';} elseif($record->postchangeStatus == 'Submitted' || $record->postchangeStatus == 'Screening' || $record->postchangeStatus == 'Under R and I'){echo 'info';} elseif($record->postchangeStatus == 'Received By DRAP' || $record->postchangeStatus == 'Under Review Stage 1' || $record->postchangeStatus == 'Review Complete' || $record->postchangeStatus == 'Under Inspection' || $record->postchangeStatus == 'Post Inspection Process' || $record->postchangeStatus == 'Under Board Stage 2' || $record->postchangeStatus == 'Post Board Process'){echo 'primary';} elseif($record->postchangeStatus == 'Referred Back To Company (Editable)' || $record->postchangeStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->postchangeStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->postchangeStatus == 'Recommended By Board Stage 3' || $record->postchangeStatus == 'Under Pricing' || $record->postchangeStatus == 'Pricing Complete' || $record->postchangeStatus == 'Approved'){echo 'success';} ?>'><?php if($record->postchangeStatus == 'Under Board Stage 2'){echo 'Under Committee';} elseif($record->postchangeStatus == 'Recommended By Board Stage 3'){echo 'Recommended By Committee';}else{echo $record->postchangeStatus;} ?></span></h4></b>
                    </td>
                    <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                    <td class="text-center"><?php if($record->discussInBoard == 1){echo 'Yes';} if($record->discussInBoard == 0){echo 'No';} ?></td>
                    <?php } ?>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">
                            <?php if($this->roleId == '26'){ echo '
                            <li><a href="'.base_url().'report/view/Registration Application Submission Receipt/'.$record->id.'">Application Submission Receipt</a></li>
                            ';} ?>
                            <?php if($record->panelOfInspector1){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Registration Panel of Inspector/'.$record->id.'">Registration Panel of Inspector</a></li>
                            ';} ?>
                            <?php if($record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Renewal Applicant Registration Certificate/'.$record->id.'">Renewal Certificate</a></li>
                            ';} ?>
                          </ul>
                        </div>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <?php if($record->postchangeStatus <> 'Approved'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        <?php } ?>
                        <?php if($record->postchangeStatus == 'Draft'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                        <?php } ?>
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
      <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';}?>
        <div class="card card-primary card-outline1">
          <div class="card-header">
            <h3 class="card-title"><?php if($myAction == 'add'){echo 'Add';} if($myAction == 'edit'){echo 'Edit';} if($myAction == 'view'){echo 'View';} ?> Details</h3>

          </div>
          <!-- /.card-header -->
          <div class="card-body cardBodyTransaction">
              <?php

                if(@$recordsEdit[0]->postchangeStatus == 'Draft'){
                  echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 63px;">Draft</span>
                    <span style="margin-right: 63px;">Screening</span>
                    <span style="margin-right: 63px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                }
                if(@$recordsEdit[0]->postchangeStatus == 'Submitted' || @$recordsEdit[0]->postchangeStatus == 'Screening' || @$recordsEdit[0]->postchangeStatus == 'Under R and I' || @$recordsEdit[0]->postchangeStatus == 'Received By DRAP' || @$recordsEdit[0]->postchangeStatus == 'Referred Back To Company (Editable)'){
                  echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 47px;">Draft</span>
                    <span style="margin-right: 63px;">Screening</span>
                    <span style="margin-right: 63px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                }
                if(@$recordsEdit[0]->postchangeStatus == 'Under Review Stage 1' || @$recordsEdit[0]->postchangeStatus == 'Under Inspection' || @$recordsEdit[0]->postchangeStatus == 'Referred Back To Company (Locked)' || @$recordsEdit[0]->postchangeStatus == 'Review Complete'){
                  echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 43px;">Draft</span>
                    <span style="margin-right: 43px;">Screening</span>
                    <span style="margin-right: 57px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                }
                if(@$recordsEdit[0]->postchangeStatus == 'Under Board Stage 2' || @$recordsEdit[0]->postchangeStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->postchangeStatus == 'Pricing Complete' || @$recordsEdit[0]->postchangeStatus == 'Approved'){
                  echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 47px;">Draft</span>
                    <span style="margin-right: 37px;">Screening</span>
                    <span style="margin-right: 37px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                }
                ?>
            <div class="row">

              <?php if($this->roleId <> 26){ ?>
              <div class="col-md-12" style="border: 5px outset #c2c7d0; padding: 1%;">
                <div class="col-md-6" style="float: left;">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Company Name</label>
                      <br>
                      <i><u><?php echo @$recordsEdit[0]->companyName; ?></u></i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Site Address</label>
                      <br>
                      <i><u><?php echo @$recordsEdit[0]->siteAddress.' '.@$recordsEdit[0]->siteCity; ?></u></i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>License No.</label>
                      <br>
                      <i><u><?php echo @$recordsEdit[0]->licenseNoManual; ?></u></i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>GMP Status</label>
                      <br>
                      <!-- <span class="text-success font-weight-bold">VALID</span> -->
                    </div>
                  </div>
                </div>
                <div class="col-md-6" style="float: right;">
                  <iframe src="<?php echo @$recordsEdit[0]->googleMapURL ?>" width="100%" height="280" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                </div>
              </div>
              <?php } ?>

              <div class="col-md-12">
                <br>
                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab1">Registration Variance Type</a>
                      </li>
                      <?php if($myAction <> 'add'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab2">Previous Record</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab3">Proposed Variances</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab4">Queries</a>
                      </li>
                      <?php if($this->roleId <> 26){ ?>
                      <?php if(@$recordsEdit[0]->postchangeStatus <> 'Submitted' && @$recordsEdit[0]->postchangeStatus <> 'Screening' && @$recordsEdit[0]->postchangeStatus <> 'Under R and I' && $recordsEdit[0]->postchangeStatus <> 'Received By DRAP'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab8">Evaluation</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab5">Letter Statement</a>
                      </li>
                      <?php } ?>
                      <?php if(@$records[0]->postchangeStatus == 'Under Board Stage 2' || @$records[0]->postchangeStatus == 'Post Board Process'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab6">RB</a>
                      </li>
                      <?php } ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab7">Assignment / Note Sheet</a>
                      </li>
                      <?php } ?>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane fade show" id="tab1">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if($myAction == 'add'){?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Brand Name'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'parentId'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($registrationApproved1))
                                  {
                                    foreach ($registrationApproved1 as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->approvedName. ' ( '.$record->registrationNo.' ) '; ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Variance Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'registrationTypeId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($postChangeType))
                                  {
                                      $head = '';
                                    foreach ($postChangeType as $record)
                                    {
                                        if($record->registrationHead != $head){
                                            ?>
                                            <optgroup label="<?php echo $record->registrationHead; ?>">
                                            <?php
                                        }
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->registrationSubType ?></option>
                                        <?php
                                        if($record->registrationHead != $head){
                                            $head = $record->registrationHead;
                                            ?>
                                            </optgroup>
                                            <?php
                                        }

                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>

                          <?php if($myAction <> 'add'){

                              ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Brand Name'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'parentId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($registrationApproved2))
                                  {
                                    foreach ($registrationApproved2 as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->approvedName. ' ( '.$record->registrationNo.' )'; ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Variance Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'registrationTypeId'; ?>
                              <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php //echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($postChangeType))
                                  {
                                    foreach ($postChangeType as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->registrationSubType.' & '.@$recordsEdit[0]->$column; ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab2">

                        <div class="row" style="float: left; width: 100%;">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Registration No.'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'registrationNo'; ?>
                                    <input disabled type="text" id="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php $label = 'Approved Brand Name'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'approvedName'; ?>
                                    <input disabled type="text" id="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Used For'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'usedForId'; ?>
                                    <select disabled class="form-control select2" id="<?php echo @$column; ?>" >
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
                                    <?php $label = 'Registration Date'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'issueDateManual'; ?>
                                    <input disabled type="date" id="<?php echo @$column; ?>" value="<?php echo date('Y-m-d', strtotime(date('d-m-Y H:i', strtotime(@$recordsEdit[0]->$column)))); ?>"  class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Route of Admin'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'routeOfAdminId'; ?>
                                    <select disabled class="form-control select2" id="<?php echo @$column; ?>">
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Renewal Due Date'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'validTill'; ?>
                                    <input disabled type="text" id="<?php echo @$column; ?>"  value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php $label = 'Dosage Form'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'dosageFormId'; ?>
                                    <select disabled class="form-control prefixselect2" id="<?php echo @$column; ?>">
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
                                    <input disabled type="text" id="<?php echo @$column; ?>"  value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
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
                                        <?php $myTable = 'tabledetailinnPrevious'; ?>
                                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>S.#</th>
                                                <th >Generic</th>
                                                <th>Strength / Potency</th>
                                                <th >Unit</th>

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
                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                        </td>

                                                        <td>
                                                            <div class="col-md-12 w-100 ui-widget">
                                                                <div class="form-group">
                                                                    <?php $column = 'innManual'; ?>
                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'strength'; ?>
                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $label = 'Unit'; ?>
                                                                    <?php $column = 'unitId'; ?>
                                                                    <select style="max-width: 200px" disabled class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php $label = 'Label Claim'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'labelClaim'; ?>
                                    <textarea readonly  id="<?php echo @$column; ?>"  class="form-control" rows="3">
                            <?php echo ((@$recordsEdit[0]->refUnit)? @$recordsEdit[0]->refUnit:'Each '.@$recordsEdit[0]->dosageName.' contains:')."\n";
                            foreach ($recordsDetailINN as $record1)
                            {
                                echo @$record1->innManual.' .... '.@$record1->strength.' '.@$record1->unit."\n";
                            }?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
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

                                                <th style="display: none">Approved Price</th>
                                                <th style="display: none">Pricing Type</th>
                                                <th style="display: none">Proposed Price</th>

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
                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'packSize'; ?>
                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control" placeholder="Pack Size">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'description'; ?>
                                                                    <textarea disabled id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>"  class="form-control " rows="3"><?php echo @$record->$column; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'approvedPrice'; ?>
                                                                    <input disabled type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column ?>" class="form-control" placeholder="Price" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td  style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'pricingType'; ?>
                                                                    <select disabled class="form-control " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                        <option <?php echo @$record->$column == "Controlled"? 'selected':''; ?> value="Controlled">Controlled</option>
                                                                        <option <?php echo @$record->$column == "Free of Cost"? 'selected':''; ?> value="Free of Cost">Free of Cost</option>
                                                                        <option <?php echo @$record->$column == "De-Controlled"? 'selected':''; ?> value="De-Controlled">De-Controlled</option>
                                                                        <option <?php echo @$record->$column == "As Per SRO"? 'selected':''; ?> value="As Per SRO">As Per SRO</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td style="display: none">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'proposedPrice'; ?>
                                                                    <input disabled type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
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

                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Product Category'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'productCategoryId'; ?>
                                    <select disabled class="form-control select2" id="<?php echo @$column; ?>" >
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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Finished Product Specification'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'pharmacopeiaId'; ?>
                                    <select disabled class="form-control select2" id="<?php echo @$column; ?>" >
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
                                    <input type="text" disabled id="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Shelf Life Unit'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'shelfLifeunit'; ?>
                                    <select disabled class="form-control select2" id="<?php echo @$column; ?>" >
                                        <option selected value="Year(s)">Year(s)</option>
                                        <option <?php echo @$recordsEdit[0]->$column == 'Months(s)'?'selected':''; ?> value="Months(s)">Month(s)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php $label = 'Manufacturing Type'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'regTypeId'; ?>
                                    <select class="form-control select2" id="<?php echo @$column; ?>" >
                                        <option value="">Select <?php echo @$label; ?></option>
                                        <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Self Manufacturing</option>
                                        <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Contract Manufacturing</option>
                                        <option <?php echo @$recordsEdit[0]->$column == 3?'selected':''; ?> value="3">Import</option>
                                    </select>
                                </div>
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
                                                <?php if($this->roleId <> 26){ ?>
                                                    <th style="width:30%" >Company</th>
                                                    <?php
                                                }
                                                ?>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Address</th>
                                                <th>Country</th>

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
                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="rowId">
                                                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>"  value="0" class="deleteRow">
                                                        </td>

                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'companyName'; ?>
                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control cname">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'role'; ?>
                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control">
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $column = 'companyAddress'; ?>
                                                                    <textarea disabled id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>"  class="form-control cadd" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <?php $label = 'Country'; ?>
                                                                    <?php $column = 'companyCountry'; ?>
                                                                    <select disabled class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>">
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
                      <div class="tab-pane fade" id="tab3">

                        <div class="row" style="float: left; width: 100%;">

                            <?php if(@$recordsEdit[0]->registrationTypeId == 12){?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Manufacturer Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyName'; ?>
                                        <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo (@$recordsEdit[0]->isUpdated == 1)?@$recordsEdit[0]->$column:''; ?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                    <div class="form-group">
                                        <?php $label = 'Fee Challan'; ?>
                                        <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                        <?php $column = 'postchangeFeeChallanPath'; ?>
                                        <div class="custom-file">
                                            <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                    <div class="form-group">
                                        <?php $label = 'Undertaking'; ?>
                                        <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                        <?php $column = 'pvUndertakingAttachment'; ?>
                                        <div class="custom-file">
                                            <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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


                                <?php if($this->companySubCategory == 'Manufacturer'){ ?>
                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                        <div class="form-group">
                                            <?php $label = 'CLB Approval Letter'; ?>
                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                            <?php $column = 'pvApprovalAttachment'; ?>
                                            <div class="custom-file">
                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $label; ?> Link</label>
                                            <br>
                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                        <div class="form-group">
                                            <?php $label = 'Contract between Registraion/MA holder and Manufacturer'; ?>
                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                            <?php $column = 'pvContractAttachment'; ?>
                                            <div class="custom-file">
                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $label; ?> Link</label>
                                            <br>
                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                        </div>
                                    </div>


                                <?php } ?>

                            <?php if($this->companySubCategory == 'Importer'){ ?>


                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                        <div class="form-group">
                                            <?php $label = 'Original Legalized CoPP as per WHO format / GMP Certificate '; ?>
                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                            <?php $column = 'pvLegalAttachment'; ?>
                                            <div class="custom-file">
                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $label; ?> Link</label>
                                            <br>
                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                        </div>
                                    </div>

                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                        <div class="form-group">
                                            <?php $label = 'Revised Sole Agency Agreement <small> if change in MAH</small>'; ?>
                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                            <?php $column = 'pvAgreementAttachment'; ?>
                                            <div class="custom-file">
                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $label; ?> Link</label>
                                            <br>
                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                        </div>
                                    </div>


                                <?php } ?>


                            <?php } ?>


                            <?php if(@$recordsEdit[0]->registrationTypeId == 13){?>
                          <div class="col-md-4">
                            <div class="form-group">
                              <?php $label = 'Proposed Name 1'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'proposedName1'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo (@$recordsEdit[0]->isUpdated == 1)?@$recordsEdit[0]->$column:''; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <?php $label = 'Proposed Name 2'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'proposedName2'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo (@$recordsEdit[0]->isUpdated == 1)?@$recordsEdit[0]->$column:''; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-4">
                            <div class="form-group">
                              <?php $label = 'Proposed Name 3'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'proposedName3'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo (@$recordsEdit[0]->isUpdated == 1)?@$recordsEdit[0]->$column:''; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'maHolder'; ?>
                              <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo (@$recordsEdit[0]->isUpdated == 1)?@$recordsEdit[0]->$column:''; ?></textarea>
                            </div>
                          </div>

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Undertaking'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'pvUndertakingAttachment'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                    <div class="form-group">
                                        <?php $label = 'Details of last batch manufactured'; ?>
                                        <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                        <?php $column = 'pvBrandHistoryAttachment'; ?>
                                        <div class="custom-file">
                                            <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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


                          <div class="col-md-6"s <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Details of last batch manufactured'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'pvBatchAttachment'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                          <?php if($this->companySubCategory == 'Importer'){ ?>
                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                        <div class="form-group">
                                            <?php $label = 'Original Legalized CoPP as per WHO format / GMP Certificate '; ?>
                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                            <?php $column = 'pvLegalAttachment'; ?>
                                            <div class="custom-file">
                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo $label; ?> Link</label>
                                            <br>
                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                        </div>
                                    </div>

                          <?php } ?>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 14){?>


                               <?php if($this->companySubCategory == 'Importer'){ ?>
                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Fee Challan'; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'postchangeFeeChallanPath'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Form 5-F / Form-5/5A '; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvForm'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'NOC'; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvNocAttachment'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Termination Letter from manufacturer'; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvTerminationAttachment'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Revised Sole Agency Agreement <small> if change in MAH</small>'; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvAgreementAttachment'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                           </div>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label><?php echo $label; ?> Link</label>
                                           <br>
                                           <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                       </div>
                                   </div>



                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Original Legalized CoPP as per WHO format / GMP Certificate '; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvLegalAttachment'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                           </div>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label><?php echo $label; ?> Link</label>
                                           <br>
                                           <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                       </div>
                                   </div>

                               <?php } ?>

                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 15){?>
                               <?php if($this->companySubCategory == 'Importer'){ ?>

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                   <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                       <div class="form-group">
                                           <?php $label = 'Authority / Sole Agent Letter fron new MA/PL holder'; ?>
                                           <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                           <?php $column = 'pvAgreementAttachment'; ?>
                                           <div class="custom-file">
                                               <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                               <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                           </div>
                                       </div>
                                   </div>

                                   <div class="col-md-6">
                                       <div class="form-group">
                                           <label><?php echo $label; ?> Link</label>
                                           <br>
                                           <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                       </div>
                                   </div>
                                <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'MA/PL Approval Letter from Exporting Country'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvApprovalAttachment'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label><?php echo $label; ?> Link</label>
                                       <br>
                                       <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                   </div>
                               </div>

                               <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'Original Legalized Pharmaceutical Certificate as per WHO format'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvLegalAttachment'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label><?php echo $label; ?> Link</label>
                                       <br>
                                       <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                   </div>
                               </div>

                           <?php } ?>


                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 16){?>
                            <?php if($this->companySubCategory == 'Importer'){ ?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                               <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'DSL with new Name/Address'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvDSL'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label><?php echo $label; ?> Link</label>
                                       <br>
                                       <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                   </div>
                               </div>

                               <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'Sole Agency Agreement with new name of importer'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvAgreementAttachment'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label><?php echo $label; ?> Link</label>
                                       <br>
                                       <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                   </div>
                               </div>
                               <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'Approval of new name by SECP / registrar'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvApprovalAttachment'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label><?php echo $label; ?> Link</label>
                                       <br>
                                       <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i><?php echo @$recordsEdit[0]->$column; ?></a>
                                   </div>
                               </div>

                               <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                   <div class="form-group">
                                       <?php $label = 'Undertaking (No Case is pending at any forum/court)'; ?>
                                       <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                       <?php $column = 'pvUndertakingAttachment'; ?>
                                       <div class="custom-file">
                                           <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                           <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                           <?php
                               }
                            } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 17){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">INN</h3>
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
                                    <th>INN</th>
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
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'innManual'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'WHO or INN Reference'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'pvwhoInnRef'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 18){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Form 5-F'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'form5f'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'NOC'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'noc'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Inspection Report'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpReport'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of section approval of mew manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 19){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Form 5-F'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'form5f'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'NOC'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'noc'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Inspection Report'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpReport'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of section approval of mew manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <?php if($this->companySubCategory == 'Importer'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'COPP No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'coppNo'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'COPP Issuing Authority'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'coppIssuingAuthority'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'COPP Date of Issue'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'coppDateOfIssue'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'COPP Validity'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'coppValidity'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'FSC No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'fscNo'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'FSC Issuing Authority'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'fscIssuingAuthority'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'FSC Date of Issue'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'fscDateOfIssue'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'FSC Validity'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'fscValidity'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'GMP No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'gmpNo'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'GMP Issuing Authority'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'gmpIssuingAuthority'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'GMP Date of Issue'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'gmpDateOfIssue'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'GMP Validity'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'gmpValidity'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Sole Agency Agreement'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'soleAgencyAgreement'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Contract between product license holder and manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'contract'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Site Master File for new manufacturing site'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'siteMasterFIle'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 20){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Certificate of analysis'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'certificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Certificate'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Stability Data'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'stabilityData'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">INN</h3>
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
                                    <th>Manufacturer</th>
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
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'manufacturer'; ?>
                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
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

                           <?php if(@$recordsEdit[0]->registrationTypeId == 21){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Stability Data'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'stabilityData'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparison in existing and proposed excipients'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence that proposed excipient is a pharmaceutical grade'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 22){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparison in existing and proposed product form'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 23){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of approval by reference regulatory authority/ innovator/pharmacopeia'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Label Claim'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'labelClaim'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 24){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Official monograph attachment (in case firm is not using manufacturer specs)'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'monograph'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparison between official monograph vs manufacturer (in case firm wants to adopt manufacturer specification)'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Finished Product Specification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'pharmacopeiaId'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 25){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Shelf Life'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'shelfLife'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 26){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of reference regulatory authority/ innovator'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Storage Condition'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'storageCondition'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 27){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Details of proposed container closed system'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 28){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparision between existing and proposed'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Suitability testing as per pharmacopeia'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'suitability'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 29){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparision between existing and proposed'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 33){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Details of new process'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'detailsOfNewProcess'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 34){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparative studies between existing and proposed analytical method'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Validation/verification studies of proposed analytical method'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'validationStudies'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 35){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-12">
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
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO">
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

                           <?php if(@$recordsEdit[0]->registrationTypeId == 36){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Certificate of analysis'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'certificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Certificate'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Document for confirmation of manufacturing facility by regulatory authority of exporting country'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 37){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparison between existing and proposed'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence from regulatory authority/innovatory'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 47){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Comparison between existing and proposed'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Justification'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'justification'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 48){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of section approval of new manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Status'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'DML Status'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'dmlCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Previous approvals of contract manufacturing permission with validity'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'comparison'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'NOC from manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'noc'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                           <?php if(@$recordsEdit[0]->registrationTypeId == 49){?>
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'postchangeFeeChallanPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Form 5-F'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'form5f'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Evidence of section approval of new manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'evidence'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'GMP Status'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'gmpCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'DML Status'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'dmlCertificate'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'NOC from manufacturer'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'noc'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Contract Manufacturing Agreement (If applicable)'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'contractManufacturingAgreement'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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
                           <?php } ?>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab4">

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
                                <?php $myTable = 'tabledetailquery'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Date & Time</th>
                                    <th>Title</th>
                                    <th>Message</th>
                                    <th>Attachment</th>
                                    <th>Application Status</th>
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
                                      <td><?php echo $record->title; ?></td>
                                      <td><?php echo $record->message; ?></td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath'; ?>
                                            <a <?php if(!@$record>$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td><?php echo $record->applicationStatus; ?></td>
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

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab8">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-12">
                            <?php $label = 'Reviewer Evaluation'; ?>
                            <?php $column = 'reviewer1Remarks11'; ?>
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

                          <div class="col-md-12">
                            <?php $label = 'Reviewer Remarks'; ?>
                            <?php $column = 'reviewer2Remarks11'; ?>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Proposed'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionProposed'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId == '39'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Required'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionRequired'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId <> '39'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionTypeId'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId <> '39'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($inspectionType))
                                  {
                                    foreach ($inspectionType as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionSubType ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab5">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'File No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'regFileNo'; ?>
                                <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Registration No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'registrationNoManual'; ?>
                                <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Issue Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'regIssueDateManual'; ?>
                                <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <?php if($this->roleId == '19' && (@$recordsEdit[0]->registrationStatus == 'Post Board Process' || @$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->registrationStatus == 'Under Pricing' || @$recordsEdit[0]->registrationStatus == 'Pricing Complete' || @$recordsEdit[0]->registrationStatus == 'Deferred and Closed' || @$recordsEdit[0]->registrationStatus == 'Approved')){?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Approved Name'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'approvedName'; ?>
                                <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-12">
                            <?php $label = 'Registration Remarks (Shortcoming)'; ?>
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

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab6">

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
                                    <th class="text-center">Status</th>
                                    <?php if($myAction <> 'view'){ ?>
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
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'meetingDate'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'remarks'; ?>
                                            <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
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
                                      </td>
                                      <?php if($myAction <> 'view'){ ?>
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

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Required'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionRequired1'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionTypeId1'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($inspectionType))
                                  {
                                    foreach ($inspectionType as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionSubType ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab7">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Note Sheet</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="//height: 300px;">
                                <?php $myTable = 'tabledetailhistory'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th class="text-center" width="10%">Date</th>
                                    <th class="text-center" width="20%">Designation</th>
                                    <th class="text-center" width="20%">Forwarded To</th>
                                    <th class="text-center" width="40%">Remarks</th>
                                    <th class="text-center" width="10%">Status</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailHistory))
                                    {
                                        foreach($recordsDetailHistory as $record)
                                        {
                                    ?>
                                    <tr>
                                      <td class="srNo">
                                        <span><?=$sn?></span>.
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
                                      <td class="text-center">
                                        <?php echo $record->status; ?>
                                      </td>
                                    </tr>
                                    <?php $sId++ ?>
                                    <?php $sn++ ?>
                                    <?php
                                        }
                                    }
                                    ?>
                                    <tr>
                                      <td class="srNo">
                                        <span><?=$sn?></span>.
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
                                                      <option value="<?php echo $detail->id ?>"><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
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
                                        <?php if($this->roleId == '19' || $this->roleId == '51'){?>
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

                          <div class="col-md-12">
                            <?php $label = 'Inspection Remarks'; ?>
                            <?php $column = 'panelRemarks'; ?>
                            <div class="card card-outline card-primary">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <?php echo $label; ?>
                                </h3>
                              </div>
                              <div class="card-body">
                                <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Additional Report'; ?>
                              <?php $column = 'inspectionReportPath'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Rating'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'rating'; ?>
                              <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <option value="Very Good" <?php if('Very Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Very Good</option>
                                <option value="Good" <?php if('Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Good</option>
                                <option value="Average" <?php if('Average' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Average</option>
                                <option value="Not Recommended" <?php if('Not Recommended' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Not Recommended</option>
                              </select>
                            </div>
                          </div>

                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <?php if($this->roleId == 26){ ?>
              <div class="col-md-6" style="display: none;">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'postchangeStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Save">Save</option>
                    <option value="Submit">Submit</option>
                  </select>
                </div>
              </div>
              <?php } ?>

              <?php if($this->roleId <> 26){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'postchangeStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <?php
                    if($this->roleId == '7'){ // Registration Director
                      echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      <option value="Approved">Approved</option>
                      ';
                    }
                    if($this->roleId == '11'){ // Registration Additional Director
                      echo '
                      <option value="Save">Save</option>
                      ';
                    }
                    if($this->roleId == '15'){ // Registration Deputy Director
                      echo '
                      <option value="Save">Save</option>
                      ';
                    }
                    if($this->roleId == '19'){ // Registration Assistant Director
                      echo '
                      <option value="Save">Save</option>
                      <option value="Referred Back To Company">Referred Back To Company</option>
                      <option value="Proceed">Proceed</option>
                      ';
                    }
                    if($this->roleId == '39'){ // Registration Assigning Officer
                      echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      ';
                    }
                    if($this->roleId == '44'){ // Registration Board Secretary
                      echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      ';
                    }
                    if($this->roleId == '45'){ // Registration Pricing User
                      echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      ';
                    }
                    if($this->roleId == '51'){ // Registration Screening Officer
                      echo '
                      <option value="Save">Save</option>
                      <option value="Referred Back To Company">Referred Back To Company</option>
                      <option value="Proceed">Proceed</option>
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
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($this->roleId == 26){ ?>
            <?php if($myAction == 'add'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save">';}?>
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save"> <input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="formSubmit" value="Submit">';}?>
            <?php } ?>
            <?php if($this->roleId <> 26){ ?>
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" value="Submit">';}?>
            <?php } ?>
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

<script type="text/javascript">
  loadMyTable('table', true, 15);
  loadMyTable('tabledetailhistory', false, -1);

  loadMyTable('tabledetailproposedbrandname', false, -1);
  $('#tabledetailproposedbrandname').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailproposedbrandname';
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

  loadMyTable('tabledetailinn', false, -1);
  $('#tabledetailinn').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailinn';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      // $.ajax({
      //   url:"<?php echo base_url(); ?>myController/innAjaxGet",
      //   method:"POST",
      //   success:function(data)
      //   {
      //     $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
      //   }
      //  });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_unit', columnName:'unit'},
        success:function(data)
        {
          $("td:eq(4)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(4).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailproposedpacking', false, -1);
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

  loadMyTable('tabledetaildomesticreference', false, -1);
  $('#tabledetaildomesticreference').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetaildomesticreference';
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

  loadMyTable('tabledetailinternationalreference', false, -1);
  $('#tabledetailinternationalreference').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailinternationalreference';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_regulatorybody', columnName:'regulatoryBody'},
        success:function(data)
        {
          $("td:eq(3)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  $("#formSave").click(function() { 
    $('#postchangeStatus').val('Save');
  });
  $("#formSubmit").click(function() { 
    $('#postchangeStatus').val('Submit');
  });

  $(function () {
    $('#reviewer1Remarks').summernote()
    $('#reviewer1Remarks2').summernote()
    $('#reviewer1Remarks3').summernote()
    $('#panelOfInspector1').summernote()
    $('#panelRemarks').summernote()
    $('#reviewer1Remarks11').summernote()
    $('#reviewer2Remarks11').summernote()

    <?php if($myAction == 'view'){ ?>
    $('#reviewer1Remarks').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view'){ ?>
    $('#reviewer1Remarks2').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view'){ ?>
    $('#reviewer1Remarks3').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view'){ ?>
    $('#panelOfInspector1').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view' || $this->roleId <> 26){ ?>
    $('#panelRemarks').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view' || $this->roleId <> 19 || @$recordsEdit[0]->postchangeStatus <> 'Under Review Stage 1'){ ?>
    $('#reviewer1Remarks11').summernote('disable');
    <?php } ?>
    <?php if($myAction == 'view' || $this->roleId <> 19 || @$recordsEdit[0]->postchangeStatus <> 'Post Board Process'){ ?>
    $('#reviewer2Remarks11').summernote('disable');
    <?php } ?>
  })
</script>