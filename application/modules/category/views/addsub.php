
<?php echo form_open('category/add',array("class"=>"form-horizontal")); ?>

<div class="form-group">
  <label for="category" class="col-md-4 control-label"><span class="text-danger">*</span>Select Name</label>
  <div class="col-md-3">
   <select>
   <?php 	foreach($category as $row)
   { ?>
   	<option value="<?= $row['id'] ?>" > <?= $row['name'] ?></option>
   <?php } ?>
   </select>
    <span class="text-danger name_error"></span>
  </div>
</div>


<div class="form-group">
  <label for="name" class="col-md-4 control-label"><span class="text-danger">*</span>Subcategory Name</label>
  <div class="col-md-3">
    <input type="text" name="subcatname" value="<?php echo $this->input->post('subcatname'); ?>" class="form-control" id="subcatname" required  autofocus "/>
    <span class="text-danger name_error"></span>
  </div>
</div>