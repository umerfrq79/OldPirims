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
<div class="content-wrapper" style="background: url('<?php echo base_url(); ?>/assets/dist/img/<?php echo $this->wallpaper ?>') !important; background-size:100% 100%;">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: #dedada;"><i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName; ?></h1>
        </div>
        <div class="col-sm-6">
          <h1><a href="<?php echo base_url(); ?>" style="background-color: #3e8193 !important;" class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Go Back</a></h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-md-12 text-center">
          <div class="form-group">
            <a class="btn btn-primary" href="<?php echo base_url(); ?>country">Countries</a>
            <a class="btn btn-warning" href="<?php echo base_url(); ?>state">States</a>
            <a class="btn btn-danger" href="<?php echo base_url(); ?>city">Cities</a>
          </div>
        </div>

        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
          <div class="form-group">
            <label>System</label>
            <select class="form-control select2" id="system" name="system">
              <option value="Active" <?php if('Active' == $records[0]->mode){ echo 'selected'; } ?>>Active</option>
              <option value="Maintenance" <?php if('Maintenance' == $records[0]->mode){ echo 'selected'; } ?>>Maintenance</option>
            </select>
          </div>
        </div>
        <div class="col-md-4">
        </div>

        <div class="col-md-4">
        </div>
        <div class="col-md-4 text-center">
          <div class="form-group">
            <label>Database Backup</label>
            <div><a class="btn btn-sm btn-success col-md-4 col-md-push-4" id="backupDB" title="Backup Database"><i class="far fa-hdd fa-5x"></i></a></div>
          </div>
        </div>
        <div class="col-md-4">
        </div>

        <script>
          $(document).ready(function(){
            $('#system').change(function(){
              var system = $('#system').val();
              if(system != '0')
              {
               $.ajax({
                url:"<?php echo base_url(); ?>login/systemUpdate",
                method:"POST",
                data:{system:system},
                success:function(data)
                {
                 location.reload();
                }
               });
              }
            });
          });
        </script>
        <script>
          $(document).ready(function(){
            $('#backupDB').click(function(){
               $.ajax({
                url:"<?php echo base_url(); ?>login/backupDB",
                method:"POST",
                success:function(data)
                {
                 location.reload();
                }
               });
            });
          });
        </script>

      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
  
</script>