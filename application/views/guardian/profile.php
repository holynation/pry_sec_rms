<?php 
include "template/header.php";
if ($this->webSessionManager->getCurrentUserProp('user_type')=='admin') {
  include "template/sidebar.php";
}else if($this->webSessionManager->getCurrentUserProp('user_type')=='guardian'){
  include "template/sidebar_student.php";
}
 ?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Guardian Profile
    <small><?php echo $guardian->surname.' '.$guardian->firstname ?></small>
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
      <div class="row">
        <div class="col-md-5">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
                 <?php
                  $path = (isset($guardian) && $guardian->img_path) ? $guardian->img_path : "assets/img/default-profile.jpg";
                  ?>
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($path); ?>" alt="admin profile picture">
                  <!-- <div class="showupload btn btn-primary btn-block">change photo</div> -->
                  <div class="form">
                    <div class="upload-control" style="display: none; width: 205px;margin:0 auto;">
                      <form id="data_profile_change" method="post" enctype="multipart/form-data" action="<?php echo base_url('mc/update/guardian/'.$guardian->ID.'/1/1') ?> ">
                      <label for="">
                        choose file to upload <br>
                        <input type="file" name="img_path" id="img_path" class="form-control">
                      </label>
                      <input type="submit" value="Upload Photo" name="submit-btn" class="btn btn-primary btn-block">
                      </form>
                    </div>
                </div>
                <?php //} ?>
                <div class="push-down"></div>
              <h3 class="profile-username text-center"><?php echo $guardian->surname. ' '. $guardian->firstname; ?></h3>

              <p class="text-muted text-center"><b>Email: <?php echo $guardian->email;  ?></b></p>

              <ul class="list-group list-group-unbordered">
              </ul>

              <a href="#" data-toggle='modal' data-target='#center_modal_password' class="btn btn-primary" style="margin:0 auto;">Change Password</a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

         <!-- password change modal -->
        <div id="center_modal_password" class="modal fade animated position_modal" role="dialog">
          <div class="modal-dialog">
            <!-- <form action="" method="post"> -->
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Change Password</h4>
                  </div>
                  <div class="modal-body">
                      <form  class="form-horizontal" id="form_change_password" name="form_change_password" action="<?php echo base_url('vc/changePassword'); ?>">
                        <div id="data_notify"></div><br>
                        <div class="box-body">
                          <div class="form-group">
                            <label for="data_current_password" class="col-sm-2 control-label">Current Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="data_current_password" name="data_current_password" placeholder="Current Password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="data_password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="data_password" name="data_password" placeholder="Password">
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="data_confirm_password" class="col-sm-2 control-label">Confirm Password</label>
                            <div class="col-sm-10">
                              <input type="password" class="form-control" id="data_confirm_password" name="data_confirm_password" placeholder="Confirm Password">
                            </div>
                          </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                          <button type="submit" class="btn btn-info pull-right">Change</button>
                        </div>
                        <!-- /.box-footer -->
                      </form>
                  </div>
              </div>
            <!-- </form> -->
          </div>
        </div>
        <!-- end modal -->

        <div class="col-md-7">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Bio-Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <td>Student Name (In Relation)</td>
                  <td><?php echo $guardian->student_biodata->surname .' '. $guardian->student_biodata->firstname.' ('.$guardian->student_biodata->registration_number . ')'; ?></td>
                <tr>
                  <td>Surname</td>
                  <td><?php echo $guardian->surname; ?></td>
                </tr>
                <tr>
                  <td>Firstname</td>
                  <td><?php echo $guardian->firstname; ?></td>
                </tr>
                <tr>
                  <td>Phone Number</td>
                  <td><?php echo format_phone('nig',$guardian->phone_num); ?></td>
                </tr>
                <tr>
                  <td>Address</td>
                  <td><?php echo $guardian->address; ?> </td>
                </tr>
              </table>
            </div>
                    <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
    <!-- /.content -->
  </div>
 <?php include "template/footer.php" ?>
  <script>
    function addMoreEvent() {
      $("#data_profile_change").submit(function(e){
       e.preventDefault();
       submitAjaxForm($(this));
      });
    }
   function ajaxFormSuccess(target,data) {
     reportAndRefresh(target,data,'flagAction',3000);
   }
  </script>
 