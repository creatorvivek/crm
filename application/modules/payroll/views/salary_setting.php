<style type="text/css">
  
  .form-groups label.error {
    font-size: 12px;
    display: block;
    margin-top: 5px;
    font-weight: normal;
    color: #F44336; }
</style>



<div class="row clearfix">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>SALARY SETTING</h2>

			</div>
			<div class="body">
				<form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>payroll/add_salary_setting">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <p>
              Department <span class="col-pink">*</span>
            </p>
            <div class="form-groups">
              <select class="form-control  show-tick method" id="designation_id" name="designation" onchange="fetch_employee()" required="" autofocus>
               <option value="">--Select --</option>
               <?php 
               foreach($department as $row): ?>
                <option value="<?= $row['id'] ?>"  <?=  set_select('designation',''. $row['id']. '') ?> >  <?= $row['name'] ?></option>
              <?php	endforeach; ?>

            </select>
            <span class="error"><?= form_error('designation');?></span>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>
              <?= $staff_name ?>  Name <span class="col-pink">*</span>
            </p>
            <div class="form-groups">
              <select class="form-control form-group" id="staff_fetch" name="employee" required="" >
                <option value="">--Select --</option>
                <!-- <option value="6">Anurag</option> -->

              </select>
              
            </div>
          </div>
          
        </div>
        <div class="row clearfix">
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
          <p>
           Payhead <span class="col-pink">*</span>
         </p>
         <div class="form-groups">
          <select class="form-control show-tick method"  name="payhead" required>
            <option value="">--Select --</option>

            <?php foreach($payhead as $row): ?>
              <option value="<?= $row['id'] ?>" <?=  set_select('payhead',''. $row['id']. '') ?> ><?= $row['payhead_name'] ?></option>
            <?php   endforeach; ?>
          </select>
          <span class="error"><?= form_error('payhead');?></span>
        </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <p>
           Unit type <span class="col-pink">*</span>
         </p>
         <div class="form-groups">
          <select class="form-control show-tick method"  name="unit_type" required>
            <option value="">--Select --</option>
            <option value="1" <?=  set_select('unit_type','1') ?>  >Amount</option>    
            <option value="2" <?=  set_select('unit_type', '2') ?> >Percentage</option>    

          </select>
          <span class="error"><?= form_error('unit_type');?></span>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
         <p>
           Unit <span class="col-pink">*</span>
         </p>
         <div class="form-group form-float" data-toggle="tooltip" title="unit is number example-5">
          <div class="form-line">
            <input type="text" class="form-control" name="unit" required=""  onkeypress="return isNumberKey(event);" aria-required="true" >
            <!-- <label class="form-label">Unit </label> -->
            <span class="error"><?= form_error('unit');?></span>
          </div>
        </div>
      </div>
        <!--   <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
            <button type="button" class="btn btn-info">+</button>
          </div> -->
        </div>
        <!-- </div> -->
<span class="error"><?= form_error('employee');?></span>
        <!-- <div class="col-md-3"> -->
         <!-- </div> -->
         <button class="btn btn-primary waves-effect" type="submit">ADD</button>
       </form>
     </div>
   </div>
 </div>

 <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
  <div class="card">
    <div class="header">
      <h2>
       SALARY SETTING LIST
       <!-- STOCK LIST -->
     </h2>

   </div>
   <div class="body">
    <div class="table-responsive">
      <table class="table table-bordered table-striped table-hover js-basic-example dataTable" >
        <thead>
          <tr>

            <th>Name</th>
            <th>Payhead</th>
            <th>unit</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php 



          foreach ($list_salary_setting as $row) { 



            ?>
            <tr>


             <td><?= $row['name'] ?></td>

            
            <td><?= $row['payhead_name'] ?></td>


           
              <td><span class="badge"><?= $row['payhead_type'] ?></span>  <?=  $row['unit'].' '.$row['type'] ?> </td>
               <td>
                  
                  <div class="btn-group" role="group">
                    <a href="#" onclick="delFunction(<?= $row['id'] ?>)"  class="btn btn-danger"><i class="material-icons">delete</i></a>
                    <a href="<?= base_url() ?>crn/update/<?= $row['id'] ?>" class="btn btn-primary waves-effect" data-toggle="tooltip" data-placement="top" title="edit"><i class="material-icons">create</i></a>
                   
                  
                  </div>
                  
               
                </td>

            </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>


  </div>
</div>
</div>
</div>


  <!-- Bootstrap Datepicker Plugin Js -->
  <script src="<?= base_url() ?>/assets/admin/plugins/sweetalert/sweetalert.min.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
  <script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

  <!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script> -->
  <script type="text/javascript">


    $(document).ready(function() {
 $('.js-basic-example').DataTable();

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
    $(element).parents('.form-groups').append(error);
    $(element).parents('.form-group').append(error);
  }


    });
});

    function fetch_employee()
    {

      var designation_id=$('#designation_id').val();

      $.ajax({
        type: "post",
        url: "<?= base_url() ?>staff/fetch_staff",
        data:{designation_id:designation_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
        success: function (data) {

          var obj=JSON.parse(data);
          var row='';
          for(var i=0;i<obj.length;i++)
          {
            row+='<option value="'+obj[i]['id']+'">'+obj[i]['name']+'</option>'    
          }
          console.log(row);
          $('#staff_fetch').append(row);    
        },
        error:function(data)
        {
          console.log('error');
        },
      });
    }
 function delFunction(id)
        {
     swal({
      title: "Are you sure?", 
      text: "Are you sure that you want to delete this id?", 
      type: "warning",
      showCancelButton: true,
      closeOnConfirm: false,
      confirmButtonText: "Yes, delete it!",
      confirmButtonColor: "#ec6c62"
    }, function() {
      $.ajax({
        url: "<?= base_url() ?>payroll/remove_salary_setting/"+id,
        type: "DELETE"
      })
      .done(function(data) {
        swal("Deleted!", "Your file was successfully deleted!", "success");
         $('#'+id+'').fadeOut(300);
      })
      .error(function(data) {
        swal("Oops", "We couldn't connect to the server!", "error");
      });
    });
  }
</script>
  </script>




