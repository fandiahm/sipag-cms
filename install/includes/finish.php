<?php

$root = "http://".$_SERVER['HTTP_HOST'];
$folder_name = explode('/', $_SERVER['REQUEST_URI'])[1];

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
  	<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
  	<!-- Font Awesome -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  	<!-- Ionicons -->
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  	<!-- Theme style -->
  	<link rel="stylesheet" href="../../assets/dist/css/AdminLTE.min.css">
  	<!-- Plugin -->
  	<link rel="stylesheet" href="../../assets/plugins/pnotify/pnotify.custom.min.css" />

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
				Welcome to Sipag CMS
  			</h4>
  			<div class="alert alert-success">
  				<p>Installation success. Delete install folder from <code>/your-project-directory/</code> and then try following these link:</p>
  			</div>
	    	<p><a href="<?php echo $root; ?>/<?php echo $folder_name; ?>" target="_blank">Go to home page</a> or 
	    	<a href="<?php echo $root; ?>/<?php echo $folder_name; ?>/admin/home/logout" target="_blank">Go to admin page</a></p>
  		</div>
  	<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 2.2.3 -->
	<script src="../../assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>