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
			<a href="<?php echo base_url(); ?>admin/section/add" class="btn btn-flat btn-info">
				<i class="icon fa fa-plus"></i> add new section
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
					<th>Section name</th>
					<th>Layout</th>
					<th>Menu name</th>
					<th>Title</th>
					<th>Tools</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<script type="text/javascript">
	PNotify.prototype.options.styling = "bootstrap3";
	var oTable1;
	var url = "<?php echo site_url('admin/section/get_section')?>";
	$(document).ready(function() {
		oTable1 = $('#myTable').dataTable( {
			"aoColumns": [null, null, null, null, { "bSortable": false }],
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
		});
		$('[data-rel=tooltip]').tooltip();
	})

	function reload_table()
	{
	    //oTable1.ajax.reload(null,false);
	    $('#myTable').dataTable()._fnAjaxUpdate();
	}

	function delete_section(id){
		bootbox.confirm({
			title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete section?",
		    message: "<div class='alert alert-info'>If you deleting section, its content will be deleted too. Both are permanently deleted.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
			callback: function (data) {
				if(data) 
				{
					// ajax delete data to database
			        $.ajax({
			            url : "<?php echo site_url('admin/section/delete')?>/"+id,
			            type: "POST",
			            dataType: "JSON",
			            success: function(data)
			            {
			                reload_table();
			                new PNotify({
							    title: 'Success',
							    text: 'Selected section successfully deleted.',
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