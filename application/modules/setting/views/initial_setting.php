<div class="row">
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Plan Setting</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <?= form_open('setting/add',array("class"=>"form-horizontal","id"=>"form")) ?>
        <div class="row">
        <div class="col-md-4">
              <!-- <label  class="col-md-12 control-label">PLAN TYPE</label> -->
          
          <div class="row">
          <div class="col-md-8">
              <div class="form-group">
                <input type="text"   class="form-control plan_name" id="plan_name" required  placeholder="plan type"   data-toggle="tooltip" title="example: prepaid, postpaid,etc..." />
                <span class="text-danger name_error"></span>
              </div>
            </div>
            <div class="col-md-2">
            
              <div class="form-group">
                <button type="button" class="btn btn-success add_plan">+</button>
                <span class="text-danger name_error"></span>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
</div>