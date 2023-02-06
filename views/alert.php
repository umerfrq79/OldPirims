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
                <?php
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New Alert</a>';
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
                  <th>Type</th>
                  <th>Date & Time</th>
                  <th>Name</th>
                  <th>Alert After</th>
                  <th>Description</th>
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
                    <td><?php echo $record->type; ?></td>
                    <td><?php echo $record->dateTime; ?></td>
                    <td><?php echo $record->alertName; ?></td>
                    <td><?php echo $record->duration; ?></td>
                    <td><?php echo $record->description; ?></td>
                    <td class="text-center">
                      <b><h4><span <?php if($record->status == "Active"){echo "class='badge bg-success'";} if($record->status == "Inactive"){echo "class='badge bg-warning'";} ?>><?php echo $record->status; ?></span></h4></b>
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
                  <?php $label = 'Type'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'type'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" onchange="showFilters()">
                    <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                    <option value="Broadcast" <?php if('Broadcast' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Broadcast</option>
                    <!-- <option value="User" <?php if('User' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>User</option> -->
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Date & Time'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'dateTime'; ?>
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> readonly type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php if(@$recordsEdit[0]->$column){echo @$recordsEdit[0]->$column;}else{echo date($this->dateTimeFormat);} ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'alertName'; ?>
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Alert After'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'duration'; ?>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="now" <?php if('now' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Now</option>
                      <option value="1 MINUTE" <?php if('1 MINUTE' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>1 Minute</option>
                      <option value="5 MINUTE" <?php if('5 MINUTE' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>5 Minutes</option>
                      <option value="15 MINUTE" <?php if('15 MINUTE' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>15 Minutes</option>
                      <option value="1 HOUR" <?php if('1 HOUR' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>1 Hour</option>
                      <option value="3 HOUR" <?php if('3 HOUR' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>3 Hours</option>
                      <option value="6 HOUR" <?php if('6 HOUR' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>6 Hours</option>
                      <option value="12 HOUR" <?php if('12 HOUR' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>12 Hours</option>
                      <option value="1 DAY" <?php if('1 DAY' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>1 Day</option>
                      <option value="3 DAY" <?php if('3 DAY' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>3 Days</option>
                      <option value="5 DAY" <?php if('5 DAY' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>5 Days</option>
                      <option value="1 MONTH" <?php if('1 MONTH' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>1 Month</option>
                      <option value="3 MONTH" <?php if('3 MONTH' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>3 Months</option>
                      <option value="6 MONTH" <?php if('6 MONTH' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>6 Months</option>
                      <option value="1 YEAR" <?php if('1 YEAR' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>1 Year</option>
                    </select>
                </div>
              </div>

              <script type="text/javascript">
                $(document).ready(function(){
                  var value = $('#type').val();
                    if(value == '0'){
                        $("#companyDiv").hide();
                        $("#unitDiv").hide();
                        $("#departmentDiv").hide();
                        $("#designationDiv").hide();
                        $("#userDiv").hide();
                    }
                    if(value == 'Broadcast'){
                        $("#companyDiv").hide();
                        $("#unitDiv").hide();
                        $("#departmentDiv").hide();
                        $("#designationDiv").hide();
                        $("#userDiv").hide();
                    }
                    if(value == 'Company'){
                        $("#companyDiv").show();
                        $("#unitDiv").hide();
                        $("#departmentDiv").hide();
                        $("#designationDiv").hide();
                        $("#userDiv").hide();
                    }
                    if(value == 'Unit'){
                        $("#companyDiv").hide();
                        $("#unitDiv").show();
                        $("#departmentDiv").hide();
                        $("#designationDiv").hide();
                        $("#userDiv").hide();
                    }
                    if(value == 'Department'){
                        $("#companyDiv").hide();
                        $("#unitDiv").hide();
                        $("#departmentDiv").show();
                        $("#designationDiv").hide();
                        $("#userDiv").hide();
                    }
                    if(value == 'Designation'){
                        $("#companyDiv").hide();
                        $("#unitDiv").hide();
                        $("#departmentDiv").hide();
                        $("#designationDiv").show();
                        $("#userDiv").hide();
                    }
                    if(value == 'User'){
                        $("#companyDiv").hide();
                        $("#unitDiv").hide();
                        $("#departmentDiv").hide();
                        $("#designationDiv").hide();
                        $("#userDiv").show();
                    }
                });
                function showFilters(){
                  var value = $('#type').val();
                    if(value == '0'){
                        $("#userDiv").hide();
                    }
                    if(value == 'Broadcast'){
                        $("#userDiv").hide();
                    }
                    if(value == 'User'){
                        $("#userDiv").show();
                    }
                }
              </script>

              <!-- <div class="col-md-6" id="userDiv" style="display: none;">
                <div class="form-group">
                  <label>User</label>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" multiple size="15" data-placeholder="Select User" id="userId" name="recepients">
                      <option value="">Select User</option>
                      <?php
                        if(!empty($user))
                        {
                          foreach ($user as $record)
                          {
                              ?>
                              <option value="<?php echo $record->id ?>"><?php echo $record->userName ?></option>
                              <?php
                          }
                        }
                      ?>
                    </select>
                </div>
              </div> -->

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
                  <?php $label = 'Remarks'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'status'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Active" <?php if('Active' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Active</option>
                    <option value="Inactive" <?php if('Inactive' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Inactive</option>
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
</script>