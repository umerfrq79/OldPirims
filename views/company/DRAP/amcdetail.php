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
                <div class="row justify-content-center">
                    <div class="col-md-4">

              <form action="<?php echo base_url().$pageTitle[0]->url.'/lookup/' ?>" method="POST">
                  <div class="row justify-content-center">
                      <div class="col-md-12">
                          <div class="form-group">
                              <?php $label = 'Drug'; ?>
                              <!--<label><?php echo $label; ?></label>-->
                              <?php $column = 'drugname'; ?>
                              <select required style="height: inherit" autofocus class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                  <option value="">Select <?php echo @$label; ?></option>
                                  <?php
                                  if(!empty($drugs))
                                  {
                                      foreach ($drugs as $drug)
                                      {
                                          ?>
                                          <option value="<?php echo $drug->name ?>" <?php echo isset($drugname) && $drugname == $drug->name?'selected':''; ?> ><?php echo $drug->name.' (<small>'.$drug->code.'</small>)'; ?></option>
                                          <?php
                                      }
                                  }
                                  ?>
                              </select>
                          </div>
                      </div>
                  </div>

                  <div class="row justify-content-center">
                      <div class="col-md-4">
                          <input type="submit" value="Search" class="btn btn-primary" name="" id="">
                      </div>
                  </div>

              </form>

                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->
    </div>
        <?php if(isset($drugname) && !empty($drugname)){ ?>
    <!-- /.container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline" style="background-color: #d2d2d2;">

                        <!-- /.card-header -->
                        <div class="card-body table-responsive cardBodyTransaction">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Material Imported</span>
                                                <span class="info-box-number"><?php echo 0; ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">FPP Produced</span>
                                                <span class="info-box-number"><?php echo 0; ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="javascript:displayRecord('#regBrands');">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Registered Brands</span>
                                                <span class="info-box-number"><?php echo count(@$regBrands); ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="javascript:displayRecord('#regManuf');">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-indigo elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Registered Manufacturers</span>
                                                <span class="info-box-number"><?php echo count(@$regManufacturers); ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-lightblue elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Distribution</span>
                                                <span class="info-box-number"><?php echo 0; ?><small></small>
                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-olive elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Retail Inventory</span>
                                                <span class="info-box-number"><?php echo 0; ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-12 col-sm-6 col-md-4">
                                    <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-maroon elevation-1"><i class="fas fa-certificate"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">FPP Dispensed</span>
                                                <span class="info-box-number"><?php echo 0; ?><small></small></span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>

        <div class="container-fluid">
            <div id="regBrands" class="row recordDetail">
                    <div class="col-12">
                        <div class="card card-primary card-outline">

                            <div class="card-header">
                                <h3 class="card-title">Registered Brands</h3>
                                <div class="card-tools">
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive cardBodyTransaction">
                             <table id="regBrandsTable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>S.#</th>
                                        <th>Registration No.</th>
                                        <th>Brand Name</th>
                                        <th>Company</th>
                                        <th>Address</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sn=1; ?>
                                    <?php
                                    if(!empty(@$regBrands))
                                    {
                                        foreach($regBrands as $record)
                                        {
                                            ?>
                                            <tr>
                                                <td><?=$sn?>.</td>
                                                <td><?php echo $record->registrationNo; ?></td>
                                                <td><?php echo $record->approvedName; ?></td>
                                                <td><?php echo $record->companyName; ?></td>
                                                <td><?php echo $record->companyAddress; ?></td>
                                            </tr>
                                            <?php $sn++ ?>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>

                                </table>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <div id="regManuf" class="row recordDetail">
                <div class="col-12">
                    <div class="card card-primary card-outline">

                        <div class="card-header">
                            <h3 class="card-title">Registered Manufacturers</h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive cardBodyTransaction">
                            <table id="regManufTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>S.#</th>
                                    <th>Company</th>
                                    <th>Address</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php $sn=1; ?>
                                <?php
                                if(!empty(@$regManufacturers))
                                {
                                    foreach($regManufacturers as $record)
                                    {
                                        ?>
                                        <tr>
                                            <td><?=$sn?>.</td>
                                            <td><?php echo $record->companyName; ?></td>
                                            <td><?php echo $record->companyAddress; ?></td>
                                        </tr>
                                        <?php $sn++ ?>
                                        <?php
                                    }
                                }
                                ?>
                                </tbody>

                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- /.container-fluid -->

            <?php
        }
    } ?>

  </section>
  <!-- /.content -->
</div>

<script type="text/javascript">
  loadMyTable('table', true, 15);
  loadMyTable('regBrandsTable', true, 15);
  loadMyTable('regManufTable', true, 15);

  $("#formSave").click(function() { 
    $('#amcStatus').val('Save');
  });
  $("#formSubmit").click(function() { 
    $('#amcStatus').val('Submit');
  });
  function displayRecord(id){
      $(".recordDetail").hide();
      $(id).show();
      $('html, body').animate({ scrollTop: $(id).offset().top }, 'slow');

  }
</script>
<style>
    .recordDetail{
        display: none;
    }
</style>
