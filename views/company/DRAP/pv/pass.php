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
                  <th>Pass Type</th>
                    <th>Study</th>
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
                  <tr>
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <?php if($this->roleId <> 26){?>
                    <td><?php echo $record->companyName; ?></td>
                    <?php } ?>
                    <td><?php if('vpass' == $record->passType){ echo 'Voluntarily PASS';} else if('ipass' == $record->passType){echo 'Imposed PASS';} ?></td>
                      <td><?php echo $record->studyName; ?></td>
                      <td><?php echo $record->submissiondate; ?></td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">

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
                        <a class="nav-link active" data-toggle="pill" href="#tab1">PASS Details</a>
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
                              <?php $label = 'Pass Type'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'passType'; ?>
                              <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <option value="vpass" <?php if('vpass' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Voluntarily PASS</option>
                                <option value="ipass" <?php if('ipass' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Imposed PASS</option>

                              </select>
                            </div>
                          </div>

                          <div class="col-md-6 ">
                          </div>
                            <div class="col-md-12  ddata">
                                <div class="form-group">
                                    <?php $label = 'Study Name'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'studyName'; ?>
                                    <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                </div>
                            </div>

                          <div class="col-md-6  ddata" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Protocol of PASS'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'passProtocol'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 ">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 ddata">
                            <div class="form-group">
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6 ddata" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Amendments to the Study Protocol '; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'protocolAmendments'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 ddata">
                            <div class="form-group">
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6 ddata" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Risk-Benefit Balance of the Product'; ?>
                              <label><?php echo $label; ?> (<?php echo @$recordsEdit[0]->companyType; ?>) <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'rbProduct'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6 ddata">
                            <div class="form-group">
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6  ddata" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Progress and Interim Report '; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'progReport'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 ">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6  ddata">
                            <div class="form-group">
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
                          </div>

                          <div class="col-md-6  ddata" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                            <div class="form-group">
                              <?php $label = 'Final Study Report'; ?>
                              <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                              <?php $column = 'studyReport'; ?>
                              <div class="custom-file">
                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 ">
                              </div>
                            </div>
                          </div>

                          <div class="col-md-6  ddata">
                            <div class="form-group">
                              <label><?php echo $label; ?> Link</label>
                              <br>
                              <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                            </div>
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
            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save"  name="status"> <input  name="status" type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="formSubmit1" value="Submit">';}?>
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
      <?php if($this->roleId == 26){ ?>
      $('#passType').on('change', function() {
          if(this.value == ''){
              $('.ddata').hide();
          }else{
              $('.ddata').show();
          }
      });
      if($("#passType").val() == ''){
          $('.ddata').hide();
      }else{
          $('.ddata').show();
      }
      <?php } ?>

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