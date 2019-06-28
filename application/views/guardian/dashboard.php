<?php 
// include "template/header.php";
// include "template/sidebar.php";
// for testing
include "template/header.php";
include "template/sidebar_student.php";
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
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $countData['student']; ?></h3>

              <p>Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-wand"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $currentClass; ?></h3>

              <p>Current Class</p>
            </div>
            <div class="icon">
              <i class="ion ion-easel"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $countData['subject']; ?></h3>

              <p>Subject</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $countData['term']; ?></h3>

              <p>Terms</p>
            </div>
            <div class="icon">
              <i class="ion ion-nuclear"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
     
      <div class="row">
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Student Distribution by Gender</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="gender-pie" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>

        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
            <ul class="nav nav-tabs pull-right">
              <li class="pull-left header"><i class="fa fa-inbox"></i> Student Distribution by Class</li>
            </ul>
            <div class="tab-content no-padding">
              <!-- Morris chart - Sales -->
              <div class="chart tab-pane active" id="class-chart" style="position: relative; height: 300px;"></div>
            </div>
          </div>
          <!-- /.nav-tabs-custom -->
        </section>
        <!-- right col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <script src="<?php echo base_url('assets/lib/morris.js-0.4.3/raphael-min.js') ?>"></script>
  <script src="<?php echo base_url('assets/lib/morris.js-0.4.3/morris.min.js') ?>"></script>
 <?php include "template/footer.php" ?>
 <script>
      function addMoreEvent() {
      loadDepartmentChart();
      loadGenderChart();
   }
   function loadDepartmentChart() {
    var val = JSON.parse('<?php echo json_encode($classDistribution); ?>');
    Morris.Bar({
      element: 'class-chart',
      data:val ,
      xkey: 'class_name',
      ykeys: ['total'],
      barColors: ["#dd4b39"],
      labels: ['Y', 'Z', 'A']
    });
   }   function loadGenderChart() {
    var val = JSON.parse('<?php echo json_encode($genderDistribution); ?>');
    Morris.Donut({
      element: 'gender-pie',
      data:val,
      xkey: 'gender',
      ykeys: ['total'],
      labels: ['Y', 'Z', 'A']
    });
   }
 </script>
