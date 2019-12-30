<div class="row clearfix">
 <!--  <div class="col-md-12">
    <div class="card">
        <form action="<?= base_url() ?>account/invoice_list" method="post">
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
         
            <button type="submit"   class="btn btn-primary form-control" >SEARCH</button>
          </div>
        </div>
        <div class="col-md-5 pull-right">
         <div class="form-group">
          
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
</div> -->
</div>



<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             Leave Application
                                <!-- STOCK LIST -->
                            </h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="invoiceTable">
    <thead>
    <tr>
        
        <th>From</th>
        <th>To</th>
        <th>leave Category</th>
        <th>status</th>
        <th>reason</th>
       
        <th>created at</th>
      
    </tr>
    </thead>
    <tbody>

    <?php 
      


    foreach ($leave_application as $row) { 



      ?>
        <tr>
          
          
             <td><?= $row['start_date'] ?></td>
              <td><?= $row['end_date'] ?></td>
              <td><?= $row['category_name'] ?></td>
             <!-- <td><?=$row['created_at'] ?></td> -->
             <td><span class="label <?php if($row['status']==0){
              echo 'label-danger';
              $status='pending';

              } else if($row['status']==1){
                echo 'label-success';
                 $status='Approved';
              } else{
                echo 'label-danger';
                 $status='rejected';
              }
                ?>"><?= $status ?></span></td>
                <td><?= $row['reason'] ?></td>
            <td class="date"> <?=  date('j F Y ', strtotime( $row['created_at']) ) ; ?><br>
            <?=  date('h :i a', strtotime($row['created_at']) ) ; ?></td>
            <!-- <td><select><option value="">--select--</option><option value="1">Approved</option><option value="2">reject</option></select></td> -->
            
        </tr>
    <?php } ?>
    </tbody>
   
</table>
</div>


</div>
</div>


      <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    
<script>
    $(document).ready( function () {
        $('.js-basic-example').DataTable();
    } );
     
   
</script>
