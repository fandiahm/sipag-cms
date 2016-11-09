<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $folder_name = explode('/', $_SERVER['REQUEST_URI'])[1]; ?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Section</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-tasks"></i> Contact</a></li>
                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-paw"></i> Footer</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
                <div class="box box-info" id="box-contact">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact section</h3>
                        <div class="pull-right">
                            <input type="checkbox" id="gritter-light" name="auto_height" data-toggle="toggle" data-onstyle="primary" data-offstyle="default" data-size="mini">
                        </div>
                    </div>
                    <form class="" id="contact-form" action="#">
                        <div class="box-body">
                            <input type="hidden" name="contact_id" id="contact_id" value="">

                            <div class="form-group">
                                <label for="contact_layout"> Choose layout</label>
                                <select name="contact_layout" class="chosen-select chosen-select-contact" id="form-field-select-3" data-placeholder="Choose a layout..." disabled="disabled">
                                    <option id="layout-1" value="1" <?php if($contact->contact_layout == '1'){ echo 'selected="selected"'; }?>>Single form</option>
                                    <option id="layout-2" value="2" <?php if($contact->contact_layout == '2'){ echo 'selected="selected"'; }?>>Form with content</option>
                                </select>
                                <small><i>See <a class="group4" href="<?php echo base_url();?>assets/backend/img/contact-1.png" title="Single form">example</a></i></small>
                            </div>

                            <div class="form-group">
                                <label for="contact_title">Contact title</label>
                                <input type="text" name="contact_title" class="form-control" id="contact_title" placeholder="Contact title" disabled="true">
                            </div>

                            <div class="form-group form-contact-content">
                                <label for="contact_content"> Content</label>
                                <div class="overlay-editor">
                                    <textarea name="contact_content" id="editor1" class="form-required" disabled="true"></textarea>
                                    <div class="form-overlay" id="disable-tinymce"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_bgcolor">Background color</label>

                                <div id="cp5" class="input-group my-colorpicker1 colorpicker-component">
                                    <input type="text" name="contact_bgcolor" value="" class="form-control" disabled="true">
                                    <div class="input-group-addon"><i></i></div>
                                </div>
                                <small class="input-group">
                                    <i>Leave it transparent if not using background color.</i>
                                </small>
                            </div>

                            <div class="form-group">
                                <label class="control-label" for="contact_bgimage">Background image</label>
                                <div class="image-preview"> 
                                    <img src="" id="image-preview" width="100%">
                                    <label id="remove-label">
                                        <input type="checkbox" name="remove_image" value="remove_image" disabled="true">
                                        <span class="lbl remove">Remove this image</span>
                                    </label>
                                </div>
                                <div class="no-padding-left">
                                    <input type="file" name="contact_bgimage" id="id-input-file-3" class="" disabled="true" />
                                    <small><i>Max upload 100kb.</i></small>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer box-grey">
                            <button class="btn btn-info pull-right" id="btnUpdateContact" type="button" onclick="update_contact()" disabled="true">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="tab-pane" id="tab_2">
                <div class="box box-success" id="box-footer">
                    <div class="box-header">
                        <h3 class="box-title">Footer section</h3>
                        <div class="pull-right">
                            <input type="checkbox" id="gritter-light2" name="auto_height" data-toggle="toggle" data-onstyle="primary" data-offstyle="default" data-size="mini">
                        </div>
                    </div>
                    <form class="" id="footer-form" action="#">
                        <div class="box-body">
                            <input type="hidden" name="footer_id" id="footer_id" value="">

                            <div class="form-group">
                                <label for="contact_content"> Content</label>
                                <div class="overlay-editor">
                                    <textarea name="footer_content" id="editor2" class="form-required" disabled="true"></textarea>
                                    <div class="form-overlay" id="disable-tinymce2"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="contact_bgcolor">Background color</label>

                                <div id="cp6" class="input-group my-colorpicker1 colorpicker-component">
                                    <input type="text" name="footer_color" value="" class="form-control" disabled="true">
                                    <div class="input-group-addon"><i></i></div>
                                </div>
                                <small class="input-group">
                                    <i>Leave it transparent if not using background color.</i>
                                </small>
                            </div>
                        </div>

                        <div class="box-footer box-grey">
                            <button class="btn btn-info pull-right" id="btnUpdateFooter" type="button" onclick="update_footer()" disabled="true">
                                <i class="ace-icon fa fa-check bigger-110"></i>
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="img-col-example">
    <a class="group4" href="<?php echo base_url();?>assets/backend/img/contact-2.png" title="Form with content"></a>
</div>

<script>
    
    var save_method;
    var base_url = '<?php echo base_url();?>';
    PNotify.prototype.options.styling = "bootstrap3";

    window.onload = function(id)
    {
        save_method = 'update_contact';

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/contact/get_id')?>/1",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="contact_id"]').val(data.contact_id);
                $('[name="contact_title"]').val(data.contact_title);
                $('[name="contact_bgcolor"]').val(data.contact_bgcolor);
                $('[name="contact_content"]').val(data.contact_content);

                /* colorpicker */
                $('#cp5').colorpicker({
                    format: 'hex'
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
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | fontawesome | forecolor backcolor | fontsizeselect | fullscreen',
                    image_advtab: true,
                    automatic_uploads: true,
                    extended_valid_elements: 'span[*]', 
                    setup: function (editor) {
                        editor.on('change', function () {
                            editor.save();
                        });
                    }
                });

                if(data.contact_bgimage)
                {
                    $('.image-preview').show();
                    $('img#image-preview').attr('src', ''+base_url+''+data.contact_bgimage+'');
                    $('#remove-label').show();
                }
                else
                {
                    $('.image-preview').hide();
                }

                $.ajax({
		            url : "<?php echo site_url('admin/footer/get_id')?>/1",
		            type: "GET",
		            dataType: "JSON",
		            success: function(data)
		            {
		                $('[name="footer_id"]').val(data.footer_id);
		                $('[name="footer_color"]').val(data.footer_color);
		                $('[name="footer_content"]').val(data.footer_content);

		                /* colorpicker */
		                $('#cp6').colorpicker({
		                    format: 'hex'
		                });

		                /* tinymce */
		                tinymce.init({
		                    selector: '#editor2',
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
		                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | fontawesome | forecolor backcolor | fontsizeselect | fullscreen',
		                    image_advtab: true,
		                    automatic_uploads: true,
		                    extended_valid_elements: 'span[*]', 
		                    setup: function (editor) {
		                        editor.on('change', function () {
		                            editor.save();
		                        });
		                    }
		                });

		            },
		            error: function (jqXHR, textStatus, errorThrown)
		            {
		                alert('Error get data from ajax');
		            }
		        });

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function update_contact() 
    {
        $('#box-contact').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $('#btnUpdateContact').text('Updating data...');
        $('#btnUpdateContact').attr('disabled',true);

        var url = "<?php echo site_url('admin/contact/update')?>/1";
        var msg = "Contact section update success...";
        
        // ajax adding data to database
        var formData = new FormData($('#contact-form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                    
                if(data.status) 
                {  
                    $('#box-contact').find('.overlay').remove();
                    new PNotify({
						title: 'Success',
						text: msg,
						type: 'success'
					});
                    var id  = '1';
                    get_image(id);

                    $('#id-input-file-3').ace_file_input("reset_input");
                    $('[name="remove_image"]').prop('checked', false);

                    $('#btnUpdateContact').text('Update');
                    $('#btnUpdateContact').attr('disabled',false);
                }
                else
                {
                    new PNotify({
						title: 'Error',
						text: 'Please check your connection or reload page.',
						type: 'error'
					});
                }
            },
            error: function (jqXHR, textStatus, errorThrown,ex)
            {
                //alert('Error adding / update data');
                //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                new PNotify({
					title: 'Error',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
     
            }
        });
    }

    function get_image(id)
    {
        $.ajax({
            url : "<?php echo site_url('admin/contact/get_id')?>/1",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                if(data.contact_bgimage)
                {
                    $('.image-preview').show();
                    $('img#image-preview').attr('src', ''+base_url+''+data.contact_bgimage+'');
                    $('#remove-label').show();
                }
                else
                {
                    $('.image-preview').hide();
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error get data from ajax');
                new PNotify({
					title: 'Error',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
            }
        });
    }

    function update_footer() 
    {
        $('#box-footer').append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
        $('#btnUpdateFooter').text('Updating data...');
        $('#btnUpdateFooter').attr('disabled',true);

        var url = "<?php echo site_url('admin/footer/update')?>/1";
        var msg = "Footer section update success...";
        
        // ajax adding data to database
        var formData = new FormData($('#footer-form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                    
                if(data.status) 
                {  
                    $('#box-footer').find('.overlay').remove();
                    new PNotify({
						title: 'Success',
						text: msg,
						type: 'success'
					});

                    $('#btnUpdateFooter').text('Update');
                    $('#btnUpdateFooter').attr('disabled',false);
                }
                else
                {
                    new PNotify({
						title: 'Error',
						text: 'Please check your connection or reload page.',
						type: 'error'
					});
                }
            },
            error: function (jqXHR, textStatus, errorThrown,ex)
            {
                //alert('Error adding / update data');
                //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                new PNotify({
					title: 'Error',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
     
            }
        });
    }

</script>

<script type="text/javascript">
    jQuery(function($) {

        $('#gritter-light').change(function() {
            $('#disable-tinymce').toggleClass('form-overlay',!this.checked);
            $('.chosen-select').attr('disabled',!this.checked).trigger("chosen:updated",!this.checked);
            $('#contact-form .form-group :input').attr('disabled',!this.checked);
            $('#btnUpdateContact').attr('disabled',!this.checked);
        });

		$('#gritter-light2').change(function() {
			$('#disable-tinymce2').toggleClass('form-overlay',!this.checked);
			$('#footer-form .form-group :input').attr('disabled',!this.checked);
			$('#btnUpdateFooter').attr('disabled',!this.checked);
		});

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

        /* chosen function */
        if(!ace.vars['touch']) {
            $('.chosen-select').chosen({allow_single_deselect:true}); 
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
        }

        /* popover */
        $('[data-rel=popover]').popover({container:'body'});

        $(document).ready(function () {
            if($('option#layout-1').is(':selected')) {
                $(".form-contact-content").hide();
            } else if($('option#layout-2').is('selected')) {
                $(".form-contact-content").show();
            }
        });

        var $overflow = '';
        var colorbox_params = {
            rel: 'group4', 
            reposition:true,
            scalePhotos:true,
            scrolling:false,
            previous:'<i class="icon fa fa-arrow-left"></i>',
            next:'<i class="icon fa fa-arrow-right"></i>',
            close:'&times;',
            current:'{current} of {total}',
            maxWidth:'100%',
            maxHeight:'100%',
            onOpen:function(){
                $overflow = document.body.style.overflow;
                document.body.style.overflow = 'hidden';
            },
            onClosed:function(){
                document.body.style.overflow = $overflow;
            },
            onComplete:function(){
                $.colorbox.resize();
            }
        }

        $('.group4').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
        
        $(document).one('ajaxloadstart.page', function(e) {
            $('#colorbox, #cboxOverlay').remove();
        });

    })
</script>