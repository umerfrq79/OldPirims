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
    <?php if(1==1){echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';}?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Lookup</h3>
              <div class="card-tools">
                <?php if($this->roleId == '18' || $this->roleId == '19'){echo'
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Meeting No.</label>
                        <input type="text" id="meetingNo" name="meetingNo" value="" class="form-control" data-inputmask="\'mask\': \'9999\'" data-mask>
                    </div>
                  </div>
                ';} ?>
                <?php if($this->roleId == '43' || $this->roleId == '44' ){echo'
                  <div class="col-xs-4">
                    <div class="form-group">
                      <label>Meeting Date</label>
                        <input type="date" id="meetingDate" name="meetingDate" value="" class="form-control">
                    </div>
                  </div>
                ';} ?>
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
                  <?php if($this->roleId == '18' || $this->roleId == '19'){echo'
                    <th>Discuss In Board</th>
                  ';} ?>
                  <th>Submission Date & Time</th>
                  <th>Type</th>
                  <th>Company</th>
                    <?php if($this->roleId == '43'){ ?>
                  <th>Site Address</th>
                  <th>Inspector Recommendation</th>
                  <th>Phase</th>
                    <?php }else{
                        ?>
                        <th>Registration No.</th>
                    <?php
                    }?>
                  <!--<th>Application (Link)</th>-->
                  <?php if($this->roleId == '43' || $this->roleId == '44'){echo'
                    <th>Board Decision</th>
                    <th style="display:none" class="text-center">Status</th>
                  ';} ?>
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
                    <td><?=$sn?>.
                    <input type="hidden" id="" name="table-id_detail[]" value="<?php echo $record->id ?>" class="form-control required">
                    <input type="hidden" id="" name="table-type_detail[]" value="<?php echo $record->type ?>" class="form-control required">
                    <input type="hidden" id="" name="table-meetingid_detail[]" value="<?php echo $record->meetingid ?>" class="form-control required">
                    <input type="hidden" id="" name="table-agendaid_detail[]" value="<?php echo $record->agendaid ?>" class="form-control required">

					<?php if($this->roleId == '18' || $this->roleId == '19'){echo'
                      <td class="text-center">
                        <input type="checkbox" id="" name="table-discussInBoard_detail[]" value="1" class="form-group required">
                      </td>
                    ';} ?>
                    <td><?php echo $record->submissionDate; ?></td>
                    <td><?php echo $record->myType.' &mdash; '.$record->mySubType.'<br> &mdash; '.$record->type; ?></td>
                    <td><?php echo $record->companyName; ?></td>
                          <?php if($this->roleId == '43'){ ?>
                      <td><?php echo @$record->siteAddress; ?></td>
                    <td><?php echo $record->panelRemarks; ?></td>
                    <td><?php echo @$record->phase; ?></td>
                      <?php }
                          else{
                          ?>
                              <td><?php echo @$record->registrationNo; ?></td>
                          <?php
                          }?>
                    <!--<td class="text-center">
                      <?php if($record->type == 'License'){echo'
                        <a href="'.base_url().'license/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} if($record->type == 'License Renewal'){echo'
                        <a href="'.base_url().'licenserenewal/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} if($record->type == 'Post License Change'){echo'
                        <a href="'.base_url().'licensevariance/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} ?>
                      <?php if($record->type == 'Registration'){echo'
                        <a href="'.base_url().'newregistration/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} if($record->type == 'Registration Renewal'){echo'
                        <a href="'.base_url().'registrationrenewal/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} if($record->type == 'Post Registration Change'){echo'
                        <a href="'.base_url().'registrationvariance/view/'.$record->id .'" target="_blank" class="btn btn-success"><i class="fa fa-file text-default"></i></a>
                      ';} ?>
                    </td>-->
                    <?php if($this->roleId == '43' || $this->roleId == '44'){echo'
                      <td class="text-center">
                        <textarea id="" name="table-remarks_detail[]" class="form-control" rows="3"></textarea>
                      </td>
                      <td style="display:none">
                          <select required class="form-control select2 required" id="" name="table-status_detail[]">
                            <option value="">Select Status</option>
                            <option selected value="Approved">Approved</option>
                            <option value="Deferred">Deferred</option>
                            <option value="Inspection Required">Inspection Required</option>
                          </select>
                      </td>
                    ';} ?>
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
            <div class="col-xs-6" style="display: none;">
              <div class="form-group">
                <label>Status</label>
                <select class="form-control select2" id="agendaStatus" name="agendaStatus">
                  <option value="0">0</option>
                  <option value="Save">Save</option>
                  <option value="Submit">Submit</option>
                </select>
              </div>
            </div>
            <div class="card-footer">
              <?php if($this->roleId == 44 || $this->roleId == 43){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" value="Close Meeting"> ';}?>
              <?php if( $this->roleId == 19){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" value="Add to Agenda"> ';}?>
              
              <?php if($this->roleId == 19 || $this->roleId == 44){echo '<a href="'.base_url().'report/view/Registration Agenda/" target="_blank" class="btn btn-info">New Registration Agenda</a>
              ';}?>
              <?php if($this->roleId == 19){echo '<a href="'.base_url().'report/view/Registration Renewal Agenda/" target="_blank" class="btn btn-info">Registration Renewal Agenda</a>
              ';}?>
              <?php if($this->roleId == 19){echo '<a href="'.base_url().'report/view/Registration Variance Agenda/" target="_blank" class="btn btn-info">Registration Variance Agenda</a>
              ';}?>
            </div>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    <?php if(1==1){echo '</form>';}?>
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
      grossTotal += parseInt($(this).find('.totalValue').html());
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
<script>
  $('#table tbody tr').click(function(){
    $('#table tbody tr').css('background-color', '#f9f9f9');
    $('#table tbody tr').css('box-shadow', 'inset 0px 0px 0px 0px #ffffff');
    $(this).css('background-color', 'aliceblue');
    $(this).css('box-shadow', 'inset 0px 0px 3px 0px #5b5b5b');
  });
</script>