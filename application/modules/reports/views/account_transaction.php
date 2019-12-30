<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>reports/account_transaction_report" method="post">
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

                           
        <div class="col-md-1">
          <div class="form-group">
            <!-- <label>dfsdf </label> -->
            <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-5 ">
         <div class="form-group">
           <!-- <label> </label> -->
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
           Date Rang: <?php echo  $this->input->post('date_range')?>
           <!-- Vendor :  <?php echo $this->input->post('vendor_id') ?> -->
         </div>
       </div>
        <div class="col-md-3 pull-right">
              <button type="button" class="btn btn-success" onclick="print()">Print</button>
       </div>
     </div>
   </div>
 </form>
 </div>
</div>
</div> 
                  
  <div class="account_transaction">
  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 align="center">
                                  <?= ucfirst($company_name) ?>
                                  <div style="font-size: 24px" align="center">ACCOUNT TRANSACTION</div>
                            </h2>
                            
                        </div>
                        <div class="body">
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
   
        <th>DATE</th>
        <th>ACCOUNT</th>
        <!-- <th>Transaction Detail</th> -->
        <th>TRANSACTION TYPE</th>
        <th>TRANSACTION</th>
        <!-- <th>INVOICE NUMBER</th> -->
  
        <!-- <th>PAYMENT ID</th> -->
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
      for ($k=0;$k<count($transaction);$k++) {  
       $credit_sub += $transaction[$k]['credit']; 
       $debit_sub += $transaction[$k]['debit']; 


       ?>
       <tr>
        <td> 
          <?=  date('j F Y ', strtotime( $transaction[$k]['created_at']) ) ; ?><br>
        </td>
        <td><?= $transaction[$k]['group_name'] ?> </td>
        <td><?= $transaction[$k]['type'] ?> </td>
        <?php switch($transaction[$k]['reference_type'])
        {
          case 1:
          $trans="<a href=".base_url()."sales/sales_invoice_view/".$transaction[$k]['invoice_id']." data-toggle='tooltip' title='click to view invoice' target='_blank'>".$transaction[$k]['invoice_id'] ."</a>";
            break;
            case 2:

            $trans="<a href=".base_url()."sales/reciept_view/".$transaction[$k]['reciept_id']." data-toggle='tooltip' title='click to view reciept'  target='_blank'>". $transaction[$k]['reciept_id']." </a>"; 
            break;
            case 3:
            $trans="<a href=".base_url()."item/purchase_order_view/".$transaction[$k]['reciept_id']." data-toggle='tooltip' title='click to view bill'  target='_blank'>". $transaction[$k]['reciept_id']." </a>";
            
            $trans='';
            break;
            default:
            $trans="";


        }
        ?>
        <td><?= $trans ?></td>
        <!-- <td><a href="<?= base_url() ?>sales/sales_invoice_view/<?= $transaction[$k]['invoice_id'] ?>" target="_blank"><?= $transaction[$k]['invoice_id'] ?></a></td> -->
       <!--  <td><a href="<?= base_url() ?>sales/reciept_view/<?= $transaction[$k]['reciept_id'] ?>" target="_blank"><?= $transaction[$k]['reciept_id'] ?> </a></td> -->
        <td><?= $transaction[$k]['debit'] ?>  </td>
        <td><?= $transaction[$k]['credit'] ?> </td>
        <td><?= $debit_sub- $credit_sub   ?></td> 


                  </tr>



                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                 <td colspan="4"></td>

               
                 <td><strong><?= $debit_sub ?></strong></td>
                 <td><strong><?= $credit_sub ?></strong></td>
                 <td></td>

               </tr>
               <tr>
                <!-- <td><a href="<?= base_url() ?>account/customer_outstanding_balance/2" class="btn btn-info">Outstanding Balance</a></td> -->
                  <td class="text-right" colspan="4"><b>BALANCE</b></td>
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
        

           <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
     <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
     <script>
     
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
                              $(".account_transaction").printMe({path:["<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css","<?= base_url() ?>assets/admin/print.css"]});
                             
                            }
     </script>