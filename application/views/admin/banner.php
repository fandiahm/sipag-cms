<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <p>
            <button class="btn btn-flat btn-info" onclick="add_banner()" title="Add new banner">
                <i class="icon fa fa-plus"></i> quick add banner
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
                    <th>Header</th>
                    <th>Caption</th>
                    <th style="width:50px;text-align:center;">Image</th>
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
 
    $(document).ready(function() {
    
        //datatables
        table = $('#table').DataTable({ 
            "aoColumns": [null, null, null,{ "bSortable": false }],
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/banner/banner_list')?>",
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
     
        //set input/textarea/select event when change value, remove class error and remove text help block 
        $("input").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("textarea").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });
        $("select").change(function(){
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
        });

    });
     
    function add_banner()
    {
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add Banner'); 
        $('#id-input-file-3').val('');
     
        $('#image-preview').hide(); 
     
        $('#label-image').text('Upload Image'); 
        $('#btnSave').attr('onclick', 'save()'); 
    }
     
    function edit_banner(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 

        $('#btnSave').attr('onclick', 'update()'); 
     
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/banner/banner_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
     
                $('[name="id"]').val(data.banner_id);
                $('[name="header"]').val(data.header);
                $('[name="caption"]').val(data.caption);
                $('#modal_form').modal('show'); 
                $('#id-input-file-3').val('');
                $('.modal-title').text('Edit Banner'); 
     
                $('#image-preview').show(); 
     
                if(data.image)
                {
                    $('#label-image').text('Change Image'); 
                    $('#image-preview div').html('<img src="'+base_url+''+data.image+'" class="img-responsive">'); 
                    $('#image-preview div').append('<input type="checkbox" name="remove_image" value="'+data.image+'"/> Remove image when saving'); 
     
                }
                else
                {
                    $('#label-image').text('Upload Image'); 
                    $('#image-preview div').text('(No Image)');
                }
     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
     
    function reload_table()
    {
        table.ajax.reload(null,false); 
    }
     
    function save()
    {
        if ($("#form").valid()) 
        {
            $('#btnSave').text('saving...'); 
            $('#btnSave').attr('disabled',true); 
            var url;
         
            if(save_method == 'add') {
                url = "<?php echo site_url('admin/banner/banner_add')?>";
                msg = "New banner has been added.";
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
                success: function(data)
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
                            title: 'Error',
                            text: 'Please check your connection or reload page.',
                            type: 'error'
                        });
                    }
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false); 
         
         
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    new PNotify({
                        title: 'Error',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                    $('#btnSave').text('save'); 
                    $('#btnSave').attr('disabled',false); 
         
                }
            });
        }
    }

    function update()
    {
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true); 
        var update_url;
         
        if(save_method == 'update') {
            update_url = "<?php echo site_url('admin/banner/banner_update')?>";
            msg = "Banner has been updated.";
        }

        var formData = new FormData($('#form')[0]);
        $.ajax({
            url : update_url,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(data)
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
                    console.log(data.responseText);
                }
                else
                {
                    new PNotify({
                        title: 'Error',
                        text: 'Please check your connection or reload page.',
                        type: 'error'
                    });
                    console.log(data.responseText);
                }
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            },
            error: function (data, jqXHR, textStatus, errorThrown)
            {
                new PNotify({
                    title: 'Error',
                    text: 'Please check your connection or reload page.',
                    type: 'error'
                });
                console.log(data.responseText);
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 
            }
        });
    }

    function delete_banner(id)
    {
        bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete banner?",
            message: "<div class='alert alert-info'>This banner will be permanently deleted.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                        url : "<?php echo site_url('admin/banner/banner_delete')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                            new PNotify({
                                title: 'Success',
                                text: 'Selected banner successfully deleted.',
                                type: 'success'
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            //alert('Error deleting data');
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
            rel: 'banner',
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

        $('.banner').colorbox(colorbox_params);
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
                <h3 class="modal-title">Banner Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Header</label>
                            <div class="col-md-9">
                                <input name="header" placeholder="Header" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Caption</label>
                            <div class="col-md-9">
                                <input name="caption" placeholder="Caption" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="image-preview">
                            <label class="control-label col-md-3">Image</label>
                            <div class="col-md-9">
                                (No Image)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3" id="label-image">Upload Image </label>
                            <div class="col-md-9">
                                <input name="image" type="file" id="id-input-file-3">
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<script>
    jQuery(function($) {
        /* validation form */
        $('#form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                image: {
                    required: true,
                }
            },
            messages: {
                image: {
                    required: "Please insert image of banner."
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
                if(element.is('#id-input-file-3')) {
                    error.insertAfter(element.siblings('[class*="ace-file-container"]:eq(0)'));
                }
                else error.insertAfter(element.siblings('[class*="help-block"]:eq(0)'));
            },
            
            //submitHandler: function (form) {},
            invalidHandler: function (form, validator) {
                if (!validator.numberOfInvalids())
                    return;

                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).focus()
                }, 2000);
            }
        });
        /* upload image */
        $('#id-input-file-3').ace_file_input({
            style:'well',
            btn_choose:'Drop files here or click to choose',
            btn_change:null,
            no_icon:'icon fa fa-cloud-upload',
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
                        $('#id-input-file-3').ace_file_input("reset_input");
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
                        $('#id-input-file-3').ace_file_input("reset_input");
                    }
                    if( file.size > 110000 ) {//~100Kb
                        file = new PNotify({
                            title: 'File too big!',
                            text: 'Image size should not exceed 100Kb!',
                            type: 'error',
                            addclass: "stack-modal"
                        });
                        $('#id-input-file-3').ace_file_input("reset_input");
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

        $('#modal_form').on('hidden.bs.modal', function (e) {
            $('#id-input-file-3').ace_file_input("reset_input");
        });
    })
</script>
