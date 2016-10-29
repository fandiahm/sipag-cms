<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box">
	<div class="box-header">
		<p>
			<button class="btn btn-flat btn-info" onclick="add_theme()" title="Add new theme">
		        <i class="icon fa fa-plus"></i> add new theme
		    </button>
		    <button class="btn btn-flat btn-success" onclick="reload_table()" title="Refresh">
		        <i class="icon fa fa-refresh"></i> refresh
		    </button>
	    </p>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
		    <thead>
		        <tr>
		            <th>Theme name</th>
		            <th>File directory</th>
		            <th style="text-align:center;">Thumbnail</th>
		            <th>Tools</th>
		        </tr>
		    </thead>
		    <tbody>
		    </tbody>
		</table>
	</div>
</div>

<script type="text/javascript">
 
    var save_method; //for save method string
    var table;
    var base_url = '<?php echo base_url();?>';

    PNotify.prototype.options.styling = "bootstrap3";
    PNotify.prototype.options.delay = 3000;
 
    $(document).ready(function() {
    
        //datatables
        table = $('#table').DataTable({ 
            "aoColumns": [null, null, null,{ "bSortable": false }],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/theme/theme_list'); ?>",
                "type": "POST"
            },
     
            //Set column definition initialisation properties.
            "columnDefs": [
                { 
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
                { 
                    "targets": [ -2 ], //2 last column (photo)
                    "orderable": false, //set not orderable
                },
            ],
     
        });
    
    });

    function add_theme()
    {
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add New Theme'); 
     
        $('#image-preview').hide(); 
     
        $('#label-image').text('Upload Image'); 
    }

    function edit_theme(id)
    {
        save_method = 'update';
        $('#form-edit')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty();
     
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/theme/theme_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data, textStatus, jqXHR, ex)
            {
                
                $('[name="id"]').val(data.theme_id);
                $('[name="theme_name_hidden"]').val(data.theme_name);
                $('#theme-name').text(data.theme_name);
                $('#theme-file').text(data.theme_style);
                
                $('#modal-form-update').modal('show'); 
                $('img.theme-thumbnail').show();
                $('label.label-thumbnail').show();
     
                if(data.theme_thumbnail)
                {
                    var img_url = ''+base_url+''+data.theme_thumbnail+'';
                    $('img.theme-thumbnail').attr('src', img_url);
                    $('label.label-thumbnail').hide();
                }
                else
                {
                    $('img.theme-thumbnail').hide();
                    $('label.label-thumbnail').show();
                }
                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax 
    }
     
    function save()
    {
        if ($("#form").valid()) 
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;
         
            if(save_method == 'add') {
                url = "<?php echo site_url('admin/theme/theme_add')?>";
                msg = "New theme has been added.";
            }
         
            // ajax adding data to database
         
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data, textStatus, ex, jqXHR)
                {
         
                    if(data.status) 
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                        new PNotify({
							title: 'Success',
							text: msg,
							type: 'success'
						});
                    }
                    else
                    {
                        new PNotify({
							title: 'Error!',
							text: 'Adding new theme has failed. Please check your connection or reload page.',
							type: 'error'
						});
                        //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                    }
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false);
         
         
                },
                error: function (jqXHR, textStatus, errorThrown, ex)
                {
                    new PNotify({
						title: 'Error!',
						text: 'Adding new theme has failed. Please check your connection or reload page.',
						type: 'error'
					});
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                    //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                }
            });
        }
    }

    function update()
    {
        $('#btnUpdate').text('updating...'); 
        $('#btnUpdaet').attr('disabled',true);  
        var url_update;
         
        if(save_method == 'update') {
            url_update = "<?php echo site_url('admin/theme/theme_update/')?>";
            msg_update = "Theme has been updated.";
        }

        var formData = new FormData($('#form-edit')[0]);
        $.ajax({
            url : url_update,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data, textStatus, jqXHR, ex)
            {
         
                if(data.status) 
                {
                    $('#modal-form-update').modal('hide');
                    reload_table();
                    new PNotify({
						title: 'Success',
						text: msg_update,
						type: 'success'
					});
                }
                else
                {
                    new PNotify({
						title: 'Error!',
						text: 'Update theme has failed. Please check your connection or reload page.',
						type: 'error'
					});
                }
                $('#btnUpdate').text('Update'); 
                $('#btnUpdate').attr('disabled',false); 
                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
            },
            error: function (jqXHR, textStatus, errorThrown, ex)
            {
                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                new PNotify({
                    title: 'Error!',
                    text: 'Update theme has failed. Please check your connection or reload page.',
                    type: 'error'
                });
                $('#btnUpdate').text('Update'); 
                $('#btnUpdate').attr('disabled',false);
         
            }
        });
        
    }

    function delete_theme(id)
    {
        bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete theme?",
            message: "<div class='alert alert-info'>Deleting theme will also delete its folder and files permanently.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
            size: 'small',
            buttons: {
                cancel: {
                    label: '<i class="icon fa fa-times"></i> Cancel',
                    className: 'btn-default'
                },
                confirm: {
                    label: '<i class="icon fa fa-trash"></i> Delete',
                    className: 'btn-danger'
                }
            },
            callback: function (data){
                if(data) 
                {
                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('admin/theme/delete_theme')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            reload_table();
                            new PNotify({
								title: 'Success',
								text: 'Selected theme successfully deleted.',
								type: 'success'
							});
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            new PNotify({
								title: 'Error!',
								text: 'Please check your connection or reload page.',
								type: 'error'
							});
                        }
                    });
                }
            }
        });
    }

    function colorbox()
    {
        var $overflow = '';
        var colorbox_params = {
            rel: 'theme-colorbox',
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

        $('.theme-colorbox').colorbox(colorbox_params);
        $("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
        
        $(document).one('ajaxloadstart.page', function(e) {
            $('#colorbox, #cboxOverlay').remove();
       });
    }

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Add New Theme</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Theme name</label>
                            <div class="col-md-8">
                                <input id="theme_name1" name="theme_name" placeholder="Theme name" class="form-control" type="text" maxlength="50">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Theme file</label>
                            <div class="col-md-8">
                                <input name="theme_file" type="file" class="id-input-file-2">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-image">Thumbnail </label>
                            <div class="col-md-8">
                                <input name="theme_thumbnail" type="file" class="id-input-file-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-info">Save</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-form-update" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Update Theme</h4>
            </div>

            <div class="modal-body form" style="padding-top:0;">
                <div class="row preview-theme">
                    <div class="col-xs-12 col-sm-5">
                        <img src="" class="img-responsive theme-thumbnail">
                        <label class="label-thumbnail">
                            <span class="red">Empty default thumbnail</span>
                        </label>
                    </div>
                    <div class="col-xs-12 col-sm-7">
                        <dl>
                            <dt>Theme name</dt>
                            <dd id="theme-name"></dd>
                            <dt>Theme file directory</dt>
                            <dd id="theme-file"></dd>
                        </dl>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <form action="#" id="form-edit" class="form-horizontal">
                        <input type="hidden" value="" name="id"/> 
                        <input type="hidden" value="" name="theme_name_hidden"/> 
                        <div class="form-group">
                            <label class="control-label col-md-3">Update CSS</label>
                            <div class="col-md-8">
                                <input name="update_file" type="file" class="id-input-file-2">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-thumbnail">Update thumbnail </label>
                            <div class="col-md-8">
                                <input name="update_thumbnail" type="file" class="id-input-file-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnUpdate" onclick="update()" class="btn btn-info">Update</button>
                <button type="button" class="btn" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- End Bootstrap modal -->

<script>
    jQuery(function($) {
        /* validation form */
        var url_val = '<?php echo site_url("admin/theme/isThemeExist")?>';
        $('#form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: true,
            ignore: '',
            rules: {
                theme_name: {
                    required: true,
                    remote: {
                        url: url_val,
                        type: 'POST',
                        data: {
                            theme_name: function() {
                                return $("#theme_name1").val();
                            }
                        }
                    }
                },
                theme_file: {
                    required: true,
                },
                theme_thumbnail: {
                    required: true,
                }
            },
            messages: {
                theme_name: {
                    required: "Please insert theme name.",
                    remote: "Theme name is already in use."
                },
                theme_file: {
                    required: "Please insert css file."
                },
                theme_thumbnail: {
                    required: "Please insert a screenshot theme."
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
                if(element.is('.id-input-file-3')) {
                    error.insertAfter(element.siblings('[class*="ace-file-container"]:eq(0)'));
                } else if(element.is('.id-input-file-2')) {
                    error.insertAfter(element.siblings('[class*="ace-file-container"]:eq(0)'));
                }
                else error.insertAfter(element.siblings('[class*="help-block"]:eq(0)'));
            },
            
            //submitHandler: function (form) {},
            invalidHandler: function (form, validator) {
            }
        });

        $('#theme_name1').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9']+$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        /* Upload css file */
        $('.id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false,
            before_change:function(files, dropped) {
                var file = files[0];
                if(typeof file == "string") {
                    if(! (/\.(css)$/i).test(file) ) {
                        file = new PNotify({
						    title: 'File is empty!',
						    text: 'Please choose a CSS file!',
						    type: 'error'
						});
                        $('.id-input-file-2').val('');
                    }
                } else {
                    var type = $.trim(file.type);
                    if( ( type.length > 0 && ! (/\/(css)$/i).test(type) )
                    || ( type.length == 0 && ! (/\.(css)$/i).test(file.name) )
                    ) {
                        file = new PNotify({
						    title: 'File is not CSS!',
						    text: 'Please choose a CSS file!',
						    type: 'error'
						});
                        $('.id-input-file-2').val('');
                    }
                    if( file.size > 11000000 ) {
                        file = new PNotify({
						    title: 'File too big!',
						    text: 'File size should not exceed 10Mb!',
						    type: 'error'
						});
                        $('.id-input-file-2').val('');
                    }
                }
            
                return true;
            }
            ,before_remove : function() {
                return true;
            }
            ,
            preview_error : function(filename, error_code) {
                alert(error_code);
            }
        });

        /* upload image */
        $('.id-input-file-3').ace_file_input({
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
                        $('.id-input-file-3').val('');
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
                        $('.id-input-file-3').val('');
                    }
                    if( file.size > 110000 ) {//~100Kb
                        file = new PNotify({
						    title: 'File too big!',
						    text: 'Image size should not exceed 100Kb!',
						    type: 'error',
						    addclass: "stack-modal"
						});
                        $('.id-input-file-3').val('');
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

        /* regex theme_name */
        $('#theme_name').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z0-9_]*$");
            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
                return true;
            }
            e.preventDefault();
            return false;
        });

        $('#modal_form').on('hidden.bs.modal', function (e) {
            $('.id-input-file-2').ace_file_input("reset_input");
            $('.id-input-file-3').ace_file_input("reset_input");
        });

        $('#modal-form-update').on('hidden.bs.modal', function (e) {
            $('.id-input-file-2').ace_file_input("reset_input");
            $('.id-input-file-3').ace_file_input("reset_input");
        });
    })
</script>