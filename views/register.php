<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DRAP | Registration Page</title>
  <link id="favicon" rel="icon" href="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo.png"/>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Select2 -->
  <script src="<?php echo base_url(); ?>assets/plugins/select2/js/select2.full.min.js"></script>
</head>
<body class="hold-transition register-page">
<div class="wrapper">
<div class="register-box1" style="//box-shadow: 0px 2px 30px #f47635;//border: 8px solid #1c395d;border-radius:2%;//background-color: #344063;background-color: #00a559; box-shadow: 0px 0px 20px 0px #989898; margin: auto;">
  <div class="card card-outline card-primary" style="border-top: 3px solid #00a559; ">
    <div class="card-header text-center">
      <a href="<?php echo base_url(); ?>" class="h1"><b>PIRIMS</b><sub style="bottom: 0em; font-size: 45%;"> v2</sub></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new account</p>

      <form id="myForm" action="<?php echo base_url(); ?>registerMe" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

          <div class="col-md-6">
            <div class="form-group">
              <?php $label = 'Category'; ?>
              <label><?php echo $label; ?></label>
              <?php $column = 'companyCategory'; ?>
              <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                <option value="">Select <?php echo @$label; ?></option>
                <option value="Pharma Industry">Pharma Industry</option>
                <option disabled value="HOTC Industry">HOTC Industry</option>
                <option disabled value="MDMC Industry">MDMC Industry</option>
                <option disabled value="Distributor">Distributor</option>
                <option disabled value="Retailer">Retailer</option>
                <option disabled value="Institution">Institution</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <?php $label = 'Sub Category'; ?>
              <label><?php echo $label; ?></label>
              <?php $column = 'companySubCategory'; ?>
              <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                <option value="">Select <?php echo @$label; ?></option>
                <option value="Manufacturer">Manufacturer</option>
                <option value="Importer">Importer</option>
              </select>
            </div>
          </div>

        </div>

        <div class="row">

          <div class="col-12" id="area1" style="display: none;">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">General Information</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Company Name / Name'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'companyName'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Email (will be used to login)'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'email'; ?>
                      <input type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Address'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'companyAddress'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Head Office Address Link (Google Map URL)'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'googleMapURL'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Company Type'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'companyType'; ?>
                      <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                        <option value="">Select <?php echo @$label; ?></option>
                        <option value="Private Limited">Private Limited</option>
                        <option value="Sole Proprietor">Sole Proprietor</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Public Limited">Public Limited</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Province'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'stateId'; ?>
                      <select class="form-control select2 required" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                        <option value="">Select <?php echo @$label; ?></option>
                        <option value="1">Punjab</option>
                        <option value="3">Balochistan</option>
                        <option value="4">Sindh</option>
                        <option value="5">KPK</option>
                        <option value="6">Islamabad Capital Territory</option>
                        <option value="7">AJK</option>
                        <option value="8">Gilgit Baltistan</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Website'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'website'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Phone'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'phone'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Contact Person Name'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'contactPersonName'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Contact Person Phone'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'contactPersonPhone'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Contact Person Designation'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'contactPersonDesignation'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Contact Person Email'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'contactPersonEmail'; ?>
                      <input type="email" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control required">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'NTN / SECP No. / CNIC'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'companyNTN'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'NTN / SECP / CNIC'; ?>
                      <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                      <?php $column = 'companyNTNAttachment'; ?>
                      <div class="custom-file">
                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="">
                        <input type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="custom-file-input required">
                        <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12" id="area2" style="display: none;">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Site Information</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                <div class="row">
                  
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-12" id="area3" style="display: none;">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">DSL Information</h3>
                <div class="card-tools">
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive cardBodyTransaction1 parentDiv">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'DSL No.'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'dslNo'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'DSL'; ?>
                      <label><?php echo $label; ?> <i>[<font style="color: #F44336;">File Format</font><font style="color: #3f51b5;"> (*.JPEG, *.PNG, *.PDF)</font><font style="color: #F44336;"> Max. File Size</font><font style="color: #3f51b5;"> 5 MB</font>]</i></label>
                      <?php $column = 'dslAttachment'; ?>
                      <div class="custom-file">
                        <input type="hidden" id="<?php echo @$column; ?>Hidden" name="<?php echo @$column; ?>" value="">
                        <input type="file" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="custom-file-input required">
                        <label class="custom-file-label" for="<?php echo @$column; ?>">Choose file</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'DSL Validity Date'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'dslValidityDate'; ?>
                      <input type="date" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'City'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'cityId'; ?>
                      <select class="form-control select2" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>">
                        <option value="">Select <?php echo @$label; ?></option>
                        <?php
                          if(!empty($city))
                          {
                            foreach ($city as $record)
                            {
                                ?>
                                <option value="<?php echo $record->id ?>"><?php echo $record->cityName ?></option>
                                <?php
                            }
                          }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'DSL Issuing Authority'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'dslIssuingAuthority'; ?>
                      <input type="text" id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" value="" class="form-control">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'DSL Address'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'dslAddress'; ?>
                      <textarea id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <?php $label = 'Godown Address'; ?>
                      <label><?php echo $label; ?></label>
                      <?php $column = 'godownAddress'; ?>
                      <textarea id="<?php echo @$column; ?>" name="<?php echo @$column; ?>" class="form-control" rows="3"></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>
        <div class="row">
          <style type="text/css">
            .table {
              font-family: verdana, Helvetica, sans-serif;
              font-size: 12px;
              color: #333;
              background-color: #E4E4E4;
            }
            .table td {
              background-color: #F8F8F8;
            }
          </style>
          <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="table" style="width: auto;">
            <?php if($this->session->userdata('msg')){?>
            <tr>
              <td colspan="2" align="center" valign="top"><?php echo $this->session->userdata('msg');?></td>
            </tr>
            <?php } $this->session->unset_userdata('msg'); ?>
            <tr>
              <td align="right" valign="top"> Validation code:</td>
              <td><img src="<?php echo base_url()?>registerCaptcha?rand=<?php echo rand();?>" id='captchaimg'><br>
                <label for='message'>Enter the code above here :</label>
                <br>
                <input id="captcha_code" name="captcha_code" type="text">
                <br>
                Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.</td>
            </tr>
          </table>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="confirmTerms">
              <label for="confirmTerms">
               I agree to the <a href="#" data-toggle="modal" data-target="#termsofuse" data-backdrop="static">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" id="submitButton" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div> -->

      <a href="<?php echo base_url(); ?>" class="text-center">I already have an account</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
  <!-- <br> -->
  <div class="col-md-12 col-xs-12" style="background-color: #00a559">
    <!-- <br> -->
  </div>
  <div class="col-md-12 col-xs-12">
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
<!-- /.register-box -->
<footer>
  <a href="https://www.usp.org" target="_blank"><img style="width: 122px; height: 68px; margin-right: 30px; margin-top: 100px;" src="<?php echo base_url(); ?>uploads/company/DRAP/logo/logo_usp.png" class="img-fluid pull-right" alt="Logo"></a>
</footer>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<script type='text/javascript'>
  function refreshCaptcha(){
    var img = document.images['captchaimg'];
    img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
  }
</script>
<script type="text/javascript">
  $('#confirmTerms').click(function(){
    if($(this).prop("checked") == true){
      $('#submitButton').attr('disabled', false);
    }
    else
    {
      $('#submitButton').attr('disabled', true);
    }
  });
  $(document).ready(function(){
    var value = $('#confirmTerms').val();
      if(value == 'on'){
        $('#submitButton').attr('disabled', true);
      }
  });
</script>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  })
</script>
<script type="text/javascript">
  $('.required').each(function(i, obj) {
      $(this).parent().find('label').prepend('<i class="fa fa-asterisk text-danger"></i> ');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#companySubCategory').on('change', function() {
      if($('#companySubCategory').val() == 'Manufacturer'){
        $('#area1').css('display', 'block');
        //$('#area2').css('display', 'block');
        $('#area3').css('display', 'none');
      }
      if($('#companySubCategory').val() == 'Importer'){
        $('#area1').css('display', 'block');
        //$('#area2').css('display', 'none');
        $('#area3').css('display', 'block');
      }
    });
  });
</script>
</body>
</html>
