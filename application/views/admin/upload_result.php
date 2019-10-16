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
            <label>
              <a href="<?php echo base_url('mc/result_template/test'); ?>" type="button" class="btn btn-danger">
                <i class="fa fa-download"></i> download test template
              </a>
            </label>
            <label for="exampleInputEmail1">
              <a href="<?php echo base_url('mc/result_template/exam'); ?>" type="button" class="btn btn-primary">
                <i class="fa fa-download"></i> download exam template
              </a>
            </label>
          </div>

          <div class="box-header">
            <ul class="nav nav-tabs">
              <li role="presentation" class="active"><a href="#test" data-toggle='tab'>TEST UPLOAD</a></li>
              <li role="presentation"><a href="#exam" data-toggle='tab'>EXAM UPLOAD</a></li>
            </ul>
          </div> <!-- /.box-header -->
          <div class="tab-content">
            <div class="box-body tab-pane active" id="test">
              <form action="<?php echo base_url('mc/upload_result'); ?>" method='post' enctype='multipart/form-data'>
                  <div style="display: none;">
                    <input type="checkbox" name="auto-register" checked>
                      <span></span>
                  </div>
                <hr>
                <div class="row">
                  <div class="form-group col-lg-3">
                    <label for="">Upload Type</label>
                    <select class="form-control" name="test_type" id="test_type">
                      <option value="">.....choose upload type.....</option>
                      <option value="before">Before Midterm</option>
                      <option value="after">After Midterm</option>
                    </select>
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="">Session Term</label>
                    <select class="form-control" name="session_term" id="session_term">
                      <option value="">..choose session</option>
                      <?php echo buildOptionFromQuery($this->db,"select session_term.id,concat(session_name,' (',term_name,')') as value from session_term join academic_session on academic_session.id=session_term.academic_session_id join term on term.id=session_term.term_id order by academic_session.start_date desc"); ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="">Class</label>
                    <select name="school_class" id="school_class" class="form-control">
                      <option value="">..choose class..</option>
                      <?php echo buildOptionFromQuery($this->db,"select id, class_name as value from school_class",null,isset($_GET['school_class'])?$_GET['school_class']:''); ?>
                    </select>
                  </div>
                  <div class="form-group col-lg-3">
                    <label for="">Subject</label>
                    <select class="form-control" name="subject" id="subject">
                      <option value="">..select subject..</option>
                      <?php $query ="select id,subject_title as value from subject order by subject_title asc";
                          echo buildOptionFromQuery($this->db,$query,null,isset($_GET['subject'])?$_GET['subject']:''); ?>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="form-group col-lg-4">
                      <label  for="">Select result file</label>
                      <input type="file" name="bulk-upload">
                  </div>
                </div>
                <input type="hidden" name="upload_type" id="upload_type" value="test_upload">
                <div class="form-group ">
                  <br>
                  <input class="btn btn-danger" type="submit" value='Upload Test Result' name="upload_result" id="upload_result">
                </div>
              </form>
            </div>

            <div class="box-body table-responsive no-padding tab-pane" id="exam">
              <form action="<?php echo base_url('mc/upload_result'); ?>" method='post' enctype='multipart/form-data'>
                  <div style="display: none;">
                    <input type="checkbox" name="auto-register" checked>
                      <span></span>
                  </div>
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
                  <div class="form-group col-lg-4">
                      <label  for="">Select result file</label>
                      <input type="file" name="bulk-upload">
                  </div>
                </div>
                <input type="hidden" name="upload_type" id="upload_type" value="exam_upload">
                <div class="form-group ">
                  <br>
                  <input class="btn btn-primary" type="submit" value='Upload Exam Result' name="upload_result" id="upload_result">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
</div>
 <?php include "template/footer.php" ?>
 