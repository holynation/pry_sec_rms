<?php 
$userType=$this->webSessionManager->getCurrentUserProp('user_type');
if ($userType=='lecturer') {
  include_once "template/sidebar_lecturer.php";
}
 ?>
 <?php if ($userType=='admin'): ?>
     <aside class="main-sidebar">
       <!-- sidebar: style can be found in sidebar.less -->
       <section class="sidebar">
         <!-- Sidebar user panel -->
         <div class="user-panel">
          <?php
              loadClass($this->load,'admin');
              $this->admin->ID = $this->webSessionManager->getCurrentUserProp('user_table_id');
              $this->admin->load();
              $path = @$admin->img_path;
            ?>
           <div class="pull-left image">
             <img src="<?php echo base_url($path); ?>" class="img-circle" alt="user" style="widht:60px;height:50px;">
           </div>
           <div class="pull-left info" style="margin-left: -12px;">
             <p><?php echo $this->webSessionManager->getUserDisplayName(); ?></p>
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
           </div>
         </div>
         <!-- sidebar menu: : style can be found in sidebar.less -->
         <ul class="sidebar-menu" data-widget="tree">
           <li class="header">MAIN NAVIGATION</li>

             <?php 
              if(isset($canView)):
                  foreach(@$canView as $key => $value): ?>
               <?php 
                   $state='';
                    if ($canView[$key]['state']===0) {
                     continue;
                   }
                ?>
               <li class="treeview">
                 <a href="#">
                   <i class="fa <?php echo $value['class']; ?>"></i>
                   <span><?php echo $key; ?></span>
                   <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                   </span>
                 </a>
                 <ul class="treeview-menu">
                   <?php foreach ($value['children'] as $label =>$link): ?>
                     <li><a href="<?php echo base_url($link); ?>"><i class="fa fa-circle-o"></i> <?php echo $label; ?></a></li>
                   <?php endforeach; ?>
                   <?php if ($key=='Dashboard'): ?>
                     <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-circle-o"></i> Logout</a></li>
                   <?php endif; ?>
                 </ul>
               </li>
             <?php endforeach; endif; ?>
         </ul>
       </section>
       <!-- /.sidebar -->
     </aside>
 <?php endif; ?>
  