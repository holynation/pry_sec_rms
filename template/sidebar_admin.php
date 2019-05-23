  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?php echo $this->webSessionManager->getUserDisplayName() ?></p>
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
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href=""><i class="fa fa-circle-o"></i> Profile</a></li>
            <li class="active"><a href="javascript:void(0);" data-toggle="modal" data-target="#center_modal_<?php echo $this->webSessionManager->getCurrentUserProp('ID'); ?>"><i class="fa fa-circle-o"></i> Change password</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Logout</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Users</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Student</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Lecturer</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Admin</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Role</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog"></i>
            <span>School Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> School</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Department</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Faculty</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Program</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Level</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Semester</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Session</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Session Semester</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Entry Mode</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Study Mode</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Degree</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Program Degree</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> </a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Max Unit</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Department</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Faculty</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Program</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Student</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Courses</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Course</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Session Semester Course</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-setting"></i>
            <span>Result Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Class of degree</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Scale</a></li>
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
            <li><a href=""><i class="fa fa-circle-o"></i> Respond To Complaint</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> Student Complaint</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div id="center_modal_<?php echo $this->webSessionManager->getCurrentUserProp('ID'); ?>" class="modal fade animated position_modal" role="dialog">
      <div class="modal-dialog">
        <!-- <form action="" method="post"> -->
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Change Password</h4>
              </div>
              <div class="modal-body">
                  <form class="form-horizontal" id="form_change_password" name="form_change_password" action="<?php echo base_url('vc/changePassword/'.$this->webSessionManager->getCurrentUserProp('ID')); ?>">
                    <div id="data_notify"></div><br>
                    <div class="box-body">
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