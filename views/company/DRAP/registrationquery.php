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

                  <a class="btn btn-primary" href="<?php echo base_url().$pageTitle[0]->url.'/add' ?>"><i class="fa fa-plus"></i> <?php echo $pageTitle[0]->friendlyName; ?></a>

              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">

              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th>Updated On</th>
                    <?php
                    if($this->roleId == 26){
                        ?>
                        <th class="text-center">Officer Name</th>
                        <?php
                    }else{
                        ?>
                        <th class="text-center">Company Name</th>
                        <?php
                    }
                    ?>

                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $sn=1; ?>
                  <?php
                  if(!empty($records))
                  {
                      $CI = & get_instance();
                      foreach($records as $record)
                      {
                        $seenBy = explode(",",$record->seenBy);
                          if ($this->roleId <> 26 && $record->officerid != $this->userId) {

                              continue;
                          }
                              ?>
                  <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td><?php echo $record->updateddate; ?></td>
                      <?php
                      if($this->roleId == 26){
                          $u_info[] = $CI->loginModel->getuserRecord($record->officerid);
                          ?>
                          <td class="text-center">
                              <?php echo $u_info[0]->userName.'<br>'.$u_info[0]->designation.' '.$u_info[0]->department; ?>
                          </td>
                          <?php
                      }else{
                          ?>
                          <td class="text-center">
                              <?php echo $record->companyName; ?>
                          </td>
                          <?php
                      }
                      ?>

                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">

                          </ul>
                        </div>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->companyId.'/'.$record->officerid.'/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->companyId.'/'.$record->officerid.'/'.$record->id;; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                          <!-- <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a> -->
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
              <div class="col-md-6">
                  <div class="form-group">
                      <?php $label = 'Company Name'; ?>
                      <label><?php echo $label; ?></label>
                      <?php
                      $column = 'companyId'; ?>
                      <select style="height: inherit; width: 100%" <?php if($myAction <> 'add'){ echo 'disabled'; } ?> id="<?php echo $column; ?>" name="<?php echo @$column; ?>"   class="form-control select2 ">
                          <option value="">Select Company</option>
                          <?php
                          if(!empty($companies))
                          {
                              foreach ($companies as $company)
                              {
                                  ?>
                                  <option <?php if(@$companyId == $company->id ){ echo 'selected';  } ?> value="<?php echo $company->id ?>" ><?php echo $company->companyName.' -'.$company->licenseNoManual.'- ('.$company->companyAddress.')'; ?></option>
                                  <?php
                              }
                          }
                          ?>
                      </select>
                      <?php
                      if($myAction <> 'add'){
                          ?>
                          <input type="hidden" name="<?php echo @$column; ?>" value="<?php echo @$companyId ?>" />

                          <?php
                      }
                      ?>
                  </div>
              </div>
                <?php } ?>


              <?php
              $CI =& get_instance();
              $isRecord = false;
              if($myAction == 'edit' || $myAction == 'view'){
              foreach ($recordsEdit as $recordEdit){
               if($recordEdit->status == 'Active'){
                   ?>
                <div class="card card-outline card-primary w-100">
                    <div class="card-body">
                        <div class="row">
                            <?php if($this->roleId == 26 && $recordEdit->forwardRole <> 26){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Query To'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php
                                        $column = 'forwardTo'; ?>
                                        <select style="height: inherit; width: 100%" <?php if($myAction <> 'add'){ echo 'disabled'; } ?> id="<?php echo $column; ?>" name="<?php echo @$column; ?>"   class="form-control select2 ">
                                            <option value="">Select Officer</option>
                                            <?php
                                            if(!empty($officers))
                                            {
                                                foreach ($officers as $officer)
                                                {
                                                    ?>
                                                    <option <?php if(@$recordEdit->forwardTo == $officer->id ){ echo 'selected';  } ?> value="<?php echo $officer->id ?>" ><?php echo $officer->userName; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="forwardRole" value="19" />
                                        <input type="hidden" name="companyId" value="<?php echo @$this->companyId; ?>" />

                                        <?php
                                        if($myAction <> 'add'){
                                            ?>
                                            <input type="hidden" name="<?php echo @$column; ?>" value="<?php echo @$forwardTo ?>" />

                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            <div class="col-md-6">
                            </div>
                            <?php } ?>

                            <div class="col-md-9">
                           <div class="form-group">
                               <?php $label = 'Message'; ?>
                               <label><?php echo $label; ?></label>
                               <textarea disabled id="msg<?php echo $recordEdit->id; ?>"  class="form-control msg" rows="3"><?php echo $recordEdit->comment; ?></textarea>
                           </div>
                       </div>
                            <div class="col-md-3 float-right" >
                           <div class="form-group">
                               <?php $label = 'From'; ?>
                               <label style="display: block; font-weight: unset;"><?php echo $label; ?></label>
                               <?php
                               $u_info = $CI->loginModel->getuserRecord($recordEdit->updatedby);
                               ?>
                               <label style="display: block"><?php echo $u_info[0]->userName; ?></label>
                               <?php
                               if($u_info[0]->companyId == 1){
                               ?>
                               <label style="display: block"><?php echo $u_info[0]->designation; ?> <small>(<?php echo $u_info[0]->department; ?>)</small></label>
                               <?php
                               }else{

                               $lic_info = $CI->myModel->getCompanyApprovedLicense($recordEdit->companyId);
                               if($lic_info){
                                   ?>
                                   <label style="display: block"><?php echo @$lic_info[0]->companyName; ?> <small>(<?php echo @$lic_info[0]->licenseNoManual; ?>)</small></label>
                                   <?php
                               }
                               }
                               ?>
                               <?php $label = 'Submitted Date'; ?>
                               <label style="display: block; font-weight: unset;"><?php echo $label; ?></label>
                               <label> <?php echo $recordEdit->updateddate; ?></label>

                           </div>
                       </div>
                            <div class="col-md-6">
                           <div class="form-group">
                               <?php $label = 'Attachment'; ?>
                               <?php $column = 'queryAttachment'; ?>
                               <label><?php echo $label; ?> Link</label>
                               <br>
                               <a <?php if(!@$recordEdit->$column){ echo 'disabled';} ?> <?php if(@$recordEdit->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordEdit->companyUniqueNo.'/docs/'.@$recordEdit->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordEdit->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                           </div>
                       </div>
                        </div>
                    </div>
                </div>
                   <?php
               }
               else if($recordEdit->updatedby == $this->userId){
                   $isRecord = true;
                   ?>
                <div class="card card-outline card-primary">

                    <div class="card-body">
                        <div class="row">

                            <?php if($this->roleId == 26){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Query To'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php
                                        $column = 'forwardTo'; ?>
                                        <select style="height: inherit; width: 100%" <?php echo 'disabled';  ?> id="<?php echo $column; ?>" name="<?php echo @$column; ?>"   class="form-control select2 ">
                                            <option value="">Plz Select Officer</option>
                                            <?php
                                            if(!empty($officers))
                                            {
                                                foreach ($officers as $officer)
                                                {
                                                    ?>
                                                    <option <?php if(@$recordEdit->forwardTo == $officer->id ){ echo 'selected';  } ?> value="<?php echo $officer->id ?>" ><?php echo $officer->userName; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="forwardTo" value="<?php echo @$recordEdit->officerid; ?>" />
                                        <input type="hidden" name="forwardRole" value="<?php echo @$recordEdit->forwardRole; ?>" />
                                        <input type="hidden" name="companyId" value="<?php echo @$this->companyId; ?>" />
                                        <input type="hidden" name="officerid" value="<?php echo @$recordEdit->officerid; ?>" />

                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            <?php } ?>

                            <?php if($this->roleId <> 26){ ?>
                            <input type="hidden" name="forwardRole" value="26" />
                            <?php } ?>

                            <div class="col-md-12">
                            <div class="form-group">
                                   <input type="hidden" id="queryHidden" name="queryId" value="<?php echo $recordEdit->id; ?>">

                                   <?php $label = 'Message'; ?>
                                   <label><?php echo $label; ?></label>
                                   <?php $column = 'comment'; ?>
                                   <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" <?php if($myAction <> 'view'){ ?> name="<?php echo @$column; ?>"<?php  } ?> class="form-control" rows="3"><?php echo $recordEdit->comment; ?></textarea>
                               </div>
                           </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <?php $label = 'Attachment'; ?>
                               <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                               <?php $column = 'queryAttachment'; ?>
                               <div class="custom-file">
                                   <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordEdit->$column; ?>">
                                   <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordEdit->$column; ?>" class="custom-file-input1">
                               </div>
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                               <?php $label = 'Attachment'; ?>
                               <?php $column = 'queryAttachment'; ?>
                               <label><?php echo $label; ?> Link</label>
                               <br>
                               <a <?php if(!@$recordEdit->$column){ echo 'disabled';} ?> <?php if(@$recordEdit->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordEdit->companyUniqueNo.'/docs/'.@$recordEdit->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordEdit->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                           </div>
                       </div>
                        </div>
                    </div>
                </div>
                   <?php
               }
              }
              }
              ?>

                <?php
                if(!$isRecord && $myAction != 'view'){
                ?>
                <div class="card card-outline card-primary">

                    <div class="card-body">
                        <div class="row">

                            <?php if($this->roleId == 26){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Query To'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php
                                        $column = 'forwardTo'; ?>
                                        <select style="height: inherit; width: 100%" <?php if($myAction == 'view' || $myAction == 'edit'){ echo 'disabled'; } ?> id="<?php echo $column; ?>" name="<?php echo @$column; ?>"   class="form-control select2 ">
                                            <option value="">Select Officer</option>
                                            <?php
                                            if(!empty($officers))
                                            {
                                                foreach ($officers as $officer)
                                                {
                                                    ?>
                                                    <option <?php if($myAction == 'edit' && $officer->id == @$recordEdit->officerid){ echo 'selected'; } ?> value="<?php echo $officer->id ?>" ><?php echo $officer->userName; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="forwardTo" value="<?php echo @$recordEdit->officerid; ?>" />
                                        <input type="hidden" name="forwardRole" value="19" />
                                        <input type="hidden" name="companyId" value="<?php echo @$this->companyId; ?>" />


                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            <?php } ?>

                            <?php if($this->roleId <> 26){ ?>
                                <input type="hidden" name="forwardRole" value="26" />
                            <?php } ?>
                            <div class="col-md-12">
                    <div class="form-group">
                        <?php $label = 'Message'; ?>
                        <label><?php echo $label; ?></label>
                        <?php $column = 'comment'; ?>
                        <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" <?php if($myAction <> 'view'){ ?> name="<?php echo @$column; ?>"<?php  } ?> class="form-control" rows="3"></textarea>
                    </div>
                </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php $label = 'Attachment'; ?>
                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                <?php $column = 'queryAttachment'; ?>
                                <div class="custom-file">
                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="">
                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="custom-file-input1">
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>








            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
              <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input type="submit" onclick="" name="queryStatus" class="btn btn-primary" id="formSave" value="Save"> <input name="queryStatus" type="submit" onclick="return confirmSubmit()" class="btn btn-success formSubmit2" id="formSubmit2" value="Submit">';}?>
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
      $('#comment').summernote();
      $('.msg').each(function(i, obj) {
          $('#'+obj.id).summernote('disable');
      });
      <?php if($myAction == 'view'){ ?>
      $('#comment').summernote('disable');
      <?php } ?>
  });
</script>