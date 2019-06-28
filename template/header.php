<?php 
$base=base_url('assets/') 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>RPS | <?php echo (isset($school) && $school)? $school->school_name:'System'; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo $base ?>lib/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo $base ?>lib/font-awesome/css/font-awesome.min.css"> 
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo $base ?>lib/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $base ?>css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?php echo $base ?>css/style.css">      
  <link rel="stylesheet" href="<?php echo $base ?>lib/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo $base ?>css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo $base ?>lib/morris.js/morris.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo $base ?>lib/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <script src="<?php echo $base ?>lib/jquery/jquery.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="dashboard" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>CS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg" style="text-transform: uppercase;"><b><?php echo @$school->school_name; ?></b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <input type="hidden" value="<?php echo base_url() ?>" id='baseurl'>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <?php
              $fullname='';
              $path='';
                if($this->webSessionManager->getCurrentUserProp('user_type') == 'admin'){
                  if(isset($admin)){
                    $fullname =  $admin->firstname .' '.$admin->lastname;
                    $path = ($admin->img_path != '') ? $admin->img_path : 'assets/images/default-profile.jpg';
                  }
                }else if($this->webSessionManager->getCurrentUserProp('user_type') == 'guardian'){
                  if(isset($guardian)){
                    $fullname =  $guardian->surname .' '.$guardian->firstname;
                    $path = ($guardian->img_path != '') ? $guardian->img_path : 'assets/images/default-profile.jpg';
                  }
                }
            ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url($path); ?>" class="user-image" alt="user">
              <span class="hidden-xs"><?php echo $fullname; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <?php if ('admin'==$this->webSessionManager->getCurrentUserProp('user_type')): ?>
                  <a href="<?php echo base_url('vc/admin/profile') ?>" class="btn btn-default btn-flat">Profile</a>
                <?php endif; ?>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
      <style>
          #notification{
              display: none;
              position: absolute;
              width: 50%;
              z-index: 5000;
          }
          .modal-dialog {
              margin-top: 150px ;
          }
          select{
            wdith:100%;
            display: block;
          }
      </style>
  </header>

<div id="notification" class="alert alert-dismissable text-center"></div>
