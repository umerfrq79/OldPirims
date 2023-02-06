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
             
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th>Meeting No</th>
                  <th>Meeting Created Date</th>
                  <th> Meeting Date </th>
                  <th>Action</th>
                  
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
                  <tr>
                    <td> <?= $sn ?> </td>
                    <td><?php echo $record->meetingNo; ?></td>
                    <td><?php echo $record->createddate; ?></td>
					
					<td><?php echo $record->isheld == 1?$record->meetingDate:''; ?></td>
                    <td class="text-center">
                      <?php 
					  
						echo '<a title="Meeting Agenda" href="'.base_url().'report/view/License Agenda/" target="_blank" class="btn btn-success mx-3"><i class="fa fa-file-alt"></i></a>';

						if($record->isheld == 0){
							echo '<a  title="Meeting Minutes" href="'.base_url().'agendaandminutes/lookup/'.$record->id.'" class="btn btn-info"><i class="fa fa-file"></i></a>';
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