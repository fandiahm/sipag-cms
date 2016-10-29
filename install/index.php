<?php

error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) 
		{
			$message = $core->show_message('error',"The database could not be created, please verify your settings.");
		} 
		else if ($database->create_tables($_POST) == false) 
		{
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} 
		else if ($core->write_config($_POST) == false) 
		{
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod application/config/database.php file to 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) 
		{
		 	$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
      		$redir .= "://".$_SERVER['HTTP_HOST'];
      		$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
      		$redir = str_replace('install/','',$redir); 
			header( 'Location:includes/finish.php' );
		}

	}
	else 
	{
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, password, and database name are required.');
	}
}

?>

<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<title>Sipag CMS | Install</title>
  	<!-- Tell the browser to be responsive to screen width -->
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  	<!-- Bootstrap 3.3.6 -->
  	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  	<!-- Plugin -->
  	<link rel="stylesheet" href="../assets/plugins/pnotify/pnotify.custom.min.css" />

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
				Database configuration
  			</h4>
	    	<?php if(is_writable($db_config_path)): ?>
		    	<form method="post" id="form" action="#" />
		      		<div class="form-group has-feedback">
		      			<input type="text" name="test_hostname" class="form-control" id="hostname" placeholder="Hostname (e.g. localhost)" required autofocus>
				        <span class="glyphicon glyphicon-home form-control-feedback"></span>
				        <span class="help-block"></span>
		      		</div>
		      		<div class="form-group has-feedback">
		      			<input type="text" name="test_username" class="form-control" id="username" placeholder="Username" required>
				        <span class="glyphicon glyphicon-user form-control-feedback"></span>
				        <span class="help-block"></span>
		      		</div>
		      		<div class="form-group has-feedback">
		        		<input type="password" name="test_password" class="form-control" id="password" placeholder="Password (optional)">
		        		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
		        		<span class="help-block"></span>
		      		</div>
		      		<div class="form-group has-feedback">
		      			<input type="text" name="test_database" class="form-control" id="database" placeholder="Database name">
				        <span class="glyphicon glyphicon-tasks form-control-feedback"></span>
				        <span class="help-block"></span>
		      		</div>
		      		<?php if(isset($message)):?>
						<span class='text-red'><?php echo $message; ?></span>
					<?php endif; ?>
		      		<div class="row">
		        		<!-- /.col -->
		        		<div class="col-xs-6">
		        			<span class="loading-connection"></span>
		        		</div>
		        		<div class="col-xs-6">
		          			<a href="javascript:void(0)" onclick="test_connection()" class="btn btn-primary btn-block btn-flat pull-right">Test Connection</a>
		        		</div>
		        		<!-- /.col -->
		      		</div>
		      		<div class="alert alert-danger" id="error_msg"></div>
		      	</form>
		      	<hr>
		      	<div class="row">
		      		<div class="col-xs-12">
		      			<form method="post" id="form-hidden" action="<?php echo $_SERVER['PHP_SELF']; ?>" />
			  				<input type="hidden" name="hostname">
			  				<input type="hidden" name="username">
			  				<input type="hidden" name="password">
			      			<input type="hidden" name="database">
			      			<button type="submit" class="btn-submit btn btn-info btn-block btn-flat pull-right">Set up installation</button>
		      			</form>
		      		</div>
		      	</div>
		    <?php else: ?>
		    	<div class="alert alert-danger">
		    		<p>Please make the application/config/database.php file writable. 
		    		<strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
		    	</div>
		    <?php endif; ?>
  		</div>
  	<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- Plugin -->
	<script src="../assets/plugins/validate/jquery.validate.min.js"></script>
	<script src="../assets/plugins/pnotify/pnotify.custom.min.js"></script>

	<script>
		$(document).ready(function(){
			$('.btn-submit').hide();
			$('#error_msg').hide();
		});

		PNotify.prototype.options.styling = "bootstrap3";
	    PNotify.prototype.options.delay = 3000;

		function test_connection()
		{
			if ($("#form").valid())
			{ 
				$('.loading-connection').html('<span class="overlay"><h4 class="text-center"><i class="fa-spin icon fa fa-spinner text-orange"></i></h4></span>');
				var url = 'includes/test_connection.php';
				var formData = new FormData($('#form')[0]);
		        $.ajax({
		            url : url,
		            type: "POST",
		            data: formData,
		            contentType: false,
		            processData: false,
		            dataType: "JSON",
		            success: function(data)
		            {
		            	if(data)
		            	{
		            		$('#error_msg').hide();
		            		$('.loading-connection').find('.overlay').remove();
		            		$('.loading-connection').html('<h4 class="text-center"><i  class="icon fa fa-check text-green"></i></h4>');
		            		new PNotify({
								title: 'Success',
								text: 'Connect to database is success.',
								type: 'success'
							});
							$('.btn-submit').show();
		            		//console.log(data.responseText);
		            	}
		            },
		            error: function(data, jqXHR, textStatus, errorThrown)
		            {	
		            	$('.btn-submit').hide();
		            	$('#error_msg').show();
		            	$('.loading-connection').find('.overlay').remove();
		            	$('.loading-connection').html('<h4 class="text-center"><i  class="icon fa fa-times text-red"></i></h4>');
		            	$('#error_msg').html(data.responseText);
		            	new PNotify({
							title: 'Error!',
							text: 'Connect to database has failed. Please check your data and try again.',
							type: 'error'
						});
		            	//console.log(data.responseText);
		            }
		        });
			}
		}

		jQuery(function($) {
	    	$('#form').validate({
	    		errorElement: 'div',
	            errorClass: 'help-block',
	            focusInvalid: true,
	            ignore: "",
	            rules: {
	                test_hostname: {
	                    required: true
	                },
	                test_username: {
	                    required: true
	                },
	                test_database: {
	                    required: true
	                }
	            },
	            messages: {
	                test_hostname: {
	                    required: "This field is required."
	                },
	                test_username: {
	                    required: "This field is required."
	                },
	                test_database: {
	                    required: "This field is required."
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
	                if(element.is('.chosen-select')) {
	                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
	                }
	                else error.insertAfter(element.siblings('[class*="help-block"]:eq(0)'));
	            },
	            
	            //submitHandler: function (form) {},
	            invalidHandler: function (form, validator) {

	            }
	        });

			$('input[name=test_hostname]').keyup(function() {
		    	$('input[name=hostname]').val($(this).val()); // set value
			});
			$('input[name=test_username]').keyup(function() {
		    	$('input[name=username]').val($(this).val()); // set value
			});
			$('input[name=test_password]').keyup(function() {
		    	$('input[name=password]').val($(this).val()); // set value
			});
			$('input[name=test_database]').keyup(function() {
		    	$('input[name=database]').val($(this).val()); // set value
			});
		})
	</script>

</body>
</html>