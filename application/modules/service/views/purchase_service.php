<div class="row clearfix">
    <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>PURCHASE <?= $heading ?></h2>

            </div>
            <div class="body">
                <form id="form_validation" method="POST"  action="<?= base_url() ?>service/service_purchase_add">
                   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>"> 

                      <div class="form-group">
                         <!-- <div class="form-line"> -->
                            <select class="form-control" name="vendor_id" required=""  >
                              <option value="" >--Select Vendor-- </option>
                              <?php {
                                foreach($vendor as $row)
                                {
                                  ?>

                                  <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                              <?php   }

                          }?>

                      </select>
                      <!-- </div> -->
                  </div>
             
              <div class="form-group form-float">
                <div class="form-line">
                    <input type="text" class="form-control" name="service_name" required="" aria-required="true" >
                    <label class="form-label">Service Name <span class="col-pink">*</span></label>
                </div>
            </div>
            <div class="form-group form-float">
                <div class="form-line">
                  <textarea class="form-control" name="discription" required></textarea>
                  <label class="form-label">Description <span class="col-pink">*</span></label>
              </div>
          </div>
          <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="purchase_amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Service Purchase Amount <span class="col-pink">*</span></label>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="selling_amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                <label class="form-label">Service Selling Amount <span class="col-pink">*</span></label>
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                <input type="text" class="form-control" name="validity" required="" aria-required="true">
                <label class="form-label">Service Validity <span class="col-pink">*</span></label>
            </div>
        </div>
        <div class="form-group">
            <input type="radio" name="validity_unit" id="radio1" class="with-gap" value="once" required="">
            <label for="radio1">Once</label>
            <input type="radio" name="validity_unit" id="male" class="with-gap" value="day" >
            <label for="male">Day</label>

            <input type="radio" name="validity_unit" id="female" class="with-gap" value="month">
            <label for="female">Month</label>
            <input type="radio" name="validity_unit" id="radio3" class="with-gap" value="year">
            <label for="radio3" >Year</label>
        </div>

        <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
    </form>
</div>
</div>
</div>
</div>
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<script type="text/javascript">
 $('#form_validation').validate({
    rules: {
        'checkbox': {
            required: true
        },
        'radio': {
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