    <div class="row clearfix">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>ADD <?= $heading ?></h2>

                </div>
                <div class="body">
                    <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/add">
                       <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                       <div class="card">
                        <div class="header">
                            <h2 align="center">OFFCIAL DETAILS </h2>

                        </div>
                        <div class="body">
                            <div class="row">
                               <div class="col-lg-4 col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="emp_code" required=""  value="<?= $this->input->post('emp_code'); ?>" aria-required="true"  maxlength="10">
                                        <label class="form-label">Employee code <span class="col-pink">*</span></label>
                                    </div>
                                        <!-- <div class="error"><?= form_error('emp_code');?></div> -->
                                        <label  class="error" for="emp_code"><?= form_error('emp_code');?></label>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line placeholder">
                                        <!-- <span class="input-group-addon">@example.com</span> -->
                                        <input type="text" class="form-control doj" name="doj" placeholder="Date of joining" required=""  value="<?= $this->input->post('doj'); ?>"  onkeypress="return isNumberKey(event);" >
                                        <!-- <label class="form-label">Date Of Joining <span class="col-pink">*</span></label> -->
                                        <span class="error"><?= form_error('doj');?></span>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-4 col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="qualification" required=""  value="<?= $this->input->post('qualification'); ?>" aria-required="true" >
                                        <label class="form-label">Qualification <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('qualification');?></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                        <!-- <p>
                            Designation <span class="col-pink">*</span>
                        </p> -->
                        <div class="form-groups">
                            <select class="form-control" id="department_id" name="department"  required="">
                                <option value="">--Select Department--</option>
                                <?php 
                                foreach($department as $row): ?>
                                    <option value="<?= $row['id'] ?>" <?= set_select('department',''. $row['id']. '') ?>  ><?= $row['name'] ?></option>
                                <?php   endforeach; ?>
                                
                            </select>
                            <span class="error"><?= form_error('department');?></span>
                        </div>
                    </div>
              <!--   </div>
                 <div class="row"> -->
                    <div class="col-lg-4 col-md-4">
                        <!-- <p>
                            Designation <span class="col-pink">*</span>
                        </p> -->
                        <div class="form-groups">
                            <select class="form-control" id="designation_id" name="designation"  required="">
                                <option value="">--Select Designation--</option>
                                <?php 
                                foreach($designation as $row): ?>
                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                <?php   endforeach; ?>
                                
                            </select>
                            <span class="error"><?= form_error('designation');?></span>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4">
                        <!-- <p>
                            Designation <span class="col-pink">*</span>
                        </p> -->
                        <div class="form-groups">
                            <select class="form-control" id="user_role" name="user_role"  required="">
                                <option value="">--User Role--</option>
                                <option value="2">Admin</option>
                                <option value="3">Employee</option>
                               
                                
                            </select>
                            <span class="error"><?= form_error('user_role');?></span>
                        </div>
                    </div>

                </div>
<div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="experience"  value="<?= $this->input->post('experience'); ?>" required="" aria-required="true" onkeypress="return checkSpcialChar(event)" >
                                <label class="form-label">Experience (Year) <span class="col-pink">*</span></label>
                                <span class="error"><?= form_error('experience');?></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="text" class="form-control" name="basic_pay"  value="<?= $this->input->post('basic_pay'); ?>" required="" aria-required="true" onkeypress="return checkSpcialChar(event)" >
                                <label class="form-label">Basic Salary (monthly) <span class="col-pink">*</span></label>
                                <span class="error"><?= form_error('basic_pay');?></span>
                            </div>
                        </div>
                    </div>
                     <div class="col-lg-4 col-md-4">
                                <div class="form-group form-float">
                                    <div class="form-line placeholder">
                                        <!-- <span class="input-group-addon">@example.com</span> -->
                                        <input type="text" class="form-control resignation" name="resignation" placeholder="Date of Resignation"   value="<?= $this->input->post('resignation'); ?>"  onkeypress="return isNumberKey(event);" >
                                        <!-- <label class="form-label">Date Of Joining <span class="col-pink">*</span></label> -->
                                        <span class="error"><?= form_error('resignation');?></span>
                                    </div>
                                </div>
                            </div>


            </div>
            <!-- </div> -->
            <div class="row"  >
               <div class="col-lg-5 col-md-5" >
                <!-- <div class="card"> -->
                    <div class="header">
                        <h2>PERSONAL DETAILS </h2>

                    </div>
                    <div class="body">





                        <div class="col-lg-12 col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="name"  value="<?= $this->input->post('name'); ?>" required="" aria-required="true" onkeypress="return checkSpcialChar(event)" >
                                    <label class="form-label">Name <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('name');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control dob" placeholder="date of birth" name="dob" required="" readonly=""  value="<?= $this->input->post('dob'); ?>" aria-required="true" onkeypress="return isNumberKey(event);" maxlength="10">
                                        <!-- <label class="form-label">Date Of Birth <span class="col-pink">*</span></label> -->
                                        <span class="error"><?= form_error('dob');?></span>
                                    </div>
                                </div>
                            </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="aadhar_no"  value="<?= $this->input->post('aadhar_no'); ?>" required="" aria-required="true" onkeypress="return checkSpcialChar(event)"  max-length="16">
                                    <label class="form-label">Aadhar no. <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('aadhar_no');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pan_no"  value="<?= $this->input->post('pan_no'); ?>"  aria-required="true" onkeypress="return checkSpcialChar(event)" maxlength="12" >
                                    <label class="form-label">Pan no </label>
                                    <span class="error"><?= form_error('pan_no');?></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <input type="radio" name="gender" id="male" class="with-gap" value="male" <?php echo  set_radio('gender', '1'); ?> >
                                <label for="male">Male</label>

                                <input type="radio" name="gender" id="female" class="with-gap" value="female" <?php echo  set_radio('gender', '1'); ?> >
                                <label for="female" class="m-l-20">Female</label>
                                <span class="error"><?= form_error('gender');?></span>
                            </div>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
                    <div class="col-md-1" ></div>
                <div class="col-lg-5 col-md-5">
                    <!-- <div class="card"> -->
                        <div class="header">
                            <h2>CONTACT DETAILS </h2>

                        </div>
                        <div class="body">
                            <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                  <textarea class="form-control" name="address" required="" aria-required="true"><?= $this->input->post('address'); ?></textarea>
                                  <label class="form-label">Present Addesss <span class="col-pink">*</span></label>
                                  <span class="error"></span>
                                </div>
                              </div>
                          </div>
                            <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="city" required=""  value="<?= $this->input->post('city'); ?>" aria-required="true" onkeypress="return isAlpha(event)" maxlength="10">
                                    <label class="form-label">City <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('city');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="pincode" required=""  value="<?= $this->input->post('pincode'); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="6">
                                    <label class="form-label">Pincode <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('pincode');?></span>
                                </div>
                            </div>
                        </div>
                           <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="mobile" required=""  value="<?= $this->input->post('mobile'); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                    <label class="form-label">Mobile <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('mobile');?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" required="" value="<?= $this->input->post('email'); ?>" aria-required="true">
                                    <label class="form-label">Email <span class="col-pink">*</span></label>
                                    <span class="error"><?= form_error('email');?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>






            <div class="row">
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

<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
<script src="<?= base_url() ?>assets/admin/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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
        $(element).parents('.form-groups').append(error);
    }



});

 function validation()
 {


  var $regexname=/^([a-zA-Z]{3,16})$/;

  if (! $('.name').val().match($regexname)) {
                  // there is a mismatch, hence show the error message
                  alert("not match");
              }
              else
              {

              }
          }

// $('.doj').click(function(){
// alert("d");
// $(".placeholder").addClass('focused');
// });
$(document).ready(function() {


    $( ".doj" ).datepicker({
        flat: true,
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
    $( ".dob" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     yearRange: '1950:2019'
     // maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


 });
    $( ".resignation" ).datepicker({
     //    flat: true,
     //   date: '2008-07-31',
     // current: '2008-07-31',
     dateFormat: "dd-mm-yy",
     changeMonth: true,
     changeYear: true,
     yearRange: '2018:2030'
     // maxDate: "+0d",
     // shortYearCutoff: 50
     // minDate: "-2m"
     // constrainInput: false


 });
});








      </script>

