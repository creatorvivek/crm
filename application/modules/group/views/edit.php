
<!-- <?php var_dump($group); ?> -->
<div class="row">
  <div class="col-md-4">

    <div class="card">
      <div class="card-header">
        <h3 class="card-title">EDIT GROUP</h3>
      </div>
      <div class="card-body">
         <?= form_open('group/edit/'.$group['data'][0]['id'].'',array("class"=>"form-horizontal")); ?>
        <div class="form-group">
          <label for="Name" class="col-md-4 control-label"><span class="text-danger">*</span>Group Name</label>
          <div class="col-md-8">
            <input type="text" name="name" value="<?= ($this->input->post('name') ? $this->input->post('name') : $group['data'][0]['name']); ?>" class="form-control" id="name" required  autofocus/>
            <span class="text-danger name_error"></span>
          </div>
        </div>


        <div class="form-group">
          <label for="head" class="col-md-4 control-label"><span class="text-danger">*</span>Head</label>
          <div class="col-md-8">
            <input type="text" name="head" value="<?= ($this->input->post('head') ? $this->input->post('head') : $group['data'][0]['head_name']); ?>" class="form-control" id="head"  />
            <span class="text-danger nas_error"></span>
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-md-4 control-label"><span class="text-danger">*</span>Description</label>
          <div class="col-md-8">
            <input type="text" name="description" value="<?= ($this->input->post('description') ? $this->input->post('description') : $group['data'][0]['description']); ?>" class="form-control" id="description" />
            <span class="text-danger"><?php echo form_error('description');?></span>
          </div>
        </div>
        <div class="form-group">
          <label for="f_detail" class="col-md-4 control-label"><span class="text-danger">*</span>Frenchizy Detail</label>
          <div class="col-md-8">
            <input type="text" name="f_detail" value="<?= ($this->input->post('f_detail') ? $this->input->post('f_detail') : $group['data'][0]['frenchizy_detail']); ?>" class="form-control" id="f_detail"  data-toggle="tooltip" data-placement="top" title=""/>
            <span class="text-danger ip_error"> </span>
          </div>
        </div>
        <div class="form-group">
          <label for="business" class="col-md-4 control-label"><span class="text-danger">*</span>Business</label>
          <div class="col-md-8">
            <input type="text" name="business" value="<?= ($this->input->post('business') ? $this->input->post('business') : $group['data'][0]['belong_business']); ?>" class="form-control" id="business" />
            <span class="text-danger"><?php echo form_error('port');?></span>
          </div>
        </div>
        <!-- <input type="hidden" name="id" value="<?= $group['data'][0]['id'] ?>"> -->
    </div>
     <div class="form-group">
        	<div class="col-sm-offset-4 col-sm-5">
        		<button type="submit" class="btn btn-success">Update</button>
        	</div>
        </div>
        <?= form_close() ?>
</div>
</div>
</div>
