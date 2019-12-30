<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>sales/payment_list" method="post">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
      <div class="body">
        <div class="row clearfix">
         
        <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            DATE RANGE
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" id="daterange" name="date_range" placeholder="select date range" autocomplete="off" required>
                                        </div>
                                    </div>
                                </div>
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <button type="submit"    class="btn btn-primary form-control" >SEARCH</button>
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
                          <div class="row">
                            <div class="col-md-8">
                            <h2>
                            	PAYMENT RECEIVED
                                <!-- STOCK LIST -->
                            </h2>
                          </div>
                          <div class="col-md-4" align="right">
                            <a href="<?= base_url() ?>sales/reciept" class="btn btn-info">ADD PAYMENT</a>
                          </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Payment Date</th>
                                            <th>Payment ID #</th>
                                            <!-- <th>Order id#</th> -->
                                            <th>Invoice id#</th>
                                            <!-- <th>Customer Name</th> -->
                                            <th>Method</th>
                                            <th>Amount Paid(&#8377)</th>
                                            <!-- <th>Serial No</th> -->
                                         
                                           
                                            <!-- <th>Action</th> -->
                                          
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                    	<?php 
                                        $total=0;
                                        foreach($payment as $row)
                                    	{ 
                                            $total+=$row['amount'];
                                                

                                            ?>
                                        <tr>
                                            <td><?= $row['payment_date'] ?></td>
                                            <td><a href="<?= base_url() ?>sales/reciept_view/<?= $row['payment_id'] ?>" target="_blank"> <?= $row['payment_id'] ?></a></td>
                                         <?php     $invoice_id_array=json_decode($row['invoice_id_json'],1);     
                                            $string_version = @implode(',', $invoice_id_array);
                                          // print_r($string_version);
                                         ?>
                                            <td><?= $string_version ?></td>
                                            <!-- <td><?= $row['customer_name'] ?></td>  -->
                                            <td><?= $row['payment_method'] ?></td>
                                            <td><?= $row['amount'] ?></td>
                                           
                                        
                                            <!--  <td>
                                            	<div class="btn-group" role="group">
                                            	<a href="<?= base_url() ?>item/edit_item/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a>
                                            	<a data-toggle="tooltip" title="Add Quantity" href="<?= base_url() ?>item/add_more_item/<?= $row['id'] ?> " class="btn btn-success waves-effect"><i class="material-icons">add</i></a>
                                            </div>
                                            </td> -->
                                    <!-- <button type="button" class="btn btn-default waves-effect">LEFT</button>
                                    <button type="button" class="btn btn-default waves-effect">MIDDLE</button>
                                    <button type="button" class="btn btn-default waves-effect">RIGHT</button> -->
                               				 
                                            <!-- <td><a href="<?= base_url() ?>/item/edit/<?= $row['id'] ?>" class="btn btn-primary waves-effect"><i class="material-icons">create</i></a></td> -->
                                           
                                        </tr>
                                            









                                       <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        
                                        <td colspan="4" align="center"><strong>Total Payment (&#8377)</strong></td>
                                        <td><strong><?= $total ?> &#8377</strong></td>
                                        <!-- <td colspan="1"></td> -->
                                        
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

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
       <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="<?= base_url() ?>assets/admin/js/pages/tables/jquery-datatable.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
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
</script>