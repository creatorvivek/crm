<style type="text/css">
  @media print{

  .button_print
  {
    display: none;
  }  
}

 /*.button_print
  {
    display: none;
  } */ 
</style>




<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>reports/customer_ledger_report" method="post">
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
                          <select class="form-control" name="customer_id">
                            <option value="">--Select Customer</option>
                            <?php foreach ($customers as $row) {  ?>
                                <option value="<?= $row['id'] ?>"  <?=  set_select('customer_id',''. $row['id']. '') ?>   ><?= $row['name'] ?></option>
                          <?php }  ?>
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
                  
<?php if(isset($customer_ledger))  {  ?>
  <div class="customer_ledger">
  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <div class="row clearfix">
                             <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <h2>
                            Customer Ledger 
                            </h2>
                             </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 button_print" align="right">
                            <button class="btn btn-info" onclick="print()">Print</button>
                           </div>
                        </div>
                      </div>
                        <div class="body">
                          <div class="name_heading" align="center">
                            <!-- fdgdfgfdg -->
                            <?= $customer_name['name'] ?>
                            </div>
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover js-exportabe">
    <thead>
      <tr>
   
        <th>DATE</th>
        <th>INVOICE NUMBER</th>
  
        <th>RECIEPT ID</th>
        <th>DEBIT</th>
        <th>CREDIT</th>
        <th>Balance</th>
    
      </tr>
    </thead>
    <tbody>



      <?php 
      $credit_sub = 0;
      $debit_sub = 0;
      $debit_sum=0;
      $credit_sum=0;
      for ($k=0;$k<count($customer_ledger);$k++) {  
       $credit_sub += $customer_ledger[$k]['credit']; 
       $debit_sub += $customer_ledger[$k]['debit']; 


       ?>
       <tr>
        <td> 
          <?=  date('j F Y ', strtotime( $customer_ledger[$k]['created_at']) ) ; ?><br>

        </td>
        <td><a href="<?= base_url() ?>sales/sales_invoice_view/<?= $customer_ledger[$k]['invoice_id'] ?>" target="_blank"><?= $customer_ledger[$k]['invoice_id'] ?></a></td>
        <td><a href="<?= base_url() ?>sales/reciept_view/<?= $customer_ledger[$k]['reciept_id'] ?>" target="_blank"><?= $customer_ledger[$k]['reciept_id'] ?> </a></td>
        <td><?= $customer_ledger[$k]['debit'] ?>  </td>
        <td><?= $customer_ledger[$k]['credit'] ?> </td>
        <td><?= $debit_sub- $credit_sub   ?></td> 


                  </tr>



                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                 <td colspan="3"></td>

               
                 <td><strong><?= $debit_sub ?></strong></td>
                 <td><strong><?= $credit_sub ?></strong></td>
                 <td></td>

               </tr>
               <tr>
                <td><a href="<?= base_url() ?>account/customer_outstanding_balance/<?= $customer_id ?>" class="btn btn-info button_outstanding">Outstanding Balance</a></td>
                  <td class="text-right" colspan="2"><b>BALANCE</b></td>
                  <td align="center" colspan="2"><strong><?= $balance=$debit_sub-$credit_sub;?></strong></td>

                  <td></td>

                </tr>

              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
          <?php }  ?>

           <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
      <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
      <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
        <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
     <script>
        $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        title:'LEDGER',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
     });
      $(document).ready( function () {
   
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

 function print()
                      {
                              $(".customer_ledger").printMe({path:["<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css","<?= base_url() ?>assets/admin/print.css"]});
                             
                   }
     </script>