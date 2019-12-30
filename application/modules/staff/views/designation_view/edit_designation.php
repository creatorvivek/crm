<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>UPDATE DESIGNATION</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/designation_update/<?= $designation['id'] ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="designation_name" required="" aria-required="true" value="<?= $this->input->post('designation_name')?$this->input->post('designation_name'):$designation['name']          ?>" >
                                        <label class="form-label">Designation Name <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('designation_name');?></span>
                                    </div>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>