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

        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <div class="col-md-12">

            <div class="row">
              <div class='col-md-4'>
                  <div class='small-box bg-primary myDashboardTile' style='cursor: default; padding:3%;'>
                      <a href='<?php echo base_url() ?>dashboard/Licensing' class='small-box-footer myDashboardTile'>
                      <div class='inner'>
                      <i class='fa fa-certificate fa-5x'></i>
                      </div>
                      <b>Licensing</b>
                      </a>
                  </div>
              </div>

              <div class='col-md-4'>
                  <div class='small-box bg-orange myDashboardTile' style='cursor: default; padding:3%;'>
                      <a href='<?php echo base_url() ?>dashboard/Registration' class='small-box-footer myDashboardTile'>
                      <div class='inner'>
                      <i class='far fa-edit fa-5x'></i>
                      </div>
                      <b>Registration</b>
                      </a>
                  </div>
              </div>

              <div class='col-md-4'>
                  <div class='small-box bg-green myDashboardTile' style='cursor: default; padding:3%;'>
                      <a href='<?php echo base_url() ?>dashboard/Inspection' class='small-box-footer myDashboardTile'>
                      <div class='inner'>
                      <i class='fa fa-search fa-5x'></i>
                      </div>
                      <b>Inspection</b>
                      </a>
                  </div>
              </div>
            </div>

            </div>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="col-md-12">

              <div class="row">
                <div class='col-md-4'>
                    <div class='small-box bg-maroon myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/AMC' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-heartbeat fa-5x'></i>
                        </div>
                        <b>AMC</b>
                        </a>
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class='small-box bg-black myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/Lab Testing' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-flask fa-5x'></i>
                        </div>
                        <b>Lab Testing</b>
                        </a>
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class='small-box bg-red myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/PV' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-medkit fa-5x'></i>
                        </div>
                        <b>PV</b>
                        </a>
                    </div>
                </div>
              </div>

            </div>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="col-md-12">

              <div class="row">
                <div class='col-md-4'>
                    <div class='small-box bg-brown myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/R and I' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-exchange-alt fa-5x'></i>
                        </div>
                        <b>R and I</b>
                        </a>
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class='small-box bg-purple myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/Lot Release' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-sign-out-alt fa-5x'></i>
                        </div>
                        <b>Lot Release</b>
                        </a>
                    </div>
                </div>

                <div class='col-md-4'>
                    <div class='small-box bg-warning myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/Pricing' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-dollar-sign fa-5x'></i>
                        </div>
                        <b>Pricing</b>
                        </a>
                    </div>
                </div>
              </div>

            </div>
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="col-md-12">

              <div class="row">
                <div class='col-md-4'>
                    <div class='small-box bg-pink myDashboardTile' style='cursor: default; padding:3%;'>
                        <a href='<?php echo base_url() ?>dashboard/API FPP Shortage' class='small-box-footer myDashboardTile'>
                        <div class='inner'>
                        <i class='fa fa-filter fa-5x'></i>
                        </div>
                        <b>API / FPP Shortage</b>
                        </a>
                    </div>
                </div>
              </div>

            </div>
        </div>
        <div class="col-md-3">
        </div>

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
  
</script>