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
/*
if(@$records[0]->countLicense > 0 && $this->roleId == 26 && $myAction == 'add'){
  $this->session->set_flashdata('success', 'Nice Try ;D');
  header("Location:".base_url().$pageTitle[0]->url.'/lookup');
  exit();
}*/
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


    <?php if($myAction == 'add' || $myAction == 'edit' || $myAction == 'view'){ ?>
    <div class="container-fluid">
      <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';}?>
        <div class="card card-primary card-outline1">
          <div class="card-header">
            <h3 class="card-title"><?php if($myAction == 'add'){echo 'Add';} if($myAction == 'edit'){echo 'Edit';} if($myAction == 'view'){echo 'View';} ?> Details</h3>

            <!-- <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body cardBodyTransaction">
				<h4 class="text-center"><?php echo @$recordsEdit[0]->phase; ?></h4>
				<h6 class="text-center"><?php echo @$recordsEdit[0]->licenseStatus; ?></h6>
             <!--
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
-->
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
				  <iframe src="https://maps.google.com/maps?q=<?php echo @$recordsEdit[0]->latitude.', '.@$recordsEdit[0]->longitude; ?>&z=12&output=embed" width="100%" height="280" frameborder="0" allowfullscreen="" style="border:0"></iframe>

                  <!--<iframe src="<?php  @$recordsEdit[0]->googleMapURL ?>" width="100%" height="280" frameborder="0" style="border:0;" allowfullscreen=""></iframe>-->
                </div>
              </div>
              <?php } ?>

              <?php if($myAction == 'add'){ ?>
              <div class="col-md-12">
                <br>
                <div class="form-group">
                  <label>Current Phase</label>
                  <br>
                  <i><u><?php echo 'Site Verification'; ?></u></i>
                </div>
              </div>
              <?php } ?>

              <?php if($myAction <> 'add'){ ?>
              <div class="col-md-12">
                <br>
                <div class="form-group">
                  <label>Current Phase</label>
                  <br>
                  <i><u><?php echo @$recordsEdit[0]->phase; ?></u></i>
                </div>
              </div>
              <?php } ?>

              <div class="col-md-12">
                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs">

                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab4">License Record</a>
                      </li>

                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade active show" id="tab4">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Management Team</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailmanagement1'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Name</th>
                                    <th>Father Name</th>
                                    <th>Address</th>
                                    <th>NIC</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Remarks</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailManagement))
                                    {
                                        foreach($recordsDetailManagement as $record)
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
                                            <?php $column = 'name'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'fatherName'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'address'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'nic'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'department'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'designation'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'phone'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'email'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                        <td>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php $column = 'remarks'; ?>
                                                    <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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

                          <?php if(@$recordsEdit[0]->licenseTypeId == 1 || @$recordsEdit[0]->licenseTypeId == 2){ ?>
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">API</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailapi'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed1" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>API Name</th>
                                    <th>Application Form <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Fee Challan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Chemical Names Manufacturing <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Chemical Names Recycled <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Manufacturing Flow Chart <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Theorical Yied <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Trial Batches <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Reference Monograph <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Testing Equipments <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Shelf Life Of API <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Material Safety Data <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Remarks</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(empty($recordsDetailApi))
                                    {
                                      unset($record);
                                      @$recordsDetailApi[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailApi))
                                    {
                                        foreach($recordsDetailApi as $record)
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
                                            <?php $column = 'apiName'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath2'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath3'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath4'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath5'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath6'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath7'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath8'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath9'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath10'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath11'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                              <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                        <td>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <?php $column = 'remarks'; ?>
                                                    <input required  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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
                                                  <th>Remarks</th>

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
                                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                              <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                          </td>
                                                          <td>
                                                              <div class="col-md-12">
                                                                  <div class="form-group">
                                                                      <?php $column = 'facilityname'; ?>
                                                                      <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                  </div>
                                                              </div>
                                                          </td>
                                                         <td>
                                                                                                     <div class="col-md-12">
                                                                                                         <div class="form-group">
                                                                                                             <?php $column = 'remarks'; ?>
                                                                                                             <input required  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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

                          <?php if(@$recordsEdit[0]->licenseTypeId == 6 && 1 == 7){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Repacking Drug'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'pvmg4'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                          <?php } ?>

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
                                    <th class="text-center">Action</th>
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
                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'name'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'fatherName'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'address'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'nic'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'phone'; ?>
                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'Designation'; ?>
                                            <?php $column = 'designationId'; ?>
                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($designation))
                                                {
                                                  foreach ($designation as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->designation ?></option>
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
                                            <?php $label = 'Qualification'; ?>
                                            <?php $column = 'qualificationId'; ?>
                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($qualification))
                                                {
                                                  foreach ($qualification as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->qualification ?></option>
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
                                            <?php $label = 'Specialization'; ?>
                                            <?php $column = 'specializationId'; ?>
                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($specialization))
                                                {
                                                  foreach ($specialization as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->specialization ?></option>
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
                                                                                            <input required  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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




                          <?php if(@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2){ ?>
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
                                    <th>Ready for Inspection</th>
                                      <th>Remarks</th>
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
                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'Section'; ?>
                                            <?php $column = 'sectionId'; ?>
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'approved'; ?>
                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="" <?php if('' == @$record->$column){ echo 'selected'; } ?>>Select ---</option>
                                              <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                              <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
                                            </select>
                                          </div>
                                        </div>
                                      </td>

                                        <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'remarks'; ?>
                                                                                            <input required  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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

                    </div>
                  </div>
                </div>
              </div>





              <?php if($this->roleId <> 26){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'licenseStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option selected value="Save">Save</option>

                  </select>
                </div>
              </div>
              <?php } ?>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">

            <?php if($this->roleId <> 26){ ?>
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" value="Submit"> ';}?>
            <?php } ?>
              <a class="btn btn-warning" target="_blank" href="<?php echo base_url().'report/view/License Report/'.@$recordsEdit[0]->id; ?>">License Report</a>
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
  loadMyTable('tabledetailsections', false, -1);

  loadMyTable('tabledetailmanagement', false, -1);
  $('#tabledetailmanagement').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmanagement';
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

  loadMyTable('tabledetaillayoutplan', false, -1);
  $('#tabledetaillayoutplan').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetaillayoutplan';
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

  loadMyTable('tabledetailsection', false, -1);
  $('#tabledetailsection').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailsection';
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
        data:{table:'tbl_section', columnName:'section'},
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
      });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_pharmagroup', columnName:'pharmaGroup'},
        success:function(data)
        {
          $("td:eq(2)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(2).children().children().children().attr("name") +'">'+data+'</select>');
        }
      });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_usedfor', columnName:'usedFor'},
        success:function(data)
        {
          $("td:eq(3)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select>');
        }
      });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailfacility', false, -1);
  $('#tabledetailfacility').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailfacility';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });
  loadMyTable('tabledetailapi', false, -1);
  $('#tabledetailapi').on( 'click', '.plus', function () {
      var myCurrentTable = 'tabledetailapi';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailqualifiedstaff', false, -1);
  $('#tabledetailqualifiedstaff').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailqualifiedstaff';
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
        data:{table:'tbl_companydesignation', columnName:'designation'},
        success:function(data)
        {
          $("td:eq(6)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(6).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_companyqualification', columnName:'qualification'},
        success:function(data)
        {
          $("td:eq(7)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(7).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbl_companyspecialization', columnName:'specialization'},
        success:function(data)
        {
          $("td:eq(8)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(8).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailsection2', false, -1);
  $('#tabledetailsection2').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailsection2';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/sectionApprovedAjaxGet11",
        method:"POST",
        data:{data:'<?php echo @$recordsEdit[0]->id ?>'},
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/pharmaGroupApprovedAjaxGet11",
        method:"POST",
        data:{data:'<?php echo @$recordsEdit[0]->id ?>'},
        success:function(data)
        {
          $("td:eq(2)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(2).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $.ajax({
        url:"<?php echo base_url(); ?>myController/usedForApprovedAjaxGet11",
        method:"POST",
        data:{data:'<?php echo @$recordsEdit[0]->id ?>'},
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
    $('#licenseStatus').val('Save');
  });
  $("#formSubmit").click(function() { 
    $('#licenseStatus').val('Submit');
  });

  $(function () {

      $("input[type='file']").on("change", function () {
          if(this.files[0].size > 5000000) {
              alert("Please upload file less than 5MB. Thanks!!");
              $(this).val('');
          }
      });

    $('#reviewer1Remarks').summernote()
    $('#reviewer1Remarks2').summernote()
    $('#reviewer1Remarks3').summernote()
    $('#panelOfInspector1').summernote()
    $('#panelRemarks').summernote()

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
  })
</script>