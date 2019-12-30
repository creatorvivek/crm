<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>reports/purchase_report" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
      <div class="body">
        <div class="row clearfix">
         
        <div class="col-md-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            DATE RANGE
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="daterange" name="date_range" placeholder="Select date range" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                       <div class="col-md-3">
                       		<select class="form-control" name="vendor_id">
                       			<option value="">--Select Vendor</option>
                       			<?php foreach ($vendors as $row) {  ?>
                        				<option value="<?= $row['id'] ?>"  <?=  set_select('vendor_id',''. $row['id']. '') ?> 	><?= $row['name'] ?></option>
                       		<?php	}  ?>
                       		</select>
                       </div>          
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-5 pull-right">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?php echo  $this->input->post('date_range')?>
           <!-- Vendor :  <?php echo $this->input->post('vendor_id') ?> -->
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
                            	<?= isset($heading)?$heading:'PURCHASE LIST' ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>#Purchase id</th>
                                          
                                            <th>Total Amount</th>
                                          
                                            <th>Vendor</th>
                                            <th>Adding By</th> 
                                            <th>Billed Status</th>
                                            <!-- <th>Action</th> -->
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php foreach($purchase as $row)
                                    	{ ?>
                                        <tr>
                                            <td><a href="<?= base_url() ?>item/purchase_order_view/<?= $row['purchase_id'] ?>" data-toggle="tooltip" title="click here to view purchase order detail"><?= $row['purchase_id'] ?></a></td>
                                            <!-- <td><?= $row['description'] ?></td> -->
                                            <td><?= $row['total_amount'] ?></td>
                                         
                                            <td><?= $row['vendor_name'] ?></td>
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                            <td><?= $row['status'] ?></td>
                                            <!-- <td> -->
                                       
                                        </tr>
                                            









                                       <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
          <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
             <!-- Jquery DataTable Plugin Js -->
   
     <!-- <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script> -->
    <!--  <script type="text/javascript">
     	$(document).ready( function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        "processing": true
    });
});
     </script> -->

     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
     <script>
     
      $(document).ready( function () {
    $('.sales_table').DataTable({
        "responsive": true,
        "processing": true,
        "order": [[ 4, 'desc' ]]
    });
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
     </script>