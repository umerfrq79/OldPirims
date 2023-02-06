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
                  //echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New Company</a>';
                ?>
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
                  <th>Unique No</th>
                  <th>Category</th>
                  <th>User Type</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Address</th>
                  <th>NTN / SECP No. / CNIC</th>
                  <th>DSL No.</th>
                  <th>Email</th>
                  <th>Webiste</th>
                  <th>Province</th>
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
                    <td><?php echo $record->companyUniqueNo; ?></td>
                    <td><?php echo $record->companyCategory; ?></td>
                    <td><?php echo $record->companyUserType; ?></td>
                    <td><?php echo $record->companyName; ?></td>
                    <td><?php echo $record->companyType; ?></td>
                    <td><?php echo $record->companyAddress; ?></td>
                    <td><?php echo $record->companyNTN; ?></td>
                    <td><?php echo $record->dslNo; ?></td>
                    <td><?php echo $record->email; ?></td>
                    <td><?php echo $record->website; ?></td>
                    <td><?php echo $record->stateName; ?></td>
                    <td class="text-center">
                      <b><h4><span <?php if($record->status == "Active"){echo "class='badge bg-success'";} if($record->status == "Inactive"){echo "class='badge bg-warning'";} if($record->status == "Pending"){echo "class='badge bg-blue'";} if($record->status == "Suspended"){echo "class='badge bg-gray'";} if($record->status == "Blocked"){echo "class='badge badge-danger'";} if($record->status == "Rejected"){echo "class='badge badge-danger'";} ?>><?php echo $record->status; ?></span></h4></b>
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
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/delete/'.$record->id; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')"><i class="fa fa-trash"></i></a>
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
                  <?php $label = 'Category'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'companyCategory'; ?>
                  <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                    <option value="Pharma Industry" <?php if('Pharma Industry' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Pharma Industry</option>
                    <option disabled value="HOTC Industry" <?php if('HOTC Industry' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>HOTC Industry</option>
                    <option disabled value="MDMC Industry" <?php if('MDMC Industry' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>MDMC Industry</option>
                    <option disabled value="Distributor" <?php if('Distributor' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Distributor</option>
                    <option disabled value="Retailer" <?php if('Retailer' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Retailer</option>
                    <option disabled value="Institution" <?php if('Institution' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Institution</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Sub Category'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'companySubCategory'; ?>
                  <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                    <option value="Manufacturer" <?php if('Manufacturer' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Manufacturer</option>
                    <option value="Importer" <?php if('Importer' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Importer</option>
                  </select>
                </div>
              </div>

              <div class="col-12" id="area1">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">General Information</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'User Type'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyUserType'; ?>
                          <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                            <option value="" <?php if('' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                            <option value="New Applicant" <?php if('New Applicant' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>New Applicant</option>
                            <option value="Existing Applicant" <?php if('Existing Applicant' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Existing Applicant</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Company Name / Name'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyName'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Company Type'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyType'; ?>
                          <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                            <option value="Private Limited" <?php if('Private Limited' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Private Limited</option>
                            <option value="Sole Proprietor" <?php if('Sole Proprietor' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Sole Proprietor</option>
                            <option value="Partnership" <?php if('Partnership' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Partnership</option>
                            <option value="Public Limited" <?php if('Public Limited' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Public Limited</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'NTN / SECP No. / CNIC'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyNTN'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Address'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyAddress'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <!-- <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Company Email'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'companyEmail'; ?>
                          <input type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div> -->

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Email (will be used to login)'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'email'; ?>
                          <input type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Website'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'website'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Phone'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'phone'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Province'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'stateId'; ?>
                          <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                            <option value="">Select <?php echo @$label; ?></option>
                            <?php
                              if(!empty($state))
                              {
                                foreach ($state as $record)
                                {
                                    ?>
                                    <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->stateName ?></option>
                                    <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Country'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'countryId'; ?>
                          <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                            <option value="">Select <?php echo @$label; ?></option>
                            <?php
                              if(!empty($country))
                              {
                                foreach ($country as $record)
                                {
                                    ?>
                                    <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->countryName ?></option>
                                    <?php
                                }
                              }
                            ?>
                          </select>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Head Office Address Link (Google Map URL)'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'googleMapURL'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Latitute'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'latitude'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Longitude'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'longitude'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Contact Person Name'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'contactPersonName'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Contact Person Phone'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'contactPersonPhone'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Contact Person Designation'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'contactPersonDesignation'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Contact Person Email'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'contactPersonEmail'; ?>
                          <input type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <?php $label = 'Brief Description'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'description'; ?>
                          <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

              <div class="col-12" id="area2" style="display: none;">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Site Information (In Case of Manufacturer)</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                    <div class="row">
                      
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>

              <div class="col-12" id="area3">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">DSL Information (In Case of Importer)</h3>
                    <div class="card-tools">
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'DSL No.'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'dslNo'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'DSL Validity Date'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'dslValidityDate'; ?>
                          <input type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'City'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'cityId'; ?>
                          <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                          <?php $label = 'DSL Issuing Authority'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'dslIssuingAuthority'; ?>
                          <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'DSL Address'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'dslAddress'; ?>
                          <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <?php $label = 'Godown Address'; ?>
                          <label><?php echo $label; ?></label>
                          <?php $column = 'godownAddress'; ?>
                          <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
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
                    <option value="">Select <?php echo @$label; ?></option>
                    <option value="Active" <?php if('Active' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Active</option>
                    <option value="Rejected" <?php if('Rejected' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Rejected</option>
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
</script>