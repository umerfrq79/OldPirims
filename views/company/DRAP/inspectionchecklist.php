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
    <?php } ?>

    <?php if($myAction == 'edit' || $myAction == 'view'){ ?>
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

              <div class="col-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h3 class="card-title">Checklist</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                    <?php $myTable = 'tabledetailchecklist'; ?>
                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                      <thead>
                      <tr>
                        <th>Section</th>
                        <th>S.#</th>
                        <th>Question</th>
                        <th class="text-center">C</th>
                        <th class="text-center">PC</th>
                        <th class="text-center">NC</th>
                        <th class="text-center">NA</th>
                        <th class="text-center">Inspector Findings</th>
                        <th class="text-center">Inspector Rating</th>
                        <?php if(@$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete'){ ?>
                        <th class="text-center">Panel Findings</th>
                        <th class="text-center">Panel Rating</th>
                        <?php } ?>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $sn=1; ?>
                        <?php
                        $sectionShow = true;
                        if(!empty($inspectionChecklistSection))
                        {
                            foreach($inspectionChecklistSection as $record)
                            {
                        ?>
                        <tr>
                          <td <?php if($sectionShow == true){echo 'style="color: #000"';} ?>><b><?php echo $record->section; $sectionShow = false; ?></b></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <?php if(@$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete'){ ?>
                          <td></td>
                          <td></td>
                          <?php } ?>
                        </tr>
                        <?php $sId=0; ?>
                           <?php
                            if(!empty($inspectionChecklistQuestion))
                            {
                              foreach ($inspectionChecklistQuestion as $recordDetail)
                              {

                                if($recordDetail->masterId == $record->id){ echo '
                                  <tr>
                                  <td style="color: #f9f9f9"><b>'.$record->section.'</b></td>
                                  <td>'.$recordDetail->checklistNo.'</td>
                                  <td><a href="'.$recordDetail->url.'" title="'.$recordDetail->trsNumber.'" target="_blank">'.$recordDetail->checklistName.'</a>
                                  <input type="hidden" id="tabledetailchecklist-id_'.$recordDetail->id.'" name="tabledetailchecklist-id_detail[]" value="';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->checklistId == $recordDetail->id){
                                        echo $recordDetailChecklist->id;
                                      }
                                    }
                                  }
                                  ?>
                                  <?php echo '
                                  ">
                                  <input type="hidden" id="tabledetailchecklist-checklistId_'.$recordDetail->id.'" name="tabledetailchecklist-checklistId_detail[]" value="'.$recordDetail->id.'">
                                  </td>
                                  <td><input ';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->marks == "C" && $recordDetailChecklist->checklistId == $recordDetail->id){
                                        echo 'checked';
                                      }
                                    }
                                  }
                                  ?>
                                  <?php echo '
                                  type="radio" id="checklistName_'.$recordDetail->id.'" name="tabledetailchecklist-marks_detail['.$sId.']" value="C">
                                    </td>
                                    <td><input ';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->marks == "PC" && $recordDetailChecklist->checklistId == $recordDetail->id){
                                        echo 'checked';
                                      }
                                    }
                                  }
                                  ?>
                                  <?php echo '
                                  type="radio" id="checklistName_'.$recordDetail->id.'" name="tabledetailchecklist-marks_detail['.$sId.']" value="PC">
                                    </td>
                                    <td><input ';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->marks == "NC" && $recordDetailChecklist->checklistId == $recordDetail->id){
                                        echo 'checked';
                                      }
                                    }
                                  }
                                  ?>
                                  <?php echo '
                                  type="radio" id="checklistName_'.$recordDetail->id.'" name="tabledetailchecklist-marks_detail['.$sId.']" value="NC">
                                    </td>
                                    <td><input ';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->marks == "NA" && $recordDetailChecklist->checklistId == $recordDetail->id){
                                        echo 'checked';
                                      }
                                    }
                                  }
                                  ?>
                                  <?php echo '
                                  type="radio" id="checklistName_'.$recordDetail->id.'" name="tabledetailchecklist-marks_detail['.$sId.']" value="NA">
                                    </td>
                                    <td><textarea id="inspectorRemarks_'.$recordDetail->id.'" name="tabledetailchecklist-inspectorRemarks_detail[]" class="form-control" rows="3">';?><?php if(!empty($recordsDetailChecklist)){foreach ($recordsDetailChecklist as $recordDetailChecklist){if($recordDetailChecklist->checklistId == $recordDetail->id){echo $recordDetailChecklist->inspectorRemarks;}}}?><?php echo '</textarea></td>
                                    <td>';
                                  ?>
                                  <?php
                                  if(!empty($recordsDetailChecklist))
                                  {
                                    foreach ($recordsDetailChecklist as $recordDetailChecklist)
                                    {
                                      if($recordDetailChecklist->checklistId == $recordDetail->id){
                                        ?>
                                        <select class="form-control select2" id="inspectorRating_<?php echo $recordDetail->id; ?>" name="tabledetailchecklist-inspectorRating_detail[]">
                                          <option value="0">Select Rating</option>
                                          <option value="Critical" <?php if('Critical' == $recordDetailChecklist->inspectorRating){ echo 'selected'; } ?>>Critical</option>
                                          <option value="Major" <?php if('Major' == $recordDetailChecklist->inspectorRating){ echo 'selected'; } ?>>Major</option>
                                          <option value="Minor" <?php if('Minor' == $recordDetailChecklist->inspectorRating){ echo 'selected'; } ?>>Minor</option>
                                          <option value="Compliant" <?php if('Compliant' == $recordDetailChecklist->inspectorRating){ echo 'selected'; } ?>>Compliant</option>
                                        </select>
                                      <?php
                                      break;
                                      }
                                    }
                                  }
                                  else{
                                  ?>
                                    <select class="form-control select2" id="inspectorRating_<?php echo $recordDetail->id; ?>" name="tabledetailchecklist-inspectorRating_detail[]">
                                      <option value="0">Select Rating</option>
                                      <option value="Critical">Critical</option>
                                      <option value="Major">Major</option>
                                      <option value="Minor">Minor</option>
                                      <option value="Compliant">Compliant</option>
                                    </select>
                                  <?php
                                  }
                                  ?>
                                </td>
                                  <?php if(@$recordsEdit[0]->inspectionStatus == 'Under Review Stage 1' || @$recordsEdit[0]->inspectionStatus == 'Under Review Stage 2' || @$recordsEdit[0]->inspectionStatus == 'Review Complete'){ ?>
                                  <td><textarea id="panelRemarks_<?php echo $record->id; ?>" name="tabledetailchecklistreport-panelRemarks_detail[]" class="form-control" rows="3"><?php echo $record->panelRemarks; ?></textarea>
                                  </td>
                                  <td>
                                    <select class="form-control select2" id="panelRating_<?php echo $record->id; ?>" name="tabledetailchecklistreport-panelRating_detail[]">
                                      <option value="0">Select Rating</option>
                                      <option value="Critical" <?php if('Critical' == $record->panelRating){ echo 'selected'; } ?>>Critical</option>
                                      <option value="Major" <?php if('Major' == $record->panelRating){ echo 'selected'; } ?>>Major</option>
                                      <option value="Minor" <?php if('Minor' == $record->panelRating){ echo 'selected'; } ?>>Minor</option>
                                      <option value="Compliant" <?php if('Compliant' == $record->panelRating){ echo 'selected'; } ?>>Compliant</option>
                                    </select>
                                  </td>
                                  <?php } ?>
                                  <?php echo '</tr>';}
                                  if($recordDetail->masterId <> $record->id){
                                    $sectionShow = true;
                                  }
                                ?>
                                <?php $sId++ ?>
                                <?php
                              }
                            }
                          ?>
                          <!-- <tr>
                            <td style="color: #f9f9f9"><b><?php echo $record->section ?></b></td>
                            <td><b>Marks</b></td>
                            <td class="text-center">
                              <b>7/12</b>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr> -->
                          <!-- <tr>
                            <td style="color: #f9f9f9"><b><?php echo $record->section ?></b></td>
                            <td><b>Remarks</b></td>
                            <td>
                              <textarea style="width: 100%" id="tabledetailchecklistsection-remarks_<?php echo $record->id ?>" name="tabledetailchecklistsection-remarks_detail[]" class="form-control" rows="3"><?php if(!empty($recordsDetailChecklistRemarks)){foreach ($recordsDetailChecklistRemarks as $recordDetailChecklistRemarks){if($recordDetailChecklistRemarks->sectionId == $record->id){echo $recordDetailChecklistRemarks->remarks;}}}?></textarea>
                              <input type="hidden" id="tabledetailchecklistsection-id_<?php echo $record->id; ?>" name="tabledetailchecklistsection-id_detail[]" value="
                                  <?php
                                  if(!empty($recordsDetailChecklistRemarks))
                                  {
                                    foreach ($recordsDetailChecklistRemarks as $recordDetailChecklistRemarks)
                                    {
                                      if($recordDetailChecklistRemarks->sectionId == $record->id){
                                        echo $recordDetailChecklistRemarks->id;
                                      }
                                    }
                                  }
                                  ?>">
                                  <input type="hidden" id="tabledetailchecklistsection-sectionId_<?php echo $record->id; ?>" name="tabledetailchecklistsection-sectionId_detail[]" value="<?php echo $record->id ?>">
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr> -->
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
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input type="submit" onclick="return confirm(\'Are you sure you want to save this record?\')" class="btn btn-success" value="Submit">';}?>
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
  $(document).ready(function(){
    // Setup - add a text input to each header cell
    $('#tabledetailchecklist thead tr').clone(true).appendTo( '#tabledetailchecklist thead' );
    $('#tabledetailchecklist thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        if(title == '' || title == 'S.#' || title == 'Action' || title == 'Question' || title == 'C' || title == 'PC' || title == 'NC' || title == 'NA' || title == 'Inspector Findings' || title == 'Inspector Rating'){
          $(this).html( '' );
        }
        else if(title == 'Section'){
          var table = $('#tabledetailchecklist').DataTable({
              'orderCellsTop': true,
              'fixedHeader'  : true,
              'paging'       : true,
              'lengthChange' : true,
              'searching'    : true,
              'ordering'     : false,
              'info'         : true,
              'iDisplayLength': <?php echo -1 ?>,
              'autoWidth'    : true,
              'search'       : {'caseInsensitive': true},
              'columnDefs'   : [{ 'type': 'num', 'targets': [0] }]
          });
          var select = $('<select class="form-control select2"><option value=""></option></select>')
              .appendTo($(this).empty())
              .on('change', function (){
                  table.column(0)
                      .search($(this).val())
                      .draw();
              });
   
          table.column(0).data().unique().sort().each(function (d,j){
              select.append('<option value="'+d+'">'+d+'</option>')
          });
          $('#tabledetailchecklist').DataTable().destroy();
        }
        else{
          $(this).html( '<input type="text" class="form-control d-none" placeholder="Search '+title+'" />' );
        }
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
       return $(value).val();
    };
 
    var table = $('#tabledetailchecklist').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': true},
        'columnDefs'   : [{ 'type': 'num', 'targets': [0] }]
    });
});
$( "#tabledetailchecklist thead th" ).click(function() {
  $( "#tabledetailchecklist thead th input" ).removeClass('d-none');
  $( "#tabledetailchecklist thead th select" ).removeClass('d-none');
});
</script>