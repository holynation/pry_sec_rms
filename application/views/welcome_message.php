<?php $base=base_url(); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Result Processing System | LOGIN</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href=" <?php echo $base ?>assets/lib/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $base ?>assets/lib/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $base ?>assets/lib/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo $base ?>assets/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo $base ?>assets/lib/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
<!--     <link href="https://fonts.googleapis.com/css?family=Audiowide" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
</head>
<body class="hold-transition login-page">
<div class="login-box">
<!--  <div class="login-logo">-->
<!--      <a href="--><?php //echo $base ?><!--"><b style="color: #fff;">RMS</b></a>-->
<!--  </div>-->
  <!-- /.login-logo -->
  <div class="login-box-body">

      <div class="login-logo">
        <img src="<?php echo base_url(@$school->school_logo); ?>" height="180px" width="80%" alt="UI RMS"/>
        <a href="<?php echo $base ?>">
          <b style="font-size:25px; color: #000;font-family: 'Audiowide', cursive;">SWOT CHARTER SCHOOL</b>
        </a>
      </div>
    <p class="login-box-msg">Sign in to start your session</p>
      <div class="alert alert-danger alert-dismissible" id="notify">
      </div>
    <form action="<?php echo base_url('auth/web'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" id='username' class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <input type="hidden" name="isajax">
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <!-- <input type="checkbox"> Remember Me -->
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
<input type="hidden" id='base_path' value="<?php echo $base; ?>">
<!--     <a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<style>
  #notify{
    display: none;
  }
</style>
<!-- jQuery 3 -->
<script src="<?php echo $base ?>assets/lib/jquery/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $base ?>assets/lib/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo $base ?>assets/lib/iCheck/icheck.min.js"></script>
<script src="<?php echo $base ?>assets/js/custom.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
    var form =$('form');
    form.submit(function(event) {
      event.preventDefault()
      var note = $("#notify");
      note.text('');
      note.hide()
      submitAjaxForm(form)
    });
    
  });

  function ajaxFormSuccess(target,data){
    if (data.status) {
      var path = data.message;
      location.assign(path);
    }
    else{
      $("#notify").show();
      $("#notify").text(data.message);
    }
  }
</script>
</body>
</html>