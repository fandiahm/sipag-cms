<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $folder_name = explode('/', $_SERVER['REQUEST_URI'])[1]; ?>

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
		<h3 class="box-title">Form add content</h3>
	</div>

	<form class="form-horizontal" id="validation-form" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/content/add">
		<div class="box-body">
			<div class="form-group">
		        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="section_id"> Choose section</label>

		        <div class="col-xs-12 col-sm-4">
		            <div class="clearfix">
		                <select name="section_id" class="chosen-select" id="form-field-select-3" data-placeholder="Choose a section...">
		                    <option value="">  </option>
		                    <?php 
		                        $default = '';
		                        foreach ($section->result() as $row) { 
		                            echo "<option value='$row->section_id' " . set_select('section_id', $row->section_id) . " >" . $row->section_name . "</option>";
		                        }
		                    ?>
		                </select>
		            </div>
		        </div>
		    </div>

		    <div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="content_title"> Content title</label>
				<div class="col-xs-12 col-sm-9">
					<div class="input-group col-xs-12 col-sm-8">
					    <input type="text" name="content_title" id="content_title" value="<?php echo set_value('content_title'); ?>" class="form-control limited" maxlength="100" placeholder="Content title"/>
					    <span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="You can display/hide title on advanced option tab." title="Information"><i class="icon fa fa-info-circle"></i></span>
					</div>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="userfile">Image</label>
				<div class="col-xs-12 col-sm-9">
					<div class="clearfix">
					    <input type="file" name="userfile" id="id-input-file-3" class="" />
					    <small class="help-block"><i>Max upload 100kb.</i></small>
					</div>
				</div>
			</div>

			<div class="form-group">
		        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="content_text"> Content</label>

		        <div class="col-xs-12 col-sm-9">
		            <div class="clearfix">
		                <textarea name="content_text" id="editor1" class="form-required"><?php echo set_value('content_text'); ?></textarea>
		            </div>
		        </div>
		    </div>

			<div class="form-group">
		        <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="animate"> Choose animation</label>

		        <div class="col-xs-12 col-sm-4">
		            <div class="clearfix">
		                <select name="content_animate" class="input input--dropdown js--animations chosen-select2" id="animate" data-current-selected-option="<?php echo $this->input->post("content_animate"); ?>">
		                    <option value="">-- choose your animation --</option>
		                    <optgroup label="Attention Seekers" id="opt-group-1"></optgroup>
		                    <optgroup label="Bouncing Entrances" id="opt-group-2"></optgroup>
		                    <optgroup label="Bouncing Exits" id="opt-group-3"></optgroup>
		                    <optgroup label="Fading Entrances" id="opt-group-4"></optgroup>
		                    <optgroup label="Fading Exits" id="opt-group-5"></optgroup>
		                    <optgroup label="Flippers" id="opt-group-6"></optgroup>
		                    <optgroup label="Lightspeed" id="opt-group-7"></optgroup>
		                    <optgroup label="Rotating Entrances" id="opt-group-8"></optgroup>
		                    <optgroup label="Rotating Exits" id="opt-group-9"></optgroup>
		                    <optgroup label="Sliding Entrances" id="opt-group-10"></optgroup>
		                    <optgroup label="Sliding Exits" id="opt-group-11"></optgroup>
		                    <optgroup label="Zoom Entrances" id="opt-group-12"></optgroup>
		                    <optgroup label="Zoom Exits" id="opt-group-13"></optgroup>
		                    <optgroup label="Specials" id="opt-group-14"></optgroup>
		                </select>
		            </div>
		        </div>
		        <div class="col-xs-12 col-sm-5">
		            <div class="clearfix">
		                <span id="animationSandbox" style="display: block;"><h4 id="animationSandbox" class="site__title mega">Animated it!</h4></span>
		            </div>
		        </div>
		    </div>

		    <div class="form-group">
        		<label class="control-label col-xs-12 col-sm-2 no-padding-right" for="advanced-option">Advanced option</label>

        		<div class="col-xs-12 col-sm-5">
        			<div class="box box-default box-solid collapsed-box">
        				<div class="box-header with-border">
        					<h3 class="box-title">Configuration</h3>
        					<div class="box-tools pull-right">
                				<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                				</button>
              				</div>
        				</div>
        				<div class="box-body no-padding">
        					<table class="table table-striped">
        						<tbody class="thin-border-bottom">
	                                <tr>
	                                    <td>Display title content</td>
	                                    <td>
	                                    	<input type="checkbox" name="display_title_content" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" checked="checked">
	                                    </td>
	                                </tr>
	                                <tr>
	                                    <td>Animation repeat</td>
	                                    <td>
	                                        <input type="checkbox" name="animation_repeat" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini">
	                                    </td>
	                                </tr>
	                            </tbody>
        					</table>
        				</div>
        			</div>
        		</div>
        	</div>

		</div>

		<div class="box-footer text-center box-grey">
			<a href="<?php echo base_url();?>admin/content" class="btn btn-default">Cancel</a>
			<button type="submit" class="btn btn-info">Submit</button>
		</div>
	</form>
</div>

<script type="text/javascript">
    jQuery(function($) {
        /* validation form */
        $('#validation-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                section_id: {
                    required: true
                },
                content_title: {
                    required: true
                },
            },
            messages: {
                section_id: {
                    required: "Please choose section."
                },
                content_title: {
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
                else error.insertAfter(element.parent());
            },
            
            //submitHandler: function (form) {},
            invalidHandler: function(form, validator) {
                if (!validator.numberOfInvalids())
                    return;

                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).focus()
                }, 2000);
            }
        });

        /* popover */
        $('[data-rel=popover]').popover({container:'body'});

        /* chosen function */
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true}); 
            $('.chosen-select2').chosen({allow_single_deselect:true});
            $('.chosen-select').change(function () {
                $(this).valid();
            });
            //resize the chosen on window resize
            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
            $(window)
            .off('resize.chosen')
            .on('resize.chosen', function() {
                $('.chosen-select2').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            }).trigger('resize.chosen');
            //resize chosen on sidebar collapse/expand
            $(document).on('settings.ace.chosen', function(e, event_name, event_val) {
                if(event_name != 'sidebar_collapsed') return;
                $('.chosen-select2').each(function() {
                    var $this = $(this);
                    $this.next().css({'width': $this.parent().width()});
                })
            });
        }

        $('.chosen-select2').on('chosen:showing_dropdown', function(event, params) {
		   var chosen_container = $( event.target ).next( '.chosen-container' );
		   var dropdown = chosen_container.find( '.chosen-drop' );
		   var dropdown_top = dropdown.offset().top - $(window).scrollTop();
		   var dropdown_height = dropdown.height();
		   var viewport_height = $(window).height();

		   if ( dropdown_top + dropdown_height > viewport_height ) {
		      chosen_container.addClass( 'chosen-drop-up' );
		   }

		});
		$('.chosen-select2').on('chosen:hiding_dropdown', function(event, params) {
		   $( event.target ).next( '.chosen-container' ).removeClass( 'chosen-drop-up' );
		});
        
        /* upload image */
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
        
        /* Example animation */
        function testAnim(x) {
            $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
                $(this).removeClass();
            });
        };

        $(document).ready(function(){
            $('.js--triggerAnimation').click(function(e){
                e.preventDefault();
                var anim = $('.js--animations').val();
                testAnim(anim);
            });
            $('.js--animations').change(function(){
                var anim = $(this).val();
                testAnim(anim);
            });
        });

        /* tinymce */
        var fpath = '<?php print($folder_name)?>';
        tinymce.init({
            selector: '#editor1',
            height: 50,
            theme: 'modern',
            relative_urls:false,
            external_filemanager_path:"/"+fpath+"/assets/plugins/filemanager/",
            content_css: '/'+fpath+'/assets/font-awesome/4.7.0/css/font-awesome.min.css',
            filemanager_title:"Responsive Filemanager" ,
            external_plugins: { "filemanager" : "filemanager/plugin.min.js"},
            plugins: [
                'fullscreen advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen fontawesome',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools responsivefilemanager'
            ],
            //toolbar1: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link responsivefilemanager | fullscreen blockquote forecolor backcolor emoticons fontawesome | fontsizeselect fontselect',
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | fontawesome | forecolor backcolor | fontsizeselect | fullscreen',
            image_advtab: true,
            automatic_uploads: true,
            extended_valid_elements: 'span[*]',
        });
    })
</script>