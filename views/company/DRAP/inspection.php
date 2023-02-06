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
                <?php if($this->roleId == '36'){
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New Inspection</a>';
                }?>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">
              <!-- <form action="<?php echo base_url().$pageTitle[0]->url.'/lookup/' ?>" method="POST">
                <div class="input-group input-group-sm float-right" style="width: 150px;">
                  &nbsp;<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control float-right" placeholder="Search">

                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </form> -->
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <?php if($this->roleId <> 26){ ?>
                  <th>Company</th>
                  <?php } ?>
                  <th>Inspection Type</th>
                  <?php if($this->roleId <> 26){ ?>
                  <th>Inspection Name</th>
                  <?php } ?>
                  <th>Inspection Date</th>
                  <th>Lead</th>
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
                  <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <?php if($this->roleId <> 26){ ?>
                    <td><?php echo $record->companyName; ?></td>
                    <?php } ?>
                    <td><?php echo $record->inspectionType.' &mdash; '.$record->inspectionSubType; ?></td>
                    <?php if($this->roleId <> 26){ ?>
                    <td><?php echo $record->inspectionName; ?></td>
                    <?php } ?>
                    <td><?php echo $record->inspectionFromDate.' &mdash; '.$record->inspectionToDate; ?></td>
                    <td><?php echo $record->leadUserName; ?></td>
                    <?php if($record->inspectionStatus == 'Approved' && $this->roleId == '26'){
                            $record->inspectionStatus = 'Inspection Completed';
                          } 
                    ?>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->inspectionStatus == 'Draft'){echo 'warning';} elseif($record->inspectionStatus == 'Inspection Scheduled' || $record->inspectionStatus == 'Inspection Pending'){echo 'info';} elseif($record->inspectionStatus == 'Initiated' || $record->inspectionStatus == 'Inspection Completed'){echo 'primary';} elseif($record->inspectionStatus == 'Panel Meeting Scheduled' || $record->inspectionStatus == 'Panel Meeting Pending'){echo 'info';} elseif($record->inspectionStatus == 'Under Review Stage 1'){echo 'primary';} elseif($record->inspectionStatus == 'CAPA Awaited From Company'){echo 'warning';} elseif($record->inspectionStatus == 'CAPA Received From Company'){echo 'info';} elseif($record->inspectionStatus == 'Under Review Stage 2' || $record->inspectionStatus == 'Review Complete'){echo 'primary';} elseif($record->inspectionStatus == 'Further Information Required'){echo 'warning';} elseif($record->inspectionStatus == 'Follow-Up Inspection'){echo 'secondary';} elseif($record->inspectionStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->inspectionStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->inspectionStatus; ?></span></h4></b>
                    </td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">
                            <?php if($record->inspectionStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Inspection Certificate/'.$record->id.'">Inspection Certificate</a></li>
                            ';} ?>
                            <?php if($this->roleId <> 26 && @$record->inspectionTypeId == 5){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Letter/'.$record->refId.'">Site Verification Letter</a></li>
                            ';} ?>
                            <?php if($this->roleId <> 26 && (@$record->inspectionTypeId == 6 || @$record->inspectionTypeId == 7)){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Letter/'.$record->refId.'">Site Verification Letter</a></li>
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Grant of License Panel of Inspector/'.$record->refId.'">Grant of License Panel of Inspector</a></li>
                            ';} ?>
                            <?php if($this->roleId <> 26 && ( @$record->inspectionTypeId == 9)){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Inspection Request Panel of Inspector/'.$record->refId.'">Inspection Request Panel of Inspector</a></li>
                            ';} ?>
                          </ul>
                        </div>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <?php if($record->inspectionStatus <> 'Approved'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        <?php } ?>
                        <?php if($record->inspectionStatus == 'Draft1'){ ?>
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

              <?php if($this->roleId <> 26){ ?>
              <?php if($myAction <> 'add'){ ?>
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
                      <i><u><?php if(@$recordsEdit[0]->siteAddress){echo @$recordsEdit[0]->siteAddress.' '.@$recordsEdit[0]->siteCity;}else{echo @$recordsEdit[0]->siteAddress1.' '.@$recordsEdit[0]->siteCity1;} ?></u></i>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>License No.</label>
                      <br>
                      <i><u><?php if(@$recordsEdit[0]->licenseNoManual){echo @$recordsEdit[0]->licenseNoManual;}else{echo @$recordsEdit[0]->licenseNoManual1;} ?></u></i>
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
                </div>
              </div>
              <?php } ?>
              <?php } ?>

              <div class="col-md-12">
                <br>
                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link <?php echo (@$recordsEdit[0]->inspectionStatus == 'Draft')?'active':'active'; ?> " data-toggle="pill" href="#tab1">Pre Inspection Scheduling</a>
                      </li>
                      <?php if($myAction <> 'add'){ ?>
                      <?php if(@$recordsEdit[0]->inspectionStatus <> 'Draft'){ ?>
                      <?php if($this->roleId <> '26'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab2">Attachments</a>
                      </li>
                      <?php } ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab3">Documents Review</a>
                      </li>
                      <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab5">Inspection Meetings</a>
                      </li>
                      <?php if($this->roleId <> '26'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab4">Inspection Checklist</a>
                      </li>
                      <?php if(@$recordsEdit[0]->inspectionStatus == 'Inspection Completed' || @$recordsEdit[0]->inspectionStatus == 'Panel Meeting Scheduled' || @$recordsEdit[0]->inspectionStatus == 'Panel Meeting Pending' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1' || @$recordsEdit[0]->inspectionStatus == 'CAPA Awaited From Company' || @$recordsEdit[0]->inspectionStatus == 'CAPA Received From Company' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete' || @$recordsEdit[0]->inspectionStatus == 'Further Information Required' || @$recordsEdit[0]->inspectionStatus == 'Follow-Up Inspection' || @$recordsEdit[0]->inspectionStatus == 'Re-Inspection' || @$recordsEdit[0]->inspectionStatus == 'Approved'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab6">Post Inspection Scheduling</a>
                      </li>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php if($this->roleId <> '26' && @$recordsEdit[0]->inspectionStatus != 'Inspection Scheduled' && @$recordsEdit[0]->inspectionStatus != 'Inspection Pending'){ ?>
                      <li class="nav-item">
                        <a class="nav-link " data-toggle="pill" href="#tab7">Inspection Report</a>
                      </li>
                      <?php } ?>
                      <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                      <?php if($this->roleId <> '26'){ ?>
                      <?php if(@$recordsEdit[0]->inspectionStatus == 'Panel Meeting Scheduled' || @$recordsEdit[0]->inspectionStatus == 'Panel Meeting Pending' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1' || @$recordsEdit[0]->inspectionStatus == 'CAPA Awaited From Company' || @$recordsEdit[0]->inspectionStatus == 'CAPA Received From Company' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete' || @$recordsEdit[0]->inspectionStatus == 'Further Information Required' || @$recordsEdit[0]->inspectionStatus == 'Follow-Up Inspection' || @$recordsEdit[0]->inspectionStatus == 'Re-Inspection' || @$recordsEdit[0]->inspectionStatus == 'Approved'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab8">Review</a>
                      </li>
                      <?php } ?>
                      <?php } ?>
                      <?php if(@$recordsEdit[0]->inspectionStatus == 'CAPA Awaited From Company' || @$recordsEdit[0]->inspectionStatus == 'CAPA Received From Company' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete' || @$recordsEdit[0]->inspectionStatus == 'Further Information Required' || @$recordsEdit[0]->inspectionStatus == 'Follow-Up Inspection' || @$recordsEdit[0]->inspectionStatus == 'Re-Inspection' || @$recordsEdit[0]->inspectionStatus == 'Approved'){ ?>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab9">CAPA</a>
                      </li>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                      <?php } ?>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane fade show <?php echo (@$recordsEdit[0]->inspectionStatus == 'Draft')?'active':'active'; ?>" id="tab1">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if($myAction == 'add'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionTypeId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($inspectionType))
                                  {
                                    foreach ($inspectionType as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionType.' &mdash; '.$record->inspectionSubType ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>

                          <?php if($myAction <> 'add'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionTypeId'; ?>
                              <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($inspectionAllType))
                                  {
                                    foreach ($inspectionAllType as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionType.' &mdash; '.$record->inspectionSubType ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                          <?php } ?>

                          <?php if($this->roleId == '26'){ ?>
                          <div class="col-md-6">
                          </div>
                          <?php } ?>

                          <?php if($this->roleId <> '26'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Name (If Applicable)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection From Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionFromDate'; ?>
                                <input <?php if(($this->roleId <> 36 && $this->roleId <> 12) || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection To Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inspectionToDate'; ?>
                                <input <?php if(($this->roleId <> 36 && $this->roleId <> 12) || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <?php if($this->roleId == '26'){ ?>
                          <?php if(@$recordsEdit[0]->inspectionStatus == 'Inspection Scheduled'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Site Master File'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'siteMasterFile'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>

                          <?php if($myAction <> 'add'){ ?>
                          <?php if(@$recordsEdit[0]->inspectionStatus <> 'Draft'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Site Master File'; ?>
                              <?php $column = 'siteMasterFile'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 19){ ?>
                          <?php if($this->roleId == '26'){ ?>
                          <?php if(@$recordsEdit[0]->inspectionStatus == 'Inspection Scheduled'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'QIS File'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'qisFile'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                              </div>
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'QIS File'; ?>
                              <?php $column = 'qisFile'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>

                          <?php if($this->roleId <> '26'){ ?>
                          <?php if($myAction == 'add'){ ?>
                          <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Company'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'companyId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($company))
                                  {
                                    foreach ($company as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->companyName.($record->licenseNoManual?' ('.$record->licenseNoManual.') ':' - ').$record->companyAddress;  ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <?php } ?>

                          <?php if($myAction <> 'add'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Company'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'companyId'; ?>
                              <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($company))
                                  {
                                    foreach ($company as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->companyName ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>
                          <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                          <?php } ?>
                          <?php } ?>

                          <?php if($this->roleId == 12 || $this->roleId == 36 || $this->roleId == 26 || $this->userId == @$recordsEdit[0]->leadUserId){ ?>
                          <?php if($records[0]->inspectionTypeId == 6){ ?>
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
                                    if(empty($recordsDetailSection1))
                                    {
                                      unset($record);
                                      @$recordsDetailSection1[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailSection1))
                                    {
                                        foreach($recordsDetailSection1 as $record)
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
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($companySection))
                                                {
                                                  foreach ($companySection as $detail)
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
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 19){ ?>
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Product's Detail</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailregistration'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Section</th>
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
                                    if(empty($recordsDetailRegistration))
                                    {
                                      unset($record);
                                      @$recordsDetailRegistration[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailRegistration))
                                    {
                                        foreach($recordsDetailRegistration as $record)
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
                                            <?php $label = 'Product'; ?>
                                            <?php $column = 'registrationId'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($companyRegistration))
                                                {
                                                  foreach ($companyRegistration as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->approvedName ?></option>
                                                      <?php
                                                  }
                                                }
                                              ?>
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
                          <?php } ?>

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Pre Inspection Panel Members (Internal)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailmember'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Name</th>
                                    <th>Is Lead</th>
                                    <?php if($myAction <> 'view' && (($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus == 'Draft') || ($myAction == 'add'))){ ?>
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
                                    if(empty($recordsDetailMember))
                                    {
                                      unset($record);
                                      @$recordsDetailMember[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailMember))
                                    {
                                        foreach($recordsDetailMember as $record)
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
                                            <?php $label = 'Member'; ?>
                                            <?php $column = 'memberId'; ?>
                                            <select <?php if($myAction == 'view' || ($this->roleId <> 36 && $this->roleId <> 12) || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($member))
                                                {
                                                  foreach ($member as $detail)
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
                                            <?php $column = 'isLead'; ?>
                                            <select <?php if($myAction == 'view' || ($this->roleId <> 36 && $this->roleId <> 12) || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                              <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <?php if($myAction <> 'view' && (($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus == 'Draft') || ($myAction == 'add'))){ ?>
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

                          <?php if($this->roleId == 36 || $this->roleId == 12 || $this->userId == @$recordsEdit[0]->leadUserId){ ?>
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Pre Inspection Panel Members (External)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailmemberexternal'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Name</th>
                                    <?php if($myAction <> 'view' && (($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus == 'Draft') || ($myAction == 'add'))){ ?>
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
                                    if(empty($recordsDetailMemberExternal))
                                    {
                                      unset($record);
                                      @$recordsDetailMemberExternal[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailMemberExternal))
                                    {
                                        foreach($recordsDetailMemberExternal as $record)
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
                                            <?php $label = 'Member'; ?>
                                            <?php $column = 'memberId'; ?>
                                            <select <?php if($myAction == 'view' || ($this->roleId <> 36 && $this->roleId <> 12) || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($memberExternal))
                                                {
                                                  foreach ($memberExternal as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->memberName ?></option>
                                                      <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <?php if($myAction <> 'view' && (($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus == 'Draft') || ($myAction == 'add'))){ ?>
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

                          <?php } ?>

                          <?php if($this->roleId == '36' || $this->roleId == '12'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Send Inspection Schedule To Company?'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'sendInspectionScheduleToCompany'; ?>
                              <select <?php if($myAction == 'view' || ($myAction == 'edit' && @$recordsEdit[0]->inspectionStatus <> 'Draft')){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                              </select>
                            </div>
                          </div>
                          <?php } ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php $label = 'Remarks / Directions'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'inspectionDirections'; ?>
                                    <textarea <?php if($myAction == 'view' || $this->roleId <> 36 || $this->roleId <> 12){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                </div>
                            </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab2">

                        <div class="row" style="float: left; width: 100%;">
<!--
                         <div class="col-md-12" style="display: none;">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Attachments</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header --
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailimage'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>View / Take Image</th>
                                    <th>View / Browse Attachment</th>
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
                                    if(empty($recordsDetailImage))
                                    {
                                      unset($record);
                                    ?>
                                    <tr>
                                      <td class="srNo">
                                        <span><?=$sn?></span>.
                                        <?php $column = 'id'; ?>
                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?=$sn?>" class="rowId">
                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'Image Type'; ?>
                                            <?php $column = 'inspectionImageTypeI'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($inspectionImageType))
                                                {
                                                  foreach ($inspectionImageType as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->imageTyoe; ?></option>
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
                                            <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <a target="_blank" disabled class="btn btn-success" id="imageLink_<?php echo $sn; ?>"><i class="fa fa-image"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <a onClick="startCamera_<?php echo $sn; ?>()" class="btn btn-warning"><i class="fa fa-long-arrow-alt-right"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <a disabled onClick="take_snapshot_<?php echo $sn; ?>()" class="btn btn-success" id="take_snapshot_<?php echo $sn; ?>"><i class="fa fa-camera"></i></a>
                                            <input type="hidden" name="imageData_<?php echo $sn; ?>" class="imageData_<?php echo $sn; ?>" value="">
                                            <script language="JavaScript">
                                                function startCamera_<?php echo $sn; ?>(){
                                                    Webcam.set({
                                                        width: 490,
                                                        height: 390,
                                                        image_format: 'jpeg',
                                                        jpeg_quality: 90
                                                    });
                                                Webcam.attach( '#my_camera' );
                                                $("#take_snapshot_"+<?php echo $sn; ?>).attr( "disabled", false );
                                                }
                                                function take_snapshot_<?php echo $sn; ?>() {
                                                    Webcam.snap( function(data_uri) {
                                                        $(".imageData_"+<?php echo $sn; ?>).val(data_uri);
                                                        $("#imageLink_"+<?php echo $sn; ?>).attr( "href", data_uri );
                                                    } );
                                                }
                                            </script>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a disabled class="btn btn-success"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <input type="file" id="tabledetailimage-filePath_<?=$sn?>" name="tabledetailimage-filePath_<?php echo $sId; ?>" value="">
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
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailImage))
                                    {
                                        foreach($recordsDetailImage as $record)
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
                                            <?php $label = 'Image Type'; ?>
                                            <?php $column = 'inspectionImageTypeI'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($inspectionImageType))
                                                {
                                                  foreach ($inspectionImageType as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->imageTyoe ?></option>
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
                                            <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-8">
                                          <div class="form-group">
                                            <a target="_blank" href="<?php echo $record->imageData; ?>" class="btn btn-success" id="imageLink_<?php echo $sn; ?>"><i class="fa fa-image"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <a onClick="startCamera_<?php echo $sn; ?>()" class="btn btn-warning"><i class="fa fa-long-arrow-alt-right"></i></a>
                                          </div>
                                        </div>
                                        <div class="col-md-2">
                                          <div class="form-group">
                                            <a disabled onClick="take_snapshot_<?php echo $sn; ?>()" class="btn btn-success" id="take_snapshot_<?php echo $sn; ?>"><i class="fa fa-camera"></i></a>
                                            <input type="hidden" name="tabledetailimage-imageData_detail[]" class="imageData_<?php echo $sn; ?>" value="<?php echo $record->imageData; ?>">
                                            <script language="JavaScript">
                                                function startCamera_<?php echo $sn; ?>(){
                                                    Webcam.set({
                                                        width: 490,
                                                        height: 390,
                                                        image_format: 'jpeg',
                                                        jpeg_quality: 90
                                                    });
                                                Webcam.attach( '#my_camera' );
                                                $("#take_snapshot_"+<?php echo $sn; ?>).attr( "disabled", false );
                                                }
                                                function take_snapshot_<?php echo $sn; ?>() {
                                                    Webcam.snap( function(data_uri) {
                                                        $(".imageData_"+<?php echo $sn; ?>).val(data_uri);
                                                        $("#imageLink_"+<?php echo $sn; ?>).attr( "href", data_uri );
                                                    } );
                                                }
                                            </script>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <a <?php if(!$record->filePath){ echo 'disabled';} ?> <?php if($record->filePath){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/Inspection/'.$record->filePath.'"';} ?> target="_blank" class="btn btn-success"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>

                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <input type="hidden" id="tabledetailimage-filePathHidden_<?=$sn?>" name="tabledetailimage-filePath_<?php echo $sId; ?>" value="<?php echo $record->filePath; ?>">
                                            <input type="file" id="tabledetailimage-filePath_<?=$sn?>" name="tabledetailimage-filePath_<?php echo $sId; ?>" value="">
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
                                  </tfoot> --
                                </table>
                              </div>
                              <!-- /.card-body --
                            </div>
                            <!-- /.card --
                          </div>
-->
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Attachments</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailimage1'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Attachment <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <?php if($myAction <> 'view' && $this->userId == @$recordsEdit[0]->leadUserId && @$recordsEdit[0]->inspectionStatus == 'Initiated'){ ?>
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
                                    if(empty($recordsDetailImage))
                                    {
                                      unset($record);
                                      @$recordsDetailImage[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailImage))
                                    {
                                        foreach($recordsDetailImage as $record)
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
                                                  <?php $label = 'Type'; ?>
                                                  <?php $column = 'attachmentType'; ?>
                                                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                      <option value="">Select <?php echo @$label; ?></option>
                                                      <!--<option value="0" <?php if(@$record->$column == 0){ echo 'selected'; } ?>>Image</option>
                                                      <option value="1" <?php if(@$record->$column == 1){ echo 'selected'; } ?>>Video</option>
                                                      -->
                                                      <?php
                                                      if(!empty($inspectionImageType))
                                                      {
                                                          foreach ($inspectionImageType as $detail)
                                                          {
                                                              ?>
                                                              <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->imageType; ?></option>
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
                                            <textarea <?php if($myAction == 'view' || $this->userId <> @$recordsEdit[0]->leadUserId || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6" <?php if($this->userId <> @$recordsEdit[0]->leadUserId || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'style="display:none;"';}?>>
                                          <div class="form-group">
                                            <?php $column = 'filePath'; ?>
                                            <div class="custom-file">
                                              <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
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
                                      <?php if($myAction <> 'view' && $this->userId == @$recordsEdit[0]->leadUserId && @$recordsEdit[0]->inspectionStatus == 'Initiated'){ ?>
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

                          <div class="col-md-12 text-center">
                              <center>
                              <div id="my_camera"></div>
                              </center>
                          </div>
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab3">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                            <div class="col-md-12">
                              <?php
                                  $headShow = false;
                                  $headNameShow = '';
                                  if(!empty($checklist))
                                  {
                                    foreach ($checklist as $record)
                                    {
                                      if($headNameShow <> ''){
                                        $headShow = false;
                                      }
                                      if($headNameShow == $record->headName){
                                        $headNameShow = $record->headName;
                                        $headShow = false;
                                      }
                                      if($headNameShow <> $record->headName){
                                        $headNameShow = $record->headName;
                                        $headShow = true;
                                      }
                                      if($headNameShow == ''){
                                        $headNameShow = $record->headName;
                                         $headShow = true;
                                      }
                                        ?>
                                        <div class="row">
                                          <?php if($headShow == true){echo '<h2>'.$record->headName.'</h2>' ;} $headShow = false;?>
                                          <div class="col-md-12">
                                          </div>
                                          <div class="col-md-2">
                                            <div class="form-group">
                                                  <input <?php if($this->roleId == '26' || $this->userId <> @$recordsEdit[0]->leadUserId || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){ echo 'disabled';} ?> type="checkbox"
                                                    <?php
                                                          if(!empty($recordsDetailDocumentChecklist))
                                                          {
                                                            foreach ($recordsDetailDocumentChecklist as $detail)
                                                            {
                                                                if($record->id == $detail->checklistCheckedId){
                                                                  echo 'checked';
                                                                }
                                                            }
                                                          }
                                                        ?>
                                                   id="checklistCheckedId_<?php echo $record->id ?>" name="tabledetaildocumentchecklist-checklistCheckedId_detail[]" value="<?php echo $record->id ?>">
                                                   <input type="hidden" id="tabledetaildocumentchecklist-id_<?php echo $record->id ?>" name="tabledetaildocumentchecklist-id_detail[]" value="
                                                  <?php
                                                  if(!empty($recordsDetailDocumentChecklist))
                                                  {
                                                    foreach ($recordsDetailDocumentChecklist as $detail)
                                                    {
                                                      if($detail->checklistId == $record->id){
                                                        echo $detail->id;
                                                      }
                                                    }
                                                  }
                                                  ?>">
                                                  <input type="hidden" id="tabledetaildocumentchecklist-checklistId_<?php echo $record->id ?>" name="tabledetaildocumentchecklist-checklistId_detail[]" value="<?php echo $record->id; ?>">
                                                  <?php echo $record->checklistNo ?>
                                            </div>
                                          </div>
                                          <div class="col-md-10">
                                            <div class="form-group">
                                              <?php echo $record->checklistName ?>
                                            </div>
                                          </div>
                                        </div>
                                        <?php
                                    }
                                  }
                                ?>

                            </div>
                          <?php } ?>

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Management Team (Readonly)</h3>
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

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 5){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'SECP Documents'; ?>
                              <?php if(@$recordsEdit[0]->companyType == 'Private Limited' || @$recordsEdit[0]->companyType == 'Public Limited'){ $label = 'SECP Documents';} if(@$recordsEdit[0]->companyType == 'Sole Proprietor'){ $label = 'Affidavit Document';} ?>
                              <?php $column = 'svStatusOfFirm'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Copy Of CNIC'; ?>
                              <?php $column = 'svCopyOfCNIC'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <?php if(@$recordsEdit[0]->companyType == 'Partnership'){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Documents of Partnership from registrar of firm'; ?>
                              <?php $column = 'svRegistrationCertificate'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Complete Set of Land Documents'; ?>
                              <?php $column = 'svLandDocument'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Site Map'; ?>
                              <?php $column = 'svSiteMap'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 6){ ?>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 7){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Form-1'; ?>
                              <?php $column = 'dmlForm1'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Covering Letter'; ?>
                              <?php $column = 'dmlProForma'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Legal Status and management (SECP / Registration of firm documents/ Affidavit)'; ?>
                              <?php $column = 'dmlLegalStatus'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Fee Challan'; ?>
                              <?php $column = 'dmlFeeChallan'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Layout Plan (Readonly)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetaillayoutplans'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Layout Plan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                    <th>Description</th>
                                    <th>Approved Layout Plan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailLayoutPlan))
                                    {
                                        foreach($recordsDetailLayoutPlan as $record)
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
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'description'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'approvedFilePath'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
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
                                <h3 class="card-title">Section's Detail (Readonly)</h3>
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
                                <h3 class="card-title">API (Readonly)</h3>
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
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
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
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath2'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePat3'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath4'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath5'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath6'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath7'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath8'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath9'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath10'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <?php $column = 'filePath11'; ?>
                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
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
                          <?php if(@$recordsEdit[0]->licenseTypeId == 6){ ?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Repacking Drug'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'pvmg4'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                          <?php } ?>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 8){ ?>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 9){ ?>
                          <?php } ?>

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 7 || @$recordsEdit[0]->inspectionTypeId == 8 || @$recordsEdit[0]->inspectionTypeId == 9){ ?>
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Qualified Staff (Readonly)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailqualifiedstaffs'; ?>
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
                                            <?php $column = 'phone'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $label = 'Designation'; ?>
                                            <?php $column = 'designationId'; ?>
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                              <?php $label = 'Production Incharge Documents'; ?>
                              <?php $column = 'qsDocuments'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'QC Incharge Documents'; ?>
                              <?php $column = 'qsDocuments2'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <?php if($this->roleId <> '26'){ ?>
                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Section's Detail</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailsections1'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Section</th>
                                    <th>Pharmacological Group</th>
                                    <th>Used For</th>
                                    <th>Ready for Inspection</th>
                                    <th>Recommended By Panel</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
                                    ?>
                                    <?php
                                    if(!empty($sectionApproved))
                                    {
                                        foreach($sectionApproved as $record)
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                              <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'recommended'; ?>
                                            <select <?php if($myAction == 'view' || $this->userId <> @$recordsEdit[0]->leadUserId){echo 'disabled';}?> class="form-control required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="" <?php if('' == @$record->$column){ echo 'selected'; } ?>>Select ---</option>
                                              <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                              <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
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

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Machine's Detail (Readonly)</h3>
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
                                  </tr>
                                  </thead>
                                  <tbody>
                                    <?php 
                                      $sn = 1;
                                      $sId = 0;
                                      $total = 0;
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
                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($sectionApproved))
                                                {
                                                  foreach ($sectionApproved as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->sectionId ?>" <?php if($detail->sectionId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
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
                                                if(!empty($pharmaGroupApproved))
                                                {
                                                  foreach ($pharmaGroupApproved as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->pharmaGroupId ?>" <?php if($detail->pharmaGroupId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
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
                                                if(!empty($usedForApproved))
                                                {
                                                  foreach ($usedForApproved as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->usedForId ?>" <?php if($detail->usedForId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
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
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'machineMake'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'machineModel'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'machinePartNo'; ?>
                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
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
                      <div class="tab-pane fade" id="tab5">

                        <div class="row" style="float: left; width: 100%;">

                         <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Meetings</h3>
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
                                    <th>Meeting Date</th>
                                    <th>Opening Meeting Remarks</th>
                                    <th>Closing Meeting Remarks</th>
                                    <?php if($this->roleId <> '26'){ ?>
                                    <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Initiated'){ ?>
                                    <th class="text-center">Action</th>
                                    <?php } ?>
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
                                            <?php $column = 'meetingDate'; ?>
                                              <input <?php if($this->roleId == '26'){ echo 'disabled'; }?> <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'openingMeeting'; ?>
                                            <textarea <?php if($this->roleId == '26'){ echo 'disabled'; }?> <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'closingMeeting'; ?>
                                            <textarea <?php if($this->roleId == '26'){ echo 'disabled'; }?> <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <?php if($this->roleId <> '26'){ ?>
                                      <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Initiated'){ ?>
                                      <td class="text-center widthMaxContent">
                                        <div class="btn-group">
                                          <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                            <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                        </div>
                                      </td>
                                      <?php } ?>
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
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab4">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Checklist'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a href="<?php if($myAction == 'edit'){echo base_url().'inspectionchecklist/edit/'.@$recordsEdit[0]->id;} if($myAction == 'view'){echo base_url().'inspectionchecklist/view/'.@$recordsEdit[0]->id;} ?>" target="_blank" class="btn btn-success"><i class="fa fa-file"></i></a>
                            </div>
                          </div> -->
                          <?php } ?>

                          <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Overall System Observations'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'overallSystemObservations'; ?>
                              <textarea <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                            </div>
                          </div>
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab6">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Panel Meeting Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'panelMeetingDate'; ?>
                                <input <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Inspection Completed'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-12">
                            <div class="card card-primary card-outline">
                              <div class="card-header">
                                <h3 class="card-title">Post Inspection Panel Members (Internal)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailmemberpost'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Name</th>
                                    <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Inspection Completed'){ ?>
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
                                    if(empty($recordsDetailMemberPost))
                                    {
                                      unset($record);
                                      @$recordsDetailMemberPost[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailMemberPost))
                                    {
                                        foreach($recordsDetailMemberPost as $record)
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
                                            <?php $label = 'Member'; ?>
                                            <?php $column = 'memberId'; ?>
                                            <select <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Inspection Completed'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($memberLead))
                                                {
                                                  foreach ($memberLead as $detail)
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
                                      <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Inspection Completed'){ ?>
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
                                <h3 class="card-title">Post Inspection Panel Members (External)</h3>
                                <div class="card-tools">
                                </div>
                              </div>
                              <!-- /.card-header -->
                              <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                <?php $myTable = 'tabledetailmemberexternalpost'; ?>
                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                  <thead>
                                  <tr>
                                    <th>S.#</th>
                                    <th>Name</th>
                                    <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Inspection Completed'){ ?>
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
                                    if(empty($recordsDetailMemberExternalPost))
                                    {
                                      unset($record);
                                      @$recordsDetailMemberExternalPost[0]->id = 1;
                                    }
                                    ?>
                                    <?php
                                    if(!empty($recordsDetailMemberExternalPost))
                                    {
                                        foreach($recordsDetailMemberExternalPost as $record)
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
                                            <?php $label = 'Member'; ?>
                                            <?php $column = 'memberId'; ?>
                                            <select <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Inspection Completed'){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="">Select <?php echo @$label; ?></option>
                                              <?php
                                                if(!empty($memberExternal))
                                                {
                                                  foreach ($memberExternal as $detail)
                                                  {
                                                      ?>
                                                      <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->memberName ?></option>
                                                      <?php
                                                  }
                                                }
                                              ?>
                                            </select>
                                          </div>
                                        </div>
                                      </td>
                                      <?php if($myAction <> 'view' && @$recordsEdit[0]->inspectionStatus == 'Inspection Completed'){ ?>
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
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab7">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Report'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a href="<?php if($myAction == 'edit'){echo base_url().'inspectionchecklist/edit/'.@$recordsEdit[0]->id;} if($myAction == 'view'){echo base_url().'inspectionchecklist/view/'.@$recordsEdit[0]->id;} ?>" target="_blank" class="btn btn-success"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                          </div> -->
                          <?php } ?>

                          <?php if($this->userId == @$recordsEdit[0]->leadUserId){ ?>
                          <div class="col-md-6" <?php if(@$recordsEdit[0]->inspectionStatus <> 'Initiated'){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Inspection Additional Report'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'inspectionReportPath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                              </div>
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Inspection Additional Report'; ?>
                              <?php $column = 'inspectionReportPath'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab8">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-12">
                            <?php $label = 'Panel Remarks'; ?>
                            <?php $column = 'panelRemarks'; ?>
                            <div class="card card-outline card-primary">
                              <div class="card-header">
                                <h3 class="card-title">
                                  <?php echo $label; ?>
                                </h3>
                              </div>
                              <div class="card-body">
                                <textarea <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Under Review Stage 1'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Panel Status'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'panelStatus'; ?>
                              <select <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Under Review Stage 1'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="Non-Compliant (NC)" <?php if('Non-Compliant (NC)' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Non-Compliant (NC)</option>
                                <option value="Compliant (CAPA Required)" <?php if('Compliant (CAPA Required)' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Compliant (CAPA Required)</option>
                                <option value="Compliant (CAPA Not Required)" <?php if('Compliant (CAPA Not Required)' == @$recordsEdit[0]->$column){ echo 'Compliant (CAPA Not Required)'; } ?>>Compliant (CAPA Not Required)</option>
                                <option value="Follow-Up Inspection Required" <?php if('Follow-Up Inspection Required' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Follow-Up Inspection Required</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Proposed Inspection Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'proposedInspectionDate'; ?>
                                <input <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Under Review Stage 1'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                            </div>
                          </div>

                          <?php if(@$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1'){?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Non-Conformance Report'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'ncrFilePath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                              </div>
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Non-Conformance Report'; ?>
                              <?php $column = 'ncrFilePath'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.$this->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab9">

                        <div class="row" style="float: left; width: 100%;">

                          <?php if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){ ?>
                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'CAPA'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a href="<?php if($myAction == 'edit'){echo base_url().'capa/edit/'.@$recordsEdit[0]->id;} if($myAction == 'view'){echo base_url().'capa/view/'.@$recordsEdit[0]->id;} ?>" target="_blank" class="btn btn-success"><i class="fa fa-file"></i></a>
                            </div>
                          </div> -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Non-Conformance Report'; ?>
                              <?php $column = 'ncrFilePath'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.$this->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6">
                          </div>

                          <?php if($this->roleId == '26'){?>
                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'CAPA Document'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'capaFilePath'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                              </div>
                            </div>
                          </div>
                          <?php } ?>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'CAPA Document'; ?>
                              <?php $column = 'capaFilePath'; ?>
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.$this->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>
                          <?php } ?>
                          
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <?php if($myAction <> 'add'){ ?>
              <?php if($this->roleId == 26){ ?>
              <?php if(@$recordsEdit[0]->inspectionStatus == 'Review Complete'){?>
              <!-- <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Decision'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'decision'; ?>
                  <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div> -->
              <?php } ?>
              <?php } ?>

              <?php if($this->roleId <> 26){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Recommendations'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea <?php if($this->roleId == 36){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <?php if(@$recordsEdit[0]->inspectionStatus != 'Draft' && @$recordsEdit[0]->inspectionStatus != 'Inspection Scheduled' && @$recordsEdit[0]->inspectionStatus != 'Inspection Pending'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Rating'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'rating'; ?>
                  <select <?php if($myAction == 'view' || ($this->userId != @$recordsEdit[0]->leadUserId)){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <option value="Very Good" <?php if('Very Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Very Good</option>
                    <option value="Good" <?php if('Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Good</option>
                    <option value="Average" <?php if('Average' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Average</option>
                    <option value="Not Recommended" <?php if('Not Recommended' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Not Recommended</option>
                  </select>
                </div>
              </div>
              <?php } ?>

              <?php if(@$recordsEdit[0]->inspectionStatus == 'Review Complete'){?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Decision'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'decision'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>
              <?php } ?>
              <?php } ?>
              <?php } ?>

              <?php if($this->roleId == 26){ ?>
              <div class="col-md-6" style="display: none;">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'inspectionStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Save">Save</option>
                    <option value="Submit">Submit</option>
                  </select>
                </div>
              </div>
              <?php } ?>

              <?php if($this->roleId <> 26){ ?>
              <?php if($myAction == 'add'){ ?>
              <div class="col-md-6" style="display: none;">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'inspectionStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Save">Save</option>
                    <option value="Submit">Submit</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if($myAction <> 'add'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'inspectionStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <?php
                    if($this->roleId == '6'){ // Director Licensing
                      echo '
                      <option value="Save">Save</option>
                      <option value="Further Information Required">Further Information Required</option>
                      <option value="Follow-Up Inspection">Follow-Up Inspection</option>
                      <option value="Re-Inspection">Re-Inspection</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      <option value="Approved">Approved</option>
                      <option value="Proceed">Proceed</option>
                      ';
                    }
                    if($this->roleId == '7'){ // Director Registration
                      echo '
                      <option value="Save">Save</option>
                      <option value="Further Information Required">Further Information Required</option>
                      <option value="Follow-Up Inspection">Follow-Up Inspection</option>
                      <option value="Re-Inspection">Re-Inspection</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      <option value="Approved">Approved</option>
                      <option value="Proceed">Proceed</option>
                      ';
                    }
                    if($this->roleId == '36' || $this->roleId == '12'){ // Director Inspection
						if($recordsEdit[0]->inspectionStatus == 'Draft'){
							echo '
							<option value="Save">Save</option>
							<option value="Proceed">Save and Submit</option>
							  ';
						}else if($recordsEdit[0]->inspectionStatus == 'Inspection Completed' ){
							if(@$recordsEdit[0]->inspectionTypeId == 12 || @$recordsEdit[0]->inspectionTypeId == 13 || @$recordsEdit[0]->inspectionTypeId == 14 || @$recordsEdit[0]->inspectionTypeId == 15 || @$recordsEdit[0]->inspectionTypeId == 19){
							echo '
							  <option value="Save">Save</option>
							  <option value="Further Information Required">Further Information Required</option>
							  <option value="Follow-Up Inspection">Follow-Up Inspection</option>
							  <option value="Re-Inspection">Re-Inspection</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="Approved">Approved</option>
							  <option value="Deferred and Closed">Deferred and Closed</option>
							  ';
							}else{
							echo '
							  <option value="Save">Save</option>
							  <!--<option value="Further Information Required">Further Information Required</option>-->
							  <!--<option value="Follow-Up Inspection">Follow-Up Inspection</option>-->
							  <!--<option value="Re-Inspection">Re-Inspection</option>-->
							  <!--<option value="Proceed">Proceed</option>-->
							  <option value="Approved">Approved</option>
							  <option value="Deferred and Closed">Deferred and Closed</option>
							  ';
							}
						}else{
							echo '
							  <option value="Save">Save</option>
							  <option value="Further Information Required">Further Information Required</option>
							  <option value="Follow-Up Inspection">Follow-Up Inspection</option>
							  <option value="Re-Inspection">Re-Inspection</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="Approved">Approved</option>
							  <option value="Deferred and Closed">Deferred and Closed</option>
							  ';
						}
                      
                    }
                    if(!empty($recordsDetailMember)){
                      foreach($recordsDetailMember as $detail)
                        {
                          if($detail->isLead == 'Yes'){
                            $currentUserId = $detail->userId;
                          }
                        }
                    }
                    if($this->userId == $currentUserId){ // Team Lead of Inspection
                      echo '
                      <option value="Save">Save</option>
                      <!--<option value="Further Information Required">Further Information Required</option>-->
                      <option value="Proceed">Save and Submit</option>
                      ';
                    }
                    if($this->roleId == '42'){ //CEO
                      echo '
                      <!-- <option value="Save">Save</option> -->
                      <!-- <option value="Further Information Required">Further Information Required</option> -->
                      <!-- <option value="Follow-Up Inspection">Follow-Up Inspection</option> -->
                      <!-- <option value="Re-Inspection">Re-Inspection</option> -->
                      <!-- <option value="Deferred and Closed">Deferred and Closed</option> -->
                      <!-- <option value="Approved">Approved</option> -->
                      <!-- <option value="Proceed">Proceed</option> -->
                      ';
                    }
                    ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php } ?>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($this->roleId == 26){ ?>
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save"> <input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="form_Submit" value="Submit">';}?>
            <?php } ?>
            <?php if($this->roleId <> 26){ ?>
            <?php if($myAction == 'add'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save">';}?>
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
$(document).ready(function() {
    $("input[type='file']").on("change", function () {
        if(this.files[0].size > 5000000) {
            alert("Please upload file less than 5MB. Thanks!!");
            $(this).val('');
        }
    });
    $('#formSubmit').prop("disabled", false);
    $('#myForm')
        .bootstrapValidator({
            excluded: [':disabled']
        })

        // Called when a field is invalid
        .on('error.field.bv', function(e, data) {
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id');

            $('a[href="#' + tabId + '"][data-toggle="tab"]')
                .parent()
                .find('i')
                .removeClass('fa-check')
                .addClass('fa-times');
        })

        // Called when a field is valid
        .on('success.field.bv', function(e, data) {
            // data.bv      --> The BootstrapValidator instance
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
                tabId    = $tabPane.attr('id'),
                $icon    = $('a[href="#' + tabId + '"][data-toggle="tab"]')
                            .parent()
                            .find('i')
                            .removeClass('fa-check fa-times');

            // Check if the submit button is clicked
            if (data.bv.getSubmitButton()) {
                // Check if all fields in tab are valid
                var isValidTab = data.bv.isValidContainer($tabPane);
                $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
            }
        });
});

  loadMyTable('table', true, 15);
  loadMyTable('tabledetailhistory', false, -1);

  loadMyTable('tabledetailmember', false, -1);
  $('#tabledetailmember').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmember';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/memberAjaxGet",
        method:"POST",
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailmemberexternal', false, -1);
  $('#tabledetailmemberexternal').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmemberexternal';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/memberExternalAjaxGet",
        method:"POST",
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailimage1', false, -1);
  $('#tabledetailimage1').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailimage1';
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
        data:{table:'tbl_inspectionimagetype', columnName:'imageType'},
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
      });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailmeeting', false, -1);
  $('#tabledetailmeeting').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmeeting';
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

  loadMyTable('tabledetailmemberpost', false, -1);
  $('#tabledetailmemberpost').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmemberpost';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/memberLeadAjaxGet",
        method:"POST",
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  loadMyTable('tabledetailmemberexternalpost', false, -1);
  $('#tabledetailmemberexternalpost').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailmemberexternalpost';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/memberExternalAjaxGet",
        method:"POST",
        success:function(data)
        {
          $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });

  $("#formSave").click(function() { 
    $('#inspectionStatus').val('Save');
  });
  $("#form_Submit").click(function() {
    $('#inspectionStatus').val('Submit');
  });

  $(function () {
    $('#panelRemarks').summernote()

    <?php if($myAction == 'view' || @$recordsEdit[0]->inspectionStatus <> 'Under Review Stage 1'){ ?>
    $('#panelRemarks').summernote('disable');
    <?php } ?>
  })
</script>
<script>
    $(document).ready(function(){
		
		
        // Setup - add a text input to each header cell
        $('#tabledetailimage thead tr').clone(true).appendTo( '#tabledetailimage thead' );
        $('#tabledetailimage thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            if(title == '' || title == 'S.#' || title == 'Action'){
              $(this).html( '' );
            }
            else{
              $(this).html( '<input type="text" class="form-control d-none" placeholder="Search '+title+'" />' );
            }
     
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailimage').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo -1 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailimage thead th" ).click(function() {
      $( "#tabledetailimage thead th input" ).removeClass('d-none');
    });
    $('#tabledetailimage').on( 'click', '.plus', function () {
      var tabledetailimage = document.getElementById('tabledetailimage');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailimage.rows[$("#tabledetailimage tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailimage.rows[$("#tabledetailimage tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailimage tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailimage tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<select class="form-control select2" id="'+ $("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("name") +'"></select>';
      columns[2] = '<textarea id="'+ $("#tabledetailimage tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailimage tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control" rows="3"></textarea>';
      columns[3] = '<div class="col-xs-8"><div class="form-group"><a target="_blank" disabled class="btn btn-success" id="imageLink_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'"><i class="fa fa-image"></i></a></div></div><div class="col-xs-2"><div class="form-group"><a onClick="startCamera_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'()" class="btn btn-warning"><i class="fa fa-long-arrow-alt-right"></i></a></div></div><div class="col-xs-2"><div class="form-group"><a disabled onClick="take_snapshot_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'()" class="btn btn-success" id="take_snapshot_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'"><i class="fa fa-camera"></i></a><input type="hidden" name="imageData_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" class="imageData_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" value=""><script language="JavaScript">function startCamera_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'(){Webcam.set({width: 490,height: 390,image_format: "jpeg",jpeg_quality: 90});Webcam.attach( "#my_camera" );$("#take_snapshot_"+'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +').attr( "disabled", false );}function take_snapshot_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'() {Webcam.snap( function(data_uri) {$(".imageData_"+'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +').val(data_uri);$("#imageLink_"+'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +').attr( "href", data_uri );} );} </scr'+'ipt></div></div>';
      columns[4] = '<div class="col-xs-6"><div class="form-group"><a disabled class="btn btn-success"><i class="fa fa-file"></i></a></div></div><div class="col-xs-6"><div class="form-group"><input type="file" id="'+ $("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("name").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("name").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(4).find("input").attr("name").split("_").length -1]) + parseInt("1")) +'" value=""></div></div>';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailimage').DataTable().row.add(columns).draw();
      $.ajax({
        url:"<?php echo base_url(); ?>myController/inspectionImageTypeAjaxGet",
        method:"POST",
        success:function(data)
        {
          myId = $("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailimage tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]));
         $('#'+myId).html(data);
        }
       });
      $('#tabledetailimage select').select2();
      $('#tabledetailimage tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetailimage').DataTable().destroy();
      $('#tabledetailimage').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailimage tbody').on( 'click', '.trash', function () {
        if($('#tabledetailimage tbody tr').length !== 1){
          // $('#'+myTable).DataTable()
          //     .row( $(this).parents('tr'))
          //     .remove()
          //     .draw();
          $(this).parents().closest('tr').attr('style', 'background-color: #c22f3c !important');
          $(this).parents().closest('tr').find('.deleteRow').val(1);
        }
      });
  </script>