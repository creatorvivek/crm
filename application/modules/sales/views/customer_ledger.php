<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
   
        <th>DATE</th>
        <th>INVOICE NUMBER</th>
  
        <th>PAYMENT ID</th>
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
                <td><a href="<?= base_url() ?>account/customer_outstanding_balance/2" class="btn btn-info">Outstanding Balance</a></td>
                  <td class="text-right" colspan="2"><b>BALANCE</b></td>
                  <td align="center" colspan="2"><strong><?= $balance=$debit_sub-$credit_sub;?></strong></td>

                  <td></td>

                </tr>

              </tfoot>
            </table>
          </div>