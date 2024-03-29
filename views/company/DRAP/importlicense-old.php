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
    <?php if($myAction == 'lookup'){ ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lookup</h3>
              <div class="card-tools">
                <?php if(@$records[0]->countLicense < 1 && $this->roleId == 26){
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i>License Data</a>';
                  }
                ?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">
              <form action="<?php echo base_url().$pageTitle[0]->url.'/lookup/' ?>" method="POST">
                <div class="input-group input-group-sm float-right" style="width: 150px;">
                  &nbsp;<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form>
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th>Company</th>
                  <th>License No.</th>
                  <th>Phase</th>
                  <th class="text-center">Stage</th>
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
                  <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td><?php echo $record->companyName; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td>
                    <td><?php echo $record->phase; ?></td>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->licenseStatus == 'Draft'){echo 'warning';} elseif($record->licenseStatus == 'Submitted' || $record->licenseStatus == 'Screening' || $record->licenseStatus == 'Under R and I'){echo 'info';} elseif($record->licenseStatus == 'Received By DRAP' || $record->licenseStatus == 'Under Review Stage 1' || $record->licenseStatus == 'Under Inspection' || $record->licenseStatus == 'Post Inspection Process' || $record->licenseStatus == 'Under Board Stage 2'){echo 'primary';} elseif($record->licenseStatus == 'Referred Back To Company (Editable)' || $record->licenseStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->licenseStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->licenseStatus == 'Recommended By Board Stage 3' || $record->licenseStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->licenseStatus; ?></span></h4></b>
                    </td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <!-- <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">
                            <li class="dropdown-item"><a href="#">Dropdown link</a></li>
                            <li class="dropdown-item"><a href="#">Dropdown link</a></li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item"><a href="#">Separated link</a></li>
                          </ul>
                        </div> -->

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
            <div class="row">

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'License No.'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'licenseNoManual'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Issue Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'issueDate'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'License Validity'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'validTill'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Last Renewal Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'lastRenewalDate'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Phase'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'phase'; ?>
                  <select <?php if($myAction == 'view' || $this->roleId == 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <option value="Site Verification" <?php if('Site Verification' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Site Verification</option>
                    <option value="Layout Plan" <?php if('Layout Plan' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Layout Plan</option>
                    <option value="Grant of License" <?php if('Grant of License' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Grant of License</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Establishment License'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'licenseTypeId'; ?>
                  <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                      if(!empty($licenseType))
                      {
                        foreach ($licenseType as $record)
                        {
                            ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->licenseSubType ?></option>
                            <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>

              <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Management Team</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                    <?php $myTable = 'tabledetailmanagement'; ?>
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
                        if(empty($recordsDetailManagement))
                        {
                          unset($record);
                          @$recordsDetailManagement[0]->id = 1;
                        }
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
                                <?php $column = 'department'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'designation'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
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
                                <?php $column = 'email'; ?>
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

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Site Address'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'siteAddress'; ?>
                  <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Site City'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'siteCity'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Site Address Link (Google Map URL)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'googleMapURL'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Latitude'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'latitude'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Longitude'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'longitude'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Section's Detail</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                    <?php $myTable = 'tabledetailsection'; ?>
                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                      <thead>
                      <tr>
                        <th>S.#</th>
                        <th>Section</th>
                        <th>Pharmacological Group</th>
                        <th>Used For</th>
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
                        if(empty($recordsDetailSection))
                        {
                          unset($record);
                          @$recordsDetailSection[0]->id = 1;
                        }
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Courier Company'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'pvma4'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Tracking No.'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'pvma2'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'pvma3'; ?>
                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
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
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'fatherName'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'address'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'nic'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control " data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'phone'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $label = 'Designation'; ?>
                                <?php $column = 'designationId'; ?>
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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

              <div class="col-md-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Machine's Detail</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                    <?php $myTable = 'tabledetailsection2'; ?>
                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                      <thead>
                      <tr>
                        <th>S.#</th>
                        <th>Section</th>
                        <th>Pharmacological Group</th>
                        <th>Used For</th>
                        <th>Drug Name</th>
                        <th>Machine Make</th>
                        <th>Machine Model</th>
                        <th>Machine Serial No.</th>
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
                        if(empty($recordsDetailSectionMachine))
                        {
                          unset($record);
                          @$recordsDetailSectionMachine[0]->id = 1;
                        }
                        ?>
                        <?php
                        if(!empty($recordsDetailSectionMachine))
                        {
                            foreach($recordsDetailSectionMachine as $record)
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                <?php $column = 'drugName'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'machineMake'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'machineModel'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'machinePartNo'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
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
                  <?php $label = 'Site Verification Approval Letter'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'siteVerificationLetter'; ?>
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
                  <?php $label = 'Layout Plan Approval Letter'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'layoutPlanLetter'; ?>
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
                  <?php $label = 'License'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'licenseLetter'; ?>
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
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'licenseStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <?php if($this->roleId == 26){ ?>
                    <option value="Draft">Save</option>
                    <option value="Submitted">Submit</option>
                    <?php } ?>
                    <?php if($this->roleId <> 26){ ?>
                    <option value="Submitted">Save</option>
                    <option value="Approved">Approve</option>
                    <?php } ?>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-primary" value="Submit">';}?>
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
</script>