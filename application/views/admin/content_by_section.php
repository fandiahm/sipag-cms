<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $folder_name = explode('/', $_SERVER['REQUEST_URI'])[1]; ?>

<p>
    <button class="btn btn-flat btn-info" onclick="add_content()" title="Add new content">
        <i class="icon fa fa-plus"></i> quick add content
    </button>
    <button class="btn btn-flat btn-success" onclick="reload_table()" title="Refresh">
        <i class="icon fa fa-refresh"></i> refresh
    </button>
    <a href="<?php echo base_url(); ?>admin/content" class="btn btn-flat btn-default pull-right" title="Go to content list">
        all content <i class="icon fa fa-share"></i>
    </a>
</p>

<div class="box">
	<div class="box-header">
		<?php $first = TRUE; ?>
		<?php foreach($content_list->result() as $row): ?>
			<?php if($first): ?>
				Content list for "<?php echo $row->section_name;?>" section.
				<?php $first = FALSE; ?>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
	<div class="box-body">
		<table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Section name</th>
		            <th>Title</th>
		            <th style="width:50px;text-align:center;">Image</th>
		            <th>Content</th>
		            <th>Animation</th>
		            <th>Tools</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
 
	var save_method; //for save method string
	var table;
	var base_url = '<?php echo base_url();?>';
	var id = '<?php echo $this->uri->segment(4);?>';
	var url = "<?php echo site_url('admin/section/get_content')?>/" + id;

	/* PNotify style */
	PNotify.prototype.options.styling = "bootstrap3";

	$(document).ready(function() {
	    //datatables
	    table = $('#table').DataTable({ 
	        "aoColumns": [null, null, null, null, null, { "bSortable": false }],
	        "processing": true, //Feature control the processing indicator.
	        "serverSide": true, //Feature control DataTables' server-side processing mode.
	        "responsive": true,
	        "order": [], //Initial no order.
	 
	        // Load data for the table's content from an Ajax source
	        "ajax": {
	            "url": url,
	            "type": "POST",
	            error: function (jqXHR, textStatus, errorThrown, ex)
	            {
	                //alert('Error');
	                //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
			        new PNotify({
						title: 'Error!',
						text: 'Please check your connection or reload page.',
					    type: 'error'
					});
	            }
	        },
	 
	        //Set column definition initialisation properties.
	        "columnDefs": [
	            { 
	                "targets": [ -1 ], //last column
	                "orderable": false, //set not orderable
	            },
	            { 
	                "targets": [ -4 ], //2 last column (photo)
	                "orderable": false, //set not orderable
	            },
	        ],
	    })
 
    });

	function add_content()
	{
		var section_id 	= '<?php echo $this->uri->segment(4); ?>';
		var fpath  		= '<?php print($folder_name)?>';

	    save_method = 'add';

	    $('#form')[0].reset();
	    $('.form-group').removeClass('has-error');
	    $('.help-block').empty(); 

	    $('#modal_form').modal('show'); 
	    $('#modal_form').on('shown.bs.modal', function () {
  			$('.chosen-select').chosen({allow_single_deselect:true}); 
		});
	    $('.modal-title').text('Add content'); 

	    tinymce.init({
		    selector: 'textarea',
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
       		extended_valid_elements: 'span[*]',
	        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | fontawesome | forecolor backcolor | fontsizeselect | fullscreen',
	        image_advtab: true,
	        automatic_uploads: true,
		    setup: function (editor) {
	    		editor.on('change', function () {
	        		editor.save();
	    		});
			}
		});

	    $('#id-input-file-3').val(''); 
	    $('#image-preview').hide(); 
	    $('#label-image').text('Upload Image'); 

		$('[name="id"]').val(section_id);
		$('[name="cid"]').val('');
	}

	function edit_content(id)
	{
	    save_method = 'update';
	    $('#form')[0].reset();
	    $('.form-group').removeClass('has-error'); 
	    $('.help-block').empty(); 
	 
	    $.ajax({
	        url : "<?php echo site_url('admin/section/ajax_edit')?>/" + id,
	        type: "GET",
	        dataType: "JSON",
	        success: function(data, textStatus, jqXHR, ex)
	        {
	        	var title 	= $('<input />').html(data.content_title).text();
	        	var content = $('<textarea />').html(data.content_text).text();
	        	var fpath   = '<?php print($folder_name)?>';

	        	$('[name="cid"]').val(data.content_id);
	            $('[name="id"]').val(data.section_id);
	            $('[name="content_title"]').val(title);
	            $('[name="content_text"]').val(content);
	            $('[name="content_animate"]').val(data.animate);

	            $('#modal_form').modal('show');
		        $('#modal_form').on('shown.bs.modal', function () {
		  			$('.chosen-select').chosen({allow_single_deselect:true});

				});
				$('.modal-title').text('Update content');

		        tinymce.init({
		            selector: 'textarea',
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
            		extended_valid_elements: 'span[*]',
		            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | outdent indent | link image | fontawesome | forecolor backcolor | fontsizeselect | fullscreen',
		            image_advtab: true,
		            automatic_uploads: true,
		            setup: function (editor) {
				        editor.on('change', function () {
				            editor.save();
				        });
				    }
		        });

	            $('#id-input-file-3').val('');
	            $('#image-preview').show();
	 
	            if(data.content_image)
	            {
	                $('#label-image').text('Change Image');
	                $('#image-preview div').html('<img src="'+base_url+''+data.content_image+'" class="img-responsive">'); // show photo
	                $('#image-preview div').append('<input type="checkbox" name="remove_image" value="'+data.content_image+'"/> Remove image when saving'); // remove photo
	 
	            }
	            else
	            {
	                $('#label-image').text('Upload Image');
	                $('#image-preview div').text('(No Image)');
	            }

	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	        },
	        error: function (jqXHR, textStatus, errorThrown, ex)
	        {
	            //alert('Error get data from ajax');
	            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
		        new PNotify({
					title: 'Error!',
					text: 'Please check your connection or reload page.',
				    type: 'error'
				});
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

		    $('#btnSave').text('saving...'); //change button text
		    $('#btnSave').attr('disabled',true); //set button disable 
		    var ur2;
		 
		    if(save_method == 'add') {
		        url2 = "<?php echo site_url('admin/section/ajax_add')?>";
		        msg = "New content has been added.";
		    } else {
		        url2 = "<?php echo site_url('admin/section/ajax_update')?>";
		        msg = "Content has been updated.";
		    }
		 
		    // ajax adding data to database
		 
		    var formData = new FormData($('#form')[0]);
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
		                $('#modal_form').modal('hide');
		                $('#modal_form').on('hidden.bs.modal', function (e) {
		        			// need to remove the editor to make it work the next time
		        			tinymce.remove();
						});
		                reload_table();
		                new PNotify({
							title: 'Success',
							text: msg,
						    type: 'success'
						});
		            }
		            else
		            {
		                for (var i = 0; i < data.inputerror.length; i++) 
		                {
		                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
		                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
		                }
		            }
		            $('#btnSave').text('save'); //change button text
		            $('#btnSave').attr('disabled',false); //set button enable 
		 
		 
		        },
		        error: function (jqXHR, textStatus, errorThrown, ex)
		        {
		            //alert('Error adding / update data');
		            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
			        new PNotify({
						title: 'Error!',
						text: 'Please check your connection or reload page.',
					    type: 'error'
					});
		            $('#btnSave').text('save'); //change button text
		            $('#btnSave').attr('disabled',false); //set button enable 
		 
		        }
		    });
		}
	}

	function delete_content(id)
	{
		bootbox.confirm({
			title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete content?",
		    message: "<div class='alert alert-info'>This content will be permanently deleted.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
				if(data) {
					// ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('admin/section/ajax_delete')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                //if success reload ajax table
			                reload_table();
			                $.gritter.add({
			                    title: 'Success',
			                    text: 'Selected content successfully deleted.',
			                    class_name: 'gritter-success'
			                });
			                new PNotify({
								title: 'Success',
								text: 'Selected content successfully deleted.',
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

	function colorbox(id)
	{
		var $overflow = '';
		var colorbox_params = {
			href: id,
			reposition:true,
			scalePhotos:true,
			scrolling:false,
			//previous:'<i class="ace-icon fa fa-arrow-left"></i>',
			//next:'<i class="ace-icon fa fa-arrow-right"></i>',
			close:'&times;',
			//current:'{current} of {total}',
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

		$('a[data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('#colorbox, #cboxOverlay').remove();
	   });
	}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Content form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                	<input type="hidden" value="" name="cid">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-2">Title</label>
                            <div class="col-md-10">
                                <input name="content_title" placeholder="Set content title" class="form-control" maxlength="100" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group" id="image-preview">
                            <label class="control-label col-md-2">Image</label>
                            <div class="col-md-10">
                                (No Image)
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2" id="label-image">Upload Image </label>
                            <div class="col-md-10">
                                <input name="image" type="file" id="id-input-file-3">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Content text</label>
                            <div class="col-md-10">
                                <textarea name="content_text" id="editor1" class="tinymce-modal"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-2">Animation</label>
                            <div class="col-md-10">
                            	<div class="col-xs-12 col-sm-4">
						            <div class="clearfix">
						                <select name="content_animate" class="input input--dropdown js--animations chosen-select" id="modal-chosen" data-current-selected-option="<?=$this->input->post("content_animate"); ?>">
						                    <option value="">-- choose animation --</option>
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
<!-- End Bootstrap modal -->

<script type="text/javascript">
    jQuery(function($) {
    	$('#form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            ignore: "",
            rules: {
                content_title: {
                    required: true,
                }
            },
            messages: {
                content_title: {
                    required: "Please insert title of content."
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
                if(element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
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

        $(document).on('focusin', function(e) {
		    if ($(e.target).closest(".mce-window").length) {
		        e.stopImmediatePropagation();
		    }
		});

		$('#modal_form').on('hidden.bs.modal', function (e) {
	        // need to remove the editor to make it work the next time
	        tinymce.remove();
	        $('.chosen-select').chosen("destroy");
	        $('#id-input-file-3').ace_file_input("reset_input");
		});

    })
</script>