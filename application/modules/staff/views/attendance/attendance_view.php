
  
  <style type="text/css" media="all">
   
 

  .table
  {
    font-size:12px;
  
  }
 
</style>

</style>
<form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/attendance_view">
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

	<div class="row clearfix">
		<div class="col-md-12">
			<div class="card">
				<div class="header">
					<h2>ATTENDANCE VIEW</h2>

				</div>
				<div class="body">
					<div class="row clearfix">
						<div class="col-md-3">
							<!-- <p>DEPARTMENT</p> -->
							<!-- <div class="form-group"> -->
								<select class="form-control"  data-live-search="true" name="department" id="department" required=""  >
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
							<div class="col-md-3">
								<!-- <div class="form-group"> -->
									<select class="form-control show-tick method year"  name="year" required="">
										<option value="">--Select Year --</option>

										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>



									<span class="error"><?= form_error('year');?></span>
									<!-- </div> -->
								</div>
               <!--  <p>
                    Month <span class="col-pink">*</span>
                </p> -->
                <div class="col-md-3">
                	<!-- <div class="form-group"> -->
                		<select class="form-control show-tick method month"  name="month" required="">


                			<option value="" selected="selected">Select Month</option>
                			<option value="1">January</option>
                			<option value="2">February</option>
                			<option value="3">March</option>
                			<option value="4">April</option>
                			<option value="5">May</option>
                			<option value="6">June</option>
                			<option value="7">July</option>
                			<option value="8">August</option>
                			<option value="9">September</option>
                			<option value="10">October</option>
                			<option value="11">November</option>
                			<option value="12">December</option>
                		</select>
                		<span class="error"><?= form_error('month');?></span>
                		<!-- </div> -->
                	</div>
 				<!-- <div class="col-md-4">
 				<div class="form-group form-float">
                                        	<div class="form-line">
                                        		<input type="text" class="form-control datemask" required  readonly='true' id="date"  name="date_attendance" onchange="validate()"  placeholder="attendance date">
                                        		<span class="error"><?= form_error('from');?></span>
                                        	</div>
                                        </div>
                                    </div> -->
                                    <div class="col-md-3">
                                    	<button type="button" class="btn btn-success" onclick="form_submit()" >Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>


            <?php 
// print_r(count($attendance_report));

            if(isset($attendance_report))
            {
            	// $no_of_days=31;
            	

            	?>
            	<div class="row clearfix attendance_print">
            		<div class="col-md-12 col-xs-12">
            			<div class="card">
            				<div class="header">
            					<!-- <button class="btn btn-success print_report" onclick="print_report()">Print</button> -->
                      <div class="row">
                      <div class="col-md-8">
            					<h2>Attendance report of <?= $month.'  '.$year ?></h2>
                    </div>
                     <div class="col-md-4" align="right">
                      <button type="button" class="btn btn-info print_button" onclick="print()" >Print</button>
                    </div>
                  </div>
            				</div>
            				<div class="body"> 
            					<div class="table-responsive">
            						<table class="table table-bordered table-hover table-condensed">
            							<thead>
            								<tr>
            									<th>CODE</th>
            									<th>NAME</th>
            									<?php $count=1; 
            									?>
            									<?php for($i=1;$i<=$no_of_days;$i++) {  ?>
            										<th width="2"><?= $i ?></th>
            									<?php } ?>
            									<th>P</th>
                              <th>A</th>
                              <th>H</th>
                              <th>Total</th>
            								</tr>
            							</thead>
<!-- $present=0;
   $attendance_report[$k]['staff_id']
   ?> -->
   <tbody>
    <?php 

   	for($j=0;$j<count($attendance_report);$j++)	{  
   		$present=0;
   		$absent=0;
      $holiday=0;
      $leave=0;
   		echo '<tr>';
   		echo '<td>'.$attendance_report[$j]['employee_code'].'</td>';
   		echo '<td>'.$attendance_report[$j]['name'].'</td>';
   		for($k=1;$k<=$no_of_days;$k++)   { 
   			$attendance_report[$j]['day'.$k];
   			if($attendance_report[$j]['day'.$k]=='1')
   			{
   				$present++;
   				$status="<span class='col-green'>P</span>";
   			}
   			else if($attendance_report[$j]['day'.$k]=='0')
   			{
   				$absent++;
   				$status="<span class='col-red'>A</span>";
   			}
        else if($attendance_report[$j]['day'.$k]=='2')
        {
          $holiday++;
          $status="<span class='col-blue'>H</span>";
        }
   			else
   			{
   				$status='';
   			}
   			?>                 
   			<td class="status_width">  <?= $status ?></td>
   		<?php } ?>
   		<td><?= $present ?></td> 
      <td><span class='col-red'><?= $absent ?></span></td>
      <td><span class='col-blue'><?= $holiday ?></span></td>
      <td><?= $present+$absent+$holiday ?></td>
   	</tr>
   <?php  	} 
   ?> 
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>

<div class="row clearfix">
                <div class="col-md-12">
                  <div class="card">
                    <div class="header">
                      <!-- <button class="btn btn-success print_report" onclick="print_report()">Print</button> -->
                      <h2>Symbol</h2>
                    </div>
                    <div class="body"> 
                     p= <span class="label bg-green">Present</span>
                     A=<span class="label bg-red">Absent</span>
                     H=<span class="label bg-blue">Holiday</span>
                     L=<span class="label bg-green">Leave</span>
                      </div>
                    </div>
                  </div>
                </div>
<?php } ?>

                          <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
                          <script type="text/javascript">
                            function print()
                            {
                              $(".attendance_print").printMe({path:["<?= base_url() ?>assets/admin/print_table.css"]});
                            }

                            
                          function form_submit()
                          {
                            var department=$('#department').val();
                            var year=$('.year').val();
                            var month=$('.month').val();
                            if(department && year && month)
                            {

                                $("#form_validation").submit();
                            }
                            else
                            {

                              alert("Select All the Field");
                            }



                          }
                          </script>     
