  
  

  <div class="row clearfix">
  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>reports/profit_analysis" method="post">
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







<div class="col-md-6">
    <div class="body">
                            <div class="list-group">
                                <a href="javascript:void(0);" class="list-group-item">
                                    <span class="badge bg-pink"><?= isset($purchase_sum)?$purchase_sum:'' ?></span> Purchase
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <span class="badge bg-cyan"><?= isset($sales_sum)?$sales_sum:'' ?></span>Sales
                                </a>
                                <a href="javascript:void(0);" class="list-group-item">
                                    <span class="badge bg-teal"><?= isset($profit)?$profit:'' ?></span>Profit
                                </a>
                               
                            </div>
                        </div>
                   
           </div>
    <script src="<?= base_url() ?>assets/admin/plugins/chartjs/Chart.bundle.js"></script>
    

   
 <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/moment.js"></script>
     <script src="<?= base_url() ;?>assets/admin/plugins/daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript">
  
    
    
     
     $(function () {

    $('#daterange').daterangepicker(
    {
      ranges: {
        // 'Today': [moment(), moment()],
        // 'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Last 3 Month': [moment().subtract(3, 'month'), moment()],
        'Last 6 Month': [moment().subtract(6, 'month'), moment()],
        'Last 9 Month': [moment().subtract(9, 'month'), moment()],
        'Last 12 Month': [moment().subtract(12, 'month'), moment()],
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
