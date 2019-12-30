
<!-- <div class="pull-right">
	<a href="<?= site_url('nas/add_nas'); ?>" class="btn btn-success">Add</a> 
</div> -->
 <div class="card">
            <div class="card-header">
              <h3 class="card-title">User List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


<!-- <div id="overlay">loading...</div> -->
<table id ="nas_table" class="table table-bordered table-hover">
	
	<thead>
		<tr>
			<th>ID</th>
			<th>name</th>
			
			<th>username</th>
			
			<!-- 
			<th>MAC ADDRESS</th>
			<th>IP ADDRESS</th>
			<th>PORT</th>
			<th>TYPE</th> -->

			
			<!-- <th>DATE</th> -->
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		<?php  
		$count=1 ?>
		<?php foreach($users as $row){ ?>
			<tr>
				<td><?= $count++ ?></td>
				
				<td><?= $row['name']; ?></td>
				
				
				<td><?= $row['username']; ?></td>
				<!-- <td><?= $row['mac_address']; ?></td>
				<td><?= $row['ip_address']; ?></td>
				<td><?= $row['port']; ?></td>
				
				<td><?= $row['type']; ?></td>
				<td><?= $row['created_at']; ?></td> -->
				
				<td>
					<div class="btn-group" >
						<button type="button" class="btn btn-success " data-toggle="tooltip" data-placement="top" title="Edit"><a href="<?= base_url() ?>nas/editView/<?= $row['id'] ?>" ><i class="fa fa-pencil"></i></a></button>
						<button type="button" class="btn btn-danger" onclick="delFunction(<?= $row['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
						<!-- <button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View"><a href="#" id="<?= $row['id']?>" class="view_data"><i class="fa fa-eye"></i></a></button> -->
						<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="View"><a href="<?= base_url() ?>admin/listChildUsers/<?= $row['id'] ?>"><i class="fa fa-eye"></i></a></button>
						
					</div>
				</td>
			</tr>
		<?php } ?>
	</tbody>
</table>
</div>
</div>



	<script>
		$(document).ready( function () {
			$('#nas_table').DataTable(
				{
					"processing": true
				});
		} );
	</script>
	<script type="text/javascript">
		var url="<?= base_url();?>";
		function delFunction(id)
		{
			
			
			bootbox.confirm("Are you sure?Are you sure to delete ", function(result) {
				if(result)
					
					window.location = url+'nas/remove/'+id ;
				
			});
		}

	</script>
	


<script type="text/javascript">
	$(window).load(function(){
   // PAGE IS FULLY LOADED  
   // FADE OUT YOUR OVERLAYING DIV
   $('#overlay').hide();
});
</script>