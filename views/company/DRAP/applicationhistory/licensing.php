<?php
// if($userInfo[0]->status == 'Completed'){
//   //if($this->userId <> 27){
//   header("Location:".base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
//   exit();
//   //}
// }

$myAction = 'lookup';
$type = '';
if(explode('/', $_SERVER['REQUEST_URI'])[1] == $pageTitle[0]->url){
    $type = explode('/', $_SERVER['REQUEST_URI'])[2];
}
/*if(explode('/', $_SERVER['REQUEST_URI'])[2] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[3];
}
if(explode('/', $_SERVER['REQUEST_URI'])[1] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[2];
}

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
          <h1><i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName.' '.ucfirst($type); ?></h1>
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

              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th class="text-center">Referrence No.</th>
                  <th>Establishment License</th>
                  <th>License No.</th>
                  <th>Issue Date</th>
                  <th>Renewal Due Date</th>
                  <th>Last Renewal Date</th>
                  <th>App. Submitted</th>
                  <th>App. Type</th>
                  <th>Phase</th>
                  <th class="text-center">Stage</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $sn=1; ?>
                  <?php
                  if(!empty($licenseRecords))
                  {



                      foreach($licenseRecords as $record)
                      {

                        $seenBy = explode(",",$record->seenBy);
                  ?>
                  <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <td><?php echo $record->licenseSubType; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td>
                    <td><?php echo $record->issueDateManual; ?></td>
                    <td><?php echo $record->validTill; ?></td>
                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                    <td><?php

                        if($record->applicationType == 1){
                            if($record->phase == 'Site Verification'){
                                echo $record->siteSubmissionDate;
                            }else if($record->phase == 'Layout Plan'){
                                echo $record->layoutSubmissionDate;
                            }else if($record->phase == 'Grant of License'){
                                echo $record->grantSubmissionDate;
                            }
                        }else{
                            echo $record->submissionDate;
                        }
                        ?></td>
                    <td><?php
                        $appStatus = '';
                          if($this->roleId == 26) {
                              if ($record->applicationType == 1) {
                                  $appStatus = $record->licenseStatus;
                                  echo "New License";
                              } else if ($record->applicationType == 2) {
                                  $appStatus = $record->postchangeStatus;
                                  echo "License Variance";
                              } else if ($record->applicationType == 3) {
                                  $appStatus = $record->renewalStatus;
                                  echo "License Renewal";
                              }
                          }else{
                              echo $record->applicationType;
                          }
                         ?></td>
                    <td><?php
                          if($record->applicationType == 1) {
                              echo $record->phase;
                          }
                    ?></td>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($appStatus == 'Draft'){echo 'warning';} elseif($appStatus == 'Submitted' || $appStatus == 'Screening' || $appStatus == 'Under R and I'){echo 'info';} elseif($appStatus == 'Received By DRAP' || $appStatus == 'Under Review Stage 1' || $appStatus == 'Under Inspection' || $appStatus == 'Post Inspection Process' || $appStatus == 'Under Board Stage 2'){echo 'primary';} elseif($appStatus == 'Referred Back To Company (Editable)' || $appStatus == 'Referred Back To Company (Locked)'){echo 'secondary';} elseif($appStatus == 'Rejected and Closed'){echo 'danger';} elseif($appStatus == 'Recommended By Board Stage 3' || $appStatus == 'Approved'){echo 'success';} ?>'><?php echo $appStatus; ?></span></h4></b>
                    </td>

                    <td class="text-center widthMaxContent">
                        <?php
                        if($record->applicationType == 1){
                            ?>
                            <div class="btn-group">

                                <div class="btn-group-prepend">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="">

                                        <!-- <?php if($record->phase == 'Site Verification'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Shortcoming Letter/'.$record->id.'">Site Verification Shortcoming Letter</a></li>
                            ';} ?> -->
                                        <?php if($record->reviewer1Remarks && ($this->roleId <> '26' || $appStatus == 'Referred Back To Company (Locked)' )){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Shortcoming Letter/'.$record->id.'">Site Verification Shortcoming Letter</a></li>
                            ';} ?>
                                        <?php if($record->phase == 'Site Verification' && ($appStatus == 'Under Inspection' || $appStatus == 'Post Inspection Process') && $record->siteData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Letter/'.$record->id.'">Site Verification Letter</a></li>
                            ';} ?>
                                        <?php if(($record->phase == 'Layout Plan' || $record->phase == 'Grant of License') && $record->siteData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Approval Letter/'.$record->id.'">Site Approval Letter</a></li>
                            ';} ?>
                                        <?php if($record->reviewer1Remarks2 && ($this->roleId <> '26' || $appStatus == 'Referred Back To Company (Locked)' )){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Layout Plan Shortcoming Letter/'.$record->id.'">Layout Plan Shortcoming Letter</a></li>
                            ';} ?>
                                        <?php if($record->phase == 'Grant of License' && $record->layoutData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Layout Plan Approval Letter/'.$record->id.'">Layout Plan Approval Letter</a></li>
                            ';} ?>
                                        <?php if($record->reviewer1Remarks3){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Applicant License Shortcoming Certificate/'.$record->id.'">Establishment License Shortcoming</a></li>
                            ';} ?>
                                        <?php if($record->phase == 'Grant of License' && $record->panelOfInspector1 ){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Grant of License Panel of Inspector/'.$record->id.'">Grant of License Panel of Inspector</a></li>
                            ';} ?>
                                        <?php if($appStatus == 'Approved' && $record->dmlData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Applicant License Certificate/'.$record->id.'">Establishment License Certificate</a></li>
                            ';} ?>
                                    </ul>
                                </div>

                                <a href="<?php echo base_url().'newlicense/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>

                                <?php if($appStatus <> 'Approved'){ ?>
                                    <a href="<?php echo base_url().'newlicense/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                <?php } ?>

                            </div>

                            <?php
                            //echo "New License";
                        }else  if($record->applicationType == 2){
                            ?>
                            <div class="btn-group">

                                <div class="btn-group-prepend">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="">

                                        <?php if($record->postchangeTypeId == 15 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Company Name Approval Letter/'.$record->id.'">Company Name Variance Certificate</a></li>
                            ';} ?>

                                        <?php if(($record->postchangeTypeId == 19||$record->postchangeTypeId == 16) && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a  target="_blank" href="'.base_url().'report/view/Technical Staff Approval Letter/'.$record->id.'">Technical Staff Variance Certificate</a></li>
                            ';} ?>
                                        <?php
                                        if($record->totalQueries > 0){
                                            ?>
                                            <?php if($record->postchangeTypeId == 16 || $record->postchangeTypeId == 19){ echo '
                                    <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Shortcoming Technical Staff/'.$record->id.'">Shortcoming Technical Staff</a></li>
                                    ';} ?>
                                            <?php if($record->postchangeTypeId == 17){ echo '
                                    <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Shortcoming Company Management/'.$record->id.'">Shortcoming Company Management</a></li>
                                    ';} ?>
                                            <?php
                                        }
                                        ?>
                                        <?php if($record->postchangeTypeId == 17 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Company Management Variance Certificate/'.$record->id.'">Company Management Variance Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 18 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Layout Plan Variance Certificate/'.$record->id.'">Layout Plan Variance Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 23 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/API Variance Certificate/'.$record->id.'">API Variance Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 24 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Misc Inspection Book Variance Certificate/'.$record->id.'">Misc Inspection Book Variance Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 25 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Misc Attestation of License Variance Certificate/'.$record->id.'">Misc Attestation of License Variance Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 26 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Repacking Variance Certificate/'.$record->id.'">Variance Repacking Certificate</a></li>
                            ';} ?>
                                        <?php if($record->postchangeTypeId == 27 && $record->panelOfInspector1){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Inspection Request Panel of Inspector/'.$record->id.'">Inspection Request Panel of Inspector</a></li>
                            ';} ?>

                                        <?php if($record->postchangeTypeId == 27 && $record->postchangeStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Request for Inspection Variance Certificate/'.$record->id.'">Request for Inspection Variance Certificate</a></li>
                            ';} ?>
                                    </ul>
                                </div>

                                <a href="<?php echo base_url().'licensevariance/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                <?php if($record->postchangeStatus <> 'Approved'){ ?>
                                    <a href="<?php echo base_url().'licensevariance/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                <?php } ?>
                                <?php if($record->postchangeStatus == 'Draft'){ ?>
                                    <a href="<?php echo base_url().'licensevariance/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                                <?php } ?>
                            </div>

                            <?php
                            //echo "License Variance";
                        }else  if($record->applicationType == 3){
                            ?>
                            <div class="btn-group">

                                <div class="btn-group-prepend">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" style="">


                                        <?php if($record->panelOfInspector1 ){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Renewal of License Panel of Inspector/'.$record->id.'">Renewal of License Panel of Inspector</a></li>
                            ';} ?>
                                        <?php if($record->totalQueries > 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Renewal Shortcoming/'.$record->id.'">Renewal Shortcoming</a></li>
                            ';} ?>
                                        <!-- <?php if(1==1){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Renewal Approval Letter/'.$record->id.'">Renewal Approval Letter</a></li>
                            ';} ?> -->
                                        <?php if($record->renewalStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Renewal Applicant License Certificate/'.$record->id.'">Renewal License Certificate</a></li>
                            ';} ?>
                                    </ul>
                                </div>

                                <a href="<?php echo base_url().'licenserenewal/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                <?php if($record->renewalStatus <> 'Approved'){ ?>
                                    <a href="<?php echo base_url().'licenserenewal/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                <?php } ?>

                            </div>

                            <?php
                            //echo "License Renewal";
                        }
                        ?>
                    </td>
                  </tr>
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
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
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