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
/*
if(explode('/', $_SERVER['REQUEST_URI'])[2] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[3];
}
if(explode('/', $_SERVER['REQUEST_URI'])[1] == $pageTitle[0]->url){
  $myAction = explode('/', $_SERVER['REQUEST_URI'])[2];
}
*/
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
                  <th class="text-center">Referrence No.</th>
                  <th>Registration No.</th>
                  <th>Approved Name</th>
                  <th>Registration Type</th>
                  <th>Product Origin</th>
                  <th>Product Category</th>
                  <th>Used For</th>
                  <th>Issue Date</th>
                  <th>Renewal Due Date</th>
                  <th>Last Renewal Date</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
                  <?php $sn=1; ?>
                  <?php
                  if(!empty($registrationRecords))
                  {
                      foreach($registrationRecords as $record)
                      {
                        $seenBy = explode(",",$record->seenBy);
                  ?>
                  <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                    <td><?=$sn?>.</td>
                    <td class="text-center"><?php echo $record->id; ?></td>
                    <td><?php echo $record->registrationNo; ?></td>
                    <td><?php echo $record->approvedName; ?></td>
                    <td><?php echo ($record->isexport == 1)?'Export Registration':$record->registrationType.' &mdash; '.$record->registrationSubType; ?></td>
                    <td><?php echo $record->productOrigin; ?></td>
                    <td><?php echo $record->productCategory; ?></td>
                    <td><?php echo $record->usedFor; ?></td>
                    <td><?php echo isset($record->issueDateManual)?date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))):''; ?></td>
                    <td><?php echo isset($record->validTill)?date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))):''; ?></td>
                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                    <td class="text-center">
                      <b><h4><span class='badge bg-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Screening' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review Stage 1' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Post Inspection Process' || $record->registrationStatus == 'Under Board Stage 2' || $record->registrationStatus == 'Post Board Process'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 3' || $record->registrationStatus == 'Under Pricing' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                    </td>
                    <td class="text-center widthMaxContent">
                      <div class="btn-group">



                        <div class="btn-group-prepend">
                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu" style="">

                            <?php if($record->panelOfInspector1){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Registration Panel of Inspector/'.$record->id.'">Registration Panel of Inspector</a></li>
                            ';} ?>
                            <?php if($record->registrationStatus == 'Approved'){ echo '
                            <li class="dropdown-item"><a href="'.base_url().'report/view/Applicant Registration Certificate/'.$record->id.'">Registration Certificate</a></li>
                            ';} ?>
                              <?php
                              echo '<li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Product Detail/'.$record->id.'">Product Detail</a></li>';
                              ?>
                          </ul>
                        </div>

                          <a href="<?php echo base_url().'importregistration/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
<!--
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                        -->
                          <?php if($record->registrationStatus <> 'Approved'){ ?>
                        <!--
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        -->
                          <?php } ?>
                        <?php if($record->registrationStatus == 'Draft'){ ?>
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
</section>
  <!-- /.content -->
</div>

<script type="text/javascript">
  loadMyTable('table', true, 15);


  $(function () {
  })
</script>