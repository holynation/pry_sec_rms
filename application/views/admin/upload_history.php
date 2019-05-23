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
    Admin Panel
    <small>Upload history</small>
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
        <div class="col-xs-12 box box-primary">

          <form  action="">
            <div class="form-group col-lg-4">
              <label for="">Session Term</label>
              <select name="session" id="session" class="form-control">
                <option value="">..select session..</option>
                <?php echo buildOptionFromQuery($this->db,"select session_term.id,concat(session_name,'(',term_name,')') as value from session_term join academic_session on academic_session.id= session_term.academic_session_id join term on term.id=session_term.term_id order by session_term.id desc",null,isset($_GET['session'])?$_GET['session']:'') ?>
              </select>
            </div>
              <div class="form-group col-lg-4">
              <label for="">Class</label>
              <select name="class" id="class" class="form-control">
                <option value="">..choose class..</option>
                <?php echo buildOptionFromQuery($this->db,"select id, class_name as value from school_class",null,isset($_GET['class'])?$_GET['class']:'') ?>
              </select>
            </div>
             <div class="form-group col-lg-4">
              <label for="">Subject</label>
              <select class="form-control" name="subject" id="subject">
                <option value="">..select subject</option>
                <?php $query ="select id,subject_title as value from subject order by subject_title asc";
                  echo buildOptionFromQuery($this->db,$query,null,isset($_GET['subject'])?$_GET['subject']:''); ?>
              </select>
            </div>

            <div class="form-group col-lg-4">
                <label for="">Load result</label>
              <input type="submit" value="Load Result" class="btn btn-primary form-control">
            </div>
          </form>
        </div>
        <div id="notification" style="display: none;">  </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Upload Result History</h3>
              <?php if ($uploadHistory): ?>
                <table class="table table-bordered">
                  <tr>
                    <th>Subject</th>
                    <th>Date Uploaded</th>
                    <th>Uploader</th>
                    <th>Action</th>
                  </tr>
                <?php foreach ($uploadHistory as $history): ?>
                  <tr>
                      <td><?php echo $history['upload_subject'] ?></td>
                      <td><?php echo $history['date_uploaded'] ?></td>
                      <td><?php echo $history['uploader'] ?></td>
                      <td>
                        <a target="_blank" href="<?php echo base_url($history['document_path']); ?>" class='btn btn-primary'>download Result</a>
                      </td>
                  </tr>
                <?php endforeach; ?>
                </table>
                <?php else: ?>
                  <br /><br />
                  <div class="alert alert-danger">
                    No History Found.
                  </div>
              <?php endif; ?>
              
             
            </div>
            <!-- /.box-header -->
         
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 <?php include "template/footer.php"; ?>
 <script>
   function addMoreEvent(){
    $('.table').removeClass('table-striped');
    $(".table").addClass('table-hover');
    $(".app-btn").click(function(event) {
      if (!confirm("are you sure you want to perform operation")) {
        return;
      }
      var path = $('#baseurl').val()+'ajaxData/'+$(this).attr('data-target');
      sendAjax($(this),path,'sub=true','post',updatePage);

    });
   }
   function updatePage(target,data) {
    data = JSON.parse(data);
    if (data.status) {
      location.reload();
    }
    else{
     showNotification(data.status,data.message); 
     
   }
    }
 </script>
 