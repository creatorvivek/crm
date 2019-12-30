<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>task/report_analysis" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
      <div class="body">
        <div class="row clearfix">
         
        <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            DATE RANGE
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="daterange" name="date_range" placeholder="Select date range" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
       <div class="col-md-3">
        <select name="staff" class="form-control">
          <option value="">--select <?= $staff_name ?>--</option>
         <?php  foreach($staff as $row) {     ?>
          <option value="<?= $row['id'] ?>" <?=  set_select('staff',  $row['id'] ); ?> ><?= $row['name'] ?></option>
        <?php } ?>
         </select>
       </div>
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-3 pull-right">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?php echo  $this->input->post('date_range')?>
         </div>
       </div>
     </div>
   </div>
 </form>
 </div>
</div>
</div>
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             Report
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered  table-hover js-basic-example dataTable" id="reportTable">
    <thead>
    <tr>
        <!-- <th>ID</th> -->
        <th>Task</th>
        <th>Completed</th>
        <th>%(task complete)</th>
        <th>My work</th>
        <th>staff</th>
        <th>Date</th>
        <!-- <th>status</th>
        <th>Pending Amount (&#8377)</th>
        <th>Actions</th> -->
    </tr>
    </thead>
    <tbody>

    <?php 
       $total=0;
      $total_payment=0;



    foreach ($report as $row) { 

       

      ?>
        <tr>
          
           <td><?= $row['task'] ?></td>
           <?php if( $row['task_completed']==1)
           {

            $task_completed='yes';
           }
           else
           {
            $task_completed='No';
           } 
           ?>
           <td width="2%"><?= $task_completed ?></td>
           <td width="2%"><?= $row['complete_percent'] ?></td>
           <td width="30%"><?= $row['work_did'] ?></td>
           <td width="10%"><?= $row['staff_name'] ?></td>

           <td width="8%"><?= $row['created_at'] ?></td>


        </tr>
    <?php } ?>
    </tbody>
  
</table>
</div>

    <script src="<?= base_url() ?>assets/admin/plugins/daterangepicker/moment.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
     <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script>
  $(function () {

    $('#daterange').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    );
  });
  



  $(document).ready( function () {
        $('.js-basic-example').DataTable();
    } );
      // for each column in header add a togglevis button in the div
    
  </script>

