            <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

            <section class="sidebar">
      			<!-- Sidebar user panel -->
      			<ul class="sidebar-menu">
      				<li class="header">MAIN NAVIGATION</li>
      				<li>
          				<a href="<?php echo base_url(); ?>admin">
            				<i class="fa fa-dashboard"></i> <span>Dashboard</span>
          				</a>
        			</li>
        			<li class="treeview">
          				<a href="#">
				            <i class="fa fa-pencil-square-o"></i>
				            <span>Menu</span>
				            <span class="pull-right-container">
              					<i class="fa fa-angle-left pull-right"></i>
            				</span>
          				</a>
          				<ul class="treeview-menu">
				            <li><a href="<?php echo base_url(); ?>admin/section"><i class="fa fa-circle-o"></i> Section</a></li>
				            <li><a href="<?php echo base_url(); ?>admin/content"><i class="fa fa-circle-o"></i> Content</a></li>
				            <li><a href="<?php echo base_url(); ?>admin/banner"><i class="fa fa-circle-o"></i> Banner</a></li>
				            <li><a href="<?php echo base_url(); ?>admin/menu"><i class="fa fa-circle-o"></i> Menu Link</a></li>
                            <li><a href="<?php echo base_url(); ?>admin/contact"><i class="fa fa-circle-o"></i> Contact & Footer</a></li>
                       </ul>
        			</li>
        			<li>
          				<a href="<?php echo base_url(); ?>admin/messages">
            				<i class="fa fa-envelope"></i> <span>Messages</span>
          				</a>
        			</li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/setting">
                            <i class="fa fa-cog"></i> <span>Setting</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url(); ?>admin/theme">
                            <i class="fa fa-eyedropper"></i> <span>Theme</span>
                        </a>
                    </li>
      			</ul>
      		</section>