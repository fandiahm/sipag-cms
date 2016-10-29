<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if(validation_errors() OR isset($error)): ?>
	<div class="alert alert-danger alert-dismissible" role="alert" align="center">
		<button type="button" class="close" data-dismiss="alert">
			<i class="icon fa fa-times"></i>
		</button>
	    <?php echo validation_errors(); ?>
	    <?php isset($error)?$error:''; ?>
	</div>
<?php endif; ?>

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Update password</h3>
	</div>
	<form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/user/password/<?php echo $user->user_id; ?>">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="oldpassword">Old password</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="password" name="oldpassword" id="oldpassword" class="form-control" maxlength="32" placeholder="Your current password" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="newpassword">New password</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="password" name="newpassword" id="newpassword" class="form-control" maxlength="32" placeholder="Your new password" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="repassword">Confirm new password</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="password" name="repassword" id="repassword" class="form-control" maxlength="32" placeholder="Re-type your new password" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for=""></label>
				<div class="col-xs-12 col-sm-10">
					<div class="clearfix">
						<small class="text-orange">
							<i class="icon fa fa-exclamation-triangle"></i>
							<i>
								You will be directly logout after submitting form is success.
							</i>
						</small>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer box-grey text-center">
			<a href="<?php echo base_url();?>admin/user/user_edit/<?php echo $user->user_id; ?>" class="btn btn-default">Back</a>
			<button class="btn btn-info" type="submit">
				<i class="icon fa fa-check"></i>
				Submit
			</button>
		</div>
	</form>
</div>

<script type="text/javascript">
	jQuery(function($) {
		/*  validation form*/
		$('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			ignore: "",
			rules: {
				oldpassword: {
					required: true,
					minlength: 5
				},
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
				oldpassword: {
					required: "Old password is required.",
					minlength: "Password is too short."
				},
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
				else if(element.is('.select2')) {
					error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
				}
				else if(element.is('.chosen-select')) {
						error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
				}
				else error.insertAfter(element.parent());
			},
			//submitHandler: function (form) {},
			invalidHandler: function (form) {
			}
		});
	})
</script>