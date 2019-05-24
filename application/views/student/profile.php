<?php 
$userType= $this->webSessionManager->getCurrentUserProp('user_type');
include "template/header.php";
if ($userType=='admin') {
  include "template/sidebar.php";
}

 ?>
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Student Profile
    <small><?php echo $student->surname.' '.$student->firstname.' '.$student->middlename.' ( '.$student->registration_number.' )'; ?></small>
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
        <div class="col-md-4">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <?php if (@$student->img_path): ?>
                <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url($student->img_path); ?>" alt="Student profile picture">
                <?php else: ?>
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets/img/default-profile.jpg'); ?>" alt="Student profile picture">
                <br /> 
              <?php endif; ?>
                  
                  <div class="showupload btn btn-primary btn-block">change photo</div>
                  <div class="form">
                    <div class="upload-control" style="display: none; width: 205px;margin:0 auto;">
                      <form method="post" name="data_profile_change" id="data_profile_change" enctype="multipart/form-data" action="<?php echo base_url('mc/update/student_biodata/'.$student->ID.'/1'); ?>">
                      <label for="">
                        choose file to upload <br>
                        <input type="file" name="img_path" id="img_path" class="form-control">
                      </label>
                      <input type="submit" value="Upload Photo" name="submit-btn" class="btn btn-primary">
                      </form>
                    </div>
                </div>
                <div class="push-down"></div>
              <h3 class="profile-username text-center"><?php echo $student->surname. ' '. $student->firstname; ?></h3>

              <p class="text-muted text-center"><b>Reg No: <?php echo $student->registration_number; ?></b></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  
                  <b>School Class</b> <a class="pull-right"><?php echo @$student->school_class->class_name; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Entry Mode</b> <a class="pull-right"><?php echo @$student->entry_mode->mode_of_entry; ?></a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-8">
          <div class="box">
            <div class="box-header">
              <ul class="nav nav-tabs">
                <li role="presentation" class="active"><a href="#biodata" data-toggle='tab'>Biodata</a></li>
              </ul>
              <!-- <h3 class="box-title">Bio-Data</h3> -->
            </div>
            <!-- /.box-header -->
            <div class="tab-content">
              <div class="box-body table-responsive no-padding tab-pane active" id="biodata">
                <table class="table table-hover">
                  <tr>
                    <td>Surname</td>
                    <td><?php echo $student->surname; ?></td>
                  </tr>
                  <tr>
                    <td>Matric Number</td>
                    <td><?php echo $student->registration_number; ?></td>
                  </tr>
                  <tr>
                    <td>Firstname</td>
                    <td><?php echo $student->firstname; ?></td>
                  </tr>
                  <tr>
                    <td>Middlename</td>
                    <td><?php echo $student->middlename; ?></td>
                  </tr>
                  <tr>
                    <td>Gender</td>
                    <td><?php echo $student->gender; ?></td>
                  </tr>
                  <tr>
                    <td>Date of Birth</td>
                    <td><?php echo $student->dob; ?></td>
                  </tr>
                  <tr>
                    <td>Phone Number</td>
                    <td><?php echo $student->email; ?></td>
                  </tr>
                  <tr>
                    <td>Marital Status</td>
                    <td><?php echo @$student->marital_status; ?></td>
                  </tr>
                  <tr>
                    <td>Religion</td>
                    <td><?php echo @$student->religion; ?></td>
                  </tr>
                  <tr>
                    <td>Address</td>
                    <td><?php echo $student->address; ?></td>
                  </tr>
                  <tr>
                    <td>Current Level</td>
                    <td><?php echo @$student->school_class->class_name; ?></td>
                    </tr>
                    <tr>
                      <td>Mode of Entry</td>
                      <td><?php echo @$student->entry_mode->mode_of_entry; ?></td>
                      </tr>
                  <tr>
                    <td>State Of Origin</td>
                    <td><?php echo $student->state_of_origin; ?></td>
                    </tr>
                    <tr>
                      <td>LGA Of Origin</td>
                      <td><?php echo $student->lga_of_origin; ?></td>
                      </tr>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
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
     $('.showupload').click(function(event) {
       $(this).hide();
       $('.upload-control').show();
     });

     $("#data_profile_change").submit(function(e){
      e.preventDefault();
      submitAjaxForm($(this));
     });
   }
function ajaxFormSuccess(target,data) {
  reportAndRefresh(target,data);
}
 </script>
 