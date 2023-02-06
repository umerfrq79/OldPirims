<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $pageTitle; ?></title>
  <link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/MedRS/logo/logo.png"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">

  <!--############################### UP CSS ######################################### -->

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <!-- <link rel="stylesheet" href="<?php //echo base_url(); ?>assets/dist/css/skins/skin-blue.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper" style="height: 92vh;">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="margin-left: 0px;">
          <!-- Content Header (Page header) -->
          <div class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>
                    404
                    <small> Page not found.</small>
                  </h1>
                </div>
                <div class="col-sm-6">
                  <h1><a href="<?php echo base_url(); ?>" style="background-color: #3e8193 !important;" class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Go Back</a></h1>
                </div>
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->
          <!-- Main content -->
          <div class="content">
            <div class="container-fluid">
              <div class="row">

                <div class="col-md-12 text-center">
                    <h3><p>We could not find the page you were looking for.</p></h3>

                    <i class="fas fa-exclamation-triangle text-warning fa-9x"></i>
                </div>

              </div>
            </div>
          </div>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
       <footer class="main-footer" id="myFooter" style="margin-left: 0px; cursor: default;">
        <!-- To the right -->
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"><?php echo 'The U.S. Pharmacopeial Convention'; ?></a>.</strong> All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
          <b><?php echo 'MedRS'; ?></b> | <b>Version</b> 3.1.0-rc | Powered By: <span><b><a href="https://www.usp.org" target="_blank">USP | PQM (usp.org)</a></b><span>
        </div>
      </footer>
    </div>
</body>
</html>