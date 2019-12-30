<?= form_open('crn/add_crn_process',array("class"=>"form-horizontal")) ?>
<div class="form-group">
  <label for="name" class="col-md-4 control-label"><span class="text-danger">*</span>Name</label>
  <div class="col-md-5">
    <input type="text" name="name" value="<?php echo $this->input->post('parent_Name'); ?>" class="form-control" id="name" required  autofocus onfocusout="validationNasName();"/>
    <span class="text-danger name_error"></span>
  </div>
</div>


<div class="form-group">
  <label for="nas_id" class="col-md-4 control-label"><span class="text-danger">*</span>Mobile Number</label>
  <div class="col-md-5">
    <input type="text" name="mobile" value="<?php echo $this->input->post('nas_id'); ?>" class="form-control" id="nas_id" onfocusout="validationNas();" />
    <span class="text-danger nas_error"></span>
  </div>
</div>


<div class="form-group">
  <label for="location" class="col-md-4 control-label"><span class="text-danger">*</span>Location</label>
  <div class="col-md-5">
    <input type="text" name="location" value="<?php echo $this->input->post('location'); ?>" class="form-control" id="location" onfocusout="ip();" data-toggle="tooltip" data-placement="top" title="ex- 192.168.0.1"/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="description" class="col-md-4 control-label"><span class="text-danger">*</span>Description</label>
  <div class="col-md-5">
    <input type="text" name="description" value="<?php echo $this->input->post('description'); ?>" class="form-control" id="description" onfocusout="ip();" data-toggle="tooltip" data-placement="top" title=""/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>Remarks</label>
  <div class="col-md-5">
    <input type="text" name="remarks" value="<?php echo $this->input->post('ip_address'); ?>" class="form-control" id="ip_address" onfocusout="ip();" data-toggle="tooltip" data-placement="top" title="ex- 192.168.0.1"/>
    <span class="text-danger ip_error"> </span>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>lead</label>
  <div class="col-md-5">
    <select class="form-control" name="lead">
      <option value="2">parent</option>
      
    </select>
  </div>
</div>
<div class="form-group">
  <label for="remark" class="col-md-4 control-label"><span class="text-danger">*</span>Type</label>
  <div class="col-md-5">
    <select class="form-control" name="type">
      <option value="1">customer</option>
      <option value="2">frenchise</option>
      <option value="3">reseller</option>
      
    </select>
  </div>
</div>
<div class="form-group">
    <div class="col-sm-offset-4 col-sm-5">
      <button type="submit" class="btn btn-success">Save</button>
        </div>
  </div>
  <?= form_close(); ?>