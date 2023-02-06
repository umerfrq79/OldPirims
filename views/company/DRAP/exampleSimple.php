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
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New Country</a>';
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
                  <th>Country</th>
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
                    <td><?php echo $record->countryName; ?></td>
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
                  <?php $label = 'Country Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'countryName'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Number'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'countryName001'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="number" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required" style="text-align: right; direction: ltr;" step="any" min="0">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Date Calendar'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'countryName01'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Date Normal'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'startDate'; ?>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                  </div>
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

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment'; ?>
                  <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                  <?php $column = 'attachment'; ?>
                  <div class="custom-file">
                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                    <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Attachment'; ?>
                  <?php $column = 'attachment'; ?>
                  <label><?php echo $label; ?> Link</label>
                  <br>
                  <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.$this->companyName.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                </div>
              </div>

              <div class="col-md-6">
                <div class="icheck-primary">
                  <?php $label = 'Country Name'; ?>
                  <?php $column = 'countryName'; ?>
                  <input type="hidden" id="<?php echo $column; ?>Hidden" name="<?php echo $column; ?>" value="0">
                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="1" <?php if(1 == @$recordsEdit[0]->$column){echo 'checked';} ?>>
                  <label for="<?php echo @$column; ?>"><?php echo $label; ?></label>
                </div>
              </div>

              <div class="col-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Table Detail</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                    <?php $myTable = 'tabledetail'; ?>
                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                      <thead>
                      <tr>
                        <th>S.#</th>
                        <th>Plain Text</th>
                        <th>Date Calendar</th>
                        <th>Date Normal</th>
                        <th>Input Text</th>
                        <th>Select (Database)</th>
                        <th>Select Manual</th>
                        <th>Textarea</th>
                        <th>Attachment <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                        <th class="text-center">Checkbox</th>
                        <th>Qty</th>
                        <th>Rate</th>
                        <th>Total</th>
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
                        if(empty($recordsDetail))
                        {
                          unset($record);
                          @$recordsDetail[0]->id = 1;
                        }
                        ?>
                        <?php
                        if(!empty($recordsDetail))
                        {
                            foreach($recordsDetail as $record)
                            {
                              $total = @$record->qty * @$record->rate;
                        ?>
                        <tr>
                          <td class="srNo">
                            <span><?=$sn?></span>.
                            <?php $column = 'id'; ?>
                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                            <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                          </td>
                          <td>
                            <?php echo @$record->plaintext; ?>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'countryName01'; ?>
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'startDate'; ?>
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                  </div>
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask="" inputmode="numeric">
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'countryName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $label = 'Country'; ?>
                                <?php $column = 'countryId'; ?>
                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                  <option value="">Select <?php echo @$label; ?></option>
                                  <?php
                                    if(!empty($country))
                                    {
                                      foreach ($country as $detail)
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
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'status'; ?>
                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                  <option value="Active" <?php if('Active' == @$record->$column){ echo 'selected'; } ?>>Active</option>
                                  <option value="Inactive" <?php if('Inactive' == @$record->$column){ echo 'selected'; } ?>>Inactive</option>
                                  <option value="Suspended" <?php if('Suspended' == @$record->$column){ echo 'selected'; } ?>>Suspended</option>
                                  <option value="Blocked" <?php if('Blocked' == @$record->$column){ echo 'selected'; } ?>>Blocked</option>
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
                            <div class="col-md-6">
                              <div class="form-group">
                                <?php $column = 'attachment'; ?>
                                <div class="custom-file">
                                  <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input <?php if(!@$record->$column){echo 'required';}?>">
                                  <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <a <?php if(!@$record>$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                              </div>
                            </div>
                          </td>
                          <td class="text-center">
                            <?php $column = 'countryName2'; ?>
                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                            <div class="icheck-primary">
                              <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                              <?php
                                if(@$record->$column == 1){
                                  echo 'checked';
                                }
                              ?>
                              >
                              <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'qty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required qtyC" style="text-align: right; direction: ltr;" step="any" min="0" onfocusout="updateTotal($(this), $(this).val());">
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="col-md-12">
                              <div class="form-group">
                                <?php $column = 'rate'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required rateC" style="text-align: right; direction: ltr;" step="any" min="0" onfocusout="updateTotal1($(this), $(this).val());">
                              </div>
                            </div>
                          </td>
                          <td class="text-center">
                            <b class="totalValue"><?php echo @$total; ?></b>
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

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Remarks'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-12">
                <?php $label = 'SummerNote Remarks'; ?>
                <?php $column = 'remarks'; ?>
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

  loadMyTable('tabledetail', false, -1);
  $('#tabledetail').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetail';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $("td:eq(9)", row).closest('td').html('<input type="hidden" id="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[0] +'Hidden_'+ (parseInt($('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[$('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("name") +'" value="0"><div class="icheck-primary"><input type="checkbox" id="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[0] +'_'+ (parseInt($('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[$('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("name") +'" value="1"><label for="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[0] +'_'+ (parseInt($('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_")[$('#'+myCurrentTable+' tr:last').find("td").eq(9).children().children().attr("id").split("_").length -1]) + parseInt("1")) +'"></label></div>');

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>myController/myAjaxGet",
        method:"POST",
        data:{table:'tbls_page', columnName:'friendlyName'},
        success:function(data)
        {
          $("td:eq(5)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(5).children().children().children().attr("name") +'">'+data+'</select>');
        }
      });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      //$('#'+myCurrentTable+' select').select2();
      //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(13).addClass('text-center widthMaxContent');
  });

  updateNetTotal();
  function updateNetTotal(){
    var netTotal = 0;
    $('#tabledetail > tbody  > tr').each(function(e) {
      netTotal += parseInt($(this).find('.totalValue').html());
    });
    $('#netTotal').val(netTotal);
  }
  function updateTotal(thisElement, qty){
    z = qty * $(thisElement).parent().parent().parent().parent().find('.rateC').val();
    $(thisElement).parent().parent().parent().parent().find('.totalValue').html(z);
    updateNetTotal();
  }
  function updateTotal1(thisElement, rate){
    z = rate * $(thisElement).parent().parent().parent().parent().find('.qtyC').val();
    $(thisElement).parent().parent().parent().parent().find('.totalValue').html(z);
    updateNetTotal();
  }
</script>