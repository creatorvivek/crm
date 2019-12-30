<link href="<?= base_url() ?>/assets/admin/plugins/animate-css/animate.css" rel="stylesheet" />

<div class="row clearfix">
  <div class="col-lg-16 col-md-12 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">

      </div>         <!-- Nav tabs -->

      <div class="body">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
          <!-- <li role="presentation" class="active"><a href="#home_animation_2" data-toggle="tab">HOME</a></li> -->
          <li role="presentation" class="active"><a href="#profile_animation_2" data-toggle="tab">INVOICES</a></li>
          <li role="presentation"><a href="#messages_animation_2" data-toggle="tab">RECIEPTS</a></li>
          <li role="presentation"><a href="#settings_animation_2" data-toggle="tab">LEDGER</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
         <!--  <div role="tabpanel" class="tab-pane animated fadeInRight" id="home_animation_2">

         </div> -->
         <div role="tabpanel" class="tab-pane   active" id="profile_animation_2">
          <!-- <b>Profile Content</b> -->
          <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Invoice Number #</th>
                  <th>Customer Name</th>
                  <th>Base Amount</th>
                  <th>Total Amount</th>
                  <th>Date</th>
                  <th>status</th>

                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
               <?php   $count=1; ?>
               <?php foreach ($customer_invoice as $row) { ?>
                <tr>
                  <td><?=$count++ ?></td>
                  <td data-toggle="tooltip" data-placement="top" title="click to view invoice details" ><a href="<?= base_url() ?>sales/sales_invoice_view/<?=$row['invoice_id'] ?>"><?=$row['invoice_id'] ?> </a></td>
                  <td data-toggle="tooltip" data-placement="top" title="click to view" ><?=$row['name'] ?> </td>
                  <td><?=$row['amount'] ?></td>
                  <td><?=$row['total'] ?></td>
                  <!-- <td><?=$row['created_at'] ?></td> -->
                  <td class="date"> <?=  date('j F Y ', strtotime( $row['created_at']) ) ; ?><br>
                    <?=  date('h :i a', strtotime($row['created_at']) ) ; ?></td>
                    <td><span class="label <?php if($row['status']=='pending'){
                      echo 'label-danger';} else if($row['status']=='partially'){
                        echo 'label-warning';
                        } else{
                          echo 'label-success';
                        }
                        ?>"><?= $row['status'] ?></span></td>
                        <td><a href="<?= site_url('account/get_invoice/'.$row['invoice_id']); ?>" class="btn btn-info btn-xs" target="_blank">Get Pdf</a> 
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>  

            </div>
            <div role="tabpanel" class="tab-pane" id="messages_animation_2">
              <!-- <b>Message Content</b> -->
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                  <thead>
                    <tr>
                      <th>Reciept id</th>
                      <th>Invoice number</th>
                      <!-- <th>Customer Name</th> -->
                      <th>Paid amount</th>
                      <th>Payment method</th>
                      <th>Date</th>
                      <!-- <th>status</th> -->

                      <!-- <th>Actions</th> -->
                    </tr>
                  </thead>
                  <tbody>
                   <?php   $count=1; ?>
                   <?php foreach ($customer_payments as $row) { ?>
                    <tr>
                      <td><a href="<?= base_url() ?>sales/reciept_view/<?=$row['payment_id'] ?>" target="_blank"><?= $row['payment_id'] ?></td>
                        <td><a href="<?= base_url() ?>sales/sales_invoice_view/<?=$row['invoice_id'] ?>" ><?=$row['invoice_id'] ?> </a></td>
                        <td data-toggle="tooltip" data-placement="top" title="paid amount" ><?=$row['amount'] ?> </td>
                        <td><?=$row['payment_method'] ?></td>
                        <td><?=$row['payment_date'] ?></td>


                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>  
            </div>
            <div role="tabpanel" class="tab-pane" id="settings_animation_2">

              <div class="center" align="center"><h3><?= $customer_detail['name'] ?></h3></div> 
              <br>
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <!-- <th>PAYMENT ID</th> -->
                      <th>Date</th>
                      <th>Invoice number</th>
                      <!-- <th>Customer Name</th> -->
                      <th>Payment id</th>
                      <th>Debit</th>
                      <th>Credit</th>
                      <th>Balance</th>
                      <!-- <th>status</th> -->

                      <!-- <th>Actions</th> -->
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
                        <?=  date('j F Y ', strtotime($customer_ledger[$k]['created_at']) ) ; ?><br>

                      </td>
                      <td><a href="<?= base_url() ?>sales/sales_invoice_view/<?= $customer_ledger[$k]['invoice_id'] ?>" target="_blank"><?= $customer_ledger[$k]['invoice_id'] ?></a></td>
                      <td><a href="<?= base_url() ?>sales/reciept_view/<?= $customer_ledger[$k]['reciept_id'] ?>" target="_blank"><?= $customer_ledger[$k]['reciept_id'] ?> </a></td>
                      <td><?= $customer_ledger[$k]['debit'] ?>  </td>
                      <td><?= $customer_ledger[$k]['credit'] ?> </td>
                      <td><?= $debit_sub - $credit_sub   ?></td> 
                         

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
                <td><a href="<?= base_url() ?>account/customer_outstanding_balance/<?= $customer_id ?>" class="btn btn-info">Outstanding Balance</a></td>
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
</div>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script type="text/javascript">
  $(document).ready( function () {
    $('.js-basic-example').DataTable(
    {
  // "order": [[ 4, 'desc' ]],
// "processing": true
});
  } );

   // $('.js-exportable').DataTable({
   //      dom: 'Bfrtip',
   //      responsive: true,
   //      title:'LEDGER',
   //      buttons: [
   //          'copy', 'csv', 'excel', 'pdf', 'print'
   //      ]
   //   });
 </script>
 


