

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
        <?php if($myAction == 'lookup'){ ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Lookup</h3>
                                <div class="card-tools">
                                    <?php if( @$records[0]->countLicense < 1 && $this->roleId == 26){ //
                                        echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> License Data</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive cardBodyTransaction">
                                <form action="<?php echo base_url().$pageTitle[0]->url.'/lookup/' ?>" method="POST">
                                    <div class="input-group input-group-sm float-right d-none" style="width: 150px;">
                                        &nbsp;<input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control float-right" placeholder="Search">

                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>


                                <table id="<?php echo ($myAction == 'lookup' ? 'newtable' : '') ?>" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>

                                        <th width="5%">S.#</th>
                                        <th width="20%">Company</th>
                                        <th width="5%">License No.</th>
                                        <th width="5%">Phase</th>
                                        <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){?>
                                            <th width="5%">Assigned Officer</th>
                                            <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38|| $this->roleId == 43){?>
                                                <th width="5%">Desk Officer</th>
                                                <?php
                                            }
                                        } ?>
                                        <th width="5%" class="text-center">App. Date</th>
                                        <th width="5%" class="text-center">Stage</th>
                                        <th width="15%" class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sn=1; ?>
                                    <?php
                                    if(!empty($records))
                                    {
                                        $CI =& get_instance();
                                        //$CI->load->model('loginModel');

                                        foreach($records as $record)
                                        {
                                            if(($this->roleId == 14 || $this->roleId == 18) && $record->assignedOfficer != $this->userId){
                                                continue;
                                            }
                                            $seenBy = explode(",",$record->seenBy);
                                            ?>
                                            <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>

                                                <td><?=$sn?>.</td>
                                                <td><?php echo '<b>'.$record->companyName.'</b><br>'.$record->siteAddress; ?></td>
                                                <td><?php echo $record->licenseNoManual; ?></td>
                                                <td><?php echo $record->phase; ?></td>
                                                <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 14 || $this->roleId == 18 || $this->roleId == 38 || $this->roleId == 43){
                                                    if(isset($record->assignedOfficer)){
                                                        $u_info = $CI->loginModel->getuserNameRole($record->assignedOfficer);
                                                        ?>
                                                        <td><?php echo $u_info[0]->userName; ?></td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <td> License Assigning Officer</td>
                                                        <?php
                                                    }
                                                    if ($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38 || $this->roleId == 43) {
                                                        if(isset($record->deskOfficer)) {
                                                            $do_info = $CI->loginModel->getuserNameRole($record->deskOfficer);
                                                            ?>
                                                            <td><?php echo $do_info[0]->userName; ?></td>
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                            <td> </td>
                                                            <?php
                                                        }
                                                    }
                                                } ?>

                                                <td><?php
                                                    echo ($record->submissionDate == '' || $record->submissionDate == NULL)?$record->createddate:(date("Y-m-d", strtotime($record->submissionDate)));
                                                    ?></td>
                                                <td class="text-center">
                                                    <b><h4><span class='badge bg-<?php if($record->licenseStatus == 'Draft'){echo 'warning';} elseif($record->licenseStatus == 'Submitted' || $record->licenseStatus == 'Re Submitted' || $record->licenseStatus == 'Screening' || $record->licenseStatus == 'Under R and I'){echo 'info';} elseif($record->licenseStatus == 'Review Complete' || $record->licenseStatus == 'Received By DRAP' || $record->licenseStatus == 'Under Review' || $record->licenseStatus == 'Under Review Stage 1' || $record->licenseStatus == 'Under Inspection' || $record->licenseStatus == 'Post Inspection Process' || $record->licenseStatus == 'Under Board Stage 2'){echo 'primary';} elseif($record->licenseStatus == 'Referred Back To Company' || $record->licenseStatus == 'Referred Back To Company (Editable)' || $record->licenseStatus == 'Referred Back To Company (Locked)'){echo 'secondary';} elseif($record->licenseStatus == 'Rejected and Closed'){echo 'danger';} elseif($record->licenseStatus == 'Recommended By Board Stage 3' || $record->licenseStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->licenseStatus; ?></span></h4></b>
                                                </td>
                                                <td class="text-center widthMaxContent">
                                                    <div class="btn-group">

                                                        <div class="btn-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" style="">
                                                                <?php if($this->roleId <> '26'){ echo '
                                                                <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Data Authentication License Note Sheet/'.$record->id.'">License Note Sheet</a></li>
                                                                <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/License History/'.$record->id.'">License History</a></li>

                                                                ';} ?>
                                                                <?php
                                                                $licqueries = $this->loginModel->getLicenseQueries($record->id);
                                                                $s_num = 1;
                                                                foreach($licqueries as $licquery){
                                                                    echo '<li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Data Authentication Shortcoming Letter/'.$licquery->id.'">Shortcoming Letter '.$s_num++.'</a></li>';
                                                                }
                                                                ?>
                                                                <?php if($record->licenseStatus == 'Approved'){ echo '
                                                                    <li class="dropdown-item"><a target="_blank" href="'.base_url().'report/view/Data Authentication Approval Letter/'.$record->id.'">Data Authentication Approval Letter</a></li>
                                                                    ';} ?>
                                                            </ul>
                                                        </div>

                                                        <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                                                        <!-- <?php if($record->licenseStatus == 'Draft'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
                        <?php } ?> -->
                                                        <?php
                                                        if(($this->roleId == '38' || $record->assignedOfficer == $this->userId) && $this->roleId <> '18' && $record->licenseStatus <> 'Referred Back To Company' && $record->licenseStatus <> 'Approved'){
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
                                        <th>S.#</th>
                                        <th>Company</th>
                                        <th>License No.</th>
                                        <th>Phase</th>
                                        <th>Assigned Officer</th>
                                        <th>Desk Officer</th>
                                        <th>App. Date</th>
                                        <th>Stage</th>
                                        <th>Action</th>
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
                <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" class="form_valid importformSubmit" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" accept-charset="utf-8">';}?>
                <div class="card card-primary card-outline1">
                    <div class="card-header">
                        <h3 class="card-title"><?php if($myAction == 'add'){echo 'Add';} if($myAction == 'edit'){echo 'Edit';} if($myAction == 'view'){echo 'View';} ?> Details  <?php if($this->roleId <> 26){ echo '( '.@$recordsEdit[0]->companyName.' )'; } ?></h3>




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
                                    <?php $label = 'Completed Phase'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'phase'; ?>
                                    <select <?php if($myAction == 'view' || $this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && @$recordsEdit[0]->licenseStatus != 'Referred Back To Company' && $myAction != 'add')){echo 'disabled';}?> class="form-control" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" onchange="updateDropdowns()">
                                        <option disabled selected>Select <?php echo @$label; ?></option>
                                        <option  value="Site Verification" <?php if('Site Verification' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Site Verification</option>
                                        <option value="Layout Plan" <?php if('Layout Plan' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Layout Plan</option>
                                        <option value="Grant of License" <?php if('Grant of License' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Existing DML Holder</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft')?'':'active' ?>" data-toggle="pill" href="#tab1" id="t1" style="display: none;">Site Verification - Step 1</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab2" id="t2" style="display: none;">Layout Plan  - Step 2</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab3" id="t3" style="display: none;">License Data - Step 3</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php echo ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft')?'active':'' ?>" data-toggle="pill" href="#tab5" >Queries</a>
                                            </li>
                                            <?php if($this->roleId <> 26){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab4">Notesheet</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="tab-pane fade  <?php echo ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft')?'':'show active' ?>" id="tab1">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Establishment License'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licenseTypeId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26 /*|| ( $this->roleId == 26  && @$recordsEdit[0]->licenseStatus != 'Draft'  && $myAction != 'add' )*/){echo 'disabled';}?> class="form-control select2 allphaserequired" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                                                            <?php $label = 'File No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licFileNo'; ?>
                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'Site Address'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'siteAddress'; ?>
                                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26 /*|| ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft'  && $myAction != 'add') */){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control allphaserequired" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Site City'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'siteCity'; ?>
                                                            <!-- <input <?php if($myAction == 'view' || $this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft'  && $myAction != 'add')){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required"> -->
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26 /*|| ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft'  && $myAction != 'add')*/){echo 'disabled';}?> class="form-control select2 allphaserequired" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft'  && $myAction != 'add')){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Latitude'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'latitude'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26 ){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control allphaserequired">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Longitude'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'longitude'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26 ){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control allphaserequired">
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
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'fatherName'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'address'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'nic'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'department'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'designation'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'email'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control allphaserequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>

                                                                                <?php if($myAction <> 'view' && $this->roleId == 26 ){ ?>
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svCoveringLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svFeeChallan'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26  || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Legal Status of Management / Firm'; ?>
                                                            <?php if(@$recordsEdit[0]->companyType == 'Private Limited' || @$recordsEdit[0]->companyType == 'Public Limited'){ $label = 'SECP Documents';} if(@$recordsEdit[0]->companyType == 'Sole Proprietor'){ $label = 'Affidavit Document';} ?>
                                                            <label><?php echo $label; ?> (<?php echo @$recordsEdit[0]->companyType; ?>) <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svStatusOfFirm'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Copy Of CNIC'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svCopyOfCNIC'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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
                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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
                                                    <?php } ?>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Complete Set of Land Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svLandDocument'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Site Map'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'svSiteMap'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Site Verification Approval Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'siteVerificationLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 siterequired">
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

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="tab2">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="form-group">
                                                            <?php $label = 'Courier Company'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma4'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="form-group">
                                                            <?php $label = 'Tracking No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma2'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="form-group">
                                                            <?php $label = 'Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pvma3'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control ">
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
                                                                    <?php $myTable = 'tabledetailsection'; ?>
                                                                    <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>S.#</th>
                                                                            <th>Section</th>
                                                                            <th>Pharmacological Group</th>
                                                                            <th>Used For</th>
                                                                            <th>Approved</th>
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
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 <?php echo ((@$recordsEdit[0]->licenseTypeId !== null) && @$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2)?'layoutdmlrequired':''; ?> " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 <?php echo (@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2)?'layoutdmlrequired':''; ?>" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 <?php echo (@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2)?'layoutdmlrequired':''; ?>" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                        <input type="hidden" name="<?php echo $myTable; ?>-recommended_detail[]" value="Yes">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'approved'; ?>
                                                                                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control <?php echo (@$recordsEdit[0]->licenseTypeId != 1 && @$recordsEdit[0]->licenseTypeId != 2)?'layoutdmlrequired':''; ?>" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                    <?php

                                                                                                    if($this->roleId == 26){ ?>
                                                                                                        <option value="Yes" selected>Yes</option>
                                                                                                        <?php
                                                                                                    }else{
                                                                                                        ?>
                                                                                                        <option value="" <?php if('' == @$record->$column){ echo 'selected'; } ?>>Select ---</option>
                                                                                                        <option value="No" <?php if('No' == @$record->$column){ echo 'selected'; } ?>>No</option>
                                                                                                        <option value="Yes" <?php if('Yes' == @$record->$column){ echo 'selected'; } ?>>Yes</option>
                                                                                                        <?php
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
                                                    <?php } ?>
                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'lpApplicationCoveringLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'lpChallanForm'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Layout Plan Approval Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'layoutPlanLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 layoutdmlrequired">
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

                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="tab3">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'License No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'licenseNoManual'; ?>
                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control dmlrequired">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Issue Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'issueDateManual'; ?>
                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control dmlrequired">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'License Validity'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'validTill'; ?>
                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control dmlrequired">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Last Renewal Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'lastRenewalDate'; ?>
                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="form-group">
                                                            <?php $label = 'Meeting No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'meetingNo'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId == 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" style="display: none;">
                                                        <div class="form-group">
                                                            <?php $label = 'Meeting Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'meetingDate'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId == 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>

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
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'fatherName'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'address'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'nic'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired" data-inputmask='"mask": "99999-9999999-9"' data-mask1>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'phone'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'Designation'; ?>
                                                                                            <?php $column = 'designationId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 dmlrequired" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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
                                                                                            <?php $column = 'drugName'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control dmlrequired">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'machineMake'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'machineModel'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'machinePartNo'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
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

                                                    <?php if((@$recordsEdit[0]->licenseTypeId == 1 || @$recordsEdit[0]->licenseTypeId == 2)){ ?>

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
                                                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>


                                                                                    <td>
                                                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                            <div class="form-group">
                                                                                                <?php $column = 'filePath3'; ?>
                                                                                                <div class="custom-file">
                                                                                                    <input type="hidden" id="<?php echo $myTable; ?>-<?php echo @$column; ?>Hidden_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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
                                                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="custom-file-input1 ">
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

                                                    <?php } ?>
                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Form-1 / Form-1A'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlForm1'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Covering Letter'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlProForma'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Legal Status and management (SECP / Registration of firm documents/ Affidavit)'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlLegalStatus'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Fee Challan'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'dmlFeeChallan'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Production Incharge Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'qsDocuments'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'QC Incharge Documents'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'qsDocuments2'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                    <div class="col-md-6" <?php if($this->roleId <> 26 || ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft' && $myAction != 'add')){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'License'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'licenseLetter'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> isuploaded="<?php echo @$recordsEdit[0]->$column!= null?1:0; ?>" type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1 dmlrequired">
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

                                                </div>

                                            </div>
                                            <?php if($this->roleId <> 26){ ?>
                                                <div class="tab-pane fade" id="tab4">

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
                                                                            <th class="text-center" width="25%">Designation</th>
                                                                            <th class="text-center" width="25%">Forwarded To</th>
                                                                            <th class="text-center" width="40%">Remarks</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <?php
                                                                        $sn = 1;
                                                                        $snum = 1;
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
                                                                                        <span><?=$snum?></span>.
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

                                                                                </tr>
                                                                                <?php $sId++; ?>
                                                                                <?php $sn = $sn<9?$sn++:$sn; ?>
                                                                                <?php
                                                                                $snum++; }
                                                                        }
                                                                        ?>
                                                                        <tr>
                                                                            <td class="srNo">
                                                                                <span></span>.
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
                                                        <?php if($this->roleId == '18'){?>
                                                            <div class="col-md-12">
                                                                <?php $label = 'Shortcoming'; ?>
                                                                <?php $column = 'datashortcoming'; ?>
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
                                            <?php } ?>
                                            <div class="tab-pane fade <?php echo ( $this->roleId == 26 && @$recordsEdit[0]->licenseStatus != 'Draft')?'show active':'' ?>" id="tab5">

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
                                                                <?php $myTable = 'tbl_query2'; ?>
                                                                <input type="hidden"  name="fromQ" value="<?php if($this->roleId == 26){ echo 'Applicant'; }else{ echo 'DRAP'; } ?>">

                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Date & Time</th>
                                                                        <th>Shortcoming</th>
                                                                        <th>Comment</th>
                                                                        <th>Attachment</th>
                                                                        <th class="text-center">Action</th>
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
                                                                            if($record->status == 'Info Required From Company' && $this->roleId == 26){
                                                                                // display Draft Comments and new editable comments
                                                                                if(!empty($record->querycomments))
                                                                                {
                                                                                    foreach($record->querycomments as $querycomment){
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td class="srNo">
                                                                                                <span><?=$sn?></span>.
                                                                                                <?php $column = 'id'; ?>
                                                                                                <input class="d-none isDeletedId deleteRow" type="text" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0">
                                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>">
                                                                                                <input class="d-none lastqId" type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>Hidden" name="<?php echo $myTable; ?>-<?php echo 'q'.$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">


                                                                                            </td>
                                                                                            <td><?php echo $record->dateTime; ?></td>
                                                                                            <td><?php echo $record->message; ?>
                                                                                            </td>

                                                                                            <td>
                                                                                                <?php $column = 'queryattachid'; ?>
                                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>Hidden" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$querycomment->id; ?>">

                                                                                                <?php $column = 'comment'; ?>

                                                                                                <textarea  <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" class="form-control required" rows="3"><?php echo $querycomment->comment; ?></textarea>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                                        <div class="form-group">
                                                                                                            <?php $label = 'Attachment'; ?>
                                                                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                                                            <?php $column = 'filePath'; ?>
                                                                                                            <div class="custom-file">
                                                                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>Hidden" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                                                                                                                <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                    <?php
                                                                                                    $column = 'attachmentPath';
                                                                                                    ?>
                                                                                                    <div class="col-12 my-2">
                                                                                                        <a title="<?php echo $querycomment->comment; ?>" <?php if(!@$querycomment->$column){ echo 'disabled';} ?> <?php if(@$querycomment->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$querycomment->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$querycomment->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <?php if($myAction <> 'view' && $this->roleId == 26 && $record->status == 'Info Required From Company'){ ?>
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

                                                                                else{ ?>
                                                                                    <tr>
                                                                                        <td class="srNo">
                                                                                            <span><?=$sn?></span>.
                                                                                            <?php $column = 'id'; ?>
                                                                                            <input class="d-none isDeletedId deleteRow" type="text" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0">

                                                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">

                                                                                            <input type="text" class="d-none lastqId" id="<?php echo $myTable; ?>-<?php echo 'q'.$column; ?>_<?=$sn?>"  name="<?php echo $myTable; ?>-<?php echo 'q'.$column; ?>_detail[]" value="<?php echo @$record->$column; ?>">

                                                                                        </td>
                                                                                        <td><?php echo $record->dateTime; ?></td>
                                                                                        <td><?php echo $record->message; ?></td>

                                                                                        <td>

                                                                                            <?php $column = 'comment'; ?>

                                                                                            <textarea  <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" class="form-control required" rows="3"></textarea>

                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="row">
                                                                                                <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                                                                    <div class="form-group">
                                                                                                        <?php $label = 'Attachment'; ?>
                                                                                                        <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                                                        <?php $column = 'filePath'; ?>
                                                                                                        <div class="custom-file">
                                                                                                            <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>Hidden" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
                                                                                                            <!--<label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>-->
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>


                                                                                            </div>
                                                                                        </td>
                                                                                        <?php if($myAction <> 'view' && $this->roleId == 26 && $record->status == 'Info Required From Company'){ ?>
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

                                                                            else{
                                                                                if(!empty($record->querycomments) && $record->status <> 'Info Required From Company')
                                                                                {
                                                                                    foreach($record->querycomments as $querycomment){
                                                                                        ?>
                                                                                        <tr>
                                                                                            <td class="srNo">
                                                                                                <span><?=$sn?></span>.

                                                                                            </td>
                                                                                            <td><?php echo $record->dateTime; ?></td>
                                                                                            <td><?php echo $record->message; ?>
                                                                                            </td>

                                                                                            <td>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12 my-2">
                                                                                                        <?php echo $querycomment->comment; ?>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td>
                                                                                                <div class="row">
                                                                                                    <?php
                                                                                                    $column = 'attachmentPath';
                                                                                                    ?>
                                                                                                    <div class="col-12 my-2">
                                                                                                        <a title="<?php echo $querycomment->comment; ?>" <?php if(!@$querycomment->$column){ echo 'disabled';} ?> <?php if(@$querycomment->$column){ echo 'href="'.base_url().'uploads/company/'.@$recordsEdit[0]->companyUniqueNo.'/docs/'.@$querycomment->$column.'"';} ?> target="_blank" class="btn btn-success <?php if(!@$querycomment->$column){ echo 'disabled';} ?>"><i class="fa fa-file"></i></a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </td>
                                                                                            <td></td>
                                                                                        </tr>
                                                                                        <?php $sId++ ?>
                                                                                        <?php $sn++ ?>
                                                                                        <?php
                                                                                    }
                                                                                }

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

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if($this->roleId == 26){ ?>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <p>To Submit the application to DRAP, select "Submit" from the status list and then press the submit button.</p>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php $label = 'Status'; ?>
                                    <label><?php echo $label; ?></label>
                                    <?php $column = 'licenseStatus'; ?>
                                    <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" onchange="updateLicenseStatus()" >
                                        <?php if($this->roleId == 26){ ?>
                                            <option value="Draft">Save as Draft</option>
                                            <?php
                                            if( $myAction == 'edit') {
                                                ?>
                                                <option value = "Submitted" > Save and Submit </option >
                                                <?php
                                            }
                                        } ?>
                                        <?php if($this->roleId <> 26){

                                            if($this->roleId == '38'){ // Licensing Assigning Officer
                                                echo '
						<option value="Save">Save</option>						
                      <option value="Proceed">Save and Submit</option>
                      ';
                                            }
                                            if($this->roleId == '18'){ // Licensing Assistant Director
                                                if(@$recordsEdit[0]->licenseStatus == 'Review Complete'){
                                                    echo '<option value="Save">Save</option>	
									<option value="fwdapproval">Forwarded for Approval</option>
									<option value="Approved">Approve</option>';
                                                }else{
                                                    echo '
						<option value="fwdapproval">Forwarded for Approval</option>
                        <option value="Approved">Approve</option>
						<option value="Referred Back To Company">Send Back to Applicant</option>
                      ';
                                                }

                                            }
                                            if($this->roleId == '6' || $this->roleId == '10' || $this->roleId == '14' || $this->roleId == '43'){ // Licensing Assistant Director
                                                echo '
						<option value="Save">Save</option>
						<option value="Proceed">Save and Submit</option>
                      ';

                                            }
                                            ?>


                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input id="form_valid_submit" type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-primary" value="Submit">';}?>
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
            <form id="notesheetmodal-action" method="post" action="<?php echo base_url().'notesheet/importlicense/0'; ?>">
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
<style>
    .error {
        color: #F00;
    }

</style>
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
    })

    loadMyTable('table', true, 15);

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


        rows({selected: true}).data()

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

        //console.log($('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name"));
        //console.log($('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children());


        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_section', columnName:'section'},
            success:function(data)
            {
                $("td:eq(1)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_pharmagroup', columnName:'pharmaGroup'},
            success:function(data)
            {
                $("td:eq(2)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(2).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_usedfor', columnName:'usedFor'},
            success:function(data)
            {
                $("td:eq(3)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

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
                $("td:eq(6)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(6).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_companyqualification', columnName:'qualification'},
            success:function(data)
            {
                $("td:eq(7)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(7).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_companyspecialization', columnName:'specialization'},
            success:function(data)
            {
                $("td:eq(8)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(8).children().children().children().attr("name") +'">'+data+'</select></div></div>');
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
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_section', columnName:'section'},
            success:function(data)
            {
                $("td:eq(1)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_pharmagroup', columnName:'pharmaGroup'},
            success:function(data)
            {
                $("td:eq(2)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(2).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_usedfor', columnName:'usedFor'},
            success:function(data)
            {
                $("td:eq(3)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            }
        });

        $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        //$('#'+myCurrentTable+' select').select2();
        //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
    });

    loadMyTable('tbl_query2', false, -1);
    $('#tbl_query2').on( 'click', '.plus', function () {
        var myCurrentTable = 'tbl_query2';
        var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
        $("td :input", row).val("");
        $("td.qtyC", row).text("");
        $("td.rateC", row).text("");
        $("td b.totalValue", row).text("");

        var last_id = parseInt($("td.srNo span", row).text());
        var new_id =  last_id + parseInt("1");
        $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
        $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden.rowId").val()) + parseInt("1"));


        var newisdelid = $(".isDeletedId:last").attr('id').slice(0, -1) + new_id;
        $(".isDeletedId:last",row).attr('id',newisdelid);
        $(".isDeletedId:last",row).val(0);

        var newlastqId = $(".lastqId:last").attr('id').slice(0, -1) + new_id;
        $(".lastqId:last",row).attr('id',newlastqId);
        $(".lastqId:last",row).val($(".lastqId:last").val());



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

    function removeasterisk(){

    }
    function appendasterisk(){
        //$(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ')
    }

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



    function updateDropdowns(){
        var id = $('#phase').val();
        $(".asterisk").remove();
        if(id == 'Site Verification'){
            $('.allphaserequired, .siterequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                siterequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');

                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
                layoutdmlrequired:{
                    required: false
                },
                layoutrequired:{
                    required: false
                },
                dmlrequired:{
                    required: false
                },
            });
            $("#t1").css("display", "block");
            $("#t2").css("display", "none");
            $("#t3").css("display", "none");
        }
        if(id == 'Layout Plan'){
            $('.allphaserequired, .siterequired, .layoutrequired, .layoutdmlrequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                layoutdmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                layoutrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                siterequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
                dmlrequired:{
                    required: false
                },
            });
            $("#t1").css("display", "block");
            $("#t2").css("display", "block");
            $("#t3").css("display", "none");
        }
        if(id == 'Grant of License'){
            $('.allphaserequired, .layoutdmlrequired, .dmlrequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                layoutrequired:{
                    required: false
                },
                siterequired:{
                    required: false
                },
                dmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                layoutdmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
            });
            $("#t1").css("display", "block");
            $("#t2").css("display", "block");
            $("#t3").css("display", "block");
        }

    }


    /*function updateLicenseStatus(){
        var license_Status = $('#licenseStatus').val();

            $(".importformSubmit").addClass("");

    }*/
    $( document ).ready(function() {

        //updateLicenseStatus();

        $("input[type='file']").on("change", function () {
            if(this.files[0].size > 5000000) {
                alert("Please upload file less than 5MB. Thanks!!");
                $(this).val('');
            }
        });

        var id = $('#phase').val();
        $(".asterisk").remove();
        if(id == ''){
            $("#t1").css("display", "none");
            $("#t2").css("display", "none");
            $("#t3").css("display", "none");
        }
        if(id == 'Site Verification'){
            $('.allphaserequired, .siterequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                siterequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');

                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
                layoutdmlrequired:{
                    required: false
                },
                layoutrequired:{
                    required: false
                },
                dmlrequired:{
                    required: false
                },
            });

            $("#t1").css("display", "block");
            $("#t2").css("display", "none");
            $("#t3").css("display", "none");
        }
        if(id == 'Layout Plan'){
            $('.allphaserequired, .siterequired, .layoutrequired, .layoutdmlrequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                layoutdmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                layoutrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                siterequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
                dmlrequired:{
                    required: false
                },
            });

            $("#t1").css("display", "block");
            $("#t2").css("display", "block");
            $("#t3").css("display", "none");
        }
        if(id == 'Grant of License'){
            $('.allphaserequired, .layoutdmlrequired, .dmlrequired').each(function(i, obj) {
                $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
            });
            $.validator.addClassRules({
                layoutrequired:{
                    required: false
                },
                siterequired:{
                    required: false
                },
                dmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                layoutdmlrequired:{
                    required: function(element) {
                        var attr = $(element).attr('isuploaded');
                        if (typeof attr !== 'undefined' && attr !== false && attr == 1) {
                            return false;
                        }
                        else{
                            return true;
                        }
                    }
                },
                allphaserequired:{
                    required: true
                },
            });

            $("#t1").css("display", "block");
            $("#t2").css("display", "block");
            $("#t3").css("display", "block");
        }
    });

    $(function () {
        $('#datashortcoming').summernote();
    });


    <?php if($myAction == 'view'){ ?>
    $('#datashortcoming').summernote('disable');
    <?php } ?>


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

