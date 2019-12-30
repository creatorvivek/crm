
<div class="row">
	<div class="col-md-5">
		<div class="card">
			<div class="header">
				<h3 class="card-title">Group Information</h3>
			</div>
			<!-- /.card-header -->
			<div class="body">
				<table class="table table-bordered table-hover">
					<!-- <?php	foreach($group_data as $row) 
					
					?> -->
					<tr>
						<th>Group Name </th>
						<td><?= $group_data['name'] ?></td>
					</tr>
					<tr>
						<th>Group Head </th>
						<td><?= $group_data['head_name'] ?></td>
					</tr>
					<tr>
						<th>Group Description </th>
						<td><?= $group_data['description'] ?></td>
					</tr>
					
				</table>
			</div>
			<!-- /card body -->
		</div>
		<!-- /card -->
	</div>
	<!-- /col -->
	<div class="col-md-7">
		<div class="card">
			<div class="header">
				<h3 class="card-title">Member Information</h3>
			</div>
			<!-- /.card-header -->
			<div class="body">
				<?php	if(count($staff)==0)
				{
					echo "No Member In This group";
				}else {  ?>
					<table class="table table-bordered table-hover">
						<tr>
							<th>s no</th>
							<th>name</th>
							<th>mobile no</th>
							<th>action</th>	
						</tr>
						<?php $count=1 ?>
						<?php	

						for($i=0;$i<count($staff_group);$i++) {  ?>

							<tr>
								<td><?= $count ++ ?></td>
								<td><?= $staff_group[$i]['name'] ?></td>
								<td><?= $staff_group[$i]['mobile'] ?></td>
								<td><button type="button" class="btn btn-danger" onclick="delFunction(<?= $staff[$i]['id'] ?>);" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button></td>	
							</tr>
						<?php } }?>
					</table>

					<div class="form-group">
						<label>Add Member</label>
						<div class="col-md-12">
							<select class="form-control show-tick"  data-live-search="true" multiple="multiple" data-placeholder="Select a member and group" id="member" name="member[]"
							>
							<option value="">--select--</option>
							<?php for($i=0;$i<count($staff);$i++) {
								if($staff[$i]['id']!=$staff_group[$i]['id'])  {  ?>
									<option value="<?= $staff[$i]['id'] ?> "><?= $staff[$i]['name'] ?></option>
								<?php }} ?>
							</select>
						</div>
					</div>
					<div class="col-sm-offset-4 col-sm-5">
						<div class="form-group">
							<button type="submit" class="btn btn-success"  onclick="addMember();">ADD</button>
						</div>
					</div>
				</div>
				<!-- /card body -->
			</div>
		</div>
		<!-- /row -->	
		<script type="text/javascript">
			
</script>
<script type="text/javascript">
			/*function addMember()
			{
				var group_id="<?= $group[0]['group_id'] ?>";
				var member=$('#member').val();
				console.log(group_id);
				console.log(member);
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>group/mapGroupMember",
					data: {
						member:member,group_id:group_id
					},

					success: function (data) {
						console.log(data);
						location.reload();

					}
				});
			}
		function delFunction(id)
		{
			
			
			var group_id="<?= $group[0]['group_id'] ?>";
			bootbox.confirm("Are you sure want to delete ", function(result) {
				if(result)
				{	
					
				$.ajax({
					type: "POST",
					url: "<?= base_url() ?>group/deleteMember",
					data: {
						member_id:id,group_id:group_id
					},

					success: function (data) {
						console.log(data);
						location.reload();


					}
				});
				}
				
			});
		}*/
		</script>