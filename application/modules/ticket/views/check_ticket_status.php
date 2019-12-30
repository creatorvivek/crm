<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?= $heading ?></h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>ticket/check_ticket_status">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="ticket_no"  value="<?= $this->input->post('ticket_no'); ?>" required="" aria-required="true" onkeypress="return checkSpcialChar(event)" >
                                        <label class="form-label"><?= strtoupper(isset($this->session->menu_ticket) ? $this->session->menu_ticket : 'TICKET') ?> NO <span class="col-pink">*</span></label>
                                        <span class="text-danger"><?= form_error('ticket_no');?></span>
                                    </div>
                                </div>
                                
                               
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
         