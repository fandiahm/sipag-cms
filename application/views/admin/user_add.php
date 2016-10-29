<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php if($this->session->flashdata('message')) : ?>
	<div class="alert alert-success alert-dismissible" role="alert" align="center">
		<button type="button" class="close" data-dismiss="alert">		
			<i class="icon fa fa-times"></i>
		</button>
	   	<?php echo $this->session->flashdata('message'); ?>
	</div>
<?php endif; ?>

<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Form add user</h3>
	</div>
	<form class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/user/user_add">
		<div class="box-body">
			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="email">Email</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>" class="form-control" maxlength="50" placeholder="Email address"/>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="username">Username</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="text" name="username" id="username" value="<?php echo set_value('username'); ?>" class="form-control limited" maxlength="20" placeholder="Username"/>
					</div>
				</div>
			</div>

			<hr>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="password">Password</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="password" name="password" id="password" class="form-control" maxlength="32" placeholder="Password for this user" />
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="repassword">Password confirm</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="password" name="repassword" id="repassword" class="form-control" maxlength="32" placeholder="Re-type password" />
					</div>
				</div>
			</div>

			<hr>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="name">Full name</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="text" name="name" id="name" value="<?php echo set_value('name'); ?>" class="form-control limited" maxlength="25" placeholder="Full name"/>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="userfile">Picture</label>

				<div class="col-xs-12 col-sm-6">
					<div class="clearfix">
						<input type="file" name="userfile" id="id-input-file-3" class="" />
						<small><i>Max upload 100kb.</i></small>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right">Level</label>

				<div class="col-xs-12 col-sm-10">
					<div>
						<label>
							<input type="radio" name="level" class="flat-red" value="2" <?php echo set_radio('level', '2', TRUE); ?>>
							Author
						</label>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right">Status</label>

				<div class="col-xs-12 col-sm-10">
					<div>
						<label>
							<input type="radio" class="flat-red" name="status" value="1" <?php echo set_radio('status', '1', TRUE); ?> />
							Active
						</label>
					</div>
					<div>
						<label>
							<input type="radio" class="flat-red" name="status" value="2" <?php echo set_radio('status', '2'); ?> />
							Not Active
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="box-footer box-grey text-center">
			<a href="<?php echo base_url();?>admin/user" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-info">Submit</button>
		</div>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function(){
  		$('input[type=radio]').iCheck({
    		checkboxClass: 'icheckbox_flat-blue',
    		radioClass: 'iradio_flat-blue'
  		});
	});

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
				password: {
					required: true,
					minlength: 5
				},
				repassword: {
					required: true,
					minlength: 5,
					equalTo: "#password"
				},
				name: {
					required: true
				},
				level: {
					required: true
				},
				status: {
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
				password: {
					required: "Please enter password.",
					minlength: "Password is too short."
				},
				repassword: {
					required: "Please enter password.",
					minlength: "Password is too short."
				},
				name: "Please enter full name.",
				level: "Choose level.",
				status: "Choose status."
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

		/* regular expression */
		/* id=username allow only alphabet and number, also underscore for bonus :p */
		/* in case we only allow alphabet and number use this : ^[a-zA-Z0-9]+$ */
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