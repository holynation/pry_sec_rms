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
            <h3>Signature View</h3>
        </div>

      <?php 
        $signature= $this->signature->all();
        if ($signature) {
          echo $this->modelFormBuilder->start('signature_table')
          ->appendUpdateForm('signature',true,$signature[0]->ID)
          ->addSubmitLink(null,false)
          ->appendSubmitButton("Update",'btn btn-success')
          ->build();
        }
        else{
          echo $this->modelFormBuilder->start('signature_table')
          ->appendInsertForm('signature')
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
 