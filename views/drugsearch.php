<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>DRAP | Drug Search</title>
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
<body class=" login-page" style="background-image: linear-gradient(#ededed, #b7b7b7);">
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
                      <h6 class="card-title txt-dark">Registered Drug Search - DRAP</h6>
                  </div>
                  <div class="clearfix"></div>
              </div>
                    <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                              <form action="<?php echo base_url(); ?>drugs" method="post" >
                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <label for="exampleFormControlSelect1">Search By</label>
                                              <select autofocus class="form-control" name="searchby" id="searchby">
                                                  <option value="1" selected >Registration Number</option>
                                                  <option value="2" <?php echo isset($searchby) && $searchby == 2?'selected':''; ?> >Brand Name</option>
                                                  <option value="3" <?php echo isset($searchby) && $searchby == 3?'selected':''; ?>>Composition</option>
                                                  <option value="4" <?php echo isset($searchby) && $searchby == 4?'selected':''; ?>>Company</option>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="col-md-9 filterbox">
                                          <div class="form-group">
                                              <label for="sstring">Search String</label>
                                              <input autofocus type="text" class="form-control" id="sstring" value="<?php echo isset($searchstring)?$searchstring:''; ?>" name="searchstring">
                                          </div>
                                      </div>

                                      <div class="col-md-9 companyfilter">
                                          <div class="form-group">
                                              <?php $label = 'Company Name'; ?>
                                              <label><?php echo $label; ?></label>
                                              <?php $column = 'companyAccountId'; ?>
                                              <select style="height: inherit" autofocus class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                                                  <option value="">Select <?php echo @$label; ?></option>
                                                  <?php
                                                  if(!empty($companies))
                                                  {
                                                      foreach ($companies as $company)
                                                      {
                                                          ?>
                                                          <option value="<?php echo $company->companyUniqueNo ?>" <?php echo isset($companyAccountId) && $companyAccountId == $company->companyUniqueNo?'selected':''; ?> ><?php echo $company->companyName.' (<small>'.$company->companyAddress.'</small>)'; ?></option>
                                                          <?php
                                                      }
                                                  }
                                                  ?>
                                              </select>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row">
                                      <div class="col-md-4">
                                          <input type="submit" value="Search" class="btn btn-primary" name="" id="">
                                      </div>
                                  </div>

                              </form>

                          </div>
                      </div>
                  </div>
          </div>
              </div>
          </div>

          <?php
          if(isset($drugs)){
              ?>
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
                                              <th>Market Authhorization Holder/ Registration Holder</th>
                                              <th>Brand Name</th>
                                              <th>Composition</th>
                                              <th>Dosage</th>
                                              <!--
                                              <th>Intended Target</th>
                                              <th>Reg Type</th>

                                              <th>Action</th>
                                              -->
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
                                                          echo isset($company[0])?$company[0]->companyName:''; ?>
                                                      </td>
                                                      <td><?php echo $drug->approvedName; ?></td>
                                                      <td><?php
                                                          $compositions = $CI->loginModel->getDrugCompositions($drug->id);
                                                          foreach ($compositions as $composition){
                                                              $unit = $CI->loginModel->getUnit($composition->unitId);
                                                              $unitlabel = isset($unit[0])?$unit[0]->unit:'';

                                                              echo $composition->innManual.' '.$composition->strength.' '.$unitlabel.' <br>';
                                                          }
                                                          ?></td>
                                                      <td>
                                                          <?php
                                                          $dosage = $CI->loginModel->getDosage($drug->dosageFormId);
                                                          echo isset($dosage[0])?$dosage[0]->dosageName:''; ?>
                                                      </td>
                                                      <!--<td>
                                                          <?php //echo isset($drug)?(($drug->usedForId == 1)?'Human': (($drug->usedForId == 3)?'Veterinary':'')):''; ?>
                                                      </td>
                                                      <td><?php //echo isset($drug)?$drug->regType:''; ?></td>

                                                      <td>
                                                          <a href="<?php echo base_url().'drugDetails/'.$drug->id; ?>" class="btn btn-success">Details</a>
                                                      </td>
                                                      -->
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

              <?php
          }
          ?>

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
<script>
  function loginSound() {
    document.getElementById("loginSound").play();
  }
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
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>


  <script>
$(function () {
    $('.select2').select2();
    $('#regdrugs').DataTable(
        {
            'processing': true,
            "language": {
                "emptyTable": "No Record Found",
                "processing": '<i class="fa fa-spinner fa-spin" style="font-size:24px;color:rgb(75, 183, 245);"></i>'

            }
        }
    );
    if($('#searchby').val() == 4){
        $(".filterbox").hide();
        $(".companyfilter").show();
    }else{
        $(".companyfilter").hide();
    }


    $('#searchby').on('change', function() {
        if(this.value == 4){
            $(".filterbox").hide();
            $(".companyfilter").show();
        }else{
            $(".filterbox").show();
            $(".companyfilter").hide();
        }
    });

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
