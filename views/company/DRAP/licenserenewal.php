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
        <?php if($myAction == 'lookup'){


            ?>
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
                                            <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38){?>
                                                <th style="width: 3%;">Desk Officer</th>
                                            <?php } } ?>
                                        <th style="width:3%">App. Sub.</th>
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
                                                <td class="d-none text-center"><?php if($record->renewalStatus == 'Submitted'){if($record->queuePosition <> 0){echo $record->queuePosition;}else{echo 'Now Serving';}}else{echo '';} ?></td>
                                                <?php if($this->roleId == 26){?>
                                                    <td class="d-none text-center"><?php //echo $record->lastRenewalDate; ?></td>
                                                <?php } ?>
                                                <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                                    <td><?php echo $record->assignedOfficer; ?></td>
                                                    <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38){?>
                                                        <td ><?php echo $record->deskOfficer; ?></td>
                                                    <?php } } ?>
                                                <td><?php
                                                    echo ($record->submissionDate == '' || $record->submissionDate == NULL)?$record->createddate:$record->submissionDate;
                                                    ?></td>
                                                <td class="text-center">
                                                    <span style="font-size: 14px; font-weight: bold;width: 100%;white-space: break-spaces;"  class='badge bg-<?php if($record->renewalStatus == 'Draft'){echo 'warning';} elseif($record->renewalStatus == 'Submitted' || $record->renewalStatus == 'Screening' || $record->renewalStatus == 'Under R and I'){echo 'info';} elseif($record->renewalStatus == 'Received By DRAP' || $record->renewalStatus == 'Under Review Stage 1' || $record->renewalStatus == 'Under Inspection' || $record->renewalStatus == 'Post Inspection Process' || $record->renewalStatus == 'Under Board Stage 2'){echo 'primary';} elseif($record->renewalStatus == 'Referred Back To Company (Editable)' || $record->renewalStatus == 'Referred Back To Company (Locked)'){echo 'secondary';} elseif($record->renewalStatus == 'Rejected and Closed'){echo 'danger';} elseif($record->renewalStatus == 'Recommended By Board Stage 3' || $record->renewalStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->renewalStatus; ?></span>
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

                            ';} ?>

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

                                                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                        <?php if($record->renewalStatus <> 'Approved'){ ?>
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                                        <?php } ?>
                                                        <?php if($record->renewalStatus == 'Draft'){ ?>
                                                            <!-- <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                        -->
                                                        <?php } ?>
                                                        <?php
                                                        if(($this->roleId == '38' || $record->assignedOfficerId == $this->userId) && $this->roleId <>  '18' && $record->renewalStatus <> 'Referred Back To Company (Locked)' && $record->renewalStatus <> 'Approved'&& $record->renewalStatus <> 'Under Inspection'){
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
                                    <tfoot>
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
                                            <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38){?>
                                                <th style="width: 3%;">Desk Officer</th>
                                            <?php } } ?>
                                        <th style="width:3%">App. Sub.</th>
                                        <th style="width:3%" class="text-center">Stage</th>
                                        <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                            <th style="width:5%">In Board</th>
                                        <?php } ?>
                                        <!-- <th class="text-center">Status</th> -->
                                        <th style="width:3%" class="text-center">Action</th>
                                    </tr>
                                    </tfoot>
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
                <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" class="form_valid" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';}?>
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
                        <?php
                        if(@$recordsEdit[0]->renewalStatus == 'Draft'){
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
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-minus"></i>
                    <i class="fa fa-circle"></i>
                    <i class="fa fa-minus"></i>
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
                    <span style="margin-left: -5px; margin-right: 63px;">Draft</span>
                    <span style="margin-right: 63px;">Screening</span>
                    <span style="margin-right: 63px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-md-4">
                  </div>
                </div>
                ';
                        }
                        if(@$recordsEdit[0]->renewalStatus == 'Submitted' || @$recordsEdit[0]->renewalStatus == 'Screening' || @$recordsEdit[0]->renewalStatus == 'Under R and I' || @$recordsEdit[0]->renewalStatus == 'Received By DRAP' || @$recordsEdit[0]->renewalStatus == 'Referred Back To Company (Editable)'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
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
                        if(@$recordsEdit[0]->renewalStatus == 'Under Review Stage 1' || @$recordsEdit[0]->renewalStatus == 'Under Inspection' || @$recordsEdit[0]->renewalStatus == 'Referred Back To Company (Locked)'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i>
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
                        if(@$recordsEdit[0]->renewalStatus == 'Under Board Stage 2' || @$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->renewalStatus == 'Approved'){
                            echo '
                  <div class="row">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-4">
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
                    <i class="fa fa-circle" style="color: #4caf50; border-radius: 50%; box-shadow: 0px 0px 20px 0px #4caf50;"></i>
                    <i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i><i class="fa fa-minus"></i>
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
                            <?php if(@$recordsEdit[0]->challan_no || $this->roleId <> 26){ ?>
                                <div class="col-md-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <span> Challan Staus  : <strong><?php echo @$recordsEdit[0]->challan_status; ?></strong></span>
                                        </div>
                                        <div class="card-body">
                                            <span><strong> Challan No :  </strong><?php echo @$recordsEdit[0]->challan_no; ?></span><br>
                                            <span><strong> Challan Fee :  </strong><?php echo @$recordsEdit[0]->challan_fee; ?></span><br>
                                            <span><strong> Challan Date :  </strong><?php echo @$recordsEdit[0]->challan_date; ?></span><br>
                                            <span><strong> Challan Info :  </strong><?php echo @$recordsEdit[0]->challan_msg; ?></span><br>
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

                                        <!--  <iframe src="<?php echo @$recordsEdit[0]->googleMapURL ?>" width="100%" height="280" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                -->
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <br>
                                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab1">License Renewal</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab2">Queries</a>
                                            </li>
                                            <?php if($this->roleId <> 26){ ?>
                                                <?php if(@$recordsEdit[0]->renewalStatus <> 'Submitted' && @$recordsEdit[0]->renewalStatus <> 'Screening' && @$recordsEdit[0]->renewalStatus <> 'Under R and I' && @$recordsEdit[0]->renewalStatus <> 'Received By DRAP'){ ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab5">Letter Statement</a>
                                                    </li>
                                                <?php } ?>
                                                <?php if(@$recordsEdit[0]->phase == 'Grant of License' && @$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3'){ ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab6">CLB</a>
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
                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="">
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
                                                        <div class="form-group">
                                                            <?php $label = 'Renewal Due Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'validTill'; ?>
                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php if(@$recordsEdit[0]->$column <> ''){echo date('d-F-Y', strtotime(date('Y-m-d', strtotime(@$recordsEdit[0]->$column))));} ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'rCoveringLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 renewalrequired <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'rFeeChallan'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 renewalrequired <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Nothing Due Certificate for CRF'; ?>
                                                            <label><?php echo $label; ?> (<?php echo @$recordsEdit[0]->companyType; ?>) <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'rcrf'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" class="custom-file-input1 renewalrequired <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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
                                                            <?php $label = 'Form 1-A and Attested enclosure'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'rformA1'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 renewalrequired <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
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

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Qualified Staff (Readonly)</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailqualifiedstaffs'; ?>
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
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                    $sn = 1;
                                                                    $sId = 0;
                                                                    $total = 0;
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
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'Designation'; ?>
                                                                                            <?php $column = 'designationId'; ?>
                                                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                                                                            <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="">
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
                                                                <h3 class="card-title">Layout Plan (Readonly)</h3>
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
                                                                                            <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'approvedFilePath'; ?>
                                                                                            <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
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
                                                    <?php if(@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2){ ?>

                                                        <div class="col-md-12">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Section's Detail (Readonly)</h3>
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
                                                                                                <?php $label = 'Section '.@$record->sectionId; ?>
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
                                                                            <th>Drug Name</th>
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
                                                    <?php if(@$recordsEdit[0]->licenseTypeId == 1 || @$recordsEdit[0]->licenseTypeId == 2){ ?>
                                                        <div class="col-md-12">
                                                            <div class="card card-primary card-outline">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">API  (Readonly)</h3>
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
                                                                                                <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>

                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group">
                                                                                                <a <?php if(!@$record->$column){ echo 'disabled';} ?> <?php if(@$record->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$record->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$record->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
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
                                                                                                <input disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control">
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

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Is your Production Incharge changed?'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'rformA4'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Is your QC Incharge changed?'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'rformA2'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Is there any change in Management?'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'rformA3'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <br>
                                                            <label><i class="fa fa-asterisk text-danger"></i> Note: If there is any change in your Technical Staff and/or in Company Management, then please file <u>Variance</u> before the Renewal.</label>
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

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'License No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licenseNoManual'; ?>
                                                            <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php if(@$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Issue Date'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'issueDateManual'; ?>
                                                                <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Shortcoming Letter Type.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'letterType'; ?>
                                                            <input  <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo 'BY UMS'; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <?php $label = 'Renewal Remarks (Shortcoming)'; ?>
                                                        <?php $column = 'renewalRemarks'; ?>
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
                                                        <?php $label = 'Panel of Inspectors (License Renewal)'; ?>
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

                                                </div>

                                            </div>
                                            <?php if(@$recordsEdit[0]->phase == 'Grant of License' && @$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3'){ ?>

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
                                                                            <th style="display:none;" class="text-center">Status</th>

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
                                                                                if($record->type == 'License Renewal'){
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
                                                                                                    <?php $column = 'meetingNo'; ?>
                                                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <?php $column = 'meetingDate'; ?>
                                                                                                    <input disabled type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"  value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <?php $column = 'remarks'; ?>
                                                                                                    <textarea disabled id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>"  class="form-control " rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td style="display:none;">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <?php $column = 'status'; ?>
                                                                                                    <select disabled class="form-control" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                        <option value="Approved" <?php if('Approved' == @$record->$column){ echo 'selected'; } ?>>Approved</option>
                                                                                                        <option value="Deferred" <?php if('Deferred' == @$record->$column){ echo 'selected'; } ?>>Deferred</option>
                                                                                                        <option value="Inspection Required" <?php if('Inspection Required' == @$record->$column){ echo 'selected'; } ?>>Inspection Required</option>
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
                                            <?php } ?>
                                            <?php if($this->roleId <> '26'){ ?>
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
                                            <?php } ?>
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
                                        <?php $column = 'renewalStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="Save">Save</option>
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
                                        <?php $column = 'renewalStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <?php
                                            if($this->roleId == '6'){ // Licensing Director
                                                /*echo '
                                                <option value="Save">Save</option>
                                                <!-- <option value="Proceed">Save and Submit</option> -->
                                                <option value="Rejected and Closed">Rejected and Closed</option>
                                                <option value="Approved">Approved</option>
                                                ';*/
                                                echo '
							  <option value="Save">Save</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="Rejected and Closed">Rejected and Closed</option>
							  ';
                                                if(@$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3'){
                                                    echo '
							  
							  <option value="approveclb">Approve CLB</option>
							  ';
                                                }
                                            }
                                            if($this->roleId == '10'){ // Licensing Additional Director
                                                echo '
                      <option value="Save">Save</option>
					  <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '14'){ // Licensing Deputy Director
                                                echo '
                      <option value="Save">Save</option>
					  <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '18'){ // Licensing Assistant Director
                                                /*echo '
                                                <option value="Save">Save</option>
                                                <option value="Referred Back To Company">Referred Back To Company</option>
                                                <option value="Proceed">Save and Submit</option>
                                                <option value="fwdapproval">Forwarded for Approval</option>
                                                ';*/
                                                echo '<option value="Save">Save</option>
							  <option value="Proceed">Save and Submit</option>
							  <option value="fwdapproval">Forwarded for Approval</option>';
                                                if(@$recordsEdit[0]->renewalStatus == 'Recommended By Board Stage 3'){
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
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '43'){ // Licensing Board Secretary
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Save and Submit</option>
                      <option value="Rejected and Closed">Rejected and Closed</option>
                      ';
                                            }
                                            if($this->roleId == '42'){ // CEO
                                                echo '
                      <!-- <option value="Save">Save</option> -->
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
    /*
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
      */
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
    <?php if($this->roleId == 26){ ?>
    var validator = $(".form_valid").validate({
        ignore: ":hidden",
        ignore: "",
        showErrors: function(errorMap, errorList) {
            //This method handles all elements that do not meet the validation
            var i = 0;
            for (var key in errorMap) {
                //Alert ("attribute: + key +", value: + errormap \ [key \]);
                if (i == 0) {
                    //Content fields for all tab pages
                    var conents = $("div.tab\_tontent > div");
                    //All tab headers
                    var tabs = $("div.tab\_menu ul li");
                    var index = conents.index(conents.has("\[name='" + key + "'\]"));
                    tabs.eq(index).click();
                }
                i++;
            }
            this.defaultShowErrors();

        },
        invalidHandler: function(form, validator) {
            var errors = validator.numberOfInvalids();
            console.log(validator.errorList);
            if (errors) {
                <?php if($this->roleId == 26){ ?>
                alert("Please enter required fields");
                <?php } ?>
                validator.errorList[0].element.focus();
            }
        }

    });
    <?php } ?>


    $("#formSave").click(function() {
        $('#renewalStatus').val('Save');
    });
    $("#formSubmit").click(function() {
        $('#renewalStatus').val('Submit');
    });

    $(function () {

        $("input[type='file']").on("change", function () {
            if(this.files[0].size > 5000000) {
                alert("Please upload file less than 5MB. Thanks!!");
                $(this).val('');
            }
        });

        $.validator.addClassRules({
            renewalrequired:{
                required: function(element) {
                    var attr = $(element).attr('isuploaded');

                    if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                        return false;
                    }
                    else{
                        return true;
                    }
                }
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
    $(document).ready(function () {
        //Only needed for the filename of export files.
        //Normally set in the title tag of your page.
        document.title = "PIRIMS - License Renewal";
        // Create search inputs in footer
        $("#newtable tfoot th").each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="Search" />');
        });
        // DataTable initialisation
        var table = $("#newtable").DataTable({
            dom: '<"dt-buttons"Bf><"clear">lirtp',
            paging: true,
            autoWidth: true,
            buttons: [
                "colvis",
                "copyHtml5",
                "csvHtml5",
                "excelHtml5",
                "pdfHtml5",
                "print",
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

                    extend: 'print',
                    text: 'Print selected',
                    exportOptions: {
                        columns: [ 0, ':visible' ]
                    }
                }
            ],
            select: {
                style: 'Single'
            },


            initComplete: function (settings, json) {
                var footer = $("#newtable tfoot tr");
                $("#newtable thead").append(footer);
            }
        });
        $('#newtable tbody').on('click', 'tr', function () {
            $(this).toggleClass('selected');
        });

        // Apply the search
        $("#newtable thead").on("keyup", "input", function () {
            table.column($(this).parent().index())
                .search(this.value)
                .draw();
        });


    });

</script>