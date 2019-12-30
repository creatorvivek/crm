<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>ADD PAYHEAD</h2>

      </div>
      <div class="body">
        <form id="form_validation" method="POST"  action="<?= base_url() ?>payroll/add_payhead">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" class="form-control" name="payhead_name" required="" aria-required="true" >
              <label class="form-label">Payhead Name <span class="col-pink">*</span></label>
            </div>
          </div>
          

          <div class="form-group form-float">
            <div class="form-line">
              <textarea class="form-control" name="description" required></textarea>
              <label class="form-label">Description<span class="col-pink">*</span></label>
            </div>
          </div>
           <div class="form-group">
          <select class="form-control show-tick" name="payhead_type" required>

            <option value=""> --select --</option>
            <option value="1">Addition</option>
            <option value="2">Deduction</option>
            
            
          </select>
        </div>
          

          <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
        </form>
      </div>
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>
         PAYHEAD LIST
         <!-- STOCK LIST -->
       </h2>

     </div>
     <div class="body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="invoiceTable">
          <thead>
            <tr>

              <th>Payhead name</th>
              <th>Payhead type</th>
    
              <th>Actions</th>
      </tr>
    </thead>
    <tbody>

      <?php 
      


      foreach ($payhead_list as $row) { 



        ?>
        <tr>


         <td><?= $row['payhead_name'] ?></td>

<?php if($row['payhead_type']==1)
{

  $payhead='Addition';
}
else
{
  $payhead='Deduction';
}
?>
         <td>


          <?= $payhead ?></td>
          <td></td>

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
</div>



<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script> -->
<script type="text/javascript">
 $('#form_validation').validate({
  rules: {
    'checkbox': {
      required: true
    },
    'gender': {
      required: true
    }
  },
  highlight: function (input) {
    $(input).parents('.form-line').addClass('error');
  },
  unhighlight: function (input) {
    $(input).parents('.form-line').removeClass('error');
  },
  errorPlacement: function (error, element) {
    $(element).parents('.form-group').append(error);
  }



});
</script>