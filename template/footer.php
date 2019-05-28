<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <?php 
    loadClass($this->load,'school');
    $school = new School();
    $schoolData =$school->all($total,false);
    if ($schoolData) {
      $schoolData = $schoolData[0];
    }
     ?>
    <strong>Copyright &copy;<?php echo date("Y"); ?> <a href="javascript:void(0);">  <?php echo ucfirst($schoolData->school_name); ?></a>.</strong>
</footer>
  <div class="control-sidebar-bg"></div>
</div>
<script src="<?php echo $base ?>lib/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $base ?>lib/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo $base ?>lib/jquery-knob/jquery.knob.min.js"></script>
<script src="<?php echo $base ?>lib/moment/min/moment.min.js"></script>
<script src="<?php echo $base ?>lib/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo $base ?>lib/iCheck/icheck.min.js"></script>
<script src="<?php echo $base ?>js/adminlte.min.js"></script>
<script src="<?php echo $base ?>js/pages/dashboard.js"></script>
<script src="<?php echo $base ?>lib/select2/dist/js/select2.full.min.js"></script>
<script src="<?php echo $base ?>js/demo.js"></script>
<script src="<?php echo $base ?>js/custom.js"></script>
<script type="text/javascript">
  $(function() {
  	 $("filter-item select,select.form-control,form-group select,form select").select2();
  });
  //get the height of the window and set the window frame size
  // var height = window.innerHeight;
  // if (height > 400) {
  //   $('.content-wrapper').css({
  //     'height': height,
  //     'overflow-y': 'auto'
  //   });
  //   $('body').css('overflow-y', 'scroll');
  // }
	var data_notify = $('#data_notify');
    $('#form_change_password').submit(function(e){
      e.preventDefault();
      var data_password = $('#data_password').val(),
          confirm_password = $('#data_confirm_password').val();

          if(data_password == '' || confirm_password == ''){
              data_notify.html('<p class="alert alert-danger" style="width:50%;margin:0 auto;">All Field is required...</p>');
              return false;
          }
          else if(data_password != confirm_password ){
            data_notify.html('<p class="alert alert-danger" style="width:50%;margin:0 auto;">Password must match...</p>');
            return false;
          }else{
          	submitAjaxForm($(this));
          }

    });
  </script>
</body>
</html>
