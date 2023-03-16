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
//                                    echo '<a target="_blank" href="'.base_url().'downloadRegisteredProducts'.'" class="btn btn-info mr-5"><i class="fa fa-plus"></i> Download Registered Products</a>';
                                    echo '<a target="_blank" href="'.base_url().'downloadCompanyRegisteredProducts'.'" class="btn btn-info mr-5"><i class="fa fa-plus"></i> Download Excel File</a>';

                                    ?>
                                    <?php if($this->roleId == 26){?>
                                        <!--
                  <a class="btn btn-primary" href="<?php echo base_url().$pageTitle[0]->url.'/add' ?>"><i class="fa fa-plus"></i> <?php echo $pageTitle[0]->friendlyName; ?></a>
                -->
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
                                <table id="table" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.#</th>

                                        <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                                            <th>Company</th>
                                            <th>NTN</th>
                                        <?php } ?>
                                        <?php if($this->companySubCategory <> 'Importer'){?>
                                        <?php } ?>

                                        <?php if($this->companySubCategory == 'Importer'){?>
                                            <th>DSL</th>
                                        <?php } ?>
                                        <th>Registration No.</th>
                                        <th>Brand Name</th>
                                        <th class="text-center">Action</th>
                                         <?php if($this->roleId == 26){?>
                                          <?php } ?>
                                        <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                                            <th>Assigned Officer</th>
                                            <th>Days Left (Evaluation)</th>
                                        <?php } ?>
                                        <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45){?>
                                            <th>Added In Agenda</th>
                                        <?php } ?>
                                        <!-- <th class="text-center">Status</th> -->
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
                                            <tr <?php if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                                                <td><?=$sn?>.</td>
                                               <td><?php echo $record->registrationNo; ?></td>
                                                <td><?php echo $record->approvedName; ?></td>
                                                <td class="text-center widthMaxContent">
                                                    <div class="btn-group">
                                                        <div class="btn-group-prepend">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu" style="">
                                                                <?php if($this->roleId == '26'){
                                                                    /*echo '
                                                                <li><a href="'.base_url().'report/view/Registration Application Submission Receipt/'.$record->id.'">Application Submission Receipt</a></li>
                                                                ';*/


                                                                } ?>
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
                                                        <?php if($this->roleId ==26){?>

                                                            <a href="<?php echo base_url().'importregistration/edit/'.$record->id; ?>" class="btn btn-danger"><i class="fa fa-pencil-alt"></i></a>
                                                        <?php } ?>

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
                        <?php
                        if(@$recordsEdit[0]->registrationStatus == 'Draft'){
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
                        if(@$recordsEdit[0]->registrationStatus == 'Submitted' || @$recordsEdit[0]->registrationStatus == 'Screening' || @$recordsEdit[0]->registrationStatus == 'Under R and I' || @$recordsEdit[0]->registrationStatus == 'Received By DRAP' || @$recordsEdit[0]->registrationStatus == 'Referred Back To Company (Editable)'){
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
                        if(@$recordsEdit[0]->registrationStatus == 'Under Review Stage 1' || @$recordsEdit[0]->registrationStatus == 'Under Inspection' || @$recordsEdit[0]->registrationStatus == 'Referred Back To Company (Locked)' || @$recordsEdit[0]->registrationStatus == 'Review Complete'){
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
                        if(@$recordsEdit[0]->registrationStatus == 'Under Board Stage 2' || @$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->registrationStatus == 'Pricing Complete' || @$recordsEdit[0]->registrationStatus == 'Approved'){
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
                                        <iframe src="<?php echo @$recordsEdit[0]->googleMapURL ?>" width="100%" height="280" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                    </div>
                                </div>
                            <?php } ?>

                            <div class="col-md-12">
                                <br>
                                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                                    <div class="card-header p-0 pt-1">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="pill" href="#tab1">Application Type</a>
                                            </li>
                                            <?php if($myAction <> 'add'){ ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab2">Product Information</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab3"><?php if(@$recordsEdit[0]->registrationFormType == 'Form 5F (CTD)'){echo 'Form 5F (CTD)';} else{echo 'Form ______';} ?></a></a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="pill" href="#tab4">Queries</a>
                                                </li>
                                                <?php if($this->roleId <> 26){ ?>
                                                    <?php if(@$recordsEdit[0]->registrationStatus <> 'Submitted' && @$recordsEdit[0]->registrationStatus <> 'Screening' && @$recordsEdit[0]->registrationStatus <> 'Under R and I' && $recordsEdit[0]->registrationStatus <> 'Received By DRAP'){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="pill" href="#tab8">Evaluation</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="pill" href="#tab5">Letter Statement</a>
                                                        </li>
                                                    <?php } ?>
                                                    <?php if(@$records[0]->registrationStatus == 'Under Board Stage 2' || @$records[0]->registrationStatus == 'Post Board Process'){ ?>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="pill" href="#tab6">RB</a>
                                                        </li>
                                                    <?php } ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="pill" href="#tab7">Assignment / Note Sheet</a>
                                                    </li>
                                                <?php } ?>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">

                                            <div class="tab-pane fade show" id="tab1">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <?php if($myAction == 'add'){ ?>
                                                        <?php if($this->companySubCategory <> 'Importer'){?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php $label = 'Establishment License'; ?>
                                                                    <label><?php echo $label; ?></label>
                                                                    <?php $column = 'masterId'; ?>
                                                                    <input readonly <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$licenseApproved1[0]->licenseSubType; ?>" class="form-control required">
                                                                </div>
                                                                <input <?php if($myAction == 'add'){echo 'readonly';}?> <?php if($myAction == 'edit'){echo 'disabled';}?> type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved1[0]->id; ?>">
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if($myAction <> 'add'){ ?>
                                                        <?php if($this->companySubCategory <> 'Importer'){?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php $label = 'Establishment License'; ?>
                                                                    <label><?php echo $label; ?></label>
                                                                    <?php $column = 'masterId'; ?>
                                                                    <input readonly <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$licenseApproved[0]->licenseSubType; ?>" class="form-control required">
                                                                </div>
                                                                <input <?php if($myAction == 'add'){echo 'readonly';}?> <?php if($myAction == 'edit'){echo 'disabled';}?> type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved[0]->id; ?>">
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if($myAction == 'add'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Product Category'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'productCategoryId'; ?>
                                                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php
                                                                    if(!empty($productCategory))
                                                                    {
                                                                        foreach ($productCategory as $record)
                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->productCategory ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Used For'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'usedForId'; ?>
                                                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php
                                                                    if(!empty($usedFor))
                                                                    {
                                                                        foreach ($usedFor as $record)
                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->usedFor ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Contract Manufacturing'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'isContractManufacturer'; ?>
                                                                <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="productOriginId" value="<?php if(@$recordsEdit[0]->companySubCategory == 'Manufacturer'){echo '1';} if(@$recordsEdit[0]->companySubCategory == 'Importer'){echo '2';} ?>">
                                                    <?php } ?>

                                                    <?php if($myAction <> 'add'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Product Origin'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'companySubCategory'; ?>
                                                                <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php if(@$recordsEdit[0]->companySubCategory == 'Manufacturer'){echo 'Local';} if(@$recordsEdit[0]->companySubCategory == 'Importer'){echo 'Importer';} ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Product Category'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'productCategoryId'; ?>
                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php
                                                                    if(!empty($productCategory))
                                                                    {
                                                                        foreach ($productCategory as $record)
                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->productCategory ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Used For'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'usedForId'; ?>
                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php
                                                                    if(!empty($usedFor))
                                                                    {
                                                                        foreach ($usedFor as $record)
                                                                        {
                                                                            ?>
                                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->usedFor ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Contract Manufacturing'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'isContractManufacturer'; ?>
                                                                <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <?php if(@$recordsEdit[0]->isContractManufacturer == 'Yes'){ ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <?php $label = 'Manufacturer License'; ?>
                                                                    <label><?php echo $label; ?></label>
                                                                    <?php $column = 'contractManufacturerLicenseId'; ?>
                                                                    <select <?php if(@$recordsEdit[0]->$column){echo 'disabled';}?> <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                        <option value="">Select <?php echo @$label; ?></option>
                                                                        <?php
                                                                        if(!empty($allApprovedLicenses))
                                                                        {
                                                                            foreach ($allApprovedLicenses as $record)
                                                                            {
                                                                                ?>
                                                                                <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->licenseNoManual. ' - ' .$record->companyName ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>

                                                    <?php if($myAction <> 'add'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Registration Type'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'registrationTypeId'; ?>
                                                                <select <?php if(@$recordsEdit[0]->$column){echo 'disabled';}?> <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php
                                                                    if(!empty($registrationType))
                                                                    {
                                                                        foreach ($registrationType as $record)
                                                                        {
                                                                            if(@$recordsEdit[0]->productCategoryId == 1){
                                                                                if($record->id == 1 || $record->id == 2){
                                                                                    continue;
                                                                                }
                                                                            }
                                                                            if(@$recordsEdit[0]->productCategoryId == 2){
                                                                                if($record->id == 39 || $record->id == 40 || $record->id == 41 || $record->id == 42 || $record->id == 43 || $record->id == 44 || $record->id == 45){
                                                                                    continue;
                                                                                }
                                                                            }
                                                                            ?>
                                                                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->registrationSubType ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Registration Form Type'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'registrationFormType'; ?>
                                                                <select <?php if(@$recordsEdit[0]->$column){echo 'disabled';}?> <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <?php if(@$recordsEdit[0]->usedForId == 1){?>
                                                                        <option value="Form 5F (CTD)" <?php if('Form 5F (CTD)' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5F (CTD)</option>
                                                                    <?php }?>
                                                                    <?php if(@$recordsEdit[0]->productCategoryId == 1 && @$recordsEdit[0]->usedForId == 3){?>
                                                                        <option value="Form 5" <?php if('Form 5' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5</option>
                                                                        <option value="Form 5-D" <?php if('Form 5-D' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5-D</option>
                                                                        <option value="Form 5-E" <?php if('Form 5-E' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5-E</option>
                                                                    <?php }?>
                                                                    <?php if(@$recordsEdit[0]->productCategoryId == 2 && @$recordsEdit[0]->usedForId == 1){?>
                                                                        <option value="Form 5" <?php if('Form 5' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5</option>
                                                                        <option value="Form 5-D" <?php if('Form 5-D' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5-D</option>
                                                                    <?php }?>
                                                                    <?php if($this->companySubCategory == 'Importer'){?>
                                                                        <option value="Form 5-A" <?php if('Form 5-A' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5-A</option>
                                                                    <?php }?>
                                                                    <?php if(@$recordsEdit[0]->productCategoryId == 2 && @$recordsEdit[0]->usedForId == 3){?>
                                                                        <!-- <option value="Form 5-A" <?php if('Form 5-A' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Form 5-A</option> -->
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <?php if($this->companySubCategory <> 'Importer'){?>
                                                            <?php if(@$recordsEdit[0]->isContractManufacturer <> 'Yes'){?>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <?php $label = 'Section'; ?>
                                                                        <label><?php echo $label; ?></label>
                                                                        <?php $column = 'sectionId'; ?>
                                                                        <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                            <option value="">Select <?php echo @$label; ?></option>
                                                                            <?php
                                                                            if(!empty($licenseSectionApproved))
                                                                            {
                                                                                foreach ($licenseSectionApproved as $record)
                                                                                {
                                                                                    ?>
                                                                                    <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->section ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            <?php }?>
                                                        <?php }?>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Deposit Date'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'rgDate'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Fee Challan Invoice No.'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'rgInvoiceNo'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Amount Paid'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'rgFeeAmount'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="number" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required" style="text-align: right; direction: ltr;" step="any" min="0">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        </div>

                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Fee Challan'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'rgFeeChallan'; ?>
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

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab2">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <?php $label = 'Proposed Name 1'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'proposedName1'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <?php $label = 'Proposed Name 2'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'proposedName2'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <?php $label = 'Proposed Name 3'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'proposedName3'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <?php if(@$recordsEdit[0]->productCategoryId == 1){?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Common Name'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'commonName'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>
                                                    <?php }?>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Dosage Form'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'dosageFormId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($dosageForm))
                                                                {
                                                                    foreach ($dosageForm as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->dosageName ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Basic Dose'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'basicDoseId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($basicDose))
                                                    {
                                                        foreach ($basicDose as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->basicDose ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Pharmaceutical Dose'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'pharmaDoseId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($pharmaDose))
                                                    {
                                                        foreach ($pharmaDose as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->pharmaDose ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Combined Pharma Dose'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'combinedPharmaDoseId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($combinedPharmaDose))
                                                    {
                                                        foreach ($combinedPharmaDose as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->combinedPharmaDose ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Release Characteristics'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'releaseCharacteristicsId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($releaseCharacteristics))
                                                    {
                                                        foreach ($releaseCharacteristics as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->releaseCharacteristics ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Transformation'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'transformationId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($transformation))
                                                    {
                                                        foreach ($transformation as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->transformation ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Admin Method'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'adminMethodId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($adminMethod))
                                                    {
                                                        foreach ($adminMethod as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->adminMethod ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Intended Site'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'intendedSiteId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($intendedSite))
                                                    {
                                                        foreach ($intendedSite as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->intendedSite ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Presentation Unit'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'presentationUnitId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($presentationUnit))
                                                    {
                                                        foreach ($presentationUnit as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->presentationUnit ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div> -->

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Route of Admin'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'routeOfAdminId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($routeOfAdmin))
                                                                {
                                                                    foreach ($routeOfAdmin as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->routeOfAdmin ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Packaging Category'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'packagingCategoryId'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                                    if(!empty($packagingCategory))
                                                    {
                                                        foreach ($packagingCategory as $record)
                                                        {
                                                            ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->packagingCategory ?></option>
                                        <?php
                                                        }
                                                    }
                                                    ?>
                              </select>
                            </div>
                          </div> -->

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Finished Product Specification'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pharmacopeiaId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($pharmacopeia))
                                                                {
                                                                    foreach ($pharmacopeia as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->pharmacopeia ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Reference Unit (In case if reference unit is NOT Dosage Form itself)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'refUnit'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Intended Use'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'intendedUse'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <option value="Domestic Sale" <?php if('Domestic Sale' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Domestic Sale</option>
                                                                <option value="Export Sale" <?php if('Export Sale' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Export Sale</option>
                                                                <option value="Domestic and Export Sales" <?php if('Domestic and Export Sales' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Domestic and Export Sales</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Pharmaco Therapeutic Group'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'pharmacoTherapeuticGroup'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <?php if($this->companySubCategory == 'Importer'){?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Exporting Country'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'exportingCountry'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <?php $label = 'Marketing authorization holder name and address'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'maHolder'; ?>
                                                                <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <?php $label = 'Manufacturer name and address'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'manufacturerDetail'; ?>
                                                                <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php }?>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">INN</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailinn'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>INN</th>
                                                                        <th>Strength / Potency</th>
                                                                        <th>Operator</th>
                                                                        <th>Unit</th>
                                                                        <th>Manufacturer</th>
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
                                                                    if(empty($recordsDetailINN))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailINN[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailINN))
                                                                    {
                                                                        foreach($recordsDetailINN as $record)
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
                                                                                            <?php $column = 'innManual'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'strength'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'operator'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="=" <?php if('=' == @$record->$column){ echo 'selected'; } ?>>=</option>
                                                                                                <?php if(@$recordsEdit[0]->productCategoryId == 1){?>
                                                                                                    <option value=">" <?php if('>' == @$record->$column){ echo 'selected'; } ?>>></option>
                                                                                                    <option value="<" <?php if('<' == @$record->$column){ echo 'selected'; } ?>><</option>
                                                                                                    <option value="≥" <?php if('≥' == @$record->$column){ echo 'selected'; } ?>>≥</option>
                                                                                                    <option value="≤" <?php if('≤' == @$record->$column){ echo 'selected'; } ?>>≤</option>
                                                                                                    <option value="≥ and ≤" <?php if('≥ and ≤' == @$record->$column){ echo 'selected'; } ?>>≥ and ≤</option>
                                                                                                <?php }?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $label = 'Unit'; ?>
                                                                                            <?php $column = 'unitId'; ?>
                                                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control required" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                                                <?php
                                                                                                if(!empty($unit))
                                                                                                {
                                                                                                    foreach ($unit as $detail)
                                                                                                    {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->unit ?></option>
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
                                                                                            <?php $column = 'manufacturer'; ?>
                                                                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
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
                                                            <?php $label = 'Label Claim'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'labelClaim'; ?>
                                                            <textarea readonly <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo 'Each '.((@$recordsEdit[0]->refUnit)? @$recordsEdit[0]->refUnit:@$recordsEdit[0]->dosageName).' contains:'."\n";
                                                                foreach ($recordsDetailINN as $record1)
                                                                {
                                                                    echo @$record1->innManual.' .... '.@$record1->strength.' '.@$record1->unit."\n";
                                                                }?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'ATC Code'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'atcCodeId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($atcCode))
                                                                {
                                                                    foreach ($atcCode as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->atcName.' ('.$record->atcCode.')' ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'ATC Manual (Write here only in case of ATC Code not availible in the list)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'atcCodeManual'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Shelf Life'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'shelfLife'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Storage Condition'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'storageCondition'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="card card-primary card-outline">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Proposed Packing</h3>
                                                                <div class="card-tools">
                                                                </div>
                                                            </div>
                                                            <!-- /.card-header -->
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                                                <?php $myTable = 'tabledetailproposedpacking'; ?>
                                                                <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>S.#</th>
                                                                        <th>Pack Size</th>
                                                                        <th>Description of Pack (Primary and Secondary)</th>
                                                                        <th>Proposed Price</th>
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
                                                                    if(empty($recordsDetailProposedPacking))
                                                                    {
                                                                        unset($record);
                                                                        @$recordsDetailProposedPacking[0]->id = 1;
                                                                    }
                                                                    ?>
                                                                    <?php
                                                                    if(!empty($recordsDetailProposedPacking))
                                                                    {
                                                                        foreach($recordsDetailProposedPacking as $record)
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
                                                                                            <?php $column = 'packSize'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO">
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'description'; ?>
                                                                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'proposedPrice'; ?>
                                                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
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

                                                    <?php if($this->companySubCategory == 'Importer'){ ?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'COPP No.'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'coppNo'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'COPP Issuing Authority'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'coppIssuingAuthority'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'COPP Date of Issue'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'coppDateOfIssue'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'COPP Validity'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'coppValidity'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'FSC No.'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'fscNo'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'FSC Issuing Authority'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'fscIssuingAuthority'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'FSC Date of Issue'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'fscDateOfIssue'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'FSC Validity'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'fscValidity'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'GMP No.'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'gmpNo'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'GMP Issuing Authority'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'gmpIssuingAuthority'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'GMP Date of Issue'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'gmpDateOfIssue'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'GMP Validity'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'gmpValidity'; ?>
                                                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <?php $label = 'Details of Letter of Authorization'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'detailsOfLetterOfAuthorization'; ?>
                                                                <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Registration and availability status in country of origin'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'registrationAndAvailabilityStatus'; ?>
                                                                <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                    <option value="">Select <?php echo @$label; ?></option>
                                                                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <?php $label = 'Remarks (if any)'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'registrationAndAvailabilityStatusRemarks'; ?>
                                                                <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Domestic Ref. (Brand Name)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefBrandName'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Domestic Ref. (Registration No.)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefRegistrationNo'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Domestic Ref. (Product Holder)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'domesticRefProductHolder'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'International Ref. (Brand Name)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefBrandName'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'International Ref. (MA Holder)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefMAHolder'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'International Ref. (Regulatory Body)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefRegulatoryBodyId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($regulatoryBody))
                                                                {
                                                                    foreach ($regulatoryBody as $detail)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $detail->regulatoryBody ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'International Ref. 3 European Countries (Write here only in case of Regulatory Body not availible in the list)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRef3EuropeanCountries'; ?>
                                                            <textarea <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <?php $label = 'International Ref. (Link)'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'internationalRefLink'; ?>
                                                            <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                        <div class="form-group">
                                                            <?php $label = 'Proposed Artwork'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'proposedArtworkPath'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
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
                                                            <?php $label = 'SmPC'; ?>
                                                            <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                            <?php $column = 'smpc'; ?>
                                                            <div class="custom-file">
                                                                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input1">
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

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab3">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <?php if(@$recordsEdit[0]->registrationFormType == 'Form 5F (CTD)'){ ?>
                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Module 1'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'module1'; ?>
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
                                                                <?php $label = 'Module 2'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'module2'; ?>
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
                                                            <div class="card card-warning">
                                                                <div class="card-header">
                                                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                                                                        <label><i class="fa fa-asterisk text-danger"></i> Undertaking:
                                                                    </a>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div id="accordion">
                                                                        <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
                                                                            <div class="card-body">
                                                                                Module 3, Module 4 and Module 5 will be submitted through CDs.
                                                                                <br><br>
                                                                                <b>By submitting this application I/ we agree the following commitments.</b>
                                                                                <br><br>
                                                                                I / we hereby undertake that: <br><br>
                                                                                1. After registration of applied drug, the Pharmacovigilance department of the applicant /
                                                                                manufacture is liable to impose similar restrictions, addition of any clinical information (like
                                                                                in Indications, Contra-indications, Side effects, Precautions, Dosage & Adverse Drug
                                                                                Reactions etc. in Summary of Product Characteristics (SmPC), Labelling & Promotional
                                                                                material) or withdraw the drug from market in Pakistan within fourteen days after knowing
                                                                                that such information (which was not available or approved by the DRAP at the time of
                                                                                registration) / actions taken (for safety reasons) by any reference / stringent drug regulatory
                                                                                agency / authority & also inform the DRAP (Drug Regulatory Authority of Pakistan) for
                                                                                further action in this regard. <br><br>
                                                                                2. We shall recall the defective Finished Pharmaceutical Products (FPP) and notify the
                                                                                compliance to the authority along with detail of actions taken by him as soon as possible but
                                                                                not more than ten days. The level of recall shall also be defined. <br><br>
                                                                                3. In case of any false claim / concealing of information, the DRAP has the right to reject the
                                                                                application at any time, before and even after approval or registration of the product in case
                                                                                if proved so. <br><br>
                                                                                4. We will follow the official pharmacopoeia specifications for product / substance as published
                                                                                in the latest edition & shall update its specification as per latest editions of the same. In case,
                                                                                the specifications of product / substance not present in any official pharmacopoeia the firm
                                                                                shall establish the specifications. In both cases, the validation of specifications shall be done
                                                                                by the applicant. <br><br>
                                                                                5. In case of any post approval change, the applicant shall ensure that the product with both
                                                                                approvals shall not be available in the market at the same time. And the product with new
                                                                                approvals shall be marketed only after consumption / withdrawal of stock with previous
                                                                                approvals. The company shall be liable to inform the same regarding marketing status of
                                                                                product to the DRAP after getting such post-registration approvals. <br><br>
                                                                                6. We will perform process validation and stability studies till the assigned shelf life for the first
                                                                                three consecutive batches of commercial scale, stability study of at least one batch every year
                                                                                in accordance with the protocols and continue real time stability study till assigned shelf life
                                                                                of the applied product. <br><br>
                                                                                7. We will be responsible to change the brand name in case the name resembles with already
                                                                                approved / registered names. <br><br>
                                                                                8. We will be responsible to change the label design if it resembles with any of the previously registered
                                                                                drug. <br><br>
                                                                                I / We hereby undertake that the above given information is true and correct to the best of my / our
                                                                                knowledge and belief.
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if(@$recordsEdit[0]->registrationFormType == 'Form 5'){ ?>
                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Form 5'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'form5Attachment'; ?>
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

                                                    <?php if(@$recordsEdit[0]->registrationFormType == 'Form 5-D'){ ?>
                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Form 5-D'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'form5dAttachment'; ?>
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

                                                    <?php if(@$recordsEdit[0]->registrationFormType == 'Form 5-A'){ ?>
                                                        <div class="col-md-6" <?php if($this->roleId <> 26){echo 'style="display:none;"';}?>>
                                                            <div class="form-group">
                                                                <?php $label = 'Form 5-A'; ?>
                                                                <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                                                <?php $column = 'form5aAttachment'; ?>
                                                                <div class="custom-file">
                                                                    <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>">
                                                                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="custom-file-input <?php if(!@$recordsEdit[0]->$column){echo 'required';}?>">
                                                                    <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
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

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab4">

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
                                                                        <th>Application Status</th>
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
                                                                                <td><?php echo $record->applicationStatus; ?></td>
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
                                            <div class="tab-pane fade" id="tab8">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-12">
                                                        <?php $label = 'Reviewer Evaluation'; ?>
                                                        <?php $column = 'reviewer1Remarks11'; ?>
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
                                                        <?php $label = 'Reviewer Remarks'; ?>
                                                        <?php $column = 'reviewer2Remarks11'; ?>
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

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Proposed'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'inspectionProposed'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId == '39'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Required'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'inspectionRequired'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> '39'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Type'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'inspectionTypeId'; ?>
                                                            <select <?php if($myAction == 'view' || $this->roleId <> '39'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($inspectionType))
                                                                {
                                                                    foreach ($inspectionType as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionSubType ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="tab5">

                                                <div class="row" style="float: left; width: 100%;">

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'File No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'regFileNo'; ?>
                                                            <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Registration No.'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'registrationNoManual'; ?>
                                                            <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Issue Date'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'regIssueDateManual'; ?>
                                                            <input disabled <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                        </div>
                                                    </div>

                                                    <?php if($this->roleId == '19' && (@$recordsEdit[0]->registrationStatus == 'Post Board Process' || @$recordsEdit[0]->registrationStatus == 'Recommended By Board Stage 3' || @$recordsEdit[0]->registrationStatus == 'Under Pricing' || @$recordsEdit[0]->registrationStatus == 'Pricing Complete' || @$recordsEdit[0]->registrationStatus == 'Deferred and Closed' || @$recordsEdit[0]->registrationStatus == 'Approved')){?>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <?php $label = 'Approved Name'; ?>
                                                                <label><?php echo $label; ?></label>
                                                                <?php $column = 'approvedName'; ?>
                                                                <input <?php if(@$recordsEdit[0]->$column){echo 'readonly';}?> <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <div class="col-md-12">
                                                        <?php $label = 'Registration Remarks (Shortcoming)'; ?>
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

                                                </div>

                                            </div>
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
                                                                            <th class="text-center" style="display:none">Action</th>
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
                                                                                    <!--<div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'meetingNo'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>
                                          -->
                                                                                </td>
                                                                                <td>
                                                                                    <?php echo $record->meetingDate; ?>
                                                                                    <!--<div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'meetingDate'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control required">
                                          </div>
                                        </div>-->
                                                                                </td>
                                                                                <td>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <?php $column = 'remarks'; ?>
                                                                                            <textarea <?php echo 'disabled';?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                                        </div>
                                                                                    </div>
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
                                                                                </td>
                                                                                <?php if($myAction <> 'view'){ ?>
                                                                                    <td class="text-center widthMaxContent" style="display:none">
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

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Required'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'inspectionRequired1'; ?>
                                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                                                <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php $label = 'Inspection Type'; ?>
                                                            <label><?php echo $label; ?></label>
                                                            <?php $column = 'inspectionTypeId1'; ?>
                                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                                <option value="">Select <?php echo @$label; ?></option>
                                                                <?php
                                                                if(!empty($inspectionType))
                                                                {
                                                                    foreach ($inspectionType as $record)
                                                                    {
                                                                        ?>
                                                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->inspectionSubType ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
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
                                                            <div class="card-body table-responsive myFixedTableHeader1" style="//height: 300px;">
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
                                                                            <?php if($this->roleId == '19' || $this->roleId == '51'){?>
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

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if($this->roleId == 26){ ?>
                                <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Priority Reason'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'priorityReasonId'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                                if(!empty($priorityReason))
                                {
                                    foreach ($priorityReason as $record)
                                    {
                                        ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->priorityReason ?></option>
                            <?php
                                    }
                                }
                                ?>
                  </select>
                </div>
              </div> -->

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Specify Details of Priority (If Any)'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'remarks'; ?>
                                        <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Final Remarks By DRAP'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'finalRemarksShowToCompany'; ?>
                  <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div> -->
                            <?php } ?>

                            <?php if($this->roleId <> 26){ ?>
                                <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Priority Reason'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'priorityReasonId'; ?>
                  <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                                if(!empty($priorityReason))
                                {
                                    foreach ($priorityReason as $record)
                                    {
                                        ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->priorityReason ?></option>
                            <?php
                                    }
                                }
                                ?>
                  </select>
                </div>
              </div> -->

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Is Priority'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'isPriority'; ?>
                                        <select <?php if($myAction == 'view' || $this->roleId <> 38){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                            <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Specify Details of Priority (If Any)'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'remarks'; ?>
                                        <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Final Remarks By DRAP'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'finalRemarksShowToCompany'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div> -->
                            <?php } ?>

                            <?php if($this->roleId == 26){ ?>
                                <div class="col-md-6" style="display: none;">
                                    <div class="form-group">
                                        <?php $label = 'Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationStatus'; ?>
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
                                        <?php $column = 'registrationStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <?php
                                            if($this->roleId == '7'){ // Registration Director
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      <option value="Approved">Approved</option>
                      ';
                                            }
                                            if($this->roleId == '11'){ // Registration Additional Director
                                                echo '
                      <option value="Save">Save</option>
                      ';
                                            }
                                            if($this->roleId == '15'){ // Registration Deputy Director
                                                echo '
                      <option value="Save">Save</option>
                      ';
                                            }
                                            if($this->roleId == '19'){ // Registration Assistant Director
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Referred Back To Company">Referred Back To Company</option>
                      <option value="Proceed">Proceed</option>
                      ';
                                            }
                                            if($this->roleId == '39'){ // Registration Assigning Officer
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      ';
                                            }
                                            if($this->roleId == '44'){ // Registration Board Secretary
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      <option value="Deferred and Closed">Deferred and Closed</option>
                      ';
                                            }
                                            if($this->roleId == '45'){ // Registration Pricing User
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Proceed">Proceed</option>
                      ';
                                            }
                                            if($this->roleId == '51'){ // Registration Screening Officer
                                                echo '
                      <option value="Save">Save</option>
                      <option value="Referred Back To Company">Referred Back To Company</option>
                      <option value="Proceed">Proceed</option>
                      ';
                                            }
                                            if($this->roleId == '42'){ // CEO
                                                echo '
                      <!-- <option value="Save">Save</option> -->
                      <!-- <option value="Deferred and Closed">Deferred and Closed</option> -->
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

<script type="text/javascript">
    loadMyTable('table', true, 15);
    loadMyTable('tabledetailhistory', false, -1);

    loadMyTable('tabledetailproposedbrandname', false, -1);
    $('#tabledetailproposedbrandname').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailproposedbrandname';
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

    loadMyTable('tabledetailinn', false, -1);
    $('#tabledetailinn').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailinn';
        var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
        $("td :input", row).val("");
        $("td.qtyC", row).text("");
        $("td.rateC", row).text("");
        $("td b.totalValue", row).text("");

        $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
        $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

        $('#'+myCurrentTable).DataTable().row.add(row).draw();

        // $.ajax({
        //   url:"<?php echo base_url(); ?>myController/innAjaxGet",
        //   method:"POST",
        //   success:function(data)
        //   {
        //     $("td:eq(1)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(1).children().children().children().attr("name") +'">'+data+'</select>');
        //   }
        //  });

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_unit', columnName:'unit'},
            success:function(data)
            {
                $("td:eq(4)", row).closest('td').html('<select class="form-control select2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(4).children().children().children().attr("name") +'">'+data+'</select>');
            }
        });

        $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' })
        //$('#'+myCurrentTable+' select').select2();
        //$('#'+myCurrentTable+' tbody tr:last').find('td').eq(9).addClass('text-center widthMaxContent');
    });

    loadMyTable('tabledetailproposedpacking', false, -1);
    $('#tabledetailproposedpacking').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailproposedpacking';
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

    loadMyTable('tabledetaildomesticreference', false, -1);
    $('#tabledetaildomesticreference').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetaildomesticreference';
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

    loadMyTable('tabledetailinternationalreference', false, -1);
    $('#tabledetailinternationalreference').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailinternationalreference';
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
            data:{table:'tbl_regulatorybody', columnName:'regulatoryBody'},
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
        $('#registrationStatus').val('Save');
    });
    $("#formSubmit").click(function() {
        $('#registrationStatus').val('Submit');
    });

    $(function () {
        $('#reviewer1Remarks').summernote()
        $('#reviewer1Remarks2').summernote()
        $('#reviewer1Remarks3').summernote()
        $('#panelOfInspector1').summernote()
        $('#panelRemarks').summernote()
        $('#reviewer1Remarks11').summernote()
        $('#reviewer2Remarks11').summernote()

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
        <?php if($myAction == 'view' || $this->roleId <> 19 || @$recordsEdit[0]->registrationStatus <> 'Under Review Stage 1'){ ?>
        $('#reviewer1Remarks11').summernote('disable');
        <?php } ?>
        <?php if($myAction == 'view' || $this->roleId <> 19 || @$recordsEdit[0]->registrationStatus <> 'Post Board Process'){ ?>
        $('#reviewer2Remarks11').summernote('disable');
        <?php } ?>
    })
</script>