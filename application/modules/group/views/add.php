
<div class="row">
  <div class="col-md-4">

    <div class="card">
      <div class="header">
        <h3>ADD GROUP</h3>
      </div>
      <div class="body">
       
         <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>group/add">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
         <div class="form-group form-float">
              <div class="form-line">
          <!-- <div class="col-md-10"> -->
            <input type="text" name="name" value="<?php echo $this->input->post('name'); ?>" class="form-control" id="name" required  autofocus aria-required="true" />
          <label class="form-label">Group Name <span class="col-pink">*</span></label>
            <span class="error"><?php echo form_error('description');?></span>
          <!-- </div> -->
        </div>
      </div>


         <div class="form-group form-float">
              <div class="form-line">
          <!-- <div class="col-md-10"> -->
            <input type="text" name="head" value="<?php echo $this->input->post('head'); ?>" class="form-control" id="head" required aria-required="true"  />
          <label class="form-label">Head <span class="col-pink">*</span></label>
           <span class="error"><?php echo form_error('head');?></span>
          <!-- </div> -->
        </div>  
      </div>

         <div class="form-group form-float">
              <div class="form-line">
          <!-- <div class="col-md-10"> -->
            <input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" required aria-required="true" />
          <label class="form-label">Description <span class="col-pink">*</span></label>
            <span class="text-danger"><?php echo form_error('description');?></span>
          <!-- </div> -->
        </div>
      </div>
       
        
          <!-- <label>Add Member</label> -->  
         <div class="form-group">
            
            <select   name="member[]" class="form-control show-tick"   data-live-search="true" multiple>
              <option value="">--select--</option>
               <?php for($i=0;$i<count($staff);$i++) { ?>
              
       
            <option value="<?= $staff[$i]['id'] ?>"><?= $staff[$i]['name'] ?></option>
    <?php  }  ?> 

            
          </select>
        </div>
      
      <!-- /.form-group -->
      <div class="form-group">
        <!-- <div class="col-sm-offset-10 col-sm-10"> -->
          <button type="submit" class="btn btn-success">ADD</button>
        <!-- </div> -->
      </div>

       </form>

    </div><!--card body -->
  </div><!--card  -->
</div><!--card col  -->
</div><!--row  -->
