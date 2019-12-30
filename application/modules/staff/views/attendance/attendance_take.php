 			<form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/insert_attendance">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
 <div class="row clearfix">
 	<div class="col-md-12">
 		<div class="card">
 			<div class="header">
 				<h2>TAKE ATTENDANCE</h2>

 			</div>
 			<div class="body">
 				<div class="row clearfix">
 				<div class="col-md-4">
 					<!-- <p>DEPARTMENT</p> -->
 					<!-- <div class="form-group"> -->
 						<select class="form-control"  data-live-search="true" name="department" id="department" required  >
 							<option value="">--Select department--</option>
                            <option value="all">All</option>
 							<?php  foreach($department as $row)
 							{
 								?>
 								<option value="<?= $row['id'] ?>" ><?= $row['name']  ?></option>
 							<?php } ?>
 						</select>
 					<!-- </div> -->


 				</div>
 				   <div class="col-md-4">
 				       <div class="form-group form-float">
                                        	<div class="form-line">
                                        		<input type="text" class="form-control datemask" required  readonly='true' id="date"  name="date_attendance"   placeholder="attendance date">
                                        		<span class="error"><?= form_error('from');?></span>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                    	<button type="button" class="btn btn-success" onclick="fetch_staff()">search</button>
                                    </div>
 			</div>
 		</div>
 	</div>
 </div>
</div>
 <div class="row clearfix">
 	<div class="col-md-12">
 		<div class="card">
 			<div class="header">
 				<h2>ATTENDANCE SHEET</h2>

 			</div>
 			<div class="body">
 				 <div class="row clearfix">
 				 		<div class="col-md-12">
 				<table class="table table-bordered">
 						<thead>
 							<th>Employee Id</th>
 							<th>Name</th>
 							<th>Remark</th>

 						</thead>
 						<tbody class="body_data">
 							

 						</tbody>	


 				</table>
 			</div>
 			<div class="col-md-12" align="center">
 			<button type="submit" class="btn btn-success" id="submit_button" >Add</button>
 			</div>

 		</div>
 	</div>
 </div>
</div>
</div>


</form>





<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>

<script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('#submit_button').hide();

	$( ".datemask" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     // yearRange: '1950:2012'
     maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


 });
});

 function validate() {
 var date = $('#date').val();
 console.log(date);
 var date = new Date(date).setHours(0, 0, 0, 0);
 var now = (new Date()).setHours(0, 0, 0, 0);
 console.log('now-'+now);
 console.log('date-'+date);
 if (date < now) {
 alert("Date must be less than or equal to current date");
 $('#date').val('');
 return;
}
}

function fetch_staff()
{

var department_id=$('#department').val();
var date=$('#date').val();
	// console.log(course_id);
	$.ajax({
		url:"<?= base_url()?>staff/fetch_staff_for_attendance",  
		method:"POST",  
		data:{department_id:department_id,date:date,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},  
		success:function(data){  
			console.log(data);
			var obj=JSON.parse(data);
			var row='';
			console.log(obj);
			if(obj.length>0)
			{
				for(var i=0;i<obj.length;i++)
				{
					row+='<tr><td><input type="hidden" name="employee_id[]" value="'+obj[i]['id']+'" ><input type="hidden" name="department_id[]" value="'+obj[i]['department_id']+'" >'+obj[i]['employee_code']+'</td><td>'+obj[i]['name']+'</td>'+
					// +'<td><input type="checkbox" id="basic_checkbox_2'+i+'" class="filled-in check" name="att-'+obj[i]['id']+'" value="p">&nbsp <label for="basic_checkbox_2'+i+'">Present</label>'+
   		// 									'<input type="checkbox" id="basic_checkbox'+i+'" class="filled-in check" name=""'+obj[i]['id']+'"" value="A">&nbsp <label for="basic_checkbox'+i+'">Absent</label>'
   											'<td><input name="attendance-'+obj[i]['id']+'" value="1" type="radio" id="radio_p'+i+'" checked /><label for="radio_p'+i+'">Present</label><input name="attendance-'+obj[i]['id']+'" type="radio" value="0" id="radio_a'+i+'" /><label for="radio_a'+i+'">Absent</label>'+
                                            '<input name="attendance-'+obj[i]['id']+'" type="radio" value="2" id="radio_h'+i+'" /><label for="radio_h'+i+'">Holiday</label><input name="attendance-'+obj[i]['id']+'" type="radio" value="0" id="radio_l'+i+'" /><label for="radio_l'+i+'">Leave</label></td></tr>'
				}
				$('#submit_button').show();
			}
			else{

				row='<option value="">No staff are avilable</option>'
			}	
			$('.body_data').html(row) ;  
            
            },
            error:function(data)
            {

            },
        });

}





</script>