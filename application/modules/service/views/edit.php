<div class="row clearfix">
                <div class="col-lg-16 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>Edit <?= $heading ?></h2>
                           
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST"  action="<?= base_url() ?>service/service_update/<?= $service[0]['id'] ?>">
                                 <input type="hidden" name="<?= $this->security->get_csrf_token_name();?>" value="<?= $this->security->get_csrf_hash();?>"> 
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="service_name" value="<?= ($this->input->post('service_name') ? $this->input->post('service_name') : $service[0]['service_name']); ?>" required="" aria-required="true" >
                                        <label class="form-label">Service Name <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                 <div class="form-group form-float">
                                <div class="form-line">
                                  <textarea class="form-control" name="discription" required="" ><?= $service[0]['description'] ?></textarea>
                                  <label class="form-label">Description <span class="col-pink">*</span></label>
                                </div>
                              </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="amount" required="" value="<?= ($this->input->post('amount') ? $this->input->post('amount') : $service[0]['amount']); ?>" aria-required="true" onkeypress="return isNumberKey(event)" maxlength="10">
                                        <label class="form-label">Service Amount <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="validity" required=""  value="<?= ($this->input->post('validity') ? $this->input->post('validity') : $service[0]['validity']); ?>"  aria-required="true">
                                        <label class="form-label">Service Validity <span class="col-pink">*</span></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <input type="radio" name="validity_unit" id="radio1" class="with-gap" value="once" required="" <?php if($service[0]['validity_unit']=='once') { echo 'checked'; } ?>>
                                    <label for="radio1">Once</label>
                                    <input type="radio" name="validity_unit" id="male" class="with-gap" value="day"  <?php if($service[0]['validity_unit']=='day') { echo 'checked'; } ?>  >
                                    <label for="male">Day</label>

                                    <input type="radio" name="validity_unit" id="female" class="with-gap" value="month" <?php if($service[0]['validity_unit']=='month') { echo 'checked'; } ?> >
                                    <label for="female">Month</label>
                                    <input type="radio" name="validity_unit" id="radio3" class="with-gap" value="year" <?php if($service[0]['validity_unit']=='year') { echo 'checked'; } ?> >
                                    <label for="radio3" >Year</label>
                                </div>
                               
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>