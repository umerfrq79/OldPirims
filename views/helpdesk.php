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
                <a href="<?php echo base_url(); ?>userguide/lookup" class="btn btn-link"><i class="fas fa-book"></i> User Guide</a>
                <?php
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> Ask Question</a>';
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
                  <th>Date & Time</th>
                  <th>Ticket No.</th>
                  <!-- <th>User Name</th> -->
                  <!-- <th>Module Name</th> -->
                  <!-- <th>Page Name</th> -->
                  <!-- <th>Field Name</th> -->
                  <th>Description</th>
                  <!-- <th>Steps To Reproduce Error</th> -->
                  <!-- <th>Current Behaviour</th> -->
                  <!-- <th>Ideal Scenario</th> -->
                  <!-- <th>Error Code</th> -->
                  <th class="text-center">Issue Status</th>
                  <th class="text-center">Client Status</th>
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
                    <td><?php echo $record->id; ?></td>
                    <!-- <td><?php echo $record->userName; ?></td> -->
                    <!-- <td><?php echo $record->moduleName; ?></td> -->
                    <!-- <td><?php echo $record->pageName; ?></td> -->
                    <!-- <td><?php echo $record->fieldName; ?></td> -->
                    <td><?php echo $record->description; ?></td>
                    <!-- <td><?php echo $record->stepsToReproduceError; ?></td> -->
                    <!-- <td><?php echo $record->currentBehaviour; ?></td> -->
                    <!-- <td><?php echo $record->idealScenario; ?></td> -->
                    <!-- <td><?php echo $record->errorCode; ?></td> -->
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->issueStatus == 'Logged'){echo 'primary';} elseif($record->issueStatus == 'In Process'){echo 'warning';} elseif($record->issueStatus == 'Fixed'){echo 'success';} elseif($record->issueStatus == 'Cancelled'){echo 'default';} ?>'><?php echo $record->issueStatus; ?></span></h4></b>
                    </td>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->clientStatus == 'Fixed'){echo 'success';} elseif($record->clientStatus == 'Not Fixed'){echo 'danger';} ?>'><?php echo $record->clientStatus; ?></span></h4></b>
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
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
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
                  <?php $label = 'Module Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'moduleName'; ?>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="Admin" <?php if('Admin' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Admin</option>
                      <option value="Help Desk" <?php if('Help Desk' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Help Desk</option>
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Page Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'pageName'; ?>
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Field Name(s) (If Any)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'fieldName'; ?>
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Description'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'description'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Steps To Reproduce Error'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'stepsToReproduceError'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Current Behaviour'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'currentBehaviour'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Ideal Scenario'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'idealScenario'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'attachment'; ?>
                  <div class="custom-file">
                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                    <input type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input">
                    <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment Preview'; ?>
                  <label><?php echo $label; ?></label>
                  <br>
                  <a <?php if(!@$recordsEdit[0]->attachment){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->attachment){ echo 'href="'.base_url().'uploads/company/company/MedRS/docs/'.@$recordsEdit[0]->attachment.'"';} ?> target="_blank" class="btn btn-success"><i class="far fa-file"></i></a>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Error Code (If Any)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'errorCode'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <?php if($this->roleId == 1){ ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php $label = 'Issue Status'; ?>
                    <label><?php echo $label; ?></label>
                    <?php $column = 'issueStatus'; ?>
                    <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="Logged" <?php if('Logged' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Logged</option>
                      <option value="In Process" <?php if('In Process' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>In Process</option>
                      <option value="Fixed" <?php if('Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Fixed</option>
                      <option value="Cancelled" <?php if('Cancelled' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Cancelled</option>
                    </select>
                  </div>
                </div>
              <?php } ?>
              <?php if($this->roleId <> 1){ ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php $label = 'Issue Status'; ?>
                    <label><?php echo $label; ?></label>
                    <?php $column = 'issueStatus'; ?>
                    <select disabled class="form-control select2 required" id="<?php echo @$column; ?>" name="">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="Logged" <?php if('Logged' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Logged</option>
                      <option value="In Process" <?php if('In Process' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>In Process</option>
                      <option value="Fixed" <?php if('Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Fixed</option>
                      <option value="Cancelled" <?php if('Cancelled' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Cancelled</option>
                    </select>
                  </div>
                </div>
                <input disabled type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="">
            <?php } ?>

              <?php if($this->roleId == 1){ ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php $label = 'Client Status'; ?>
                    <label><?php echo $label; ?></label>
                    <?php $column = 'clientStatus'; ?>
                    <select disabled class="form-control select2 required" id="<?php echo @$column; ?>" name="">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="Fixed" <?php if('Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Fixed</option>
                      <option value="Not Fixed" <?php if('Not Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Not Fixed</option>
                    </select>
                  </div>
                </div>
                <input disabled type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="">
              <?php } ?>
              <?php if($this->roleId <> 1){ ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <?php $label = 'Client Status'; ?>
                    <label><?php echo $label; ?></label>
                    <?php $column = 'clientStatus'; ?>
                    <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="Fixed" <?php if('Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Fixed</option>
                      <option value="Not Fixed" <?php if('Not Fixed' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Not Fixed</option>
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
</script>