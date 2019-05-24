<?php 
// include "template/header.php";
// include "template/sidebar.php";
// for testing
include "template/header.php";
include "template/sidebar.php";
 ?>
 <!-- the breadcrump for pages that needed it -->
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- the content page -->
 <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-5 ">
          
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->
      <div class="box box-danger" style="padding: 15px">
        <?php if (($mesage=$this->webSessionManager->getFlashMessage('message'))): ?>
          <div class="alert alert-danger">
            <?php echo $message ?>
          </div>
        <?php endif ?>
        
          <div class="alert alert-info">
            Note: if registration number is not selected , report is generated for all the student that matches the filter settings.It is highly recommended to load report by registration number for speed and performance sake.
          </div>
          <form action="<?php echo base_url('vc/admin/report') ?>">
              <div class="row">
              <div class="form-group col-sm-3 col-md-3">
                  <label for="">Academic Session</label>
                  <select class="form-control" name="session" id="session">
                      <option value="" >..select session</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,session_name as value from academic_session order by session_name desc'); ?>
                  </select>
              </div>
              <div class="form-group col-sm-3 col-md-3">
                <label for="">Session Term</label>
                <select class="form-control" name="sessionTerm" id="sessionTerm" required="">
                    <option value="" >..select session term</option>
                    <?php echo buildOptionFromQuery($this->db,'select id,term_name as value from term order by id asc'); ?>
                </select>
              </div>
              <div class="form-group col-sm-3 col-md-3">
                  <label for="">School Class</label>
                  <select class="form-control autoload" data-child='reg' data-load='studentIn' data-depend='session,sessionTerm' name="l" id="class" required=""> 
                      <option value="">..select level..</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,class_name as value from school_class'); ?>
                  </select>
              </div>
              <div class="form-group col-sm-3 col-md-3">
                  <label for="">Student</label>
                  <select name="reg" id="reg" class="form-control">
                    <option value="">..select student...</option>
                  </select>
              </div>
              </div>
              <input type="submit" value="Load Report" class="btn btn-primary pull-right" />
              <div class="clearfix"></div>

              </div>
              
          </form>

      </div>
      <div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 <?php include "template/footer.php" ?>
 