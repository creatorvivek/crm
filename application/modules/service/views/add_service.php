<div class="row clearfix">
    <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>ADD <?= $heading ?></h2>

            </div>
            <div class="body">
                <form id="form_validation" method="POST"  action="<?= base_url() ?>service/add">
                   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>"> 

                  
          <p>
            Select Service  (If Purchased)
        </p>
        <div class="form-group">
          <select class="form-control show-tick" name="service_id" id="service_id"  onchange="fill_details()">

            <option value=""> --Select Service --</option>
            <!-- <option value="0"> no parent category</option> -->
            <?php  foreach($service as $row)
            { ?>
                <option value="<?= $row['id'] ?>" > <?= $row['service_name'] ?></option>
            <?php } ?>
            
        </select>
         </div>





<div class="form-group form-float">
    <div class="form-line placeholder"> 
        <input type="text" class="form-control service_name" name="service_name" required="" aria-required="true" >
        <label class="form-label">Service Name <span class="col-pink">*</span></label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line placeholder">
      <textarea class="form-control description" name="discription" required></textarea>
      <label class="form-label">Description <span class="col-pink">*</span></label>
  </div>
</div>
<div class="form-group form-float">
    <div class="form-line placeholder">
        <input type="text" class="form-control amount" name="amount" required="" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
        <label class="form-label">Service Amount <span class="col-pink">*</span></label>
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line placeholder">
        <input type="text" class="form-control service_validity" name="validity" required="" aria-required="true">
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

 function fill_details()
 {
    var service_id = $('#service_id').val();
    console.log(service_id);
    
          $.ajax({
type: "post",
url: "<?= base_url() ?>service/service_details",
data:{service_id:service_id,<?= $this->security->get_csrf_token_name();?>:"<?= $this->security->get_csrf_hash();?>"},
success: function (data) {
  // $('#customerModal').hide();
        // console.log(data);
        var obj=JSON.parse(data);
        console.log(obj);
        if(obj.length==1)
        {
            $('.service_name').val(obj[0].service_name);
            $('.description').val(obj[0].description);
            $('.amount').val(obj[0].selling_amount);
            $('.service_validity').val(obj[0].service_validity);
            // $('.validity').val(obj[0].service_validity);
            $(".placeholder").addClass("focused");


        }    
  // fetch_category();
 // location.reload();

},
});


 }
</script>