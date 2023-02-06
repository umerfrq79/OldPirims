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
      <?php echo '<form id="myForm" action="'.base_url().$pageTitle[0]->url.'/lookup" enctype="multipart/form-data" method="post" accept-charset="utf-8">';?>
        <div class="card card-success card-outline1">
          <div class="card-header">
            <h3 class="card-title">Search Filters</h3>

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

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'From Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'fromDate'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div> -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'To Date'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'toDate'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div> -->

              <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'INN Name'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'innManual'; ?>
                    <input <?php if($myAction == 'view'){echo 'disabled';}?> type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="<?php echo @$recordsEdit[0]->$column; ?>" class="form-control">
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Show Total Brands'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'totalBrands'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div> -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Show Total Batch Qty'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'totalBatchQty'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div> -->

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <?php $label = 'Show Total API Qty Imported'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'totalAPIQtyImported'; ?>
                  <select <?php if($myAction == 'view'){echo 'disabled';}?> class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                    <option value="No" <?php if('No' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>No</option>
                    <option value="Yes" <?php if('Yes' == @$recordsEdit[0]->$column){ echo 'selected'; } ?>>Yes</option>
                  </select>
                </div>
              </div> -->

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="border-top: 3px solid #28a744 !important;">
            <?php echo '<input type="submit" class="btn btn-success" value="Search">';?>
          </div>
        <!-- /.card -->
        </div>
        <!-- /.row -->
      <?php if(@$records){ ?>
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4" onclick="setS1()">
            <div class="info-box" id="b1">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Manufacturers</span>
                <span class="info-box-number"><?php echo @$records[0]->countManufacturer; ?><small></small>
                </span>
              </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4" onclick="setS2()">
            <div class="info-box" id="b2">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clinic-medical"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Brands / Products</span>
                <span class="info-box-number"><?php echo @$countProducts[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4" onclick="setS3()">
            <div class="info-box" id="b3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-leaf"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">API Imported</span>
                <span class="info-box-number"><?php echo @$countAPIImported[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4" onclick="setS4()">
            <div class="info-box" id="b4">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Packs Released</span>
                <span class="info-box-number"><?php echo @$countPacksReleased[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
        </div>
        <input type="hidden" id="manufacturerS" name="manufacturerS" value="" class="form-control">
      </div>
    </div>
    <!-- /.container-fluid -->
    <?php } ?>
    <?php echo '</form>';?>

    <?php if(@$parameters['manufacturerS']){ ?>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Details</h3>
              <div class="card-tools">
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive cardBodyTransaction">
              <table id="table" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.#</th>
                  <?php if(@$parameters['manufacturerS'] == 'Manufacturer'){ ?>
                  <th>Name</th>
                  <th>Address</th>
                  <th>Contact No.</th>
                  <th>Email</th>
                  <th>Contact Person</th>
                  <?php } ?>
                  <?php if(@$parameters['manufacturerS'] == 'Products'){ ?>
                  <th>Brand Name</th>
                  <th>Strength</th>
                  <th>Unit</th>
                  <th>Manufacturer</th>
                  <th>Pack Size</th>
                  <th>Price</th>
                  <?php } ?>
                  <?php if(@$parameters['manufacturerS'] == 'API Imported'){ ?>
                  <th>Importer</th>
                  <th>Qty Imported</th>
                  <th>Importer Contact No.</th>
                  <th>Manufacturer of API</th>
                  <th>Date of NOC/Import</th>
                  <?php } ?>
                  <?php if(@$parameters['manufacturerS'] == 'Packs Released'){ ?>
                  <th>Brand Name</th>
                  <th>Batches</th>
                  <th>Qty</th>
                  <th>Pack Size</th>
                  <?php } ?>
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
                    <?php if(@$parameters['manufacturerS'] == 'Manufacturer'){ ?>
                    <td><?php echo $record->companyName; ?></td>
                    <td><?php echo $record->address; ?></td>
                    <td><?php echo $record->phone; ?></td>
                    <td><?php echo $record->email; ?></td>
                    <td><?php echo $record->name; ?></td>
                    <?php } ?>
                    <?php if(@$parameters['manufacturerS'] == 'Products'){ ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php } ?>
                    <?php if(@$parameters['manufacturerS'] == 'API Imported'){ ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php } ?>
                    <?php if(@$parameters['manufacturerS'] == 'Packs Released'){ ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?php } ?>
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
    <?php } ?>
  </section>
  <!-- /.content -->
</div>

<script type="text/javascript">
  loadMyTable('table', true, 15);

  function setS1(){
    $('#manufacturerS').val('Manufacturer');
    $('#b1').css({ border: "3px solid #28a744" });
    $('#b2').css({ border: "0px solid #28a744" });
    $('#b3').css({ border: "0px solid #28a744" });
    $('#b4').css({ border: "0px solid #28a744" });
  }
  function setS2(){
    $('#manufacturerS').val('Products');
    $('#b2').css({ border: "3px solid #28a744" });
    $('#b1').css({ border: "0px solid #28a744" });
    $('#b3').css({ border: "0px solid #28a744" });
    $('#b4').css({ border: "0px solid #28a744" });
  }
  function setS3(){
    $('#manufacturerS').val('API Imported');
    $('#b3').css({ border: "3px solid #28a744" });
    $('#b1').css({ border: "0px solid #28a744" });
    $('#b2').css({ border: "0px solid #28a744" });
    $('#b4').css({ border: "0px solid #28a744" });
  }
  function setS4(){
    $('#manufacturerS').val('Packs Released');
    $('#b4').css({ border: "3px solid #28a744" });
    $('#b1').css({ border: "0px solid #28a744" });
    $('#b2').css({ border: "0px solid #28a744" });
    $('#b3').css({ border: "0px solid #28a744" });
  }
</script>