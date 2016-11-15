<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view($header); ?>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
    		<a href="<?php echo base_url(); ?>" target="_blank" class="logo" title="visit homepage">
    			<!-- mini logo for sidebar mini 50x50 pixels -->
    			<span class="logo-mini"><i class="icon fa fa-home"></i></span>
    			<!-- logo for regular state and mobile devices -->
    			<span class="logo-lg">Visit homepage</span>
    		</a>
    		<!-- Header Navbar: style can be found in header.less -->
    		<nav class="navbar navbar-static-top">
    			<!-- Sidebar toggle button-->
		     	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
		      	</a>
                <!--a href="<?php //echo base_url(); ?>admin/home" class="navbar-brand">
                    Sipag CMS
                </a-->
		      	<div class="navbar-custom-menu">
        			<ul class="nav navbar-nav">
        				<li class="dropdown user user-menu">
        					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php foreach ($admin->result() as $row): ?>
                                    <?php if(!empty($row->image)):?>
                                        <img src="<?php echo base_url(); ?><?php echo $row->image; ?>" class="user-image" alt="User Image">
                                        <span class="hidden-xs">
                                            <small>Welcome, </small>
                                            <?php echo $row->username; ?>
                                        </span>
                                    <?php else: ?>
                                        <img src="<?php echo base_url();?>assets/dist/img/avatar2.png" class="user-image" alt="User Image">
                                        <span class="hidden-xs">
                                            <small>Welcome, </small>
                                            <?php echo $row->username; ?>
                                        </span>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </a>
        					<ul class="dropdown-menu">
        						<!-- User image -->
              					<li class="user-header">
                                    <?php foreach ($admin->result() as $row): ?>
                                        <?php if(!empty($row->image)):?>
                                            <img src="<?php echo base_url(); ?><?php echo $row->image; ?>" class="img-circle" alt="User Image">
        	                				<p><?php echo $row->username; ?></p>
                                        <?php else: ?>
                                            <img src="<?php echo base_url();?>assets/dist/img/avatar2.png" class="img-circle" alt="User Image">
                                            <p><?php echo $row->username; ?></p>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
              					</li>
              					<li class="user-footer">
                					<div class="pull-left">
                  						<a href="<?php echo base_url(); ?>admin/user" class="btn btn-default btn-flat">Users</a>
                					</div>
                					<div class="pull-right">
                  						<a href="<?php echo base_url(); ?>admin/home/logout" class="btn btn-default btn-flat">Sign out</a>
                					</div>
              					</li>
        					</ul>
        				</li>
        			</ul>
        		</div>
    		</nav>
		</header>

		<!-- Left side column. contains the sidebar -->
  		<aside class="main-sidebar">
    		<!-- sidebar: style can be found in sidebar.less -->
    		<?php $this->load->view($menu); ?>
      	</aside>

      	<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">
    		<!-- Content Header (Page header) -->
    		<section class="content-header">
      			<h1>
        			<?php echo $sub_title; ?>
                    <?php if((!empty($sub_title2)) && (empty($sub_title3))): ?>
            			<small>
                            <i class="icon fa fa-angle-right"></i> 
                            <?php echo $sub_title2; ?>
                        </small>
                    <?php elseif((!empty($sub_title2)) && (!empty($sub_title3))): ?>
                        <small>
                            <i class="icon fa fa-angle-right"></i> 
                            <?php echo $sub_title2; ?>
                            <i class="icon fa fa-angle-right"></i> 
                            <?php echo $sub_title3; ?>
                        </small>
                    <?php else: ?>

                    <?php endif; ?>
      			</h1>
      			<ol class="breadcrumb">
			        <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo $title; ?></a></li>
			        <?php if((!empty($sub_title2)) && (empty($sub_title3))): ?>
                        <li><?php echo $sub_title; ?></li>
                        <li class="active"><?php echo $sub_title2; ?></li>
                    <?php elseif((!empty($sub_title2)) && (!empty($sub_title3))): ?>
                        <li><?php echo $sub_title; ?></li>
                        <li><?php echo $sub_title2; ?></li>
                        <li class="active"><?php echo $sub_title3; ?></li>
                    <?php else: ?>
                        <li class="active"><?php echo $sub_title; ?></li>
                    <?php endif; ?>
      			</ol>
    		</section>

    		<!-- Main content -->
    		<section class="content">
                <!-- PAGE CONTENT BEGINS -->
    			<?php $this->load->view($content); ?>
                <!-- PAGE CONTENT ENDS -->
    		</section>
    	</div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                Admin Template by <a href="http://almsaeedstudio.com">Admin<b>LTE</b></a> Version <b>2.3.7</b>
            </div>
            <strong>Copyright &copy; 2016 Sipag CMS.</strong> 
            All rights reserved.
        </footer>

	</div>
    <script>
        AdminLTEOptions = {
            enableBSToppltip: false
        };
    </script>
    <script src="<?php echo base_url();?>assets/dist/js/app.js"></script>
</body>
</html>