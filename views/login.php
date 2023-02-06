<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>DRAP | Log In</title>
  <link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">

</head>
<body class="login-page" style="background-image: linear-gradient(#ededed, #b7b7b7);">
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
  <div id="cover" style="width: 100%;">
  <div id="cover23" style="//background: url(assets/dist/img/wp1.jpg); //background: url(assets/dist/img/wp15.jpg); //background: url(assets/dist/img/wp24.jpg); background: url(assets/dist/img/wp6.jpg); border-top-left-radius: 100em 10em; border-top-right-radius: 100em 10em; background-size: 100%;">
  <div id="a1" class="img-header" style="height: 60.83650190114068vh;">
  <div class="login-box" style="border-radius:2%; //background-color: #f6f6f6; box-shadow: 0px 0px 20px 0px #151515; margin: auto; border-top-left-radius: 100em 7em;
    border-top-right-radius: 100em 7em;">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary" style="//border-top: 3px solid #00a559; border-top: 20px solid #f8fdfb; background-color: #00a65a; border-top-left-radius: 100em 7em;
    border-top-right-radius: 100em 7em;">
      <img style="margin-top: 10px; width: 100%; height: 200px; vertical-align: middle;" src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo3.png" class="img-fluid" alt="Logo">
      <div class="card-header text-center" style="margin: -10px; border-bottom: 0px solid #000 !important;">
        <a href="<?php echo base_url(); ?>" class="h1" style="color: #fff;"><b style="color: darkgreen; text-shadow: 2px 2px 0px mediumseagreen;">PIRIMS</b><sub style="bottom: 0em; font-size: 45%;"> v2</sub></a>
      </div>
      <div class="card-body" style="background-color: #e8e8e8;">
        <p class="login-box-msg"><?php if($mode == 'Maintenance'){echo '<span class="text-danger"> <span style="border-bottom: 3px solid #dc3545; border-bottom-left-radius: 1em 100em; border-bottom-right-radius: 1em 100em; border-bottom-width: thick; padding: 10px;">● <i class="fas fa-cog fa-spin fa-6x"></i> ●</span></span>';}else{echo '<span style="border-bottom: 3px solid #10a659; border-bottom-left-radius: 100em 50em; border-bottom-right-radius: 100em 50em; border-bottom-width: thick; padding: 10px;"><span style="color:#10a659;">●</span> Sign In <span style="color:#10a659;">●</span></span>';} ?></p>

        <form onsubmit="loginSound();hide();" action="<?php echo base_url(); ?>loginMe" method="post" <?php if($mode == 'Maintenance'){echo 'style="opacity:0;"';} ?>>
          <div class="input-group mb-3">
            <input type="email" name="email" autocomplete="off" autofocus  onfocus="this.removeAttribute('readonly');$(':submit').removeAttr('disabled');" value="<?php if($this->session->userdata('myEmail')){echo $this->session->userdata('myEmail');}?>" class="form-control" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');$(':submit').removeAttr('disabled');" value="<?php if($this->session->userdata('myPassword')){echo $this->session->userdata('myPassword');}?>" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <a href="https://www.usp.org" target="_blank"><img style="width: -webkit-fill-available; max-width: 40% !important;" src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo_usp.png" class="img-fluid pull-right" alt="Logo"></a>
            </div>

            <!-- /.col -->
            <div class="col-4">
              <button disabled type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-md-12 col-xs-12">
              <?php
                  if($this->session->flashdata('error'))
                  {
              ?>
              <br>
              <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $this->session->flashdata('error'); ?>                    
              </div>
              <?php }
              if($this->session->flashdata('success'))
                  {
              ?>
              <br>
              <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?php echo $this->session->flashdata('success'); ?>
              </div>
              <?php } ?>
            </div>
          </div>
        </form>

        <p class="mb-1">
            <a href="https://fee.dra.gov.pk/forgot-password">I forgot my password</a>
            <!-- <a href="<?php echo base_url(); ?>forgotPassword">I forgot my password</a> -->
        </p>
        <!--<p class="mb-0">
          <a href="<?php echo base_url(); ?>register" class="text-center">Register a new account</a>
        </p> -->
          <p class="mb-0">
              <a href="https://fee.dra.gov.pk/register" class="text-center">Register a new account</a>
          </p>
      </div>
      <!-- <br> -->
      <div style="text-align: center; font-weight: bold; color: white; //font-size: initial; font-size: 80%; background-color: #00a559;">Drug Regulatory Authority Of Pakistan</div>
      <!-- <br> -->
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
  </div>
  </div>
  </div>
  <footer>
   <!-- <div style="width: 122px; height: 68px; margin-left: 400px; margin-top: 100px;"> -->
    <a href="https://www.usp.org" target="_blank"><img src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo_usp.png" class="img-fluid pull-right" style="width: 122px; height: 68px; margin-left: 600%; margin-top: 100px;" alt="Logo"></a>
  <!-- </div> -->
  </footer>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<audio  id="loginSound" src="assets/dingtong.mp3"></audio>
<script>
  function loginSound() {
    //document.getElementById("loginSound").play();
  }
  /*
  <style>
      // Chrome, Safari, Opera
      @-webkit-keyframes fade {
      0%   { opacity: 0;top: -100px;}
      100% { opacity: 1;top: 0px;}
  }
      .img-header1{
      opacity: 0;
      -webkit-animation: fade 1.5s ease 0s forwards;// Chrome, Safari, Opera
      position: relative;

  }

      @-webkit-keyframes q1 {
      0%   { -webkit-transform: translateY(1000px) scale(3); opacity: 0;top: 0px;}
      100% { -webkit-transform: translateY(0px) scale(1); opacity: 1;top: 0px;}
  }
      body{
      opacity: 0;
      -webkit-animation: q1 3s ease 0s forwards;
      position: relative;

  }

      @-webkit-keyframes fades {
      0% {
          opacity: 0;top: -100px;
      -webkit-transform: translateY(15px) scale(0.5);
  }
      50% {
      opacity: 1;top: 0px;
      -webkit-transform: translateY(0) scale(0.5);
  }
      100% {
      opacity: 1;top: 0px;
      -webkit-transform: translateY(0) scale(1);
  }
  }
      .img-header{
      opacity: 0;
      -webkit-animation: fades 1s ease 2s forwards;
      position: relative;
  }

      @-webkit-keyframes reversefades {
      0% {
          opacity: 1;top: 0px;
      -webkit-transform: translateY(0) scale(1);
  }
      50% {
      opacity: 0;top: -100px;
      -webkit-transform: translateY(15px) scale(1);
  }
      100% {
      opacity: 0;top: -100px;
      -webkit-transform: translateY(15) scale(1);
  }
  }
      .img-headerhide{
      opacity: 1;
      -webkit-animation: reversefades 1s ease 0s forwards;
      position: relative;
  }

      #cover1 {
      -webkit-animation: bg 6s linear infinite;
      -webkit-backface-visibility: hidden;
      -webkit-transform: translate3d(0,0,0);
      background: #348cb2 url("assets/dist/img/bg4.jpg") bottom left;
      background-size:100% 100%;
      background-repeat: repeat-x;
      height: 100%;
      width: 100%;
      opacity: 1;
      position: fixed;
      top: 0;
  }

      @-webkit-keyframes bg {
      0% {
      -webkit-transform: scale(1);
  }
      50% {
      -webkit-transform: scale(1.1);
  }

      100% {
      -webkit-transform: scale(1);
  }
  }
  </style>
*/
</script>
<script type="text/javascript">
  function hide(){
  $("#a1").removeClass("img-header");
  $("#a1").addClass("img-headerhide");
  }
</script>
<style type="text/css">
  .pageLoader{
      background-color: #000;
      opacity: 0.4;
      pointer-events:none;
</style>
<!-- jquery-validation -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
<script>
$(function () {
  $('#myForm').validate({
    rules: {
      name: {
        required: true,
      },
      email: {
        required: true,
        email: true,
      },
      message: {
        required: true,
        maxlength: 200
      },
    },
    messages: {
      name: {
        required: "Please enter a name",
      },
      email: {
        required: "Please enter a email address",
        email: "Please enter a vaild email address"
      },
      message: {
        required: "Please provide a message",
        maxlength: "Your message must be not exceed 200 characters"
      },
    },
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
<script type="text/javascript">
  $('.required').each(function(i, obj) {
      $(this).parent().find('label').prepend('<i class="fa fa-asterisk text-danger"></i> ');
  });
</script>
<?php $this->session->unset_userdata('myEmail'); ?>
<?php $this->session->unset_userdata('myPassword'); ?>
</body>
</html>
