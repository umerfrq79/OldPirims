
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
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <style>
        .suggestbox > ul{
            background-color:#eee;
            cursor:pointer;
        }
        .suggestbox > ul > li{
            padding:12px;
        }
    </style>
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
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <div class="pull-left">
                                    <h6 class="card-title txt-dark">Registered Drug Search - DRAP</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="<?php echo base_url(); ?>importregistration/lookup" method="post" >
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Search By</label>
                                                        <select autofocus class="form-control" name="searchby" id="searchby">
                                                            <option value="1" selected >Registration Number</option>
                                                            <option value="2" <?php echo isset($searchby) && $searchby == 2?'selected':''; ?> >Brand Name</option>
                                                            <option value="3" <?php echo isset($searchby) && $searchby == 3?'selected':''; ?>>Composition</option>
                                                            <option value="4" <?php echo isset($searchby) && $searchby == 4?'selected':''; ?>>Company</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 filterbox">
                                                    <div class="form-group">
                                                        <label for="sstring">Search String</label>
                                                        <input autofocus type="text" class="form-control" id="sstring" value="<?php echo isset($searchstring)?$searchstring:''; ?>" name="searchstring">
                                                    </div>
                                                </div>

                                                <div class="col-md-9 companyfilter">
                                                    <div class="form-group">
                                                        <?php $label = 'Company Name'; ?>
                                                        <label><?php echo $label; ?></label>
                                                        <?php $column = 'companyAccountId'; ?>
                                                        <select style="height: inherit" autofocus class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                            <option value="">Select <?php echo @$label; ?></option>
                                                            <?php
                                                            if(!empty($companies))
                                                            {
                                                                foreach ($companies as $company)
                                                                {
                                                                    ?>
                                                                    <option value="<?php echo $company->companyUniqueNo ?>" <?php echo isset($companyAccountId) && $companyAccountId == $company->companyUniqueNo?'selected':''; ?> ><?php echo $company->companyName.' -'.$company->licenseNoManual.'- (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="submit" value="Search" class="btn btn-primary" name="" id="">
                                                </div>
                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Lookup</h3>
                                <div class="card-tools">
                                    <?php
                                    echo '<a target="_blank" href="'.base_url().'downloadRegisteredProducts'.'" class="btn btn-info mr-5"><i class="fa fa-plus"></i> Download Registered Products</a>';

                                    echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> Registration Data</a>';
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
                                <?php
                                if(isset($drugs)){
                                    ?>
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>S.#</th>
                                            <th class="text-center">Pirims Ref. No.</th>
                                            <th>Company</th>
                                            <?php if($this->companySubCategory <> 'Importer'){?>
                                                <!-- <th>Establishment License</th>
                                                <th>License No.</th> -->
                                            <?php } ?>
                                            <th>Registration No.</th>
                                            <th>Approved Name</th>
                                            <th>Registration Type</th>
                                            <th>Registration Form Type</th>
                                            <th>Product Origin</th>
                                            <th>Product Category</th>
                                            <th>Used For</th>

                                            <th>Issue Date</th>
                                            <th>Renewal Due Date</th>
                                            <th>Last Renewal Date</th>
                                            <th class="text-center">Data Status</th>
                                            <th class="text-center">Stage</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <?php $sn=1; ?>
                                        <?php
                                        $CI =& get_instance();
                                        ?>
                                        <?php
                                        if(!empty($drugs))
                                        {
                                            foreach($drugs as $record)
                                            {
                                                $seenBy = explode(",",$record->seenBy);
                                                ?>
                                                <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                                                    <td><?=$sn?>.</td>
                                                    <td class="text-center"><?php echo $record->id; ?></td>
                                                    <td>
                                                        <?php
                                                        $company = $CI->loginModel->getCompany($record->companyAccountId);
                                                        echo isset($company[0])?$company[0]->companyName:'';
                                                        ?>

                                                    </td>
                                                    <!--<td><?php //echo $record->companyNTN; ?></td>-->
                                                    <?php if($this->companySubCategory <> 'Importer'){?>
                                                        <!-- <td><?php echo $record->licenseType.' &mdash; '.$record->licenseSubType; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td> -->
                                                    <?php } ?>
                                                    <td><?php echo $record->registrationNo; ?></td>
                                                    <td><?php echo $record->approvedName; ?></td>

                                                    <td>
                                                        <?php
                                                        $regtype = $CI->loginModel->getRecord('tbl_registrationtype','id',$record->registrationTypeId);
                                                        echo isset($regtype[0])?$regtype[0]->registrationType.' &mdash; '.$regtype[0]->registrationSubType:'';
                                                        ?>
                                                    </td>
                                                    <td><?php echo $record->registrationFormType; ?></td>
                                                    <td>
                                                        <?php
                                                        $porigin = $CI->loginModel->getRecord('tbl_productorigin','id',$record->productOriginId);
                                                        echo isset($porigin[0])?$porigin[0]->productOrigin:'';
                                                        ?>

                                                    </td>
                                                    <td>
                                                        <?php
                                                        $pcat = $CI->loginModel->getRecord('tbl_productcategory','id',$record->productCategoryId);
                                                        echo isset($pcat[0])?$pcat[0]->productCategory:'';
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $usedfor = $CI->loginModel->getRecord('tbl_usedfor','id',$record->usedForId);
                                                        echo isset($usedfor[0])?$usedfor[0]->usedFor:'';
                                                        ?>
                                                    </td>
                                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))); ?></td>
                                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))); ?></td>
                                                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                                                    <td class="text-center">
                                                        <?php if($record->productStatus ==1){
                                                            echo "Verified";
                                                        } else if($record->productStatus ==2){
                                                            echo "Un-Verified";
                                                        }else if($record->productStatus ==3){
                                                            echo "Provisionally Verified";
                                                        }

                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <b><h4><span class='badge bg-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Screening' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review Stage 1' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Post Inspection Process' || $record->registrationStatus == 'Under Board Stage 2' || $record->registrationStatus == 'Post Board Process'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 3' || $record->registrationStatus == 'Under Pricing' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                                                    </td>
                                                    <td class="text-center widthMaxContent">
                                                        <div class="btn-group">
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
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

                                    <?php
                                }else{
                                    ?>
                                    <table id="newtable" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>S.#</th>
                                            <th class="text-center">Referrence No.</th>
                                            <th>Company</th>
                                            <?php if($this->companySubCategory <> 'Importer'){?>
                                                <!-- <th>Establishment License</th>
                                                <th>License No.</th> -->
                                            <?php } ?>
                                            <th>Registration No.</th>
                                            <th>Approved Name</th>
                                            <th>Registration Type</th>
                                            <th>Registration Form Type</th>
                                            <th>Product Origin</th>
                                            <th>Product Category</th>
                                            <th>Used For</th>

                                            <th>Issue Date</th>
                                            <th>Renewal Due Date</th>
                                            <th>Last Renewal Date</th>
                                            <th class="text-center">Data Status</th>
                                            <th class="text-center">Stage</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $sn=1; ?>
                                        <?php
                                        if(!empty($drugs))
                                        {
                                            foreach($drugs as $record)
                                            {
                                                $seenBy = explode(",",$record->seenBy);
                                                ?>
                                                <tr <?php //if(!(in_array($this->session->userdata('userId'), $seenBy))){echo "style='background-color: #92a1ad2e !important; font-weight:bold;'";} ?>>
                                                    <td><?=$sn?>.</td>
                                                    <td class="text-center"><?php echo $record->id; ?></td>
                                                    <td><?php echo $record->companyName; ?></td>
                                                    <!--<td><?php //echo $record->companyNTN; ?></td>-->
                                                    <?php if($this->companySubCategory <> 'Importer'){?>
                                                        <!-- <td><?php echo $record->licenseType.' &mdash; '.$record->licenseSubType; ?></td>
                    <td><?php echo $record->licenseNoManual; ?></td> -->
                                                    <?php } ?>
                                                    <td><?php echo $record->registrationNo; ?></td>
                                                    <td><?php echo $record->approvedName; ?></td>

                                                    <td><?php echo $record->registrationType.' &mdash; '.$record->registrationSubType; ?></td>
                                                    <td><?php echo $record->registrationFormType; ?></td>
                                                    <td><?php echo $record->productOrigin; ?></td>
                                                    <td><?php echo $record->productCategory; ?></td>
                                                    <td><?php echo $record->usedFor; ?></td>
                                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->issueDateManual)))); ?></td>
                                                    <td><?php echo date('d-M-y', strtotime(date('d-M-y H:i', strtotime($record->validTill)))); ?></td>
                                                    <td><?php echo $record->lastRenewalDateManual; ?></td>
                                                    <td class="text-center">
                                                        <?php if($record->productStatus ==1){
                                                            echo "Verified";
                                                        } else if($record->productStatus ==2){
                                                            echo "Un-Verified";
                                                        }else if($record->productStatus ==3){
                                                            echo "Provisionally Verified";
                                                        }

                                                        ?>

                                                    </td>
                                                    <td class="text-center">
                                                        <b><h4><span class='badge bg-<?php if($record->registrationStatus == 'Draft'){echo 'warning';} elseif($record->registrationStatus == 'Submitted' || $record->registrationStatus == 'Screening' || $record->registrationStatus == 'Under R and I'){echo 'info';} elseif($record->registrationStatus == 'Received By DRAP' || $record->registrationStatus == 'Under Review Stage 1' || $record->registrationStatus == 'Review Complete' || $record->registrationStatus == 'Under Inspection' || $record->registrationStatus == 'Post Inspection Process' || $record->registrationStatus == 'Under Board Stage 2' || $record->registrationStatus == 'Post Board Process'){echo 'primary';} elseif($record->registrationStatus == 'Referred Back To Company (Editable)' || $record->registrationStatus == 'Referred Back To Company (Locked)'){echo 'default';} elseif($record->registrationStatus == 'Deferred and Closed'){echo 'danger';} elseif($record->registrationStatus == 'Recommended By Board Stage 3' || $record->registrationStatus == 'Under Pricing' || $record->registrationStatus == 'Pricing Complete' || $record->registrationStatus == 'Approved'){echo 'success';} ?>'><?php echo $record->registrationStatus; ?></span></h4></b>
                                                    </td>
                                                    <td class="text-center widthMaxContent">
                                                        <div class="btn-group">
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/view/'.$record->id; ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
                                                            <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
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

                                    <?php
                                }
                                ?>

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
                <?php if($myAction == 'add' || $myAction == 'edit'){ ?>
                    <div class="card card-primary card-outline1">
                        <div class="card-header">
                            <h3 class="card-title">Search</h3>
                        </div>
                        <form id="myFormSearch" action="<?php echo base_url().$pageTitle[0]->url; ?>/submit" enctype="multipart/form-data" method="post" autocomplete="off" accept-charset="utf-8">
                            <div class="card-body cardBodyTransaction">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php $label = 'Registration No.'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'reg_no'; ?>
                                            <input  type="text" required id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control required">
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="submit"  class="btn btn-primary" value="Search">
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <?php if($myAction == 'add' || $myAction == 'edit'){echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/submit" enctype="multipart/form-data" method="post" autocomplete="off" accept-charset="utf-8">';}?>

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
                    <?php if($this->roleId == 26 && $myAction =='edit'){ ?>
                        <div class="card-body cardBodyTransaction">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Company Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyAccountId'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2 " id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <?php
                                            if(!empty($companies))
                                            {
                                                foreach ($companies as $company)
                                                {
                                                    ?>
                                                    <option data-companyname="<?php echo $company->companyName; ?>" data-address="<?php echo $company->companyAddress ?>" value="<?php echo $company->companyUniqueNo ?>" <?php if($company->companyUniqueNo == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $company->companyName.' -'.$company->licenseNoManual.'- (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Company Address'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyAddress'; ?>
                                        <textarea name="<?php echo @$column; ?>" readonly  id="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Company Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyName'; ?>
                                        <textarea name="<?php echo @$column; ?>" readonly  id="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Establishment License No'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'masterId'; ?>
                    <input readonly <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$licenseApproved1[0]->licenseSubType; ?>" class="form-control">
                </div>
                <input <?php if($myAction == 'add'){echo 'readonly';}?> <?php if($myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved1[0]->id; ?>">
                <?php $column = 'licenseTypeId'; ?>
                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved1[0]->licenseTypeId; ?>">
              </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php $label = 'Manufacturing Section'; ?>
                        <label><?php echo $label; ?></label>
                        <?php $column = 'manufacturingsection'; ?>
                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                    </div>
                </div>
                -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Dealing Section'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'dealingsection'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option value="REG-I" <?php if("REG-I" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I</option>
                                            <option value="REG-II" <?php if("REG-II" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-II</option>
                                            <option value="REG-I&V(I)" <?php if("REG-I&V(I)" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I&V(I)</option>
                                            <option value="REG-I&V(II)" <?php if("REG-I&V(II)" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I&V(II)</option>
                                            <option value="PR-I" <?php if("PR-I" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>PR-I</option>
                                            <option value="PR-II" <?php if("PR-II" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>PR-II</option>
                                            <option value="BIOLOGICCAL" <?php if("BIOLOGICCAL" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>BIOLOGICCAL</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ui-widget">
                                        <?php $label = 'File Number'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'regFileNo'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Meeting No.'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'meetingNo'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Used For'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'usedForId'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Registration Date'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'issueDateManual'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo date('Y-m-d', strtotime(date('d-m-Y H:i', strtotime(@$recordsEdit[0]->$column)))); ?>"  class="form-control required">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Route of Admin'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'routeOfAdminId'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Renewal Due Date'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'validTill'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Registration No.'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationNo'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Approved Brand Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'approvedName'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Dosage Form'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'dosageFormId'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control prefixselect2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Reference Unit (In case if reference unit is NOT Dosage Form itself)'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'refUnit'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Composition</h3>
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
                                                    <th >Generic</th>
                                                    <th>Strength / Potency</th>
                                                    <th >Unit</th>
                                                    <?php if($myAction <> 'view'  ){ ?>
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
                                                                <div class="col-md-12 w-100 ui-widget">
                                                                    <div class="form-group">
                                                                        <?php $column = 'innManual'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control generic">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'strength'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $label = 'Unit'; ?>
                                                                        <?php $column = 'unitId'; ?>
                                                                        <select style="max-width: 200px" <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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

                                                            <?php if($myAction <> 'view'){ ?>
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
                                        <textarea readonly <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3">
                            <?php echo ((@$recordsEdit[0]->refUnit)? @$recordsEdit[0]->refUnit:'Each '.@$recordsEdit[0]->dosageName.' contains:')."\n";
                            foreach ($recordsDetailINN as $record1)
                            {
                                echo @$record1->innManual.' .... '.@$record1->strength.' '.@$record1->unit."\n";
                            }?></textarea>
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
                                                    <th style="display: none">Description of Pack (Primary and Secondary)</th>

                                                    <th>Approved Price</th>
                                                    <th>Pricing Type</th>
                                                    <th style="display: none">Proposed Price</th>
                                                    <?php if($myAction <> 'view'){ ?>
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
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="Pack Size">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="display: none">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'description'; ?>
                                                                        <textarea <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control " rows="3"><?php echo @$record->$column; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'approvedPrice'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column ?>" class="form-control" placeholder="Price" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'pricingType'; ?>
                                                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                            <option <?php echo @$record->$column == "Controlled"? 'selected':''; ?> value="Controlled">Controlled</option>
                                                                            <option <?php echo @$record->$column == "Free of Cost"? 'selected':''; ?> value="Free of Cost">Free of Cost</option>
                                                                            <option <?php echo @$record->$column == "De-Controlled"? 'selected':''; ?> value="De-Controlled">De-Controlled</option>
                                                                            <option <?php echo @$record->$column == "As Per SRO"? 'selected':''; ?> value="As Per SRO">As Per SRO</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="display: none">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'proposedPrice'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php if($myAction <> 'view' ){ ?>
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





                                <div class="col-md-3">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Finished Product Specification'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'pharmacopeiaId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                                        <?php $label = 'Testing Method'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'testingmethod'; ?>
                                        <textarea name="<?php echo @$column; ?>"  id="<?php echo @$column; ?>" class="form-control" rows="10" placeholder="<?php echo @$recordsEdit[0]->$column; ?>"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <?php $label = 'Already Submitted Data:'; ?>
                                    <label><?php echo $label; ?></label>
                                    <br>
                                    <label><?php echo @$recordsEdit[0]->$column; ?></label>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Shelf Life'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'shelfLife'; ?>
                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Shelf Life Unit'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'shelfLifeunit'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option selected value="Year(s)">Year(s)</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Months(s)'?'selected':''; ?> value="Months(s)">Month(s)</option>
                                        </select>
                                    </div>
                                </div>





                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Manufacturing Type'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'regTypeId'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Self Manufacturing</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Contract Manufacturing</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 3?'selected':''; ?> value="3">Import</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if($this->roleId <> 26){ ?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Data Status'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'productStatus'; ?>
                                            <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                <option value="">Select <?php echo @$label; ?></option>
                                                <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Verified</option>
                                                <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Un-Verified</option>
                                                <option <?php echo @$recordsEdit[0]->$column == 3?'selected':''; ?> value="3">Provisionally Verified</option>

                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Product Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationStatus'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Cancelled'?'selected':''; ?> value="Cancelled">Cancelled</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'De-Activated'?'selected':''; ?> value="De-Activated">De-Activated</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'De-Registered'?'selected':''; ?> value="De-Registered">De-Registered</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Transferred'?'selected':''; ?> value="Transferred">Transferred</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Approved'?'selected':''; ?> value="Approved">Approved</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Provisionally Active'?'selected':''; ?> value="Provisionally Active">Provisionally Active</option>

                                        </select>
                                    </div>
                                </div>
                                <?php if($this->roleId <> 26){echo 'disabled';}{?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Public'; ?>
                                            <label class="w-100"><?php echo $label; ?></label>
                                            <?php $column = 'isPublic'; ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '1'?'checked':''; ?>  value="1">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '0'?'checked':((@$recordsEdit[0]->$column)!== null?'':'checked'); ?> name="<?php echo @$column; ?>" value="0">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Display to Company'; ?>
                                            <label class="w-100"><?php echo $label; ?></label>
                                            <?php $column = 'isCompany'; ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '1'?'checked':''; ?>  value="1">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '0'?'checked':((@$recordsEdit[0]->$column)!== null?'':'checked'); ?> name="<?php echo @$column; ?>" value="0">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Other Manufacturer</h3>
                                            <div class="card-tools">
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                            <?php $myTable = 'tabledetailmanufacturer'; ?>
                                            <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>S.#</th>
                                                    <?php if($this->roleId <> 26){ ?>
                                                        <th style="width:30%" >Company</th>
                                                        <?php
                                                    }
                                                    ?>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Address</th>
                                                    <th>Country</th>
                                                    <?php if($myAction <> 'view'){ ?>
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
                                                if(empty($recordsDetailOtherManufacturer))
                                                {
                                                    unset($record);
                                                    @$recordsDetailOtherManufacturer[0]->id = 1;
                                                }
                                                ?>
                                                <?php
                                                if(!empty($recordsDetailOtherManufacturer))
                                                {
                                                    foreach($recordsDetailOtherManufacturer as $record)
                                                    {

                                                        ?>
                                                        <tr>
                                                            <td class="srNo">
                                                                <span><?=$sn?></span>.
                                                                <?php
                                                                $column = 'id'; ?>
                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                            </td>
                                                            <?php if($this->roleId <> 26){ ?>
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php
                                                                            $column = 'comp'; ?>
                                                                            <select style="height: inherit; width: 100%" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"   class="form-control select2 comp">
                                                                                <option value="">Select Company</option>
                                                                                <?php
                                                                                if(!empty($companies))
                                                                                {
                                                                                    foreach ($companies as $company)
                                                                                    {
                                                                                        ?>
                                                                                        <option data-add="<?php echo $company->companyAddress ?>" value="<?php echo $company->companyName ?>" ><?php echo $company->companyName.' (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'companyName'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control cname">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'role'; ?>
                                                                        <input <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'companyAddress'; ?>
                                                                        <textarea <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control cadd" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $label = 'Country'; ?>
                                                                        <?php $column = 'companyCountry'; ?>
                                                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                            <option value="">Select <?php echo @$label; ?></option>
                                                                            <?php
                                                                            if(!empty($countries))
                                                                            {
                                                                                foreach ($countries as $detail)
                                                                                {
                                                                                    ?>
                                                                                    <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->countryName ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php if($myAction <> 'view' ){ ?>
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

                                <?php if($this->roleId <> 26){ ?>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php $label = 'Remarks'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'submissionRemarks'; ?>
                                            <textarea  name="<?php echo @$column; ?>" id="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php $label = 'Ref Document Number'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'refDocNo'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationStatus'; ?>
                                        <select <?php if($myAction == 'view' || $myAction == 'edit'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>">
                                            <option selected value="Submit">Save</option>
                                            <!--<?php if($this->roleId == 26){ ?>
                    <option value="Draft">Save</option>
                    <option value="Submitted">Submit</option>
                    <?php } ?>
                    <?php if($this->roleId <> 26){ ?>
                    <option value="Under Review">Save</option>
                    <option value="Review Complete">Review Complete</option>
                    <option value="Approved">Approve</option>
                    <option value="Referred Back To Company">Send Back to Applicant</option>
                    <?php } ?>
                      -->
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php }
                    else{?>

                        <div class="card-body cardBodyTransaction">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Company Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyAccountId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 " id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <?php
                                            if(!empty($companies))
                                            {
                                                foreach ($companies as $company)
                                                {
                                                    ?>
                                                    <option data-companyname="<?php echo $company->companyName; ?>" data-address="<?php echo $company->companyAddress ?>" value="<?php echo $company->companyUniqueNo ?>" <?php if($company->companyUniqueNo == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $company->companyName.' -'.$company->licenseNoManual.'- (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Company Address'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyAddress'; ?>
                                        <textarea name="<?php echo @$column; ?>" readonly  id="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Company Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'companyName'; ?>
                                        <textarea name="<?php echo @$column; ?>" readonly  id="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                                <!--<div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Establishment License No'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'masterId'; ?>
                    <input readonly <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php echo @$licenseApproved1[0]->licenseSubType; ?>" class="form-control">
                </div>
                <input <?php if($myAction == 'add'){echo 'readonly';}?> <?php if($myAction == 'edit'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved1[0]->id; ?>">
                <?php $column = 'licenseTypeId'; ?>
                <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="<?php echo @$licenseApproved1[0]->licenseTypeId; ?>">
              </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <?php $label = 'Manufacturing Section'; ?>
                        <label><?php echo $label; ?></label>
                        <?php $column = 'manufacturingsection'; ?>
                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                    </div>
                </div>
                -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Dealing Section'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'dealingsection'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option value="REG-I" <?php if("REG-I" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I</option>
                                            <option value="REG-II" <?php if("REG-II" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-II</option>
                                            <option value="REG-I&V(I)" <?php if("REG-I&V(I)" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I&V(I)</option>
                                            <option value="REG-I&V(II)" <?php if("REG-I&V(II)" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>REG-I&V(II)</option>
                                            <option value="PR-I" <?php if("PR-I" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>PR-I</option>
                                            <option value="PR-II" <?php if("PR-II" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>PR-II</option>
                                            <option value="BIOLOGICCAL" <?php if("BIOLOGICCAL" == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>BIOLOGICCAL</option>

                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="form-group ui-widget">
                                        <?php $label = 'File Number'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'regFileNo'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Meeting No.'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'meetingNo'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>



                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Used For'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'usedForId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Registration Date'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'issueDateManual'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo date('Y-m-d', strtotime(date('d-m-Y H:i', strtotime(@$recordsEdit[0]->$column)))); ?>"  class="form-control required">
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Route of Admin'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'routeOfAdminId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Renewal Due Date'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'validTill'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Registration No.'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationNo'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <?php $label = 'Approved Brand Name'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'approvedName'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Dosage Form'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'dosageFormId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control prefixselect2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php $label = 'Reference Unit (In case if reference unit is NOT Dosage Form itself)'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'refUnit'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Composition</h3>
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
                                                    <th >Generic</th>
                                                    <th>Strength / Potency</th>
                                                    <th >Unit</th>
                                                    <?php if($myAction <> 'view'  ){ ?>
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
                                                                <div class="col-md-12 w-100 ui-widget">
                                                                    <div class="form-group">
                                                                        <?php $column = 'innManual'; ?>
                                                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control generic">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'strength'; ?>
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control ">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $label = 'Unit'; ?>
                                                                        <?php $column = 'unitId'; ?>
                                                                        <select style="max-width: 200px" <?php if($myAction == 'view' ){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
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

                                                            <?php if($myAction <> 'view'){ ?>
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
                                        <textarea readonly <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3">
                            <?php echo ((@$recordsEdit[0]->refUnit)? @$recordsEdit[0]->refUnit:'Each '.@$recordsEdit[0]->dosageName.' contains:')."\n";
                            foreach ($recordsDetailINN as $record1)
                            {
                                echo @$record1->innManual.' .... '.@$record1->strength.' '.@$record1->unit."\n";
                            }?></textarea>
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
                                                    <th style="display: none">Description of Pack (Primary and Secondary)</th>

                                                    <th>Approved Price</th>
                                                    <th>Pricing Type</th>
                                                    <th style="display: none">Proposed Price</th>
                                                    <?php if($myAction <> 'view'){ ?>
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
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="Pack Size">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="display: none">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'description'; ?>
                                                                        <textarea <?php if($myAction == 'view' ){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control " rows="3"><?php echo @$record->$column; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'approvedPrice'; ?>
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column ?>" class="form-control" placeholder="Price" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'pricingType'; ?>
                                                                        <select <?php if($myAction == 'view' ){echo 'disabled';}?> class="form-control " id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                            <option <?php echo @$record->$column == "Controlled"? 'selected':''; ?> value="Controlled">Controlled</option>
                                                                            <option <?php echo @$record->$column == "Free of Cost"? 'selected':''; ?> value="Free of Cost">Free of Cost</option>
                                                                            <option <?php echo @$record->$column == "De-Controlled"? 'selected':''; ?> value="De-Controlled">De-Controlled</option>
                                                                            <option <?php echo @$record->$column == "As Per SRO"? 'selected':''; ?> value="As Per SRO">As Per SRO</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td style="display: none">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'proposedPrice'; ?>
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php if($myAction <> 'view' ){ ?>
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





                                <div class="col-md-3">
                                    <div class="form-group">

                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Finished Product Specification'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'pharmacopeiaId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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


                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Shelf Life'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'shelfLife'; ?>
                                        <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Shelf Life Unit'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'shelfLifeunit'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option selected value="Year(s)">Year(s)</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Months(s)'?'selected':''; ?> value="Months(s)">Month(s)</option>
                                        </select>
                                    </div>
                                </div>





                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Manufacturing Type'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'regTypeId'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Self Manufacturing</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Contract Manufacturing</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 3?'selected':''; ?> value="3">Import</option>
                                        </select>
                                    </div>
                                </div>
                                <?php if($this->roleId <> 26){ ?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Data Status'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'productStatus'; ?>
                                            <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                <option value="">Select <?php echo @$label; ?></option>
                                                <option <?php echo @$recordsEdit[0]->$column == 1?'selected':''; ?> value="1">Verified</option>
                                                <option <?php echo @$recordsEdit[0]->$column == 2?'selected':''; ?> value="2">Un-Verified</option>
                                                <option <?php echo @$recordsEdit[0]->$column == 3?'selected':''; ?> value="3">Provisionally Verified</option>

                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <?php $label = 'Product Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                            <option value="">Select <?php echo @$label; ?></option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Cancelled'?'selected':''; ?> value="Cancelled">Cancelled</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'De-Activated'?'selected':''; ?> value="De-Activated">De-Activated</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'De-Registered'?'selected':''; ?> value="De-Registered">De-Registered</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Transferred'?'selected':''; ?> value="Transferred">Transferred</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Approved'?'selected':''; ?> value="Approved">Approved</option>
                                            <option <?php echo @$recordsEdit[0]->$column == 'Provisionally Active'?'selected':''; ?> value="Provisionally Active">Provisionally Active</option>

                                        </select>
                                    </div>
                                </div>
                                <?php if($this->roleId <> 26){ ?>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Public'; ?>
                                            <label class="w-100"><?php echo $label; ?></label>
                                            <?php $column = 'isPublic'; ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '1'?'checked':''; ?>  value="1">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '0'?'checked':((@$recordsEdit[0]->$column)!== null?'':'checked'); ?> name="<?php echo @$column; ?>" value="0">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php $label = 'Display to Company'; ?>
                                            <label class="w-100"><?php echo $label; ?></label>
                                            <?php $column = 'isCompany'; ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '1'?'checked':''; ?>  value="1">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" id="<?php echo @$column; ?>" <?php echo @$recordsEdit[0]->$column == '0'?'checked':((@$recordsEdit[0]->$column)!== null?'':'checked'); ?> name="<?php echo @$column; ?>" value="0">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="col-md-12">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <h3 class="card-title">Other Manufacturer</h3>
                                            <div class="card-tools">
                                            </div>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive myFixedTableHeader1" style="height: 300px;">
                                            <?php $myTable = 'tabledetailmanufacturer'; ?>
                                            <table id="<?php echo $myTable; ?>" class="table table-bordered table-striped table-head-fixed" style="width: 100%;">
                                                <thead>
                                                <tr>
                                                    <th>S.#</th>
                                                    <?php if($this->roleId <> 26){ ?>
                                                        <th style="width:30%" >Company</th>
                                                        <?php
                                                    }
                                                    ?>
                                                    <th>Name</th>
                                                    <th>Role</th>
                                                    <th>Address</th>
                                                    <th>Country</th>
                                                    <?php if($myAction <> 'view'){ ?>
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
                                                if(empty($recordsDetailOtherManufacturer))
                                                {
                                                    unset($record);
                                                    @$recordsDetailOtherManufacturer[0]->id = 1;
                                                }
                                                ?>
                                                <?php
                                                if(!empty($recordsDetailOtherManufacturer))
                                                {
                                                    foreach($recordsDetailOtherManufacturer as $record)
                                                    {

                                                        ?>
                                                        <tr>
                                                            <td class="srNo">
                                                                <span><?=$sn?></span>.
                                                                <?php
                                                                $column = 'id'; ?>
                                                                <input type="hidden" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="rowId">
                                                                <input type="hidden" id="<?php echo $myTable; ?>-isDeleted_<?=$sn?>" name="<?php echo $myTable; ?>-isDeleted_detail[]" value="0" class="deleteRow">
                                                            </td>
                                                            <?php if($this->roleId <> 26){ ?>
                                                                <td>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <?php
                                                                            $column = 'comp'; ?>
                                                                            <select style="height: inherit; width: 100%" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>"   class="form-control select2 comp">
                                                                                <option value="">Select Company</option>
                                                                                <?php
                                                                                if(!empty($companies))
                                                                                {
                                                                                    foreach ($companies as $company)
                                                                                    {
                                                                                        ?>
                                                                                        <option data-add="<?php echo $company->companyAddress ?>" value="<?php echo $company->companyName ?>" ><?php echo $company->companyName.' (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                            }
                                                            ?>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'companyName'; ?>
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control cname">
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'role'; ?>
                                                                        <input <?php if($myAction == 'view' ){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $column = 'companyAddress'; ?>
                                                                        <textarea <?php if($myAction == 'view' ){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control cadd" rows="3"><?php echo @$record->$column; ?></textarea>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?php $label = 'Country'; ?>
                                                                        <?php $column = 'companyCountry'; ?>
                                                                        <select <?php if($myAction == 'view' ){echo 'disabled';}?> class="form-control select2" id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]">
                                                                            <option value="">Select <?php echo @$label; ?></option>
                                                                            <?php
                                                                            if(!empty($countries))
                                                                            {
                                                                                foreach ($countries as $detail)
                                                                                {
                                                                                    ?>
                                                                                    <option value="<?php echo $detail->id ?>" <?php if($detail->id == @$record->$column){ echo 'selected'; } ?>><?php echo $detail->countryName ?></option>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <?php if($myAction <> 'view' ){ ?>
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

                                <?php if($this->roleId <> 26){ ?>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php $label = 'Remarks'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'submissionRemarks'; ?>
                                            <textarea  name="<?php echo @$column; ?>" id="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php $label = 'Ref Document Number'; ?>
                                            <label><?php echo $label; ?></label>
                                            <?php $column = 'refDocNo'; ?>
                                            <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="col-md-6 d-none">
                                    <div class="form-group">
                                        <?php $label = 'Status'; ?>
                                        <label><?php echo $label; ?></label>
                                        <?php $column = 'registrationStatus'; ?>
                                        <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>">
                                            <option selected value="Submit">Save</option>
                                            <!--<?php if($this->roleId == 26){ ?>
                    <option value="Draft">Save</option>
                    <option value="Submitted">Submit</option>
                    <?php } ?>
                    <?php if($this->roleId <> 26){ ?>
                    <option value="Under Review">Save</option>
                    <option value="Review Complete">Review Complete</option>
                    <option value="Approved">Approve</option>
                    <option value="Referred Back To Company">Send Back to Applicant</option>
                    <?php } ?>
                      -->
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php }?>
                    <!-- /.card-body hello-->
                    <div class="card-footer">
                        <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input type="submit"  class="btn btn-primary" value="Submit"> <input type="submit"  class="btn btn-primary" value="Submit&Keep">';}?>
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

<script type="text/javascript">
    var prefix_Sorter = function(results) {
        if (!results || results.length == 0)
            return results

        // Find the open select2 search field and get its value
        var term = document.querySelector('.select2-search__field').value.toLowerCase()
        if (term.length == 0)
            return results

        return results.sort(function(a, b) {
            aHasPrefix = a.text.toLowerCase().indexOf(term) == 0
            bHasPrefix = b.text.toLowerCase().indexOf(term) == 0

            return bHasPrefix - aHasPrefix // If one is prefixed, push to the top. Otherwise, no sorting.
        })
    }
    loadMyTable('table', true, 15);

    function initailizeSelect2(){

        $(".select2_el").select2({
            ajax: {
                url: "ajaxfile.php",
                type: "post",
                dataType: 'json',
                delay: 250,
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    }
    //loadMyTable('tabledetailinn', false, -1);
    loadBasicTable('tabledetailinn');
    $('#tabledetailinn').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailinn';
        var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
        $("td :input", row).val("");

        $("td.qtyC", row).text("");
        $("td.rateC", row).text("");
        $("td b.totalValue", row).text("");

        $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
        $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));


        //var lastelement = $('#'+myCurrentTable+' tr:last').find("[name='tabledetailinn-innManual_detail[]']");
        //lastelement.attr('id') = "tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());
        //$("td input.generic", row).val("tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()));
        $('#'+myCurrentTable).DataTable().row.add(row).draw();
        /*
              $("td:eq(3)", row).closest('td').html('<select class="form-control prefixselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'"></select>');
              $( ".prefixselect2" ).last().select2({

                  ajax: {
                      url:"<?php echo base_url(); ?>myController/myAjaxGetOptions",
              method:"POST",
              data:{table:'tbl_unit', columnName:'unit'},
              delay: 250,
              processResults: function (response) {
                  console.log(response)
                  return {
                      results: response
                  };
              },
              cache: true
          }
      });
      */

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbl_unit', columnName:'unit'},
            success:function(data)
            {
                //console.log(data);
                $("td:eq(3)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control prefixunitselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(3).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            },
            complete: function (data) {
                $('.prefixunitselect2').last().select2({ width: '100%' });
            }
        });

        //$('.prefixselect2').select2({ sorter: prefix_Sorter });


        $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });

        var lastgenericid = "tabledetailinn-innManual_"+parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());

        $( ".generic" ).last().attr('id',lastgenericid);

        //alert(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));
        /*$("td input.generic").on("keyup", function(){

            $(this).autocomplete({
                source: generics
            });
        });
        /*$('.generic').on("keyup", function(){
            $(this).autocomplete({
                source: generics
            });
        });*/

    });
    //loadMyTable('tabledetailmanufacturer', false, -1);
    loadBasicTable('tabledetailmanufacturer');
    $('#tabledetailmanufacturer').on( 'click', '.plus', function () {
        var myCurrentTable = 'tabledetailmanufacturer';
        var row = $('#'+myCurrentTable+' tbody>tr:last').clone(true);
        $("td :input", row).val("");
        $("td.qtyC", row).text("");
        $("td.rateC", row).text("");
        $("td b.totalValue", row).text("");

        $("td.srNo span", row).text(parseInt($("td.srNo span", row).text()) + parseInt("1"));
        $("td.srNo input:hidden.rowId", row).val(parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val()) + parseInt("1"));

        $('#'+myCurrentTable).DataTable().row.add(row).draw();

        var lastid = parseInt($('#'+myCurrentTable+' tr:last').find("td.srNo input:hidden").val());


        var lastcompid = "tabledetailmanufacturer-comp_"+lastid;
        var lastcnameid = "tabledetailmanufacturer-companyName_"+lastid;
        var lastcaddid = "tabledetailmanufacturer-companyAddress_"+lastid;

        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGetCompany",
            method:"POST",
            data:{table:'tbls_company', columnName:'companyName'},
            success:function(data)
            {
                $("td:eq(1)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control select2 comp" id="'+lastcompid+'" >'+data+'</select></div></div>');
            },
            complete: function (data) {
                $('#'+lastcompid).on('change', function() {
                    var selectedid = $(this).attr('id').split('_')[1];

                    var cnameid = "#tabledetailmanufacturer-companyName_"+selectedid;
                    var caddid = "#tabledetailmanufacturer-companyAddress_"+selectedid;

                    var cadd = $(this).find('option:selected').attr('data-add');
                    var cname = $(this).find('option:selected').text();
                    $(cnameid).val(cname);
                    $(caddid).val(cadd);
                });
                $('#'+lastcompid).select2({ width: '100%' });
                //  $('.select2:nth-last-child(2)').select2();
            }
        });
        $.ajax({
            url:"<?php echo base_url(); ?>myController/myAjaxGet",
            method:"POST",
            data:{table:'tbls_country', columnName:'countryName'},
            success:function(data)
            {
                $("td:eq(5)", row).closest('td').html('<div class="col-md-12"><div class="form-group"><select class="form-control prefixselect2" name="'+ $('#'+myCurrentTable+' tr:last').find("td").eq(5).children().children().children().attr("name") +'">'+data+'</select></div></div>');
            },
            complete: function (data) {
                // console.log($('.select2').last().attr('name'));
                $('.prefixselect2').last().select2({ width: '100%' });
            }
        });


        //$( ".comp" ).first().attr('id',lastcompid);
        $( ".cname" ).last().attr('id',lastcnameid);
        $( ".cadd" ).last().attr('id',lastcaddid);

        $('[data-mask]').inputmask('dd-mm-yyyy', { 'placeholder': 'dd-mm-yyyy' });
    });


    //loadMyTable('tabledetailproposedpacking', false, -1);
    loadBasicTable('tabledetailproposedpacking');

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
    $(document).ready(function(){

        if($('#searchby').val() == 4){
            $(".filterbox").hide();
            $(".companyfilter").show();
        }else{
            $(".companyfilter").hide();
        }
        $('#searchby').on('change', function() {
            if(this.value == 4){
                $(".filterbox").hide();
                $(".companyfilter").show();
            }else{
                $(".filterbox").show();
                $(".companyfilter").hide();
            }
        });
        $('.comp').on('change', function() {

            var selectedid = $(this).attr('id').split('_')[1];

            var cnameid = "#tabledetailmanufacturer-companyName_"+selectedid;
            var caddid = "#tabledetailmanufacturer-companyAddress_"+selectedid;

            var cadd = $(this).find('option:selected').attr('data-add');
            var cname = $(this).find('option:selected').text();

            $(cnameid).val(cname);
            $(caddid).val(cadd);
        });

        $(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
            $(this).closest(".select2-container").siblings('select:enabled').select2('open');
        });

// steal focus during close - only capture once and stop propogation
        $('select.select2').on('select2:closing', function (e) {
            $(e.target).data("select2").$selection.one('focus focusin', function (e) {
                e.stopPropagation();
            });
        });

        $("#companyAccountId").change(function () {
            $("#companyName").val($(this).find(':selected').data('companyname'));

            $("#companyAddress").val($(this).find(':selected').data('address'));

        });
        var refUnit  = <?php echo json_encode($refunits); ?>;
        $( "#refUnit" ).autocomplete({
            source: refUnit
        });

        var filenum  = <?php echo json_encode($filenumbers); ?>;
        $( "#regFileNo" ).autocomplete({
            source: filenum
        });

        var generics  =  <?php echo json_encode($generics); ?>;

        $('.generic').on("keyup", function(){
            //console.log($(this).val());
            $(this).autocomplete({
                minLength:3,
                source: generics
            });
        });




        $('#regFileNo').on("focusout", function() {
            var fnum = this.value;
            var regExp = /\(([^)]+)\)/;
            var matches = regExp.exec(fnum);

            if(matches[1].startsWith("M-"))
                $( "#meetingNo" ).val(matches[1].split("M-")[1]);
            else
                $( "#meetingNo" ).val('');
        });
        $('#issueDateManual').on("focusout", function() {
            var issuedate = this.value;
            var year  = new Date(issuedate).getFullYear();
            var month = new Date(issuedate).getMonth();
            var day   = new Date(issuedate).getDate();
            var date  = new Date(year +5, month, day -1);
            var vtill = date.toLocaleDateString("en-CA");
            $( "#validTill" ).val(vtill);
        });

        var newtable = $('#newtable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                url: "<?php echo base_url(); ?>myController/registrationData",
                type:"POST",
                error:function(err, status){
                    // what error is seen(it could be either server side or client side.
                    console.log('Error');
                    console.log(err);
                },
            },
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : false,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': 25,
            'autoWidth'    : true,
            'lengthMenu': [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            "dom": 'Blfrtip',
            "oLanguage": {
                "sInfo" : "Showing _START_ to _END_",// text you want show for info section
            },

            'search'       : {'caseInsensitive': false},
            'searchDelay': 10000,
            //'columnDefs'   : [{ 'type': 'html-input', 'targets': ['_all'] }],
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1] }],
            'buttons'      : [{'extend':'copy', 'exportOptions': {'columns': ':visible' }}, {'extend':'csv', 'exportOptions': {'columns': ':visible' }}, {'extend':'excel', 'exportOptions': {'columns': ':visible' }}, {'extend':'pdf', 'exportOptions': {'columns': ':visible' }}, {'extend':'print', 'exportOptions': {'columns': ':visible' }}, 'colvis'],

            initComplete   : function () {
                this.api().columns().every( function () {
                    var that = this;
                    $( 'input', $('#newtable thead tr:eq(1) th').eq( this.index() ) ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            }
        }).buttons().container().appendTo('#newtable_wrapper .col-md-6:eq(0)');
        $('.dataTables_filter input')
            .unbind('keypress keyup')
            .bind('keypress keyup', function(e){
                if ($(this).val().length < 3 && e.keyCode != 13) return;
                newtable.fnFilter($(this).val());
            });


        /*
        $('.dataTables_filter input')
            .off()
            .on('keyup', function() {

                $('#newtable').DataTable().search(this.value.trim(), false, false).draw();
            });

        $('.dataTables_filter input')
            .unbind('keypress keyup')
            .bind('keypress keyup', function(e){
                //if ($(this).val().length < 3 && e.keyCode != 13) return;
                if (e.keyCode == 13)
                    newtable.fnFilter($(this).val());
                else
                    return;
            });
        */

    });
</script>
<script>
    $(document).ready(function() {
        var selValue = $("#pharmacopeiaId").val();
        document.getElementById('pharmacopeiaId').disabled = selValue=='' || selValue=='0' || selValue=='26' ? false : true;
        initTestMethodRich(selValue);

        $("#pharmacopeiaId").on("change",function(){

            var selValue = $("#pharmacopeiaId").val();
            initTestMethodRich(selValue);
        });

        function initTestMethodRich(selValue){
            if(['','0','23','27','28','32','22','26'].includes(selValue))
            {
                if(!$("#testingmethod").is(':visible')) $("#testingmethod").show();
                tinymce.init({selector: '#testingmethod'});
            }
            else{
                tinymce.remove("#testingmethod");
                $("#testingmethod").hide();
            }
        }
    });
</script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>