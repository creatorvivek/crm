  
<div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>reports/balance_sheet" method="post">
          <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
      <div class="body">
        <div class="row clearfix">
         
        <div class="col-md-3">
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
        
            <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-3">
         <div class="form-group">
        
           <?php
           $date_rang = (!empty($this->input->post('date_range')))? $this->input->post('date_range'): 'Please select date range';
           ?>
            Date Rang: <?=  $this->input->post('date_range')?>
         
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






    <div class="balance_sheet">
  <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 align="center">
                                Balance Sheet
                            </h2>
                            <h4 align="center"><?= $company_name['company_name'] ?></h4>
                            <h5 align="center"><?=  $this->input->post('date_range')?></h5>
                        </div>
                        <div class="body">
                          <div class="row clearfix">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                <table class="table">
                                    <thead><tr>
                                        <td><b>Liabilities & Equities</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                       <td><b> current liabilities</b></td>
                                    </tr>
                                    <tr>
                                        <td>Accounts Payable</td>
                                        <td><?= $account_payable ?></td>
                                    </tr> 
                                    <tr>
                                        <td>Gst Payable</td>
                                        <td><?= $gst_payable ?></td>
                                    </tr>
                                    <tr>
                                        <td>Opening balance adjustment</td>
                                        <td><?= $opening_balance_adjustment ?></td>
                                    </tr>
                                    <tr>
                                        <!-- <td></td> -->
                                        <td><b>TOTAL CURRENT LIABILITIES  </b></td>
                                        <td><b><?= $total_current_liabilities ?></b></td>
                                    </tr>
                                    <!-- <hr> -->
                                    <tr><td><b>Equities</b></td><td><?= $equities ?></td></tr>
                                    <tr>
                                        <td><b>TOTAL LIABILITIES & EQUITIES</b></td>
                                        <td><b><?= $total_liabilities_equities ?></b></td>
                                    </tr>
                                </tbody>
                                </table>
                          </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <table class="table">
                                    <thead>
                                        <tr>
                                            <td><b>Assets</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Cash</td>
                                        <td><a href="<?= base_url() ?>reports/account_transaction_ledger/10"><?= $cash ?></a></td>
                                    </tr>
                                    <tr>
                                        <td>Account Receivable</td>
                                        <td><?= $account_recieve ?></td>
                                    </tr>
                                    <tr><td><b>TOTAL CURRENT ASSETS</b>    </td>
                                        <td><b><?= $total_current_assets ?></b></td>
                                    </tr>
                                    
                                    <tr>
                                       <td><b> Other assets</b></td>
                                    </tr>
                                    <tr>
                                        <td>Inventory Asset</td>
                                        <td><?= $inventory_assets ?></td>
                                    </tr>
                                    <tr rowspan="3"><td></td></tr>
                                    <tr><td></td></tr>
                                    <tr>
                                        <td><b>TOTAL ASSETS</b></td>
                                        <td><b><?= $total_assets ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                           </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
<script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script> 
            <script src="<?= base_url() ?>assets/jquery-printme.min.js"></script>
            <script type="text/javascript">
                $('#daterange').daterangepicker(
    {
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Current financial year':[moment().month('April').startOf('month'),moment().add('year', 1).month('March').endOf('month')],
        'Previous financial year': [moment().subtract('year', 1).month('April').startOf('month'),moment().month('March').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate: moment()
    },
    function (start, end) {
      $('#daterange').val(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
    }
    );
            
                        
                            function print()
                            {
                              $(".balance_sheet").printMe({path:["<?= base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css","<?= base_url() ?>assets/admin/print.css"]});
                             
                            }

                            
                          </script>  