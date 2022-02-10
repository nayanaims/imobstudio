<!-- Page Wrapper -->
<div class="page-wrapper">
<div class="content container-fluid">
	<!-- Page Header -->
	<div class="page-header">
		<div class="row align-items-center">
			<div class="col">
				<h3 class="page-title">Unit list</h3>
				<ul class="breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('dashboard');?>">Dashboard</a></li>
					<li class="breadcrumb-item active">Unit list</li>
				</ul>
			</div>
		</div>
	</div>
	<span id="message_id"><?php echo $this->session->flashdata('message'); ?></span>		
  
	<div class="row">
		<div class="col-md-12">
			<div class="">  <!-- table-responsive -->
				<table id="admin_lists" class=" table table-stripped mb-0 admin_lists" >
					<thead>
						<tr>
							<?php 
							if(!empty($tabletile)) :
							  foreach($tabletile as $key => $title) : ?>
								<th class="th<?= $key; ?>"><?= $title; ?></th>
							<?php 
							   endforeach;
						    endif; ?>
						</tr>
					</thead>
					<tbody>						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<script>
$(document).ready(function() {
   $('.admin_lists').DataTable({
    'processing': true,
    'serverSide': true,
    "bPaginate": true,
    'serverMethod': 'post',
    'ajax': {
        'url':  BaseUrl + "admin/getlist"
    },
    "deferRender": true,
    "lengthChange": true,
    "lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
    "order": [[1, "asc"]]
});   

});
</script>