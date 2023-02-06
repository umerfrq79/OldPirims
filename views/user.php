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
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>';
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
                  <th></th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Country</th>
                  <th>Department</th>
                  <th>Designation</th>
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
                    <td class="text-center widthMaxContent"><img src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/profilepic/<?php echo $record->profilepic; ?>" class="img-circle" alt="User Image" style="width: 100%; max-width: 45px; height: auto; max-height: 45px;">
                    </td>
                    <td><?php echo $record->userName; ?></td>
                    <td><?php echo $record->email; ?></td>
                    <td><?php echo $record->phone; ?></td>
                    <td><?php echo $record->countryName; ?></td>
                    <td><?php echo $record->department; ?></td>
                    <td><?php echo $record->designation; ?></td>
                    <td class="text-center">
                      <b><h4><span <?php if($record->status == "Active"){echo "class='badge bg-success'";} if($record->status == "Inactive"){echo "class='badge bg-warning'";} if($record->status == "Suspended"){echo "class='badge bg-gray'";} if($record->status == "Expired"){echo "class='badge bg-danger'";} if($record->status == "Closed"){echo "class='badge bg-black'";} ?>><?php echo $record->status; ?></span></h4></b>
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
                  <?php $label = 'Role'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'roleId'; ?>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="">Select <?php echo @$label; ?></option>
                      <?php
                        if(!empty($role))
                        {
                          foreach ($role as $record)
                          {
                              ?>
                              <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->department.' &mdash; '.$record->designation ?></option>
                              <?php
                          }
                        }
                      ?>
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'User Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'userName'; ?>
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Country'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'countryId'; ?>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="">Select <?php echo @$label; ?></option>
                      <?php
                        if(!empty($country))
                        {
                          foreach ($country as $record)
                          {
                              ?>
                              <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->countryName ?></option>
                              <?php
                          }
                        }
                      ?>
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Email (will be used to login)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'email'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Province'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'stateId'; ?>
                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="">Select <?php echo @$label; ?></option>
                      <?php
                        if(!empty($state))
                        {
                          foreach ($state as $record)
                          {
                              ?>
                              <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->stateName ?></option>
                              <?php
                          }
                        }
                      ?>
                    </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'New Password'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'password'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="password" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Start Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'startDate'; ?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Confirm New Password'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'cpassword'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="password" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" equalTo="#password">
                </div>
              </div>

            </div>
            <!-- /.row -->
          <div class="row">
            <!-- row -->

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'End Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'endDate'; ?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Resume Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'resumeDate'; ?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Phone'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'phone'; ?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Profile Picture'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'profilepic'; ?>
                  <div class="custom-file">
                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input">
                    <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Address'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'address'; ?>
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
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Active" <?php if('Active' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Active</option>
                    <option value="Inactive" <?php if('Inactive' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Inactive</option>
                    <option value="Suspended" <?php if('Suspended' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Suspended</option>
                    <option value="Blocked" <?php if('Blocked' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Blocked</option>
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