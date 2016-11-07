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
				Reset password form
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
  				<div class="alert alert-danger alert-dismissible" role="alert">
				    <button type="button" class="close" data-dismiss="alert">
				        <i class="icon fa fa-times"></i>
				    </button>   
				    <?php echo $msg; ?>
				</div>
  			<?php endif; ?>
	    	<form id="validation-form" method="post" action="<?php echo base_url(); ?>admin/reset_password/user/<?php echo $id; ?>" />
	      		<div class="form-group">
	      			<label>Username</label>
	      			<input type="text" value="<?php echo $username; ?>" name="username" id="username" class="form-control" readonly="readonly">
	      		</div>
	      		<div class="form-group">
	      			<label>New password</label>
	      			<input type="password" name="newpassword" id="newpassword" class="form-control" maxlength="32" placeholder="Your new password" autofocus/>
	      		</div>
	      		<div class="form-group">
	      			<label>Re-type password</label>
	      			<input type="password" name="repassword" id="repassword" class="form-control" maxlength="32" placeholder="Re-type your new password" />
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
	<script src="<?php echo base_url();?>assets/plugins/validate/jquery.validate.min.js"></script>

	<script type="text/javascript">
		jQuery(function($) {
			/*  validation form*/
			$('#validation-form').validate({
				errorElement: 'div',
				errorClass: 'help-block',
				focusInvalid: true,
				ignore: "",
				rules: {
					newpassword: {
						required: true,
						minlength: 5
					},
					repassword: {
						required: true,
						minlength: 5,
						equalTo: "#newpassword"
					}
				},
				messages: {
					newpassword: {
						required: "New password is required.",
						minlength: "New password is too short."
					},
					repassword: {
						required: "Please confirm new password.",
						minlength: "Password not match."
					}
				},
				highlight: function (e) {
					$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
				},
				success: function (e) {
					$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
					$(e).remove();
				},
				errorPlacement: function (error, element) {
					if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
						var controls = element.closest('div[class*="col-"]');
						if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
						else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
					}
					else error.insertAfter(element.parent());
				},
				//submitHandler: function (form) {},
				invalidHandler: function (form) {
				}
			});
		})
	</script>

</body>
</html>
