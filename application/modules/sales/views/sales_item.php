 <div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>sales/sales_list" method="post">
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
                              <?= $heading ?>
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover sales_table dataTable">
                                    <thead>
                                        <tr>
                                          <th>Sales Order #</th>
                                            <th>Customer Name</th>
                                            <th>Customer Mobile</th>
                                            <!-- <th>Item Name</th> -->
                                            <th>Total (&#8377)</th>
                                            <!-- <th>Serial No</th> -->
                                            <!-- <th>Model No</th> -->
                                            <th>Adding By</th> 
                                            <!-- <th>Category</th> -->
                                            <!-- <th>Action</th> -->
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                      <?php 
                                      $total=0;

                                      foreach($item as $row)
                                      { 


                                        $total+=$row['total'];
                                        ?>
                                        <tr>
                                          <td data-toggle="tooltip" data-placement="right" title="click to  view order"><a href="<?= base_url() ?>sales/sales_order_view/<?= $row['order_id'] ?>"><?= $row['order_id'] ?></a></td>
                                            <td data-toggle="tooltip" data-placement="right" title="click to customer view"><a href="<?= base_url() ?>crn/customer_info/<?= $row['customer_id'] ?>"><?= $row['customer_name'] ?></a></td>
                                            <td><?= $row['mobile'] ?></td>
                                          <!-- <td><?= $row['item_name'] ?></td>  -->
                                            <td><?= $row['total'] ?></td>
                                            <!-- <td><?= $row['selling_price'] ?></td> -->
                                            <!-- <td><?= $row['serial_no'] ?></td> -->
                                            <!-- <td><?= $row['model_no'] ?></td> -->
                                            <td><?= $row['staff_name'] ?></br><?= $row['created_at'] ?></td>
                                           
                                           
                                           
                                        </tr>
                                        
                                       <?php } ?>
                                    </tbody>
                                    <?php if($total!=0) { ?>
                                    <tfoot>
                                      <td colspan="3"></td>
                                      <td><b><?= $total ?></b> &#8377</td>
                                      <td></td>
                                      <!-- <td></td> -->
                                    </tfoot>
                                  <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <!-- Jquery DataTable Plugin Js -->
      <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
   
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