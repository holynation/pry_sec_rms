<?php 
include "template/header.php";
include "template/sidebar.php";
//sectiofn for the form parameter
$exclude = ($configData && array_key_exists('exclude', $configData))?$configData['exclude']:array();
$has_upload = ($configData && array_key_exists('has_upload', $configData))?$configData['has_upload']:array();
$hidden = ($configData && array_key_exists('hidden', $configData))?$configData['hidden']:array();
$showStatus = ($configData && array_key_exists('show_status', $configData))?$configData['show_status']:false;
$submitLabel = ($configData && array_key_exists('submit_label', $configData))?$configData['submit_label']:"Save";
$tableAction = ($configData && array_key_exists('table_action', $configData))?$configData['table_action']:$model::$tableAction;
$tableExclude = ($configData && array_key_exists('table_exclude', $configData))?$configData['table_exclude']:array();
$query = ($configData && array_key_exists('query', $configData))?$configData['query']:array();
$tableTitle = ($configData && array_key_exists('table_title', $configData))?$configData['table_title']:"Table of ".removeUnderscore($model);
$icon = ($configData && array_key_exists('table_icon', $configData))?$configData['table_icon']:"";
$search = ($configData && array_key_exists('search', $configData))?$configData['search']:"";
$filter = ($configData && array_key_exists('filter', $configData))?$configData['filter']:"";
$where ='';
if ($filter) {
  foreach ($filter as $item) {
    $display = (isset($item['filter_display'])&&$item['filter_display'])?$item['filter_display']:$item['filter_label'];

    if (isset($_GET[$display]) && $_GET[$display]) {
      $value = $this->db->conn_id->escape_string($_GET[$display]);
      $where.= $where?" and {$item['filter_label']}='$value' ":"where {$item['filter_label']}='$value' ";
    }
  }
}

if ($search) {
 $val = isset($_GET['q'])?$_GET['q']:'';
 $val = $this->db->conn_id->escape_string($val);
 if (isset($_GET['q']) && $_GET['q']) {
   $temp=$where?" and (":" where (";
   $count =0;
     foreach ($search as $criteria) {
       $temp.=$count==0?" $criteria like '%$val%'":" or $criteria like '%$val%' ";
       $count++;
     }
     $temp.=')';
     $where.=$temp;
 }
}
  if (isset($_GET['export'])) {
    $this->queryHtmlTableModel->export=true;
    $this->tableViewModel->export=true;
   }
$tableData='';

$where .= ' order by ID desc ';
   if ($query) {
     $query.=' '.$where;
     $tableData= $this->queryHtmlTableModel->getHtmlTableWithQuery($query,array(),$count,$tableAction);
   }
   else{
     $tableData= $this->tableViewModel->getTableHtml($model,$count,$tableExclude,$tableAction,true,0,null,true,$where);
   }
 ?>

 <!-- the breadcrump for pages that needed it -->
 <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Administrative
    <small><?php echo removeUnderscore($model); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo removeUnderscore($model); ?></li>
  </ol>
</section>

<!-- the content page -->
 <!-- Main content -->
  <div>
    <?php 
        $formContent= $this->modelFormBuilder->start($model.'_table')
        ->appendInsertForm($model,true,$hidden,'',$showStatus,$exclude)
        ->addSubmitLink()
        ->appendResetButton('Reset','btn-danger')
        ->appendSubmitButton($submitLabel,'btn btn-success')
        ->build();
    ?>
  </div>

  <section class="content">
      <!-- Main row -->
      <!-- /.row (main row) -->
    <div class="row">
      <section class="col-lg-12 connectedSortable">
        <div class="modal fade" id="modal-add">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo removeUnderscore($model);  ?> Entry Form</h4>
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
        <!-- /.modal -->

        <?php if ($configData==false || array_key_exists('has_upload', $configData)==false || $configData['has_upload']): ?>
          <div class="modal modal-default fade" id="modal-upload">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><?php echo removeUnderscore($model); ?> Batch Upload</h4>
                </div>
                <div class="modal-body">
                  <p>
                  <div >
                    <a  class='btn btn-warning' href="<?=base_url("mc/template/$model?exc=name");?>">Download Template</a>
                  </div>
                  <h3>Upload <?php echo removeUnderscore($model); ?></h3>
                  <form method="post" action="<?php echo base_url('mc/sFile/'.$model); ?>" enctype="multipart/form-data">
                  <div class="form-group">
                    <input type="file" name="bulk-upload" class="form-control">
                    <input type="hidden" name="MAX_FILE_SIZE" value="200000">
                  </div>
                   <div class="form-group">
                      <input type="submit" class='btn btn-success' name="submit" value="Upload">
                    </div>
                    
                  </form>
                  </p>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          <!-- /.modal-dialog -->
          </div>
            <!-- /.modal -->
        <?php endif; ?>
     
        <div class="top-action pull-right">
          <span class="main-menu-item btn btn-primary" style="color: #fff;" data-toggle='modal' data-target='#modal-add'>Add</span>
          <?php if ($configData==false || array_key_exists('has_upload', $configData)==false || $configData['has_upload']): ?>|<span class="main-menu-item btn btn-primary" style="color: #fff;" data-toggle='modal' data-target='#modal-upload'>Batch Upload</span>
          <?php endif; ?>
        </div>

        <div class="clearfix"></div>

        <div style="border-bottom: solid 2px #ccc;"></div>
        <div class="content-area">
          <div class="">
            <div class="filter-section">
              <?php 
                $where='';
               ?>
              <form action="" class="filter_form">
                  <div class="form-control2">

                <?php if ($filter): ?>
                  <?php foreach ($filter as $item): ?>
                     <?php 
                      $display = (isset($item['filter_display'])&&$item['filter_display'])?$item['filter_display']:$item['filter_label'];
                     ?>
                   <?php 
                      if (isset($_GET[$display]) && $_GET[$display]) {
                        $value = $this->db->conn_id->escape_string($_GET[$display]);
                        $where.= $where?" and {$item['filter_label']}='$value' ":"where {$item['filter_label']}='$value' ";
                      }
                    ?>
                      <select class="form-control1 <?php echo isset($item['child'])?'autoload':'' ?>" name="<?php echo $display; ?>" id="<?php echo $display; ?>"  <?php echo isset($item['child'])?"data-child='{$item['child']}'":""?> <?php echo isset($item['load'])?"data-load='{$item['load']}'":""?> >
                      <option value="">..select <?php echo removeUnderscore(rtrim($display,'_id')) ?>...</option>
                      <?php if (isset($item['preload_query'])&& $item['preload_query']): ?>
                        <?php echo buildOptionFromQuery($this->db,$item['preload_query'],null,isset($_GET[$display])?$_GET[$display]:''); ?>
                      <?php endif; ?>
                    </select>
                  <?php endforeach; ?>
                <?php endif; ?>

              <?php if ($search): ?>
                <?php 
                  $placeholder=" search by : ".implode(',', $search);
                  $val = isset($_GET['q'])?$_GET['q']:'';
                  $val = $this->db->conn_id->escape_string($val);
                 ?>
                <input class="form-control1" type="text" name="q" placeholder="<?php echo $placeholder; ?>" value="<?php echo $val; ?>" style="width:30%;">
               
              <?php endif; ?>
              
              <?php if ($search || $filter): ?>
                   <input type="submit" value="Filter" class="btn btn-success">
                <?php endif; ?>
                  </div>
              </form>
              <div style="margin-top: 15px;" class="alert alert-info">Load the data to export with the necessary parameter before clicking export button</div>
              <?php 
                $queryString= $_SERVER['QUERY_STRING'];
               ?>
            <?php if ($configData==false || array_key_exists('has_export', $configData)==false || $configData['has_export']): ?>
             <a target="_blank" href="<?php echo $queryString?('?'.$queryString.'&export=yes'):'?export=yes' ?>" style="margin-top: 15px;" class="btn btn-primary pull-right" id="export-btn">Export Data</a>
            <?php endif; ?>
             <div class="clear"></div>
             <br>
            </div>
            <h3><?php echo $tableTitle; ?></h3>
            <?php echo $tableData;?>
          </div>
        </div>
      </section>
    </div>
  </section>
    <!-- /.content -->
</div>
  <script>
    var inserted=false;
    $(document).ready(function($) {
      $('.modal').on('hidden.bs.modal', function (e) {
        if (inserted) {
          inserted = false;
          location.reload();
        }
    });
    $('.close').click(function(event) {
      if (inserted) {
        inserted = false;
        location.reload();
      }
    });
      $('li[data-ajax-edit=1] a').click(function(event){
        event.preventDefault();
        var link = $(this).attr('href');
        var action = $(this).text();
        sendAjax(null,link,'','get',showUpdateForm);
      });
    });
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
      if (data.status) {
        inserted=true;
      }
      showNotification(data.status,data.message);
      if (typeof target ==='undefined') {
        location.reload();
      }
    }
  </script>
 <?php include "template/footer.php" ?>


