<?php 
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
      <!-- /.row (main row) -->
      <div>
        <div class="box box-primary">
          <div class="form-group">
            <label for="exampleInputEmail1">
              <a href="<?php echo base_url('mc/result_template'); ?>" type="button" class="btn btn-primary">
                <i class="fa fa-download"></i> download template
              </a>
            </label>
          </div>
          <form action="<?php echo base_url('mc/upload_result'); ?>" method='post' enctype='multipart/form-data'>
            <hr>
            <label style="background-color:#3C8DBC;color:#fff;">
              <div class="col-md-12" style="display: none;">
                <input type="checkbox" name="auto-register" checked>
                  <span></span>
              </div>
            </label>
            <hr>

            <div class="row">
              <div class="form-group col-lg-4">
                <label for="">Session Term</label>
                <select class="form-control" name="session_term" id="session_term">
                  <option value="">..choose session</option>
                  <?php echo buildOptionFromQuery($this->db,"select session_term.id,concat(session_name,' (',term_name,')') as value from session_term join academic_session on academic_session.id=session_term.academic_session_id join term on term.id=session_term.term_id order by academic_session.start_date desc"); ?>
                </select>
              </div>
              <div class="form-group col-lg-4">
                <label for="">Class</label>
                <select name="school_class" id="school_class" class="form-control">
                  <option value="">..choose class..</option>
                  <?php echo buildOptionFromQuery($this->db,"select id, class_name as value from school_class",null,isset($_GET['school_class'])?$_GET['school_class']:''); ?>
                </select>
              </div>
              <div class="form-group col-lg-4">
                <label for="">Subject</label>
                <select class="form-control" name="subject" id="subject">
                  <option value="">..select subject..</option>
                  <?php $query ="select id,subject_title as value from subject order by subject_title asc";
                      echo buildOptionFromQuery($this->db,$query,null,isset($_GET['subject'])?$_GET['subject']:''); ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-lg-4 ">
                  <label  for="">Select result file</label>
                  <input type="file" name="bulk-upload">
              </div>
            </div>

          <div class="form-group ">
            <br>
            <input class="btn btn-primary" type="submit" value='Upload Result' name="upload_result" id="upload_result">
          </div>


          </form>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
 <?php include "template/footer.php" ?>
 