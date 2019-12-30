

<div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>SMS CONFIGURATION</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>setting/update_sms_configuration/<?= $sms[0]['id'] ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="auth_key" required="" aria-required="true"  value="<?= ($this->input->post('auth_key') ? $this->input->post('auth_key') : $sms[0]['auth_key']); ?>" >
                                        <label class="form-label">Auth key</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="url" required=""  value="<?= ($this->input->post('url') ? $this->input->post('url') : $sms[0]['url']); ?>" aria-required="true" >
                                        <label class="form-label">Url</label>
                                    </div>
                                </div>
                              

                            
                              <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="route" required=""  value="<?= ($this->input->post('route') ? $this->input->post('route') : $sms[0]['route']); ?>" aria-required="true" >
                                        <label class="form-label">Route</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="sender_id" required=""  value="<?= ($this->input->post('sender_id') ? $this->input->post('sender_id') : $sms[0]['sender_id']); ?>"  aria-required="true" >
                                        <label class="form-label">Sender id</label>
                                    </div>
                                </div>
          
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>

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
</script>