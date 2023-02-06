<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>DRAP | Drug Details</title>
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
<body class="hold-transition login-page" style="background-image: linear-gradient(#ededed, #b7b7b7);">

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
  <div id="cover23" style=" border-top-left-radius: 100em 10em; border-top-right-radius: 100em 10em; background-size: 100%;">
      <div class="container-fluid">

          <div class="row">
              <div class="col-sm-12 col-xs-12">
                  <div class="mb-30">
                      <h4 class="text-center txt-dark">

                          <img class="align-center brand-img " style="max-width: 60%" src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo4.png" alt="DRAP"/>
                      </h4>
                      <hr/>
                      <h3 class="text-center txt-dark mb-10">Registered Drugs </h3>
                      <div class="alert alert-danger error-message" style="display: none;"></div>
                  </div>

              </div>
          </div>

          <div class="row justify-content-center">
              <div class="col-sm-10 col-xs-10">
                <div class="card card-outline card-primary">
              <div class="card-header">
                  <div class="pull-left">
                      <h6 class="card-title txt-dark">Registered Drug Details - DRAP</h6>
                  </div>
                  <div class="clearfix"></div>
              </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <table id="regdrugs" class="display table table-bordered table-striped" style="width:100%">
                                  <thead>
                                  <tr>
                                      <th>Reg. No</th>
                                      <th>Registrant</th>
                                      <th>Brand Name</th>
                                      <!--<th>Strength</th>
                                      <th>Dosage</th>-->
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                  if(isset($drugs)){
                                      $CI =& get_instance();
                                      //$CI->load->model('someModel')


                                      foreach ($drugs as $drug){
                                          ?>
                                          <tr>
                                              <td><?php echo $drug->registrationNo; ?></td>
                                              <td><?php
                                                  $company = $CI->loginModel->getCompany($drug->companyAccountId);
                                                  echo isset($company[0])?$company[0]->companyName:''; ?></td>
                                              <td><?php echo $drug->approvedName; ?></td>
                                              <!--<td>61</td>
                                              <td>2011/04/25</td>-->
                                              <td>
                                                  <a href="<?php echo base_url().'drugDetails/'.$drug->id; ?>" class="btn btn-success">Details</a>
                                              </td>
                                          </tr>
                                          <?php
                                      }
                                  }
                                  ?>

                                  </tbody>

                              </table>
                          </div>
                      </div>
                  </div>
          </div>
              </div>
          </div>
      </div>
  </div>
  </div>
  <footer>
   <!-- <div style="width: 122px; height: 68px; margin-left: 400px; margin-top: 100px;"> -->
    <!--<a href="https://www.usp.org" target="_blank"><img src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo_usp.png" class="img-fluid pull-right" style="width: 122px; height: 68px; margin-left: 600%; margin-top: 100px;" alt="Logo"></a>
-->
<!-- </div> -->
  </footer>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<audio  id="loginSound" src="assets/dingtong.mp3"></audio>

<style>
  /* Chrome, Safari, Opera */
  @-webkit-keyframes fade {
      0%   { opacity: 0;top: -100px;}
      100% { opacity: 1;top: 0px;}
  }
  .img-header1{
    opacity: 0;
    -webkit-animation: fade 1.5s ease 0s forwards; /* Chrome, Safari, Opera */
    position: relative;
  
  }

  @-webkit-keyframes q1 {
      0%   { -webkit-transform: translateY(1000px) scale(3); opacity: 0;top: 0px;}
      100% { -webkit-transform: translateY(0px) scale(1); opacity: 1;top: 0px;}
  }
  body{
    opacity: 0;
    -webkit-animation: q1 3s ease 0s forwards; /* Chrome, Safari, Opera */
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
    -webkit-animation: fades 1s ease 2s forwards; /* Chrome, Safari, Opera */
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
    -webkit-animation: reversefades 1s ease 0s forwards; /* Chrome, Safari, Opera */
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
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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


  <script>

$(function () {
    $('#regdrugs').DataTable(
        {
            'processing': true,
            "language": {
                "emptyTable": "No Record Found",
                "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'

            }
        }
    );
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
