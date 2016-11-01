<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $folder_name = explode('/', $_SERVER['REQUEST_URI'])[1]; ?>

<div id="debug"></div>

<div class="row">
	<div class="col-md-3">
		<div class="box box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Folders</h3>
				<div class="box-tools">
					<button type="button" class="btn btn-box-tool" data-widget="collapse">
						<i class="fa fa-minus"></i>
					</button>
				</div>
			</div>
			<div class="box-body no-padding">
				<ul class="nav nav-pills nav-stacked">
					<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-inbox"></i> Inbox</a></li>
					<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-envelope-o"></i> Sent</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col-md-9">
		<div class="tab-content">
			<div class="tab-pane active" id="tab_1">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Inbox</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-sm checkbox-toggle-inbox">
								<i class="fa fa-square-o"></i>
							</button>
							<button type="button" onclick="delete_multiple_inbox()" class="btn btn-default btn-sm">
								<i class="fa fa-trash-o"></i>
							</button>
							<button type="button" onclick="reload_table()" class="btn btn-default btn-sm">
								<i class="fa fa-refresh"></i>
							</button>
						</div>
					</div>
					<div class="box-body inbox-messages">
						<table id="myTable" class="table table-striped table-hover" cellspacing="0" width="100%">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_2">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Sent</h3>
						<div class="pull-right">
							<button type="button" class="btn btn-default btn-sm checkbox-toggle-sent">
								<i class="fa fa-square-o"></i>
							</button>
							<button type="button"  onclick="delete_multiple_sent()" class="btn btn-default btn-sm">
								<i class="fa fa-trash-o"></i>
							</button>
							<button type="button" onclick="reload_table()" class="btn btn-default btn-sm">
								<i class="fa fa-refresh"></i>
							</button>
						</div>
					</div>
					<div class="box-body sent-messages">
						<table id="myTable2" class="table table-striped table-hover" cellspacing="0" width="100%">
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

	var oTable1;
	var oTable2;

	PNotify.prototype.options.styling = "bootstrap3";

	$(document).ready(function() {
		oTable1 = $('#myTable').dataTable({
			bAutoWidth: false,
			"aoColumns": [{ "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false }],
			"aaSorting": [],
			"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/messages/msg_list')?>",
                "type": "POST",
                error: function (jqXHR, textStatus, errorThrown, ex)
	            {
	                //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	                new PNotify({
					    title: 'Error!',
					    text: 'Please check your connection or reload page.',
					    type: 'error'
					});
	            }
            },
		});

		oTable2 = $('#myTable2').dataTable({
			bAutoWidth: false,
			"aoColumns": [{ "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false }, { "bSortable": false }],
			"aaSorting": [],
			"processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.
     
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('admin/messages/msg_sent')?>",
                "type": "POST",
                error: function (jqXHR, textStatus, errorThrown, ex)
	            {
	                //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	                new PNotify({
					    title: 'Error!',
					    text: 'Please check your connection or reload page.',
					    type: 'error'
					});
	            }
            },
		});
	});

	function reload_table()
    {
        oTable1.api().ajax.reload(null,false);
        oTable2.api().ajax.reload(null,false);
    }

    function open_msg(id)
	{
	    $('#form')[0].reset();
	    $('#form').hide();
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $('#btnSend').hide(); 
        $('#btnCancel').hide(); 
        $('#btnReply').show(); 
        $('#btnClose').show();
	 
	    $.ajax({
	        url : "<?php echo site_url('admin/messages/get_msg')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data, textStatus, jqXHR, ex)
	        {
	            $('[name="id"]').val(data.msg_id);
	            $('[name="email"]').val(data.email);
	            $('#sender').text(data.name);
	            $('#email_sender').text(data.email);
	            $('#content_msg').text(data.msg_text);

	            $('#modal_form').modal('show');
				$('.modal-title').text('Open message');

				var fpath   = '<?php print($folder_name)?>';

				tinymce.init({
		            selector: 'textarea',
		            height: 50,
		            theme: 'modern',
		            relative_urls:false,
		            plugins: [
		                'link image paste textcolor colorpicker imagetools',
		            ],
		            toolbar1: 'fullscreen undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent forecolor backcolor',
		            image_advtab: true,
		            automatic_uploads: true,
		            setup: function (editor) {
				        editor.on('change', function () {
				            editor.save();
				        });
				    }
		        });

				$('#btnSend').hide(); 
                $('#btnCancel').hide(); 

                $('#btnReply').on('click', function(){
	               	$('#form').show();
	               	$('.modal-title').text('Reply message');
	               	$('#modal_form').find('.modal-body').css({
		            	width:'auto', //probably not needed
		              	height:'auto', //probably not needed 
		              	'max-height':'100%'
		       		});

	               	$('#btnSend').show(); 
	               	$('#btnCancel').show(); 
	                $('#btnReply').hide(); 
	                $('#btnClose').hide(); 
                });

                $('#btnCancel').on('click', function(){
                	$('#form').hide();
                	$('.modal-title').text('Open message');

                	$('#btnSend').hide(); 
                	$('#btnCancel').hide(); 
                	$('#btnReply').show(); 
                	$('#btnClose').show();
                })

                $.ajax({
			        url : "<?php echo site_url('admin/messages/read_msg')?>/" + id,
			        type: "POST",
			        dataType: "JSON"
			    })

	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	        },
	        error: function (jqXHR, textStatus, errorThrown, ex)
	        {
	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	            new PNotify({
					title: 'Error!',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
	        }
	    });
	}

	function open_sent(id)
	{
	 	$('#send_to').text('');
	    $('#subject_send').text('');
	    $('#msg_send').html('').text();
	    $('#date_send').text('');
	    $('#sender2').text('');
	    $('#email_sender2').text('');
	    $('#content_msg2').text('');
	    $('#date_recieve').text('');
	    $.ajax({
	        url : "<?php echo site_url('admin/messages/get_sent')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data, textStatus, jqXHR, ex)
	        {
	        	//var content = $('<dd />').html(data.msg_send).text();

	            $('#send_to').text(data.send_to);
	            $('#subject_send').text(data.subject_send);
	            $('#msg_send').html(data.msg_send).text();
	            $('#date_send').text(data.date_send);
	            $('#sender2').text(data.name);
	            $('#email_sender2').text(data.email);
	            $('#content_msg2').text(data.msg_text);
	            $('#date_recieve').text(data.date);

	            $('#modal_sent').modal('show');
	        },
	        error: function (jqXHR, textStatus, errorThrown, ex)
	        {
	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	            new PNotify({
					title: 'Error!',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
	        }
	    });
	}

	function reply(id)
	{
		$('#form')[0].reset();
	    $('#form').show();
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	    $('#btnSend').show(); 
        $('#btnCancel').hide(); 
        $('#btnReply').hide(); 
        $('#btnClose').show();

        $.ajax({
			url : "<?php echo site_url('admin/messages/read_msg')?>/" + id,
			type: "POST",
			dataType: "JSON"
		});
	 
	    $.ajax({
	        url : "<?php echo site_url('admin/messages/get_msg')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data, textStatus, jqXHR, ex)
	        {
	            $('[name="id"]').val(data.msg_id);
	            $('[name="email"]').val(data.email);
	            $('#sender').text(data.name);
	            $('#email_sender').text(data.email);
	            $('#content_msg').text(data.msg_text);

	            $('#modal_form').modal('show');
				$('.modal-title').text('Open message');

				var fpath   = '<?php print($folder_name)?>';

				tinymce.init({
		            selector: 'textarea',
		            height: 50,
		            theme: 'modern',
		            relative_urls:false,
		            plugins: [
		                'link image paste textcolor colorpicker imagetools',
		            ],
		            toolbar1: 'fullscreen undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent forecolor backcolor',
		            image_advtab: true,
		            automatic_uploads: true,
		            setup: function (editor) {
				        editor.on('change', function () {
				            editor.save();
				        });
				    }
		        });

	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	        },
	        error: function (jqXHR, textStatus, errorThrown, ex)
	        {
	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	            new PNotify({
					title: 'Error!',
					text: 'Please check your connection or reload page.',
					type: 'error'
				});
	        }
	    });
	}

	function send()
	{
	    $('#btnSend').text('Sending...'); //change button text
	    $('#btnCancel').attr('disabled',true); //set button disable 
	    
	    var url;

	    url = "<?php echo site_url('admin/messages/send_msg')?>";

	    // ajax adding data to database
	 
	    var formData = new FormData($('#form')[0]);
	    $.ajax({
	        url : url,
	        type: "POST",
	        data: formData,
	        contentType: false,
	        processData: false,
	        dataType: "JSON",
	        success: function(data, jqXHR, textStatus, errorThrown, ex)
	        {
	 
	            if(data.status) //if success close modal and reload ajax table
	            {
	                $('#modal_form').modal('hide');
	                $('#modal_form').on('hidden.bs.modal', function (e) {
	        			// need to remove the editor to make it work the next time
	        			tinymce.remove();
					});

	                new PNotify({
						title: 'Success!',
						text: 'Message has been sent.',
						type: 'success'
					});
	            }
	            else
	            {
	             	//console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	             	new PNotify({
						title: 'Error!',
						text: 'Please setup your gmail account to use this feature.',
						type: 'error'
					});
	            }
	            $('#btnSend').text('Send'); //change button text
	            $('#btnCancel').attr('disabled',false); //set button enable 

	        },
	        error: function (jqXHR, textStatus, errorThrown, ex)
	        {
	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	            new PNotify({
					title: 'Error!',
					text: 'You may need to check your Gmail SMTP Configuration, because its given wrong data. Otherwise, check your connection or reload page.',
					type: 'error'
				});
	            $('#btnSend').text('Send');
	            $('#btnSend').attr('disabled',false); 
	 
	        }
	    });
	}

	function delete_inbox(id)
	{
		bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete message?",
            message: "<div class='alert alert-info'>This message will be permanently deleted.</div>"+
            "<p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                        url : "<?php echo site_url('admin/messages/delete_inbox')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                            new PNotify({
								title: 'Success',
								text: 'Selected message successfully deleted.',
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

	function delete_multiple_inbox()
	{
		bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete message?",
            message: "<div class='alert alert-info'>Selected messages will be permanently deleted.</div>"+
            "<p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                	selected_inbox = new Array();
        			i = 0;
        			$("input.inbox:checked").each(function(){
            			selected_inbox[i] = $(this).val();
            			i++;
        			})

                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('admin/messages/delete_multiple_inbox')?>",
                        type: "POST",
                        data: {id: selected_inbox},
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                            new PNotify({
								title: 'Success',
								text: 'All checked messages successfully deleted.',
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

	function delete_sent(id)
	{
		bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete message?",
            message: "<div class='alert alert-info'>This message will be permanently deleted.</div>"+
            "<p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                        url : "<?php echo site_url('admin/messages/delete_sent')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                            new PNotify({
								title: 'Success',
								text: 'Selected message successfully deleted.',
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

	function delete_multiple_sent()
	{
		bootbox.confirm({
            title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete message?",
            message: "<div class='alert alert-info'>Selected messages will be permanently deleted.</div>"+
            "<p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
                	selected_sent = new Array();
        			i = 0;
        			$("input.sent:checked").each(function(){
            			selected_sent[i] = $(this).val();
            			i++;
        			})
                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('admin/messages/delete_multiple_sent')?>",
                        type: "POST",
                        data: {id: selected_sent},
                        dataType: "JSON",
                        success: function(data)
                        {
                            //if success reload ajax table
                            reload_table();
                            new PNotify({
								title: 'Success',
								text: 'Selected messages successfully deleted.',
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

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Open message</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                    	<div class="form-group">
                            <label class="control-label col-md-2">Send to</label>
                            <div class="col-md-10">
                                <input name="email" class="form-control" type="email" readonly="readonly">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Subject</label>
                            <div class="col-md-10">
                                <input name="subject" placeholder="" class="form-control" type="text" maxlength="100">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Messages</label>
                            <div class="col-md-10">
                                <textarea name="msg_text" id="editor1" class="form-control"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="hr hr-dotted"></div>
                    </div>
                </form>
                <dl class="dl-horizontal">
                	<dt>From</dt>
                	<dd><span id="sender"></span>, <span id="email_sender" class="blue"></span></dd>
                	<dt>Message</dt>
                	<dd id="content_msg"></dd>
                </dl>
                <div class="hr hr-dotted"></div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btnSend" onclick="send()" class="btn btn-info">Send</button>
                <button type="button" id="btnCancel" class="btn">Cancel</button>
                <button type="button" id="btnReply" class="btn btn-info">Reply</button>
                <button type="button" id="btnClose" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_sent" role="dialog">
    <div class="modal-dialog modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Message sent</h3>
            </div>
            <div class="modal-body form">
                <dl class="dl-horizontal">
                	<dt>Date</dt>
                	<dd id="date_send"></dd>
                	<dt>To</dt>
                	<dd><span id="send_to" class="blue"></span></dd>
                	<dt>Subject</dt>
                	<dd id="subject_send"></dd>
                	<dt>Message</dt>
                	<dd id="msg_send"></dd>
                </dl>
                <div class="hr hr-dotted hr-double"></div>
                <h4>Reply messages for : </h4>
                <dl class="dl-horizontal">
                	<dt>Date</dt>
                	<dd id="date_recieve"></dd>
                	<dt>From</dt>
                	<dd><span id="sender2"></span>, <span id="email_sender2" class="blue"></span></dd>
                	<dt>Message</dt>
                	<dd id="content_msg2"></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnClose" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap modal -->

<script>
    jQuery(function($) {
    	$('#myTable').on('draw.dt', function () {
    		$('.inbox-messages input[type="checkbox"]').iCheck({
	    		checkboxClass: 'icheckbox_flat-blue',
	    		radioClass: 'iradio_flat-blue'
	    	});
    	});

    	$('#myTable2').on('draw.dt', function () {
    		$('.sent-messages input[type="checkbox"]').iCheck({
	    		checkboxClass: 'icheckbox_flat-blue',
	    		radioClass: 'iradio_flat-blue'
	    	});
    	});
    	
    	$(".checkbox-toggle-inbox").click(function () {
    		var clicks = $(this).data('clicks');
    		if (clicks) {
    			//Uncheck all checkboxes
    			$(".inbox-messages input[type='checkbox']").iCheck("uncheck");
    			$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    		} else {
    			//Check all checkboxes
    			$(".inbox-messages input[type='checkbox']").iCheck("check");
    			$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    		}
    		$(this).data("clicks", !clicks);
    	});

		$(".checkbox-toggle-sent").click(function () {
    		var clicks = $(this).data('clicks');
    		if (clicks) {
    			//Uncheck all checkboxes
    			$(".sent-messages input[type='checkbox']").iCheck("uncheck");
    			$(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
    		} else {
    			//Check all checkboxes
    			$(".sent-messages input[type='checkbox']").iCheck("check");
    			$(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
    		}
    		$(this).data("clicks", !clicks);
    	});  

    	$('#modal_form').on('hidden.bs.modal', function (e) {
	        // need to remove the editor to make it work the next time
	        tinymce.remove();
		});  	
    	
    })
</script>