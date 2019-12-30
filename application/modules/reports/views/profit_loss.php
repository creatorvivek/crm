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
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2 align="center">
                                  <!-- <?= ucfirst($company_name) ?> -->
                                  <div style="font-size: 24px" align="center">PROFIT & LOSS</div>
                            </h2>
                            
                        </div>
                        <div class="body">
<div class="table-responsive">
  <table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
   
       
        <th>Particulars</th>
       
        <!-- <th>Amount</th> -->
        
        <th>AMOUNTS</th>
         <!-- <th>Particulars</th> -->
        <!-- <th>CREDIT</th> -->
        <!-- <th>Balance</th> -->
    
      </tr>
    </thead>
    <tbody>
      <?php foreach ($account_group as $row) { ?>
        <tr>
       <td><?= $row['group_name'] ?></td>
       <td><?= $row['debit'] ?></td>
     </tr>
       <!-- <td><?= $row['group_name'] ?></td> -->
      <?php  } ?>
 

     
              </tbody>
             
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

        

           <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
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
     </script>