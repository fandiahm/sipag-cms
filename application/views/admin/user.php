<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php foreach ($admin->result() as $row2): ?>
	<?php if(($row2->level == 0) OR ($row2->level == 1)):?>

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
					<a href="<?php echo base_url(); ?>admin/user/user_add" class="btn btn-flat btn-info">
						<i class="icon fa fa-plus"></i> add new user
					</a>
					<a href="<?php echo site_url('admin/user/user_edit/'."$row2->user_id"); ?>" class="btn btn-flat btn-success pull-right">
						<i class="icon fa fa-eye"></i>  view profile
					</a>
				</p>
			</div>
			<div class="box-body">
				<table id="myTable1" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Picture</th>
							<th>Username</th>
							<th>Email</th>
							<th>Level</th>
							<th>Status</th>
							<th style="text-align:center;">Tools</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($user->result() as $row): ?>
						<tr>
							<td>
								<?php if(empty($row->image)): ?>
									<img class="user-image" src="<?php echo base_url(); ?>assets/dist/img/avatar2.png" alt="Admin's Photo" />
								<?php else: ?>
									<img class="user-image" src="<?php echo base_url(); ?><?php echo $row->image; ?>" width="32" height="32" />
								<?php endif; ?>
							</td>
							<td><?php echo $row->username; ?></td>
							<td><?php echo $row->email; ?></td>
							<td>
								<?php if($row->level == 0) {
									$level = 'Developer';
								} elseif($row->level == 1) {
									$level = 'Administrator';
								} elseif($row->level == 2) {
									$level = 'Author';
								} else {
									$level = 'Not registered';
								}
								?>
								<?php echo $level; ?>
							</td>
							<td>
								<?php if($row->status == 1) {
									$status = 'Active';
								} else {
									$status = 'Not active';
								}
								?>
								<?php echo $status; ?>
							</td>
							<td align="center">
								<?php if(($row->level==0) OR ($row->level==1)): ?>
								<?php else: ?>
									<div class="action-buttons">
										<a class="text-green" href="<?php echo site_url('admin/user/user_edit/' . "$row->user_id"); ?>">
											<i class="icon fa fa-pencil"></i>
										</a>

										<a class="text-red" href="javascript:void(0)" onclick="delete_user('<?php echo $row->user_id; ?>')">
											<i class="icon fa fa-trash-o"></i>
										</a>
									</div>
								<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	<?php else: ?>

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
					<a href="<?php echo site_url('admin/user/user_edit/' . "$row2->user_id"); ?>" class="btn btn-flat btn-success">
						<i class="icon fa fa-eye"></i>  view profile
					</a>
				</p>
			</div>
			<div class="box-body">
				<table id="myTable2" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Picture</th>
							<th>Username</th>
							<th>Email</th>
							<th>Level</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($user->result() as $row): ?>
						<tr>
							<td>
								<?php if(empty($row->image)): ?>
									<img class="user-image" src="<?php echo base_url();?>assets/dist/img/avatar2.png" alt="Admin's Photo" />
								<?php else: ?>
									<img class="user-image" src="<?php echo base_url();?><?php echo $row->image; ?>" width="32" height="32" />
								<?php endif; ?>
							</td>
							<td><?php echo $row->username; ?></td>
							<td><?php echo $row->email; ?></td>
							<td>
								<?php if($row->level == 0) {
									$level = 'Developer';
								} elseif($row->level == 1) {
									$level = 'Administrator';
								} elseif($row->level == 2) {
									$level = 'Author';
								} else {
									$level = 'Not registered';
								}
								?>
								<?php echo $level; ?>
							</td>
							<td>
								<?php if($row->status == 1) {
									$status = 'Active';
								} else {
									$status = 'Not active';
								}
								?>
								<?php echo $status; ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>

	<?php endif; ?>
<?php endforeach; ?>

<script>
	PNotify.prototype.options.styling = "bootstrap3";

	$(document).ready(function() {
		var oTable1 = $('#myTable1').dataTable({
			"aoColumns": [null, null, null, null, null,{ "bSortable": false }] 
		});

		var oTable1 = $('#myTable2').dataTable({
			"aoColumns": [null, null, null, null,{ "bSortable": false }] 
		});
	})

	function reload_table()
	{
	    //oTable1.ajax.reload(null,false);
	    $('#myTable1').dataTable()._fnAjaxUpdate();
	}

	function delete_user(id){
		bootbox.confirm({
			title: "<i class='icon fa fa-exclamation-triangle text-red'></i> Delete section?",
		    message: "<div class='alert alert-info'>Selected user will be deleted.</div> <p class='text-center text-grey'><i class='icon fa fa-hand-o-right text-blue'></i> Are you sure?</p>",
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
			callback: function (result) {
				if(result)
				{
					window.location = "<?php echo site_url('admin/user/user_delete')?>/"+id;
				}
			}
		});
	}
</script>