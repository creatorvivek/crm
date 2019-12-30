<div class="row clearfix">
	<div class="col-md-12">
		<div class="card">

			<div class="header">

				<h2>Genaral Entry</h2>
			</div>
			<div class="body">

				 <form id="form_validation" method="POST" action="<?= base_url() ?>account/journal_entry_process">
         			<input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
				<div class="row">
						<div class="col-md-5">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="notes" required="" aria-required="true" value="<?= $this->input->post('notes'); ?>" >
                            <label class="form-label">Notes <span class="col-pink">*</span></label>
                            <span class="error"><?= form_error('notes');?></span>
                        </div>
                    </div>
                </div>	
                <div class="col-md-10">
                	<div class="table-responsive">
                	<table class="table table-bordered">
                		<tr>
                			<th>Account</th>
                			<th>Contact</th>
                			<th>Debit</th>
                			<th>Credit</th>
                			<!-- <th>Account</th> -->
                		</tr>
                		<tr>
                			<td><select name="ledger_group[]" required class="form-control"><option value="">Select Group</option><?php foreach($account_group as $row)
                			{  ?>
                				<option value="<?= $row['id'] ?>"><?= $row['group_name'] ?></option>
                		<?php	}

                			 ?></select></td>
                			<td><select name="contact[]" class="form-control"><option value="">Select Contact</option>
                				<?php foreach($contact as $row)
                			{  ?>
                				<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                		<?php	}

                		?>
                			</select></td>
                			<td><input type="text" name="debit[]"  value="0" onkeyup="total()"  class="form-control debit"></td>
                			<td><input type="text" name="credit[]"  value="0" onkeyup="total()" class="form-control credit"></td>


                		</tr>
                		<tr>
                			<td><select name="ledger_group[]" required class="form-control"><option value="">Select Group</option><?php foreach($account_group as $row)
                			{  ?>
                				<option value="<?= $row['id'] ?>"><?= $row['group_name'] ?></option>
                		<?php	}

                			 ?></select></td>
                			<td><select name="contact[]" class="form-control"><option value="">Select Contact</option>
                				<?php foreach($contact as $row)
                			{  ?>
                				<option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                		<?php	}

                		?>
                			</select></td>
                			<td><input type="text" name="debit[]"  value="0" onkeyup="total()"  class="form-control debit"></td>
                			<td><input type="text" name="credit[]" value="0"  onkeyup="total()" class="form-control credit"></td>


                		</tr>
                		<tr>
                			
                			<td colspan="2" align="center">Total</td>
                			<td class="total_debit"></td>
                			<td class="total_credit"></td>
                		</tr>
                	</table>
                </div>
                </div>
                <input type="hidden" name="amount" class="total_amount">
                	<div class="col-md-10"><div class="error_total"></div></div>
                	<div class="col-md-10"><button type="submit" align="center" class="btn btn-info" onclick="validate()">ADD</button>
				</div> 	
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	
function total()
{
var total_credit=0;
var total_debit=0;
$(".debit").each(function(){
total_debit += parseInt($(this).val());
});


$(".credit").each(function(){
total_credit += parseInt($(this).val());
});

$('.total_credit').text(total_credit);
$('.total_debit').text(total_debit);
$('.total_amount').val(total_debit);


}

function validate()
{


if($('.total_credit').text()!=$('.total_debit').text())

{

	$(".error_total").html("Total Debit and Credit Should be Equal");
	$(".error_total").css("color","red");
}
else{
document.getElementById("form_validation").submit();

}


}

</script>