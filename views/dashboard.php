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
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-md-12">
          <h1 class="m-0"><i class="fas fa-tachometer-alt"></i> Dashboard - <?php echo $this->department.' '.$this->designation; ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <br>
      <div id="myDashboardHead" style="box-shadow: -20px -6px 20px 0px #bbbbbb !important;">
      <b id="welcomeText">
        <font color="#000" face1="century gothic">Welcome Back <font style="color: #00a558;"><?php echo $this->userName; ?></font></font>
      </b>
      </div>

      <br>
      <div class="row">
          <!-- Director, Additional Director, Assigning Officer Licensing -->
          <?php if($this->roleId == 6 || $this->roleId == 10 || $this->roleId == 38 || $this->roleId == 43){?>
              <div class="col-md-6">
                  <!--<div class="row">
                      <div class="col-12 col-sm-6 col-md-4">
                          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                              <div class="info-box">
                                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-certificate"></i></span>
                                  <div class="info-box-content">
                                      <span class="info-box-text">Pending License</span>
                                      <span class="info-box-number"><?php echo @$pendingLicense[0]->resultCount; ?><small></small>
                </span>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4">
                          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                              <div class="info-box">
                                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-certificate"></i></span>
                                  <div class="info-box-content">
                                      <span class="info-box-text">Approved License</span>
                                      <span class="info-box-number"><?php echo @$approvedLicense[0]->resultCount; ?><small></small>
                </span>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4">
                          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
                              <div class="info-box">
                                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-certificate"></i></span>
                                  <div class="info-box-content">
                                      <span class="info-box-text">Cancelled License</span>
                                      <span class="info-box-number"><?php echo @$troubleLicense[0]->resultCount; ?><small></small>
                </span>
                                  </div>
                              </div>
                          </a>
                      </div>
                      <div class="col-12 col-sm-6 col-md-4">
                          <a href="<?php echo base_url().'importlicense/lookup/' ?>">
                              <div class="info-box">
                                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-exchange-alt"></i></span>
                                  <div class="info-box-content">
                                      <span class="info-box-text">DML Authentication</span>
                                      <span class="info-box-number"><?php echo @$pendingDML[0]->resultCount; ?><small></small>
                </span>
                                  </div>
                              </div>
                          </a>
                      </div>
                  </div>-->
                  <div class="card collapsed-card">
                      <div class="card-header ui-sortable-handle" style="cursor:pointer;" data-card-widget="collapse">
                          <h3 class="card-title">DML Authentication</h3>
                          <div class="card-tools d-none">
                              <span title="3 New Messages" class="badge badge-primary">3</span>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>

                      <div class="card-body" style="display: none;">
                          <ul class="list-group list-group-flush">
                              <?php
                              foreach (@$inprocessRecord as $irecord){
                                  ?>
                                  <li class="list-group-item"><a href="#"><strong><?php echo $irecord->licenseStatus; ?></strong><span class="float-right badge bg-info"><?php echo $irecord->totalapplications; ?></span></a></li>
                                  <?php
                              }
                              ?>

                          </ul>
                      </div>

                      <!--
                      <div class="card-footer" style="display: block;">

                      </div>
                      -->

                  </div>
                  <div class="card collapsed-card">
                      <div class="card-header ui-sortable-handle" style="cursor:pointer;" data-card-widget="collapse">
                          <h3 class="card-title">New Licenses</h3>
                          <div class="card-tools d-none">
                              <span title="3 New Messages" class="badge badge-primary">3</span>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>

                      <div class="card-body" style="display: none;">
                          <ul class="list-group list-group-flush">
                              <?php
                              foreach (@$newlicenseRecord as $irecord){
                                  ?>
                                  <li class="list-group-item"><a href="#"><strong><?php echo $irecord->licenseStatus; ?></strong><span class="float-right badge bg-info"><?php echo $irecord->totalapplications; ?></span></a></li>
                                  <?php
                              }
                              ?>

                          </ul>
                      </div>

                      <!--
                      <div class="card-footer" style="display: block;">

                      </div>
                      -->

                  </div>
                  <div class="card collapsed-card">
                      <div class="card-header ui-sortable-handle" style="cursor:pointer;" data-card-widget="collapse">
                          <h3 class="card-title">License Variance</h3>
                          <div class="card-tools d-none">
                              <span title="3 New Messages" class="badge badge-primary">3</span>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>

                      <div class="card-body" style="display: none;">
                          <ul class="list-group list-group-flush">
                              <?php
                              foreach (@$variancelicenseRecord as $irecord){
                                  ?>
                                  <li class="list-group-item"><a href="#"><strong><?php echo $irecord->licenseStatus; ?></strong><span class="float-right badge bg-info"><?php echo $irecord->totalapplications; ?></span></a></li>
                                  <?php
                              }
                              ?>

                          </ul>
                      </div>


                  </div>
                  <div class="card collapsed-card">
                      <div class="card-header ui-sortable-handle" style="cursor:pointer;" data-card-widget="collapse">
                          <h3 class="card-title">License Renewal</h3>
                          <div class="card-tools d-none">
                              <span title="3 New Messages" class="badge badge-primary">3</span>
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>

                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>

                      <div class="card-body" style="display: none;">
                          <ul class="list-group list-group-flush">
                              <?php
                              foreach (@$renewalLicenseRecord as $irecord){
                                  ?>
                                  <li class="list-group-item"><a href="#"><strong><?php echo $irecord->licenseStatus; ?></strong><span class="float-right badge bg-info"><?php echo $irecord->totalapplications; ?></span></a></li>
                                  <?php
                              }
                              ?>

                          </ul>
                      </div>


                  </div>

              </div>
              <div class="col-md-6">
                  <div class="card card-primary card-outline collapsed-card"  style="cursor:pointer;" data-card-widget="collapse">
                      <div class="card-header">
                          <h3 class="card-title">Officer Wise Report</h3>
                          <div class="card-tools">
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body table-responsive cardBodyTransaction" style="display: none">
                          <table id="officerReport" class="table table-bordered table-striped" style="width: 100%">
                              <thead>
                              <tr>
                                  <th>S.#</th>
                                  <th class="text-center">Officer Name</th>
                                  <th class="text-center">No. of Applications</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php $sn=1;
                              ?>
                              <?php
                              if(!empty($officersRecord))
                              {
                                  foreach($officersRecord as $record)
                                  {
                                      ?>
                                      <tr>
                                          <td><?=$sn?>.</td>
                                          <td><a href="<?php echo base_url() ?>applicationHistory/licensing/<?php echo $record->forwardedTo; ?>"><?php echo $record->userName; ?></a></td>
                                          <td><?php echo $record->totalapplications; ?></td>
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
          <?php } ?>
          <!-- Deputy Director, Assistant Director, Secretary Licensing -->
          <?php if( $this->roleId == 14 || $this->roleId == 18){?>
        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-certificate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending License</span>
                <span class="info-box-number"><?php echo @$pendingLicense[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4 d-none">
          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-certificate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Priority License</span>
                <span class="info-box-number"><?php echo @$priorityLicense[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-certificate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Approved License</span>
                <span class="info-box-number"><?php echo @$approvedLicense[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'newlicense/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-certificate"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Cancelled License</span>
                <span class="info-box-number"><?php echo @$troubleLicense[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>
		<div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'importlicense/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-exchange-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Pending DML or InProcess Data</span>
                <span class="info-box-number"><?php echo @$pendingDML[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>
        <?php } ?>
          <?php if($this->roleId == 12 || $this->roleId == 16 || $this->roleId == 20 || $this->roleId == 36 || $this->roleId == 37){?>
              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'inspection/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-search"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Inspection in Draft</span>
                              <span class="info-box-number"><?php echo @$inspectionDraft[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>
              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'inspection/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-primary elevation-1"><i class="fa fa-search"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Inspection Scheduled</span>
                              <span class="info-box-number"><?php echo @$inspectionScheduled[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'inspection/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-warning elevation-1"><i class="fa fa-search"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Inspection Pending</span>
                              <span class="info-box-number"><?php echo @$inspectionPending[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'inspection/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-success elevation-1"><i class="fa fa-search"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Inspection Initiated</span>
                              <span class="info-box-number"><?php echo @$inspectionInitiated[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'inspection/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-danger elevation-1"><i class="fa fa-search"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Inspection Completed</span>
                              <span class="info-box-number"><?php echo @$inspectionCompleted[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

          <?php } ?>
          <?php if($this->roleId == 7 || $this->roleId == 11 || $this->roleId == 15 || $this->roleId == 19 || $this->roleId == 39 || $this->roleId == 44 || $this->roleId == 45 || $this->roleId == 51 || $this->roleId == 53 || $this->roleId == 54 || $this->roleId == 55){?>
              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'newregistration/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-certificate"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Submitted</span>
                              <span class="info-box-number"><?php echo @$pendingRegistration[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'newregistration/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-certificate"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Returned</span>
                              <span class="info-box-number"><?php echo @$returnedRegistration[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'newregistration/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-success elevation-1"><i class="fas fa-certificate"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Approved</span>
                              <span class="info-box-number"><?php echo @$approvedRegistration[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>

              <div class="col-12 col-sm-6 col-md-4">
                  <a href="<?php echo base_url().'newregistration/lookup/' ?>">
                      <div class="info-box">
                          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-certificate"></i></span>
                          <div class="info-box-content">
                              <span class="info-box-text">Rejected</span>
                              <span class="info-box-number"><?php echo @$rejectedRegistration[0]->resultCount; ?><small></small>
                </span>
                          </div>
                      </div>
                  </a>
              </div>
          <?php } ?>
        <?php if($this->roleId == 52){?>
        <!-- <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'report/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Manufacturers</span>
                <span class="info-box-number"><?php echo @$countManufacturer[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'report/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-clinic-medical"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Brands / Products</span>
                <span class="info-box-number"><?php echo @$countProducts[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'report/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-leaf"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">API Imported</span>
                <span class="info-box-number"><?php echo @$countAPIImported[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <a href="<?php echo base_url().'report/lookup/' ?>">
            <div class="info-box">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-box"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Packs Released</span>
                <span class="info-box-number"><?php echo @$countPacksReleased[0]->resultCount; ?><small></small>
                </span>
              </div>
            </div>
          </a>
        </div> -->
        <?php } ?>

      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url(); ?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard3.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard2.js"></script>

<script type="text/javascript">
    loadMyTable('officerReport', true, 15);
</script>