<div class="row clearfix">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>ADD VENDOR</h2>

            </div>
            <div class="body">
                <form id="form_validation" method="POST"  action="<?= base_url() ?>vendor/add">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <div class="row clearfix">
                   <div class="col-md-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="name" required="" aria-required="true" >
                            <label class="form-label ">Vendor Name <span class="col-pink">*</span></label>
                             <span class="error"><?= form_error('name');?></span>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="company_name"  aria-required="true" >
                            <label class="form-label">Vendor Company Name</label>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control" name="mobile" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                            <label class="form-label">Mobile <span class="col-pink">*</span></label>
                             <span class="error"><?= form_error('mobile');?></span>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" required="" aria-required="true">
                            <label class="form-label">Email <span class="col-pink">*</span></label>
                             <span class="error"><?= form_error('email');?></span>
                        </div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                          <textarea class="form-control" name="address" required></textarea>
                          <label class="form-label">Address <span class="col-pink">*</span></label>
                           <span class="error"><?= form_error('address');?></span>
                      </div>
                  </div>
              </div>
               <div class="col-md-12">
                  <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="city" required="" aria-required="true" onkeypress="return isAlpha(event)">
                        <label class="form-label">City <span class="col-pink">*</span></label>
                        <span class="error"><?= form_error('city');?></span>
                    </div>
                </div>
            </div>
             <div class="col-md-12">
                <div class="form-group form-float">
                    <div class="form-line">
                        <input type="text" class="form-control" name="pincode" required="" aria-required="true" maxlength="6" onkeypress="return isNumberKey(event)">
                        <label class="form-label">Pincode <span class="col-pink">*</span></label>
                        <span class="error"><?= form_error('pincode');?></span>
                    </div>
                </div>
            </div>
                 <div class="col-md-12">
                <div class="form-group">
                    <input type="radio" name="gender" id="male" class="with-gap" value="male">
                    <label for="male">Male</label>

                    <input type="radio" name="gender" id="female" class="with-gap" value="female">
                    <label for="female" class="m-l-20">Female</label>
                </div>
            </div>
                <div class="col-md-12">
                   <div class="form-group">
                       <input type="checkbox" id="basic_checkbox_2" class="filled-in check" name="check" value="1"  onclick="showOption()"   />
                       <label for="basic_checkbox_2">opening Balance ?</label>
                   </div>
               </div>
               <div id="show_option">
                <div class="col-md-6">
                    <div class="form-group form-float">
                      <div class="form-line">
                        <input type="text" class="form-control" name="opening_balance"  onkeypress="return isNumberKey(event)"  aria-required="true">
                        <label class="form-label">Opening Balance <span class="col-pink">*</span></label>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-md-12">
        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
    </div>
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


    function validateMobile()
    {
        var mobile=$('#mobile').val();
// console.log(mobile);
if(mobile=='')
{
    $('.mobile_error').show();
    $('.mobile_error').html('Please fill this field');
    $('#mobile').focus();
}
else
{
    $('.mobile_error').hide();
    $.ajax({
        type: "post",
        url: "<?= base_url() ?>crn/mobileCheck",
        data:{mobile:mobile},
        success: function (data) {
            var obj=JSON.parse(data);
            console.log(obj);

            if(obj.length>0)
            {
                $('.mobile_error').show();
                $('.mobile_error').html('this mobile number already exist of crn='+obj[0].crn_id+'');
            }
        },
    });
}
}
$(document).ready( function () {


   $('#show_option').hide();
});
function showOption()
{
// $('#show_option').show();
if($('.check').is(':checked'))
{
    $('#show_option').fadeIn();
}
else
{
    $('#show_option').fadeOut();

}
}
</script>