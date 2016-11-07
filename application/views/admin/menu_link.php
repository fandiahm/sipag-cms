<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box">
    <div class="box-header">
        <p>
            <button class="btn btn-flat btn-info" onclick="add_menu()" title="Add new menu">
                <i class="icon fa fa-plus"></i> quick add menu
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
                    <th>Menu name</th>
                    <th>Menu Url</th>
                    <th>Menu target</th>
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
                "url": "<?php echo site_url('admin/menu/menu_list')?>",
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

    function add_menu()
    {
        save_method = 'add';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 

        $('#modal_form').modal('show'); 
        $('.modal-title').text('Add Menu'); 
    }

    function edit_menu(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); 
        $('.form-group').removeClass('has-error'); 
        $('.help-block').empty(); 
     
        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('admin/menu/menu_edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
     
                $('[name="menu_id"]').val(data.menu_id);
                $('[name="menu_name"]').val(data.menu_name);
                $('[name="menu_url"]').val(data.menu_url);
                $('[name="menu_target"]').val(data.menu_target);

                $('#modal_form').modal('show');
                $('.modal-title').text('Edit Menu'); 
     
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
                url = "<?php echo site_url('admin/menu/menu_add')?>";
                msg = "New menu has been added.";
            } else {
                url = "<?php echo site_url('admin/menu/menu_update')?>";
                msg = "Update menu is succcess.";
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

    function delete_menu(id)
    {
        bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete menu?",
            message: "<div class='alert alert-info'>This menu will be permanently deleted.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                        url : "<?php echo site_url('admin/menu/menu_delete')?>/"+id,
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

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Menu Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="menu_id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Menu name</label>
                            <div class="col-md-9">
                                <input name="menu_name" placeholder="Type menu name..." class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Menu url</label>
                            <div class="col-md-9">
                                <input name="menu_url" placeholder="example. http://sipag-cms.com/" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Menu target</label>
                            <div class="col-md-9">
                                <select name="menu_target" class="form-control">
                                    <option value="_self">_self</option>
                                    <option value="_blank">_blank</option>
                                </select>
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
            focusInvalid: true,
            ignore: "",
            rules: {
                menu_name: {
                    required: true,
                },
                menu_url: {
                    required: true,
                }
            },
            messages: {
                menu_name: {
                    required: "Please insert menu name."
                },
                menu_url: {
                    required: "Please insert menu url."
                },
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
            }
        });
    })
</script>
