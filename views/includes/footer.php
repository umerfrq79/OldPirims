<footer class="main-footer" id="myFooter">
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"><?php echo $this->companyAddress; ?></a>.</strong> All rights reserved.
  <div class="float-right d-none d-sm-inline-block">
    <b><?php echo $this->companyProject; ?></b> | <b>Version</b> 3.1.0-rc | Powered By: <span><b><a href="https://www.usp.org" target="_blank">USP | PQM+ (usp.org)</a></b><span>
  </div>
</footer>

</div>
<!-- ./wrapper -->

<script type="text/javascript">
  $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
      var prefixSorter = function(results) {
          if (!results || results.length == 0)
              return results

          // Find the open select2 search field and get its value
          var term = document.querySelector('.select2-search__field').value.toLowerCase()
          if (term.length == 0)
              return results

          return results.sort(function(a, b) {
              aHasPrefix = a.text.toLowerCase().indexOf(term) == 0
              bHasPrefix = b.text.toLowerCase().indexOf(term) == 0

              return bHasPrefix - aHasPrefix // If one is prefixed, push to the top. Otherwise, no sorting.
          })
      }

      $('.prefixselect2').select2({ sorter: prefixSorter })







      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()

      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
      //Custom Date range picker
      $('#dateRange').daterangepicker({ timePicker: false, timePickerIncrement: 30, locale: { format: 'DD-MMM-YY' }})
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )

      //Date picker
      $('.datepicker').datepicker({
        autoclose: true
      })

      //Colorpicker
      $('.my-colorpicker1').colorpicker()
      //color picker with addon
      $('.my-colorpicker2').colorpicker()

      //Timepicker
      $('.timepicker').timepicker({
        showInputs: false
      })

      //iCheckbox
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
      
      //iCheck for checkbox and radio inputs
      $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
      })
      //Red color scheme for iCheck
      $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
      })
      //Flat red color scheme for iCheck
      $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
      })

      /* BOOTSTRAP SLIDER */
      $('.slider').slider()
  })

  var windowURL = window.location.href;
  pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
  var x= $('a[href="'+pageURL+'"]');
      x.addClass('active');
      x.parent().addClass('active');
  var y= $('a[href="'+windowURL+'"]');
      y.addClass('active');
      y.parent().addClass('active');
</script>
<!-- Notification -->
<!-- <script src="<?php echo base_url(); ?>assets/dist/vendors/notification/notification.js"></script> -->
<script>
  // $(function () {
  //   //Add text editor
  //   $('#compose-textarea').summernote()
  // })
</script>
<script>
  // $(function () {
  //   $("#example1").DataTable({
  //     "responsive": true, "lengthChange": false, "autoWidth": false,
  //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": false,
  //     "searching": false,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": false,
  //     "responsive": true,
  //   });
  // });
</script>
<script>
  // $(function () {
  //   $("#jsGrid1").jsGrid({
  //       height: "100%",
  //       width: "100%",

  //       sorting: true,
  //       paging: true,

  //       data: db.clients,

  //       fields: [
  //           { name: "Name", type: "text", width: 150 },
  //           { name: "Age", type: "number", width: 50 },
  //           { name: "Address", type: "text", width: 200 },
  //           { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name" },
  //           { name: "Married", type: "checkbox", title: "Is Married" }
  //       ]
  //   });
  // });
</script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<script type="text/javascript">
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    //$('[title]').tooltip()
  })
</script>
<script type="text/javascript">
  $('.required,.renewalrequired,.allphaserequired, .siterequired, .layoutrequired, .layoutdmlrequired, .dmlrequired').each(function(i, obj) {
      //$(this).parent().find('label').prepend('<i class="fa fa-asterisk text-danger"></i> ');
      $(this).parent().parent().find('label').prepend('<span class="asterisk"><i class="fa fa-asterisk text-danger"></i></span> ');
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
      $("[type='date']").keydown(function (evt) {
          evt.preventDefault();
      });
      $("[type='date']").keyup(function (evt) {
          evt.preventDefault();
      });
      $("[type='date']").keypress(function (evt) {
          evt.preventDefault();
      });
    $('input[type=file]').each(function(index, field){
      filenames = $(this).attr('name');
      if(filenames.substr(0, 11) == 'tabledetail' || filenames == 'files'){
        return;
      }
      $('#filenames').append(filenames+'~');
    });
    $('#myForm :input').each(function(index, field){
      fieldnames = $(this).attr('name');
      if(typeof fieldnames === 'undefined' || fieldnames.substr(-1, 1) == ']' || fieldnames == 'files'){
        return;
      }
      $('#fieldnames').append(fieldnames+'~');
    });
    $('table').each(function(index, field){
      tablenames = $(this).attr('id');
      if(tablenames.substr(0, 11) !== 'tabledetail'){
        return;
      }
      $('#tablenames').append(tablenames+'~');
    });
      <?php if($this->roleId == 26){ ?>
      //$("#formSave").attr('disabled', 'disabled');
      $("#formSubmit").attr('disabled', 'disabled');
      <?php } ?>
      <?php if(@$recordsEdit[0]->challan_no  || @$challanInfo[0]->challan_no  || $this->roleId <> 26){ ?>
      //$('#formSave').removeAttr('disabled');
      $('#formSubmit').removeAttr('disabled');
      <?php } ?>

  });
  function success_function(responseText, statusText, XMLHttpRequest){
      console.log(responseText);
      var jsonData = JSON.parse(responseText);

      if (typeof(jsonData['success']) != 'undefined' && (jsonData['success'] == true || jsonData['success'] == 'true')) {

          $('#verify_challan').html('Verified');
          $('#challan_status').val('Paid');
          $('#challan_fee').val(jsonData["data"]['Fee']);
          $('#challan_date').val(jsonData["data"]['PaidDate']);
          $('#challan_msg').val(jsonData["data"]['FeeOf']);

          $('#challan_account_id').val(jsonData["data"]['AccountId']);
          $('#challan_account_title').val(jsonData["data"]['AccountTitle']);

          $('.challan-status').removeClass('text-danger').addClass('text-success').html('Challan Status: <strong> Paid</strong>');
          $('#verify_result').html('<span>Challan Fee: '+jsonData["data"]['Fee']+'</span><br><span>Paid Date: '+jsonData["data"]['PaidDate']+'</span><br><span>Fees Of: '+jsonData["data"]['FeeOf']+'</span>');
          //$('#formSave').removeAttr('disabled');
          $('#formSubmit').removeAttr('disabled');


      }else if(typeof(jsonData['success']) != 'undefined' && (jsonData['success'] == false || jsonData['success'] == 'false')){
          $('.challan-status').removeClass('text-success').addClass('text-danger').html('Challan Status: <strong> Unpaid </strong>');
          $('#challan_status').val('Unpaid');
          $('#challan_fee').val('');
          $('#challan_date').val('');

          //handling the error msg
          if(jsonData['error'] != 'undefined' && typeof jsonData['error'] === 'string'){
              $('#verify_result').html(jsonData['error']);
          }else if(jsonData['error']['msg'] != 'undefined'){
              $('#verify_result').html(jsonData['error']['msg']);
          }else{
              $('#verify_result').html('Some problem occured while verifying');
          }

          //$("#formSave").attr('disabled', 'disabled');
          $("#formSubmit").attr('disabled', 'disabled');
          $('#challan_msg').val(jsonData['error']);
      }else if (typeof(jsonData['message']) != 'undefined' && jsonData['message'] != '') {
          $('.challan-status').removeClass('text-success').addClass('text-danger').html('Challan Status: <strong> Unpaid </strong>');
          $('#challan_status').val('Unpaid');
          $('#challan_fee').val('');
          $('#challan_date').val('');
          $('#verify_result').html(jsonData['message']);
          $('#challan_msg').val(jsonData['message']);

          //$("#formSave").attr('disabled', 'disabled');
          $("#formSubmit").attr('disabled', 'disabled');
      }
      else{
          // console.log('ELSE !!!! :'+jsonData['success']);
      }
  }
  $(document).on('click', '#verify_challan', function(e){
      e.preventDefault();
      var challan_no = $('#challan_no').val();
      var app_ref = $('#app_ref_no').val();

      $.ajax({
          type:'POST',
          url:'<?php echo base_url(); ?>verifyChallan',
          data: {
              challan_no:challan_no
          },
          beforeSend: function () {
              $('#verify_challan').attr('disabled', 'disabled');
              //$("#formSave").attr('disabled', 'disabled');
              $("#formSubmit").attr('disabled', 'disabled');

              /// before sending ajax, empty the text , so that new data does not mixup with old vals.
              $('#challan_status').val('');
              $('#challan_fee').val('');
              $('#challan_date').val('');
              $('#challan_msg').val('');
              $('#challan_account_id').val('');
              $('#challan_account_title').val('');
              $('#verify_result').html('Verifying Challan Information,Please wait...');
          },
          success:success_function
      });
  });
</script>
</body>
</html>
