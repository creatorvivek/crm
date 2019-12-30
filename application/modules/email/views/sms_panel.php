<div class="row">
  
    <div class="col-md-5">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Send Sms</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form method="post" action="<?= base_url() ?>sms/send_sms">
        <div class="form-group">
            <input type="text" name="mobile" placeholder="mobile number" value="<?= $mobile ?>" onkeypress="return isNumberKey(event)"  class="form-control" required>
        </div>
        <div class="form-group">
        <textarea class="form-control" rows="5" name="message" placeholder="Type your message here" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Send</button>
      </form>
      </div>
      </div>
    </div>
  </div>
</div>