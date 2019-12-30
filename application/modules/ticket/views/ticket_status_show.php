<div class="row clearfix">
	<div class="card">
		<div class="header">
			<h3 class="title"><div class="row"><div class="col-md-3" style="color:#1158a3">
				Ticket Number - <?= $ticket_id ?> </div><div class="col-md-3"> <?= ucwords($name) ?> </div><div class="col-md-3"><button class="btn btn-info">Call <?= $mobile ?> </button></div><div class="col-md-3" style="font-size: 14px;"><?= date('j F Y', strtotime($created_at)); ?>&nbsp &nbsp<?= date('h:i a', strtotime($created_at)); ?></div> </div> </h3>
			</div>
			<!-- /.card-header -->
			<div class="body">
				<!-- <b>CUSTOMER-ID</b>  -  123
				<hr> -->
				<b>ISSUE -</b>  <?= $description ?>
				<hr><b>Status -</b>
				<?php if($status=='open')
				{ ?>

				<span class="label label-danger"><?= $status ?></span>
			<?php 
				}  else { ?>
						<span class="label label-success"><?= $status ?></span>

			<?php	} ?>
			<hr>

			<!-- <b>Assign To -</b>
			<?php
			
			 foreach($assign as $row){ ?>
				   <?= $row ?>
			<?php echo ','; 
		} ?>  -->
			</div>
		</div>
		
		<div class="card">
			<div class="header bg-cyan ">
				<h2>
				Ticket Log
				</h2>
				
			</div>
		</div>	
			<!-- </div> -->
			
			<?php foreach($ticket_log as $row){ ?>
			
			<div class="card">
				<div class="header ">
					<h5> Created by :
					<?= $row['staff_name']; ?>
					<small> <?= date('j F Y', strtotime($row['created_at'])); ?>&nbsp &nbsp<?= date('h:i a', strtotime($row['created_at'])); ?></small>
					</h5>
				</div>
				<div class="body">
					<?= $row['reply']; ?>
					
				</div>
			</div>
			
			<?php } ?>