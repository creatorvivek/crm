<div class="row clearfix">
    <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>ADD NEW SELLER</h2>
                
            </div>
            <div class="body">
                <form id="form_validation" method="POST"  action="<?= base_url() ?>super_admin/add">
                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="company_name" required="" aria-required="true" value="<?= $this->input->post('company_name'); ?>" >
                            <label class="form-label">Company Name <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('company_name');?></span>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" required="" value="<?= $this->input->post('name'); ?>" aria-required="true" >
                            <label class="form-label">Seller Name <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('name');?></span>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="mobile" required="" aria-required="true" value="<?= $this->input->post('mobile'); ?>" onkeypress="return isNumberKey(event)" maxlength="10">
                            <label class="form-label">Mobile <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('mobile');?></span>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" required="" value="<?= $this->input->post('email'); ?>" aria-required="true">
                            <label class="form-label">Email <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('email');?></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-12"> -->
                        <div class="form-group form-float">
                          <div class="form-line">
                       <textarea class="form-control" name="address" required="" ><?= $this->input->post('address'); ?></textarea>
                              <label class="form-label">Address <span class="col-pink">*</span></label>
                              <span class="text-danger"><?= form_error('address');?></span>
                       </div>
                      </div>
                     <!-- </div> -->    
                     <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="city" required="" aria-required="true" value="<?= $this->input->post('city'); ?>" onkeypress="return isAlpha(event)">
                            <label class="form-label">City <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('city');?></span>
                        </div>
                    </div>
                     <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="pincode" required="" aria-required="true" value="<?= $this->input->post('pincode'); ?>" onkeypress="return isNumberKey(event)" maxlength="6">
                            <label class="form-label">Pincode <span class="col-pink">*</span></label>
                            <span class="text-danger"><?= form_error('pincode');?></span>
                        </div>
                    </div>
                     <div class="form-group">
                        <!-- <p>Gender</p> -->
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male" <?php echo  set_radio('gender', 'male'); ?> >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php echo  set_radio('gender', 'female'); ?>>
                                    <label for="female" class="m-l-20">Female</label>
                                    <span class="text-danger"><?= form_error('gender');?></span>
                                </div>
                     <div class="form-group form-float">
                    <select class="form-control show-tick" name="type" required >
                        <option value="">----Select Type-----</option>
                        <option value="1" <?=  set_select('type', '1'); ?> >Service Based</option>
                        <option value="2" <?=  set_select('type', '2'); ?>>Product Based</option>
                        <option value="3" <?=  set_select('type', '3'); ?>>Service & Product Based</option>
                    </select>
                    <span class="text-danger"><?= form_error('type');?></span>
                </div>
                    
                     <div class="form-group">
                    <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<!-- <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script> -->
<script type="text/javascript">
$('#form_validation').validate({
rules: {
'type': {
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