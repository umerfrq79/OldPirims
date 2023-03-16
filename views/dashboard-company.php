<?php
// if($userInfo[0]->status == 'Completed'){
//   //if($this->userId <> 27){
//   header("Location:".base_url().substr($pageTitle[0]->url, 0, strcspn($pageTitle[0]->url, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ')));
//   exit();
//   //}
// }
?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script></head>

</head>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    <!--  <h1 class="m-0"><i class="fas fa-tachometer-alt"></i> Dashboard <?php //echo ' - '.$this->department.' '.$this->designation; ?> </h1>
       -->
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

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">NOTICE TO PHARMACEUTICAL / BIOLOGICAL MANUFACTURERS AND IMPORTERS (Dated 13-03-2022)</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p  style="text-align:justify; font-weight: lighter; font-size: large"> Pharmaceutical Industry is hereby informed through this notice that Drug Regulatory Authority of Pakistan (DRAP) has deployed an online application management system namely Pakistan Integrated Regulatory Information Management System (PIRIMS) for performance of various regulatory functions.<br><br>

                                    All the Registration Holders are hereby directed to update the finished product specifications and validated testing procedures  i.e. Pharmacopoeial or in case of non-availability in any pharmacopeia, Innovator / Manufacturer Specification,  in the corresponding product details in PIRIMS portal <strong>( Goto New Registration -> Edit Product -> Finished Product Specifications)</strong>. The portal  to perform the above-saidactivity will remain accessible for thirty days after publication of this notice and afterwards, no request shall be entertained. <strong>It is further clarified that after the lapse of the due time for above-said activity, necessary regulatory fee may apply.</strong><br><br>

                                    Registration holders may approach Data Management Cell (DMC) of Pharmaceutical Evaluation & Registration Division for guidance through  <a href="mailto:dmc@dra.gov.pk" >email </a> (dmc@dra.gov.pk) with regards to guidance for procedures and requirements etc.<br><br>

                                    <strong>
                                        Data Management Cell (DMC)<br>
                                        Division of Pharmaceutical Evaluation & Registration<br>
                                        Drug Regulatory Authority of Pakistan<br>
                                        www.dra.gov.pk</strong></p>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok! Acknowledged</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



            <br>

            <div class="row mb-3">
                <div class="col-md-12">
                    <button  style="background-color: #3e8193 !important;" onclick="changeMenu('main')" class="btn btn-secondary float-right"><i class="fa fa-arrow-left"></i> Go Back</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12" style="border: 5px outset #c2c7d0; background-color: white; padding: 1%;">
                    <div class="col-md-6" style="float: left;">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company Name</label>
                                <br>
                                <i><u><?php echo @$userCompany[0]->companyName; ?></u></i>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Site Address</label>
                                <br>
                                <i><u><?php echo @$companyLicense->siteAddress.','.@$companyLicense->licCityName; ?></u></i>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Company Contact</label>
                                <br>
                                <i><u><?php echo @$userCompany[0]->contactPersonPhone; ?></u></i>
                            </div>
                        </div>
                        <!--<div class="col-md-12">
                              <div class="form-group">
                                  <label>Company Email</label>
                                  <br>
                                  <i><u><?php echo @$userCompany[0]->email; ?></u></i>
                              </div>
                          </div>
                          -->

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>License No.</label>
                                <br>

                                <i><u><?php echo @$companyLicense->licenseNoManual; ?></u></i>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>License Validity.</label>
                                <br>
                                <i><u><?php echo @$companyLicense->validTill; ?></u></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="float: right;">
                        <iframe src="https://maps.google.com/maps?q=<?php echo @$companyLicense->latitude.', '.@$companyLicense->longitude; ?>&z=12&output=embed" width="100%" height="280" frameborder="0" allowfullscreen="" style="border:0"></iframe>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div id="#main">
                        <div class="row" >
                            <div class='col-md-3'>
                                <div class='small-box bg-primary myDashboardTile' onclick="changeMenu('licensediv')"  style='cursor: pointer; padding:3%;'>
                                  <span  class='small-box-footer myDashboardTile'>
                                      <div class='inner'>
                                          <i class='fa fa-certificate fa-5x'></i>
                                      </div>
                                      <b>Licensing</b>
                                  </span>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-orange myDashboardTile' onclick="changeMenu('registrationdiv')" style='cursor: pointer; padding:3%;'>
                                  <span class='small-box-footer myDashboardTile'>
                                      <div class='inner'>
                                          <i class='far fa-edit fa-5x'></i>
                                      </div>
                                      <b>Registration</b>
                                  </span>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-green myDashboardTile' onclick="changeMenu('inspection')" style='cursor: pointer; padding:3%;'>
                                    <a href='<?php echo base_url() ?>inspection/lookup'  class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-search fa-5x'></i>
                                        </div>
                                        <b>Inspection</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-red myDashboardTile' onclick="changeMenu('pvdiv')" style='cursor: pointer; padding:3%;'>
                                  <span class='small-box-footer myDashboardTile'>
                                      <div class='inner'>
                                          <i class='fa fa-medkit fa-5x'></i>
                                      </div>
                                      <b>PV</b>
                                  </span>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-maroon  myDashboardTile' style='cursor: pointer; padding:3%;'>
                                    <a href='<?php echo base_url() ?>query/lookup'  class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-exchange-alt fa-5x'></i>
                                        </div>
                                        <b>LoQ</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="#licensediv">
                        <div class="row"  >
                            <div class='col-md-3'>
                                <div class='small-box bg-primary myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo (!@$companyLicense->id)?base_url().'newlicense/lookup':'' ?>' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-certificate fa-5x'></i>
                                        </div>
                                        <b>New License</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-orange myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>licenserenewal/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-certificate fa-5x'></i>
                                        </div>
                                        <b>License Renewal</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-green myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>licensevariance/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-certificate fa-5x'></i>
                                        </div>
                                        <b>License Variance</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-red myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>importlicense/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-exchange-alt fa-5x'></i>
                                        </div>
                                        <b>DML / In Process Data</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-purple myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>applicationHistory/licensing' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-history fa-5x'></i>
                                        </div>
                                        <b>Application History</b>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="#registrationdiv">
                        <div class="row" >
                            <div class='col-md-3'>
                                <div class='small-box bg-primary myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>newregistration/add' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='far fa-edit fa-5x'></i>
                                        </div>
                                        <b>Registered Products</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-orange myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>registrationrenewal/add' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='far fa-edit fa-5x'></i>
                                        </div>
                                        <b>Registration Renewal</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-green myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>registrationvariance/add' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='far fa-edit fa-5x'></i>
                                        </div>
                                        <b>Registration Variance</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-red myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>newexportregistration/add' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='far fa-edit fa-5x'></i>
                                        </div>
                                        <b>Export Registration</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-purple myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>applicationHistory/registration' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-history fa-5x'></i>
                                        </div>
                                        <b>Application History</b>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="#pvdiv">
                        <div class="row"  >
                            <div class='col-md-3'>
                                <div class='small-box bg-primary myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>qualifiedPerson/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 1 QPPV/LSO</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-orange myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>pmsf/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 2 PMSF</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-green myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>riskManagement/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 3 RMP</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-pink myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>adverseEventsADR/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 4 Report ADR</b>
                                    </a>
                                </div>
                            </div>

                            <div class='col-md-3'>
                                <div class='small-box bg-cyan myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>averseEventsNilReport/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 4B Nil Report</b>
                                    </a>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='small-box bg-brown myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>adverseEvents/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 4C Safety Issue</b>
                                    </a>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='small-box bg-red myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>pbrer/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 5 PBRER</b>
                                    </a>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='small-box bg-purple myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>pass/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 6 PASS</b>
                                    </a>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='small-box bg-gray myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>detectedSignals/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 7 DS</b>
                                    </a>
                                </div>
                            </div>
                            <div class='col-md-3'>
                                <div class='small-box bg-teal myDashboardTile' style='cursor: default; padding:3%;'>
                                    <a href='<?php echo base_url() ?>safetyCommunications/lookup' class='small-box-footer myDashboardTile'>
                                        <div class='inner'>
                                            <i class='fa fa-medkit fa-5x'></i>
                                        </div>
                                        <b>Module 8 SC</b>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

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

    function changeMenu(id){
        document.getElementById("#main").style.display="none";
        document.getElementById("#licensediv").style.display="none";
        document.getElementById("#registrationdiv").style.display="none";
        document.getElementById("#pvdiv").style.display="none";

        document.getElementById('#'+id).style.display="block";
    }
    $( document ).ready(function() {
        document.getElementById("#licensediv").style.display="none";
        document.getElementById("#registrationdiv").style.display="none";
        document.getElementById("#pvdiv").style.display="none";

    })


</script>

<script>
    $(document).ready(function(){
        $("#exampleModal").modal('show');
    });
</script>