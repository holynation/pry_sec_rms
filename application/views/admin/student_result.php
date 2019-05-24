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
            <?php echo $message; ?>
          </div>
        <?php endif; ?>
        
        <br>
          <form>
              <div class="row">
              <div class="form-group col-sm-4 col-md-4">
                  <label for="">Academic Session</label>
                  <select class="form-control" name="session" id="session" required="">
                      <option value="" >..select session</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,session_name as value from academic_session order by session_name desc'); ?>
                  </select>
              </div>
              <div class="form-group col-sm-4 col-md-4">
                  <label for="">School Class</label>
                  <select class="form-control autoload" data-child='reg' data-load='studentIn' data-depend='session' name="l" id="class" required=""> 
                      <option value="">..select class..</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,class_name as value from school_class'); ?>
                  </select>
              </div>
              <div class="form-group col-sm-4 col-md-4">
                  <label for="">Student</label>
                  <select name="reg" id="reg" class="form-control">
                    <option value="">..select student...</option>
                  </select>
              </div>
              </div>
              <input type="submit" value="Load Result" class="btn btn-primary pull-right" />
              <div class="clearfix"></div>

              </div>
              
          </form>
          <?php //if (@$result): ?>
            
          <div>
            <?php if (@$student): ?>
              <h3><?php echo strtoupper($student->fullname); ?> RESULT
                <button data-toggle='modal' data-target='#modal-add' class="btn btn-success pull-right"style="margin-bottom: 15px;"> 
                  <i class="fa fa-plus"></i> Add Result
                </button>
              </h3>
              <?php 

              $action = array('delete'=>'delete/subject_score','edit'=>'edit/subject_score');
              echo $this->queryHtmlTableModel->buildOrdinaryTable($result,$action);
              ?>
              <div class="modal fade" id="modal-edit">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                      <p id="edit-container">
                        
                      </p>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            <?php loadClass($this->load,'student_biodata');
              $std = $this->student_biodata->getWhere(array('registration_number'=>$_GET['reg']),$c,0,null,false);
              $std =@$std[0];
            ?>
              <div class="modal fade" id="modal-add">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Enter Result for <b><?php echo $_GET['reg']; ?></b></h4>
                    </div>
                    <div class="modal-body">
                      <div class="alert alert-info">You will only be able to add a score that has been registered for the student</div>
                      <p>
                        <form action="<?php echo base_url('mc/add/subject_score/1'); ?>" method='post' id='result_form'>
                          <div class="form-group">
                            <label for="student_subject_registration_id">Student Registered Subject</label>
                            <select class="form-control" name="student_subject_registration_id" id="student_subject_registration_id">
                              <?php 
                                $query="select student_subject_registration.id,subject_title as value from student_subject_registration join subject on subject.ID=student_subject_registration.subject_id where student_biodata_id=? and academic_session_id=? and not exists(select * from subject_score where student_subject_registration_id=student_subject_registration.ID) order by subject_title asc";
                                $option = buildOptionFromQuery($this->db,$query,array($std->ID,$_GET['session']));
                               ?>
                               <option value="">..select subject..</option>
                               <?php echo $option; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ca_score1">Enter First CA score</label>
                            <input type="number" min="0" class="form-control" id="ca_score1" name="ca_score1">
                          </div>
                          <div class="form-group">
                            <label for="ca_score2">Enter Second CA score</label>
                            <input type="number" min="0" class="form-control" id="ca_score2" name="ca_score2">
                          </div>
                          <div class="form-group">
                            <label for="exam_score">Enter Exam Score</label>
                            <input type="number" min="0" max="100" class="form-control" id="exam_score" name="exam_score">
                          </div>

                          <button class="btn btn-success pull-right" type="submit" name="edu-submit">Add</button>
                          <div class="clearfix"></div>
                        </form>
                      </p>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            <?php endif; ?>
          </div>
          <!-- show the table here -->
          <?php //endif; ?>

      </div>
      <div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 <?php include "template/footer.php"; ?>

 <script>
   function addMoreEvent() {
       $('li[data-ajax-edit=1] a').click(function(event){
         event.preventDefault();
         var link = $(this).attr('href');
         var action = $(this).text();
         sendAjax(null,link,'','get',showUpdateForm);
       });

    
     $('#result_form').submit(function(event) {
       event.preventDefault();
       submitAjaxForm($(this));
     });
   }
    function showUpdateForm(target,data) {
       var data = JSON.parse(data);
       if (data.status==false) {
         showNotification(false,data.message);
         return;
       }
      var container = $('#edit-container');
        container.html(data.message);
        //rebind the autoload functions inside
        $('#modal-edit').modal();
     }
    function ajaxFormSuccess(target,data) {
      showNotification(data.status,data.message);
      if (data.status) {
        location.reload();
      }
    }
 </script>
 