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
                  <th>Role</th>
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
                    <td><?php echo $record->department.' &mdash; '.$record->designation; ?></td>
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

              <div class="container-fluid">
                <div class="row">

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Role'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'id'; ?>
                      <input disabled type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->department.' &mdash; '.@$recordsEdit[0]->designation; ?>" class="form-control">
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="card card-primary card-outline">
                      <div class="card-header">
                        <h3 class="card-title">Module Permisson</h3>
                        <div class="card-tools">
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                        <?php $myTable = 'tabledetailpage'; ?>
                        <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed">
                          <thead>
                          <tr>
                            <th>S.#</th>
                            <th>Module</th>
                            <th class="text-center">Lookup</th>
                            <th class="text-center">Add</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Delete</th>
                            <th class="text-center">Submit</th>
                            <!-- <th class="text-center">Action</th> -->
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sn = 1;
                              $sId = 0;
                            ?>
                            <?php
                            if(!empty($page))
                            {
                                foreach($page as $record)
                                {
                            ?>
                            <tr>
                              <td class="srNo">
                                <span><?=$sn?></span>.
                                <?php $column = 'id'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="
                                      <?php
                                      if(!empty($recordsDetailPage))
                                      {
                                        foreach ($recordsDetailPage as $detail)
                                        {
                                          if($detail->masterId == $record->$column){
                                            echo $detail->id;
                                          }
                                        }
                                      }
                                      ?>
                                      " class="rowId">
                                      <!-- <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow"> -->
                              </td>
                              <td>
                                <?php echo $record->head.' &mdash; '.$record->friendlyName; ?>
                                <?php $column = 'masterId'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> readonly type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo $record->id; ?>" class="form-control">
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordLookup'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordLookup == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordAdd'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordAdd == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordEdit'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordEdit == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordView'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordView == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordDelete'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordDelete == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <td class="text-center">
                                <?php $column = 'recordSubmit'; ?>
                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="0">
                                <div class="icheck-primary">
                                  <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[<?php echo $sId;?>]" value="1" 
                                  <?php
                                  if(!empty($recordsDetailPage))
                                  {
                                    foreach ($recordsDetailPage as $detail)
                                    {
                                      if($detail->masterId == $record->id){
                                        if($detail->recordSubmit == 1){
                                          echo 'checked';
                                        }
                                      }
                                    }
                                  }
                                  ?>
                                  >
                                  <label for="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"></label>
                                </div>
                              </td>
                              <!-- <td class="text-center widthMaxContent">
                                <div class="btn-group">
                                  <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                    <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                </div>
                              </td> -->
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
                </div>
                <!-- /.row -->
              </div>
              <!-- /.container-fluid -->

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

<script>
  loadMyTable('table', true, 15);
  loadMyTable('tabledetailpage', false, -1);

  $('#tabledetailpage').on( 'click', '.plus', function () {
    var myCurrentTable = 'tabledetailpage';
      var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
      $("td :input", row).val("");
      $("td.qtyC", row).text("");
      $("td.rateC", row).text("");
      $("td b.totalValue", row).text("");

      $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
      $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

      $("td:eq(2)", row).closest('td').html('<select class="form-control select2" id="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($('#'+myCurrentTable+' tr:last').find("td").eq(1).children().attr("id").split("_")[$('#'+myCurrentTable+' tr:last').find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().attr("name") +'"></select>');

      $('#'+myCurrentTable).DataTable().row.add(row).draw();

      $.ajax({
        url:"<?php echo base_url(); ?>login/pageAjaxGet",
        method:"POST",
        success:function(data)
        {
          myId = $('#'+myCurrentTable+" tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($('#'+myCurrentTable+" tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$('#'+myCurrentTable+" tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]));
          $('#'+myId).html(data);
        }
       });

      $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
      $('#'+myCurrentTable+' select').select2();
      $('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
  });
</script>