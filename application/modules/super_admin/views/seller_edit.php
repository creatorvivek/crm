<div class="row clearfix">
    <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>EDIT SELLER</h2>
                
            </div>
            <div class="body">
                <form id="form_validation" method="POST"  action="<?= base_url() ?>super_admin/edit/<?= $seller[0]['id'] ?> ">
                     <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="company_name" required="" value="<?= ($this->input->post('company_name') ? $this->input->post('company_name') : $seller[0]['company_name']); ?>" aria-required="true" >
                            <label class="form-label">Company Name</label>
                             <span class="text-danger"><?= form_error('company_name');?></span>
                        </div>
                    </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" required="" aria-required="true" value="<?= ($this->input->post('name') ? $this->input->post('name') : $seller[0]['name']); ?>" >
                            <label class="form-label">Name</label>
                             <span class="text-danger"><?= form_error('name');?></span>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="mobile" required="" aria-required="true" value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $seller[0]['mobile']); ?>" onkeypress="return isNumberKey(event)" maxlength="10">
                            <label class="form-label">Mobile</label>
                             <span class="text-danger"><?= form_error('mobile');?></span>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" required="" aria-required="true" value="<?= ($this->input->post('email') ? $this->input->post('email') : $seller[0]['email']); ?>">
                            <label class="form-label">Email</label>
                             <span class="text-danger"><?= form_error('email');?></span>
                        </div>
                    </div>
                    <!-- <div class="col-md-12"> -->
                        <div class="form-group form-float">
                          <div class="form-line">
                       <textarea class="form-control" name="address" required><?= ($this->input->post('address') ? $this->input->post('address') : $seller[0]['address']); ?></textarea>
                              <label class="form-label">Address</label>
                               <span class="text-danger"><?= form_error('address');?></span>
                       </div>
                      </div>
                     <!-- </div> -->    
                     <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="city" required="" aria-required="true" value="<?= ($this->input->post('city') ? $this->input->post('city') : $seller[0]['city']); ?>" onkeypress="return isAlpha(event)">
                            <label class="form-label">City</label>
                             <span class="text-danger"><?= form_error('city');?></span>
                        </div>
                    </div>
                     <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="pincode" required="" aria-required="true" value="<?= ($this->input->post('pincode') ? $this->input->post('pincode') : $seller[0]['pincode']); ?>" onkeypress="return isNumberKey(event)" maxlength="6">
                            <label class="form-label">Pincode</label>
                             <span class="text-danger"><?= form_error('pincode');?></span>
                        </div>
                    </div>
                    <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male"  <?php if($staff[0]['gender']=='male'){ echo "checked"; }  ?> <?php echo  set_radio('gender', 'male'); ?> >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php if($staff[0]['gender']=='female'){ echo "checked"; }  ?>  <?php echo  set_radio('gender', 'female'); ?> >
                                    <label for="female" class="m-l-20">Female</label>
                                </div>
                               
                      <div class="form-group form-float">
                    <p>
                        Type
                    </p>
                     <select class="form-control show-tick" name="type" required >
                        <option value=''>----select-----</option>
                        <option value="1" <?php if($seller[0]['type']==1){echo 'selected'; } ?> >Service Based</option>
                        <option value="2" <?php if($seller[0]['type']==2){echo 'selected'; } ?>>Product Based</option>
                        <option value="3" <?php if($seller[0]['type']==3){echo 'selected'; } ?>>Service & Product Based</option>
                    </select>
                </div>
                    
                     <div class="form-group">
                    <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
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