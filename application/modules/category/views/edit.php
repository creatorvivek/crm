

<div class="row clearfix">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
    <div class="card">
      <div class="header">
        <h2 align="center">
        EDIT CATEGORY
        
        </h2>
        
      </div>
      <div class="body">
        <?= form_open('category/category_edit/'.$category['id'].'',array("class"=>"form-horizontal","id"=>"form_validation")); ?>
        <div class="col-md-12">
          <div class="form-group form-float">
            <div class="form-line">
              <input type="text" id="name" name="name" class="form-control" value="<?= ($this->input->post('name') ? $this->input->post('name') : $category['name']); ?>" required onkeypress="return isAlpha(event)" >
              <label class="form-label">Category Name</label>
            </div>
          </div>
        </div>
        <!-- <div class="form-group">
          <label for="category" class="col-md-4 control-label"><span class="text-danger">*</span>Select Parent Category</label>
          <div class="col-md-3">
            <select name="paraent_cat_id" class="form-control">
              <option value="0"> no parent category</option>
            </select>
            <span class="text-danger name_error"></span>
          </div>
        </div> -->
        <div class="col-md-12">
         <!--  <p>
            <b>Parent Category</b>
          </p> -->
          <div class="form-group">
          <select class="form-control show-tick" name="category_id" required>
            
            <!-- <option value="<?= $parent_category['category_id'] ?>"><?= $parent_category['name'] ?></option> -->
            <!-- <option value="0"> no parent category</option> -->
            <?php  foreach($category_option1 as $row)
            { 
              if($row['category_id']== $parent_category['category_id'] )
                { ?>
            <option value="<?= $parent_category['category_id'] ?>" selected > <?= $parent_category['name'] ?></option>
            <?php 
                }
               else
               { 
              ?>
            <option value="<?= $row['category_id'] ?>" > <?= $row['name'] ?></option>
            <?php } }?> 
            
          </select>
        </div>
        </div>
        <button class="btn btn-info">Update</button>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

  <script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

  <script src="<?= base_url() ?>assets/admin/js/pages/forms/form-validation.js"></script>