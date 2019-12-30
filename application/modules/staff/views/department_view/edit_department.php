<div class="row clearfix">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>UPDATE DEPARTMENT</h2>
                            
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" novalidate="novalidate" action="<?= base_url() ?>staff/department_update/<?= $department['id'] ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="department_name" required="" aria-required="true" value="<?= $this->input->post('department_name')?$this->input->post('department_name'):$department['name']          ?>" >
                                        <label class="form-label">department Name <span class="col-pink">*</span></label>
                                        <span class="error"><?= form_error('department_name');?></span>
                                    </div>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">UPDATE</button>
                            </form>
                        </div>
                    </div>
                </div>