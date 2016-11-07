<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Sipag CMS | Reset Password</title>
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
  	<!-- Plugin -->
  	<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/pnotify/pnotify.custom.min.css" />

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
  				<i class="fa fa-key"></i> 
				Reset password
  			</h4>
	    	<hr>
	    	<?php if(validation_errors() OR isset($error)): ?>
				<div class="alert alert-danger alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert">
				        <i class="icon fa fa-times"></i>
				    </button>   
				    <?php echo validation_errors(); ?>
				    <?php isset($error)?$error:''; ?> 
				</div>
			<?php endif; ?>
			<?php $msg = $this->session->flashdata('error'); ?>
  			<?php if(!empty($msg)): ?>
  				<div class="alert alert-error alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert">
				        <i class="icon fa fa-times"></i>
				    </button>   
				    <?php echo $msg; ?>
				</div>
  			<?php endif; ?>
	    	<form method="post" action="<?php echo base_url(); ?>admin/reset_password/send_link" />
	      		<div class="form-group has-feedback">
			        <input type="text" name="email" class="form-control" placeholder="Email address" required autofocus>
			        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      		</div>
	      		<div class="row">
	        		<!-- /.col -->
	        		<div class="col-xs-8"></div>
	        		<div class="col-xs-4">
	          			<button type="submit" id="btnSend" class="btn btn-primary btn-block btn-flat pull-right">Confirm</button>
	        		</div>
	        		<!-- /.col -->
	      		</div>
	    	</form>
  		</div>
  	<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Plugin -->
	<script src="<?php echo base_url();?>assets/plugins/pnotify/pnotify.custom.min.js"></script>
	
	<script>
		PNotify.prototype.options.styling = "bootstrap3";
		$(document).on('ready', function(){
			if(navigator.onLine){
				console.log('Connection is success!');
			} else {
				$('#btnSend').attr('disabled',true);
				new PNotify({
					title: 'No internet connection!',
					text: 'Reset password link will send through your email address. Please check your connection and try reloading this page.',
					type: 'error'
				});
			}
		});
	</script>

</body>
</html>
