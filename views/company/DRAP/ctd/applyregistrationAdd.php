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
        <a href="<?php echo base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')); ?>" style="color:#f44336;" class="pull-right"><i class="fa fa-arrow-left"></i> <u>Go Back</u></a>
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
        <!-- row -->
        <div class="col-xs-12">
          <!-- col 12 -->
          <form action="<?php echo base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')).'Save'; ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="box box-default">
              <!-- box -->
              <div class="box-header with-border">
                <!-- box header -->
                <h3 class="box-title"><?php echo substr($pageTitle[0]->url, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'), strlen($pageTitle[0]->url)); ?> Details</h3>

                <!-- <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div> -->
                <!-- /.box header -->
              </div>
              <div class="box-body">
                <!-- box body -->
                <div class="row">
                  <div class="col-xs-4">
                  </div>
                  <div class="col-xs-4">
                    <i class="fa fa-circle" style="color: #ff9800; border-radius: 50%; box-shadow: 0px 0px 20px 0px #FF5722;"></i>
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
                  <div class="col-xs-4">
                  </div>
                </div>
                <div class="row">
                  <div class="col-xs-4">
                  </div>
                  <div class="col-xs-4">
                    <span style="margin-left: -5px; margin-right: 63px;">Draft</span>
                    <span style="margin-right: 63px;">Screening</span>
                    <span style="margin-right: 63px;">Review</span>
                    <span>Approval</span>
                  </div>
                  <div class="col-xs-4">
                  </div>
                </div>
                <div class="row">
                  <!-- row -->

                  <div class="col-xs-12">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs" style="background-color: #f1f1f1;">
                              <li class="active"><a href="#tab_1" data-toggle="tab">Application Type</a></li>
                              <!-- <li><a href="#tab_2" data-toggle="tab">Product Info</a></li> -->
                              <!-- <li><a href="#tab_3" data-toggle="tab">Document Submission (CTD)</a></li> -->
                              <!-- <li><a href="#tab_4" data-toggle="tab">Fee Challan</a></li> -->
                            </ul>
                            <div class="tab-content" style="background-color: #f7f7f7 !important; border: 4px solid #bdbdbd !important;">
                              <div class="tab-pane active" id="tab_1" style="background-color: #f7f7f7 !important;">
                                
                                <div class="col-xs-12">

                                  <!-- <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Company Category</label>
                                      <input disabled type="text" id="companyCategory" name="" value="<?php echo $records[0]->companyCategory; ?>" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Company Sub Category</label>
                                      <input disabled type="text" id="companySubCategory" name="" value="<?php echo $records[0]->companySubCategory; ?>" class="form-control required">
                                    </div>
                                  </div> -->

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Establishment License</label>
                                      <input disabled type="text" id="masterId" name="" value="<?php echo $records[0]->licenseType.' &mdash; '.$records[0]->licenseSubType ?>" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Product Origin</label>
                                      <input disabled type="text" id="companyCategory" name="" value="<?php if($records[0]->companySubCategory == 'Manufacturer'){echo 'Local';} if($records[0]->companySubCategory == 'Importer'){echo 'Importer';} ?>" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Manufacturer</label>
                                        <select class="form-control select2" id="manufacturerId" name="manufacturerId">
                                          <option value="0">Select Manufacturer</option>
                                          <?php
                                            if(!empty($manufacturer))
                                            {
                                              foreach ($manufacturer as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->companyName.' ('.$record->siteAddress.')' ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Product Category</label>
                                        <select class="form-control select2" id="productCategoryId" name="productCategoryId">
                                          <option value="0">Select Product Category</option>
                                          <?php
                                            if(!empty($productCategory))
                                            {
                                              foreach ($productCategory as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->productCategory ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <input type="hidden" name="masterId" value="<?php echo $records[0]->id ?>">

                                  <!-- <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Registration Type</label>
                                        <select class="form-control select2" id="registrationTypeId" name="registrationTypeId">
                                          <option value="0">Select Registration Type</option>
                                          <?php
                                            if(!empty($registrationType))
                                            {
                                              foreach ($registrationType as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->registrationSubType ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div> -->

                                  <input type="hidden" name="productOriginId" value="<?php if($records[0]->companySubCategory == 'Manufacturer'){echo '1';} if($records[0]->companySubCategory == 'Importer'){echo '2';} ?>">

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Used For</label>
                                        <select class="form-control select2" id="usedForId" name="usedForId">
                                          <option value="0">Select Used For</option>
                                          <?php
                                            if(!empty($usedFor))
                                            {
                                              foreach ($usedFor as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->usedFor ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                </div>

                              </div>
                              <div class="tab-pane" id="tab_2">

                                <div class="col-xs-12">

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Dosage Form</label>
                                        <select class="form-control select2" id="dosageFormId" name="dosageFormId">
                                          <option value="0">Select Dosage Form</option>
                                          <?php
                                            if(!empty($dosage))
                                            {
                                              foreach ($dosage as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->dosageName ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Pharmacopeia</label>
                                        <select class="form-control select2" id="pharmacopeiaId" name="pharmacopeiaId">
                                          <option value="0">Select Pharmacopeia</option>
                                          <?php
                                            if(!empty($pharmacopeia))
                                            {
                                              foreach ($pharmacopeia as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->pharmacopeia ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> ATC Code</label>
                                        <select class="form-control select2" id="atcCodeId" name="atcCodeId">
                                          <option value="0">Select ATC Code</option>
                                          <?php
                                            if(!empty($atcCode))
                                            {
                                              foreach ($atcCode as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->atcName.' ('.$record->atcCode.')' ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>ATC Code Manual (If Applicable)</label>
                                      <input type="text" id="atcCodeManual" name="atcCodeManual" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Innovator Brand</label>
                                      <input type="text" id="innovatorBrand" name="innovatorBrand" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Innovator Company</label>
                                      <input type="text" id="innovatorCompany" name="innovatorCompany" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Proposed Artwork <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                      <input type="file" id="proposedArtworkPath" name="proposedArtworkPath" value="">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Intended Market</label>
                                        <select class="form-control select2" id="intendedMarketId" name="intendedMarketId">
                                          <option value="0">Select Intended Market</option>
                                          <?php
                                            if(!empty($intendedMarket))
                                            {
                                              foreach ($intendedMarket as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->intendedMarket ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Intended Population</label>
                                        <select class="form-control select2" id="intendedPopulation" name="intendedPopulation">
                                          <option value="0">Select Intended Population</option>
                                          <option value="Adult Male Only">Adult Male Only</option>
                                          <option value="Adult Female Only">Adult Female Only</option>
                                          <option value="Adult">Adult</option>
                                          <option value="Children">Children</option>
                                          <option value="Infant">Infant</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Intended Age Group</label>
                                        <select class="form-control select2" id="intendedAgeGroup" name="intendedAgeGroup">
                                          <option value="0">Select Intended Age Group</option>
                                          <option value="3 Months To 5 Months">3 Months To 5 Months</option>
                                          <option value="6 Months To 11 Months">6 Months To 11 Months</option>
                                          <option value="1 Year To 3 Years">1 Year To 3 Years</option>
                                          <option value="4 Years To 5 Years">4 Years To 5 Years</option>
                                          <option value="6 Years To 11 Years">6 Years To 11 Years</option>
                                          <option value="12 Years To 19 Years">12 Years To 19 Years</option>
                                          <option value="20 Years To 39 Years">20 Years To 39 Years</option>
                                          <option value="40 Years To 59 Years">40 Years To 59 Years</option>
                                          <option value="60 Years To 79 Years">60 Years To 79 Years</option>
                                          <option value="80 Years To 99 Years">80 Years To 99 Years</option>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Manufacturer Manual (If Applicable)</label>
                                      <input type="text" id="manufacturerManual" name="manufacturerManual" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Country</label>
                                        <select class="form-control select2" id="countryId" name="countryId">
                                          <option value="0">Select Country</option>
                                          <?php
                                            if(!empty($country))
                                            {
                                              foreach ($country as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>" <?php if($record->id == '1'){ echo 'selected'; } ?>><?php echo $record->countryName ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Route of Admin</label>
                                        <select class="form-control select2" id="routeOfAdminId" name="routeOfAdminId">
                                          <option value="0">Select Route of Admin</option>
                                          <?php
                                            if(!empty($routeOfAdmin))
                                            {
                                              foreach ($routeOfAdmin as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->routeOfAdmin ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Shelf Life</label>
                                        <select class="form-control select2" id="shelfLifeId" name="shelfLifeId">
                                          <option value="0">Select Shelf Life</option>
                                          <?php
                                            if(!empty($shelfLife))
                                            {
                                              foreach ($shelfLife as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>"><?php echo $record->shelfLife ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-6">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Storage Condition</label>
                                        <select class="form-control select2" id="storageConditionId" name="storageConditionId">
                                          <option value="0">Select Storage Condition</option>
                                          <?php
                                            if(!empty($storageCondition))
                                            {
                                              foreach ($storageCondition as $record)
                                              {
                                                  ?>
                                                  <option value="<?php echo $record->id ?>" ><?php echo $record->storageCondition ?></option>
                                                  <?php
                                              }
                                            }
                                          ?>
                                        </select>
                                    </div>
                                  </div>

                                  <div class="col-xs-3">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Strength</label>
                                      <input type="text" id="strength" name="strength" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-3">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Unit</label>
                                      <input type="text" id="unit" name="unit" value="" class="form-control required">
                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Label Claim</label>
                                      <textarea id="labelClaim" name="labelClaim" class="form-control" rows="3"></textarea>
                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Primary Packing Description</label>
                                      <textarea id="packingDesc" name="packingDesc" class="form-control" rows="3"></textarea>
                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    <div class="form-group">
                                      <label><i class="fa fa-asterisk text-danger"></i> Secondary Packing Description</label>
                                      <textarea id="secondaryPackingDesc" name="secondaryPackingDesc" class="form-control" rows="3"></textarea>
                                    </div>
                                  </div>

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title">INN Code</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetailinncode" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>S.#</th>
                                            <th>INN Code</th>
                                            <th>Strength / Potency</th>
                                            <th>Unit</th>
                                            <th>QOS S Part</th>
                                            <th class="text-center">Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td><?=$sn?>.<input type="hidden" id="tabledetailinncode-id_<?=$sn?>" name="tabledetailinncode-id_detail[]" value="<?=$sn?>"></td>
                                              <td>
                                                <select class="form-control select2" id="tabledetailinncode-innCodeId_<?=$sn?>" name="tabledetailinncode-innCodeId_detail[]">
                                                  <option value="0">Select INN Code</option>
                                                  <?php
                                                    if(!empty($innCode))
                                                    {
                                                      foreach ($innCode as $record)
                                                      {
                                                          ?>
                                                          <option value="<?php echo $record->id ?>"><?php echo $record->atcName ?></option>
                                                          <?php
                                                      }
                                                    }
                                                  ?>
                                                </select>
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailinncode-strength_<?=$sn?>" name="tabledetailinncode-strength_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailinncode-unit_<?=$sn?>" name="tabledetailinncode-unit_detail[]" value="" class="form-control required">
                                              </td>
                                              <td><a disabled class="btn btn-success" id=""><i class="fa fa-file-text"></i></a></td>
                                              <td class="text-center widthMaxContent">
                                                <div class="btn-group">
                                                  <i class="btn btn-primary fa fa-plus"></i>
                                                  <i class="btn btn-danger fa fa-trash"></i>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title">Proposed Name</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetailproposedname" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>S.#</th>
                                            <th>Proposed Name</th>
                                            <th class="text-center">Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td><?=$sn?>.<input type="hidden" id="tabledetailproposedname-id_<?=$sn?>" name="tabledetailproposedname-id_detail[]" value="<?=$sn?>"></td>
                                              <td>
                                                <input type="text" id="tabledetailproposedname-proposedName_<?=$sn?>" name="tabledetailproposedname-proposedName_detail[]" value="" class="form-control required">
                                              </td>
                                              <td class="text-center widthMaxContent">
                                                <div class="btn-group">
                                                  <i class="btn btn-primary fa fa-plus"></i>
                                                  <i class="btn btn-danger fa fa-trash"></i>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title">Proposed Price</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetailproposedprice" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>S.#</th>
                                            <th>Pack Size</th>
                                            <th>Proposed Price</th>
                                            <th>Shelf Life</th>
                                            <th class="text-center">Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td><?=$sn?>.<input type="hidden" id="tabledetailproposedprice-id_<?=$sn?>" name="tabledetailproposedprice-id_detail[]" value="<?=$sn?>"></td>
                                              <td>
                                                <input type="text" id="tabledetailproposedprice-packSize_<?=$sn?>" name="tabledetailproposedprice-packSize_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailproposedprice-proposedPrice_<?=$sn?>" name="tabledetailproposedprice-proposedPrice_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailproposedprice-shelfLife_<?=$sn?>" name="tabledetailproposedprice-shelfLife_detail[]" value="" class="form-control required">
                                              </td>
                                              <td class="text-center widthMaxContent">
                                                <div class="btn-group">
                                                  <i class="btn btn-primary fa fa-plus"></i>
                                                  <i class="btn btn-danger fa fa-trash"></i>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title">Domestic Reference / Local Reference</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetaildomesticreference" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>S.#</th>
                                            <th>Brand Name</th>
                                            <th>Registration No.</th>
                                            <th>Product Holder</th>
                                            <th class="text-center">Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td><?=$sn?>.<input type="hidden" id="tabledetaildomesticreference-id_<?=$sn?>" name="tabledetaildomesticreference-id_detail[]" value="<?=$sn?>"></td>
                                              <td>
                                                <input type="text" id="tabledetaildomesticreference-brandName_<?=$sn?>" name="tabledetaildomesticreference-brandName_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetaildomesticreference-registrationNo_<?=$sn?>" name="tabledetaildomesticreference-registrationNo_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetaildomesticreference-productHolder_<?=$sn?>" name="tabledetaildomesticreference-productHolder_detail[]" value="" class="form-control required">
                                              </td>
                                              <td class="text-center widthMaxContent">
                                                <div class="btn-group">
                                                  <i class="btn btn-primary fa fa-plus"></i>
                                                  <i class="btn btn-danger fa fa-trash"></i>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title">International Reference / SRA Reference</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetailinternationalreference" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>S.#</th>
                                            <th>Brand Name</th>
                                            <th>Product Holder</th>
                                            <th>Regulating Body</th>
                                            <th class="text-center">Action</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td><?=$sn?>.<input type="hidden" id="tabledetailinternationalreference-id_<?=$sn?>" name="tabledetailinternationalreference-id_detail[]" value="<?=$sn?>"></td>
                                              <td>
                                                <input type="text" id="tabledetailinternationalreference-brandName_<?=$sn?>" name="tabledetailinternationalreference-brandName_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailinternationalreference-productHolder_<?=$sn?>" name="tabledetailinternationalreference-productHolder_detail[]" value="" class="form-control required">
                                              </td>
                                              <td>
                                                <input type="text" id="tabledetailinternationalreference-regulatingBody_<?=$sn?>" name="tabledetailinternationalreference-regulatingBody_detail[]" value="" class="form-control required">
                                              </td>
                                              <td class="text-center widthMaxContent">
                                                <div class="btn-group">
                                                  <i class="btn btn-primary fa fa-plus"></i>
                                                  <i class="btn btn-danger fa fa-trash"></i>
                                                </div>
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                </div>

                              </div>
                              <div class="tab-pane" id="tab_3">
                                
                                <div class="col-xs-12">
                                
                                  <div class="row">
                                    <div class="col-sm-12">
                                      <h2>Search</h2>
                                      <div class="form-group">
                                        <label for="input-select-node" class="sr-only">Search:</label>
                                        <input type="input" class="form-control" id="input-select-node" placeholder="Search Folder..." value="">
                                      </div>
                                      <div class="form-group">
                                          <button type="button" class="btn btn-success select-node" id="btn-select-node">Select Folder</button>
                                          <button type="button" class="btn btn-danger select-node" id="btn-unselect-node">Unselect Folder</button>
                                      </div>
                                    </div>
                                    <div class="col-sm-4" style="overflow-y: scroll; max-height: 70vh;">
                                      <h2>Folder Structure</h2>
                                      <div id="treeview-selectable" class="treeview"></div>
                                    </div>
                                    <div class="col-sm-8">
                                      <h2>Folder Content</h2>
                                      <div id="selectable-output">
                                          <div class="box-body" style="display:none;" id="div_1">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_1">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_1" href="#headingData_1">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_1" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_1" name="folderData1" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_2">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_2">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_2" href="#headingData_2">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_2" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_2" name="folderData2" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_3">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_3">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_3" href="#headingData_3">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_3" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_3" name="folderData3" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_4">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_4">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_4" href="#headingData_4">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_4" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_4" name="folderData4" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_5">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_5">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_5" href="#headingData_5">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_5" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_5" name="folderData5" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_6">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_6">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_6" href="#headingData_6">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_6" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_6" name="folderData6" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_7">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_7">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_7" href="#headingData_7">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_7" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_7" name="folderData7" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_8">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_8">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_8" href="#headingData_8">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_8" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_8" name="folderData8" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_9">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_9">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_9" href="#headingData_9">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_9" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_9" name="folderData9" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_10">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_10">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_10" href="#headingData_10">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_10" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_10" name="folderData10" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_11">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_11">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_11" href="#headingData_11">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_11" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_11" name="folderData11" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_12">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_12">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_12" href="#headingData_12">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_12" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_12" name="folderData12" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_13">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_13">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_13" href="#headingData_13">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_13" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_13" name="folderData13" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_14">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_14">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_14" href="#headingData_14">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_14" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_14" name="folderData14" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_15">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_15">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_15" href="#headingData_15">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_15" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_15" name="folderData15" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_16">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_16">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_16" href="#headingData_16">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_16" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_16" name="folderData16" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_17">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_17">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_17" href="#headingData_17">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_17" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_17" name="folderData17" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_18">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_18">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_18" href="#headingData_18">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_18" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_18" name="folderData18" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_19">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_19">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_19" href="#headingData_19">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_19" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_19" name="folderData19" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_20">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_20">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_20" href="#headingData_20">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_20" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_20" name="folderData20" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_21">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_21">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_21" href="#headingData_21">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_21" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_21" name="folderData21" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_22">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_22">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_22" href="#headingData_22">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_22" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_22" name="folderData22" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_23">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_23">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_23" href="#headingData_23">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_23" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_23" name="folderData23" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_24">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_24">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_24" href="#headingData_24">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_24" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_24" name="folderData24" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_25">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_25">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_25" href="#headingData_25">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_25" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_25" name="folderData25" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_26">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_26">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_26" href="#headingData_26">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_26" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_26" name="folderData26" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_27">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_27">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_27" href="#headingData_27">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_27" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_27" name="folderData27" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_28">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_28">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_28" href="#headingData_28">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_28" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_28" name="folderData28" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_29">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_29">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_29" href="#headingData_29">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_29" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_29" name="folderData29" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_30">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_30">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_30" href="#headingData_30">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_30" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_30" name="folderData30" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_32">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_32">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_32" href="#headingData_32">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_32" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_32" name="folderData32" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_33">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_33">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_33" href="#headingData_33">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_33" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_33" name="folderData33" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_34">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_34">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_34" href="#headingData_34">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_34" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_34" name="folderData34" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_35">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_35">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_35" href="#headingData_35">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_35" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_35" name="folderData35" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_36">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_36">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_36" href="#headingData_36">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_36" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_36" name="folderData36" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_37">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_37">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_37" href="#headingData_37">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_37" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_37" name="folderData37" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_38">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_38">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_38" href="#headingData_38">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_38" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_38" name="folderData38" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_39">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_39">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_39" href="#headingData_39">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_39" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_39" name="folderData39" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_40">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_40">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_40" href="#headingData_40">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_40" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_40" name="folderData40" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_41">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_41">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_41" href="#headingData_41">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_41" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_41" name="folderData41" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_42">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_42">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_42" href="#headingData_42">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_42" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_42" name="folderData42" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_43">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_43">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_43" href="#headingData_43">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_43" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_43" name="folderData43" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_44">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_44">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_44" href="#headingData_44">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_44" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_44" name="folderData44" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_45">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_45">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_45" href="#headingData_45">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_45" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_45" name="folderData45" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_46">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_46">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_46" href="#headingData_46">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_46" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_46" name="folderData46" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_47">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_47">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_47" href="#headingData_47">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_47" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_47" name="folderData47" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_48">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_48">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_48" href="#headingData_48">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_48" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_48" name="folderData48" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_54">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_54">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_54" href="#headingData_54">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_54" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_54" name="folderData54" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_55">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_55">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_55" href="#headingData_55">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_55" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_55" name="folderData55" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_56">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_56">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_56" href="#headingData_56">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_56" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_56" name="folderData56" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_57">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_57">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_57" href="#headingData_57">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_57" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="form-group">
                                                <label>Content</label>
                                                <textarea id="folderData_57" name="folderData57" class="form-control" rows="10" cols="80"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_49">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_49">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_49" href="#headingData_49">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_49" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="col-xs-12">
                                                <h4>MODULE 2.3 - QUALITY OVERALL SUMMARY: PRODUCT DOSSIER (QOS-PD)</h4>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">Summary of product information</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailsummary" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th></th>
                                                        <th></th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-inn_<?=$sn?>" name="" value="Non-proprietary name(s) of the Drug Product" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-innValue_<?=$sn?>" name="innValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-brandName_<?=$sn?>" name="" value="Proprietary name(s) of the Drug Product" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-brandNameValue_<?=$sn?>" name="brandNameValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-innSubstance_<?=$sn?>" name="" value="International non-proprietary name(s) of the Drug Substance, including form (salt, hydrate, polymorph)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-innSubstanceValue_<?=$sn?>" name="innSubstanceValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-applicantName_<?=$sn?>" name="" value="Applicant name and address " class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-applicantNameValue_<?=$sn?>" name="applicantNameValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-dosageForm_<?=$sn?>" name="" value="Dosage form" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-dosageFormValue_<?=$sn?>" name="dosageFormValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-strength_<?=$sn?>" name="" value="Strength" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-strengthValue_<?=$sn?>" name="strengthValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-route_<?=$sn?>" name="" value="Route of administration" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-routeValue_<?=$sn?>" name="routeValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-indication_<?=$sn?>" name="" value="Proposed indication(s)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-indicationValue_<?=$sn?>" name="indicationValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-contactPerson_<?=$sn?>" name="" value="Primary Contact person responsible for this application" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-contactPersonValue_<?=$sn?>" name="contactPersonValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-jobTitle_<?=$sn?>" name="" value="Contact person's job title" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-jobTitleValue_<?=$sn?>" name="jobTitleValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-address_<?=$sn?>" name="" value="Corresponding address" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-addressValue_<?=$sn?>" name="addressValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-townCity_<?=$sn?>" name="" value="Town/City/Country" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-townCityValue_<?=$sn?>" name="townCityValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-email_<?=$sn?>" name="" value="Contact person's email address" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-emailValue_<?=$sn?>" name="emailValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsummary-phone_<?=$sn?>" name="" value="Contact person's phone number" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailsummary-phoneValue_<?=$sn?>" name="phoneValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">Other Introductory information (Related dossiers (e.g. Drug Product(s) with the same Drug Substance(s) submitted to DRAP:)</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailotherinfo" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Brand Name</th>
                                                        <th>Date of Submission in DRAP</th>
                                                        <th>Drug Substance, strength, dosage form(eg. Abacavir (as sulphate) 300 mg tablets)</th>
                                                        <th>Drug Substance manufacturer(including address if same supplier as current dossier)</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailotherinfo-id_<?=$sn?>" name="tabledetailotherinfo-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailotherinfo-brandName_<?=$sn?>" name="tabledetailotherinfo-brandName_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="date" id="tabledetailotherinfo-submissionDate_<?=$sn?>" name="tabledetailotherinfo-submissionDate_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailotherinfo-drugSubstance_<?=$sn?>" name="tabledetailotherinfo-drugSubstance_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailotherinfo-substanceMfg_<?=$sn?>" name="tabledetailotherinfo-substanceMfg_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">Identify available literature references for the Drug Substance and Drug Product</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailliterature" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>Publication(s)</th>
                                                        <th>Monograph exists/does not exist/exists in other combination only</th>
                                                        <th>Most recent edition/volume consulted</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td colspan="3">API status in pharmacopoeias and fora:</td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="USP" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographAPIUSP_<?=$sn?>" name="monographAPIUSP">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionAPIUSP_<?=$sn?>" name="editionAPIUSP" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="BP" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographAPIBP_<?=$sn?>" name="monographAPIBP">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionAPIBP_<?=$sn?>" name="editionAPIBP" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="Ph.Eur" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographAPIPhEur_<?=$sn?>" name="monographAPIPhEur">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionAPIPhEur_<?=$sn?>" name="editionAPIPhEur" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="Ph.Int" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographAPIPhInt_<?=$sn?>" name="monographAPIPhInt">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionAPIPhInt_<?=$sn?>" name="editionAPIPhInt" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="Other (e.g. JP)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographAPIOther_<?=$sn?>" name="monographAPIOther">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionAPIOther_<?=$sn?>" name="editionAPIOther" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="3">FPP status in pharmacopoeias and fora:</td>
                                                        </tr>

                                                       <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="USP" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographFPPUSP_<?=$sn?>" name="monographFPPUSP">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionFPPUSP_<?=$sn?>" name="editionFPPUSP" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="BP" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographFPPBP_<?=$sn?>" name="monographFPPBP">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionFPPBP_<?=$sn?>" name="editionFPPBP" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="Ph.Int" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographFPPPhInt_<?=$sn?>" name="monographFPPPhInt">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionFPPPhInt_<?=$sn?>" name="editionFPPPhInt" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="Other (e.g. JP)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <select class="form-control select2" id="tabledetailliterature-monographFPPOther_<?=$sn?>" name="monographFPPOther">
                                                              <option value="No">No</option>
                                                              <option value="Yes">Yes</option>
                                                            </select>
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionFPPOther_<?=$sn?>" name="editionFPPOther" value="" class="form-control required">
                                                          </td>
                                                        </tr> 

                                                        <tr>
                                                          <td colspan="3">Other reference texts (e.g. public access reports): Mandatory for new drugs or drug products for which official monograph does not exist</td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailliterature-publication_<?=$sn?>" name="" value="<e.g. WHOPARs, EPARs, FDA review, PMDA review report>)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-monographOtherRef_<?=$sn?>" name="monographOtherRef" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailliterature-editionOtherRef_<?=$sn?>" name="editionOtherRef" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <?php $sn++ ?>
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
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_50">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_50">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_50" href="#headingData_50">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_50" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="col-xs-12">
                                                <h4>2.3.A.1 Facilities and Equipment</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>Facilities and Equipment</label>
                                                  <textarea id="facilityEquipments" name="facilityEquipments" class="form-control" rows="7" placeholder=""></textarea>

                                                </div>
                                              </div>



                                              <div class="col-xs-12">
                                                <h4>2.3.A.2 Adventitious Agents Safety Evaluation</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>Adventitious Agents Safety Evaluation</label>
                                                  <textarea readonly id="agentSafetyEval" name="agentSafetyEval" class="form-control" rows="7" placeholder="Optional Part"></textarea>

                                                </div>
                                              </div>


                                              <div class="col-xs-12">
                                                <h4>2.3.A.3 Excipients</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>Excipients</label>
                                                  <textarea id="appendixExcipients" name="appendixExcipients" class="form-control" rows="7" placeholder="<For excipient(s) used for the first time in a drug product or by a new route of administration, full details of manufacture, characterization, and controls, with cross references to supporting safety (non-clinical and/or clinical) data  should be provided>"></textarea>

                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_52">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_52">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_52" href="#headingData_52">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_52" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="col-xs-12">
                                                <h4>2.3.R REGIONAL INFORMATION</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.R.1 Production Documentation</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.R.1.1 Executed Production Documents</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>Executed Production Documents</label>
                                                  <textarea id="execProductionDoc" name="execProductionDoc" class="form-control" rows="7" placeholder="<Provide copy of Batch Manufacturing Record (BMR) for all the batches of drug product for which stability studies data is provided in Module 3 section 3.2.P.8.3>"></textarea>

                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.R.1.2 Master Production Documents</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>Master Production Documents</label>
                                                  <textarea id="masterProductionDoc" name="masterProductionDoc" class="form-control" rows="7" placeholder="<For applications of locally manufactured drug product(s), provide blank master production document / batch manufacturing record to be used during the commercial manufacturing of the applied product>

                          <For applications of imported drug product(s) the submission of master production documents is not required>
                          "></textarea>

                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.R.2 Analytical Procedures and Validation Information for Drug Product</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">ANALYTICAL PROCEDURES AND VALIDATION INFORMATION SUMMARIES</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailanalyticalprocsummary" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-hplcMethod_<?=$sn?>" name="" value="HPLC Method Summary" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-volumePage_<?=$sn?>" name="" value="Volume /Page" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailanalyticalprocsummary-volumePageValue_<?=$sn?>" name="volumePageValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-methodName_<?=$sn?>" name="" value="Method Name" class="form-control required">
                                                          </td>
                                                          <td colspan="3">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-methodNameValue_<?=$sn?>" name="methodNameValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-methodCode_<?=$sn?>" name="" value="Method Code" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailanalyticalprocsummary-methodCodeValue_<?=$sn?>" name="methodCodeValue" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-methodDate_<?=$sn?>" name="" value="Method Date" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="date" id="tabledetailanalyticalprocsummary-methodDateValue_<?=$sn?>" name="methodDateValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-columnTemp_<?=$sn?>" name="" value="Column(s) /Temprature (If other than ambient)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-columnTempValue_<?=$sn?>" name="columnTempValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-mobilePhase_<?=$sn?>" name="" value="Mobile Phase (Specify gradient program, if applicable)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-mobilePhaseValue_<?=$sn?>" name="mobilePhaseValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-detector_<?=$sn?>" name="" value="Detector (and wavelength, if applicable)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-detectorValue_<?=$sn?>" name="detectorValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-flowRate_<?=$sn?>" name="" value="Flow rate" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-flowRateValue_<?=$sn?>" name="flowRateValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-injectionVol_<?=$sn?>" name="" value="Injection volume" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-injectionVolValue_<?=$sn?>" name="injectionVolValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-sampleSolution_<?=$sn?>" name="" value="Sample solution preparation and concentration
                            (expressed as mg/ml, let this be termed “A”)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-sampleSolutionValue_<?=$sn?>" name="sampleSolutionValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-refSolution_<?=$sn?>" name="" value="Reference solution preparation and concentration
                            (expressed as mg/ml and as % of “A”)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-refSolutionValue_<?=$sn?>" name="refSolutionValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-sysSuitablity_<?=$sn?>" name="" value="System suitability solution concentration
                            (expressed as mg/ml and as % of “A”):" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-sysSuitablityValue_<?=$sn?>" name="sysSuitablityValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-suitabilityTest_<?=$sn?>" name="" value="System suitability tests (tests and acceptance criteria)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-suitabilityTestValue_<?=$sn?>" name="suitabilityTestValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailanalyticalprocsummary-quantification_<?=$sn?>" name="" value="Method of quantification (e.g. against API or impurity reference standard(s))" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailanalyticalprocsummary-quantificationValue_<?=$sn?>" name="quantificationValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">Validation Summary</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailvalidationsummary" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th></th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-volPage_<?=$sn?>" name="" value="Validation Summary" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-volPage1_<?=$sn?>" name="" value="" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailvalidationsummary-volPage1Value_<?=$sn?>" name="volPage1Value" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="6">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-analytes_<?=$sn?>" name="" value="Analytes" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-rTime_<?=$sn?>" name="" value="Typical retention times (RT) " class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-rTime1_<?=$sn?>" name="rTime1" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-rTime2_<?=$sn?>" name="rTime2" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-rTime3_<?=$sn?>" name="rTime3" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-rTime4_<?=$sn?>" name="rTime4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-relativeTime_<?=$sn?>" name="" value="Relative retention times (RTImp./RTAPI or Int. Std.)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-relativeTime1_<?=$sn?>" name="relativeTime1" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-relativeTime2_<?=$sn?>" name="relativeTime2" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-relativeTime3_<?=$sn?>" name="relativeTime3" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-relativeTime4_<?=$sn?>" name="relativeTime4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-respFactor_<?=$sn?>" name="" value="Relative response factor (RFImp./RFAPI)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-respFactor1_<?=$sn?>" name="respFactor1" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-respFactor2_<?=$sn?>" name="respFactor2" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-respFactor3_<?=$sn?>" name="respFactor3" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-respFactor4_<?=$sn?>" name="respFactor4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="6">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-specificity_<?=$sn?>" name="" value="Specificity" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-lineartyRange_<?=$sn?>" name="" value="Linearity / Range" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-lineartyRange1_<?=$sn?>" name="" value="Number of concentrations:Range (expressed as mg/ml and as % “A”):Slope:Y-intercept:Correlation coefficient (r2)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-lRValue1_<?=$sn?>" name="lRValue1" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-lRValue2_<?=$sn?>" name="lRValue2" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-lRValue3_<?=$sn?>" name="lRValue3" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-lRValue4_<?=$sn?>" name="lRValue4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-accuracy_<?=$sn?>" name="" value="Accuracy" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-accuracy0_<?=$sn?>" name="" value="Conc.(s) (expressed as mg/ml and as % “A”):Number of replicates:Percent recovery (avg/RSD)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-accuracy1_<?=$sn?>" name="accuracy1" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-accuracy2_<?=$sn?>" name="accuracy2" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-accuracy3_<?=$sn?>" name="accuracy3" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailvalidationsummary-accuracy4_<?=$sn?>" name="accuracy4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-precision_<?=$sn?>" name="" value="Precision /Repeatability:(intra-assay precision)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-precision0_<?=$sn?>" name="" value="Conc.(s) (expressed as mg/ml and as % “A”):Number of replicates:Result (avg/RSD)" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-precision1_<?=$sn?>" name="precision1" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-precisionInter_<?=$sn?>" name="" value="Precision /Intermediate Precision:(days/analysts/equipment)" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-precisionInter0_<?=$sn?>" name="" value="Parameter(s) altered:Result (avg/RSD)" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-precisionInter1_<?=$sn?>" name="precisionInter1" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-lod_<?=$sn?>" name="" value="Limit of Detection (LOD): (expressed as mg/ml and as % “A”)" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-lod_<?=$sn?>" name="lod" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-loq_<?=$sn?>" name="" value="Limit of Quantitation (LOQ): (expressed as mg/ml and as % “A”)" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-loq_<?=$sn?>" name="loq" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-robustness_<?=$sn?>" name="" value="Robustness" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailvalidationsummary-robustness0_<?=$sn?>" name="" value="Stability of solutions:Other variables/effects" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-robustness1_<?=$sn?>" name="robustness1" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-chromatograms_<?=$sn?>" name="" value="Typical chromatograms or spectra may be found in" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-chromatograms_<?=$sn?>" name="chromatograms" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td colspan="2">
                                                            <input readonly type="text" id="tabledetailvalidationsummary-responsible_<?=$sn?>" name="" value="Company(s) responsible for method validation" class="form-control required">
                                                          </td>
                                                          <td colspan="4">
                                                            <input type="text" id="tabledetailvalidationsummary-responsible_<?=$sn?>" name="responsible" value="" class="form-control required">
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_51">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_51">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_51" href="#headingData_51">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_51" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="col-xs-12">
                                                <h4>2.3.P DRUG PRODUCT or Finished Pharmaceutical Product (FPP) </h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.1 Description and Composition of the Drug Product </h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Description of the Drug Product</label>
                                                  <textarea id="descOfPharmaDrugProd" name="descOfPharmaDrugProd" class="form-control" rows="5" placeholder="<e.g The proposed XYZ 50-mg tablets are available as white, oval, film coated immediate release tablets, debossed with‘50’ on one side and a break line on the other side> "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>(b) Composition of the Drug Product </h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>i.  Composition, i.e. list of all components of the Drug Product and their amounts on a per unit basis and percentage basis (including individual components of mixtures prepared in-house (e.g. coatings) and overages, if any) </h4>
                                              </div>    
                                              
                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(b) Composition of the Drug Product</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailcompositionofdrugproduct" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Component and quality standard (and grade, if applicable)</th>
                                                        <th>Function</th>
                                                        <th>Quant. per unit or per mL</th>
                                                        <th>Percentage (%)</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailcompositionofdrugproduct-id_<?=$sn?>" name="tabledetailcompositionofdrugproduct-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailcompositionofdrugproduct-componentAndQty_<?=$sn?>" name="tabledetailcompositionofdrugproduct-componentAndQty_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcompositionofdrugproduct-function_<?=$sn?>" name="tabledetailcompositionofdrugproduct-function_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcompositionofdrugproduct-perUnitQty_<?=$sn?>" name="tabledetailcompositionofdrugproduct-perUnitQty_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcompositionofdrugproduct-percentage_<?=$sn?>" name="tabledetailcompositionofdrugproduct-percentage_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (c) Description of accompanying reconstitution diluent(s), if applicable</label>
                                                  <textarea id="descOfReconstDiluents" name="descOfReconstDiluents" class="form-control" rows="5" placeholder="<Provide summarized information (including type of diluent, its composition, quantity or volume, specifications (as applicable) and regulatory status in Pakistan (as applicable) for the diluent which is to be provided along with the applied drug>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (d) Type of container closure system used for the Drug Product and accompanying reconstitution diluent, if applicable</label>
                                                  <textarea id="typeOfContainerSys" name="typeOfContainerSys" class="form-control" rows="5" placeholder="<The container-closure used for the drug product (and accompanying reconstitution diluent, if applicable) should be briefly described, with further details provided under 3.2.P.7 Container-closure system>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2 Pharmaceutical Development</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.1 Components of the Drug Product</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.1.1 Drug Substance</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> i.  compatibility of the Drug Substance(s) with excipients listed in 2.3.P.1</label>
                                                  <textarea id="compatibilityOfDrugSubstance" name="compatibilityOfDrugSubstance" class="form-control" rows="5" placeholder="<If the qualitative composition of the formulation is not similar to innovator / reference product, the drug-excipient compatibility studies should be provided>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> ii. key physicochemical characteristics (e.g. water content, solubility, particle size distribution, polymorphic or solid state form) of the Drug Substance(s) that can influence the performance of the Drug Product</label>
                                                  <textarea id="keyCharacteristics" name="keyCharacteristics" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> or fixed-dose combinations, compatibility of Drug Substance(s) with each other</label>
                                                  <textarea id="fixedDoseCombinations" name="fixedDoseCombinations" class="form-control" rows="5" placeholder="<For combination products, which are not approved by any reference regulatory authority, the compatibility of drug substances with each other should be discussed>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.1.2 Excipients</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Discussion of the choice of excipients listed in 2.3.P.1, their concentrations and characteristics that can influence the Drug Product performance)</label>
                                                  <textarea id="choiceOfExcipients" name="choiceOfExcipients" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.2 Drug Product</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.2.1 Formulation Development</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Summary describing the development of the Drug Product</label>
                                                  <textarea id="summaryOfDevDrugProd" name="summaryOfDevDrugProd" class="form-control" rows="5" placeholder="<Brief discussion on the formulation development procedure adapted for the currently applied Drug Product>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (b) Pharmaceutical equivalence</label>
                                                  <textarea id="pharmaEquivalence" name="pharmaEquivalence" class="form-control" rows="5" placeholder="<The comparison of the developed formulation and the innovator / reference / comparator product including the results of all the quality tests should be submitted and discussed>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>For innovator drug products, the submission of pharmaceutical equivalence is not required.</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> i.  Summary of the results of comparative dissolution profile (where applicable)</label>
                                                  <textarea id="summaryOfDissolutionResults" name="summaryOfDissolutionResults" class="form-control" rows="7" placeholder="<The results of comparative dissolution profile conducted in three BCS media across the physiological pH range along with calculation of similarity factor f2 should be submitted and discussed>
                             

                            <For comparative dissolution profile, the guidelines specified in WHO Technical Report Series No. 992, 2015, Annex 7, Appendix 1 Recommendations for conducting and assessing comparative dissolution profiles and USFDA Guidance for Industry Dissolution Testing of Immediate Release Solid Oral Dosage Forms - Dissolution Profile Comparisons may be followed>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>For innovator drug products, the submission of pharmaceutical equivalence is not required</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.2.2 Overages</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Justification of overages in the formulation(s) described in 2.3.P.1</label>
                                                  <textarea id="justificationOfOverages" name="justificationOfOverages" class="form-control" rows="5" placeholder="<Generally overages are not acceptable unless fully justified>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.2.3 Physicochemical and Biological Properties</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Discussion of the parameters relevant to the performance of the Drug Product (e.g. pH, ionic strength, dissolution, particle size distribution, polymorphism, rheological properties)</label>
                                                  <textarea id="performanceParameters" name="performanceParameters" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>


                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.3 Manufacturing Process Development</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Discussion of the development of the manufacturing process of the Drug Product (e.g. optimization of the process, selection of the method of sterilization)</label>
                                                  <textarea id="devOfManufacturingProcess" name="devOfManufacturingProcess" class="form-control" rows="7" placeholder="<The selection and optimization of the manufacturing process described in 3.2.P.3.3, in particular its critical aspects, should be explained. Any specific manufacturing process development should be provided e.g., sterilization should be explained and justified>
                            <Where relevant, justification for the selection of aseptic processing or other sterilization methods over terminal sterilization should be provided>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.4 Container Closure System</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Discussion of the suitability of the container closure system (described in 2.3.P.7) used for the storage, transportation (shipping) and use of the Drug Product (e.g. choice of materials, protection from moisture and light, compatibility of the materials with the Drug Product)</label>
                                                  <textarea id="suitabilityOfContainer" name="suitabilityOfContainer" class="form-control" rows="7" placeholder="<A brief description of container closure should be included>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (b) For a device accompanying a multi-dose container, a summary of the study results demonstrating the reproducibility of the device (e.g. consistent delivery of the intended volume for the lowest intended dose)</label>
                                                  <textarea id="multiDoseContainer" name="multiDoseContainer" class="form-control" rows="7" placeholder="<e.g. for Dry Powder Inhalers supplied with rotacaps, the studies including uniformity of delivered dose, aerodynamic particle size distribution etc. should be provided>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.2.5 Microbiological Attributes</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Discussion of the compatibility of the Drug Product (e.g. with reconstitution diluent(s) or dosage devices, co-administered Drug Product(s))</label>
                                                  <textarea id="compatibilityOfDrugProduct" name="compatibilityOfDrugProduct" class="form-control" rows="7" placeholder="<Compatibility studies for the dry powder for injections and dry powder for suspension should be performed as per the instructions provided in individual label of the drug product>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.3 Manufacture</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.3.1 Manufacturer(s)</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Name, address and responsibility (e.g. fabrication, packaging, labelling, testing) of each manufacturer, including contractors and each proposed production site or facility involved in manufacturing and testing</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailproductmanufacturer" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Name and address (include block(s)/unit(s))</th>
                                                        <th>Responsibility</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailproductmanufacturer-id_<?=$sn?>" name="tabledetailproductmanufacturer-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductmanufacturer-mfgNameAddress_<?=$sn?>" name="tabledetailproductmanufacturer-mfgNameAddress_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductmanufacturer-mfgResponsibility_<?=$sn?>" name="tabledetailproductmanufacturer-mfgResponsibility_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (b) Good Manufacturing Practices (GMP) certificate of all manufacturing sites mentioned above should be provided in Module 1</label>
                                                  <textarea id="gmpOfAllMfgSites" name="gmpOfAllMfgSites" class="form-control" rows="5" placeholder="<For applications of locally manufactured drug products, GMP certificate of all sites should be
                            provided in Module 1>

                            <For applications of imported drug products, Certificate of Pharmaceutical Product or GMP
                            certificate of all manufacturing sites should be provided in Module 1>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.3.2 Batch Formula</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) List of all components of the Drug Product to be used in the manufacturing process and their amounts on a per batch basis (including individual components of mixtures prepared in-house (e.g. coatings) and overages, if any)</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailbatchformula" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Component and quality standard (and grade, if applicable)</th>
                                                        <th>Quantity per batch (e.g. kg/batch)</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailbatchformula-id_<?=$sn?>" name="tabledetailbatchformula-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailbatchformula-componentQualityStd_<?=$sn?>" name="tabledetailbatchformula-componentQualityStd_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailbatchformula-quantityPerBatch_<?=$sn?>" name="tabledetailbatchformula-quantityPerBatch_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <h4>2.3.P.3.3 Description of Manufacturing Process and Process Controls</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Flow diagram of the manufacturing process</label>
                                                  <textarea id="flowDiagramOfMfgProcess" name="flowDiagramOfMfgProcess" class="form-control" rows="7" placeholder="<A flow diagram should be presented giving the steps of the process and showing where materials enter the process. The critical steps and points at which process controls, intermediate tests or final product controls are conducted should be identified>

                            <The maximum holding time for bulk product prior to final packaging should be stated. The holding time should be supported by the submission of stability data if longer than 30 days. For an aseptically processed drug product, sterile filtration of the bulk and filling into final containers should preferably be continuous; any holding time should be justified>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.3.4 Controls of Critical Steps and Intermediates</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Summary of controls performed at the critical steps of the manufacturing process and on isolated intermediates</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailcontrolsperformed" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Step (e.g. granulation, compression, coating)</th>
                                                        <th>Tests</th>
                                                        <th>Acceptance criteria</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailcontrolsperformed-id_<?=$sn?>" name="tabledetailcontrolsperformed-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontrolsperformed-controlsStep_<?=$sn?>" name="tabledetailcontrolsperformed-controlsStep_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontrolsperformed-controlsTest_<?=$sn?>" name="tabledetailcontrolsperformed-controlsTest_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontrolsperformed-controlsAcceptance_<?=$sn?>" name="tabledetailcontrolsperformed-controlsAcceptance_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.3.5 Process Validation and/or Evaluation</label>
                                                  <textarea id="proposedProcessValidation" name="proposedProcessValidation" class="form-control" rows="7" placeholder="<For applications of locally manufactured drug products, a brief description of process validation including the proposed protocol based upon the process steps and controls mentioned in 2.3.P.3.4 / 3.2.P.3.4 should be described. It should be noted that first three consecutive batches of commercial scale will be subjected to the process validation in accordance with the protocol>

                            <For applications of imported drug products, process validation reports including the protocols and results for critical process steps mentioned in 2.3.P.3.4 / 3.2.P.3.4 should be provided>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4 Control of Excipients</label>
                                                  <textarea id="controlOfExcipients" name="controlOfExcipients" class="form-control" rows="7" placeholder="<If the excipient(s) are in pharmacopoeia there is no need to provide detailed specifications or its analytical procedures. However for excipients of non-compendial standards, specifications as well as analytical procedures should be provided>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.1 Specifications ((a) Summary of the specifications for in-house standard excipients)</label>
                                                  <textarea id="inHouseStandardSpecs" name="inHouseStandardSpecs" class="form-control" rows="7" placeholder="The specifications for excipients of non-compendial standard should be provided>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.2 Analytical Procedures ((a)  Summary of the analytical procedures for in-house standard excipients)</label>
                                                  <textarea id="inHouseStandardAnalyticalProc" name="inHouseStandardAnalyticalProc" class="form-control" rows="7" placeholder="<Copies of analytical procedures of non-compendial excipient should be submitted>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.3 Validation of Analytical Procedures ((a) Summary of the validation information for the analytical procedures for in-house standard excipients)</label>
                                                  <textarea id="inHouseStandardValidationProc" name="inHouseStandardValidationProc" class="form-control" rows="7" placeholder=""></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.4 Justification of Specifications ((a)  Justification of the specifications for the analytical procedures for in-house standard excipients)</label>
                                                  <textarea id="inHouseStandardJustificationProc" name="inHouseStandardJustificationProc" class="form-control" rows="7" placeholder=""></textarea>

                                              </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.5 Excipients of Human or Animal Origin</label>
                                                  <textarea id="excipientsOfHumanOrigin" name="excipientsOfHumanOrigin" class="form-control" rows="7" placeholder="<For excipients of human or animal origin, a certificate should be provided, confirming that the excipient(s) are free from BSE and TSE>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> 2.3.P.4.6 Novel Excipients</label>
                                                  <textarea id="novelExcipients" name="novelExcipients" class="form-control" rows="7" placeholder="<For excipient(s) used for the first time in a drug product or by a new route of administration, full details of specification and testing method should be provided>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.5 Control of Drug Product</h4>
                                              </div>

                                              <div class="col-xs-6">
                                                <div class="form-group">
                                                  <label><i class="fa fa-asterisk text-danger"></i> Standard (e.g. USP, BP, Ph.Int., Ph.Eur., JP, in-house) </label>
                                                  <input type="text" id="specsStandardDrugProduct" name="specsStandardDrugProduct" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control required">
                                                </div>
                                              </div>

                                              <div class="col-xs-6">
                                                <div class="form-group">
                                                  <label><i class="fa fa-asterisk text-danger"></i> Specification reference number and version: </label>
                                                  <input type="text" id="specsRefDrugProduct" name="specsRefDrugProduct" value="" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control required">
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title"> (a)  Specification(s) for the Drug Product</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailsample" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>Test</th>
                                                        <th>Acceptance Criteria (Release)</th>
                                                        <th>Acceptance Criteria (Shelf-Life)</th>
                                                        <th>Analytical procedure (Type/Source/Version)</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <!-- <tr>
                                                          <td colspan="3">API status in pharmacopoeias and fora:</td>
                                                        </tr> -->
                                                        
                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsample-desctest_<?=$sn?>" name="" value="Description" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailsample-descReleaseAcceptanceCriteria_<?=$sn?>" name="descReleaseAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-descShelfLifeAcceptanceCriteria_<?=$sn?>" name="descShelfLifeAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-analyticalProcedure_<?=$sn?>" name="analyticalProcedure" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsample-identReleaseAcceptanceCriteria_<?=$sn?>" name="" value="Identification" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailsample-identReleaseAcceptanceCriteria_<?=$sn?>" name="identReleaseAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-identShelfLifeAcceptanceCriteria_<?=$sn?>" name="identShelfLifeAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-identAnalyticalProc_<?=$sn?>" name="identAnalyticalProc" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsample-impuritiesReleaseAccpetanceCriteria_<?=$sn?>" name="" value="Impurities" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailsample-impuritiesReleaseAccpetanceCriteria_<?=$sn?>" name="impuritiesReleaseAccpetanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-impuritiesShelfLifeAccpetanceCriteria_<?=$sn?>" name="impuritiesShelfLifeAccpetanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-impuritiesAnalyticalProc_<?=$sn?>" name="impuritiesAnalyticalProc" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsample-assayReleaseAcceptanceCriteria_<?=$sn?>" name="" value="Assay" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailsample-assayReleaseAcceptanceCriteria_<?=$sn?>" name="assayReleaseAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-assayShelfLifeAcceptanceCriteria_<?=$sn?>" name="assayShelfLifeAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-assayAnalyticalProc_<?=$sn?>" name="assayAnalyticalProc" value="" class="form-control required">
                                                          </td>

                                                          
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailsample-etcReleaseAcceptanceCriteria_<?=$sn?>" name="" value="etc." class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailsample-etcReleaseAcceptanceCriteria_<?=$sn?>" name="etcReleaseAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-etcShelfLifeAcceptanceCriteria_<?=$sn?>" name="etcShelfLifeAcceptanceCriteria" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailsample-etcAnalyticalProc_<?=$sn?>" name="etcAnalyticalProc" value="" class="form-control required">
                                                          </td>

                                                        </tr>

                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <h4>2.3.P.5.2 Analytical Procedures</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Summary of the analytical procedures (e.g. key method parameters, conditions, system suitability testing</label>
                                                  <textarea id="analyticalProcSummary" name="analyticalProcSummary" class="form-control" rows="7" placeholder="<Provide brief tabulated summary of analytical procedures including key method parameters and conditions instead of attaching detailed analytical methods of Drug Product>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>Detailed analytical procedures should be provided (In Hard-Copy) in Module 3 under section 3.2.P.5.2</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.5.3 Validation of Analytical Procedures</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Summary of the validation information (e.g. validation parameters and results)</label>
                                                  <textarea id="validationInfo" name="validationInfo" class="form-control" rows="7" placeholder="<For in-house methods, analytical method validation should be performed>

                            <All the officially recognized compendial methods for assay, dissolution and impurities (as applicable) are required to be verified and verification should include a demonstration of specificity, repeatability (method precision) and accuracy>

                            <Brief summary of validation / verification should be provided here, instead of attaching detailed protocols and results of analytical method validation>
                            "></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.5.4 Batch Analyses</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Description of the batches</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailbatchanalysis" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Batch Number</th>
                                                        <th>Batch Size</th>
                                                        <th>Date of Manufacturing</th>
                                                        <th>Use (e.g. pharmaceutical equivalence or stability)</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailbatchanalysis-id_<?=$sn?>" name="tabledetailbatchanalysis-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysis-batchNumber_<?=$sn?>" name="tabledetailbatchanalysis-batchNumber_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysis-batchSize_<?=$sn?>" name="tabledetailbatchanalysis-batchSize_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="date" id="tabledetailbatchanalysis-mfgDate_<?=$sn?>" name="tabledetailbatchanalysis-mfgDate_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysis-useOf_<?=$sn?>" name="tabledetailbatchanalysis-useOf_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title"> (b)  Summary of batch analyses release results for relevant batches (e.g. comparative bioavailability or biowaiver, stability)</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailbatchanalysissummary" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>Test</th>
                                                        <th>Acceptance Criteria</th>
                                                        <th>Batch x</th>
                                                        <th>Batch y</th>
                                                        <th>etc.</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <!-- <tr>
                                                          <td colspan="3">API status in pharmacopoeias and fora:</td>
                                                        </tr> -->
                                                        
                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailbatchanalysissummary-descBatchAnalysis1_<?=$sn?>" name="" value="Description" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-descAcceptanceCriteria1_<?=$sn?>" name="descAcceptanceCriteria1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-descBatchX1_<?=$sn?>" name="descBatchX1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-descBatchY1_<?=$sn?>" name="descBatchY1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-descEtc1_<?=$sn?>" name="descEtc1" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailbatchanalysissummary-identBatchAnalysis1_<?=$sn?>" name="" value="Identification" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-identAcceptanceCriteria1_<?=$sn?>" name="identAcceptanceCriteria1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-identBatchX1_<?=$sn?>" name="indentBatchX1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-identBatchY1_<?=$sn?>" name="indentBatchY1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-identEtc1_<?=$sn?>" name="indentEtc1" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailbatchanalysissummary-impuritiesBatchAnalysis1_<?=$sn?>" name="" value="Impurities" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-impuritiesAcceptanceCriteria1_<?=$sn?>" name="impuritiesAcceptanceCriteria1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-impuritiesBatchX1_<?=$sn?>" name="impuritiesBatchX1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-impuritiesBatchY1_<?=$sn?>" name="impuritiesBatchY1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-impuritiesEtc1_<?=$sn?>" name="impuritiesEtc1" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailbatchanalysissummary-assayBatchAnalysis1_<?=$sn?>" name="" value="Assay" class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-assayAcceptanceCriteria1_<?=$sn?>" name="assayAcceptanceCriteria1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-assayBatchX1_<?=$sn?>" name="assayBatchX1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-assayBatchY1_<?=$sn?>" name="assayBatchY1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-assayEtc1_<?=$sn?>" name="assayEtc1" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailbatchanalysissummary-etcBatchAnalysis1_<?=$sn?>" name="" value="etc." class="form-control required">
                                                          </td>
                                                          
                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-etcAcceptanceCriteria1_<?=$sn?>" name="etcAcceptanceCriteria1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-etcBatchX1_<?=$sn?>" name="etcBatchX1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-etcBatchY1_<?=$sn?>" name="etcBatchY1" value="" class="form-control required">
                                                          </td>

                                                          <td>
                                                            <input type="text" id="tabledetailbatchanalysissummary-etcEtc1_<?=$sn?>" name="etcEtc1" value="" class="form-control required">
                                                          </td>
                                                        
                                                        </tr>

                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <h4>2.3.P.5.5 Characterization of Impurities</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (a) Summary of the validation information (e.g. validation parameters and results)</label>
                                                  <textarea id="characterizationOfImpurities" name="characterizationOfImpurities" class="form-control" rows="7" placeholder="Those impurities that are degradation product should be included in the specifications>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>22.3.P.5.6 Justification of Specification(s)</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> Justification of Specification(s)</label>
                                                  <textarea id="justificationOfSpecs1" name="justificationOfSpecs1" class="form-control" rows="7" placeholder="<The justification of specification(s) for non-pharmacopeial products must be provided. Justification of specification of non-pharmacopeial product should be based on batch analysis results>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.6 Reference Standards or Materials</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> Reference Standards or Materials</label>
                                                  <textarea id="referenceStandards" name="referenceStandards" class="form-control" rows="7" placeholder="<For testing of Pharmacopeial Drug Product(s), the use of primary reference standard is recommended, however for non-pharmacopeial Drug Product(s), a secondary reference standard is acceptable>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.7 Container Closure System</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> Container Closure System</label>
                                                  <textarea id="containerClosureSystem" name="containerClosureSystem" class="form-control" rows="7" placeholder=""></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Description of the primary container closure systems, including unit count or fill size, container size or volume (<b>Container Size or Volume</b></h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailcontainerclosuresystem" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Description of primary container closure (including materials of construction) </th>
                                                        <th>Unit count or fill size (e.g. 60s, 100s etc.)</th>
                                                        <th>Container size (e.g. 5 ml, 100 ml etc.)</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailcontainerclosuresystem-id_<?=$sn?>" name="tabledetailcontainerclosuresystem-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontainerclosuresystem-containerSizeDesc_<?=$sn?>" name="tabledetailcontainerclosuresystem-containerSizeDesc_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontainerclosuresystem-containerSizeUnit_<?=$sn?>" name="tabledetailcontainerclosuresystem-containerSizeUnit_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailcontainerclosuresystem-containerSizeValue_<?=$sn?>" name="tabledetailcontainerclosuresystem-containerSizeValue_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <h4>2.3.P.8 Stability</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.8.1 Stability Summary and Conclusions</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Summary of accelerated and long-term stability study testing parameters (<b>Accelerated Stability Study</b></h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailproductstability" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Storage Condition (◦C, % RH)</th>
                                                        <th>Batch number</th>
                                                        <th>Batch size</th>
                                                        <th>Container closure system</th>
                                                        <th>Completed testing intervals</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailproductstability-id_<?=$sn?>" name="tabledetailproductstability-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability-storageCondition1_<?=$sn?>" name="tabledetailproductstability-storageCondition1_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability-batchNo_<?=$sn?>" name="tabledetailproductstability-batchNo_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability-batchSize_<?=$sn?>" name="tabledetailproductstability-batchSize_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability-containerClosure_<?=$sn?>" name="tabledetailproductstability-containerClosure_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability-completedTestingInterval_<?=$sn?>" name="tabledetailproductstability-completedTestingInterval_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(a) Summary of accelerated and long-term stability study testing parameters (<b>Long term / Real time stability study</b>)</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailproductstability2" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Storage condition (◦C, % RH)</th>
                                                        <th>Batch number</th>
                                                        <th>Batch size</th>
                                                        <th>Container closure system</th>
                                                        <th>Completed testing intervals</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailproductstability2-id_<?=$sn?>" name="tabledetailproductstability2-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability2-storageCondition2_<?=$sn?>" name="tabledetailproductstability2-storageCondition2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability2-batchNo2_<?=$sn?>" name="tabledetailproductstability2-batchNo2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability2-batchSize2_<?=$sn?>" name="tabledetailproductstability2-batchSize2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability2-containerClosure2_<?=$sn?>" name="tabledetailproductstability2-containerClosure2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproductstability2-completedTestingInterval2_<?=$sn?>" name="tabledetailproductstability2-completedTestingInterval2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label> (b) Summary of additional stability studies (if applicable)</label>
                                                  <textarea id="additionalStabilityStudy" name="additionalStabilityStudy" class="form-control" rows="7" placeholder="<e.g. in-use studies for drug products which are to be reconstituted before use>"></textarea>
                                                </div>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(c) Proposed storage statement and shelf-life</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailstoragestatement" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Container closure system</th>
                                                        <th>Storage statement</th>
                                                        <th>Shelf-life</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailstoragestatement-id_<?=$sn?>" name="tabledetailstoragestatement-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailstoragestatement-containerClosure_<?=$sn?>" name="tabledetailstoragestatement-containerClosure_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailstoragestatement-storageStatement_<?=$sn?>" name="tabledetailstoragestatement-storageStatement_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailstoragestatement-shelfLife_<?=$sn?>" name="tabledetailstoragestatement-shelfLife_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">(d) Proposed in-use storage statement and in-use shelf-life</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailproposedstoragestatement" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Storage statement</th>
                                                        <th>Shelf-life</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailproposedstoragestatement-id_<?=$sn?>" name="tabledetailproposedstoragestatement-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailproposedstoragestatement-storageStatement2_<?=$sn?>" name="tabledetailproposedstoragestatement-storageStatement2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailproposedstoragestatement-shelfLife2_<?=$sn?>" name="tabledetailproposedstoragestatement-shelfLife2_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                <h4>All the data and statements provided in this section should be based on ICH and WHO guidelines</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <h4>2.3.P.8.2 Post-approval Stability Protocol and Stability Commitment</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title"> Stability protocol for Commitment batches (e.g. storage conditions, batch numbers and batch sizes, tests and acceptance criteria, testing frequency, container closure system(s))</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailpostapprovalstability" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>Parameter</th>
                                                        <th>Detail</th>
                                                        <th>Value</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-storageCondition2_<?=$sn?>" name="" value="Storage condition(s) (◦C, % RH)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailpostapprovalstability-storageCondition2_<?=$sn?>" name="storageCondition2" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-batchNumberSize_<?=$sn?>" name="" value="Batch Number(s) /Batch Size(s)" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailpostapprovalstability-batchNumberSize_<?=$sn?>" name="batchNumberSize" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testCriteria_<?=$sn?>" name="" value="Test and Accpetance Criteria" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testDescCriteria_<?=$sn?>" name="testDescCriteria" value="Description" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailpostapprovalstability-testDescCriteriaValue_<?=$sn?>" name="testDescCriteriaValue" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testCriteria1_<?=$sn?>" name="" value="Test and Accpetance Criteria" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testDescCriteria1_<?=$sn?>" name="testDescCriteria2" value="Moisture" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailpostapprovalstability-testDescCriteriaValue1_<?=$sn?>" name="testDescCriteriaValue1" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testCriteria2_<?=$sn?>" name="" value="Test and Accpetance Criteria" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testDescCriteria2_<?=$sn?>" name="testDescCriteria2" value="Impurities" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailpostapprovalstability-testDescCriteriaValue2_<?=$sn?>" name="testDescCriteriaValue2" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testCriteria3_<?=$sn?>" name="" value="Test and Accpetance Criteria" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testDescCriteria3_<?=$sn?>" name="testDescCriteria3" value="Assay" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailpostapprovalstability-testDescCriteriaValue3_<?=$sn?>" name="testDescCriteriaValue3" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testCriteria4_<?=$sn?>" name="" value="Test and Accpetance Criteria" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testDescCriteria4_<?=$sn?>" name="testDescCriteria4" value="Etc" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailpostapprovalstability-testDescCriteriaValue4_<?=$sn?>" name="testDescCriteriaValue4" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-testingFrequency_<?=$sn?>" name="" value="Testing Frequency" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailpostapprovalstability-testingFrequency1_<?=$sn?>" name="testingFrequency1" value="" class="form-control required">
                                                          </td>
                                                        </tr>

                                                        <tr>
                                                          <td>
                                                            <input readonly type="text" id="tabledetailpostapprovalstability-containerClosureSystem2_<?=$sn?>" name="" value="Container Closure System" class="form-control required">
                                                          </td>
                                                          <td colspan="2">
                                                            <input type="text" id="tabledetailpostapprovalstability-containerClosureSystem3_<?=$sn?>" name="containerClosureSystem3" value="" class="form-control required">
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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

                                              <div class="col-xs-12">
                                                  <h4>2.3.P.8.3 Stability Data</h4>
                                              </div>

                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>(a)  Conclusion of the stability studies</label>
                                                  <textarea id="conclusionStabilityStudy" name="conclusionStabilityStudy" class="form-control" rows="7" placeholder=""></textarea>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_53">
                                            <div class="col-xs-12">
                                                <h4>Please Save the application to get access to S Part.</h4>
                                            </div>
                                          </div>
                                          <div class="box-body" style="display:none;" id="div_31">
                                            <div class="col-xs-12">
                                                <div class="box-body">
                                                  <div class="box-group" id="heading_31">
                                                    <div class="panel box box-primary">
                                                      <div class="box-header with-border">
                                                        <h4 class="box-title">
                                                          <a data-toggle="collapse" data-parent="#heading_31" href="#headingData_31">
                                                            <i class="icon fa fa-info-circle"></i> Help?
                                                          </a>
                                                        </h4>
                                                      </div>
                                                      <div id="headingData_31" class="panel-collapse collapse">
                                                        <div class="box-body">
                                                          ----------
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                              <div class="col-xs-12">
                                                <h4>SmPC</h4>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>2.0 QUALITATIVE AND QUANTITATIVE COMPOSITION:-</label>
                                                  <textarea id="qaqc" name="qaqc" class="form-control" rows="5" placeholder="Name of the Active Pharmaceutical Ingredient(s) / Drug Substance(s)"></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>3.0 PHARMACEUTICAL FORM:-</label>
                                                  <textarea id="pharmaceuticalForm" name="pharmaceuticalForm" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.0 CLINICAL PARTICULARS:-</label>
                                                  <textarea id="clinicalParticulars" name="clinicalParticulars" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.1 Therapeutic indications</label>
                                                  <textarea id="therapeuticIndication" name="therapeuticIndication" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.2 Posology and method of administration</label>
                                                  <textarea id="posologyandmethodofadministration" name="posologyandmethodofadministration" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.3 Contraindications</label>
                                                  <textarea id="contraindications" name="contraindications" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.4 Special warnings and precautions for use</label>
                                                  <textarea id="warningandprecautionsforuse" name="warningandprecautionsforuse" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.5 Interaction with other medicinal products and other forms of interaction</label>
                                                  <textarea id="interactionwithothermedicinalproducts" name="interactionwithothermedicinalproducts" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.6Fertility, pregnancy and lactation</label>
                                                  <textarea id="fertility" name="fertility" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.7 Effects on ability to drive and use machines</label>
                                                  <textarea id="effectsonabilitytodriveandusemachines" name="effectsonabilitytodriveandusemachines" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.8 Undesirable effects</label>
                                                  <textarea id="undesirableEffects" name="undesirableEffects" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>4.9 Overdose</label>
                                                  <textarea id="overdose" name="overdose" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>5.0 PHARMACOLOGICAL PROPERTIES</label>
                                                  <textarea id="pharmalogicalProperties" name="pharmalogicalProperties" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>5.1 Pharmacodynamics properties</label>
                                                  <textarea id="pharmadynamicsProperties" name="pharmadynamicsProperties" class="form-control" rows="5" placeholder="Therapeutic Classification & ATC Codes"></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>5.2 Pharmacokinetic properties</label>
                                                  <textarea id="pharmacokinetivProperties" name="pharmacokinetivProperties" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>5.3 Preclinical safety data</label>
                                                  <textarea id="preclinicalSafetyData" name="preclinicalSafetyData" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">6.1 List of Excipients</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailexcipients" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Name</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailexcipients-id_<?=$sn?>" name="tabledetailexcipients-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailexcipients-excipientName_<?=$sn?>" name="tabledetailexcipients-excipientName_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>6.2 Incompatibilities</label>
                                                  <textarea id="incompatibilities" name="incompatibilities" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>6.4 Special precautions for storage</label>
                                                  <textarea id="specialPrecautionsForStorage" name="specialPrecautionsForStorage" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>6.5 Nature and contents of container and special equipment for use/administration or Implantation</label>
                                                  <textarea id="natureandcontentsofcontainer" name="natureandcontentsofcontainer" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="form-group">
                                                  <label>6.6 Special precautions for disposal</label>
                                                  <textarea id="specialprecautionfordisposal" name="specialprecautionfordisposal" class="form-control" rows="5" placeholder=""></textarea>
                                                </div>
                                              </div>
                                              <div class="col-xs-12">
                                                <div class="box">
                                                  <!-- box -->
                                                  <!-- box-header -->
                                                  <div class="box-header bg-gray">
                                                    <h3 class="box-title">Specific Identification tests for each Active Substance</h3>
                                                  </div>
                                                  <!-- /.box-header -->
                                                  <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                                    <!-- box-body -->
                                                    <table id="tabledetailspecificidentification" class="table table-bordered table-striped" width="100%">
                                                      <thead>
                                                      <tr style="background-color: #ffffff;">
                                                        <th>S.#</th>
                                                        <th>Name of Test / Parameter</th>
                                                        <th>Acceptance Criteria / Limits</th>
                                                        <th>Reference to Analytical / method</th>
                                                        <th class="text-center">Action</th>
                                                      </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php $sn=1; ?>
                                                        <tr>
                                                          <td><?=$sn?>.<input type="hidden" id="tabledetailspecificidentification-id_<?=$sn?>" name="tabledetailspecificidentification-id_detail[]" value="<?=$sn?>"></td>
                                                          <td>
                                                            <input type="text" id="tabledetailspecificidentification-testName_<?=$sn?>" name="tabledetailspecificidentification-testName_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailspecificidentification-criteria_<?=$sn?>" name="tabledetailspecificidentification-criteria_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td>
                                                            <input type="text" id="tabledetailspecificidentification-reference_<?=$sn?>" name="tabledetailspecificidentification-reference_detail[]" value="" class="form-control required">
                                                          </td>
                                                          <td class="text-center widthMaxContent">
                                                            <div class="btn-group">
                                                              <i class="btn btn-primary fa fa-plus"></i>
                                                              <i class="btn btn-danger fa fa-trash"></i>
                                                            </div>
                                                          </td>
                                                        </tr>
                                                        <?php $sn++ ?>
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
                                            </div>
                                          </div>

                                      </div>
                                    </div>
                                  </div>

                                </div>

                              </div>
                              <div class="tab-pane" id="tab_4" style="background-color: #f7f7f7 !important;">
                                
                                <div class="col-xs-12">

                                  <!-- <div class="col-xs-6">
                                    <div class="form-group">
                                      <label>Fee Challan <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                                      <input type="file" id="feeChallanPath" name="feeChallanPath" value="">
                                    </div>
                                  </div> -->

                                  <div class="col-xs-12">
                                    <div class="box">
                                      <!-- box -->
                                      <!-- box-header -->
                                      <div class="box-header bg-gray">
                                        <h3 class="box-title"> Fee Info</h3>
                                      </div>
                                      <!-- /.box-header -->
                                      <div class="box-body table-responsive" style="background-color: #f1f1f1;">
                                        <!-- box-body -->
                                        <table id="tabledetailfeeinfo" class="table table-bordered table-striped" width="100%">
                                          <thead>
                                          <tr style="background-color: #ffffff;">
                                            <th>Phase</th>
                                            <th>Invoice No.</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                            <?php $sn=1; ?>
                                            <tr>
                                              <td>
                                                <b>Registration</b>
                                              </td>
                                              <td>
                                                <input type="text" id="invoice" name="invoice" value="" class="form-control required">
                                              </td>
                                            </tr>
                                            <?php $sn++ ?>
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

                                </div>

                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="form-group">
                      <label>Priority</label>
                        <select class="form-control select2" id="priorityReasonId" name="priorityReasonId">
                          <option value="0">Select Priority</option>
                          <?php
                            if(!empty($priorityReason))
                            {
                              foreach ($priorityReason as $record)
                              {
                                  ?>
                                  <option value="<?php echo $record->id ?>"><?php echo $record->priorityReason ?></option>
                                  <?php
                              }
                            }
                          ?>
                        </select>
                    </div>
                  </div>

                  <div class="col-xs-12">
                    <div class="form-group">
                      <label>Specify Details of Priority (If Any)</label>
                      <textarea id="remarks" name="remarks" class="form-control" rows="3"></textarea>
                    </div>
                  </div>

                  <div class="col-xs-6" style="display: none;">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control select2" id="registrationStatus" name="registrationStatus">
                        <option value="Save">Save</option>
                        <option value="Submit">Submit</option>
                      </select>
                    </div>
                  </div>

                  <!-- /.row -->
                </div>
                <!-- /.box body -->
              </div>
              <div class="box-footer">
                <!-- box footer -->
                <input type="submit" onclick="" class="btn btn-primary" id="formSave" value="Save">
                <!-- <input type="submit" onclick="return confirm('Are you sure you want to submit this record?')" class="btn btn-success" id="formSubmit" value="Submit"> -->
                <!-- /.box footer -->
              </div>
              <!-- /.box -->
            </div>
          </form>
          <!-- /.col 12 -->
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
        $('#tabledetailinncode thead tr').clone(true).appendTo( '#tabledetailinncode thead' );
        $('#tabledetailinncode thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailinncode').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
        });
    });
    $( "#tabledetailinncode thead th" ).click(function() {
      $( "#tabledetailinncode thead th input" ).removeClass('hidden');
    });
    $('#tabledetailinncode').on( 'click', '.fa-plus', function () {
      var tabledetailinncode = document.getElementById('tabledetailinncode');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailinncode.rows[$("#tabledetailinncode tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailinncode.rows[$("#tabledetailinncode tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailinncode tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<select class="form-control select2" id="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("name") +'"></select>';
      columns[2] = '<input type="text" id="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailinncode tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailinncode tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinncode tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<a disabled class="btn btn-success" id=""><i class="fa fa-file-text"></i></a>';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailinncode').DataTable().row.add(columns).draw();
      $.ajax({
        url:"<?php echo base_url(); ?>myController/innCodeAjaxGet",
        method:"POST",
        success:function(data)
        {
          myId = $("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailinncode tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]));
         $('#'+myId).html(data);
        }
       });
      $('#tabledetailinncode select').select2();
      $('#tabledetailinncode tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetailinncode').DataTable().destroy();
      $('#tabledetailinncode').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
      });
    });
    $('#tabledetailinncode tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailinncode tbody tr').length !== 1){
        $('#tabledetailinncode').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproposedname thead tr').clone(true).appendTo( '#tabledetailproposedname thead' );
        $('#tabledetailproposedname thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproposedname').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2] }]
        });
    });
    $( "#tabledetailproposedname thead th" ).click(function() {
      $( "#tabledetailproposedname thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproposedname').on( 'click', '.fa-plus', function () {
      var tabledetailproposedname = document.getElementById('tabledetailproposedname');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproposedname.rows[$("#tabledetailproposedname tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproposedname.rows[$("#tabledetailproposedname tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproposedname tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedname tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproposedname tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedname tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproposedname tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproposedname tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedname tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproposedname tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedname tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproposedname').DataTable().row.add(columns).draw();
      $('#tabledetailproposedname select').select2();
      $('#tabledetailproposedname tbody tr:last').find('td').eq(2).addClass('text-center widthMaxContent');
      $('#tabledetailproposedname').DataTable().destroy();
      $('#tabledetailproposedname').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2] }]
      });
    });
    $('#tabledetailproposedname tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproposedname tbody tr').length !== 1){
        $('#tabledetailproposedname').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproposedprice thead tr').clone(true).appendTo( '#tabledetailproposedprice thead' );
        $('#tabledetailproposedprice thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproposedprice').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailproposedprice thead th" ).click(function() {
      $( "#tabledetailproposedprice thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproposedprice').on( 'click', '.fa-plus', function () {
      var tabledetailproposedprice = document.getElementById('tabledetailproposedprice');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproposedprice.rows[$("#tabledetailproposedprice tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproposedprice.rows[$("#tabledetailproposedprice tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedprice tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproposedprice tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproposedprice tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedprice tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproposedprice tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedprice tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproposedprice tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedprice tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailproposedprice tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedprice tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproposedprice').DataTable().row.add(columns).draw();
      $('#tabledetailproposedprice select').select2();
      $('#tabledetailproposedprice tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailproposedprice').DataTable().destroy();
      $('#tabledetailproposedprice').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailproposedprice tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproposedprice tbody tr').length !== 1){
        $('#tabledetailproposedprice').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetaildomesticreference thead tr').clone(true).appendTo( '#tabledetaildomesticreference thead' );
        $('#tabledetaildomesticreference thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetaildomesticreference').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetaildomesticreference thead th" ).click(function() {
      $( "#tabledetaildomesticreference thead th input" ).removeClass('hidden');
    });
    $('#tabledetaildomesticreference').on( 'click', '.fa-plus', function () {
      var tabledetaildomesticreference = document.getElementById('tabledetaildomesticreference');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetaildomesticreference.rows[$("#tabledetaildomesticreference tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetaildomesticreference.rows[$("#tabledetaildomesticreference tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildomesticreference tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetaildomesticreference tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetaildomesticreference tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildomesticreference tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetaildomesticreference tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildomesticreference tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetaildomesticreference tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildomesticreference tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetaildomesticreference tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildomesticreference tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetaildomesticreference').DataTable().row.add(columns).draw();
      $('#tabledetaildomesticreference select').select2();
      $('#tabledetaildomesticreference tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetaildomesticreference').DataTable().destroy();
      $('#tabledetaildomesticreference').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetaildomesticreference tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetaildomesticreference tbody tr').length !== 1){
        $('#tabledetaildomesticreference').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailinternationalreference thead tr').clone(true).appendTo( '#tabledetailinternationalreference thead' );
        $('#tabledetailinternationalreference thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailinternationalreference').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailinternationalreference thead th" ).click(function() {
      $( "#tabledetailinternationalreference thead th input" ).removeClass('hidden');
    });
    $('#tabledetailinternationalreference').on( 'click', '.fa-plus', function () {
      var tabledetailinternationalreference = document.getElementById('tabledetailinternationalreference');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailinternationalreference.rows[$("#tabledetailinternationalreference tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailinternationalreference.rows[$("#tabledetailinternationalreference tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinternationalreference tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailinternationalreference tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailinternationalreference tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinternationalreference tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailinternationalreference tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinternationalreference tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailinternationalreference tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailinternationalreference tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailinternationalreference tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailinternationalreference tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailinternationalreference').DataTable().row.add(columns).draw();
      $('#tabledetailinternationalreference select').select2();
      $('#tabledetailinternationalreference tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailinternationalreference').DataTable().destroy();
      $('#tabledetailinternationalreference').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailinternationalreference tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailinternationalreference tbody tr').length !== 1){
        $('#tabledetailinternationalreference').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailotherinfo thead tr').clone(true).appendTo( '#tabledetailotherinfo thead' );
        $('#tabledetailotherinfo thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailotherinfo').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
        });
    });
    $( "#tabledetailotherinfo thead th" ).click(function() {
      $( "#tabledetailotherinfo thead th input" ).removeClass('hidden');
    });
    $('#tabledetailotherinfo').on( 'click', '.fa-plus', function () {
      var tabledetailotherinfo = document.getElementById('tabledetailotherinfo');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailotherinfo.rows[$("#tabledetailotherinfo tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailotherinfo.rows[$("#tabledetailotherinfo tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailotherinfo tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailotherinfo tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailotherinfo tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailotherinfo tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailotherinfo tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailotherinfo tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailotherinfo tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailotherinfo').DataTable().row.add(columns).draw();
      $('#tabledetailotherinfo select').select2();
      $('#tabledetailotherinfo tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetailotherinfo').DataTable().destroy();
      $('#tabledetailotherinfo').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
      });
    });
    $('#tabledetailotherinfo tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailotherinfo tbody tr').length !== 1){
        $('#tabledetailotherinfo').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailcompositionofdrugproduct thead tr').clone(true).appendTo( '#tabledetailcompositionofdrugproduct thead' );
        $('#tabledetailcompositionofdrugproduct thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailcompositionofdrugproduct').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
        });
    });
    $( "#tabledetailcompositionofdrugproduct thead th" ).click(function() {
      $( "#tabledetailcompositionofdrugproduct thead th input" ).removeClass('hidden');
    });
    $('#tabledetailcompositionofdrugproduct').on( 'click', '.fa-plus', function () {
      var tabledetailcompositionofdrugproduct = document.getElementById('tabledetailcompositionofdrugproduct');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailcompositionofdrugproduct.rows[$("#tabledetailcompositionofdrugproduct tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailcompositionofdrugproduct.rows[$("#tabledetailcompositionofdrugproduct tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcompositionofdrugproduct tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailcompositionofdrugproduct').DataTable().row.add(columns).draw();
      $('#tabledetailcompositionofdrugproduct select').select2();
      $('#tabledetailcompositionofdrugproduct tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetailcompositionofdrugproduct').DataTable().destroy();
      $('#tabledetailcompositionofdrugproduct').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
      });
    });
    $('#tabledetailcompositionofdrugproduct tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailcompositionofdrugproduct tbody tr').length !== 1){
        $('#tabledetailcompositionofdrugproduct').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproductmanufacturer thead tr').clone(true).appendTo( '#tabledetailproductmanufacturer thead' );
        $('#tabledetailproductmanufacturer thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproductmanufacturer').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailproductmanufacturer thead th" ).click(function() {
      $( "#tabledetailproductmanufacturer thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproductmanufacturer').on( 'click', '.fa-plus', function () {
      var tabledetailproductmanufacturer = document.getElementById('tabledetailproductmanufacturer');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproductmanufacturer.rows[$("#tabledetailproductmanufacturer tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproductmanufacturer.rows[$("#tabledetailproductmanufacturer tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductmanufacturer tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproductmanufacturer').DataTable().row.add(columns).draw();
      $('#tabledetailproductmanufacturer select').select2();
      $('#tabledetailproductmanufacturer tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailproductmanufacturer').DataTable().destroy();
      $('#tabledetailproductmanufacturer').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailproductmanufacturer tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproductmanufacturer tbody tr').length !== 1){
        $('#tabledetailproductmanufacturer').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailbatchformula thead tr').clone(true).appendTo( '#tabledetailbatchformula thead' );
        $('#tabledetailbatchformula thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailbatchformula').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailbatchformula thead th" ).click(function() {
      $( "#tabledetailbatchformula thead th input" ).removeClass('hidden');
    });
    $('#tabledetailbatchformula').on( 'click', '.fa-plus', function () {
      var tabledetailbatchformula = document.getElementById('tabledetailbatchformula');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailbatchformula.rows[$("#tabledetailbatchformula tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailbatchformula.rows[$("#tabledetailbatchformula tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchformula tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailbatchformula tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailbatchformula tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchformula tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailbatchformula tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchformula tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailbatchformula tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchformula tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailbatchformula').DataTable().row.add(columns).draw();
      $('#tabledetailbatchformula select').select2();
      $('#tabledetailbatchformula tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailbatchformula').DataTable().destroy();
      $('#tabledetailbatchformula').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailbatchformula tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailbatchformula tbody tr').length !== 1){
        $('#tabledetailbatchformula').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailcontrolsperformed thead tr').clone(true).appendTo( '#tabledetailcontrolsperformed thead' );
        $('#tabledetailcontrolsperformed thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailcontrolsperformed').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailcontrolsperformed thead th" ).click(function() {
      $( "#tabledetailcontrolsperformed thead th input" ).removeClass('hidden');
    });
    $('#tabledetailcontrolsperformed').on( 'click', '.fa-plus', function () {
      var tabledetailcontrolsperformed = document.getElementById('tabledetailcontrolsperformed');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailcontrolsperformed.rows[$("#tabledetailcontrolsperformed tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailcontrolsperformed.rows[$("#tabledetailcontrolsperformed tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontrolsperformed tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailcontrolsperformed').DataTable().row.add(columns).draw();
      $('#tabledetailcontrolsperformed select').select2();
      $('#tabledetailcontrolsperformed tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailcontrolsperformed').DataTable().destroy();
      $('#tabledetailcontrolsperformed').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailcontrolsperformed tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailcontrolsperformed tbody tr').length !== 1){
        $('#tabledetailcontrolsperformed').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailbatchanalysis thead tr').clone(true).appendTo( '#tabledetailbatchanalysis thead' );
        $('#tabledetailbatchanalysis thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailbatchanalysis').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
        });
    });
    $( "#tabledetailbatchanalysis thead th" ).click(function() {
      $( "#tabledetailbatchanalysis thead th input" ).removeClass('hidden');
    });
    $('#tabledetailbatchanalysis').on( 'click', '.fa-plus', function () {
      var tabledetailbatchanalysis = document.getElementById('tabledetailbatchanalysis');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailbatchanalysis.rows[$("#tabledetailbatchanalysis tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailbatchanalysis.rows[$("#tabledetailbatchanalysis tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailbatchanalysis tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailbatchanalysis tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailbatchanalysis tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailbatchanalysis tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailbatchanalysis tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailbatchanalysis tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailbatchanalysis tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailbatchanalysis').DataTable().row.add(columns).draw();
      $('#tabledetailbatchanalysis select').select2();
      $('#tabledetailbatchanalysis tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetailbatchanalysis').DataTable().destroy();
      $('#tabledetailbatchanalysis').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
      });
    });
    $('#tabledetailbatchanalysis tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailbatchanalysis tbody tr').length !== 1){
        $('#tabledetailbatchanalysis').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailcontainerclosuresystem thead tr').clone(true).appendTo( '#tabledetailcontainerclosuresystem thead' );
        $('#tabledetailcontainerclosuresystem thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailcontainerclosuresystem').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailcontainerclosuresystem thead th" ).click(function() {
      $( "#tabledetailcontainerclosuresystem thead th input" ).removeClass('hidden');
    });
    $('#tabledetailcontainerclosuresystem').on( 'click', '.fa-plus', function () {
      var tabledetailcontainerclosuresystem = document.getElementById('tabledetailcontainerclosuresystem');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailcontainerclosuresystem.rows[$("#tabledetailcontainerclosuresystem tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailcontainerclosuresystem.rows[$("#tabledetailcontainerclosuresystem tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosuresystem tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailcontainerclosuresystem').DataTable().row.add(columns).draw();
      $('#tabledetailcontainerclosuresystem select').select2();
      $('#tabledetailcontainerclosuresystem tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailcontainerclosuresystem').DataTable().destroy();
      $('#tabledetailcontainerclosuresystem').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailcontainerclosuresystem tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailcontainerclosuresystem tbody tr').length !== 1){
        $('#tabledetailcontainerclosuresystem').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailstability thead tr').clone(true).appendTo( '#tabledetailproductstability thead' );
        $('#tabledetailproductstability thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproductstability').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
        });
    });
    $( "#tabledetailproductstability thead th" ).click(function() {
      $( "#tabledetailproductstability thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproductstability').on( 'click', '.fa-plus', function () {
      var tabledetailproductstability = document.getElementById('tabledetailproductstability');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproductstability.rows[$("#tabledetailproductstability tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproductstability.rows[$("#tabledetailproductstability tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<input type="text" id="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(5).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability tbody tr:last").find("td").eq(5).children().attr("id").split("_")[$("#tabledetailproductstability tbody tr:last").find("td").eq(5).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability tbody tr:last").find("td").eq(5).children().attr("name") +'" value="" class="form-control required">';
      columns[6] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproductstability').DataTable().row.add(columns).draw();
      $('#tabledetailproductstability select').select2();
      $('#tabledetailproductstability tbody tr:last').find('td').eq(6).addClass('text-center widthMaxContent');
      $('#tabledetailproductstability').DataTable().destroy();
      $('#tabledetailproductstability').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
      });
    });
    $('#tabledetailproductstability tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproductstability tbody tr').length !== 1){
        $('#tabledetailproductstability').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproductstability2 thead tr').clone(true).appendTo( '#tabledetailproductstability2 thead' );
        $('#tabledetailproductstability2 thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproductstability2').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
        });
    });
    $( "#tabledetailproductstability2 thead th" ).click(function() {
      $( "#tabledetailproductstability2 thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproductstability2').on( 'click', '.fa-plus', function () {
      var tabledetailproductstability2 = document.getElementById('tabledetailproductstability2');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproductstability2.rows[$("#tabledetailproductstability2 tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproductstability2.rows[$("#tabledetailproductstability2 tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<input type="text" id="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproductstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_")[$("#tabledetailproductstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproductstability2 tbody tr:last").find("td").eq(5).children().attr("name") +'" value="" class="form-control required">';
      columns[6] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproductstability2').DataTable().row.add(columns).draw();
      $('#tabledetailproductstability2 select').select2();
      $('#tabledetailproductstability2 tbody tr:last').find('td').eq(6).addClass('text-center widthMaxContent');
      $('#tabledetailproductstability2').DataTable().destroy();
      $('#tabledetailproductstability2').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
      });
    });
    $('#tabledetailproductstability2 tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproductstability2 tbody tr').length !== 1){
        $('#tabledetailproductstability2').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailstoragestatement thead tr').clone(true).appendTo( '#tabledetailstoragestatement thead' );
        $('#tabledetailstoragestatement thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailstoragestatement').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailstoragestatement thead th" ).click(function() {
      $( "#tabledetailstoragestatement thead th input" ).removeClass('hidden');
    });
    $('#tabledetailstoragestatement').on( 'click', '.fa-plus', function () {
      var tabledetailstoragestatement = document.getElementById('tabledetailstoragestatement');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailstoragestatement.rows[$("#tabledetailstoragestatement tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailstoragestatement.rows[$("#tabledetailstoragestatement tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailstoragestatement tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstoragestatement tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailstoragestatement tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstoragestatement tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailstoragestatement').DataTable().row.add(columns).draw();
      $('#tabledetailstoragestatement select').select2();
      $('#tabledetailstoragestatement tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailstoragestatement').DataTable().destroy();
      $('#tabledetailstoragestatement').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailstoragestatement tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailstoragestatement tbody tr').length !== 1){
        $('#tabledetailstoragestatement').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproposedstoragestatement thead tr').clone(true).appendTo( '#tabledetailproposedstoragestatement thead' );
        $('#tabledetailproposedstoragestatement thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproposedstoragestatement').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailproposedstoragestatement thead th" ).click(function() {
      $( "#tabledetailproposedstoragestatement thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproposedstoragestatement').on( 'click', '.fa-plus', function () {
      var tabledetailproposedstoragestatement = document.getElementById('tabledetailproposedstoragestatement');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproposedstoragestatement.rows[$("#tabledetailproposedstoragestatement tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproposedstoragestatement.rows[$("#tabledetailproposedstoragestatement tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragestatement tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproposedstoragestatement').DataTable().row.add(columns).draw();
      $('#tabledetailproposedstoragestatement select').select2();
      $('#tabledetailproposedstoragestatement tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailproposedstoragestatement').DataTable().destroy();
      $('#tabledetailproposedstoragestatement').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailproposedstoragestatement tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproposedstoragestatement tbody tr').length !== 1){
        $('#tabledetailproposedstoragestatement').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailsolubilities thead tr').clone(true).appendTo( '#tabledetailsolubilities thead' );
        $('#tabledetailsolubilities thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailsolubilities').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailsolubilities thead th" ).click(function() {
      $( "#tabledetailsolubilities thead th input" ).removeClass('hidden');
    });
    $('#tabledetailsolubilities').on( 'click', '.fa-plus', function () {
      var tabledetailsolubilities = document.getElementById('tabledetailsolubilities');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailsolubilities.rows[$("#tabledetailsolubilities tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailsolubilities.rows[$("#tabledetailsolubilities tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailsolubilities tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailsolubilities tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailsolubilities tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailsolubilities tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailsolubilities tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailsolubilities tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailsolubilities tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailsolubilities tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailsolubilities').DataTable().row.add(columns).draw();
      $('#tabledetailsolubilities select').select2();
      $('#tabledetailsolubilities tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailsolubilities').DataTable().destroy();
      $('#tabledetailsolubilities').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailsolubilities tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailsolubilities tbody tr').length !== 1){
        $('#tabledetailsolubilities').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailmanufacturers thead tr').clone(true).appendTo( '#tabledetailmanufacturers thead' );
        $('#tabledetailmanufacturers thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailmanufacturers').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailmanufacturers thead th" ).click(function() {
      $( "#tabledetailmanufacturers thead th input" ).removeClass('hidden');
    });
    $('#tabledetailmanufacturers').on( 'click', '.fa-plus', function () {
      var tabledetailmanufacturers = document.getElementById('tabledetailmanufacturers');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailmanufacturers.rows[$("#tabledetailmanufacturers tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailmanufacturers.rows[$("#tabledetailmanufacturers tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailmanufacturers tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailmanufacturers tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailmanufacturers tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailmanufacturers tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailmanufacturers tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailmanufacturers tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailmanufacturers tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailmanufacturers tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailmanufacturers').DataTable().row.add(columns).draw();
      $('#tabledetailmanufacturers select').select2();
      $('#tabledetailmanufacturers tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailmanufacturers').DataTable().destroy();
      $('#tabledetailmanufacturers').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailmanufacturers tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailmanufacturers tbody tr').length !== 1){
        $('#tabledetailmanufacturers').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetaildrugsubstance thead tr').clone(true).appendTo( '#tabledetaildrugsubstance thead' );
        $('#tabledetaildrugsubstance thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetaildrugsubstance').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
        });
    });
    $( "#tabledetaildrugsubstance thead th" ).click(function() {
      $( "#tabledetaildrugsubstance thead th input" ).removeClass('hidden');
    });
    $('#tabledetaildrugsubstance').on( 'click', '.fa-plus', function () {
      var tabledetaildrugsubstance = document.getElementById('tabledetaildrugsubstance');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetaildrugsubstance.rows[$("#tabledetaildrugsubstance tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetaildrugsubstance.rows[$("#tabledetaildrugsubstance tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetaildrugsubstance tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetaildrugsubstance tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetaildrugsubstance tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetaildrugsubstance tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetaildrugsubstance tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetaildrugsubstance tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetaildrugsubstance tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetaildrugsubstance').DataTable().row.add(columns).draw();
      $('#tabledetaildrugsubstance select').select2();
      $('#tabledetaildrugsubstance tbody tr:last').find('td').eq(5).addClass('text-center widthMaxContent');
      $('#tabledetaildrugsubstance').DataTable().destroy();
      $('#tabledetaildrugsubstance').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5] }]
      });
    });
    $('#tabledetaildrugsubstance tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetaildrugsubstance tbody tr').length !== 1){
        $('#tabledetaildrugsubstance').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailprocessimpurities thead tr').clone(true).appendTo( '#tabledetailprocessimpurities thead' );
        $('#tabledetailprocessimpurities thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailprocessimpurities').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailprocessimpurities thead th" ).click(function() {
      $( "#tabledetailprocessimpurities thead th input" ).removeClass('hidden');
    });
    $('#tabledetailprocessimpurities').on( 'click', '.fa-plus', function () {
      var tabledetailprocessimpurities = document.getElementById('tabledetailprocessimpurities');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailprocessimpurities.rows[$("#tabledetailprocessimpurities tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailprocessimpurities.rows[$("#tabledetailprocessimpurities tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailprocessimpurities tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailprocessimpurities tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailprocessimpurities tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailprocessimpurities tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailprocessimpurities tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailprocessimpurities tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailprocessimpurities tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailprocessimpurities tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailprocessimpurities').DataTable().row.add(columns).draw();
      $('#tabledetailprocessimpurities select').select2();
      $('#tabledetailprocessimpurities tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailprocessimpurities').DataTable().destroy();
      $('#tabledetailprocessimpurities').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailprocessimpurities tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailprocessimpurities tbody tr').length !== 1){
        $('#tabledetailprocessimpurities').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailspecifications thead tr').clone(true).appendTo( '#tabledetailspecifications thead' );
        $('#tabledetailspecifications thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailspecifications').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailspecifications thead th" ).click(function() {
      $( "#tabledetailspecifications thead th input" ).removeClass('hidden');
    });
    $('#tabledetailspecifications').on( 'click', '.fa-plus', function () {
      var tabledetailspecifications = document.getElementById('tabledetailspecifications');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailspecifications.rows[$("#tabledetailspecifications tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailspecifications.rows[$("#tabledetailspecifications tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecifications tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailspecifications tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailspecifications tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecifications tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailspecifications tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecifications tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailspecifications tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecifications tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailspecifications tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecifications tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailspecifications').DataTable().row.add(columns).draw();
      $('#tabledetailspecifications select').select2();
      $('#tabledetailspecifications tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailspecifications').DataTable().destroy();
      $('#tabledetailspecifications').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailspecifications tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailspecifications tbody tr').length !== 1){
        $('#tabledetailspecifications').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailcontainerclosure thead tr').clone(true).appendTo( '#tabledetailcontainerclosure thead' );
        $('#tabledetailcontainerclosure thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailcontainerclosure').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
        });
    });
    $( "#tabledetailcontainerclosure thead th" ).click(function() {
      $( "#tabledetailcontainerclosure thead th input" ).removeClass('hidden');
    });
    $('#tabledetailcontainerclosure').on( 'click', '.fa-plus', function () {
      var tabledetailcontainerclosure = document.getElementById('tabledetailcontainerclosure');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailcontainerclosure.rows[$("#tabledetailcontainerclosure tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailcontainerclosure.rows[$("#tabledetailcontainerclosure tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosure tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailcontainerclosure tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailcontainerclosure tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosure tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailcontainerclosure tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailcontainerclosure tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailcontainerclosure tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailcontainerclosure tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailcontainerclosure').DataTable().row.add(columns).draw();
      $('#tabledetailcontainerclosure select').select2();
      $('#tabledetailcontainerclosure tbody tr:last').find('td').eq(3).addClass('text-center widthMaxContent');
      $('#tabledetailcontainerclosure').DataTable().destroy();
      $('#tabledetailcontainerclosure').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3] }]
      });
    });
    $('#tabledetailcontainerclosure tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailcontainerclosure tbody tr').length !== 1){
        $('#tabledetailcontainerclosure').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailstability thead tr').clone(true).appendTo( '#tabledetailstability thead' );
        $('#tabledetailstability thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailstability').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
        });
    });
    $( "#tabledetailstability thead th" ).click(function() {
      $( "#tabledetailstability thead th input" ).removeClass('hidden');
    });
    $('#tabledetailstability').on( 'click', '.fa-plus', function () {
      var tabledetailstability = document.getElementById('tabledetailstability');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailstability.rows[$("#tabledetailstability tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailstability.rows[$("#tabledetailstability tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<input type="text" id="'+ $("#tabledetailstability tbody tr:last").find("td").eq(5).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability tbody tr:last").find("td").eq(5).children().attr("id").split("_")[$("#tabledetailstability tbody tr:last").find("td").eq(5).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability tbody tr:last").find("td").eq(5).children().attr("name") +'" value="" class="form-control required">';
      columns[6] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailstability').DataTable().row.add(columns).draw();
      $('#tabledetailstability select').select2();
      $('#tabledetailstability tbody tr:last').find('td').eq(6).addClass('text-center widthMaxContent');
      $('#tabledetailstability').DataTable().destroy();
      $('#tabledetailstability').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
      });
    });
    $('#tabledetailstability tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailstability tbody tr').length !== 1){
        $('#tabledetailstability').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailstability2 thead tr').clone(true).appendTo( '#tabledetailstability2 thead' );
        $('#tabledetailstability2 thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailstability2').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
        });
    });
    $( "#tabledetailstability2 thead th" ).click(function() {
      $( "#tabledetailstability2 thead th input" ).removeClass('hidden');
    });
    $('#tabledetailstability2').on( 'click', '.fa-plus', function () {
      var tabledetailstability2 = document.getElementById('tabledetailstability2');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailstability2.rows[$("#tabledetailstability2 tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailstability2.rows[$("#tabledetailstability2 tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<input type="text" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(4).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(4).children().attr("name") +'" value="" class="form-control required">';
      columns[5] = '<input type="text" id="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_")[$("#tabledetailstability2 tbody tr:last").find("td").eq(5).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailstability2 tbody tr:last").find("td").eq(5).children().attr("name") +'" value="" class="form-control required">';
      columns[6] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailstability2').DataTable().row.add(columns).draw();
      $('#tabledetailstability2 select').select2();
      $('#tabledetailstability2 tbody tr:last').find('td').eq(6).addClass('text-center widthMaxContent');
      $('#tabledetailstability2').DataTable().destroy();
      $('#tabledetailstability2').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4, 5, 6] }]
      });
    });
    $('#tabledetailstability2 tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailstability2 tbody tr').length !== 1){
        $('#tabledetailstability2').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailproposedstoragecondition thead tr').clone(true).appendTo( '#tabledetailproposedstoragecondition thead' );
        $('#tabledetailproposedstoragecondition thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailproposedstoragecondition').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailproposedstoragecondition thead th" ).click(function() {
      $( "#tabledetailproposedstoragecondition thead th input" ).removeClass('hidden');
    });
    $('#tabledetailproposedstoragecondition').on( 'click', '.fa-plus', function () {
      var tabledetailproposedstoragecondition = document.getElementById('tabledetailproposedstoragecondition');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailproposedstoragecondition.rows[$("#tabledetailproposedstoragecondition tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailproposedstoragecondition.rows[$("#tabledetailproposedstoragecondition tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailproposedstoragecondition tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailproposedstoragecondition').DataTable().row.add(columns).draw();
      $('#tabledetailproposedstoragecondition select').select2();
      $('#tabledetailproposedstoragecondition tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailproposedstoragecondition').DataTable().destroy();
      $('#tabledetailproposedstoragecondition').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailproposedstoragecondition tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailproposedstoragecondition tbody tr').length !== 1){
        $('#tabledetailproposedstoragecondition').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailexcipients thead tr').clone(true).appendTo( '#tabledetailexcipients thead' );
        $('#tabledetailexcipients thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailexcipients').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2] }]
        });
    });
    $( "#tabledetailexcipients thead th" ).click(function() {
      $( "#tabledetailexcipients thead th input" ).removeClass('hidden');
    });
    $('#tabledetailexcipients').on( 'click', '.fa-plus', function () {
      var tabledetailexcipients = document.getElementById('tabledetailexcipients');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailexcipients.rows[$("#tabledetailexcipients tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailexcipients.rows[$("#tabledetailexcipients tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailexcipients tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailexcipients tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailexcipients tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailexcipients tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailexcipients tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailexcipients tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailexcipients tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailexcipients tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailexcipients tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailexcipients').DataTable().row.add(columns).draw();
      $('#tabledetailexcipients select').select2();
      $('#tabledetailexcipients tbody tr:last').find('td').eq(2).addClass('text-center widthMaxContent');
      $('#tabledetailexcipients').DataTable().destroy();
      $('#tabledetailexcipients').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2] }]
      });
    });
    $('#tabledetailexcipients tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailexcipients tbody tr').length !== 1){
        $('#tabledetailexcipients').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <script>
    $(document).ready(function(){
        // Setup - add a text input to each header cell
        $('#tabledetailspecificidentification thead tr').clone(true).appendTo( '#tabledetailspecificidentification thead' );
        $('#tabledetailspecificidentification thead tr:eq(1) th').each( function (i) {
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

        $.fn.dataTableExt.ofnSearch['html-input'] = function(value) {
           return $(value).val();
        };
     
        var table = $('#tabledetailspecificidentification').DataTable({
            'orderCellsTop': true,
            'fixedHeader'  : true,
            'paging'       : true,
            'lengthChange' : true,
            'searching'    : true,
            'ordering'     : false,
            'info'         : true,
            'iDisplayLength': <?php echo 10 ?>,
            'autoWidth'    : true,
            'search'       : {'caseInsensitive': false},
            'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
        });
    });
    $( "#tabledetailspecificidentification thead th" ).click(function() {
      $( "#tabledetailspecificidentification thead th input" ).removeClass('hidden');
    });
    $('#tabledetailspecificidentification').on( 'click', '.fa-plus', function () {
      var tabledetailspecificidentification = document.getElementById('tabledetailspecificidentification');
      var columns = new Array(1);
      columns[0] = parseInt($(tabledetailspecificidentification.rows[$("#tabledetailspecificidentification tbody tr").length + 1].cells[0]).html().substring(0, $(tabledetailspecificidentification.rows[$("#tabledetailspecificidentification tbody tr").length + 1].cells[0]).html().indexOf("."))) + 1 + '.' + '<input type="hidden" id="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(0).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecificidentification tbody tr:last").find("td").eq(0).children().attr("id").split("_")[$("#tabledetailspecificidentification tbody tr:last").find("td").eq(0).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(0).children().attr("name") +'" value="'+ (parseInt($("#tabledetailspecificidentification tbody tr:last").find("td").eq(0).children().attr("value")) + parseInt("1")) +'" class="form-control required">';
      columns[1] = '<input type="text" id="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(1).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecificidentification tbody tr:last").find("td").eq(1).children().attr("id").split("_")[$("#tabledetailspecificidentification tbody tr:last").find("td").eq(1).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(1).children().attr("name") +'" value="" class="form-control required">';
      columns[2] = '<input type="text" id="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(2).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecificidentification tbody tr:last").find("td").eq(2).children().attr("id").split("_")[$("#tabledetailspecificidentification tbody tr:last").find("td").eq(2).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(2).children().attr("name") +'" value="" class="form-control required">';
      columns[3] = '<input type="text" id="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(3).children().attr("id").split("_")[0] +'_'+ (parseInt($("#tabledetailspecificidentification tbody tr:last").find("td").eq(3).children().attr("id").split("_")[$("#tabledetailspecificidentification tbody tr:last").find("td").eq(3).children().attr("id").split("_").length -1]) + parseInt("1")) +'" name="'+ $("#tabledetailspecificidentification tbody tr:last").find("td").eq(3).children().attr("name") +'" value="" class="form-control required">';
      columns[4] = '<div class="btn-group"><i class="btn btn-primary fa fa-plus"></i><i class="btn btn-danger fa fa-trash"></i></div>';

      $('#tabledetailspecificidentification').DataTable().row.add(columns).draw();
      $('#tabledetailspecificidentification select').select2();
      $('#tabledetailspecificidentification tbody tr:last').find('td').eq(4).addClass('text-center widthMaxContent');
      $('#tabledetailspecificidentification').DataTable().destroy();
      $('#tabledetailspecificidentification').DataTable({
        'orderCellsTop': true,
        'fixedHeader'  : true,
        'paging'       : true,
        'lengthChange' : true,
        'searching'    : true,
        'ordering'     : false,
        'info'         : true,
        'iDisplayLength': <?php echo -1 ?>,
        'autoWidth'    : true,
        'search'       : {'caseInsensitive': false},
        'columnDefs'   : [{ 'type': 'html-input', 'targets': [1, 2, 3, 4] }]
      });
    });
    $('#tabledetailspecificidentification tbody').on( 'click', '.fa-trash', function () {
      if($('#tabledetailspecificidentification tbody tr').length !== 1){
        $('#tabledetailspecificidentification').DataTable()
            .row( $(this).parents('tr'))
            .remove()
            .draw();
      }
    });
  </script>
  <?php 
    $nodes = 0;
    $currentLevel = 0;
    $i = 0;
    echo '
      <script>
          var defaultData = [
    ';
    if(!empty($ctdStructure))
    {
      foreach ($ctdStructure as $record)
      {
        if($record->moduleName == 'END'){
          break;
        }
        if($record->id <> 1 && $ctdStructure[$i-1]->id == $record->parentId){
          echo '
              nodes: [
          ';
          $nodes = $nodes + 1;
        }
        echo '
            {
              text: "'.$record->moduleName.' '.$record->description.'",
              href: "#div_'.$record->id.'",
        ';
        if($record->lastLevel == 1){
          echo '
            },
          ';
        }
        if($record->id <> 1 && $ctdStructure[$i+1]->parentId < $record->parentId){
          echo '
              ]
            },
          ';
          $nodes = $nodes - 1;
          $currentLevel = $nodes;
          for ($x = 1; $x <= $currentLevel; $x++) {
            if($ctdStructure[$i+1]->family <> $record->family){
              echo '
                  ]
                },
              ';
              $nodes = $nodes - 1;
            }
          }
        }
        $i++;
      }
    }
    echo '
          ]
      </script>
    ';
  ?>
  <script type="text/javascript">

    $(function() {

      $('#treeview8').treeview({
        expandIcon: "glyphicon glyphicon-stop",
        collapseIcon: "glyphicon glyphicon-unchecked",
        nodeIcon: "glyphicon glyphicon-user",
        color: "yellow",
        backColor: "purple",
        onhoverColor: "orange",
        borderColor: "red",
        showBorder: false,
        showTags: true,
        highlightSelected: true,
        selectedColor: "yellow",
        selectedBackColor: "darkorange",
        data: defaultData
      });

      $('#treeview10').treeview({
        color: "#428bca",
        enableLinks: true,
        data: defaultData
      });

      var search = function(e) {
        var pattern = $('#input-search').val();
        var options = {
          ignoreCase: $('#chk-ignore-case').is(':checked'),
          exactMatch: $('#chk-exact-match').is(':checked'),
          revealResults: $('#chk-reveal-results').is(':checked')
        };
        var results = $searchableTree.treeview('search', [ pattern, options ]);

        var output = '<p>' + results.length + ' matches found</p>';
        $.each(results, function (index, result) {
          output += '<p>- ' + result.text + '</p>';
        });
        $('#search-output').html(output);
      }

      $('#btn-search').on('click', search);
      $('#input-search').on('keyup', search);

      $('#btn-clear-search').on('click', function (e) {
        $searchableTree.treeview('clearSearch');
        $('#input-search').val('');
        $('#search-output').html('');
      });


      var initSelectableTree = function() {
        return $('#treeview-selectable').treeview({
          data: defaultData,
          levels: 3,
          // enableLinks: true,
          multiSelect: $('#chk-select-multi').is(':checked'),
          onNodeSelected: function(event, node) {
            $(node.href).show();
            divId = node.href;
            CKEDITOR.replace('folderData'+divId.substring(divId.indexOf("_"), divId.length));
          },
          onNodeUnselected: function (event, node) {
            $(node.href).hide();
          }
        });
      };
      var $selectableTree = initSelectableTree();

      var findSelectableNodes = function() {
        return $selectableTree.treeview('search', [ $('#input-select-node').val(), { ignoreCase: false, exactMatch: false } ]);
      };
      var selectableNodes = findSelectableNodes();

      $('#chk-select-multi:checkbox').on('change', function () {
        console.log('multi-select change');
        $selectableTree = initSelectableTree();
        selectableNodes = findSelectableNodes();          
      });

      // Select/unselect/toggle nodes
      $('#input-select-node').on('keyup', function (e) {
        selectableNodes = findSelectableNodes();
        $('.select-node').prop('disabled', !(selectableNodes.length >= 1));
      });

      $('#btn-select-node.select-node').on('click', function (e) {
        $selectableTree.treeview('selectNode', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
      });

      $('#btn-unselect-node.select-node').on('click', function (e) {
        $selectableTree.treeview('unselectNode', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
      });

      $('#btn-toggle-selected.select-node').on('click', function (e) {
        $selectableTree.treeview('toggleNodeSelected', [ selectableNodes, { silent: $('#chk-select-silent').is(':checked') }]);
      });

    });
  </script>
  <script>
    $("#formSave").click(function() { 
      $('#licenseStatus').val('Save');
    });
    $("#formSubmit").click(function() { 
      $('#licenseStatus').val('Submit');
    });
  </script>
  <script type="text/javascript">
    // $(window).on('beforeunload', function(){
    //      return false;
    //  });
  </script>