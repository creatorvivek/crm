<div class="row clearfix">
	<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
		<div class="card">
			<div class="header">
				<h2>LEAVE APPLICATION</h2>

			</div>
			<div class="body">
				<form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>leave/add_leave_request">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
					<p>
						Leave category<span class="col-pink">*</span>
					</p>
                    <div class="row clearfix">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                           <div class="form-group">
                              <select class="form-control show-tick method" id="method" name="category_name" required>
                                 <option value="">--Select --</option>
                                 <?php 
                                 foreach($leave_category as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['category_name'] ?></option>
                                <?php	endforeach; ?>
                                ?>
                            </select>
                            <span class="error"><?= form_error('category_name');?></span>
                        </div>
                    </div>
					<!-- <div class="form-group form-float">
						<div class="form-line">
							<input type="text" class="form-control" name="category_name" required="" aria-required="true" value="<?= $this->input->post('category_name'); ?>" >
							<label class="form-label">Leave Category Name <span class="col-pink">*</span></label>
							<span class="error"><?= form_error('category_name');?></span>
						</div>
					</div> -->

					<!-- <div class="col-xs-6"> -->

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h2 class="card-inside-title">Range</h2>
                      </div>
                       <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                          <!-- <div class="input-daterange input-group" id="bs_datepicker_range_container"> -->
                                        <!-- <div class="form-line">
                                            <input type="text" class="form-control" name="from" placeholder="Date start...">
                                            
                                        </div> -->
                                        <div class="form-group form-float">
                                        	<div class="form-line">
                                        		<input type="text" class="form-control datemask" required  readonly='true'  name="from"  placeholder="Date start...">
                                        		<span class="error"><?= form_error('from');?></span>
                                        	</div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                     <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                                        <span class="input-group-addon">to</span>
                                    </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                             <div class="form-group form-float">
                                            <div class="form-line">
                                               <input type="text" class="form-control datemask2" required  readonly='true'  name="to"  placeholder="Date end...">
                                               <span class="error"><?= form_error('to');?></span>
                                           </div>
                                       </div>
                                       </div>
                                   
                                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                           <div class="form-line">
                                              <textarea class="form-control" name="reason" required></textarea>
                                              <label class="form-label">Reason <span class="col-pink">*</span></label>
                                              <span class="error"><?= form_error('reason');?></span>
                                          </div>
                                      </div>
                                  </div>
                              
                                  <!-- </div> -->

                                  <!-- <div class="col-md-3"> -->
                                   <!-- </div> -->
                                   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                       <button class="btn btn-primary waves-effect" type="submit">ADD</button>
                                   </div>
                               </div>
                                   </form>
                               </div>
                           </div>
                       </div>



                       <!-- Bootstrap Datepicker Plugin Js -->
                       <script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
                       <script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

                       <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
                       <script type="text/javascript">

// $(function () {
    //Textarea auto growth


    //Bootstrap datepicker plugin
    // $('#bs_datepicker_container input').datepicker({
    //     autoclose: true,
    //     container: '#bs_datepicker_container'
    // });

    // $('#bs_datepicker_component_container').datepicker({
    //     autoclose: true,
    //     container: '#bs_datepicker_component_container'
    // });
    
    // $('#bs_datepicker_range_container').datepicker({
    //     autoclose: true,
    //     container: '#bs_datepicker_range_container'
    // });
// });
$(document).ready(function() {


	$( ".datemask" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     // yearRange: '1950:2012'
     // maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


 });
	$( ".datemask2" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     // yearRange: '1950:2012'
     // maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


 });
});

function date_validation()
{



}


</script>




