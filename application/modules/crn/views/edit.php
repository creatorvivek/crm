

<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EDIT CUSTOMER</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>crn/update/<?= $customer[0]['id'] ?>">
                                 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="name" required="" aria-required="true"  value="<?= ($this->input->post('name') ? $this->input->post('name') : $customer[0]['name']); ?>" >
                                        <label class="form-label">Name <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" required=""  value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $customer[0]['mobile']); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Mobile <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control"   value="<?= ($this->input->post('email') ? $this->input->post('email') : $customer[0]['email']); ?>" name="email" required="" aria-required="true">
                                        <label class="form-label">Email <span class="col-pink">*</span></label>
                                    </div>
                                </div>

                              <div class="form-group form-float">
                                <div class="form-line">
                                  <textarea class="form-control" name="address" required> <?= ($this->input->post('address') ? $this->input->post('address') : $customer[0]['address']); ?></textarea>
                                  <label class="form-label">Addesss <span class="col-pink">*</span></label>
                                </div>
                              </div>
                              <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="city" required=""  value="<?= ($this->input->post('city') ? $this->input->post('city') : $customer[0]['city']); ?>" aria-required="true" onkeypress="return isAlpha(event)">
                                        <label class="form-label">City <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="pincode" required=""  value="<?= ($this->input->post('pincode') ? $this->input->post('pincode') : $customer[0]['pincode']); ?>" maxlength="10" aria-required="true" onkeypress="return isNumberKey(event)">
                                        <label class="form-label">Pincode <span class="col-pink">*</span></label>
                                    </div>
                                </div>
          
                                <div class="form-group">
                                    <input type="radio" name="gender" id="male" class="with-gap" value="male" <?php if($customer[0]['gender']=='male'){
                                      echo 'checked';
                                    } ?>  >
                                    <label for="male">Male</label>

                                    <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php if($customer[0]['gender']=='female'){
                                      echo 'checked';
                                    } ?>>
                                    <label for="female" class="m-l-20">Female</label>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
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
function usernameValidation()
{
var username=$('#username').val();
$.ajax({
type: "post",
url: "<?= base_url() ?>crn/usernameCheck",
data:{username:username},
success: function (data) {
// alert(data);
var obj=JSON.parse(data)
// var result=datas;
if(obj.length>0)
{

$('.username_error').html('This username is already exist');
$('.username_error').css('color','red');
}
else
{
$('.username_error').html('This username is avilable');
$('.username_error').css('color','green');
}
// console.log(obj);
},
})
}
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