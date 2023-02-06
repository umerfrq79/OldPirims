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
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i <?php echo "class='".$pageTitle[0]->icon."'"; ?>></i> <?php echo $pageTitle[0]->friendlyName; ?></h1>
        </div>
        <div class="col-sm-6">
          <h1><a href="<?php echo base_url(); ?>" style="background-color: #3e8193 !important;" class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Go Back</a></h1>
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
    <div class="container-fluid">
      <form id="myForm" action="<?php echo base_url().$pageTitle[0]->url.'/submit'; ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="card card-primary card-outline1">
          <div class="card-header">
            <h3 class="card-title">Configure</h3>

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

              <div class="col-md-12" style="display: none;">
                <div class="form-group">
                  <?php $label = 'Wallpaper'; ?>
                  <label><?php echo $label; ?></label>
                  <?php $column = 'wallpaper'; ?>
                    <select class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                      <option value="" <?php if('' == $this->wallpaper){ echo 'selected'; } ?>>Select <?php echo @$label; ?></option>
                      <option value="wp1.jpg" <?php if('wp1.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 1</option>
                      <option value="wp4.jpg" <?php if('wp4.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 4</option>
                      <option value="wp6.jpg" <?php if('wp6.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 6</option>
                      <option value="wp10.jpg" <?php if('wp10.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 10</option>
                      <option value="wp15.jpg" <?php if('wp15.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 15</option>
                      <option value="wp24.jpg" <?php if('wp24.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 24</option>
                      <option value="wp31.jpg" <?php if('wp31.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 31</option>
                      <option value="photo3.jpg" <?php if('photo3.jpg' == $this->wallpaper){ echo 'selected'; } ?>>Wallpaper 31</option>
                    </select>
                </div>
              </div>

              <!-- /.row -->
            </div>
            
            <div class="row">
              <!-- row -->

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp1.jpg" <?php if('wp1.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp4.jpg" <?php if('wp4.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp6.jpg" <?php if('wp6.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp10.jpg" <?php if('wp10.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <!-- /.row -->
            </div>
            
            <div class="row">
              <!-- row -->

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp15.jpg" <?php if('wp15.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp24.jpg" <?php if('wp24.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/wp31.jpg" <?php if('wp31.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <img src="<?php echo base_url(); ?>/assets/dist/img/photo3.jpg" <?php if('photo3.jpg' == $this->wallpaper){echo "style='border:10px solid #3c8dbc'" ;} ?> width="100%" onclick="setPic(this)">
                </div>
              </div>

              <!-- /.row -->
            </div>

            <script type="text/javascript">
              function setPic(value){
                wallpaper = $(value).attr('src');
                wallpaper = wallpaper.substring(wallpaper.lastIndexOf('/') + 1, wallpaper.length);
                $('#wallpaper').val(wallpaper).trigger('change');
                $('img').removeAttr('style');
                $(value).css('border', '10px solid #3c8dbc');
              }
            </script>

          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <input type="submit" onclick="return confirm('Are you sure you want to save this setting?')" class="btn btn-primary" value="Submit">
          </div>
        <!-- /.card -->
        </div>
        <!-- /.row -->
      </form>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>

<script type="text/javascript">
  
</script>