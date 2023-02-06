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
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New Member</a>';
                ?>
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
                  <th>Type</th>
                  <!-- <th>Is Lead</th> -->
                  <th>User Name</th>
                  <th>Member Name</th>
                  <th>Department</th>
                  <th>Designation</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Enter Date</th>
                  <th>Exit Date</th>
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
                    <!-- <td><?php if($record->isLead == 1){echo 'Lead';} ?></td> -->
                    <td><?php echo $record->userName; ?></td>
                    <td><?php echo $record->memberName; ?></td>
                    <td><?php echo $record->department; ?></td>
                    <td><?php echo $record->designation; ?></td>
                    <td><?php echo $record->phone; ?></td>
                    <td><?php echo $record->email; ?></td>
                    <td><?php echo $record->enterDate; ?></td>
                    <td><?php echo $record->exitDate; ?></td>
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

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Type'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'type'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Internal" <?php if('Internal' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Internal</option>
                    <option value="External" <?php if('External' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>External</option>
                  </select>
                </div>
              </div>

              <?php if($myAction == 'add'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'User (If Internal)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'userId'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                      if(!empty($users))
                      {
                        foreach ($users as $record)
                        {
                            ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->userName.' ('.$record->department.' &mdash; '.$record->designation.')' ?></option>
                            <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <?php } ?>
              <?php if($myAction <> 'add'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'User (If Internal)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'userId'; ?>
                  <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                      if(!empty($users))
                      {
                        foreach ($users as $record)
                        {
                            ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->userName.' ('.$record->department.' &mdash; '.$record->designation.')' ?></option>
                            <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
              <?php } ?>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Member Name (If External)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'memberName'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Department (If External)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'department'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Designation (If External)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'designation'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Phone (If External)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'phone'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Email (If External)'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'email'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
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