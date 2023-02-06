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
    <?php if($myAction == 'lookup'){ ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lookup</h3>
              <div class="card-tools">
                <?php if($this->roleId == 26){  //  ?>
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
                  <?php if($this->roleId <> 26){?>
                  <th>Company</th>
                  <?php } ?>
                  <th>Title</th>
                    <th>PBRER From</th>
                    <th>PBRER To</th>
                  <th>Submission Date</th>
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

                  ?>
                  <tr >
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <?php if($this->roleId <> 26){?>
                    <td><?php echo $record->companyName; ?></td>
                    <?php } ?>
                    <td><?php echo $record->title; ?></td>
                      <td><?php echo $record->pbrerFrom; ?></td>
                      <td><?php echo $record->pbrerTo; ?></td>
                      <td><?php echo $record->submissiondate; ?></td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">
                            <?php if($this->roleId <> '26'){ echo '
                            <!--<li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/License Note Sheet/'.$record->id.'">License Note Sheet</a></li>
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/All License Note Sheet/'.$record->id.'">All Applications License Note Sheet</a></li>
                            -->';} ?>
                          </ul>
                        </div>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>

                          <?php if($record->status == 'Draft'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        <?php } ?>

                          <?php if($this->roleId <> '26'){ ?>
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



              <div class="col-md-12">
                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab1">PBRER Details</a>
                      </li>

                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="tab1">

                        <div class="row" style="float: left; width: 100%;">


                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php $label = 'Title'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'title'; ?>
                                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php $label = 'PBRER From Date'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'pbrerFrom'; ?>
                                    <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php $label = 'PBRER To Date'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'pbrerTo'; ?>
                                    <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                </div>
                            </div>
<!--
                          <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = '(ICH E2C (R2)) as per GVP guidelines'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'pbrerAttachment'; ?>
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
                                    <?php $label = '(ICH E2C (R2)) as per GVP guidelines (part 2)'; ?>
                                    <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                    <?php $column = 'pbrerAttachment2'; ?>
                                    <div class="custom-file">
                                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
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
                                    <?php $label = '(ICH E2C (R2)) as per GVP guidelines (part 3)'; ?>
                                    <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                    <?php $column = 'pbrerAttachment3'; ?>
                                    <div class="custom-file">
                                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
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

                            <div class="col-md-12">
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <h3 class="card-title">Attachments</h3>
                                        <div class="card-tools">
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                        <?php $myTable = 'tabledetailattachments'; ?>
                                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>S.#</th>
                                                <th>Description</th>
                                                <th>(ICH E2C (R2)) as per GVP guidelines <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
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
                                            if(empty($recordsdetailattachments))
                                            {
                                                unset($record);
                                                @$recordsdetailattachments[0]->id = 1;
                                            }
                                            ?>
                                            <?php
                                            if(!empty($recordsdetailattachments))
                                            {
                                                foreach($recordsdetailattachments as $record)
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
                                                                    <?php $column = 'remarks'; ?>
                                                                    <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="col-md-6" <?php if($myAction == 'view'){echo 'style="display:none;"';}?>>
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

              <?php if($this->roleId == 26){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Applicant\'s Remarks'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Final Remarks By DRAP'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'finalRemarksShowToCompany'; ?>
                  <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>
              <?php } ?>

              <?php if($this->roleId <> 26){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Applicant\'s Remarks'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Final Remarks By DRAP'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'finalRemarksShowToCompany'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>
              <?php } ?>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($this->roleId == 26){ ?>
            <?php if($myAction == 'add'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" name="status" value="Save">';}?>
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save" name="status"> <input name="status" type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="formSubmit1" value="Submit">';}?>
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
  loadMyTable('tabledetailattachments', false, -1);
  $('#tabledetailattachments').on( 'click', '.plus', function () {
      var myCurrentTable = 'tabledetailattachments';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");


      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

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

  })
</script>