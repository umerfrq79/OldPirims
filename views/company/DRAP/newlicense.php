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
    <?php if($myAction == 'lookup'){ ?>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/select/1.6.0/css/select.dataTables.min.css" />

        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/select/1.6.0/js/dataTables.select.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.colVis.min.js"></script>
    <?php } ?>

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
                                    <?php if( @$records[0]->countLicense < 1 && $this->roleId == 26){  //  ?>
                                        <a class="btn btn-primary" href="<?php echo base_url().$pageTitle[0]->url.'/add' ?>"><i class="fa fa-plus"></i> <?php echo $pageTitle[0]->friendlyName; ?></a>
                                    <?php }?>
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
                                <table id="<?php echo ($myAction == 'lookup' ? 'newtable' : '') ?>" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width:5%">S.#</th>
                                        <th class="text-center d-none">Referrence No.</th>
                                        <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                            <th style="width:5%">Company</th>
                                            <th class="d-none">NTN</th>
                                        <?php } ?>
                                        <th style="width:5%">License Type</th>
                                        <th class="d-none">License No.</th>
                                        <th class="d-none">Issue Date</th>
                                        <th style="width:5%">Renewal Due Date</th>
                                        <th class="d-none">Last Renewal Date</th>
                                        <th class="text-center d-none">Queue (Position)</th>
                                        <?php if($this->roleId == 26){?>
                                            <th class="text-center d-none">Days To Respond</th>
                                        <?php } ?>
                                        <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                            <th style="width:5%">Assigned Officer</th>
                                            <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38 || $this->roleId == 43){?>
                                                <th style="width:5%">Desk Officer</th>
                                            <?php } } ?>
                                        <th style="width:3%">App. Submitted</th>
                                        <th style="width:3%">Phase</th>
                                        <th style="width:3%" class="text-center">Stage</th>
                                        <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                            <th style="width:5%">In Board</th>
                                        <?php } ?>
                                        <!-- <th class="text-center">Status</th> -->
                                        <th style="width:10%" class="text-center">Action</th>
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
                                                <td class="d-none text-center"><?php echo $record->id; ?></td>
                                                <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                                    <td style="white-space: break-spaces;"><?php echo '<b>'.$record->companyName.'</b><br>'.$record->siteAddress; ?></td>
                                                    <td class="d-none"><?php echo $record->companyNTN; ?></td>
                                                <?php } ?>
                                                <td><?php echo $record->licenseSubType.'<br>'.$record->licenseNoManual; ?></td>
                                                <td class="d-none"><?php echo $record->licenseNoManual; ?></td>
                                                <td class="d-none"><?php echo $record->issueDateManual; ?></td>
                                                <td><?php echo $record->validTill; ?></td>
                                                <td class="d-none"><?php echo $record->lastRenewalDateManual; ?></td>
                                                <td class="d-none text-center"><?php if($record->licenseStatus == 'Submitted'){if($record->queuePosition <> 0){echo $record->queuePosition;}else{echo 'Now Serving';}}else{echo '';} ?></td>
                                                <?php if($this->roleId == 26){?>
                                                    <td class="d-none text-center"><?php //echo $record->lastRenewalDate; ?></td>
                                                <?php } ?>
                                                <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                                    <td><?php echo $record->assignedOfficer; ?></td>
                                                    <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38 || $this->roleId == 43){?>
                                                        <td class="text-center"><?php echo $record->deskOfficer; ?></td>
                                                    <?php } } ?>
                                                <td><?php
                                                    if($record->phase == 'Site Verification'){
                                                        echo ($record->siteSubmissionDate == '' || $record->siteSubmissionDate == NULL)?$record->createddate:$record->siteSubmissionDate;
                                                    }else if($record->phase == 'Layout Plan'){
                                                        echo ($record->layoutSubmissionDate == '' || $record->layoutSubmissionDate == NULL)?$record->createddate:$record->layoutSubmissionDate;
                                                    }else if($record->phase == 'Grant of License'){
                                                        echo ($record->grantSubmissionDate == '' || $record->grantSubmissionDate == NULL)?$record->createddate:$record->grantSubmissionDate;

                                                    }
                                                    ?></td>
                                                <td><?php echo $record->phase; ?></td>
                                                <td class="text-center">
                                                    <span style="font-size: 14px; font-weight: bold;width: 100%;white-space: break-spaces;"  class='badge bg-<?php if($record->licenseStatus == 'Draft'){echo 'warning';} elseif($record->licenseStatus == 'Submitted' || $record->licenseStatus == 'Screening' || $record->licenseStatus == 'Under R and I'){echo 'info';} elseif($record->licenseStatus == 'Received By DRAP' || $record->licenseStatus == 'Under Review Stage 1' || $record->licenseStatus == 'Under Inspection' || $record->licenseStatus == 'Post Inspection Process' || $record->licenseStatus == 'Under Board Stage 2'){echo 'primary';} elseif($record->licenseStatus == 'Referred Back To Company (Editable)' || $record->licenseStatus == 'Referred Back To Company (Locked)'){echo 'secondary';} elseif($record->licenseStatus == 'Rejected and Closed'){echo 'danger';} elseif($record->licenseStatus == 'Recommended By Board Stage 3' || $record->licenseStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->licenseStatus; ?></span>
                                                </td>
                                                <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                                    <td class="text-center"><?php if($record->discussInBoard == 1){echo 'Yes';} if($record->discussInBoard == 0){echo 'No';} ?></td>
                                                <?php } ?>
                                                <td class="text-center widthMaxContent">
                                                    <div class="btn-group">

                                                        <div class="btn-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" style="">
                                                                <?php if($this->roleId <> '26'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/License Note Sheet/'.$record->id.'">License Note Sheet</a></li>
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/All License Note Sheet/'.$record->id.'">All Applications License Note Sheet</a></li>
                            ';} ?>
                                                                <!-- <?php if($record->phase == 'Site Verification'){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Shortcoming Letter/'.$record->id.'">Site Verification Shortcoming Letter</a></li>
                            ';} ?> -->
                                                                <?php if($record->reviewer1Remarks && ($this->roleId <> '26' || $record->licenseStatus == 'Referred Back To Company (Locked)' )){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Shortcoming Letter/'.$record->id.'">Site Verification Shortcoming Letter</a></li>
                            ';} ?>
                                                                <?php if($record->phase == 'Site Verification' && ($record->licenseStatus == 'Under Inspection' || $record->licenseStatus == 'Post Inspection Process') && $record->siteData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Verification Letter/'.$record->id.'">Site Verification Letter</a></li>
                            ';} ?>
                                                                <?php if(($record->phase == 'Layout Plan' || $record->phase == 'Grant of License') && $record->siteData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Site Approval Letter/'.$record->id.'">Site Approval Letter</a></li>
                            ';} ?>
                                                                <?php if($record->reviewer1Remarks2 && ($this->roleId <> '26' || $record->licenseStatus == 'Referred Back To Company (Locked)' )){ echo '
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
                                                                <?php if($record->licenseStatus == 'Approved' && $record->dmlData == 0){ echo '
                            <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Applicant License Certificate/'.$record->id.'">Establishment License Certificate</a></li>
                            ';} ?>
                                                            </ul>
                                                        </div>

                                                        <?php if($this->roleId <> '26'){ ?>
                                                            <a href="<?php echo base_url().'licensereport/edit/'.$record->id; ?>" class="btn btn-warning"><i class="fa fa-file"></i></a>
                                                        <?php } ?>
                                                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>

                                                        <?php if($record->licenseStatus <> 'Approved'){ ?>
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                                        <?php } ?>
                                                        <?php if($record->licenseStatus == 'Draft'){ ?>
                                                            <!-- <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to apply for license variance?')"><i class="fa fa-certificate"></i></a>

                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a> -->
                                                        <?php } ?>
                                                        <?php
                                                        if(($this->roleId == '38' || $record->assignedOfficerId == $this->userId) && $this->roleId <>  '18'  && $record->licenseStatus <> 'Referred Back To Company (Locked)' && $record->licenseStatus <> 'Approved' && $record->licenseStatus <> 'Under Inspection' && $record->licenseStatus <> 'Draft'){
                                                            ?>
                                                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#notesheetmodal" data-company="<?php echo $record->companyName; ?>" data-id="<?php echo $record->id; ?>"><i class="fa fa-user"></i></button>
                                                            <?php
                                                        }
                                                        ?>
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
                        <h4 class="text-center"><?php echo @$recordsEdit[0]->phase; ?></h4>
                        <h6 class="text-center"><?php echo @$recordsEdit[0]->licenseStatus; ?></h6>
                        <?php
                        if(@$recordsEdit[0]->licenseStatus == 'Draft'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 45px;">Draft</span>
                    <span style="margin-right: 45px;">Screening</span>
                    <span style="margin-right: 45px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                        }
                        if(@$recordsEdit[0]->licenseStatus == 'Submitted' || @$recordsEdit[0]->licenseStatus == 'Screening' || @$recordsEdit[0]->licenseStatus == 'Under R and I' || @$recordsEdit[0]->licenseStatus == 'Received By DRAP' || @$recordsEdit[0]->licenseStatus == 'Referred Back To Company (Editable)'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 47px;">Draft</span>
                    <span style="margin-right: 63px;">Screening</span>
                    <span style="margin-right: 63px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                        }
                        if(@$recordsEdit[0]->licenseStatus == 'Under Review Stage 1' || @$recordsEdit[0]->licenseStatus == 'Under Inspection' || @$recordsEdit[0]->licenseStatus == 'Referred Back To Company (Locked)'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 43px;">Draft</span>
                    <span style="margin-right: 43px;">Screening</span>
                    <span style="margin-right: 57px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                        }
                        if(@$recordsEdit[0]->licenseStatus == 'Under Board Stage 2' || @$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->licenseStatus == 'Approved'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <span style="margin-left: -5px; margin-right: 47px;">Draft</span>
                    <span style="margin-right: 37px;">Screening</span>
                    <span style="margin-right: 37px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                        }
                        ?>

                        <div class="row">
                            <?php if(@$challanInfo[0]->challan_no || $this->roleId <> 26){ ?>
                                <div class="col-md-12">
                                    <div class="card <?php echo (@$challanInfo[0]->challan_status == 'Paid')?'card-success':'card-danger' ?>">
                                        <div class="card-header">
                                            <span> Challan Staus  : <strong><?php echo @$challanInfo[0]->challan_status; ?></strong></span>
                                        </div>
                                        <div class="card-body">
                                            <span><strong> Challan No :  </strong><?php echo @$challanInfo[0]->challan_no; ?></span><br>
                                            <span><strong> Challan Fee :  </strong><?php echo @$challanInfo[0]->challan_fee; ?></span><br>
                                            <span><strong> Challan Date :  </strong><?php echo @$challanInfo[0]->challan_date; ?></span><br>
                                            <span><strong> Challan Info :  </strong><?php echo @$challanInfo[0]->challan_msg; ?></span><br>
                                        </div>
                                    </div>
                                </div>
                            <?php } else { ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php $label = 'Challan No'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'challan_no'; ?>
                                        <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                        <input type="hidden" id="challan_msg" name="challan_msg" value="" />
                                        <input type="hidden" id="challan_status" name="challan_status" value="" />
                                        <input type="hidden" id="challan_fee" name="challan_fee" value="" />
                                        <input type="hidden" id="challan_date" name="challan_date" value="" />
                                        <input type="hidden" id="challan_account_id" name="challan_account_id" value="" />
                                        <input type="hidden" id="challan_account_title" name="challan_account_title" value="" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label> &nbsp;</label>
                                    <div>
                                        <a href="#" id="verify_challan" class="btn btn-sm btn-success">
                                            Verify Challan
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-danger mb-12 challan-status">Challan Status:</p>
                                    <p class="text-default mb-10" id="verify_result"></p>
                                </div>
                            <?php } ?>
                        </div>

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
                                                <i><u><?php echo @$recordsEdit[0]->siteAddress.', '.@$recordsEdit[0]->siteCityName; ?></u></i>
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

                            <?php if($myAction == 'add'){ ?>
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label>Current Phase</label>
                                        <br>
                                        <i><u><?php echo 'Site Verification'; ?></u></i>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($myAction <> 'add'){ ?>
                                <div class="col-md-12">
                                    <br>
                                    <div class="form-group">
                                        <label>Current Phase</label>
                                        <br>
                                        <i><u><?php echo @$recordsEdit[0]->phase; ?></u></i>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs">
                                            <?php if(@$recordsEdit[0]->phase == 'Site Verification' || $myAction == 'add'){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab1">Site Verification</a>
                                                </li>
                                            <?php } ?>
                                            <?php if(@$recordsEdit[0]->phase == 'Layout Plan'){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab3">Layout Plan</a>
                                                </li>
                                            <?php } ?>
                                            <?php if(@$recordsEdit[0]->phase == 'Grant of License'){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab4">Grant of License</a>
                                                </li>
                                            <?php } ?>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab2">Queries</a>
                                            </li>
                                            <?php if($this->roleId <> 26){ ?>
                                                <?php if(@$recordsEdit[0]->licenseStatus <> 'Submitted' && @$recordsEdit[0]->licenseStatus <> 'Screening' && @$recordsEdit[0]->licenseStatus <> 'Under R and I' && $recordsEdit[0]->licenseStatus <> 'Received By DRAP'){ ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab5">Letter Statement</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(@$recordsEdit[0]->phase == 'Grant of License'  && (@$recordsEdit[0]->licenseStatus == 'Under Board Stage 2' || @$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3')){ ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab6">CLB</a>
                                                    </li>
                                                <?php  } ?>
                                                <?php if(@$recordsEdit[0]->licenseStatus == 'Post Inspection Process' || @$recordsEdit[0]->licenseStatus == 'Under Board Stage 2' || @$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3'){ ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab8">Inspection Report</a>
                                                    </li>
                                                <?php } ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab7">Assignment / Note Sheet</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="tab-pane fade show" id="tab1">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Establishment License'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licenseTypeId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($licenseType))
                                                                {
                                                                    foreach ($licenseType as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->licenseSubType ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svCoveringLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svFeeChallan'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Legal Status of Management / Firm'; ?>
                                                            <?php if(@$recordsEdit[0]->companyType == 'Private Limited' || @$recordsEdit[0]->companyType == 'Public Limited'){ $label = 'SECP Documents';} if(@$recordsEdit[0]->companyType == 'Sole Proprietor'){ $label = 'Affidavit Document';} ?>
                                                            <label><?php echo $label; ?> (<?php echo @$recordsEdit[0]->companyType; ?>) <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svStatusOfFirm'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Copy Of CNIC'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svCopyOfCNIC'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <?php if(@$recordsEdit[0]->companyType == 'Partnership'){ ?>
                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Documents of Partnership from registrar of firm'; ?>
                                                                <label><?php echo $label; ?> (<?php echo @$recordsEdit[0]->companyType; ?>) <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'svRegistrationCertificate'; ?>
                                                                <div class="custom-file">
                                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo $label; ?> Link</label>
                                                                <br>
                                                                <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Complete Set of Land Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svLandDocument'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Site Map'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svSiteMap'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Management Team</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailmanagement'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Name</th>
                                                                        <th>Father/Spouse Name</th>
                                                                        <th>Address</th>
                                                                        <th>NIC</th>
                                                                        <th>Department</th>
                                                                        <th>Designation</th>
                                                                        <th>Phone</th>
                                                                        <th>Email</th>
                                                                        <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                    if(empty($recordsDetailManagement))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailManagement[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailManagement))
                                                                    {
                                                                        foreach($recordsDetailManagement as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'name'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'fatherName'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'address'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'nic'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'department'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'designation'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'email'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                            <?php $label = 'Site Address'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'siteAddress'; ?>
                                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Site City'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'siteCity'; ?>
                                                            <!--<input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
								-->
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($city))
                                                                {
                                                                    foreach ($city as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->cityName ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Site Address Link (Google Map URL)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'googleMapURL'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Latitude'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'latitude'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Longitude'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'longitude'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab2">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Queries</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailquery'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Date & Time</th>
                                                                        <th>Title</th>
                                                                        <th>Message</th>
                                                                        <th>Attachment</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $sn = 1;
                                                                    $sId = 0;
                                                                    $total = 0;
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailQuery))
                                                                    {
                                                                        foreach($recordsDetailQuery as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                </td>
                                                                                <td><?php echo $record->dateTime; ?></td>
                                                                                <td><?php echo $record->title; ?></td>
                                                                                <td><?php echo $record->message; ?></td>
                                                                                <td>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'filePath'; ?>
                                                                                            <a <?php if(!@$record>$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
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

                                            </div>
                                            <div class="tab-pane fade" id="tab3">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'lpApplicationCoveringLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'lpChallanForm'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Tracking No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma2'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma3'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Courier Company'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma4'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Layout Plan</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetaillayoutplan'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Layout Plan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                        <th>Description</th>
                                                                        <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                    if(empty($recordsDetailLayoutPlan))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailLayoutPlan[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailLayoutPlan))
                                                                    {
                                                                        foreach($recordsDetailLayoutPlan as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'filePath'; ?>
                                                                                            <div class="custom-file">
                                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'description'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Section's Detail</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailsection'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Section</th>
                                                                        <th>Pharmacological Group</th>
                                                                        <th>Used For</th>
                                                                        <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                    if(empty($recordsDetailSection))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailSection[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailSection))
                                                                    {
                                                                        foreach($recordsDetailSection as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'Section'; ?>
                                                                                            <?php $column = 'sectionId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($section))
                                                                                                {
                                                                                                    foreach ($section as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
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
                                                                                            <?php $label = 'Pharmacological Group'; ?>
                                                                                            <?php $column = 'pharmaGroupId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($pharmaGroup))
                                                                                                {
                                                                                                    foreach ($pharmaGroup as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
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
                                                                                            <?php $label = 'Used For'; ?>
                                                                                            <?php $column = 'usedForId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($usedFor))
                                                                                                {
                                                                                                    foreach ($usedFor as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab4">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Form-1'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlForm1'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlProForma'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Legal Status and management (SECP / Registration of firm documents/ Affidavit)'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlLegalStatus'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlFeeChallan'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Layout Plan <?php if($this->roleId == 26){ ?>(Readonly)<?php } ?></h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetaillayoutplans'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Layout Plan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                        <th>Description</th>
                                                                        <th>Approved Layout Plan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $sn = 1;
                                                                    $sId = 0;
                                                                    $total = 0;
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailLayoutPlan))
                                                                    {
                                                                        foreach($recordsDetailLayoutPlan as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'filePath'; ?>
                                                                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'description'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <?php if($this->roleId <> 26 && @$recordsEdit[0]->phase == 'Layout Plan'){ ?>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'approvedLayoutplanPath'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php } ?>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'approvedLayoutplanPath';
                                                                                            $recordsEdit[0]->$column = (!@$recordsEdit[0]->$column)?@$recordsEdit[0]->layoutPlanLetter:@$recordsEdit[0]->$column;

                                                                                            ?>
                                                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
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
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Management Team (Readonly)</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailmanagement1'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Name</th>
                                                                        <th>Father/Spouse Name</th>
                                                                        <th>Address</th>
                                                                        <th>NIC</th>
                                                                        <th>Department</th>
                                                                        <th>Designation</th>
                                                                        <th>Phone</th>
                                                                        <th>Email</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $sn = 1;
                                                                    $sId = 0;
                                                                    $total = 0;
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailManagement))
                                                                    {
                                                                        foreach($recordsDetailManagement as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'name'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'fatherName'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'address'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'nic'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'department'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'designation'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'email'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
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

                                                    <?php if(@$recordsEdit[0]->licenseTypeId == 1 || @$recordsEdit[0]->licenseTypeId == 2){ ?>
                                                        <div class="col-md-12">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">API</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailapi'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed1" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>API Name</th>
                                                                            <th>Application Form <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Fee Challan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Chemical Names Manufacturing <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Chemical Names Recycled <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Manufacturing Flow Chart <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Theorical Yied <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Trial Batches <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Reference Monograph <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Testing Equipments <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Shelf Life Of API <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <th>Material Safety Data <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></th>
                                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                        if(empty($recordsDetailApi))
                                                                        {
                                                                            unset($record);
                                                                            @$recordsDetailApi[0]->id = 1;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailApi))
                                                                        {
                                                                            foreach($recordsDetailApi as $record)
                                                                            {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'apiName'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath2'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath3'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath4'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath5'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath6'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath7'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath8'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath9'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath10'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath11'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 <?php if(!@$record->$column){echo 'required';}?>">
                                                                                                    <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Sections (Basic/Semi-Basic Manufacture)</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailfacility'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed1" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>Facility/Section Name</th>
                                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                        if(empty($recordsDetailFacility))
                                                                        {
                                                                            unset($record);
                                                                            @$recordsDetailFacility[0]->id = 1;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailFacility))
                                                                        {
                                                                            foreach($recordsDetailFacility as $record)
                                                                            {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'facilityname'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>

                                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Machine's Detail</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailsection2'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th  style="display:none">Section</th>
                                                                            <th  style="display:none">Pharmacological Group</th>
                                                                            <th  style="display:none">Used For</th>
                                                                            <th>Section/Facility Name</th>
                                                                            <th>Machine Name</th>
                                                                            <th>Machine Make</th>
                                                                            <th>Machine Model</th>
                                                                            <th>Machine Serial No.</th>
                                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                        if(empty($recordsDetailSectionMachine))
                                                                        {
                                                                            unset($record);
                                                                            @$recordsDetailSectionMachine[0]->id = 1;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailSectionMachine))
                                                                        {
                                                                            foreach($recordsDetailSectionMachine as $record)
                                                                            {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td style="display:none">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $label = 'Section'; ?>
                                                                                                <?php $column = 'sectionId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($sectionApproved11))
                                                                                                    {
                                                                                                        foreach ($sectionApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->sectionId ?>" <?php if($detail->sectionId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
                                                                                                            <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td  style="display:none">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $label = 'Pharmacological Group'; ?>
                                                                                                <?php $column = 'pharmaGroupId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($pharmaGroupApproved11))
                                                                                                    {
                                                                                                        foreach ($pharmaGroupApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->pharmaGroupId ?>" <?php if($detail->pharmaGroupId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
                                                                                                            <?php
                                                                                                        }
                                                                                                    }
                                                                                                    ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td  style="display:none">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $label = 'Used For'; ?>
                                                                                                <?php $column = 'usedForId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($usedForApproved11))
                                                                                                    {
                                                                                                        foreach ($usedForApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->usedForId ?>" <?php if($detail->usedForId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
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
                                                                                                <?php $column = 'mfacilityName'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'drugName'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machineMake'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machineModel'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machinePartNo'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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

                                                    <?php } ?>

                                                    <?php if(@$recordsEdit[0]->licenseTypeId == 6){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Repacking Drug'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'pvmg4'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Qualified Staff</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailqualifiedstaff'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Name</th>
                                                                        <th>Father/Spouse Name</th>
                                                                        <th>Address</th>
                                                                        <th>NIC</th>
                                                                        <th>Phone</th>
                                                                        <th>Designation</th>
                                                                        <th>Qualification</th>
                                                                        <th>Specialization</th>
                                                                        <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                    if(empty($recordsDetailQualifiedStaff))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailQualifiedStaff[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailQualifiedStaff))
                                                                    {
                                                                        foreach($recordsDetailQualifiedStaff as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                    <?php $column = 'id'; ?>
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'name'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'fatherName'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'address'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'nic'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'Designation'; ?>
                                                                                            <?php $column = 'designationId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($designation))
                                                                                                {
                                                                                                    foreach ($designation as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->designation ?></option>
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
                                                                                            <?php $label = 'Qualification'; ?>
                                                                                            <?php $column = 'qualificationId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($qualification))
                                                                                                {
                                                                                                    foreach ($qualification as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->qualification ?></option>
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
                                                                                            <?php $label = 'Specialization'; ?>
                                                                                            <?php $column = 'specializationId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($specialization))
                                                                                                {
                                                                                                    foreach ($specialization as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->specialization ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Production Incharge Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'qsDocuments'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'QC Incharge Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'qsDocuments2'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>
                                                    <?php if(@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2){ ?>
                                                        <div class="col-md-12">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Section's Detail</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailsections'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>Section</th>
                                                                            <th>Pharmacological Group</th>
                                                                            <th>Used For</th>
                                                                            <th>Ready for Inspection</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $sn = 1;
                                                                        $sId = 0;
                                                                        $total = 0;
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailSection))
                                                                        {
                                                                            foreach($recordsDetailSection as $record)
                                                                            {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $label = 'Section'; ?>
                                                                                                <?php $column = 'sectionId'; ?>
                                                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($section))
                                                                                                    {
                                                                                                        foreach ($section as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
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
                                                                                                <?php $label = 'Pharmacological Group'; ?>
                                                                                                <?php $column = 'pharmaGroupId'; ?>
                                                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($pharmaGroup))
                                                                                                    {
                                                                                                        foreach ($pharmaGroup as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
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
                                                                                                <?php $label = 'Used For'; ?>
                                                                                                <?php $column = 'usedForId'; ?>
                                                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($usedFor))
                                                                                                    {
                                                                                                        foreach ($usedFor as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
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
                                                                                                <?php $column = 'approved'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="" <?php if('' == @$record->$column){ echo 'selected'; } ?>>Select ---</option>
                                                                                                    <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                                                                                    <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
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
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Machine's Detail</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailsection2'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>Section</th>
                                                                            <th>Pharmacological Group</th>
                                                                            <th>Used For</th>
                                                                            <th>Machine Name</th>
                                                                            <th>Machine Make</th>
                                                                            <th>Machine Model</th>
                                                                            <th>Machine Serial No.</th>
                                                                            <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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
                                                                        if(empty($recordsDetailSectionMachine))
                                                                        {
                                                                            unset($record);
                                                                            @$recordsDetailSectionMachine[0]->id = 1;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailSectionMachine))
                                                                        {
                                                                            foreach($recordsDetailSectionMachine as $record)
                                                                            {
                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $label = 'Section'; ?>
                                                                                                <?php $column = 'sectionId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($sectionApproved11))
                                                                                                    {
                                                                                                        foreach ($sectionApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->sectionId ?>" <?php if($detail->sectionId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->section ?></option>
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
                                                                                                <?php $label = 'Pharmacological Group'; ?>
                                                                                                <?php $column = 'pharmaGroupId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($pharmaGroupApproved11))
                                                                                                    {
                                                                                                        foreach ($pharmaGroupApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->pharmaGroupId ?>" <?php if($detail->pharmaGroupId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->pharmaGroup ?></option>
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
                                                                                                <?php $label = 'Used For'; ?>
                                                                                                <?php $column = 'usedForId'; ?>
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                                                    <?php
                                                                                                    if(!empty($usedForApproved11))
                                                                                                    {
                                                                                                        foreach ($usedForApproved11 as $detail)
                                                                                                        {
                                                                                                            ?>
                                                                                                            <option value="<?php echo $detail->usedForId ?>" <?php if($detail->usedForId == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->usedFor ?></option>
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
                                                                                                <?php $column = 'drugName'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machineMake'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machineModel'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'machinePartNo'; ?>
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
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

                                                    <?php } ?>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab5">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'File No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licFileNo'; ?>
                                                            <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <?php if(@$recordsEdit[0]->phase == 'Grant of License' && @$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'License No.'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'licenseNoManual'; ?>
                                                                <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Issue Date'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'issueDateManual'; ?>
                                                                <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if(@$recordsEdit[0]->phase == 'Site Verification'){ ?>
                                                        <div class="col-md-12">
                                                            <?php $label = 'Site Verification Remarks (Shortcoming)'; ?>
                                                            <?php $column = 'reviewer1Remarks'; ?>
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

                                                    <?php } ?>

                                                    <?php if(@$recordsEdit[0]->phase == 'Layout Plan'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'LOP Metting Date'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'lopMeetingDate'; ?>
                                                                <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <?php $label = 'Layout Plan Remarks (Shortcoming)'; ?>
                                                            <?php $column = 'reviewer1Remarks2'; ?>
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






                                                        <?php if(@$recordsEdit[0]->licenseStatus == 'Under Review Stage 1'){ ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php $label = 'Approved Layout Plan'; ?>
                                                                    <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                    <?php $column = 'approvedLayoutplanPath'; ?>
                                                                    <div class="custom-file">
                                                                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                        <!-- <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label><?php echo $label; ?> Link</label>
                                                                    <br>
                                                                    <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                </div>
                                                            </div>
                                                        <?php } } ?>

                                                    <?php if(@$recordsEdit[0]->phase == 'Grant of License'){ ?>
                                                        <div class="col-md-12">
                                                            <?php $label = 'Grant of License Remarks (Shortcoming)'; ?>
                                                            <?php $column = 'reviewer1Remarks3'; ?>
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

                                                        <div class="col-md-12">
                                                            <?php $label = 'Panel of Inspectors (Grant of License)'; ?>
                                                            <?php $column = 'panelOfInspector1'; ?>
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
                                                    <?php } ?>

                                                </div>

                                            </div>

                                            <?php if(@$recordsEdit[0]->phase == 'Grant of License' && (@$recordsEdit[0]->licenseStatus == 'Under Board Stage 2' || @$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3')){ ?>
                                                <div class="tab-pane fade" id="tab6">

                                                    <div class="row" style="float: left; width: 100%;">

                                                        <div class="col-md-12">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Application Board Meetings</h3>
                                                                    <div class="card-tools">
                                                                    </div>
                                                                </div>
                                                                <!-- /.card-header -->
                                                                <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                    <?php $myTable = 'tabledetailmeeting'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>Meeting No.</th>
                                                                            <th>Meeting Date</th>
                                                                            <th>Decision</th>
                                                                            <th class="text-center" style="display:none">Status</th>
                                                                            <?php if($myAction <> 'view'){ ?>
                                                                                <th style="display:none" class="text-center">Action</th>
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
                                                                        if(empty($recordsDetailMeeting))
                                                                        {
                                                                            unset($record);
                                                                            @$recordsDetailMeeting[0]->id = 1;
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        if(!empty($recordsDetailMeeting))
                                                                        {
                                                                            foreach($recordsDetailMeeting as $record)
                                                                            {

                                                                                ?>
                                                                                <tr>
                                                                                    <td class="srNo">
                                                                                        <span><?=$sn?></span>.
                                                                                        <?php $column = 'id'; ?>
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                                        <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $record->meetingNo; ?>
                                                                                        <!--
										<div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'meetingNo'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
										-->
                                                                                    </td>
                                                                                    <td>
                                                                                        <?php echo $record->meetingDate; ?>
                                                                                        <!--
										<div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'meetingDate'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
										-->
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'remarks'; ?>
                                                                                                <textarea <?php echo 'disabled';?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                            </div>
                                                                                        </div>

                                                                                        <!--<?php echo ($this->roleId != 6)?$record->remarks:''; ?>
										<?php if($this->roleId == 6) {?>
										<input type="hidden" id="<?php echo $myTable; ?>-<?php echo 'agendaid'; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo 'agendaid'; ?>_detail[]" value="<?php echo @$record->agendaid; ?>" class="rowId">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'remarks'; ?>
                                            <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
										<?php } ?> -->
                                                                                    </td>
                                                                                    <td style="display:none">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'status'; ?>
                                                                                                <select <?php echo 'disabled'; ?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" >
                                                                                                    <option value="Approved" <?php if('Approved' == @$record->$column){ echo 'selected'; } ?>>Approved</option>
                                                                                                    <option value="Deferred" <?php if('Deferred' == @$record->$column){ echo 'selected'; } ?>>Deferred</option>
                                                                                                    <option value="Inspection Required" <?php if('Inspection Required' == @$record->$column){ echo 'selected'; } ?>>Inspection Required</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <!--
										<?php echo ($this->roleId != 6)?$record->status:''; ?>
										<?php if($this->roleId == 6) {?>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'status'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                              <option value="Approved" <?php if('Approved' == @$record->$column){ echo 'selected'; } ?>>Approved</option>
                                              <option value="Deferred" <?php if('Deferred' == @$record->$column){ echo 'selected'; } ?>>Deferred</option>
                                              <option value="Inspection Required" <?php if('Inspection Required' == @$record->$column){ echo 'selected'; } ?>>Inspection Required</option>
                                            </select>
                                          </div>
                                        </div>
										<?php } ?>
										-->
                                                                                    </td>
                                                                                    <?php if($myAction <> 'view'){ ?>
                                                                                        <td style="display:none" class="text-center widthMaxContent">
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

                                                    </div>

                                                </div>
                                            <?php  } ?>

                                            <div class="tab-pane fade" id="tab7">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Note Sheet</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailhistory'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th class="text-center" width="10%">Date</th>
                                                                        <th class="text-center" width="20%">Designation</th>
                                                                        <th class="text-center" width="20%">Forwarded To</th>
                                                                        <th class="text-center" width="40%">Remarks</th>
                                                                        <th class="text-center" width="10%">Status</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $sn = 1;
                                                                    $sId = 0;
                                                                    $total = 0;
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailHistory))
                                                                    {
                                                                        foreach($recordsDetailHistory as $record)
                                                                        {
                                                                            ?>
                                                                            <tr>
                                                                                <td class="srNo">
                                                                                    <span><?=$sn?></span>.
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $record->dateTime; ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?php
                                                                                    if(!empty($historyDesignation))
                                                                                    {
                                                                                        foreach ($historyDesignation as $detail)
                                                                                        {
                                                                                            ?>
                                                                                            <?php if($detail->id == @$record->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'User'; ?>
                                                                                            <?php $column = 'forwardedTo'; ?>
                                                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($historyDesignation))
                                                                                                {
                                                                                                    foreach ($historyDesignation as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
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
                                                                                            <?php $column = 'remarks'; ?>
                                                                                            <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                    <?php echo $record->status; ?>
                                                                                </td>
                                                                            </tr>
                                                                            <?php $sId++ ?>
                                                                            <?php $sn++ ?>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    <tr>
                                                                        <td class="srNo">
                                                                            <span><?=$sn?></span>.
                                                                        </td>
                                                                        <td class="text-center">
                                                                            <?php echo date($this->dateTimeFormat); ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if(!empty($historyDesignation))
                                                                            {
                                                                                foreach ($historyDesignation as $detail)
                                                                                {
                                                                                    ?>
                                                                                    <?php if($detail->id == $this->userId){ echo $detail->userName.' &mdash; '.$detail->designation; } ?>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?php $label = 'User'; ?>
                                                                                    <?php $column = 'forwardedTo'; ?>
                                                                                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101">
                                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                                        <?php
                                                                                        if(!empty($historyDesignation))
                                                                                        {
                                                                                            foreach ($historyDesignation as $detail)
                                                                                            {
                                                                                                ?>
                                                                                                <option value="<?php echo $detail->id ?>"><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
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
                                                                                    <?php $column = 'remarks'; ?>
                                                                                    <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo @$column; ?>_detail101" class="form-control required" rows="3"></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <?php if($this->roleId == '18'){?>
                                                                                <br>
                                                                                <div class="col-md-12">
                                                                                    <div class="icheck-primary">
                                                                                        <?php $label = 'Send This Query To The Applicant?'; ?>
                                                                                        <?php $column = 'sendQueryToCompany'; ?>
                                                                                        <input type="hidden" id="<?php echo $column; ?>Hidden" name="<?php echo $column; ?>" value="0">
                                                                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="checkbox" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="1">
                                                                                        <label for="<?php echo @$column; ?>"><?php echo $label; ?></label>
                                                                                    </div>
                                                                                </div>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td class="text-center">

                                                                        </td>
                                                                    </tr>
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

                                            <div class="tab-pane fade" id="tab8">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-12">
                                                        <?php $label = 'Inspection Remarks'; ?>
                                                        <?php $column = 'panelRemarks'; ?>
                                                        <div class="card card-outline card-primary">
                                                            <div class="card-header">
                                                                <h3 class="card-title">
                                                                    <?php echo $label; ?>
                                                                </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Additional Report'; ?>
                                                            <?php $column = 'inspectionReportPath'; ?>
                                                            <label><?php echo $label; ?> Link</label>
                                                            <br>
                                                            <a <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?> <?php if(@$recordsEdit[0]->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$recordsEdit[0]->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$recordsEdit[0]->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Rating'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'rating'; ?>
                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <option value="Very Good" <?php if('Very Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Very Good</option>
                                                                <option value="Good" <?php if('Good' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Good</option>
                                                                <option value="Average" <?php if('Average' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Average</option>
                                                                <option value="Not Recommended" <?php if('Not Recommended' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Not Recommended</option>
                                                            </select>
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

                            <?php if($this->roleId == 26){ ?>
                                <div class="col-md-6" style="display: none;">
                                    <div class="form-group">
                                        <?php $label = 'Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'licenseStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="Save">Save as Draft</option>
                                            <option value="Submit">Submit</option>


                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($this->roleId <> 26){ ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'licenseStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <?php
                                            if($this->roleId == '6'){ // Licensing Director
                                                echo '
							  <option value="Save">Save as Draft</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="Rejected and Closed">Rejected and Closed</option>
							  ';
                                                if(@$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3'){
                                                    echo '
							  
							  <option value="approveclb">Approve CLB</option>
							  ';
                                                }

                                            }
                                            if($this->roleId == '10'){ // Licensing Additional Director
                                                echo '
                      <option value="Save">Save as Draft</option>
                      <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '14'){ // Licensing Deputy Director
                                                echo '
                      <option value="Save">Save as Draft</option>
                      <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '18'){ // Licensing Assistant Director
                                                echo '<option value="Save">Save as Draft</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="fwdapproval">Forwarded for Approval</option>';
                                                if(@$recordsEdit[0]->licenseStatus == 'Recommended By Board Stage 3'){
                                                    echo '<option value="Rejected and Closed">Rejected and Closed</option>
							  <option value="Approved">Approved</option>
							  ';
                                                }else{
                                                    echo '<option value="Referred Back To Company">Referred Back To Company</option>
							  ';

                                                }
                                            }
                                            if($this->roleId == '38'){ // Licensing Assigning Officer
                                                echo '
                      <option value="Save">Save as Draft</option>
                      <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '43'){ // Licensing Board Secretary
                                                echo '
                      <option value="Save">Save as Draft</option>
                      <option value="Proceed">Save and Submit</option>
                      <!-- <option value="Rejected and Closed">Rejected and Closed</option> -->
                      ';
                                            }
                                            if($this->roleId == '42'){ // CEO
                                                echo '
                      <!-- <option value="Save">Save as Draft</option> -->
                      <!-- <option value="Rejected and Closed">Rejected and Closed</option> -->
                      <!-- <option value="Approved">Approved</option> -->
                      ';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php if($this->roleId == 26){ ?>
                            <?php if($myAction == 'add'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save">';}?>
                            <?php if($myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save"> <input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="formSubmit" value="Submit">';}?>
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
<div class="modal fade" id="notesheetmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notesheet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="notesheetmodal-action" method="post" action="<?php echo base_url().'notesheet/license/0'; ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Company</label>
                        <input type="text" readonly class="form-control" id="companyname-modal">
                        <input type="hidden" name="refback" readonly class="form-control" id="refback">
                    </div>
                    <div class="form-group">
                        <?php $label = 'Forward To'; ?>
                        <?php $column = 'forwardedTo'; ?>
                        <select class="form-control select2 required" id="forwardedTomodel" name="forwardedTo">
                            <option value="">Select <?php echo @$label; ?></option>
                            <?php
                            if(!empty($historyDesignation))
                            {
                                foreach ($historyDesignation as $detail)
                                {
                                    ?>
                                    <option value="<?php echo $detail->id ?>"><?php echo $detail->userName.' &mdash; '.$detail->designation ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="remarks" class="col-form-label">Remarks</label>
                        <textarea class="form-control" name="remarks" id="remarks"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#notesheetmodal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var company = button.data('company')
        var id = button.data('id')
        var modal = $(this)
        var action = $('#notesheetmodal-action').attr('action');

        var action = action.substring(0, action.lastIndexOf("/")+1) + id;

        //action += id;
        $('#notesheetmodal-action').attr('action', action);
        modal.find('.modal-body #refback').val('<?php echo current_url(); ?>')
        modal.find('.modal-body #companyname-modal').val(company)
    });

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
<script>

    $(document).ready(function ($) {

        $('#newtable thead th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search" />');
        });


        var table = $('#newtable').DataTable({
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'selectAll',
                    className: 'selectall',
                    action : function(e) {
                        e.preventDefault();
                        table.rows({ search: 'applied'}).deselect();
                        table.rows({ search: 'applied'}).select();
                    }
                },
                {
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                },
                'colvis',
                {
                    extend: 'print',
                    text: 'Print all',
                    exportOptions: {
                        //columns: [ 0, 1, 5 ],
                        modifier: {
                            selected: null
                        }
                    }
                },
                {

                    extend: 'print',
                    text: 'Print selected',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                }
            ],
            select: {
                style: 'Single'
            }

        });

        table.columns().every(function() {
            var that = this;

            $('input', this.header()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that
                        .search(this.value)
                        .draw();
                }
            });
        });

        $('#newtable tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

    });
</script>