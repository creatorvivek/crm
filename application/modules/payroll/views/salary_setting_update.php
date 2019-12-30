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
				<form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>payroll/salary_setting_update/">
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