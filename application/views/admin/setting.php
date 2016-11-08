<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Logo site</h3>
            </div>
            <div class="box-body">
                <div class="user-profile text-center">
                    <span class="profile-picture">
                        <?php if(!empty($site_logo)):?>
                            <?php $logo = base_url().$site_logo; ?>
                        <?php else: ?>
                            <?php $logo = base_url().'assets/avatars/profile-pic.jpg'; ?>
                        <?php endif; ?>
                        <img id="avatar" class="editable img-responsive" alt="Logo site" src="<?php echo $logo; ?>" />
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Site info</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Site name</label>
                        <div class="col-sm-9">
                            <span class="editable" id="site_name"><?php echo $site_name; ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Site title</label>
                        <div class="col-sm-9">
                            <span class="editable" id="site_title"><?php echo $site_title; ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Meta keyword</label>
                        <div class="col-sm-9">
                            <span class="editable" id="meta_keyword"><?php echo $meta_keyword; ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Meta description</label>
                        <div class="col-sm-9">
                            <span class="editable" id="meta_description"><?php echo $meta_description; ?></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<form class="form-horizontal" id="setting-form" action="#">
    <input type="hidden" name="setting_id" value=""/>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default box-solid widget-box-navbar">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon fa fa-th-large"></i> 
                        Navbar menu
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tbody class="thin-border-bottom">
                            <tr>
                                <td>Display navbar</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_navbar()" class="switch custom-switch sipag-switch" name="display_navbar" id="display_navbar" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display logo site</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_navbar()" class="switch custom-switch sipag-switch" name="display_logo" id="display_logo" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Navbar inverse</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_navbar()" class="switch custom-switch sipag-switch" name="navbar_inverse" id="navbar_inverse" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Navbar transparent</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_navbar()" class="switch custom-switch sipag-switch" name="navbar_transparent" id="navbar_transparent" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Navbar pull right</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_navbar()" class="switch custom-switch sipag-switch" name="navbar_pull_right" id="navbar_pull_right" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-section">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon fa fa-list-alt"></i> 
                        Section
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tbody class="thin-border-bottom">
                            <tr>
                                <td>Background color</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_section()" class="switch custom-switch sipag-switch" name="section_bgcolor" id="section_bgcolor" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Background image</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_section()" class="switch custom-switch sipag-switch" name="section_bgimage" id="section_bgimage" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Use editor for title</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_section()" class="switch custom-switch sipag-switch" name="section_title_tinymce" id="section_title_tinymce" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Advanced option</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_section()" class="switch custom-switch sipag-switch" name="section_advanced_option" id="section_advanced_option" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-cf">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon fa fa-bookmark"></i> 
                        Contact & Footer
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tbody class="thin-border-bottom">
                            <tr>
                                <td>Display contact section</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_cf()" class="switch custom-switch sipag-switch" name="display_contact" id="display_contact" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display footer</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_cf()" class="switch custom-switch sipag-switch" name="display_footer" id="display_footer" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-smtp">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon fa fa-envelope"></i> 
                        Email SMTP Configuration
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <p>
                        <i class="icon fa fa-info-circle"></i> 
                        Sipag CMS use Gmail SMTP for sending email. You have to activate your gmail account here.
                    </p>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="smtp"> SMTP</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" name="smtp" id="smtp" value="ssl://smtp.gmail.com" class="col-xs-12 col-sm-12 form-control" maxlength="50" readonly="readonly" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="name"> Sender Name</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="text" name="name_smtp" id="name_smtp" value="" class="col-xs-12 col-sm-12 form-control" maxlength="100" placeholder="Display name sender" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="email"> Email</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="email" name="email_smtp" id="email" value="" class="col-xs-12 col-sm-12 form-control" maxlength="100" placeholder="Ex. email@gmail.com" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-xs-12 col-sm-3 no-padding-right" for="password"> Password</label>
                        <div class="col-xs-12 col-sm-9">
                            <div class="clearfix">
                                <input type="password" name="pass_smtp" id="password" value="" class="col-xs-12 col-sm-12 form-control" maxlength="100" placeholder="Your password email" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer box-grey">
                    <button type="button" id="btnSMTP" class="btn btn-xs btn-success pull-right" onclick="save_smtp()">
                        Save
                        <i class="icon fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default box-solid widget-box-banner">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon fa fa-image"></i> 
                        Banner
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <table class="table table-striped table-bordered">
                        <tbody class="thin-border-bottom">
                            <tr>
                                <td>Display banner</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_display" id="banner_display" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display header</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_display_header" id="banner_display_header" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display caption</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_display_caption" id="banner_display_caption" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display scroll-down button</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_display_button" id="banner_display_button" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Display prev-next button</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_nav_button" id="banner_nav_button" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Banner autoplay</td>
                                <td>
                                    <label class="custom">
                                        <input type="checkbox" onclick="save_banner()" class="switch custom-switch sipag-switch" name="banner_autoplay" id="banner_autoplay" value="" />
                                        <span class="lbl"></span>
                                    </label>
                                </td>
                            </tr>
                            <tr>
                                <td>Transition Style</td>
                                <td>
                                    <select name="banner_animation" id="banner_animation" class="form-control" onchange="save_banner()">
                                        <option value="1">none</option>
                                        <option value="2">fade</option>
                                        <option value="3">backSlide</option>
                                        <option value="4">goDown</option>
                                        <option value="5">fadeUp</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-order">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="icon fa fa-bars"></i> 
                        Order Section
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <p class="text">
                        <span class="text-blue">Section</span>
                        <span class="text-green pull-right">Menu</span>
                    </p>
                    <ul class="todo-list" id="section_order">
                        <?php foreach($section->result() as $row):?>
                            <li id="item-<?php echo $row->section_id;?>">
                                <span class="handle handle-section">
                                    <i class="icon fa fa-ellipsis-v"></i>
                                    <i class="icon fa fa-ellipsis-v"></i>
                                </span>
                                <span class="text text-blue"><?php echo $row->section_name;?></span>
                                <span class="text pull-right text-green"><?php echo $row->section_menu;?></span>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-order">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="icon fa fa-bars"></i> 
                        Order Menu
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="dd" id="nestable">
                        <?php if(isset($menu_list)): ?>
                            <?php if (count($menu_list) > 0): ?>
                                <?php echo $li; ?>
                            <?php else:?>
                                <div class="alert alert-info">
                                    <p class="text-center">Empty</p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="box box-default box-solid widget-box-scroll">
                <div class="box-header">
                    <h3 class="box-title">
                        <i class="icon fa fa-bars"></i> 
                        Scroll Effect
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Scroll time</label>
                        <div class="col-sm-9">
                            <span class="editable" id="scroll_time"><?php echo $scrolltime; ?></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-xs-12 col-sm-3 control-label"> Scroll offset</label>
                        <div class="col-sm-9">
                            <span class="editable" id="scroll_offset"><?php echo $scrolloffset; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>

    PNotify.prototype.options.styling = "bootstrap3";
    PNotify.prototype.options.delay = 3000;

    var save_method;
    var base_url = '<?php echo base_url();?>';

    window.onload = function(id)
    {
        save_method = 'update_setting';
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/setting/get_id')?>/1",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="setting_id"]').val(data.setting_id);
                $('[name="banner_display"]').val(data.banner_display);
                $('[name="banner_display_header"]').val(data.banner_display_header);
                $('[name="banner_display_caption"]').val(data.banner_display_caption);
                $('[name="banner_display_button"]').val(data.banner_display_button);
                $('[name="banner_nav_button"]').val(data.banner_nav_button);
                $('[name="banner_autoplay"]').val(data.banner_autoplay);
                $('[name="banner_animation"]').val(data.banner_animation);
                $('[name="section_title_tinymce"]').val(data.section_title_tinymce);
                $('[name="section_bgcolor"]').val(data.section_bgcolor);
                $('[name="section_bgimage"]').val(data.section_bgimage);
                $('[name="display_contact"]').val(data.display_contact);
                $('[name="display_footer"]').val(data.display_footer);
                $('[name="section_advanced_option"]').val(data.section_advanced_option);
                $('[name="display_navbar"]').val(data.display_navbar);
                $('[name="display_logo"]').val(data.display_logo);
                $('[name="navbar_inverse"]').val(data.navbar_inverse);
                $('[name="navbar_transparent"]').val(data.navbar_transparent);
                $('[name="navbar_pull_right"]').val(data.navbar_pull_right);

                $('[name="name_smtp"]').val(data.name_smtp);
                $('[name="email_smtp"]').val(data.email_smtp);
                $('[name="password_smtp"]').val(data.pass_smtp);
                
                if($('[name="banner_display"]').val()=='1') {
                    $('[name="banner_display"]').prop('checked', true);
                } else {
                    $('[name="banner_display"]').prop('checked', false);
                }

                if($('[name="banner_display_header"]').val()=='1') {
                    $('[name="banner_display_header"]').prop('checked', true);
                } else {
                    $('[name="banner_display_header"]').prop('checked', false);
                }

                if($('[name="banner_display_caption"]').val()=='1') {
                    $('[name="banner_display_caption"]').prop('checked', true);
                } else {
                    $('[name="banner_display_caption"]').prop('checked', false);
                }

                if($('[name="banner_display_button"]').val()=='1') {
                    $('[name="banner_display_button"]').prop('checked', true);
                } else {
                    $('[name="banner_display_button"]').prop('checked', false);
                }

                if($('[name="banner_nav_button"]').val()=='1') {
                    $('[name="banner_nav_button"]').prop('checked', true);
                } else {
                    $('[name="banner_nav_button"]').prop('checked', false);
                }

                if($('[name="banner_autoplay"]').val()=='1') {
                    $('[name="banner_autoplay"]').prop('checked', true);
                } else {
                    $('[name="banner_autoplay"]').prop('checked', false);
                }

                if($('[name="section_title_tinymce"]').val()=='1') {
                    $('[name="section_title_tinymce"]').prop('checked', true);
                } else {
                    $('[name="section_title_tinymce"]').prop('checked', false);
                }

                if($('[name="section_bgcolor"]').val()=='1') {
                    $('[name="section_bgcolor"]').prop('checked', true);
                } else {
                    $('[name="section_bgcolor"]').prop('checked', false);
                }

                if($('[name="section_bgimage"]').val()=='1') {
                    $('[name="section_bgimage"]').prop('checked', true);
                } else {
                    $('[name="section_bgimage"]').prop('checked', false);
                }

                if($('[name="section_advanced_option"]').val()=='1') {
                    $('[name="section_advanced_option"]').prop('checked', true);
                } else {
                    $('[name="section_advanced_option"]').prop('checked', false);
                }

                if($('[name="display_navbar"]').val()=='1') {
                    $('[name="display_navbar"]').prop('checked', true);
                } else {
                    $('[name="display_navbar"]').prop('checked', false);
                }

                if($('[name="display_logo"]').val()=='1') {
                    $('[name="display_logo"]').prop('checked', true);
                } else {
                    $('[name="display_logo"]').prop('checked', false);
                }

                if($('[name="navbar_inverse"]').val()=='1') {
                    $('[name="navbar_inverse"]').prop('checked', true);
                } else {
                    $('[name="navbar_inverse"]').prop('checked', false);
                }

                if($('[name="navbar_transparent"]').val()=='1') {
                    $('[name="navbar_transparent"]').prop('checked', true);
                } else {
                    $('[name="navbar_transparent"]').prop('checked', false);
                }

                if($('[name="navbar_pull_right"]').val()=='1') {
                    $('[name="navbar_pull_right"]').prop('checked', true);
                } else {
                    $('[name="navbar_pull_right"]').prop('checked', false);
                }

                if($('[name="display_contact"]').val()=='1') {
                    $('[name="display_contact"]').prop('checked', true);
                } else {
                    $('[name="display_contact"]').prop('checked', false);
                }

                if($('[name="display_footer"]').val()=='1') {
                    $('[name="display_footer"]').prop('checked', true);
                } else {
                    $('[name="display_footer"]').prop('checked', false);
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error get data from ajax');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    function save_banner()
    {
        $('.widget-box-banner').append('<div class="overlay"><i class="fa-spin icon fa fa-spinner text-orange"></i></div>');
        var url;
        if(save_method == 'update_setting') {
            url = "<?php echo site_url('admin/setting/update')?>/1";
            msg = "Banner configuration has been updated.";
        } 
        
        // ajax adding data to database
        var formData = new FormData($('#setting-form')[0]);
        $.ajax({
            url : url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {  
                    $('.widget-box-banner').find('.overlay').remove();
                    new PNotify({
                        title: 'Success!',
                        text: msg,
                        type: 'success'
                    });
                }
                else
                {
                    //alert('Error');
                    new PNotify({
                        title: 'Error!',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    function save_section()
    {
        $('.widget-box-section').append('<div class="overlay"><i class="fa-spin icon fa fa-spinner text-orange"></i></div>');
        var url2;
        if(save_method == 'update_setting') {
            url2 = "<?php echo site_url('admin/setting/update')?>/1";
            msg2 = "Section configuration has been updated.";
        } 
        
        // ajax adding data to database
        var formData = new FormData($('#setting-form')[0]);
        $.ajax({
            url : url2,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {  
                    $('.widget-box-section').find('.overlay').remove();
                    new PNotify({
                        title: 'Success!',
                        text: msg2,
                        type: 'success'
                    });
                }
                else
                {
                    //alert('Error');
                    new PNotify({
                        title: 'Error!',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    function save_cf()
    {
        $('.widget-box-cf').append('<div class="overlay"><i class="fa-spin icon fa fa-spinner text-orange"></i></div>');
        var url2;
        if(save_method == 'update_setting') {
            url2 = "<?php echo site_url('admin/setting/update')?>/1";
            msg2 = "Contact & Footer configuration has been updated.";
        } 
        
        // ajax adding data to database
        var formData = new FormData($('#setting-form')[0]);
        $.ajax({
            url : url2,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {  
                    $('.widget-box-cf').find('.overlay').remove();
                    new PNotify({
                        title: 'Success!',
                        text: msg2,
                        type: 'success'
                    });
                }
                else
                {
                    //alert('Error');
                    new PNotify({
                        title: 'Error!',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    function save_navbar()
    {
        $('.widget-box-navbar').append('<div class="overlay"><i class="fa-spin icon fa fa-spinner text-orange"></i></div>');
        var url5;
        if(save_method == 'update_setting') {
            url5 = "<?php echo site_url('admin/setting/update')?>/1";
            msg5 = "Navbar configuration has been updated.";
        } 
        
        // ajax adding data to database
        var formData = new FormData($('#setting-form')[0]);
        $.ajax({
            url : url5,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {  
                    $('.widget-box-navbar').find('.overlay').remove();
                    new PNotify({
                        title: 'Success!',
                        text: msg5,
                        type: 'success'
                    });
                }
                else
                {
                    //alert('Error');
                    new PNotify({
                        title: 'Error!',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
     
            }
        });
    }

    function save_smtp() 
    {
        $('.widget-box-smtp').append('<div class="overlay"><i class="fa-spin icon fa fa-spinner text-orange"></i></div>');
        $('#btnSMTP').text('Saving data...');
        $('#btnSMTP').attr('disabled',true);

        var url3 = "<?php echo site_url('admin/setting/update_smtp')?>/1";
        var msg3 = "Email SMTP Configuration succeed.";
        
        // ajax adding data to database
        var formData = new FormData($('#setting-form')[0]);
        $.ajax({
            url : url3,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) //if success close modal and reload ajax table
                {  
                    $('.widget-box-smtp').find('.overlay').remove();
                    new PNotify({
                        title: 'Success!',
                        text: msg3,
                        type: 'success'
                    });
                    $('#btnSMTP').text('Save');
                    $('#btnSMTP').attr('disabled',false);
                }
                else
                {
                    //alert('Error');
                    new PNotify({
                        title: 'Error!',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error adding / update data');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    function get_logo(id)
    {
        $.ajax({
            url : "<?php echo site_url('admin/setting/get_id')?>/1",
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                if(data.site_logo)
                {
                    $('#avatar').attr('src', ''+base_url+''+data.site_logo+'');
                    console.log(data.site_logo);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //alert('Error get data from ajax');
                new PNotify({
                    title: 'Error!',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
            }
        });
    }

    /* sortable ajax */
    $(document).ready(function () {
        var url3 = '<?php echo site_url("admin/setting/update_section")?>';
        $('ul#section_order').sortable({
            axis: 'y',
            cursor: 'move',            
            update: function(event, ui){
                var order = $(this).sortable("serialize");
                //console.log(order);
                $.ajax({
                    url: url3,
                    type: 'POST',
                    data: order,
                    success: function (data) {
                        // $("#debug").html(data);
                        new PNotify({
                            title: 'Success',
                            text: 'Ordering section-menu succeed.',
                            type: 'success'
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        new PNotify({
                            title: 'Error!',
                            text: 'Ordering section-menu has failed. Why this is happening?',
                            type: 'error'
                        });
                    }
                });
            }
        });

        var updateOutput = function(e)
        {
            //var url13 = '<?php echo site_url("admin/setting/update_menu_priority")?>';
            var list   = e.length ? e : $(e.target), output = list.data('output');

            $.ajax({
                method:'POST',
                url: '<?php echo site_url("admin/setting/update_menu_priority")?>',
                data: {list: list.nestable('serialize')},
                dataType: 'JSON',
                success: function (result) {
                    if (result['status'] == "success") {
                        //console.log(result.responseText);
                        new PNotify({
                            title: 'Success',
                            text: 'Ordering section-menu succeed.',
                            type: 'success'
                        });
                    } else {
                        //console.log(result.responseText);
                        new PNotify({
                            title: 'Error!',
                            text: 'Ordering section-menu has failed. Why this is happening?',
                            type: 'error'
                        });
                    } 
                    
                },
                error: function (jqXHR, textStatus, errorThrown, ex) {
                    //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
                    new PNotify({
                        title: 'Error!',
                        text: 'Ordering section-menu has failed. Why this is happening?',
                        type: 'error'
                    });
                }
            });
        };
        
        $('.dd').nestable({
            maxDepth: 2
        }).on('change', updateOutput);

        $('.dd-handle a').on('mousedown', function(e){
            e.stopPropagation();
        });

    });

    jQuery(function($) {
            
        /* editable form*/
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editableform.loading = "<div class='editableform-loading'></div>";
        $.fn.editableform.buttons = '<button type="submit" class="btn btn-sm btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                                    '<button type="button" class="btn btn-sm editable-cancel"><i class="icon fa fa-times"></i></button>'

        var url_sitename = '<?php echo site_url("admin/setting/update_site_name")?>';
        $('#site_name').editable({
            type: 'text',
            url: url_sitename,  
            name: 'site_name',
            pk: 1,
            title: 'Enter site name',
            success: function (data) {
                //$("#debug").html(data);
                new PNotify({
                    title: 'Success',
                    text: 'Update site name succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update site name has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        var url_sitetitle = '<?php echo site_url("admin/setting/update_site_title")?>';
        $('#site_title').editable({
            type: 'text',
            url: url_sitetitle,  
            name: 'site_title',
            pk: 1,
            title: 'Enter site title',
            success: function (data) {
                //$("#debug").html(data);
                new PNotify({
                    title: 'Success',
                    text: 'Update site title succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update site title has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        var url_meta = '<?php echo site_url("admin/setting/update_meta_description")?>';
        $('#meta_description').editable({
            type: 'textarea',
            url: url_meta,  
            name: 'meta_description',
            pk: 1,
            title: 'Enter meta description',
            success: function (data) {
                //$("#debug").html(data);
                new PNotify({
                    title: 'Success',
                    text: 'Update meta description succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update meta description has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        var url_keyword = '<?php echo site_url("admin/setting/update_meta_keyword")?>';
        $('#meta_keyword').editable({
            type: 'textarea',
            url: url_keyword,  
            name: 'meta_keyword',
            pk: 1,
            title: 'Enter meta keyword',
            success: function (data) {
                //$("#debug").html(data);
                new PNotify({
                    title: 'Success',
                    text: 'Update meta keyword succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update meta keyword has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        var url_scrolltime = '<?php echo site_url("admin/setting/update_scrolltime")?>';
        $('#scroll_time').editable({
            type: 'slider',
            url: url_scrolltime,  
            name: 'scroll_time',
            pk: 1,
            slider: {
                min : 0,
                max: 10000,
                step: 500,
            },
            success: function (data, newValue) {
                //$("#debug").html(data);
                if(parseInt(newValue) == 0){
                    $(this).html(newValue + " ms");
                } else {
                    $(this).html(newValue + " ms");
                }
                new PNotify({
                    title: 'Success',
                    text: 'Update scroll effect succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update scroll effect has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        var url_scrolloffset = '<?php echo site_url("admin/setting/update_scrolloffset")?>';
        $('#scroll_offset').editable({
            type: 'slider',
            url: url_scrolloffset,  
            name: 'scroll_effect',
            pk: 1,
            slider : {
                min : 0,
                max: 100,
                width: 100
                //,nativeUI: true//if true and browser support input[type=range], native browser control will be used
            },

            success: function (data, newValue) {
                //$("#debug").html(data);
                if(parseInt(newValue) == 0){
                    $(this).html(newValue + " px");
                } else {
                    $(this).html(newValue + " px");
                }

                new PNotify({
                    title: 'Success',
                    text: 'Update scroll effect succeed.',
                    type: 'success'
                });
            },
            error: function (jqXHR, textStatus, errorThrown) {
                new PNotify({
                    title: 'Error!',
                    text: 'Update scroll effect has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                //console.log(textStatus + "," + errorThrown + "," + jqXHR.responseText);
            }
        });

        // *** editable logo *** //
        try {//ie8 throws some harmless exceptions, so let's catch'em
            
            //first let's add a fake appendChild method for Image element for browsers that have a problem with this
            //because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
            try {
                document.createElement('IMG').appendChild(document.createElement('B'));
            } catch(e) {
                Image.prototype.appendChild = function(el){}
            }

            var last_gritter
            $('#avatar').editable({
                type: 'image',
                name: 'avatar',
                value: null,
                image: {
                    //specify ace file input plugin's options here
                    btn_choose: 'Change Logo',
                    droppable: true,
                    maxSize: 110000,//~100Kb
            
                    //and a few extra ones here
                    name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                    on_error : function(error_type) {//on_error function will be called when the selected file has a problem
                        if(last_gritter) PNotify.removeAll(last_gritter);
                        if(error_type == 1) {//file format error
                            last_gritter = new PNotify({
                                title: 'File is not an image!',
                                text: 'Please choose a jpg|gif|png image!',
                                type: 'error',
                                addclass: "stack-modal"
                            });
                        } else if(error_type == 2) {//file size rror
                            last_gritter = new PNotify({
                                title: 'File too big!',
                                text: 'Image size should not exceed 100Kb!',
                                type: 'error',
                                addclass: "stack-modal"
                            });
                        }
                        else {//other error
                        }
                    },
                    on_success : function() {
                        PNotify.removeAll();
                    }
                },
                url: function(params) {
                    // ***UPDATE AVATAR HERE*** //
                    //for a working upload example you can replace the contents of this function with 
                    //examples/profile-avatar-update.js
                    //please modify submit_url accordingly

                    // this is what I got from https://github.com/zhuowenji/ace-admin/blob/master/examples/profile-avatar-update.js
                    var submit_url = '<?php echo site_url("admin/setting/update_logo"); ?>';
                    var deferred;

                    //if value is empty, means no valid files were selected
                    //but it may still be submitted by the plugin, because "" (empty string) is different from previous non-empty value whatever it was
                    //so we return just here to prevent problems
                    var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                    if(!value || value.length == 0) {
                        deferred = new $.Deferred
                        deferred.resolve();
                        return deferred.promise();
                    }

                    var $form = $('#avatar').next().find('.editableform:eq(0)')
                    var file_input = $form.find('input[type=file]:eq(0)');

                    //user iframe for older browsers that don't support file upload via FormData & Ajax
                    if( !("FormData" in window) ) {
                        deferred = new $.Deferred

                        var iframe_id = 'temporary-iframe-'+(new Date()).getTime()+'-'+(parseInt(Math.random()*1000));
                        $form.after('<iframe id="'+iframe_id+'" name="'+iframe_id+'" frameborder="0" width="0" height="0" src="about:blank" style="position:absolute;z-index:-1;"></iframe>');
                        $form.append('<input type="hidden" name="temporary-iframe-id" value="'+iframe_id+'" />');
                        $form.next().data('deferrer' , deferred);//save the deferred object to the iframe
                        $form.attr({'method' : 'POST', 'enctype' : 'multipart/form-data',
                                    'target':iframe_id, 'action':submit_url});

                        $form.get(0).submit();

                        //if we don't receive the response after 60 seconds, declare it as failed!
                        setTimeout(function(){
                            var iframe = document.getElementById(iframe_id);
                            if(iframe != null) {
                                iframe.src = "about:blank";
                                $(iframe).remove();
                                
                                deferred.reject({'status':'fail','message':'Timeout!'});
                            }
                        } , 60000);
                    }
                    else {
                        var fd = null;
                        try {
                            fd = new FormData($form.get(0));
                        } catch(e) {
                            //IE10 throws "SCRIPT5: Access is denied" exception,
                            //so we need to add the key/value pairs one by one
                            fd = new FormData();
                            $.each($form.serializeArray(), function(index, item) {
                                fd.append(item.name, item.value);
                            });
                            //and then add files because files are not included in serializeArray()'s result
                            $form.find('input[type=file]').each(function(){
                                if(this.files.length > 0) fd.append(this.getAttribute('name'), this.files[0]);
                            });
                        }
                        
                        //if file has been drag&dropped , append it to FormData
                        if(file_input.data('ace_input_method') == 'drop') {
                            var files = file_input.data('ace_input_files');
                            if(files && files.length > 0) {
                                fd.append(file_input.attr('name'), files[0]);
                            }
                        }

                        deferred = $.ajax({
                            url: submit_url,
                            type: 'POST',
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            data: fd,
                            xhr: function() {
                                var req = $.ajaxSettings.xhr();
                                return req;
                            },
                            success : function() {
                                new PNotify({
                                    title: 'Success!',
                                    text: 'Update site logo succeed.',
                                    type: 'success'
                                });
                            },
                            error : function(jqXHR, textStatus, errorThrown) {
                            }
                        })
                    }
                    deferred.done(function(res){
                        if(res.status == 'TRUE'){
                            var id = '1';
                            get_logo(id);
                        } 
                        else {
                            console.log(res.message);
                            var id = '1';
                            get_logo(id);
                        }
                    }).fail(function(res){
                        alert("Failure");
                    });
                    return deferred.promise();
                },
                success: function(response, newValue) {
                }
            })
        }catch(e) {}
    })
</script>