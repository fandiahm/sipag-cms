<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

	
<?php if($this->session->flashdata('message')) : ?>
   	<div class="alert alert-success alert-dismissible" role="alert" align="center">
   		<button type="button" class="close" data-dismiss="alert">
			<i class="icon fa fa-times"></i>
		</button>
       	<?php echo $this->session->flashdata('message'); ?>
   	</div>
<?php endif; ?>

<div class="box">
	<div class="box-header">
		<p>
			<a href="<?php echo base_url(); ?>admin/content/add" class="btn btn-flat btn-info">
				<i class="icon fa fa-plus"></i> add new content
			</a>
			<button class="btn btn-flat btn-success" onclick="reload_table()">
		       	<i class="icon fa fa-refresh"></i> refresh
		   	</button>
		</p>
	</div>
	<div class="box-body">
		<table id="myTable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Section</th>
					<th>Title</th>
					<th>Image</th>
					<th>Content</th>
					<th>Animation</th>
					<th>Tools</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
	PNotify.prototype.options.styling = "bootstrap3";
	var oTable1;
	var url = "<?php echo site_url('admin/content/get_allcontent')?>";
	$(document).ready(function() {
		oTable1 = $('#myTable').dataTable( {
			"aoColumns": [null, null, null, null, null, { "bSortable": false }],
			"processing": true, 
			"serverSide": true,
			"responsive": true,
			"order": [],
			"ajax": {
	            "url": url,
	            "type": "POST",
	            error: function (jqXHR, textStatus, errorThrown, ex)
	            {
	                //alert('Error');
	                console.log(textStatus + "," + ex + "," + jqXHR.responseText);
	                new PNotify({
					    title: 'Error!',
					    text: 'Please check your connection or reload page.',
					    type: 'error'
					});
	            }
	        },
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
		});
		$('[data-rel=tooltip]').tooltip();
	})

	function reload_table()
	{
	    //oTable1.ajax.reload(null,false);
	    $('#myTable').dataTable()._fnAjaxUpdate();
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
			            url : "<?php echo site_url('admin/content/delete_content')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                //if success reload ajax table
			                reload_table();
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