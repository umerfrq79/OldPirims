<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRAP | Lockscreen</title>
  <link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen" style="background: url('assets/dist/img/<?php echo $this->wallpaper ?>'); background-size:100% 100%; overflow-y: hidden;">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="<?php echo base_url(); ?>" class="h1"><b><?php echo $this->companyProject; ?></b></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name"><?php echo $this->userName; ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/profilepic/<?php echo $this->profilepic; ?>" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form action="<?php echo base_url(); ?>unlockMe" method="post" class="lockscreen-credentials">
      <div class="input-group">
        <input type="hidden" name="email" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" value="<?php echo $this->session->userdata('userEmail') ?>" class="form-control" placeholder="Email">
        <input type="password" name="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" class="form-control" placeholder="password">

        <div class="input-group-append">
          <button type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <!-- /.lockscreen-item -->
  <div class="help-block text-center">
    Enter your password to retrieve your session
  </div>
  <!-- <div class="text-center">
    <a href="<?php echo base_url(); ?>logout">Or sign in as a different user</a>
  </div> -->
  <div class="lockscreen-footer text-center">
    Copyright &copy; <?php echo date('Y'); ?> <b><a href="<?php echo base_url(); ?>" style="color:#3f51b5;" class="text-black"><?php echo $this->companyAddress; ?></a></b><br>
    All rights reserved
  </div>
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
