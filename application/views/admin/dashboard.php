<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
		x
	</button>

	<i class="icon fa fa-check"></i>

	Welcome to admin page,
	<strong>
		Sipag CMS 
		<small>(v1.0.0)</small>
	</strong>
	, use the menu features to access content.
</div>

<div class="row">
	<div class="col-sm-3 col-xs-6">
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3><?php echo $total_section; ?></h3>
				<p>Section</p>
			</div>
			<a href="<?php echo base_url(); ?>admin/section" class="small-box-footer">
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-sm-3 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h3><?php echo $total_content; ?></h3>
				<p>Content</p>
			</div>
			<a href="<?php echo base_url(); ?>admin/content" class="small-box-footer">
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-sm-3 col-xs-6">
		<div class="small-box bg-yellow">
			<div class="inner">
				<h3><?php echo $total_theme; ?></h3>
				<p>Theme</p>
			</div>
			<a href="<?php echo base_url(); ?>admin/theme" class="small-box-footer">
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
	<div class="col-sm-3 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h3><?php echo $total_unread; ?></h3>
				<p>Unread messages</p>
			</div>
			<a href="<?php echo base_url(); ?>admin/messages" class="small-box-footer">
				<i class="fa fa-arrow-circle-right"></i>
			</a>
		</div>
	</div>
</div>