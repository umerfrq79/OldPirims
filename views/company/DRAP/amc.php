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
                <?php if($this->roleId == 26){
                  echo '<a href="'.base_url().$pageTitle[0]->url.'/add'.'" class="btn btn-primary"><i class="fa fa-plus"></i> New AMC</a>';
                }
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
                  <?php if($this->roleId <> 26){?>
                  <th>Company</th>
                  <?php } ?>
                  <th>Product Name</th>
                  <th>Dosage Form</th>
                  <th>Batch No.</th>
                  <th>Batch Size</th>
                  <th>Mfg. Date</th>
                  <th>Exp. Date</th>
                  <th>Pack Size</th>
                  <th>Qty (Packs)</th>
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
                    <?php if($this->roleId <> 26){?>
                    <td><?php echo $record->companyName; ?></td>
                    <?php } ?>
                    <td><?php echo $record->approvedName; ?></td>
                    <td><?php echo $record->dosageName; ?></td>
                    <td><?php echo $record->batchNo; ?></td>
                    <td><?php echo $record->batchSize; ?></td>
                    <td><?php echo $record->mfgDate; ?></td>
                    <td><?php echo $record->expDate; ?></td>
                    <td><?php echo $record->packSize; ?></td>
                    <td><?php echo $record->qty; ?></td>
                    <td class="text-center">
                      <b><h4><span <?php if($record->amcStatus == "Submitted"){echo "class='badge bg-success'";} if($record->amcStatus == "Draft"){echo "class='badge bg-warning'";} ?>><?php echo $record->amcStatus; ?></span></h4></b>
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
                        <?php if($record->amcStatus <> 'Submitted'){ ?>
                        <a href="<?php echo base_url().$pageTitle[0]->url.'/edit/'.$record->id; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this record?')"><i class="fa fa-pencil-alt"></i></a>
                        <?php } ?>
                        <?php if($record->amcStatus == 'Draft'){ ?>
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
            <div class="row">

              <?php if($myAction == 'add'){ ?>
              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Product'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'productId'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="">Select <?php echo @$label; ?></option>
                    <?php
                      if(!empty($products))
                      {
                        foreach ($products as $record)
                        {
                            ?>
                            <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->approvedName ?></option>
                            <?php
                        }
                      }
                    ?>
                  </select>
                </div>
              </div>
              <?php } ?>

              <?php if($myAction <> 'add'){ ?>
              <div class="col-md-12">
                <div class="card card-secondary border-secondary card-tabs" style="border: 3px solid;">
                  <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#tab1">Product Info</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab2">Production Detail</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" data-toggle="pill" href="#tab3">Consumption Detail</a>
                      </li>
                    </ul>
                  </div>
                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane fade show active" id="tab1">

                        <div class="row" style="float: left; width: 100%;">

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Country'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'countryId'; ?>
                              <select disabled <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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

                          <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Label Claim'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'labelClaim'; ?>
                              <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
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
                                    <th>Description of Pack</th>
                                    <th>Proposed Price</th>
                                    <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                    <!-- <th class="text-center">Action</th> -->
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
                                            <input disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO">
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'description'; ?>
                                            <textarea disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> id="<?php echo $myTable; ?>-<?php echo @$column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo @$column; ?>_detail[]" class="form-control required" rows="3"><?php echo @$record->$column; ?></textarea>
                                          </div>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <?php $column = 'proposedPrice'; ?>
                                            <input disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="number" id="<?php echo $myTable; ?>-<?php echo $column; ?>_<?=$sn?>" name="<?php echo $myTable; ?>-<?php echo $column; ?>_detail[]" value="<?php echo @$record->$column; ?>" class="form-control" placeholder="As per SRO" style="text-align: right; direction: ltr;" step="any" min="0">
                                          </div>
                                        </div>
                                      </td>
                                      <?php if($myAction <> 'view' && $this->roleId == 26){ ?>
                                      <!-- <td class="text-center widthMaxContent">
                                        <div class="btn-group">
                                          <span class="btn btn-primary plus"><i class="fa fa-plus"></i></span>
                                            <span class="btn btn-danger trash"><i class="fa fa-trash"></i></span>
                                        </div>
                                      </td> -->
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
                              <?php $label = 'Paediatric Product'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'paediatricProduct'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Dosage Form'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'dosageFormId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                              <?php $label = 'Route of Admin'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'routeOfAdminId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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
                              <?php $label = 'Strength'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'strength'; ?>
                                <input <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div> -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Reference Unit'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'refUnit'; ?>
                                <input disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'INBASQ'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inbasq'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'INBASQ Unit'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'inbasqUnit'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'ATC Code'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'atcCodeId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
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

                          <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Ingredients'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'ingredients'; ?>
                              <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Product Origin'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'companySubCategory'; ?>
                                <input disabled <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="" value="<?php if(@$recordsEdit[0]->companySubCategory == 'Manufacturer'){echo 'Local';} if(@$recordsEdit[0]->companySubCategory == 'Importer'){echo 'Importer';} ?>" class="form-control required">
                            </div>
                          </div>

                          <!-- <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Manufacturer'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'manufacturerId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($manufacturer))
                                  {
                                    foreach ($manufacturer as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->$record->manufacturerName ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div> -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Generics'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'generics'; ?>
                              <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="0" <?php if('0' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                                <option value="1" <?php if('1' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Conversion Factor'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'conversionFactor'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <!-- <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Primary Packing Description'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'packingDesc'; ?>
                              <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                            </div>
                          </div> -->

                          <!-- <div class="col-md-12">
                            <div class="form-group">
                              <?php $label = 'Secondary Packing Description'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'secondaryPackingDesc'; ?>
                              <textarea disabled <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                            </div>
                          </div> -->

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'ARS'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'ars'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'WHO DDD'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'ddd'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'WHO DDD Unit'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'dddUnit'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'DPP'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'dpp'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Total Packages'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'totalPackages'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Community Packages'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'comunityPackages'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Hospital Packages'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'hospitalPackages'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab2">

                        <div class="row" style="float: left; width: 100%;">

                         <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Product'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'productId'; ?>
                              <select disabled <?php if($myAction == 'view' || $this->roleId <> 26){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                <option value="">Select <?php echo @$label; ?></option>
                                <?php
                                  if(!empty($products))
                                  {
                                    foreach ($products as $record)
                                    {
                                        ?>
                                        <option value="<?php echo $record->id ?>" <?php if($record->id == @$recordsEdit[0]->$column){ echo 'selected'; } ?>><?php echo $record->$record->approvedName ?></option>
                                        <?php
                                    }
                                  }
                                ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Batch No.'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'batchNo'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Mfg. Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'mfgDate'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Batch Size'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'batchSize'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Exp. Date'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'expDate'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Pack Size'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'packSize'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Qty (Packs)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'qty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="number" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required" style="text-align: right; direction: ltr;" step="any" min="0">
                            </div>
                          </div>
                          
                        </div>

                      </div>
                      <div class="tab-pane fade" id="tab3">

                        <div class="row" style="float: left; width: 100%;">

                         <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Distributor'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'distributorName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Distributor (Qty)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'distributorQty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Institution'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'institutionName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Institution (Qty)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'institutionQty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Retailer'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'retailerName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Retailer (Qty)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'retailerQty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-12">
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerName'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer (Qty)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerQty'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer (NIC)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerNIC'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer (Phone)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerPhone'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer (Email)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerEmail'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <?php $label = 'Consumer (City)'; ?>
                              <label><?php echo $label; ?></label>
                              <?php $column = 'consumerCity'; ?>
                                <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control required">
                            </div>
                          </div>
                          
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <?php } ?>

              <div class="col-md-12">
                <div class="form-group">
                  <?php $label = 'Remarks'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'remarks'; ?>
                  <textarea <?php if($myAction == 'view'){echo 'disabled';}?> id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"><?php echo @$recordsEdit[0]->$column; ?></textarea>
                </div>
              </div>

              <div class="col-md-6" style="display: none;">
                <div class="form-group">
                  <?php $label = 'Status'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'amcStatus'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="Save">Save</option>
                    <option value="Submit">Submit</option>
                  </select>
                </div>
              </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <?php if($myAction == 'add' || $myAction == 'edit'){echo '<input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save"> <input type="submit" onclick="return confirm(\'Are you sure you want to submit this record?\')" class="btn btn-success" id="formSubmit" value="Submit">';}?>
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
  loadMyTable('tabledetailproposedpacking', false, -1);

  $("#formSave").click(function() { 
    $('#amcStatus').val('Save');
  });
  $("#formSubmit").click(function() { 
    $('#amcStatus').val('Submit');
  });
</script>