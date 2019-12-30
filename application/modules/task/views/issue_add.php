<div class="row clearfix">
  <div class="col-lg-8 col-md-8    col-sm-12 col-xs-12">
    <div class="card">
      <div class="header" align="center">
        <h2><?php echo isset($heading)?$heading:'ADD ISSUE' ?></h2>
        
      </div>
      <div class="body">
        <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>task/add_issue_process">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
           <div class="row clearfix">
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <!-- <input type="text" class="form-control" name="issue" required="" aria-required="true" > -->
                                <textarea class="form-control" name="issue" required></textarea>

                <label class="form-label">ISSUE ? <span class="col-pink">*</span></label>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group form-float">
              <div class="form-line">
                <textarea class="form-control" name="description"></textarea>
                <label class="form-label">SOLUTION </label>
              </div>
            </div>
          </div>
         
         <div class="col-md-6">
          
            <div class="form-group" >
              <select class="form-control show-tick" id="category_select" name="category_id" required>
               
                <option value=""> --select category--</option> 

               
                <?php  foreach($issue_category as $row)
                { ?>
                <option value="<?= $row['id'] ?>" > <?= $row['category_name'] ?></option>
                <?php } ?> 
                 <!-- <option value="default"> -- ADD CATEGORY-- </option>  -->
              
                
              </select>
            </div>
          </div>
        </div>
          <div class="row clearfix">
           <div class="col-md-6" align="center">
          <!-- <div class="form-group"> -->
          <button class="btn btn-primary waves-effect" align="center" type="submit">SUBMIT</button>
        </div>
        <div class="col-md-6" align="center">
          <!-- <div class="form-group"> -->
          <button class="btn btn-primary waves-effect" align="center" type="submit">SUBMIT & ADD MORE</button>
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