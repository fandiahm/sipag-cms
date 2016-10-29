<?php defined('BASEPATH') OR exit('No direct script access allowed');

	if($this->input->post()){
	    $email 			= set_value('email');
	    $username       = set_value('username');
	    $name        	= set_value('name');
	    $level        	= set_value('level');
	    $status        	= set_value('status');
	    $image        	= set_value('image');
	} else {
	    $email        	= $user->email;
	    $username       = $user->username;
	    $name        	= $user->name;
	    $level        	= $user->level;
	    $status        	= $user->status;
	    $image        	= $user->image;
	}

?>

<?php if($this->session->flashdata('message')): ?>
	<div class="alert alert-success alert-dismissible" role="alert" align="center">
		<button type="button" class="close" data-dismiss="alert">		
			<i class="icon fa fa-times"></i>
		</button>
	   	<?php echo $this->session->flashdata('message'); ?>
	</div>
<?php endif; ?>
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
		<h3 class="box-title">User info</h3>
	</div>
	<form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/user/user_edit/<?php echo $user->user_id; ?>">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="email">Email</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="email" name="email" id="email" value="<?php echo $email; ?>" class="form-control" maxlength="50"/>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="username">Username</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="text" name="username" id="username" value="<?php echo $username; ?>" class="form-control limited" maxlength="20"/>
					</div>
				</div>
			</div>

			<?php if(($access == 0) OR ($access == 1 && $level == 2)): ?>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="level_display">Level</label>

					<div class="col-xs-12 col-sm-6">
						<div class="input-group">
							<input type="text" name="level_display" id="level_display" value="<?php if($level == 0){echo "Developer";} elseif ($level == 1){echo "Administrator";} else {echo "Author";} ?>" class="form-control col-xs-12 col-sm-6" disabled />
							<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="You cannot change this value." title="Why disabled?"><i class="icon fa fa-question-circle"></i></span>
						</div>
						<input type="hidden" name="level" id="level" value="<?php echo $level; ?>" class="col-xs-11 col-sm-6" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="status_display">Status</label>

					<div class="col-xs-12 col-sm-6">
						<div class="clearfix">
							<select class="form-control" id="status" name="status">
								<?php $selected = "selected"; ?>
								<option value="1" <?php if($status == 1){echo 'selected';} ?>>Active</option>
								<option value="2" <?php if($status == 2){echo 'selected';} ?>>Not active</option>
							</select>
						</div>
					</div>
				</div>
			<?php else: ?>
				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="level_display">Level</label>

					<div class="col-xs-12 col-sm-6">
						<div class="input-group">
							<input type="text" name="level_display" id="level_display" value="<?php if($level == 0){echo "Developer";} elseif($level == 1){echo "Administrator";} else {echo "Author";} ?>" class="form-control col-xs-12 col-sm-6" disabled />
							<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="You cannot change this value." title="Why disabled?"><i class="icon fa fa-question-circle"></i></span>
						</div>
						<input type="hidden" name="level" id="level" value="<?php echo $level; ?>" class="" />
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="status_display">Status</label>

					<div class="col-xs-12 col-sm-6">
						<div class="input-group">
							<input type="text" name="status_display" id="status_display" value="<?php if($status == 1){echo "Active";} else {echo "Not active";} ?>" class="form-control col-xs-12 col-sm-6" disabled />
							<span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Only administrator can change this value." title="Why disabled?"><i class="icon fa fa-question-circle"></i></span>
						</div>
						<input type="hidden" name="status" id="status" value="<?php echo $status; ?>" class="" />
					</div>
				</div>
			<?php endif; ?>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password">Password</label>
				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<a href="<?php echo base_url(); ?>admin/user/password/<?php echo $user->user_id; ?>" 
						class="btn btn-sm bg-orange btn-flat btn-round">
						<i class="icon fa fa-key middle"></i>
						Update password &nbsp;
						<span class="pull-right"> <i class="icon fa fa-arrow-right"></i></span>
						</a>
					</div>
				</div>
			</div>

			<hr>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">Full name</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="text" name="name" id="name" value="<?php echo $name; ?>" class="form-control limited" maxlength="25" placeholder="Full name" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="userfile">Picture</label>
				
				<?php if(empty($user->image)): ?>
					<div class="col-xs-12 col-sm-6">
						<div class="clearfix">
							<input type="file" name="userfile" id="id-input-file-3" class="" />
							<small><i>Max upload 100kb.</i></small>
						</div>
					</div>
				<?php else: ?>
					<div class="col-xs-12 col-sm-5">
						<div class="clearfix">
							<?php 
			               	echo img(['src'=>$user->image,'width'=>'100%']);
			                ?>
			                <label>
		                        <input type="checkbox" name="checked" value="checked">
		                        <span class="lbl">Remove this image</span>
		                    </label>
			            </div>
			        </div>
					<div class="col-xs-12 col-sm-5">
						<div class="clearfix">
							<input type="file" name="userfile" id="id-input-file-3" class="" />
							<small><i>Max upload 100kb.</i></small>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="box-footer box-grey text-center">
			<a href="<?php echo base_url(); ?>admin/user" class="btn btn-default">Back</a>
			<a href="#password_form" class="btn btn-info" data-toggle="modal">
				<i class="icon fa fa-check"></i>
				Update
			</a>
		</div>

		<div id="password_form" class="modal" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="blue bigger">Password confirm</h4>
					</div>

					<div class="modal-body">
						<div class="row">
							<div class="col-xs-12 col-sm-12">
								<div class="form-group">
									<label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email">Password</label>

									<div class="col-xs-12 col-sm-8">
										<div class="clearfix">
											<input type="password" id="form-field-password" name="password" placeholder="Enter your password here" class="form-control" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<div class="row">
							<div class="clearfix">
								<div class="col-md-offset-9 col-md-3">
									<button class="btn btn-info" type="submit">
										<i class="ace-icon fa fa-check bigger-110"></i>
										Confirm
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>

<script type="text/javascript">
    jQuery(function($) {
		/* validation form */
		$('#validation-form').validate({
			errorElement: 'div',
			errorClass: 'help-block',
			focusInvalid: true,
			ignore: "",
			rules: {
				email: {
					required: true,
					email:true
				},
				username: {
					required: true,
					minlength:5
				},
				name: {
					required: true
				},
				level: {
					required: true
				},
				status: {
					required: true
				},
				password: {
					required: true
				}		
			},
			messages: {
				email: {
					required: "Please enter a valid email.",
					email: "Please enter a valid email."
				},
				username: {
					required: "Please enter username.",
					minlength: "Username at least 5 character."
				},
				name: "Please enter full name.",
				level: "Level cannot be empty.",
				status: "Status cannot be empty.",
				password: "Please enter password."
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
		
		/* regular expression 
		** id=username allow only alphabet and number, also underscore for bonus :p 
		** in case we only allow alphabet and number use this : ^[a-zA-Z0-9]+$ 
		*/

		$('#username').keypress(function (e) {
    		var regex = new RegExp("^[a-zA-Z0-9_]*$");
    		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    		if (regex.test(str)) {
        		return true;
    		}
    		e.preventDefault();
    		return false;
		});
		/* id=name allow only alphabet, number, space and aposthope. example : Mark O'neal */
		$('#name').keypress(function (e) {
    		var regex = new RegExp("^[a-zA-Z0-9 ']+$");
    		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    		if (regex.test(str)) {
        		return true;
    		}
    		e.preventDefault();
    		return false;
		});
		/* inputlimiter function */

		/* popover */
		$('[data-rel=popover]').popover({container:'body'});
		
		PNotify.prototype.options.styling = "bootstrap3";
        /* upload image */
        $('#id-input-file-3').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'ace-icon fa fa-cloud-upload',
            droppable:true,
            thumbnail:'large',//large | fit \ small
            //allowExt: ['jpg', 'jpeg', 'png', 'gif'],
            //allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
            //,icon_remove:null//set null, to hide remove/reset button
            before_change:function(files, dropped) {
                var file = files[0];
                if(typeof file == "string") { //files is just a file name here (in browsers that don't support FileReader API)
                    if(! (/\.(jpe?g|png|gif)$/i).test(file) ) {
                        file = new PNotify({
						    title: 'File is empty!',
						    text: 'Please choose a jpg|gif|png image!',
						    type: 'error'
						});
                        $('#id-input-file-3').val('');
                    }
                } else {
                    var type = $.trim(file.type);
                    if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
                    || ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )//for android's default browser!
                    ) {
                    	file = new PNotify({
						    title: 'File is not an image!',
						    text: 'Please choose a jpg|gif|png image!',
						    type: 'error',
						    addclass: "stack-modal"
						});
                        $('#id-input-file-3').val('');
                    }
                    if( file.size > 110000 ) {//~100Kb
                        file = new PNotify({
						    title: 'File too big!',
						    text: 'Image size should not exceed 100Kb!',
						    type: 'error',
						    addclass: "stack-modal"
						});
                        $('#id-input-file-3').val('');
                    }
                }
                return true;
            }
            ,before_remove : function() {
                return true;
            }
            ,
            preview_error : function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                alert(error_code);
            }
            
        });
	})
</script>