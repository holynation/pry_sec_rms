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
      <div style="background-color: white">
        <form action="">

          <div class="form-group col-md-2">
            <label for="">Session Term</label>
            <select name="session" id="session" class="form-control">
              <option value="">..select session..</option>
              <?php echo buildOptionFromQuery($this->db,"select session_term.id,concat(session_name,'(',term_name,')') as value from session_term join academic_session on academic_session.id= session_term.academic_session_id join term on term.id=session_term.term_id order by academic_session.id desc",null,isset($_GET['session'])?$_GET['session']:'') ?>
            </select>
          </div>
            <div class="form-group col-md-2">
            <label for="">Class</label>
            <select name="class" id="class" class="form-control">
              <option value="">..choose class..</option>
              <?php echo buildOptionFromQuery($this->db,"select id, class_name as value from school_class",null,isset($_GET['class'])?$_GET['class']:'') ?>
            </select>
          </div>
           <div class="form-group col-md-2">
            <label for="">Subject</label>
            <select class="form-control" name="subject" id="subject">
              <option value="">..select subject..</option>
              <?php
                $sessionTerm=@$_GET['session'];
                loadClass($this->load,'session_term');
                $sessionTerm = $this->db->conn_id->escape_string($sessionTerm);
                $ses = new Session_term();
                $ses->ID=$sessionTerm;
                $ses->load();
              ?>
              <?php $query ="select id,subject_title as value from subject order by subject_title asc";
                  echo buildOptionFromQuery($this->db,$query,null,isset($_GET['subject'])?$_GET['subject']:''); ?>
            </select>
          </div>
          <div class="form-group col-md-2">
            <label for="">Registration Number</label>
            <input class="form-control" type="text" name="reg" placeholder="Search by reg. num" value="<?php echo isset($_GET['reg'])?$_GET['reg']:'' ?>">
          </div>

          <div class="form-group col-md-2">
            <label style="visibility: hidden;">emptyh</label>
            <input type="submit" value="Load Result" class="btn btn-primary">
          </div>
          <div class="clearfix"></div>
        </form>
        <div class="clearfix"></div>
      </div>
      <div class="table-section">
        <?php 
          $semesterCourse = @$_GET['subject'];
          $sessionSemester = @$_GET['session'];
          loadClass($this->load,'grade_scale');
          $gradeScale = new Grade_scale();
          $session = @$ses->academic_session_id;
          $where = (isset($_GET['reg']) && $_GET['reg'])?" and  registration_number like '%{$_GET['reg']}%'":'';
          $pg=@$_GET['pg'];
          if ($pg) {
            $pg=$this->db->conn_id->escape_string($pg);
            $where.=" and student_biodata.school_class_id=$pg";
          }
          
          $query ="select concat_ws(' ',surname,firstname,middlename) as student_name ,registration_number,ca_total,exam_score,(ca_total + exam_score) as total,grade,point from subject_score join student_subject_registration on student_subject_registration.id = subject_score.student_subject_registration_id join student_biodata on student_biodata.id =student_subject_registration.student_biodata_id  join academic_session on academic_session.id = student_subject_registration.academic_session_id  join term on term.id = student_subject_registration.term_id join session_term on session_term.academic_session_id = academic_session.id and session_term.term_id = term.id left join grade_scale on (ca_total + exam_score) between grade_scale.min_score and grade_scale.max_score where  student_subject_registration.subject_id=? and session_term.id=? $where";
          $param =array($semesterCourse,$sessionSemester);
          $tableData = $this->queryHtmlTableModel->getHtmlTableWithQuery($query, $param,$c,array(),null,false);
         ?>
         <?php if ($semesterCourse && $sessionSemester): ?>
           <?php 
            echo $tableData;
            ?>
            <?php else: ?>
              <table class="table table-striped">
                <tr>
                  <th>Student Name</th>
                  <th>Student Reg Number</th>
                  <th>CA SCORE</th>
                  <th>Exam Score</th>
                </tr>
                 </table>
         <?php endif ?>
         
        
      </div>
    </section>
    <!-- /.content -->
  </div>
  <style>
    .form-group{
      display: inline-block;
      margin-left: 5px;
    }
  </style>
 <?php include "template/footer.php" ?>
 