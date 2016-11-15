<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en"> <!--<![endif]-->
<head>

    <!-- Meta-Information -->
    <title><?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="keyword" content="<?php echo $meta_keyword; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Vendor: Bootstrap Stylesheets http://getbootstrap.com -->
    <link rel="stylesheet" href="<?php echo base_url();?><?php echo $theme; ?>">
    <!-- Font -->
    <link href="<?php echo base_url();?>assets/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Plugins css -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/animate.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/owl-carousel/owl.theme.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/frontend/owl-carousel/owl.transitions.css">
    <!-- Our Website CSS Styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/sipag-styles.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/frontend/css/styles.css">

    <script src="<?php echo base_url();?>assets/frontend/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/frontend/js/jquery.validate.min.js"></script>

</head>
<body>
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Our Website Content Goes Here -->
<?php $this->load->view($header);?>
<?php $this->load->view($banner);?>
<?php $this->load->view($layout);?>
<?php $this->load->view($footer);?>

<!-- Vendor: Javascripts -->

<script src="<?php echo base_url();?>assets/frontend/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/scrollIt.min.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/scrollspy.js"></script>
<script src="<?php echo base_url();?>assets/frontend/js/WOW.min.js"></script>

<!-- Our Website Javascripts -->
<script src="<?php echo base_url();?>assets/frontend/js/scripts.js"></script>

</body>
</html>
