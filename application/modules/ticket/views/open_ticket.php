
<!-- <div class="pull-right">
	<a href="<?= site_url('ticket/add_ticket'); ?>" class="btn btn-success">Add</a> 
</div> -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Open Ticket</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">


		<!-- <div id="overlay">loading...</div> -->
		<table id ="ticket_table" class="table table-bordered table-hover">

			<thead>
				<tr>
					<th>Ticket id</th>
					<th>Name</th>
					<th>Email</th>

					<th>Mobile</th>
					<th>Comment</th>
					<th>Description</th>



					<th>Created_at</th>
					<!-- <th>PORT</th> -->
					<!-- <th>TYPE</th> -->
					<th>assign</th>

					<!-- <th>DATE</th> -->
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>

				<?php foreach($open_ticket as $row){ ?>
					<tr>
						<td><a href="<?= base_url()?>ticket/log_ticket_by_ticket_no/<?= $row['ticket_id'] ?>"><?= $row['ticket_id'] ?></a></td>
						<td><?= $row['name']; ?></td>
						<td><?= $row['email']; ?></td>


						<td><?= $row['mobile']; ?><br><button class="btn btn-info"><a href="<?= base_url() ?>sms/index?mobile=<?= $row['mobile'] ?>" style="color:white">sms</a></button><button class="btn btn-danger">Call</button></td>
						<td><?= $row['comment']; ?></td>
						<td><?= $row['description']; ?></td>

						<!-- <td><?= $row['type']; ?></td> -->
						<td><?= $row['created_at']; ?><br><!-- <div class="creator_name"><?= '-'. $row['staff_name']; ?> --></div></td>
						<?php if($row['assign'] ==null)
						{ ?>
							<td style="color:red">unassigned<br>
								<div class="anchor"> <a href="<?= base_url()?>ticket/ticket_response/<?= $row['ticket_id'] ?>"">click to assign</a></div>
							</td>
						<?php  } else { ?>
							<td style="color:green">assign</td>
						<?php } ?>

						<td>
							<div class="btn-group" >

								<button type="button" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="ticket Log"><a href="<?= base_url()?>ticket/log_ticket_by_ticket_no/<?= $row['ticket_id'] ?>"><i class="fa fa-history"></i></a></button>
								<button type="button" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Reply"><a href="<?= base_url() ?>ticket/ticket_response/<?= $row['ticket_id'] ?>"><i class="fa fa-reply"></i></a></button>

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
		$('#ticket_table').DataTable(
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

				window.location = url+'ticket/remove/'+id ;

		});
	}

</script>



