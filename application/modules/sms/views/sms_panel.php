<div class="row clearfix">
  
    <div class="col-md-5">
    <div class="card">
      <div class="header">
        <h3 class="card-title">Send Sms</h3>
      </div>
      <!-- /.card-header -->
      <div class="body">
        <form method="post" action="<?= base_url() ?>sms/send_sms">
           <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
      <!--   <div class="form-group">
            <input type="text" name="mobile" placeholder="mobile number" value="<?= $mobile ?>" onkeypress="return isNumberKey(event)"  class="form-control" required>
        </div> -->
        <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="mobile" required="" aria-required="true"  value="<?= $mobile ?>" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Mobile <span class="col-pink">*</span></label>
                                    </div>
                                </div>
        <div class="form-group form-float">
                                <div class="form-line">
                                  <textarea class="form-control" name="message" required></textarea>
                                  <span class="col-pink">*</span>
                                  <label class="form-label">Type Your Message Here.....</label>
                                </div>
                              </div>
        <button type="submit" class="btn btn-success">Send</button>
      </form>
      </div>
      </div>
    </div>
  </div>
</div>