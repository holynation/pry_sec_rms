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
              <div class="form-group  col-md-4">
                  <label for="">Academic Session</label>
                  <select class="form-control" name="session" id="session" required="">
                      <option value="" >..select session</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,session_name as value from academic_session order by session_name desc'); ?>
                  </select>
              </div>
              <div class="form-group  col-md-4">
                  <label for="">School class</label>
                  <select class="form-control autoload" data-child='reg' data-load='studentAll' data-depend='session' name="l" id="class" required=""> 
                      <option value="">..select class..</option>
                      <?php echo buildOptionFromQuery($this->db,'select id,class_name as value from school_class'); ?>
                  </select>
              </div>
              <div class="form-group  col-md-4">
                  <label for="">Student</label>
                  <select name="reg" id="reg" class="form-control">
                    <option value="">..select student...</option>
                  </select>
              </div>
              </div>
              <input type="submit" value="Load Subject" class="btn btn-primary pull-right" />
              <div class="clearfix"></div>

              </div>
              
          </form>
          <?php if (@$result): ?>
            <div>
              <h3 style="padding-bottom: 15px; border-bottom: thin solid #777;">Student Subject Registration (<?php echo $header; ?>)
                <button data-toggle='modal' data-target='#modal-add' class="btn btn-success pull-right"> <i class="fa fa-plus"></i> Add Subject
                </button>
              </h3>
            </div>
            
          <?php foreach ($result as $res): ?>
          <div>
            <?php $student=@$res[0]; ?>
            <?php if (@$student): ?>
              
              <h4><?php echo strtoupper($student->fullname); ?> </h4>
              <?php 
              $action = array('delete'=>'delete/student_subject_registration');
              echo $this->queryHtmlTableModel->buildOrdinaryTable($res[1],$action);
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
                <?php 
                    loadClass($this->load,'student_biodata');
                    $std = $this->student_biodata->getWhere(array('registration_number'=>$_GET['reg']),$c,0,null,false);
                    $std =@$std[0];
                    $formContent= $this->modelFormBuilder->start('registration_table')
                    ->appendInsertForm('student_subject_registration',true,array('academic_session_id'=>$_GET['session'],'student_biodata_id'=>$std->ID))
                    ->addSubmitLink()
                    ->appendSubmitButton("Add",'btn btn-success')
                    ->build();
                ?>
                  <div class="modal fade" id="modal-add">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title">Enter Course Registration for <b><?php echo $_GET['reg'].' ('. @$className .' '.@$sessionName .')'; ?></b></h4>
                        </div>
                        <div class="modal-body">
                          <p>
                            <?php echo $formContent; ?>
                          </p>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
            <?php endif; ?>
          </div>
          <div style="page-break-before: always;"></div>

          <!-- show the table here -->
          <?php endforeach; ?>
          <?php endif; ?>

      </div>
      <div>
      </div>
    </section>
    <!-- /.content -->
  </div>
 <?php include "template/footer.php" ?>
 <script>

   function addMoreEvent() {
       $('li[data-ajax-edit=1] a').click(function(event){
         event.preventDefault();
         var link = $(this).attr('href');
         var action = $(this).text();
         sendAjax(null,link,'','get',showUpdateForm);
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
    showNotification(data.status,data.message)
     if (data.status) {
      location.reload();
      return;
     }
   }
 </script>
 