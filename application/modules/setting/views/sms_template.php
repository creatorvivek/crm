
<div class="row clearfix">
		<div class="card">
			<div class="body bg-danger">
					code used for ticket module -> {name} ,{ticket_id}	<br>
					code used for user credential {username} ,{password}, {url}.
			</div>
		</div>





</div>















<div class="row clearfix">
		<form action="<?= base_url() ?>setting/sms_template_update" method="post">
			<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
	<?php for($i=0;$i<count($template);$i++) 
	 { ?>
			<div class="card col-md-6">
					<div class="header">
						 <h2> Module  -  :  <?= $template[$i]['module'] ?></h2>
					</div>
					<!-- /.card-header -->
					<div class="body">
						
							<div class="form-group form-float">
		                                <div class="form-line">
		                                  <textarea class="form-control" name="context[]" required><?= $template[$i]['context'] ?></textarea>
		                                  <label class="form-label">Context</label>
		                                </div>
		                   </div>

					</div>
				</div>
		
			<input type="hidden" name="id[]" value="<?= $template[$i]['id']  ?>">
		<?php } ?>
		<button type="submit" class="btn btn-info">Update</button>
		</form>

		
		</div>

		    <!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/basic-form-elements.js"></script> -->