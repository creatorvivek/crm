<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>EMAIL CONFIGURATION</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>setting/email_configuration_update/<?= $email[0]['id'] ?>">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="protocol" required="" aria-required="true"  value="<?= ($this->input->post('protocol') ? $this->input->post('protocol') : $email[0]['protocol']); ?>" >
                                        <label class="form-label">PROTOCOL</label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="smtp_host" required=""  value="<?= ($this->input->post('smtp_host') ? $this->input->post('smtp_host') : $email[0]['smtp_host']); ?>" aria-required="true" >
                                        <label class="form-label">Smtp host</label>
                                    </div>
                                </div>
                              

                            
                              <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="smtp_port" required=""  value="<?= ($this->input->post('smtp_port') ? $this->input->post('smtp_port') : $email[0]['smtp_port']); ?>" aria-required="true" >
                                        <label class="form-label">Smtp port</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="smtp_user" required=""  value="<?= ($this->input->post('smtp_user') ? $this->input->post('smtp_user') : $email[0]['smtp_user']); ?>"  aria-required="true" >
                                        <label class="form-label">Smtp user</label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="password" class="form-control" name="smtp_password" required=""  value="<?= ($this->input->post('smtp_password') ? $this->input->post('smtp_password') : $email[0]['smtp_password']); ?>"  aria-required="true" >
                                        <label class="form-label">Password</label>
                                    </div>
                                </div>
          
          
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Send test email</h2>
                        <div class=""><small>Send test email to make sure that your SMTP settings is set correctly.</small></div>

                        </div>
                        <div class="body">
                            <form action="<?= base_url() ?>email/test_email" method="post">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                     <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="email" class="form-control" name="email" required=""    aria-required="true" >
                                        <label class="form-label">Email</label>
                                    </div>
                                </div>     
                                <button type="submit" class="btn btn-info">Send</button>   
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
'email': {
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