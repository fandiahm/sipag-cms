<?php defined('BASEPATH') OR exit('No direct script access allowed');

    if($this->input->post()){
        $section_layout     = set_value('section_layout');
        $section_name       = set_value('section_name');
        $section_menu       = set_value('section_menu');
        $section_title      = set_value('title');
        $bgcolor            = set_value('bgcolor');
        $bgimage            = set_value('bgimage');
        $title_animation    = set_value('title_animation');
    } else {
        $section_layout     = $section->section_layout;
        $section_name       = $section->section_name;
        $section_menu       = $section->section_menu;
        $section_title      = $section->title;
        $bgcolor            = $section->bgcolor;
        $bgimage            = $section->bgimage;
        $title_animation    = $section->title_animation;
    }
?>

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
        <h3 class="box-title">Form update section</h3>
    </div>
    <form class="form-horizontal" id="validation-form" role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>admin/section/edit/<?php echo $section->section_id;?>">
        <div class="box-body">
            <div class="form-group">
                <label class="col-xs-12 col-sm-2 control-label no-padding-right" for="section_layout"> Choose layout</label>

                <div class="col-xs-12 col-sm-4">
                    <select name="section_layout" class="form-control chosen-select" data-placeholder="Choose a layout...">
                        <option> </option>
                        <optgroup label="Standard column">
                            <option <?php if($section_layout=='1'){echo"selected='selected'";} ?> value="1">1 column</option>
                            <option <?php if($section_layout=='2'){echo"selected='selected'";} ?> value="2">2 column</option>
                            <option <?php if($section_layout=='3'){echo"selected='selected'";} ?> value="3">3 column</option>
                            <option <?php if($section_layout=='4'){echo"selected='selected'";} ?> value="4">4 column</option>
                            <option <?php if($section_layout=='5'){echo"selected='selected'";} ?> value="5">5 column</option>
                            <option <?php if($section_layout=='6'){echo"selected='selected'";} ?> value="6">6 column</option>
                        </optgroup>
                        <optgroup label="Stand image">
                            <option <?php if($section_layout=='21'){echo"selected='selected'";} ?> value="21">Left image column</option>
                            <option <?php if($section_layout=='22'){echo"selected='selected'";} ?> value="22">Right image column</option>
                        </optgroup>
                        <optgroup label="Gallery">
                            <option <?php if($section_layout=='31'){echo"selected='selected'";} ?> value="31">2 column gallery</option>
                            <option <?php if($section_layout=='32'){echo"selected='selected'";} ?> value="32">3 column gallery</option>
                            <option <?php if($section_layout=='33'){echo"selected='selected'";} ?> value="33">4 column gallery</option>
                        </optgroup>
                        <optgroup label="Slider">
                            <option <?php if($section_layout=='7'){echo"selected='selected'";} ?> value="7">Slider content</option>
                        </optgroup>
                    </select>
                    <small class="help-block"><i><a class="group3" href="<?php echo base_url();?>assets/backend/img/single_column.png" title="1 column">See example</a></i></small>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="section_name"> Section name</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="input-group col-xs-12 col-sm-8">
                        <input type="text" name="section_name" id="section_name" value="<?php echo $section_name; ?>" class="form-control limited" maxlength="20" placeholder="Section name"/>
                        <span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Section name must be unique and only lowercase allowed." title="Information"><i class="icon fa fa-info-circle"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="section_menu"> Section menu</label>
                <div class="col-xs-12 col-sm-9">
                    <div class="input-group col-xs-12 col-sm-8">
                        <input type="text" name="section_menu" id="section_menu" value="<?php echo $section_menu; ?>" class="form-control limited" maxlength="20" placeholder="Section menu"/>
                        <span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="Menu name will appear at top navigation, so this could be unique." title="Information"><i class="icon fa fa-info-circle"></i></span>
                    </div>
                </div>
            </div>

            <?php if($use_tinymce == 0): ?>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="title"> Section title</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="input-group col-xs-12 col-sm-8">
                            <input type="text" name="title" id="title" value="<?php echo strip_tags(htmlspecialchars_decode($section_title)); ?>" class="form-control" placeholder="Section title"/>
                            <span class="input-group-addon" data-rel="popover" data-trigger="hover" data-placement="top" data-content="If you want to use Tinymce editor go to setting." title="Information"><i class="icon fa fa-info-circle"></i></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                    
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="title"> Section title</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <textarea name="title" id="editor_title"><?php echo $section_title; ?></textarea>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($use_bgcolor == 1): ?>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="bgcolor">Background color</label>

                    <div class="col-xs-12 col-sm-9">
                        <div class="input-group my-colorpicker1 col-xs-12 col-sm-6">
                            <input type="text" name="bgcolor" value="<?php echo $bgcolor; ?>" class="form-control">
                            <div class="input-group-addon">
                                <i></i>
                            </div>
                        </div>
                        <small class="input-group">
                            <i>Leave it transparent if not using background color.</i>
                        </small>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($use_bgimage == 1): ?>
                <div class="form-group">
                    <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="userfile">Background image</label>
                    <div class="col-xs-12 col-sm-9">
                        <div class="clearfix">
                            <div class="col-xs-12 col-sm-6">  
                                <?php if(empty($section->bgimage)): ?>
                                    <h5><span class="text-red">Empty default image</span></h5>
                                <?php else: ?>
                                    <img src="<?php echo base_url(); ?><?php echo $bgimage; ?>" width="100%">
                                    <label>
                                        <input type="checkbox" name="checked" value="checked">
                                        <span>Remove this image</span>
                                    </label>
                                <?php endif; ?>
                            </div>
                            
                            <div class="col-xs-12 col-sm-6">
                                <input type="file" name="userfile" id="id-input-file-3" class="" />
                                <small class="help-block"><i>Max upload 100kb.</i></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <label class="control-label col-xs-12 col-sm-2 no-padding-right" for="animate"> Choose animation</label>

                <div class="col-xs-12 col-sm-4">
                    <div class="clearfix">
                        <select name="title_animation" class="input input--dropdown js--animations chosen-select2" id="animate" data-current-selected-option="<?php echo $this->input->post("title_animation"); ?>">
                            <?php if($title_animation==''): ?>
                                <option value="">-- choose your animation --</option>
                            <?php else: ?>
                                <option value="<?php echo $title_animation; ?>"><?php echo $title_animation;?></option>
                                <option value="">-- choose your animation --</option>
                            <?php endif; ?>
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
                    <small class="input-group">
                        <i>Will be use only for title section.</i>
                    </small>
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
                                        <td>Auto height section</td>
                                        <td>
                                            <?php if($section->auto_height == '1') { $ah_checked = 'checked="checked"'; } else { $ah_checked = ''; } ?>
                                            <input type="checkbox" name="auto_height" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" <?php echo $ah_checked; ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vertical align section</td>
                                        <td>
                                            <?php if($section->vertical_align == '1') { $va_checked = 'checked="checked"'; } else { $va_checked = ''; } ?>
                                            <input type="checkbox" name="vertical_align" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" <?php echo $va_checked; ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Display title section</td>
                                        <td>
                                            <?php if($section->display_title == '1') { $dt_checked = 'checked="checked"'; } else { $dt_checked = ''; } ?>
                                            <input type="checkbox" name="display_title" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" <?php echo $dt_checked; ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Display menu</td>
                                        <td>
                                            <?php if($section->display_menu == '1') { $dm_checked = 'checked="checked"'; } else { $dm_checked = ''; } ?>
                                            <input type="checkbox" name="display_menu" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" <?php echo $dm_checked; ?> />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Animation repeat</td>
                                        <td>
                                            <?php if($section->title_animation_repeat == '1') { $tar_checked = 'checked="checked"'; } else { $tar_checked = ''; } ?>
                                            <input type="checkbox" name="title_animation_repeat" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="primary" data-offstyle="default" data-size="mini" <?php echo $tar_checked; ?> />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="box-footer box-grey text-center">
            <a href="<?php echo base_url();?>admin/section" class="btn btn-default">Cancel</a>
            <button type="submit" class="btn btn-info">Submit</button>
        </div>
    </form>
</div>

<div class="img-col-example">

    <a class="group3" href="<?php echo base_url();?>assets/backend/img/double_column.png" title="2 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/triple_column.png" title="3 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/four_column.png" title="4 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/five_column.png" title="5 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/six_column.png" title="6 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/double-img-left.png" title="Image left column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/double-img-right.png" title="Image right column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/gallery-2-column.jpg" title="Gallery 2 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/gallery-3-column.jpg" title="Gallery 3 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/gallery-4-column.jpg" title="Gallery 4 column" data-rel="colorbox"></a>
    <a class="group3" href="<?php echo base_url();?>assets/backend/img/slider-content.jpg" title="Slider content" data-rel="colorbox"></a>

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
                section_layout: {
                    required: true
                },
                section_name: {
                    required: true,
                    minlength:2
                },
                section_menu: {
                    required: true,
                    minlength:2                
                }      
            },
            messages: {
                section_layout: {
                    required: "Please choose section layout."
                },
                section_name: {
                    required: "Section name is required.",
                    minlength: "Section name is too short."
                },
                section_menu: {
                    required: "Menu name is required.",
                    minlength: "Menu name is required."
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
            invalidHandler: function (form, validator) {

            }
        });

        /* regular expression 
        ** 
        */
        $('#section_name').keypress(function (e) {
            var regex = new RegExp("^[a-z0-9_]*$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });
        $('#section_menu').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9 ']+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        /* inputlimiter function 
        $('#section_name.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });
        $('#section_menu.limited').inputlimiter({
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        }); */

        /* popover */
        $('[data-rel=popover]').popover({container:'body'});

        /* colorpicker */
        $(".my-colorpicker1").colorpicker({
            format: 'hex'
        });

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
        
        /* PNotify bootstrap styling*/
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
        window.onload = function()
        {
            $('iframe#editor_title_ifr').removeAttr('title');
        }
        var fpath = '<?php print($folder_name)?>';
        tinymce.init({
            selector: '#editor_title',
            height: 100,
            theme: 'modern',
            content_css: '/'+fpath+'/assets/font-awesome/4.7.0/css/font-awesome.min.css',
            plugins: [
                'textcolor colorpicker visualblocks fontawesome noneditable code',
            ],
            menubar: true,
            toolbar: 'undo redo | fontselect | bold italic forecolor backcolor | alignleft aligncenter alignright',
            style_formats: [
                { title: 'Headers', items: [
                    { title: 'h1', block: 'h1' },
                    { title: 'h2', block: 'h2' },
                    { title: 'h3', block: 'h3' },
                    { title: 'h4', block: 'h4' },
                    { title: 'h5', block: 'h5' },
                    { title: 'h6', block: 'h6' }
                ] }
            ],
            noneditable_noneditable_class: 'fa',
            extended_valid_elements: 'span[*]',
        });

        var $overflow = '';
        var colorbox_params = {
            rel: 'group3', 
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

        $('.group3').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").html("<i class='icon fa fa-spinner text-orange fa-spin'></i>");//let's add a custom loading icon
        
        $(document).one('ajaxloadstart.page', function(e) {
            $('#colorbox, #cboxOverlay').remove();
        });

    })
</script>