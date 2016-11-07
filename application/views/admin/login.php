<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Sipag CMS | Log in</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.6 -->
  	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  	<!--[if lt IE 9]>
  	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  	<![endif]-->
</head>
<body class="hold-transition login-page">
	<div class="login-box">
 		<div class="login-logo">
    		<a href="#"><b>Sipag</b> CMS</a>
  		</div>
  		<!-- /.login-logo -->
  		<div class="login-box-body">
  			<h4 class="login-box-message text-center">
  				<i class="fa fa-coffee green"></i> 
				Please enter your information
  			</h4>
	    	<hr>
	    	<?php $msg = $this->session->flashdata('messages'); ?>
  			<?php if(!empty($msg)): ?>
  				<div class="alert alert-success alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert">
				        <i class="icon fa fa-times"></i>
				    </button>   
				    <?php echo $msg; ?>
				</div>
  			<?php endif; ?>
	    	<?php $info = $this->session->flashdata('info'); ?>
			<?php if(!empty($info)): ?>
			   	<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert">
					    <i class="icon fa fa-times"></i>
					</button> 
					<?php echo $info; ?>
				</div>
			<?php endif; ?>
	    	<form method="post" action="<?php echo base_url(); ?>admin/auth/check_login" />
	      		<div class="form-group has-feedback">
			        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      		</div>
	      		<div class="form-group has-feedback">
	        		<input type="password" name="password" class="form-control" placeholder="Password" required>
	        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      		</div>
	      		<div class="row">
	        		<!-- /.col -->
	        		<div class="col-xs-8"></div>
	        		<div class="col-xs-4">
	          			<button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Sign In</button>
	        		</div>
	        		<!-- /.col -->
	      		</div>
	    	</form>
	    	<br>
	    	<span class="text">Forgot password? <a href="<?php echo base_url(); ?>admin/reset_password">Click here</a></span>
  		</div>
  	<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
