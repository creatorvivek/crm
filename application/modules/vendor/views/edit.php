<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>UPDATE VENDOR</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  action="<?= base_url() ?>vendor/update/<?= $vendor[0]['id'] ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required="" value="<?= ($this->input->post('name') ? $this->input->post('name') : $vendor[0]['name']); ?>" aria-required="true" >
                                        <label class="form-label">Vendor Name <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="company_name"  aria-required="true" value="<?= ($this->input->post('company_name') ? $this->input->post('company_name') : $vendor[0]['company_name']); ?>" >
                                        <label class="form-label">Vendor Company Name</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $vendor[0]['mobile']); ?>"  name="mobile"  required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Mobile <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required="" aria-required="true" value="<?= ($this->input->post('email') ? $this->input->post('email') : $vendor[0]['email']); ?>">
                                        <label class="form-label">Email <span class="col-pink">*</span></label>
                                    </div>
                                </div>

                              <div class="form-group form-float">
                                <div class="form-line">
                                  <textarea class="form-control" name="address" required><?= $vendor[0]['address'] ?></textarea>
                                  <label class="form-label">Address <span class="col-pink">*</span></label>
                                </div>
                              </div>
                              <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="city" required="" aria-required="true" onkeypress="return isAlpha(event)" value="<?= ($this->input->post('city') ? $this->input->post('city') : $vendor[0]['city']); ?> ">
                                        <label class="form-label">City <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pincode" required="" aria-required="true" maxlength="6" onkeypress="return isNumberKey(event)" value="<?= ($this->input->post('pincode') ? $this->input->post('pincode') : $vendor[0]['pincode']); ?>" >
                                        <label class="form-label">Pincode <span class="col-pink">*</span></label>
                                    </div>
                                </div>
          
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male" <?php if($vendor[0]['gender']=='male'){ echo 'checked';  } ?> >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php if($vendor[0]['gender']=='female'){ echo 'checked';  } ?>  >
                                    <label for="female" class="m-l-20">Female</label>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
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


<script type="text/javascript">

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

</script>