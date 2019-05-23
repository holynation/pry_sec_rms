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

    <div class="row">
    <div class=" col-md-8 col-md-offset-2">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3>update school information</h3>
        </div>

      <?php 
        loadClass($this->load,'school');
        $school= $this->school->all();
        if ($school) {
          echo $this->modelFormBuilder->start('school_table')
          ->appendUpdateForm('school',true,$school[0]->ID)
          ->addSubmitLink(null,false)
          ->appendSubmitButton("Update",'btn btn-success')
          ->build();
        }
        else{
          echo $this->modelFormBuilder->start('school_table')
          ->appendInsertForm('school')
          ->addSubmitLink()
          ->appendSubmitButton("Save",'btn btn-success')
          ->build();
        }
       ?>
        </div>
    </div>
  </div>
</div>
 <?php include "template/footer.php" ?>
 