<div class="row clearfix">
  <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>task/daily_report_add">
   <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
   <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2>ADD TODAY REPORTS</h2>

      </div>
      <div class="body">
       <div class="col-md-12">
         <div class="form-group form-float">
          <div class="form-line">
            <textarea class="form-control" name="task"><?= $this->input->post('task'); ?></textarea>
            <label class="form-label">TASK <span class="col-pink">*</span></label>
            <span class="error"><?= form_error('task');?></span>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <input type="checkbox" name="task_completion" id="task_complete" class="with-gap" value="1" <?php echo  set_radio('task_completion', '1'); ?> >
          <label for="task_complete">TASK COMPLETED?</label>


          <span class="text-danger"><?= form_error('task_completion');?></span>
        </div>
      </div>

      <div class="col-md-6">
       <div class="form-group form-float ">
        <div class="form-line ps">
          <input type="text" class="form-control" name="completion_percent" required="" id="completion_percent"  value="<?= $this->input->post('completion_percent'); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="3">
          <label class="form-label">Completion Percent <span class="col-pink">*</span></label>
          <span class="text-danger"><?= form_error('completion_percent');?></span>
        </div>
      </div>
    </div>
    <div class="col-md-12">
     <div class="form-group form-float">
      <div class="form-line">
        <textarea class="form-control" name="work" required><?= $this->input->post('work'); ?></textarea>
        <label class="form-label">WORK DID <span class="col-pink">*</span></label>
        <span class="error"><?= form_error('work');?></span>
      </div>
    </div>
  </div>
  <div class="col-md-6">
   <div class="form-group">
    <!-- <div class="form-line"> -->
     <input type="checkbox" id="basic_checkbox_2" class="filled-in check " name="check" value="1" onclick="addIssue()"  />
     <label for="basic_checkbox_2">Faced any issue ?</label>
     <!-- </div> -->
   </div>
 </div>
 <div class="col-md-6">
   <div class="form-group form-float ">
    <div class="form-line">
      <input type="text" class="form-control" name="how_many"  id="how_many" onkeyup="addIssue()" value="<?= $this->input->post('how_many'); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="3">
      <label class="form-label">How many Issue ? <span class="col-pink">*</span></label>
      <span class="text-danger"><?= form_error('how_many');?></span>
    </div>
  </div>
</div>

<!-- <div class="col-md-12">
 <div class="form-group form-float">
    <div class="form-line">
     <input type="text" name="how_many">
      <label class="form-label">ISSUE <span class="col-pink">*</span></label>
     
  </div>
</div>
</div>
<div class="col-md-12">
 <div class="form-group form-float">
    <div class="form-line">
        <input type="text" class="form-control" name="category" required=""  value="<?= $this->input->post('category'); ?>" aria-required="true" >
        <label class="form-label">ISSUE CATEGORY <span class="col-pink">*</span></label>
   
    </div>
</div>
</div>
<div class="col-md-10">
 <div class="form-group form-float">
    <div class="form-line">
      <textarea class="form-control" name="solution[]" required></textarea>
      <label class="form-label">SOLUTION <span class="col-pink">*</span></label>
      <span class="error"><?= form_error('solution[]');?></span>
  </div>
</div>
</div>
<div class="col-md-2">
 <button class="btn btn-success waves-effect add" type="button" >+</button>
</div> -->



<button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>

</div>
</div>
</div>
<div class="col-md-6 otherPanel" style="display:none"  >
  <div class="card" style="overflow-y: scroll;max-height: 700px;">

    <div class="addIssueBody"></div>
  </div>
</div>
</form>
</div>



<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

<script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>
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

          $('#task_complete').click(function(){
            if($('#task_complete').is(':checked')){
              $('#completion_percent').val('100');
              $(".ps").addClass("focused");
              console.log("yes");
            }
            else
            {
              console.log("not");
              $('#completion_percent').val('');
              $(".ps").removeClass("focused");

            }
          });
          function addIssue()
          {
           if($('.check').is(':checked'))
           {
            console.log('d');
            var issueRow='<div class="body"><div class="col-md-12">'+
            '<div class="form-group form-float">'+
            '<div class="form-line">'+
            '<textarea class="form-control" name="issue[]" required></textarea>'+
            '<label class="form-label">ISSUE <span class="col-pink">*</span></label>'+

            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-6">'+
            '<div class="form-group form-float">'+
            '<div class="form-line">'+
            '<input type="text" class="form-control" name="category[]" required=""   aria-required="true" >'+
            '<label class="form-label">ISSUE CATEGORY <span class="col-pink">*</span></label>'+

            '</div>'+
            '</div>'+
            '</div>'+
            '<div class="col-md-12">'+
            '<div class="form-group form-float">'+
            '<div class="form-line">'+
            '<textarea class="form-control" name="solution[]" required></textarea>'+
            '<label class="form-label">SOLUTION <span class="col-pink">*</span></label>'+
            '<span class="error"><?= form_error('solution[]');?></span>'+
            '</div>'+
            '</div>'+
            '</div>'+


            '</body>'
            $('.addIssueBody').empty();
            var qty=$('#how_many').val();
            for(var i=0;i<qty;i++)
            {
             $('.otherPanel').show();
  // $('.newRow').append(line);
  $('.addIssueBody').append(issueRow);
  $(".ps2").addClass("focused");
}
}
else
{
  $('.otherPanel').hide();
  $('.addIssueBody').empty(issueRow);
}

}








</script>

