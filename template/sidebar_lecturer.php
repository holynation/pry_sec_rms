  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              <?php $sn=$this->webSessionManager->getCurrentUserProp('surname');
                   $fn=$this->webSessionManager->getCurrentUserProp('firstname');
                   $mn=$this->webSessionManager->getCurrentUserProp('middlename');
              echo $sn[0].'.'.$fn[0].'.'.$mn[0] ?> </p>

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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="<?php echo base_url('vc/lecturer/dashboard'); ?>"><i class="fa fa-circle-o"></i> Home</a></li>
            <li class="active"><a href="<?php echo base_url('vc/lecturer/profile'); ?>"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-circle-o"></i> Logout</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Courses Taught</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('vc/lecturer/course_history'); ?>"><i class="fa fa-circle-o"></i> My Courses</a></li>
            <li><a href="<?php echo base_url('vc/lecturer/project'); ?>"><i class="fa fa-circle-o"></i> My Project Students</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Results</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('vc/lecturer/upload_result') ?>"><i class="fa fa-circle-o"></i> Upload Result</a></li>
            <li><a href="<?php echo base_url('vc/lecturer/view_result') ?>"><i class="fa fa-circle-o"></i> View Result</a></li>

            <li><a href="<?php echo base_url('vc/lecturer/result_history'); ?>"><i class="fa fa-circle-o"></i> My Upload History</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Support</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('vc/lecturer/response_complaint'); ?>"><i class="fa fa-circle-o"></i> Complaint</a></li>
          </ul>
        </li>

        <?php if (@$lecturer->role_id): ?>
          <?php foreach ($canView as $key => $value): ?>
            <?php 
            if ($key=='Dashboard') {
              continue;
            }
                $state='';
                 if ($canView[$key]['state']===0) {
                  continue;
                }
             ?>
            <li class="treeview">
              <a href="#">
                <i class="fa <?php echo $value['class'] ?>"></i>
                <span><?php echo $key ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php foreach ($value['children'] as $label =>$link): ?>
                  <li><a href="<?php echo base_url($link); ?>"><i class="fa fa-circle-o"></i> <?php echo $label ?></a></li>
                <?php endforeach ?>
                <?php if ($key=='Dashboard'): ?>
                  <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-circle-o"></i> Logout</a></li>
                <?php endif ?>
              </ul>
            </li>
          <?php endforeach ?>
        <?php endif ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>