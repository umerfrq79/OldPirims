<?php
if(@$applicationStatus[0]->status == 'Approved' || @$applicationStatus[0]->status == 'Deferred and Closed' || @$applicationStatus[0]->status == 'Follow-Up Inspection' || @$applicationStatus[0]->status == 'Re-Inspection'){
  //if($this->userId <> 27){
  header("Location:".base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
  exit();
  //}
}

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
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">
<!--               <form action="<?php echo base_url().$pageTitle[0]->url.'/lookup/' ?>" method="POST">
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
                  <th>Date & Time</th>
                  <th>Referrence No. (Module)</th>
                  <th>Type</th>
                  <th>Title</th>
                  <!-- <th>From</th> -->
                  <th>Message / Reply</th>
                  <th>Application Status</th>
                  <th class="text-center">Status</th>
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
                    <td><?php echo $record->dateTime; ?></td>
                    <td><?php echo $record->masterId.' ('.$record->type.')'; ?></td>
                    <td><?php echo $record->type; ?></td>
                    <td><?php echo $record->title; ?></td>
                    <!-- <td><?php //if($record->userName == $this->userName){ echo 'ME';} else{ echo 'DRAP';} ?></td> -->
                    <td><?php echo $record->message; ?></td>
                    <td><?php echo $record->applicationStatus; ?></td>
                    <td class="text-center">
                      <b><h4><span <?php if($record->status == "Submitted Requested Document To DRAP"){echo "class='badge bg-success'";} if($record->status == "Info Required From Company"){echo "class='badge bg-warning'";} ?>><?php echo $record->status; ?></span></h4></b>
                    </td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">
                            <?php if($record->status <> 'Submitted Requested Document To DRAP' && $record->applicationStatus <> 'Under Board Stage 2' && $record->applicationStatus <> 'Recommended By Board Stage 3' && $record->applicationStatus <> 'Deferred and Closed' && $record->applicationStatus <> 'Approved'){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'query/edit/'.$record->id.'/'.$record->type.'/'.$record->masterId.'">Reply</a></li>
                            ';} ?>
                          </ul>
                        </div>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <!-- <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a> -->
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

              <?php if($myAction <> 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Title / Referrence'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'title'; ?>
                    <input readonly <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="Re: <?php echo @$title; ?>" class="form-control required">
                </div>
              </div>
              <?php } ?>

              <?php if($myAction == 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Title / Referrence'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'title'; ?>
                    <input readonly <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$title; ?>" class="form-control required">
                </div>
              </div>
              <?php } ?>

              <?php if(@$recordsEdit[0]->status == 'Info Required From Company' && $myAction <> 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'filePath'; ?>
                  <div class="custom-file">
                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                  </div>
                </div>
              </div>
              <?php } ?>

              <?php if(@$recordsEdit[0]->status <> 'Info Required From Company' && $myAction == 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment'; ?>
                  <?php $column = 'filePath'; ?>
                  <label><?php echo $label; ?> Link</label>
                  <br>
                  <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$this->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                </div>
              </div>
              <?php } ?>

              <?php if(@$recordsEdit[0]->status <> 'Info Required From Company' || $myAction == 'view'){ ?>

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
                    <div class="col-md-5">
                        <div class="form-group">
                            <?php $label = 'Challan No <small>(Optional Additional Fee if requested)</small>'; ?>
                            <label><?php echo $label; ?></label>
                            <?php $column = 'challan_no'; ?>
                            <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
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
                    <div class="col-md-5">
                        <p class="text-danger mb-12 challan-status">Challan Status:</p>
                        <p class="text-default mb-10" id="verify_result"></p>
                    </div>
                <?php } ?>
              <?php if(@$recordsEdit[0]->status == 'Info Required From Company' && $myAction <> 'view'){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Message'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'question'; ?>
                    <?php echo @$recordsEdit[0]->shortcomming; ?>
                    <!--
                  <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->shortcomming; ?></textarea>
                -->
                </div>
              </div>
              <?php } ?>

              <?php if($myAction == 'view'){ ?>
              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Message'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'message'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>
              <?php } ?>

              <?php if($myAction <> 'view'){ ?>




                  <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Reply'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'message'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                </div>
              </div>
              <?php } ?>

              <?php if($myAction == 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'status'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Info Required From Company" <?php if('Info Required From Company' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Info Required From Company</option>
                    <option value="Submitted Requested Document To DRAP" <?php if('Submitted Requested Document To DRAP' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Submitted Requested Document To DRAP</option>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if($myAction <> 'view'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'status'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <?php if($this->roleId <> 26){ ?>
                    <option value="Info Required From Company">Info Required From Company</option>
                    <?php } ?>
                    <?php if($this->roleId == 26){ ?>
                    <option value="Submitted Requested Document To DRAP">Submitted Requested Document To DRAP</option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <?php } ?>

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
  $(function () {

      $("input[type='file']").on("change", function () {
          if (this.files[0].size > 5000000) {
              alert("Please upload file less than 5MB. Thanks!!");
              $(this).val('');
          }
      });
  });
</script>