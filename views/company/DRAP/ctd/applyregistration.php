<?php
// if($userInfo[0]->status == 'Completed'){
//   //if($this->userId <> 27){
//   header("Location:".base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
//   exit();
//   //}
// }
?>
<head>
  
</head>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 style="color:#000;">
        <i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName; ?>
        <!-- <small>Add, Edit, Delete, View</small> -->
      </h1>
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
          <div class="col-xs-12 text-right">
              <div class="form-group">
                  <a class="btn btn-primary" href="<?php echo base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'Add' ?>"><i class="fa fa-plus"></i> <?php echo $pageTitle[0]->friendlyName; ?></a>
              </div>
          </div>
      </div>
      <div class="col-md-4 col-xs-12 pull-right">
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
      <div class="row">
        <!-- row -->
        <div class="col-xs-12">
          <div class="box">
            <!-- box -->
            <!-- box-header -->
            <!-- <div class="box-header">
              <h3 class="box-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.box-header -->
            <div class="box-body table-responsive">
              <!-- box-body -->
              <table id="table" class="table table-bordered table-striped" width="100%">
                <thead>
                <tr>
                  <th>S.#</th>
                  <th class="text-center">Referrence No.</th>
                  <th>Registration Type</th>
                  <th>Registration No.</th>
                  <th>Approved Name</th>
                  <th>Registration Date</th>
                  <th>Validity</th>
                  <th>Last Renewal Date</th>
                  <th>Origin</th>
                  <th class="text-center">Queue (Position)</th>
                  <th class="text-center">Priority</th>
                  <th class="text-center">Days To Respond</th>
                  <th class="text-center">Stage</th>
                  <!-- <th class="text-center">Status</th> -->
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
                  <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <td><?php echo $record->registrationType.' &mdash; '.$record->registrationSubType; ?></td>
                    <td><?php echo $record->registrationNo; ?></td>
                    <td><?php echo $record->approvedName; ?></td>
                    <td><?php echo $record->regIssueDate; ?></td>
                    <td><?php echo $record->validTill; ?></td>
                    <td><?php echo $record->lastRenewalDate; ?></td>
                    <td><?php echo $record->productOrigin; ?></td>
                    <td class="text-center"><?php if($record->registrationStatus == 'Submitted'){if($record->queuePosition <> 0){echo $record->queuePosition;}else{echo 'Now Serving';}}else{echo '';} ?></td>
                    <td class="text-center"><?php if($record->isPriority == 1){echo '<i class="icon fa fa-warning text-red"></i>';} ?></td>
                    <td class="text-center"><?php //echo $record->lastRenewalDate; ?></td>
                    <td class="text-center">
                      <b><h4><span class='label label-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Screening' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review Stage 1' || $record->registrationStatus == 'Under Review Stage 2' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Board Stage 3'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 4' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                    </td>
                    <!-- <td class="text-center">
                      <b><h4><span class='label label-<?php if($record->status == 'Active'){echo 'success';} elseif($record->status == 'Inactive'){echo 'warning';} ?>'><?php echo $record->status; ?></span></h4></b>
                    </td> -->
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">

                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <!-- <?php if($record->registrationStatus <> 'Approved'){ echo '
                            <li><a href="'.base_url().'companyqueryAdd/'.$record->id.'/Registration'.'">Add Query</a></li>
                            ';} ?> -->
                            <!-- <?php if($record->registrationStatus == 'Approved'){ echo '
                            <li><a href="'.base_url().'reportView/Applicant Registration Certificate/'.$record->id.'">Registration Certificate</a></li>
                            ';} ?> -->
                            <!-- <?php if($record->registrationStatus == 'Under R and I'){ echo '
                            <li><a href="'.base_url().'reportView/Registration Application Submission Receipt/'.$record->id.'">Application Submission Receipt</a></li>
                            ';} ?> -->
                            <li><a href="<?php echo base_url().'reportView/Registration Application Submission Receipt/'.$record->id; ?>">Application Submission Receipt</a></li>
                          </ul>
                        </div>

                        <a href="<?php echo base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'View/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        <?php if($record->registrationStatus <> 'Approved'){ echo '
                        <a href="'.base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'Edit/'.$record->id.'" class="btn btn-primary" onclick="return confirm(\'Are you sure you want to edit this record?\')"><i class="fa fa-pencil"></i></a>
                        ';} ?>
                        <?php if($record->registrationStatus == 'Draft'){ echo '
                        <a href="'.base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'Delete/'.$record->id.'" class="btn btn-danger" onclick="return confirm(\'Are you sure you want to delete this record?\')"><i class="fa fa-trash"></i></a>
                        ';} ?>
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
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#table thead tr').clone(true).appendTo( '#table thead' );
        $('#table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            if(title == '' || title == 'S.#' || title == 'Action'){
              $(this).html( '' );
            }
            else{
              $(this).html( '<input type="text" class="form-control hidden" placeholder="Search '+title+'" />' );
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
     
        var table = $('#table').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : true,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }],
            //'dom'          : 'Bfrtip',
            'buttons'      : ['columnsToggle'],
        });
        // Hide two columns
        //table.columns( [1,2] ).visible( false );
    });
    $( "#table thead th" ).click(function() {
      $( "#table thead th input" ).removeClass('hidden');
    });
  </script>