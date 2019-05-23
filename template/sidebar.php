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
           <div class="pull-left image">
             <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="user">
           </div>
           <div class="pull-left info">
             <p><?php echo $this->webSessionManager->getUserDisplayName(); ?></p>
             <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
           </div>
         </div>
         <!-- search form -->
   <!--      <form action="#" method="get" class="sidebar-form">-->
   <!--        <div class="input-group">-->
   <!--          <input type="text" name="q" class="form-control" placeholder="Search...">-->
   <!--          <span class="input-group-btn">-->
   <!--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>-->
   <!--                </button>-->
   <!--              </span>-->
   <!--        </div>-->
   <!--      </form>-->
         <!-- /.search form -->
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
  