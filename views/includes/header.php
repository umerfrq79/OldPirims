<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $pageTitle; ?></title>
  <link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- jsGrid -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jsgrid/jsgrid.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jsgrid/jsgrid-theme.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/codemirror/codemirror.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/codemirror/theme/monokai.css"> -->
  <!-- bootstrap slider -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-slider/css/bootstrap-slider.min.css"> -->
  <!-- Ion Slider -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fullcalendar/main.css">
  <!-- pace-progress -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/pace-progress/themes/black/pace-theme-flat-top.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/jqvmap/jqvmap.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css"> -->
  <!-- BS Stepper -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bs-stepper/css/bs-stepper.min.css"> -->
  <!-- dropzonejs -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.css"> -->
  <!-- SimpleMDE -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/simplemde/simplemde.min.css"> -->
  <!-- SweetAlert2 -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->
  <!-- Toastr -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css"> -->
  <!-- flag-icon-css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/flag-icon-css/css/flag-icon.min.css">
  <!-- Bootstrap Treeview -->
  <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/vendors/bootstrap-treeview-master/bootstrap-treeview-master/dist/bootstrap-treeview.css"> -->

  <!--############################### UP CSS ######################################### -->

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

  <!--############################### CUSTOM CSS ######################################### -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/style/css/myStyle.css">
  <!--############################### CUSTOM CSS ######################################### -->

  <style type="text/css">
    table>tbody>tr:hover {
      background-color: #f5f5f5 !important;
    }
    .pageLoaderBackground{
      background-color: #000;
    }
    .pageLoader{
      //background-color: grey;
      opacity: 0.4;
      pointer-events:none;
    }
    .loader {
      width:100%;
      top: 50%;
      position:fixed;
      z-index:9999;
      color: #3c8dbc;
      text-align: center;
    }
  </style>

  <!--############################### DOWN JS ######################################### -->

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?php echo base_url(); ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- InputMask -->
  <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/inputmask/jquery.inputmask.min.js"></script>
  <!-- date-range-picker -->
  <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap color picker -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url(); ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- CodeMirror -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/codemirror/codemirror.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/codemirror/mode/css/css.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/codemirror/mode/xml/xml.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script> -->
  <!-- DataTables  & Plugins -->
  <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jszip/jszip.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- jsGrid -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/jsgrid/demos/db.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jsgrid/jsgrid.min.js"></script> -->
  <!-- Bootstrap slider -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-slider/bootstrap-slider.min.js"></script> -->
  <!-- fullCalendar 2.2.5 -->
  <script src="<?php echo base_url(); ?>assets/plugins/moment/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/fullcalendar/main.js"></script>
  <!-- Ion Slider -->
  <script src="<?php echo base_url(); ?>assets/plugins/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
  <!-- pace-progress -->
  <script src="<?php echo base_url(); ?>assets/plugins/pace-progress/pace.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url(); ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- Bootstrap4 Duallistbox -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script> -->
  <!-- Bootstrap Switch -->
  <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
  <!-- BS-Stepper -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/bs-stepper/js/bs-stepper.min.js"></script> -->
  <!-- dropzonejs -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/dropzone/min/dropzone.min.js"></script> -->
  <!-- jquery-validation -->
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- SweetAlert2 -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script> -->
  <!-- Toastr -->
  <!-- <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script> -->
  <!-- Bootstrap Treeview -->
  <!-- <script src="<?php echo base_url(); ?>assets/dist/vendors/bootstrap-treeview-master/bootstrap-treeview-master/dist/bootstrap-treeview.min.js"></script> -->
  <!-- Webcam -->
  <script src="<?php echo base_url(); ?>assets/dist/vendors/WebcamJS-1.0.25/WebcamJS-1.0.25.js"></script>
  <!-- HTML2Canvas -->
  <script src="<?php echo base_url(); ?>assets/dist/vendors/html2canvas/html2canvas.js"></script>
  <!-- QRCode1 -->
  <script src='<?php echo base_url(); ?>assets/dist/vendors/qrcode1/jquery-qrcode-0.14.0.min.js'></script>
  <script src="<?php echo base_url(); ?>assets/dist/vendors/qrcode1/main.js"></script>

  <!--############################### CUSTOM JS ######################################### -->
  <script src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/style/js/myStyle.js"></script>
  <!--############################### CUSTOM JS ######################################### -->

  <script type="text/javascript">
  // To make Pace works on Ajax calls
  $(document).ajaxStart(function () {
    Pace.restart()
  })
  $('.ajax').click(function () {
    $.ajax({
      url: '#', success: function (result) {
        $('.ajax-content').html('<hr>Ajax Request Completed !')
      }
    })
  })

  // ################# LOCK ME #################
  $(document).ready(function(){
    function lockMe(){
      //window.location.href = '<?php echo base_url() ?>lockMe';
    }

    $(document).mousemove(function(event) {
        clearInterval(interval);
        clearTimeout(timeout);
        
        timeout = setTimeout(function() {
          interval = startInterval();
        }, 60000000);
    });
    $(document).keydown(function(event){
      clearInterval(interval);
        clearTimeout(timeout);
        
        timeout = setTimeout(function() {
          interval = startInterval();
        }, 60000000);
    });
    function startInterval() {
      return setInterval(lockMe, 60000000);
      }
    var interval = startInterval(), timeout;
  });
  // ################# LOCK ME #################

  // ################# WELCOME MESSAGE #################
  $(function(){
    if ('speechSynthesis' in window) {
      speechSynthesis.onvoiceschanged = function() {
        var $voicelist = $('#voices');

        if($voicelist.find('option').length == 0) {
          speechSynthesis.getVoices().forEach(function(voice, index) {
            var $option = $('<option>')
            .val(index)
            .html(voice.name + (voice.default ? ' (default)' :''));

            $voicelist.append($option);
          });

          $voicelist.material_select();
        }
      }

      $( document ).ready(function() {
		 /* var  issound= '<?php //echo isset($this->session->userdata('welcomeMessageSound'))?$this->session->userdata('welcomeMessageSound'):false; ?>';
        if( issound == true){
        var text = 'Good to see you <?php //echo $this->userName; ?>';
        }
      
      // $('#submit').click(function(){
      //   var text = 'Amir Rashid';
        var msg = new SpeechSynthesisUtterance();
        var voices = window.speechSynthesis.getVoices();
        msg.voice = voices[9];
        msg.rate = 10 / 10;
        msg.pitch = 1;
        msg.text = text;

        msg.onend = function(e) {
          //console.log('Finished in ' + event.elapsedTime + ' seconds.');
        };

        speechSynthesis.speak(msg);
        */
      })
    }
  });
  <?php echo $this->session->set_userdata(array('welcomeMessageSound' => false)); ?>
  // ################# WELCOME MESSAGE #################
  </script>
  <script>
  $(function () {
    $('#myForm').validate({
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
  </script>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| NAVBAR COLORS | navbar-light navbar-white               |
|               | navbar-light                            |
|               | navbar-dark                             |
|               | navbar-dark navbar-danger               |
|               | navbar-dark navbar-primary              |
|               | navbar-dark navbar-info                 |
|               | navbar-dark navbar-success              |
|               | navbar-dark navbar-pink                 |
|               | navbar-dark navbar-teal                 |
|               | navbar-dark navbar-indigo               |
|               | navbar-dark navbar-gray                 |
|               | navbar-light navbar-orange              |
|               | navbar-light navbar-warning             |
|---------------------------------------------------------|
|LAYOUT OPTIONS | sidebar-mini layout-boxed               |
|               | sidebar-mini sidebar-collapse           |
|               | sidebar-mini layout-footer-fixed        |
|               | sidebar-mini layout-fixed               |
|               | sidebar-mini layout-navbar-fixed        |
|               | layout-top-nav                          |
|               | sidebar-collapse layout-top-nav         |
|---------------------------------------------------------|
-->
<?php
  $myAction = '';
  if(count(explode('/', $_SERVER['REQUEST_URI'])) > 1){
    if(explode('/', $_SERVER['REQUEST_URI'])[1] == 'dashboardSuper' || explode('/', $_SERVER['REQUEST_URI'])[1] == 'dashboard'){
      $myAction = explode('/', $_SERVER['REQUEST_URI'])[1];
    }
  }
  if(count(explode('/', $_SERVER['REQUEST_URI'])) > 2){
    if(explode('/', $_SERVER['REQUEST_URI'])[2] == 'dashboardSuper' || explode('/', $_SERVER['REQUEST_URI'])[2] == 'dashboard'){
      $myAction = explode('/', $_SERVER['REQUEST_URI'])[2];
    }
  }
 ?>
<body class="hold-transition <?php if($myAction <> 'dashboardSuper'){echo 'sidebar-mini';} ?> layout-navbar-fixed <?php if($myAction == 'dashboard'){echo 'layout-fixed sidebar-collapse';}else{echo 'layout-fixed sidebar-collapse';} ?> pace-primary">
<a id="fullscreenButton" data-widget="fullscreen"></a>
<div id="loader" style="display: none;"><i class="fas fa-spin fa-spinner fa-4x"></i><!-- <img style="width: 10%; height: auto;" src="<?php echo base_url(); ?>assets/dist/gif/3.gif" class="img-circle" alt="Loader"> --></div>
<div class="wrapper">

  <!-- Navbar -->
  <nav id="myHeader" class="main-header navbar navbar-expand <?php echo $this->companyTheme; ?>" style="background-color: #00a559 !important;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <?php if($myAction <> 'dashboardSuper'){ ?>
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <?php } ?>
      <?php if($myAction == 'dashboardSuper'){ ?>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url(); ?>" role="button"><h4><b>PIRIMS</b></h4></a>
      </li>
      <?php } ?>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      <?php
      $result = $this->loginModel->systemInfoGet();
      if(count($result) > 0)
      {
        foreach ($result as $res)
        { 
            $mode = $res->mode;
        }
      }
      ?>
      <?php 
      if($this->roleId <> '1'){
        if($mode == 'Maintenance'){
          echo '<style>html{
            background-color: grey;
            opacity: 0.4;
            pointer-events:none;
          }</style>';
        } 
      }
      ?>
      <li class="nav-item col-md-12">
        <a class="nav-link"></a>
      </li>
      <li class="nav-item col-md-12">
        <a class="nav-link"></a>
      </li>
      <li class="nav-item">
        <a class="nav-link"><span <?php if($mode == 'Active'){echo 'style="cursor: default;border-radius: 2ex; background-color: #009688 !important;"';}else{echo 'style="cursor: default;border-radius: 2ex; background-color: #ed1c24 !important;"';} ?> class="label label-warning col-md-1 col-md-push-4 hidden-xs"><i class="fas fa-circle-notch" style="margin-left: 100%; margin-right: 100%;"></i></span></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url(); ?>lockMe" class="nav-link">
          <i class="fa fa-lock"></i>
        </a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php
          $result = $this->loginModel->alertGet();
          $resultCount = count($result);
          ?>
          <span class="badge badge-warning navbar-badge"><?php echo $resultCount ?></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <?php
          if(count($result) > 0)
          {
            echo '<span class="dropdown-item dropdown-header" style="cursor:default;">You have '.$resultCount.' notifications</span>';
            foreach ($result as $res)
            { 
              $dateTime = $res->dateTime;
                $alertName = $res->alertName;
                $description = $res->description;
                echo '<div class="dropdown-divider"></div>
                      <a class="dropdown-item" style="cursor:default;">
                        <i class="far fa-bell mr-2"></i> <span style="white-space: initial;">'.$alertName.'</span>
                        <span class="float-right text-muted text-sm"></span>
                      </a>
                ';
            }
          }
          else
          {
            echo '<div class="dropdown-divider"></div>
                  <a class="dropdown-item" style="cursor:default;">
                    <i class="far fa-bell mr-2"></i>You have no notifications
                  </a>
                ';
          }
          ?>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url().'alerts/lookup'; ?>" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link">
          <i class="flag-icon flag-icon-<?php echo strtolower($this->countryFlag); ?>"></i>
        </a>
      </li>

      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/profilepic/<?php echo $this->profilepic; ?>" class="user-image img-circle elevation-2" alt="User Image">
          <!-- <span class="d-none d-md-inline"><?php echo $this->userName; ?></span> -->
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-gray" style="background-color: #00a559 !important;">
            <img src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/profilepic/<?php echo $this->profilepic; ?>" class="img-circle elevation-2" alt="User Image">

            <p>
              <?php echo $this->userName; ?>
              <small><?php echo $this->department.' '.$this->designation; ?></small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
		  <?php if($this->roleId <> 26){ ?>
            <a href="<?php echo base_url(); ?>profile/edit" class="btn btn-default btn-flat">Profile</a>
		  <?php } ?>
            <a href="<?php echo base_url(); ?>logout" onclick="logoutSound()" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>

      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->

      <li class="nav-item">
        <a href="<?php echo base_url(); ?>setting/edit" class="nav-link"><i class="fas fa-cogs"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php if($myAction <> 'dashboardSuper'){ ?>
  <aside id="myAside" class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4" style="//background: url('<?php echo base_url(); ?>/assets/dist/img/<?php echo $this->wallpaper ?>'); //background-color: #3e8193; background-color: #454e52;">
    <!-- Brand Logo -->
    <a href="<?php echo base_url(); ?>" class="brand-link">
      <img src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $this->companyProject; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo base_url(); ?>uploads/company/<?php echo $this->companyName; ?>/profilepic/<?php echo $this->profilepic; ?>" class="img-circle elevation-2" alt="User Image" style="height: 33.59px;">
        </div>
        <div class="info">
          <a class="d-block" style="cursor: default; color: #c2c7d0 !important;"><?php echo $this->userName; ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search1">
          <input type="text" id="myInput" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onkeyup="search()" class="form-control form-control-sidebar1" placeholder="Search" aria-label="Search" style="background-color: #f2f2f2 !important; border: 1px solid #d9d9d9 !important; color: #1f2d3d !important;">
          <!-- <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul id="myUL" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
                  $myAction = '';
                  if(count(explode('/', $_SERVER['REQUEST_URI'])) > 3){
                    if(explode('/', $_SERVER['REQUEST_URI'])[2] == 'dashboard'){
                      $myAction = explode('/', $_SERVER['REQUEST_URI'])[3];
                    }
                  }
                  if(count(explode('/', $_SERVER['REQUEST_URI'])) > 2){
                    if(explode('/', $_SERVER['REQUEST_URI'])[1] == 'dashboard'){
                      $myAction = explode('/', $_SERVER['REQUEST_URI'])[2];
                    }
                  }
                  $nodes = 0;
                  $currentLevel = 0;
                  $i = 0;
                  $result = $this->loginModel->rolePageHeaderGet($this->roleId);
                  echo "<li class='nav-item'>";
                  echo "<a href='".base_url()."dashboard' class='nav-link'>";
                  echo "<i class='nav-icon fas fa-tachometer-alt'></i>";
                  echo "<p>";
                  echo "Dashboard";
                  echo "</p>";
                  echo "</a>";
                  echo "</li>";
                  
                  if(count($result) > 0)
                  {
                    foreach ($result as $res)
                    {   
                      $friendlyName = $res->friendlyName;
                      $pageName = $res->pageName;
                      $icon = $res->icon;
                      $url = $res->url;
                      $defaultAction = $res->defaultAction;
                      $parentId = $res->parentId;
                      $children = $res->children;
                      $head = $res->head;
                      $myHead = $res->myHead;
                      if($myAction && $myHead <> $myAction){
                        continue;
                      }
                      if($parentId <> 0 && $result[$i-1]->id == $parentId){
                        echo "<ul class='nav nav-treeview' style='background-color: #ced4da38;'>";
                        $nodes = $nodes + 1;
                      }
                      echo "<li class='nav-item'>";
                      if($children == 0){
                        echo "<a href='".base_url()."$url/$defaultAction' class='nav-link'>";
                      }
                      if($children > 0){
                        echo "<a href='#' class='nav-link'>";
                      }
                      echo "<i class='nav-icon $icon'></i>";
                      echo "<p>";
                      echo "$friendlyName";
                      if($children > 0){
                        echo "<i class='right fas fa-angle-left'></i>";
                      }

                      $totalNew = $this->loginModel->unseenRecordCountGet($pageName, $this->roleId);
                      if(count($totalNew) > 0)
                      {
                        foreach ($totalNew as $count)
                        {
                          $unseen = $count->unseen;
                        }
                        if($unseen > 0)
                        {
                        //echo "<span class='badge badge-warning right'>$unseen</span>";
                        }
                        else
                        {
                         echo "";
                        }
                      }

                      echo "</p>";
                      echo "</a>";
                      if($parentId == 0 && $children == 0){
                        echo "</li>";
                      }
                      if($parentId <> 0 && $children == 0){
                        echo "</li>";
                      }
                      if(count($result) - 1 <> $i){
                        if($parentId <> 0 && $result[$i+1]->parentId < $res->parentId){
                          echo "</ul>";
                          echo "</li>";
                          $nodes = $nodes - 1;
                          $currentLevel = $nodes;
                          for ($x = 1; $x <= $currentLevel; $x++) {
                            if($result[$i+1]->head <> $res->head){
                              echo "</ul>";
                              echo "</li>";
                              $nodes = $nodes - 1;
                            }
                          }
                          $difference = $res->parentId - $result[$i+1]->parentId;
                          if(($result[$i+1]->head == $res->head) && ($result[$i+1]->children > 0) && ($result[$i+1]->parentId < $res->parentId) && ($difference > 1)){
                            echo "</ul>";
                            echo "</li>";
                            $nodes = $nodes - 1;
                          }
                        }
                      }
                      $i++;
                  
                    }
                  }
                  // echo "<li class='nav-item'>";
                  // echo "<a href='".base_url()."#' class='nav-link'>";
                  // echo "<i class='nav-icon fas fa-book'></i>";
                  // echo "<p>";
                  // echo "User Guide";
                  // echo "</p>";
                  // echo "</a>";
                  // echo "</li>";
                  // echo "<li class='nav-item'>";
                  // echo "<a href='".base_url()."helpdesk' class='nav-link'>";
                  // echo "<i class='nav-icon fas fa-question'></i>";
                  // echo "<p>";
                  // echo "Help Desk";
                  // echo "</p>";
                  // echo "</a>";
                  // echo "</li>";
                    if($this->userId == 772 || ($this->roleId == 21)){
                        ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class='nav-icon fa fa-medkit'></i>
                                <p>
                                    PV
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'qualifiedPerson/lookup'; ?>" class="nav-link">
                                       <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 1 (QPPV/LSO)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'pmsf/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 2 (PMSF)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'riskManagement/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 3 (RMP)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'adverseEventsADR/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 4A Report ADR</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'adverseEventsNilReport/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 4B Nil Report</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'adverseEvents/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 4C Safety Issues</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'pbrer/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 5 (PBRER)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'pass/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 6 (PASS)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'detectedSignals/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 7 (DS)</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url().'safetyCommunications/lookup'; ?>" class="nav-link">
                                        <!-- <i class="far fa-circle nav-icon"></i>-->
                                        <p>Module 8 (SC)</p>
                                    </a>
                                </li>


                            </ul>
                        </li>
                        <?php
                    }
              ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    <div class="sidebar-custom">
      <!-- <a href="<?php echo base_url(); ?>userguide/lookup" class="btn btn-link"><i class="fas fa-book"></i> User Guide</a> -->
      <a href="<?php echo base_url(); ?>helpdesk/lookup" class="btn btn-secondary hide-on-collapse"><i class="fa fa-question"></i></a>
    </div>
    <!-- /.sidebar-custom -->
  </aside>
<?php } ?>

  <div class="viewPage"></div>

  <div class="modal modal-primary fade" id="modal-default">
  	<!-- modal-dialog -->
	  <div class="modal-dialog">
	  	<!-- modal-content -->
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Default Modal</h4>
	      </div>
	      <div class="modal-body">
	        <p>One fine body&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div>
	    <!-- /.modal-content -->
	  </div>
		<!-- /.modal-dialog -->
	</div>

  <script type="text/javascript">
    $(window).on('beforeunload', function(){
      //Pace.restart();
      $("#loader").addClass("loader");
      $("body").addClass("pageLoaderBackground");
      $(".wrapper").addClass("pageLoader");
      $("#loader").show();
    });
    document.onreadystatechange = function () {
      var state = document.readyState
      if (state == 'interactive') {
           $("#loader").addClass("loader");
           $("body").addClass("pageLoaderBackground");
           $(".wrapper").addClass("pageLoader");
           $("#loader").show();
      } else if (state == 'complete') {
           $("#loader").removeClass("loader");
           $("body").removeClass("pageLoaderBackground");
           $(".wrapper").removeClass("pageLoader");
           $("#loader").hide();
      }
    }
    Pace.stop();
    $(document).ajaxStart(function(){
      Pace.restart();
      $("#loader").addClass("loader");
      $("body").addClass("pageLoaderBackground");
      $(".wrapper").addClass("pageLoader");
      $("#loader").show();
    });
    $(document).ajaxStop(function(){
      $("#loader").removeClass("loader");
      $("body").removeClass("pageLoaderBackground");
      $(".wrapper").removeClass("pageLoader");
      $("#loader").hide();
      Pace.stop();
    });
    function loadPage(page) {
      window.history.pushState('obj', 'newtitle', page);
      $(".viewPage").load(page);
    }
  </script>
  <script type="text/javascript">
    $("#myInput").on('keyup', function(){
      var value = $(this).val().toLowerCase();
      $("#myUL li").each(function () {
          if ($(this).text().toLowerCase().search(value) > -1) {
              $(this).slideDown();
              $(this).addClass('menu-is-opening menu-open');
              //$(this).find('.nav-icon').removeClass('fa-circle');
              //$(this).find('.nav-icon').addClass('fa-dot-circle');
          } else {
              $(this).slideUp();
          }
      });
      $("#myUL ul").each(function () {
          if ($(this).text().toLowerCase().search(value) > -1) {
              $(this).slideDown();
              $(this).addClass('menu-is-opening menu-open');
              //$(this).find('.nav-icon').removeClass('fa-circle');
              //$(this).find('.nav-icon').addClass('fa-dot-circle');
          } else {
              $(this).slideUp();
          }
      });   
    })
    $("#myInput").on('keyup', function(){
        if($("#myInput").val() == ''){
          $("#myUL ul").slideUp();
        }
    });

    $(document).ready(function(){
      $('#myUL li ul').each(function () {
        if ($(this).find('a').hasClass('active')) {
          $(this).parent().addClass('menu-is-opening menu-open');
          //$(this).find('.nav-icon').removeClass('fa-circle');
          //$(this).find('.nav-icon').addClass('fa-dot-circle');
        }
      });
    });
  </script>
  <audio id="signoutSound" src="assets/ding.mp3"></audio>
  <script>
    function logoutSound() {
      document.getElementById("signoutSound").play();
    }
  </script>
  <script type="text/javascript">
    // $(document).ready(function(){
    //    $.ajax({
    //     url:"<?php echo base_url(); ?>login/alertAjaxGet",
    //     method:"POST",
    //     success:function(data)
    //     {
    //       if(data){
    //       var result = data.split('_');
    //       showNotification(result[0], result[1]);
    //       }
    //     }
    //    });
    // });
    // function showNotification(name, data) {
    //   Notification.requestPermission(function(result) {
    //     if (result === 'granted') {
    //       navigator.serviceWorker.ready.then(function(registration) {
    //         registration.showNotification(name, {
    //           body: data,
    //           icon: 'uploads/company/DRAP/logo/logo.png',
    //           vibrate: [200, 100, 200, 100, 200, 100, 200],
    //           tag: 'vibration-sample'
    //         });
    //       });
    //     }
    //   });
    // }
    // function showNotification(name, data) {
    //   navigator.serviceWorker.register('sw.js');
    //   Notification.requestPermission(function(result) {
    //     if (result === 'granted') {
    //       new Notification(name, {
    //         body: data,
    //         icon: 'uploads/company/DRAP/logo/logo.png',
    //         vibrate: [200, 100, 200, 100, 200, 100, 200],
    //         tag: 'vibration-sample'
    //       });
    //     }
    //   });
    // }
    // setInterval(function(){ notification(); }, 120000);
    // function notification(){
    //    $.ajax({
    //     url:"<?php echo base_url(); ?>login/alertAjaxGet",
    //     method:"POST",
    //     success:function(data)
    //     {
    //       if(data){
    //       var result = data.split('_');
    //       showNotification(result[0], result[1]);
    //       }
    //     }
    //    });
    // }
  </script>
  <script type="text/javascript">
    // function safeExit() {
    //   return "Write something clever here...";
    // }
  </script>
  <script type="text/javascript">
    function h2c(){
      html2canvas(document.body).then(function(canvas) {
        document.body.appendChild(canvas);
        var myImage = canvas.toDataURL("img/png");
        //alert(myImage);
        //$('#bla').append(canvas);
        //$('#bla').attr('src', myImage);
      });

      // html2canvas(document.querySelector("#capture")).then(canvas => {
      //   document.body.appendChild(canvas);
      //   $('#bla').append(canvas);
      // });
      
      // html2canvas($("body"), {
      //   onrendered: function(canvas) {
      //     var myImage = canvas.toDataURL("img/png");
      //     window.open(myImage);
      //     //alert(myImage);
      //     }
      // });
    }
  </script>
  <!-- <script type="text/javascript">
    $(document).ready(function(){
      $('#fullscreenButton').trigger('click');
    });
  </script> -->

  <script type="text/javascript">

      function loadBasicTable(myTable) {
          var basictable = $('#'+myTable).DataTable({

              'orderCellsTop': true,
              'fixedHeader': true,
              'paging': true,
              'lengthChange': true,
              'pageLength'   : 50,
              'searching': false,
              'ordering': false,
              'info': true,
              'iDisplayLength': 50,
              'autoWidth': true,

          });
      }
    function loadMyTable(myTable, ordering, pageLength, isDBSearch){

      $('#'+myTable+' thead tr').clone(true).appendTo( '#'+myTable+' thead' );
      $('#'+myTable+' thead tr:eq(1) th').each( function (i) {
          var title = $(this).text();
          if(title == '' || title == 'S.#' || title == 'Action'){
            $(this).html( '' );
          }
          else{
            $(this).html( '<input type="text" class="form-control d-none" placeholder="Search '+title+'" />' );
            if(isDBSearch == 'Yes'){
              $(this).html('<div class="input-group input-group-sm float-right d-none" style="width: 150px;">&nbsp;<input type="text" name="searchText[]" value="" class="form-control float-right" placeholder="Search"><div class="input-group-append"><button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button></div></div>');
            }

          }
      } );

      var autowidth = true;
      //pageLength = 50;
        <?php if($this->roleId != 26) { ?>
        if(myTable == 'table'){
            autowidth = false;
        }
        <?php } ?>

      var table = $('#'+myTable).DataTable({
          'orderCellsTop': true,
          'fixedHeader'  : true,
          'paging'       : true,
          'lengthChange' : (pageLength>0?true:false),
          'pageLength'   : pageLength,
          'searching'    : true,
          'ordering'     : ordering,
          'info'         : true,
          'iDisplayLength': pageLength,
          'autoWidth'    : autowidth,
          'search'       : {'caseInsensitive': false},
          //'columnDefs'   : [{ 'type': 'html-input', 'targets': ['_all'] }],
          'columnDefs'   : [{ 'type': 'html-input', 'targets': [1] }],
          'buttons'      : [{'extend':'copy', 'exportOptions': {'columns': ':visible' }}, {'extend':'csv', 'exportOptions': {'columns': ':visible' }}, {'extend':'excel', 'exportOptions': {'columns': ':visible' }}, {'extend':'pdf', 'exportOptions': {'columns': ':visible' }}, {'extend':'print', 'exportOptions': {'columns': ':visible' }}, 'colvis'],
          initComplete   : function () {
            this.api().columns().every( function () {
              var that = this;
              $( 'input', $('#'+myTable+' thead tr:eq(1) th').eq( this.index() ) ).on( 'keyup change clear', function () {
                  if ( that.search() !== this.value ) {
                      that
                          .search( this.value )
                          .draw();
                  }
              } );
            } );
          }
      }).buttons().container().appendTo('#'+myTable+'_wrapper .col-md-6:eq(0)');
      $( '#'+myTable+" thead th" ).click(function() {
        $( '#'+myTable+" thead th input" ).removeClass('d-none');
        if(isDBSearch == 'Yes'){
          $( '#'+myTable+" thead th div" ).removeClass('d-none');
        }
      });
      $(':submit').on('click', function(){
        $('table').DataTable().search('').columns().search('').draw();
      });
      $('#'+myTable+' tbody').on( 'click', '.trash', function () {
        if($('#'+myTable+' tbody tr').length !== 1){
          // $('#'+myTable).DataTable()
          //     .row( $(this).parents('tr'))
          //     .remove()
          //     .draw();
          $(this).parents().closest('tr').attr('style', 'background-color: #c22f3c !important');
          $(this).parents().closest('tr').find('.deleteRow').val(1);
          $(this).parent().parent().parent().find('.deleteRow:last').val(1);


        }
      });
    }
  </script>
  <script type="text/javascript">
    $('body').css('opacity', '0.4');
    $(document).ready(function(){
       $('body').css('opacity', '1');
    });
  </script>