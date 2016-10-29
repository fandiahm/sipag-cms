<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $folder_name = explode('/', $_SERVER['REQUEST_URI'])[1]; ?>

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Theme List</h3>
		<h3 class="box-title pull-right">
		    <a href="<?php echo base_url(); ?>admin/theme/configuration" class="btn btn-flat btn-info" title="Theme configuration">
		        Configuration <i class="icon fa fa-cogs"></i>
		    </a>
		</h3>
	</div>
	<div class="box-body">
		<div id="theme-gallery">
			<ul class="mailbox-attachments clearfix">
				<?php foreach($theme->result() as $row):?>
		            <?php if($setting == $row->theme_style):?>
		                <?php $status = '<small class="badge pull-left bg-green">Active</small>'; ?>
                        <?php $active = '<h2 class="badge-theme-active pull-left bg-green"><i class="icon fa fa-check"></i></h2>'; ?>
                        <?php $color  = 'text-green'; ?>
		            <?php else:?>
		                <?php $status = ''; ?>
                        <?php $active = ''; ?>
                        <?php $color  = ''; ?>
		            <?php endif; ?>
		            <li>
		            	<a href="<?php echo base_url(); ?><?php echo $row->theme_thumbnail; ?>" data-rel="colorbox" class="theme-thumbnail">
		            		<img width="250" height="150" src="<?php echo base_url(); ?><?php echo $row->theme_thumbnail; ?>" alt="Attachment">
		            	</a>
                        <?php echo $active; ?>
		            	<div class="mailbox-attachment-info tools mailbox-attachment-bottom">
		            		<span class="mailbox-attachment-size">
		            			<?php echo $status; ?>
		            			<a class="btn btn-default btn-xs pull-right" href="javascript:void(0)" onclick="theme_detail('<?php echo $row->theme_id; ?>')">
	    							<i class="icon fa fa-eye"></i> 
	    						</a>
		            			<a class="btn btn-default btn-xs pull-right <?php echo $color; ?>" href="javascript:void(0)" onclick="activated_theme('<?php echo $row->theme_id; ?>')">
	    							<i class="icon fa fa-check"></i>
	    						</a>
		            		</span>
		            	</div>
		            </li>
		        <?php endforeach; ?>
			</ul>
		</div>
	</div>
</div>

<script>

	PNotify.prototype.options.styling = "bootstrap3";
    PNotify.prototype.options.delay = 3000;

    function theme_detail(id)
    {
        var base_url = '<?php echo base_url(); ?>';
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
                
                $('#modal-form').modal('show'); 
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

    function activated_theme(id)
    {
        bootbox.confirm({
            title: "Activate Theme?",
            message: "<div class='alert alert-info'>You are going to use this theme. If your front page didn't take effect, try to refresh browser cache.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
            size: 'small',
            buttons: {
                cancel: {
                    label: '<i class="icon fa fa-times"></i> Cancel',
                    className: 'btn-default'
                },
                confirm: {
                    label: '<i class="icon fa fa-check"></i> Confirm',
                    className: 'btn-info'
                }
            },
            callback: function (data){
                if(data) 
                {
                    // ajax delete data to database
                    $.ajax({
                        url : "<?php echo site_url('admin/theme/activated')?>/"+id,
                        type: "POST",
                        dataType: "JSON",
                        success: function(data)
                        {
                            new PNotify({
		                        title: 'Success!',
		                        text: 'Selected theme successfully configured.',
		                        type: 'success'
		                    });
                            $("#theme-gallery").load(location.href + " #theme-gallery");
                        },
                        error: function (jqXHR, textStatus, errorThrown, ex)
                        {
                            //alert('Error deleting data');
                            new PNotify({
		                        title: 'Error!',
		                        text: 'SPlease check your connection or reload page.',
		                        type: 'error'
		                    });
                            //console.log(textStatus + "," + ex + "," + jqXHR.responseText);
                        }
                    });
                }
            }
        });
    }

</script>

<div class="modal fade" id="modal-form" role="dialog">
    <div class="modal-dialog model-content">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Theme Detail</h4>
            </div>

            <div class="modal-body" style="padding-top:0;padding-bottom:0;">
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
            </div>
            <div class="hr hr-dotted"></div>
            <div class="modal-footer">
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
	jQuery(function($) {
		var $overflow = '';
		var colorbox_params = {
			rel: 'colorbox',
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
		};

		$('.mailbox-attachments [data-rel="colorbox"]').colorbox(colorbox_params);
		$("#cboxLoadingGraphic").html("<i class='ace-icon fa fa-spinner orange fa-spin'></i>");//let's add a custom loading icon
		
		
		$(document).one('ajaxloadstart.page', function(e) {
			$('#colorbox, #cboxOverlay').remove();
	   	});

	})

</script>