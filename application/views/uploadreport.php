<?php 
$userType = $this->webSessionManager->getCurrentUserProp('user_type');
include "template/header.php";
if ($userType =='admin') {
  include "template/sidebar.php";
}
else{
  show_404();exit;
}
 ?>
 <!-- the breadcrump for pages that needed it -->
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Batch Upload
    <small>Upload Report</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- the content page -->
 <!-- Main content -->
    <section class="content">
      <div class="callout callout-info">
        <h4><?php echo removeUnderscore(ucfirst($model));  ?> Upload Report</h4>

        <p>You are welcome to the Upload Status Report Page !!!</p>
      </div>
      <!-- Main row -->
      <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">
          <div class="col-sm-12">
            <?php if ($status): ?>
              <div class="alert alert-success"><?php echo  wordwrap(ucfirst($message), 100 , "\n", true);  ?></div>
              <?php else: ?>
                <div class="alert alert-danger"><?php echo ucfirst($message); ?></div>
            <?php endif; ?>
          </div>
        </section>
        <!-- right col -->
      </div>
      
      <br>
      <a href="<?php echo @$backLink?$backLink:''; ?>" class="btn btn-primary">
        <i class="fa fa-arrow-back"></i> Back
      </a>
      <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
  </div>
 <?php include "template/footer.php"; ?>
 